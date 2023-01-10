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
$jenis_ijin_delete = new jenis_ijin_delete();

// Run the page
$jenis_ijin_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$jenis_ijin_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fjenis_ijindelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fjenis_ijindelete = currentForm = new ew.Form("fjenis_ijindelete", "delete");
	loadjs.done("fjenis_ijindelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $jenis_ijin_delete->showPageHeader(); ?>
<?php
$jenis_ijin_delete->showMessage();
?>
<form name="fjenis_ijindelete" id="fjenis_ijindelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="jenis_ijin">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($jenis_ijin_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($jenis_ijin_delete->id->Visible) { // id ?>
		<th class="<?php echo $jenis_ijin_delete->id->headerCellClass() ?>"><span id="elh_jenis_ijin_id" class="jenis_ijin_id"><?php echo $jenis_ijin_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($jenis_ijin_delete->nama->Visible) { // nama ?>
		<th class="<?php echo $jenis_ijin_delete->nama->headerCellClass() ?>"><span id="elh_jenis_ijin_nama" class="jenis_ijin_nama"><?php echo $jenis_ijin_delete->nama->caption() ?></span></th>
<?php } ?>
<?php if ($jenis_ijin_delete->aktif->Visible) { // aktif ?>
		<th class="<?php echo $jenis_ijin_delete->aktif->headerCellClass() ?>"><span id="elh_jenis_ijin_aktif" class="jenis_ijin_aktif"><?php echo $jenis_ijin_delete->aktif->caption() ?></span></th>
<?php } ?>
<?php if ($jenis_ijin_delete->value->Visible) { // value ?>
		<th class="<?php echo $jenis_ijin_delete->value->headerCellClass() ?>"><span id="elh_jenis_ijin_value" class="jenis_ijin_value"><?php echo $jenis_ijin_delete->value->caption() ?></span></th>
<?php } ?>
<?php if ($jenis_ijin_delete->valueperjam->Visible) { // valueperjam ?>
		<th class="<?php echo $jenis_ijin_delete->valueperjam->headerCellClass() ?>"><span id="elh_jenis_ijin_valueperjam" class="jenis_ijin_valueperjam"><?php echo $jenis_ijin_delete->valueperjam->caption() ?></span></th>
<?php } ?>
<?php if ($jenis_ijin_delete->jabatan_id->Visible) { // jabatan_id ?>
		<th class="<?php echo $jenis_ijin_delete->jabatan_id->headerCellClass() ?>"><span id="elh_jenis_ijin_jabatan_id" class="jenis_ijin_jabatan_id"><?php echo $jenis_ijin_delete->jabatan_id->caption() ?></span></th>
<?php } ?>
<?php if ($jenis_ijin_delete->jenjang_id->Visible) { // jenjang_id ?>
		<th class="<?php echo $jenis_ijin_delete->jenjang_id->headerCellClass() ?>"><span id="elh_jenis_ijin_jenjang_id" class="jenis_ijin_jenjang_id"><?php echo $jenis_ijin_delete->jenjang_id->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$jenis_ijin_delete->RecordCount = 0;
$i = 0;
while (!$jenis_ijin_delete->Recordset->EOF) {
	$jenis_ijin_delete->RecordCount++;
	$jenis_ijin_delete->RowCount++;

	// Set row properties
	$jenis_ijin->resetAttributes();
	$jenis_ijin->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$jenis_ijin_delete->loadRowValues($jenis_ijin_delete->Recordset);

	// Render row
	$jenis_ijin_delete->renderRow();
?>
	<tr <?php echo $jenis_ijin->rowAttributes() ?>>
<?php if ($jenis_ijin_delete->id->Visible) { // id ?>
		<td <?php echo $jenis_ijin_delete->id->cellAttributes() ?>>
<span id="el<?php echo $jenis_ijin_delete->RowCount ?>_jenis_ijin_id" class="jenis_ijin_id">
<span<?php echo $jenis_ijin_delete->id->viewAttributes() ?>><?php echo $jenis_ijin_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($jenis_ijin_delete->nama->Visible) { // nama ?>
		<td <?php echo $jenis_ijin_delete->nama->cellAttributes() ?>>
<span id="el<?php echo $jenis_ijin_delete->RowCount ?>_jenis_ijin_nama" class="jenis_ijin_nama">
<span<?php echo $jenis_ijin_delete->nama->viewAttributes() ?>><?php echo $jenis_ijin_delete->nama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($jenis_ijin_delete->aktif->Visible) { // aktif ?>
		<td <?php echo $jenis_ijin_delete->aktif->cellAttributes() ?>>
<span id="el<?php echo $jenis_ijin_delete->RowCount ?>_jenis_ijin_aktif" class="jenis_ijin_aktif">
<span<?php echo $jenis_ijin_delete->aktif->viewAttributes() ?>><?php echo $jenis_ijin_delete->aktif->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($jenis_ijin_delete->value->Visible) { // value ?>
		<td <?php echo $jenis_ijin_delete->value->cellAttributes() ?>>
<span id="el<?php echo $jenis_ijin_delete->RowCount ?>_jenis_ijin_value" class="jenis_ijin_value">
<span<?php echo $jenis_ijin_delete->value->viewAttributes() ?>><?php echo $jenis_ijin_delete->value->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($jenis_ijin_delete->valueperjam->Visible) { // valueperjam ?>
		<td <?php echo $jenis_ijin_delete->valueperjam->cellAttributes() ?>>
<span id="el<?php echo $jenis_ijin_delete->RowCount ?>_jenis_ijin_valueperjam" class="jenis_ijin_valueperjam">
<span<?php echo $jenis_ijin_delete->valueperjam->viewAttributes() ?>><?php echo $jenis_ijin_delete->valueperjam->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($jenis_ijin_delete->jabatan_id->Visible) { // jabatan_id ?>
		<td <?php echo $jenis_ijin_delete->jabatan_id->cellAttributes() ?>>
<span id="el<?php echo $jenis_ijin_delete->RowCount ?>_jenis_ijin_jabatan_id" class="jenis_ijin_jabatan_id">
<span<?php echo $jenis_ijin_delete->jabatan_id->viewAttributes() ?>><?php echo $jenis_ijin_delete->jabatan_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($jenis_ijin_delete->jenjang_id->Visible) { // jenjang_id ?>
		<td <?php echo $jenis_ijin_delete->jenjang_id->cellAttributes() ?>>
<span id="el<?php echo $jenis_ijin_delete->RowCount ?>_jenis_ijin_jenjang_id" class="jenis_ijin_jenjang_id">
<span<?php echo $jenis_ijin_delete->jenjang_id->viewAttributes() ?>><?php echo $jenis_ijin_delete->jenjang_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$jenis_ijin_delete->Recordset->moveNext();
}
$jenis_ijin_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $jenis_ijin_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$jenis_ijin_delete->showPageFooter();
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
$jenis_ijin_delete->terminate();
?>