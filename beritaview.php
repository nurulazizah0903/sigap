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
$berita_view = new berita_view();

// Run the page
$berita_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$berita_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$berita_view->isExport()) { ?>
<script>
var fberitaview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fberitaview = currentForm = new ew.Form("fberitaview", "view");
	loadjs.done("fberitaview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$berita_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $berita_view->ExportOptions->render("body") ?>
<?php $berita_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $berita_view->showPageHeader(); ?>
<?php
$berita_view->showMessage();
?>
<form name="fberitaview" id="fberitaview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="berita">
<input type="hidden" name="modal" value="<?php echo (int)$berita_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($berita_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $berita_view->TableLeftColumnClass ?>"><span id="elh_berita_id"><?php echo $berita_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $berita_view->id->cellAttributes() ?>>
<span id="el_berita_id">
<span<?php echo $berita_view->id->viewAttributes() ?>><?php echo $berita_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($berita_view->grup->Visible) { // grup ?>
	<tr id="r_grup">
		<td class="<?php echo $berita_view->TableLeftColumnClass ?>"><span id="elh_berita_grup"><?php echo $berita_view->grup->caption() ?></span></td>
		<td data-name="grup" <?php echo $berita_view->grup->cellAttributes() ?>>
<span id="el_berita_grup">
<span<?php echo $berita_view->grup->viewAttributes() ?>><?php echo $berita_view->grup->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($berita_view->judul->Visible) { // judul ?>
	<tr id="r_judul">
		<td class="<?php echo $berita_view->TableLeftColumnClass ?>"><span id="elh_berita_judul"><?php echo $berita_view->judul->caption() ?></span></td>
		<td data-name="judul" <?php echo $berita_view->judul->cellAttributes() ?>>
<span id="el_berita_judul">
<span<?php echo $berita_view->judul->viewAttributes() ?>><?php echo $berita_view->judul->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($berita_view->berita->Visible) { // berita ?>
	<tr id="r_berita">
		<td class="<?php echo $berita_view->TableLeftColumnClass ?>"><span id="elh_berita_berita"><?php echo $berita_view->berita->caption() ?></span></td>
		<td data-name="berita" <?php echo $berita_view->berita->cellAttributes() ?>>
<span id="el_berita_berita">
<span<?php echo $berita_view->berita->viewAttributes() ?>><?php echo $berita_view->berita->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($berita_view->gambar->Visible) { // gambar ?>
	<tr id="r_gambar">
		<td class="<?php echo $berita_view->TableLeftColumnClass ?>"><span id="elh_berita_gambar"><?php echo $berita_view->gambar->caption() ?></span></td>
		<td data-name="gambar" <?php echo $berita_view->gambar->cellAttributes() ?>>
<span id="el_berita_gambar">
<span<?php echo $berita_view->gambar->viewAttributes() ?>><?php echo $berita_view->gambar->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($berita_view->video->Visible) { // video ?>
	<tr id="r_video">
		<td class="<?php echo $berita_view->TableLeftColumnClass ?>"><span id="elh_berita_video"><?php echo $berita_view->video->caption() ?></span></td>
		<td data-name="video" <?php echo $berita_view->video->cellAttributes() ?>>
<span id="el_berita_video">
<span<?php echo $berita_view->video->viewAttributes() ?>><?php echo $berita_view->video->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($berita_view->c_by->Visible) { // c_by ?>
	<tr id="r_c_by">
		<td class="<?php echo $berita_view->TableLeftColumnClass ?>"><span id="elh_berita_c_by"><?php echo $berita_view->c_by->caption() ?></span></td>
		<td data-name="c_by" <?php echo $berita_view->c_by->cellAttributes() ?>>
<span id="el_berita_c_by">
<span<?php echo $berita_view->c_by->viewAttributes() ?>><?php echo $berita_view->c_by->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($berita_view->c_date->Visible) { // c_date ?>
	<tr id="r_c_date">
		<td class="<?php echo $berita_view->TableLeftColumnClass ?>"><span id="elh_berita_c_date"><?php echo $berita_view->c_date->caption() ?></span></td>
		<td data-name="c_date" <?php echo $berita_view->c_date->cellAttributes() ?>>
<span id="el_berita_c_date">
<span<?php echo $berita_view->c_date->viewAttributes() ?>><?php echo $berita_view->c_date->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($berita_view->aktif->Visible) { // aktif ?>
	<tr id="r_aktif">
		<td class="<?php echo $berita_view->TableLeftColumnClass ?>"><span id="elh_berita_aktif"><?php echo $berita_view->aktif->caption() ?></span></td>
		<td data-name="aktif" <?php echo $berita_view->aktif->cellAttributes() ?>>
<span id="el_berita_aktif">
<span<?php echo $berita_view->aktif->viewAttributes() ?>><?php echo $berita_view->aktif->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("komentar", explode(",", $berita->getCurrentDetailTable())) && $komentar->DetailView) {
?>
<?php if ($berita->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("komentar", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "komentargrid.php" ?>
<?php } ?>
</form>
<?php
$berita_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$berita_view->isExport()) { ?>
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
$berita_view->terminate();
?>