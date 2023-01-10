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
$peg_skill_delete = new peg_skill_delete();

// Run the page
$peg_skill_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$peg_skill_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpeg_skilldelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fpeg_skilldelete = currentForm = new ew.Form("fpeg_skilldelete", "delete");
	loadjs.done("fpeg_skilldelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $peg_skill_delete->showPageHeader(); ?>
<?php
$peg_skill_delete->showMessage();
?>
<form name="fpeg_skilldelete" id="fpeg_skilldelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="peg_skill">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($peg_skill_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($peg_skill_delete->id->Visible) { // id ?>
		<th class="<?php echo $peg_skill_delete->id->headerCellClass() ?>"><span id="elh_peg_skill_id" class="peg_skill_id"><?php echo $peg_skill_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($peg_skill_delete->pid->Visible) { // pid ?>
		<th class="<?php echo $peg_skill_delete->pid->headerCellClass() ?>"><span id="elh_peg_skill_pid" class="peg_skill_pid"><?php echo $peg_skill_delete->pid->caption() ?></span></th>
<?php } ?>
<?php if ($peg_skill_delete->keahlian->Visible) { // keahlian ?>
		<th class="<?php echo $peg_skill_delete->keahlian->headerCellClass() ?>"><span id="elh_peg_skill_keahlian" class="peg_skill_keahlian"><?php echo $peg_skill_delete->keahlian->caption() ?></span></th>
<?php } ?>
<?php if ($peg_skill_delete->tingkat->Visible) { // tingkat ?>
		<th class="<?php echo $peg_skill_delete->tingkat->headerCellClass() ?>"><span id="elh_peg_skill_tingkat" class="peg_skill_tingkat"><?php echo $peg_skill_delete->tingkat->caption() ?></span></th>
<?php } ?>
<?php if ($peg_skill_delete->bukti->Visible) { // bukti ?>
		<th class="<?php echo $peg_skill_delete->bukti->headerCellClass() ?>"><span id="elh_peg_skill_bukti" class="peg_skill_bukti"><?php echo $peg_skill_delete->bukti->caption() ?></span></th>
<?php } ?>
<?php if ($peg_skill_delete->keterangan->Visible) { // keterangan ?>
		<th class="<?php echo $peg_skill_delete->keterangan->headerCellClass() ?>"><span id="elh_peg_skill_keterangan" class="peg_skill_keterangan"><?php echo $peg_skill_delete->keterangan->caption() ?></span></th>
<?php } ?>
<?php if ($peg_skill_delete->c_date->Visible) { // c_date ?>
		<th class="<?php echo $peg_skill_delete->c_date->headerCellClass() ?>"><span id="elh_peg_skill_c_date" class="peg_skill_c_date"><?php echo $peg_skill_delete->c_date->caption() ?></span></th>
<?php } ?>
<?php if ($peg_skill_delete->u_date->Visible) { // u_date ?>
		<th class="<?php echo $peg_skill_delete->u_date->headerCellClass() ?>"><span id="elh_peg_skill_u_date" class="peg_skill_u_date"><?php echo $peg_skill_delete->u_date->caption() ?></span></th>
<?php } ?>
<?php if ($peg_skill_delete->c_by->Visible) { // c_by ?>
		<th class="<?php echo $peg_skill_delete->c_by->headerCellClass() ?>"><span id="elh_peg_skill_c_by" class="peg_skill_c_by"><?php echo $peg_skill_delete->c_by->caption() ?></span></th>
<?php } ?>
<?php if ($peg_skill_delete->u_by->Visible) { // u_by ?>
		<th class="<?php echo $peg_skill_delete->u_by->headerCellClass() ?>"><span id="elh_peg_skill_u_by" class="peg_skill_u_by"><?php echo $peg_skill_delete->u_by->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$peg_skill_delete->RecordCount = 0;
$i = 0;
while (!$peg_skill_delete->Recordset->EOF) {
	$peg_skill_delete->RecordCount++;
	$peg_skill_delete->RowCount++;

	// Set row properties
	$peg_skill->resetAttributes();
	$peg_skill->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$peg_skill_delete->loadRowValues($peg_skill_delete->Recordset);

	// Render row
	$peg_skill_delete->renderRow();
?>
	<tr <?php echo $peg_skill->rowAttributes() ?>>
<?php if ($peg_skill_delete->id->Visible) { // id ?>
		<td <?php echo $peg_skill_delete->id->cellAttributes() ?>>
<span id="el<?php echo $peg_skill_delete->RowCount ?>_peg_skill_id" class="peg_skill_id">
<span<?php echo $peg_skill_delete->id->viewAttributes() ?>><?php echo $peg_skill_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($peg_skill_delete->pid->Visible) { // pid ?>
		<td <?php echo $peg_skill_delete->pid->cellAttributes() ?>>
<span id="el<?php echo $peg_skill_delete->RowCount ?>_peg_skill_pid" class="peg_skill_pid">
<span<?php echo $peg_skill_delete->pid->viewAttributes() ?>><?php echo $peg_skill_delete->pid->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($peg_skill_delete->keahlian->Visible) { // keahlian ?>
		<td <?php echo $peg_skill_delete->keahlian->cellAttributes() ?>>
<span id="el<?php echo $peg_skill_delete->RowCount ?>_peg_skill_keahlian" class="peg_skill_keahlian">
<span<?php echo $peg_skill_delete->keahlian->viewAttributes() ?>><?php echo $peg_skill_delete->keahlian->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($peg_skill_delete->tingkat->Visible) { // tingkat ?>
		<td <?php echo $peg_skill_delete->tingkat->cellAttributes() ?>>
<span id="el<?php echo $peg_skill_delete->RowCount ?>_peg_skill_tingkat" class="peg_skill_tingkat">
<span<?php echo $peg_skill_delete->tingkat->viewAttributes() ?>><?php echo $peg_skill_delete->tingkat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($peg_skill_delete->bukti->Visible) { // bukti ?>
		<td <?php echo $peg_skill_delete->bukti->cellAttributes() ?>>
<span id="el<?php echo $peg_skill_delete->RowCount ?>_peg_skill_bukti" class="peg_skill_bukti">
<span<?php echo $peg_skill_delete->bukti->viewAttributes() ?>><?php echo $peg_skill_delete->bukti->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($peg_skill_delete->keterangan->Visible) { // keterangan ?>
		<td <?php echo $peg_skill_delete->keterangan->cellAttributes() ?>>
<span id="el<?php echo $peg_skill_delete->RowCount ?>_peg_skill_keterangan" class="peg_skill_keterangan">
<span<?php echo $peg_skill_delete->keterangan->viewAttributes() ?>><?php echo $peg_skill_delete->keterangan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($peg_skill_delete->c_date->Visible) { // c_date ?>
		<td <?php echo $peg_skill_delete->c_date->cellAttributes() ?>>
<span id="el<?php echo $peg_skill_delete->RowCount ?>_peg_skill_c_date" class="peg_skill_c_date">
<span<?php echo $peg_skill_delete->c_date->viewAttributes() ?>><?php echo $peg_skill_delete->c_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($peg_skill_delete->u_date->Visible) { // u_date ?>
		<td <?php echo $peg_skill_delete->u_date->cellAttributes() ?>>
<span id="el<?php echo $peg_skill_delete->RowCount ?>_peg_skill_u_date" class="peg_skill_u_date">
<span<?php echo $peg_skill_delete->u_date->viewAttributes() ?>><?php echo $peg_skill_delete->u_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($peg_skill_delete->c_by->Visible) { // c_by ?>
		<td <?php echo $peg_skill_delete->c_by->cellAttributes() ?>>
<span id="el<?php echo $peg_skill_delete->RowCount ?>_peg_skill_c_by" class="peg_skill_c_by">
<span<?php echo $peg_skill_delete->c_by->viewAttributes() ?>><?php echo $peg_skill_delete->c_by->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($peg_skill_delete->u_by->Visible) { // u_by ?>
		<td <?php echo $peg_skill_delete->u_by->cellAttributes() ?>>
<span id="el<?php echo $peg_skill_delete->RowCount ?>_peg_skill_u_by" class="peg_skill_u_by">
<span<?php echo $peg_skill_delete->u_by->viewAttributes() ?>><?php echo $peg_skill_delete->u_by->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$peg_skill_delete->Recordset->moveNext();
}
$peg_skill_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $peg_skill_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$peg_skill_delete->showPageFooter();
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
$peg_skill_delete->terminate();
?>