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
$gajismk_delete = new gajismk_delete();

// Run the page
$gajismk_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gajismk_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fgajismkdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fgajismkdelete = currentForm = new ew.Form("fgajismkdelete", "delete");
	loadjs.done("fgajismkdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $gajismk_delete->showPageHeader(); ?>
<?php
$gajismk_delete->showMessage();
?>
<form name="fgajismkdelete" id="fgajismkdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gajismk">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($gajismk_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($gajismk_delete->tahun->Visible) { // tahun ?>
		<th class="<?php echo $gajismk_delete->tahun->headerCellClass() ?>"><span id="elh_gajismk_tahun" class="gajismk_tahun"><?php echo $gajismk_delete->tahun->caption() ?></span></th>
<?php } ?>
<?php if ($gajismk_delete->bulan->Visible) { // bulan ?>
		<th class="<?php echo $gajismk_delete->bulan->headerCellClass() ?>"><span id="elh_gajismk_bulan" class="gajismk_bulan"><?php echo $gajismk_delete->bulan->caption() ?></span></th>
<?php } ?>
<?php if ($gajismk_delete->datetime->Visible) { // datetime ?>
		<th class="<?php echo $gajismk_delete->datetime->headerCellClass() ?>"><span id="elh_gajismk_datetime" class="gajismk_datetime"><?php echo $gajismk_delete->datetime->caption() ?></span></th>
<?php } ?>
<?php if ($gajismk_delete->createby->Visible) { // createby ?>
		<th class="<?php echo $gajismk_delete->createby->headerCellClass() ?>"><span id="elh_gajismk_createby" class="gajismk_createby"><?php echo $gajismk_delete->createby->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$gajismk_delete->RecordCount = 0;
$i = 0;
while (!$gajismk_delete->Recordset->EOF) {
	$gajismk_delete->RecordCount++;
	$gajismk_delete->RowCount++;

	// Set row properties
	$gajismk->resetAttributes();
	$gajismk->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$gajismk_delete->loadRowValues($gajismk_delete->Recordset);

	// Render row
	$gajismk_delete->renderRow();
?>
	<tr <?php echo $gajismk->rowAttributes() ?>>
<?php if ($gajismk_delete->tahun->Visible) { // tahun ?>
		<td <?php echo $gajismk_delete->tahun->cellAttributes() ?>>
<span id="el<?php echo $gajismk_delete->RowCount ?>_gajismk_tahun" class="gajismk_tahun">
<span<?php echo $gajismk_delete->tahun->viewAttributes() ?>><?php echo $gajismk_delete->tahun->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gajismk_delete->bulan->Visible) { // bulan ?>
		<td <?php echo $gajismk_delete->bulan->cellAttributes() ?>>
<span id="el<?php echo $gajismk_delete->RowCount ?>_gajismk_bulan" class="gajismk_bulan">
<span<?php echo $gajismk_delete->bulan->viewAttributes() ?>><?php echo $gajismk_delete->bulan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gajismk_delete->datetime->Visible) { // datetime ?>
		<td <?php echo $gajismk_delete->datetime->cellAttributes() ?>>
<span id="el<?php echo $gajismk_delete->RowCount ?>_gajismk_datetime" class="gajismk_datetime">
<span<?php echo $gajismk_delete->datetime->viewAttributes() ?>><?php echo $gajismk_delete->datetime->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gajismk_delete->createby->Visible) { // createby ?>
		<td <?php echo $gajismk_delete->createby->cellAttributes() ?>>
<span id="el<?php echo $gajismk_delete->RowCount ?>_gajismk_createby" class="gajismk_createby">
<span<?php echo $gajismk_delete->createby->viewAttributes() ?>><?php echo $gajismk_delete->createby->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$gajismk_delete->Recordset->moveNext();
}
$gajismk_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $gajismk_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$gajismk_delete->showPageFooter();
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
$gajismk_delete->terminate();
?>