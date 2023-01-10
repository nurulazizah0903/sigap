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
$peg_dokumen_view = new peg_dokumen_view();

// Run the page
$peg_dokumen_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$peg_dokumen_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$peg_dokumen_view->isExport()) { ?>
<script>
var fpeg_dokumenview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fpeg_dokumenview = currentForm = new ew.Form("fpeg_dokumenview", "view");
	loadjs.done("fpeg_dokumenview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$peg_dokumen_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $peg_dokumen_view->ExportOptions->render("body") ?>
<?php $peg_dokumen_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $peg_dokumen_view->showPageHeader(); ?>
<?php
$peg_dokumen_view->showMessage();
?>
<form name="fpeg_dokumenview" id="fpeg_dokumenview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="peg_dokumen">
<input type="hidden" name="modal" value="<?php echo (int)$peg_dokumen_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($peg_dokumen_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $peg_dokumen_view->TableLeftColumnClass ?>"><span id="elh_peg_dokumen_id"><?php echo $peg_dokumen_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $peg_dokumen_view->id->cellAttributes() ?>>
<span id="el_peg_dokumen_id">
<span<?php echo $peg_dokumen_view->id->viewAttributes() ?>><?php echo $peg_dokumen_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($peg_dokumen_view->pid->Visible) { // pid ?>
	<tr id="r_pid">
		<td class="<?php echo $peg_dokumen_view->TableLeftColumnClass ?>"><span id="elh_peg_dokumen_pid"><?php echo $peg_dokumen_view->pid->caption() ?></span></td>
		<td data-name="pid" <?php echo $peg_dokumen_view->pid->cellAttributes() ?>>
<span id="el_peg_dokumen_pid">
<span<?php echo $peg_dokumen_view->pid->viewAttributes() ?>><?php echo $peg_dokumen_view->pid->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($peg_dokumen_view->nama_dokumen->Visible) { // nama_dokumen ?>
	<tr id="r_nama_dokumen">
		<td class="<?php echo $peg_dokumen_view->TableLeftColumnClass ?>"><span id="elh_peg_dokumen_nama_dokumen"><?php echo $peg_dokumen_view->nama_dokumen->caption() ?></span></td>
		<td data-name="nama_dokumen" <?php echo $peg_dokumen_view->nama_dokumen->cellAttributes() ?>>
<span id="el_peg_dokumen_nama_dokumen">
<span<?php echo $peg_dokumen_view->nama_dokumen->viewAttributes() ?>><?php echo $peg_dokumen_view->nama_dokumen->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($peg_dokumen_view->file_dokumen->Visible) { // file_dokumen ?>
	<tr id="r_file_dokumen">
		<td class="<?php echo $peg_dokumen_view->TableLeftColumnClass ?>"><span id="elh_peg_dokumen_file_dokumen"><?php echo $peg_dokumen_view->file_dokumen->caption() ?></span></td>
		<td data-name="file_dokumen" <?php echo $peg_dokumen_view->file_dokumen->cellAttributes() ?>>
<span id="el_peg_dokumen_file_dokumen">
<span<?php echo $peg_dokumen_view->file_dokumen->viewAttributes() ?>><?php echo $peg_dokumen_view->file_dokumen->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($peg_dokumen_view->keterangan->Visible) { // keterangan ?>
	<tr id="r_keterangan">
		<td class="<?php echo $peg_dokumen_view->TableLeftColumnClass ?>"><span id="elh_peg_dokumen_keterangan"><?php echo $peg_dokumen_view->keterangan->caption() ?></span></td>
		<td data-name="keterangan" <?php echo $peg_dokumen_view->keterangan->cellAttributes() ?>>
<span id="el_peg_dokumen_keterangan">
<span<?php echo $peg_dokumen_view->keterangan->viewAttributes() ?>><?php echo $peg_dokumen_view->keterangan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($peg_dokumen_view->c_date->Visible) { // c_date ?>
	<tr id="r_c_date">
		<td class="<?php echo $peg_dokumen_view->TableLeftColumnClass ?>"><span id="elh_peg_dokumen_c_date"><?php echo $peg_dokumen_view->c_date->caption() ?></span></td>
		<td data-name="c_date" <?php echo $peg_dokumen_view->c_date->cellAttributes() ?>>
<span id="el_peg_dokumen_c_date">
<span<?php echo $peg_dokumen_view->c_date->viewAttributes() ?>><?php echo $peg_dokumen_view->c_date->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($peg_dokumen_view->u_date->Visible) { // u_date ?>
	<tr id="r_u_date">
		<td class="<?php echo $peg_dokumen_view->TableLeftColumnClass ?>"><span id="elh_peg_dokumen_u_date"><?php echo $peg_dokumen_view->u_date->caption() ?></span></td>
		<td data-name="u_date" <?php echo $peg_dokumen_view->u_date->cellAttributes() ?>>
<span id="el_peg_dokumen_u_date">
<span<?php echo $peg_dokumen_view->u_date->viewAttributes() ?>><?php echo $peg_dokumen_view->u_date->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($peg_dokumen_view->c_by->Visible) { // c_by ?>
	<tr id="r_c_by">
		<td class="<?php echo $peg_dokumen_view->TableLeftColumnClass ?>"><span id="elh_peg_dokumen_c_by"><?php echo $peg_dokumen_view->c_by->caption() ?></span></td>
		<td data-name="c_by" <?php echo $peg_dokumen_view->c_by->cellAttributes() ?>>
<span id="el_peg_dokumen_c_by">
<span<?php echo $peg_dokumen_view->c_by->viewAttributes() ?>><?php echo $peg_dokumen_view->c_by->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($peg_dokumen_view->u_by->Visible) { // u_by ?>
	<tr id="r_u_by">
		<td class="<?php echo $peg_dokumen_view->TableLeftColumnClass ?>"><span id="elh_peg_dokumen_u_by"><?php echo $peg_dokumen_view->u_by->caption() ?></span></td>
		<td data-name="u_by" <?php echo $peg_dokumen_view->u_by->cellAttributes() ?>>
<span id="el_peg_dokumen_u_by">
<span<?php echo $peg_dokumen_view->u_by->viewAttributes() ?>><?php echo $peg_dokumen_view->u_by->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$peg_dokumen_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$peg_dokumen_view->isExport()) { ?>
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
$peg_dokumen_view->terminate();
?>