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
$gajisma_delete = new gajisma_delete();

// Run the page
$gajisma_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gajisma_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fgajismadelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fgajismadelete = currentForm = new ew.Form("fgajismadelete", "delete");
	loadjs.done("fgajismadelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $gajisma_delete->showPageHeader(); ?>
<?php
$gajisma_delete->showMessage();
?>
<form name="fgajismadelete" id="fgajismadelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gajisma">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($gajisma_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($gajisma_delete->tahun->Visible) { // tahun ?>
		<th class="<?php echo $gajisma_delete->tahun->headerCellClass() ?>"><span id="elh_gajisma_tahun" class="gajisma_tahun"><?php echo $gajisma_delete->tahun->caption() ?></span></th>
<?php } ?>
<?php if ($gajisma_delete->bulan->Visible) { // bulan ?>
		<th class="<?php echo $gajisma_delete->bulan->headerCellClass() ?>"><span id="elh_gajisma_bulan" class="gajisma_bulan"><?php echo $gajisma_delete->bulan->caption() ?></span></th>
<?php } ?>
<?php if ($gajisma_delete->datetime->Visible) { // datetime ?>
		<th class="<?php echo $gajisma_delete->datetime->headerCellClass() ?>"><span id="elh_gajisma_datetime" class="gajisma_datetime"><?php echo $gajisma_delete->datetime->caption() ?></span></th>
<?php } ?>
<?php if ($gajisma_delete->createby->Visible) { // createby ?>
		<th class="<?php echo $gajisma_delete->createby->headerCellClass() ?>"><span id="elh_gajisma_createby" class="gajisma_createby"><?php echo $gajisma_delete->createby->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$gajisma_delete->RecordCount = 0;
$i = 0;
while (!$gajisma_delete->Recordset->EOF) {
	$gajisma_delete->RecordCount++;
	$gajisma_delete->RowCount++;

	// Set row properties
	$gajisma->resetAttributes();
	$gajisma->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$gajisma_delete->loadRowValues($gajisma_delete->Recordset);

	// Render row
	$gajisma_delete->renderRow();
?>
	<tr <?php echo $gajisma->rowAttributes() ?>>
<?php if ($gajisma_delete->tahun->Visible) { // tahun ?>
		<td <?php echo $gajisma_delete->tahun->cellAttributes() ?>>
<span id="el<?php echo $gajisma_delete->RowCount ?>_gajisma_tahun" class="gajisma_tahun">
<span<?php echo $gajisma_delete->tahun->viewAttributes() ?>><?php echo $gajisma_delete->tahun->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gajisma_delete->bulan->Visible) { // bulan ?>
		<td <?php echo $gajisma_delete->bulan->cellAttributes() ?>>
<span id="el<?php echo $gajisma_delete->RowCount ?>_gajisma_bulan" class="gajisma_bulan">
<span<?php echo $gajisma_delete->bulan->viewAttributes() ?>><?php echo $gajisma_delete->bulan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gajisma_delete->datetime->Visible) { // datetime ?>
		<td <?php echo $gajisma_delete->datetime->cellAttributes() ?>>
<span id="el<?php echo $gajisma_delete->RowCount ?>_gajisma_datetime" class="gajisma_datetime">
<span<?php echo $gajisma_delete->datetime->viewAttributes() ?>><?php echo $gajisma_delete->datetime->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gajisma_delete->createby->Visible) { // createby ?>
		<td <?php echo $gajisma_delete->createby->cellAttributes() ?>>
<span id="el<?php echo $gajisma_delete->RowCount ?>_gajisma_createby" class="gajisma_createby">
<span<?php echo $gajisma_delete->createby->viewAttributes() ?>><?php echo $gajisma_delete->createby->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$gajisma_delete->Recordset->moveNext();
}
$gajisma_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $gajisma_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$gajisma_delete->showPageFooter();
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
$gajisma_delete->terminate();
?>