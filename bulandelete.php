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
$bulan_delete = new bulan_delete();

// Run the page
$bulan_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$bulan_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fbulandelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fbulandelete = currentForm = new ew.Form("fbulandelete", "delete");
	loadjs.done("fbulandelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $bulan_delete->showPageHeader(); ?>
<?php
$bulan_delete->showMessage();
?>
<form name="fbulandelete" id="fbulandelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="bulan">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($bulan_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($bulan_delete->id->Visible) { // id ?>
		<th class="<?php echo $bulan_delete->id->headerCellClass() ?>"><span id="elh_bulan_id" class="bulan_id"><?php echo $bulan_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($bulan_delete->nourut->Visible) { // nourut ?>
		<th class="<?php echo $bulan_delete->nourut->headerCellClass() ?>"><span id="elh_bulan_nourut" class="bulan_nourut"><?php echo $bulan_delete->nourut->caption() ?></span></th>
<?php } ?>
<?php if ($bulan_delete->bulan->Visible) { // bulan ?>
		<th class="<?php echo $bulan_delete->bulan->headerCellClass() ?>"><span id="elh_bulan_bulan" class="bulan_bulan"><?php echo $bulan_delete->bulan->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$bulan_delete->RecordCount = 0;
$i = 0;
while (!$bulan_delete->Recordset->EOF) {
	$bulan_delete->RecordCount++;
	$bulan_delete->RowCount++;

	// Set row properties
	$bulan->resetAttributes();
	$bulan->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$bulan_delete->loadRowValues($bulan_delete->Recordset);

	// Render row
	$bulan_delete->renderRow();
?>
	<tr <?php echo $bulan->rowAttributes() ?>>
<?php if ($bulan_delete->id->Visible) { // id ?>
		<td <?php echo $bulan_delete->id->cellAttributes() ?>>
<span id="el<?php echo $bulan_delete->RowCount ?>_bulan_id" class="bulan_id">
<span<?php echo $bulan_delete->id->viewAttributes() ?>><?php echo $bulan_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bulan_delete->nourut->Visible) { // nourut ?>
		<td <?php echo $bulan_delete->nourut->cellAttributes() ?>>
<span id="el<?php echo $bulan_delete->RowCount ?>_bulan_nourut" class="bulan_nourut">
<span<?php echo $bulan_delete->nourut->viewAttributes() ?>><?php echo $bulan_delete->nourut->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bulan_delete->bulan->Visible) { // bulan ?>
		<td <?php echo $bulan_delete->bulan->cellAttributes() ?>>
<span id="el<?php echo $bulan_delete->RowCount ?>_bulan_bulan" class="bulan_bulan">
<span<?php echo $bulan_delete->bulan->viewAttributes() ?>><?php echo $bulan_delete->bulan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$bulan_delete->Recordset->moveNext();
}
$bulan_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $bulan_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$bulan_delete->showPageFooter();
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
$bulan_delete->terminate();
?>