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
$potongan_smp_delete = new potongan_smp_delete();

// Run the page
$potongan_smp_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$potongan_smp_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpotongan_smpdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fpotongan_smpdelete = currentForm = new ew.Form("fpotongan_smpdelete", "delete");
	loadjs.done("fpotongan_smpdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $potongan_smp_delete->showPageHeader(); ?>
<?php
$potongan_smp_delete->showMessage();
?>
<form name="fpotongan_smpdelete" id="fpotongan_smpdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="potongan_smp">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($potongan_smp_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($potongan_smp_delete->datetime->Visible) { // datetime ?>
		<th class="<?php echo $potongan_smp_delete->datetime->headerCellClass() ?>"><span id="elh_potongan_smp_datetime" class="potongan_smp_datetime"><?php echo $potongan_smp_delete->datetime->caption() ?></span></th>
<?php } ?>
<?php if ($potongan_smp_delete->u_by->Visible) { // u_by ?>
		<th class="<?php echo $potongan_smp_delete->u_by->headerCellClass() ?>"><span id="elh_potongan_smp_u_by" class="potongan_smp_u_by"><?php echo $potongan_smp_delete->u_by->caption() ?></span></th>
<?php } ?>
<?php if ($potongan_smp_delete->month->Visible) { // month ?>
		<th class="<?php echo $potongan_smp_delete->month->headerCellClass() ?>"><span id="elh_potongan_smp_month" class="potongan_smp_month"><?php echo $potongan_smp_delete->month->caption() ?></span></th>
<?php } ?>
<?php if ($potongan_smp_delete->nama->Visible) { // nama ?>
		<th class="<?php echo $potongan_smp_delete->nama->headerCellClass() ?>"><span id="elh_potongan_smp_nama" class="potongan_smp_nama"><?php echo $potongan_smp_delete->nama->caption() ?></span></th>
<?php } ?>
<?php if ($potongan_smp_delete->jenjang_id->Visible) { // jenjang_id ?>
		<th class="<?php echo $potongan_smp_delete->jenjang_id->headerCellClass() ?>"><span id="elh_potongan_smp_jenjang_id" class="potongan_smp_jenjang_id"><?php echo $potongan_smp_delete->jenjang_id->caption() ?></span></th>
<?php } ?>
<?php if ($potongan_smp_delete->jabatan_id->Visible) { // jabatan_id ?>
		<th class="<?php echo $potongan_smp_delete->jabatan_id->headerCellClass() ?>"><span id="elh_potongan_smp_jabatan_id" class="potongan_smp_jabatan_id"><?php echo $potongan_smp_delete->jabatan_id->caption() ?></span></th>
<?php } ?>
<?php if ($potongan_smp_delete->terlambat->Visible) { // terlambat ?>
		<th class="<?php echo $potongan_smp_delete->terlambat->headerCellClass() ?>"><span id="elh_potongan_smp_terlambat" class="potongan_smp_terlambat"><?php echo $potongan_smp_delete->terlambat->caption() ?></span></th>
<?php } ?>
<?php if ($potongan_smp_delete->value_terlambat->Visible) { // value_terlambat ?>
		<th class="<?php echo $potongan_smp_delete->value_terlambat->headerCellClass() ?>"><span id="elh_potongan_smp_value_terlambat" class="potongan_smp_value_terlambat"><?php echo $potongan_smp_delete->value_terlambat->caption() ?></span></th>
<?php } ?>
<?php if ($potongan_smp_delete->izin->Visible) { // izin ?>
		<th class="<?php echo $potongan_smp_delete->izin->headerCellClass() ?>"><span id="elh_potongan_smp_izin" class="potongan_smp_izin"><?php echo $potongan_smp_delete->izin->caption() ?></span></th>
<?php } ?>
<?php if ($potongan_smp_delete->value_izin->Visible) { // value_izin ?>
		<th class="<?php echo $potongan_smp_delete->value_izin->headerCellClass() ?>"><span id="elh_potongan_smp_value_izin" class="potongan_smp_value_izin"><?php echo $potongan_smp_delete->value_izin->caption() ?></span></th>
<?php } ?>
<?php if ($potongan_smp_delete->izinperjam->Visible) { // izinperjam ?>
		<th class="<?php echo $potongan_smp_delete->izinperjam->headerCellClass() ?>"><span id="elh_potongan_smp_izinperjam" class="potongan_smp_izinperjam"><?php echo $potongan_smp_delete->izinperjam->caption() ?></span></th>
<?php } ?>
<?php if ($potongan_smp_delete->izinperjamvalue->Visible) { // izinperjamvalue ?>
		<th class="<?php echo $potongan_smp_delete->izinperjamvalue->headerCellClass() ?>"><span id="elh_potongan_smp_izinperjamvalue" class="potongan_smp_izinperjamvalue"><?php echo $potongan_smp_delete->izinperjamvalue->caption() ?></span></th>
<?php } ?>
<?php if ($potongan_smp_delete->sakit->Visible) { // sakit ?>
		<th class="<?php echo $potongan_smp_delete->sakit->headerCellClass() ?>"><span id="elh_potongan_smp_sakit" class="potongan_smp_sakit"><?php echo $potongan_smp_delete->sakit->caption() ?></span></th>
<?php } ?>
<?php if ($potongan_smp_delete->value_sakit->Visible) { // value_sakit ?>
		<th class="<?php echo $potongan_smp_delete->value_sakit->headerCellClass() ?>"><span id="elh_potongan_smp_value_sakit" class="potongan_smp_value_sakit"><?php echo $potongan_smp_delete->value_sakit->caption() ?></span></th>
<?php } ?>
<?php if ($potongan_smp_delete->sakitperjam->Visible) { // sakitperjam ?>
		<th class="<?php echo $potongan_smp_delete->sakitperjam->headerCellClass() ?>"><span id="elh_potongan_smp_sakitperjam" class="potongan_smp_sakitperjam"><?php echo $potongan_smp_delete->sakitperjam->caption() ?></span></th>
<?php } ?>
<?php if ($potongan_smp_delete->sakitperjamvalue->Visible) { // sakitperjamvalue ?>
		<th class="<?php echo $potongan_smp_delete->sakitperjamvalue->headerCellClass() ?>"><span id="elh_potongan_smp_sakitperjamvalue" class="potongan_smp_sakitperjamvalue"><?php echo $potongan_smp_delete->sakitperjamvalue->caption() ?></span></th>
<?php } ?>
<?php if ($potongan_smp_delete->pulcep->Visible) { // pulcep ?>
		<th class="<?php echo $potongan_smp_delete->pulcep->headerCellClass() ?>"><span id="elh_potongan_smp_pulcep" class="potongan_smp_pulcep"><?php echo $potongan_smp_delete->pulcep->caption() ?></span></th>
<?php } ?>
<?php if ($potongan_smp_delete->value_pulcep->Visible) { // value_pulcep ?>
		<th class="<?php echo $potongan_smp_delete->value_pulcep->headerCellClass() ?>"><span id="elh_potongan_smp_value_pulcep" class="potongan_smp_value_pulcep"><?php echo $potongan_smp_delete->value_pulcep->caption() ?></span></th>
<?php } ?>
<?php if ($potongan_smp_delete->tidakhadir->Visible) { // tidakhadir ?>
		<th class="<?php echo $potongan_smp_delete->tidakhadir->headerCellClass() ?>"><span id="elh_potongan_smp_tidakhadir" class="potongan_smp_tidakhadir"><?php echo $potongan_smp_delete->tidakhadir->caption() ?></span></th>
<?php } ?>
<?php if ($potongan_smp_delete->value_tidakhadir->Visible) { // value_tidakhadir ?>
		<th class="<?php echo $potongan_smp_delete->value_tidakhadir->headerCellClass() ?>"><span id="elh_potongan_smp_value_tidakhadir" class="potongan_smp_value_tidakhadir"><?php echo $potongan_smp_delete->value_tidakhadir->caption() ?></span></th>
<?php } ?>
<?php if ($potongan_smp_delete->tidakhadirjam->Visible) { // tidakhadirjam ?>
		<th class="<?php echo $potongan_smp_delete->tidakhadirjam->headerCellClass() ?>"><span id="elh_potongan_smp_tidakhadirjam" class="potongan_smp_tidakhadirjam"><?php echo $potongan_smp_delete->tidakhadirjam->caption() ?></span></th>
<?php } ?>
<?php if ($potongan_smp_delete->tidakhadirjamvalue->Visible) { // tidakhadirjamvalue ?>
		<th class="<?php echo $potongan_smp_delete->tidakhadirjamvalue->headerCellClass() ?>"><span id="elh_potongan_smp_tidakhadirjamvalue" class="potongan_smp_tidakhadirjamvalue"><?php echo $potongan_smp_delete->tidakhadirjamvalue->caption() ?></span></th>
<?php } ?>
<?php if ($potongan_smp_delete->totalpotongan->Visible) { // totalpotongan ?>
		<th class="<?php echo $potongan_smp_delete->totalpotongan->headerCellClass() ?>"><span id="elh_potongan_smp_totalpotongan" class="potongan_smp_totalpotongan"><?php echo $potongan_smp_delete->totalpotongan->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$potongan_smp_delete->RecordCount = 0;
$i = 0;
while (!$potongan_smp_delete->Recordset->EOF) {
	$potongan_smp_delete->RecordCount++;
	$potongan_smp_delete->RowCount++;

	// Set row properties
	$potongan_smp->resetAttributes();
	$potongan_smp->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$potongan_smp_delete->loadRowValues($potongan_smp_delete->Recordset);

	// Render row
	$potongan_smp_delete->renderRow();
?>
	<tr <?php echo $potongan_smp->rowAttributes() ?>>
<?php if ($potongan_smp_delete->datetime->Visible) { // datetime ?>
		<td <?php echo $potongan_smp_delete->datetime->cellAttributes() ?>>
<span id="el<?php echo $potongan_smp_delete->RowCount ?>_potongan_smp_datetime" class="potongan_smp_datetime">
<span<?php echo $potongan_smp_delete->datetime->viewAttributes() ?>><?php echo $potongan_smp_delete->datetime->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($potongan_smp_delete->u_by->Visible) { // u_by ?>
		<td <?php echo $potongan_smp_delete->u_by->cellAttributes() ?>>
<span id="el<?php echo $potongan_smp_delete->RowCount ?>_potongan_smp_u_by" class="potongan_smp_u_by">
<span<?php echo $potongan_smp_delete->u_by->viewAttributes() ?>><?php echo $potongan_smp_delete->u_by->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($potongan_smp_delete->month->Visible) { // month ?>
		<td <?php echo $potongan_smp_delete->month->cellAttributes() ?>>
<span id="el<?php echo $potongan_smp_delete->RowCount ?>_potongan_smp_month" class="potongan_smp_month">
<span<?php echo $potongan_smp_delete->month->viewAttributes() ?>><?php echo $potongan_smp_delete->month->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($potongan_smp_delete->nama->Visible) { // nama ?>
		<td <?php echo $potongan_smp_delete->nama->cellAttributes() ?>>
<span id="el<?php echo $potongan_smp_delete->RowCount ?>_potongan_smp_nama" class="potongan_smp_nama">
<span<?php echo $potongan_smp_delete->nama->viewAttributes() ?>><?php echo $potongan_smp_delete->nama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($potongan_smp_delete->jenjang_id->Visible) { // jenjang_id ?>
		<td <?php echo $potongan_smp_delete->jenjang_id->cellAttributes() ?>>
<span id="el<?php echo $potongan_smp_delete->RowCount ?>_potongan_smp_jenjang_id" class="potongan_smp_jenjang_id">
<span<?php echo $potongan_smp_delete->jenjang_id->viewAttributes() ?>><?php echo $potongan_smp_delete->jenjang_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($potongan_smp_delete->jabatan_id->Visible) { // jabatan_id ?>
		<td <?php echo $potongan_smp_delete->jabatan_id->cellAttributes() ?>>
<span id="el<?php echo $potongan_smp_delete->RowCount ?>_potongan_smp_jabatan_id" class="potongan_smp_jabatan_id">
<span<?php echo $potongan_smp_delete->jabatan_id->viewAttributes() ?>><?php echo $potongan_smp_delete->jabatan_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($potongan_smp_delete->terlambat->Visible) { // terlambat ?>
		<td <?php echo $potongan_smp_delete->terlambat->cellAttributes() ?>>
<span id="el<?php echo $potongan_smp_delete->RowCount ?>_potongan_smp_terlambat" class="potongan_smp_terlambat">
<span<?php echo $potongan_smp_delete->terlambat->viewAttributes() ?>><?php echo $potongan_smp_delete->terlambat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($potongan_smp_delete->value_terlambat->Visible) { // value_terlambat ?>
		<td <?php echo $potongan_smp_delete->value_terlambat->cellAttributes() ?>>
<span id="el<?php echo $potongan_smp_delete->RowCount ?>_potongan_smp_value_terlambat" class="potongan_smp_value_terlambat">
<span<?php echo $potongan_smp_delete->value_terlambat->viewAttributes() ?>><?php echo $potongan_smp_delete->value_terlambat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($potongan_smp_delete->izin->Visible) { // izin ?>
		<td <?php echo $potongan_smp_delete->izin->cellAttributes() ?>>
<span id="el<?php echo $potongan_smp_delete->RowCount ?>_potongan_smp_izin" class="potongan_smp_izin">
<span<?php echo $potongan_smp_delete->izin->viewAttributes() ?>><?php echo $potongan_smp_delete->izin->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($potongan_smp_delete->value_izin->Visible) { // value_izin ?>
		<td <?php echo $potongan_smp_delete->value_izin->cellAttributes() ?>>
<span id="el<?php echo $potongan_smp_delete->RowCount ?>_potongan_smp_value_izin" class="potongan_smp_value_izin">
<span<?php echo $potongan_smp_delete->value_izin->viewAttributes() ?>><?php echo $potongan_smp_delete->value_izin->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($potongan_smp_delete->izinperjam->Visible) { // izinperjam ?>
		<td <?php echo $potongan_smp_delete->izinperjam->cellAttributes() ?>>
<span id="el<?php echo $potongan_smp_delete->RowCount ?>_potongan_smp_izinperjam" class="potongan_smp_izinperjam">
<span<?php echo $potongan_smp_delete->izinperjam->viewAttributes() ?>><?php echo $potongan_smp_delete->izinperjam->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($potongan_smp_delete->izinperjamvalue->Visible) { // izinperjamvalue ?>
		<td <?php echo $potongan_smp_delete->izinperjamvalue->cellAttributes() ?>>
<span id="el<?php echo $potongan_smp_delete->RowCount ?>_potongan_smp_izinperjamvalue" class="potongan_smp_izinperjamvalue">
<span<?php echo $potongan_smp_delete->izinperjamvalue->viewAttributes() ?>><?php echo $potongan_smp_delete->izinperjamvalue->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($potongan_smp_delete->sakit->Visible) { // sakit ?>
		<td <?php echo $potongan_smp_delete->sakit->cellAttributes() ?>>
<span id="el<?php echo $potongan_smp_delete->RowCount ?>_potongan_smp_sakit" class="potongan_smp_sakit">
<span<?php echo $potongan_smp_delete->sakit->viewAttributes() ?>><?php echo $potongan_smp_delete->sakit->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($potongan_smp_delete->value_sakit->Visible) { // value_sakit ?>
		<td <?php echo $potongan_smp_delete->value_sakit->cellAttributes() ?>>
<span id="el<?php echo $potongan_smp_delete->RowCount ?>_potongan_smp_value_sakit" class="potongan_smp_value_sakit">
<span<?php echo $potongan_smp_delete->value_sakit->viewAttributes() ?>><?php echo $potongan_smp_delete->value_sakit->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($potongan_smp_delete->sakitperjam->Visible) { // sakitperjam ?>
		<td <?php echo $potongan_smp_delete->sakitperjam->cellAttributes() ?>>
<span id="el<?php echo $potongan_smp_delete->RowCount ?>_potongan_smp_sakitperjam" class="potongan_smp_sakitperjam">
<span<?php echo $potongan_smp_delete->sakitperjam->viewAttributes() ?>><?php echo $potongan_smp_delete->sakitperjam->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($potongan_smp_delete->sakitperjamvalue->Visible) { // sakitperjamvalue ?>
		<td <?php echo $potongan_smp_delete->sakitperjamvalue->cellAttributes() ?>>
<span id="el<?php echo $potongan_smp_delete->RowCount ?>_potongan_smp_sakitperjamvalue" class="potongan_smp_sakitperjamvalue">
<span<?php echo $potongan_smp_delete->sakitperjamvalue->viewAttributes() ?>><?php echo $potongan_smp_delete->sakitperjamvalue->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($potongan_smp_delete->pulcep->Visible) { // pulcep ?>
		<td <?php echo $potongan_smp_delete->pulcep->cellAttributes() ?>>
<span id="el<?php echo $potongan_smp_delete->RowCount ?>_potongan_smp_pulcep" class="potongan_smp_pulcep">
<span<?php echo $potongan_smp_delete->pulcep->viewAttributes() ?>><?php echo $potongan_smp_delete->pulcep->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($potongan_smp_delete->value_pulcep->Visible) { // value_pulcep ?>
		<td <?php echo $potongan_smp_delete->value_pulcep->cellAttributes() ?>>
<span id="el<?php echo $potongan_smp_delete->RowCount ?>_potongan_smp_value_pulcep" class="potongan_smp_value_pulcep">
<span<?php echo $potongan_smp_delete->value_pulcep->viewAttributes() ?>><?php echo $potongan_smp_delete->value_pulcep->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($potongan_smp_delete->tidakhadir->Visible) { // tidakhadir ?>
		<td <?php echo $potongan_smp_delete->tidakhadir->cellAttributes() ?>>
<span id="el<?php echo $potongan_smp_delete->RowCount ?>_potongan_smp_tidakhadir" class="potongan_smp_tidakhadir">
<span<?php echo $potongan_smp_delete->tidakhadir->viewAttributes() ?>><?php echo $potongan_smp_delete->tidakhadir->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($potongan_smp_delete->value_tidakhadir->Visible) { // value_tidakhadir ?>
		<td <?php echo $potongan_smp_delete->value_tidakhadir->cellAttributes() ?>>
<span id="el<?php echo $potongan_smp_delete->RowCount ?>_potongan_smp_value_tidakhadir" class="potongan_smp_value_tidakhadir">
<span<?php echo $potongan_smp_delete->value_tidakhadir->viewAttributes() ?>><?php echo $potongan_smp_delete->value_tidakhadir->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($potongan_smp_delete->tidakhadirjam->Visible) { // tidakhadirjam ?>
		<td <?php echo $potongan_smp_delete->tidakhadirjam->cellAttributes() ?>>
<span id="el<?php echo $potongan_smp_delete->RowCount ?>_potongan_smp_tidakhadirjam" class="potongan_smp_tidakhadirjam">
<span<?php echo $potongan_smp_delete->tidakhadirjam->viewAttributes() ?>><?php echo $potongan_smp_delete->tidakhadirjam->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($potongan_smp_delete->tidakhadirjamvalue->Visible) { // tidakhadirjamvalue ?>
		<td <?php echo $potongan_smp_delete->tidakhadirjamvalue->cellAttributes() ?>>
<span id="el<?php echo $potongan_smp_delete->RowCount ?>_potongan_smp_tidakhadirjamvalue" class="potongan_smp_tidakhadirjamvalue">
<span<?php echo $potongan_smp_delete->tidakhadirjamvalue->viewAttributes() ?>><?php echo $potongan_smp_delete->tidakhadirjamvalue->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($potongan_smp_delete->totalpotongan->Visible) { // totalpotongan ?>
		<td <?php echo $potongan_smp_delete->totalpotongan->cellAttributes() ?>>
<span id="el<?php echo $potongan_smp_delete->RowCount ?>_potongan_smp_totalpotongan" class="potongan_smp_totalpotongan">
<span<?php echo $potongan_smp_delete->totalpotongan->viewAttributes() ?>><?php echo $potongan_smp_delete->totalpotongan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$potongan_smp_delete->Recordset->moveNext();
}
$potongan_smp_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $potongan_smp_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$potongan_smp_delete->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$potongan_smp_delete->terminate();
?>