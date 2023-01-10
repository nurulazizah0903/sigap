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
$agama_delete = new agama_delete();

// Run the page
$agama_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$agama_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fagamadelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fagamadelete = currentForm = new ew.Form("fagamadelete", "delete");
	loadjs.done("fagamadelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $agama_delete->showPageHeader(); ?>
<?php
$agama_delete->showMessage();
?>
<form name="fagamadelete" id="fagamadelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="agama">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($agama_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($agama_delete->id->Visible) { // id ?>
		<th class="<?php echo $agama_delete->id->headerCellClass() ?>"><span id="elh_agama_id" class="agama_id"><?php echo $agama_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($agama_delete->name->Visible) { // name ?>
		<th class="<?php echo $agama_delete->name->headerCellClass() ?>"><span id="elh_agama_name" class="agama_name"><?php echo $agama_delete->name->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$agama_delete->RecordCount = 0;
$i = 0;
while (!$agama_delete->Recordset->EOF) {
	$agama_delete->RecordCount++;
	$agama_delete->RowCount++;

	// Set row properties
	$agama->resetAttributes();
	$agama->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$agama_delete->loadRowValues($agama_delete->Recordset);

	// Render row
	$agama_delete->renderRow();
?>
	<tr <?php echo $agama->rowAttributes() ?>>
<?php if ($agama_delete->id->Visible) { // id ?>
		<td <?php echo $agama_delete->id->cellAttributes() ?>>
<span id="el<?php echo $agama_delete->RowCount ?>_agama_id" class="agama_id">
<span<?php echo $agama_delete->id->viewAttributes() ?>><?php echo $agama_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($agama_delete->name->Visible) { // name ?>
		<td <?php echo $agama_delete->name->cellAttributes() ?>>
<span id="el<?php echo $agama_delete->RowCount ?>_agama_name" class="agama_name">
<span<?php echo $agama_delete->name->viewAttributes() ?>><?php echo $agama_delete->name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$agama_delete->Recordset->moveNext();
}
$agama_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $agama_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$agama_delete->showPageFooter();
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
$agama_delete->terminate();
?>