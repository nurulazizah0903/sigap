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
$tpendidikan_view = new tpendidikan_view();

// Run the page
$tpendidikan_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tpendidikan_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tpendidikan_view->isExport()) { ?>
<script>
var ftpendidikanview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ftpendidikanview = currentForm = new ew.Form("ftpendidikanview", "view");
	loadjs.done("ftpendidikanview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tpendidikan_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tpendidikan_view->ExportOptions->render("body") ?>
<?php $tpendidikan_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tpendidikan_view->showPageHeader(); ?>
<?php
$tpendidikan_view->showMessage();
?>
<form name="ftpendidikanview" id="ftpendidikanview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tpendidikan">
<input type="hidden" name="modal" value="<?php echo (int)$tpendidikan_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tpendidikan_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $tpendidikan_view->TableLeftColumnClass ?>"><span id="elh_tpendidikan_id"><?php echo $tpendidikan_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $tpendidikan_view->id->cellAttributes() ?>>
<span id="el_tpendidikan_id">
<span<?php echo $tpendidikan_view->id->viewAttributes() ?>><?php echo $tpendidikan_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tpendidikan_view->nourut->Visible) { // nourut ?>
	<tr id="r_nourut">
		<td class="<?php echo $tpendidikan_view->TableLeftColumnClass ?>"><span id="elh_tpendidikan_nourut"><?php echo $tpendidikan_view->nourut->caption() ?></span></td>
		<td data-name="nourut" <?php echo $tpendidikan_view->nourut->cellAttributes() ?>>
<span id="el_tpendidikan_nourut">
<span<?php echo $tpendidikan_view->nourut->viewAttributes() ?>><?php echo $tpendidikan_view->nourut->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tpendidikan_view->name->Visible) { // name ?>
	<tr id="r_name">
		<td class="<?php echo $tpendidikan_view->TableLeftColumnClass ?>"><span id="elh_tpendidikan_name"><?php echo $tpendidikan_view->name->caption() ?></span></td>
		<td data-name="name" <?php echo $tpendidikan_view->name->cellAttributes() ?>>
<span id="el_tpendidikan_name">
<span<?php echo $tpendidikan_view->name->viewAttributes() ?>><?php echo $tpendidikan_view->name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$tpendidikan_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tpendidikan_view->isExport()) { ?>
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
$tpendidikan_view->terminate();
?>