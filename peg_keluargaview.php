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
$peg_keluarga_view = new peg_keluarga_view();

// Run the page
$peg_keluarga_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$peg_keluarga_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$peg_keluarga_view->isExport()) { ?>
<script>
var fpeg_keluargaview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fpeg_keluargaview = currentForm = new ew.Form("fpeg_keluargaview", "view");
	loadjs.done("fpeg_keluargaview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$peg_keluarga_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $peg_keluarga_view->ExportOptions->render("body") ?>
<?php $peg_keluarga_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $peg_keluarga_view->showPageHeader(); ?>
<?php
$peg_keluarga_view->showMessage();
?>
<form name="fpeg_keluargaview" id="fpeg_keluargaview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="peg_keluarga">
<input type="hidden" name="modal" value="<?php echo (int)$peg_keluarga_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($peg_keluarga_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $peg_keluarga_view->TableLeftColumnClass ?>"><span id="elh_peg_keluarga_id"><?php echo $peg_keluarga_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $peg_keluarga_view->id->cellAttributes() ?>>
<span id="el_peg_keluarga_id">
<span<?php echo $peg_keluarga_view->id->viewAttributes() ?>><?php echo $peg_keluarga_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($peg_keluarga_view->pid->Visible) { // pid ?>
	<tr id="r_pid">
		<td class="<?php echo $peg_keluarga_view->TableLeftColumnClass ?>"><span id="elh_peg_keluarga_pid"><?php echo $peg_keluarga_view->pid->caption() ?></span></td>
		<td data-name="pid" <?php echo $peg_keluarga_view->pid->cellAttributes() ?>>
<span id="el_peg_keluarga_pid">
<span<?php echo $peg_keluarga_view->pid->viewAttributes() ?>><?php echo $peg_keluarga_view->pid->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($peg_keluarga_view->nama->Visible) { // nama ?>
	<tr id="r_nama">
		<td class="<?php echo $peg_keluarga_view->TableLeftColumnClass ?>"><span id="elh_peg_keluarga_nama"><?php echo $peg_keluarga_view->nama->caption() ?></span></td>
		<td data-name="nama" <?php echo $peg_keluarga_view->nama->cellAttributes() ?>>
<span id="el_peg_keluarga_nama">
<span<?php echo $peg_keluarga_view->nama->viewAttributes() ?>><?php echo $peg_keluarga_view->nama->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($peg_keluarga_view->hp->Visible) { // hp ?>
	<tr id="r_hp">
		<td class="<?php echo $peg_keluarga_view->TableLeftColumnClass ?>"><span id="elh_peg_keluarga_hp"><?php echo $peg_keluarga_view->hp->caption() ?></span></td>
		<td data-name="hp" <?php echo $peg_keluarga_view->hp->cellAttributes() ?>>
<span id="el_peg_keluarga_hp">
<span<?php echo $peg_keluarga_view->hp->viewAttributes() ?>><?php echo $peg_keluarga_view->hp->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($peg_keluarga_view->hubungan->Visible) { // hubungan ?>
	<tr id="r_hubungan">
		<td class="<?php echo $peg_keluarga_view->TableLeftColumnClass ?>"><span id="elh_peg_keluarga_hubungan"><?php echo $peg_keluarga_view->hubungan->caption() ?></span></td>
		<td data-name="hubungan" <?php echo $peg_keluarga_view->hubungan->cellAttributes() ?>>
<span id="el_peg_keluarga_hubungan">
<span<?php echo $peg_keluarga_view->hubungan->viewAttributes() ?>><?php echo $peg_keluarga_view->hubungan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($peg_keluarga_view->tgl_lahir->Visible) { // tgl_lahir ?>
	<tr id="r_tgl_lahir">
		<td class="<?php echo $peg_keluarga_view->TableLeftColumnClass ?>"><span id="elh_peg_keluarga_tgl_lahir"><?php echo $peg_keluarga_view->tgl_lahir->caption() ?></span></td>
		<td data-name="tgl_lahir" <?php echo $peg_keluarga_view->tgl_lahir->cellAttributes() ?>>
<span id="el_peg_keluarga_tgl_lahir">
<span<?php echo $peg_keluarga_view->tgl_lahir->viewAttributes() ?>><?php echo $peg_keluarga_view->tgl_lahir->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($peg_keluarga_view->keterangan->Visible) { // keterangan ?>
	<tr id="r_keterangan">
		<td class="<?php echo $peg_keluarga_view->TableLeftColumnClass ?>"><span id="elh_peg_keluarga_keterangan"><?php echo $peg_keluarga_view->keterangan->caption() ?></span></td>
		<td data-name="keterangan" <?php echo $peg_keluarga_view->keterangan->cellAttributes() ?>>
<span id="el_peg_keluarga_keterangan">
<span<?php echo $peg_keluarga_view->keterangan->viewAttributes() ?>><?php echo $peg_keluarga_view->keterangan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($peg_keluarga_view->jen_kel->Visible) { // jen_kel ?>
	<tr id="r_jen_kel">
		<td class="<?php echo $peg_keluarga_view->TableLeftColumnClass ?>"><span id="elh_peg_keluarga_jen_kel"><?php echo $peg_keluarga_view->jen_kel->caption() ?></span></td>
		<td data-name="jen_kel" <?php echo $peg_keluarga_view->jen_kel->cellAttributes() ?>>
<span id="el_peg_keluarga_jen_kel">
<span<?php echo $peg_keluarga_view->jen_kel->viewAttributes() ?>><?php echo $peg_keluarga_view->jen_kel->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$peg_keluarga_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$peg_keluarga_view->isExport()) { ?>
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
$peg_keluarga_view->terminate();
?>