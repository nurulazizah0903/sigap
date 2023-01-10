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
$mpendidikan_view = new mpendidikan_view();

// Run the page
$mpendidikan_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$mpendidikan_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$mpendidikan_view->isExport()) { ?>
<script>
var fmpendidikanview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fmpendidikanview = currentForm = new ew.Form("fmpendidikanview", "view");
	loadjs.done("fmpendidikanview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$mpendidikan_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $mpendidikan_view->ExportOptions->render("body") ?>
<?php $mpendidikan_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $mpendidikan_view->showPageHeader(); ?>
<?php
$mpendidikan_view->showMessage();
?>
<form name="fmpendidikanview" id="fmpendidikanview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="mpendidikan">
<input type="hidden" name="modal" value="<?php echo (int)$mpendidikan_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($mpendidikan_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $mpendidikan_view->TableLeftColumnClass ?>"><span id="elh_mpendidikan_id"><?php echo $mpendidikan_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $mpendidikan_view->id->cellAttributes() ?>>
<span id="el_mpendidikan_id">
<span<?php echo $mpendidikan_view->id->viewAttributes() ?>><?php echo $mpendidikan_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($mpendidikan_view->name->Visible) { // name ?>
	<tr id="r_name">
		<td class="<?php echo $mpendidikan_view->TableLeftColumnClass ?>"><span id="elh_mpendidikan_name"><?php echo $mpendidikan_view->name->caption() ?></span></td>
		<td data-name="name" <?php echo $mpendidikan_view->name->cellAttributes() ?>>
<span id="el_mpendidikan_name">
<span<?php echo $mpendidikan_view->name->viewAttributes() ?>><?php echo $mpendidikan_view->name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$mpendidikan_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$mpendidikan_view->isExport()) { ?>
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
$mpendidikan_view->terminate();
?>