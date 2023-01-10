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
$absen_delete = new absen_delete();

// Run the page
$absen_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$absen_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fabsendelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fabsendelete = currentForm = new ew.Form("fabsendelete", "delete");
	loadjs.done("fabsendelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $absen_delete->showPageHeader(); ?>
<?php
$absen_delete->showMessage();
?>
<form name="fabsendelete" id="fabsendelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="absen">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($absen_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($absen_delete->tahun->Visible) { // tahun ?>
		<th class="<?php echo $absen_delete->tahun->headerCellClass() ?>"><span id="elh_absen_tahun" class="absen_tahun"><?php echo $absen_delete->tahun->caption() ?></span></th>
<?php } ?>
<?php if ($absen_delete->bulan->Visible) { // bulan ?>
		<th class="<?php echo $absen_delete->bulan->headerCellClass() ?>"><span id="elh_absen_bulan" class="absen_bulan"><?php echo $absen_delete->bulan->caption() ?></span></th>
<?php } ?>
<?php if ($absen_delete->jumlah_hari_kerja->Visible) { // jumlah_hari_kerja ?>
		<th class="<?php echo $absen_delete->jumlah_hari_kerja->headerCellClass() ?>"><span id="elh_absen_jumlah_hari_kerja" class="absen_jumlah_hari_kerja"><?php echo $absen_delete->jumlah_hari_kerja->caption() ?></span></th>
<?php } ?>
<?php if ($absen_delete->datetime->Visible) { // datetime ?>
		<th class="<?php echo $absen_delete->datetime->headerCellClass() ?>"><span id="elh_absen_datetime" class="absen_datetime"><?php echo $absen_delete->datetime->caption() ?></span></th>
<?php } ?>
<?php if ($absen_delete->createuser->Visible) { // createuser ?>
		<th class="<?php echo $absen_delete->createuser->headerCellClass() ?>"><span id="elh_absen_createuser" class="absen_createuser"><?php echo $absen_delete->createuser->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$absen_delete->RecordCount = 0;
$i = 0;
while (!$absen_delete->Recordset->EOF) {
	$absen_delete->RecordCount++;
	$absen_delete->RowCount++;

	// Set row properties
	$absen->resetAttributes();
	$absen->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$absen_delete->loadRowValues($absen_delete->Recordset);

	// Render row
	$absen_delete->renderRow();
?>
	<tr <?php echo $absen->rowAttributes() ?>>
<?php if ($absen_delete->tahun->Visible) { // tahun ?>
		<td <?php echo $absen_delete->tahun->cellAttributes() ?>>
<span id="el<?php echo $absen_delete->RowCount ?>_absen_tahun" class="absen_tahun">
<span<?php echo $absen_delete->tahun->viewAttributes() ?>><?php echo $absen_delete->tahun->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($absen_delete->bulan->Visible) { // bulan ?>
		<td <?php echo $absen_delete->bulan->cellAttributes() ?>>
<span id="el<?php echo $absen_delete->RowCount ?>_absen_bulan" class="absen_bulan">
<span<?php echo $absen_delete->bulan->viewAttributes() ?>><?php echo $absen_delete->bulan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($absen_delete->jumlah_hari_kerja->Visible) { // jumlah_hari_kerja ?>
		<td <?php echo $absen_delete->jumlah_hari_kerja->cellAttributes() ?>>
<span id="el<?php echo $absen_delete->RowCount ?>_absen_jumlah_hari_kerja" class="absen_jumlah_hari_kerja">
<span<?php echo $absen_delete->jumlah_hari_kerja->viewAttributes() ?>><?php echo $absen_delete->jumlah_hari_kerja->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($absen_delete->datetime->Visible) { // datetime ?>
		<td <?php echo $absen_delete->datetime->cellAttributes() ?>>
<span id="el<?php echo $absen_delete->RowCount ?>_absen_datetime" class="absen_datetime">
<span<?php echo $absen_delete->datetime->viewAttributes() ?>><?php echo $absen_delete->datetime->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($absen_delete->createuser->Visible) { // createuser ?>
		<td <?php echo $absen_delete->createuser->cellAttributes() ?>>
<span id="el<?php echo $absen_delete->RowCount ?>_absen_createuser" class="absen_createuser">
<span<?php echo $absen_delete->createuser->viewAttributes() ?>><?php echo $absen_delete->createuser->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$absen_delete->Recordset->moveNext();
}
$absen_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $absen_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$absen_delete->showPageFooter();
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
$absen_delete->terminate();
?>