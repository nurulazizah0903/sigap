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
$gajitunjangan_view = new gajitunjangan_view();

// Run the page
$gajitunjangan_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gajitunjangan_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$gajitunjangan_view->isExport()) { ?>
<script>
var fgajitunjanganview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fgajitunjanganview = currentForm = new ew.Form("fgajitunjanganview", "view");
	loadjs.done("fgajitunjanganview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$gajitunjangan_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $gajitunjangan_view->ExportOptions->render("body") ?>
<?php $gajitunjangan_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $gajitunjangan_view->showPageHeader(); ?>
<?php
$gajitunjangan_view->showMessage();
?>
<form name="fgajitunjanganview" id="fgajitunjanganview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gajitunjangan">
<input type="hidden" name="modal" value="<?php echo (int)$gajitunjangan_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($gajitunjangan_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $gajitunjangan_view->TableLeftColumnClass ?>"><span id="elh_gajitunjangan_id"><?php echo $gajitunjangan_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $gajitunjangan_view->id->cellAttributes() ?>>
<span id="el_gajitunjangan_id">
<span<?php echo $gajitunjangan_view->id->viewAttributes() ?>><?php echo $gajitunjangan_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gajitunjangan_view->pidjabatan->Visible) { // pidjabatan ?>
	<tr id="r_pidjabatan">
		<td class="<?php echo $gajitunjangan_view->TableLeftColumnClass ?>"><span id="elh_gajitunjangan_pidjabatan"><?php echo $gajitunjangan_view->pidjabatan->caption() ?></span></td>
		<td data-name="pidjabatan" <?php echo $gajitunjangan_view->pidjabatan->cellAttributes() ?>>
<span id="el_gajitunjangan_pidjabatan">
<span<?php echo $gajitunjangan_view->pidjabatan->viewAttributes() ?>><?php echo $gajitunjangan_view->pidjabatan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gajitunjangan_view->value_kehadiran->Visible) { // value_kehadiran ?>
	<tr id="r_value_kehadiran">
		<td class="<?php echo $gajitunjangan_view->TableLeftColumnClass ?>"><span id="elh_gajitunjangan_value_kehadiran"><?php echo $gajitunjangan_view->value_kehadiran->caption() ?></span></td>
		<td data-name="value_kehadiran" <?php echo $gajitunjangan_view->value_kehadiran->cellAttributes() ?>>
<span id="el_gajitunjangan_value_kehadiran">
<span<?php echo $gajitunjangan_view->value_kehadiran->viewAttributes() ?>><?php echo $gajitunjangan_view->value_kehadiran->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gajitunjangan_view->gapok->Visible) { // gapok ?>
	<tr id="r_gapok">
		<td class="<?php echo $gajitunjangan_view->TableLeftColumnClass ?>"><span id="elh_gajitunjangan_gapok"><?php echo $gajitunjangan_view->gapok->caption() ?></span></td>
		<td data-name="gapok" <?php echo $gajitunjangan_view->gapok->cellAttributes() ?>>
<span id="el_gajitunjangan_gapok">
<span<?php echo $gajitunjangan_view->gapok->viewAttributes() ?>><?php echo $gajitunjangan_view->gapok->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gajitunjangan_view->tunjangan_jabatan->Visible) { // tunjangan_jabatan ?>
	<tr id="r_tunjangan_jabatan">
		<td class="<?php echo $gajitunjangan_view->TableLeftColumnClass ?>"><span id="elh_gajitunjangan_tunjangan_jabatan"><?php echo $gajitunjangan_view->tunjangan_jabatan->caption() ?></span></td>
		<td data-name="tunjangan_jabatan" <?php echo $gajitunjangan_view->tunjangan_jabatan->cellAttributes() ?>>
<span id="el_gajitunjangan_tunjangan_jabatan">
<span<?php echo $gajitunjangan_view->tunjangan_jabatan->viewAttributes() ?>><?php echo $gajitunjangan_view->tunjangan_jabatan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gajitunjangan_view->reward->Visible) { // reward ?>
	<tr id="r_reward">
		<td class="<?php echo $gajitunjangan_view->TableLeftColumnClass ?>"><span id="elh_gajitunjangan_reward"><?php echo $gajitunjangan_view->reward->caption() ?></span></td>
		<td data-name="reward" <?php echo $gajitunjangan_view->reward->cellAttributes() ?>>
<span id="el_gajitunjangan_reward">
<span<?php echo $gajitunjangan_view->reward->viewAttributes() ?>><?php echo $gajitunjangan_view->reward->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gajitunjangan_view->lembur->Visible) { // lembur ?>
	<tr id="r_lembur">
		<td class="<?php echo $gajitunjangan_view->TableLeftColumnClass ?>"><span id="elh_gajitunjangan_lembur"><?php echo $gajitunjangan_view->lembur->caption() ?></span></td>
		<td data-name="lembur" <?php echo $gajitunjangan_view->lembur->cellAttributes() ?>>
<span id="el_gajitunjangan_lembur">
<span<?php echo $gajitunjangan_view->lembur->viewAttributes() ?>><?php echo $gajitunjangan_view->lembur->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gajitunjangan_view->piket->Visible) { // piket ?>
	<tr id="r_piket">
		<td class="<?php echo $gajitunjangan_view->TableLeftColumnClass ?>"><span id="elh_gajitunjangan_piket"><?php echo $gajitunjangan_view->piket->caption() ?></span></td>
		<td data-name="piket" <?php echo $gajitunjangan_view->piket->cellAttributes() ?>>
<span id="el_gajitunjangan_piket">
<span<?php echo $gajitunjangan_view->piket->viewAttributes() ?>><?php echo $gajitunjangan_view->piket->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gajitunjangan_view->inval->Visible) { // inval ?>
	<tr id="r_inval">
		<td class="<?php echo $gajitunjangan_view->TableLeftColumnClass ?>"><span id="elh_gajitunjangan_inval"><?php echo $gajitunjangan_view->inval->caption() ?></span></td>
		<td data-name="inval" <?php echo $gajitunjangan_view->inval->cellAttributes() ?>>
<span id="el_gajitunjangan_inval">
<span<?php echo $gajitunjangan_view->inval->viewAttributes() ?>><?php echo $gajitunjangan_view->inval->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gajitunjangan_view->jam_lebih->Visible) { // jam_lebih ?>
	<tr id="r_jam_lebih">
		<td class="<?php echo $gajitunjangan_view->TableLeftColumnClass ?>"><span id="elh_gajitunjangan_jam_lebih"><?php echo $gajitunjangan_view->jam_lebih->caption() ?></span></td>
		<td data-name="jam_lebih" <?php echo $gajitunjangan_view->jam_lebih->cellAttributes() ?>>
<span id="el_gajitunjangan_jam_lebih">
<span<?php echo $gajitunjangan_view->jam_lebih->viewAttributes() ?>><?php echo $gajitunjangan_view->jam_lebih->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gajitunjangan_view->tunjangan_khusus->Visible) { // tunjangan_khusus ?>
	<tr id="r_tunjangan_khusus">
		<td class="<?php echo $gajitunjangan_view->TableLeftColumnClass ?>"><span id="elh_gajitunjangan_tunjangan_khusus"><?php echo $gajitunjangan_view->tunjangan_khusus->caption() ?></span></td>
		<td data-name="tunjangan_khusus" <?php echo $gajitunjangan_view->tunjangan_khusus->cellAttributes() ?>>
<span id="el_gajitunjangan_tunjangan_khusus">
<span<?php echo $gajitunjangan_view->tunjangan_khusus->viewAttributes() ?>><?php echo $gajitunjangan_view->tunjangan_khusus->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gajitunjangan_view->ekstrakuri->Visible) { // ekstrakuri ?>
	<tr id="r_ekstrakuri">
		<td class="<?php echo $gajitunjangan_view->TableLeftColumnClass ?>"><span id="elh_gajitunjangan_ekstrakuri"><?php echo $gajitunjangan_view->ekstrakuri->caption() ?></span></td>
		<td data-name="ekstrakuri" <?php echo $gajitunjangan_view->ekstrakuri->cellAttributes() ?>>
<span id="el_gajitunjangan_ekstrakuri">
<span<?php echo $gajitunjangan_view->ekstrakuri->viewAttributes() ?>><?php echo $gajitunjangan_view->ekstrakuri->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$gajitunjangan_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$gajitunjangan_view->isExport()) { ?>
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
$gajitunjangan_view->terminate();
?>