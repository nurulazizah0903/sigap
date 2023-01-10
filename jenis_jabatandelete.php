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
$jenis_jabatan_delete = new jenis_jabatan_delete();

// Run the page
$jenis_jabatan_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$jenis_jabatan_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fjenis_jabatandelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fjenis_jabatandelete = currentForm = new ew.Form("fjenis_jabatandelete", "delete");
	loadjs.done("fjenis_jabatandelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $jenis_jabatan_delete->showPageHeader(); ?>
<?php
$jenis_jabatan_delete->showMessage();
?>
<form name="fjenis_jabatandelete" id="fjenis_jabatandelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="jenis_jabatan">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($jenis_jabatan_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($jenis_jabatan_delete->name->Visible) { // name ?>
		<th class="<?php echo $jenis_jabatan_delete->name->headerCellClass() ?>"><span id="elh_jenis_jabatan_name" class="jenis_jabatan_name"><?php echo $jenis_jabatan_delete->name->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$jenis_jabatan_delete->RecordCount = 0;
$i = 0;
while (!$jenis_jabatan_delete->Recordset->EOF) {
	$jenis_jabatan_delete->RecordCount++;
	$jenis_jabatan_delete->RowCount++;

	// Set row properties
	$jenis_jabatan->resetAttributes();
	$jenis_jabatan->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$jenis_jabatan_delete->loadRowValues($jenis_jabatan_delete->Recordset);

	// Render row
	$jenis_jabatan_delete->renderRow();
?>
	<tr <?php echo $jenis_jabatan->rowAttributes() ?>>
<?php if ($jenis_jabatan_delete->name->Visible) { // name ?>
		<td <?php echo $jenis_jabatan_delete->name->cellAttributes() ?>>
<span id="el<?php echo $jenis_jabatan_delete->RowCount ?>_jenis_jabatan_name" class="jenis_jabatan_name">
<span<?php echo $jenis_jabatan_delete->name->viewAttributes() ?>><?php echo $jenis_jabatan_delete->name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$jenis_jabatan_delete->Recordset->moveNext();
}
$jenis_jabatan_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $jenis_jabatan_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$jenis_jabatan_delete->showPageFooter();
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
$jenis_jabatan_delete->terminate();
?>