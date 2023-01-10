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
$agama_view = new agama_view();

// Run the page
$agama_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$agama_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$agama_view->isExport()) { ?>
<script>
var fagamaview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fagamaview = currentForm = new ew.Form("fagamaview", "view");
	loadjs.done("fagamaview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$agama_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $agama_view->ExportOptions->render("body") ?>
<?php $agama_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $agama_view->showPageHeader(); ?>
<?php
$agama_view->showMessage();
?>
<form name="fagamaview" id="fagamaview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="agama">
<input type="hidden" name="modal" value="<?php echo (int)$agama_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($agama_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $agama_view->TableLeftColumnClass ?>"><span id="elh_agama_id"><?php echo $agama_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $agama_view->id->cellAttributes() ?>>
<span id="el_agama_id">
<span<?php echo $agama_view->id->viewAttributes() ?>><?php echo $agama_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($agama_view->name->Visible) { // name ?>
	<tr id="r_name">
		<td class="<?php echo $agama_view->TableLeftColumnClass ?>"><span id="elh_agama_name"><?php echo $agama_view->name->caption() ?></span></td>
		<td data-name="name" <?php echo $agama_view->name->cellAttributes() ?>>
<span id="el_agama_name">
<span<?php echo $agama_view->name->viewAttributes() ?>><?php echo $agama_view->name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$agama_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$agama_view->isExport()) { ?>
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
$agama_view->terminate();
?>