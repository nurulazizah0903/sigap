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
$potongan_smk_add = new potongan_smk_add();

// Run the page
$potongan_smk_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$potongan_smk_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpotongan_smkadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fpotongan_smkadd = currentForm = new ew.Form("fpotongan_smkadd", "add");

	// Validate form
	fpotongan_smkadd.validate = function() {
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
			<?php if ($potongan_smk_add->datetime->Required) { ?>
				elm = this.getElements("x" + infix + "_datetime");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $potongan_smk_add->datetime->caption(), $potongan_smk_add->datetime->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($potongan_smk_add->u_by->Required) { ?>
				elm = this.getElements("x" + infix + "_u_by");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $potongan_smk_add->u_by->caption(), $potongan_smk_add->u_by->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($potongan_smk_add->month->Required) { ?>
				elm = this.getElements("x" + infix + "_month");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $potongan_smk_add->month->caption(), $potongan_smk_add->month->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_month");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($potongan_smk_add->month->errorMessage()) ?>");
			<?php if ($potongan_smk_add->nama->Required) { ?>
				elm = this.getElements("x" + infix + "_nama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $potongan_smk_add->nama->caption(), $potongan_smk_add->nama->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($potongan_smk_add->jenjang_id->Required) { ?>
				elm = this.getElements("x" + infix + "_jenjang_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $potongan_smk_add->jenjang_id->caption(), $potongan_smk_add->jenjang_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jenjang_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($potongan_smk_add->jenjang_id->errorMessage()) ?>");
			<?php if ($potongan_smk_add->jabatan_id->Required) { ?>
				elm = this.getElements("x" + infix + "_jabatan_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $potongan_smk_add->jabatan_id->caption(), $potongan_smk_add->jabatan_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jabatan_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($potongan_smk_add->jabatan_id->errorMessage()) ?>");
			<?php if ($potongan_smk_add->terlambat->Required) { ?>
				elm = this.getElements("x" + infix + "_terlambat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $potongan_smk_add->terlambat->caption(), $potongan_smk_add->terlambat->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_terlambat");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($potongan_smk_add->terlambat->errorMessage()) ?>");
			<?php if ($potongan_smk_add->value_terlambat->Required) { ?>
				elm = this.getElements("x" + infix + "_value_terlambat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $potongan_smk_add->value_terlambat->caption(), $potongan_smk_add->value_terlambat->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_value_terlambat");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($potongan_smk_add->value_terlambat->errorMessage()) ?>");
			<?php if ($potongan_smk_add->izin->Required) { ?>
				elm = this.getElements("x" + infix + "_izin");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $potongan_smk_add->izin->caption(), $potongan_smk_add->izin->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_izin");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($potongan_smk_add->izin->errorMessage()) ?>");
			<?php if ($potongan_smk_add->value_izin->Required) { ?>
				elm = this.getElements("x" + infix + "_value_izin");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $potongan_smk_add->value_izin->caption(), $potongan_smk_add->value_izin->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_value_izin");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($potongan_smk_add->value_izin->errorMessage()) ?>");
			<?php if ($potongan_smk_add->sakit->Required) { ?>
				elm = this.getElements("x" + infix + "_sakit");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $potongan_smk_add->sakit->caption(), $potongan_smk_add->sakit->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_sakit");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($potongan_smk_add->sakit->errorMessage()) ?>");
			<?php if ($potongan_smk_add->value_sakit->Required) { ?>
				elm = this.getElements("x" + infix + "_value_sakit");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $potongan_smk_add->value_sakit->caption(), $potongan_smk_add->value_sakit->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_value_sakit");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($potongan_smk_add->value_sakit->errorMessage()) ?>");
			<?php if ($potongan_smk_add->tidakhadir->Required) { ?>
				elm = this.getElements("x" + infix + "_tidakhadir");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $potongan_smk_add->tidakhadir->caption(), $potongan_smk_add->tidakhadir->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tidakhadir");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($potongan_smk_add->tidakhadir->errorMessage()) ?>");
			<?php if ($potongan_smk_add->value_tidakhadir->Required) { ?>
				elm = this.getElements("x" + infix + "_value_tidakhadir");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $potongan_smk_add->value_tidakhadir->caption(), $potongan_smk_add->value_tidakhadir->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_value_tidakhadir");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($potongan_smk_add->value_tidakhadir->errorMessage()) ?>");
			<?php if ($potongan_smk_add->pulcep->Required) { ?>
				elm = this.getElements("x" + infix + "_pulcep");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $potongan_smk_add->pulcep->caption(), $potongan_smk_add->pulcep->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pulcep");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($potongan_smk_add->pulcep->errorMessage()) ?>");
			<?php if ($potongan_smk_add->value_pulcep->Required) { ?>
				elm = this.getElements("x" + infix + "_value_pulcep");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $potongan_smk_add->value_pulcep->caption(), $potongan_smk_add->value_pulcep->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_value_pulcep");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($potongan_smk_add->value_pulcep->errorMessage()) ?>");
			<?php if ($potongan_smk_add->tidakhadirjam->Required) { ?>
				elm = this.getElements("x" + infix + "_tidakhadirjam");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $potongan_smk_add->tidakhadirjam->caption(), $potongan_smk_add->tidakhadirjam->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tidakhadirjam");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($potongan_smk_add->tidakhadirjam->errorMessage()) ?>");
			<?php if ($potongan_smk_add->tidakhadirjamvalue->Required) { ?>
				elm = this.getElements("x" + infix + "_tidakhadirjamvalue");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $potongan_smk_add->tidakhadirjamvalue->caption(), $potongan_smk_add->tidakhadirjamvalue->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tidakhadirjamvalue");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($potongan_smk_add->tidakhadirjamvalue->errorMessage()) ?>");
			<?php if ($potongan_smk_add->sakitperjam->Required) { ?>
				elm = this.getElements("x" + infix + "_sakitperjam");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $potongan_smk_add->sakitperjam->caption(), $potongan_smk_add->sakitperjam->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_sakitperjam");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($potongan_smk_add->sakitperjam->errorMessage()) ?>");
			<?php if ($potongan_smk_add->sakitperjamvalue->Required) { ?>
				elm = this.getElements("x" + infix + "_sakitperjamvalue");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $potongan_smk_add->sakitperjamvalue->caption(), $potongan_smk_add->sakitperjamvalue->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_sakitperjamvalue");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($potongan_smk_add->sakitperjamvalue->errorMessage()) ?>");
			<?php if ($potongan_smk_add->izinperjam->Required) { ?>
				elm = this.getElements("x" + infix + "_izinperjam");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $potongan_smk_add->izinperjam->caption(), $potongan_smk_add->izinperjam->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_izinperjam");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($potongan_smk_add->izinperjam->errorMessage()) ?>");
			<?php if ($potongan_smk_add->izinperjamvalue->Required) { ?>
				elm = this.getElements("x" + infix + "_izinperjamvalue");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $potongan_smk_add->izinperjamvalue->caption(), $potongan_smk_add->izinperjamvalue->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_izinperjamvalue");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($potongan_smk_add->izinperjamvalue->errorMessage()) ?>");
			<?php if ($potongan_smk_add->totalpotongan->Required) { ?>
				elm = this.getElements("x" + infix + "_totalpotongan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $potongan_smk_add->totalpotongan->caption(), $potongan_smk_add->totalpotongan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_totalpotongan");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($potongan_smk_add->totalpotongan->errorMessage()) ?>");

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
	fpotongan_smkadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpotongan_smkadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fpotongan_smkadd.lists["x_u_by"] = <?php echo $potongan_smk_add->u_by->Lookup->toClientList($potongan_smk_add) ?>;
	fpotongan_smkadd.lists["x_u_by"].options = <?php echo JsonEncode($potongan_smk_add->u_by->lookupOptions()) ?>;
	fpotongan_smkadd.autoSuggests["x_u_by"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fpotongan_smkadd.lists["x_nama"] = <?php echo $potongan_smk_add->nama->Lookup->toClientList($potongan_smk_add) ?>;
	fpotongan_smkadd.lists["x_nama"].options = <?php echo JsonEncode($potongan_smk_add->nama->lookupOptions()) ?>;
	fpotongan_smkadd.lists["x_jenjang_id"] = <?php echo $potongan_smk_add->jenjang_id->Lookup->toClientList($potongan_smk_add) ?>;
	fpotongan_smkadd.lists["x_jenjang_id"].options = <?php echo JsonEncode($potongan_smk_add->jenjang_id->lookupOptions()) ?>;
	fpotongan_smkadd.autoSuggests["x_jenjang_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fpotongan_smkadd.lists["x_jabatan_id"] = <?php echo $potongan_smk_add->jabatan_id->Lookup->toClientList($potongan_smk_add) ?>;
	fpotongan_smkadd.lists["x_jabatan_id"].options = <?php echo JsonEncode($potongan_smk_add->jabatan_id->lookupOptions()) ?>;
	fpotongan_smkadd.autoSuggests["x_jabatan_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fpotongan_smkadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $potongan_smk_add->showPageHeader(); ?>
<?php
$potongan_smk_add->showMessage();
?>
<form name="fpotongan_smkadd" id="fpotongan_smkadd" class="<?php echo $potongan_smk_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="potongan_smk">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$potongan_smk_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($potongan_smk_add->month->Visible) { // month ?>
	<div id="r_month" class="form-group row">
		<label id="elh_potongan_smk_month" for="x_month" class="<?php echo $potongan_smk_add->LeftColumnClass ?>"><?php echo $potongan_smk_add->month->caption() ?><?php echo $potongan_smk_add->month->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $potongan_smk_add->RightColumnClass ?>"><div <?php echo $potongan_smk_add->month->cellAttributes() ?>>
<span id="el_potongan_smk_month">
<input type="text" data-table="potongan_smk" data-field="x_month" name="x_month" id="x_month" maxlength="10" placeholder="<?php echo HtmlEncode($potongan_smk_add->month->getPlaceHolder()) ?>" value="<?php echo $potongan_smk_add->month->EditValue ?>"<?php echo $potongan_smk_add->month->editAttributes() ?>>
<?php if (!$potongan_smk_add->month->ReadOnly && !$potongan_smk_add->month->Disabled && !isset($potongan_smk_add->month->EditAttrs["readonly"]) && !isset($potongan_smk_add->month->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpotongan_smkadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fpotongan_smkadd", "x_month", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $potongan_smk_add->month->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($potongan_smk_add->nama->Visible) { // nama ?>
	<div id="r_nama" class="form-group row">
		<label id="elh_potongan_smk_nama" for="x_nama" class="<?php echo $potongan_smk_add->LeftColumnClass ?>"><?php echo $potongan_smk_add->nama->caption() ?><?php echo $potongan_smk_add->nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $potongan_smk_add->RightColumnClass ?>"><div <?php echo $potongan_smk_add->nama->cellAttributes() ?>>
<span id="el_potongan_smk_nama">
<?php $potongan_smk_add->nama->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_nama"><?php echo EmptyValue(strval($potongan_smk_add->nama->ViewValue)) ? $Language->phrase("PleaseSelect") : $potongan_smk_add->nama->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($potongan_smk_add->nama->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($potongan_smk_add->nama->ReadOnly || $potongan_smk_add->nama->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_nama',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $potongan_smk_add->nama->Lookup->getParamTag($potongan_smk_add, "p_x_nama") ?>
<input type="hidden" data-table="potongan_smk" data-field="x_nama" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $potongan_smk_add->nama->displayValueSeparatorAttribute() ?>" name="x_nama" id="x_nama" value="<?php echo $potongan_smk_add->nama->CurrentValue ?>"<?php echo $potongan_smk_add->nama->editAttributes() ?>>
</span>
<?php echo $potongan_smk_add->nama->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($potongan_smk_add->jenjang_id->Visible) { // jenjang_id ?>
	<div id="r_jenjang_id" class="form-group row">
		<label id="elh_potongan_smk_jenjang_id" class="<?php echo $potongan_smk_add->LeftColumnClass ?>"><?php echo $potongan_smk_add->jenjang_id->caption() ?><?php echo $potongan_smk_add->jenjang_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $potongan_smk_add->RightColumnClass ?>"><div <?php echo $potongan_smk_add->jenjang_id->cellAttributes() ?>>
<span id="el_potongan_smk_jenjang_id">
<?php
$onchange = $potongan_smk_add->jenjang_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$potongan_smk_add->jenjang_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_jenjang_id">
	<input type="text" class="form-control" name="sv_x_jenjang_id" id="sv_x_jenjang_id" value="<?php echo RemoveHtml($potongan_smk_add->jenjang_id->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($potongan_smk_add->jenjang_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($potongan_smk_add->jenjang_id->getPlaceHolder()) ?>"<?php echo $potongan_smk_add->jenjang_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="potongan_smk" data-field="x_jenjang_id" data-value-separator="<?php echo $potongan_smk_add->jenjang_id->displayValueSeparatorAttribute() ?>" name="x_jenjang_id" id="x_jenjang_id" value="<?php echo HtmlEncode($potongan_smk_add->jenjang_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fpotongan_smkadd"], function() {
	fpotongan_smkadd.createAutoSuggest({"id":"x_jenjang_id","forceSelect":false});
});
</script>
<?php echo $potongan_smk_add->jenjang_id->Lookup->getParamTag($potongan_smk_add, "p_x_jenjang_id") ?>
</span>
<?php echo $potongan_smk_add->jenjang_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($potongan_smk_add->jabatan_id->Visible) { // jabatan_id ?>
	<div id="r_jabatan_id" class="form-group row">
		<label id="elh_potongan_smk_jabatan_id" class="<?php echo $potongan_smk_add->LeftColumnClass ?>"><?php echo $potongan_smk_add->jabatan_id->caption() ?><?php echo $potongan_smk_add->jabatan_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $potongan_smk_add->RightColumnClass ?>"><div <?php echo $potongan_smk_add->jabatan_id->cellAttributes() ?>>
<span id="el_potongan_smk_jabatan_id">
<?php
$onchange = $potongan_smk_add->jabatan_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$potongan_smk_add->jabatan_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_jabatan_id">
	<input type="text" class="form-control" name="sv_x_jabatan_id" id="sv_x_jabatan_id" value="<?php echo RemoveHtml($potongan_smk_add->jabatan_id->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($potongan_smk_add->jabatan_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($potongan_smk_add->jabatan_id->getPlaceHolder()) ?>"<?php echo $potongan_smk_add->jabatan_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="potongan_smk" data-field="x_jabatan_id" data-value-separator="<?php echo $potongan_smk_add->jabatan_id->displayValueSeparatorAttribute() ?>" name="x_jabatan_id" id="x_jabatan_id" value="<?php echo HtmlEncode($potongan_smk_add->jabatan_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fpotongan_smkadd"], function() {
	fpotongan_smkadd.createAutoSuggest({"id":"x_jabatan_id","forceSelect":false});
});
</script>
<?php echo $potongan_smk_add->jabatan_id->Lookup->getParamTag($potongan_smk_add, "p_x_jabatan_id") ?>
</span>
<?php echo $potongan_smk_add->jabatan_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($potongan_smk_add->terlambat->Visible) { // terlambat ?>
	<div id="r_terlambat" class="form-group row">
		<label id="elh_potongan_smk_terlambat" for="x_terlambat" class="<?php echo $potongan_smk_add->LeftColumnClass ?>"><?php echo $potongan_smk_add->terlambat->caption() ?><?php echo $potongan_smk_add->terlambat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $potongan_smk_add->RightColumnClass ?>"><div <?php echo $potongan_smk_add->terlambat->cellAttributes() ?>>
<span id="el_potongan_smk_terlambat">
<input type="text" data-table="potongan_smk" data-field="x_terlambat" name="x_terlambat" id="x_terlambat" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($potongan_smk_add->terlambat->getPlaceHolder()) ?>" value="<?php echo $potongan_smk_add->terlambat->EditValue ?>"<?php echo $potongan_smk_add->terlambat->editAttributes() ?>>
</span>
<?php echo $potongan_smk_add->terlambat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($potongan_smk_add->value_terlambat->Visible) { // value_terlambat ?>
	<div id="r_value_terlambat" class="form-group row">
		<label id="elh_potongan_smk_value_terlambat" for="x_value_terlambat" class="<?php echo $potongan_smk_add->LeftColumnClass ?>"><?php echo $potongan_smk_add->value_terlambat->caption() ?><?php echo $potongan_smk_add->value_terlambat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $potongan_smk_add->RightColumnClass ?>"><div <?php echo $potongan_smk_add->value_terlambat->cellAttributes() ?>>
<span id="el_potongan_smk_value_terlambat">
<input type="text" data-table="potongan_smk" data-field="x_value_terlambat" name="x_value_terlambat" id="x_value_terlambat" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($potongan_smk_add->value_terlambat->getPlaceHolder()) ?>" value="<?php echo $potongan_smk_add->value_terlambat->EditValue ?>"<?php echo $potongan_smk_add->value_terlambat->editAttributes() ?>>
</span>
<?php echo $potongan_smk_add->value_terlambat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($potongan_smk_add->izin->Visible) { // izin ?>
	<div id="r_izin" class="form-group row">
		<label id="elh_potongan_smk_izin" for="x_izin" class="<?php echo $potongan_smk_add->LeftColumnClass ?>"><?php echo $potongan_smk_add->izin->caption() ?><?php echo $potongan_smk_add->izin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $potongan_smk_add->RightColumnClass ?>"><div <?php echo $potongan_smk_add->izin->cellAttributes() ?>>
<span id="el_potongan_smk_izin">
<input type="text" data-table="potongan_smk" data-field="x_izin" name="x_izin" id="x_izin" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($potongan_smk_add->izin->getPlaceHolder()) ?>" value="<?php echo $potongan_smk_add->izin->EditValue ?>"<?php echo $potongan_smk_add->izin->editAttributes() ?>>
</span>
<?php echo $potongan_smk_add->izin->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($potongan_smk_add->value_izin->Visible) { // value_izin ?>
	<div id="r_value_izin" class="form-group row">
		<label id="elh_potongan_smk_value_izin" for="x_value_izin" class="<?php echo $potongan_smk_add->LeftColumnClass ?>"><?php echo $potongan_smk_add->value_izin->caption() ?><?php echo $potongan_smk_add->value_izin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $potongan_smk_add->RightColumnClass ?>"><div <?php echo $potongan_smk_add->value_izin->cellAttributes() ?>>
<span id="el_potongan_smk_value_izin">
<input type="text" data-table="potongan_smk" data-field="x_value_izin" name="x_value_izin" id="x_value_izin" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($potongan_smk_add->value_izin->getPlaceHolder()) ?>" value="<?php echo $potongan_smk_add->value_izin->EditValue ?>"<?php echo $potongan_smk_add->value_izin->editAttributes() ?>>
</span>
<?php echo $potongan_smk_add->value_izin->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($potongan_smk_add->sakit->Visible) { // sakit ?>
	<div id="r_sakit" class="form-group row">
		<label id="elh_potongan_smk_sakit" for="x_sakit" class="<?php echo $potongan_smk_add->LeftColumnClass ?>"><?php echo $potongan_smk_add->sakit->caption() ?><?php echo $potongan_smk_add->sakit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $potongan_smk_add->RightColumnClass ?>"><div <?php echo $potongan_smk_add->sakit->cellAttributes() ?>>
<span id="el_potongan_smk_sakit">
<input type="text" data-table="potongan_smk" data-field="x_sakit" name="x_sakit" id="x_sakit" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($potongan_smk_add->sakit->getPlaceHolder()) ?>" value="<?php echo $potongan_smk_add->sakit->EditValue ?>"<?php echo $potongan_smk_add->sakit->editAttributes() ?>>
</span>
<?php echo $potongan_smk_add->sakit->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($potongan_smk_add->value_sakit->Visible) { // value_sakit ?>
	<div id="r_value_sakit" class="form-group row">
		<label id="elh_potongan_smk_value_sakit" for="x_value_sakit" class="<?php echo $potongan_smk_add->LeftColumnClass ?>"><?php echo $potongan_smk_add->value_sakit->caption() ?><?php echo $potongan_smk_add->value_sakit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $potongan_smk_add->RightColumnClass ?>"><div <?php echo $potongan_smk_add->value_sakit->cellAttributes() ?>>
<span id="el_potongan_smk_value_sakit">
<input type="text" data-table="potongan_smk" data-field="x_value_sakit" name="x_value_sakit" id="x_value_sakit" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($potongan_smk_add->value_sakit->getPlaceHolder()) ?>" value="<?php echo $potongan_smk_add->value_sakit->EditValue ?>"<?php echo $potongan_smk_add->value_sakit->editAttributes() ?>>
</span>
<?php echo $potongan_smk_add->value_sakit->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($potongan_smk_add->tidakhadir->Visible) { // tidakhadir ?>
	<div id="r_tidakhadir" class="form-group row">
		<label id="elh_potongan_smk_tidakhadir" for="x_tidakhadir" class="<?php echo $potongan_smk_add->LeftColumnClass ?>"><?php echo $potongan_smk_add->tidakhadir->caption() ?><?php echo $potongan_smk_add->tidakhadir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $potongan_smk_add->RightColumnClass ?>"><div <?php echo $potongan_smk_add->tidakhadir->cellAttributes() ?>>
<span id="el_potongan_smk_tidakhadir">
<input type="text" data-table="potongan_smk" data-field="x_tidakhadir" name="x_tidakhadir" id="x_tidakhadir" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($potongan_smk_add->tidakhadir->getPlaceHolder()) ?>" value="<?php echo $potongan_smk_add->tidakhadir->EditValue ?>"<?php echo $potongan_smk_add->tidakhadir->editAttributes() ?>>
</span>
<?php echo $potongan_smk_add->tidakhadir->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($potongan_smk_add->value_tidakhadir->Visible) { // value_tidakhadir ?>
	<div id="r_value_tidakhadir" class="form-group row">
		<label id="elh_potongan_smk_value_tidakhadir" for="x_value_tidakhadir" class="<?php echo $potongan_smk_add->LeftColumnClass ?>"><?php echo $potongan_smk_add->value_tidakhadir->caption() ?><?php echo $potongan_smk_add->value_tidakhadir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $potongan_smk_add->RightColumnClass ?>"><div <?php echo $potongan_smk_add->value_tidakhadir->cellAttributes() ?>>
<span id="el_potongan_smk_value_tidakhadir">
<input type="text" data-table="potongan_smk" data-field="x_value_tidakhadir" name="x_value_tidakhadir" id="x_value_tidakhadir" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($potongan_smk_add->value_tidakhadir->getPlaceHolder()) ?>" value="<?php echo $potongan_smk_add->value_tidakhadir->EditValue ?>"<?php echo $potongan_smk_add->value_tidakhadir->editAttributes() ?>>
</span>
<?php echo $potongan_smk_add->value_tidakhadir->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($potongan_smk_add->pulcep->Visible) { // pulcep ?>
	<div id="r_pulcep" class="form-group row">
		<label id="elh_potongan_smk_pulcep" for="x_pulcep" class="<?php echo $potongan_smk_add->LeftColumnClass ?>"><?php echo $potongan_smk_add->pulcep->caption() ?><?php echo $potongan_smk_add->pulcep->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $potongan_smk_add->RightColumnClass ?>"><div <?php echo $potongan_smk_add->pulcep->cellAttributes() ?>>
<span id="el_potongan_smk_pulcep">
<input type="text" data-table="potongan_smk" data-field="x_pulcep" name="x_pulcep" id="x_pulcep" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($potongan_smk_add->pulcep->getPlaceHolder()) ?>" value="<?php echo $potongan_smk_add->pulcep->EditValue ?>"<?php echo $potongan_smk_add->pulcep->editAttributes() ?>>
</span>
<?php echo $potongan_smk_add->pulcep->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($potongan_smk_add->value_pulcep->Visible) { // value_pulcep ?>
	<div id="r_value_pulcep" class="form-group row">
		<label id="elh_potongan_smk_value_pulcep" for="x_value_pulcep" class="<?php echo $potongan_smk_add->LeftColumnClass ?>"><?php echo $potongan_smk_add->value_pulcep->caption() ?><?php echo $potongan_smk_add->value_pulcep->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $potongan_smk_add->RightColumnClass ?>"><div <?php echo $potongan_smk_add->value_pulcep->cellAttributes() ?>>
<span id="el_potongan_smk_value_pulcep">
<input type="text" data-table="potongan_smk" data-field="x_value_pulcep" name="x_value_pulcep" id="x_value_pulcep" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($potongan_smk_add->value_pulcep->getPlaceHolder()) ?>" value="<?php echo $potongan_smk_add->value_pulcep->EditValue ?>"<?php echo $potongan_smk_add->value_pulcep->editAttributes() ?>>
</span>
<?php echo $potongan_smk_add->value_pulcep->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($potongan_smk_add->tidakhadirjam->Visible) { // tidakhadirjam ?>
	<div id="r_tidakhadirjam" class="form-group row">
		<label id="elh_potongan_smk_tidakhadirjam" for="x_tidakhadirjam" class="<?php echo $potongan_smk_add->LeftColumnClass ?>"><?php echo $potongan_smk_add->tidakhadirjam->caption() ?><?php echo $potongan_smk_add->tidakhadirjam->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $potongan_smk_add->RightColumnClass ?>"><div <?php echo $potongan_smk_add->tidakhadirjam->cellAttributes() ?>>
<span id="el_potongan_smk_tidakhadirjam">
<input type="text" data-table="potongan_smk" data-field="x_tidakhadirjam" name="x_tidakhadirjam" id="x_tidakhadirjam" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($potongan_smk_add->tidakhadirjam->getPlaceHolder()) ?>" value="<?php echo $potongan_smk_add->tidakhadirjam->EditValue ?>"<?php echo $potongan_smk_add->tidakhadirjam->editAttributes() ?>>
</span>
<?php echo $potongan_smk_add->tidakhadirjam->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($potongan_smk_add->tidakhadirjamvalue->Visible) { // tidakhadirjamvalue ?>
	<div id="r_tidakhadirjamvalue" class="form-group row">
		<label id="elh_potongan_smk_tidakhadirjamvalue" for="x_tidakhadirjamvalue" class="<?php echo $potongan_smk_add->LeftColumnClass ?>"><?php echo $potongan_smk_add->tidakhadirjamvalue->caption() ?><?php echo $potongan_smk_add->tidakhadirjamvalue->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $potongan_smk_add->RightColumnClass ?>"><div <?php echo $potongan_smk_add->tidakhadirjamvalue->cellAttributes() ?>>
<span id="el_potongan_smk_tidakhadirjamvalue">
<input type="text" data-table="potongan_smk" data-field="x_tidakhadirjamvalue" name="x_tidakhadirjamvalue" id="x_tidakhadirjamvalue" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($potongan_smk_add->tidakhadirjamvalue->getPlaceHolder()) ?>" value="<?php echo $potongan_smk_add->tidakhadirjamvalue->EditValue ?>"<?php echo $potongan_smk_add->tidakhadirjamvalue->editAttributes() ?>>
</span>
<?php echo $potongan_smk_add->tidakhadirjamvalue->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($potongan_smk_add->sakitperjam->Visible) { // sakitperjam ?>
	<div id="r_sakitperjam" class="form-group row">
		<label id="elh_potongan_smk_sakitperjam" for="x_sakitperjam" class="<?php echo $potongan_smk_add->LeftColumnClass ?>"><?php echo $potongan_smk_add->sakitperjam->caption() ?><?php echo $potongan_smk_add->sakitperjam->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $potongan_smk_add->RightColumnClass ?>"><div <?php echo $potongan_smk_add->sakitperjam->cellAttributes() ?>>
<span id="el_potongan_smk_sakitperjam">
<input type="text" data-table="potongan_smk" data-field="x_sakitperjam" name="x_sakitperjam" id="x_sakitperjam" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($potongan_smk_add->sakitperjam->getPlaceHolder()) ?>" value="<?php echo $potongan_smk_add->sakitperjam->EditValue ?>"<?php echo $potongan_smk_add->sakitperjam->editAttributes() ?>>
</span>
<?php echo $potongan_smk_add->sakitperjam->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($potongan_smk_add->sakitperjamvalue->Visible) { // sakitperjamvalue ?>
	<div id="r_sakitperjamvalue" class="form-group row">
		<label id="elh_potongan_smk_sakitperjamvalue" for="x_sakitperjamvalue" class="<?php echo $potongan_smk_add->LeftColumnClass ?>"><?php echo $potongan_smk_add->sakitperjamvalue->caption() ?><?php echo $potongan_smk_add->sakitperjamvalue->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $potongan_smk_add->RightColumnClass ?>"><div <?php echo $potongan_smk_add->sakitperjamvalue->cellAttributes() ?>>
<span id="el_potongan_smk_sakitperjamvalue">
<input type="text" data-table="potongan_smk" data-field="x_sakitperjamvalue" name="x_sakitperjamvalue" id="x_sakitperjamvalue" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($potongan_smk_add->sakitperjamvalue->getPlaceHolder()) ?>" value="<?php echo $potongan_smk_add->sakitperjamvalue->EditValue ?>"<?php echo $potongan_smk_add->sakitperjamvalue->editAttributes() ?>>
</span>
<?php echo $potongan_smk_add->sakitperjamvalue->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($potongan_smk_add->izinperjam->Visible) { // izinperjam ?>
	<div id="r_izinperjam" class="form-group row">
		<label id="elh_potongan_smk_izinperjam" for="x_izinperjam" class="<?php echo $potongan_smk_add->LeftColumnClass ?>"><?php echo $potongan_smk_add->izinperjam->caption() ?><?php echo $potongan_smk_add->izinperjam->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $potongan_smk_add->RightColumnClass ?>"><div <?php echo $potongan_smk_add->izinperjam->cellAttributes() ?>>
<span id="el_potongan_smk_izinperjam">
<input type="text" data-table="potongan_smk" data-field="x_izinperjam" name="x_izinperjam" id="x_izinperjam" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($potongan_smk_add->izinperjam->getPlaceHolder()) ?>" value="<?php echo $potongan_smk_add->izinperjam->EditValue ?>"<?php echo $potongan_smk_add->izinperjam->editAttributes() ?>>
</span>
<?php echo $potongan_smk_add->izinperjam->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($potongan_smk_add->izinperjamvalue->Visible) { // izinperjamvalue ?>
	<div id="r_izinperjamvalue" class="form-group row">
		<label id="elh_potongan_smk_izinperjamvalue" for="x_izinperjamvalue" class="<?php echo $potongan_smk_add->LeftColumnClass ?>"><?php echo $potongan_smk_add->izinperjamvalue->caption() ?><?php echo $potongan_smk_add->izinperjamvalue->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $potongan_smk_add->RightColumnClass ?>"><div <?php echo $potongan_smk_add->izinperjamvalue->cellAttributes() ?>>
<span id="el_potongan_smk_izinperjamvalue">
<input type="text" data-table="potongan_smk" data-field="x_izinperjamvalue" name="x_izinperjamvalue" id="x_izinperjamvalue" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($potongan_smk_add->izinperjamvalue->getPlaceHolder()) ?>" value="<?php echo $potongan_smk_add->izinperjamvalue->EditValue ?>"<?php echo $potongan_smk_add->izinperjamvalue->editAttributes() ?>>
</span>
<?php echo $potongan_smk_add->izinperjamvalue->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($potongan_smk_add->totalpotongan->Visible) { // totalpotongan ?>
	<div id="r_totalpotongan" class="form-group row">
		<label id="elh_potongan_smk_totalpotongan" for="x_totalpotongan" class="<?php echo $potongan_smk_add->LeftColumnClass ?>"><?php echo $potongan_smk_add->totalpotongan->caption() ?><?php echo $potongan_smk_add->totalpotongan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $potongan_smk_add->RightColumnClass ?>"><div <?php echo $potongan_smk_add->totalpotongan->cellAttributes() ?>>
<span id="el_potongan_smk_totalpotongan">
<input type="text" data-table="potongan_smk" data-field="x_totalpotongan" name="x_totalpotongan" id="x_totalpotongan" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($potongan_smk_add->totalpotongan->getPlaceHolder()) ?>" value="<?php echo $potongan_smk_add->totalpotongan->EditValue ?>"<?php echo $potongan_smk_add->totalpotongan->editAttributes() ?>>
</span>
<?php echo $potongan_smk_add->totalpotongan->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$potongan_smk_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $potongan_smk_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $potongan_smk_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$potongan_smk_add->showPageFooter();
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
$potongan_smk_add->terminate();
?>