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
$jabatan_add = new jabatan_add();

// Run the page
$jabatan_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$jabatan_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fjabatanadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fjabatanadd = currentForm = new ew.Form("fjabatanadd", "add");

	// Validate form
	fjabatanadd.validate = function() {
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
			<?php if ($jabatan_add->nama_jabatan->Required) { ?>
				elm = this.getElements("x" + infix + "_nama_jabatan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $jabatan_add->nama_jabatan->caption(), $jabatan_add->nama_jabatan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($jabatan_add->type_jabatan->Required) { ?>
				elm = this.getElements("x" + infix + "_type_jabatan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $jabatan_add->type_jabatan->caption(), $jabatan_add->type_jabatan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($jabatan_add->jenjang->Required) { ?>
				elm = this.getElements("x" + infix + "_jenjang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $jabatan_add->jenjang->caption(), $jabatan_add->jenjang->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($jabatan_add->type_guru->Required) { ?>
				elm = this.getElements("x" + infix + "_type_guru");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $jabatan_add->type_guru->caption(), $jabatan_add->type_guru->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_type_guru");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($jabatan_add->type_guru->errorMessage()) ?>");
			<?php if ($jabatan_add->keterangan->Required) { ?>
				elm = this.getElements("x" + infix + "_keterangan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $jabatan_add->keterangan->caption(), $jabatan_add->keterangan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($jabatan_add->c_by->Required) { ?>
				elm = this.getElements("x" + infix + "_c_by");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $jabatan_add->c_by->caption(), $jabatan_add->c_by->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_c_by");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($jabatan_add->c_by->errorMessage()) ?>");
			<?php if ($jabatan_add->c_date->Required) { ?>
				elm = this.getElements("x" + infix + "_c_date");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $jabatan_add->c_date->caption(), $jabatan_add->c_date->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_c_date");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($jabatan_add->c_date->errorMessage()) ?>");
			<?php if ($jabatan_add->u_by->Required) { ?>
				elm = this.getElements("x" + infix + "_u_by");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $jabatan_add->u_by->caption(), $jabatan_add->u_by->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_u_by");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($jabatan_add->u_by->errorMessage()) ?>");
			<?php if ($jabatan_add->u_date->Required) { ?>
				elm = this.getElements("x" + infix + "_u_date");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $jabatan_add->u_date->caption(), $jabatan_add->u_date->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_u_date");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($jabatan_add->u_date->errorMessage()) ?>");
			<?php if ($jabatan_add->aktif->Required) { ?>
				elm = this.getElements("x" + infix + "_aktif");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $jabatan_add->aktif->caption(), $jabatan_add->aktif->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_aktif");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($jabatan_add->aktif->errorMessage()) ?>");

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
	fjabatanadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fjabatanadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fjabatanadd.lists["x_type_jabatan"] = <?php echo $jabatan_add->type_jabatan->Lookup->toClientList($jabatan_add) ?>;
	fjabatanadd.lists["x_type_jabatan"].options = <?php echo JsonEncode($jabatan_add->type_jabatan->lookupOptions()) ?>;
	fjabatanadd.lists["x_jenjang"] = <?php echo $jabatan_add->jenjang->Lookup->toClientList($jabatan_add) ?>;
	fjabatanadd.lists["x_jenjang"].options = <?php echo JsonEncode($jabatan_add->jenjang->lookupOptions()) ?>;
	loadjs.done("fjabatanadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $jabatan_add->showPageHeader(); ?>
<?php
$jabatan_add->showMessage();
?>
<form name="fjabatanadd" id="fjabatanadd" class="<?php echo $jabatan_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="jabatan">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$jabatan_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($jabatan_add->nama_jabatan->Visible) { // nama_jabatan ?>
	<div id="r_nama_jabatan" class="form-group row">
		<label id="elh_jabatan_nama_jabatan" for="x_nama_jabatan" class="<?php echo $jabatan_add->LeftColumnClass ?>"><?php echo $jabatan_add->nama_jabatan->caption() ?><?php echo $jabatan_add->nama_jabatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $jabatan_add->RightColumnClass ?>"><div <?php echo $jabatan_add->nama_jabatan->cellAttributes() ?>>
<span id="el_jabatan_nama_jabatan">
<input type="text" data-table="jabatan" data-field="x_nama_jabatan" name="x_nama_jabatan" id="x_nama_jabatan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($jabatan_add->nama_jabatan->getPlaceHolder()) ?>" value="<?php echo $jabatan_add->nama_jabatan->EditValue ?>"<?php echo $jabatan_add->nama_jabatan->editAttributes() ?>>
</span>
<?php echo $jabatan_add->nama_jabatan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($jabatan_add->type_jabatan->Visible) { // type_jabatan ?>
	<div id="r_type_jabatan" class="form-group row">
		<label id="elh_jabatan_type_jabatan" for="x_type_jabatan" class="<?php echo $jabatan_add->LeftColumnClass ?>"><?php echo $jabatan_add->type_jabatan->caption() ?><?php echo $jabatan_add->type_jabatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $jabatan_add->RightColumnClass ?>"><div <?php echo $jabatan_add->type_jabatan->cellAttributes() ?>>
<span id="el_jabatan_type_jabatan">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_type_jabatan"><?php echo EmptyValue(strval($jabatan_add->type_jabatan->ViewValue)) ? $Language->phrase("PleaseSelect") : $jabatan_add->type_jabatan->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($jabatan_add->type_jabatan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($jabatan_add->type_jabatan->ReadOnly || $jabatan_add->type_jabatan->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_type_jabatan',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $jabatan_add->type_jabatan->Lookup->getParamTag($jabatan_add, "p_x_type_jabatan") ?>
<input type="hidden" data-table="jabatan" data-field="x_type_jabatan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $jabatan_add->type_jabatan->displayValueSeparatorAttribute() ?>" name="x_type_jabatan" id="x_type_jabatan" value="<?php echo $jabatan_add->type_jabatan->CurrentValue ?>"<?php echo $jabatan_add->type_jabatan->editAttributes() ?>>
</span>
<?php echo $jabatan_add->type_jabatan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($jabatan_add->jenjang->Visible) { // jenjang ?>
	<div id="r_jenjang" class="form-group row">
		<label id="elh_jabatan_jenjang" for="x_jenjang" class="<?php echo $jabatan_add->LeftColumnClass ?>"><?php echo $jabatan_add->jenjang->caption() ?><?php echo $jabatan_add->jenjang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $jabatan_add->RightColumnClass ?>"><div <?php echo $jabatan_add->jenjang->cellAttributes() ?>>
<span id="el_jabatan_jenjang">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_jenjang"><?php echo EmptyValue(strval($jabatan_add->jenjang->ViewValue)) ? $Language->phrase("PleaseSelect") : $jabatan_add->jenjang->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($jabatan_add->jenjang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($jabatan_add->jenjang->ReadOnly || $jabatan_add->jenjang->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_jenjang',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $jabatan_add->jenjang->Lookup->getParamTag($jabatan_add, "p_x_jenjang") ?>
<input type="hidden" data-table="jabatan" data-field="x_jenjang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $jabatan_add->jenjang->displayValueSeparatorAttribute() ?>" name="x_jenjang" id="x_jenjang" value="<?php echo $jabatan_add->jenjang->CurrentValue ?>"<?php echo $jabatan_add->jenjang->editAttributes() ?>>
</span>
<?php echo $jabatan_add->jenjang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($jabatan_add->type_guru->Visible) { // type_guru ?>
	<div id="r_type_guru" class="form-group row">
		<label id="elh_jabatan_type_guru" for="x_type_guru" class="<?php echo $jabatan_add->LeftColumnClass ?>"><?php echo $jabatan_add->type_guru->caption() ?><?php echo $jabatan_add->type_guru->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $jabatan_add->RightColumnClass ?>"><div <?php echo $jabatan_add->type_guru->cellAttributes() ?>>
<span id="el_jabatan_type_guru">
<input type="text" data-table="jabatan" data-field="x_type_guru" name="x_type_guru" id="x_type_guru" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($jabatan_add->type_guru->getPlaceHolder()) ?>" value="<?php echo $jabatan_add->type_guru->EditValue ?>"<?php echo $jabatan_add->type_guru->editAttributes() ?>>
</span>
<?php echo $jabatan_add->type_guru->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($jabatan_add->keterangan->Visible) { // keterangan ?>
	<div id="r_keterangan" class="form-group row">
		<label id="elh_jabatan_keterangan" for="x_keterangan" class="<?php echo $jabatan_add->LeftColumnClass ?>"><?php echo $jabatan_add->keterangan->caption() ?><?php echo $jabatan_add->keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $jabatan_add->RightColumnClass ?>"><div <?php echo $jabatan_add->keterangan->cellAttributes() ?>>
<span id="el_jabatan_keterangan">
<input type="text" data-table="jabatan" data-field="x_keterangan" name="x_keterangan" id="x_keterangan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($jabatan_add->keterangan->getPlaceHolder()) ?>" value="<?php echo $jabatan_add->keterangan->EditValue ?>"<?php echo $jabatan_add->keterangan->editAttributes() ?>>
</span>
<?php echo $jabatan_add->keterangan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($jabatan_add->c_by->Visible) { // c_by ?>
	<div id="r_c_by" class="form-group row">
		<label id="elh_jabatan_c_by" for="x_c_by" class="<?php echo $jabatan_add->LeftColumnClass ?>"><?php echo $jabatan_add->c_by->caption() ?><?php echo $jabatan_add->c_by->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $jabatan_add->RightColumnClass ?>"><div <?php echo $jabatan_add->c_by->cellAttributes() ?>>
<span id="el_jabatan_c_by">
<input type="text" data-table="jabatan" data-field="x_c_by" name="x_c_by" id="x_c_by" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($jabatan_add->c_by->getPlaceHolder()) ?>" value="<?php echo $jabatan_add->c_by->EditValue ?>"<?php echo $jabatan_add->c_by->editAttributes() ?>>
</span>
<?php echo $jabatan_add->c_by->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($jabatan_add->c_date->Visible) { // c_date ?>
	<div id="r_c_date" class="form-group row">
		<label id="elh_jabatan_c_date" for="x_c_date" class="<?php echo $jabatan_add->LeftColumnClass ?>"><?php echo $jabatan_add->c_date->caption() ?><?php echo $jabatan_add->c_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $jabatan_add->RightColumnClass ?>"><div <?php echo $jabatan_add->c_date->cellAttributes() ?>>
<span id="el_jabatan_c_date">
<input type="text" data-table="jabatan" data-field="x_c_date" name="x_c_date" id="x_c_date" maxlength="19" placeholder="<?php echo HtmlEncode($jabatan_add->c_date->getPlaceHolder()) ?>" value="<?php echo $jabatan_add->c_date->EditValue ?>"<?php echo $jabatan_add->c_date->editAttributes() ?>>
<?php if (!$jabatan_add->c_date->ReadOnly && !$jabatan_add->c_date->Disabled && !isset($jabatan_add->c_date->EditAttrs["readonly"]) && !isset($jabatan_add->c_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjabatanadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fjabatanadd", "x_c_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $jabatan_add->c_date->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($jabatan_add->u_by->Visible) { // u_by ?>
	<div id="r_u_by" class="form-group row">
		<label id="elh_jabatan_u_by" for="x_u_by" class="<?php echo $jabatan_add->LeftColumnClass ?>"><?php echo $jabatan_add->u_by->caption() ?><?php echo $jabatan_add->u_by->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $jabatan_add->RightColumnClass ?>"><div <?php echo $jabatan_add->u_by->cellAttributes() ?>>
<span id="el_jabatan_u_by">
<input type="text" data-table="jabatan" data-field="x_u_by" name="x_u_by" id="x_u_by" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($jabatan_add->u_by->getPlaceHolder()) ?>" value="<?php echo $jabatan_add->u_by->EditValue ?>"<?php echo $jabatan_add->u_by->editAttributes() ?>>
</span>
<?php echo $jabatan_add->u_by->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($jabatan_add->u_date->Visible) { // u_date ?>
	<div id="r_u_date" class="form-group row">
		<label id="elh_jabatan_u_date" for="x_u_date" class="<?php echo $jabatan_add->LeftColumnClass ?>"><?php echo $jabatan_add->u_date->caption() ?><?php echo $jabatan_add->u_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $jabatan_add->RightColumnClass ?>"><div <?php echo $jabatan_add->u_date->cellAttributes() ?>>
<span id="el_jabatan_u_date">
<input type="text" data-table="jabatan" data-field="x_u_date" name="x_u_date" id="x_u_date" maxlength="19" placeholder="<?php echo HtmlEncode($jabatan_add->u_date->getPlaceHolder()) ?>" value="<?php echo $jabatan_add->u_date->EditValue ?>"<?php echo $jabatan_add->u_date->editAttributes() ?>>
<?php if (!$jabatan_add->u_date->ReadOnly && !$jabatan_add->u_date->Disabled && !isset($jabatan_add->u_date->EditAttrs["readonly"]) && !isset($jabatan_add->u_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjabatanadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fjabatanadd", "x_u_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $jabatan_add->u_date->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($jabatan_add->aktif->Visible) { // aktif ?>
	<div id="r_aktif" class="form-group row">
		<label id="elh_jabatan_aktif" for="x_aktif" class="<?php echo $jabatan_add->LeftColumnClass ?>"><?php echo $jabatan_add->aktif->caption() ?><?php echo $jabatan_add->aktif->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $jabatan_add->RightColumnClass ?>"><div <?php echo $jabatan_add->aktif->cellAttributes() ?>>
<span id="el_jabatan_aktif">
<input type="text" data-table="jabatan" data-field="x_aktif" name="x_aktif" id="x_aktif" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($jabatan_add->aktif->getPlaceHolder()) ?>" value="<?php echo $jabatan_add->aktif->EditValue ?>"<?php echo $jabatan_add->aktif->editAttributes() ?>>
</span>
<?php echo $jabatan_add->aktif->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("gajitunjangan", explode(",", $jabatan->getCurrentDetailTable())) && $gajitunjangan->DetailAdd) {
?>
<?php if ($jabatan->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("gajitunjangan", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "gajitunjangangrid.php" ?>
<?php } ?>
<?php if (!$jabatan_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $jabatan_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $jabatan_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$jabatan_add->showPageFooter();
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
$jabatan_add->terminate();
?>