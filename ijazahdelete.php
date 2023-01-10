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
$ijazah_delete = new ijazah_delete();

// Run the page
$ijazah_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ijazah_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fijazahdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fijazahdelete = currentForm = new ew.Form("fijazahdelete", "delete");
	loadjs.done("fijazahdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ijazah_delete->showPageHeader(); ?>
<?php
$ijazah_delete->showMessage();
?>
<form name="fijazahdelete" id="fijazahdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ijazah">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($ijazah_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($ijazah_delete->name->Visible) { // name ?>
		<th class="<?php echo $ijazah_delete->name->headerCellClass() ?>"><span id="elh_ijazah_name" class="ijazah_name"><?php echo $ijazah_delete->name->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$ijazah_delete->RecordCount = 0;
$i = 0;
while (!$ijazah_delete->Recordset->EOF) {
	$ijazah_delete->RecordCount++;
	$ijazah_delete->RowCount++;

	// Set row properties
	$ijazah->resetAttributes();
	$ijazah->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$ijazah_delete->loadRowValues($ijazah_delete->Recordset);

	// Render row
	$ijazah_delete->renderRow();
?>
	<tr <?php echo $ijazah->rowAttributes() ?>>
<?php if ($ijazah_delete->name->Visible) { // name ?>
		<td <?php echo $ijazah_delete->name->cellAttributes() ?>>
<span id="el<?php echo $ijazah_delete->RowCount ?>_ijazah_name" class="ijazah_name">
<span<?php echo $ijazah_delete->name->viewAttributes() ?>><?php echo $ijazah_delete->name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$ijazah_delete->Recordset->moveNext();
}
$ijazah_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ijazah_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$ijazah_delete->showPageFooter();
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
$ijazah_delete->terminate();
?>