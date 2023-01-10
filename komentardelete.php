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
$komentar_delete = new komentar_delete();

// Run the page
$komentar_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$komentar_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fkomentardelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fkomentardelete = currentForm = new ew.Form("fkomentardelete", "delete");
	loadjs.done("fkomentardelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $komentar_delete->showPageHeader(); ?>
<?php
$komentar_delete->showMessage();
?>
<form name="fkomentardelete" id="fkomentardelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="komentar">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($komentar_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($komentar_delete->id->Visible) { // id ?>
		<th class="<?php echo $komentar_delete->id->headerCellClass() ?>"><span id="elh_komentar_id" class="komentar_id"><?php echo $komentar_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($komentar_delete->pid->Visible) { // pid ?>
		<th class="<?php echo $komentar_delete->pid->headerCellClass() ?>"><span id="elh_komentar_pid" class="komentar_pid"><?php echo $komentar_delete->pid->caption() ?></span></th>
<?php } ?>
<?php if ($komentar_delete->gambar->Visible) { // gambar ?>
		<th class="<?php echo $komentar_delete->gambar->headerCellClass() ?>"><span id="elh_komentar_gambar" class="komentar_gambar"><?php echo $komentar_delete->gambar->caption() ?></span></th>
<?php } ?>
<?php if ($komentar_delete->video->Visible) { // video ?>
		<th class="<?php echo $komentar_delete->video->headerCellClass() ?>"><span id="elh_komentar_video" class="komentar_video"><?php echo $komentar_delete->video->caption() ?></span></th>
<?php } ?>
<?php if ($komentar_delete->pegawai->Visible) { // pegawai ?>
		<th class="<?php echo $komentar_delete->pegawai->headerCellClass() ?>"><span id="elh_komentar_pegawai" class="komentar_pegawai"><?php echo $komentar_delete->pegawai->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$komentar_delete->RecordCount = 0;
$i = 0;
while (!$komentar_delete->Recordset->EOF) {
	$komentar_delete->RecordCount++;
	$komentar_delete->RowCount++;

	// Set row properties
	$komentar->resetAttributes();
	$komentar->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$komentar_delete->loadRowValues($komentar_delete->Recordset);

	// Render row
	$komentar_delete->renderRow();
?>
	<tr <?php echo $komentar->rowAttributes() ?>>
<?php if ($komentar_delete->id->Visible) { // id ?>
		<td <?php echo $komentar_delete->id->cellAttributes() ?>>
<span id="el<?php echo $komentar_delete->RowCount ?>_komentar_id" class="komentar_id">
<span<?php echo $komentar_delete->id->viewAttributes() ?>><?php echo $komentar_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($komentar_delete->pid->Visible) { // pid ?>
		<td <?php echo $komentar_delete->pid->cellAttributes() ?>>
<span id="el<?php echo $komentar_delete->RowCount ?>_komentar_pid" class="komentar_pid">
<span<?php echo $komentar_delete->pid->viewAttributes() ?>><?php echo $komentar_delete->pid->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($komentar_delete->gambar->Visible) { // gambar ?>
		<td <?php echo $komentar_delete->gambar->cellAttributes() ?>>
<span id="el<?php echo $komentar_delete->RowCount ?>_komentar_gambar" class="komentar_gambar">
<span<?php echo $komentar_delete->gambar->viewAttributes() ?>><?php echo $komentar_delete->gambar->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($komentar_delete->video->Visible) { // video ?>
		<td <?php echo $komentar_delete->video->cellAttributes() ?>>
<span id="el<?php echo $komentar_delete->RowCount ?>_komentar_video" class="komentar_video">
<span<?php echo $komentar_delete->video->viewAttributes() ?>><?php echo $komentar_delete->video->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($komentar_delete->pegawai->Visible) { // pegawai ?>
		<td <?php echo $komentar_delete->pegawai->cellAttributes() ?>>
<span id="el<?php echo $komentar_delete->RowCount ?>_komentar_pegawai" class="komentar_pegawai">
<span<?php echo $komentar_delete->pegawai->viewAttributes() ?>><?php echo $komentar_delete->pegawai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$komentar_delete->Recordset->moveNext();
}
$komentar_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $komentar_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$komentar_delete->showPageFooter();
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
$komentar_delete->terminate();
?>