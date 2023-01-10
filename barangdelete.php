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
$barang_delete = new barang_delete();

// Run the page
$barang_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$barang_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fbarangdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fbarangdelete = currentForm = new ew.Form("fbarangdelete", "delete");
	loadjs.done("fbarangdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $barang_delete->showPageHeader(); ?>
<?php
$barang_delete->showMessage();
?>
<form name="fbarangdelete" id="fbarangdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="barang">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($barang_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($barang_delete->Kode_Barang->Visible) { // Kode_Barang ?>
		<th class="<?php echo $barang_delete->Kode_Barang->headerCellClass() ?>"><span id="elh_barang_Kode_Barang" class="barang_Kode_Barang"><?php echo $barang_delete->Kode_Barang->caption() ?></span></th>
<?php } ?>
<?php if ($barang_delete->Nama_Barang->Visible) { // Nama_Barang ?>
		<th class="<?php echo $barang_delete->Nama_Barang->headerCellClass() ?>"><span id="elh_barang_Nama_Barang" class="barang_Nama_Barang"><?php echo $barang_delete->Nama_Barang->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$barang_delete->RecordCount = 0;
$i = 0;
while (!$barang_delete->Recordset->EOF) {
	$barang_delete->RecordCount++;
	$barang_delete->RowCount++;

	// Set row properties
	$barang->resetAttributes();
	$barang->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$barang_delete->loadRowValues($barang_delete->Recordset);

	// Render row
	$barang_delete->renderRow();
?>
	<tr <?php echo $barang->rowAttributes() ?>>
<?php if ($barang_delete->Kode_Barang->Visible) { // Kode_Barang ?>
		<td <?php echo $barang_delete->Kode_Barang->cellAttributes() ?>>
<span id="el<?php echo $barang_delete->RowCount ?>_barang_Kode_Barang" class="barang_Kode_Barang">
<span<?php echo $barang_delete->Kode_Barang->viewAttributes() ?>><?php echo $barang_delete->Kode_Barang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($barang_delete->Nama_Barang->Visible) { // Nama_Barang ?>
		<td <?php echo $barang_delete->Nama_Barang->cellAttributes() ?>>
<span id="el<?php echo $barang_delete->RowCount ?>_barang_Nama_Barang" class="barang_Nama_Barang">
<span<?php echo $barang_delete->Nama_Barang->viewAttributes() ?>><?php echo $barang_delete->Nama_Barang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$barang_delete->Recordset->moveNext();
}
$barang_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $barang_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$barang_delete->showPageFooter();
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
$barang_delete->terminate();
?>