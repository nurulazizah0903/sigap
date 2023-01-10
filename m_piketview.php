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
$m_piket_view = new m_piket_view();

// Run the page
$m_piket_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_piket_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_piket_view->isExport()) { ?>
<script>
var fm_piketview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fm_piketview = currentForm = new ew.Form("fm_piketview", "view");
	loadjs.done("fm_piketview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$m_piket_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $m_piket_view->ExportOptions->render("body") ?>
<?php $m_piket_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $m_piket_view->showPageHeader(); ?>
<?php
$m_piket_view->showMessage();
?>
<form name="fm_piketview" id="fm_piketview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_piket">
<input type="hidden" name="modal" value="<?php echo (int)$m_piket_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($m_piket_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $m_piket_view->TableLeftColumnClass ?>"><span id="elh_m_piket_id"><?php echo $m_piket_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $m_piket_view->id->cellAttributes() ?>>
<span id="el_m_piket_id">
<span<?php echo $m_piket_view->id->viewAttributes() ?>><?php echo $m_piket_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_piket_view->jenjang->Visible) { // jenjang ?>
	<tr id="r_jenjang">
		<td class="<?php echo $m_piket_view->TableLeftColumnClass ?>"><span id="elh_m_piket_jenjang"><?php echo $m_piket_view->jenjang->caption() ?></span></td>
		<td data-name="jenjang" <?php echo $m_piket_view->jenjang->cellAttributes() ?>>
<span id="el_m_piket_jenjang">
<span<?php echo $m_piket_view->jenjang->viewAttributes() ?>><?php echo $m_piket_view->jenjang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_piket_view->type_jabatan->Visible) { // type_jabatan ?>
	<tr id="r_type_jabatan">
		<td class="<?php echo $m_piket_view->TableLeftColumnClass ?>"><span id="elh_m_piket_type_jabatan"><?php echo $m_piket_view->type_jabatan->caption() ?></span></td>
		<td data-name="type_jabatan" <?php echo $m_piket_view->type_jabatan->cellAttributes() ?>>
<span id="el_m_piket_type_jabatan">
<span<?php echo $m_piket_view->type_jabatan->viewAttributes() ?>><?php echo $m_piket_view->type_jabatan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_piket_view->jenis_sertif->Visible) { // jenis_sertif ?>
	<tr id="r_jenis_sertif">
		<td class="<?php echo $m_piket_view->TableLeftColumnClass ?>"><span id="elh_m_piket_jenis_sertif"><?php echo $m_piket_view->jenis_sertif->caption() ?></span></td>
		<td data-name="jenis_sertif" <?php echo $m_piket_view->jenis_sertif->cellAttributes() ?>>
<span id="el_m_piket_jenis_sertif">
<span<?php echo $m_piket_view->jenis_sertif->viewAttributes() ?>><?php echo $m_piket_view->jenis_sertif->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_piket_view->value->Visible) { // value ?>
	<tr id="r_value">
		<td class="<?php echo $m_piket_view->TableLeftColumnClass ?>"><span id="elh_m_piket_value"><?php echo $m_piket_view->value->caption() ?></span></td>
		<td data-name="value" <?php echo $m_piket_view->value->cellAttributes() ?>>
<span id="el_m_piket_value">
<span<?php echo $m_piket_view->value->viewAttributes() ?>><?php echo $m_piket_view->value->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$m_piket_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_piket_view->isExport()) { ?>
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
$m_piket_view->terminate();
?>