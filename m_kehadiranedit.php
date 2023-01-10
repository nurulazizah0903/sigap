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
$m_kehadiran_edit = new m_kehadiran_edit();

// Run the page
$m_kehadiran_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_kehadiran_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_kehadiranedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fm_kehadiranedit = currentForm = new ew.Form("fm_kehadiranedit", "edit");

	// Validate form
	fm_kehadiranedit.validate = function() {
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
			<?php if ($m_kehadiran_edit->jenjang->Required) { ?>
				elm = this.getElements("x" + infix + "_jenjang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_kehadiran_edit->jenjang->caption(), $m_kehadiran_edit->jenjang->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_kehadiran_edit->jenis_jabatan->Required) { ?>
				elm = this.getElements("x" + infix + "_jenis_jabatan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_kehadiran_edit->jenis_jabatan->caption(), $m_kehadiran_edit->jenis_jabatan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_kehadiran_edit->jabatan->Required) { ?>
				elm = this.getElements("x" + infix + "_jabatan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_kehadiran_edit->jabatan->caption(), $m_kehadiran_edit->jabatan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_kehadiran_edit->sertif->Required) { ?>
				elm = this.getElements("x" + infix + "_sertif");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_kehadiran_edit->sertif->caption(), $m_kehadiran_edit->sertif->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_kehadiran_edit->value->Required) { ?>
				elm = this.getElements("x" + infix + "_value");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_kehadiran_edit->value->caption(), $m_kehadiran_edit->value->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_value");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_kehadiran_edit->value->errorMessage()) ?>");

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
	fm_kehadiranedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fm_kehadiranedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fm_kehadiranedit.lists["x_jenjang"] = <?php echo $m_kehadiran_edit->jenjang->Lookup->toClientList($m_kehadiran_edit) ?>;
	fm_kehadiranedit.lists["x_jenjang"].options = <?php echo JsonEncode($m_kehadiran_edit->jenjang->lookupOptions()) ?>;
	fm_kehadiranedit.lists["x_jenis_jabatan"] = <?php echo $m_kehadiran_edit->jenis_jabatan->Lookup->toClientList($m_kehadiran_edit) ?>;
	fm_kehadiranedit.lists["x_jenis_jabatan"].options = <?php echo JsonEncode($m_kehadiran_edit->jenis_jabatan->lookupOptions()) ?>;
	fm_kehadiranedit.lists["x_jabatan"] = <?php echo $m_kehadiran_edit->jabatan->Lookup->toClientList($m_kehadiran_edit) ?>;
	fm_kehadiranedit.lists["x_jabatan"].options = <?php echo JsonEncode($m_kehadiran_edit->jabatan->lookupOptions()) ?>;
	fm_kehadiranedit.lists["x_sertif"] = <?php echo $m_kehadiran_edit->sertif->Lookup->toClientList($m_kehadiran_edit) ?>;
	fm_kehadiranedit.lists["x_sertif"].options = <?php echo JsonEncode($m_kehadiran_edit->sertif->lookupOptions()) ?>;
	loadjs.done("fm_kehadiranedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_kehadiran_edit->showPageHeader(); ?>
<?php
$m_kehadiran_edit->showMessage();
?>
<form name="fm_kehadiranedit" id="fm_kehadiranedit" class="<?php echo $m_kehadiran_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_kehadiran">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$m_kehadiran_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($m_kehadiran_edit->jenjang->Visible) { // jenjang ?>
	<div id="r_jenjang" class="form-group row">
		<label id="elh_m_kehadiran_jenjang" for="x_jenjang" class="<?php echo $m_kehadiran_edit->LeftColumnClass ?>"><?php echo $m_kehadiran_edit->jenjang->caption() ?><?php echo $m_kehadiran_edit->jenjang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_kehadiran_edit->RightColumnClass ?>"><div <?php echo $m_kehadiran_edit->jenjang->cellAttributes() ?>>
<span id="el_m_kehadiran_jenjang">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_jenjang"><?php echo EmptyValue(strval($m_kehadiran_edit->jenjang->ViewValue)) ? $Language->phrase("PleaseSelect") : $m_kehadiran_edit->jenjang->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($m_kehadiran_edit->jenjang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($m_kehadiran_edit->jenjang->ReadOnly || $m_kehadiran_edit->jenjang->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_jenjang',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $m_kehadiran_edit->jenjang->Lookup->getParamTag($m_kehadiran_edit, "p_x_jenjang") ?>
<input type="hidden" data-table="m_kehadiran" data-field="x_jenjang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $m_kehadiran_edit->jenjang->displayValueSeparatorAttribute() ?>" name="x_jenjang" id="x_jenjang" value="<?php echo $m_kehadiran_edit->jenjang->CurrentValue ?>"<?php echo $m_kehadiran_edit->jenjang->editAttributes() ?>>
</span>
<?php echo $m_kehadiran_edit->jenjang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_kehadiran_edit->jenis_jabatan->Visible) { // jenis_jabatan ?>
	<div id="r_jenis_jabatan" class="form-group row">
		<label id="elh_m_kehadiran_jenis_jabatan" for="x_jenis_jabatan" class="<?php echo $m_kehadiran_edit->LeftColumnClass ?>"><?php echo $m_kehadiran_edit->jenis_jabatan->caption() ?><?php echo $m_kehadiran_edit->jenis_jabatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_kehadiran_edit->RightColumnClass ?>"><div <?php echo $m_kehadiran_edit->jenis_jabatan->cellAttributes() ?>>
<span id="el_m_kehadiran_jenis_jabatan">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_jenis_jabatan"><?php echo EmptyValue(strval($m_kehadiran_edit->jenis_jabatan->ViewValue)) ? $Language->phrase("PleaseSelect") : $m_kehadiran_edit->jenis_jabatan->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($m_kehadiran_edit->jenis_jabatan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($m_kehadiran_edit->jenis_jabatan->ReadOnly || $m_kehadiran_edit->jenis_jabatan->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_jenis_jabatan',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $m_kehadiran_edit->jenis_jabatan->Lookup->getParamTag($m_kehadiran_edit, "p_x_jenis_jabatan") ?>
<input type="hidden" data-table="m_kehadiran" data-field="x_jenis_jabatan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $m_kehadiran_edit->jenis_jabatan->displayValueSeparatorAttribute() ?>" name="x_jenis_jabatan" id="x_jenis_jabatan" value="<?php echo $m_kehadiran_edit->jenis_jabatan->CurrentValue ?>"<?php echo $m_kehadiran_edit->jenis_jabatan->editAttributes() ?>>
</span>
<?php echo $m_kehadiran_edit->jenis_jabatan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_kehadiran_edit->jabatan->Visible) { // jabatan ?>
	<div id="r_jabatan" class="form-group row">
		<label id="elh_m_kehadiran_jabatan" for="x_jabatan" class="<?php echo $m_kehadiran_edit->LeftColumnClass ?>"><?php echo $m_kehadiran_edit->jabatan->caption() ?><?php echo $m_kehadiran_edit->jabatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_kehadiran_edit->RightColumnClass ?>"><div <?php echo $m_kehadiran_edit->jabatan->cellAttributes() ?>>
<span id="el_m_kehadiran_jabatan">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_jabatan"><?php echo EmptyValue(strval($m_kehadiran_edit->jabatan->ViewValue)) ? $Language->phrase("PleaseSelect") : $m_kehadiran_edit->jabatan->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($m_kehadiran_edit->jabatan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($m_kehadiran_edit->jabatan->ReadOnly || $m_kehadiran_edit->jabatan->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_jabatan',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $m_kehadiran_edit->jabatan->Lookup->getParamTag($m_kehadiran_edit, "p_x_jabatan") ?>
<input type="hidden" data-table="m_kehadiran" data-field="x_jabatan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $m_kehadiran_edit->jabatan->displayValueSeparatorAttribute() ?>" name="x_jabatan" id="x_jabatan" value="<?php echo $m_kehadiran_edit->jabatan->CurrentValue ?>"<?php echo $m_kehadiran_edit->jabatan->editAttributes() ?>>
</span>
<?php echo $m_kehadiran_edit->jabatan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_kehadiran_edit->sertif->Visible) { // sertif ?>
	<div id="r_sertif" class="form-group row">
		<label id="elh_m_kehadiran_sertif" for="x_sertif" class="<?php echo $m_kehadiran_edit->LeftColumnClass ?>"><?php echo $m_kehadiran_edit->sertif->caption() ?><?php echo $m_kehadiran_edit->sertif->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_kehadiran_edit->RightColumnClass ?>"><div <?php echo $m_kehadiran_edit->sertif->cellAttributes() ?>>
<span id="el_m_kehadiran_sertif">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_sertif"><?php echo EmptyValue(strval($m_kehadiran_edit->sertif->ViewValue)) ? $Language->phrase("PleaseSelect") : $m_kehadiran_edit->sertif->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($m_kehadiran_edit->sertif->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($m_kehadiran_edit->sertif->ReadOnly || $m_kehadiran_edit->sertif->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_sertif',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $m_kehadiran_edit->sertif->Lookup->getParamTag($m_kehadiran_edit, "p_x_sertif") ?>
<input type="hidden" data-table="m_kehadiran" data-field="x_sertif" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $m_kehadiran_edit->sertif->displayValueSeparatorAttribute() ?>" name="x_sertif" id="x_sertif" value="<?php echo $m_kehadiran_edit->sertif->CurrentValue ?>"<?php echo $m_kehadiran_edit->sertif->editAttributes() ?>>
</span>
<?php echo $m_kehadiran_edit->sertif->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_kehadiran_edit->value->Visible) { // value ?>
	<div id="r_value" class="form-group row">
		<label id="elh_m_kehadiran_value" for="x_value" class="<?php echo $m_kehadiran_edit->LeftColumnClass ?>"><?php echo $m_kehadiran_edit->value->caption() ?><?php echo $m_kehadiran_edit->value->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_kehadiran_edit->RightColumnClass ?>"><div <?php echo $m_kehadiran_edit->value->cellAttributes() ?>>
<span id="el_m_kehadiran_value">
<input type="text" data-table="m_kehadiran" data-field="x_value" name="x_value" id="x_value" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($m_kehadiran_edit->value->getPlaceHolder()) ?>" value="<?php echo $m_kehadiran_edit->value->EditValue ?>"<?php echo $m_kehadiran_edit->value->editAttributes() ?>>
</span>
<?php echo $m_kehadiran_edit->value->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="m_kehadiran" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($m_kehadiran_edit->id->CurrentValue) ?>">
<?php if (!$m_kehadiran_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $m_kehadiran_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_kehadiran_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$m_kehadiran_edit->showPageFooter();
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
$m_kehadiran_edit->terminate();
?>