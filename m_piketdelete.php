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
$m_piket_delete = new m_piket_delete();

// Run the page
$m_piket_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_piket_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_piketdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fm_piketdelete = currentForm = new ew.Form("fm_piketdelete", "delete");
	loadjs.done("fm_piketdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_piket_delete->showPageHeader(); ?>
<?php
$m_piket_delete->showMessage();
?>
<form name="fm_piketdelete" id="fm_piketdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_piket">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($m_piket_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($m_piket_delete->jenjang->Visible) { // jenjang ?>
		<th class="<?php echo $m_piket_delete->jenjang->headerCellClass() ?>"><span id="elh_m_piket_jenjang" class="m_piket_jenjang"><?php echo $m_piket_delete->jenjang->caption() ?></span></th>
<?php } ?>
<?php if ($m_piket_delete->type_jabatan->Visible) { // type_jabatan ?>
		<th class="<?php echo $m_piket_delete->type_jabatan->headerCellClass() ?>"><span id="elh_m_piket_type_jabatan" class="m_piket_type_jabatan"><?php echo $m_piket_delete->type_jabatan->caption() ?></span></th>
<?php } ?>
<?php if ($m_piket_delete->jenis_sertif->Visible) { // jenis_sertif ?>
		<th class="<?php echo $m_piket_delete->jenis_sertif->headerCellClass() ?>"><span id="elh_m_piket_jenis_sertif" class="m_piket_jenis_sertif"><?php echo $m_piket_delete->jenis_sertif->caption() ?></span></th>
<?php } ?>
<?php if ($m_piket_delete->value->Visible) { // value ?>
		<th class="<?php echo $m_piket_delete->value->headerCellClass() ?>"><span id="elh_m_piket_value" class="m_piket_value"><?php echo $m_piket_delete->value->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$m_piket_delete->RecordCount = 0;
$i = 0;
while (!$m_piket_delete->Recordset->EOF) {
	$m_piket_delete->RecordCount++;
	$m_piket_delete->RowCount++;

	// Set row properties
	$m_piket->resetAttributes();
	$m_piket->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$m_piket_delete->loadRowValues($m_piket_delete->Recordset);

	// Render row
	$m_piket_delete->renderRow();
?>
	<tr <?php echo $m_piket->rowAttributes() ?>>
<?php if ($m_piket_delete->jenjang->Visible) { // jenjang ?>
		<td <?php echo $m_piket_delete->jenjang->cellAttributes() ?>>
<span id="el<?php echo $m_piket_delete->RowCount ?>_m_piket_jenjang" class="m_piket_jenjang">
<span<?php echo $m_piket_delete->jenjang->viewAttributes() ?>><?php echo $m_piket_delete->jenjang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_piket_delete->type_jabatan->Visible) { // type_jabatan ?>
		<td <?php echo $m_piket_delete->type_jabatan->cellAttributes() ?>>
<span id="el<?php echo $m_piket_delete->RowCount ?>_m_piket_type_jabatan" class="m_piket_type_jabatan">
<span<?php echo $m_piket_delete->type_jabatan->viewAttributes() ?>><?php echo $m_piket_delete->type_jabatan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_piket_delete->jenis_sertif->Visible) { // jenis_sertif ?>
		<td <?php echo $m_piket_delete->jenis_sertif->cellAttributes() ?>>
<span id="el<?php echo $m_piket_delete->RowCount ?>_m_piket_jenis_sertif" class="m_piket_jenis_sertif">
<span<?php echo $m_piket_delete->jenis_sertif->viewAttributes() ?>><?php echo $m_piket_delete->jenis_sertif->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_piket_delete->value->Visible) { // value ?>
		<td <?php echo $m_piket_delete->value->cellAttributes() ?>>
<span id="el<?php echo $m_piket_delete->RowCount ?>_m_piket_value" class="m_piket_value">
<span<?php echo $m_piket_delete->value->viewAttributes() ?>><?php echo $m_piket_delete->value->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$m_piket_delete->Recordset->moveNext();
}
$m_piket_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_piket_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$m_piket_delete->showPageFooter();
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
$m_piket_delete->terminate();
?>