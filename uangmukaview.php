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
$uangmuka_view = new uangmuka_view();

// Run the page
$uangmuka_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$uangmuka_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$uangmuka_view->isExport()) { ?>
<script>
var fuangmukaview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fuangmukaview = currentForm = new ew.Form("fuangmukaview", "view");
	loadjs.done("fuangmukaview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$uangmuka_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $uangmuka_view->ExportOptions->render("body") ?>
<?php $uangmuka_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $uangmuka_view->showPageHeader(); ?>
<?php
$uangmuka_view->showMessage();
?>
<form name="fuangmukaview" id="fuangmukaview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="uangmuka">
<input type="hidden" name="modal" value="<?php echo (int)$uangmuka_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($uangmuka_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $uangmuka_view->TableLeftColumnClass ?>"><span id="elh_uangmuka_id"><?php echo $uangmuka_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $uangmuka_view->id->cellAttributes() ?>>
<span id="el_uangmuka_id">
<span<?php echo $uangmuka_view->id->viewAttributes() ?>><?php echo $uangmuka_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($uangmuka_view->tgl->Visible) { // tgl ?>
	<tr id="r_tgl">
		<td class="<?php echo $uangmuka_view->TableLeftColumnClass ?>"><span id="elh_uangmuka_tgl"><?php echo $uangmuka_view->tgl->caption() ?></span></td>
		<td data-name="tgl" <?php echo $uangmuka_view->tgl->cellAttributes() ?>>
<span id="el_uangmuka_tgl">
<span<?php echo $uangmuka_view->tgl->viewAttributes() ?>><?php echo $uangmuka_view->tgl->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($uangmuka_view->pembayar->Visible) { // pembayar ?>
	<tr id="r_pembayar">
		<td class="<?php echo $uangmuka_view->TableLeftColumnClass ?>"><span id="elh_uangmuka_pembayar"><?php echo $uangmuka_view->pembayar->caption() ?></span></td>
		<td data-name="pembayar" <?php echo $uangmuka_view->pembayar->cellAttributes() ?>>
<span id="el_uangmuka_pembayar">
<span<?php echo $uangmuka_view->pembayar->viewAttributes() ?>><?php echo $uangmuka_view->pembayar->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($uangmuka_view->peruntukan->Visible) { // peruntukan ?>
	<tr id="r_peruntukan">
		<td class="<?php echo $uangmuka_view->TableLeftColumnClass ?>"><span id="elh_uangmuka_peruntukan"><?php echo $uangmuka_view->peruntukan->caption() ?></span></td>
		<td data-name="peruntukan" <?php echo $uangmuka_view->peruntukan->cellAttributes() ?>>
<span id="el_uangmuka_peruntukan">
<span<?php echo $uangmuka_view->peruntukan->viewAttributes() ?>><?php echo $uangmuka_view->peruntukan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($uangmuka_view->penerima->Visible) { // penerima ?>
	<tr id="r_penerima">
		<td class="<?php echo $uangmuka_view->TableLeftColumnClass ?>"><span id="elh_uangmuka_penerima"><?php echo $uangmuka_view->penerima->caption() ?></span></td>
		<td data-name="penerima" <?php echo $uangmuka_view->penerima->cellAttributes() ?>>
<span id="el_uangmuka_penerima">
<span<?php echo $uangmuka_view->penerima->viewAttributes() ?>><?php echo $uangmuka_view->penerima->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($uangmuka_view->rek_penerima->Visible) { // rek_penerima ?>
	<tr id="r_rek_penerima">
		<td class="<?php echo $uangmuka_view->TableLeftColumnClass ?>"><span id="elh_uangmuka_rek_penerima"><?php echo $uangmuka_view->rek_penerima->caption() ?></span></td>
		<td data-name="rek_penerima" <?php echo $uangmuka_view->rek_penerima->cellAttributes() ?>>
<span id="el_uangmuka_rek_penerima">
<span<?php echo $uangmuka_view->rek_penerima->viewAttributes() ?>><?php echo $uangmuka_view->rek_penerima->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($uangmuka_view->tgl_terima->Visible) { // tgl_terima ?>
	<tr id="r_tgl_terima">
		<td class="<?php echo $uangmuka_view->TableLeftColumnClass ?>"><span id="elh_uangmuka_tgl_terima"><?php echo $uangmuka_view->tgl_terima->caption() ?></span></td>
		<td data-name="tgl_terima" <?php echo $uangmuka_view->tgl_terima->cellAttributes() ?>>
<span id="el_uangmuka_tgl_terima">
<span<?php echo $uangmuka_view->tgl_terima->viewAttributes() ?>><?php echo $uangmuka_view->tgl_terima->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($uangmuka_view->total_terima->Visible) { // total_terima ?>
	<tr id="r_total_terima">
		<td class="<?php echo $uangmuka_view->TableLeftColumnClass ?>"><span id="elh_uangmuka_total_terima"><?php echo $uangmuka_view->total_terima->caption() ?></span></td>
		<td data-name="total_terima" <?php echo $uangmuka_view->total_terima->cellAttributes() ?>>
<span id="el_uangmuka_total_terima">
<span<?php echo $uangmuka_view->total_terima->viewAttributes() ?>><?php echo $uangmuka_view->total_terima->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($uangmuka_view->tgl_tgjb->Visible) { // tgl_tgjb ?>
	<tr id="r_tgl_tgjb">
		<td class="<?php echo $uangmuka_view->TableLeftColumnClass ?>"><span id="elh_uangmuka_tgl_tgjb"><?php echo $uangmuka_view->tgl_tgjb->caption() ?></span></td>
		<td data-name="tgl_tgjb" <?php echo $uangmuka_view->tgl_tgjb->cellAttributes() ?>>
<span id="el_uangmuka_tgl_tgjb">
<span<?php echo $uangmuka_view->tgl_tgjb->viewAttributes() ?>><?php echo $uangmuka_view->tgl_tgjb->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($uangmuka_view->jumlah_tgjb->Visible) { // jumlah_tgjb ?>
	<tr id="r_jumlah_tgjb">
		<td class="<?php echo $uangmuka_view->TableLeftColumnClass ?>"><span id="elh_uangmuka_jumlah_tgjb"><?php echo $uangmuka_view->jumlah_tgjb->caption() ?></span></td>
		<td data-name="jumlah_tgjb" <?php echo $uangmuka_view->jumlah_tgjb->cellAttributes() ?>>
<span id="el_uangmuka_jumlah_tgjb">
<span<?php echo $uangmuka_view->jumlah_tgjb->viewAttributes() ?>><?php echo $uangmuka_view->jumlah_tgjb->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($uangmuka_view->jenis->Visible) { // jenis ?>
	<tr id="r_jenis">
		<td class="<?php echo $uangmuka_view->TableLeftColumnClass ?>"><span id="elh_uangmuka_jenis"><?php echo $uangmuka_view->jenis->caption() ?></span></td>
		<td data-name="jenis" <?php echo $uangmuka_view->jenis->cellAttributes() ?>>
<span id="el_uangmuka_jenis">
<span<?php echo $uangmuka_view->jenis->viewAttributes() ?>><?php echo $uangmuka_view->jenis->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($uangmuka_view->bukti1->Visible) { // bukti1 ?>
	<tr id="r_bukti1">
		<td class="<?php echo $uangmuka_view->TableLeftColumnClass ?>"><span id="elh_uangmuka_bukti1"><?php echo $uangmuka_view->bukti1->caption() ?></span></td>
		<td data-name="bukti1" <?php echo $uangmuka_view->bukti1->cellAttributes() ?>>
<span id="el_uangmuka_bukti1">
<span<?php echo $uangmuka_view->bukti1->viewAttributes() ?>><?php echo GetFileViewTag($uangmuka_view->bukti1, $uangmuka_view->bukti1->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($uangmuka_view->bukti2->Visible) { // bukti2 ?>
	<tr id="r_bukti2">
		<td class="<?php echo $uangmuka_view->TableLeftColumnClass ?>"><span id="elh_uangmuka_bukti2"><?php echo $uangmuka_view->bukti2->caption() ?></span></td>
		<td data-name="bukti2" <?php echo $uangmuka_view->bukti2->cellAttributes() ?>>
<span id="el_uangmuka_bukti2">
<span<?php echo $uangmuka_view->bukti2->viewAttributes() ?>><?php echo GetFileViewTag($uangmuka_view->bukti2, $uangmuka_view->bukti2->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($uangmuka_view->bukti3->Visible) { // bukti3 ?>
	<tr id="r_bukti3">
		<td class="<?php echo $uangmuka_view->TableLeftColumnClass ?>"><span id="elh_uangmuka_bukti3"><?php echo $uangmuka_view->bukti3->caption() ?></span></td>
		<td data-name="bukti3" <?php echo $uangmuka_view->bukti3->cellAttributes() ?>>
<span id="el_uangmuka_bukti3">
<span<?php echo $uangmuka_view->bukti3->viewAttributes() ?>><?php echo GetFileViewTag($uangmuka_view->bukti3, $uangmuka_view->bukti3->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($uangmuka_view->bukti4->Visible) { // bukti4 ?>
	<tr id="r_bukti4">
		<td class="<?php echo $uangmuka_view->TableLeftColumnClass ?>"><span id="elh_uangmuka_bukti4"><?php echo $uangmuka_view->bukti4->caption() ?></span></td>
		<td data-name="bukti4" <?php echo $uangmuka_view->bukti4->cellAttributes() ?>>
<span id="el_uangmuka_bukti4">
<span<?php echo $uangmuka_view->bukti4->viewAttributes() ?>><?php echo GetFileViewTag($uangmuka_view->bukti4, $uangmuka_view->bukti4->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($uangmuka_view->disetujui->Visible) { // disetujui ?>
	<tr id="r_disetujui">
		<td class="<?php echo $uangmuka_view->TableLeftColumnClass ?>"><span id="elh_uangmuka_disetujui"><?php echo $uangmuka_view->disetujui->caption() ?></span></td>
		<td data-name="disetujui" <?php echo $uangmuka_view->disetujui->cellAttributes() ?>>
<span id="el_uangmuka_disetujui">
<span<?php echo $uangmuka_view->disetujui->viewAttributes() ?>><?php echo $uangmuka_view->disetujui->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($uangmuka_view->status->Visible) { // status ?>
	<tr id="r_status">
		<td class="<?php echo $uangmuka_view->TableLeftColumnClass ?>"><span id="elh_uangmuka_status"><?php echo $uangmuka_view->status->caption() ?></span></td>
		<td data-name="status" <?php echo $uangmuka_view->status->cellAttributes() ?>>
<span id="el_uangmuka_status">
<span<?php echo $uangmuka_view->status->viewAttributes() ?>><?php echo $uangmuka_view->status->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($uangmuka_view->keterangan->Visible) { // keterangan ?>
	<tr id="r_keterangan">
		<td class="<?php echo $uangmuka_view->TableLeftColumnClass ?>"><span id="elh_uangmuka_keterangan"><?php echo $uangmuka_view->keterangan->caption() ?></span></td>
		<td data-name="keterangan" <?php echo $uangmuka_view->keterangan->cellAttributes() ?>>
<span id="el_uangmuka_keterangan">
<span<?php echo $uangmuka_view->keterangan->viewAttributes() ?>><?php echo $uangmuka_view->keterangan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$uangmuka_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$uangmuka_view->isExport()) { ?>
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
$uangmuka_view->terminate();
?>