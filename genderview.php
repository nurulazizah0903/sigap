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
$gender_view = new gender_view();

// Run the page
$gender_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gender_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$gender_view->isExport()) { ?>
<script>
var fgenderview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fgenderview = currentForm = new ew.Form("fgenderview", "view");
	loadjs.done("fgenderview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$gender_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $gender_view->ExportOptions->render("body") ?>
<?php $gender_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $gender_view->showPageHeader(); ?>
<?php
$gender_view->showMessage();
?>
<form name="fgenderview" id="fgenderview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gender">
<input type="hidden" name="modal" value="<?php echo (int)$gender_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($gender_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $gender_view->TableLeftColumnClass ?>"><span id="elh_gender_id"><?php echo $gender_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $gender_view->id->cellAttributes() ?>>
<span id="el_gender_id">
<span<?php echo $gender_view->id->viewAttributes() ?>><?php echo $gender_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gender_view->gen->Visible) { // gen ?>
	<tr id="r_gen">
		<td class="<?php echo $gender_view->TableLeftColumnClass ?>"><span id="elh_gender_gen"><?php echo $gender_view->gen->caption() ?></span></td>
		<td data-name="gen" <?php echo $gender_view->gen->cellAttributes() ?>>
<span id="el_gender_gen">
<span<?php echo $gender_view->gen->viewAttributes() ?>><?php echo $gender_view->gen->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$gender_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$gender_view->isExport()) { ?>
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
$gender_view->terminate();
?>