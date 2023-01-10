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
$gajismp_view = new gajismp_view();

// Run the page
$gajismp_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gajismp_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$gajismp_view->isExport()) { ?>
<script>
var fgajismpview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fgajismpview = currentForm = new ew.Form("fgajismpview", "view");
	loadjs.done("fgajismpview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$gajismp_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $gajismp_view->ExportOptions->render("body") ?>
<?php $gajismp_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $gajismp_view->showPageHeader(); ?>
<?php
$gajismp_view->showMessage();
?>
<form name="fgajismpview" id="fgajismpview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gajismp">
<input type="hidden" name="modal" value="<?php echo (int)$gajismp_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($gajismp_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $gajismp_view->TableLeftColumnClass ?>"><span id="elh_gajismp_id"><?php echo $gajismp_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $gajismp_view->id->cellAttributes() ?>>
<span id="el_gajismp_id">
<span<?php echo $gajismp_view->id->viewAttributes() ?>><?php echo $gajismp_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gajismp_view->tahun->Visible) { // tahun ?>
	<tr id="r_tahun">
		<td class="<?php echo $gajismp_view->TableLeftColumnClass ?>"><span id="elh_gajismp_tahun"><?php echo $gajismp_view->tahun->caption() ?></span></td>
		<td data-name="tahun" <?php echo $gajismp_view->tahun->cellAttributes() ?>>
<span id="el_gajismp_tahun">
<span<?php echo $gajismp_view->tahun->viewAttributes() ?>><?php echo $gajismp_view->tahun->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gajismp_view->bulan->Visible) { // bulan ?>
	<tr id="r_bulan">
		<td class="<?php echo $gajismp_view->TableLeftColumnClass ?>"><span id="elh_gajismp_bulan"><?php echo $gajismp_view->bulan->caption() ?></span></td>
		<td data-name="bulan" <?php echo $gajismp_view->bulan->cellAttributes() ?>>
<span id="el_gajismp_bulan">
<span<?php echo $gajismp_view->bulan->viewAttributes() ?>><?php echo $gajismp_view->bulan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gajismp_view->datetime->Visible) { // datetime ?>
	<tr id="r_datetime">
		<td class="<?php echo $gajismp_view->TableLeftColumnClass ?>"><span id="elh_gajismp_datetime"><?php echo $gajismp_view->datetime->caption() ?></span></td>
		<td data-name="datetime" <?php echo $gajismp_view->datetime->cellAttributes() ?>>
<span id="el_gajismp_datetime">
<span<?php echo $gajismp_view->datetime->viewAttributes() ?>><?php echo $gajismp_view->datetime->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gajismp_view->createby->Visible) { // createby ?>
	<tr id="r_createby">
		<td class="<?php echo $gajismp_view->TableLeftColumnClass ?>"><span id="elh_gajismp_createby"><?php echo $gajismp_view->createby->caption() ?></span></td>
		<td data-name="createby" <?php echo $gajismp_view->createby->cellAttributes() ?>>
<span id="el_gajismp_createby">
<span<?php echo $gajismp_view->createby->viewAttributes() ?>><?php echo $gajismp_view->createby->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("gajismp_detil", explode(",", $gajismp->getCurrentDetailTable())) && $gajismp_detil->DetailView) {
?>
<?php if ($gajismp->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("gajismp_detil", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "gajismp_detilgrid.php" ?>
<?php } ?>
</form>
<?php
$gajismp_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$gajismp_view->isExport()) { ?>
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
$gajismp_view->terminate();
?>