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
$peg_keluarga_delete = new peg_keluarga_delete();

// Run the page
$peg_keluarga_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$peg_keluarga_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpeg_keluargadelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fpeg_keluargadelete = currentForm = new ew.Form("fpeg_keluargadelete", "delete");
	loadjs.done("fpeg_keluargadelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $peg_keluarga_delete->showPageHeader(); ?>
<?php
$peg_keluarga_delete->showMessage();
?>
<form name="fpeg_keluargadelete" id="fpeg_keluargadelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="peg_keluarga">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($peg_keluarga_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($peg_keluarga_delete->id->Visible) { // id ?>
		<th class="<?php echo $peg_keluarga_delete->id->headerCellClass() ?>"><span id="elh_peg_keluarga_id" class="peg_keluarga_id"><?php echo $peg_keluarga_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($peg_keluarga_delete->pid->Visible) { // pid ?>
		<th class="<?php echo $peg_keluarga_delete->pid->headerCellClass() ?>"><span id="elh_peg_keluarga_pid" class="peg_keluarga_pid"><?php echo $peg_keluarga_delete->pid->caption() ?></span></th>
<?php } ?>
<?php if ($peg_keluarga_delete->nama->Visible) { // nama ?>
		<th class="<?php echo $peg_keluarga_delete->nama->headerCellClass() ?>"><span id="elh_peg_keluarga_nama" class="peg_keluarga_nama"><?php echo $peg_keluarga_delete->nama->caption() ?></span></th>
<?php } ?>
<?php if ($peg_keluarga_delete->hp->Visible) { // hp ?>
		<th class="<?php echo $peg_keluarga_delete->hp->headerCellClass() ?>"><span id="elh_peg_keluarga_hp" class="peg_keluarga_hp"><?php echo $peg_keluarga_delete->hp->caption() ?></span></th>
<?php } ?>
<?php if ($peg_keluarga_delete->hubungan->Visible) { // hubungan ?>
		<th class="<?php echo $peg_keluarga_delete->hubungan->headerCellClass() ?>"><span id="elh_peg_keluarga_hubungan" class="peg_keluarga_hubungan"><?php echo $peg_keluarga_delete->hubungan->caption() ?></span></th>
<?php } ?>
<?php if ($peg_keluarga_delete->tgl_lahir->Visible) { // tgl_lahir ?>
		<th class="<?php echo $peg_keluarga_delete->tgl_lahir->headerCellClass() ?>"><span id="elh_peg_keluarga_tgl_lahir" class="peg_keluarga_tgl_lahir"><?php echo $peg_keluarga_delete->tgl_lahir->caption() ?></span></th>
<?php } ?>
<?php if ($peg_keluarga_delete->jen_kel->Visible) { // jen_kel ?>
		<th class="<?php echo $peg_keluarga_delete->jen_kel->headerCellClass() ?>"><span id="elh_peg_keluarga_jen_kel" class="peg_keluarga_jen_kel"><?php echo $peg_keluarga_delete->jen_kel->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$peg_keluarga_delete->RecordCount = 0;
$i = 0;
while (!$peg_keluarga_delete->Recordset->EOF) {
	$peg_keluarga_delete->RecordCount++;
	$peg_keluarga_delete->RowCount++;

	// Set row properties
	$peg_keluarga->resetAttributes();
	$peg_keluarga->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$peg_keluarga_delete->loadRowValues($peg_keluarga_delete->Recordset);

	// Render row
	$peg_keluarga_delete->renderRow();
?>
	<tr <?php echo $peg_keluarga->rowAttributes() ?>>
<?php if ($peg_keluarga_delete->id->Visible) { // id ?>
		<td <?php echo $peg_keluarga_delete->id->cellAttributes() ?>>
<span id="el<?php echo $peg_keluarga_delete->RowCount ?>_peg_keluarga_id" class="peg_keluarga_id">
<span<?php echo $peg_keluarga_delete->id->viewAttributes() ?>><?php echo $peg_keluarga_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($peg_keluarga_delete->pid->Visible) { // pid ?>
		<td <?php echo $peg_keluarga_delete->pid->cellAttributes() ?>>
<span id="el<?php echo $peg_keluarga_delete->RowCount ?>_peg_keluarga_pid" class="peg_keluarga_pid">
<span<?php echo $peg_keluarga_delete->pid->viewAttributes() ?>><?php echo $peg_keluarga_delete->pid->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($peg_keluarga_delete->nama->Visible) { // nama ?>
		<td <?php echo $peg_keluarga_delete->nama->cellAttributes() ?>>
<span id="el<?php echo $peg_keluarga_delete->RowCount ?>_peg_keluarga_nama" class="peg_keluarga_nama">
<span<?php echo $peg_keluarga_delete->nama->viewAttributes() ?>><?php echo $peg_keluarga_delete->nama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($peg_keluarga_delete->hp->Visible) { // hp ?>
		<td <?php echo $peg_keluarga_delete->hp->cellAttributes() ?>>
<span id="el<?php echo $peg_keluarga_delete->RowCount ?>_peg_keluarga_hp" class="peg_keluarga_hp">
<span<?php echo $peg_keluarga_delete->hp->viewAttributes() ?>><?php echo $peg_keluarga_delete->hp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($peg_keluarga_delete->hubungan->Visible) { // hubungan ?>
		<td <?php echo $peg_keluarga_delete->hubungan->cellAttributes() ?>>
<span id="el<?php echo $peg_keluarga_delete->RowCount ?>_peg_keluarga_hubungan" class="peg_keluarga_hubungan">
<span<?php echo $peg_keluarga_delete->hubungan->viewAttributes() ?>><?php echo $peg_keluarga_delete->hubungan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($peg_keluarga_delete->tgl_lahir->Visible) { // tgl_lahir ?>
		<td <?php echo $peg_keluarga_delete->tgl_lahir->cellAttributes() ?>>
<span id="el<?php echo $peg_keluarga_delete->RowCount ?>_peg_keluarga_tgl_lahir" class="peg_keluarga_tgl_lahir">
<span<?php echo $peg_keluarga_delete->tgl_lahir->viewAttributes() ?>><?php echo $peg_keluarga_delete->tgl_lahir->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($peg_keluarga_delete->jen_kel->Visible) { // jen_kel ?>
		<td <?php echo $peg_keluarga_delete->jen_kel->cellAttributes() ?>>
<span id="el<?php echo $peg_keluarga_delete->RowCount ?>_peg_keluarga_jen_kel" class="peg_keluarga_jen_kel">
<span<?php echo $peg_keluarga_delete->jen_kel->viewAttributes() ?>><?php echo $peg_keluarga_delete->jen_kel->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$peg_keluarga_delete->Recordset->moveNext();
}
$peg_keluarga_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $peg_keluarga_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$peg_keluarga_delete->showPageFooter();
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
$peg_keluarga_delete->terminate();
?>