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
$gajitk_delete = new gajitk_delete();

// Run the page
$gajitk_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gajitk_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fgajitkdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fgajitkdelete = currentForm = new ew.Form("fgajitkdelete", "delete");
	loadjs.done("fgajitkdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $gajitk_delete->showPageHeader(); ?>
<?php
$gajitk_delete->showMessage();
?>
<form name="fgajitkdelete" id="fgajitkdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gajitk">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($gajitk_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($gajitk_delete->tahun->Visible) { // tahun ?>
		<th class="<?php echo $gajitk_delete->tahun->headerCellClass() ?>"><span id="elh_gajitk_tahun" class="gajitk_tahun"><?php echo $gajitk_delete->tahun->caption() ?></span></th>
<?php } ?>
<?php if ($gajitk_delete->bulan->Visible) { // bulan ?>
		<th class="<?php echo $gajitk_delete->bulan->headerCellClass() ?>"><span id="elh_gajitk_bulan" class="gajitk_bulan"><?php echo $gajitk_delete->bulan->caption() ?></span></th>
<?php } ?>
<?php if ($gajitk_delete->datetime->Visible) { // datetime ?>
		<th class="<?php echo $gajitk_delete->datetime->headerCellClass() ?>"><span id="elh_gajitk_datetime" class="gajitk_datetime"><?php echo $gajitk_delete->datetime->caption() ?></span></th>
<?php } ?>
<?php if ($gajitk_delete->createby->Visible) { // createby ?>
		<th class="<?php echo $gajitk_delete->createby->headerCellClass() ?>"><span id="elh_gajitk_createby" class="gajitk_createby"><?php echo $gajitk_delete->createby->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$gajitk_delete->RecordCount = 0;
$i = 0;
while (!$gajitk_delete->Recordset->EOF) {
	$gajitk_delete->RecordCount++;
	$gajitk_delete->RowCount++;

	// Set row properties
	$gajitk->resetAttributes();
	$gajitk->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$gajitk_delete->loadRowValues($gajitk_delete->Recordset);

	// Render row
	$gajitk_delete->renderRow();
?>
	<tr <?php echo $gajitk->rowAttributes() ?>>
<?php if ($gajitk_delete->tahun->Visible) { // tahun ?>
		<td <?php echo $gajitk_delete->tahun->cellAttributes() ?>>
<span id="el<?php echo $gajitk_delete->RowCount ?>_gajitk_tahun" class="gajitk_tahun">
<span<?php echo $gajitk_delete->tahun->viewAttributes() ?>><?php echo $gajitk_delete->tahun->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gajitk_delete->bulan->Visible) { // bulan ?>
		<td <?php echo $gajitk_delete->bulan->cellAttributes() ?>>
<span id="el<?php echo $gajitk_delete->RowCount ?>_gajitk_bulan" class="gajitk_bulan">
<span<?php echo $gajitk_delete->bulan->viewAttributes() ?>><?php echo $gajitk_delete->bulan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gajitk_delete->datetime->Visible) { // datetime ?>
		<td <?php echo $gajitk_delete->datetime->cellAttributes() ?>>
<span id="el<?php echo $gajitk_delete->RowCount ?>_gajitk_datetime" class="gajitk_datetime">
<span<?php echo $gajitk_delete->datetime->viewAttributes() ?>><?php echo $gajitk_delete->datetime->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gajitk_delete->createby->Visible) { // createby ?>
		<td <?php echo $gajitk_delete->createby->cellAttributes() ?>>
<span id="el<?php echo $gajitk_delete->RowCount ?>_gajitk_createby" class="gajitk_createby">
<span<?php echo $gajitk_delete->createby->viewAttributes() ?>><?php echo $gajitk_delete->createby->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$gajitk_delete->Recordset->moveNext();
}
$gajitk_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $gajitk_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$gajitk_delete->showPageFooter();
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
$gajitk_delete->terminate();
?>