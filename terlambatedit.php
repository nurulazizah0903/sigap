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
$terlambat_edit = new terlambat_edit();

// Run the page
$terlambat_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$terlambat_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fterlambatedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fterlambatedit = currentForm = new ew.Form("fterlambatedit", "edit");

	// Validate form
	fterlambatedit.validate = function() {
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
			<?php if ($terlambat_edit->jenjang_id->Required) { ?>
				elm = this.getElements("x" + infix + "_jenjang_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $terlambat_edit->jenjang_id->caption(), $terlambat_edit->jenjang_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jenjang_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($terlambat_edit->jenjang_id->errorMessage()) ?>");
			<?php if ($terlambat_edit->jabatan_id->Required) { ?>
				elm = this.getElements("x" + infix + "_jabatan_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $terlambat_edit->jabatan_id->caption(), $terlambat_edit->jabatan_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jabatan_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($terlambat_edit->jabatan_id->errorMessage()) ?>");
			<?php if ($terlambat_edit->value->Required) { ?>
				elm = this.getElements("x" + infix + "_value");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $terlambat_edit->value->caption(), $terlambat_edit->value->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_value");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($terlambat_edit->value->errorMessage()) ?>");

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
	fterlambatedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fterlambatedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fterlambatedit.lists["x_jenjang_id"] = <?php echo $terlambat_edit->jenjang_id->Lookup->toClientList($terlambat_edit) ?>;
	fterlambatedit.lists["x_jenjang_id"].options = <?php echo JsonEncode($terlambat_edit->jenjang_id->lookupOptions()) ?>;
	fterlambatedit.autoSuggests["x_jenjang_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fterlambatedit.lists["x_jabatan_id"] = <?php echo $terlambat_edit->jabatan_id->Lookup->toClientList($terlambat_edit) ?>;
	fterlambatedit.lists["x_jabatan_id"].options = <?php echo JsonEncode($terlambat_edit->jabatan_id->lookupOptions()) ?>;
	fterlambatedit.autoSuggests["x_jabatan_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fterlambatedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $terlambat_edit->showPageHeader(); ?>
<?php
$terlambat_edit->showMessage();
?>
<form name="fterlambatedit" id="fterlambatedit" class="<?php echo $terlambat_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="terlambat">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$terlambat_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($terlambat_edit->jenjang_id->Visible) { // jenjang_id ?>
	<div id="r_jenjang_id" class="form-group row">
		<label id="elh_terlambat_jenjang_id" class="<?php echo $terlambat_edit->LeftColumnClass ?>"><?php echo $terlambat_edit->jenjang_id->caption() ?><?php echo $terlambat_edit->jenjang_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $terlambat_edit->RightColumnClass ?>"><div <?php echo $terlambat_edit->jenjang_id->cellAttributes() ?>>
<span id="el_terlambat_jenjang_id">
<?php
$onchange = $terlambat_edit->jenjang_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$terlambat_edit->jenjang_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_jenjang_id">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_jenjang_id" id="sv_x_jenjang_id" value="<?php echo RemoveHtml($terlambat_edit->jenjang_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($terlambat_edit->jenjang_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($terlambat_edit->jenjang_id->getPlaceHolder()) ?>"<?php echo $terlambat_edit->jenjang_id->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($terlambat_edit->jenjang_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_jenjang_id',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($terlambat_edit->jenjang_id->ReadOnly || $terlambat_edit->jenjang_id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="terlambat" data-field="x_jenjang_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $terlambat_edit->jenjang_id->displayValueSeparatorAttribute() ?>" name="x_jenjang_id" id="x_jenjang_id" value="<?php echo HtmlEncode($terlambat_edit->jenjang_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fterlambatedit"], function() {
	fterlambatedit.createAutoSuggest({"id":"x_jenjang_id","forceSelect":false});
});
</script>
<?php echo $terlambat_edit->jenjang_id->Lookup->getParamTag($terlambat_edit, "p_x_jenjang_id") ?>
</span>
<?php echo $terlambat_edit->jenjang_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($terlambat_edit->jabatan_id->Visible) { // jabatan_id ?>
	<div id="r_jabatan_id" class="form-group row">
		<label id="elh_terlambat_jabatan_id" class="<?php echo $terlambat_edit->LeftColumnClass ?>"><?php echo $terlambat_edit->jabatan_id->caption() ?><?php echo $terlambat_edit->jabatan_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $terlambat_edit->RightColumnClass ?>"><div <?php echo $terlambat_edit->jabatan_id->cellAttributes() ?>>
<span id="el_terlambat_jabatan_id">
<?php
$onchange = $terlambat_edit->jabatan_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$terlambat_edit->jabatan_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_jabatan_id">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_jabatan_id" id="sv_x_jabatan_id" value="<?php echo RemoveHtml($terlambat_edit->jabatan_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($terlambat_edit->jabatan_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($terlambat_edit->jabatan_id->getPlaceHolder()) ?>"<?php echo $terlambat_edit->jabatan_id->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($terlambat_edit->jabatan_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_jabatan_id',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($terlambat_edit->jabatan_id->ReadOnly || $terlambat_edit->jabatan_id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="terlambat" data-field="x_jabatan_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $terlambat_edit->jabatan_id->displayValueSeparatorAttribute() ?>" name="x_jabatan_id" id="x_jabatan_id" value="<?php echo HtmlEncode($terlambat_edit->jabatan_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fterlambatedit"], function() {
	fterlambatedit.createAutoSuggest({"id":"x_jabatan_id","forceSelect":false});
});
</script>
<?php echo $terlambat_edit->jabatan_id->Lookup->getParamTag($terlambat_edit, "p_x_jabatan_id") ?>
</span>
<?php echo $terlambat_edit->jabatan_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($terlambat_edit->value->Visible) { // value ?>
	<div id="r_value" class="form-group row">
		<label id="elh_terlambat_value" for="x_value" class="<?php echo $terlambat_edit->LeftColumnClass ?>"><?php echo $terlambat_edit->value->caption() ?><?php echo $terlambat_edit->value->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $terlambat_edit->RightColumnClass ?>"><div <?php echo $terlambat_edit->value->cellAttributes() ?>>
<span id="el_terlambat_value">
<input type="text" data-table="terlambat" data-field="x_value" name="x_value" id="x_value" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($terlambat_edit->value->getPlaceHolder()) ?>" value="<?php echo $terlambat_edit->value->EditValue ?>"<?php echo $terlambat_edit->value->editAttributes() ?>>
</span>
<?php echo $terlambat_edit->value->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="terlambat" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($terlambat_edit->id->CurrentValue) ?>">
<?php if (!$terlambat_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $terlambat_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $terlambat_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$terlambat_edit->showPageFooter();
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
$terlambat_edit->terminate();
?>