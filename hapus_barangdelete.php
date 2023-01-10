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
$hapus_barang_delete = new hapus_barang_delete();

// Run the page
$hapus_barang_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$hapus_barang_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fhapus_barangdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fhapus_barangdelete = currentForm = new ew.Form("fhapus_barangdelete", "delete");
	loadjs.done("fhapus_barangdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $hapus_barang_delete->showPageHeader(); ?>
<?php
$hapus_barang_delete->showMessage();
?>
<form name="fhapus_barangdelete" id="fhapus_barangdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="hapus_barang">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($hapus_barang_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($hapus_barang_delete->ID_Hapus->Visible) { // ID_Hapus ?>
		<th class="<?php echo $hapus_barang_delete->ID_Hapus->headerCellClass() ?>"><span id="elh_hapus_barang_ID_Hapus" class="hapus_barang_ID_Hapus"><?php echo $hapus_barang_delete->ID_Hapus->caption() ?></span></th>
<?php } ?>
<?php if ($hapus_barang_delete->Kode_Barang->Visible) { // Kode_Barang ?>
		<th class="<?php echo $hapus_barang_delete->Kode_Barang->headerCellClass() ?>"><span id="elh_hapus_barang_Kode_Barang" class="hapus_barang_Kode_Barang"><?php echo $hapus_barang_delete->Kode_Barang->caption() ?></span></th>
<?php } ?>
<?php if ($hapus_barang_delete->Nama_Barang->Visible) { // Nama_Barang ?>
		<th class="<?php echo $hapus_barang_delete->Nama_Barang->headerCellClass() ?>"><span id="elh_hapus_barang_Nama_Barang" class="hapus_barang_Nama_Barang"><?php echo $hapus_barang_delete->Nama_Barang->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$hapus_barang_delete->RecordCount = 0;
$i = 0;
while (!$hapus_barang_delete->Recordset->EOF) {
	$hapus_barang_delete->RecordCount++;
	$hapus_barang_delete->RowCount++;

	// Set row properties
	$hapus_barang->resetAttributes();
	$hapus_barang->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$hapus_barang_delete->loadRowValues($hapus_barang_delete->Recordset);

	// Render row
	$hapus_barang_delete->renderRow();
?>
	<tr <?php echo $hapus_barang->rowAttributes() ?>>
<?php if ($hapus_barang_delete->ID_Hapus->Visible) { // ID_Hapus ?>
		<td <?php echo $hapus_barang_delete->ID_Hapus->cellAttributes() ?>>
<span id="el<?php echo $hapus_barang_delete->RowCount ?>_hapus_barang_ID_Hapus" class="hapus_barang_ID_Hapus">
<span<?php echo $hapus_barang_delete->ID_Hapus->viewAttributes() ?>><?php echo $hapus_barang_delete->ID_Hapus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($hapus_barang_delete->Kode_Barang->Visible) { // Kode_Barang ?>
		<td <?php echo $hapus_barang_delete->Kode_Barang->cellAttributes() ?>>
<span id="el<?php echo $hapus_barang_delete->RowCount ?>_hapus_barang_Kode_Barang" class="hapus_barang_Kode_Barang">
<span<?php echo $hapus_barang_delete->Kode_Barang->viewAttributes() ?>><?php echo $hapus_barang_delete->Kode_Barang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($hapus_barang_delete->Nama_Barang->Visible) { // Nama_Barang ?>
		<td <?php echo $hapus_barang_delete->Nama_Barang->cellAttributes() ?>>
<span id="el<?php echo $hapus_barang_delete->RowCount ?>_hapus_barang_Nama_Barang" class="hapus_barang_Nama_Barang">
<span<?php echo $hapus_barang_delete->Nama_Barang->viewAttributes() ?>><?php echo $hapus_barang_delete->Nama_Barang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$hapus_barang_delete->Recordset->moveNext();
}
$hapus_barang_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $hapus_barang_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$hapus_barang_delete->showPageFooter();
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
$hapus_barang_delete->terminate();
?>