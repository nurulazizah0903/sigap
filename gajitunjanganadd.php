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
$gajitunjangan_add = new gajitunjangan_add();

// Run the page
$gajitunjangan_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gajitunjangan_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fgajitunjanganadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fgajitunjanganadd = currentForm = new ew.Form("fgajitunjanganadd", "add");

	// Validate form
	fgajitunjanganadd.validate = function() {
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
			<?php if ($gajitunjangan_add->pidjabatan->Required) { ?>
				elm = this.getElements("x" + infix + "_pidjabatan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitunjangan_add->pidjabatan->caption(), $gajitunjangan_add->pidjabatan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pidjabatan");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitunjangan_add->pidjabatan->errorMessage()) ?>");
			<?php if ($gajitunjangan_add->value_kehadiran->Required) { ?>
				elm = this.getElements("x" + infix + "_value_kehadiran");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitunjangan_add->value_kehadiran->caption(), $gajitunjangan_add->value_kehadiran->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_value_kehadiran");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitunjangan_add->value_kehadiran->errorMessage()) ?>");
			<?php if ($gajitunjangan_add->gapok->Required) { ?>
				elm = this.getElements("x" + infix + "_gapok");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitunjangan_add->gapok->caption(), $gajitunjangan_add->gapok->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_gapok");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitunjangan_add->gapok->errorMessage()) ?>");
			<?php if ($gajitunjangan_add->tunjangan_jabatan->Required) { ?>
				elm = this.getElements("x" + infix + "_tunjangan_jabatan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitunjangan_add->tunjangan_jabatan->caption(), $gajitunjangan_add->tunjangan_jabatan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tunjangan_jabatan");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitunjangan_add->tunjangan_jabatan->errorMessage()) ?>");
			<?php if ($gajitunjangan_add->reward->Required) { ?>
				elm = this.getElements("x" + infix + "_reward");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitunjangan_add->reward->caption(), $gajitunjangan_add->reward->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_reward");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitunjangan_add->reward->errorMessage()) ?>");
			<?php if ($gajitunjangan_add->lembur->Required) { ?>
				elm = this.getElements("x" + infix + "_lembur");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitunjangan_add->lembur->caption(), $gajitunjangan_add->lembur->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_lembur");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitunjangan_add->lembur->errorMessage()) ?>");
			<?php if ($gajitunjangan_add->piket->Required) { ?>
				elm = this.getElements("x" + infix + "_piket");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitunjangan_add->piket->caption(), $gajitunjangan_add->piket->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_piket");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitunjangan_add->piket->errorMessage()) ?>");
			<?php if ($gajitunjangan_add->inval->Required) { ?>
				elm = this.getElements("x" + infix + "_inval");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitunjangan_add->inval->caption(), $gajitunjangan_add->inval->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_inval");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitunjangan_add->inval->errorMessage()) ?>");
			<?php if ($gajitunjangan_add->jam_lebih->Required) { ?>
				elm = this.getElements("x" + infix + "_jam_lebih");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitunjangan_add->jam_lebih->caption(), $gajitunjangan_add->jam_lebih->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jam_lebih");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitunjangan_add->jam_lebih->errorMessage()) ?>");
			<?php if ($gajitunjangan_add->tunjangan_khusus->Required) { ?>
				elm = this.getElements("x" + infix + "_tunjangan_khusus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitunjangan_add->tunjangan_khusus->caption(), $gajitunjangan_add->tunjangan_khusus->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tunjangan_khusus");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitunjangan_add->tunjangan_khusus->errorMessage()) ?>");
			<?php if ($gajitunjangan_add->ekstrakuri->Required) { ?>
				elm = this.getElements("x" + infix + "_ekstrakuri");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitunjangan_add->ekstrakuri->caption(), $gajitunjangan_add->ekstrakuri->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ekstrakuri");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitunjangan_add->ekstrakuri->errorMessage()) ?>");

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
	fgajitunjanganadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fgajitunjanganadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fgajitunjanganadd.lists["x_pidjabatan"] = <?php echo $gajitunjangan_add->pidjabatan->Lookup->toClientList($gajitunjangan_add) ?>;
	fgajitunjanganadd.lists["x_pidjabatan"].options = <?php echo JsonEncode($gajitunjangan_add->pidjabatan->lookupOptions()) ?>;
	fgajitunjanganadd.autoSuggests["x_pidjabatan"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fgajitunjanganadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $gajitunjangan_add->showPageHeader(); ?>
<?php
$gajitunjangan_add->showMessage();
?>
<form name="fgajitunjanganadd" id="fgajitunjanganadd" class="<?php echo $gajitunjangan_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gajitunjangan">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$gajitunjangan_add->IsModal ?>">
<?php if ($gajitunjangan->getCurrentMasterTable() == "jabatan") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="jabatan">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($gajitunjangan_add->pidjabatan->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($gajitunjangan_add->pidjabatan->Visible) { // pidjabatan ?>
	<div id="r_pidjabatan" class="form-group row">
		<label id="elh_gajitunjangan_pidjabatan" class="<?php echo $gajitunjangan_add->LeftColumnClass ?>"><?php echo $gajitunjangan_add->pidjabatan->caption() ?><?php echo $gajitunjangan_add->pidjabatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajitunjangan_add->RightColumnClass ?>"><div <?php echo $gajitunjangan_add->pidjabatan->cellAttributes() ?>>
<?php if ($gajitunjangan_add->pidjabatan->getSessionValue() != "") { ?>
<span id="el_gajitunjangan_pidjabatan">
<span<?php echo $gajitunjangan_add->pidjabatan->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gajitunjangan_add->pidjabatan->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_pidjabatan" name="x_pidjabatan" value="<?php echo HtmlEncode($gajitunjangan_add->pidjabatan->CurrentValue) ?>">
<?php } else { ?>
<span id="el_gajitunjangan_pidjabatan">
<?php
$onchange = $gajitunjangan_add->pidjabatan->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$gajitunjangan_add->pidjabatan->EditAttrs["onchange"] = "";
?>
<span id="as_x_pidjabatan">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_pidjabatan" id="sv_x_pidjabatan" value="<?php echo RemoveHtml($gajitunjangan_add->pidjabatan->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitunjangan_add->pidjabatan->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($gajitunjangan_add->pidjabatan->getPlaceHolder()) ?>"<?php echo $gajitunjangan_add->pidjabatan->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($gajitunjangan_add->pidjabatan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_pidjabatan',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($gajitunjangan_add->pidjabatan->ReadOnly || $gajitunjangan_add->pidjabatan->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="gajitunjangan" data-field="x_pidjabatan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $gajitunjangan_add->pidjabatan->displayValueSeparatorAttribute() ?>" name="x_pidjabatan" id="x_pidjabatan" value="<?php echo HtmlEncode($gajitunjangan_add->pidjabatan->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fgajitunjanganadd"], function() {
	fgajitunjanganadd.createAutoSuggest({"id":"x_pidjabatan","forceSelect":false});
});
</script>
<?php echo $gajitunjangan_add->pidjabatan->Lookup->getParamTag($gajitunjangan_add, "p_x_pidjabatan") ?>
</span>
<?php } ?>
<?php echo $gajitunjangan_add->pidjabatan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajitunjangan_add->value_kehadiran->Visible) { // value_kehadiran ?>
	<div id="r_value_kehadiran" class="form-group row">
		<label id="elh_gajitunjangan_value_kehadiran" for="x_value_kehadiran" class="<?php echo $gajitunjangan_add->LeftColumnClass ?>"><?php echo $gajitunjangan_add->value_kehadiran->caption() ?><?php echo $gajitunjangan_add->value_kehadiran->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajitunjangan_add->RightColumnClass ?>"><div <?php echo $gajitunjangan_add->value_kehadiran->cellAttributes() ?>>
<span id="el_gajitunjangan_value_kehadiran">
<input type="text" data-table="gajitunjangan" data-field="x_value_kehadiran" name="x_value_kehadiran" id="x_value_kehadiran" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gajitunjangan_add->value_kehadiran->getPlaceHolder()) ?>" value="<?php echo $gajitunjangan_add->value_kehadiran->EditValue ?>"<?php echo $gajitunjangan_add->value_kehadiran->editAttributes() ?>>
</span>
<?php echo $gajitunjangan_add->value_kehadiran->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajitunjangan_add->gapok->Visible) { // gapok ?>
	<div id="r_gapok" class="form-group row">
		<label id="elh_gajitunjangan_gapok" for="x_gapok" class="<?php echo $gajitunjangan_add->LeftColumnClass ?>"><?php echo $gajitunjangan_add->gapok->caption() ?><?php echo $gajitunjangan_add->gapok->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajitunjangan_add->RightColumnClass ?>"><div <?php echo $gajitunjangan_add->gapok->cellAttributes() ?>>
<span id="el_gajitunjangan_gapok">
<input type="text" data-table="gajitunjangan" data-field="x_gapok" name="x_gapok" id="x_gapok" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitunjangan_add->gapok->getPlaceHolder()) ?>" value="<?php echo $gajitunjangan_add->gapok->EditValue ?>"<?php echo $gajitunjangan_add->gapok->editAttributes() ?>>
</span>
<?php echo $gajitunjangan_add->gapok->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajitunjangan_add->tunjangan_jabatan->Visible) { // tunjangan_jabatan ?>
	<div id="r_tunjangan_jabatan" class="form-group row">
		<label id="elh_gajitunjangan_tunjangan_jabatan" for="x_tunjangan_jabatan" class="<?php echo $gajitunjangan_add->LeftColumnClass ?>"><?php echo $gajitunjangan_add->tunjangan_jabatan->caption() ?><?php echo $gajitunjangan_add->tunjangan_jabatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajitunjangan_add->RightColumnClass ?>"><div <?php echo $gajitunjangan_add->tunjangan_jabatan->cellAttributes() ?>>
<span id="el_gajitunjangan_tunjangan_jabatan">
<input type="text" data-table="gajitunjangan" data-field="x_tunjangan_jabatan" name="x_tunjangan_jabatan" id="x_tunjangan_jabatan" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitunjangan_add->tunjangan_jabatan->getPlaceHolder()) ?>" value="<?php echo $gajitunjangan_add->tunjangan_jabatan->EditValue ?>"<?php echo $gajitunjangan_add->tunjangan_jabatan->editAttributes() ?>>
</span>
<?php echo $gajitunjangan_add->tunjangan_jabatan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajitunjangan_add->reward->Visible) { // reward ?>
	<div id="r_reward" class="form-group row">
		<label id="elh_gajitunjangan_reward" for="x_reward" class="<?php echo $gajitunjangan_add->LeftColumnClass ?>"><?php echo $gajitunjangan_add->reward->caption() ?><?php echo $gajitunjangan_add->reward->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajitunjangan_add->RightColumnClass ?>"><div <?php echo $gajitunjangan_add->reward->cellAttributes() ?>>
<span id="el_gajitunjangan_reward">
<input type="text" data-table="gajitunjangan" data-field="x_reward" name="x_reward" id="x_reward" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitunjangan_add->reward->getPlaceHolder()) ?>" value="<?php echo $gajitunjangan_add->reward->EditValue ?>"<?php echo $gajitunjangan_add->reward->editAttributes() ?>>
</span>
<?php echo $gajitunjangan_add->reward->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajitunjangan_add->lembur->Visible) { // lembur ?>
	<div id="r_lembur" class="form-group row">
		<label id="elh_gajitunjangan_lembur" for="x_lembur" class="<?php echo $gajitunjangan_add->LeftColumnClass ?>"><?php echo $gajitunjangan_add->lembur->caption() ?><?php echo $gajitunjangan_add->lembur->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajitunjangan_add->RightColumnClass ?>"><div <?php echo $gajitunjangan_add->lembur->cellAttributes() ?>>
<span id="el_gajitunjangan_lembur">
<input type="text" data-table="gajitunjangan" data-field="x_lembur" name="x_lembur" id="x_lembur" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitunjangan_add->lembur->getPlaceHolder()) ?>" value="<?php echo $gajitunjangan_add->lembur->EditValue ?>"<?php echo $gajitunjangan_add->lembur->editAttributes() ?>>
</span>
<?php echo $gajitunjangan_add->lembur->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajitunjangan_add->piket->Visible) { // piket ?>
	<div id="r_piket" class="form-group row">
		<label id="elh_gajitunjangan_piket" for="x_piket" class="<?php echo $gajitunjangan_add->LeftColumnClass ?>"><?php echo $gajitunjangan_add->piket->caption() ?><?php echo $gajitunjangan_add->piket->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajitunjangan_add->RightColumnClass ?>"><div <?php echo $gajitunjangan_add->piket->cellAttributes() ?>>
<span id="el_gajitunjangan_piket">
<input type="text" data-table="gajitunjangan" data-field="x_piket" name="x_piket" id="x_piket" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitunjangan_add->piket->getPlaceHolder()) ?>" value="<?php echo $gajitunjangan_add->piket->EditValue ?>"<?php echo $gajitunjangan_add->piket->editAttributes() ?>>
</span>
<?php echo $gajitunjangan_add->piket->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajitunjangan_add->inval->Visible) { // inval ?>
	<div id="r_inval" class="form-group row">
		<label id="elh_gajitunjangan_inval" for="x_inval" class="<?php echo $gajitunjangan_add->LeftColumnClass ?>"><?php echo $gajitunjangan_add->inval->caption() ?><?php echo $gajitunjangan_add->inval->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajitunjangan_add->RightColumnClass ?>"><div <?php echo $gajitunjangan_add->inval->cellAttributes() ?>>
<span id="el_gajitunjangan_inval">
<input type="text" data-table="gajitunjangan" data-field="x_inval" name="x_inval" id="x_inval" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitunjangan_add->inval->getPlaceHolder()) ?>" value="<?php echo $gajitunjangan_add->inval->EditValue ?>"<?php echo $gajitunjangan_add->inval->editAttributes() ?>>
</span>
<?php echo $gajitunjangan_add->inval->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajitunjangan_add->jam_lebih->Visible) { // jam_lebih ?>
	<div id="r_jam_lebih" class="form-group row">
		<label id="elh_gajitunjangan_jam_lebih" for="x_jam_lebih" class="<?php echo $gajitunjangan_add->LeftColumnClass ?>"><?php echo $gajitunjangan_add->jam_lebih->caption() ?><?php echo $gajitunjangan_add->jam_lebih->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajitunjangan_add->RightColumnClass ?>"><div <?php echo $gajitunjangan_add->jam_lebih->cellAttributes() ?>>
<span id="el_gajitunjangan_jam_lebih">
<input type="text" data-table="gajitunjangan" data-field="x_jam_lebih" name="x_jam_lebih" id="x_jam_lebih" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gajitunjangan_add->jam_lebih->getPlaceHolder()) ?>" value="<?php echo $gajitunjangan_add->jam_lebih->EditValue ?>"<?php echo $gajitunjangan_add->jam_lebih->editAttributes() ?>>
</span>
<?php echo $gajitunjangan_add->jam_lebih->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajitunjangan_add->tunjangan_khusus->Visible) { // tunjangan_khusus ?>
	<div id="r_tunjangan_khusus" class="form-group row">
		<label id="elh_gajitunjangan_tunjangan_khusus" for="x_tunjangan_khusus" class="<?php echo $gajitunjangan_add->LeftColumnClass ?>"><?php echo $gajitunjangan_add->tunjangan_khusus->caption() ?><?php echo $gajitunjangan_add->tunjangan_khusus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajitunjangan_add->RightColumnClass ?>"><div <?php echo $gajitunjangan_add->tunjangan_khusus->cellAttributes() ?>>
<span id="el_gajitunjangan_tunjangan_khusus">
<input type="text" data-table="gajitunjangan" data-field="x_tunjangan_khusus" name="x_tunjangan_khusus" id="x_tunjangan_khusus" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gajitunjangan_add->tunjangan_khusus->getPlaceHolder()) ?>" value="<?php echo $gajitunjangan_add->tunjangan_khusus->EditValue ?>"<?php echo $gajitunjangan_add->tunjangan_khusus->editAttributes() ?>>
</span>
<?php echo $gajitunjangan_add->tunjangan_khusus->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajitunjangan_add->ekstrakuri->Visible) { // ekstrakuri ?>
	<div id="r_ekstrakuri" class="form-group row">
		<label id="elh_gajitunjangan_ekstrakuri" for="x_ekstrakuri" class="<?php echo $gajitunjangan_add->LeftColumnClass ?>"><?php echo $gajitunjangan_add->ekstrakuri->caption() ?><?php echo $gajitunjangan_add->ekstrakuri->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajitunjangan_add->RightColumnClass ?>"><div <?php echo $gajitunjangan_add->ekstrakuri->cellAttributes() ?>>
<span id="el_gajitunjangan_ekstrakuri">
<input type="text" data-table="gajitunjangan" data-field="x_ekstrakuri" name="x_ekstrakuri" id="x_ekstrakuri" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gajitunjangan_add->ekstrakuri->getPlaceHolder()) ?>" value="<?php echo $gajitunjangan_add->ekstrakuri->EditValue ?>"<?php echo $gajitunjangan_add->ekstrakuri->editAttributes() ?>>
</span>
<?php echo $gajitunjangan_add->ekstrakuri->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$gajitunjangan_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $gajitunjangan_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $gajitunjangan_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$gajitunjangan_add->showPageFooter();
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
$gajitunjangan_add->terminate();
?>