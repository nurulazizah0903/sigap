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
$sertif_view = new sertif_view();

// Run the page
$sertif_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$sertif_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$sertif_view->isExport()) { ?>
<script>
var fsertifview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fsertifview = currentForm = new ew.Form("fsertifview", "view");
	loadjs.done("fsertifview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$sertif_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $sertif_view->ExportOptions->render("body") ?>
<?php $sertif_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $sertif_view->showPageHeader(); ?>
<?php
$sertif_view->showMessage();
?>
<form name="fsertifview" id="fsertifview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="sertif">
<input type="hidden" name="modal" value="<?php echo (int)$sertif_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($sertif_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $sertif_view->TableLeftColumnClass ?>"><span id="elh_sertif_id"><?php echo $sertif_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $sertif_view->id->cellAttributes() ?>>
<span id="el_sertif_id">
<span<?php echo $sertif_view->id->viewAttributes() ?>><?php echo $sertif_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($sertif_view->name->Visible) { // name ?>
	<tr id="r_name">
		<td class="<?php echo $sertif_view->TableLeftColumnClass ?>"><span id="elh_sertif_name"><?php echo $sertif_view->name->caption() ?></span></td>
		<td data-name="name" <?php echo $sertif_view->name->cellAttributes() ?>>
<span id="el_sertif_name">
<span<?php echo $sertif_view->name->viewAttributes() ?>><?php echo $sertif_view->name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$sertif_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$sertif_view->isExport()) { ?>
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
$sertif_view->terminate();
?>