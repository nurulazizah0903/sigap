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
$gajisd_view = new gajisd_view();

// Run the page
$gajisd_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gajisd_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$gajisd_view->isExport()) { ?>
<script>
var fgajisdview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fgajisdview = currentForm = new ew.Form("fgajisdview", "view");
	loadjs.done("fgajisdview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$gajisd_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $gajisd_view->ExportOptions->render("body") ?>
<?php $gajisd_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $gajisd_view->showPageHeader(); ?>
<?php
$gajisd_view->showMessage();
?>
<form name="fgajisdview" id="fgajisdview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gajisd">
<input type="hidden" name="modal" value="<?php echo (int)$gajisd_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($gajisd_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $gajisd_view->TableLeftColumnClass ?>"><span id="elh_gajisd_id"><?php echo $gajisd_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $gajisd_view->id->cellAttributes() ?>>
<span id="el_gajisd_id">
<span<?php echo $gajisd_view->id->viewAttributes() ?>><?php echo $gajisd_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gajisd_view->tahun->Visible) { // tahun ?>
	<tr id="r_tahun">
		<td class="<?php echo $gajisd_view->TableLeftColumnClass ?>"><span id="elh_gajisd_tahun"><?php echo $gajisd_view->tahun->caption() ?></span></td>
		<td data-name="tahun" <?php echo $gajisd_view->tahun->cellAttributes() ?>>
<span id="el_gajisd_tahun">
<span<?php echo $gajisd_view->tahun->viewAttributes() ?>><?php echo $gajisd_view->tahun->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gajisd_view->bulan->Visible) { // bulan ?>
	<tr id="r_bulan">
		<td class="<?php echo $gajisd_view->TableLeftColumnClass ?>"><span id="elh_gajisd_bulan"><?php echo $gajisd_view->bulan->caption() ?></span></td>
		<td data-name="bulan" <?php echo $gajisd_view->bulan->cellAttributes() ?>>
<span id="el_gajisd_bulan">
<span<?php echo $gajisd_view->bulan->viewAttributes() ?>><?php echo $gajisd_view->bulan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gajisd_view->datetime->Visible) { // datetime ?>
	<tr id="r_datetime">
		<td class="<?php echo $gajisd_view->TableLeftColumnClass ?>"><span id="elh_gajisd_datetime"><?php echo $gajisd_view->datetime->caption() ?></span></td>
		<td data-name="datetime" <?php echo $gajisd_view->datetime->cellAttributes() ?>>
<span id="el_gajisd_datetime">
<span<?php echo $gajisd_view->datetime->viewAttributes() ?>><?php echo $gajisd_view->datetime->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gajisd_view->createby->Visible) { // createby ?>
	<tr id="r_createby">
		<td class="<?php echo $gajisd_view->TableLeftColumnClass ?>"><span id="elh_gajisd_createby"><?php echo $gajisd_view->createby->caption() ?></span></td>
		<td data-name="createby" <?php echo $gajisd_view->createby->cellAttributes() ?>>
<span id="el_gajisd_createby">
<span<?php echo $gajisd_view->createby->viewAttributes() ?>><?php echo $gajisd_view->createby->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("gajisd_detil", explode(",", $gajisd->getCurrentDetailTable())) && $gajisd_detil->DetailView) {
?>
<?php if ($gajisd->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("gajisd_detil", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "gajisd_detilgrid.php" ?>
<?php } ?>
</form>
<?php
$gajisd_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$gajisd_view->isExport()) { ?>
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
$gajisd_view->terminate();
?>