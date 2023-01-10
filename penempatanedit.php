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
$penempatan_edit = new penempatan_edit();

// Run the page
$penempatan_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$penempatan_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpenempatanedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fpenempatanedit = currentForm = new ew.Form("fpenempatanedit", "edit");

	// Validate form
	fpenempatanedit.validate = function() {
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
			<?php if ($penempatan_edit->pegawai->Required) { ?>
				elm = this.getElements("x" + infix + "_pegawai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penempatan_edit->pegawai->caption(), $penempatan_edit->pegawai->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pegawai");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($penempatan_edit->pegawai->errorMessage()) ?>");
			<?php if ($penempatan_edit->project->Required) { ?>
				elm = this.getElements("x" + infix + "_project");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penempatan_edit->project->caption(), $penempatan_edit->project->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($penempatan_edit->jabatan->Required) { ?>
				elm = this.getElements("x" + infix + "_jabatan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penempatan_edit->jabatan->caption(), $penempatan_edit->jabatan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jabatan");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($penempatan_edit->jabatan->errorMessage()) ?>");
			<?php if ($penempatan_edit->tgl_mulai->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_mulai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penempatan_edit->tgl_mulai->caption(), $penempatan_edit->tgl_mulai->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_mulai");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($penempatan_edit->tgl_mulai->errorMessage()) ?>");
			<?php if ($penempatan_edit->tgl_akhir->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_akhir");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penempatan_edit->tgl_akhir->caption(), $penempatan_edit->tgl_akhir->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_akhir");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($penempatan_edit->tgl_akhir->errorMessage()) ?>");

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
	fpenempatanedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpenempatanedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fpenempatanedit.lists["x_pegawai"] = <?php echo $penempatan_edit->pegawai->Lookup->toClientList($penempatan_edit) ?>;
	fpenempatanedit.lists["x_pegawai"].options = <?php echo JsonEncode($penempatan_edit->pegawai->lookupOptions()) ?>;
	fpenempatanedit.autoSuggests["x_pegawai"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fpenempatanedit.lists["x_jabatan"] = <?php echo $penempatan_edit->jabatan->Lookup->toClientList($penempatan_edit) ?>;
	fpenempatanedit.lists["x_jabatan"].options = <?php echo JsonEncode($penempatan_edit->jabatan->lookupOptions()) ?>;
	fpenempatanedit.autoSuggests["x_jabatan"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fpenempatanedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $penempatan_edit->showPageHeader(); ?>
<?php
$penempatan_edit->showMessage();
?>
<form name="fpenempatanedit" id="fpenempatanedit" class="<?php echo $penempatan_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="penempatan">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$penempatan_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($penempatan_edit->pegawai->Visible) { // pegawai ?>
	<div id="r_pegawai" class="form-group row">
		<label id="elh_penempatan_pegawai" class="<?php echo $penempatan_edit->LeftColumnClass ?>"><?php echo $penempatan_edit->pegawai->caption() ?><?php echo $penempatan_edit->pegawai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penempatan_edit->RightColumnClass ?>"><div <?php echo $penempatan_edit->pegawai->cellAttributes() ?>>
<span id="el_penempatan_pegawai">
<?php
$onchange = $penempatan_edit->pegawai->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$penempatan_edit->pegawai->EditAttrs["onchange"] = "";
?>
<span id="as_x_pegawai">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_pegawai" id="sv_x_pegawai" value="<?php echo RemoveHtml($penempatan_edit->pegawai->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($penempatan_edit->pegawai->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($penempatan_edit->pegawai->getPlaceHolder()) ?>"<?php echo $penempatan_edit->pegawai->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($penempatan_edit->pegawai->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_pegawai',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($penempatan_edit->pegawai->ReadOnly || $penempatan_edit->pegawai->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="penempatan" data-field="x_pegawai" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $penempatan_edit->pegawai->displayValueSeparatorAttribute() ?>" name="x_pegawai" id="x_pegawai" value="<?php echo HtmlEncode($penempatan_edit->pegawai->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fpenempatanedit"], function() {
	fpenempatanedit.createAutoSuggest({"id":"x_pegawai","forceSelect":false});
});
</script>
<?php echo $penempatan_edit->pegawai->Lookup->getParamTag($penempatan_edit, "p_x_pegawai") ?>
</span>
<?php echo $penempatan_edit->pegawai->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penempatan_edit->project->Visible) { // project ?>
	<div id="r_project" class="form-group row">
		<label id="elh_penempatan_project" for="x_project" class="<?php echo $penempatan_edit->LeftColumnClass ?>"><?php echo $penempatan_edit->project->caption() ?><?php echo $penempatan_edit->project->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penempatan_edit->RightColumnClass ?>"><div <?php echo $penempatan_edit->project->cellAttributes() ?>>
<span id="el_penempatan_project">
<input type="text" data-table="penempatan" data-field="x_project" name="x_project" id="x_project" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($penempatan_edit->project->getPlaceHolder()) ?>" value="<?php echo $penempatan_edit->project->EditValue ?>"<?php echo $penempatan_edit->project->editAttributes() ?>>
</span>
<?php echo $penempatan_edit->project->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penempatan_edit->jabatan->Visible) { // jabatan ?>
	<div id="r_jabatan" class="form-group row">
		<label id="elh_penempatan_jabatan" class="<?php echo $penempatan_edit->LeftColumnClass ?>"><?php echo $penempatan_edit->jabatan->caption() ?><?php echo $penempatan_edit->jabatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penempatan_edit->RightColumnClass ?>"><div <?php echo $penempatan_edit->jabatan->cellAttributes() ?>>
<span id="el_penempatan_jabatan">
<?php
$onchange = $penempatan_edit->jabatan->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$penempatan_edit->jabatan->EditAttrs["onchange"] = "";
?>
<span id="as_x_jabatan">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_jabatan" id="sv_x_jabatan" value="<?php echo RemoveHtml($penempatan_edit->jabatan->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($penempatan_edit->jabatan->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($penempatan_edit->jabatan->getPlaceHolder()) ?>"<?php echo $penempatan_edit->jabatan->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($penempatan_edit->jabatan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_jabatan',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($penempatan_edit->jabatan->ReadOnly || $penempatan_edit->jabatan->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="penempatan" data-field="x_jabatan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $penempatan_edit->jabatan->displayValueSeparatorAttribute() ?>" name="x_jabatan" id="x_jabatan" value="<?php echo HtmlEncode($penempatan_edit->jabatan->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fpenempatanedit"], function() {
	fpenempatanedit.createAutoSuggest({"id":"x_jabatan","forceSelect":false});
});
</script>
<?php echo $penempatan_edit->jabatan->Lookup->getParamTag($penempatan_edit, "p_x_jabatan") ?>
</span>
<?php echo $penempatan_edit->jabatan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penempatan_edit->tgl_mulai->Visible) { // tgl_mulai ?>
	<div id="r_tgl_mulai" class="form-group row">
		<label id="elh_penempatan_tgl_mulai" for="x_tgl_mulai" class="<?php echo $penempatan_edit->LeftColumnClass ?>"><?php echo $penempatan_edit->tgl_mulai->caption() ?><?php echo $penempatan_edit->tgl_mulai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penempatan_edit->RightColumnClass ?>"><div <?php echo $penempatan_edit->tgl_mulai->cellAttributes() ?>>
<span id="el_penempatan_tgl_mulai">
<input type="text" data-table="penempatan" data-field="x_tgl_mulai" name="x_tgl_mulai" id="x_tgl_mulai" maxlength="10" placeholder="<?php echo HtmlEncode($penempatan_edit->tgl_mulai->getPlaceHolder()) ?>" value="<?php echo $penempatan_edit->tgl_mulai->EditValue ?>"<?php echo $penempatan_edit->tgl_mulai->editAttributes() ?>>
<?php if (!$penempatan_edit->tgl_mulai->ReadOnly && !$penempatan_edit->tgl_mulai->Disabled && !isset($penempatan_edit->tgl_mulai->EditAttrs["readonly"]) && !isset($penempatan_edit->tgl_mulai->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpenempatanedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fpenempatanedit", "x_tgl_mulai", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $penempatan_edit->tgl_mulai->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penempatan_edit->tgl_akhir->Visible) { // tgl_akhir ?>
	<div id="r_tgl_akhir" class="form-group row">
		<label id="elh_penempatan_tgl_akhir" for="x_tgl_akhir" class="<?php echo $penempatan_edit->LeftColumnClass ?>"><?php echo $penempatan_edit->tgl_akhir->caption() ?><?php echo $penempatan_edit->tgl_akhir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penempatan_edit->RightColumnClass ?>"><div <?php echo $penempatan_edit->tgl_akhir->cellAttributes() ?>>
<span id="el_penempatan_tgl_akhir">
<input type="text" data-table="penempatan" data-field="x_tgl_akhir" name="x_tgl_akhir" id="x_tgl_akhir" maxlength="10" placeholder="<?php echo HtmlEncode($penempatan_edit->tgl_akhir->getPlaceHolder()) ?>" value="<?php echo $penempatan_edit->tgl_akhir->EditValue ?>"<?php echo $penempatan_edit->tgl_akhir->editAttributes() ?>>
<?php if (!$penempatan_edit->tgl_akhir->ReadOnly && !$penempatan_edit->tgl_akhir->Disabled && !isset($penempatan_edit->tgl_akhir->EditAttrs["readonly"]) && !isset($penempatan_edit->tgl_akhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpenempatanedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fpenempatanedit", "x_tgl_akhir", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $penempatan_edit->tgl_akhir->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="penempatan" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($penempatan_edit->id->CurrentValue) ?>">
<?php if (!$penempatan_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $penempatan_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $penempatan_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$penempatan_edit->showPageFooter();
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
$penempatan_edit->terminate();
?>