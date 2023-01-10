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
$tunjangan_tambahan_delete = new tunjangan_tambahan_delete();

// Run the page
$tunjangan_tambahan_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tunjangan_tambahan_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftunjangan_tambahandelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ftunjangan_tambahandelete = currentForm = new ew.Form("ftunjangan_tambahandelete", "delete");
	loadjs.done("ftunjangan_tambahandelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tunjangan_tambahan_delete->showPageHeader(); ?>
<?php
$tunjangan_tambahan_delete->showMessage();
?>
<form name="ftunjangan_tambahandelete" id="ftunjangan_tambahandelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tunjangan_tambahan">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tunjangan_tambahan_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tunjangan_tambahan_delete->jenjang->Visible) { // jenjang ?>
		<th class="<?php echo $tunjangan_tambahan_delete->jenjang->headerCellClass() ?>"><span id="elh_tunjangan_tambahan_jenjang" class="tunjangan_tambahan_jenjang"><?php echo $tunjangan_tambahan_delete->jenjang->caption() ?></span></th>
<?php } ?>
<?php if ($tunjangan_tambahan_delete->kualifikasi->Visible) { // kualifikasi ?>
		<th class="<?php echo $tunjangan_tambahan_delete->kualifikasi->headerCellClass() ?>"><span id="elh_tunjangan_tambahan_kualifikasi" class="tunjangan_tambahan_kualifikasi"><?php echo $tunjangan_tambahan_delete->kualifikasi->caption() ?></span></th>
<?php } ?>
<?php if ($tunjangan_tambahan_delete->value->Visible) { // value ?>
		<th class="<?php echo $tunjangan_tambahan_delete->value->headerCellClass() ?>"><span id="elh_tunjangan_tambahan_value" class="tunjangan_tambahan_value"><?php echo $tunjangan_tambahan_delete->value->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tunjangan_tambahan_delete->RecordCount = 0;
$i = 0;
while (!$tunjangan_tambahan_delete->Recordset->EOF) {
	$tunjangan_tambahan_delete->RecordCount++;
	$tunjangan_tambahan_delete->RowCount++;

	// Set row properties
	$tunjangan_tambahan->resetAttributes();
	$tunjangan_tambahan->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tunjangan_tambahan_delete->loadRowValues($tunjangan_tambahan_delete->Recordset);

	// Render row
	$tunjangan_tambahan_delete->renderRow();
?>
	<tr <?php echo $tunjangan_tambahan->rowAttributes() ?>>
<?php if ($tunjangan_tambahan_delete->jenjang->Visible) { // jenjang ?>
		<td <?php echo $tunjangan_tambahan_delete->jenjang->cellAttributes() ?>>
<span id="el<?php echo $tunjangan_tambahan_delete->RowCount ?>_tunjangan_tambahan_jenjang" class="tunjangan_tambahan_jenjang">
<span<?php echo $tunjangan_tambahan_delete->jenjang->viewAttributes() ?>><?php echo $tunjangan_tambahan_delete->jenjang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tunjangan_tambahan_delete->kualifikasi->Visible) { // kualifikasi ?>
		<td <?php echo $tunjangan_tambahan_delete->kualifikasi->cellAttributes() ?>>
<span id="el<?php echo $tunjangan_tambahan_delete->RowCount ?>_tunjangan_tambahan_kualifikasi" class="tunjangan_tambahan_kualifikasi">
<span<?php echo $tunjangan_tambahan_delete->kualifikasi->viewAttributes() ?>><?php echo $tunjangan_tambahan_delete->kualifikasi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tunjangan_tambahan_delete->value->Visible) { // value ?>
		<td <?php echo $tunjangan_tambahan_delete->value->cellAttributes() ?>>
<span id="el<?php echo $tunjangan_tambahan_delete->RowCount ?>_tunjangan_tambahan_value" class="tunjangan_tambahan_value">
<span<?php echo $tunjangan_tambahan_delete->value->viewAttributes() ?>><?php echo $tunjangan_tambahan_delete->value->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tunjangan_tambahan_delete->Recordset->moveNext();
}
$tunjangan_tambahan_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tunjangan_tambahan_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tunjangan_tambahan_delete->showPageFooter();
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
$tunjangan_tambahan_delete->terminate();
?>