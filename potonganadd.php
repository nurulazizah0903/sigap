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
$potongan_add = new potongan_add();

// Run the page
$potongan_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$potongan_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpotonganadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fpotonganadd = currentForm = new ew.Form("fpotonganadd", "add");

	// Validate form
	fpotonganadd.validate = function() {
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
			<?php if ($potongan_add->datetime->Required) { ?>
				elm = this.getElements("x" + infix + "_datetime");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $potongan_add->datetime->caption(), $potongan_add->datetime->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($potongan_add->u_by->Required) { ?>
				elm = this.getElements("x" + infix + "_u_by");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $potongan_add->u_by->caption(), $potongan_add->u_by->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($potongan_add->month->Required) { ?>
				elm = this.getElements("x" + infix + "_month");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $potongan_add->month->caption(), $potongan_add->month->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_month");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($potongan_add->month->errorMessage()) ?>");
			<?php if ($potongan_add->nama->Required) { ?>
				elm = this.getElements("x" + infix + "_nama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $potongan_add->nama->caption(), $potongan_add->nama->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($potongan_add->jenjang_id->Required) { ?>
				elm = this.getElements("x" + infix + "_jenjang_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $potongan_add->jenjang_id->caption(), $potongan_add->jenjang_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jenjang_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($potongan_add->jenjang_id->errorMessage()) ?>");
			<?php if ($potongan_add->jabatan_id->Required) { ?>
				elm = this.getElements("x" + infix + "_jabatan_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $potongan_add->jabatan_id->caption(), $potongan_add->jabatan_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jabatan_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($potongan_add->jabatan_id->errorMessage()) ?>");
			<?php if ($potongan_add->terlambat->Required) { ?>
				elm = this.getElements("x" + infix + "_terlambat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $potongan_add->terlambat->caption(), $potongan_add->terlambat->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_terlambat");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($potongan_add->terlambat->errorMessage()) ?>");
			<?php if ($potongan_add->izin->Required) { ?>
				elm = this.getElements("x" + infix + "_izin");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $potongan_add->izin->caption(), $potongan_add->izin->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_izin");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($potongan_add->izin->errorMessage()) ?>");
			<?php if ($potongan_add->sakit->Required) { ?>
				elm = this.getElements("x" + infix + "_sakit");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $potongan_add->sakit->caption(), $potongan_add->sakit->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_sakit");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($potongan_add->sakit->errorMessage()) ?>");
			<?php if ($potongan_add->tidakhadir->Required) { ?>
				elm = this.getElements("x" + infix + "_tidakhadir");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $potongan_add->tidakhadir->caption(), $potongan_add->tidakhadir->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tidakhadir");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($potongan_add->tidakhadir->errorMessage()) ?>");
			<?php if ($potongan_add->pulcep->Required) { ?>
				elm = this.getElements("x" + infix + "_pulcep");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $potongan_add->pulcep->caption(), $potongan_add->pulcep->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pulcep");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($potongan_add->pulcep->errorMessage()) ?>");
			<?php if ($potongan_add->tidakhadirjam->Required) { ?>
				elm = this.getElements("x" + infix + "_tidakhadirjam");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $potongan_add->tidakhadirjam->caption(), $potongan_add->tidakhadirjam->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tidakhadirjam");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($potongan_add->tidakhadirjam->errorMessage()) ?>");
			<?php if ($potongan_add->sakitperjam->Required) { ?>
				elm = this.getElements("x" + infix + "_sakitperjam");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $potongan_add->sakitperjam->caption(), $potongan_add->sakitperjam->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_sakitperjam");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($potongan_add->sakitperjam->errorMessage()) ?>");
			<?php if ($potongan_add->izinperjam->Required) { ?>
				elm = this.getElements("x" + infix + "_izinperjam");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $potongan_add->izinperjam->caption(), $potongan_add->izinperjam->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_izinperjam");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($potongan_add->izinperjam->errorMessage()) ?>");

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
	fpotonganadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpotonganadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fpotonganadd.lists["x_u_by"] = <?php echo $potongan_add->u_by->Lookup->toClientList($potongan_add) ?>;
	fpotonganadd.lists["x_u_by"].options = <?php echo JsonEncode($potongan_add->u_by->lookupOptions()) ?>;
	fpotonganadd.autoSuggests["x_u_by"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fpotonganadd.lists["x_nama"] = <?php echo $potongan_add->nama->Lookup->toClientList($potongan_add) ?>;
	fpotonganadd.lists["x_nama"].options = <?php echo JsonEncode($potongan_add->nama->lookupOptions()) ?>;
	fpotonganadd.lists["x_jenjang_id"] = <?php echo $potongan_add->jenjang_id->Lookup->toClientList($potongan_add) ?>;
	fpotonganadd.lists["x_jenjang_id"].options = <?php echo JsonEncode($potongan_add->jenjang_id->lookupOptions()) ?>;
	fpotonganadd.autoSuggests["x_jenjang_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fpotonganadd.lists["x_jabatan_id"] = <?php echo $potongan_add->jabatan_id->Lookup->toClientList($potongan_add) ?>;
	fpotonganadd.lists["x_jabatan_id"].options = <?php echo JsonEncode($potongan_add->jabatan_id->lookupOptions()) ?>;
	fpotonganadd.autoSuggests["x_jabatan_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fpotonganadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $potongan_add->showPageHeader(); ?>
<?php
$potongan_add->showMessage();
?>
<form name="fpotonganadd" id="fpotonganadd" class="<?php echo $potongan_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="potongan">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$potongan_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($potongan_add->month->Visible) { // month ?>
	<div id="r_month" class="form-group row">
		<label id="elh_potongan_month" for="x_month" class="<?php echo $potongan_add->LeftColumnClass ?>"><?php echo $potongan_add->month->caption() ?><?php echo $potongan_add->month->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $potongan_add->RightColumnClass ?>"><div <?php echo $potongan_add->month->cellAttributes() ?>>
<span id="el_potongan_month">
<input type="text" data-table="potongan" data-field="x_month" name="x_month" id="x_month" maxlength="10" placeholder="<?php echo HtmlEncode($potongan_add->month->getPlaceHolder()) ?>" value="<?php echo $potongan_add->month->EditValue ?>"<?php echo $potongan_add->month->editAttributes() ?>>
<?php if (!$potongan_add->month->ReadOnly && !$potongan_add->month->Disabled && !isset($potongan_add->month->EditAttrs["readonly"]) && !isset($potongan_add->month->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpotonganadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fpotonganadd", "x_month", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $potongan_add->month->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($potongan_add->nama->Visible) { // nama ?>
	<div id="r_nama" class="form-group row">
		<label id="elh_potongan_nama" for="x_nama" class="<?php echo $potongan_add->LeftColumnClass ?>"><?php echo $potongan_add->nama->caption() ?><?php echo $potongan_add->nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $potongan_add->RightColumnClass ?>"><div <?php echo $potongan_add->nama->cellAttributes() ?>>
<span id="el_potongan_nama">
<?php $potongan_add->nama->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_nama"><?php echo EmptyValue(strval($potongan_add->nama->ViewValue)) ? $Language->phrase("PleaseSelect") : $potongan_add->nama->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($potongan_add->nama->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($potongan_add->nama->ReadOnly || $potongan_add->nama->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_nama',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $potongan_add->nama->Lookup->getParamTag($potongan_add, "p_x_nama") ?>
<input type="hidden" data-table="potongan" data-field="x_nama" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $potongan_add->nama->displayValueSeparatorAttribute() ?>" name="x_nama" id="x_nama" value="<?php echo $potongan_add->nama->CurrentValue ?>"<?php echo $potongan_add->nama->editAttributes() ?>>
</span>
<?php echo $potongan_add->nama->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($potongan_add->jenjang_id->Visible) { // jenjang_id ?>
	<div id="r_jenjang_id" class="form-group row">
		<label id="elh_potongan_jenjang_id" class="<?php echo $potongan_add->LeftColumnClass ?>"><?php echo $potongan_add->jenjang_id->caption() ?><?php echo $potongan_add->jenjang_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $potongan_add->RightColumnClass ?>"><div <?php echo $potongan_add->jenjang_id->cellAttributes() ?>>
<span id="el_potongan_jenjang_id">
<?php
$onchange = $potongan_add->jenjang_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$potongan_add->jenjang_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_jenjang_id">
	<input type="text" class="form-control" name="sv_x_jenjang_id" id="sv_x_jenjang_id" value="<?php echo RemoveHtml($potongan_add->jenjang_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($potongan_add->jenjang_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($potongan_add->jenjang_id->getPlaceHolder()) ?>"<?php echo $potongan_add->jenjang_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="potongan" data-field="x_jenjang_id" data-value-separator="<?php echo $potongan_add->jenjang_id->displayValueSeparatorAttribute() ?>" name="x_jenjang_id" id="x_jenjang_id" value="<?php echo HtmlEncode($potongan_add->jenjang_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fpotonganadd"], function() {
	fpotonganadd.createAutoSuggest({"id":"x_jenjang_id","forceSelect":false});
});
</script>
<?php echo $potongan_add->jenjang_id->Lookup->getParamTag($potongan_add, "p_x_jenjang_id") ?>
</span>
<?php echo $potongan_add->jenjang_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($potongan_add->jabatan_id->Visible) { // jabatan_id ?>
	<div id="r_jabatan_id" class="form-group row">
		<label id="elh_potongan_jabatan_id" class="<?php echo $potongan_add->LeftColumnClass ?>"><?php echo $potongan_add->jabatan_id->caption() ?><?php echo $potongan_add->jabatan_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $potongan_add->RightColumnClass ?>"><div <?php echo $potongan_add->jabatan_id->cellAttributes() ?>>
<span id="el_potongan_jabatan_id">
<?php
$onchange = $potongan_add->jabatan_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$potongan_add->jabatan_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_jabatan_id">
	<input type="text" class="form-control" name="sv_x_jabatan_id" id="sv_x_jabatan_id" value="<?php echo RemoveHtml($potongan_add->jabatan_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($potongan_add->jabatan_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($potongan_add->jabatan_id->getPlaceHolder()) ?>"<?php echo $potongan_add->jabatan_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="potongan" data-field="x_jabatan_id" data-value-separator="<?php echo $potongan_add->jabatan_id->displayValueSeparatorAttribute() ?>" name="x_jabatan_id" id="x_jabatan_id" value="<?php echo HtmlEncode($potongan_add->jabatan_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fpotonganadd"], function() {
	fpotonganadd.createAutoSuggest({"id":"x_jabatan_id","forceSelect":false});
});
</script>
<?php echo $potongan_add->jabatan_id->Lookup->getParamTag($potongan_add, "p_x_jabatan_id") ?>
</span>
<?php echo $potongan_add->jabatan_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($potongan_add->terlambat->Visible) { // terlambat ?>
	<div id="r_terlambat" class="form-group row">
		<label id="elh_potongan_terlambat" for="x_terlambat" class="<?php echo $potongan_add->LeftColumnClass ?>"><?php echo $potongan_add->terlambat->caption() ?><?php echo $potongan_add->terlambat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $potongan_add->RightColumnClass ?>"><div <?php echo $potongan_add->terlambat->cellAttributes() ?>>
<span id="el_potongan_terlambat">
<input type="text" data-table="potongan" data-field="x_terlambat" name="x_terlambat" id="x_terlambat" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($potongan_add->terlambat->getPlaceHolder()) ?>" value="<?php echo $potongan_add->terlambat->EditValue ?>"<?php echo $potongan_add->terlambat->editAttributes() ?>>
</span>
<?php echo $potongan_add->terlambat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($potongan_add->izin->Visible) { // izin ?>
	<div id="r_izin" class="form-group row">
		<label id="elh_potongan_izin" for="x_izin" class="<?php echo $potongan_add->LeftColumnClass ?>"><?php echo $potongan_add->izin->caption() ?><?php echo $potongan_add->izin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $potongan_add->RightColumnClass ?>"><div <?php echo $potongan_add->izin->cellAttributes() ?>>
<span id="el_potongan_izin">
<input type="text" data-table="potongan" data-field="x_izin" name="x_izin" id="x_izin" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($potongan_add->izin->getPlaceHolder()) ?>" value="<?php echo $potongan_add->izin->EditValue ?>"<?php echo $potongan_add->izin->editAttributes() ?>>
</span>
<?php echo $potongan_add->izin->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($potongan_add->sakit->Visible) { // sakit ?>
	<div id="r_sakit" class="form-group row">
		<label id="elh_potongan_sakit" for="x_sakit" class="<?php echo $potongan_add->LeftColumnClass ?>"><?php echo $potongan_add->sakit->caption() ?><?php echo $potongan_add->sakit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $potongan_add->RightColumnClass ?>"><div <?php echo $potongan_add->sakit->cellAttributes() ?>>
<span id="el_potongan_sakit">
<input type="text" data-table="potongan" data-field="x_sakit" name="x_sakit" id="x_sakit" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($potongan_add->sakit->getPlaceHolder()) ?>" value="<?php echo $potongan_add->sakit->EditValue ?>"<?php echo $potongan_add->sakit->editAttributes() ?>>
</span>
<?php echo $potongan_add->sakit->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($potongan_add->tidakhadir->Visible) { // tidakhadir ?>
	<div id="r_tidakhadir" class="form-group row">
		<label id="elh_potongan_tidakhadir" for="x_tidakhadir" class="<?php echo $potongan_add->LeftColumnClass ?>"><?php echo $potongan_add->tidakhadir->caption() ?><?php echo $potongan_add->tidakhadir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $potongan_add->RightColumnClass ?>"><div <?php echo $potongan_add->tidakhadir->cellAttributes() ?>>
<span id="el_potongan_tidakhadir">
<input type="text" data-table="potongan" data-field="x_tidakhadir" name="x_tidakhadir" id="x_tidakhadir" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($potongan_add->tidakhadir->getPlaceHolder()) ?>" value="<?php echo $potongan_add->tidakhadir->EditValue ?>"<?php echo $potongan_add->tidakhadir->editAttributes() ?>>
</span>
<?php echo $potongan_add->tidakhadir->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($potongan_add->pulcep->Visible) { // pulcep ?>
	<div id="r_pulcep" class="form-group row">
		<label id="elh_potongan_pulcep" for="x_pulcep" class="<?php echo $potongan_add->LeftColumnClass ?>"><?php echo $potongan_add->pulcep->caption() ?><?php echo $potongan_add->pulcep->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $potongan_add->RightColumnClass ?>"><div <?php echo $potongan_add->pulcep->cellAttributes() ?>>
<span id="el_potongan_pulcep">
<input type="text" data-table="potongan" data-field="x_pulcep" name="x_pulcep" id="x_pulcep" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($potongan_add->pulcep->getPlaceHolder()) ?>" value="<?php echo $potongan_add->pulcep->EditValue ?>"<?php echo $potongan_add->pulcep->editAttributes() ?>>
</span>
<?php echo $potongan_add->pulcep->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($potongan_add->tidakhadirjam->Visible) { // tidakhadirjam ?>
	<div id="r_tidakhadirjam" class="form-group row">
		<label id="elh_potongan_tidakhadirjam" for="x_tidakhadirjam" class="<?php echo $potongan_add->LeftColumnClass ?>"><?php echo $potongan_add->tidakhadirjam->caption() ?><?php echo $potongan_add->tidakhadirjam->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $potongan_add->RightColumnClass ?>"><div <?php echo $potongan_add->tidakhadirjam->cellAttributes() ?>>
<span id="el_potongan_tidakhadirjam">
<input type="text" data-table="potongan" data-field="x_tidakhadirjam" name="x_tidakhadirjam" id="x_tidakhadirjam" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($potongan_add->tidakhadirjam->getPlaceHolder()) ?>" value="<?php echo $potongan_add->tidakhadirjam->EditValue ?>"<?php echo $potongan_add->tidakhadirjam->editAttributes() ?>>
</span>
<?php echo $potongan_add->tidakhadirjam->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($potongan_add->sakitperjam->Visible) { // sakitperjam ?>
	<div id="r_sakitperjam" class="form-group row">
		<label id="elh_potongan_sakitperjam" for="x_sakitperjam" class="<?php echo $potongan_add->LeftColumnClass ?>"><?php echo $potongan_add->sakitperjam->caption() ?><?php echo $potongan_add->sakitperjam->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $potongan_add->RightColumnClass ?>"><div <?php echo $potongan_add->sakitperjam->cellAttributes() ?>>
<span id="el_potongan_sakitperjam">
<input type="text" data-table="potongan" data-field="x_sakitperjam" name="x_sakitperjam" id="x_sakitperjam" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($potongan_add->sakitperjam->getPlaceHolder()) ?>" value="<?php echo $potongan_add->sakitperjam->EditValue ?>"<?php echo $potongan_add->sakitperjam->editAttributes() ?>>
</span>
<?php echo $potongan_add->sakitperjam->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($potongan_add->izinperjam->Visible) { // izinperjam ?>
	<div id="r_izinperjam" class="form-group row">
		<label id="elh_potongan_izinperjam" for="x_izinperjam" class="<?php echo $potongan_add->LeftColumnClass ?>"><?php echo $potongan_add->izinperjam->caption() ?><?php echo $potongan_add->izinperjam->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $potongan_add->RightColumnClass ?>"><div <?php echo $potongan_add->izinperjam->cellAttributes() ?>>
<span id="el_potongan_izinperjam">
<input type="text" data-table="potongan" data-field="x_izinperjam" name="x_izinperjam" id="x_izinperjam" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($potongan_add->izinperjam->getPlaceHolder()) ?>" value="<?php echo $potongan_add->izinperjam->EditValue ?>"<?php echo $potongan_add->izinperjam->editAttributes() ?>>
</span>
<?php echo $potongan_add->izinperjam->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$potongan_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $potongan_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $potongan_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$potongan_add->showPageFooter();
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
$potongan_add->terminate();
?>