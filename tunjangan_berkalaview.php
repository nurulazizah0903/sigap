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
$tunjangan_berkala_view = new tunjangan_berkala_view();

// Run the page
$tunjangan_berkala_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tunjangan_berkala_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tunjangan_berkala_view->isExport()) { ?>
<script>
var ftunjangan_berkalaview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ftunjangan_berkalaview = currentForm = new ew.Form("ftunjangan_berkalaview", "view");
	loadjs.done("ftunjangan_berkalaview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tunjangan_berkala_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tunjangan_berkala_view->ExportOptions->render("body") ?>
<?php $tunjangan_berkala_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tunjangan_berkala_view->showPageHeader(); ?>
<?php
$tunjangan_berkala_view->showMessage();
?>
<form name="ftunjangan_berkalaview" id="ftunjangan_berkalaview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tunjangan_berkala">
<input type="hidden" name="modal" value="<?php echo (int)$tunjangan_berkala_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tunjangan_berkala_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $tunjangan_berkala_view->TableLeftColumnClass ?>"><span id="elh_tunjangan_berkala_id"><?php echo $tunjangan_berkala_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $tunjangan_berkala_view->id->cellAttributes() ?>>
<span id="el_tunjangan_berkala_id">
<span<?php echo $tunjangan_berkala_view->id->viewAttributes() ?>><?php echo $tunjangan_berkala_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tunjangan_berkala_view->jenjang->Visible) { // jenjang ?>
	<tr id="r_jenjang">
		<td class="<?php echo $tunjangan_berkala_view->TableLeftColumnClass ?>"><span id="elh_tunjangan_berkala_jenjang"><?php echo $tunjangan_berkala_view->jenjang->caption() ?></span></td>
		<td data-name="jenjang" <?php echo $tunjangan_berkala_view->jenjang->cellAttributes() ?>>
<span id="el_tunjangan_berkala_jenjang">
<span<?php echo $tunjangan_berkala_view->jenjang->viewAttributes() ?>><?php echo $tunjangan_berkala_view->jenjang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tunjangan_berkala_view->kualifikasi->Visible) { // kualifikasi ?>
	<tr id="r_kualifikasi">
		<td class="<?php echo $tunjangan_berkala_view->TableLeftColumnClass ?>"><span id="elh_tunjangan_berkala_kualifikasi"><?php echo $tunjangan_berkala_view->kualifikasi->caption() ?></span></td>
		<td data-name="kualifikasi" <?php echo $tunjangan_berkala_view->kualifikasi->cellAttributes() ?>>
<span id="el_tunjangan_berkala_kualifikasi">
<span<?php echo $tunjangan_berkala_view->kualifikasi->viewAttributes() ?>><?php echo $tunjangan_berkala_view->kualifikasi->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tunjangan_berkala_view->lama->Visible) { // lama ?>
	<tr id="r_lama">
		<td class="<?php echo $tunjangan_berkala_view->TableLeftColumnClass ?>"><span id="elh_tunjangan_berkala_lama"><?php echo $tunjangan_berkala_view->lama->caption() ?></span></td>
		<td data-name="lama" <?php echo $tunjangan_berkala_view->lama->cellAttributes() ?>>
<span id="el_tunjangan_berkala_lama">
<span<?php echo $tunjangan_berkala_view->lama->viewAttributes() ?>><?php echo $tunjangan_berkala_view->lama->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tunjangan_berkala_view->value->Visible) { // value ?>
	<tr id="r_value">
		<td class="<?php echo $tunjangan_berkala_view->TableLeftColumnClass ?>"><span id="elh_tunjangan_berkala_value"><?php echo $tunjangan_berkala_view->value->caption() ?></span></td>
		<td data-name="value" <?php echo $tunjangan_berkala_view->value->cellAttributes() ?>>
<span id="el_tunjangan_berkala_value">
<span<?php echo $tunjangan_berkala_view->value->viewAttributes() ?>><?php echo $tunjangan_berkala_view->value->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$tunjangan_berkala_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tunjangan_berkala_view->isExport()) { ?>
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
$tunjangan_berkala_view->terminate();
?>