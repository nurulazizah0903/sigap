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
$gaji_pokok_tu_edit = new gaji_pokok_tu_edit();

// Run the page
$gaji_pokok_tu_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gaji_pokok_tu_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fgaji_pokok_tuedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fgaji_pokok_tuedit = currentForm = new ew.Form("fgaji_pokok_tuedit", "edit");

	// Validate form
	fgaji_pokok_tuedit.validate = function() {
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
			<?php if ($gaji_pokok_tu_edit->jenjang_id->Required) { ?>
				elm = this.getElements("x" + infix + "_jenjang_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_pokok_tu_edit->jenjang_id->caption(), $gaji_pokok_tu_edit->jenjang_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($gaji_pokok_tu_edit->ijazah->Required) { ?>
				elm = this.getElements("x" + infix + "_ijazah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_pokok_tu_edit->ijazah->caption(), $gaji_pokok_tu_edit->ijazah->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($gaji_pokok_tu_edit->lama_kerja->Required) { ?>
				elm = this.getElements("x" + infix + "_lama_kerja");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_pokok_tu_edit->lama_kerja->caption(), $gaji_pokok_tu_edit->lama_kerja->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_lama_kerja");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_pokok_tu_edit->lama_kerja->errorMessage()) ?>");
			<?php if ($gaji_pokok_tu_edit->value->Required) { ?>
				elm = this.getElements("x" + infix + "_value");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_pokok_tu_edit->value->caption(), $gaji_pokok_tu_edit->value->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_value");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_pokok_tu_edit->value->errorMessage()) ?>");

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
	fgaji_pokok_tuedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fgaji_pokok_tuedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fgaji_pokok_tuedit.lists["x_jenjang_id"] = <?php echo $gaji_pokok_tu_edit->jenjang_id->Lookup->toClientList($gaji_pokok_tu_edit) ?>;
	fgaji_pokok_tuedit.lists["x_jenjang_id"].options = <?php echo JsonEncode($gaji_pokok_tu_edit->jenjang_id->lookupOptions()) ?>;
	fgaji_pokok_tuedit.lists["x_ijazah"] = <?php echo $gaji_pokok_tu_edit->ijazah->Lookup->toClientList($gaji_pokok_tu_edit) ?>;
	fgaji_pokok_tuedit.lists["x_ijazah"].options = <?php echo JsonEncode($gaji_pokok_tu_edit->ijazah->lookupOptions()) ?>;
	loadjs.done("fgaji_pokok_tuedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $gaji_pokok_tu_edit->showPageHeader(); ?>
<?php
$gaji_pokok_tu_edit->showMessage();
?>
<form name="fgaji_pokok_tuedit" id="fgaji_pokok_tuedit" class="<?php echo $gaji_pokok_tu_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gaji_pokok_tu">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$gaji_pokok_tu_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($gaji_pokok_tu_edit->jenjang_id->Visible) { // jenjang_id ?>
	<div id="r_jenjang_id" class="form-group row">
		<label id="elh_gaji_pokok_tu_jenjang_id" for="x_jenjang_id" class="<?php echo $gaji_pokok_tu_edit->LeftColumnClass ?>"><?php echo $gaji_pokok_tu_edit->jenjang_id->caption() ?><?php echo $gaji_pokok_tu_edit->jenjang_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_pokok_tu_edit->RightColumnClass ?>"><div <?php echo $gaji_pokok_tu_edit->jenjang_id->cellAttributes() ?>>
<span id="el_gaji_pokok_tu_jenjang_id">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_jenjang_id"><?php echo EmptyValue(strval($gaji_pokok_tu_edit->jenjang_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $gaji_pokok_tu_edit->jenjang_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($gaji_pokok_tu_edit->jenjang_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($gaji_pokok_tu_edit->jenjang_id->ReadOnly || $gaji_pokok_tu_edit->jenjang_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_jenjang_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $gaji_pokok_tu_edit->jenjang_id->Lookup->getParamTag($gaji_pokok_tu_edit, "p_x_jenjang_id") ?>
<input type="hidden" data-table="gaji_pokok_tu" data-field="x_jenjang_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $gaji_pokok_tu_edit->jenjang_id->displayValueSeparatorAttribute() ?>" name="x_jenjang_id" id="x_jenjang_id" value="<?php echo $gaji_pokok_tu_edit->jenjang_id->CurrentValue ?>"<?php echo $gaji_pokok_tu_edit->jenjang_id->editAttributes() ?>>
</span>
<?php echo $gaji_pokok_tu_edit->jenjang_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_pokok_tu_edit->ijazah->Visible) { // ijazah ?>
	<div id="r_ijazah" class="form-group row">
		<label id="elh_gaji_pokok_tu_ijazah" for="x_ijazah" class="<?php echo $gaji_pokok_tu_edit->LeftColumnClass ?>"><?php echo $gaji_pokok_tu_edit->ijazah->caption() ?><?php echo $gaji_pokok_tu_edit->ijazah->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_pokok_tu_edit->RightColumnClass ?>"><div <?php echo $gaji_pokok_tu_edit->ijazah->cellAttributes() ?>>
<span id="el_gaji_pokok_tu_ijazah">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="gaji_pokok_tu" data-field="x_ijazah" data-value-separator="<?php echo $gaji_pokok_tu_edit->ijazah->displayValueSeparatorAttribute() ?>" id="x_ijazah" name="x_ijazah"<?php echo $gaji_pokok_tu_edit->ijazah->editAttributes() ?>>
			<?php echo $gaji_pokok_tu_edit->ijazah->selectOptionListHtml("x_ijazah") ?>
		</select>
</div>
<?php echo $gaji_pokok_tu_edit->ijazah->Lookup->getParamTag($gaji_pokok_tu_edit, "p_x_ijazah") ?>
</span>
<?php echo $gaji_pokok_tu_edit->ijazah->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_pokok_tu_edit->lama_kerja->Visible) { // lama_kerja ?>
	<div id="r_lama_kerja" class="form-group row">
		<label id="elh_gaji_pokok_tu_lama_kerja" for="x_lama_kerja" class="<?php echo $gaji_pokok_tu_edit->LeftColumnClass ?>"><?php echo $gaji_pokok_tu_edit->lama_kerja->caption() ?><?php echo $gaji_pokok_tu_edit->lama_kerja->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_pokok_tu_edit->RightColumnClass ?>"><div <?php echo $gaji_pokok_tu_edit->lama_kerja->cellAttributes() ?>>
<span id="el_gaji_pokok_tu_lama_kerja">
<input type="text" data-table="gaji_pokok_tu" data-field="x_lama_kerja" name="x_lama_kerja" id="x_lama_kerja" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($gaji_pokok_tu_edit->lama_kerja->getPlaceHolder()) ?>" value="<?php echo $gaji_pokok_tu_edit->lama_kerja->EditValue ?>"<?php echo $gaji_pokok_tu_edit->lama_kerja->editAttributes() ?>>
</span>
<?php echo $gaji_pokok_tu_edit->lama_kerja->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gaji_pokok_tu_edit->value->Visible) { // value ?>
	<div id="r_value" class="form-group row">
		<label id="elh_gaji_pokok_tu_value" for="x_value" class="<?php echo $gaji_pokok_tu_edit->LeftColumnClass ?>"><?php echo $gaji_pokok_tu_edit->value->caption() ?><?php echo $gaji_pokok_tu_edit->value->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gaji_pokok_tu_edit->RightColumnClass ?>"><div <?php echo $gaji_pokok_tu_edit->value->cellAttributes() ?>>
<span id="el_gaji_pokok_tu_value">
<input type="text" data-table="gaji_pokok_tu" data-field="x_value" name="x_value" id="x_value" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_pokok_tu_edit->value->getPlaceHolder()) ?>" value="<?php echo $gaji_pokok_tu_edit->value->EditValue ?>"<?php echo $gaji_pokok_tu_edit->value->editAttributes() ?>>
</span>
<?php echo $gaji_pokok_tu_edit->value->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="gaji_pokok_tu" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($gaji_pokok_tu_edit->id->CurrentValue) ?>">
<?php if (!$gaji_pokok_tu_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $gaji_pokok_tu_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $gaji_pokok_tu_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$gaji_pokok_tu_edit->showPageFooter();
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
$gaji_pokok_tu_edit->terminate();
?>