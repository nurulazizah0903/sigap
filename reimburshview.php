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
$reimbursh_view = new reimbursh_view();

// Run the page
$reimbursh_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$reimbursh_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$reimbursh_view->isExport()) { ?>
<script>
var freimburshview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	freimburshview = currentForm = new ew.Form("freimburshview", "view");
	loadjs.done("freimburshview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$reimbursh_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $reimbursh_view->ExportOptions->render("body") ?>
<?php $reimbursh_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $reimbursh_view->showPageHeader(); ?>
<?php
$reimbursh_view->showMessage();
?>
<form name="freimburshview" id="freimburshview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="reimbursh">
<input type="hidden" name="modal" value="<?php echo (int)$reimbursh_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($reimbursh_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $reimbursh_view->TableLeftColumnClass ?>"><span id="elh_reimbursh_id"><?php echo $reimbursh_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $reimbursh_view->id->cellAttributes() ?>>
<span id="el_reimbursh_id">
<span<?php echo $reimbursh_view->id->viewAttributes() ?>><?php echo $reimbursh_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($reimbursh_view->pegawai->Visible) { // pegawai ?>
	<tr id="r_pegawai">
		<td class="<?php echo $reimbursh_view->TableLeftColumnClass ?>"><span id="elh_reimbursh_pegawai"><?php echo $reimbursh_view->pegawai->caption() ?></span></td>
		<td data-name="pegawai" <?php echo $reimbursh_view->pegawai->cellAttributes() ?>>
<span id="el_reimbursh_pegawai">
<span<?php echo $reimbursh_view->pegawai->viewAttributes() ?>><?php echo $reimbursh_view->pegawai->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($reimbursh_view->nama->Visible) { // nama ?>
	<tr id="r_nama">
		<td class="<?php echo $reimbursh_view->TableLeftColumnClass ?>"><span id="elh_reimbursh_nama"><?php echo $reimbursh_view->nama->caption() ?></span></td>
		<td data-name="nama" <?php echo $reimbursh_view->nama->cellAttributes() ?>>
<span id="el_reimbursh_nama">
<span<?php echo $reimbursh_view->nama->viewAttributes() ?>><?php echo $reimbursh_view->nama->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($reimbursh_view->tgl->Visible) { // tgl ?>
	<tr id="r_tgl">
		<td class="<?php echo $reimbursh_view->TableLeftColumnClass ?>"><span id="elh_reimbursh_tgl"><?php echo $reimbursh_view->tgl->caption() ?></span></td>
		<td data-name="tgl" <?php echo $reimbursh_view->tgl->cellAttributes() ?>>
<span id="el_reimbursh_tgl">
<span<?php echo $reimbursh_view->tgl->viewAttributes() ?>><?php echo $reimbursh_view->tgl->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($reimbursh_view->total_pengajuan->Visible) { // total_pengajuan ?>
	<tr id="r_total_pengajuan">
		<td class="<?php echo $reimbursh_view->TableLeftColumnClass ?>"><span id="elh_reimbursh_total_pengajuan"><?php echo $reimbursh_view->total_pengajuan->caption() ?></span></td>
		<td data-name="total_pengajuan" <?php echo $reimbursh_view->total_pengajuan->cellAttributes() ?>>
<span id="el_reimbursh_total_pengajuan">
<span<?php echo $reimbursh_view->total_pengajuan->viewAttributes() ?>><?php echo $reimbursh_view->total_pengajuan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($reimbursh_view->tgl_pengajuan->Visible) { // tgl_pengajuan ?>
	<tr id="r_tgl_pengajuan">
		<td class="<?php echo $reimbursh_view->TableLeftColumnClass ?>"><span id="elh_reimbursh_tgl_pengajuan"><?php echo $reimbursh_view->tgl_pengajuan->caption() ?></span></td>
		<td data-name="tgl_pengajuan" <?php echo $reimbursh_view->tgl_pengajuan->cellAttributes() ?>>
<span id="el_reimbursh_tgl_pengajuan">
<span<?php echo $reimbursh_view->tgl_pengajuan->viewAttributes() ?>><?php echo $reimbursh_view->tgl_pengajuan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($reimbursh_view->jenis->Visible) { // jenis ?>
	<tr id="r_jenis">
		<td class="<?php echo $reimbursh_view->TableLeftColumnClass ?>"><span id="elh_reimbursh_jenis"><?php echo $reimbursh_view->jenis->caption() ?></span></td>
		<td data-name="jenis" <?php echo $reimbursh_view->jenis->cellAttributes() ?>>
<span id="el_reimbursh_jenis">
<span<?php echo $reimbursh_view->jenis->viewAttributes() ?>><?php echo $reimbursh_view->jenis->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($reimbursh_view->keterangan->Visible) { // keterangan ?>
	<tr id="r_keterangan">
		<td class="<?php echo $reimbursh_view->TableLeftColumnClass ?>"><span id="elh_reimbursh_keterangan"><?php echo $reimbursh_view->keterangan->caption() ?></span></td>
		<td data-name="keterangan" <?php echo $reimbursh_view->keterangan->cellAttributes() ?>>
<span id="el_reimbursh_keterangan">
<span<?php echo $reimbursh_view->keterangan->viewAttributes() ?>><?php echo $reimbursh_view->keterangan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($reimbursh_view->rek_tujuan->Visible) { // rek_tujuan ?>
	<tr id="r_rek_tujuan">
		<td class="<?php echo $reimbursh_view->TableLeftColumnClass ?>"><span id="elh_reimbursh_rek_tujuan"><?php echo $reimbursh_view->rek_tujuan->caption() ?></span></td>
		<td data-name="rek_tujuan" <?php echo $reimbursh_view->rek_tujuan->cellAttributes() ?>>
<span id="el_reimbursh_rek_tujuan">
<span<?php echo $reimbursh_view->rek_tujuan->viewAttributes() ?>><?php echo $reimbursh_view->rek_tujuan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($reimbursh_view->bukti1->Visible) { // bukti1 ?>
	<tr id="r_bukti1">
		<td class="<?php echo $reimbursh_view->TableLeftColumnClass ?>"><span id="elh_reimbursh_bukti1"><?php echo $reimbursh_view->bukti1->caption() ?></span></td>
		<td data-name="bukti1" <?php echo $reimbursh_view->bukti1->cellAttributes() ?>>
<span id="el_reimbursh_bukti1">
<span<?php echo $reimbursh_view->bukti1->viewAttributes() ?>><?php echo $reimbursh_view->bukti1->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($reimbursh_view->bukti2->Visible) { // bukti2 ?>
	<tr id="r_bukti2">
		<td class="<?php echo $reimbursh_view->TableLeftColumnClass ?>"><span id="elh_reimbursh_bukti2"><?php echo $reimbursh_view->bukti2->caption() ?></span></td>
		<td data-name="bukti2" <?php echo $reimbursh_view->bukti2->cellAttributes() ?>>
<span id="el_reimbursh_bukti2">
<span<?php echo $reimbursh_view->bukti2->viewAttributes() ?>><?php echo $reimbursh_view->bukti2->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($reimbursh_view->bukti3->Visible) { // bukti3 ?>
	<tr id="r_bukti3">
		<td class="<?php echo $reimbursh_view->TableLeftColumnClass ?>"><span id="elh_reimbursh_bukti3"><?php echo $reimbursh_view->bukti3->caption() ?></span></td>
		<td data-name="bukti3" <?php echo $reimbursh_view->bukti3->cellAttributes() ?>>
<span id="el_reimbursh_bukti3">
<span<?php echo $reimbursh_view->bukti3->viewAttributes() ?>><?php echo $reimbursh_view->bukti3->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($reimbursh_view->bukti4->Visible) { // bukti4 ?>
	<tr id="r_bukti4">
		<td class="<?php echo $reimbursh_view->TableLeftColumnClass ?>"><span id="elh_reimbursh_bukti4"><?php echo $reimbursh_view->bukti4->caption() ?></span></td>
		<td data-name="bukti4" <?php echo $reimbursh_view->bukti4->cellAttributes() ?>>
<span id="el_reimbursh_bukti4">
<span<?php echo $reimbursh_view->bukti4->viewAttributes() ?>><?php echo $reimbursh_view->bukti4->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($reimbursh_view->disetujui->Visible) { // disetujui ?>
	<tr id="r_disetujui">
		<td class="<?php echo $reimbursh_view->TableLeftColumnClass ?>"><span id="elh_reimbursh_disetujui"><?php echo $reimbursh_view->disetujui->caption() ?></span></td>
		<td data-name="disetujui" <?php echo $reimbursh_view->disetujui->cellAttributes() ?>>
<span id="el_reimbursh_disetujui">
<span<?php echo $reimbursh_view->disetujui->viewAttributes() ?>><?php echo $reimbursh_view->disetujui->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($reimbursh_view->pembayar->Visible) { // pembayar ?>
	<tr id="r_pembayar">
		<td class="<?php echo $reimbursh_view->TableLeftColumnClass ?>"><span id="elh_reimbursh_pembayar"><?php echo $reimbursh_view->pembayar->caption() ?></span></td>
		<td data-name="pembayar" <?php echo $reimbursh_view->pembayar->cellAttributes() ?>>
<span id="el_reimbursh_pembayar">
<span<?php echo $reimbursh_view->pembayar->viewAttributes() ?>><?php echo $reimbursh_view->pembayar->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($reimbursh_view->terbayar->Visible) { // terbayar ?>
	<tr id="r_terbayar">
		<td class="<?php echo $reimbursh_view->TableLeftColumnClass ?>"><span id="elh_reimbursh_terbayar"><?php echo $reimbursh_view->terbayar->caption() ?></span></td>
		<td data-name="terbayar" <?php echo $reimbursh_view->terbayar->cellAttributes() ?>>
<span id="el_reimbursh_terbayar">
<span<?php echo $reimbursh_view->terbayar->viewAttributes() ?>><?php echo $reimbursh_view->terbayar->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($reimbursh_view->tgl_pembayaran->Visible) { // tgl_pembayaran ?>
	<tr id="r_tgl_pembayaran">
		<td class="<?php echo $reimbursh_view->TableLeftColumnClass ?>"><span id="elh_reimbursh_tgl_pembayaran"><?php echo $reimbursh_view->tgl_pembayaran->caption() ?></span></td>
		<td data-name="tgl_pembayaran" <?php echo $reimbursh_view->tgl_pembayaran->cellAttributes() ?>>
<span id="el_reimbursh_tgl_pembayaran">
<span<?php echo $reimbursh_view->tgl_pembayaran->viewAttributes() ?>><?php echo $reimbursh_view->tgl_pembayaran->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($reimbursh_view->jumlah_dibayar->Visible) { // jumlah_dibayar ?>
	<tr id="r_jumlah_dibayar">
		<td class="<?php echo $reimbursh_view->TableLeftColumnClass ?>"><span id="elh_reimbursh_jumlah_dibayar"><?php echo $reimbursh_view->jumlah_dibayar->caption() ?></span></td>
		<td data-name="jumlah_dibayar" <?php echo $reimbursh_view->jumlah_dibayar->cellAttributes() ?>>
<span id="el_reimbursh_jumlah_dibayar">
<span<?php echo $reimbursh_view->jumlah_dibayar->viewAttributes() ?>><?php echo $reimbursh_view->jumlah_dibayar->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$reimbursh_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$reimbursh_view->isExport()) { ?>
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
$reimbursh_view->terminate();
?>