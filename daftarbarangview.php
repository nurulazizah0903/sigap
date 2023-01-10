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
$daftarbarang_view = new daftarbarang_view();

// Run the page
$daftarbarang_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$daftarbarang_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$daftarbarang_view->isExport()) { ?>
<script>
var fdaftarbarangview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fdaftarbarangview = currentForm = new ew.Form("fdaftarbarangview", "view");
	loadjs.done("fdaftarbarangview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$daftarbarang_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $daftarbarang_view->ExportOptions->render("body") ?>
<?php $daftarbarang_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $daftarbarang_view->showPageHeader(); ?>
<?php
$daftarbarang_view->showMessage();
?>
<form name="fdaftarbarangview" id="fdaftarbarangview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="daftarbarang">
<input type="hidden" name="modal" value="<?php echo (int)$daftarbarang_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($daftarbarang_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $daftarbarang_view->TableLeftColumnClass ?>"><span id="elh_daftarbarang_id"><?php echo $daftarbarang_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $daftarbarang_view->id->cellAttributes() ?>>
<span id="el_daftarbarang_id">
<span<?php echo $daftarbarang_view->id->viewAttributes() ?>><?php echo $daftarbarang_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($daftarbarang_view->pemegang->Visible) { // pemegang ?>
	<tr id="r_pemegang">
		<td class="<?php echo $daftarbarang_view->TableLeftColumnClass ?>"><span id="elh_daftarbarang_pemegang"><?php echo $daftarbarang_view->pemegang->caption() ?></span></td>
		<td data-name="pemegang" <?php echo $daftarbarang_view->pemegang->cellAttributes() ?>>
<span id="el_daftarbarang_pemegang">
<span<?php echo $daftarbarang_view->pemegang->viewAttributes() ?>><?php echo $daftarbarang_view->pemegang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($daftarbarang_view->nama->Visible) { // nama ?>
	<tr id="r_nama">
		<td class="<?php echo $daftarbarang_view->TableLeftColumnClass ?>"><span id="elh_daftarbarang_nama"><?php echo $daftarbarang_view->nama->caption() ?></span></td>
		<td data-name="nama" <?php echo $daftarbarang_view->nama->cellAttributes() ?>>
<span id="el_daftarbarang_nama">
<span<?php echo $daftarbarang_view->nama->viewAttributes() ?>><?php echo $daftarbarang_view->nama->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($daftarbarang_view->jenis->Visible) { // jenis ?>
	<tr id="r_jenis">
		<td class="<?php echo $daftarbarang_view->TableLeftColumnClass ?>"><span id="elh_daftarbarang_jenis"><?php echo $daftarbarang_view->jenis->caption() ?></span></td>
		<td data-name="jenis" <?php echo $daftarbarang_view->jenis->cellAttributes() ?>>
<span id="el_daftarbarang_jenis">
<span<?php echo $daftarbarang_view->jenis->viewAttributes() ?>><?php echo $daftarbarang_view->jenis->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($daftarbarang_view->sepsifikasi->Visible) { // sepsifikasi ?>
	<tr id="r_sepsifikasi">
		<td class="<?php echo $daftarbarang_view->TableLeftColumnClass ?>"><span id="elh_daftarbarang_sepsifikasi"><?php echo $daftarbarang_view->sepsifikasi->caption() ?></span></td>
		<td data-name="sepsifikasi" <?php echo $daftarbarang_view->sepsifikasi->cellAttributes() ?>>
<span id="el_daftarbarang_sepsifikasi">
<span<?php echo $daftarbarang_view->sepsifikasi->viewAttributes() ?>><?php echo $daftarbarang_view->sepsifikasi->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($daftarbarang_view->tgl_terima->Visible) { // tgl_terima ?>
	<tr id="r_tgl_terima">
		<td class="<?php echo $daftarbarang_view->TableLeftColumnClass ?>"><span id="elh_daftarbarang_tgl_terima"><?php echo $daftarbarang_view->tgl_terima->caption() ?></span></td>
		<td data-name="tgl_terima" <?php echo $daftarbarang_view->tgl_terima->cellAttributes() ?>>
<span id="el_daftarbarang_tgl_terima">
<span<?php echo $daftarbarang_view->tgl_terima->viewAttributes() ?>><?php echo $daftarbarang_view->tgl_terima->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($daftarbarang_view->tgl_beli->Visible) { // tgl_beli ?>
	<tr id="r_tgl_beli">
		<td class="<?php echo $daftarbarang_view->TableLeftColumnClass ?>"><span id="elh_daftarbarang_tgl_beli"><?php echo $daftarbarang_view->tgl_beli->caption() ?></span></td>
		<td data-name="tgl_beli" <?php echo $daftarbarang_view->tgl_beli->cellAttributes() ?>>
<span id="el_daftarbarang_tgl_beli">
<span<?php echo $daftarbarang_view->tgl_beli->viewAttributes() ?>><?php echo $daftarbarang_view->tgl_beli->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($daftarbarang_view->harga->Visible) { // harga ?>
	<tr id="r_harga">
		<td class="<?php echo $daftarbarang_view->TableLeftColumnClass ?>"><span id="elh_daftarbarang_harga"><?php echo $daftarbarang_view->harga->caption() ?></span></td>
		<td data-name="harga" <?php echo $daftarbarang_view->harga->cellAttributes() ?>>
<span id="el_daftarbarang_harga">
<span<?php echo $daftarbarang_view->harga->viewAttributes() ?>><?php echo $daftarbarang_view->harga->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($daftarbarang_view->dokumen->Visible) { // dokumen ?>
	<tr id="r_dokumen">
		<td class="<?php echo $daftarbarang_view->TableLeftColumnClass ?>"><span id="elh_daftarbarang_dokumen"><?php echo $daftarbarang_view->dokumen->caption() ?></span></td>
		<td data-name="dokumen" <?php echo $daftarbarang_view->dokumen->cellAttributes() ?>>
<span id="el_daftarbarang_dokumen">
<span<?php echo $daftarbarang_view->dokumen->viewAttributes() ?>><?php echo GetFileViewTag($daftarbarang_view->dokumen, $daftarbarang_view->dokumen->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($daftarbarang_view->foto->Visible) { // foto ?>
	<tr id="r_foto">
		<td class="<?php echo $daftarbarang_view->TableLeftColumnClass ?>"><span id="elh_daftarbarang_foto"><?php echo $daftarbarang_view->foto->caption() ?></span></td>
		<td data-name="foto" <?php echo $daftarbarang_view->foto->cellAttributes() ?>>
<span id="el_daftarbarang_foto">
<span<?php echo $daftarbarang_view->foto->viewAttributes() ?>><?php echo GetFileViewTag($daftarbarang_view->foto, $daftarbarang_view->foto->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($daftarbarang_view->keterangan->Visible) { // keterangan ?>
	<tr id="r_keterangan">
		<td class="<?php echo $daftarbarang_view->TableLeftColumnClass ?>"><span id="elh_daftarbarang_keterangan"><?php echo $daftarbarang_view->keterangan->caption() ?></span></td>
		<td data-name="keterangan" <?php echo $daftarbarang_view->keterangan->cellAttributes() ?>>
<span id="el_daftarbarang_keterangan">
<span<?php echo $daftarbarang_view->keterangan->viewAttributes() ?>><?php echo $daftarbarang_view->keterangan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($daftarbarang_view->deskripsi->Visible) { // deskripsi ?>
	<tr id="r_deskripsi">
		<td class="<?php echo $daftarbarang_view->TableLeftColumnClass ?>"><span id="elh_daftarbarang_deskripsi"><?php echo $daftarbarang_view->deskripsi->caption() ?></span></td>
		<td data-name="deskripsi" <?php echo $daftarbarang_view->deskripsi->cellAttributes() ?>>
<span id="el_daftarbarang_deskripsi">
<span<?php echo $daftarbarang_view->deskripsi->viewAttributes() ?>><?php echo $daftarbarang_view->deskripsi->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($daftarbarang_view->status->Visible) { // status ?>
	<tr id="r_status">
		<td class="<?php echo $daftarbarang_view->TableLeftColumnClass ?>"><span id="elh_daftarbarang_status"><?php echo $daftarbarang_view->status->caption() ?></span></td>
		<td data-name="status" <?php echo $daftarbarang_view->status->cellAttributes() ?>>
<span id="el_daftarbarang_status">
<span<?php echo $daftarbarang_view->status->viewAttributes() ?>><?php echo $daftarbarang_view->status->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$daftarbarang_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$daftarbarang_view->isExport()) { ?>
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
$daftarbarang_view->terminate();
?>