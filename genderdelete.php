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
$gender_delete = new gender_delete();

// Run the page
$gender_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gender_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fgenderdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fgenderdelete = currentForm = new ew.Form("fgenderdelete", "delete");
	loadjs.done("fgenderdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $gender_delete->showPageHeader(); ?>
<?php
$gender_delete->showMessage();
?>
<form name="fgenderdelete" id="fgenderdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gender">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($gender_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($gender_delete->id->Visible) { // id ?>
		<th class="<?php echo $gender_delete->id->headerCellClass() ?>"><span id="elh_gender_id" class="gender_id"><?php echo $gender_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($gender_delete->gen->Visible) { // gen ?>
		<th class="<?php echo $gender_delete->gen->headerCellClass() ?>"><span id="elh_gender_gen" class="gender_gen"><?php echo $gender_delete->gen->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$gender_delete->RecordCount = 0;
$i = 0;
while (!$gender_delete->Recordset->EOF) {
	$gender_delete->RecordCount++;
	$gender_delete->RowCount++;

	// Set row properties
	$gender->resetAttributes();
	$gender->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$gender_delete->loadRowValues($gender_delete->Recordset);

	// Render row
	$gender_delete->renderRow();
?>
	<tr <?php echo $gender->rowAttributes() ?>>
<?php if ($gender_delete->id->Visible) { // id ?>
		<td <?php echo $gender_delete->id->cellAttributes() ?>>
<span id="el<?php echo $gender_delete->RowCount ?>_gender_id" class="gender_id">
<span<?php echo $gender_delete->id->viewAttributes() ?>><?php echo $gender_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gender_delete->gen->Visible) { // gen ?>
		<td <?php echo $gender_delete->gen->cellAttributes() ?>>
<span id="el<?php echo $gender_delete->RowCount ?>_gender_gen" class="gender_gen">
<span<?php echo $gender_delete->gen->viewAttributes() ?>><?php echo $gender_delete->gen->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$gender_delete->Recordset->moveNext();
}
$gender_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $gender_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$gender_delete->showPageFooter();
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
$gender_delete->terminate();
?>