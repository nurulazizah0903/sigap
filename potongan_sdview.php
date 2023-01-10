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
$potongan_sd_view = new potongan_sd_view();

// Run the page
$potongan_sd_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$potongan_sd_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$potongan_sd_view->isExport()) { ?>
<script>
var fpotongan_sdview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fpotongan_sdview = currentForm = new ew.Form("fpotongan_sdview", "view");
	loadjs.done("fpotongan_sdview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$potongan_sd_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $potongan_sd_view->ExportOptions->render("body") ?>
<?php $potongan_sd_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $potongan_sd_view->showPageHeader(); ?>
<?php
$potongan_sd_view->showMessage();
?>
<form name="fpotongan_sdview" id="fpotongan_sdview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="potongan_sd">
<input type="hidden" name="modal" value="<?php echo (int)$potongan_sd_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($potongan_sd_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $potongan_sd_view->TableLeftColumnClass ?>"><span id="elh_potongan_sd_id"><?php echo $potongan_sd_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $potongan_sd_view->id->cellAttributes() ?>>
<span id="el_potongan_sd_id">
<span<?php echo $potongan_sd_view->id->viewAttributes() ?>><?php echo $potongan_sd_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($potongan_sd_view->datetime->Visible) { // datetime ?>
	<tr id="r_datetime">
		<td class="<?php echo $potongan_sd_view->TableLeftColumnClass ?>"><span id="elh_potongan_sd_datetime"><?php echo $potongan_sd_view->datetime->caption() ?></span></td>
		<td data-name="datetime" <?php echo $potongan_sd_view->datetime->cellAttributes() ?>>
<span id="el_potongan_sd_datetime">
<span<?php echo $potongan_sd_view->datetime->viewAttributes() ?>><?php echo $potongan_sd_view->datetime->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($potongan_sd_view->u_by->Visible) { // u_by ?>
	<tr id="r_u_by">
		<td class="<?php echo $potongan_sd_view->TableLeftColumnClass ?>"><span id="elh_potongan_sd_u_by"><?php echo $potongan_sd_view->u_by->caption() ?></span></td>
		<td data-name="u_by" <?php echo $potongan_sd_view->u_by->cellAttributes() ?>>
<span id="el_potongan_sd_u_by">
<span<?php echo $potongan_sd_view->u_by->viewAttributes() ?>><?php echo $potongan_sd_view->u_by->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($potongan_sd_view->month->Visible) { // month ?>
	<tr id="r_month">
		<td class="<?php echo $potongan_sd_view->TableLeftColumnClass ?>"><span id="elh_potongan_sd_month"><?php echo $potongan_sd_view->month->caption() ?></span></td>
		<td data-name="month" <?php echo $potongan_sd_view->month->cellAttributes() ?>>
<span id="el_potongan_sd_month">
<span<?php echo $potongan_sd_view->month->viewAttributes() ?>><?php echo $potongan_sd_view->month->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($potongan_sd_view->nama->Visible) { // nama ?>
	<tr id="r_nama">
		<td class="<?php echo $potongan_sd_view->TableLeftColumnClass ?>"><span id="elh_potongan_sd_nama"><?php echo $potongan_sd_view->nama->caption() ?></span></td>
		<td data-name="nama" <?php echo $potongan_sd_view->nama->cellAttributes() ?>>
<span id="el_potongan_sd_nama">
<span<?php echo $potongan_sd_view->nama->viewAttributes() ?>><?php echo $potongan_sd_view->nama->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($potongan_sd_view->jenjang_id->Visible) { // jenjang_id ?>
	<tr id="r_jenjang_id">
		<td class="<?php echo $potongan_sd_view->TableLeftColumnClass ?>"><span id="elh_potongan_sd_jenjang_id"><?php echo $potongan_sd_view->jenjang_id->caption() ?></span></td>
		<td data-name="jenjang_id" <?php echo $potongan_sd_view->jenjang_id->cellAttributes() ?>>
<span id="el_potongan_sd_jenjang_id">
<span<?php echo $potongan_sd_view->jenjang_id->viewAttributes() ?>><?php echo $potongan_sd_view->jenjang_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($potongan_sd_view->jabatan_id->Visible) { // jabatan_id ?>
	<tr id="r_jabatan_id">
		<td class="<?php echo $potongan_sd_view->TableLeftColumnClass ?>"><span id="elh_potongan_sd_jabatan_id"><?php echo $potongan_sd_view->jabatan_id->caption() ?></span></td>
		<td data-name="jabatan_id" <?php echo $potongan_sd_view->jabatan_id->cellAttributes() ?>>
<span id="el_potongan_sd_jabatan_id">
<span<?php echo $potongan_sd_view->jabatan_id->viewAttributes() ?>><?php echo $potongan_sd_view->jabatan_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($potongan_sd_view->terlambat->Visible) { // terlambat ?>
	<tr id="r_terlambat">
		<td class="<?php echo $potongan_sd_view->TableLeftColumnClass ?>"><span id="elh_potongan_sd_terlambat"><?php echo $potongan_sd_view->terlambat->caption() ?></span></td>
		<td data-name="terlambat" <?php echo $potongan_sd_view->terlambat->cellAttributes() ?>>
<span id="el_potongan_sd_terlambat">
<span<?php echo $potongan_sd_view->terlambat->viewAttributes() ?>><?php echo $potongan_sd_view->terlambat->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($potongan_sd_view->value_terlambat->Visible) { // value_terlambat ?>
	<tr id="r_value_terlambat">
		<td class="<?php echo $potongan_sd_view->TableLeftColumnClass ?>"><span id="elh_potongan_sd_value_terlambat"><?php echo $potongan_sd_view->value_terlambat->caption() ?></span></td>
		<td data-name="value_terlambat" <?php echo $potongan_sd_view->value_terlambat->cellAttributes() ?>>
<span id="el_potongan_sd_value_terlambat">
<span<?php echo $potongan_sd_view->value_terlambat->viewAttributes() ?>><?php echo $potongan_sd_view->value_terlambat->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($potongan_sd_view->izin->Visible) { // izin ?>
	<tr id="r_izin">
		<td class="<?php echo $potongan_sd_view->TableLeftColumnClass ?>"><span id="elh_potongan_sd_izin"><?php echo $potongan_sd_view->izin->caption() ?></span></td>
		<td data-name="izin" <?php echo $potongan_sd_view->izin->cellAttributes() ?>>
<span id="el_potongan_sd_izin">
<span<?php echo $potongan_sd_view->izin->viewAttributes() ?>><?php echo $potongan_sd_view->izin->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($potongan_sd_view->value_izin->Visible) { // value_izin ?>
	<tr id="r_value_izin">
		<td class="<?php echo $potongan_sd_view->TableLeftColumnClass ?>"><span id="elh_potongan_sd_value_izin"><?php echo $potongan_sd_view->value_izin->caption() ?></span></td>
		<td data-name="value_izin" <?php echo $potongan_sd_view->value_izin->cellAttributes() ?>>
<span id="el_potongan_sd_value_izin">
<span<?php echo $potongan_sd_view->value_izin->viewAttributes() ?>><?php echo $potongan_sd_view->value_izin->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($potongan_sd_view->izinperjam->Visible) { // izinperjam ?>
	<tr id="r_izinperjam">
		<td class="<?php echo $potongan_sd_view->TableLeftColumnClass ?>"><span id="elh_potongan_sd_izinperjam"><?php echo $potongan_sd_view->izinperjam->caption() ?></span></td>
		<td data-name="izinperjam" <?php echo $potongan_sd_view->izinperjam->cellAttributes() ?>>
<span id="el_potongan_sd_izinperjam">
<span<?php echo $potongan_sd_view->izinperjam->viewAttributes() ?>><?php echo $potongan_sd_view->izinperjam->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($potongan_sd_view->izinperjamvalue->Visible) { // izinperjamvalue ?>
	<tr id="r_izinperjamvalue">
		<td class="<?php echo $potongan_sd_view->TableLeftColumnClass ?>"><span id="elh_potongan_sd_izinperjamvalue"><?php echo $potongan_sd_view->izinperjamvalue->caption() ?></span></td>
		<td data-name="izinperjamvalue" <?php echo $potongan_sd_view->izinperjamvalue->cellAttributes() ?>>
<span id="el_potongan_sd_izinperjamvalue">
<span<?php echo $potongan_sd_view->izinperjamvalue->viewAttributes() ?>><?php echo $potongan_sd_view->izinperjamvalue->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($potongan_sd_view->sakit->Visible) { // sakit ?>
	<tr id="r_sakit">
		<td class="<?php echo $potongan_sd_view->TableLeftColumnClass ?>"><span id="elh_potongan_sd_sakit"><?php echo $potongan_sd_view->sakit->caption() ?></span></td>
		<td data-name="sakit" <?php echo $potongan_sd_view->sakit->cellAttributes() ?>>
<span id="el_potongan_sd_sakit">
<span<?php echo $potongan_sd_view->sakit->viewAttributes() ?>><?php echo $potongan_sd_view->sakit->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($potongan_sd_view->value_sakit->Visible) { // value_sakit ?>
	<tr id="r_value_sakit">
		<td class="<?php echo $potongan_sd_view->TableLeftColumnClass ?>"><span id="elh_potongan_sd_value_sakit"><?php echo $potongan_sd_view->value_sakit->caption() ?></span></td>
		<td data-name="value_sakit" <?php echo $potongan_sd_view->value_sakit->cellAttributes() ?>>
<span id="el_potongan_sd_value_sakit">
<span<?php echo $potongan_sd_view->value_sakit->viewAttributes() ?>><?php echo $potongan_sd_view->value_sakit->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($potongan_sd_view->sakitperjam->Visible) { // sakitperjam ?>
	<tr id="r_sakitperjam">
		<td class="<?php echo $potongan_sd_view->TableLeftColumnClass ?>"><span id="elh_potongan_sd_sakitperjam"><?php echo $potongan_sd_view->sakitperjam->caption() ?></span></td>
		<td data-name="sakitperjam" <?php echo $potongan_sd_view->sakitperjam->cellAttributes() ?>>
<span id="el_potongan_sd_sakitperjam">
<span<?php echo $potongan_sd_view->sakitperjam->viewAttributes() ?>><?php echo $potongan_sd_view->sakitperjam->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($potongan_sd_view->sakitperjamvalue->Visible) { // sakitperjamvalue ?>
	<tr id="r_sakitperjamvalue">
		<td class="<?php echo $potongan_sd_view->TableLeftColumnClass ?>"><span id="elh_potongan_sd_sakitperjamvalue"><?php echo $potongan_sd_view->sakitperjamvalue->caption() ?></span></td>
		<td data-name="sakitperjamvalue" <?php echo $potongan_sd_view->sakitperjamvalue->cellAttributes() ?>>
<span id="el_potongan_sd_sakitperjamvalue">
<span<?php echo $potongan_sd_view->sakitperjamvalue->viewAttributes() ?>><?php echo $potongan_sd_view->sakitperjamvalue->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($potongan_sd_view->pulcep->Visible) { // pulcep ?>
	<tr id="r_pulcep">
		<td class="<?php echo $potongan_sd_view->TableLeftColumnClass ?>"><span id="elh_potongan_sd_pulcep"><?php echo $potongan_sd_view->pulcep->caption() ?></span></td>
		<td data-name="pulcep" <?php echo $potongan_sd_view->pulcep->cellAttributes() ?>>
<span id="el_potongan_sd_pulcep">
<span<?php echo $potongan_sd_view->pulcep->viewAttributes() ?>><?php echo $potongan_sd_view->pulcep->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($potongan_sd_view->value_pulcep->Visible) { // value_pulcep ?>
	<tr id="r_value_pulcep">
		<td class="<?php echo $potongan_sd_view->TableLeftColumnClass ?>"><span id="elh_potongan_sd_value_pulcep"><?php echo $potongan_sd_view->value_pulcep->caption() ?></span></td>
		<td data-name="value_pulcep" <?php echo $potongan_sd_view->value_pulcep->cellAttributes() ?>>
<span id="el_potongan_sd_value_pulcep">
<span<?php echo $potongan_sd_view->value_pulcep->viewAttributes() ?>><?php echo $potongan_sd_view->value_pulcep->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($potongan_sd_view->tidakhadir->Visible) { // tidakhadir ?>
	<tr id="r_tidakhadir">
		<td class="<?php echo $potongan_sd_view->TableLeftColumnClass ?>"><span id="elh_potongan_sd_tidakhadir"><?php echo $potongan_sd_view->tidakhadir->caption() ?></span></td>
		<td data-name="tidakhadir" <?php echo $potongan_sd_view->tidakhadir->cellAttributes() ?>>
<span id="el_potongan_sd_tidakhadir">
<span<?php echo $potongan_sd_view->tidakhadir->viewAttributes() ?>><?php echo $potongan_sd_view->tidakhadir->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($potongan_sd_view->value_tidakhadir->Visible) { // value_tidakhadir ?>
	<tr id="r_value_tidakhadir">
		<td class="<?php echo $potongan_sd_view->TableLeftColumnClass ?>"><span id="elh_potongan_sd_value_tidakhadir"><?php echo $potongan_sd_view->value_tidakhadir->caption() ?></span></td>
		<td data-name="value_tidakhadir" <?php echo $potongan_sd_view->value_tidakhadir->cellAttributes() ?>>
<span id="el_potongan_sd_value_tidakhadir">
<span<?php echo $potongan_sd_view->value_tidakhadir->viewAttributes() ?>><?php echo $potongan_sd_view->value_tidakhadir->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($potongan_sd_view->tidakhadirjam->Visible) { // tidakhadirjam ?>
	<tr id="r_tidakhadirjam">
		<td class="<?php echo $potongan_sd_view->TableLeftColumnClass ?>"><span id="elh_potongan_sd_tidakhadirjam"><?php echo $potongan_sd_view->tidakhadirjam->caption() ?></span></td>
		<td data-name="tidakhadirjam" <?php echo $potongan_sd_view->tidakhadirjam->cellAttributes() ?>>
<span id="el_potongan_sd_tidakhadirjam">
<span<?php echo $potongan_sd_view->tidakhadirjam->viewAttributes() ?>><?php echo $potongan_sd_view->tidakhadirjam->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($potongan_sd_view->tidakhadirjamvalue->Visible) { // tidakhadirjamvalue ?>
	<tr id="r_tidakhadirjamvalue">
		<td class="<?php echo $potongan_sd_view->TableLeftColumnClass ?>"><span id="elh_potongan_sd_tidakhadirjamvalue"><?php echo $potongan_sd_view->tidakhadirjamvalue->caption() ?></span></td>
		<td data-name="tidakhadirjamvalue" <?php echo $potongan_sd_view->tidakhadirjamvalue->cellAttributes() ?>>
<span id="el_potongan_sd_tidakhadirjamvalue">
<span<?php echo $potongan_sd_view->tidakhadirjamvalue->viewAttributes() ?>><?php echo $potongan_sd_view->tidakhadirjamvalue->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($potongan_sd_view->totalpotongan->Visible) { // totalpotongan ?>
	<tr id="r_totalpotongan">
		<td class="<?php echo $potongan_sd_view->TableLeftColumnClass ?>"><span id="elh_potongan_sd_totalpotongan"><?php echo $potongan_sd_view->totalpotongan->caption() ?></span></td>
		<td data-name="totalpotongan" <?php echo $potongan_sd_view->totalpotongan->cellAttributes() ?>>
<span id="el_potongan_sd_totalpotongan">
<span<?php echo $potongan_sd_view->totalpotongan->viewAttributes() ?>><?php echo $potongan_sd_view->totalpotongan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$potongan_sd_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$potongan_sd_view->isExport()) { ?>
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
$potongan_sd_view->terminate();
?>