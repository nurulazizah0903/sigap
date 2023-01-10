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
$tpendidikan_delete = new tpendidikan_delete();

// Run the page
$tpendidikan_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tpendidikan_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftpendidikandelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ftpendidikandelete = currentForm = new ew.Form("ftpendidikandelete", "delete");
	loadjs.done("ftpendidikandelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tpendidikan_delete->showPageHeader(); ?>
<?php
$tpendidikan_delete->showMessage();
?>
<form name="ftpendidikandelete" id="ftpendidikandelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tpendidikan">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tpendidikan_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tpendidikan_delete->nourut->Visible) { // nourut ?>
		<th class="<?php echo $tpendidikan_delete->nourut->headerCellClass() ?>"><span id="elh_tpendidikan_nourut" class="tpendidikan_nourut"><?php echo $tpendidikan_delete->nourut->caption() ?></span></th>
<?php } ?>
<?php if ($tpendidikan_delete->name->Visible) { // name ?>
		<th class="<?php echo $tpendidikan_delete->name->headerCellClass() ?>"><span id="elh_tpendidikan_name" class="tpendidikan_name"><?php echo $tpendidikan_delete->name->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tpendidikan_delete->RecordCount = 0;
$i = 0;
while (!$tpendidikan_delete->Recordset->EOF) {
	$tpendidikan_delete->RecordCount++;
	$tpendidikan_delete->RowCount++;

	// Set row properties
	$tpendidikan->resetAttributes();
	$tpendidikan->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tpendidikan_delete->loadRowValues($tpendidikan_delete->Recordset);

	// Render row
	$tpendidikan_delete->renderRow();
?>
	<tr <?php echo $tpendidikan->rowAttributes() ?>>
<?php if ($tpendidikan_delete->nourut->Visible) { // nourut ?>
		<td <?php echo $tpendidikan_delete->nourut->cellAttributes() ?>>
<span id="el<?php echo $tpendidikan_delete->RowCount ?>_tpendidikan_nourut" class="tpendidikan_nourut">
<span<?php echo $tpendidikan_delete->nourut->viewAttributes() ?>><?php echo $tpendidikan_delete->nourut->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tpendidikan_delete->name->Visible) { // name ?>
		<td <?php echo $tpendidikan_delete->name->cellAttributes() ?>>
<span id="el<?php echo $tpendidikan_delete->RowCount ?>_tpendidikan_name" class="tpendidikan_name">
<span<?php echo $tpendidikan_delete->name->viewAttributes() ?>><?php echo $tpendidikan_delete->name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tpendidikan_delete->Recordset->moveNext();
}
$tpendidikan_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tpendidikan_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tpendidikan_delete->showPageFooter();
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
$tpendidikan_delete->terminate();
?>