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
$setuju_delete = new setuju_delete();

// Run the page
$setuju_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$setuju_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fsetujudelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fsetujudelete = currentForm = new ew.Form("fsetujudelete", "delete");
	loadjs.done("fsetujudelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $setuju_delete->showPageHeader(); ?>
<?php
$setuju_delete->showMessage();
?>
<form name="fsetujudelete" id="fsetujudelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="setuju">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($setuju_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($setuju_delete->name->Visible) { // name ?>
		<th class="<?php echo $setuju_delete->name->headerCellClass() ?>"><span id="elh_setuju_name" class="setuju_name"><?php echo $setuju_delete->name->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$setuju_delete->RecordCount = 0;
$i = 0;
while (!$setuju_delete->Recordset->EOF) {
	$setuju_delete->RecordCount++;
	$setuju_delete->RowCount++;

	// Set row properties
	$setuju->resetAttributes();
	$setuju->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$setuju_delete->loadRowValues($setuju_delete->Recordset);

	// Render row
	$setuju_delete->renderRow();
?>
	<tr <?php echo $setuju->rowAttributes() ?>>
<?php if ($setuju_delete->name->Visible) { // name ?>
		<td <?php echo $setuju_delete->name->cellAttributes() ?>>
<span id="el<?php echo $setuju_delete->RowCount ?>_setuju_name" class="setuju_name">
<span<?php echo $setuju_delete->name->viewAttributes() ?>><?php echo $setuju_delete->name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$setuju_delete->Recordset->moveNext();
}
$setuju_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $setuju_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$setuju_delete->showPageFooter();
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
$setuju_delete->terminate();
?>