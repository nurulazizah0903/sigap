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
$gajitk_view = new gajitk_view();

// Run the page
$gajitk_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gajitk_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$gajitk_view->isExport()) { ?>
<script>
var fgajitkview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fgajitkview = currentForm = new ew.Form("fgajitkview", "view");
	loadjs.done("fgajitkview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$gajitk_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $gajitk_view->ExportOptions->render("body") ?>
<?php $gajitk_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $gajitk_view->showPageHeader(); ?>
<?php
$gajitk_view->showMessage();
?>
<form name="fgajitkview" id="fgajitkview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gajitk">
<input type="hidden" name="modal" value="<?php echo (int)$gajitk_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($gajitk_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $gajitk_view->TableLeftColumnClass ?>"><span id="elh_gajitk_id"><?php echo $gajitk_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $gajitk_view->id->cellAttributes() ?>>
<span id="el_gajitk_id">
<span<?php echo $gajitk_view->id->viewAttributes() ?>><?php echo $gajitk_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gajitk_view->tahun->Visible) { // tahun ?>
	<tr id="r_tahun">
		<td class="<?php echo $gajitk_view->TableLeftColumnClass ?>"><span id="elh_gajitk_tahun"><?php echo $gajitk_view->tahun->caption() ?></span></td>
		<td data-name="tahun" <?php echo $gajitk_view->tahun->cellAttributes() ?>>
<span id="el_gajitk_tahun">
<span<?php echo $gajitk_view->tahun->viewAttributes() ?>><?php echo $gajitk_view->tahun->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gajitk_view->bulan->Visible) { // bulan ?>
	<tr id="r_bulan">
		<td class="<?php echo $gajitk_view->TableLeftColumnClass ?>"><span id="elh_gajitk_bulan"><?php echo $gajitk_view->bulan->caption() ?></span></td>
		<td data-name="bulan" <?php echo $gajitk_view->bulan->cellAttributes() ?>>
<span id="el_gajitk_bulan">
<span<?php echo $gajitk_view->bulan->viewAttributes() ?>><?php echo $gajitk_view->bulan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gajitk_view->datetime->Visible) { // datetime ?>
	<tr id="r_datetime">
		<td class="<?php echo $gajitk_view->TableLeftColumnClass ?>"><span id="elh_gajitk_datetime"><?php echo $gajitk_view->datetime->caption() ?></span></td>
		<td data-name="datetime" <?php echo $gajitk_view->datetime->cellAttributes() ?>>
<span id="el_gajitk_datetime">
<span<?php echo $gajitk_view->datetime->viewAttributes() ?>><?php echo $gajitk_view->datetime->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gajitk_view->createby->Visible) { // createby ?>
	<tr id="r_createby">
		<td class="<?php echo $gajitk_view->TableLeftColumnClass ?>"><span id="elh_gajitk_createby"><?php echo $gajitk_view->createby->caption() ?></span></td>
		<td data-name="createby" <?php echo $gajitk_view->createby->cellAttributes() ?>>
<span id="el_gajitk_createby">
<span<?php echo $gajitk_view->createby->viewAttributes() ?>><?php echo $gajitk_view->createby->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("gajitk_detil", explode(",", $gajitk->getCurrentDetailTable())) && $gajitk_detil->DetailView) {
?>
<?php if ($gajitk->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("gajitk_detil", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "gajitk_detilgrid.php" ?>
<?php } ?>
</form>
<?php
$gajitk_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$gajitk_view->isExport()) { ?>
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
$gajitk_view->terminate();
?>