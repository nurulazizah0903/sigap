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
$gajismp_delete = new gajismp_delete();

// Run the page
$gajismp_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gajismp_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fgajismpdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fgajismpdelete = currentForm = new ew.Form("fgajismpdelete", "delete");
	loadjs.done("fgajismpdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $gajismp_delete->showPageHeader(); ?>
<?php
$gajismp_delete->showMessage();
?>
<form name="fgajismpdelete" id="fgajismpdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gajismp">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($gajismp_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($gajismp_delete->tahun->Visible) { // tahun ?>
		<th class="<?php echo $gajismp_delete->tahun->headerCellClass() ?>"><span id="elh_gajismp_tahun" class="gajismp_tahun"><?php echo $gajismp_delete->tahun->caption() ?></span></th>
<?php } ?>
<?php if ($gajismp_delete->bulan->Visible) { // bulan ?>
		<th class="<?php echo $gajismp_delete->bulan->headerCellClass() ?>"><span id="elh_gajismp_bulan" class="gajismp_bulan"><?php echo $gajismp_delete->bulan->caption() ?></span></th>
<?php } ?>
<?php if ($gajismp_delete->datetime->Visible) { // datetime ?>
		<th class="<?php echo $gajismp_delete->datetime->headerCellClass() ?>"><span id="elh_gajismp_datetime" class="gajismp_datetime"><?php echo $gajismp_delete->datetime->caption() ?></span></th>
<?php } ?>
<?php if ($gajismp_delete->createby->Visible) { // createby ?>
		<th class="<?php echo $gajismp_delete->createby->headerCellClass() ?>"><span id="elh_gajismp_createby" class="gajismp_createby"><?php echo $gajismp_delete->createby->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$gajismp_delete->RecordCount = 0;
$i = 0;
while (!$gajismp_delete->Recordset->EOF) {
	$gajismp_delete->RecordCount++;
	$gajismp_delete->RowCount++;

	// Set row properties
	$gajismp->resetAttributes();
	$gajismp->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$gajismp_delete->loadRowValues($gajismp_delete->Recordset);

	// Render row
	$gajismp_delete->renderRow();
?>
	<tr <?php echo $gajismp->rowAttributes() ?>>
<?php if ($gajismp_delete->tahun->Visible) { // tahun ?>
		<td <?php echo $gajismp_delete->tahun->cellAttributes() ?>>
<span id="el<?php echo $gajismp_delete->RowCount ?>_gajismp_tahun" class="gajismp_tahun">
<span<?php echo $gajismp_delete->tahun->viewAttributes() ?>><?php echo $gajismp_delete->tahun->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gajismp_delete->bulan->Visible) { // bulan ?>
		<td <?php echo $gajismp_delete->bulan->cellAttributes() ?>>
<span id="el<?php echo $gajismp_delete->RowCount ?>_gajismp_bulan" class="gajismp_bulan">
<span<?php echo $gajismp_delete->bulan->viewAttributes() ?>><?php echo $gajismp_delete->bulan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gajismp_delete->datetime->Visible) { // datetime ?>
		<td <?php echo $gajismp_delete->datetime->cellAttributes() ?>>
<span id="el<?php echo $gajismp_delete->RowCount ?>_gajismp_datetime" class="gajismp_datetime">
<span<?php echo $gajismp_delete->datetime->viewAttributes() ?>><?php echo $gajismp_delete->datetime->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gajismp_delete->createby->Visible) { // createby ?>
		<td <?php echo $gajismp_delete->createby->cellAttributes() ?>>
<span id="el<?php echo $gajismp_delete->RowCount ?>_gajismp_createby" class="gajismp_createby">
<span<?php echo $gajismp_delete->createby->viewAttributes() ?>><?php echo $gajismp_delete->createby->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$gajismp_delete->Recordset->moveNext();
}
$gajismp_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $gajismp_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$gajismp_delete->showPageFooter();
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
$gajismp_delete->terminate();
?>