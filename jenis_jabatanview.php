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
$jenis_jabatan_view = new jenis_jabatan_view();

// Run the page
$jenis_jabatan_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$jenis_jabatan_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$jenis_jabatan_view->isExport()) { ?>
<script>
var fjenis_jabatanview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fjenis_jabatanview = currentForm = new ew.Form("fjenis_jabatanview", "view");
	loadjs.done("fjenis_jabatanview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$jenis_jabatan_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $jenis_jabatan_view->ExportOptions->render("body") ?>
<?php $jenis_jabatan_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $jenis_jabatan_view->showPageHeader(); ?>
<?php
$jenis_jabatan_view->showMessage();
?>
<form name="fjenis_jabatanview" id="fjenis_jabatanview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="jenis_jabatan">
<input type="hidden" name="modal" value="<?php echo (int)$jenis_jabatan_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($jenis_jabatan_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $jenis_jabatan_view->TableLeftColumnClass ?>"><span id="elh_jenis_jabatan_id"><?php echo $jenis_jabatan_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $jenis_jabatan_view->id->cellAttributes() ?>>
<span id="el_jenis_jabatan_id">
<span<?php echo $jenis_jabatan_view->id->viewAttributes() ?>><?php echo $jenis_jabatan_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($jenis_jabatan_view->name->Visible) { // name ?>
	<tr id="r_name">
		<td class="<?php echo $jenis_jabatan_view->TableLeftColumnClass ?>"><span id="elh_jenis_jabatan_name"><?php echo $jenis_jabatan_view->name->caption() ?></span></td>
		<td data-name="name" <?php echo $jenis_jabatan_view->name->cellAttributes() ?>>
<span id="el_jenis_jabatan_name">
<span<?php echo $jenis_jabatan_view->name->viewAttributes() ?>><?php echo $jenis_jabatan_view->name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$jenis_jabatan_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$jenis_jabatan_view->isExport()) { ?>
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
$jenis_jabatan_view->terminate();
?>