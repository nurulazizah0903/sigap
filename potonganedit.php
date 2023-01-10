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
$potongan_edit = new potongan_edit();

// Run the page
$potongan_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$potongan_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpotonganedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fpotonganedit = currentForm = new ew.Form("fpotonganedit", "edit");

	// Validate form
	fpotonganedit.validate = function() {
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
			<?php if ($potongan_edit->datetime->Required) { ?>
				elm = this.getElements("x" + infix + "_datetime");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $potongan_edit->datetime->caption(), $potongan_edit->datetime->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($potongan_edit->u_by->Required) { ?>
				elm = this.getElements("x" + infix + "_u_by");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $potongan_edit->u_by->caption(), $potongan_edit->u_by->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($potongan_edit->month->Required) { ?>
				elm = this.getElements("x" + infix + "_month");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $potongan_edit->month->caption(), $potongan_edit->month->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_month");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($potongan_edit->month->errorMessage()) ?>");
			<?php if ($potongan_edit->nama->Required) { ?>
				elm = this.getElements("x" + infix + "_nama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $potongan_edit->nama->caption(), $potongan_edit->nama->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($potongan_edit->jenjang_id->Required) { ?>
				elm = this.getElements("x" + infix + "_jenjang_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $potongan_edit->jenjang_id->caption(), $potongan_edit->jenjang_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($potongan_edit->jabatan_id->Required) { ?>
				elm = this.getElements("x" + infix + "_jabatan_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $potongan_edit->jabatan_id->caption(), $potongan_edit->jabatan_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($potongan_edit->terlambat->Required) { ?>
				elm = this.getElements("x" + infix + "_terlambat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $potongan_edit->terlambat->caption(), $potongan_edit->terlambat->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_terlambat");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($potongan_edit->terlambat->errorMessage()) ?>");
			<?php if ($potongan_edit->value_terlambat->Required) { ?>
				elm = this.getElements("x" + infix + "_value_terlambat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $potongan_edit->value_terlambat->caption(), $potongan_edit->value_terlambat->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_value_terlambat");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($potongan_edit->value_terlambat->errorMessage()) ?>");
			<?php if ($potongan_edit->izin->Required) { ?>
				elm = this.getElements("x" + infix + "_izin");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $potongan_edit->izin->caption(), $potongan_edit->izin->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_izin");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($potongan_edit->izin->errorMessage()) ?>");
			<?php if ($potongan_edit->value_izin->Required) { ?>
				elm = this.getElements("x" + infix + "_value_izin");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $potongan_edit->value_izin->caption(), $potongan_edit->value_izin->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_value_izin");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($potongan_edit->value_izin->errorMessage()) ?>");
			<?php if ($potongan_edit->sakit->Required) { ?>
				elm = this.getElements("x" + infix + "_sakit");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $potongan_edit->sakit->caption(), $potongan_edit->sakit->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_sakit");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($potongan_edit->sakit->errorMessage()) ?>");
			<?php if ($potongan_edit->tidakhadir->Required) { ?>
				elm = this.getElements("x" + infix + "_tidakhadir");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $potongan_edit->tidakhadir->caption(), $potongan_edit->tidakhadir->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tidakhadir");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($potongan_edit->tidakhadir->errorMessage()) ?>");
			<?php if ($potongan_edit->pulcep->Required) { ?>
				elm = this.getElements("x" + infix + "_pulcep");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $potongan_edit->pulcep->caption(), $potongan_edit->pulcep->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pulcep");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($potongan_edit->pulcep->errorMessage()) ?>");
			<?php if ($potongan_edit->value_pulcep->Required) { ?>
				elm = this.getElements("x" + infix + "_value_pulcep");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $potongan_edit->value_pulcep->caption(), $potongan_edit->value_pulcep->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_value_pulcep");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($potongan_edit->value_pulcep->errorMessage()) ?>");
			<?php if ($potongan_edit->tidakhadirjam->Required) { ?>
				elm = this.getElements("x" + infix + "_tidakhadirjam");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $potongan_edit->tidakhadirjam->caption(), $potongan_edit->tidakhadirjam->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tidakhadirjam");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($potongan_edit->tidakhadirjam->errorMessage()) ?>");
			<?php if ($potongan_edit->tidakhadirjamvalue->Required) { ?>
				elm = this.getElements("x" + infix + "_tidakhadirjamvalue");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $potongan_edit->tidakhadirjamvalue->caption(), $potongan_edit->tidakhadirjamvalue->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tidakhadirjamvalue");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($potongan_edit->tidakhadirjamvalue->errorMessage()) ?>");
			<?php if ($potongan_edit->sakitperjam->Required) { ?>
				elm = this.getElements("x" + infix + "_sakitperjam");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $potongan_edit->sakitperjam->caption(), $potongan_edit->sakitperjam->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_sakitperjam");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($potongan_edit->sakitperjam->errorMessage()) ?>");
			<?php if ($potongan_edit->sakitperjamvalue->Required) { ?>
				elm = this.getElements("x" + infix + "_sakitperjamvalue");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $potongan_edit->sakitperjamvalue->caption(), $potongan_edit->sakitperjamvalue->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_sakitperjamvalue");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($potongan_edit->sakitperjamvalue->errorMessage()) ?>");
			<?php if ($potongan_edit->izinperjam->Required) { ?>
				elm = this.getElements("x" + infix + "_izinperjam");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $potongan_edit->izinperjam->caption(), $potongan_edit->izinperjam->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_izinperjam");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($potongan_edit->izinperjam->errorMessage()) ?>");
			<?php if ($potongan_edit->izinperjamvalue->Required) { ?>
				elm = this.getElements("x" + infix + "_izinperjamvalue");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $potongan_edit->izinperjamvalue->caption(), $potongan_edit->izinperjamvalue->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_izinperjamvalue");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($potongan_edit->izinperjamvalue->errorMessage()) ?>");
			<?php if ($potongan_edit->totalpotongan->Required) { ?>
				elm = this.getElements("x" + infix + "_totalpotongan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $potongan_edit->totalpotongan->caption(), $potongan_edit->totalpotongan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_totalpotongan");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($potongan_edit->totalpotongan->errorMessage()) ?>");

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
	fpotonganedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpotonganedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fpotonganedit.lists["x_u_by"] = <?php echo $potongan_edit->u_by->Lookup->toClientList($potongan_edit) ?>;
	fpotonganedit.lists["x_u_by"].options = <?php echo JsonEncode($potongan_edit->u_by->lookupOptions()) ?>;
	fpotonganedit.autoSuggests["x_u_by"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fpotonganedit.lists["x_nama"] = <?php echo $potongan_edit->nama->Lookup->toClientList($potongan_edit) ?>;
	fpotonganedit.lists["x_nama"].options = <?php echo JsonEncode($potongan_edit->nama->lookupOptions()) ?>;
	loadjs.done("fpotonganedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $potongan_edit->showPageHeader(); ?>
<?php
$potongan_edit->showMessage();
?>
<form name="fpotonganedit" id="fpotonganedit" class="<?php echo $potongan_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="potongan">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$potongan_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($potongan_edit->month->Visible) { // month ?>
	<div id="r_month" class="form-group row">
		<label id="elh_potongan_month" for="x_month" class="<?php echo $potongan_edit->LeftColumnClass ?>"><?php echo $potongan_edit->month->caption() ?><?php echo $potongan_edit->month->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $potongan_edit->RightColumnClass ?>"><div <?php echo $potongan_edit->month->cellAttributes() ?>>
<span id="el_potongan_month">
<input type="text" data-table="potongan" data-field="x_month" name="x_month" id="x_month" maxlength="10" placeholder="<?php echo HtmlEncode($potongan_edit->month->getPlaceHolder()) ?>" value="<?php echo $potongan_edit->month->EditValue ?>"<?php echo $potongan_edit->month->editAttributes() ?>>
<?php if (!$potongan_edit->month->ReadOnly && !$potongan_edit->month->Disabled && !isset($potongan_edit->month->EditAttrs["readonly"]) && !isset($potongan_edit->month->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpotonganedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fpotonganedit", "x_month", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $potongan_edit->month->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($potongan_edit->nama->Visible) { // nama ?>
	<div id="r_nama" class="form-group row">
		<label id="elh_potongan_nama" for="x_nama" class="<?php echo $potongan_edit->LeftColumnClass ?>"><?php echo $potongan_edit->nama->caption() ?><?php echo $potongan_edit->nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $potongan_edit->RightColumnClass ?>"><div <?php echo $potongan_edit->nama->cellAttributes() ?>>
<span id="el_potongan_nama">
<?php $potongan_edit->nama->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_nama"><?php echo EmptyValue(strval($potongan_edit->nama->ViewValue)) ? $Language->phrase("PleaseSelect") : $potongan_edit->nama->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($potongan_edit->nama->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($potongan_edit->nama->ReadOnly || $potongan_edit->nama->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_nama',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $potongan_edit->nama->Lookup->getParamTag($potongan_edit, "p_x_nama") ?>
<input type="hidden" data-table="potongan" data-field="x_nama" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $potongan_edit->nama->displayValueSeparatorAttribute() ?>" name="x_nama" id="x_nama" value="<?php echo $potongan_edit->nama->CurrentValue ?>"<?php echo $potongan_edit->nama->editAttributes() ?>>
</span>
<?php echo $potongan_edit->nama->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($potongan_edit->jenjang_id->Visible) { // jenjang_id ?>
	<div id="r_jenjang_id" class="form-group row">
		<label id="elh_potongan_jenjang_id" class="<?php echo $potongan_edit->LeftColumnClass ?>"><?php echo $potongan_edit->jenjang_id->caption() ?><?php echo $potongan_edit->jenjang_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $potongan_edit->RightColumnClass ?>"><div <?php echo $potongan_edit->jenjang_id->cellAttributes() ?>>
<span id="el_potongan_jenjang_id">
<span<?php echo $potongan_edit->jenjang_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($potongan_edit->jenjang_id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="potongan" data-field="x_jenjang_id" name="x_jenjang_id" id="x_jenjang_id" value="<?php echo HtmlEncode($potongan_edit->jenjang_id->CurrentValue) ?>">
<?php echo $potongan_edit->jenjang_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($potongan_edit->jabatan_id->Visible) { // jabatan_id ?>
	<div id="r_jabatan_id" class="form-group row">
		<label id="elh_potongan_jabatan_id" class="<?php echo $potongan_edit->LeftColumnClass ?>"><?php echo $potongan_edit->jabatan_id->caption() ?><?php echo $potongan_edit->jabatan_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $potongan_edit->RightColumnClass ?>"><div <?php echo $potongan_edit->jabatan_id->cellAttributes() ?>>
<span id="el_potongan_jabatan_id">
<span<?php echo $potongan_edit->jabatan_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($potongan_edit->jabatan_id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="potongan" data-field="x_jabatan_id" name="x_jabatan_id" id="x_jabatan_id" value="<?php echo HtmlEncode($potongan_edit->jabatan_id->CurrentValue) ?>">
<?php echo $potongan_edit->jabatan_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($potongan_edit->terlambat->Visible) { // terlambat ?>
	<div id="r_terlambat" class="form-group row">
		<label id="elh_potongan_terlambat" for="x_terlambat" class="<?php echo $potongan_edit->LeftColumnClass ?>"><?php echo $potongan_edit->terlambat->caption() ?><?php echo $potongan_edit->terlambat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $potongan_edit->RightColumnClass ?>"><div <?php echo $potongan_edit->terlambat->cellAttributes() ?>>
<span id="el_potongan_terlambat">
<input type="text" data-table="potongan" data-field="x_terlambat" name="x_terlambat" id="x_terlambat" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($potongan_edit->terlambat->getPlaceHolder()) ?>" value="<?php echo $potongan_edit->terlambat->EditValue ?>"<?php echo $potongan_edit->terlambat->editAttributes() ?>>
</span>
<?php echo $potongan_edit->terlambat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($potongan_edit->value_terlambat->Visible) { // value_terlambat ?>
	<div id="r_value_terlambat" class="form-group row">
		<label id="elh_potongan_value_terlambat" for="x_value_terlambat" class="<?php echo $potongan_edit->LeftColumnClass ?>"><?php echo $potongan_edit->value_terlambat->caption() ?><?php echo $potongan_edit->value_terlambat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $potongan_edit->RightColumnClass ?>"><div <?php echo $potongan_edit->value_terlambat->cellAttributes() ?>>
<span id="el_potongan_value_terlambat">
<input type="text" data-table="potongan" data-field="x_value_terlambat" name="x_value_terlambat" id="x_value_terlambat" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($potongan_edit->value_terlambat->getPlaceHolder()) ?>" value="<?php echo $potongan_edit->value_terlambat->EditValue ?>"<?php echo $potongan_edit->value_terlambat->editAttributes() ?>>
</span>
<?php echo $potongan_edit->value_terlambat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($potongan_edit->izin->Visible) { // izin ?>
	<div id="r_izin" class="form-group row">
		<label id="elh_potongan_izin" for="x_izin" class="<?php echo $potongan_edit->LeftColumnClass ?>"><?php echo $potongan_edit->izin->caption() ?><?php echo $potongan_edit->izin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $potongan_edit->RightColumnClass ?>"><div <?php echo $potongan_edit->izin->cellAttributes() ?>>
<span id="el_potongan_izin">
<input type="text" data-table="potongan" data-field="x_izin" name="x_izin" id="x_izin" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($potongan_edit->izin->getPlaceHolder()) ?>" value="<?php echo $potongan_edit->izin->EditValue ?>"<?php echo $potongan_edit->izin->editAttributes() ?>>
</span>
<?php echo $potongan_edit->izin->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($potongan_edit->value_izin->Visible) { // value_izin ?>
	<div id="r_value_izin" class="form-group row">
		<label id="elh_potongan_value_izin" for="x_value_izin" class="<?php echo $potongan_edit->LeftColumnClass ?>"><?php echo $potongan_edit->value_izin->caption() ?><?php echo $potongan_edit->value_izin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $potongan_edit->RightColumnClass ?>"><div <?php echo $potongan_edit->value_izin->cellAttributes() ?>>
<span id="el_potongan_value_izin">
<input type="text" data-table="potongan" data-field="x_value_izin" name="x_value_izin" id="x_value_izin" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($potongan_edit->value_izin->getPlaceHolder()) ?>" value="<?php echo $potongan_edit->value_izin->EditValue ?>"<?php echo $potongan_edit->value_izin->editAttributes() ?>>
</span>
<?php echo $potongan_edit->value_izin->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($potongan_edit->sakit->Visible) { // sakit ?>
	<div id="r_sakit" class="form-group row">
		<label id="elh_potongan_sakit" for="x_sakit" class="<?php echo $potongan_edit->LeftColumnClass ?>"><?php echo $potongan_edit->sakit->caption() ?><?php echo $potongan_edit->sakit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $potongan_edit->RightColumnClass ?>"><div <?php echo $potongan_edit->sakit->cellAttributes() ?>>
<span id="el_potongan_sakit">
<input type="text" data-table="potongan" data-field="x_sakit" name="x_sakit" id="x_sakit" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($potongan_edit->sakit->getPlaceHolder()) ?>" value="<?php echo $potongan_edit->sakit->EditValue ?>"<?php echo $potongan_edit->sakit->editAttributes() ?>>
</span>
<?php echo $potongan_edit->sakit->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($potongan_edit->tidakhadir->Visible) { // tidakhadir ?>
	<div id="r_tidakhadir" class="form-group row">
		<label id="elh_potongan_tidakhadir" for="x_tidakhadir" class="<?php echo $potongan_edit->LeftColumnClass ?>"><?php echo $potongan_edit->tidakhadir->caption() ?><?php echo $potongan_edit->tidakhadir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $potongan_edit->RightColumnClass ?>"><div <?php echo $potongan_edit->tidakhadir->cellAttributes() ?>>
<span id="el_potongan_tidakhadir">
<input type="text" data-table="potongan" data-field="x_tidakhadir" name="x_tidakhadir" id="x_tidakhadir" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($potongan_edit->tidakhadir->getPlaceHolder()) ?>" value="<?php echo $potongan_edit->tidakhadir->EditValue ?>"<?php echo $potongan_edit->tidakhadir->editAttributes() ?>>
</span>
<?php echo $potongan_edit->tidakhadir->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($potongan_edit->pulcep->Visible) { // pulcep ?>
	<div id="r_pulcep" class="form-group row">
		<label id="elh_potongan_pulcep" for="x_pulcep" class="<?php echo $potongan_edit->LeftColumnClass ?>"><?php echo $potongan_edit->pulcep->caption() ?><?php echo $potongan_edit->pulcep->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $potongan_edit->RightColumnClass ?>"><div <?php echo $potongan_edit->pulcep->cellAttributes() ?>>
<span id="el_potongan_pulcep">
<input type="text" data-table="potongan" data-field="x_pulcep" name="x_pulcep" id="x_pulcep" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($potongan_edit->pulcep->getPlaceHolder()) ?>" value="<?php echo $potongan_edit->pulcep->EditValue ?>"<?php echo $potongan_edit->pulcep->editAttributes() ?>>
</span>
<?php echo $potongan_edit->pulcep->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($potongan_edit->value_pulcep->Visible) { // value_pulcep ?>
	<div id="r_value_pulcep" class="form-group row">
		<label id="elh_potongan_value_pulcep" for="x_value_pulcep" class="<?php echo $potongan_edit->LeftColumnClass ?>"><?php echo $potongan_edit->value_pulcep->caption() ?><?php echo $potongan_edit->value_pulcep->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $potongan_edit->RightColumnClass ?>"><div <?php echo $potongan_edit->value_pulcep->cellAttributes() ?>>
<span id="el_potongan_value_pulcep">
<input type="text" data-table="potongan" data-field="x_value_pulcep" name="x_value_pulcep" id="x_value_pulcep" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($potongan_edit->value_pulcep->getPlaceHolder()) ?>" value="<?php echo $potongan_edit->value_pulcep->EditValue ?>"<?php echo $potongan_edit->value_pulcep->editAttributes() ?>>
</span>
<?php echo $potongan_edit->value_pulcep->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($potongan_edit->tidakhadirjam->Visible) { // tidakhadirjam ?>
	<div id="r_tidakhadirjam" class="form-group row">
		<label id="elh_potongan_tidakhadirjam" for="x_tidakhadirjam" class="<?php echo $potongan_edit->LeftColumnClass ?>"><?php echo $potongan_edit->tidakhadirjam->caption() ?><?php echo $potongan_edit->tidakhadirjam->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $potongan_edit->RightColumnClass ?>"><div <?php echo $potongan_edit->tidakhadirjam->cellAttributes() ?>>
<span id="el_potongan_tidakhadirjam">
<input type="text" data-table="potongan" data-field="x_tidakhadirjam" name="x_tidakhadirjam" id="x_tidakhadirjam" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($potongan_edit->tidakhadirjam->getPlaceHolder()) ?>" value="<?php echo $potongan_edit->tidakhadirjam->EditValue ?>"<?php echo $potongan_edit->tidakhadirjam->editAttributes() ?>>
</span>
<?php echo $potongan_edit->tidakhadirjam->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($potongan_edit->tidakhadirjamvalue->Visible) { // tidakhadirjamvalue ?>
	<div id="r_tidakhadirjamvalue" class="form-group row">
		<label id="elh_potongan_tidakhadirjamvalue" for="x_tidakhadirjamvalue" class="<?php echo $potongan_edit->LeftColumnClass ?>"><?php echo $potongan_edit->tidakhadirjamvalue->caption() ?><?php echo $potongan_edit->tidakhadirjamvalue->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $potongan_edit->RightColumnClass ?>"><div <?php echo $potongan_edit->tidakhadirjamvalue->cellAttributes() ?>>
<span id="el_potongan_tidakhadirjamvalue">
<input type="text" data-table="potongan" data-field="x_tidakhadirjamvalue" name="x_tidakhadirjamvalue" id="x_tidakhadirjamvalue" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($potongan_edit->tidakhadirjamvalue->getPlaceHolder()) ?>" value="<?php echo $potongan_edit->tidakhadirjamvalue->EditValue ?>"<?php echo $potongan_edit->tidakhadirjamvalue->editAttributes() ?>>
</span>
<?php echo $potongan_edit->tidakhadirjamvalue->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($potongan_edit->sakitperjam->Visible) { // sakitperjam ?>
	<div id="r_sakitperjam" class="form-group row">
		<label id="elh_potongan_sakitperjam" for="x_sakitperjam" class="<?php echo $potongan_edit->LeftColumnClass ?>"><?php echo $potongan_edit->sakitperjam->caption() ?><?php echo $potongan_edit->sakitperjam->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $potongan_edit->RightColumnClass ?>"><div <?php echo $potongan_edit->sakitperjam->cellAttributes() ?>>
<span id="el_potongan_sakitperjam">
<input type="text" data-table="potongan" data-field="x_sakitperjam" name="x_sakitperjam" id="x_sakitperjam" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($potongan_edit->sakitperjam->getPlaceHolder()) ?>" value="<?php echo $potongan_edit->sakitperjam->EditValue ?>"<?php echo $potongan_edit->sakitperjam->editAttributes() ?>>
</span>
<?php echo $potongan_edit->sakitperjam->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($potongan_edit->sakitperjamvalue->Visible) { // sakitperjamvalue ?>
	<div id="r_sakitperjamvalue" class="form-group row">
		<label id="elh_potongan_sakitperjamvalue" for="x_sakitperjamvalue" class="<?php echo $potongan_edit->LeftColumnClass ?>"><?php echo $potongan_edit->sakitperjamvalue->caption() ?><?php echo $potongan_edit->sakitperjamvalue->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $potongan_edit->RightColumnClass ?>"><div <?php echo $potongan_edit->sakitperjamvalue->cellAttributes() ?>>
<span id="el_potongan_sakitperjamvalue">
<input type="text" data-table="potongan" data-field="x_sakitperjamvalue" name="x_sakitperjamvalue" id="x_sakitperjamvalue" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($potongan_edit->sakitperjamvalue->getPlaceHolder()) ?>" value="<?php echo $potongan_edit->sakitperjamvalue->EditValue ?>"<?php echo $potongan_edit->sakitperjamvalue->editAttributes() ?>>
</span>
<?php echo $potongan_edit->sakitperjamvalue->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($potongan_edit->izinperjam->Visible) { // izinperjam ?>
	<div id="r_izinperjam" class="form-group row">
		<label id="elh_potongan_izinperjam" for="x_izinperjam" class="<?php echo $potongan_edit->LeftColumnClass ?>"><?php echo $potongan_edit->izinperjam->caption() ?><?php echo $potongan_edit->izinperjam->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $potongan_edit->RightColumnClass ?>"><div <?php echo $potongan_edit->izinperjam->cellAttributes() ?>>
<span id="el_potongan_izinperjam">
<input type="text" data-table="potongan" data-field="x_izinperjam" name="x_izinperjam" id="x_izinperjam" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($potongan_edit->izinperjam->getPlaceHolder()) ?>" value="<?php echo $potongan_edit->izinperjam->EditValue ?>"<?php echo $potongan_edit->izinperjam->editAttributes() ?>>
</span>
<?php echo $potongan_edit->izinperjam->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($potongan_edit->izinperjamvalue->Visible) { // izinperjamvalue ?>
	<div id="r_izinperjamvalue" class="form-group row">
		<label id="elh_potongan_izinperjamvalue" for="x_izinperjamvalue" class="<?php echo $potongan_edit->LeftColumnClass ?>"><?php echo $potongan_edit->izinperjamvalue->caption() ?><?php echo $potongan_edit->izinperjamvalue->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $potongan_edit->RightColumnClass ?>"><div <?php echo $potongan_edit->izinperjamvalue->cellAttributes() ?>>
<span id="el_potongan_izinperjamvalue">
<input type="text" data-table="potongan" data-field="x_izinperjamvalue" name="x_izinperjamvalue" id="x_izinperjamvalue" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($potongan_edit->izinperjamvalue->getPlaceHolder()) ?>" value="<?php echo $potongan_edit->izinperjamvalue->EditValue ?>"<?php echo $potongan_edit->izinperjamvalue->editAttributes() ?>>
</span>
<?php echo $potongan_edit->izinperjamvalue->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($potongan_edit->totalpotongan->Visible) { // totalpotongan ?>
	<div id="r_totalpotongan" class="form-group row">
		<label id="elh_potongan_totalpotongan" for="x_totalpotongan" class="<?php echo $potongan_edit->LeftColumnClass ?>"><?php echo $potongan_edit->totalpotongan->caption() ?><?php echo $potongan_edit->totalpotongan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $potongan_edit->RightColumnClass ?>"><div <?php echo $potongan_edit->totalpotongan->cellAttributes() ?>>
<span id="el_potongan_totalpotongan">
<input type="text" data-table="potongan" data-field="x_totalpotongan" name="x_totalpotongan" id="x_totalpotongan" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($potongan_edit->totalpotongan->getPlaceHolder()) ?>" value="<?php echo $potongan_edit->totalpotongan->EditValue ?>"<?php echo $potongan_edit->totalpotongan->editAttributes() ?>>
</span>
<?php echo $potongan_edit->totalpotongan->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="potongan" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($potongan_edit->id->CurrentValue) ?>">
<?php if (!$potongan_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $potongan_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $potongan_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$potongan_edit->showPageFooter();
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
$potongan_edit->terminate();
?>