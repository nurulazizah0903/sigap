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
$penempatan_add = new penempatan_add();

// Run the page
$penempatan_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$penempatan_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpenempatanadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fpenempatanadd = currentForm = new ew.Form("fpenempatanadd", "add");

	// Validate form
	fpenempatanadd.validate = function() {
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
			<?php if ($penempatan_add->pegawai->Required) { ?>
				elm = this.getElements("x" + infix + "_pegawai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penempatan_add->pegawai->caption(), $penempatan_add->pegawai->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pegawai");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($penempatan_add->pegawai->errorMessage()) ?>");
			<?php if ($penempatan_add->project->Required) { ?>
				elm = this.getElements("x" + infix + "_project");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penempatan_add->project->caption(), $penempatan_add->project->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($penempatan_add->jabatan->Required) { ?>
				elm = this.getElements("x" + infix + "_jabatan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penempatan_add->jabatan->caption(), $penempatan_add->jabatan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jabatan");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($penempatan_add->jabatan->errorMessage()) ?>");
			<?php if ($penempatan_add->tgl_mulai->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_mulai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penempatan_add->tgl_mulai->caption(), $penempatan_add->tgl_mulai->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_mulai");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($penempatan_add->tgl_mulai->errorMessage()) ?>");
			<?php if ($penempatan_add->tgl_akhir->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_akhir");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penempatan_add->tgl_akhir->caption(), $penempatan_add->tgl_akhir->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_akhir");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($penempatan_add->tgl_akhir->errorMessage()) ?>");

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
	fpenempatanadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpenempatanadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fpenempatanadd.lists["x_pegawai"] = <?php echo $penempatan_add->pegawai->Lookup->toClientList($penempatan_add) ?>;
	fpenempatanadd.lists["x_pegawai"].options = <?php echo JsonEncode($penempatan_add->pegawai->lookupOptions()) ?>;
	fpenempatanadd.autoSuggests["x_pegawai"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fpenempatanadd.lists["x_jabatan"] = <?php echo $penempatan_add->jabatan->Lookup->toClientList($penempatan_add) ?>;
	fpenempatanadd.lists["x_jabatan"].options = <?php echo JsonEncode($penempatan_add->jabatan->lookupOptions()) ?>;
	fpenempatanadd.autoSuggests["x_jabatan"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fpenempatanadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $penempatan_add->showPageHeader(); ?>
<?php
$penempatan_add->showMessage();
?>
<form name="fpenempatanadd" id="fpenempatanadd" class="<?php echo $penempatan_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="penempatan">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$penempatan_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($penempatan_add->pegawai->Visible) { // pegawai ?>
	<div id="r_pegawai" class="form-group row">
		<label id="elh_penempatan_pegawai" class="<?php echo $penempatan_add->LeftColumnClass ?>"><?php echo $penempatan_add->pegawai->caption() ?><?php echo $penempatan_add->pegawai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penempatan_add->RightColumnClass ?>"><div <?php echo $penempatan_add->pegawai->cellAttributes() ?>>
<span id="el_penempatan_pegawai">
<?php
$onchange = $penempatan_add->pegawai->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$penempatan_add->pegawai->EditAttrs["onchange"] = "";
?>
<span id="as_x_pegawai">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_pegawai" id="sv_x_pegawai" value="<?php echo RemoveHtml($penempatan_add->pegawai->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($penempatan_add->pegawai->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($penempatan_add->pegawai->getPlaceHolder()) ?>"<?php echo $penempatan_add->pegawai->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($penempatan_add->pegawai->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_pegawai',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($penempatan_add->pegawai->ReadOnly || $penempatan_add->pegawai->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="penempatan" data-field="x_pegawai" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $penempatan_add->pegawai->displayValueSeparatorAttribute() ?>" name="x_pegawai" id="x_pegawai" value="<?php echo HtmlEncode($penempatan_add->pegawai->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fpenempatanadd"], function() {
	fpenempatanadd.createAutoSuggest({"id":"x_pegawai","forceSelect":false});
});
</script>
<?php echo $penempatan_add->pegawai->Lookup->getParamTag($penempatan_add, "p_x_pegawai") ?>
</span>
<?php echo $penempatan_add->pegawai->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penempatan_add->project->Visible) { // project ?>
	<div id="r_project" class="form-group row">
		<label id="elh_penempatan_project" for="x_project" class="<?php echo $penempatan_add->LeftColumnClass ?>"><?php echo $penempatan_add->project->caption() ?><?php echo $penempatan_add->project->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penempatan_add->RightColumnClass ?>"><div <?php echo $penempatan_add->project->cellAttributes() ?>>
<span id="el_penempatan_project">
<input type="text" data-table="penempatan" data-field="x_project" name="x_project" id="x_project" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($penempatan_add->project->getPlaceHolder()) ?>" value="<?php echo $penempatan_add->project->EditValue ?>"<?php echo $penempatan_add->project->editAttributes() ?>>
</span>
<?php echo $penempatan_add->project->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penempatan_add->jabatan->Visible) { // jabatan ?>
	<div id="r_jabatan" class="form-group row">
		<label id="elh_penempatan_jabatan" class="<?php echo $penempatan_add->LeftColumnClass ?>"><?php echo $penempatan_add->jabatan->caption() ?><?php echo $penempatan_add->jabatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penempatan_add->RightColumnClass ?>"><div <?php echo $penempatan_add->jabatan->cellAttributes() ?>>
<span id="el_penempatan_jabatan">
<?php
$onchange = $penempatan_add->jabatan->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$penempatan_add->jabatan->EditAttrs["onchange"] = "";
?>
<span id="as_x_jabatan">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_jabatan" id="sv_x_jabatan" value="<?php echo RemoveHtml($penempatan_add->jabatan->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($penempatan_add->jabatan->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($penempatan_add->jabatan->getPlaceHolder()) ?>"<?php echo $penempatan_add->jabatan->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($penempatan_add->jabatan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_jabatan',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($penempatan_add->jabatan->ReadOnly || $penempatan_add->jabatan->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="penempatan" data-field="x_jabatan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $penempatan_add->jabatan->displayValueSeparatorAttribute() ?>" name="x_jabatan" id="x_jabatan" value="<?php echo HtmlEncode($penempatan_add->jabatan->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fpenempatanadd"], function() {
	fpenempatanadd.createAutoSuggest({"id":"x_jabatan","forceSelect":false});
});
</script>
<?php echo $penempatan_add->jabatan->Lookup->getParamTag($penempatan_add, "p_x_jabatan") ?>
</span>
<?php echo $penempatan_add->jabatan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penempatan_add->tgl_mulai->Visible) { // tgl_mulai ?>
	<div id="r_tgl_mulai" class="form-group row">
		<label id="elh_penempatan_tgl_mulai" for="x_tgl_mulai" class="<?php echo $penempatan_add->LeftColumnClass ?>"><?php echo $penempatan_add->tgl_mulai->caption() ?><?php echo $penempatan_add->tgl_mulai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penempatan_add->RightColumnClass ?>"><div <?php echo $penempatan_add->tgl_mulai->cellAttributes() ?>>
<span id="el_penempatan_tgl_mulai">
<input type="text" data-table="penempatan" data-field="x_tgl_mulai" name="x_tgl_mulai" id="x_tgl_mulai" maxlength="10" placeholder="<?php echo HtmlEncode($penempatan_add->tgl_mulai->getPlaceHolder()) ?>" value="<?php echo $penempatan_add->tgl_mulai->EditValue ?>"<?php echo $penempatan_add->tgl_mulai->editAttributes() ?>>
<?php if (!$penempatan_add->tgl_mulai->ReadOnly && !$penempatan_add->tgl_mulai->Disabled && !isset($penempatan_add->tgl_mulai->EditAttrs["readonly"]) && !isset($penempatan_add->tgl_mulai->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpenempatanadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fpenempatanadd", "x_tgl_mulai", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $penempatan_add->tgl_mulai->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penempatan_add->tgl_akhir->Visible) { // tgl_akhir ?>
	<div id="r_tgl_akhir" class="form-group row">
		<label id="elh_penempatan_tgl_akhir" for="x_tgl_akhir" class="<?php echo $penempatan_add->LeftColumnClass ?>"><?php echo $penempatan_add->tgl_akhir->caption() ?><?php echo $penempatan_add->tgl_akhir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penempatan_add->RightColumnClass ?>"><div <?php echo $penempatan_add->tgl_akhir->cellAttributes() ?>>
<span id="el_penempatan_tgl_akhir">
<input type="text" data-table="penempatan" data-field="x_tgl_akhir" name="x_tgl_akhir" id="x_tgl_akhir" maxlength="10" placeholder="<?php echo HtmlEncode($penempatan_add->tgl_akhir->getPlaceHolder()) ?>" value="<?php echo $penempatan_add->tgl_akhir->EditValue ?>"<?php echo $penempatan_add->tgl_akhir->editAttributes() ?>>
<?php if (!$penempatan_add->tgl_akhir->ReadOnly && !$penempatan_add->tgl_akhir->Disabled && !isset($penempatan_add->tgl_akhir->EditAttrs["readonly"]) && !isset($penempatan_add->tgl_akhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpenempatanadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fpenempatanadd", "x_tgl_akhir", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $penempatan_add->tgl_akhir->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$penempatan_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $penempatan_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $penempatan_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$penempatan_add->showPageFooter();
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
$penempatan_add->terminate();
?>