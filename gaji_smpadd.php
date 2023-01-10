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
$gaji_smp_add = new gaji_smp_add();

// Run the page
$gaji_smp_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gaji_smp_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fgaji_smpadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fgaji_smpadd = currentForm = new ew.Form("fgaji_smpadd", "add");

	// Validate form
	fgaji_smpadd.validate = function() {
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
			<?php if ($gaji_smp_add->pegawai->Required) { ?>
				elm = this.getElements("x" + infix + "_pegawai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_smp_add->pegawai->caption(), $gaji_smp_add->pegawai->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($gaji_smp_add->jenjang_id->Required) { ?>
				elm = this.getElements("x" + infix + "_jenjang_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_smp_add->jenjang_id->caption(), $gaji_smp_add->jenjang_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jenjang_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_smp_add->jenjang_id->errorMessage()) ?>");
			<?php if ($gaji_smp_add->jabatan_id->Required) { ?>
				elm = this.getElements("x" + infix + "_jabatan_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_smp_add->jabatan_id->caption(), $gaji_smp_add->jabatan_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jabatan_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_smp_add->jabatan_id->errorMessage()) ?>");
			<?php if ($gaji_smp_add->lama_kerja->Required) { ?>
				elm = this.getElements("x" + infix + "_lama_kerja");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_smp_add->lama_kerja->caption(), $gaji_smp_add->lama_kerja->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_lama_kerja");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_smp_add->lama_kerja->errorMessage()) ?>");
			<?php if ($gaji_smp_add->type->Required) { ?>
				elm = this.getElements("x" + infix + "_type");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_smp_add->type->caption(), $gaji_smp_add->type->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_type");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_smp_add->type->errorMessage()) ?>");
			<?php if ($gaji_smp_add->jenis_guru->Required) { ?>
				elm = this.getElements("x" + infix + "_jenis_guru");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_smp_add->jenis_guru->caption(), $gaji_smp_add->jenis_guru->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jenis_guru");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_smp_add->jenis_guru->errorMessage()) ?>");
			<?php if ($gaji_smp_add->tambahan->Required) { ?>
				elm = this.getElements("x" + infix + "_tambahan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_smp_add->tambahan->caption(), $gaji_smp_add->tambahan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tambahan");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_smp_add->tambahan->errorMessage()) ?>");
			<?php if ($gaji_smp_add->periode->Required) { ?>
				elm = this.getElements("x" + infix + "_periode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_smp_add->periode->caption(), $gaji_smp_add->periode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_periode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_smp_add->periode->errorMessage()) ?>");
			<?php if ($gaji_smp_add->tunjangan_periode->Required) { ?>
				elm = this.getElements("x" + infix + "_tunjangan_periode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_smp_add->tunjangan_periode->caption(), $gaji_smp_add->tunjangan_periode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tunjangan_periode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_smp_add->tunjangan_periode->errorMessage()) ?>");
			<?php if ($gaji_smp_add->kehadiran->Required) { ?>
				elm = this.getElements("x" + infix + "_kehadiran");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_smp_add->kehadiran->caption(), $gaji_smp_add->kehadiran->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_kehadiran");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_smp_add->kehadiran->errorMessage()) ?>");
			<?php if ($gaji_smp_add->value_kehadiran->Required) { ?>
				elm = this.getElements("x" + infix + "_value_kehadiran");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_smp_add->value_kehadiran->caption(), $gaji_smp_add->value_kehadiran->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_value_kehadiran");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_smp_add->value_kehadiran->errorMessage()) ?>");
			<?php if ($gaji_smp_add->lembur->Required) { ?>
				elm = this.getElements("x" + infix + "_lembur");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_smp_add->lembur->caption(), $gaji_smp_add->lembur->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_lembur");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_smp_add->lembur->errorMessage()) ?>");
			<?php if ($gaji_smp_add->jp->Required) { ?>
				elm = this.getElements("x" + infix + "_jp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_smp_add->jp->caption(), $gaji_smp_add->jp->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jp");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_smp_add->jp->errorMessage()) ?>");
			<?php if ($gaji_smp_add->total_gapok->Required) { ?>
				elm = this.getElements("x" + infix + "_total_gapok");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_smp_add->total_gapok->caption(), $gaji_smp_add->total_gapok->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_total_gapok");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_smp_add->total_gapok->errorMessage()) ?>");
			<?php if ($gaji_smp_add->piket_count->Required) { ?>
				elm = this.getElements("x" + infix + "_piket_count");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_smp_add->piket_count->caption(), $gaji_smp_add->piket_count->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_piket_count");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_smp_add->piket_count->errorMessage()) ?>");
			<?php if ($gaji_smp_add->penyesuaian->Required) { ?>
				elm = this.getElements("x" + infix + "_penyesuaian");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_smp_add->penyesuaian->caption(), $gaji_smp_add->penyesuaian->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_penyesuaian");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_smp_add->penyesuaian->errorMessage()) ?>");

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
	fgaji_smpadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fgaji_smpadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fgaji_smpadd.lists["x_pegawai"] = <?php echo $gaji_smp_add->pegawai->Lookup->toClientList($gaji_smp_add) ?>;
	fgaji_smpadd.lists["x_pegawai"].options = <?php echo JsonEncode($gaji_smp_add->pegawai->lookupOptions()) ?>;
	fgaji_smpadd.lists["x_jenjang_id"] = <?php echo $gaji_smp_add->jenjang_id->Lookup->toClientList($gaji_smp_add) ?>;
	fgaji_smpadd.lists["x_jenjang_id"].options = <?php echo JsonEncode($gaji_smp_add->jenjang_id->lookupOptions()) ?>;
	fgaji_smpadd.autoSuggests["x_jenjang_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fgaji_smpadd.lists["x_jabatan_id"] = <?php echo $gaji_smp_add->jabatan_id->Lookup->toClientList($gaji_smp_add) ?>;
	fgaji_smpadd.lists["x_jabatan_id"].options = <?php echo JsonEncode($gaji_smp_add->jabatan_id->lookupOptions()) ?>;
	fgaji_smpadd.autoSuggests["x_jabatan_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fgaji_smpadd.lists["x_type"] = <?php echo $gaji_smp_add->type->Lookup->toClientList($gaji_smp_add) ?>;
	fgaji_smpadd.lists["x_type"].options = <?php echo JsonEncode($gaji_smp_add->type->lookupOptions()) ?>;
	fgaji_smpadd.autoSuggests["x_type"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fgaji_smpadd.lists["x_jenis_guru"] = <?php echo $gaji_smp_add->jenis_guru->Lookup->toClientList($gaji_smp_add) ?>;
	fgaji_smpadd.lists["x_jenis_guru"].options = <?php echo JsonEncode($gaji_smp_add->jenis_guru->lookupOptions()) ?>;
	fgaji_smpadd.autoSuggests["x_jenis_guru"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fgaji_smpadd.lists["x_tambahan"] = <?php echo $gaji_smp_add->tambahan->Lookup->toClientList($gaji_smp_add) ?>;
	fgaji_smpadd.lists["x_tambahan"].options = <?php echo JsonEncode($gaji_smp_add->tambahan->lookupOptions()) ?>;
	fgaji_smpadd.autoSuggests["x_tambahan"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fgaji_smpadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $gaji_smp_add->showPageHeader(); ?>
<?php
$gaji_smp_add->showMessage();
?>
<form name="fgaji_smpadd" id="fgaji_smpadd" class="<?php echo $gaji_smp_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gaji_smp">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$gaji_smp_add->IsModal ?>">
<?php if ($gaji_smp->getCurrentMasterTable() == "m_smp") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="m_smp">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($gaji_smp_add->pid->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($gaji_smp_add->pegawai->Visible) { // pegawai ?>
	<div id="r_pegawai" class="form-group row">
		<label id="elh_gaji_smp_pegawai" for="x_pegawai" class="<?php echo $gaji_smp_add->LeftColumnClass ?>"><?php echo $gaji_smp_add->pegawai->caption() ?><?php echo $gaji_smp_add->pegawai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_smp_add->RightColumnClass ?>"><div <?php echo $gaji_smp_add->pegawai->cellAttributes() ?>>
<span id="el_gaji_smp_pegawai">
<?php $gaji_smp_add->pegawai->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_pegawai"><?php echo EmptyValue(strval($gaji_smp_add->pegawai->ViewValue)) ? $Language->phrase("PleaseSelect") : $gaji_smp_add->pegawai->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($gaji_smp_add->pegawai->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($gaji_smp_add->pegawai->ReadOnly || $gaji_smp_add->pegawai->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_pegawai',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $gaji_smp_add->pegawai->Lookup->getParamTag($gaji_smp_add, "p_x_pegawai") ?>
<input type="hidden" data-table="gaji_smp" data-field="x_pegawai" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $gaji_smp_add->pegawai->displayValueSeparatorAttribute() ?>" name="x_pegawai" id="x_pegawai" value="<?php echo $gaji_smp_add->pegawai->CurrentValue ?>"<?php echo $gaji_smp_add->pegawai->editAttributes() ?>>
</span>
<?php echo $gaji_smp_add->pegawai->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_smp_add->jenjang_id->Visible) { // jenjang_id ?>
	<div id="r_jenjang_id" class="form-group row">
		<label id="elh_gaji_smp_jenjang_id" class="<?php echo $gaji_smp_add->LeftColumnClass ?>"><?php echo $gaji_smp_add->jenjang_id->caption() ?><?php echo $gaji_smp_add->jenjang_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_smp_add->RightColumnClass ?>"><div <?php echo $gaji_smp_add->jenjang_id->cellAttributes() ?>>
<span id="el_gaji_smp_jenjang_id">
<?php
$onchange = $gaji_smp_add->jenjang_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$gaji_smp_add->jenjang_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_jenjang_id">
	<input type="text" class="form-control" name="sv_x_jenjang_id" id="sv_x_jenjang_id" value="<?php echo RemoveHtml($gaji_smp_add->jenjang_id->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($gaji_smp_add->jenjang_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($gaji_smp_add->jenjang_id->getPlaceHolder()) ?>"<?php echo $gaji_smp_add->jenjang_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_smp" data-field="x_jenjang_id" data-value-separator="<?php echo $gaji_smp_add->jenjang_id->displayValueSeparatorAttribute() ?>" name="x_jenjang_id" id="x_jenjang_id" value="<?php echo HtmlEncode($gaji_smp_add->jenjang_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fgaji_smpadd"], function() {
	fgaji_smpadd.createAutoSuggest({"id":"x_jenjang_id","forceSelect":false});
});
</script>
<?php echo $gaji_smp_add->jenjang_id->Lookup->getParamTag($gaji_smp_add, "p_x_jenjang_id") ?>
</span>
<?php echo $gaji_smp_add->jenjang_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_smp_add->jabatan_id->Visible) { // jabatan_id ?>
	<div id="r_jabatan_id" class="form-group row">
		<label id="elh_gaji_smp_jabatan_id" class="<?php echo $gaji_smp_add->LeftColumnClass ?>"><?php echo $gaji_smp_add->jabatan_id->caption() ?><?php echo $gaji_smp_add->jabatan_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_smp_add->RightColumnClass ?>"><div <?php echo $gaji_smp_add->jabatan_id->cellAttributes() ?>>
<span id="el_gaji_smp_jabatan_id">
<?php
$onchange = $gaji_smp_add->jabatan_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$gaji_smp_add->jabatan_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_jabatan_id">
	<input type="text" class="form-control" name="sv_x_jabatan_id" id="sv_x_jabatan_id" value="<?php echo RemoveHtml($gaji_smp_add->jabatan_id->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($gaji_smp_add->jabatan_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($gaji_smp_add->jabatan_id->getPlaceHolder()) ?>"<?php echo $gaji_smp_add->jabatan_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_smp" data-field="x_jabatan_id" data-value-separator="<?php echo $gaji_smp_add->jabatan_id->displayValueSeparatorAttribute() ?>" name="x_jabatan_id" id="x_jabatan_id" value="<?php echo HtmlEncode($gaji_smp_add->jabatan_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fgaji_smpadd"], function() {
	fgaji_smpadd.createAutoSuggest({"id":"x_jabatan_id","forceSelect":false});
});
</script>
<?php echo $gaji_smp_add->jabatan_id->Lookup->getParamTag($gaji_smp_add, "p_x_jabatan_id") ?>
</span>
<?php echo $gaji_smp_add->jabatan_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_smp_add->lama_kerja->Visible) { // lama_kerja ?>
	<div id="r_lama_kerja" class="form-group row">
		<label id="elh_gaji_smp_lama_kerja" for="x_lama_kerja" class="<?php echo $gaji_smp_add->LeftColumnClass ?>"><?php echo $gaji_smp_add->lama_kerja->caption() ?><?php echo $gaji_smp_add->lama_kerja->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_smp_add->RightColumnClass ?>"><div <?php echo $gaji_smp_add->lama_kerja->cellAttributes() ?>>
<span id="el_gaji_smp_lama_kerja">
<input type="text" data-table="gaji_smp" data-field="x_lama_kerja" name="x_lama_kerja" id="x_lama_kerja" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gaji_smp_add->lama_kerja->getPlaceHolder()) ?>" value="<?php echo $gaji_smp_add->lama_kerja->EditValue ?>"<?php echo $gaji_smp_add->lama_kerja->editAttributes() ?>>
</span>
<?php echo $gaji_smp_add->lama_kerja->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_smp_add->type->Visible) { // type ?>
	<div id="r_type" class="form-group row">
		<label id="elh_gaji_smp_type" class="<?php echo $gaji_smp_add->LeftColumnClass ?>"><?php echo $gaji_smp_add->type->caption() ?><?php echo $gaji_smp_add->type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_smp_add->RightColumnClass ?>"><div <?php echo $gaji_smp_add->type->cellAttributes() ?>>
<span id="el_gaji_smp_type">
<?php
$onchange = $gaji_smp_add->type->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$gaji_smp_add->type->EditAttrs["onchange"] = "";
?>
<span id="as_x_type">
	<input type="text" class="form-control" name="sv_x_type" id="sv_x_type" value="<?php echo RemoveHtml($gaji_smp_add->type->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gaji_smp_add->type->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($gaji_smp_add->type->getPlaceHolder()) ?>"<?php echo $gaji_smp_add->type->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_smp" data-field="x_type" data-value-separator="<?php echo $gaji_smp_add->type->displayValueSeparatorAttribute() ?>" name="x_type" id="x_type" value="<?php echo HtmlEncode($gaji_smp_add->type->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fgaji_smpadd"], function() {
	fgaji_smpadd.createAutoSuggest({"id":"x_type","forceSelect":false});
});
</script>
<?php echo $gaji_smp_add->type->Lookup->getParamTag($gaji_smp_add, "p_x_type") ?>
</span>
<?php echo $gaji_smp_add->type->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_smp_add->jenis_guru->Visible) { // jenis_guru ?>
	<div id="r_jenis_guru" class="form-group row">
		<label id="elh_gaji_smp_jenis_guru" class="<?php echo $gaji_smp_add->LeftColumnClass ?>"><?php echo $gaji_smp_add->jenis_guru->caption() ?><?php echo $gaji_smp_add->jenis_guru->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_smp_add->RightColumnClass ?>"><div <?php echo $gaji_smp_add->jenis_guru->cellAttributes() ?>>
<span id="el_gaji_smp_jenis_guru">
<?php
$onchange = $gaji_smp_add->jenis_guru->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$gaji_smp_add->jenis_guru->EditAttrs["onchange"] = "";
?>
<span id="as_x_jenis_guru">
	<input type="text" class="form-control" name="sv_x_jenis_guru" id="sv_x_jenis_guru" value="<?php echo RemoveHtml($gaji_smp_add->jenis_guru->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gaji_smp_add->jenis_guru->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($gaji_smp_add->jenis_guru->getPlaceHolder()) ?>"<?php echo $gaji_smp_add->jenis_guru->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_smp" data-field="x_jenis_guru" data-value-separator="<?php echo $gaji_smp_add->jenis_guru->displayValueSeparatorAttribute() ?>" name="x_jenis_guru" id="x_jenis_guru" value="<?php echo HtmlEncode($gaji_smp_add->jenis_guru->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fgaji_smpadd"], function() {
	fgaji_smpadd.createAutoSuggest({"id":"x_jenis_guru","forceSelect":false});
});
</script>
<?php echo $gaji_smp_add->jenis_guru->Lookup->getParamTag($gaji_smp_add, "p_x_jenis_guru") ?>
</span>
<?php echo $gaji_smp_add->jenis_guru->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_smp_add->tambahan->Visible) { // tambahan ?>
	<div id="r_tambahan" class="form-group row">
		<label id="elh_gaji_smp_tambahan" class="<?php echo $gaji_smp_add->LeftColumnClass ?>"><?php echo $gaji_smp_add->tambahan->caption() ?><?php echo $gaji_smp_add->tambahan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_smp_add->RightColumnClass ?>"><div <?php echo $gaji_smp_add->tambahan->cellAttributes() ?>>
<span id="el_gaji_smp_tambahan">
<?php
$onchange = $gaji_smp_add->tambahan->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$gaji_smp_add->tambahan->EditAttrs["onchange"] = "";
?>
<span id="as_x_tambahan">
	<input type="text" class="form-control" name="sv_x_tambahan" id="sv_x_tambahan" value="<?php echo RemoveHtml($gaji_smp_add->tambahan->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gaji_smp_add->tambahan->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($gaji_smp_add->tambahan->getPlaceHolder()) ?>"<?php echo $gaji_smp_add->tambahan->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_smp" data-field="x_tambahan" data-value-separator="<?php echo $gaji_smp_add->tambahan->displayValueSeparatorAttribute() ?>" name="x_tambahan" id="x_tambahan" value="<?php echo HtmlEncode($gaji_smp_add->tambahan->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fgaji_smpadd"], function() {
	fgaji_smpadd.createAutoSuggest({"id":"x_tambahan","forceSelect":false});
});
</script>
<?php echo $gaji_smp_add->tambahan->Lookup->getParamTag($gaji_smp_add, "p_x_tambahan") ?>
</span>
<?php echo $gaji_smp_add->tambahan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_smp_add->periode->Visible) { // periode ?>
	<div id="r_periode" class="form-group row">
		<label id="elh_gaji_smp_periode" for="x_periode" class="<?php echo $gaji_smp_add->LeftColumnClass ?>"><?php echo $gaji_smp_add->periode->caption() ?><?php echo $gaji_smp_add->periode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_smp_add->RightColumnClass ?>"><div <?php echo $gaji_smp_add->periode->cellAttributes() ?>>
<span id="el_gaji_smp_periode">
<input type="text" data-table="gaji_smp" data-field="x_periode" name="x_periode" id="x_periode" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gaji_smp_add->periode->getPlaceHolder()) ?>" value="<?php echo $gaji_smp_add->periode->EditValue ?>"<?php echo $gaji_smp_add->periode->editAttributes() ?>>
</span>
<?php echo $gaji_smp_add->periode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_smp_add->tunjangan_periode->Visible) { // tunjangan_periode ?>
	<div id="r_tunjangan_periode" class="form-group row">
		<label id="elh_gaji_smp_tunjangan_periode" for="x_tunjangan_periode" class="<?php echo $gaji_smp_add->LeftColumnClass ?>"><?php echo $gaji_smp_add->tunjangan_periode->caption() ?><?php echo $gaji_smp_add->tunjangan_periode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_smp_add->RightColumnClass ?>"><div <?php echo $gaji_smp_add->tunjangan_periode->cellAttributes() ?>>
<span id="el_gaji_smp_tunjangan_periode">
<input type="text" data-table="gaji_smp" data-field="x_tunjangan_periode" name="x_tunjangan_periode" id="x_tunjangan_periode" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gaji_smp_add->tunjangan_periode->getPlaceHolder()) ?>" value="<?php echo $gaji_smp_add->tunjangan_periode->EditValue ?>"<?php echo $gaji_smp_add->tunjangan_periode->editAttributes() ?>>
</span>
<?php echo $gaji_smp_add->tunjangan_periode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_smp_add->kehadiran->Visible) { // kehadiran ?>
	<div id="r_kehadiran" class="form-group row">
		<label id="elh_gaji_smp_kehadiran" for="x_kehadiran" class="<?php echo $gaji_smp_add->LeftColumnClass ?>"><?php echo $gaji_smp_add->kehadiran->caption() ?><?php echo $gaji_smp_add->kehadiran->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_smp_add->RightColumnClass ?>"><div <?php echo $gaji_smp_add->kehadiran->cellAttributes() ?>>
<span id="el_gaji_smp_kehadiran">
<input type="text" data-table="gaji_smp" data-field="x_kehadiran" name="x_kehadiran" id="x_kehadiran" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($gaji_smp_add->kehadiran->getPlaceHolder()) ?>" value="<?php echo $gaji_smp_add->kehadiran->EditValue ?>"<?php echo $gaji_smp_add->kehadiran->editAttributes() ?>>
</span>
<?php echo $gaji_smp_add->kehadiran->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_smp_add->value_kehadiran->Visible) { // value_kehadiran ?>
	<div id="r_value_kehadiran" class="form-group row">
		<label id="elh_gaji_smp_value_kehadiran" for="x_value_kehadiran" class="<?php echo $gaji_smp_add->LeftColumnClass ?>"><?php echo $gaji_smp_add->value_kehadiran->caption() ?><?php echo $gaji_smp_add->value_kehadiran->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_smp_add->RightColumnClass ?>"><div <?php echo $gaji_smp_add->value_kehadiran->cellAttributes() ?>>
<span id="el_gaji_smp_value_kehadiran">
<input type="text" data-table="gaji_smp" data-field="x_value_kehadiran" name="x_value_kehadiran" id="x_value_kehadiran" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gaji_smp_add->value_kehadiran->getPlaceHolder()) ?>" value="<?php echo $gaji_smp_add->value_kehadiran->EditValue ?>"<?php echo $gaji_smp_add->value_kehadiran->editAttributes() ?>>
</span>
<?php echo $gaji_smp_add->value_kehadiran->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_smp_add->lembur->Visible) { // lembur ?>
	<div id="r_lembur" class="form-group row">
		<label id="elh_gaji_smp_lembur" for="x_lembur" class="<?php echo $gaji_smp_add->LeftColumnClass ?>"><?php echo $gaji_smp_add->lembur->caption() ?><?php echo $gaji_smp_add->lembur->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_smp_add->RightColumnClass ?>"><div <?php echo $gaji_smp_add->lembur->cellAttributes() ?>>
<span id="el_gaji_smp_lembur">
<input type="text" data-table="gaji_smp" data-field="x_lembur" name="x_lembur" id="x_lembur" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($gaji_smp_add->lembur->getPlaceHolder()) ?>" value="<?php echo $gaji_smp_add->lembur->EditValue ?>"<?php echo $gaji_smp_add->lembur->editAttributes() ?>>
</span>
<?php echo $gaji_smp_add->lembur->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_smp_add->jp->Visible) { // jp ?>
	<div id="r_jp" class="form-group row">
		<label id="elh_gaji_smp_jp" for="x_jp" class="<?php echo $gaji_smp_add->LeftColumnClass ?>"><?php echo $gaji_smp_add->jp->caption() ?><?php echo $gaji_smp_add->jp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_smp_add->RightColumnClass ?>"><div <?php echo $gaji_smp_add->jp->cellAttributes() ?>>
<span id="el_gaji_smp_jp">
<input type="text" data-table="gaji_smp" data-field="x_jp" name="x_jp" id="x_jp" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gaji_smp_add->jp->getPlaceHolder()) ?>" value="<?php echo $gaji_smp_add->jp->EditValue ?>"<?php echo $gaji_smp_add->jp->editAttributes() ?>>
</span>
<?php echo $gaji_smp_add->jp->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_smp_add->total_gapok->Visible) { // total_gapok ?>
	<div id="r_total_gapok" class="form-group row">
		<label id="elh_gaji_smp_total_gapok" for="x_total_gapok" class="<?php echo $gaji_smp_add->LeftColumnClass ?>"><?php echo $gaji_smp_add->total_gapok->caption() ?><?php echo $gaji_smp_add->total_gapok->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_smp_add->RightColumnClass ?>"><div <?php echo $gaji_smp_add->total_gapok->cellAttributes() ?>>
<span id="el_gaji_smp_total_gapok">
<input type="text" data-table="gaji_smp" data-field="x_total_gapok" name="x_total_gapok" id="x_total_gapok" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gaji_smp_add->total_gapok->getPlaceHolder()) ?>" value="<?php echo $gaji_smp_add->total_gapok->EditValue ?>"<?php echo $gaji_smp_add->total_gapok->editAttributes() ?>>
</span>
<?php echo $gaji_smp_add->total_gapok->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_smp_add->piket_count->Visible) { // piket_count ?>
	<div id="r_piket_count" class="form-group row">
		<label id="elh_gaji_smp_piket_count" for="x_piket_count" class="<?php echo $gaji_smp_add->LeftColumnClass ?>"><?php echo $gaji_smp_add->piket_count->caption() ?><?php echo $gaji_smp_add->piket_count->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_smp_add->RightColumnClass ?>"><div <?php echo $gaji_smp_add->piket_count->cellAttributes() ?>>
<span id="el_gaji_smp_piket_count">
<input type="text" data-table="gaji_smp" data-field="x_piket_count" name="x_piket_count" id="x_piket_count" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($gaji_smp_add->piket_count->getPlaceHolder()) ?>" value="<?php echo $gaji_smp_add->piket_count->EditValue ?>"<?php echo $gaji_smp_add->piket_count->editAttributes() ?>>
</span>
<?php echo $gaji_smp_add->piket_count->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_smp_add->penyesuaian->Visible) { // penyesuaian ?>
	<div id="r_penyesuaian" class="form-group row">
		<label id="elh_gaji_smp_penyesuaian" for="x_penyesuaian" class="<?php echo $gaji_smp_add->LeftColumnClass ?>"><?php echo $gaji_smp_add->penyesuaian->caption() ?><?php echo $gaji_smp_add->penyesuaian->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_smp_add->RightColumnClass ?>"><div <?php echo $gaji_smp_add->penyesuaian->cellAttributes() ?>>
<span id="el_gaji_smp_penyesuaian">
<input type="text" data-table="gaji_smp" data-field="x_penyesuaian" name="x_penyesuaian" id="x_penyesuaian" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_smp_add->penyesuaian->getPlaceHolder()) ?>" value="<?php echo $gaji_smp_add->penyesuaian->EditValue ?>"<?php echo $gaji_smp_add->penyesuaian->editAttributes() ?>>
</span>
<?php echo $gaji_smp_add->penyesuaian->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<?php if (strval($gaji_smp_add->pid->getSessionValue()) != "") { ?>
	<input type="hidden" name="x_pid" id="x_pid" value="<?php echo HtmlEncode(strval($gaji_smp_add->pid->getSessionValue())) ?>">
	<?php } ?>
<?php if (!$gaji_smp_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $gaji_smp_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $gaji_smp_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$gaji_smp_add->showPageFooter();
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
$gaji_smp_add->terminate();
?>