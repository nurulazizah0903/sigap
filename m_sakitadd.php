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
$m_sakit_add = new m_sakit_add();

// Run the page
$m_sakit_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_sakit_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_sakitadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fm_sakitadd = currentForm = new ew.Form("fm_sakitadd", "add");

	// Validate form
	fm_sakitadd.validate = function() {
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
			<?php if ($m_sakit_add->jenjang_id->Required) { ?>
				elm = this.getElements("x" + infix + "_jenjang_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_sakit_add->jenjang_id->caption(), $m_sakit_add->jenjang_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jenjang_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_sakit_add->jenjang_id->errorMessage()) ?>");
			<?php if ($m_sakit_add->jabatan->Required) { ?>
				elm = this.getElements("x" + infix + "_jabatan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_sakit_add->jabatan->caption(), $m_sakit_add->jabatan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jabatan");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_sakit_add->jabatan->errorMessage()) ?>");
			<?php if ($m_sakit_add->perhari->Required) { ?>
				elm = this.getElements("x" + infix + "_perhari");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_sakit_add->perhari->caption(), $m_sakit_add->perhari->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_perhari");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_sakit_add->perhari->errorMessage()) ?>");
			<?php if ($m_sakit_add->perjam->Required) { ?>
				elm = this.getElements("x" + infix + "_perjam");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_sakit_add->perjam->caption(), $m_sakit_add->perjam->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_perjam");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_sakit_add->perjam->errorMessage()) ?>");

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
	fm_sakitadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fm_sakitadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fm_sakitadd.lists["x_jenjang_id"] = <?php echo $m_sakit_add->jenjang_id->Lookup->toClientList($m_sakit_add) ?>;
	fm_sakitadd.lists["x_jenjang_id"].options = <?php echo JsonEncode($m_sakit_add->jenjang_id->lookupOptions()) ?>;
	fm_sakitadd.autoSuggests["x_jenjang_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fm_sakitadd.lists["x_jabatan"] = <?php echo $m_sakit_add->jabatan->Lookup->toClientList($m_sakit_add) ?>;
	fm_sakitadd.lists["x_jabatan"].options = <?php echo JsonEncode($m_sakit_add->jabatan->lookupOptions()) ?>;
	fm_sakitadd.autoSuggests["x_jabatan"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fm_sakitadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_sakit_add->showPageHeader(); ?>
<?php
$m_sakit_add->showMessage();
?>
<form name="fm_sakitadd" id="fm_sakitadd" class="<?php echo $m_sakit_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_sakit">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$m_sakit_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($m_sakit_add->jenjang_id->Visible) { // jenjang_id ?>
	<div id="r_jenjang_id" class="form-group row">
		<label id="elh_m_sakit_jenjang_id" class="<?php echo $m_sakit_add->LeftColumnClass ?>"><?php echo $m_sakit_add->jenjang_id->caption() ?><?php echo $m_sakit_add->jenjang_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_sakit_add->RightColumnClass ?>"><div <?php echo $m_sakit_add->jenjang_id->cellAttributes() ?>>
<span id="el_m_sakit_jenjang_id">
<?php
$onchange = $m_sakit_add->jenjang_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$m_sakit_add->jenjang_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_jenjang_id">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_jenjang_id" id="sv_x_jenjang_id" value="<?php echo RemoveHtml($m_sakit_add->jenjang_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($m_sakit_add->jenjang_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($m_sakit_add->jenjang_id->getPlaceHolder()) ?>"<?php echo $m_sakit_add->jenjang_id->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($m_sakit_add->jenjang_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_jenjang_id',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($m_sakit_add->jenjang_id->ReadOnly || $m_sakit_add->jenjang_id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="m_sakit" data-field="x_jenjang_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $m_sakit_add->jenjang_id->displayValueSeparatorAttribute() ?>" name="x_jenjang_id" id="x_jenjang_id" value="<?php echo HtmlEncode($m_sakit_add->jenjang_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fm_sakitadd"], function() {
	fm_sakitadd.createAutoSuggest({"id":"x_jenjang_id","forceSelect":false});
});
</script>
<?php echo $m_sakit_add->jenjang_id->Lookup->getParamTag($m_sakit_add, "p_x_jenjang_id") ?>
</span>
<?php echo $m_sakit_add->jenjang_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_sakit_add->jabatan->Visible) { // jabatan ?>
	<div id="r_jabatan" class="form-group row">
		<label id="elh_m_sakit_jabatan" class="<?php echo $m_sakit_add->LeftColumnClass ?>"><?php echo $m_sakit_add->jabatan->caption() ?><?php echo $m_sakit_add->jabatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_sakit_add->RightColumnClass ?>"><div <?php echo $m_sakit_add->jabatan->cellAttributes() ?>>
<span id="el_m_sakit_jabatan">
<?php
$onchange = $m_sakit_add->jabatan->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$m_sakit_add->jabatan->EditAttrs["onchange"] = "";
?>
<span id="as_x_jabatan">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_jabatan" id="sv_x_jabatan" value="<?php echo RemoveHtml($m_sakit_add->jabatan->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($m_sakit_add->jabatan->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($m_sakit_add->jabatan->getPlaceHolder()) ?>"<?php echo $m_sakit_add->jabatan->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($m_sakit_add->jabatan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_jabatan',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($m_sakit_add->jabatan->ReadOnly || $m_sakit_add->jabatan->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="m_sakit" data-field="x_jabatan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $m_sakit_add->jabatan->displayValueSeparatorAttribute() ?>" name="x_jabatan" id="x_jabatan" value="<?php echo HtmlEncode($m_sakit_add->jabatan->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fm_sakitadd"], function() {
	fm_sakitadd.createAutoSuggest({"id":"x_jabatan","forceSelect":false});
});
</script>
<?php echo $m_sakit_add->jabatan->Lookup->getParamTag($m_sakit_add, "p_x_jabatan") ?>
</span>
<?php echo $m_sakit_add->jabatan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_sakit_add->perhari->Visible) { // perhari ?>
	<div id="r_perhari" class="form-group row">
		<label id="elh_m_sakit_perhari" for="x_perhari" class="<?php echo $m_sakit_add->LeftColumnClass ?>"><?php echo $m_sakit_add->perhari->caption() ?><?php echo $m_sakit_add->perhari->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_sakit_add->RightColumnClass ?>"><div <?php echo $m_sakit_add->perhari->cellAttributes() ?>>
<span id="el_m_sakit_perhari">
<input type="text" data-table="m_sakit" data-field="x_perhari" name="x_perhari" id="x_perhari" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($m_sakit_add->perhari->getPlaceHolder()) ?>" value="<?php echo $m_sakit_add->perhari->EditValue ?>"<?php echo $m_sakit_add->perhari->editAttributes() ?>>
</span>
<?php echo $m_sakit_add->perhari->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_sakit_add->perjam->Visible) { // perjam ?>
	<div id="r_perjam" class="form-group row">
		<label id="elh_m_sakit_perjam" for="x_perjam" class="<?php echo $m_sakit_add->LeftColumnClass ?>"><?php echo $m_sakit_add->perjam->caption() ?><?php echo $m_sakit_add->perjam->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_sakit_add->RightColumnClass ?>"><div <?php echo $m_sakit_add->perjam->cellAttributes() ?>>
<span id="el_m_sakit_perjam">
<input type="text" data-table="m_sakit" data-field="x_perjam" name="x_perjam" id="x_perjam" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($m_sakit_add->perjam->getPlaceHolder()) ?>" value="<?php echo $m_sakit_add->perjam->EditValue ?>"<?php echo $m_sakit_add->perjam->editAttributes() ?>>
</span>
<?php echo $m_sakit_add->perjam->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$m_sakit_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $m_sakit_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_sakit_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$m_sakit_add->showPageFooter();
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
$m_sakit_add->terminate();
?>