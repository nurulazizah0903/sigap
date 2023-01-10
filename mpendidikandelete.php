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
$mpendidikan_delete = new mpendidikan_delete();

// Run the page
$mpendidikan_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$mpendidikan_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fmpendidikandelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fmpendidikandelete = currentForm = new ew.Form("fmpendidikandelete", "delete");
	loadjs.done("fmpendidikandelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $mpendidikan_delete->showPageHeader(); ?>
<?php
$mpendidikan_delete->showMessage();
?>
<form name="fmpendidikandelete" id="fmpendidikandelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="mpendidikan">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($mpendidikan_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($mpendidikan_delete->name->Visible) { // name ?>
		<th class="<?php echo $mpendidikan_delete->name->headerCellClass() ?>"><span id="elh_mpendidikan_name" class="mpendidikan_name"><?php echo $mpendidikan_delete->name->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$mpendidikan_delete->RecordCount = 0;
$i = 0;
while (!$mpendidikan_delete->Recordset->EOF) {
	$mpendidikan_delete->RecordCount++;
	$mpendidikan_delete->RowCount++;

	// Set row properties
	$mpendidikan->resetAttributes();
	$mpendidikan->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$mpendidikan_delete->loadRowValues($mpendidikan_delete->Recordset);

	// Render row
	$mpendidikan_delete->renderRow();
?>
	<tr <?php echo $mpendidikan->rowAttributes() ?>>
<?php if ($mpendidikan_delete->name->Visible) { // name ?>
		<td <?php echo $mpendidikan_delete->name->cellAttributes() ?>>
<span id="el<?php echo $mpendidikan_delete->RowCount ?>_mpendidikan_name" class="mpendidikan_name">
<span<?php echo $mpendidikan_delete->name->viewAttributes() ?>><?php echo $mpendidikan_delete->name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$mpendidikan_delete->Recordset->moveNext();
}
$mpendidikan_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $mpendidikan_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$mpendidikan_delete->showPageFooter();
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
$mpendidikan_delete->terminate();
?>