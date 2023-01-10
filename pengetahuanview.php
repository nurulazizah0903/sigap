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
$pengetahuan_view = new pengetahuan_view();

// Run the page
$pengetahuan_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pengetahuan_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$pengetahuan_view->isExport()) { ?>
<script>
var fpengetahuanview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fpengetahuanview = currentForm = new ew.Form("fpengetahuanview", "view");
	loadjs.done("fpengetahuanview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$pengetahuan_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $pengetahuan_view->ExportOptions->render("body") ?>
<?php $pengetahuan_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $pengetahuan_view->showPageHeader(); ?>
<?php
$pengetahuan_view->showMessage();
?>
<form name="fpengetahuanview" id="fpengetahuanview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pengetahuan">
<input type="hidden" name="modal" value="<?php echo (int)$pengetahuan_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($pengetahuan_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $pengetahuan_view->TableLeftColumnClass ?>"><span id="elh_pengetahuan_id"><?php echo $pengetahuan_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $pengetahuan_view->id->cellAttributes() ?>>
<span id="el_pengetahuan_id">
<span<?php echo $pengetahuan_view->id->viewAttributes() ?>><?php echo $pengetahuan_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pengetahuan_view->grup->Visible) { // grup ?>
	<tr id="r_grup">
		<td class="<?php echo $pengetahuan_view->TableLeftColumnClass ?>"><span id="elh_pengetahuan_grup"><?php echo $pengetahuan_view->grup->caption() ?></span></td>
		<td data-name="grup" <?php echo $pengetahuan_view->grup->cellAttributes() ?>>
<span id="el_pengetahuan_grup">
<span<?php echo $pengetahuan_view->grup->viewAttributes() ?>><?php echo $pengetahuan_view->grup->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pengetahuan_view->judul->Visible) { // judul ?>
	<tr id="r_judul">
		<td class="<?php echo $pengetahuan_view->TableLeftColumnClass ?>"><span id="elh_pengetahuan_judul"><?php echo $pengetahuan_view->judul->caption() ?></span></td>
		<td data-name="judul" <?php echo $pengetahuan_view->judul->cellAttributes() ?>>
<span id="el_pengetahuan_judul">
<span<?php echo $pengetahuan_view->judul->viewAttributes() ?>><?php echo $pengetahuan_view->judul->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pengetahuan_view->isi->Visible) { // isi ?>
	<tr id="r_isi">
		<td class="<?php echo $pengetahuan_view->TableLeftColumnClass ?>"><span id="elh_pengetahuan_isi"><?php echo $pengetahuan_view->isi->caption() ?></span></td>
		<td data-name="isi" <?php echo $pengetahuan_view->isi->cellAttributes() ?>>
<span id="el_pengetahuan_isi">
<span<?php echo $pengetahuan_view->isi->viewAttributes() ?>><?php echo $pengetahuan_view->isi->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pengetahuan_view->sumber_url->Visible) { // sumber_url ?>
	<tr id="r_sumber_url">
		<td class="<?php echo $pengetahuan_view->TableLeftColumnClass ?>"><span id="elh_pengetahuan_sumber_url"><?php echo $pengetahuan_view->sumber_url->caption() ?></span></td>
		<td data-name="sumber_url" <?php echo $pengetahuan_view->sumber_url->cellAttributes() ?>>
<span id="el_pengetahuan_sumber_url">
<span<?php echo $pengetahuan_view->sumber_url->viewAttributes() ?>><?php echo $pengetahuan_view->sumber_url->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pengetahuan_view->dokumen->Visible) { // dokumen ?>
	<tr id="r_dokumen">
		<td class="<?php echo $pengetahuan_view->TableLeftColumnClass ?>"><span id="elh_pengetahuan_dokumen"><?php echo $pengetahuan_view->dokumen->caption() ?></span></td>
		<td data-name="dokumen" <?php echo $pengetahuan_view->dokumen->cellAttributes() ?>>
<span id="el_pengetahuan_dokumen">
<span<?php echo $pengetahuan_view->dokumen->viewAttributes() ?>><?php echo $pengetahuan_view->dokumen->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pengetahuan_view->visual->Visible) { // visual ?>
	<tr id="r_visual">
		<td class="<?php echo $pengetahuan_view->TableLeftColumnClass ?>"><span id="elh_pengetahuan_visual"><?php echo $pengetahuan_view->visual->caption() ?></span></td>
		<td data-name="visual" <?php echo $pengetahuan_view->visual->cellAttributes() ?>>
<span id="el_pengetahuan_visual">
<span<?php echo $pengetahuan_view->visual->viewAttributes() ?>><?php echo $pengetahuan_view->visual->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pengetahuan_view->c_by->Visible) { // c_by ?>
	<tr id="r_c_by">
		<td class="<?php echo $pengetahuan_view->TableLeftColumnClass ?>"><span id="elh_pengetahuan_c_by"><?php echo $pengetahuan_view->c_by->caption() ?></span></td>
		<td data-name="c_by" <?php echo $pengetahuan_view->c_by->cellAttributes() ?>>
<span id="el_pengetahuan_c_by">
<span<?php echo $pengetahuan_view->c_by->viewAttributes() ?>><?php echo $pengetahuan_view->c_by->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$pengetahuan_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$pengetahuan_view->isExport()) { ?>
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
$pengetahuan_view->terminate();
?>