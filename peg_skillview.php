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
$peg_skill_view = new peg_skill_view();

// Run the page
$peg_skill_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$peg_skill_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$peg_skill_view->isExport()) { ?>
<script>
var fpeg_skillview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fpeg_skillview = currentForm = new ew.Form("fpeg_skillview", "view");
	loadjs.done("fpeg_skillview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$peg_skill_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $peg_skill_view->ExportOptions->render("body") ?>
<?php $peg_skill_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $peg_skill_view->showPageHeader(); ?>
<?php
$peg_skill_view->showMessage();
?>
<form name="fpeg_skillview" id="fpeg_skillview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="peg_skill">
<input type="hidden" name="modal" value="<?php echo (int)$peg_skill_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($peg_skill_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $peg_skill_view->TableLeftColumnClass ?>"><span id="elh_peg_skill_id"><?php echo $peg_skill_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $peg_skill_view->id->cellAttributes() ?>>
<span id="el_peg_skill_id">
<span<?php echo $peg_skill_view->id->viewAttributes() ?>><?php echo $peg_skill_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($peg_skill_view->pid->Visible) { // pid ?>
	<tr id="r_pid">
		<td class="<?php echo $peg_skill_view->TableLeftColumnClass ?>"><span id="elh_peg_skill_pid"><?php echo $peg_skill_view->pid->caption() ?></span></td>
		<td data-name="pid" <?php echo $peg_skill_view->pid->cellAttributes() ?>>
<span id="el_peg_skill_pid">
<span<?php echo $peg_skill_view->pid->viewAttributes() ?>><?php echo $peg_skill_view->pid->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($peg_skill_view->keahlian->Visible) { // keahlian ?>
	<tr id="r_keahlian">
		<td class="<?php echo $peg_skill_view->TableLeftColumnClass ?>"><span id="elh_peg_skill_keahlian"><?php echo $peg_skill_view->keahlian->caption() ?></span></td>
		<td data-name="keahlian" <?php echo $peg_skill_view->keahlian->cellAttributes() ?>>
<span id="el_peg_skill_keahlian">
<span<?php echo $peg_skill_view->keahlian->viewAttributes() ?>><?php echo $peg_skill_view->keahlian->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($peg_skill_view->tingkat->Visible) { // tingkat ?>
	<tr id="r_tingkat">
		<td class="<?php echo $peg_skill_view->TableLeftColumnClass ?>"><span id="elh_peg_skill_tingkat"><?php echo $peg_skill_view->tingkat->caption() ?></span></td>
		<td data-name="tingkat" <?php echo $peg_skill_view->tingkat->cellAttributes() ?>>
<span id="el_peg_skill_tingkat">
<span<?php echo $peg_skill_view->tingkat->viewAttributes() ?>><?php echo $peg_skill_view->tingkat->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($peg_skill_view->bukti->Visible) { // bukti ?>
	<tr id="r_bukti">
		<td class="<?php echo $peg_skill_view->TableLeftColumnClass ?>"><span id="elh_peg_skill_bukti"><?php echo $peg_skill_view->bukti->caption() ?></span></td>
		<td data-name="bukti" <?php echo $peg_skill_view->bukti->cellAttributes() ?>>
<span id="el_peg_skill_bukti">
<span<?php echo $peg_skill_view->bukti->viewAttributes() ?>><?php echo $peg_skill_view->bukti->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($peg_skill_view->keterangan->Visible) { // keterangan ?>
	<tr id="r_keterangan">
		<td class="<?php echo $peg_skill_view->TableLeftColumnClass ?>"><span id="elh_peg_skill_keterangan"><?php echo $peg_skill_view->keterangan->caption() ?></span></td>
		<td data-name="keterangan" <?php echo $peg_skill_view->keterangan->cellAttributes() ?>>
<span id="el_peg_skill_keterangan">
<span<?php echo $peg_skill_view->keterangan->viewAttributes() ?>><?php echo $peg_skill_view->keterangan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($peg_skill_view->c_date->Visible) { // c_date ?>
	<tr id="r_c_date">
		<td class="<?php echo $peg_skill_view->TableLeftColumnClass ?>"><span id="elh_peg_skill_c_date"><?php echo $peg_skill_view->c_date->caption() ?></span></td>
		<td data-name="c_date" <?php echo $peg_skill_view->c_date->cellAttributes() ?>>
<span id="el_peg_skill_c_date">
<span<?php echo $peg_skill_view->c_date->viewAttributes() ?>><?php echo $peg_skill_view->c_date->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($peg_skill_view->u_date->Visible) { // u_date ?>
	<tr id="r_u_date">
		<td class="<?php echo $peg_skill_view->TableLeftColumnClass ?>"><span id="elh_peg_skill_u_date"><?php echo $peg_skill_view->u_date->caption() ?></span></td>
		<td data-name="u_date" <?php echo $peg_skill_view->u_date->cellAttributes() ?>>
<span id="el_peg_skill_u_date">
<span<?php echo $peg_skill_view->u_date->viewAttributes() ?>><?php echo $peg_skill_view->u_date->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($peg_skill_view->c_by->Visible) { // c_by ?>
	<tr id="r_c_by">
		<td class="<?php echo $peg_skill_view->TableLeftColumnClass ?>"><span id="elh_peg_skill_c_by"><?php echo $peg_skill_view->c_by->caption() ?></span></td>
		<td data-name="c_by" <?php echo $peg_skill_view->c_by->cellAttributes() ?>>
<span id="el_peg_skill_c_by">
<span<?php echo $peg_skill_view->c_by->viewAttributes() ?>><?php echo $peg_skill_view->c_by->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($peg_skill_view->u_by->Visible) { // u_by ?>
	<tr id="r_u_by">
		<td class="<?php echo $peg_skill_view->TableLeftColumnClass ?>"><span id="elh_peg_skill_u_by"><?php echo $peg_skill_view->u_by->caption() ?></span></td>
		<td data-name="u_by" <?php echo $peg_skill_view->u_by->cellAttributes() ?>>
<span id="el_peg_skill_u_by">
<span<?php echo $peg_skill_view->u_by->viewAttributes() ?>><?php echo $peg_skill_view->u_by->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$peg_skill_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$peg_skill_view->isExport()) { ?>
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
$peg_skill_view->terminate();
?>