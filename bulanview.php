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
$bulan_view = new bulan_view();

// Run the page
$bulan_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$bulan_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$bulan_view->isExport()) { ?>
<script>
var fbulanview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fbulanview = currentForm = new ew.Form("fbulanview", "view");
	loadjs.done("fbulanview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$bulan_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $bulan_view->ExportOptions->render("body") ?>
<?php $bulan_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $bulan_view->showPageHeader(); ?>
<?php
$bulan_view->showMessage();
?>
<form name="fbulanview" id="fbulanview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="bulan">
<input type="hidden" name="modal" value="<?php echo (int)$bulan_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($bulan_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $bulan_view->TableLeftColumnClass ?>"><span id="elh_bulan_id"><?php echo $bulan_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $bulan_view->id->cellAttributes() ?>>
<span id="el_bulan_id">
<span<?php echo $bulan_view->id->viewAttributes() ?>><?php echo $bulan_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bulan_view->nourut->Visible) { // nourut ?>
	<tr id="r_nourut">
		<td class="<?php echo $bulan_view->TableLeftColumnClass ?>"><span id="elh_bulan_nourut"><?php echo $bulan_view->nourut->caption() ?></span></td>
		<td data-name="nourut" <?php echo $bulan_view->nourut->cellAttributes() ?>>
<span id="el_bulan_nourut">
<span<?php echo $bulan_view->nourut->viewAttributes() ?>><?php echo $bulan_view->nourut->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bulan_view->bulan->Visible) { // bulan ?>
	<tr id="r_bulan">
		<td class="<?php echo $bulan_view->TableLeftColumnClass ?>"><span id="elh_bulan_bulan"><?php echo $bulan_view->bulan->caption() ?></span></td>
		<td data-name="bulan" <?php echo $bulan_view->bulan->cellAttributes() ?>>
<span id="el_bulan_bulan">
<span<?php echo $bulan_view->bulan->viewAttributes() ?>><?php echo $bulan_view->bulan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$bulan_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$bulan_view->isExport()) { ?>
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
$bulan_view->terminate();
?>