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
$sertif_delete = new sertif_delete();

// Run the page
$sertif_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$sertif_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fsertifdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fsertifdelete = currentForm = new ew.Form("fsertifdelete", "delete");
	loadjs.done("fsertifdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $sertif_delete->showPageHeader(); ?>
<?php
$sertif_delete->showMessage();
?>
<form name="fsertifdelete" id="fsertifdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="sertif">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($sertif_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($sertif_delete->name->Visible) { // name ?>
		<th class="<?php echo $sertif_delete->name->headerCellClass() ?>"><span id="elh_sertif_name" class="sertif_name"><?php echo $sertif_delete->name->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$sertif_delete->RecordCount = 0;
$i = 0;
while (!$sertif_delete->Recordset->EOF) {
	$sertif_delete->RecordCount++;
	$sertif_delete->RowCount++;

	// Set row properties
	$sertif->resetAttributes();
	$sertif->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$sertif_delete->loadRowValues($sertif_delete->Recordset);

	// Render row
	$sertif_delete->renderRow();
?>
	<tr <?php echo $sertif->rowAttributes() ?>>
<?php if ($sertif_delete->name->Visible) { // name ?>
		<td <?php echo $sertif_delete->name->cellAttributes() ?>>
<span id="el<?php echo $sertif_delete->RowCount ?>_sertif_name" class="sertif_name">
<span<?php echo $sertif_delete->name->viewAttributes() ?>><?php echo $sertif_delete->name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$sertif_delete->Recordset->moveNext();
}
$sertif_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $sertif_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$sertif_delete->showPageFooter();
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
$sertif_delete->terminate();
?>