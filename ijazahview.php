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
$ijazah_view = new ijazah_view();

// Run the page
$ijazah_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ijazah_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$ijazah_view->isExport()) { ?>
<script>
var fijazahview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fijazahview = currentForm = new ew.Form("fijazahview", "view");
	loadjs.done("fijazahview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$ijazah_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $ijazah_view->ExportOptions->render("body") ?>
<?php $ijazah_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $ijazah_view->showPageHeader(); ?>
<?php
$ijazah_view->showMessage();
?>
<form name="fijazahview" id="fijazahview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ijazah">
<input type="hidden" name="modal" value="<?php echo (int)$ijazah_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($ijazah_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $ijazah_view->TableLeftColumnClass ?>"><span id="elh_ijazah_id"><?php echo $ijazah_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $ijazah_view->id->cellAttributes() ?>>
<span id="el_ijazah_id">
<span<?php echo $ijazah_view->id->viewAttributes() ?>><?php echo $ijazah_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ijazah_view->name->Visible) { // name ?>
	<tr id="r_name">
		<td class="<?php echo $ijazah_view->TableLeftColumnClass ?>"><span id="elh_ijazah_name"><?php echo $ijazah_view->name->caption() ?></span></td>
		<td data-name="name" <?php echo $ijazah_view->name->cellAttributes() ?>>
<span id="el_ijazah_name">
<span<?php echo $ijazah_view->name->viewAttributes() ?>><?php echo $ijazah_view->name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$ijazah_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$ijazah_view->isExport()) { ?>
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
$ijazah_view->terminate();
?>