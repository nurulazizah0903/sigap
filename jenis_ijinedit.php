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
$jenis_ijin_edit = new jenis_ijin_edit();

// Run the page
$jenis_ijin_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$jenis_ijin_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fjenis_ijinedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fjenis_ijinedit = currentForm = new ew.Form("fjenis_ijinedit", "edit");

	// Validate form
	fjenis_ijinedit.validate = function() {
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
			<?php if ($jenis_ijin_edit->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $jenis_ijin_edit->id->caption(), $jenis_ijin_edit->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($jenis_ijin_edit->nama->Required) { ?>
				elm = this.getElements("x" + infix + "_nama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $jenis_ijin_edit->nama->caption(), $jenis_ijin_edit->nama->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($jenis_ijin_edit->aktif->Required) { ?>
				elm = this.getElements("x" + infix + "_aktif");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $jenis_ijin_edit->aktif->caption(), $jenis_ijin_edit->aktif->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($jenis_ijin_edit->value->Required) { ?>
				elm = this.getElements("x" + infix + "_value");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $jenis_ijin_edit->value->caption(), $jenis_ijin_edit->value->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_value");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($jenis_ijin_edit->value->errorMessage()) ?>");
			<?php if ($jenis_ijin_edit->valueperjam->Required) { ?>
				elm = this.getElements("x" + infix + "_valueperjam");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $jenis_ijin_edit->valueperjam->caption(), $jenis_ijin_edit->valueperjam->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_valueperjam");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($jenis_ijin_edit->valueperjam->errorMessage()) ?>");
			<?php if ($jenis_ijin_edit->jabatan_id->Required) { ?>
				elm = this.getElements("x" + infix + "_jabatan_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $jenis_ijin_edit->jabatan_id->caption(), $jenis_ijin_edit->jabatan_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jabatan_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($jenis_ijin_edit->jabatan_id->errorMessage()) ?>");
			<?php if ($jenis_ijin_edit->jenjang_id->Required) { ?>
				elm = this.getElements("x" + infix + "_jenjang_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $jenis_ijin_edit->jenjang_id->caption(), $jenis_ijin_edit->jenjang_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jenjang_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($jenis_ijin_edit->jenjang_id->errorMessage()) ?>");

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
	fjenis_ijinedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fjenis_ijinedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fjenis_ijinedit.lists["x_jabatan_id"] = <?php echo $jenis_ijin_edit->jabatan_id->Lookup->toClientList($jenis_ijin_edit) ?>;
	fjenis_ijinedit.lists["x_jabatan_id"].options = <?php echo JsonEncode($jenis_ijin_edit->jabatan_id->lookupOptions()) ?>;
	fjenis_ijinedit.autoSuggests["x_jabatan_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fjenis_ijinedit.lists["x_jenjang_id"] = <?php echo $jenis_ijin_edit->jenjang_id->Lookup->toClientList($jenis_ijin_edit) ?>;
	fjenis_ijinedit.lists["x_jenjang_id"].options = <?php echo JsonEncode($jenis_ijin_edit->jenjang_id->lookupOptions()) ?>;
	fjenis_ijinedit.autoSuggests["x_jenjang_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fjenis_ijinedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $jenis_ijin_edit->showPageHeader(); ?>
<?php
$jenis_ijin_edit->showMessage();
?>
<form name="fjenis_ijinedit" id="fjenis_ijinedit" class="<?php echo $jenis_ijin_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="jenis_ijin">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$jenis_ijin_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($jenis_ijin_edit->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_jenis_ijin_id" class="<?php echo $jenis_ijin_edit->LeftColumnClass ?>"><?php echo $jenis_ijin_edit->id->caption() ?><?php echo $jenis_ijin_edit->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $jenis_ijin_edit->RightColumnClass ?>"><div <?php echo $jenis_ijin_edit->id->cellAttributes() ?>>
<span id="el_jenis_ijin_id">
<span<?php echo $jenis_ijin_edit->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($jenis_ijin_edit->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="jenis_ijin" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($jenis_ijin_edit->id->CurrentValue) ?>">
<?php echo $jenis_ijin_edit->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($jenis_ijin_edit->nama->Visible) { // nama ?>
	<div id="r_nama" class="form-group row">
		<label id="elh_jenis_ijin_nama" for="x_nama" class="<?php echo $jenis_ijin_edit->LeftColumnClass ?>"><?php echo $jenis_ijin_edit->nama->caption() ?><?php echo $jenis_ijin_edit->nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $jenis_ijin_edit->RightColumnClass ?>"><div <?php echo $jenis_ijin_edit->nama->cellAttributes() ?>>
<span id="el_jenis_ijin_nama">
<input type="text" data-table="jenis_ijin" data-field="x_nama" name="x_nama" id="x_nama" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($jenis_ijin_edit->nama->getPlaceHolder()) ?>" value="<?php echo $jenis_ijin_edit->nama->EditValue ?>"<?php echo $jenis_ijin_edit->nama->editAttributes() ?>>
</span>
<?php echo $jenis_ijin_edit->nama->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($jenis_ijin_edit->aktif->Visible) { // aktif ?>
	<div id="r_aktif" class="form-group row">
		<label id="elh_jenis_ijin_aktif" for="x_aktif" class="<?php echo $jenis_ijin_edit->LeftColumnClass ?>"><?php echo $jenis_ijin_edit->aktif->caption() ?><?php echo $jenis_ijin_edit->aktif->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $jenis_ijin_edit->RightColumnClass ?>"><div <?php echo $jenis_ijin_edit->aktif->cellAttributes() ?>>
<span id="el_jenis_ijin_aktif">
<input type="text" data-table="jenis_ijin" data-field="x_aktif" name="x_aktif" id="x_aktif" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($jenis_ijin_edit->aktif->getPlaceHolder()) ?>" value="<?php echo $jenis_ijin_edit->aktif->EditValue ?>"<?php echo $jenis_ijin_edit->aktif->editAttributes() ?>>
</span>
<?php echo $jenis_ijin_edit->aktif->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($jenis_ijin_edit->value->Visible) { // value ?>
	<div id="r_value" class="form-group row">
		<label id="elh_jenis_ijin_value" for="x_value" class="<?php echo $jenis_ijin_edit->LeftColumnClass ?>"><?php echo $jenis_ijin_edit->value->caption() ?><?php echo $jenis_ijin_edit->value->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $jenis_ijin_edit->RightColumnClass ?>"><div <?php echo $jenis_ijin_edit->value->cellAttributes() ?>>
<span id="el_jenis_ijin_value">
<input type="text" data-table="jenis_ijin" data-field="x_value" name="x_value" id="x_value" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($jenis_ijin_edit->value->getPlaceHolder()) ?>" value="<?php echo $jenis_ijin_edit->value->EditValue ?>"<?php echo $jenis_ijin_edit->value->editAttributes() ?>>
</span>
<?php echo $jenis_ijin_edit->value->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($jenis_ijin_edit->valueperjam->Visible) { // valueperjam ?>
	<div id="r_valueperjam" class="form-group row">
		<label id="elh_jenis_ijin_valueperjam" for="x_valueperjam" class="<?php echo $jenis_ijin_edit->LeftColumnClass ?>"><?php echo $jenis_ijin_edit->valueperjam->caption() ?><?php echo $jenis_ijin_edit->valueperjam->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $jenis_ijin_edit->RightColumnClass ?>"><div <?php echo $jenis_ijin_edit->valueperjam->cellAttributes() ?>>
<span id="el_jenis_ijin_valueperjam">
<input type="text" data-table="jenis_ijin" data-field="x_valueperjam" name="x_valueperjam" id="x_valueperjam" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($jenis_ijin_edit->valueperjam->getPlaceHolder()) ?>" value="<?php echo $jenis_ijin_edit->valueperjam->EditValue ?>"<?php echo $jenis_ijin_edit->valueperjam->editAttributes() ?>>
</span>
<?php echo $jenis_ijin_edit->valueperjam->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($jenis_ijin_edit->jabatan_id->Visible) { // jabatan_id ?>
	<div id="r_jabatan_id" class="form-group row">
		<label id="elh_jenis_ijin_jabatan_id" class="<?php echo $jenis_ijin_edit->LeftColumnClass ?>"><?php echo $jenis_ijin_edit->jabatan_id->caption() ?><?php echo $jenis_ijin_edit->jabatan_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $jenis_ijin_edit->RightColumnClass ?>"><div <?php echo $jenis_ijin_edit->jabatan_id->cellAttributes() ?>>
<span id="el_jenis_ijin_jabatan_id">
<?php
$onchange = $jenis_ijin_edit->jabatan_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$jenis_ijin_edit->jabatan_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_jabatan_id">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_jabatan_id" id="sv_x_jabatan_id" value="<?php echo RemoveHtml($jenis_ijin_edit->jabatan_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($jenis_ijin_edit->jabatan_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($jenis_ijin_edit->jabatan_id->getPlaceHolder()) ?>"<?php echo $jenis_ijin_edit->jabatan_id->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($jenis_ijin_edit->jabatan_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_jabatan_id',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($jenis_ijin_edit->jabatan_id->ReadOnly || $jenis_ijin_edit->jabatan_id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="jenis_ijin" data-field="x_jabatan_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $jenis_ijin_edit->jabatan_id->displayValueSeparatorAttribute() ?>" name="x_jabatan_id" id="x_jabatan_id" value="<?php echo HtmlEncode($jenis_ijin_edit->jabatan_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fjenis_ijinedit"], function() {
	fjenis_ijinedit.createAutoSuggest({"id":"x_jabatan_id","forceSelect":false});
});
</script>
<?php echo $jenis_ijin_edit->jabatan_id->Lookup->getParamTag($jenis_ijin_edit, "p_x_jabatan_id") ?>
</span>
<?php echo $jenis_ijin_edit->jabatan_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($jenis_ijin_edit->jenjang_id->Visible) { // jenjang_id ?>
	<div id="r_jenjang_id" class="form-group row">
		<label id="elh_jenis_ijin_jenjang_id" class="<?php echo $jenis_ijin_edit->LeftColumnClass ?>"><?php echo $jenis_ijin_edit->jenjang_id->caption() ?><?php echo $jenis_ijin_edit->jenjang_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $jenis_ijin_edit->RightColumnClass ?>"><div <?php echo $jenis_ijin_edit->jenjang_id->cellAttributes() ?>>
<span id="el_jenis_ijin_jenjang_id">
<?php
$onchange = $jenis_ijin_edit->jenjang_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$jenis_ijin_edit->jenjang_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_jenjang_id">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_jenjang_id" id="sv_x_jenjang_id" value="<?php echo RemoveHtml($jenis_ijin_edit->jenjang_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($jenis_ijin_edit->jenjang_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($jenis_ijin_edit->jenjang_id->getPlaceHolder()) ?>"<?php echo $jenis_ijin_edit->jenjang_id->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($jenis_ijin_edit->jenjang_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_jenjang_id',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($jenis_ijin_edit->jenjang_id->ReadOnly || $jenis_ijin_edit->jenjang_id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="jenis_ijin" data-field="x_jenjang_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $jenis_ijin_edit->jenjang_id->displayValueSeparatorAttribute() ?>" name="x_jenjang_id" id="x_jenjang_id" value="<?php echo HtmlEncode($jenis_ijin_edit->jenjang_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fjenis_ijinedit"], function() {
	fjenis_ijinedit.createAutoSuggest({"id":"x_jenjang_id","forceSelect":false});
});
</script>
<?php echo $jenis_ijin_edit->jenjang_id->Lookup->getParamTag($jenis_ijin_edit, "p_x_jenjang_id") ?>
</span>
<?php echo $jenis_ijin_edit->jenjang_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$jenis_ijin_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $jenis_ijin_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $jenis_ijin_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$jenis_ijin_edit->showPageFooter();
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
$jenis_ijin_edit->terminate();
?>