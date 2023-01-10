<?php
namespace PHPMaker2020\sigap;

// Autoload
include_once "autoload.php";

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	\Delight\Cookie\Session::start(Config("COOKIE_SAMESITE")); // Init session data

// Output buffering
ob_start();
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$peg_dokumen_delete = new peg_dokumen_delete();

// Run the page
$peg_dokumen_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$peg_dokumen_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpeg_dokumendelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fpeg_dokumendelete = currentForm = new ew.Form("fpeg_dokumendelete", "delete");
	loadjs.done("fpeg_dokumendelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $peg_dokumen_delete->showPageHeader(); ?>
<?php
$peg_dokumen_delete->showMessage();
?>
<form name="fpeg_dokumendelete" id="fpeg_dokumendelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="peg_dokumen">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($peg_dokumen_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($peg_dokumen_delete->id->Visible) { // id ?>
		<th class="<?php echo $peg_dokumen_delete->id->headerCellClass() ?>"><span id="elh_peg_dokumen_id" class="peg_dokumen_id"><?php echo $peg_dokumen_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($peg_dokumen_delete->pid->Visible) { // pid ?>
		<th class="<?php echo $peg_dokumen_delete->pid->headerCellClass() ?>"><span id="elh_peg_dokumen_pid" class="peg_dokumen_pid"><?php echo $peg_dokumen_delete->pid->caption() ?></span></th>
<?php } ?>
<?php if ($peg_dokumen_delete->nama_dokumen->Visible) { // nama_dokumen ?>
		<th class="<?php echo $peg_dokumen_delete->nama_dokumen->headerCellClass() ?>"><span id="elh_peg_dokumen_nama_dokumen" class="peg_dokumen_nama_dokumen"><?php echo $peg_dokumen_delete->nama_dokumen->caption() ?></span></th>
<?php } ?>
<?php if ($peg_dokumen_delete->file_dokumen->Visible) { // file_dokumen ?>
		<th class="<?php echo $peg_dokumen_delete->file_dokumen->headerCellClass() ?>"><span id="elh_peg_dokumen_file_dokumen" class="peg_dokumen_file_dokumen"><?php echo $peg_dokumen_delete->file_dokumen->caption() ?></span></th>
<?php } ?>
<?php if ($peg_dokumen_delete->keterangan->Visible) { // keterangan ?>
		<th class="<?php echo $peg_dokumen_delete->keterangan->headerCellClass() ?>"><span id="elh_peg_dokumen_keterangan" class="peg_dokumen_keterangan"><?php echo $peg_dokumen_delete->keterangan->caption() ?></span></th>
<?php } ?>
<?php if ($peg_dokumen_delete->c_date->Visible) { // c_date ?>
		<th class="<?php echo $peg_dokumen_delete->c_date->headerCellClass() ?>"><span id="elh_peg_dokumen_c_date" class="peg_dokumen_c_date"><?php echo $peg_dokumen_delete->c_date->caption() ?></span></th>
<?php } ?>
<?php if ($peg_dokumen_delete->u_date->Visible) { // u_date ?>
		<th class="<?php echo $peg_dokumen_delete->u_date->headerCellClass() ?>"><span id="elh_peg_dokumen_u_date" class="peg_dokumen_u_date"><?php echo $peg_dokumen_delete->u_date->caption() ?></span></th>
<?php } ?>
<?php if ($peg_dokumen_delete->c_by->Visible) { // c_by ?>
		<th class="<?php echo $peg_dokumen_delete->c_by->headerCellClass() ?>"><span id="elh_peg_dokumen_c_by" class="peg_dokumen_c_by"><?php echo $peg_dokumen_delete->c_by->caption() ?></span></th>
<?php } ?>
<?php if ($peg_dokumen_delete->u_by->Visible) { // u_by ?>
		<th class="<?php echo $peg_dokumen_delete->u_by->headerCellClass() ?>"><span id="elh_peg_dokumen_u_by" class="peg_dokumen_u_by"><?php echo $peg_dokumen_delete->u_by->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$peg_dokumen_delete->RecordCount = 0;
$i = 0;
while (!$peg_dokumen_delete->Recordset->EOF) {
	$peg_dokumen_delete->RecordCount++;
	$peg_dokumen_delete->RowCount++;

	// Set row properties
	$peg_dokumen->resetAttributes();
	$peg_dokumen->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$peg_dokumen_delete->loadRowValues($peg_dokumen_delete->Recordset);

	// Render row
	$peg_dokumen_delete->renderRow();
?>
	<tr <?php echo $peg_dokumen->rowAttributes() ?>>
<?php if ($peg_dokumen_delete->id->Visible) { // id ?>
		<td <?php echo $peg_dokumen_delete->id->cellAttributes() ?>>
<span id="el<?php echo $peg_dokumen_delete->RowCount ?>_peg_dokumen_id" class="peg_dokumen_id">
<span<?php echo $peg_dokumen_delete->id->viewAttributes() ?>><?php echo $peg_dokumen_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($peg_dokumen_delete->pid->Visible) { // pid ?>
		<td <?php echo $peg_dokumen_delete->pid->cellAttributes() ?>>
<span id="el<?php echo $peg_dokumen_delete->RowCount ?>_peg_dokumen_pid" class="peg_dokumen_pid">
<span<?php echo $peg_dokumen_delete->pid->viewAttributes() ?>><?php echo $peg_dokumen_delete->pid->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($peg_dokumen_delete->nama_dokumen->Visible) { // nama_dokumen ?>
		<td <?php echo $peg_dokumen_delete->nama_dokumen->cellAttributes() ?>>
<span id="el<?php echo $peg_dokumen_delete->RowCount ?>_peg_dokumen_nama_dokumen" class="peg_dokumen_nama_dokumen">
<span<?php echo $peg_dokumen_delete->nama_dokumen->viewAttributes() ?>><?php echo $peg_dokumen_delete->nama_dokumen->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($peg_dokumen_delete->file_dokumen->Visible) { // file_dokumen ?>
		<td <?php echo $peg_dokumen_delete->file_dokumen->cellAttributes() ?>>
<span id="el<?php echo $peg_dokumen_delete->RowCount ?>_peg_dokumen_file_dokumen" class="peg_dokumen_file_dokumen">
<span<?php echo $peg_dokumen_delete->file_dokumen->viewAttributes() ?>><?php echo $peg_dokumen_delete->file_dokumen->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($peg_dokumen_delete->keterangan->Visible) { // keterangan ?>
		<td <?php echo $peg_dokumen_delete->keterangan->cellAttributes() ?>>
<span id="el<?php echo $peg_dokumen_delete->RowCount ?>_peg_dokumen_keterangan" class="peg_dokumen_keterangan">
<span<?php echo $peg_dokumen_delete->keterangan->viewAttributes() ?>><?php echo $peg_dokumen_delete->keterangan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($peg_dokumen_delete->c_date->Visible) { // c_date ?>
		<td <?php echo $peg_dokumen_delete->c_date->cellAttributes() ?>>
<span id="el<?php echo $peg_dokumen_delete->RowCount ?>_peg_dokumen_c_date" class="peg_dokumen_c_date">
<span<?php echo $peg_dokumen_delete->c_date->viewAttributes() ?>><?php echo $peg_dokumen_delete->c_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($peg_dokumen_delete->u_date->Visible) { // u_date ?>
		<td <?php echo $peg_dokumen_delete->u_date->cellAttributes() ?>>
<span id="el<?php echo $peg_dokumen_delete->RowCount ?>_peg_dokumen_u_date" class="peg_dokumen_u_date">
<span<?php echo $peg_dokumen_delete->u_date->viewAttributes() ?>><?php echo $peg_dokumen_delete->u_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($peg_dokumen_delete->c_by->Visible) { // c_by ?>
		<td <?php echo $peg_dokumen_delete->c_by->cellAttributes() ?>>
<span id="el<?php echo $peg_dokumen_delete->RowCount ?>_peg_dokumen_c_by" class="peg_dokumen_c_by">
<span<?php echo $peg_dokumen_delete->c_by->viewAttributes() ?>><?php echo $peg_dokumen_delete->c_by->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($peg_dokumen_delete->u_by->Visible) { // u_by ?>
		<td <?php echo $peg_dokumen_delete->u_by->cellAttributes() ?>>
<span id="el<?php echo $peg_dokumen_delete->RowCount ?>_peg_dokumen_u_by" class="peg_dokumen_u_by">
<span<?php echo $peg_dokumen_delete->u_by->viewAttributes() ?>><?php echo $peg_dokumen_delete->u_by->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$peg_dokumen_delete->Recordset->moveNext();
}
$peg_dokumen_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $peg_dokumen_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$peg_dokumen_delete->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$peg_dokumen_delete->terminate();
?>