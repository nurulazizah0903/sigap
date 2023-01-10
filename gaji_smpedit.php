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
$gaji_smp_edit = new gaji_smp_edit();

// Run the page
$gaji_smp_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gaji_smp_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fgaji_smpedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fgaji_smpedit = currentForm = new ew.Form("fgaji_smpedit", "edit");

	// Validate form
	fgaji_smpedit.validate = function() {
		if (!this.validateRequired)
			return true; // Ignore validation
		var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
		if ($fobj.find("#confirm").val() == "confirm")
			return true;
		var elm, felm, uelm, addcnt = 0;
		var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
		var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
		var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
		var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
		for (var i = startcnt; i <= rowcnt; i++) {
			var infix = ($k[0]) ? String(i) : "";
			$fobj.data("rowindex", infix);
			<?php if ($gaji_smp_edit->month->Required) { ?>
				elm = this.getElements("x" + infix + "_month");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_smp_edit->month->caption(), $gaji_smp_edit->month->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_month");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_smp_edit->month->errorMessage()) ?>");
			<?php if ($gaji_smp_edit->pegawai->Required) { ?>
				elm = this.getElements("x" + infix + "_pegawai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_smp_edit->pegawai->caption(), $gaji_smp_edit->pegawai->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($gaji_smp_edit->jenjang_id->Required) { ?>
				elm = this.getElements("x" + infix + "_jenjang_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_smp_edit->jenjang_id->caption(), $gaji_smp_edit->jenjang_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jenjang_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_smp_edit->jenjang_id->errorMessage()) ?>");
			<?php if ($gaji_smp_edit->jabatan_id->Required) { ?>
				elm = this.getElements("x" + infix + "_jabatan_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_smp_edit->jabatan_id->caption(), $gaji_smp_edit->jabatan_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jabatan_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_smp_edit->jabatan_id->errorMessage()) ?>");
			<?php if ($gaji_smp_edit->lama_kerja->Required) { ?>
				elm = this.getElements("x" + infix + "_lama_kerja");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_smp_edit->lama_kerja->caption(), $gaji_smp_edit->lama_kerja->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_lama_kerja");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_smp_edit->lama_kerja->errorMessage()) ?>");
			<?php if ($gaji_smp_edit->type->Required) { ?>
				elm = this.getElements("x" + infix + "_type");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_smp_edit->type->caption(), $gaji_smp_edit->type->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_type");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_smp_edit->type->errorMessage()) ?>");
			<?php if ($gaji_smp_edit->jenis_guru->Required) { ?>
				elm = this.getElements("x" + infix + "_jenis_guru");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_smp_edit->jenis_guru->caption(), $gaji_smp_edit->jenis_guru->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jenis_guru");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_smp_edit->jenis_guru->errorMessage()) ?>");
			<?php if ($gaji_smp_edit->tambahan->Required) { ?>
				elm = this.getElements("x" + infix + "_tambahan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_smp_edit->tambahan->caption(), $gaji_smp_edit->tambahan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tambahan");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_smp_edit->tambahan->errorMessage()) ?>");
			<?php if ($gaji_smp_edit->periode->Required) { ?>
				elm = this.getElements("x" + infix + "_periode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_smp_edit->periode->caption(), $gaji_smp_edit->periode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_periode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_smp_edit->periode->errorMessage()) ?>");
			<?php if ($gaji_smp_edit->tunjangan_periode->Required) { ?>
				elm = this.getElements("x" + infix + "_tunjangan_periode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_smp_edit->tunjangan_periode->caption(), $gaji_smp_edit->tunjangan_periode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tunjangan_periode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_smp_edit->tunjangan_periode->errorMessage()) ?>");
			<?php if ($gaji_smp_edit->kehadiran->Required) { ?>
				elm = this.getElements("x" + infix + "_kehadiran");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_smp_edit->kehadiran->caption(), $gaji_smp_edit->kehadiran->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_kehadiran");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_smp_edit->kehadiran->errorMessage()) ?>");
			<?php if ($gaji_smp_edit->value_kehadiran->Required) { ?>
				elm = this.getElements("x" + infix + "_value_kehadiran");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_smp_edit->value_kehadiran->caption(), $gaji_smp_edit->value_kehadiran->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_value_kehadiran");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_smp_edit->value_kehadiran->errorMessage()) ?>");
			<?php if ($gaji_smp_edit->lembur->Required) { ?>
				elm = this.getElements("x" + infix + "_lembur");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_smp_edit->lembur->caption(), $gaji_smp_edit->lembur->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_lembur");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_smp_edit->lembur->errorMessage()) ?>");
			<?php if ($gaji_smp_edit->value_lembur->Required) { ?>
				elm = this.getElements("x" + infix + "_value_lembur");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_smp_edit->value_lembur->caption(), $gaji_smp_edit->value_lembur->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_value_lembur");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_smp_edit->value_lembur->errorMessage()) ?>");
			<?php if ($gaji_smp_edit->jp->Required) { ?>
				elm = this.getElements("x" + infix + "_jp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_smp_edit->jp->caption(), $gaji_smp_edit->jp->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jp");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_smp_edit->jp->errorMessage()) ?>");
			<?php if ($gaji_smp_edit->gapok->Required) { ?>
				elm = this.getElements("x" + infix + "_gapok");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_smp_edit->gapok->caption(), $gaji_smp_edit->gapok->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_gapok");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_smp_edit->gapok->errorMessage()) ?>");
			<?php if ($gaji_smp_edit->total_gapok->Required) { ?>
				elm = this.getElements("x" + infix + "_total_gapok");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_smp_edit->total_gapok->caption(), $gaji_smp_edit->total_gapok->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_total_gapok");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_smp_edit->total_gapok->errorMessage()) ?>");
			<?php if ($gaji_smp_edit->value_reward->Required) { ?>
				elm = this.getElements("x" + infix + "_value_reward");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_smp_edit->value_reward->caption(), $gaji_smp_edit->value_reward->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_value_reward");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_smp_edit->value_reward->errorMessage()) ?>");
			<?php if ($gaji_smp_edit->value_inval->Required) { ?>
				elm = this.getElements("x" + infix + "_value_inval");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_smp_edit->value_inval->caption(), $gaji_smp_edit->value_inval->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_value_inval");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_smp_edit->value_inval->errorMessage()) ?>");
			<?php if ($gaji_smp_edit->piket_count->Required) { ?>
				elm = this.getElements("x" + infix + "_piket_count");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_smp_edit->piket_count->caption(), $gaji_smp_edit->piket_count->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_piket_count");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_smp_edit->piket_count->errorMessage()) ?>");
			<?php if ($gaji_smp_edit->value_piket->Required) { ?>
				elm = this.getElements("x" + infix + "_value_piket");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_smp_edit->value_piket->caption(), $gaji_smp_edit->value_piket->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_value_piket");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_smp_edit->value_piket->errorMessage()) ?>");
			<?php if ($gaji_smp_edit->tugastambahan->Required) { ?>
				elm = this.getElements("x" + infix + "_tugastambahan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_smp_edit->tugastambahan->caption(), $gaji_smp_edit->tugastambahan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tugastambahan");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_smp_edit->tugastambahan->errorMessage()) ?>");
			<?php if ($gaji_smp_edit->tj_jabatan->Required) { ?>
				elm = this.getElements("x" + infix + "_tj_jabatan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_smp_edit->tj_jabatan->caption(), $gaji_smp_edit->tj_jabatan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tj_jabatan");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_smp_edit->tj_jabatan->errorMessage()) ?>");
			<?php if ($gaji_smp_edit->sub_total->Required) { ?>
				elm = this.getElements("x" + infix + "_sub_total");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_smp_edit->sub_total->caption(), $gaji_smp_edit->sub_total->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_sub_total");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_smp_edit->sub_total->errorMessage()) ?>");
			<?php if ($gaji_smp_edit->potongan->Required) { ?>
				elm = this.getElements("x" + infix + "_potongan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_smp_edit->potongan->caption(), $gaji_smp_edit->potongan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_potongan");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_smp_edit->potongan->errorMessage()) ?>");
			<?php if ($gaji_smp_edit->penyesuaian->Required) { ?>
				elm = this.getElements("x" + infix + "_penyesuaian");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_smp_edit->penyesuaian->caption(), $gaji_smp_edit->penyesuaian->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_penyesuaian");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_smp_edit->penyesuaian->errorMessage()) ?>");
			<?php if ($gaji_smp_edit->total->Required) { ?>
				elm = this.getElements("x" + infix + "_total");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_smp_edit->total->caption(), $gaji_smp_edit->total->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_total");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_smp_edit->total->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}

		// Process detail forms
		var dfs = $fobj.find("input[name='detailpage']").get();
		for (var i = 0; i < dfs.length; i++) {
			var df = dfs[i], val = df.value;
			if (val && ew.forms[val])
				if (!ew.forms[val].validate())
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fgaji_smpedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fgaji_smpedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fgaji_smpedit.lists["x_pegawai"] = <?php echo $gaji_smp_edit->pegawai->Lookup->toClientList($gaji_smp_edit) ?>;
	fgaji_smpedit.lists["x_pegawai"].options = <?php echo JsonEncode($gaji_smp_edit->pegawai->lookupOptions()) ?>;
	fgaji_smpedit.lists["x_jenjang_id"] = <?php echo $gaji_smp_edit->jenjang_id->Lookup->toClientList($gaji_smp_edit) ?>;
	fgaji_smpedit.lists["x_jenjang_id"].options = <?php echo JsonEncode($gaji_smp_edit->jenjang_id->lookupOptions()) ?>;
	fgaji_smpedit.autoSuggests["x_jenjang_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fgaji_smpedit.lists["x_jabatan_id"] = <?php echo $gaji_smp_edit->jabatan_id->Lookup->toClientList($gaji_smp_edit) ?>;
	fgaji_smpedit.lists["x_jabatan_id"].options = <?php echo JsonEncode($gaji_smp_edit->jabatan_id->lookupOptions()) ?>;
	fgaji_smpedit.autoSuggests["x_jabatan_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fgaji_smpedit.lists["x_type"] = <?php echo $gaji_smp_edit->type->Lookup->toClientList($gaji_smp_edit) ?>;
	fgaji_smpedit.lists["x_type"].options = <?php echo JsonEncode($gaji_smp_edit->type->lookupOptions()) ?>;
	fgaji_smpedit.autoSuggests["x_type"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fgaji_smpedit.lists["x_jenis_guru"] = <?php echo $gaji_smp_edit->jenis_guru->Lookup->toClientList($gaji_smp_edit) ?>;
	fgaji_smpedit.lists["x_jenis_guru"].options = <?php echo JsonEncode($gaji_smp_edit->jenis_guru->lookupOptions()) ?>;
	fgaji_smpedit.autoSuggests["x_jenis_guru"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fgaji_smpedit.lists["x_tambahan"] = <?php echo $gaji_smp_edit->tambahan->Lookup->toClientList($gaji_smp_edit) ?>;
	fgaji_smpedit.lists["x_tambahan"].options = <?php echo JsonEncode($gaji_smp_edit->tambahan->lookupOptions()) ?>;
	fgaji_smpedit.autoSuggests["x_tambahan"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fgaji_smpedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $gaji_smp_edit->showPageHeader(); ?>
<?php
$gaji_smp_edit->showMessage();
?>
<form name="fgaji_smpedit" id="fgaji_smpedit" class="<?php echo $gaji_smp_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gaji_smp">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$gaji_smp_edit->IsModal ?>">
<?php if ($gaji_smp->getCurrentMasterTable() == "m_smp") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="m_smp">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($gaji_smp_edit->pid->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($gaji_smp_edit->month->Visible) { // month ?>
	<div id="r_month" class="form-group row">
		<label id="elh_gaji_smp_month" for="x_month" class="<?php echo $gaji_smp_edit->LeftColumnClass ?>"><?php echo $gaji_smp_edit->month->caption() ?><?php echo $gaji_smp_edit->month->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_smp_edit->RightColumnClass ?>"><div <?php echo $gaji_smp_edit->month->cellAttributes() ?>>
<span id="el_gaji_smp_month">
<input type="text" data-table="gaji_smp" data-field="x_month" name="x_month" id="x_month" maxlength="10" placeholder="<?php echo HtmlEncode($gaji_smp_edit->month->getPlaceHolder()) ?>" value="<?php echo $gaji_smp_edit->month->EditValue ?>"<?php echo $gaji_smp_edit->month->editAttributes() ?>>
<?php if (!$gaji_smp_edit->month->ReadOnly && !$gaji_smp_edit->month->Disabled && !isset($gaji_smp_edit->month->EditAttrs["readonly"]) && !isset($gaji_smp_edit->month->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fgaji_smpedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fgaji_smpedit", "x_month", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $gaji_smp_edit->month->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_smp_edit->pegawai->Visible) { // pegawai ?>
	<div id="r_pegawai" class="form-group row">
		<label id="elh_gaji_smp_pegawai" for="x_pegawai" class="<?php echo $gaji_smp_edit->LeftColumnClass ?>"><?php echo $gaji_smp_edit->pegawai->caption() ?><?php echo $gaji_smp_edit->pegawai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_smp_edit->RightColumnClass ?>"><div <?php echo $gaji_smp_edit->pegawai->cellAttributes() ?>>
<span id="el_gaji_smp_pegawai">
<?php $gaji_smp_edit->pegawai->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_pegawai"><?php echo EmptyValue(strval($gaji_smp_edit->pegawai->ViewValue)) ? $Language->phrase("PleaseSelect") : $gaji_smp_edit->pegawai->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($gaji_smp_edit->pegawai->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($gaji_smp_edit->pegawai->ReadOnly || $gaji_smp_edit->pegawai->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_pegawai',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $gaji_smp_edit->pegawai->Lookup->getParamTag($gaji_smp_edit, "p_x_pegawai") ?>
<input type="hidden" data-table="gaji_smp" data-field="x_pegawai" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $gaji_smp_edit->pegawai->displayValueSeparatorAttribute() ?>" name="x_pegawai" id="x_pegawai" value="<?php echo $gaji_smp_edit->pegawai->CurrentValue ?>"<?php echo $gaji_smp_edit->pegawai->editAttributes() ?>>
</span>
<?php echo $gaji_smp_edit->pegawai->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_smp_edit->jenjang_id->Visible) { // jenjang_id ?>
	<div id="r_jenjang_id" class="form-group row">
		<label id="elh_gaji_smp_jenjang_id" class="<?php echo $gaji_smp_edit->LeftColumnClass ?>"><?php echo $gaji_smp_edit->jenjang_id->caption() ?><?php echo $gaji_smp_edit->jenjang_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_smp_edit->RightColumnClass ?>"><div <?php echo $gaji_smp_edit->jenjang_id->cellAttributes() ?>>
<span id="el_gaji_smp_jenjang_id">
<?php
$onchange = $gaji_smp_edit->jenjang_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$gaji_smp_edit->jenjang_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_jenjang_id">
	<input type="text" class="form-control" name="sv_x_jenjang_id" id="sv_x_jenjang_id" value="<?php echo RemoveHtml($gaji_smp_edit->jenjang_id->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($gaji_smp_edit->jenjang_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($gaji_smp_edit->jenjang_id->getPlaceHolder()) ?>"<?php echo $gaji_smp_edit->jenjang_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_smp" data-field="x_jenjang_id" data-value-separator="<?php echo $gaji_smp_edit->jenjang_id->displayValueSeparatorAttribute() ?>" name="x_jenjang_id" id="x_jenjang_id" value="<?php echo HtmlEncode($gaji_smp_edit->jenjang_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fgaji_smpedit"], function() {
	fgaji_smpedit.createAutoSuggest({"id":"x_jenjang_id","forceSelect":false});
});
</script>
<?php echo $gaji_smp_edit->jenjang_id->Lookup->getParamTag($gaji_smp_edit, "p_x_jenjang_id") ?>
</span>
<?php echo $gaji_smp_edit->jenjang_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_smp_edit->jabatan_id->Visible) { // jabatan_id ?>
	<div id="r_jabatan_id" class="form-group row">
		<label id="elh_gaji_smp_jabatan_id" class="<?php echo $gaji_smp_edit->LeftColumnClass ?>"><?php echo $gaji_smp_edit->jabatan_id->caption() ?><?php echo $gaji_smp_edit->jabatan_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_smp_edit->RightColumnClass ?>"><div <?php echo $gaji_smp_edit->jabatan_id->cellAttributes() ?>>
<span id="el_gaji_smp_jabatan_id">
<?php
$onchange = $gaji_smp_edit->jabatan_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$gaji_smp_edit->jabatan_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_jabatan_id">
	<input type="text" class="form-control" name="sv_x_jabatan_id" id="sv_x_jabatan_id" value="<?php echo RemoveHtml($gaji_smp_edit->jabatan_id->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($gaji_smp_edit->jabatan_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($gaji_smp_edit->jabatan_id->getPlaceHolder()) ?>"<?php echo $gaji_smp_edit->jabatan_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_smp" data-field="x_jabatan_id" data-value-separator="<?php echo $gaji_smp_edit->jabatan_id->displayValueSeparatorAttribute() ?>" name="x_jabatan_id" id="x_jabatan_id" value="<?php echo HtmlEncode($gaji_smp_edit->jabatan_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fgaji_smpedit"], function() {
	fgaji_smpedit.createAutoSuggest({"id":"x_jabatan_id","forceSelect":false});
});
</script>
<?php echo $gaji_smp_edit->jabatan_id->Lookup->getParamTag($gaji_smp_edit, "p_x_jabatan_id") ?>
</span>
<?php echo $gaji_smp_edit->jabatan_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_smp_edit->lama_kerja->Visible) { // lama_kerja ?>
	<div id="r_lama_kerja" class="form-group row">
		<label id="elh_gaji_smp_lama_kerja" for="x_lama_kerja" class="<?php echo $gaji_smp_edit->LeftColumnClass ?>"><?php echo $gaji_smp_edit->lama_kerja->caption() ?><?php echo $gaji_smp_edit->lama_kerja->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_smp_edit->RightColumnClass ?>"><div <?php echo $gaji_smp_edit->lama_kerja->cellAttributes() ?>>
<span id="el_gaji_smp_lama_kerja">
<input type="text" data-table="gaji_smp" data-field="x_lama_kerja" name="x_lama_kerja" id="x_lama_kerja" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gaji_smp_edit->lama_kerja->getPlaceHolder()) ?>" value="<?php echo $gaji_smp_edit->lama_kerja->EditValue ?>"<?php echo $gaji_smp_edit->lama_kerja->editAttributes() ?>>
</span>
<?php echo $gaji_smp_edit->lama_kerja->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_smp_edit->type->Visible) { // type ?>
	<div id="r_type" class="form-group row">
		<label id="elh_gaji_smp_type" class="<?php echo $gaji_smp_edit->LeftColumnClass ?>"><?php echo $gaji_smp_edit->type->caption() ?><?php echo $gaji_smp_edit->type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_smp_edit->RightColumnClass ?>"><div <?php echo $gaji_smp_edit->type->cellAttributes() ?>>
<span id="el_gaji_smp_type">
<?php
$onchange = $gaji_smp_edit->type->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$gaji_smp_edit->type->EditAttrs["onchange"] = "";
?>
<span id="as_x_type">
	<input type="text" class="form-control" name="sv_x_type" id="sv_x_type" value="<?php echo RemoveHtml($gaji_smp_edit->type->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gaji_smp_edit->type->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($gaji_smp_edit->type->getPlaceHolder()) ?>"<?php echo $gaji_smp_edit->type->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_smp" data-field="x_type" data-value-separator="<?php echo $gaji_smp_edit->type->displayValueSeparatorAttribute() ?>" name="x_type" id="x_type" value="<?php echo HtmlEncode($gaji_smp_edit->type->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fgaji_smpedit"], function() {
	fgaji_smpedit.createAutoSuggest({"id":"x_type","forceSelect":false});
});
</script>
<?php echo $gaji_smp_edit->type->Lookup->getParamTag($gaji_smp_edit, "p_x_type") ?>
</span>
<?php echo $gaji_smp_edit->type->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_smp_edit->jenis_guru->Visible) { // jenis_guru ?>
	<div id="r_jenis_guru" class="form-group row">
		<label id="elh_gaji_smp_jenis_guru" class="<?php echo $gaji_smp_edit->LeftColumnClass ?>"><?php echo $gaji_smp_edit->jenis_guru->caption() ?><?php echo $gaji_smp_edit->jenis_guru->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_smp_edit->RightColumnClass ?>"><div <?php echo $gaji_smp_edit->jenis_guru->cellAttributes() ?>>
<span id="el_gaji_smp_jenis_guru">
<?php
$onchange = $gaji_smp_edit->jenis_guru->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$gaji_smp_edit->jenis_guru->EditAttrs["onchange"] = "";
?>
<span id="as_x_jenis_guru">
	<input type="text" class="form-control" name="sv_x_jenis_guru" id="sv_x_jenis_guru" value="<?php echo RemoveHtml($gaji_smp_edit->jenis_guru->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gaji_smp_edit->jenis_guru->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($gaji_smp_edit->jenis_guru->getPlaceHolder()) ?>"<?php echo $gaji_smp_edit->jenis_guru->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_smp" data-field="x_jenis_guru" data-value-separator="<?php echo $gaji_smp_edit->jenis_guru->displayValueSeparatorAttribute() ?>" name="x_jenis_guru" id="x_jenis_guru" value="<?php echo HtmlEncode($gaji_smp_edit->jenis_guru->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fgaji_smpedit"], function() {
	fgaji_smpedit.createAutoSuggest({"id":"x_jenis_guru","forceSelect":false});
});
</script>
<?php echo $gaji_smp_edit->jenis_guru->Lookup->getParamTag($gaji_smp_edit, "p_x_jenis_guru") ?>
</span>
<?php echo $gaji_smp_edit->jenis_guru->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_smp_edit->tambahan->Visible) { // tambahan ?>
	<div id="r_tambahan" class="form-group row">
		<label id="elh_gaji_smp_tambahan" class="<?php echo $gaji_smp_edit->LeftColumnClass ?>"><?php echo $gaji_smp_edit->tambahan->caption() ?><?php echo $gaji_smp_edit->tambahan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_smp_edit->RightColumnClass ?>"><div <?php echo $gaji_smp_edit->tambahan->cellAttributes() ?>>
<span id="el_gaji_smp_tambahan">
<?php
$onchange = $gaji_smp_edit->tambahan->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$gaji_smp_edit->tambahan->EditAttrs["onchange"] = "";
?>
<span id="as_x_tambahan">
	<input type="text" class="form-control" name="sv_x_tambahan" id="sv_x_tambahan" value="<?php echo RemoveHtml($gaji_smp_edit->tambahan->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gaji_smp_edit->tambahan->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($gaji_smp_edit->tambahan->getPlaceHolder()) ?>"<?php echo $gaji_smp_edit->tambahan->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_smp" data-field="x_tambahan" data-value-separator="<?php echo $gaji_smp_edit->tambahan->displayValueSeparatorAttribute() ?>" name="x_tambahan" id="x_tambahan" value="<?php echo HtmlEncode($gaji_smp_edit->tambahan->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fgaji_smpedit"], function() {
	fgaji_smpedit.createAutoSuggest({"id":"x_tambahan","forceSelect":false});
});
</script>
<?php echo $gaji_smp_edit->tambahan->Lookup->getParamTag($gaji_smp_edit, "p_x_tambahan") ?>
</span>
<?php echo $gaji_smp_edit->tambahan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_smp_edit->periode->Visible) { // periode ?>
	<div id="r_periode" class="form-group row">
		<label id="elh_gaji_smp_periode" for="x_periode" class="<?php echo $gaji_smp_edit->LeftColumnClass ?>"><?php echo $gaji_smp_edit->periode->caption() ?><?php echo $gaji_smp_edit->periode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_smp_edit->RightColumnClass ?>"><div <?php echo $gaji_smp_edit->periode->cellAttributes() ?>>
<span id="el_gaji_smp_periode">
<input type="text" data-table="gaji_smp" data-field="x_periode" name="x_periode" id="x_periode" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gaji_smp_edit->periode->getPlaceHolder()) ?>" value="<?php echo $gaji_smp_edit->periode->EditValue ?>"<?php echo $gaji_smp_edit->periode->editAttributes() ?>>
</span>
<?php echo $gaji_smp_edit->periode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_smp_edit->tunjangan_periode->Visible) { // tunjangan_periode ?>
	<div id="r_tunjangan_periode" class="form-group row">
		<label id="elh_gaji_smp_tunjangan_periode" for="x_tunjangan_periode" class="<?php echo $gaji_smp_edit->LeftColumnClass ?>"><?php echo $gaji_smp_edit->tunjangan_periode->caption() ?><?php echo $gaji_smp_edit->tunjangan_periode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_smp_edit->RightColumnClass ?>"><div <?php echo $gaji_smp_edit->tunjangan_periode->cellAttributes() ?>>
<span id="el_gaji_smp_tunjangan_periode">
<input type="text" data-table="gaji_smp" data-field="x_tunjangan_periode" name="x_tunjangan_periode" id="x_tunjangan_periode" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gaji_smp_edit->tunjangan_periode->getPlaceHolder()) ?>" value="<?php echo $gaji_smp_edit->tunjangan_periode->EditValue ?>"<?php echo $gaji_smp_edit->tunjangan_periode->editAttributes() ?>>
</span>
<?php echo $gaji_smp_edit->tunjangan_periode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_smp_edit->kehadiran->Visible) { // kehadiran ?>
	<div id="r_kehadiran" class="form-group row">
		<label id="elh_gaji_smp_kehadiran" for="x_kehadiran" class="<?php echo $gaji_smp_edit->LeftColumnClass ?>"><?php echo $gaji_smp_edit->kehadiran->caption() ?><?php echo $gaji_smp_edit->kehadiran->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_smp_edit->RightColumnClass ?>"><div <?php echo $gaji_smp_edit->kehadiran->cellAttributes() ?>>
<span id="el_gaji_smp_kehadiran">
<input type="text" data-table="gaji_smp" data-field="x_kehadiran" name="x_kehadiran" id="x_kehadiran" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($gaji_smp_edit->kehadiran->getPlaceHolder()) ?>" value="<?php echo $gaji_smp_edit->kehadiran->EditValue ?>"<?php echo $gaji_smp_edit->kehadiran->editAttributes() ?>>
</span>
<?php echo $gaji_smp_edit->kehadiran->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_smp_edit->value_kehadiran->Visible) { // value_kehadiran ?>
	<div id="r_value_kehadiran" class="form-group row">
		<label id="elh_gaji_smp_value_kehadiran" for="x_value_kehadiran" class="<?php echo $gaji_smp_edit->LeftColumnClass ?>"><?php echo $gaji_smp_edit->value_kehadiran->caption() ?><?php echo $gaji_smp_edit->value_kehadiran->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_smp_edit->RightColumnClass ?>"><div <?php echo $gaji_smp_edit->value_kehadiran->cellAttributes() ?>>
<span id="el_gaji_smp_value_kehadiran">
<input type="text" data-table="gaji_smp" data-field="x_value_kehadiran" name="x_value_kehadiran" id="x_value_kehadiran" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gaji_smp_edit->value_kehadiran->getPlaceHolder()) ?>" value="<?php echo $gaji_smp_edit->value_kehadiran->EditValue ?>"<?php echo $gaji_smp_edit->value_kehadiran->editAttributes() ?>>
</span>
<?php echo $gaji_smp_edit->value_kehadiran->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_smp_edit->lembur->Visible) { // lembur ?>
	<div id="r_lembur" class="form-group row">
		<label id="elh_gaji_smp_lembur" for="x_lembur" class="<?php echo $gaji_smp_edit->LeftColumnClass ?>"><?php echo $gaji_smp_edit->lembur->caption() ?><?php echo $gaji_smp_edit->lembur->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_smp_edit->RightColumnClass ?>"><div <?php echo $gaji_smp_edit->lembur->cellAttributes() ?>>
<span id="el_gaji_smp_lembur">
<input type="text" data-table="gaji_smp" data-field="x_lembur" name="x_lembur" id="x_lembur" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($gaji_smp_edit->lembur->getPlaceHolder()) ?>" value="<?php echo $gaji_smp_edit->lembur->EditValue ?>"<?php echo $gaji_smp_edit->lembur->editAttributes() ?>>
</span>
<?php echo $gaji_smp_edit->lembur->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_smp_edit->value_lembur->Visible) { // value_lembur ?>
	<div id="r_value_lembur" class="form-group row">
		<label id="elh_gaji_smp_value_lembur" for="x_value_lembur" class="<?php echo $gaji_smp_edit->LeftColumnClass ?>"><?php echo $gaji_smp_edit->value_lembur->caption() ?><?php echo $gaji_smp_edit->value_lembur->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_smp_edit->RightColumnClass ?>"><div <?php echo $gaji_smp_edit->value_lembur->cellAttributes() ?>>
<span id="el_gaji_smp_value_lembur">
<input type="text" data-table="gaji_smp" data-field="x_value_lembur" name="x_value_lembur" id="x_value_lembur" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_smp_edit->value_lembur->getPlaceHolder()) ?>" value="<?php echo $gaji_smp_edit->value_lembur->EditValue ?>"<?php echo $gaji_smp_edit->value_lembur->editAttributes() ?>>
</span>
<?php echo $gaji_smp_edit->value_lembur->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_smp_edit->jp->Visible) { // jp ?>
	<div id="r_jp" class="form-group row">
		<label id="elh_gaji_smp_jp" for="x_jp" class="<?php echo $gaji_smp_edit->LeftColumnClass ?>"><?php echo $gaji_smp_edit->jp->caption() ?><?php echo $gaji_smp_edit->jp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_smp_edit->RightColumnClass ?>"><div <?php echo $gaji_smp_edit->jp->cellAttributes() ?>>
<span id="el_gaji_smp_jp">
<input type="text" data-table="gaji_smp" data-field="x_jp" name="x_jp" id="x_jp" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gaji_smp_edit->jp->getPlaceHolder()) ?>" value="<?php echo $gaji_smp_edit->jp->EditValue ?>"<?php echo $gaji_smp_edit->jp->editAttributes() ?>>
</span>
<?php echo $gaji_smp_edit->jp->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_smp_edit->gapok->Visible) { // gapok ?>
	<div id="r_gapok" class="form-group row">
		<label id="elh_gaji_smp_gapok" for="x_gapok" class="<?php echo $gaji_smp_edit->LeftColumnClass ?>"><?php echo $gaji_smp_edit->gapok->caption() ?><?php echo $gaji_smp_edit->gapok->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_smp_edit->RightColumnClass ?>"><div <?php echo $gaji_smp_edit->gapok->cellAttributes() ?>>
<span id="el_gaji_smp_gapok">
<input type="text" data-table="gaji_smp" data-field="x_gapok" name="x_gapok" id="x_gapok" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_smp_edit->gapok->getPlaceHolder()) ?>" value="<?php echo $gaji_smp_edit->gapok->EditValue ?>"<?php echo $gaji_smp_edit->gapok->editAttributes() ?>>
</span>
<?php echo $gaji_smp_edit->gapok->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_smp_edit->total_gapok->Visible) { // total_gapok ?>
	<div id="r_total_gapok" class="form-group row">
		<label id="elh_gaji_smp_total_gapok" for="x_total_gapok" class="<?php echo $gaji_smp_edit->LeftColumnClass ?>"><?php echo $gaji_smp_edit->total_gapok->caption() ?><?php echo $gaji_smp_edit->total_gapok->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_smp_edit->RightColumnClass ?>"><div <?php echo $gaji_smp_edit->total_gapok->cellAttributes() ?>>
<span id="el_gaji_smp_total_gapok">
<input type="text" data-table="gaji_smp" data-field="x_total_gapok" name="x_total_gapok" id="x_total_gapok" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gaji_smp_edit->total_gapok->getPlaceHolder()) ?>" value="<?php echo $gaji_smp_edit->total_gapok->EditValue ?>"<?php echo $gaji_smp_edit->total_gapok->editAttributes() ?>>
</span>
<?php echo $gaji_smp_edit->total_gapok->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_smp_edit->value_reward->Visible) { // value_reward ?>
	<div id="r_value_reward" class="form-group row">
		<label id="elh_gaji_smp_value_reward" for="x_value_reward" class="<?php echo $gaji_smp_edit->LeftColumnClass ?>"><?php echo $gaji_smp_edit->value_reward->caption() ?><?php echo $gaji_smp_edit->value_reward->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_smp_edit->RightColumnClass ?>"><div <?php echo $gaji_smp_edit->value_reward->cellAttributes() ?>>
<span id="el_gaji_smp_value_reward">
<input type="text" data-table="gaji_smp" data-field="x_value_reward" name="x_value_reward" id="x_value_reward" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_smp_edit->value_reward->getPlaceHolder()) ?>" value="<?php echo $gaji_smp_edit->value_reward->EditValue ?>"<?php echo $gaji_smp_edit->value_reward->editAttributes() ?>>
</span>
<?php echo $gaji_smp_edit->value_reward->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_smp_edit->value_inval->Visible) { // value_inval ?>
	<div id="r_value_inval" class="form-group row">
		<label id="elh_gaji_smp_value_inval" for="x_value_inval" class="<?php echo $gaji_smp_edit->LeftColumnClass ?>"><?php echo $gaji_smp_edit->value_inval->caption() ?><?php echo $gaji_smp_edit->value_inval->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_smp_edit->RightColumnClass ?>"><div <?php echo $gaji_smp_edit->value_inval->cellAttributes() ?>>
<span id="el_gaji_smp_value_inval">
<input type="text" data-table="gaji_smp" data-field="x_value_inval" name="x_value_inval" id="x_value_inval" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_smp_edit->value_inval->getPlaceHolder()) ?>" value="<?php echo $gaji_smp_edit->value_inval->EditValue ?>"<?php echo $gaji_smp_edit->value_inval->editAttributes() ?>>
</span>
<?php echo $gaji_smp_edit->value_inval->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_smp_edit->piket_count->Visible) { // piket_count ?>
	<div id="r_piket_count" class="form-group row">
		<label id="elh_gaji_smp_piket_count" for="x_piket_count" class="<?php echo $gaji_smp_edit->LeftColumnClass ?>"><?php echo $gaji_smp_edit->piket_count->caption() ?><?php echo $gaji_smp_edit->piket_count->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_smp_edit->RightColumnClass ?>"><div <?php echo $gaji_smp_edit->piket_count->cellAttributes() ?>>
<span id="el_gaji_smp_piket_count">
<input type="text" data-table="gaji_smp" data-field="x_piket_count" name="x_piket_count" id="x_piket_count" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($gaji_smp_edit->piket_count->getPlaceHolder()) ?>" value="<?php echo $gaji_smp_edit->piket_count->EditValue ?>"<?php echo $gaji_smp_edit->piket_count->editAttributes() ?>>
</span>
<?php echo $gaji_smp_edit->piket_count->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_smp_edit->value_piket->Visible) { // value_piket ?>
	<div id="r_value_piket" class="form-group row">
		<label id="elh_gaji_smp_value_piket" for="x_value_piket" class="<?php echo $gaji_smp_edit->LeftColumnClass ?>"><?php echo $gaji_smp_edit->value_piket->caption() ?><?php echo $gaji_smp_edit->value_piket->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_smp_edit->RightColumnClass ?>"><div <?php echo $gaji_smp_edit->value_piket->cellAttributes() ?>>
<span id="el_gaji_smp_value_piket">
<input type="text" data-table="gaji_smp" data-field="x_value_piket" name="x_value_piket" id="x_value_piket" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_smp_edit->value_piket->getPlaceHolder()) ?>" value="<?php echo $gaji_smp_edit->value_piket->EditValue ?>"<?php echo $gaji_smp_edit->value_piket->editAttributes() ?>>
</span>
<?php echo $gaji_smp_edit->value_piket->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_smp_edit->tugastambahan->Visible) { // tugastambahan ?>
	<div id="r_tugastambahan" class="form-group row">
		<label id="elh_gaji_smp_tugastambahan" for="x_tugastambahan" class="<?php echo $gaji_smp_edit->LeftColumnClass ?>"><?php echo $gaji_smp_edit->tugastambahan->caption() ?><?php echo $gaji_smp_edit->tugastambahan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_smp_edit->RightColumnClass ?>"><div <?php echo $gaji_smp_edit->tugastambahan->cellAttributes() ?>>
<span id="el_gaji_smp_tugastambahan">
<input type="text" data-table="gaji_smp" data-field="x_tugastambahan" name="x_tugastambahan" id="x_tugastambahan" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_smp_edit->tugastambahan->getPlaceHolder()) ?>" value="<?php echo $gaji_smp_edit->tugastambahan->EditValue ?>"<?php echo $gaji_smp_edit->tugastambahan->editAttributes() ?>>
</span>
<?php echo $gaji_smp_edit->tugastambahan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_smp_edit->tj_jabatan->Visible) { // tj_jabatan ?>
	<div id="r_tj_jabatan" class="form-group row">
		<label id="elh_gaji_smp_tj_jabatan" for="x_tj_jabatan" class="<?php echo $gaji_smp_edit->LeftColumnClass ?>"><?php echo $gaji_smp_edit->tj_jabatan->caption() ?><?php echo $gaji_smp_edit->tj_jabatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_smp_edit->RightColumnClass ?>"><div <?php echo $gaji_smp_edit->tj_jabatan->cellAttributes() ?>>
<span id="el_gaji_smp_tj_jabatan">
<input type="text" data-table="gaji_smp" data-field="x_tj_jabatan" name="x_tj_jabatan" id="x_tj_jabatan" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_smp_edit->tj_jabatan->getPlaceHolder()) ?>" value="<?php echo $gaji_smp_edit->tj_jabatan->EditValue ?>"<?php echo $gaji_smp_edit->tj_jabatan->editAttributes() ?>>
</span>
<?php echo $gaji_smp_edit->tj_jabatan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_smp_edit->sub_total->Visible) { // sub_total ?>
	<div id="r_sub_total" class="form-group row">
		<label id="elh_gaji_smp_sub_total" for="x_sub_total" class="<?php echo $gaji_smp_edit->LeftColumnClass ?>"><?php echo $gaji_smp_edit->sub_total->caption() ?><?php echo $gaji_smp_edit->sub_total->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_smp_edit->RightColumnClass ?>"><div <?php echo $gaji_smp_edit->sub_total->cellAttributes() ?>>
<span id="el_gaji_smp_sub_total">
<input type="text" data-table="gaji_smp" data-field="x_sub_total" name="x_sub_total" id="x_sub_total" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_smp_edit->sub_total->getPlaceHolder()) ?>" value="<?php echo $gaji_smp_edit->sub_total->EditValue ?>"<?php echo $gaji_smp_edit->sub_total->editAttributes() ?>>
</span>
<?php echo $gaji_smp_edit->sub_total->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_smp_edit->potongan->Visible) { // potongan ?>
	<div id="r_potongan" class="form-group row">
		<label id="elh_gaji_smp_potongan" for="x_potongan" class="<?php echo $gaji_smp_edit->LeftColumnClass ?>"><?php echo $gaji_smp_edit->potongan->caption() ?><?php echo $gaji_smp_edit->potongan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_smp_edit->RightColumnClass ?>"><div <?php echo $gaji_smp_edit->potongan->cellAttributes() ?>>
<span id="el_gaji_smp_potongan">
<input type="text" data-table="gaji_smp" data-field="x_potongan" name="x_potongan" id="x_potongan" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_smp_edit->potongan->getPlaceHolder()) ?>" value="<?php echo $gaji_smp_edit->potongan->EditValue ?>"<?php echo $gaji_smp_edit->potongan->editAttributes() ?>>
</span>
<?php echo $gaji_smp_edit->potongan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_smp_edit->penyesuaian->Visible) { // penyesuaian ?>
	<div id="r_penyesuaian" class="form-group row">
		<label id="elh_gaji_smp_penyesuaian" for="x_penyesuaian" class="<?php echo $gaji_smp_edit->LeftColumnClass ?>"><?php echo $gaji_smp_edit->penyesuaian->caption() ?><?php echo $gaji_smp_edit->penyesuaian->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_smp_edit->RightColumnClass ?>"><div <?php echo $gaji_smp_edit->penyesuaian->cellAttributes() ?>>
<span id="el_gaji_smp_penyesuaian">
<input type="text" data-table="gaji_smp" data-field="x_penyesuaian" name="x_penyesuaian" id="x_penyesuaian" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_smp_edit->penyesuaian->getPlaceHolder()) ?>" value="<?php echo $gaji_smp_edit->penyesuaian->EditValue ?>"<?php echo $gaji_smp_edit->penyesuaian->editAttributes() ?>>
</span>
<?php echo $gaji_smp_edit->penyesuaian->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_smp_edit->total->Visible) { // total ?>
	<div id="r_total" class="form-group row">
		<label id="elh_gaji_smp_total" for="x_total" class="<?php echo $gaji_smp_edit->LeftColumnClass ?>"><?php echo $gaji_smp_edit->total->caption() ?><?php echo $gaji_smp_edit->total->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_smp_edit->RightColumnClass ?>"><div <?php echo $gaji_smp_edit->total->cellAttributes() ?>>
<span id="el_gaji_smp_total">
<input type="text" data-table="gaji_smp" data-field="x_total" name="x_total" id="x_total" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_smp_edit->total->getPlaceHolder()) ?>" value="<?php echo $gaji_smp_edit->total->EditValue ?>"<?php echo $gaji_smp_edit->total->editAttributes() ?>>
</span>
<?php echo $gaji_smp_edit->total->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="gaji_smp" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($gaji_smp_edit->id->CurrentValue) ?>">
<?php if (!$gaji_smp_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $gaji_smp_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $gaji_smp_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$gaji_smp_edit->showPageFooter();
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
$gaji_smp_edit->terminate();
?>