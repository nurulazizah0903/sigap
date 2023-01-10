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
$m_sakit_delete = new m_sakit_delete();

// Run the page
$m_sakit_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_sakit_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_sakitdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fm_sakitdelete = currentForm = new ew.Form("fm_sakitdelete", "delete");
	loadjs.done("fm_sakitdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_sakit_delete->showPageHeader(); ?>
<?php
$m_sakit_delete->showMessage();
?>
<form name="fm_sakitdelete" id="fm_sakitdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_sakit">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($m_sakit_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($m_sakit_delete->jenjang_id->Visible) { // jenjang_id ?>
		<th class="<?php echo $m_sakit_delete->jenjang_id->headerCellClass() ?>"><span id="elh_m_sakit_jenjang_id" class="m_sakit_jenjang_id"><?php echo $m_sakit_delete->jenjang_id->caption() ?></span></th>
<?php } ?>
<?php if ($m_sakit_delete->jabatan->Visible) { // jabatan ?>
		<th class="<?php echo $m_sakit_delete->jabatan->headerCellClass() ?>"><span id="elh_m_sakit_jabatan" class="m_sakit_jabatan"><?php echo $m_sakit_delete->jabatan->caption() ?></span></th>
<?php } ?>
<?php if ($m_sakit_delete->perhari->Visible) { // perhari ?>
		<th class="<?php echo $m_sakit_delete->perhari->headerCellClass() ?>"><span id="elh_m_sakit_perhari" class="m_sakit_perhari"><?php echo $m_sakit_delete->perhari->caption() ?></span></th>
<?php } ?>
<?php if ($m_sakit_delete->perjam->Visible) { // perjam ?>
		<th class="<?php echo $m_sakit_delete->perjam->headerCellClass() ?>"><span id="elh_m_sakit_perjam" class="m_sakit_perjam"><?php echo $m_sakit_delete->perjam->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$m_sakit_delete->RecordCount = 0;
$i = 0;
while (!$m_sakit_delete->Recordset->EOF) {
	$m_sakit_delete->RecordCount++;
	$m_sakit_delete->RowCount++;

	// Set row properties
	$m_sakit->resetAttributes();
	$m_sakit->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$m_sakit_delete->loadRowValues($m_sakit_delete->Recordset);

	// Render row
	$m_sakit_delete->renderRow();
?>
	<tr <?php echo $m_sakit->rowAttributes() ?>>
<?php if ($m_sakit_delete->jenjang_id->Visible) { // jenjang_id ?>
		<td <?php echo $m_sakit_delete->jenjang_id->cellAttributes() ?>>
<span id="el<?php echo $m_sakit_delete->RowCount ?>_m_sakit_jenjang_id" class="m_sakit_jenjang_id">
<span<?php echo $m_sakit_delete->jenjang_id->viewAttributes() ?>><?php echo $m_sakit_delete->jenjang_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_sakit_delete->jabatan->Visible) { // jabatan ?>
		<td <?php echo $m_sakit_delete->jabatan->cellAttributes() ?>>
<span id="el<?php echo $m_sakit_delete->RowCount ?>_m_sakit_jabatan" class="m_sakit_jabatan">
<span<?php echo $m_sakit_delete->jabatan->viewAttributes() ?>><?php echo $m_sakit_delete->jabatan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_sakit_delete->perhari->Visible) { // perhari ?>
		<td <?php echo $m_sakit_delete->perhari->cellAttributes() ?>>
<span id="el<?php echo $m_sakit_delete->RowCount ?>_m_sakit_perhari" class="m_sakit_perhari">
<span<?php echo $m_sakit_delete->perhari->viewAttributes() ?>><?php echo $m_sakit_delete->perhari->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_sakit_delete->perjam->Visible) { // perjam ?>
		<td <?php echo $m_sakit_delete->perjam->cellAttributes() ?>>
<span id="el<?php echo $m_sakit_delete->RowCount ?>_m_sakit_perjam" class="m_sakit_perjam">
<span<?php echo $m_sakit_delete->perjam->viewAttributes() ?>><?php echo $m_sakit_delete->perjam->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$m_sakit_delete->Recordset->moveNext();
}
$m_sakit_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_sakit_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$m_sakit_delete->showPageFooter();
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
$m_sakit_delete->terminate();
?>