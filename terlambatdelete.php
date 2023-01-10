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
$terlambat_delete = new terlambat_delete();

// Run the page
$terlambat_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$terlambat_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fterlambatdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fterlambatdelete = currentForm = new ew.Form("fterlambatdelete", "delete");
	loadjs.done("fterlambatdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $terlambat_delete->showPageHeader(); ?>
<?php
$terlambat_delete->showMessage();
?>
<form name="fterlambatdelete" id="fterlambatdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="terlambat">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($terlambat_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($terlambat_delete->jenjang_id->Visible) { // jenjang_id ?>
		<th class="<?php echo $terlambat_delete->jenjang_id->headerCellClass() ?>"><span id="elh_terlambat_jenjang_id" class="terlambat_jenjang_id"><?php echo $terlambat_delete->jenjang_id->caption() ?></span></th>
<?php } ?>
<?php if ($terlambat_delete->jabatan_id->Visible) { // jabatan_id ?>
		<th class="<?php echo $terlambat_delete->jabatan_id->headerCellClass() ?>"><span id="elh_terlambat_jabatan_id" class="terlambat_jabatan_id"><?php echo $terlambat_delete->jabatan_id->caption() ?></span></th>
<?php } ?>
<?php if ($terlambat_delete->value->Visible) { // value ?>
		<th class="<?php echo $terlambat_delete->value->headerCellClass() ?>"><span id="elh_terlambat_value" class="terlambat_value"><?php echo $terlambat_delete->value->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$terlambat_delete->RecordCount = 0;
$i = 0;
while (!$terlambat_delete->Recordset->EOF) {
	$terlambat_delete->RecordCount++;
	$terlambat_delete->RowCount++;

	// Set row properties
	$terlambat->resetAttributes();
	$terlambat->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$terlambat_delete->loadRowValues($terlambat_delete->Recordset);

	// Render row
	$terlambat_delete->renderRow();
?>
	<tr <?php echo $terlambat->rowAttributes() ?>>
<?php if ($terlambat_delete->jenjang_id->Visible) { // jenjang_id ?>
		<td <?php echo $terlambat_delete->jenjang_id->cellAttributes() ?>>
<span id="el<?php echo $terlambat_delete->RowCount ?>_terlambat_jenjang_id" class="terlambat_jenjang_id">
<span<?php echo $terlambat_delete->jenjang_id->viewAttributes() ?>><?php echo $terlambat_delete->jenjang_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($terlambat_delete->jabatan_id->Visible) { // jabatan_id ?>
		<td <?php echo $terlambat_delete->jabatan_id->cellAttributes() ?>>
<span id="el<?php echo $terlambat_delete->RowCount ?>_terlambat_jabatan_id" class="terlambat_jabatan_id">
<span<?php echo $terlambat_delete->jabatan_id->viewAttributes() ?>><?php echo $terlambat_delete->jabatan_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($terlambat_delete->value->Visible) { // value ?>
		<td <?php echo $terlambat_delete->value->cellAttributes() ?>>
<span id="el<?php echo $terlambat_delete->RowCount ?>_terlambat_value" class="terlambat_value">
<span<?php echo $terlambat_delete->value->viewAttributes() ?>><?php echo $terlambat_delete->value->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$terlambat_delete->Recordset->moveNext();
}
$terlambat_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $terlambat_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$terlambat_delete->showPageFooter();
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
$terlambat_delete->terminate();
?>