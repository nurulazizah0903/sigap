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
$tambahan_tugas_view = new tambahan_tugas_view();

// Run the page
$tambahan_tugas_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tambahan_tugas_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tambahan_tugas_view->isExport()) { ?>
<script>
var ftambahan_tugasview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ftambahan_tugasview = currentForm = new ew.Form("ftambahan_tugasview", "view");
	loadjs.done("ftambahan_tugasview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tambahan_tugas_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tambahan_tugas_view->ExportOptions->render("body") ?>
<?php $tambahan_tugas_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tambahan_tugas_view->showPageHeader(); ?>
<?php
$tambahan_tugas_view->showMessage();
?>
<form name="ftambahan_tugasview" id="ftambahan_tugasview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tambahan_tugas">
<input type="hidden" name="modal" value="<?php echo (int)$tambahan_tugas_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tambahan_tugas_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $tambahan_tugas_view->TableLeftColumnClass ?>"><span id="elh_tambahan_tugas_id"><?php echo $tambahan_tugas_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $tambahan_tugas_view->id->cellAttributes() ?>>
<span id="el_tambahan_tugas_id">
<span<?php echo $tambahan_tugas_view->id->viewAttributes() ?>><?php echo $tambahan_tugas_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tambahan_tugas_view->name->Visible) { // name ?>
	<tr id="r_name">
		<td class="<?php echo $tambahan_tugas_view->TableLeftColumnClass ?>"><span id="elh_tambahan_tugas_name"><?php echo $tambahan_tugas_view->name->caption() ?></span></td>
		<td data-name="name" <?php echo $tambahan_tugas_view->name->cellAttributes() ?>>
<span id="el_tambahan_tugas_name">
<span<?php echo $tambahan_tugas_view->name->viewAttributes() ?>><?php echo $tambahan_tugas_view->name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$tambahan_tugas_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tambahan_tugas_view->isExport()) { ?>
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
$tambahan_tugas_view->terminate();
?>