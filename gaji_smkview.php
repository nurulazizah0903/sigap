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
$gaji_smk_view = new gaji_smk_view();

// Run the page
$gaji_smk_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gaji_smk_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$gaji_smk_view->isExport()) { ?>
<script>
var fgaji_smkview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fgaji_smkview = currentForm = new ew.Form("fgaji_smkview", "view");
	loadjs.done("fgaji_smkview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	$("#r_value_lembur").hide(),$("#r_value_piket").hide();
});
</script>
<?php } ?>
<?php if (!$gaji_smk_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $gaji_smk_view->ExportOptions->render("body") ?>
<?php $gaji_smk_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $gaji_smk_view->showPageHeader(); ?>
<?php
$gaji_smk_view->showMessage();
?>
<form name="fgaji_smkview" id="fgaji_smkview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gaji_smk">
<input type="hidden" name="modal" value="<?php echo (int)$gaji_smk_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($gaji_smk_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $gaji_smk_view->TableLeftColumnClass ?>"><span id="elh_gaji_smk_id"><?php echo $gaji_smk_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $gaji_smk_view->id->cellAttributes() ?>>
<span id="el_gaji_smk_id">
<span<?php echo $gaji_smk_view->id->viewAttributes() ?>><?php echo $gaji_smk_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gaji_smk_view->pid->Visible) { // pid ?>
	<tr id="r_pid">
		<td class="<?php echo $gaji_smk_view->TableLeftColumnClass ?>"><span id="elh_gaji_smk_pid"><?php echo $gaji_smk_view->pid->caption() ?></span></td>
		<td data-name="pid" <?php echo $gaji_smk_view->pid->cellAttributes() ?>>
<span id="el_gaji_smk_pid">
<span<?php echo $gaji_smk_view->pid->viewAttributes() ?>><?php echo $gaji_smk_view->pid->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gaji_smk_view->datetime->Visible) { // datetime ?>
	<tr id="r_datetime">
		<td class="<?php echo $gaji_smk_view->TableLeftColumnClass ?>"><span id="elh_gaji_smk_datetime"><?php echo $gaji_smk_view->datetime->caption() ?></span></td>
		<td data-name="datetime" <?php echo $gaji_smk_view->datetime->cellAttributes() ?>>
<span id="el_gaji_smk_datetime">
<span<?php echo $gaji_smk_view->datetime->viewAttributes() ?>><?php echo $gaji_smk_view->datetime->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gaji_smk_view->by->Visible) { // by ?>
	<tr id="r_by">
		<td class="<?php echo $gaji_smk_view->TableLeftColumnClass ?>"><span id="elh_gaji_smk_by"><?php echo $gaji_smk_view->by->caption() ?></span></td>
		<td data-name="by" <?php echo $gaji_smk_view->by->cellAttributes() ?>>
<span id="el_gaji_smk_by">
<span<?php echo $gaji_smk_view->by->viewAttributes() ?>><?php echo $gaji_smk_view->by->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gaji_smk_view->month->Visible) { // month ?>
	<tr id="r_month">
		<td class="<?php echo $gaji_smk_view->TableLeftColumnClass ?>"><span id="elh_gaji_smk_month"><?php echo $gaji_smk_view->month->caption() ?></span></td>
		<td data-name="month" <?php echo $gaji_smk_view->month->cellAttributes() ?>>
<span id="el_gaji_smk_month">
<span<?php echo $gaji_smk_view->month->viewAttributes() ?>><?php echo $gaji_smk_view->month->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gaji_smk_view->pegawai->Visible) { // pegawai ?>
	<tr id="r_pegawai">
		<td class="<?php echo $gaji_smk_view->TableLeftColumnClass ?>"><span id="elh_gaji_smk_pegawai"><?php echo $gaji_smk_view->pegawai->caption() ?></span></td>
		<td data-name="pegawai" <?php echo $gaji_smk_view->pegawai->cellAttributes() ?>>
<span id="el_gaji_smk_pegawai">
<span<?php echo $gaji_smk_view->pegawai->viewAttributes() ?>><?php echo $gaji_smk_view->pegawai->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gaji_smk_view->jenjang_id->Visible) { // jenjang_id ?>
	<tr id="r_jenjang_id">
		<td class="<?php echo $gaji_smk_view->TableLeftColumnClass ?>"><span id="elh_gaji_smk_jenjang_id"><?php echo $gaji_smk_view->jenjang_id->caption() ?></span></td>
		<td data-name="jenjang_id" <?php echo $gaji_smk_view->jenjang_id->cellAttributes() ?>>
<span id="el_gaji_smk_jenjang_id">
<span<?php echo $gaji_smk_view->jenjang_id->viewAttributes() ?>><?php echo $gaji_smk_view->jenjang_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gaji_smk_view->jabatan_id->Visible) { // jabatan_id ?>
	<tr id="r_jabatan_id">
		<td class="<?php echo $gaji_smk_view->TableLeftColumnClass ?>"><span id="elh_gaji_smk_jabatan_id"><?php echo $gaji_smk_view->jabatan_id->caption() ?></span></td>
		<td data-name="jabatan_id" <?php echo $gaji_smk_view->jabatan_id->cellAttributes() ?>>
<span id="el_gaji_smk_jabatan_id">
<span<?php echo $gaji_smk_view->jabatan_id->viewAttributes() ?>><?php echo $gaji_smk_view->jabatan_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gaji_smk_view->lama_kerja->Visible) { // lama_kerja ?>
	<tr id="r_lama_kerja">
		<td class="<?php echo $gaji_smk_view->TableLeftColumnClass ?>"><span id="elh_gaji_smk_lama_kerja"><?php echo $gaji_smk_view->lama_kerja->caption() ?></span></td>
		<td data-name="lama_kerja" <?php echo $gaji_smk_view->lama_kerja->cellAttributes() ?>>
<span id="el_gaji_smk_lama_kerja">
<span<?php echo $gaji_smk_view->lama_kerja->viewAttributes() ?>><?php echo $gaji_smk_view->lama_kerja->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gaji_smk_view->type->Visible) { // type ?>
	<tr id="r_type">
		<td class="<?php echo $gaji_smk_view->TableLeftColumnClass ?>"><span id="elh_gaji_smk_type"><?php echo $gaji_smk_view->type->caption() ?></span></td>
		<td data-name="type" <?php echo $gaji_smk_view->type->cellAttributes() ?>>
<span id="el_gaji_smk_type">
<span<?php echo $gaji_smk_view->type->viewAttributes() ?>><?php echo $gaji_smk_view->type->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gaji_smk_view->jenis_guru->Visible) { // jenis_guru ?>
	<tr id="r_jenis_guru">
		<td class="<?php echo $gaji_smk_view->TableLeftColumnClass ?>"><span id="elh_gaji_smk_jenis_guru"><?php echo $gaji_smk_view->jenis_guru->caption() ?></span></td>
		<td data-name="jenis_guru" <?php echo $gaji_smk_view->jenis_guru->cellAttributes() ?>>
<span id="el_gaji_smk_jenis_guru">
<span<?php echo $gaji_smk_view->jenis_guru->viewAttributes() ?>><?php echo $gaji_smk_view->jenis_guru->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gaji_smk_view->tambahan->Visible) { // tambahan ?>
	<tr id="r_tambahan">
		<td class="<?php echo $gaji_smk_view->TableLeftColumnClass ?>"><span id="elh_gaji_smk_tambahan"><?php echo $gaji_smk_view->tambahan->caption() ?></span></td>
		<td data-name="tambahan" <?php echo $gaji_smk_view->tambahan->cellAttributes() ?>>
<span id="el_gaji_smk_tambahan">
<span<?php echo $gaji_smk_view->tambahan->viewAttributes() ?>><?php echo $gaji_smk_view->tambahan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gaji_smk_view->periode->Visible) { // periode ?>
	<tr id="r_periode">
		<td class="<?php echo $gaji_smk_view->TableLeftColumnClass ?>"><span id="elh_gaji_smk_periode"><?php echo $gaji_smk_view->periode->caption() ?></span></td>
		<td data-name="periode" <?php echo $gaji_smk_view->periode->cellAttributes() ?>>
<span id="el_gaji_smk_periode">
<span<?php echo $gaji_smk_view->periode->viewAttributes() ?>><?php echo $gaji_smk_view->periode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gaji_smk_view->tunjangan_periode->Visible) { // tunjangan_periode ?>
	<tr id="r_tunjangan_periode">
		<td class="<?php echo $gaji_smk_view->TableLeftColumnClass ?>"><span id="elh_gaji_smk_tunjangan_periode"><?php echo $gaji_smk_view->tunjangan_periode->caption() ?></span></td>
		<td data-name="tunjangan_periode" <?php echo $gaji_smk_view->tunjangan_periode->cellAttributes() ?>>
<span id="el_gaji_smk_tunjangan_periode">
<span<?php echo $gaji_smk_view->tunjangan_periode->viewAttributes() ?>><?php echo $gaji_smk_view->tunjangan_periode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gaji_smk_view->kehadiran->Visible) { // kehadiran ?>
	<tr id="r_kehadiran">
		<td class="<?php echo $gaji_smk_view->TableLeftColumnClass ?>"><span id="elh_gaji_smk_kehadiran"><?php echo $gaji_smk_view->kehadiran->caption() ?></span></td>
		<td data-name="kehadiran" <?php echo $gaji_smk_view->kehadiran->cellAttributes() ?>>
<span id="el_gaji_smk_kehadiran">
<span<?php echo $gaji_smk_view->kehadiran->viewAttributes() ?>><?php echo $gaji_smk_view->kehadiran->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gaji_smk_view->value_kehadiran->Visible) { // value_kehadiran ?>
	<tr id="r_value_kehadiran">
		<td class="<?php echo $gaji_smk_view->TableLeftColumnClass ?>"><span id="elh_gaji_smk_value_kehadiran"><?php echo $gaji_smk_view->value_kehadiran->caption() ?></span></td>
		<td data-name="value_kehadiran" <?php echo $gaji_smk_view->value_kehadiran->cellAttributes() ?>>
<span id="el_gaji_smk_value_kehadiran">
<span<?php echo $gaji_smk_view->value_kehadiran->viewAttributes() ?>><?php echo $gaji_smk_view->value_kehadiran->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gaji_smk_view->lembur->Visible) { // lembur ?>
	<tr id="r_lembur">
		<td class="<?php echo $gaji_smk_view->TableLeftColumnClass ?>"><span id="elh_gaji_smk_lembur"><?php echo $gaji_smk_view->lembur->caption() ?></span></td>
		<td data-name="lembur" <?php echo $gaji_smk_view->lembur->cellAttributes() ?>>
<span id="el_gaji_smk_lembur">
<span<?php echo $gaji_smk_view->lembur->viewAttributes() ?>><?php echo $gaji_smk_view->lembur->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gaji_smk_view->value_lembur->Visible) { // value_lembur ?>
	<tr id="r_value_lembur">
		<td class="<?php echo $gaji_smk_view->TableLeftColumnClass ?>"><span id="elh_gaji_smk_value_lembur"><?php echo $gaji_smk_view->value_lembur->caption() ?></span></td>
		<td data-name="value_lembur" <?php echo $gaji_smk_view->value_lembur->cellAttributes() ?>>
<span id="el_gaji_smk_value_lembur">
<span<?php echo $gaji_smk_view->value_lembur->viewAttributes() ?>><?php echo $gaji_smk_view->value_lembur->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gaji_smk_view->jp->Visible) { // jp ?>
	<tr id="r_jp">
		<td class="<?php echo $gaji_smk_view->TableLeftColumnClass ?>"><span id="elh_gaji_smk_jp"><?php echo $gaji_smk_view->jp->caption() ?></span></td>
		<td data-name="jp" <?php echo $gaji_smk_view->jp->cellAttributes() ?>>
<span id="el_gaji_smk_jp">
<span<?php echo $gaji_smk_view->jp->viewAttributes() ?>><?php echo $gaji_smk_view->jp->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gaji_smk_view->gapok->Visible) { // gapok ?>
	<tr id="r_gapok">
		<td class="<?php echo $gaji_smk_view->TableLeftColumnClass ?>"><span id="elh_gaji_smk_gapok"><?php echo $gaji_smk_view->gapok->caption() ?></span></td>
		<td data-name="gapok" <?php echo $gaji_smk_view->gapok->cellAttributes() ?>>
<span id="el_gaji_smk_gapok">
<span<?php echo $gaji_smk_view->gapok->viewAttributes() ?>><?php echo $gaji_smk_view->gapok->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gaji_smk_view->total_gapok->Visible) { // total_gapok ?>
	<tr id="r_total_gapok">
		<td class="<?php echo $gaji_smk_view->TableLeftColumnClass ?>"><span id="elh_gaji_smk_total_gapok"><?php echo $gaji_smk_view->total_gapok->caption() ?></span></td>
		<td data-name="total_gapok" <?php echo $gaji_smk_view->total_gapok->cellAttributes() ?>>
<span id="el_gaji_smk_total_gapok">
<span<?php echo $gaji_smk_view->total_gapok->viewAttributes() ?>><?php echo $gaji_smk_view->total_gapok->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gaji_smk_view->value_reward->Visible) { // value_reward ?>
	<tr id="r_value_reward">
		<td class="<?php echo $gaji_smk_view->TableLeftColumnClass ?>"><span id="elh_gaji_smk_value_reward"><?php echo $gaji_smk_view->value_reward->caption() ?></span></td>
		<td data-name="value_reward" <?php echo $gaji_smk_view->value_reward->cellAttributes() ?>>
<span id="el_gaji_smk_value_reward">
<span<?php echo $gaji_smk_view->value_reward->viewAttributes() ?>><?php echo $gaji_smk_view->value_reward->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gaji_smk_view->value_inval->Visible) { // value_inval ?>
	<tr id="r_value_inval">
		<td class="<?php echo $gaji_smk_view->TableLeftColumnClass ?>"><span id="elh_gaji_smk_value_inval"><?php echo $gaji_smk_view->value_inval->caption() ?></span></td>
		<td data-name="value_inval" <?php echo $gaji_smk_view->value_inval->cellAttributes() ?>>
<span id="el_gaji_smk_value_inval">
<span<?php echo $gaji_smk_view->value_inval->viewAttributes() ?>><?php echo $gaji_smk_view->value_inval->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gaji_smk_view->piket_count->Visible) { // piket_count ?>
	<tr id="r_piket_count">
		<td class="<?php echo $gaji_smk_view->TableLeftColumnClass ?>"><span id="elh_gaji_smk_piket_count"><?php echo $gaji_smk_view->piket_count->caption() ?></span></td>
		<td data-name="piket_count" <?php echo $gaji_smk_view->piket_count->cellAttributes() ?>>
<span id="el_gaji_smk_piket_count">
<span<?php echo $gaji_smk_view->piket_count->viewAttributes() ?>><?php echo $gaji_smk_view->piket_count->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gaji_smk_view->value_piket->Visible) { // value_piket ?>
	<tr id="r_value_piket">
		<td class="<?php echo $gaji_smk_view->TableLeftColumnClass ?>"><span id="elh_gaji_smk_value_piket"><?php echo $gaji_smk_view->value_piket->caption() ?></span></td>
		<td data-name="value_piket" <?php echo $gaji_smk_view->value_piket->cellAttributes() ?>>
<span id="el_gaji_smk_value_piket">
<span<?php echo $gaji_smk_view->value_piket->viewAttributes() ?>><?php echo $gaji_smk_view->value_piket->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gaji_smk_view->tugastambahan->Visible) { // tugastambahan ?>
	<tr id="r_tugastambahan">
		<td class="<?php echo $gaji_smk_view->TableLeftColumnClass ?>"><span id="elh_gaji_smk_tugastambahan"><?php echo $gaji_smk_view->tugastambahan->caption() ?></span></td>
		<td data-name="tugastambahan" <?php echo $gaji_smk_view->tugastambahan->cellAttributes() ?>>
<span id="el_gaji_smk_tugastambahan">
<span<?php echo $gaji_smk_view->tugastambahan->viewAttributes() ?>><?php echo $gaji_smk_view->tugastambahan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gaji_smk_view->tj_jabatan->Visible) { // tj_jabatan ?>
	<tr id="r_tj_jabatan">
		<td class="<?php echo $gaji_smk_view->TableLeftColumnClass ?>"><span id="elh_gaji_smk_tj_jabatan"><?php echo $gaji_smk_view->tj_jabatan->caption() ?></span></td>
		<td data-name="tj_jabatan" <?php echo $gaji_smk_view->tj_jabatan->cellAttributes() ?>>
<span id="el_gaji_smk_tj_jabatan">
<span<?php echo $gaji_smk_view->tj_jabatan->viewAttributes() ?>><?php echo $gaji_smk_view->tj_jabatan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gaji_smk_view->sub_total->Visible) { // sub_total ?>
	<tr id="r_sub_total">
		<td class="<?php echo $gaji_smk_view->TableLeftColumnClass ?>"><span id="elh_gaji_smk_sub_total"><?php echo $gaji_smk_view->sub_total->caption() ?></span></td>
		<td data-name="sub_total" <?php echo $gaji_smk_view->sub_total->cellAttributes() ?>>
<span id="el_gaji_smk_sub_total">
<span<?php echo $gaji_smk_view->sub_total->viewAttributes() ?>><?php echo $gaji_smk_view->sub_total->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gaji_smk_view->potongan->Visible) { // potongan ?>
	<tr id="r_potongan">
		<td class="<?php echo $gaji_smk_view->TableLeftColumnClass ?>"><span id="elh_gaji_smk_potongan"><?php echo $gaji_smk_view->potongan->caption() ?></span></td>
		<td data-name="potongan" <?php echo $gaji_smk_view->potongan->cellAttributes() ?>>
<span id="el_gaji_smk_potongan">
<span<?php echo $gaji_smk_view->potongan->viewAttributes() ?>><?php echo $gaji_smk_view->potongan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gaji_smk_view->penyesuaian->Visible) { // penyesuaian ?>
	<tr id="r_penyesuaian">
		<td class="<?php echo $gaji_smk_view->TableLeftColumnClass ?>"><span id="elh_gaji_smk_penyesuaian"><?php echo $gaji_smk_view->penyesuaian->caption() ?></span></td>
		<td data-name="penyesuaian" <?php echo $gaji_smk_view->penyesuaian->cellAttributes() ?>>
<span id="el_gaji_smk_penyesuaian">
<span<?php echo $gaji_smk_view->penyesuaian->viewAttributes() ?>><?php echo $gaji_smk_view->penyesuaian->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gaji_smk_view->total->Visible) { // total ?>
	<tr id="r_total">
		<td class="<?php echo $gaji_smk_view->TableLeftColumnClass ?>"><span id="elh_gaji_smk_total"><?php echo $gaji_smk_view->total->caption() ?></span></td>
		<td data-name="total" <?php echo $gaji_smk_view->total->cellAttributes() ?>>
<span id="el_gaji_smk_total">
<span<?php echo $gaji_smk_view->total->viewAttributes() ?>><?php echo $gaji_smk_view->total->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$gaji_smk_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$gaji_smk_view->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	$("#r_value_lembur").hide(),$("#r_value_piket").hide();
});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$gaji_smk_view->terminate();
?>