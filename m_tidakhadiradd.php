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
$m_tidakhadir_add = new m_tidakhadir_add();

// Run the page
$m_tidakhadir_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_tidakhadir_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_tidakhadiradd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fm_tidakhadiradd = currentForm = new ew.Form("fm_tidakhadiradd", "add");

	// Validate form
	fm_tidakhadiradd.validate = function() {
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
			<?php if ($m_tidakhadir_add->jenjang_id->Required) { ?>
				elm = this.getElements("x" + infix + "_jenjang_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_tidakhadir_add->jenjang_id->caption(), $m_tidakhadir_add->jenjang_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_tidakhadir_add->jabatan_id->Required) { ?>
				elm = this.getElements("x" + infix + "_jabatan_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_tidakhadir_add->jabatan_id->caption(), $m_tidakhadir_add->jabatan_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_tidakhadir_add->value->Required) { ?>
				elm = this.getElements("x" + infix + "_value");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_tidakhadir_add->value->caption(), $m_tidakhadir_add->value->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_value");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_tidakhadir_add->value->errorMessage()) ?>");
			<?php if ($m_tidakhadir_add->perjam_value->Required) { ?>
				elm = this.getElements("x" + infix + "_perjam_value");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_tidakhadir_add->perjam_value->caption(), $m_tidakhadir_add->perjam_value->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_perjam_value");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_tidakhadir_add->perjam_value->errorMessage()) ?>");

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
	fm_tidakhadiradd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fm_tidakhadiradd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fm_tidakhadiradd.lists["x_jenjang_id"] = <?php echo $m_tidakhadir_add->jenjang_id->Lookup->toClientList($m_tidakhadir_add) ?>;
	fm_tidakhadiradd.lists["x_jenjang_id"].options = <?php echo JsonEncode($m_tidakhadir_add->jenjang_id->lookupOptions()) ?>;
	fm_tidakhadiradd.lists["x_jabatan_id"] = <?php echo $m_tidakhadir_add->jabatan_id->Lookup->toClientList($m_tidakhadir_add) ?>;
	fm_tidakhadiradd.lists["x_jabatan_id"].options = <?php echo JsonEncode($m_tidakhadir_add->jabatan_id->lookupOptions()) ?>;
	loadjs.done("fm_tidakhadiradd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_tidakhadir_add->showPageHeader(); ?>
<?php
$m_tidakhadir_add->showMessage();
?>
<form name="fm_tidakhadiradd" id="fm_tidakhadiradd" class="<?php echo $m_tidakhadir_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_tidakhadir">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$m_tidakhadir_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($m_tidakhadir_add->jenjang_id->Visible) { // jenjang_id ?>
	<div id="r_jenjang_id" class="form-group row">
		<label id="elh_m_tidakhadir_jenjang_id" for="x_jenjang_id" class="<?php echo $m_tidakhadir_add->LeftColumnClass ?>"><?php echo $m_tidakhadir_add->jenjang_id->caption() ?><?php echo $m_tidakhadir_add->jenjang_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_tidakhadir_add->RightColumnClass ?>"><div <?php echo $m_tidakhadir_add->jenjang_id->cellAttributes() ?>>
<span id="el_m_tidakhadir_jenjang_id">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_jenjang_id"><?php echo EmptyValue(strval($m_tidakhadir_add->jenjang_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $m_tidakhadir_add->jenjang_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($m_tidakhadir_add->jenjang_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($m_tidakhadir_add->jenjang_id->ReadOnly || $m_tidakhadir_add->jenjang_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_jenjang_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $m_tidakhadir_add->jenjang_id->Lookup->getParamTag($m_tidakhadir_add, "p_x_jenjang_id") ?>
<input type="hidden" data-table="m_tidakhadir" data-field="x_jenjang_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $m_tidakhadir_add->jenjang_id->displayValueSeparatorAttribute() ?>" name="x_jenjang_id" id="x_jenjang_id" value="<?php echo $m_tidakhadir_add->jenjang_id->CurrentValue ?>"<?php echo $m_tidakhadir_add->jenjang_id->editAttributes() ?>>
</span>
<?php echo $m_tidakhadir_add->jenjang_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_tidakhadir_add->jabatan_id->Visible) { // jabatan_id ?>
	<div id="r_jabatan_id" class="form-group row">
		<label id="elh_m_tidakhadir_jabatan_id" for="x_jabatan_id" class="<?php echo $m_tidakhadir_add->LeftColumnClass ?>"><?php echo $m_tidakhadir_add->jabatan_id->caption() ?><?php echo $m_tidakhadir_add->jabatan_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_tidakhadir_add->RightColumnClass ?>"><div <?php echo $m_tidakhadir_add->jabatan_id->cellAttributes() ?>>
<span id="el_m_tidakhadir_jabatan_id">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_jabatan_id"><?php echo EmptyValue(strval($m_tidakhadir_add->jabatan_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $m_tidakhadir_add->jabatan_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($m_tidakhadir_add->jabatan_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($m_tidakhadir_add->jabatan_id->ReadOnly || $m_tidakhadir_add->jabatan_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_jabatan_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $m_tidakhadir_add->jabatan_id->Lookup->getParamTag($m_tidakhadir_add, "p_x_jabatan_id") ?>
<input type="hidden" data-table="m_tidakhadir" data-field="x_jabatan_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $m_tidakhadir_add->jabatan_id->displayValueSeparatorAttribute() ?>" name="x_jabatan_id" id="x_jabatan_id" value="<?php echo $m_tidakhadir_add->jabatan_id->CurrentValue ?>"<?php echo $m_tidakhadir_add->jabatan_id->editAttributes() ?>>
</span>
<?php echo $m_tidakhadir_add->jabatan_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_tidakhadir_add->value->Visible) { // value ?>
	<div id="r_value" class="form-group row">
		<label id="elh_m_tidakhadir_value" for="x_value" class="<?php echo $m_tidakhadir_add->LeftColumnClass ?>"><?php echo $m_tidakhadir_add->value->caption() ?><?php echo $m_tidakhadir_add->value->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_tidakhadir_add->RightColumnClass ?>"><div <?php echo $m_tidakhadir_add->value->cellAttributes() ?>>
<span id="el_m_tidakhadir_value">
<input type="text" data-table="m_tidakhadir" data-field="x_value" name="x_value" id="x_value" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($m_tidakhadir_add->value->getPlaceHolder()) ?>" value="<?php echo $m_tidakhadir_add->value->EditValue ?>"<?php echo $m_tidakhadir_add->value->editAttributes() ?>>
</span>
<?php echo $m_tidakhadir_add->value->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_tidakhadir_add->perjam_value->Visible) { // perjam_value ?>
	<div id="r_perjam_value" class="form-group row">
		<label id="elh_m_tidakhadir_perjam_value" for="x_perjam_value" class="<?php echo $m_tidakhadir_add->LeftColumnClass ?>"><?php echo $m_tidakhadir_add->perjam_value->caption() ?><?php echo $m_tidakhadir_add->perjam_value->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_tidakhadir_add->RightColumnClass ?>"><div <?php echo $m_tidakhadir_add->perjam_value->cellAttributes() ?>>
<span id="el_m_tidakhadir_perjam_value">
<input type="text" data-table="m_tidakhadir" data-field="x_perjam_value" name="x_perjam_value" id="x_perjam_value" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($m_tidakhadir_add->perjam_value->getPlaceHolder()) ?>" value="<?php echo $m_tidakhadir_add->perjam_value->EditValue ?>"<?php echo $m_tidakhadir_add->perjam_value->editAttributes() ?>>
</span>
<?php echo $m_tidakhadir_add->perjam_value->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$m_tidakhadir_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $m_tidakhadir_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_tidakhadir_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$m_tidakhadir_add->showPageFooter();
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
$m_tidakhadir_add->terminate();
?>