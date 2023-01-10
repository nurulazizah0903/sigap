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
$komentar_view = new komentar_view();

// Run the page
$komentar_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$komentar_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$komentar_view->isExport()) { ?>
<script>
var fkomentarview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fkomentarview = currentForm = new ew.Form("fkomentarview", "view");
	loadjs.done("fkomentarview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$komentar_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $komentar_view->ExportOptions->render("body") ?>
<?php $komentar_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $komentar_view->showPageHeader(); ?>
<?php
$komentar_view->showMessage();
?>
<form name="fkomentarview" id="fkomentarview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="komentar">
<input type="hidden" name="modal" value="<?php echo (int)$komentar_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($komentar_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $komentar_view->TableLeftColumnClass ?>"><span id="elh_komentar_id"><?php echo $komentar_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $komentar_view->id->cellAttributes() ?>>
<span id="el_komentar_id">
<span<?php echo $komentar_view->id->viewAttributes() ?>><?php echo $komentar_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($komentar_view->pid->Visible) { // pid ?>
	<tr id="r_pid">
		<td class="<?php echo $komentar_view->TableLeftColumnClass ?>"><span id="elh_komentar_pid"><?php echo $komentar_view->pid->caption() ?></span></td>
		<td data-name="pid" <?php echo $komentar_view->pid->cellAttributes() ?>>
<span id="el_komentar_pid">
<span<?php echo $komentar_view->pid->viewAttributes() ?>><?php echo $komentar_view->pid->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($komentar_view->komentar->Visible) { // komentar ?>
	<tr id="r_komentar">
		<td class="<?php echo $komentar_view->TableLeftColumnClass ?>"><span id="elh_komentar_komentar"><?php echo $komentar_view->komentar->caption() ?></span></td>
		<td data-name="komentar" <?php echo $komentar_view->komentar->cellAttributes() ?>>
<span id="el_komentar_komentar">
<span<?php echo $komentar_view->komentar->viewAttributes() ?>><?php echo $komentar_view->komentar->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($komentar_view->gambar->Visible) { // gambar ?>
	<tr id="r_gambar">
		<td class="<?php echo $komentar_view->TableLeftColumnClass ?>"><span id="elh_komentar_gambar"><?php echo $komentar_view->gambar->caption() ?></span></td>
		<td data-name="gambar" <?php echo $komentar_view->gambar->cellAttributes() ?>>
<span id="el_komentar_gambar">
<span<?php echo $komentar_view->gambar->viewAttributes() ?>><?php echo $komentar_view->gambar->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($komentar_view->video->Visible) { // video ?>
	<tr id="r_video">
		<td class="<?php echo $komentar_view->TableLeftColumnClass ?>"><span id="elh_komentar_video"><?php echo $komentar_view->video->caption() ?></span></td>
		<td data-name="video" <?php echo $komentar_view->video->cellAttributes() ?>>
<span id="el_komentar_video">
<span<?php echo $komentar_view->video->viewAttributes() ?>><?php echo $komentar_view->video->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($komentar_view->pegawai->Visible) { // pegawai ?>
	<tr id="r_pegawai">
		<td class="<?php echo $komentar_view->TableLeftColumnClass ?>"><span id="elh_komentar_pegawai"><?php echo $komentar_view->pegawai->caption() ?></span></td>
		<td data-name="pegawai" <?php echo $komentar_view->pegawai->cellAttributes() ?>>
<span id="el_komentar_pegawai">
<span<?php echo $komentar_view->pegawai->viewAttributes() ?>><?php echo $komentar_view->pegawai->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$komentar_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$komentar_view->isExport()) { ?>
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
$komentar_view->terminate();
?>