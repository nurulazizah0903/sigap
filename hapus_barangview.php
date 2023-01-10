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
$hapus_barang_view = new hapus_barang_view();

// Run the page
$hapus_barang_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$hapus_barang_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$hapus_barang_view->isExport()) { ?>
<script>
var fhapus_barangview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fhapus_barangview = currentForm = new ew.Form("fhapus_barangview", "view");
	loadjs.done("fhapus_barangview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$hapus_barang_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $hapus_barang_view->ExportOptions->render("body") ?>
<?php $hapus_barang_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $hapus_barang_view->showPageHeader(); ?>
<?php
$hapus_barang_view->showMessage();
?>
<form name="fhapus_barangview" id="fhapus_barangview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="hapus_barang">
<input type="hidden" name="modal" value="<?php echo (int)$hapus_barang_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($hapus_barang_view->ID_Hapus->Visible) { // ID_Hapus ?>
	<tr id="r_ID_Hapus">
		<td class="<?php echo $hapus_barang_view->TableLeftColumnClass ?>"><span id="elh_hapus_barang_ID_Hapus"><?php echo $hapus_barang_view->ID_Hapus->caption() ?></span></td>
		<td data-name="ID_Hapus" <?php echo $hapus_barang_view->ID_Hapus->cellAttributes() ?>>
<span id="el_hapus_barang_ID_Hapus">
<span<?php echo $hapus_barang_view->ID_Hapus->viewAttributes() ?>><?php echo $hapus_barang_view->ID_Hapus->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($hapus_barang_view->Kode_Barang->Visible) { // Kode_Barang ?>
	<tr id="r_Kode_Barang">
		<td class="<?php echo $hapus_barang_view->TableLeftColumnClass ?>"><span id="elh_hapus_barang_Kode_Barang"><?php echo $hapus_barang_view->Kode_Barang->caption() ?></span></td>
		<td data-name="Kode_Barang" <?php echo $hapus_barang_view->Kode_Barang->cellAttributes() ?>>
<span id="el_hapus_barang_Kode_Barang">
<span<?php echo $hapus_barang_view->Kode_Barang->viewAttributes() ?>><?php echo $hapus_barang_view->Kode_Barang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($hapus_barang_view->Nama_Barang->Visible) { // Nama_Barang ?>
	<tr id="r_Nama_Barang">
		<td class="<?php echo $hapus_barang_view->TableLeftColumnClass ?>"><span id="elh_hapus_barang_Nama_Barang"><?php echo $hapus_barang_view->Nama_Barang->caption() ?></span></td>
		<td data-name="Nama_Barang" <?php echo $hapus_barang_view->Nama_Barang->cellAttributes() ?>>
<span id="el_hapus_barang_Nama_Barang">
<span<?php echo $hapus_barang_view->Nama_Barang->viewAttributes() ?>><?php echo $hapus_barang_view->Nama_Barang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($hapus_barang_view->Keterangan->Visible) { // Keterangan ?>
	<tr id="r_Keterangan">
		<td class="<?php echo $hapus_barang_view->TableLeftColumnClass ?>"><span id="elh_hapus_barang_Keterangan"><?php echo $hapus_barang_view->Keterangan->caption() ?></span></td>
		<td data-name="Keterangan" <?php echo $hapus_barang_view->Keterangan->cellAttributes() ?>>
<span id="el_hapus_barang_Keterangan">
<span<?php echo $hapus_barang_view->Keterangan->viewAttributes() ?>><?php echo $hapus_barang_view->Keterangan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$hapus_barang_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$hapus_barang_view->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$hapus_barang_view->terminate();
?>