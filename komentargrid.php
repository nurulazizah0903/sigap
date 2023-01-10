<?php
namespace PHPMaker2020\sigap;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($komentar_grid))
	$komentar_grid = new komentar_grid();

// Run the page
$komentar_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$komentar_grid->Page_Render();
?>
<?php if (!$komentar_grid->isExport()) { ?>
<script>
var fkomentargrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fkomentargrid = new ew.Form("fkomentargrid", "grid");
	fkomentargrid.formKeyCountName = '<?php echo $komentar_grid->FormKeyCountName ?>';

	// Validate form
	fkomentargrid.validate = function() {
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
			<?php if ($komentar_grid->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $komentar_grid->id->caption(), $komentar_grid->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($komentar_grid->pid->Required) { ?>
				elm = this.getElements("x" + infix + "_pid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $komentar_grid->pid->caption(), $komentar_grid->pid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pid");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($komentar_grid->pid->errorMessage()) ?>");
			<?php if ($komentar_grid->gambar->Required) { ?>
				elm = this.getElements("x" + infix + "_gambar");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $komentar_grid->gambar->caption(), $komentar_grid->gambar->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($komentar_grid->video->Required) { ?>
				elm = this.getElements("x" + infix + "_video");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $komentar_grid->video->caption(), $komentar_grid->video->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($komentar_grid->pegawai->Required) { ?>
				elm = this.getElements("x" + infix + "_pegawai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $komentar_grid->pegawai->caption(), $komentar_grid->pegawai->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pegawai");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($komentar_grid->pegawai->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fkomentargrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "pid", false)) return false;
		if (ew.valueChanged(fobj, infix, "gambar", false)) return false;
		if (ew.valueChanged(fobj, infix, "video", false)) return false;
		if (ew.valueChanged(fobj, infix, "pegawai", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fkomentargrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fkomentargrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fkomentargrid");
});
</script>
<?php } ?>
<?php
$komentar_grid->renderOtherOptions();
?>
<?php if ($komentar_grid->TotalRecords > 0 || $komentar->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($komentar_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> komentar">
<?php if ($komentar_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $komentar_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fkomentargrid" class="ew-form ew-list-form form-inline">
<div id="gmp_komentar" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_komentargrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$komentar->RowType = ROWTYPE_HEADER;

// Render list options
$komentar_grid->renderListOptions();

// Render list options (header, left)
$komentar_grid->ListOptions->render("header", "left");
?>
<?php if ($komentar_grid->id->Visible) { // id ?>
	<?php if ($komentar_grid->SortUrl($komentar_grid->id) == "") { ?>
		<th data-name="id" class="<?php echo $komentar_grid->id->headerCellClass() ?>"><div id="elh_komentar_id" class="komentar_id"><div class="ew-table-header-caption"><?php echo $komentar_grid->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $komentar_grid->id->headerCellClass() ?>"><div><div id="elh_komentar_id" class="komentar_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $komentar_grid->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($komentar_grid->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($komentar_grid->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($komentar_grid->pid->Visible) { // pid ?>
	<?php if ($komentar_grid->SortUrl($komentar_grid->pid) == "") { ?>
		<th data-name="pid" class="<?php echo $komentar_grid->pid->headerCellClass() ?>"><div id="elh_komentar_pid" class="komentar_pid"><div class="ew-table-header-caption"><?php echo $komentar_grid->pid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pid" class="<?php echo $komentar_grid->pid->headerCellClass() ?>"><div><div id="elh_komentar_pid" class="komentar_pid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $komentar_grid->pid->caption() ?></span><span class="ew-table-header-sort"><?php if ($komentar_grid->pid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($komentar_grid->pid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($komentar_grid->gambar->Visible) { // gambar ?>
	<?php if ($komentar_grid->SortUrl($komentar_grid->gambar) == "") { ?>
		<th data-name="gambar" class="<?php echo $komentar_grid->gambar->headerCellClass() ?>"><div id="elh_komentar_gambar" class="komentar_gambar"><div class="ew-table-header-caption"><?php echo $komentar_grid->gambar->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="gambar" class="<?php echo $komentar_grid->gambar->headerCellClass() ?>"><div><div id="elh_komentar_gambar" class="komentar_gambar">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $komentar_grid->gambar->caption() ?></span><span class="ew-table-header-sort"><?php if ($komentar_grid->gambar->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($komentar_grid->gambar->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($komentar_grid->video->Visible) { // video ?>
	<?php if ($komentar_grid->SortUrl($komentar_grid->video) == "") { ?>
		<th data-name="video" class="<?php echo $komentar_grid->video->headerCellClass() ?>"><div id="elh_komentar_video" class="komentar_video"><div class="ew-table-header-caption"><?php echo $komentar_grid->video->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="video" class="<?php echo $komentar_grid->video->headerCellClass() ?>"><div><div id="elh_komentar_video" class="komentar_video">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $komentar_grid->video->caption() ?></span><span class="ew-table-header-sort"><?php if ($komentar_grid->video->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($komentar_grid->video->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($komentar_grid->pegawai->Visible) { // pegawai ?>
	<?php if ($komentar_grid->SortUrl($komentar_grid->pegawai) == "") { ?>
		<th data-name="pegawai" class="<?php echo $komentar_grid->pegawai->headerCellClass() ?>"><div id="elh_komentar_pegawai" class="komentar_pegawai"><div class="ew-table-header-caption"><?php echo $komentar_grid->pegawai->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pegawai" class="<?php echo $komentar_grid->pegawai->headerCellClass() ?>"><div><div id="elh_komentar_pegawai" class="komentar_pegawai">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $komentar_grid->pegawai->caption() ?></span><span class="ew-table-header-sort"><?php if ($komentar_grid->pegawai->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($komentar_grid->pegawai->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$komentar_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$komentar_grid->StartRecord = 1;
$komentar_grid->StopRecord = $komentar_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($komentar->isConfirm() || $komentar_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($komentar_grid->FormKeyCountName) && ($komentar_grid->isGridAdd() || $komentar_grid->isGridEdit() || $komentar->isConfirm())) {
		$komentar_grid->KeyCount = $CurrentForm->getValue($komentar_grid->FormKeyCountName);
		$komentar_grid->StopRecord = $komentar_grid->StartRecord + $komentar_grid->KeyCount - 1;
	}
}
$komentar_grid->RecordCount = $komentar_grid->StartRecord - 1;
if ($komentar_grid->Recordset && !$komentar_grid->Recordset->EOF) {
	$komentar_grid->Recordset->moveFirst();
	$selectLimit = $komentar_grid->UseSelectLimit;
	if (!$selectLimit && $komentar_grid->StartRecord > 1)
		$komentar_grid->Recordset->move($komentar_grid->StartRecord - 1);
} elseif (!$komentar->AllowAddDeleteRow && $komentar_grid->StopRecord == 0) {
	$komentar_grid->StopRecord = $komentar->GridAddRowCount;
}

// Initialize aggregate
$komentar->RowType = ROWTYPE_AGGREGATEINIT;
$komentar->resetAttributes();
$komentar_grid->renderRow();
if ($komentar_grid->isGridAdd())
	$komentar_grid->RowIndex = 0;
if ($komentar_grid->isGridEdit())
	$komentar_grid->RowIndex = 0;
while ($komentar_grid->RecordCount < $komentar_grid->StopRecord) {
	$komentar_grid->RecordCount++;
	if ($komentar_grid->RecordCount >= $komentar_grid->StartRecord) {
		$komentar_grid->RowCount++;
		if ($komentar_grid->isGridAdd() || $komentar_grid->isGridEdit() || $komentar->isConfirm()) {
			$komentar_grid->RowIndex++;
			$CurrentForm->Index = $komentar_grid->RowIndex;
			if ($CurrentForm->hasValue($komentar_grid->FormActionName) && ($komentar->isConfirm() || $komentar_grid->EventCancelled))
				$komentar_grid->RowAction = strval($CurrentForm->getValue($komentar_grid->FormActionName));
			elseif ($komentar_grid->isGridAdd())
				$komentar_grid->RowAction = "insert";
			else
				$komentar_grid->RowAction = "";
		}

		// Set up key count
		$komentar_grid->KeyCount = $komentar_grid->RowIndex;

		// Init row class and style
		$komentar->resetAttributes();
		$komentar->CssClass = "";
		if ($komentar_grid->isGridAdd()) {
			if ($komentar->CurrentMode == "copy") {
				$komentar_grid->loadRowValues($komentar_grid->Recordset); // Load row values
				$komentar_grid->setRecordKey($komentar_grid->RowOldKey, $komentar_grid->Recordset); // Set old record key
			} else {
				$komentar_grid->loadRowValues(); // Load default values
				$komentar_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$komentar_grid->loadRowValues($komentar_grid->Recordset); // Load row values
		}
		$komentar->RowType = ROWTYPE_VIEW; // Render view
		if ($komentar_grid->isGridAdd()) // Grid add
			$komentar->RowType = ROWTYPE_ADD; // Render add
		if ($komentar_grid->isGridAdd() && $komentar->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$komentar_grid->restoreCurrentRowFormValues($komentar_grid->RowIndex); // Restore form values
		if ($komentar_grid->isGridEdit()) { // Grid edit
			if ($komentar->EventCancelled)
				$komentar_grid->restoreCurrentRowFormValues($komentar_grid->RowIndex); // Restore form values
			if ($komentar_grid->RowAction == "insert")
				$komentar->RowType = ROWTYPE_ADD; // Render add
			else
				$komentar->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($komentar_grid->isGridEdit() && ($komentar->RowType == ROWTYPE_EDIT || $komentar->RowType == ROWTYPE_ADD) && $komentar->EventCancelled) // Update failed
			$komentar_grid->restoreCurrentRowFormValues($komentar_grid->RowIndex); // Restore form values
		if ($komentar->RowType == ROWTYPE_EDIT) // Edit row
			$komentar_grid->EditRowCount++;
		if ($komentar->isConfirm()) // Confirm row
			$komentar_grid->restoreCurrentRowFormValues($komentar_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$komentar->RowAttrs->merge(["data-rowindex" => $komentar_grid->RowCount, "id" => "r" . $komentar_grid->RowCount . "_komentar", "data-rowtype" => $komentar->RowType]);

		// Render row
		$komentar_grid->renderRow();

		// Render list options
		$komentar_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($komentar_grid->RowAction != "delete" && $komentar_grid->RowAction != "insertdelete" && !($komentar_grid->RowAction == "insert" && $komentar->isConfirm() && $komentar_grid->emptyRow())) {
?>
	<tr <?php echo $komentar->rowAttributes() ?>>
<?php

// Render list options (body, left)
$komentar_grid->ListOptions->render("body", "left", $komentar_grid->RowCount);
?>
	<?php if ($komentar_grid->id->Visible) { // id ?>
		<td data-name="id" <?php echo $komentar_grid->id->cellAttributes() ?>>
<?php if ($komentar->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $komentar_grid->RowCount ?>_komentar_id" class="form-group"></span>
<input type="hidden" data-table="komentar" data-field="x_id" name="o<?php echo $komentar_grid->RowIndex ?>_id" id="o<?php echo $komentar_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($komentar_grid->id->OldValue) ?>">
<?php } ?>
<?php if ($komentar->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $komentar_grid->RowCount ?>_komentar_id" class="form-group">
<span<?php echo $komentar_grid->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($komentar_grid->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="komentar" data-field="x_id" name="x<?php echo $komentar_grid->RowIndex ?>_id" id="x<?php echo $komentar_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($komentar_grid->id->CurrentValue) ?>">
<?php } ?>
<?php if ($komentar->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $komentar_grid->RowCount ?>_komentar_id">
<span<?php echo $komentar_grid->id->viewAttributes() ?>><?php echo $komentar_grid->id->getViewValue() ?></span>
</span>
<?php if (!$komentar->isConfirm()) { ?>
<input type="hidden" data-table="komentar" data-field="x_id" name="x<?php echo $komentar_grid->RowIndex ?>_id" id="x<?php echo $komentar_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($komentar_grid->id->FormValue) ?>">
<input type="hidden" data-table="komentar" data-field="x_id" name="o<?php echo $komentar_grid->RowIndex ?>_id" id="o<?php echo $komentar_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($komentar_grid->id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="komentar" data-field="x_id" name="fkomentargrid$x<?php echo $komentar_grid->RowIndex ?>_id" id="fkomentargrid$x<?php echo $komentar_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($komentar_grid->id->FormValue) ?>">
<input type="hidden" data-table="komentar" data-field="x_id" name="fkomentargrid$o<?php echo $komentar_grid->RowIndex ?>_id" id="fkomentargrid$o<?php echo $komentar_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($komentar_grid->id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($komentar_grid->pid->Visible) { // pid ?>
		<td data-name="pid" <?php echo $komentar_grid->pid->cellAttributes() ?>>
<?php if ($komentar->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($komentar_grid->pid->getSessionValue() != "") { ?>
<span id="el<?php echo $komentar_grid->RowCount ?>_komentar_pid" class="form-group">
<span<?php echo $komentar_grid->pid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($komentar_grid->pid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $komentar_grid->RowIndex ?>_pid" name="x<?php echo $komentar_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($komentar_grid->pid->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $komentar_grid->RowCount ?>_komentar_pid" class="form-group">
<input type="text" data-table="komentar" data-field="x_pid" name="x<?php echo $komentar_grid->RowIndex ?>_pid" id="x<?php echo $komentar_grid->RowIndex ?>_pid" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($komentar_grid->pid->getPlaceHolder()) ?>" value="<?php echo $komentar_grid->pid->EditValue ?>"<?php echo $komentar_grid->pid->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="komentar" data-field="x_pid" name="o<?php echo $komentar_grid->RowIndex ?>_pid" id="o<?php echo $komentar_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($komentar_grid->pid->OldValue) ?>">
<?php } ?>
<?php if ($komentar->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($komentar_grid->pid->getSessionValue() != "") { ?>
<span id="el<?php echo $komentar_grid->RowCount ?>_komentar_pid" class="form-group">
<span<?php echo $komentar_grid->pid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($komentar_grid->pid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $komentar_grid->RowIndex ?>_pid" name="x<?php echo $komentar_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($komentar_grid->pid->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $komentar_grid->RowCount ?>_komentar_pid" class="form-group">
<input type="text" data-table="komentar" data-field="x_pid" name="x<?php echo $komentar_grid->RowIndex ?>_pid" id="x<?php echo $komentar_grid->RowIndex ?>_pid" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($komentar_grid->pid->getPlaceHolder()) ?>" value="<?php echo $komentar_grid->pid->EditValue ?>"<?php echo $komentar_grid->pid->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($komentar->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $komentar_grid->RowCount ?>_komentar_pid">
<span<?php echo $komentar_grid->pid->viewAttributes() ?>><?php echo $komentar_grid->pid->getViewValue() ?></span>
</span>
<?php if (!$komentar->isConfirm()) { ?>
<input type="hidden" data-table="komentar" data-field="x_pid" name="x<?php echo $komentar_grid->RowIndex ?>_pid" id="x<?php echo $komentar_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($komentar_grid->pid->FormValue) ?>">
<input type="hidden" data-table="komentar" data-field="x_pid" name="o<?php echo $komentar_grid->RowIndex ?>_pid" id="o<?php echo $komentar_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($komentar_grid->pid->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="komentar" data-field="x_pid" name="fkomentargrid$x<?php echo $komentar_grid->RowIndex ?>_pid" id="fkomentargrid$x<?php echo $komentar_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($komentar_grid->pid->FormValue) ?>">
<input type="hidden" data-table="komentar" data-field="x_pid" name="fkomentargrid$o<?php echo $komentar_grid->RowIndex ?>_pid" id="fkomentargrid$o<?php echo $komentar_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($komentar_grid->pid->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($komentar_grid->gambar->Visible) { // gambar ?>
		<td data-name="gambar" <?php echo $komentar_grid->gambar->cellAttributes() ?>>
<?php if ($komentar->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $komentar_grid->RowCount ?>_komentar_gambar" class="form-group">
<input type="text" data-table="komentar" data-field="x_gambar" name="x<?php echo $komentar_grid->RowIndex ?>_gambar" id="x<?php echo $komentar_grid->RowIndex ?>_gambar" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($komentar_grid->gambar->getPlaceHolder()) ?>" value="<?php echo $komentar_grid->gambar->EditValue ?>"<?php echo $komentar_grid->gambar->editAttributes() ?>>
</span>
<input type="hidden" data-table="komentar" data-field="x_gambar" name="o<?php echo $komentar_grid->RowIndex ?>_gambar" id="o<?php echo $komentar_grid->RowIndex ?>_gambar" value="<?php echo HtmlEncode($komentar_grid->gambar->OldValue) ?>">
<?php } ?>
<?php if ($komentar->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $komentar_grid->RowCount ?>_komentar_gambar" class="form-group">
<input type="text" data-table="komentar" data-field="x_gambar" name="x<?php echo $komentar_grid->RowIndex ?>_gambar" id="x<?php echo $komentar_grid->RowIndex ?>_gambar" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($komentar_grid->gambar->getPlaceHolder()) ?>" value="<?php echo $komentar_grid->gambar->EditValue ?>"<?php echo $komentar_grid->gambar->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($komentar->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $komentar_grid->RowCount ?>_komentar_gambar">
<span<?php echo $komentar_grid->gambar->viewAttributes() ?>><?php echo $komentar_grid->gambar->getViewValue() ?></span>
</span>
<?php if (!$komentar->isConfirm()) { ?>
<input type="hidden" data-table="komentar" data-field="x_gambar" name="x<?php echo $komentar_grid->RowIndex ?>_gambar" id="x<?php echo $komentar_grid->RowIndex ?>_gambar" value="<?php echo HtmlEncode($komentar_grid->gambar->FormValue) ?>">
<input type="hidden" data-table="komentar" data-field="x_gambar" name="o<?php echo $komentar_grid->RowIndex ?>_gambar" id="o<?php echo $komentar_grid->RowIndex ?>_gambar" value="<?php echo HtmlEncode($komentar_grid->gambar->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="komentar" data-field="x_gambar" name="fkomentargrid$x<?php echo $komentar_grid->RowIndex ?>_gambar" id="fkomentargrid$x<?php echo $komentar_grid->RowIndex ?>_gambar" value="<?php echo HtmlEncode($komentar_grid->gambar->FormValue) ?>">
<input type="hidden" data-table="komentar" data-field="x_gambar" name="fkomentargrid$o<?php echo $komentar_grid->RowIndex ?>_gambar" id="fkomentargrid$o<?php echo $komentar_grid->RowIndex ?>_gambar" value="<?php echo HtmlEncode($komentar_grid->gambar->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($komentar_grid->video->Visible) { // video ?>
		<td data-name="video" <?php echo $komentar_grid->video->cellAttributes() ?>>
<?php if ($komentar->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $komentar_grid->RowCount ?>_komentar_video" class="form-group">
<input type="text" data-table="komentar" data-field="x_video" name="x<?php echo $komentar_grid->RowIndex ?>_video" id="x<?php echo $komentar_grid->RowIndex ?>_video" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($komentar_grid->video->getPlaceHolder()) ?>" value="<?php echo $komentar_grid->video->EditValue ?>"<?php echo $komentar_grid->video->editAttributes() ?>>
</span>
<input type="hidden" data-table="komentar" data-field="x_video" name="o<?php echo $komentar_grid->RowIndex ?>_video" id="o<?php echo $komentar_grid->RowIndex ?>_video" value="<?php echo HtmlEncode($komentar_grid->video->OldValue) ?>">
<?php } ?>
<?php if ($komentar->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $komentar_grid->RowCount ?>_komentar_video" class="form-group">
<input type="text" data-table="komentar" data-field="x_video" name="x<?php echo $komentar_grid->RowIndex ?>_video" id="x<?php echo $komentar_grid->RowIndex ?>_video" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($komentar_grid->video->getPlaceHolder()) ?>" value="<?php echo $komentar_grid->video->EditValue ?>"<?php echo $komentar_grid->video->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($komentar->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $komentar_grid->RowCount ?>_komentar_video">
<span<?php echo $komentar_grid->video->viewAttributes() ?>><?php echo $komentar_grid->video->getViewValue() ?></span>
</span>
<?php if (!$komentar->isConfirm()) { ?>
<input type="hidden" data-table="komentar" data-field="x_video" name="x<?php echo $komentar_grid->RowIndex ?>_video" id="x<?php echo $komentar_grid->RowIndex ?>_video" value="<?php echo HtmlEncode($komentar_grid->video->FormValue) ?>">
<input type="hidden" data-table="komentar" data-field="x_video" name="o<?php echo $komentar_grid->RowIndex ?>_video" id="o<?php echo $komentar_grid->RowIndex ?>_video" value="<?php echo HtmlEncode($komentar_grid->video->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="komentar" data-field="x_video" name="fkomentargrid$x<?php echo $komentar_grid->RowIndex ?>_video" id="fkomentargrid$x<?php echo $komentar_grid->RowIndex ?>_video" value="<?php echo HtmlEncode($komentar_grid->video->FormValue) ?>">
<input type="hidden" data-table="komentar" data-field="x_video" name="fkomentargrid$o<?php echo $komentar_grid->RowIndex ?>_video" id="fkomentargrid$o<?php echo $komentar_grid->RowIndex ?>_video" value="<?php echo HtmlEncode($komentar_grid->video->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($komentar_grid->pegawai->Visible) { // pegawai ?>
		<td data-name="pegawai" <?php echo $komentar_grid->pegawai->cellAttributes() ?>>
<?php if ($komentar->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $komentar_grid->RowCount ?>_komentar_pegawai" class="form-group">
<input type="text" data-table="komentar" data-field="x_pegawai" name="x<?php echo $komentar_grid->RowIndex ?>_pegawai" id="x<?php echo $komentar_grid->RowIndex ?>_pegawai" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($komentar_grid->pegawai->getPlaceHolder()) ?>" value="<?php echo $komentar_grid->pegawai->EditValue ?>"<?php echo $komentar_grid->pegawai->editAttributes() ?>>
</span>
<input type="hidden" data-table="komentar" data-field="x_pegawai" name="o<?php echo $komentar_grid->RowIndex ?>_pegawai" id="o<?php echo $komentar_grid->RowIndex ?>_pegawai" value="<?php echo HtmlEncode($komentar_grid->pegawai->OldValue) ?>">
<?php } ?>
<?php if ($komentar->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $komentar_grid->RowCount ?>_komentar_pegawai" class="form-group">
<input type="text" data-table="komentar" data-field="x_pegawai" name="x<?php echo $komentar_grid->RowIndex ?>_pegawai" id="x<?php echo $komentar_grid->RowIndex ?>_pegawai" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($komentar_grid->pegawai->getPlaceHolder()) ?>" value="<?php echo $komentar_grid->pegawai->EditValue ?>"<?php echo $komentar_grid->pegawai->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($komentar->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $komentar_grid->RowCount ?>_komentar_pegawai">
<span<?php echo $komentar_grid->pegawai->viewAttributes() ?>><?php echo $komentar_grid->pegawai->getViewValue() ?></span>
</span>
<?php if (!$komentar->isConfirm()) { ?>
<input type="hidden" data-table="komentar" data-field="x_pegawai" name="x<?php echo $komentar_grid->RowIndex ?>_pegawai" id="x<?php echo $komentar_grid->RowIndex ?>_pegawai" value="<?php echo HtmlEncode($komentar_grid->pegawai->FormValue) ?>">
<input type="hidden" data-table="komentar" data-field="x_pegawai" name="o<?php echo $komentar_grid->RowIndex ?>_pegawai" id="o<?php echo $komentar_grid->RowIndex ?>_pegawai" value="<?php echo HtmlEncode($komentar_grid->pegawai->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="komentar" data-field="x_pegawai" name="fkomentargrid$x<?php echo $komentar_grid->RowIndex ?>_pegawai" id="fkomentargrid$x<?php echo $komentar_grid->RowIndex ?>_pegawai" value="<?php echo HtmlEncode($komentar_grid->pegawai->FormValue) ?>">
<input type="hidden" data-table="komentar" data-field="x_pegawai" name="fkomentargrid$o<?php echo $komentar_grid->RowIndex ?>_pegawai" id="fkomentargrid$o<?php echo $komentar_grid->RowIndex ?>_pegawai" value="<?php echo HtmlEncode($komentar_grid->pegawai->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$komentar_grid->ListOptions->render("body", "right", $komentar_grid->RowCount);
?>
	</tr>
<?php if ($komentar->RowType == ROWTYPE_ADD || $komentar->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fkomentargrid", "load"], function() {
	fkomentargrid.updateLists(<?php echo $komentar_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$komentar_grid->isGridAdd() || $komentar->CurrentMode == "copy")
		if (!$komentar_grid->Recordset->EOF)
			$komentar_grid->Recordset->moveNext();
}
?>
<?php
	if ($komentar->CurrentMode == "add" || $komentar->CurrentMode == "copy" || $komentar->CurrentMode == "edit") {
		$komentar_grid->RowIndex = '$rowindex$';
		$komentar_grid->loadRowValues();

		// Set row properties
		$komentar->resetAttributes();
		$komentar->RowAttrs->merge(["data-rowindex" => $komentar_grid->RowIndex, "id" => "r0_komentar", "data-rowtype" => ROWTYPE_ADD]);
		$komentar->RowAttrs->appendClass("ew-template");
		$komentar->RowType = ROWTYPE_ADD;

		// Render row
		$komentar_grid->renderRow();

		// Render list options
		$komentar_grid->renderListOptions();
		$komentar_grid->StartRowCount = 0;
?>
	<tr <?php echo $komentar->rowAttributes() ?>>
<?php

// Render list options (body, left)
$komentar_grid->ListOptions->render("body", "left", $komentar_grid->RowIndex);
?>
	<?php if ($komentar_grid->id->Visible) { // id ?>
		<td data-name="id">
<?php if (!$komentar->isConfirm()) { ?>
<span id="el$rowindex$_komentar_id" class="form-group komentar_id"></span>
<?php } else { ?>
<span id="el$rowindex$_komentar_id" class="form-group komentar_id">
<span<?php echo $komentar_grid->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($komentar_grid->id->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="komentar" data-field="x_id" name="x<?php echo $komentar_grid->RowIndex ?>_id" id="x<?php echo $komentar_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($komentar_grid->id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="komentar" data-field="x_id" name="o<?php echo $komentar_grid->RowIndex ?>_id" id="o<?php echo $komentar_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($komentar_grid->id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($komentar_grid->pid->Visible) { // pid ?>
		<td data-name="pid">
<?php if (!$komentar->isConfirm()) { ?>
<?php if ($komentar_grid->pid->getSessionValue() != "") { ?>
<span id="el$rowindex$_komentar_pid" class="form-group komentar_pid">
<span<?php echo $komentar_grid->pid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($komentar_grid->pid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $komentar_grid->RowIndex ?>_pid" name="x<?php echo $komentar_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($komentar_grid->pid->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_komentar_pid" class="form-group komentar_pid">
<input type="text" data-table="komentar" data-field="x_pid" name="x<?php echo $komentar_grid->RowIndex ?>_pid" id="x<?php echo $komentar_grid->RowIndex ?>_pid" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($komentar_grid->pid->getPlaceHolder()) ?>" value="<?php echo $komentar_grid->pid->EditValue ?>"<?php echo $komentar_grid->pid->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_komentar_pid" class="form-group komentar_pid">
<span<?php echo $komentar_grid->pid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($komentar_grid->pid->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="komentar" data-field="x_pid" name="x<?php echo $komentar_grid->RowIndex ?>_pid" id="x<?php echo $komentar_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($komentar_grid->pid->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="komentar" data-field="x_pid" name="o<?php echo $komentar_grid->RowIndex ?>_pid" id="o<?php echo $komentar_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($komentar_grid->pid->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($komentar_grid->gambar->Visible) { // gambar ?>
		<td data-name="gambar">
<?php if (!$komentar->isConfirm()) { ?>
<span id="el$rowindex$_komentar_gambar" class="form-group komentar_gambar">
<input type="text" data-table="komentar" data-field="x_gambar" name="x<?php echo $komentar_grid->RowIndex ?>_gambar" id="x<?php echo $komentar_grid->RowIndex ?>_gambar" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($komentar_grid->gambar->getPlaceHolder()) ?>" value="<?php echo $komentar_grid->gambar->EditValue ?>"<?php echo $komentar_grid->gambar->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_komentar_gambar" class="form-group komentar_gambar">
<span<?php echo $komentar_grid->gambar->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($komentar_grid->gambar->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="komentar" data-field="x_gambar" name="x<?php echo $komentar_grid->RowIndex ?>_gambar" id="x<?php echo $komentar_grid->RowIndex ?>_gambar" value="<?php echo HtmlEncode($komentar_grid->gambar->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="komentar" data-field="x_gambar" name="o<?php echo $komentar_grid->RowIndex ?>_gambar" id="o<?php echo $komentar_grid->RowIndex ?>_gambar" value="<?php echo HtmlEncode($komentar_grid->gambar->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($komentar_grid->video->Visible) { // video ?>
		<td data-name="video">
<?php if (!$komentar->isConfirm()) { ?>
<span id="el$rowindex$_komentar_video" class="form-group komentar_video">
<input type="text" data-table="komentar" data-field="x_video" name="x<?php echo $komentar_grid->RowIndex ?>_video" id="x<?php echo $komentar_grid->RowIndex ?>_video" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($komentar_grid->video->getPlaceHolder()) ?>" value="<?php echo $komentar_grid->video->EditValue ?>"<?php echo $komentar_grid->video->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_komentar_video" class="form-group komentar_video">
<span<?php echo $komentar_grid->video->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($komentar_grid->video->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="komentar" data-field="x_video" name="x<?php echo $komentar_grid->RowIndex ?>_video" id="x<?php echo $komentar_grid->RowIndex ?>_video" value="<?php echo HtmlEncode($komentar_grid->video->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="komentar" data-field="x_video" name="o<?php echo $komentar_grid->RowIndex ?>_video" id="o<?php echo $komentar_grid->RowIndex ?>_video" value="<?php echo HtmlEncode($komentar_grid->video->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($komentar_grid->pegawai->Visible) { // pegawai ?>
		<td data-name="pegawai">
<?php if (!$komentar->isConfirm()) { ?>
<span id="el$rowindex$_komentar_pegawai" class="form-group komentar_pegawai">
<input type="text" data-table="komentar" data-field="x_pegawai" name="x<?php echo $komentar_grid->RowIndex ?>_pegawai" id="x<?php echo $komentar_grid->RowIndex ?>_pegawai" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($komentar_grid->pegawai->getPlaceHolder()) ?>" value="<?php echo $komentar_grid->pegawai->EditValue ?>"<?php echo $komentar_grid->pegawai->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_komentar_pegawai" class="form-group komentar_pegawai">
<span<?php echo $komentar_grid->pegawai->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($komentar_grid->pegawai->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="komentar" data-field="x_pegawai" name="x<?php echo $komentar_grid->RowIndex ?>_pegawai" id="x<?php echo $komentar_grid->RowIndex ?>_pegawai" value="<?php echo HtmlEncode($komentar_grid->pegawai->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="komentar" data-field="x_pegawai" name="o<?php echo $komentar_grid->RowIndex ?>_pegawai" id="o<?php echo $komentar_grid->RowIndex ?>_pegawai" value="<?php echo HtmlEncode($komentar_grid->pegawai->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$komentar_grid->ListOptions->render("body", "right", $komentar_grid->RowIndex);
?>
<script>
loadjs.ready(["fkomentargrid", "load"], function() {
	fkomentargrid.updateLists(<?php echo $komentar_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($komentar->CurrentMode == "add" || $komentar->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $komentar_grid->FormKeyCountName ?>" id="<?php echo $komentar_grid->FormKeyCountName ?>" value="<?php echo $komentar_grid->KeyCount ?>">
<?php echo $komentar_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($komentar->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $komentar_grid->FormKeyCountName ?>" id="<?php echo $komentar_grid->FormKeyCountName ?>" value="<?php echo $komentar_grid->KeyCount ?>">
<?php echo $komentar_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($komentar->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fkomentargrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($komentar_grid->Recordset)
	$komentar_grid->Recordset->Close();
?>
<?php if ($komentar_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $komentar_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($komentar_grid->TotalRecords == 0 && !$komentar->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $komentar_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$komentar_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$komentar_grid->terminate();
?>