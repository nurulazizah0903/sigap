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
$tunjangan_berkala_edit = new tunjangan_berkala_edit();

// Run the page
$tunjangan_berkala_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tunjangan_berkala_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftunjangan_berkalaedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ftunjangan_berkalaedit = currentForm = new ew.Form("ftunjangan_berkalaedit", "edit");

	// Validate form
	ftunjangan_berkalaedit.validate = function() {
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
			<?php if ($tunjangan_berkala_edit->jenjang->Required) { ?>
				elm = this.getElements("x" + infix + "_jenjang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tunjangan_berkala_edit->jenjang->caption(), $tunjangan_berkala_edit->jenjang->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tunjangan_berkala_edit->kualifikasi->Required) { ?>
				elm = this.getElements("x" + infix + "_kualifikasi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tunjangan_berkala_edit->kualifikasi->caption(), $tunjangan_berkala_edit->kualifikasi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tunjangan_berkala_edit->lama->Required) { ?>
				elm = this.getElements("x" + infix + "_lama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tunjangan_berkala_edit->lama->caption(), $tunjangan_berkala_edit->lama->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_lama");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($tunjangan_berkala_edit->lama->errorMessage()) ?>");
			<?php if ($tunjangan_berkala_edit->value->Required) { ?>
				elm = this.getElements("x" + infix + "_value");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tunjangan_berkala_edit->value->caption(), $tunjangan_berkala_edit->value->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_value");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($tunjangan_berkala_edit->value->errorMessage()) ?>");

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
	ftunjangan_berkalaedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ftunjangan_berkalaedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ftunjangan_berkalaedit.lists["x_jenjang"] = <?php echo $tunjangan_berkala_edit->jenjang->Lookup->toClientList($tunjangan_berkala_edit) ?>;
	ftunjangan_berkalaedit.lists["x_jenjang"].options = <?php echo JsonEncode($tunjangan_berkala_edit->jenjang->lookupOptions()) ?>;
	ftunjangan_berkalaedit.lists["x_kualifikasi"] = <?php echo $tunjangan_berkala_edit->kualifikasi->Lookup->toClientList($tunjangan_berkala_edit) ?>;
	ftunjangan_berkalaedit.lists["x_kualifikasi"].options = <?php echo JsonEncode($tunjangan_berkala_edit->kualifikasi->lookupOptions()) ?>;
	loadjs.done("ftunjangan_berkalaedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tunjangan_berkala_edit->showPageHeader(); ?>
<?php
$tunjangan_berkala_edit->showMessage();
?>
<form name="ftunjangan_berkalaedit" id="ftunjangan_berkalaedit" class="<?php echo $tunjangan_berkala_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tunjangan_berkala">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$tunjangan_berkala_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($tunjangan_berkala_edit->jenjang->Visible) { // jenjang ?>
	<div id="r_jenjang" class="form-group row">
		<label id="elh_tunjangan_berkala_jenjang" for="x_jenjang" class="<?php echo $tunjangan_berkala_edit->LeftColumnClass ?>"><?php echo $tunjangan_berkala_edit->jenjang->caption() ?><?php echo $tunjangan_berkala_edit->jenjang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tunjangan_berkala_edit->RightColumnClass ?>"><div <?php echo $tunjangan_berkala_edit->jenjang->cellAttributes() ?>>
<span id="el_tunjangan_berkala_jenjang">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_jenjang"><?php echo EmptyValue(strval($tunjangan_berkala_edit->jenjang->ViewValue)) ? $Language->phrase("PleaseSelect") : $tunjangan_berkala_edit->jenjang->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($tunjangan_berkala_edit->jenjang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($tunjangan_berkala_edit->jenjang->ReadOnly || $tunjangan_berkala_edit->jenjang->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_jenjang',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $tunjangan_berkala_edit->jenjang->Lookup->getParamTag($tunjangan_berkala_edit, "p_x_jenjang") ?>
<input type="hidden" data-table="tunjangan_berkala" data-field="x_jenjang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $tunjangan_berkala_edit->jenjang->displayValueSeparatorAttribute() ?>" name="x_jenjang" id="x_jenjang" value="<?php echo $tunjangan_berkala_edit->jenjang->CurrentValue ?>"<?php echo $tunjangan_berkala_edit->jenjang->editAttributes() ?>>
</span>
<?php echo $tunjangan_berkala_edit->jenjang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tunjangan_berkala_edit->kualifikasi->Visible) { // kualifikasi ?>
	<div id="r_kualifikasi" class="form-group row">
		<label id="elh_tunjangan_berkala_kualifikasi" for="x_kualifikasi" class="<?php echo $tunjangan_berkala_edit->LeftColumnClass ?>"><?php echo $tunjangan_berkala_edit->kualifikasi->caption() ?><?php echo $tunjangan_berkala_edit->kualifikasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tunjangan_berkala_edit->RightColumnClass ?>"><div <?php echo $tunjangan_berkala_edit->kualifikasi->cellAttributes() ?>>
<span id="el_tunjangan_berkala_kualifikasi">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_kualifikasi"><?php echo EmptyValue(strval($tunjangan_berkala_edit->kualifikasi->ViewValue)) ? $Language->phrase("PleaseSelect") : $tunjangan_berkala_edit->kualifikasi->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($tunjangan_berkala_edit->kualifikasi->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($tunjangan_berkala_edit->kualifikasi->ReadOnly || $tunjangan_berkala_edit->kualifikasi->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_kualifikasi',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $tunjangan_berkala_edit->kualifikasi->Lookup->getParamTag($tunjangan_berkala_edit, "p_x_kualifikasi") ?>
<input type="hidden" data-table="tunjangan_berkala" data-field="x_kualifikasi" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $tunjangan_berkala_edit->kualifikasi->displayValueSeparatorAttribute() ?>" name="x_kualifikasi" id="x_kualifikasi" value="<?php echo $tunjangan_berkala_edit->kualifikasi->CurrentValue ?>"<?php echo $tunjangan_berkala_edit->kualifikasi->editAttributes() ?>>
</span>
<?php echo $tunjangan_berkala_edit->kualifikasi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tunjangan_berkala_edit->lama->Visible) { // lama ?>
	<div id="r_lama" class="form-group row">
		<label id="elh_tunjangan_berkala_lama" for="x_lama" class="<?php echo $tunjangan_berkala_edit->LeftColumnClass ?>"><?php echo $tunjangan_berkala_edit->lama->caption() ?><?php echo $tunjangan_berkala_edit->lama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tunjangan_berkala_edit->RightColumnClass ?>"><div <?php echo $tunjangan_berkala_edit->lama->cellAttributes() ?>>
<span id="el_tunjangan_berkala_lama">
<input type="text" data-table="tunjangan_berkala" data-field="x_lama" name="x_lama" id="x_lama" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($tunjangan_berkala_edit->lama->getPlaceHolder()) ?>" value="<?php echo $tunjangan_berkala_edit->lama->EditValue ?>"<?php echo $tunjangan_berkala_edit->lama->editAttributes() ?>>
</span>
<?php echo $tunjangan_berkala_edit->lama->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tunjangan_berkala_edit->value->Visible) { // value ?>
	<div id="r_value" class="form-group row">
		<label id="elh_tunjangan_berkala_value" for="x_value" class="<?php echo $tunjangan_berkala_edit->LeftColumnClass ?>"><?php echo $tunjangan_berkala_edit->value->caption() ?><?php echo $tunjangan_berkala_edit->value->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tunjangan_berkala_edit->RightColumnClass ?>"><div <?php echo $tunjangan_berkala_edit->value->cellAttributes() ?>>
<span id="el_tunjangan_berkala_value">
<input type="text" data-table="tunjangan_berkala" data-field="x_value" name="x_value" id="x_value" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($tunjangan_berkala_edit->value->getPlaceHolder()) ?>" value="<?php echo $tunjangan_berkala_edit->value->EditValue ?>"<?php echo $tunjangan_berkala_edit->value->editAttributes() ?>>
</span>
<?php echo $tunjangan_berkala_edit->value->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="tunjangan_berkala" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($tunjangan_berkala_edit->id->CurrentValue) ?>">
<?php if (!$tunjangan_berkala_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tunjangan_berkala_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tunjangan_berkala_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tunjangan_berkala_edit->showPageFooter();
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
$tunjangan_berkala_edit->terminate();
?>