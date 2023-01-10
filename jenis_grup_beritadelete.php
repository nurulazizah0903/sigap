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
$jenis_grup_berita_delete = new jenis_grup_berita_delete();

// Run the page
$jenis_grup_berita_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$jenis_grup_berita_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fjenis_grup_beritadelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fjenis_grup_beritadelete = currentForm = new ew.Form("fjenis_grup_beritadelete", "delete");
	loadjs.done("fjenis_grup_beritadelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $jenis_grup_berita_delete->showPageHeader(); ?>
<?php
$jenis_grup_berita_delete->showMessage();
?>
<form name="fjenis_grup_beritadelete" id="fjenis_grup_beritadelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="jenis_grup_berita">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($jenis_grup_berita_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($jenis_grup_berita_delete->id->Visible) { // id ?>
		<th class="<?php echo $jenis_grup_berita_delete->id->headerCellClass() ?>"><span id="elh_jenis_grup_berita_id" class="jenis_grup_berita_id"><?php echo $jenis_grup_berita_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($jenis_grup_berita_delete->nama->Visible) { // nama ?>
		<th class="<?php echo $jenis_grup_berita_delete->nama->headerCellClass() ?>"><span id="elh_jenis_grup_berita_nama" class="jenis_grup_berita_nama"><?php echo $jenis_grup_berita_delete->nama->caption() ?></span></th>
<?php } ?>
<?php if ($jenis_grup_berita_delete->aktif->Visible) { // aktif ?>
		<th class="<?php echo $jenis_grup_berita_delete->aktif->headerCellClass() ?>"><span id="elh_jenis_grup_berita_aktif" class="jenis_grup_berita_aktif"><?php echo $jenis_grup_berita_delete->aktif->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$jenis_grup_berita_delete->RecordCount = 0;
$i = 0;
while (!$jenis_grup_berita_delete->Recordset->EOF) {
	$jenis_grup_berita_delete->RecordCount++;
	$jenis_grup_berita_delete->RowCount++;

	// Set row properties
	$jenis_grup_berita->resetAttributes();
	$jenis_grup_berita->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$jenis_grup_berita_delete->loadRowValues($jenis_grup_berita_delete->Recordset);

	// Render row
	$jenis_grup_berita_delete->renderRow();
?>
	<tr <?php echo $jenis_grup_berita->rowAttributes() ?>>
<?php if ($jenis_grup_berita_delete->id->Visible) { // id ?>
		<td <?php echo $jenis_grup_berita_delete->id->cellAttributes() ?>>
<span id="el<?php echo $jenis_grup_berita_delete->RowCount ?>_jenis_grup_berita_id" class="jenis_grup_berita_id">
<span<?php echo $jenis_grup_berita_delete->id->viewAttributes() ?>><?php echo $jenis_grup_berita_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($jenis_grup_berita_delete->nama->Visible) { // nama ?>
		<td <?php echo $jenis_grup_berita_delete->nama->cellAttributes() ?>>
<span id="el<?php echo $jenis_grup_berita_delete->RowCount ?>_jenis_grup_berita_nama" class="jenis_grup_berita_nama">
<span<?php echo $jenis_grup_berita_delete->nama->viewAttributes() ?>><?php echo $jenis_grup_berita_delete->nama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($jenis_grup_berita_delete->aktif->Visible) { // aktif ?>
		<td <?php echo $jenis_grup_berita_delete->aktif->cellAttributes() ?>>
<span id="el<?php echo $jenis_grup_berita_delete->RowCount ?>_jenis_grup_berita_aktif" class="jenis_grup_berita_aktif">
<span<?php echo $jenis_grup_berita_delete->aktif->viewAttributes() ?>><?php echo $jenis_grup_berita_delete->aktif->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$jenis_grup_berita_delete->Recordset->moveNext();
}
$jenis_grup_berita_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $jenis_grup_berita_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$jenis_grup_berita_delete->showPageFooter();
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
$jenis_grup_berita_delete->terminate();
?>