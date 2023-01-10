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
$proyek_delete = new proyek_delete();

// Run the page
$proyek_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$proyek_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fproyekdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fproyekdelete = currentForm = new ew.Form("fproyekdelete", "delete");
	loadjs.done("fproyekdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $proyek_delete->showPageHeader(); ?>
<?php
$proyek_delete->showMessage();
?>
<form name="fproyekdelete" id="fproyekdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="proyek">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($proyek_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($proyek_delete->id->Visible) { // id ?>
		<th class="<?php echo $proyek_delete->id->headerCellClass() ?>"><span id="elh_proyek_id" class="proyek_id"><?php echo $proyek_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($proyek_delete->klien->Visible) { // klien ?>
		<th class="<?php echo $proyek_delete->klien->headerCellClass() ?>"><span id="elh_proyek_klien" class="proyek_klien"><?php echo $proyek_delete->klien->caption() ?></span></th>
<?php } ?>
<?php if ($proyek_delete->proyek->Visible) { // proyek ?>
		<th class="<?php echo $proyek_delete->proyek->headerCellClass() ?>"><span id="elh_proyek_proyek" class="proyek_proyek"><?php echo $proyek_delete->proyek->caption() ?></span></th>
<?php } ?>
<?php if ($proyek_delete->tgl_awal->Visible) { // tgl_awal ?>
		<th class="<?php echo $proyek_delete->tgl_awal->headerCellClass() ?>"><span id="elh_proyek_tgl_awal" class="proyek_tgl_awal"><?php echo $proyek_delete->tgl_awal->caption() ?></span></th>
<?php } ?>
<?php if ($proyek_delete->tgl_akhir->Visible) { // tgl_akhir ?>
		<th class="<?php echo $proyek_delete->tgl_akhir->headerCellClass() ?>"><span id="elh_proyek_tgl_akhir" class="proyek_tgl_akhir"><?php echo $proyek_delete->tgl_akhir->caption() ?></span></th>
<?php } ?>
<?php if ($proyek_delete->file_proyek->Visible) { // file_proyek ?>
		<th class="<?php echo $proyek_delete->file_proyek->headerCellClass() ?>"><span id="elh_proyek_file_proyek" class="proyek_file_proyek"><?php echo $proyek_delete->file_proyek->caption() ?></span></th>
<?php } ?>
<?php if ($proyek_delete->aktif->Visible) { // aktif ?>
		<th class="<?php echo $proyek_delete->aktif->headerCellClass() ?>"><span id="elh_proyek_aktif" class="proyek_aktif"><?php echo $proyek_delete->aktif->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$proyek_delete->RecordCount = 0;
$i = 0;
while (!$proyek_delete->Recordset->EOF) {
	$proyek_delete->RecordCount++;
	$proyek_delete->RowCount++;

	// Set row properties
	$proyek->resetAttributes();
	$proyek->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$proyek_delete->loadRowValues($proyek_delete->Recordset);

	// Render row
	$proyek_delete->renderRow();
?>
	<tr <?php echo $proyek->rowAttributes() ?>>
<?php if ($proyek_delete->id->Visible) { // id ?>
		<td <?php echo $proyek_delete->id->cellAttributes() ?>>
<span id="el<?php echo $proyek_delete->RowCount ?>_proyek_id" class="proyek_id">
<span<?php echo $proyek_delete->id->viewAttributes() ?>><?php echo $proyek_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($proyek_delete->klien->Visible) { // klien ?>
		<td <?php echo $proyek_delete->klien->cellAttributes() ?>>
<span id="el<?php echo $proyek_delete->RowCount ?>_proyek_klien" class="proyek_klien">
<span<?php echo $proyek_delete->klien->viewAttributes() ?>><?php echo $proyek_delete->klien->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($proyek_delete->proyek->Visible) { // proyek ?>
		<td <?php echo $proyek_delete->proyek->cellAttributes() ?>>
<span id="el<?php echo $proyek_delete->RowCount ?>_proyek_proyek" class="proyek_proyek">
<span<?php echo $proyek_delete->proyek->viewAttributes() ?>><?php echo $proyek_delete->proyek->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($proyek_delete->tgl_awal->Visible) { // tgl_awal ?>
		<td <?php echo $proyek_delete->tgl_awal->cellAttributes() ?>>
<span id="el<?php echo $proyek_delete->RowCount ?>_proyek_tgl_awal" class="proyek_tgl_awal">
<span<?php echo $proyek_delete->tgl_awal->viewAttributes() ?>><?php echo $proyek_delete->tgl_awal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($proyek_delete->tgl_akhir->Visible) { // tgl_akhir ?>
		<td <?php echo $proyek_delete->tgl_akhir->cellAttributes() ?>>
<span id="el<?php echo $proyek_delete->RowCount ?>_proyek_tgl_akhir" class="proyek_tgl_akhir">
<span<?php echo $proyek_delete->tgl_akhir->viewAttributes() ?>><?php echo $proyek_delete->tgl_akhir->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($proyek_delete->file_proyek->Visible) { // file_proyek ?>
		<td <?php echo $proyek_delete->file_proyek->cellAttributes() ?>>
<span id="el<?php echo $proyek_delete->RowCount ?>_proyek_file_proyek" class="proyek_file_proyek">
<span<?php echo $proyek_delete->file_proyek->viewAttributes() ?>><?php echo GetFileViewTag($proyek_delete->file_proyek, $proyek_delete->file_proyek->getViewValue(), FALSE) ?></span>
</span>
</td>
<?php } ?>
<?php if ($proyek_delete->aktif->Visible) { // aktif ?>
		<td <?php echo $proyek_delete->aktif->cellAttributes() ?>>
<span id="el<?php echo $proyek_delete->RowCount ?>_proyek_aktif" class="proyek_aktif">
<span<?php echo $proyek_delete->aktif->viewAttributes() ?>><?php echo $proyek_delete->aktif->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$proyek_delete->Recordset->moveNext();
}
$proyek_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $proyek_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$proyek_delete->showPageFooter();
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
$proyek_delete->terminate();
?>