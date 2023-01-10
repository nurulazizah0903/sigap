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
$jenis_barang_view = new jenis_barang_view();

// Run the page
$jenis_barang_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$jenis_barang_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$jenis_barang_view->isExport()) { ?>
<script>
var fjenis_barangview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fjenis_barangview = currentForm = new ew.Form("fjenis_barangview", "view");
	loadjs.done("fjenis_barangview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$jenis_barang_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $jenis_barang_view->ExportOptions->render("body") ?>
<?php $jenis_barang_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $jenis_barang_view->showPageHeader(); ?>
<?php
$jenis_barang_view->showMessage();
?>
<form name="fjenis_barangview" id="fjenis_barangview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="jenis_barang">
<input type="hidden" name="modal" value="<?php echo (int)$jenis_barang_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($jenis_barang_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $jenis_barang_view->TableLeftColumnClass ?>"><span id="elh_jenis_barang_id"><?php echo $jenis_barang_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $jenis_barang_view->id->cellAttributes() ?>>
<span id="el_jenis_barang_id">
<span<?php echo $jenis_barang_view->id->viewAttributes() ?>><?php echo $jenis_barang_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($jenis_barang_view->nama->Visible) { // nama ?>
	<tr id="r_nama">
		<td class="<?php echo $jenis_barang_view->TableLeftColumnClass ?>"><span id="elh_jenis_barang_nama"><?php echo $jenis_barang_view->nama->caption() ?></span></td>
		<td data-name="nama" <?php echo $jenis_barang_view->nama->cellAttributes() ?>>
<span id="el_jenis_barang_nama">
<span<?php echo $jenis_barang_view->nama->viewAttributes() ?>><?php echo $jenis_barang_view->nama->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($jenis_barang_view->aktif->Visible) { // aktif ?>
	<tr id="r_aktif">
		<td class="<?php echo $jenis_barang_view->TableLeftColumnClass ?>"><span id="elh_jenis_barang_aktif"><?php echo $jenis_barang_view->aktif->caption() ?></span></td>
		<td data-name="aktif" <?php echo $jenis_barang_view->aktif->cellAttributes() ?>>
<span id="el_jenis_barang_aktif">
<span<?php echo $jenis_barang_view->aktif->viewAttributes() ?>><?php echo $jenis_barang_view->aktif->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$jenis_barang_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$jenis_barang_view->isExport()) { ?>
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
$jenis_barang_view->terminate();
?>