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
$gajisma_view = new gajisma_view();

// Run the page
$gajisma_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gajisma_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$gajisma_view->isExport()) { ?>
<script>
var fgajismaview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fgajismaview = currentForm = new ew.Form("fgajismaview", "view");
	loadjs.done("fgajismaview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$gajisma_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $gajisma_view->ExportOptions->render("body") ?>
<?php $gajisma_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $gajisma_view->showPageHeader(); ?>
<?php
$gajisma_view->showMessage();
?>
<form name="fgajismaview" id="fgajismaview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gajisma">
<input type="hidden" name="modal" value="<?php echo (int)$gajisma_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($gajisma_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $gajisma_view->TableLeftColumnClass ?>"><span id="elh_gajisma_id"><?php echo $gajisma_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $gajisma_view->id->cellAttributes() ?>>
<span id="el_gajisma_id">
<span<?php echo $gajisma_view->id->viewAttributes() ?>><?php echo $gajisma_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gajisma_view->tahun->Visible) { // tahun ?>
	<tr id="r_tahun">
		<td class="<?php echo $gajisma_view->TableLeftColumnClass ?>"><span id="elh_gajisma_tahun"><?php echo $gajisma_view->tahun->caption() ?></span></td>
		<td data-name="tahun" <?php echo $gajisma_view->tahun->cellAttributes() ?>>
<span id="el_gajisma_tahun">
<span<?php echo $gajisma_view->tahun->viewAttributes() ?>><?php echo $gajisma_view->tahun->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gajisma_view->bulan->Visible) { // bulan ?>
	<tr id="r_bulan">
		<td class="<?php echo $gajisma_view->TableLeftColumnClass ?>"><span id="elh_gajisma_bulan"><?php echo $gajisma_view->bulan->caption() ?></span></td>
		<td data-name="bulan" <?php echo $gajisma_view->bulan->cellAttributes() ?>>
<span id="el_gajisma_bulan">
<span<?php echo $gajisma_view->bulan->viewAttributes() ?>><?php echo $gajisma_view->bulan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gajisma_view->datetime->Visible) { // datetime ?>
	<tr id="r_datetime">
		<td class="<?php echo $gajisma_view->TableLeftColumnClass ?>"><span id="elh_gajisma_datetime"><?php echo $gajisma_view->datetime->caption() ?></span></td>
		<td data-name="datetime" <?php echo $gajisma_view->datetime->cellAttributes() ?>>
<span id="el_gajisma_datetime">
<span<?php echo $gajisma_view->datetime->viewAttributes() ?>><?php echo $gajisma_view->datetime->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gajisma_view->createby->Visible) { // createby ?>
	<tr id="r_createby">
		<td class="<?php echo $gajisma_view->TableLeftColumnClass ?>"><span id="elh_gajisma_createby"><?php echo $gajisma_view->createby->caption() ?></span></td>
		<td data-name="createby" <?php echo $gajisma_view->createby->cellAttributes() ?>>
<span id="el_gajisma_createby">
<span<?php echo $gajisma_view->createby->viewAttributes() ?>><?php echo $gajisma_view->createby->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("gajisma_detil", explode(",", $gajisma->getCurrentDetailTable())) && $gajisma_detil->DetailView) {
?>
<?php if ($gajisma->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("gajisma_detil", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "gajisma_detilgrid.php" ?>
<?php } ?>
</form>
<?php
$gajisma_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$gajisma_view->isExport()) { ?>
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
$gajisma_view->terminate();
?>