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
$tunjangan_berkala_delete = new tunjangan_berkala_delete();

// Run the page
$tunjangan_berkala_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tunjangan_berkala_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftunjangan_berkaladelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ftunjangan_berkaladelete = currentForm = new ew.Form("ftunjangan_berkaladelete", "delete");
	loadjs.done("ftunjangan_berkaladelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tunjangan_berkala_delete->showPageHeader(); ?>
<?php
$tunjangan_berkala_delete->showMessage();
?>
<form name="ftunjangan_berkaladelete" id="ftunjangan_berkaladelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tunjangan_berkala">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tunjangan_berkala_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tunjangan_berkala_delete->jenjang->Visible) { // jenjang ?>
		<th class="<?php echo $tunjangan_berkala_delete->jenjang->headerCellClass() ?>"><span id="elh_tunjangan_berkala_jenjang" class="tunjangan_berkala_jenjang"><?php echo $tunjangan_berkala_delete->jenjang->caption() ?></span></th>
<?php } ?>
<?php if ($tunjangan_berkala_delete->kualifikasi->Visible) { // kualifikasi ?>
		<th class="<?php echo $tunjangan_berkala_delete->kualifikasi->headerCellClass() ?>"><span id="elh_tunjangan_berkala_kualifikasi" class="tunjangan_berkala_kualifikasi"><?php echo $tunjangan_berkala_delete->kualifikasi->caption() ?></span></th>
<?php } ?>
<?php if ($tunjangan_berkala_delete->lama->Visible) { // lama ?>
		<th class="<?php echo $tunjangan_berkala_delete->lama->headerCellClass() ?>"><span id="elh_tunjangan_berkala_lama" class="tunjangan_berkala_lama"><?php echo $tunjangan_berkala_delete->lama->caption() ?></span></th>
<?php } ?>
<?php if ($tunjangan_berkala_delete->value->Visible) { // value ?>
		<th class="<?php echo $tunjangan_berkala_delete->value->headerCellClass() ?>"><span id="elh_tunjangan_berkala_value" class="tunjangan_berkala_value"><?php echo $tunjangan_berkala_delete->value->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tunjangan_berkala_delete->RecordCount = 0;
$i = 0;
while (!$tunjangan_berkala_delete->Recordset->EOF) {
	$tunjangan_berkala_delete->RecordCount++;
	$tunjangan_berkala_delete->RowCount++;

	// Set row properties
	$tunjangan_berkala->resetAttributes();
	$tunjangan_berkala->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tunjangan_berkala_delete->loadRowValues($tunjangan_berkala_delete->Recordset);

	// Render row
	$tunjangan_berkala_delete->renderRow();
?>
	<tr <?php echo $tunjangan_berkala->rowAttributes() ?>>
<?php if ($tunjangan_berkala_delete->jenjang->Visible) { // jenjang ?>
		<td <?php echo $tunjangan_berkala_delete->jenjang->cellAttributes() ?>>
<span id="el<?php echo $tunjangan_berkala_delete->RowCount ?>_tunjangan_berkala_jenjang" class="tunjangan_berkala_jenjang">
<span<?php echo $tunjangan_berkala_delete->jenjang->viewAttributes() ?>><?php echo $tunjangan_berkala_delete->jenjang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tunjangan_berkala_delete->kualifikasi->Visible) { // kualifikasi ?>
		<td <?php echo $tunjangan_berkala_delete->kualifikasi->cellAttributes() ?>>
<span id="el<?php echo $tunjangan_berkala_delete->RowCount ?>_tunjangan_berkala_kualifikasi" class="tunjangan_berkala_kualifikasi">
<span<?php echo $tunjangan_berkala_delete->kualifikasi->viewAttributes() ?>><?php echo $tunjangan_berkala_delete->kualifikasi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tunjangan_berkala_delete->lama->Visible) { // lama ?>
		<td <?php echo $tunjangan_berkala_delete->lama->cellAttributes() ?>>
<span id="el<?php echo $tunjangan_berkala_delete->RowCount ?>_tunjangan_berkala_lama" class="tunjangan_berkala_lama">
<span<?php echo $tunjangan_berkala_delete->lama->viewAttributes() ?>><?php echo $tunjangan_berkala_delete->lama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tunjangan_berkala_delete->value->Visible) { // value ?>
		<td <?php echo $tunjangan_berkala_delete->value->cellAttributes() ?>>
<span id="el<?php echo $tunjangan_berkala_delete->RowCount ?>_tunjangan_berkala_value" class="tunjangan_berkala_value">
<span<?php echo $tunjangan_berkala_delete->value->viewAttributes() ?>><?php echo $tunjangan_berkala_delete->value->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tunjangan_berkala_delete->Recordset->moveNext();
}
$tunjangan_berkala_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tunjangan_berkala_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tunjangan_berkala_delete->showPageFooter();
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
$tunjangan_berkala_delete->terminate();
?>