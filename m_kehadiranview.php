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
$m_kehadiran_view = new m_kehadiran_view();

// Run the page
$m_kehadiran_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_kehadiran_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_kehadiran_view->isExport()) { ?>
<script>
var fm_kehadiranview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fm_kehadiranview = currentForm = new ew.Form("fm_kehadiranview", "view");
	loadjs.done("fm_kehadiranview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$m_kehadiran_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $m_kehadiran_view->ExportOptions->render("body") ?>
<?php $m_kehadiran_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $m_kehadiran_view->showPageHeader(); ?>
<?php
$m_kehadiran_view->showMessage();
?>
<form name="fm_kehadiranview" id="fm_kehadiranview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_kehadiran">
<input type="hidden" name="modal" value="<?php echo (int)$m_kehadiran_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($m_kehadiran_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $m_kehadiran_view->TableLeftColumnClass ?>"><span id="elh_m_kehadiran_id"><?php echo $m_kehadiran_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $m_kehadiran_view->id->cellAttributes() ?>>
<span id="el_m_kehadiran_id">
<span<?php echo $m_kehadiran_view->id->viewAttributes() ?>><?php echo $m_kehadiran_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_kehadiran_view->jenjang->Visible) { // jenjang ?>
	<tr id="r_jenjang">
		<td class="<?php echo $m_kehadiran_view->TableLeftColumnClass ?>"><span id="elh_m_kehadiran_jenjang"><?php echo $m_kehadiran_view->jenjang->caption() ?></span></td>
		<td data-name="jenjang" <?php echo $m_kehadiran_view->jenjang->cellAttributes() ?>>
<span id="el_m_kehadiran_jenjang">
<span<?php echo $m_kehadiran_view->jenjang->viewAttributes() ?>><?php echo $m_kehadiran_view->jenjang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_kehadiran_view->jenis_jabatan->Visible) { // jenis_jabatan ?>
	<tr id="r_jenis_jabatan">
		<td class="<?php echo $m_kehadiran_view->TableLeftColumnClass ?>"><span id="elh_m_kehadiran_jenis_jabatan"><?php echo $m_kehadiran_view->jenis_jabatan->caption() ?></span></td>
		<td data-name="jenis_jabatan" <?php echo $m_kehadiran_view->jenis_jabatan->cellAttributes() ?>>
<span id="el_m_kehadiran_jenis_jabatan">
<span<?php echo $m_kehadiran_view->jenis_jabatan->viewAttributes() ?>><?php echo $m_kehadiran_view->jenis_jabatan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_kehadiran_view->jabatan->Visible) { // jabatan ?>
	<tr id="r_jabatan">
		<td class="<?php echo $m_kehadiran_view->TableLeftColumnClass ?>"><span id="elh_m_kehadiran_jabatan"><?php echo $m_kehadiran_view->jabatan->caption() ?></span></td>
		<td data-name="jabatan" <?php echo $m_kehadiran_view->jabatan->cellAttributes() ?>>
<span id="el_m_kehadiran_jabatan">
<span<?php echo $m_kehadiran_view->jabatan->viewAttributes() ?>><?php echo $m_kehadiran_view->jabatan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_kehadiran_view->sertif->Visible) { // sertif ?>
	<tr id="r_sertif">
		<td class="<?php echo $m_kehadiran_view->TableLeftColumnClass ?>"><span id="elh_m_kehadiran_sertif"><?php echo $m_kehadiran_view->sertif->caption() ?></span></td>
		<td data-name="sertif" <?php echo $m_kehadiran_view->sertif->cellAttributes() ?>>
<span id="el_m_kehadiran_sertif">
<span<?php echo $m_kehadiran_view->sertif->viewAttributes() ?>><?php echo $m_kehadiran_view->sertif->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_kehadiran_view->value->Visible) { // value ?>
	<tr id="r_value">
		<td class="<?php echo $m_kehadiran_view->TableLeftColumnClass ?>"><span id="elh_m_kehadiran_value"><?php echo $m_kehadiran_view->value->caption() ?></span></td>
		<td data-name="value" <?php echo $m_kehadiran_view->value->cellAttributes() ?>>
<span id="el_m_kehadiran_value">
<span<?php echo $m_kehadiran_view->value->viewAttributes() ?>><?php echo $m_kehadiran_view->value->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$m_kehadiran_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_kehadiran_view->isExport()) { ?>
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
$m_kehadiran_view->terminate();
?>