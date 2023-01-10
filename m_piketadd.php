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
$m_piket_add = new m_piket_add();

// Run the page
$m_piket_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_piket_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_piketadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fm_piketadd = currentForm = new ew.Form("fm_piketadd", "add");

	// Validate form
	fm_piketadd.validate = function() {
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
			<?php if ($m_piket_add->jenjang->Required) { ?>
				elm = this.getElements("x" + infix + "_jenjang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_piket_add->jenjang->caption(), $m_piket_add->jenjang->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_piket_add->type_jabatan->Required) { ?>
				elm = this.getElements("x" + infix + "_type_jabatan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_piket_add->type_jabatan->caption(), $m_piket_add->type_jabatan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_piket_add->jenis_sertif->Required) { ?>
				elm = this.getElements("x" + infix + "_jenis_sertif");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_piket_add->jenis_sertif->caption(), $m_piket_add->jenis_sertif->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_piket_add->value->Required) { ?>
				elm = this.getElements("x" + infix + "_value");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_piket_add->value->caption(), $m_piket_add->value->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_value");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_piket_add->value->errorMessage()) ?>");

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
	fm_piketadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fm_piketadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fm_piketadd.lists["x_jenjang"] = <?php echo $m_piket_add->jenjang->Lookup->toClientList($m_piket_add) ?>;
	fm_piketadd.lists["x_jenjang"].options = <?php echo JsonEncode($m_piket_add->jenjang->lookupOptions()) ?>;
	fm_piketadd.lists["x_type_jabatan"] = <?php echo $m_piket_add->type_jabatan->Lookup->toClientList($m_piket_add) ?>;
	fm_piketadd.lists["x_type_jabatan"].options = <?php echo JsonEncode($m_piket_add->type_jabatan->lookupOptions()) ?>;
	fm_piketadd.lists["x_jenis_sertif"] = <?php echo $m_piket_add->jenis_sertif->Lookup->toClientList($m_piket_add) ?>;
	fm_piketadd.lists["x_jenis_sertif"].options = <?php echo JsonEncode($m_piket_add->jenis_sertif->lookupOptions()) ?>;
	loadjs.done("fm_piketadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_piket_add->showPageHeader(); ?>
<?php
$m_piket_add->showMessage();
?>
<form name="fm_piketadd" id="fm_piketadd" class="<?php echo $m_piket_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_piket">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$m_piket_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($m_piket_add->jenjang->Visible) { // jenjang ?>
	<div id="r_jenjang" class="form-group row">
		<label id="elh_m_piket_jenjang" for="x_jenjang" class="<?php echo $m_piket_add->LeftColumnClass ?>"><?php echo $m_piket_add->jenjang->caption() ?><?php echo $m_piket_add->jenjang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_piket_add->RightColumnClass ?>"><div <?php echo $m_piket_add->jenjang->cellAttributes() ?>>
<span id="el_m_piket_jenjang">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_jenjang"><?php echo EmptyValue(strval($m_piket_add->jenjang->ViewValue)) ? $Language->phrase("PleaseSelect") : $m_piket_add->jenjang->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($m_piket_add->jenjang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($m_piket_add->jenjang->ReadOnly || $m_piket_add->jenjang->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_jenjang',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $m_piket_add->jenjang->Lookup->getParamTag($m_piket_add, "p_x_jenjang") ?>
<input type="hidden" data-table="m_piket" data-field="x_jenjang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $m_piket_add->jenjang->displayValueSeparatorAttribute() ?>" name="x_jenjang" id="x_jenjang" value="<?php echo $m_piket_add->jenjang->CurrentValue ?>"<?php echo $m_piket_add->jenjang->editAttributes() ?>>
</span>
<?php echo $m_piket_add->jenjang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_piket_add->type_jabatan->Visible) { // type_jabatan ?>
	<div id="r_type_jabatan" class="form-group row">
		<label id="elh_m_piket_type_jabatan" for="x_type_jabatan" class="<?php echo $m_piket_add->LeftColumnClass ?>"><?php echo $m_piket_add->type_jabatan->caption() ?><?php echo $m_piket_add->type_jabatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_piket_add->RightColumnClass ?>"><div <?php echo $m_piket_add->type_jabatan->cellAttributes() ?>>
<span id="el_m_piket_type_jabatan">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_piket" data-field="x_type_jabatan" data-value-separator="<?php echo $m_piket_add->type_jabatan->displayValueSeparatorAttribute() ?>" id="x_type_jabatan" name="x_type_jabatan"<?php echo $m_piket_add->type_jabatan->editAttributes() ?>>
			<?php echo $m_piket_add->type_jabatan->selectOptionListHtml("x_type_jabatan") ?>
		</select>
</div>
<?php echo $m_piket_add->type_jabatan->Lookup->getParamTag($m_piket_add, "p_x_type_jabatan") ?>
</span>
<?php echo $m_piket_add->type_jabatan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_piket_add->jenis_sertif->Visible) { // jenis_sertif ?>
	<div id="r_jenis_sertif" class="form-group row">
		<label id="elh_m_piket_jenis_sertif" for="x_jenis_sertif" class="<?php echo $m_piket_add->LeftColumnClass ?>"><?php echo $m_piket_add->jenis_sertif->caption() ?><?php echo $m_piket_add->jenis_sertif->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_piket_add->RightColumnClass ?>"><div <?php echo $m_piket_add->jenis_sertif->cellAttributes() ?>>
<span id="el_m_piket_jenis_sertif">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_jenis_sertif"><?php echo EmptyValue(strval($m_piket_add->jenis_sertif->ViewValue)) ? $Language->phrase("PleaseSelect") : $m_piket_add->jenis_sertif->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($m_piket_add->jenis_sertif->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($m_piket_add->jenis_sertif->ReadOnly || $m_piket_add->jenis_sertif->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_jenis_sertif',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $m_piket_add->jenis_sertif->Lookup->getParamTag($m_piket_add, "p_x_jenis_sertif") ?>
<input type="hidden" data-table="m_piket" data-field="x_jenis_sertif" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $m_piket_add->jenis_sertif->displayValueSeparatorAttribute() ?>" name="x_jenis_sertif" id="x_jenis_sertif" value="<?php echo $m_piket_add->jenis_sertif->CurrentValue ?>"<?php echo $m_piket_add->jenis_sertif->editAttributes() ?>>
</span>
<?php echo $m_piket_add->jenis_sertif->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_piket_add->value->Visible) { // value ?>
	<div id="r_value" class="form-group row">
		<label id="elh_m_piket_value" for="x_value" class="<?php echo $m_piket_add->LeftColumnClass ?>"><?php echo $m_piket_add->value->caption() ?><?php echo $m_piket_add->value->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_piket_add->RightColumnClass ?>"><div <?php echo $m_piket_add->value->cellAttributes() ?>>
<span id="el_m_piket_value">
<input type="text" data-table="m_piket" data-field="x_value" name="x_value" id="x_value" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($m_piket_add->value->getPlaceHolder()) ?>" value="<?php echo $m_piket_add->value->EditValue ?>"<?php echo $m_piket_add->value->editAttributes() ?>>
</span>
<?php echo $m_piket_add->value->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$m_piket_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $m_piket_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_piket_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$m_piket_add->showPageFooter();
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
$m_piket_add->terminate();
?>