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
$pengetahuan_delete = new pengetahuan_delete();

// Run the page
$pengetahuan_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pengetahuan_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpengetahuandelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fpengetahuandelete = currentForm = new ew.Form("fpengetahuandelete", "delete");
	loadjs.done("fpengetahuandelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $pengetahuan_delete->showPageHeader(); ?>
<?php
$pengetahuan_delete->showMessage();
?>
<form name="fpengetahuandelete" id="fpengetahuandelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pengetahuan">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($pengetahuan_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($pengetahuan_delete->id->Visible) { // id ?>
		<th class="<?php echo $pengetahuan_delete->id->headerCellClass() ?>"><span id="elh_pengetahuan_id" class="pengetahuan_id"><?php echo $pengetahuan_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($pengetahuan_delete->grup->Visible) { // grup ?>
		<th class="<?php echo $pengetahuan_delete->grup->headerCellClass() ?>"><span id="elh_pengetahuan_grup" class="pengetahuan_grup"><?php echo $pengetahuan_delete->grup->caption() ?></span></th>
<?php } ?>
<?php if ($pengetahuan_delete->sumber_url->Visible) { // sumber_url ?>
		<th class="<?php echo $pengetahuan_delete->sumber_url->headerCellClass() ?>"><span id="elh_pengetahuan_sumber_url" class="pengetahuan_sumber_url"><?php echo $pengetahuan_delete->sumber_url->caption() ?></span></th>
<?php } ?>
<?php if ($pengetahuan_delete->dokumen->Visible) { // dokumen ?>
		<th class="<?php echo $pengetahuan_delete->dokumen->headerCellClass() ?>"><span id="elh_pengetahuan_dokumen" class="pengetahuan_dokumen"><?php echo $pengetahuan_delete->dokumen->caption() ?></span></th>
<?php } ?>
<?php if ($pengetahuan_delete->visual->Visible) { // visual ?>
		<th class="<?php echo $pengetahuan_delete->visual->headerCellClass() ?>"><span id="elh_pengetahuan_visual" class="pengetahuan_visual"><?php echo $pengetahuan_delete->visual->caption() ?></span></th>
<?php } ?>
<?php if ($pengetahuan_delete->c_by->Visible) { // c_by ?>
		<th class="<?php echo $pengetahuan_delete->c_by->headerCellClass() ?>"><span id="elh_pengetahuan_c_by" class="pengetahuan_c_by"><?php echo $pengetahuan_delete->c_by->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$pengetahuan_delete->RecordCount = 0;
$i = 0;
while (!$pengetahuan_delete->Recordset->EOF) {
	$pengetahuan_delete->RecordCount++;
	$pengetahuan_delete->RowCount++;

	// Set row properties
	$pengetahuan->resetAttributes();
	$pengetahuan->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$pengetahuan_delete->loadRowValues($pengetahuan_delete->Recordset);

	// Render row
	$pengetahuan_delete->renderRow();
?>
	<tr <?php echo $pengetahuan->rowAttributes() ?>>
<?php if ($pengetahuan_delete->id->Visible) { // id ?>
		<td <?php echo $pengetahuan_delete->id->cellAttributes() ?>>
<span id="el<?php echo $pengetahuan_delete->RowCount ?>_pengetahuan_id" class="pengetahuan_id">
<span<?php echo $pengetahuan_delete->id->viewAttributes() ?>><?php echo $pengetahuan_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pengetahuan_delete->grup->Visible) { // grup ?>
		<td <?php echo $pengetahuan_delete->grup->cellAttributes() ?>>
<span id="el<?php echo $pengetahuan_delete->RowCount ?>_pengetahuan_grup" class="pengetahuan_grup">
<span<?php echo $pengetahuan_delete->grup->viewAttributes() ?>><?php echo $pengetahuan_delete->grup->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pengetahuan_delete->sumber_url->Visible) { // sumber_url ?>
		<td <?php echo $pengetahuan_delete->sumber_url->cellAttributes() ?>>
<span id="el<?php echo $pengetahuan_delete->RowCount ?>_pengetahuan_sumber_url" class="pengetahuan_sumber_url">
<span<?php echo $pengetahuan_delete->sumber_url->viewAttributes() ?>><?php echo $pengetahuan_delete->sumber_url->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pengetahuan_delete->dokumen->Visible) { // dokumen ?>
		<td <?php echo $pengetahuan_delete->dokumen->cellAttributes() ?>>
<span id="el<?php echo $pengetahuan_delete->RowCount ?>_pengetahuan_dokumen" class="pengetahuan_dokumen">
<span<?php echo $pengetahuan_delete->dokumen->viewAttributes() ?>><?php echo $pengetahuan_delete->dokumen->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pengetahuan_delete->visual->Visible) { // visual ?>
		<td <?php echo $pengetahuan_delete->visual->cellAttributes() ?>>
<span id="el<?php echo $pengetahuan_delete->RowCount ?>_pengetahuan_visual" class="pengetahuan_visual">
<span<?php echo $pengetahuan_delete->visual->viewAttributes() ?>><?php echo $pengetahuan_delete->visual->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pengetahuan_delete->c_by->Visible) { // c_by ?>
		<td <?php echo $pengetahuan_delete->c_by->cellAttributes() ?>>
<span id="el<?php echo $pengetahuan_delete->RowCount ?>_pengetahuan_c_by" class="pengetahuan_c_by">
<span<?php echo $pengetahuan_delete->c_by->viewAttributes() ?>><?php echo $pengetahuan_delete->c_by->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$pengetahuan_delete->Recordset->moveNext();
}
$pengetahuan_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $pengetahuan_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$pengetahuan_delete->showPageFooter();
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
$pengetahuan_delete->terminate();
?>