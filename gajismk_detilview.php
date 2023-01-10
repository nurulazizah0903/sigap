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
$gajismk_detil_view = new gajismk_detil_view();

// Run the page
$gajismk_detil_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gajismk_detil_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$gajismk_detil_view->isExport()) { ?>
<script>
var fgajismk_detilview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fgajismk_detilview = currentForm = new ew.Form("fgajismk_detilview", "view");
	loadjs.done("fgajismk_detilview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$gajismk_detil_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $gajismk_detil_view->ExportOptions->render("body") ?>
<?php $gajismk_detil_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $gajismk_detil_view->showPageHeader(); ?>
<?php
$gajismk_detil_view->showMessage();
?>
<form name="fgajismk_detilview" id="fgajismk_detilview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gajismk_detil">
<input type="hidden" name="modal" value="<?php echo (int)$gajismk_detil_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($gajismk_detil_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $gajismk_detil_view->TableLeftColumnClass ?>"><span id="elh_gajismk_detil_id"><?php echo $gajismk_detil_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $gajismk_detil_view->id->cellAttributes() ?>>
<span id="el_gajismk_detil_id">
<span<?php echo $gajismk_detil_view->id->viewAttributes() ?>><?php echo $gajismk_detil_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gajismk_detil_view->pid->Visible) { // pid ?>
	<tr id="r_pid">
		<td class="<?php echo $gajismk_detil_view->TableLeftColumnClass ?>"><span id="elh_gajismk_detil_pid"><?php echo $gajismk_detil_view->pid->caption() ?></span></td>
		<td data-name="pid" <?php echo $gajismk_detil_view->pid->cellAttributes() ?>>
<span id="el_gajismk_detil_pid">
<span<?php echo $gajismk_detil_view->pid->viewAttributes() ?>><?php echo $gajismk_detil_view->pid->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gajismk_detil_view->pegawai_id->Visible) { // pegawai_id ?>
	<tr id="r_pegawai_id">
		<td class="<?php echo $gajismk_detil_view->TableLeftColumnClass ?>"><span id="elh_gajismk_detil_pegawai_id"><?php echo $gajismk_detil_view->pegawai_id->caption() ?></span></td>
		<td data-name="pegawai_id" <?php echo $gajismk_detil_view->pegawai_id->cellAttributes() ?>>
<span id="el_gajismk_detil_pegawai_id">
<span<?php echo $gajismk_detil_view->pegawai_id->viewAttributes() ?>><?php echo $gajismk_detil_view->pegawai_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gajismk_detil_view->jabatan_id->Visible) { // jabatan_id ?>
	<tr id="r_jabatan_id">
		<td class="<?php echo $gajismk_detil_view->TableLeftColumnClass ?>"><span id="elh_gajismk_detil_jabatan_id"><?php echo $gajismk_detil_view->jabatan_id->caption() ?></span></td>
		<td data-name="jabatan_id" <?php echo $gajismk_detil_view->jabatan_id->cellAttributes() ?>>
<span id="el_gajismk_detil_jabatan_id">
<span<?php echo $gajismk_detil_view->jabatan_id->viewAttributes() ?>><?php echo $gajismk_detil_view->jabatan_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gajismk_detil_view->masakerja->Visible) { // masakerja ?>
	<tr id="r_masakerja">
		<td class="<?php echo $gajismk_detil_view->TableLeftColumnClass ?>"><span id="elh_gajismk_detil_masakerja"><?php echo $gajismk_detil_view->masakerja->caption() ?></span></td>
		<td data-name="masakerja" <?php echo $gajismk_detil_view->masakerja->cellAttributes() ?>>
<span id="el_gajismk_detil_masakerja">
<span<?php echo $gajismk_detil_view->masakerja->viewAttributes() ?>><?php echo $gajismk_detil_view->masakerja->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gajismk_detil_view->jumngajar->Visible) { // jumngajar ?>
	<tr id="r_jumngajar">
		<td class="<?php echo $gajismk_detil_view->TableLeftColumnClass ?>"><span id="elh_gajismk_detil_jumngajar"><?php echo $gajismk_detil_view->jumngajar->caption() ?></span></td>
		<td data-name="jumngajar" <?php echo $gajismk_detil_view->jumngajar->cellAttributes() ?>>
<span id="el_gajismk_detil_jumngajar">
<span<?php echo $gajismk_detil_view->jumngajar->viewAttributes() ?>><?php echo $gajismk_detil_view->jumngajar->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gajismk_detil_view->ijin->Visible) { // ijin ?>
	<tr id="r_ijin">
		<td class="<?php echo $gajismk_detil_view->TableLeftColumnClass ?>"><span id="elh_gajismk_detil_ijin"><?php echo $gajismk_detil_view->ijin->caption() ?></span></td>
		<td data-name="ijin" <?php echo $gajismk_detil_view->ijin->cellAttributes() ?>>
<span id="el_gajismk_detil_ijin">
<span<?php echo $gajismk_detil_view->ijin->viewAttributes() ?>><?php echo $gajismk_detil_view->ijin->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gajismk_detil_view->tunjangan_wkosis->Visible) { // tunjangan_wkosis ?>
	<tr id="r_tunjangan_wkosis">
		<td class="<?php echo $gajismk_detil_view->TableLeftColumnClass ?>"><span id="elh_gajismk_detil_tunjangan_wkosis"><?php echo $gajismk_detil_view->tunjangan_wkosis->caption() ?></span></td>
		<td data-name="tunjangan_wkosis" <?php echo $gajismk_detil_view->tunjangan_wkosis->cellAttributes() ?>>
<span id="el_gajismk_detil_tunjangan_wkosis">
<span<?php echo $gajismk_detil_view->tunjangan_wkosis->viewAttributes() ?>><?php echo $gajismk_detil_view->tunjangan_wkosis->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gajismk_detil_view->nominal_baku->Visible) { // nominal_baku ?>
	<tr id="r_nominal_baku">
		<td class="<?php echo $gajismk_detil_view->TableLeftColumnClass ?>"><span id="elh_gajismk_detil_nominal_baku"><?php echo $gajismk_detil_view->nominal_baku->caption() ?></span></td>
		<td data-name="nominal_baku" <?php echo $gajismk_detil_view->nominal_baku->cellAttributes() ?>>
<span id="el_gajismk_detil_nominal_baku">
<span<?php echo $gajismk_detil_view->nominal_baku->viewAttributes() ?>><?php echo $gajismk_detil_view->nominal_baku->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gajismk_detil_view->baku->Visible) { // baku ?>
	<tr id="r_baku">
		<td class="<?php echo $gajismk_detil_view->TableLeftColumnClass ?>"><span id="elh_gajismk_detil_baku"><?php echo $gajismk_detil_view->baku->caption() ?></span></td>
		<td data-name="baku" <?php echo $gajismk_detil_view->baku->cellAttributes() ?>>
<span id="el_gajismk_detil_baku">
<span<?php echo $gajismk_detil_view->baku->viewAttributes() ?>><?php echo $gajismk_detil_view->baku->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gajismk_detil_view->kehadiran->Visible) { // kehadiran ?>
	<tr id="r_kehadiran">
		<td class="<?php echo $gajismk_detil_view->TableLeftColumnClass ?>"><span id="elh_gajismk_detil_kehadiran"><?php echo $gajismk_detil_view->kehadiran->caption() ?></span></td>
		<td data-name="kehadiran" <?php echo $gajismk_detil_view->kehadiran->cellAttributes() ?>>
<span id="el_gajismk_detil_kehadiran">
<span<?php echo $gajismk_detil_view->kehadiran->viewAttributes() ?>><?php echo $gajismk_detil_view->kehadiran->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gajismk_detil_view->prestasi->Visible) { // prestasi ?>
	<tr id="r_prestasi">
		<td class="<?php echo $gajismk_detil_view->TableLeftColumnClass ?>"><span id="elh_gajismk_detil_prestasi"><?php echo $gajismk_detil_view->prestasi->caption() ?></span></td>
		<td data-name="prestasi" <?php echo $gajismk_detil_view->prestasi->cellAttributes() ?>>
<span id="el_gajismk_detil_prestasi">
<span<?php echo $gajismk_detil_view->prestasi->viewAttributes() ?>><?php echo $gajismk_detil_view->prestasi->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gajismk_detil_view->jumlahgaji->Visible) { // jumlahgaji ?>
	<tr id="r_jumlahgaji">
		<td class="<?php echo $gajismk_detil_view->TableLeftColumnClass ?>"><span id="elh_gajismk_detil_jumlahgaji"><?php echo $gajismk_detil_view->jumlahgaji->caption() ?></span></td>
		<td data-name="jumlahgaji" <?php echo $gajismk_detil_view->jumlahgaji->cellAttributes() ?>>
<span id="el_gajismk_detil_jumlahgaji">
<span<?php echo $gajismk_detil_view->jumlahgaji->viewAttributes() ?>><?php echo $gajismk_detil_view->jumlahgaji->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gajismk_detil_view->jumgajitotal->Visible) { // jumgajitotal ?>
	<tr id="r_jumgajitotal">
		<td class="<?php echo $gajismk_detil_view->TableLeftColumnClass ?>"><span id="elh_gajismk_detil_jumgajitotal"><?php echo $gajismk_detil_view->jumgajitotal->caption() ?></span></td>
		<td data-name="jumgajitotal" <?php echo $gajismk_detil_view->jumgajitotal->cellAttributes() ?>>
<span id="el_gajismk_detil_jumgajitotal">
<span<?php echo $gajismk_detil_view->jumgajitotal->viewAttributes() ?>><?php echo $gajismk_detil_view->jumgajitotal->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gajismk_detil_view->potongan1->Visible) { // potongan1 ?>
	<tr id="r_potongan1">
		<td class="<?php echo $gajismk_detil_view->TableLeftColumnClass ?>"><span id="elh_gajismk_detil_potongan1"><?php echo $gajismk_detil_view->potongan1->caption() ?></span></td>
		<td data-name="potongan1" <?php echo $gajismk_detil_view->potongan1->cellAttributes() ?>>
<span id="el_gajismk_detil_potongan1">
<span<?php echo $gajismk_detil_view->potongan1->viewAttributes() ?>><?php echo $gajismk_detil_view->potongan1->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gajismk_detil_view->potongan2->Visible) { // potongan2 ?>
	<tr id="r_potongan2">
		<td class="<?php echo $gajismk_detil_view->TableLeftColumnClass ?>"><span id="elh_gajismk_detil_potongan2"><?php echo $gajismk_detil_view->potongan2->caption() ?></span></td>
		<td data-name="potongan2" <?php echo $gajismk_detil_view->potongan2->cellAttributes() ?>>
<span id="el_gajismk_detil_potongan2">
<span<?php echo $gajismk_detil_view->potongan2->viewAttributes() ?>><?php echo $gajismk_detil_view->potongan2->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gajismk_detil_view->jumlahterima->Visible) { // jumlahterima ?>
	<tr id="r_jumlahterima">
		<td class="<?php echo $gajismk_detil_view->TableLeftColumnClass ?>"><span id="elh_gajismk_detil_jumlahterima"><?php echo $gajismk_detil_view->jumlahterima->caption() ?></span></td>
		<td data-name="jumlahterima" <?php echo $gajismk_detil_view->jumlahterima->cellAttributes() ?>>
<span id="el_gajismk_detil_jumlahterima">
<span<?php echo $gajismk_detil_view->jumlahterima->viewAttributes() ?>><?php echo $gajismk_detil_view->jumlahterima->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$gajismk_detil_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$gajismk_detil_view->isExport()) { ?>
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
$gajismk_detil_view->terminate();
?>