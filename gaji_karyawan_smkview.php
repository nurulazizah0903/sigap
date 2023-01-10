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
$gaji_karyawan_smk_view = new gaji_karyawan_smk_view();

// Run the page
$gaji_karyawan_smk_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gaji_karyawan_smk_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$gaji_karyawan_smk_view->isExport()) { ?>
<script>
var fgaji_karyawan_smkview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fgaji_karyawan_smkview = currentForm = new ew.Form("fgaji_karyawan_smkview", "view");
	loadjs.done("fgaji_karyawan_smkview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$gaji_karyawan_smk_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $gaji_karyawan_smk_view->ExportOptions->render("body") ?>
<?php $gaji_karyawan_smk_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $gaji_karyawan_smk_view->showPageHeader(); ?>
<?php
$gaji_karyawan_smk_view->showMessage();
?>
<form name="fgaji_karyawan_smkview" id="fgaji_karyawan_smkview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gaji_karyawan_smk">
<input type="hidden" name="modal" value="<?php echo (int)$gaji_karyawan_smk_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($gaji_karyawan_smk_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $gaji_karyawan_smk_view->TableLeftColumnClass ?>"><span id="elh_gaji_karyawan_smk_id"><?php echo $gaji_karyawan_smk_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $gaji_karyawan_smk_view->id->cellAttributes() ?>>
<span id="el_gaji_karyawan_smk_id">
<span<?php echo $gaji_karyawan_smk_view->id->viewAttributes() ?>><?php echo $gaji_karyawan_smk_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gaji_karyawan_smk_view->datetime->Visible) { // datetime ?>
	<tr id="r_datetime">
		<td class="<?php echo $gaji_karyawan_smk_view->TableLeftColumnClass ?>"><span id="elh_gaji_karyawan_smk_datetime"><?php echo $gaji_karyawan_smk_view->datetime->caption() ?></span></td>
		<td data-name="datetime" <?php echo $gaji_karyawan_smk_view->datetime->cellAttributes() ?>>
<span id="el_gaji_karyawan_smk_datetime">
<span<?php echo $gaji_karyawan_smk_view->datetime->viewAttributes() ?>><?php echo $gaji_karyawan_smk_view->datetime->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gaji_karyawan_smk_view->by->Visible) { // by ?>
	<tr id="r_by">
		<td class="<?php echo $gaji_karyawan_smk_view->TableLeftColumnClass ?>"><span id="elh_gaji_karyawan_smk_by"><?php echo $gaji_karyawan_smk_view->by->caption() ?></span></td>
		<td data-name="by" <?php echo $gaji_karyawan_smk_view->by->cellAttributes() ?>>
<span id="el_gaji_karyawan_smk_by">
<span<?php echo $gaji_karyawan_smk_view->by->viewAttributes() ?>><?php echo $gaji_karyawan_smk_view->by->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gaji_karyawan_smk_view->month->Visible) { // month ?>
	<tr id="r_month">
		<td class="<?php echo $gaji_karyawan_smk_view->TableLeftColumnClass ?>"><span id="elh_gaji_karyawan_smk_month"><?php echo $gaji_karyawan_smk_view->month->caption() ?></span></td>
		<td data-name="month" <?php echo $gaji_karyawan_smk_view->month->cellAttributes() ?>>
<span id="el_gaji_karyawan_smk_month">
<span<?php echo $gaji_karyawan_smk_view->month->viewAttributes() ?>><?php echo $gaji_karyawan_smk_view->month->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gaji_karyawan_smk_view->pid->Visible) { // pid ?>
	<tr id="r_pid">
		<td class="<?php echo $gaji_karyawan_smk_view->TableLeftColumnClass ?>"><span id="elh_gaji_karyawan_smk_pid"><?php echo $gaji_karyawan_smk_view->pid->caption() ?></span></td>
		<td data-name="pid" <?php echo $gaji_karyawan_smk_view->pid->cellAttributes() ?>>
<span id="el_gaji_karyawan_smk_pid">
<span<?php echo $gaji_karyawan_smk_view->pid->viewAttributes() ?>><?php echo $gaji_karyawan_smk_view->pid->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gaji_karyawan_smk_view->pegawai->Visible) { // pegawai ?>
	<tr id="r_pegawai">
		<td class="<?php echo $gaji_karyawan_smk_view->TableLeftColumnClass ?>"><span id="elh_gaji_karyawan_smk_pegawai"><?php echo $gaji_karyawan_smk_view->pegawai->caption() ?></span></td>
		<td data-name="pegawai" <?php echo $gaji_karyawan_smk_view->pegawai->cellAttributes() ?>>
<span id="el_gaji_karyawan_smk_pegawai">
<span<?php echo $gaji_karyawan_smk_view->pegawai->viewAttributes() ?>><?php echo $gaji_karyawan_smk_view->pegawai->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gaji_karyawan_smk_view->jenjang_id->Visible) { // jenjang_id ?>
	<tr id="r_jenjang_id">
		<td class="<?php echo $gaji_karyawan_smk_view->TableLeftColumnClass ?>"><span id="elh_gaji_karyawan_smk_jenjang_id"><?php echo $gaji_karyawan_smk_view->jenjang_id->caption() ?></span></td>
		<td data-name="jenjang_id" <?php echo $gaji_karyawan_smk_view->jenjang_id->cellAttributes() ?>>
<span id="el_gaji_karyawan_smk_jenjang_id">
<span<?php echo $gaji_karyawan_smk_view->jenjang_id->viewAttributes() ?>><?php echo $gaji_karyawan_smk_view->jenjang_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gaji_karyawan_smk_view->jabatan_id->Visible) { // jabatan_id ?>
	<tr id="r_jabatan_id">
		<td class="<?php echo $gaji_karyawan_smk_view->TableLeftColumnClass ?>"><span id="elh_gaji_karyawan_smk_jabatan_id"><?php echo $gaji_karyawan_smk_view->jabatan_id->caption() ?></span></td>
		<td data-name="jabatan_id" <?php echo $gaji_karyawan_smk_view->jabatan_id->cellAttributes() ?>>
<span id="el_gaji_karyawan_smk_jabatan_id">
<span<?php echo $gaji_karyawan_smk_view->jabatan_id->viewAttributes() ?>><?php echo $gaji_karyawan_smk_view->jabatan_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gaji_karyawan_smk_view->kehadiran->Visible) { // kehadiran ?>
	<tr id="r_kehadiran">
		<td class="<?php echo $gaji_karyawan_smk_view->TableLeftColumnClass ?>"><span id="elh_gaji_karyawan_smk_kehadiran"><?php echo $gaji_karyawan_smk_view->kehadiran->caption() ?></span></td>
		<td data-name="kehadiran" <?php echo $gaji_karyawan_smk_view->kehadiran->cellAttributes() ?>>
<span id="el_gaji_karyawan_smk_kehadiran">
<span<?php echo $gaji_karyawan_smk_view->kehadiran->viewAttributes() ?>><?php echo $gaji_karyawan_smk_view->kehadiran->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gaji_karyawan_smk_view->gapok->Visible) { // gapok ?>
	<tr id="r_gapok">
		<td class="<?php echo $gaji_karyawan_smk_view->TableLeftColumnClass ?>"><span id="elh_gaji_karyawan_smk_gapok"><?php echo $gaji_karyawan_smk_view->gapok->caption() ?></span></td>
		<td data-name="gapok" <?php echo $gaji_karyawan_smk_view->gapok->cellAttributes() ?>>
<span id="el_gaji_karyawan_smk_gapok">
<span<?php echo $gaji_karyawan_smk_view->gapok->viewAttributes() ?>><?php echo $gaji_karyawan_smk_view->gapok->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gaji_karyawan_smk_view->value_reward->Visible) { // value_reward ?>
	<tr id="r_value_reward">
		<td class="<?php echo $gaji_karyawan_smk_view->TableLeftColumnClass ?>"><span id="elh_gaji_karyawan_smk_value_reward"><?php echo $gaji_karyawan_smk_view->value_reward->caption() ?></span></td>
		<td data-name="value_reward" <?php echo $gaji_karyawan_smk_view->value_reward->cellAttributes() ?>>
<span id="el_gaji_karyawan_smk_value_reward">
<span<?php echo $gaji_karyawan_smk_view->value_reward->viewAttributes() ?>><?php echo $gaji_karyawan_smk_view->value_reward->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gaji_karyawan_smk_view->value_inval->Visible) { // value_inval ?>
	<tr id="r_value_inval">
		<td class="<?php echo $gaji_karyawan_smk_view->TableLeftColumnClass ?>"><span id="elh_gaji_karyawan_smk_value_inval"><?php echo $gaji_karyawan_smk_view->value_inval->caption() ?></span></td>
		<td data-name="value_inval" <?php echo $gaji_karyawan_smk_view->value_inval->cellAttributes() ?>>
<span id="el_gaji_karyawan_smk_value_inval">
<span<?php echo $gaji_karyawan_smk_view->value_inval->viewAttributes() ?>><?php echo $gaji_karyawan_smk_view->value_inval->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gaji_karyawan_smk_view->sub_total->Visible) { // sub_total ?>
	<tr id="r_sub_total">
		<td class="<?php echo $gaji_karyawan_smk_view->TableLeftColumnClass ?>"><span id="elh_gaji_karyawan_smk_sub_total"><?php echo $gaji_karyawan_smk_view->sub_total->caption() ?></span></td>
		<td data-name="sub_total" <?php echo $gaji_karyawan_smk_view->sub_total->cellAttributes() ?>>
<span id="el_gaji_karyawan_smk_sub_total">
<span<?php echo $gaji_karyawan_smk_view->sub_total->viewAttributes() ?>><?php echo $gaji_karyawan_smk_view->sub_total->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gaji_karyawan_smk_view->potongan->Visible) { // potongan ?>
	<tr id="r_potongan">
		<td class="<?php echo $gaji_karyawan_smk_view->TableLeftColumnClass ?>"><span id="elh_gaji_karyawan_smk_potongan"><?php echo $gaji_karyawan_smk_view->potongan->caption() ?></span></td>
		<td data-name="potongan" <?php echo $gaji_karyawan_smk_view->potongan->cellAttributes() ?>>
<span id="el_gaji_karyawan_smk_potongan">
<span<?php echo $gaji_karyawan_smk_view->potongan->viewAttributes() ?>><?php echo $gaji_karyawan_smk_view->potongan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gaji_karyawan_smk_view->penyesuaian->Visible) { // penyesuaian ?>
	<tr id="r_penyesuaian">
		<td class="<?php echo $gaji_karyawan_smk_view->TableLeftColumnClass ?>"><span id="elh_gaji_karyawan_smk_penyesuaian"><?php echo $gaji_karyawan_smk_view->penyesuaian->caption() ?></span></td>
		<td data-name="penyesuaian" <?php echo $gaji_karyawan_smk_view->penyesuaian->cellAttributes() ?>>
<span id="el_gaji_karyawan_smk_penyesuaian">
<span<?php echo $gaji_karyawan_smk_view->penyesuaian->viewAttributes() ?>><?php echo $gaji_karyawan_smk_view->penyesuaian->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gaji_karyawan_smk_view->total->Visible) { // total ?>
	<tr id="r_total">
		<td class="<?php echo $gaji_karyawan_smk_view->TableLeftColumnClass ?>"><span id="elh_gaji_karyawan_smk_total"><?php echo $gaji_karyawan_smk_view->total->caption() ?></span></td>
		<td data-name="total" <?php echo $gaji_karyawan_smk_view->total->cellAttributes() ?>>
<span id="el_gaji_karyawan_smk_total">
<span<?php echo $gaji_karyawan_smk_view->total->viewAttributes() ?>><?php echo $gaji_karyawan_smk_view->total->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gaji_karyawan_smk_view->jp->Visible) { // jp ?>
	<tr id="r_jp">
		<td class="<?php echo $gaji_karyawan_smk_view->TableLeftColumnClass ?>"><span id="elh_gaji_karyawan_smk_jp"><?php echo $gaji_karyawan_smk_view->jp->caption() ?></span></td>
		<td data-name="jp" <?php echo $gaji_karyawan_smk_view->jp->cellAttributes() ?>>
<span id="el_gaji_karyawan_smk_jp">
<span<?php echo $gaji_karyawan_smk_view->jp->viewAttributes() ?>><?php echo $gaji_karyawan_smk_view->jp->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$gaji_karyawan_smk_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$gaji_karyawan_smk_view->isExport()) { ?>
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
$gaji_karyawan_smk_view->terminate();
?>