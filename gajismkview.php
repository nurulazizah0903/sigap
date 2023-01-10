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
$gajismk_view = new gajismk_view();

// Run the page
$gajismk_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gajismk_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$gajismk_view->isExport()) { ?>
<script>
var fgajismkview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fgajismkview = currentForm = new ew.Form("fgajismkview", "view");
	loadjs.done("fgajismkview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$gajismk_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $gajismk_view->ExportOptions->render("body") ?>
<?php $gajismk_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $gajismk_view->showPageHeader(); ?>
<?php
$gajismk_view->showMessage();
?>
<form name="fgajismkview" id="fgajismkview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gajismk">
<input type="hidden" name="modal" value="<?php echo (int)$gajismk_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($gajismk_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $gajismk_view->TableLeftColumnClass ?>"><span id="elh_gajismk_id"><?php echo $gajismk_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $gajismk_view->id->cellAttributes() ?>>
<span id="el_gajismk_id">
<span<?php echo $gajismk_view->id->viewAttributes() ?>><?php echo $gajismk_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gajismk_view->tahun->Visible) { // tahun ?>
	<tr id="r_tahun">
		<td class="<?php echo $gajismk_view->TableLeftColumnClass ?>"><span id="elh_gajismk_tahun"><?php echo $gajismk_view->tahun->caption() ?></span></td>
		<td data-name="tahun" <?php echo $gajismk_view->tahun->cellAttributes() ?>>
<span id="el_gajismk_tahun">
<span<?php echo $gajismk_view->tahun->viewAttributes() ?>><?php echo $gajismk_view->tahun->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gajismk_view->bulan->Visible) { // bulan ?>
	<tr id="r_bulan">
		<td class="<?php echo $gajismk_view->TableLeftColumnClass ?>"><span id="elh_gajismk_bulan"><?php echo $gajismk_view->bulan->caption() ?></span></td>
		<td data-name="bulan" <?php echo $gajismk_view->bulan->cellAttributes() ?>>
<span id="el_gajismk_bulan">
<span<?php echo $gajismk_view->bulan->viewAttributes() ?>><?php echo $gajismk_view->bulan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gajismk_view->datetime->Visible) { // datetime ?>
	<tr id="r_datetime">
		<td class="<?php echo $gajismk_view->TableLeftColumnClass ?>"><span id="elh_gajismk_datetime"><?php echo $gajismk_view->datetime->caption() ?></span></td>
		<td data-name="datetime" <?php echo $gajismk_view->datetime->cellAttributes() ?>>
<span id="el_gajismk_datetime">
<span<?php echo $gajismk_view->datetime->viewAttributes() ?>><?php echo $gajismk_view->datetime->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gajismk_view->createby->Visible) { // createby ?>
	<tr id="r_createby">
		<td class="<?php echo $gajismk_view->TableLeftColumnClass ?>"><span id="elh_gajismk_createby"><?php echo $gajismk_view->createby->caption() ?></span></td>
		<td data-name="createby" <?php echo $gajismk_view->createby->cellAttributes() ?>>
<span id="el_gajismk_createby">
<span<?php echo $gajismk_view->createby->viewAttributes() ?>><?php echo $gajismk_view->createby->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("gajismk_detil", explode(",", $gajismk->getCurrentDetailTable())) && $gajismk_detil->DetailView) {
?>
<?php if ($gajismk->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("gajismk_detil", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "gajismk_detilgrid.php" ?>
<?php } ?>
</form>
<?php
$gajismk_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$gajismk_view->isExport()) { ?>
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
$gajismk_view->terminate();
?>