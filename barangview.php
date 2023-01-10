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
$barang_view = new barang_view();

// Run the page
$barang_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$barang_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$barang_view->isExport()) { ?>
<script>
var fbarangview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fbarangview = currentForm = new ew.Form("fbarangview", "view");
	loadjs.done("fbarangview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$barang_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $barang_view->ExportOptions->render("body") ?>
<?php $barang_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $barang_view->showPageHeader(); ?>
<?php
$barang_view->showMessage();
?>
<form name="fbarangview" id="fbarangview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="barang">
<input type="hidden" name="modal" value="<?php echo (int)$barang_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($barang_view->Kode_Barang->Visible) { // Kode_Barang ?>
	<tr id="r_Kode_Barang">
		<td class="<?php echo $barang_view->TableLeftColumnClass ?>"><span id="elh_barang_Kode_Barang"><?php echo $barang_view->Kode_Barang->caption() ?></span></td>
		<td data-name="Kode_Barang" <?php echo $barang_view->Kode_Barang->cellAttributes() ?>>
<span id="el_barang_Kode_Barang">
<span<?php echo $barang_view->Kode_Barang->viewAttributes() ?>><?php echo $barang_view->Kode_Barang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($barang_view->Nama_Barang->Visible) { // Nama_Barang ?>
	<tr id="r_Nama_Barang">
		<td class="<?php echo $barang_view->TableLeftColumnClass ?>"><span id="elh_barang_Nama_Barang"><?php echo $barang_view->Nama_Barang->caption() ?></span></td>
		<td data-name="Nama_Barang" <?php echo $barang_view->Nama_Barang->cellAttributes() ?>>
<span id="el_barang_Nama_Barang">
<span<?php echo $barang_view->Nama_Barang->viewAttributes() ?>><?php echo $barang_view->Nama_Barang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$barang_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$barang_view->isExport()) { ?>
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
$barang_view->terminate();
?>