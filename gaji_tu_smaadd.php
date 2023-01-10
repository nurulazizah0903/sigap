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
$gaji_tu_sma_add = new gaji_tu_sma_add();

// Run the page
$gaji_tu_sma_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gaji_tu_sma_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fgaji_tu_smaadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fgaji_tu_smaadd = currentForm = new ew.Form("fgaji_tu_smaadd", "add");

	// Validate form
	fgaji_tu_smaadd.validate = function() {
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
			<?php if ($gaji_tu_sma_add->pegawai->Required) { ?>
				elm = this.getElements("x" + infix + "_pegawai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_tu_sma_add->pegawai->caption(), $gaji_tu_sma_add->pegawai->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($gaji_tu_sma_add->jenjang_id->Required) { ?>
				elm = this.getElements("x" + infix + "_jenjang_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_tu_sma_add->jenjang_id->caption(), $gaji_tu_sma_add->jenjang_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jenjang_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_tu_sma_add->jenjang_id->errorMessage()) ?>");
			<?php if ($gaji_tu_sma_add->jabatan_id->Required) { ?>
				elm = this.getElements("x" + infix + "_jabatan_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_tu_sma_add->jabatan_id->caption(), $gaji_tu_sma_add->jabatan_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jabatan_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_tu_sma_add->jabatan_id->errorMessage()) ?>");
			<?php if ($gaji_tu_sma_add->type_jabatan->Required) { ?>
				elm = this.getElements("x" + infix + "_type_jabatan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_tu_sma_add->type_jabatan->caption(), $gaji_tu_sma_add->type_jabatan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_type_jabatan");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_tu_sma_add->type_jabatan->errorMessage()) ?>");
			<?php if ($gaji_tu_sma_add->tambahan->Required) { ?>
				elm = this.getElements("x" + infix + "_tambahan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_tu_sma_add->tambahan->caption(), $gaji_tu_sma_add->tambahan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tambahan");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_tu_sma_add->tambahan->errorMessage()) ?>");
			<?php if ($gaji_tu_sma_add->ijasah->Required) { ?>
				elm = this.getElements("x" + infix + "_ijasah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_tu_sma_add->ijasah->caption(), $gaji_tu_sma_add->ijasah->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ijasah");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_tu_sma_add->ijasah->errorMessage()) ?>");
			<?php if ($gaji_tu_sma_add->gapok->Required) { ?>
				elm = this.getElements("x" + infix + "_gapok");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_tu_sma_add->gapok->caption(), $gaji_tu_sma_add->gapok->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_gapok");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_tu_sma_add->gapok->errorMessage()) ?>");
			<?php if ($gaji_tu_sma_add->kehadiran->Required) { ?>
				elm = this.getElements("x" + infix + "_kehadiran");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_tu_sma_add->kehadiran->caption(), $gaji_tu_sma_add->kehadiran->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_kehadiran");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_tu_sma_add->kehadiran->errorMessage()) ?>");
			<?php if ($gaji_tu_sma_add->lembur->Required) { ?>
				elm = this.getElements("x" + infix + "_lembur");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_tu_sma_add->lembur->caption(), $gaji_tu_sma_add->lembur->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_lembur");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_tu_sma_add->lembur->errorMessage()) ?>");
			<?php if ($gaji_tu_sma_add->value_lembur->Required) { ?>
				elm = this.getElements("x" + infix + "_value_lembur");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_tu_sma_add->value_lembur->caption(), $gaji_tu_sma_add->value_lembur->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_value_lembur");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_tu_sma_add->value_lembur->errorMessage()) ?>");
			<?php if ($gaji_tu_sma_add->value_reward->Required) { ?>
				elm = this.getElements("x" + infix + "_value_reward");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_tu_sma_add->value_reward->caption(), $gaji_tu_sma_add->value_reward->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_value_reward");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_tu_sma_add->value_reward->errorMessage()) ?>");
			<?php if ($gaji_tu_sma_add->value_inval->Required) { ?>
				elm = this.getElements("x" + infix + "_value_inval");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_tu_sma_add->value_inval->caption(), $gaji_tu_sma_add->value_inval->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_value_inval");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_tu_sma_add->value_inval->errorMessage()) ?>");
			<?php if ($gaji_tu_sma_add->piket_count->Required) { ?>
				elm = this.getElements("x" + infix + "_piket_count");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_tu_sma_add->piket_count->caption(), $gaji_tu_sma_add->piket_count->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_piket_count");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_tu_sma_add->piket_count->errorMessage()) ?>");
			<?php if ($gaji_tu_sma_add->value_piket->Required) { ?>
				elm = this.getElements("x" + infix + "_value_piket");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_tu_sma_add->value_piket->caption(), $gaji_tu_sma_add->value_piket->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_value_piket");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_tu_sma_add->value_piket->errorMessage()) ?>");
			<?php if ($gaji_tu_sma_add->tugastambahan->Required) { ?>
				elm = this.getElements("x" + infix + "_tugastambahan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_tu_sma_add->tugastambahan->caption(), $gaji_tu_sma_add->tugastambahan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tugastambahan");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_tu_sma_add->tugastambahan->errorMessage()) ?>");
			<?php if ($gaji_tu_sma_add->tj_jabatan->Required) { ?>
				elm = this.getElements("x" + infix + "_tj_jabatan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_tu_sma_add->tj_jabatan->caption(), $gaji_tu_sma_add->tj_jabatan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tj_jabatan");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_tu_sma_add->tj_jabatan->errorMessage()) ?>");
			<?php if ($gaji_tu_sma_add->tunjangan2->Required) { ?>
				elm = this.getElements("x" + infix + "_tunjangan2");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_tu_sma_add->tunjangan2->caption(), $gaji_tu_sma_add->tunjangan2->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tunjangan2");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_tu_sma_add->tunjangan2->errorMessage()) ?>");
			<?php if ($gaji_tu_sma_add->potongan->Required) { ?>
				elm = this.getElements("x" + infix + "_potongan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_tu_sma_add->potongan->caption(), $gaji_tu_sma_add->potongan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_potongan");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_tu_sma_add->potongan->errorMessage()) ?>");
			<?php if ($gaji_tu_sma_add->sub_total->Required) { ?>
				elm = this.getElements("x" + infix + "_sub_total");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_tu_sma_add->sub_total->caption(), $gaji_tu_sma_add->sub_total->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_sub_total");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_tu_sma_add->sub_total->errorMessage()) ?>");
			<?php if ($gaji_tu_sma_add->penyesuaian->Required) { ?>
				elm = this.getElements("x" + infix + "_penyesuaian");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_tu_sma_add->penyesuaian->caption(), $gaji_tu_sma_add->penyesuaian->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_penyesuaian");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_tu_sma_add->penyesuaian->errorMessage()) ?>");
			<?php if ($gaji_tu_sma_add->total->Required) { ?>
				elm = this.getElements("x" + infix + "_total");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_tu_sma_add->total->caption(), $gaji_tu_sma_add->total->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_total");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_tu_sma_add->total->errorMessage()) ?>");

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
	fgaji_tu_smaadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fgaji_tu_smaadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fgaji_tu_smaadd.lists["x_jenjang_id"] = <?php echo $gaji_tu_sma_add->jenjang_id->Lookup->toClientList($gaji_tu_sma_add) ?>;
	fgaji_tu_smaadd.lists["x_jenjang_id"].options = <?php echo JsonEncode($gaji_tu_sma_add->jenjang_id->lookupOptions()) ?>;
	fgaji_tu_smaadd.autoSuggests["x_jenjang_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fgaji_tu_smaadd.lists["x_jabatan_id"] = <?php echo $gaji_tu_sma_add->jabatan_id->Lookup->toClientList($gaji_tu_sma_add) ?>;
	fgaji_tu_smaadd.lists["x_jabatan_id"].options = <?php echo JsonEncode($gaji_tu_sma_add->jabatan_id->lookupOptions()) ?>;
	fgaji_tu_smaadd.autoSuggests["x_jabatan_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fgaji_tu_smaadd.lists["x_type_jabatan"] = <?php echo $gaji_tu_sma_add->type_jabatan->Lookup->toClientList($gaji_tu_sma_add) ?>;
	fgaji_tu_smaadd.lists["x_type_jabatan"].options = <?php echo JsonEncode($gaji_tu_sma_add->type_jabatan->lookupOptions()) ?>;
	fgaji_tu_smaadd.autoSuggests["x_type_jabatan"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fgaji_tu_smaadd.lists["x_tambahan"] = <?php echo $gaji_tu_sma_add->tambahan->Lookup->toClientList($gaji_tu_sma_add) ?>;
	fgaji_tu_smaadd.lists["x_tambahan"].options = <?php echo JsonEncode($gaji_tu_sma_add->tambahan->lookupOptions()) ?>;
	fgaji_tu_smaadd.autoSuggests["x_tambahan"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fgaji_tu_smaadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $gaji_tu_sma_add->showPageHeader(); ?>
<?php
$gaji_tu_sma_add->showMessage();
?>
<form name="fgaji_tu_smaadd" id="fgaji_tu_smaadd" class="<?php echo $gaji_tu_sma_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gaji_tu_sma">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$gaji_tu_sma_add->IsModal ?>">
<?php if ($gaji_tu_sma->getCurrentMasterTable() == "m_tu_sma") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="m_tu_sma">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($gaji_tu_sma_add->pid->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($gaji_tu_sma_add->pegawai->Visible) { // pegawai ?>
	<div id="r_pegawai" class="form-group row">
		<label id="elh_gaji_tu_sma_pegawai" for="x_pegawai" class="<?php echo $gaji_tu_sma_add->LeftColumnClass ?>"><?php echo $gaji_tu_sma_add->pegawai->caption() ?><?php echo $gaji_tu_sma_add->pegawai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_tu_sma_add->RightColumnClass ?>"><div <?php echo $gaji_tu_sma_add->pegawai->cellAttributes() ?>>
<span id="el_gaji_tu_sma_pegawai">
<input type="text" data-table="gaji_tu_sma" data-field="x_pegawai" name="x_pegawai" id="x_pegawai" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($gaji_tu_sma_add->pegawai->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sma_add->pegawai->EditValue ?>"<?php echo $gaji_tu_sma_add->pegawai->editAttributes() ?>>
</span>
<?php echo $gaji_tu_sma_add->pegawai->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_tu_sma_add->jenjang_id->Visible) { // jenjang_id ?>
	<div id="r_jenjang_id" class="form-group row">
		<label id="elh_gaji_tu_sma_jenjang_id" class="<?php echo $gaji_tu_sma_add->LeftColumnClass ?>"><?php echo $gaji_tu_sma_add->jenjang_id->caption() ?><?php echo $gaji_tu_sma_add->jenjang_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_tu_sma_add->RightColumnClass ?>"><div <?php echo $gaji_tu_sma_add->jenjang_id->cellAttributes() ?>>
<span id="el_gaji_tu_sma_jenjang_id">
<?php
$onchange = $gaji_tu_sma_add->jenjang_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$gaji_tu_sma_add->jenjang_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_jenjang_id">
	<input type="text" class="form-control" name="sv_x_jenjang_id" id="sv_x_jenjang_id" value="<?php echo RemoveHtml($gaji_tu_sma_add->jenjang_id->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($gaji_tu_sma_add->jenjang_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($gaji_tu_sma_add->jenjang_id->getPlaceHolder()) ?>"<?php echo $gaji_tu_sma_add->jenjang_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_tu_sma" data-field="x_jenjang_id" data-value-separator="<?php echo $gaji_tu_sma_add->jenjang_id->displayValueSeparatorAttribute() ?>" name="x_jenjang_id" id="x_jenjang_id" value="<?php echo HtmlEncode($gaji_tu_sma_add->jenjang_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fgaji_tu_smaadd"], function() {
	fgaji_tu_smaadd.createAutoSuggest({"id":"x_jenjang_id","forceSelect":false});
});
</script>
<?php echo $gaji_tu_sma_add->jenjang_id->Lookup->getParamTag($gaji_tu_sma_add, "p_x_jenjang_id") ?>
</span>
<?php echo $gaji_tu_sma_add->jenjang_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_tu_sma_add->jabatan_id->Visible) { // jabatan_id ?>
	<div id="r_jabatan_id" class="form-group row">
		<label id="elh_gaji_tu_sma_jabatan_id" class="<?php echo $gaji_tu_sma_add->LeftColumnClass ?>"><?php echo $gaji_tu_sma_add->jabatan_id->caption() ?><?php echo $gaji_tu_sma_add->jabatan_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_tu_sma_add->RightColumnClass ?>"><div <?php echo $gaji_tu_sma_add->jabatan_id->cellAttributes() ?>>
<span id="el_gaji_tu_sma_jabatan_id">
<?php
$onchange = $gaji_tu_sma_add->jabatan_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$gaji_tu_sma_add->jabatan_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_jabatan_id">
	<input type="text" class="form-control" name="sv_x_jabatan_id" id="sv_x_jabatan_id" value="<?php echo RemoveHtml($gaji_tu_sma_add->jabatan_id->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($gaji_tu_sma_add->jabatan_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($gaji_tu_sma_add->jabatan_id->getPlaceHolder()) ?>"<?php echo $gaji_tu_sma_add->jabatan_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_tu_sma" data-field="x_jabatan_id" data-value-separator="<?php echo $gaji_tu_sma_add->jabatan_id->displayValueSeparatorAttribute() ?>" name="x_jabatan_id" id="x_jabatan_id" value="<?php echo HtmlEncode($gaji_tu_sma_add->jabatan_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fgaji_tu_smaadd"], function() {
	fgaji_tu_smaadd.createAutoSuggest({"id":"x_jabatan_id","forceSelect":false});
});
</script>
<?php echo $gaji_tu_sma_add->jabatan_id->Lookup->getParamTag($gaji_tu_sma_add, "p_x_jabatan_id") ?>
</span>
<?php echo $gaji_tu_sma_add->jabatan_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_tu_sma_add->type_jabatan->Visible) { // type_jabatan ?>
	<div id="r_type_jabatan" class="form-group row">
		<label id="elh_gaji_tu_sma_type_jabatan" class="<?php echo $gaji_tu_sma_add->LeftColumnClass ?>"><?php echo $gaji_tu_sma_add->type_jabatan->caption() ?><?php echo $gaji_tu_sma_add->type_jabatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_tu_sma_add->RightColumnClass ?>"><div <?php echo $gaji_tu_sma_add->type_jabatan->cellAttributes() ?>>
<span id="el_gaji_tu_sma_type_jabatan">
<?php
$onchange = $gaji_tu_sma_add->type_jabatan->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$gaji_tu_sma_add->type_jabatan->EditAttrs["onchange"] = "";
?>
<span id="as_x_type_jabatan">
	<input type="text" class="form-control" name="sv_x_type_jabatan" id="sv_x_type_jabatan" value="<?php echo RemoveHtml($gaji_tu_sma_add->type_jabatan->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gaji_tu_sma_add->type_jabatan->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($gaji_tu_sma_add->type_jabatan->getPlaceHolder()) ?>"<?php echo $gaji_tu_sma_add->type_jabatan->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_tu_sma" data-field="x_type_jabatan" data-value-separator="<?php echo $gaji_tu_sma_add->type_jabatan->displayValueSeparatorAttribute() ?>" name="x_type_jabatan" id="x_type_jabatan" value="<?php echo HtmlEncode($gaji_tu_sma_add->type_jabatan->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fgaji_tu_smaadd"], function() {
	fgaji_tu_smaadd.createAutoSuggest({"id":"x_type_jabatan","forceSelect":false});
});
</script>
<?php echo $gaji_tu_sma_add->type_jabatan->Lookup->getParamTag($gaji_tu_sma_add, "p_x_type_jabatan") ?>
</span>
<?php echo $gaji_tu_sma_add->type_jabatan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_tu_sma_add->tambahan->Visible) { // tambahan ?>
	<div id="r_tambahan" class="form-group row">
		<label id="elh_gaji_tu_sma_tambahan" class="<?php echo $gaji_tu_sma_add->LeftColumnClass ?>"><?php echo $gaji_tu_sma_add->tambahan->caption() ?><?php echo $gaji_tu_sma_add->tambahan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_tu_sma_add->RightColumnClass ?>"><div <?php echo $gaji_tu_sma_add->tambahan->cellAttributes() ?>>
<span id="el_gaji_tu_sma_tambahan">
<?php
$onchange = $gaji_tu_sma_add->tambahan->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$gaji_tu_sma_add->tambahan->EditAttrs["onchange"] = "";
?>
<span id="as_x_tambahan">
	<input type="text" class="form-control" name="sv_x_tambahan" id="sv_x_tambahan" value="<?php echo RemoveHtml($gaji_tu_sma_add->tambahan->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gaji_tu_sma_add->tambahan->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($gaji_tu_sma_add->tambahan->getPlaceHolder()) ?>"<?php echo $gaji_tu_sma_add->tambahan->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_tu_sma" data-field="x_tambahan" data-value-separator="<?php echo $gaji_tu_sma_add->tambahan->displayValueSeparatorAttribute() ?>" name="x_tambahan" id="x_tambahan" value="<?php echo HtmlEncode($gaji_tu_sma_add->tambahan->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fgaji_tu_smaadd"], function() {
	fgaji_tu_smaadd.createAutoSuggest({"id":"x_tambahan","forceSelect":false});
});
</script>
<?php echo $gaji_tu_sma_add->tambahan->Lookup->getParamTag($gaji_tu_sma_add, "p_x_tambahan") ?>
</span>
<?php echo $gaji_tu_sma_add->tambahan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_tu_sma_add->ijasah->Visible) { // ijasah ?>
	<div id="r_ijasah" class="form-group row">
		<label id="elh_gaji_tu_sma_ijasah" for="x_ijasah" class="<?php echo $gaji_tu_sma_add->LeftColumnClass ?>"><?php echo $gaji_tu_sma_add->ijasah->caption() ?><?php echo $gaji_tu_sma_add->ijasah->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_tu_sma_add->RightColumnClass ?>"><div <?php echo $gaji_tu_sma_add->ijasah->cellAttributes() ?>>
<span id="el_gaji_tu_sma_ijasah">
<input type="text" data-table="gaji_tu_sma" data-field="x_ijasah" name="x_ijasah" id="x_ijasah" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gaji_tu_sma_add->ijasah->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sma_add->ijasah->EditValue ?>"<?php echo $gaji_tu_sma_add->ijasah->editAttributes() ?>>
</span>
<?php echo $gaji_tu_sma_add->ijasah->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_tu_sma_add->gapok->Visible) { // gapok ?>
	<div id="r_gapok" class="form-group row">
		<label id="elh_gaji_tu_sma_gapok" for="x_gapok" class="<?php echo $gaji_tu_sma_add->LeftColumnClass ?>"><?php echo $gaji_tu_sma_add->gapok->caption() ?><?php echo $gaji_tu_sma_add->gapok->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_tu_sma_add->RightColumnClass ?>"><div <?php echo $gaji_tu_sma_add->gapok->cellAttributes() ?>>
<span id="el_gaji_tu_sma_gapok">
<input type="text" data-table="gaji_tu_sma" data-field="x_gapok" name="x_gapok" id="x_gapok" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_tu_sma_add->gapok->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sma_add->gapok->EditValue ?>"<?php echo $gaji_tu_sma_add->gapok->editAttributes() ?>>
</span>
<?php echo $gaji_tu_sma_add->gapok->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_tu_sma_add->kehadiran->Visible) { // kehadiran ?>
	<div id="r_kehadiran" class="form-group row">
		<label id="elh_gaji_tu_sma_kehadiran" for="x_kehadiran" class="<?php echo $gaji_tu_sma_add->LeftColumnClass ?>"><?php echo $gaji_tu_sma_add->kehadiran->caption() ?><?php echo $gaji_tu_sma_add->kehadiran->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_tu_sma_add->RightColumnClass ?>"><div <?php echo $gaji_tu_sma_add->kehadiran->cellAttributes() ?>>
<span id="el_gaji_tu_sma_kehadiran">
<input type="text" data-table="gaji_tu_sma" data-field="x_kehadiran" name="x_kehadiran" id="x_kehadiran" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($gaji_tu_sma_add->kehadiran->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sma_add->kehadiran->EditValue ?>"<?php echo $gaji_tu_sma_add->kehadiran->editAttributes() ?>>
</span>
<?php echo $gaji_tu_sma_add->kehadiran->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_tu_sma_add->lembur->Visible) { // lembur ?>
	<div id="r_lembur" class="form-group row">
		<label id="elh_gaji_tu_sma_lembur" for="x_lembur" class="<?php echo $gaji_tu_sma_add->LeftColumnClass ?>"><?php echo $gaji_tu_sma_add->lembur->caption() ?><?php echo $gaji_tu_sma_add->lembur->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_tu_sma_add->RightColumnClass ?>"><div <?php echo $gaji_tu_sma_add->lembur->cellAttributes() ?>>
<span id="el_gaji_tu_sma_lembur">
<input type="text" data-table="gaji_tu_sma" data-field="x_lembur" name="x_lembur" id="x_lembur" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($gaji_tu_sma_add->lembur->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sma_add->lembur->EditValue ?>"<?php echo $gaji_tu_sma_add->lembur->editAttributes() ?>>
</span>
<?php echo $gaji_tu_sma_add->lembur->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_tu_sma_add->value_lembur->Visible) { // value_lembur ?>
	<div id="r_value_lembur" class="form-group row">
		<label id="elh_gaji_tu_sma_value_lembur" for="x_value_lembur" class="<?php echo $gaji_tu_sma_add->LeftColumnClass ?>"><?php echo $gaji_tu_sma_add->value_lembur->caption() ?><?php echo $gaji_tu_sma_add->value_lembur->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_tu_sma_add->RightColumnClass ?>"><div <?php echo $gaji_tu_sma_add->value_lembur->cellAttributes() ?>>
<span id="el_gaji_tu_sma_value_lembur">
<input type="text" data-table="gaji_tu_sma" data-field="x_value_lembur" name="x_value_lembur" id="x_value_lembur" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_tu_sma_add->value_lembur->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sma_add->value_lembur->EditValue ?>"<?php echo $gaji_tu_sma_add->value_lembur->editAttributes() ?>>
</span>
<?php echo $gaji_tu_sma_add->value_lembur->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_tu_sma_add->value_reward->Visible) { // value_reward ?>
	<div id="r_value_reward" class="form-group row">
		<label id="elh_gaji_tu_sma_value_reward" for="x_value_reward" class="<?php echo $gaji_tu_sma_add->LeftColumnClass ?>"><?php echo $gaji_tu_sma_add->value_reward->caption() ?><?php echo $gaji_tu_sma_add->value_reward->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_tu_sma_add->RightColumnClass ?>"><div <?php echo $gaji_tu_sma_add->value_reward->cellAttributes() ?>>
<span id="el_gaji_tu_sma_value_reward">
<input type="text" data-table="gaji_tu_sma" data-field="x_value_reward" name="x_value_reward" id="x_value_reward" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_tu_sma_add->value_reward->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sma_add->value_reward->EditValue ?>"<?php echo $gaji_tu_sma_add->value_reward->editAttributes() ?>>
</span>
<?php echo $gaji_tu_sma_add->value_reward->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_tu_sma_add->value_inval->Visible) { // value_inval ?>
	<div id="r_value_inval" class="form-group row">
		<label id="elh_gaji_tu_sma_value_inval" for="x_value_inval" class="<?php echo $gaji_tu_sma_add->LeftColumnClass ?>"><?php echo $gaji_tu_sma_add->value_inval->caption() ?><?php echo $gaji_tu_sma_add->value_inval->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_tu_sma_add->RightColumnClass ?>"><div <?php echo $gaji_tu_sma_add->value_inval->cellAttributes() ?>>
<span id="el_gaji_tu_sma_value_inval">
<input type="text" data-table="gaji_tu_sma" data-field="x_value_inval" name="x_value_inval" id="x_value_inval" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_tu_sma_add->value_inval->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sma_add->value_inval->EditValue ?>"<?php echo $gaji_tu_sma_add->value_inval->editAttributes() ?>>
</span>
<?php echo $gaji_tu_sma_add->value_inval->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_tu_sma_add->piket_count->Visible) { // piket_count ?>
	<div id="r_piket_count" class="form-group row">
		<label id="elh_gaji_tu_sma_piket_count" for="x_piket_count" class="<?php echo $gaji_tu_sma_add->LeftColumnClass ?>"><?php echo $gaji_tu_sma_add->piket_count->caption() ?><?php echo $gaji_tu_sma_add->piket_count->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_tu_sma_add->RightColumnClass ?>"><div <?php echo $gaji_tu_sma_add->piket_count->cellAttributes() ?>>
<span id="el_gaji_tu_sma_piket_count">
<input type="text" data-table="gaji_tu_sma" data-field="x_piket_count" name="x_piket_count" id="x_piket_count" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($gaji_tu_sma_add->piket_count->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sma_add->piket_count->EditValue ?>"<?php echo $gaji_tu_sma_add->piket_count->editAttributes() ?>>
</span>
<?php echo $gaji_tu_sma_add->piket_count->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_tu_sma_add->value_piket->Visible) { // value_piket ?>
	<div id="r_value_piket" class="form-group row">
		<label id="elh_gaji_tu_sma_value_piket" for="x_value_piket" class="<?php echo $gaji_tu_sma_add->LeftColumnClass ?>"><?php echo $gaji_tu_sma_add->value_piket->caption() ?><?php echo $gaji_tu_sma_add->value_piket->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_tu_sma_add->RightColumnClass ?>"><div <?php echo $gaji_tu_sma_add->value_piket->cellAttributes() ?>>
<span id="el_gaji_tu_sma_value_piket">
<input type="text" data-table="gaji_tu_sma" data-field="x_value_piket" name="x_value_piket" id="x_value_piket" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_tu_sma_add->value_piket->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sma_add->value_piket->EditValue ?>"<?php echo $gaji_tu_sma_add->value_piket->editAttributes() ?>>
</span>
<?php echo $gaji_tu_sma_add->value_piket->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_tu_sma_add->tugastambahan->Visible) { // tugastambahan ?>
	<div id="r_tugastambahan" class="form-group row">
		<label id="elh_gaji_tu_sma_tugastambahan" for="x_tugastambahan" class="<?php echo $gaji_tu_sma_add->LeftColumnClass ?>"><?php echo $gaji_tu_sma_add->tugastambahan->caption() ?><?php echo $gaji_tu_sma_add->tugastambahan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_tu_sma_add->RightColumnClass ?>"><div <?php echo $gaji_tu_sma_add->tugastambahan->cellAttributes() ?>>
<span id="el_gaji_tu_sma_tugastambahan">
<input type="text" data-table="gaji_tu_sma" data-field="x_tugastambahan" name="x_tugastambahan" id="x_tugastambahan" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_tu_sma_add->tugastambahan->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sma_add->tugastambahan->EditValue ?>"<?php echo $gaji_tu_sma_add->tugastambahan->editAttributes() ?>>
</span>
<?php echo $gaji_tu_sma_add->tugastambahan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_tu_sma_add->tj_jabatan->Visible) { // tj_jabatan ?>
	<div id="r_tj_jabatan" class="form-group row">
		<label id="elh_gaji_tu_sma_tj_jabatan" for="x_tj_jabatan" class="<?php echo $gaji_tu_sma_add->LeftColumnClass ?>"><?php echo $gaji_tu_sma_add->tj_jabatan->caption() ?><?php echo $gaji_tu_sma_add->tj_jabatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_tu_sma_add->RightColumnClass ?>"><div <?php echo $gaji_tu_sma_add->tj_jabatan->cellAttributes() ?>>
<span id="el_gaji_tu_sma_tj_jabatan">
<input type="text" data-table="gaji_tu_sma" data-field="x_tj_jabatan" name="x_tj_jabatan" id="x_tj_jabatan" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_tu_sma_add->tj_jabatan->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sma_add->tj_jabatan->EditValue ?>"<?php echo $gaji_tu_sma_add->tj_jabatan->editAttributes() ?>>
</span>
<?php echo $gaji_tu_sma_add->tj_jabatan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_tu_sma_add->tunjangan2->Visible) { // tunjangan2 ?>
	<div id="r_tunjangan2" class="form-group row">
		<label id="elh_gaji_tu_sma_tunjangan2" for="x_tunjangan2" class="<?php echo $gaji_tu_sma_add->LeftColumnClass ?>"><?php echo $gaji_tu_sma_add->tunjangan2->caption() ?><?php echo $gaji_tu_sma_add->tunjangan2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_tu_sma_add->RightColumnClass ?>"><div <?php echo $gaji_tu_sma_add->tunjangan2->cellAttributes() ?>>
<span id="el_gaji_tu_sma_tunjangan2">
<input type="text" data-table="gaji_tu_sma" data-field="x_tunjangan2" name="x_tunjangan2" id="x_tunjangan2" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gaji_tu_sma_add->tunjangan2->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sma_add->tunjangan2->EditValue ?>"<?php echo $gaji_tu_sma_add->tunjangan2->editAttributes() ?>>
</span>
<?php echo $gaji_tu_sma_add->tunjangan2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_tu_sma_add->potongan->Visible) { // potongan ?>
	<div id="r_potongan" class="form-group row">
		<label id="elh_gaji_tu_sma_potongan" for="x_potongan" class="<?php echo $gaji_tu_sma_add->LeftColumnClass ?>"><?php echo $gaji_tu_sma_add->potongan->caption() ?><?php echo $gaji_tu_sma_add->potongan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_tu_sma_add->RightColumnClass ?>"><div <?php echo $gaji_tu_sma_add->potongan->cellAttributes() ?>>
<span id="el_gaji_tu_sma_potongan">
<input type="text" data-table="gaji_tu_sma" data-field="x_potongan" name="x_potongan" id="x_potongan" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_tu_sma_add->potongan->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sma_add->potongan->EditValue ?>"<?php echo $gaji_tu_sma_add->potongan->editAttributes() ?>>
</span>
<?php echo $gaji_tu_sma_add->potongan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_tu_sma_add->sub_total->Visible) { // sub_total ?>
	<div id="r_sub_total" class="form-group row">
		<label id="elh_gaji_tu_sma_sub_total" for="x_sub_total" class="<?php echo $gaji_tu_sma_add->LeftColumnClass ?>"><?php echo $gaji_tu_sma_add->sub_total->caption() ?><?php echo $gaji_tu_sma_add->sub_total->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_tu_sma_add->RightColumnClass ?>"><div <?php echo $gaji_tu_sma_add->sub_total->cellAttributes() ?>>
<span id="el_gaji_tu_sma_sub_total">
<input type="text" data-table="gaji_tu_sma" data-field="x_sub_total" name="x_sub_total" id="x_sub_total" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_tu_sma_add->sub_total->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sma_add->sub_total->EditValue ?>"<?php echo $gaji_tu_sma_add->sub_total->editAttributes() ?>>
</span>
<?php echo $gaji_tu_sma_add->sub_total->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_tu_sma_add->penyesuaian->Visible) { // penyesuaian ?>
	<div id="r_penyesuaian" class="form-group row">
		<label id="elh_gaji_tu_sma_penyesuaian" for="x_penyesuaian" class="<?php echo $gaji_tu_sma_add->LeftColumnClass ?>"><?php echo $gaji_tu_sma_add->penyesuaian->caption() ?><?php echo $gaji_tu_sma_add->penyesuaian->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_tu_sma_add->RightColumnClass ?>"><div <?php echo $gaji_tu_sma_add->penyesuaian->cellAttributes() ?>>
<span id="el_gaji_tu_sma_penyesuaian">
<input type="text" data-table="gaji_tu_sma" data-field="x_penyesuaian" name="x_penyesuaian" id="x_penyesuaian" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_tu_sma_add->penyesuaian->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sma_add->penyesuaian->EditValue ?>"<?php echo $gaji_tu_sma_add->penyesuaian->editAttributes() ?>>
</span>
<?php echo $gaji_tu_sma_add->penyesuaian->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_tu_sma_add->total->Visible) { // total ?>
	<div id="r_total" class="form-group row">
		<label id="elh_gaji_tu_sma_total" for="x_total" class="<?php echo $gaji_tu_sma_add->LeftColumnClass ?>"><?php echo $gaji_tu_sma_add->total->caption() ?><?php echo $gaji_tu_sma_add->total->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_tu_sma_add->RightColumnClass ?>"><div <?php echo $gaji_tu_sma_add->total->cellAttributes() ?>>
<span id="el_gaji_tu_sma_total">
<input type="text" data-table="gaji_tu_sma" data-field="x_total" name="x_total" id="x_total" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_tu_sma_add->total->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sma_add->total->EditValue ?>"<?php echo $gaji_tu_sma_add->total->editAttributes() ?>>
</span>
<?php echo $gaji_tu_sma_add->total->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<?php if (strval($gaji_tu_sma_add->pid->getSessionValue()) != "") { ?>
	<input type="hidden" name="x_pid" id="x_pid" value="<?php echo HtmlEncode(strval($gaji_tu_sma_add->pid->getSessionValue())) ?>">
	<?php } ?>
<?php if (!$gaji_tu_sma_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $gaji_tu_sma_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $gaji_tu_sma_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$gaji_tu_sma_add->showPageFooter();
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
$gaji_tu_sma_add->terminate();
?>