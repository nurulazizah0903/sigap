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
$berita_delete = new berita_delete();

// Run the page
$berita_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$berita_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fberitadelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fberitadelete = currentForm = new ew.Form("fberitadelete", "delete");
	loadjs.done("fberitadelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $berita_delete->showPageHeader(); ?>
<?php
$berita_delete->showMessage();
?>
<form name="fberitadelete" id="fberitadelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="berita">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($berita_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($berita_delete->id->Visible) { // id ?>
		<th class="<?php echo $berita_delete->id->headerCellClass() ?>"><span id="elh_berita_id" class="berita_id"><?php echo $berita_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($berita_delete->grup->Visible) { // grup ?>
		<th class="<?php echo $berita_delete->grup->headerCellClass() ?>"><span id="elh_berita_grup" class="berita_grup"><?php echo $berita_delete->grup->caption() ?></span></th>
<?php } ?>
<?php if ($berita_delete->judul->Visible) { // judul ?>
		<th class="<?php echo $berita_delete->judul->headerCellClass() ?>"><span id="elh_berita_judul" class="berita_judul"><?php echo $berita_delete->judul->caption() ?></span></th>
<?php } ?>
<?php if ($berita_delete->gambar->Visible) { // gambar ?>
		<th class="<?php echo $berita_delete->gambar->headerCellClass() ?>"><span id="elh_berita_gambar" class="berita_gambar"><?php echo $berita_delete->gambar->caption() ?></span></th>
<?php } ?>
<?php if ($berita_delete->video->Visible) { // video ?>
		<th class="<?php echo $berita_delete->video->headerCellClass() ?>"><span id="elh_berita_video" class="berita_video"><?php echo $berita_delete->video->caption() ?></span></th>
<?php } ?>
<?php if ($berita_delete->c_by->Visible) { // c_by ?>
		<th class="<?php echo $berita_delete->c_by->headerCellClass() ?>"><span id="elh_berita_c_by" class="berita_c_by"><?php echo $berita_delete->c_by->caption() ?></span></th>
<?php } ?>
<?php if ($berita_delete->c_date->Visible) { // c_date ?>
		<th class="<?php echo $berita_delete->c_date->headerCellClass() ?>"><span id="elh_berita_c_date" class="berita_c_date"><?php echo $berita_delete->c_date->caption() ?></span></th>
<?php } ?>
<?php if ($berita_delete->aktif->Visible) { // aktif ?>
		<th class="<?php echo $berita_delete->aktif->headerCellClass() ?>"><span id="elh_berita_aktif" class="berita_aktif"><?php echo $berita_delete->aktif->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$berita_delete->RecordCount = 0;
$i = 0;
while (!$berita_delete->Recordset->EOF) {
	$berita_delete->RecordCount++;
	$berita_delete->RowCount++;

	// Set row properties
	$berita->resetAttributes();
	$berita->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$berita_delete->loadRowValues($berita_delete->Recordset);

	// Render row
	$berita_delete->renderRow();
?>
	<tr <?php echo $berita->rowAttributes() ?>>
<?php if ($berita_delete->id->Visible) { // id ?>
		<td <?php echo $berita_delete->id->cellAttributes() ?>>
<span id="el<?php echo $berita_delete->RowCount ?>_berita_id" class="berita_id">
<span<?php echo $berita_delete->id->viewAttributes() ?>><?php echo $berita_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($berita_delete->grup->Visible) { // grup ?>
		<td <?php echo $berita_delete->grup->cellAttributes() ?>>
<span id="el<?php echo $berita_delete->RowCount ?>_berita_grup" class="berita_grup">
<span<?php echo $berita_delete->grup->viewAttributes() ?>><?php echo $berita_delete->grup->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($berita_delete->judul->Visible) { // judul ?>
		<td <?php echo $berita_delete->judul->cellAttributes() ?>>
<span id="el<?php echo $berita_delete->RowCount ?>_berita_judul" class="berita_judul">
<span<?php echo $berita_delete->judul->viewAttributes() ?>><?php echo $berita_delete->judul->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($berita_delete->gambar->Visible) { // gambar ?>
		<td <?php echo $berita_delete->gambar->cellAttributes() ?>>
<span id="el<?php echo $berita_delete->RowCount ?>_berita_gambar" class="berita_gambar">
<span<?php echo $berita_delete->gambar->viewAttributes() ?>><?php echo $berita_delete->gambar->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($berita_delete->video->Visible) { // video ?>
		<td <?php echo $berita_delete->video->cellAttributes() ?>>
<span id="el<?php echo $berita_delete->RowCount ?>_berita_video" class="berita_video">
<span<?php echo $berita_delete->video->viewAttributes() ?>><?php echo $berita_delete->video->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($berita_delete->c_by->Visible) { // c_by ?>
		<td <?php echo $berita_delete->c_by->cellAttributes() ?>>
<span id="el<?php echo $berita_delete->RowCount ?>_berita_c_by" class="berita_c_by">
<span<?php echo $berita_delete->c_by->viewAttributes() ?>><?php echo $berita_delete->c_by->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($berita_delete->c_date->Visible) { // c_date ?>
		<td <?php echo $berita_delete->c_date->cellAttributes() ?>>
<span id="el<?php echo $berita_delete->RowCount ?>_berita_c_date" class="berita_c_date">
<span<?php echo $berita_delete->c_date->viewAttributes() ?>><?php echo $berita_delete->c_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($berita_delete->aktif->Visible) { // aktif ?>
		<td <?php echo $berita_delete->aktif->cellAttributes() ?>>
<span id="el<?php echo $berita_delete->RowCount ?>_berita_aktif" class="berita_aktif">
<span<?php echo $berita_delete->aktif->viewAttributes() ?>><?php echo $berita_delete->aktif->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$berita_delete->Recordset->moveNext();
}
$berita_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $berita_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$berita_delete->showPageFooter();
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
$berita_delete->terminate();
?>