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
$m_kehadiran_delete = new m_kehadiran_delete();

// Run the page
$m_kehadiran_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_kehadiran_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_kehadirandelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fm_kehadirandelete = currentForm = new ew.Form("fm_kehadirandelete", "delete");
	loadjs.done("fm_kehadirandelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_kehadiran_delete->showPageHeader(); ?>
<?php
$m_kehadiran_delete->showMessage();
?>
<form name="fm_kehadirandelete" id="fm_kehadirandelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_kehadiran">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($m_kehadiran_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($m_kehadiran_delete->jenjang->Visible) { // jenjang ?>
		<th class="<?php echo $m_kehadiran_delete->jenjang->headerCellClass() ?>"><span id="elh_m_kehadiran_jenjang" class="m_kehadiran_jenjang"><?php echo $m_kehadiran_delete->jenjang->caption() ?></span></th>
<?php } ?>
<?php if ($m_kehadiran_delete->jenis_jabatan->Visible) { // jenis_jabatan ?>
		<th class="<?php echo $m_kehadiran_delete->jenis_jabatan->headerCellClass() ?>"><span id="elh_m_kehadiran_jenis_jabatan" class="m_kehadiran_jenis_jabatan"><?php echo $m_kehadiran_delete->jenis_jabatan->caption() ?></span></th>
<?php } ?>
<?php if ($m_kehadiran_delete->jabatan->Visible) { // jabatan ?>
		<th class="<?php echo $m_kehadiran_delete->jabatan->headerCellClass() ?>"><span id="elh_m_kehadiran_jabatan" class="m_kehadiran_jabatan"><?php echo $m_kehadiran_delete->jabatan->caption() ?></span></th>
<?php } ?>
<?php if ($m_kehadiran_delete->sertif->Visible) { // sertif ?>
		<th class="<?php echo $m_kehadiran_delete->sertif->headerCellClass() ?>"><span id="elh_m_kehadiran_sertif" class="m_kehadiran_sertif"><?php echo $m_kehadiran_delete->sertif->caption() ?></span></th>
<?php } ?>
<?php if ($m_kehadiran_delete->value->Visible) { // value ?>
		<th class="<?php echo $m_kehadiran_delete->value->headerCellClass() ?>"><span id="elh_m_kehadiran_value" class="m_kehadiran_value"><?php echo $m_kehadiran_delete->value->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$m_kehadiran_delete->RecordCount = 0;
$i = 0;
while (!$m_kehadiran_delete->Recordset->EOF) {
	$m_kehadiran_delete->RecordCount++;
	$m_kehadiran_delete->RowCount++;

	// Set row properties
	$m_kehadiran->resetAttributes();
	$m_kehadiran->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$m_kehadiran_delete->loadRowValues($m_kehadiran_delete->Recordset);

	// Render row
	$m_kehadiran_delete->renderRow();
?>
	<tr <?php echo $m_kehadiran->rowAttributes() ?>>
<?php if ($m_kehadiran_delete->jenjang->Visible) { // jenjang ?>
		<td <?php echo $m_kehadiran_delete->jenjang->cellAttributes() ?>>
<span id="el<?php echo $m_kehadiran_delete->RowCount ?>_m_kehadiran_jenjang" class="m_kehadiran_jenjang">
<span<?php echo $m_kehadiran_delete->jenjang->viewAttributes() ?>><?php echo $m_kehadiran_delete->jenjang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_kehadiran_delete->jenis_jabatan->Visible) { // jenis_jabatan ?>
		<td <?php echo $m_kehadiran_delete->jenis_jabatan->cellAttributes() ?>>
<span id="el<?php echo $m_kehadiran_delete->RowCount ?>_m_kehadiran_jenis_jabatan" class="m_kehadiran_jenis_jabatan">
<span<?php echo $m_kehadiran_delete->jenis_jabatan->viewAttributes() ?>><?php echo $m_kehadiran_delete->jenis_jabatan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_kehadiran_delete->jabatan->Visible) { // jabatan ?>
		<td <?php echo $m_kehadiran_delete->jabatan->cellAttributes() ?>>
<span id="el<?php echo $m_kehadiran_delete->RowCount ?>_m_kehadiran_jabatan" class="m_kehadiran_jabatan">
<span<?php echo $m_kehadiran_delete->jabatan->viewAttributes() ?>><?php echo $m_kehadiran_delete->jabatan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_kehadiran_delete->sertif->Visible) { // sertif ?>
		<td <?php echo $m_kehadiran_delete->sertif->cellAttributes() ?>>
<span id="el<?php echo $m_kehadiran_delete->RowCount ?>_m_kehadiran_sertif" class="m_kehadiran_sertif">
<span<?php echo $m_kehadiran_delete->sertif->viewAttributes() ?>><?php echo $m_kehadiran_delete->sertif->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_kehadiran_delete->value->Visible) { // value ?>
		<td <?php echo $m_kehadiran_delete->value->cellAttributes() ?>>
<span id="el<?php echo $m_kehadiran_delete->RowCount ?>_m_kehadiran_value" class="m_kehadiran_value">
<span<?php echo $m_kehadiran_delete->value->viewAttributes() ?>><?php echo $m_kehadiran_delete->value->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$m_kehadiran_delete->Recordset->moveNext();
}
$m_kehadiran_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_kehadiran_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$m_kehadiran_delete->showPageFooter();
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
$m_kehadiran_delete->terminate();
?>