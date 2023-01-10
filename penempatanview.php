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
$penempatan_view = new penempatan_view();

// Run the page
$penempatan_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$penempatan_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$penempatan_view->isExport()) { ?>
<script>
var fpenempatanview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fpenempatanview = currentForm = new ew.Form("fpenempatanview", "view");
	loadjs.done("fpenempatanview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$penempatan_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $penempatan_view->ExportOptions->render("body") ?>
<?php $penempatan_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $penempatan_view->showPageHeader(); ?>
<?php
$penempatan_view->showMessage();
?>
<form name="fpenempatanview" id="fpenempatanview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="penempatan">
<input type="hidden" name="modal" value="<?php echo (int)$penempatan_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($penempatan_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $penempatan_view->TableLeftColumnClass ?>"><span id="elh_penempatan_id"><?php echo $penempatan_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $penempatan_view->id->cellAttributes() ?>>
<span id="el_penempatan_id">
<span<?php echo $penempatan_view->id->viewAttributes() ?>><?php echo $penempatan_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penempatan_view->pegawai->Visible) { // pegawai ?>
	<tr id="r_pegawai">
		<td class="<?php echo $penempatan_view->TableLeftColumnClass ?>"><span id="elh_penempatan_pegawai"><?php echo $penempatan_view->pegawai->caption() ?></span></td>
		<td data-name="pegawai" <?php echo $penempatan_view->pegawai->cellAttributes() ?>>
<span id="el_penempatan_pegawai">
<span<?php echo $penempatan_view->pegawai->viewAttributes() ?>><?php echo $penempatan_view->pegawai->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penempatan_view->project->Visible) { // project ?>
	<tr id="r_project">
		<td class="<?php echo $penempatan_view->TableLeftColumnClass ?>"><span id="elh_penempatan_project"><?php echo $penempatan_view->project->caption() ?></span></td>
		<td data-name="project" <?php echo $penempatan_view->project->cellAttributes() ?>>
<span id="el_penempatan_project">
<span<?php echo $penempatan_view->project->viewAttributes() ?>><?php echo $penempatan_view->project->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penempatan_view->jabatan->Visible) { // jabatan ?>
	<tr id="r_jabatan">
		<td class="<?php echo $penempatan_view->TableLeftColumnClass ?>"><span id="elh_penempatan_jabatan"><?php echo $penempatan_view->jabatan->caption() ?></span></td>
		<td data-name="jabatan" <?php echo $penempatan_view->jabatan->cellAttributes() ?>>
<span id="el_penempatan_jabatan">
<span<?php echo $penempatan_view->jabatan->viewAttributes() ?>><?php echo $penempatan_view->jabatan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penempatan_view->tgl_mulai->Visible) { // tgl_mulai ?>
	<tr id="r_tgl_mulai">
		<td class="<?php echo $penempatan_view->TableLeftColumnClass ?>"><span id="elh_penempatan_tgl_mulai"><?php echo $penempatan_view->tgl_mulai->caption() ?></span></td>
		<td data-name="tgl_mulai" <?php echo $penempatan_view->tgl_mulai->cellAttributes() ?>>
<span id="el_penempatan_tgl_mulai">
<span<?php echo $penempatan_view->tgl_mulai->viewAttributes() ?>><?php echo $penempatan_view->tgl_mulai->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penempatan_view->tgl_akhir->Visible) { // tgl_akhir ?>
	<tr id="r_tgl_akhir">
		<td class="<?php echo $penempatan_view->TableLeftColumnClass ?>"><span id="elh_penempatan_tgl_akhir"><?php echo $penempatan_view->tgl_akhir->caption() ?></span></td>
		<td data-name="tgl_akhir" <?php echo $penempatan_view->tgl_akhir->cellAttributes() ?>>
<span id="el_penempatan_tgl_akhir">
<span<?php echo $penempatan_view->tgl_akhir->viewAttributes() ?>><?php echo $penempatan_view->tgl_akhir->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$penempatan_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$penempatan_view->isExport()) { ?>
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
$penempatan_view->terminate();
?>