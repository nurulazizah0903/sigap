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
$proyek_view = new proyek_view();

// Run the page
$proyek_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$proyek_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$proyek_view->isExport()) { ?>
<script>
var fproyekview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fproyekview = currentForm = new ew.Form("fproyekview", "view");
	loadjs.done("fproyekview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$proyek_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $proyek_view->ExportOptions->render("body") ?>
<?php $proyek_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $proyek_view->showPageHeader(); ?>
<?php
$proyek_view->showMessage();
?>
<form name="fproyekview" id="fproyekview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="proyek">
<input type="hidden" name="modal" value="<?php echo (int)$proyek_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($proyek_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $proyek_view->TableLeftColumnClass ?>"><span id="elh_proyek_id"><?php echo $proyek_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $proyek_view->id->cellAttributes() ?>>
<span id="el_proyek_id">
<span<?php echo $proyek_view->id->viewAttributes() ?>><?php echo $proyek_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($proyek_view->klien->Visible) { // klien ?>
	<tr id="r_klien">
		<td class="<?php echo $proyek_view->TableLeftColumnClass ?>"><span id="elh_proyek_klien"><?php echo $proyek_view->klien->caption() ?></span></td>
		<td data-name="klien" <?php echo $proyek_view->klien->cellAttributes() ?>>
<span id="el_proyek_klien">
<span<?php echo $proyek_view->klien->viewAttributes() ?>><?php echo $proyek_view->klien->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($proyek_view->proyek->Visible) { // proyek ?>
	<tr id="r_proyek">
		<td class="<?php echo $proyek_view->TableLeftColumnClass ?>"><span id="elh_proyek_proyek"><?php echo $proyek_view->proyek->caption() ?></span></td>
		<td data-name="proyek" <?php echo $proyek_view->proyek->cellAttributes() ?>>
<span id="el_proyek_proyek">
<span<?php echo $proyek_view->proyek->viewAttributes() ?>><?php echo $proyek_view->proyek->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($proyek_view->tgl_awal->Visible) { // tgl_awal ?>
	<tr id="r_tgl_awal">
		<td class="<?php echo $proyek_view->TableLeftColumnClass ?>"><span id="elh_proyek_tgl_awal"><?php echo $proyek_view->tgl_awal->caption() ?></span></td>
		<td data-name="tgl_awal" <?php echo $proyek_view->tgl_awal->cellAttributes() ?>>
<span id="el_proyek_tgl_awal">
<span<?php echo $proyek_view->tgl_awal->viewAttributes() ?>><?php echo $proyek_view->tgl_awal->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($proyek_view->tgl_akhir->Visible) { // tgl_akhir ?>
	<tr id="r_tgl_akhir">
		<td class="<?php echo $proyek_view->TableLeftColumnClass ?>"><span id="elh_proyek_tgl_akhir"><?php echo $proyek_view->tgl_akhir->caption() ?></span></td>
		<td data-name="tgl_akhir" <?php echo $proyek_view->tgl_akhir->cellAttributes() ?>>
<span id="el_proyek_tgl_akhir">
<span<?php echo $proyek_view->tgl_akhir->viewAttributes() ?>><?php echo $proyek_view->tgl_akhir->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($proyek_view->file_proyek->Visible) { // file_proyek ?>
	<tr id="r_file_proyek">
		<td class="<?php echo $proyek_view->TableLeftColumnClass ?>"><span id="elh_proyek_file_proyek"><?php echo $proyek_view->file_proyek->caption() ?></span></td>
		<td data-name="file_proyek" <?php echo $proyek_view->file_proyek->cellAttributes() ?>>
<span id="el_proyek_file_proyek">
<span<?php echo $proyek_view->file_proyek->viewAttributes() ?>><?php echo GetFileViewTag($proyek_view->file_proyek, $proyek_view->file_proyek->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($proyek_view->aktif->Visible) { // aktif ?>
	<tr id="r_aktif">
		<td class="<?php echo $proyek_view->TableLeftColumnClass ?>"><span id="elh_proyek_aktif"><?php echo $proyek_view->aktif->caption() ?></span></td>
		<td data-name="aktif" <?php echo $proyek_view->aktif->cellAttributes() ?>>
<span id="el_proyek_aktif">
<span<?php echo $proyek_view->aktif->viewAttributes() ?>><?php echo $proyek_view->aktif->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$proyek_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$proyek_view->isExport()) { ?>
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
$proyek_view->terminate();
?>