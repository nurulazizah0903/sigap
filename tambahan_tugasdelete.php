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
$tambahan_tugas_delete = new tambahan_tugas_delete();

// Run the page
$tambahan_tugas_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tambahan_tugas_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftambahan_tugasdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ftambahan_tugasdelete = currentForm = new ew.Form("ftambahan_tugasdelete", "delete");
	loadjs.done("ftambahan_tugasdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tambahan_tugas_delete->showPageHeader(); ?>
<?php
$tambahan_tugas_delete->showMessage();
?>
<form name="ftambahan_tugasdelete" id="ftambahan_tugasdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tambahan_tugas">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tambahan_tugas_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tambahan_tugas_delete->name->Visible) { // name ?>
		<th class="<?php echo $tambahan_tugas_delete->name->headerCellClass() ?>"><span id="elh_tambahan_tugas_name" class="tambahan_tugas_name"><?php echo $tambahan_tugas_delete->name->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tambahan_tugas_delete->RecordCount = 0;
$i = 0;
while (!$tambahan_tugas_delete->Recordset->EOF) {
	$tambahan_tugas_delete->RecordCount++;
	$tambahan_tugas_delete->RowCount++;

	// Set row properties
	$tambahan_tugas->resetAttributes();
	$tambahan_tugas->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tambahan_tugas_delete->loadRowValues($tambahan_tugas_delete->Recordset);

	// Render row
	$tambahan_tugas_delete->renderRow();
?>
	<tr <?php echo $tambahan_tugas->rowAttributes() ?>>
<?php if ($tambahan_tugas_delete->name->Visible) { // name ?>
		<td <?php echo $tambahan_tugas_delete->name->cellAttributes() ?>>
<span id="el<?php echo $tambahan_tugas_delete->RowCount ?>_tambahan_tugas_name" class="tambahan_tugas_name">
<span<?php echo $tambahan_tugas_delete->name->viewAttributes() ?>><?php echo $tambahan_tugas_delete->name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tambahan_tugas_delete->Recordset->moveNext();
}
$tambahan_tugas_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tambahan_tugas_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tambahan_tugas_delete->showPageFooter();
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
$tambahan_tugas_delete->terminate();
?>