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
$gajisd_delete = new gajisd_delete();

// Run the page
$gajisd_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gajisd_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fgajisddelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fgajisddelete = currentForm = new ew.Form("fgajisddelete", "delete");
	loadjs.done("fgajisddelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $gajisd_delete->showPageHeader(); ?>
<?php
$gajisd_delete->showMessage();
?>
<form name="fgajisddelete" id="fgajisddelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gajisd">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($gajisd_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($gajisd_delete->tahun->Visible) { // tahun ?>
		<th class="<?php echo $gajisd_delete->tahun->headerCellClass() ?>"><span id="elh_gajisd_tahun" class="gajisd_tahun"><?php echo $gajisd_delete->tahun->caption() ?></span></th>
<?php } ?>
<?php if ($gajisd_delete->bulan->Visible) { // bulan ?>
		<th class="<?php echo $gajisd_delete->bulan->headerCellClass() ?>"><span id="elh_gajisd_bulan" class="gajisd_bulan"><?php echo $gajisd_delete->bulan->caption() ?></span></th>
<?php } ?>
<?php if ($gajisd_delete->datetime->Visible) { // datetime ?>
		<th class="<?php echo $gajisd_delete->datetime->headerCellClass() ?>"><span id="elh_gajisd_datetime" class="gajisd_datetime"><?php echo $gajisd_delete->datetime->caption() ?></span></th>
<?php } ?>
<?php if ($gajisd_delete->createby->Visible) { // createby ?>
		<th class="<?php echo $gajisd_delete->createby->headerCellClass() ?>"><span id="elh_gajisd_createby" class="gajisd_createby"><?php echo $gajisd_delete->createby->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$gajisd_delete->RecordCount = 0;
$i = 0;
while (!$gajisd_delete->Recordset->EOF) {
	$gajisd_delete->RecordCount++;
	$gajisd_delete->RowCount++;

	// Set row properties
	$gajisd->resetAttributes();
	$gajisd->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$gajisd_delete->loadRowValues($gajisd_delete->Recordset);

	// Render row
	$gajisd_delete->renderRow();
?>
	<tr <?php echo $gajisd->rowAttributes() ?>>
<?php if ($gajisd_delete->tahun->Visible) { // tahun ?>
		<td <?php echo $gajisd_delete->tahun->cellAttributes() ?>>
<span id="el<?php echo $gajisd_delete->RowCount ?>_gajisd_tahun" class="gajisd_tahun">
<span<?php echo $gajisd_delete->tahun->viewAttributes() ?>><?php echo $gajisd_delete->tahun->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gajisd_delete->bulan->Visible) { // bulan ?>
		<td <?php echo $gajisd_delete->bulan->cellAttributes() ?>>
<span id="el<?php echo $gajisd_delete->RowCount ?>_gajisd_bulan" class="gajisd_bulan">
<span<?php echo $gajisd_delete->bulan->viewAttributes() ?>><?php echo $gajisd_delete->bulan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gajisd_delete->datetime->Visible) { // datetime ?>
		<td <?php echo $gajisd_delete->datetime->cellAttributes() ?>>
<span id="el<?php echo $gajisd_delete->RowCount ?>_gajisd_datetime" class="gajisd_datetime">
<span<?php echo $gajisd_delete->datetime->viewAttributes() ?>><?php echo $gajisd_delete->datetime->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gajisd_delete->createby->Visible) { // createby ?>
		<td <?php echo $gajisd_delete->createby->cellAttributes() ?>>
<span id="el<?php echo $gajisd_delete->RowCount ?>_gajisd_createby" class="gajisd_createby">
<span<?php echo $gajisd_delete->createby->viewAttributes() ?>><?php echo $gajisd_delete->createby->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$gajisd_delete->Recordset->moveNext();
}
$gajisd_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $gajisd_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$gajisd_delete->showPageFooter();
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
$gajisd_delete->terminate();
?>