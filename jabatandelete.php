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
$jabatan_delete = new jabatan_delete();

// Run the page
$jabatan_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$jabatan_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fjabatandelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fjabatandelete = currentForm = new ew.Form("fjabatandelete", "delete");
	loadjs.done("fjabatandelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $jabatan_delete->showPageHeader(); ?>
<?php
$jabatan_delete->showMessage();
?>
<form name="fjabatandelete" id="fjabatandelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="jabatan">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($jabatan_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($jabatan_delete->nama_jabatan->Visible) { // nama_jabatan ?>
		<th class="<?php echo $jabatan_delete->nama_jabatan->headerCellClass() ?>"><span id="elh_jabatan_nama_jabatan" class="jabatan_nama_jabatan"><?php echo $jabatan_delete->nama_jabatan->caption() ?></span></th>
<?php } ?>
<?php if ($jabatan_delete->type_jabatan->Visible) { // type_jabatan ?>
		<th class="<?php echo $jabatan_delete->type_jabatan->headerCellClass() ?>"><span id="elh_jabatan_type_jabatan" class="jabatan_type_jabatan"><?php echo $jabatan_delete->type_jabatan->caption() ?></span></th>
<?php } ?>
<?php if ($jabatan_delete->jenjang->Visible) { // jenjang ?>
		<th class="<?php echo $jabatan_delete->jenjang->headerCellClass() ?>"><span id="elh_jabatan_jenjang" class="jabatan_jenjang"><?php echo $jabatan_delete->jenjang->caption() ?></span></th>
<?php } ?>
<?php if ($jabatan_delete->type_guru->Visible) { // type_guru ?>
		<th class="<?php echo $jabatan_delete->type_guru->headerCellClass() ?>"><span id="elh_jabatan_type_guru" class="jabatan_type_guru"><?php echo $jabatan_delete->type_guru->caption() ?></span></th>
<?php } ?>
<?php if ($jabatan_delete->keterangan->Visible) { // keterangan ?>
		<th class="<?php echo $jabatan_delete->keterangan->headerCellClass() ?>"><span id="elh_jabatan_keterangan" class="jabatan_keterangan"><?php echo $jabatan_delete->keterangan->caption() ?></span></th>
<?php } ?>
<?php if ($jabatan_delete->c_by->Visible) { // c_by ?>
		<th class="<?php echo $jabatan_delete->c_by->headerCellClass() ?>"><span id="elh_jabatan_c_by" class="jabatan_c_by"><?php echo $jabatan_delete->c_by->caption() ?></span></th>
<?php } ?>
<?php if ($jabatan_delete->c_date->Visible) { // c_date ?>
		<th class="<?php echo $jabatan_delete->c_date->headerCellClass() ?>"><span id="elh_jabatan_c_date" class="jabatan_c_date"><?php echo $jabatan_delete->c_date->caption() ?></span></th>
<?php } ?>
<?php if ($jabatan_delete->u_by->Visible) { // u_by ?>
		<th class="<?php echo $jabatan_delete->u_by->headerCellClass() ?>"><span id="elh_jabatan_u_by" class="jabatan_u_by"><?php echo $jabatan_delete->u_by->caption() ?></span></th>
<?php } ?>
<?php if ($jabatan_delete->u_date->Visible) { // u_date ?>
		<th class="<?php echo $jabatan_delete->u_date->headerCellClass() ?>"><span id="elh_jabatan_u_date" class="jabatan_u_date"><?php echo $jabatan_delete->u_date->caption() ?></span></th>
<?php } ?>
<?php if ($jabatan_delete->aktif->Visible) { // aktif ?>
		<th class="<?php echo $jabatan_delete->aktif->headerCellClass() ?>"><span id="elh_jabatan_aktif" class="jabatan_aktif"><?php echo $jabatan_delete->aktif->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$jabatan_delete->RecordCount = 0;
$i = 0;
while (!$jabatan_delete->Recordset->EOF) {
	$jabatan_delete->RecordCount++;
	$jabatan_delete->RowCount++;

	// Set row properties
	$jabatan->resetAttributes();
	$jabatan->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$jabatan_delete->loadRowValues($jabatan_delete->Recordset);

	// Render row
	$jabatan_delete->renderRow();
?>
	<tr <?php echo $jabatan->rowAttributes() ?>>
<?php if ($jabatan_delete->nama_jabatan->Visible) { // nama_jabatan ?>
		<td <?php echo $jabatan_delete->nama_jabatan->cellAttributes() ?>>
<span id="el<?php echo $jabatan_delete->RowCount ?>_jabatan_nama_jabatan" class="jabatan_nama_jabatan">
<span<?php echo $jabatan_delete->nama_jabatan->viewAttributes() ?>><?php echo $jabatan_delete->nama_jabatan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($jabatan_delete->type_jabatan->Visible) { // type_jabatan ?>
		<td <?php echo $jabatan_delete->type_jabatan->cellAttributes() ?>>
<span id="el<?php echo $jabatan_delete->RowCount ?>_jabatan_type_jabatan" class="jabatan_type_jabatan">
<span<?php echo $jabatan_delete->type_jabatan->viewAttributes() ?>><?php echo $jabatan_delete->type_jabatan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($jabatan_delete->jenjang->Visible) { // jenjang ?>
		<td <?php echo $jabatan_delete->jenjang->cellAttributes() ?>>
<span id="el<?php echo $jabatan_delete->RowCount ?>_jabatan_jenjang" class="jabatan_jenjang">
<span<?php echo $jabatan_delete->jenjang->viewAttributes() ?>><?php echo $jabatan_delete->jenjang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($jabatan_delete->type_guru->Visible) { // type_guru ?>
		<td <?php echo $jabatan_delete->type_guru->cellAttributes() ?>>
<span id="el<?php echo $jabatan_delete->RowCount ?>_jabatan_type_guru" class="jabatan_type_guru">
<span<?php echo $jabatan_delete->type_guru->viewAttributes() ?>><?php echo $jabatan_delete->type_guru->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($jabatan_delete->keterangan->Visible) { // keterangan ?>
		<td <?php echo $jabatan_delete->keterangan->cellAttributes() ?>>
<span id="el<?php echo $jabatan_delete->RowCount ?>_jabatan_keterangan" class="jabatan_keterangan">
<span<?php echo $jabatan_delete->keterangan->viewAttributes() ?>><?php echo $jabatan_delete->keterangan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($jabatan_delete->c_by->Visible) { // c_by ?>
		<td <?php echo $jabatan_delete->c_by->cellAttributes() ?>>
<span id="el<?php echo $jabatan_delete->RowCount ?>_jabatan_c_by" class="jabatan_c_by">
<span<?php echo $jabatan_delete->c_by->viewAttributes() ?>><?php echo $jabatan_delete->c_by->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($jabatan_delete->c_date->Visible) { // c_date ?>
		<td <?php echo $jabatan_delete->c_date->cellAttributes() ?>>
<span id="el<?php echo $jabatan_delete->RowCount ?>_jabatan_c_date" class="jabatan_c_date">
<span<?php echo $jabatan_delete->c_date->viewAttributes() ?>><?php echo $jabatan_delete->c_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($jabatan_delete->u_by->Visible) { // u_by ?>
		<td <?php echo $jabatan_delete->u_by->cellAttributes() ?>>
<span id="el<?php echo $jabatan_delete->RowCount ?>_jabatan_u_by" class="jabatan_u_by">
<span<?php echo $jabatan_delete->u_by->viewAttributes() ?>><?php echo $jabatan_delete->u_by->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($jabatan_delete->u_date->Visible) { // u_date ?>
		<td <?php echo $jabatan_delete->u_date->cellAttributes() ?>>
<span id="el<?php echo $jabatan_delete->RowCount ?>_jabatan_u_date" class="jabatan_u_date">
<span<?php echo $jabatan_delete->u_date->viewAttributes() ?>><?php echo $jabatan_delete->u_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($jabatan_delete->aktif->Visible) { // aktif ?>
		<td <?php echo $jabatan_delete->aktif->cellAttributes() ?>>
<span id="el<?php echo $jabatan_delete->RowCount ?>_jabatan_aktif" class="jabatan_aktif">
<span<?php echo $jabatan_delete->aktif->viewAttributes() ?>><?php echo $jabatan_delete->aktif->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$jabatan_delete->Recordset->moveNext();
}
$jabatan_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $jabatan_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$jabatan_delete->showPageFooter();
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
$jabatan_delete->terminate();
?>