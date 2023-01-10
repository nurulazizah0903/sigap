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
$terlambat_view = new terlambat_view();

// Run the page
$terlambat_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$terlambat_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$terlambat_view->isExport()) { ?>
<script>
var fterlambatview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fterlambatview = currentForm = new ew.Form("fterlambatview", "view");
	loadjs.done("fterlambatview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$terlambat_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $terlambat_view->ExportOptions->render("body") ?>
<?php $terlambat_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $terlambat_view->showPageHeader(); ?>
<?php
$terlambat_view->showMessage();
?>
<form name="fterlambatview" id="fterlambatview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="terlambat">
<input type="hidden" name="modal" value="<?php echo (int)$terlambat_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($terlambat_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $terlambat_view->TableLeftColumnClass ?>"><span id="elh_terlambat_id"><?php echo $terlambat_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $terlambat_view->id->cellAttributes() ?>>
<span id="el_terlambat_id">
<span<?php echo $terlambat_view->id->viewAttributes() ?>><?php echo $terlambat_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($terlambat_view->jenjang_id->Visible) { // jenjang_id ?>
	<tr id="r_jenjang_id">
		<td class="<?php echo $terlambat_view->TableLeftColumnClass ?>"><span id="elh_terlambat_jenjang_id"><?php echo $terlambat_view->jenjang_id->caption() ?></span></td>
		<td data-name="jenjang_id" <?php echo $terlambat_view->jenjang_id->cellAttributes() ?>>
<span id="el_terlambat_jenjang_id">
<span<?php echo $terlambat_view->jenjang_id->viewAttributes() ?>><?php echo $terlambat_view->jenjang_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($terlambat_view->jabatan_id->Visible) { // jabatan_id ?>
	<tr id="r_jabatan_id">
		<td class="<?php echo $terlambat_view->TableLeftColumnClass ?>"><span id="elh_terlambat_jabatan_id"><?php echo $terlambat_view->jabatan_id->caption() ?></span></td>
		<td data-name="jabatan_id" <?php echo $terlambat_view->jabatan_id->cellAttributes() ?>>
<span id="el_terlambat_jabatan_id">
<span<?php echo $terlambat_view->jabatan_id->viewAttributes() ?>><?php echo $terlambat_view->jabatan_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($terlambat_view->value->Visible) { // value ?>
	<tr id="r_value">
		<td class="<?php echo $terlambat_view->TableLeftColumnClass ?>"><span id="elh_terlambat_value"><?php echo $terlambat_view->value->caption() ?></span></td>
		<td data-name="value" <?php echo $terlambat_view->value->cellAttributes() ?>>
<span id="el_terlambat_value">
<span<?php echo $terlambat_view->value->viewAttributes() ?>><?php echo $terlambat_view->value->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$terlambat_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$terlambat_view->isExport()) { ?>
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
$terlambat_view->terminate();
?>