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
$setuju_view = new setuju_view();

// Run the page
$setuju_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$setuju_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$setuju_view->isExport()) { ?>
<script>
var fsetujuview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fsetujuview = currentForm = new ew.Form("fsetujuview", "view");
	loadjs.done("fsetujuview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$setuju_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $setuju_view->ExportOptions->render("body") ?>
<?php $setuju_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $setuju_view->showPageHeader(); ?>
<?php
$setuju_view->showMessage();
?>
<form name="fsetujuview" id="fsetujuview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="setuju">
<input type="hidden" name="modal" value="<?php echo (int)$setuju_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($setuju_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $setuju_view->TableLeftColumnClass ?>"><span id="elh_setuju_id"><?php echo $setuju_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $setuju_view->id->cellAttributes() ?>>
<span id="el_setuju_id">
<span<?php echo $setuju_view->id->viewAttributes() ?>><?php echo $setuju_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($setuju_view->name->Visible) { // name ?>
	<tr id="r_name">
		<td class="<?php echo $setuju_view->TableLeftColumnClass ?>"><span id="elh_setuju_name"><?php echo $setuju_view->name->caption() ?></span></td>
		<td data-name="name" <?php echo $setuju_view->name->cellAttributes() ?>>
<span id="el_setuju_name">
<span<?php echo $setuju_view->name->viewAttributes() ?>><?php echo $setuju_view->name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$setuju_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$setuju_view->isExport()) { ?>
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
$setuju_view->terminate();
?>