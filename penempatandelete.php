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
$penempatan_delete = new penempatan_delete();

// Run the page
$penempatan_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$penempatan_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpenempatandelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fpenempatandelete = currentForm = new ew.Form("fpenempatandelete", "delete");
	loadjs.done("fpenempatandelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $penempatan_delete->showPageHeader(); ?>
<?php
$penempatan_delete->showMessage();
?>
<form name="fpenempatandelete" id="fpenempatandelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="penempatan">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($penempatan_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($penempatan_delete->pegawai->Visible) { // pegawai ?>
		<th class="<?php echo $penempatan_delete->pegawai->headerCellClass() ?>"><span id="elh_penempatan_pegawai" class="penempatan_pegawai"><?php echo $penempatan_delete->pegawai->caption() ?></span></th>
<?php } ?>
<?php if ($penempatan_delete->project->Visible) { // project ?>
		<th class="<?php echo $penempatan_delete->project->headerCellClass() ?>"><span id="elh_penempatan_project" class="penempatan_project"><?php echo $penempatan_delete->project->caption() ?></span></th>
<?php } ?>
<?php if ($penempatan_delete->jabatan->Visible) { // jabatan ?>
		<th class="<?php echo $penempatan_delete->jabatan->headerCellClass() ?>"><span id="elh_penempatan_jabatan" class="penempatan_jabatan"><?php echo $penempatan_delete->jabatan->caption() ?></span></th>
<?php } ?>
<?php if ($penempatan_delete->tgl_mulai->Visible) { // tgl_mulai ?>
		<th class="<?php echo $penempatan_delete->tgl_mulai->headerCellClass() ?>"><span id="elh_penempatan_tgl_mulai" class="penempatan_tgl_mulai"><?php echo $penempatan_delete->tgl_mulai->caption() ?></span></th>
<?php } ?>
<?php if ($penempatan_delete->tgl_akhir->Visible) { // tgl_akhir ?>
		<th class="<?php echo $penempatan_delete->tgl_akhir->headerCellClass() ?>"><span id="elh_penempatan_tgl_akhir" class="penempatan_tgl_akhir"><?php echo $penempatan_delete->tgl_akhir->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$penempatan_delete->RecordCount = 0;
$i = 0;
while (!$penempatan_delete->Recordset->EOF) {
	$penempatan_delete->RecordCount++;
	$penempatan_delete->RowCount++;

	// Set row properties
	$penempatan->resetAttributes();
	$penempatan->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$penempatan_delete->loadRowValues($penempatan_delete->Recordset);

	// Render row
	$penempatan_delete->renderRow();
?>
	<tr <?php echo $penempatan->rowAttributes() ?>>
<?php if ($penempatan_delete->pegawai->Visible) { // pegawai ?>
		<td <?php echo $penempatan_delete->pegawai->cellAttributes() ?>>
<span id="el<?php echo $penempatan_delete->RowCount ?>_penempatan_pegawai" class="penempatan_pegawai">
<span<?php echo $penempatan_delete->pegawai->viewAttributes() ?>><?php echo $penempatan_delete->pegawai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($penempatan_delete->project->Visible) { // project ?>
		<td <?php echo $penempatan_delete->project->cellAttributes() ?>>
<span id="el<?php echo $penempatan_delete->RowCount ?>_penempatan_project" class="penempatan_project">
<span<?php echo $penempatan_delete->project->viewAttributes() ?>><?php echo $penempatan_delete->project->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($penempatan_delete->jabatan->Visible) { // jabatan ?>
		<td <?php echo $penempatan_delete->jabatan->cellAttributes() ?>>
<span id="el<?php echo $penempatan_delete->RowCount ?>_penempatan_jabatan" class="penempatan_jabatan">
<span<?php echo $penempatan_delete->jabatan->viewAttributes() ?>><?php echo $penempatan_delete->jabatan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($penempatan_delete->tgl_mulai->Visible) { // tgl_mulai ?>
		<td <?php echo $penempatan_delete->tgl_mulai->cellAttributes() ?>>
<span id="el<?php echo $penempatan_delete->RowCount ?>_penempatan_tgl_mulai" class="penempatan_tgl_mulai">
<span<?php echo $penempatan_delete->tgl_mulai->viewAttributes() ?>><?php echo $penempatan_delete->tgl_mulai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($penempatan_delete->tgl_akhir->Visible) { // tgl_akhir ?>
		<td <?php echo $penempatan_delete->tgl_akhir->cellAttributes() ?>>
<span id="el<?php echo $penempatan_delete->RowCount ?>_penempatan_tgl_akhir" class="penempatan_tgl_akhir">
<span<?php echo $penempatan_delete->tgl_akhir->viewAttributes() ?>><?php echo $penempatan_delete->tgl_akhir->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$penempatan_delete->Recordset->moveNext();
}
$penempatan_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $penempatan_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$penempatan_delete->showPageFooter();
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
$penempatan_delete->terminate();
?>