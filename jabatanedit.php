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
$jabatan_edit = new jabatan_edit();

// Run the page
$jabatan_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$jabatan_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fjabatanedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fjabatanedit = currentForm = new ew.Form("fjabatanedit", "edit");

	// Validate form
	fjabatanedit.validate = function() {
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
			<?php if ($jabatan_edit->nama_jabatan->Required) { ?>
				elm = this.getElements("x" + infix + "_nama_jabatan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $jabatan_edit->nama_jabatan->caption(), $jabatan_edit->nama_jabatan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($jabatan_edit->type_jabatan->Required) { ?>
				elm = this.getElements("x" + infix + "_type_jabatan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $jabatan_edit->type_jabatan->caption(), $jabatan_edit->type_jabatan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($jabatan_edit->jenjang->Required) { ?>
				elm = this.getElements("x" + infix + "_jenjang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $jabatan_edit->jenjang->caption(), $jabatan_edit->jenjang->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($jabatan_edit->type_guru->Required) { ?>
				elm = this.getElements("x" + infix + "_type_guru");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $jabatan_edit->type_guru->caption(), $jabatan_edit->type_guru->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_type_guru");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($jabatan_edit->type_guru->errorMessage()) ?>");
			<?php if ($jabatan_edit->keterangan->Required) { ?>
				elm = this.getElements("x" + infix + "_keterangan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $jabatan_edit->keterangan->caption(), $jabatan_edit->keterangan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($jabatan_edit->c_by->Required) { ?>
				elm = this.getElements("x" + infix + "_c_by");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $jabatan_edit->c_by->caption(), $jabatan_edit->c_by->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_c_by");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($jabatan_edit->c_by->errorMessage()) ?>");
			<?php if ($jabatan_edit->c_date->Required) { ?>
				elm = this.getElements("x" + infix + "_c_date");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $jabatan_edit->c_date->caption(), $jabatan_edit->c_date->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_c_date");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($jabatan_edit->c_date->errorMessage()) ?>");
			<?php if ($jabatan_edit->u_by->Required) { ?>
				elm = this.getElements("x" + infix + "_u_by");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $jabatan_edit->u_by->caption(), $jabatan_edit->u_by->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_u_by");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($jabatan_edit->u_by->errorMessage()) ?>");
			<?php if ($jabatan_edit->u_date->Required) { ?>
				elm = this.getElements("x" + infix + "_u_date");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $jabatan_edit->u_date->caption(), $jabatan_edit->u_date->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_u_date");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($jabatan_edit->u_date->errorMessage()) ?>");
			<?php if ($jabatan_edit->aktif->Required) { ?>
				elm = this.getElements("x" + infix + "_aktif");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $jabatan_edit->aktif->caption(), $jabatan_edit->aktif->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_aktif");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($jabatan_edit->aktif->errorMessage()) ?>");

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
	fjabatanedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fjabatanedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fjabatanedit.lists["x_type_jabatan"] = <?php echo $jabatan_edit->type_jabatan->Lookup->toClientList($jabatan_edit) ?>;
	fjabatanedit.lists["x_type_jabatan"].options = <?php echo JsonEncode($jabatan_edit->type_jabatan->lookupOptions()) ?>;
	fjabatanedit.lists["x_jenjang"] = <?php echo $jabatan_edit->jenjang->Lookup->toClientList($jabatan_edit) ?>;
	fjabatanedit.lists["x_jenjang"].options = <?php echo JsonEncode($jabatan_edit->jenjang->lookupOptions()) ?>;
	loadjs.done("fjabatanedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $jabatan_edit->showPageHeader(); ?>
<?php
$jabatan_edit->showMessage();
?>
<form name="fjabatanedit" id="fjabatanedit" class="<?php echo $jabatan_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="jabatan">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$jabatan_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($jabatan_edit->nama_jabatan->Visible) { // nama_jabatan ?>
	<div id="r_nama_jabatan" class="form-group row">
		<label id="elh_jabatan_nama_jabatan" for="x_nama_jabatan" class="<?php echo $jabatan_edit->LeftColumnClass ?>"><?php echo $jabatan_edit->nama_jabatan->caption() ?><?php echo $jabatan_edit->nama_jabatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $jabatan_edit->RightColumnClass ?>"><div <?php echo $jabatan_edit->nama_jabatan->cellAttributes() ?>>
<span id="el_jabatan_nama_jabatan">
<input type="text" data-table="jabatan" data-field="x_nama_jabatan" name="x_nama_jabatan" id="x_nama_jabatan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($jabatan_edit->nama_jabatan->getPlaceHolder()) ?>" value="<?php echo $jabatan_edit->nama_jabatan->EditValue ?>"<?php echo $jabatan_edit->nama_jabatan->editAttributes() ?>>
</span>
<?php echo $jabatan_edit->nama_jabatan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($jabatan_edit->type_jabatan->Visible) { // type_jabatan ?>
	<div id="r_type_jabatan" class="form-group row">
		<label id="elh_jabatan_type_jabatan" for="x_type_jabatan" class="<?php echo $jabatan_edit->LeftColumnClass ?>"><?php echo $jabatan_edit->type_jabatan->caption() ?><?php echo $jabatan_edit->type_jabatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $jabatan_edit->RightColumnClass ?>"><div <?php echo $jabatan_edit->type_jabatan->cellAttributes() ?>>
<span id="el_jabatan_type_jabatan">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_type_jabatan"><?php echo EmptyValue(strval($jabatan_edit->type_jabatan->ViewValue)) ? $Language->phrase("PleaseSelect") : $jabatan_edit->type_jabatan->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($jabatan_edit->type_jabatan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($jabatan_edit->type_jabatan->ReadOnly || $jabatan_edit->type_jabatan->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_type_jabatan',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $jabatan_edit->type_jabatan->Lookup->getParamTag($jabatan_edit, "p_x_type_jabatan") ?>
<input type="hidden" data-table="jabatan" data-field="x_type_jabatan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $jabatan_edit->type_jabatan->displayValueSeparatorAttribute() ?>" name="x_type_jabatan" id="x_type_jabatan" value="<?php echo $jabatan_edit->type_jabatan->CurrentValue ?>"<?php echo $jabatan_edit->type_jabatan->editAttributes() ?>>
</span>
<?php echo $jabatan_edit->type_jabatan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($jabatan_edit->jenjang->Visible) { // jenjang ?>
	<div id="r_jenjang" class="form-group row">
		<label id="elh_jabatan_jenjang" for="x_jenjang" class="<?php echo $jabatan_edit->LeftColumnClass ?>"><?php echo $jabatan_edit->jenjang->caption() ?><?php echo $jabatan_edit->jenjang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $jabatan_edit->RightColumnClass ?>"><div <?php echo $jabatan_edit->jenjang->cellAttributes() ?>>
<span id="el_jabatan_jenjang">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_jenjang"><?php echo EmptyValue(strval($jabatan_edit->jenjang->ViewValue)) ? $Language->phrase("PleaseSelect") : $jabatan_edit->jenjang->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($jabatan_edit->jenjang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($jabatan_edit->jenjang->ReadOnly || $jabatan_edit->jenjang->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_jenjang',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $jabatan_edit->jenjang->Lookup->getParamTag($jabatan_edit, "p_x_jenjang") ?>
<input type="hidden" data-table="jabatan" data-field="x_jenjang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $jabatan_edit->jenjang->displayValueSeparatorAttribute() ?>" name="x_jenjang" id="x_jenjang" value="<?php echo $jabatan_edit->jenjang->CurrentValue ?>"<?php echo $jabatan_edit->jenjang->editAttributes() ?>>
</span>
<?php echo $jabatan_edit->jenjang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($jabatan_edit->type_guru->Visible) { // type_guru ?>
	<div id="r_type_guru" class="form-group row">
		<label id="elh_jabatan_type_guru" for="x_type_guru" class="<?php echo $jabatan_edit->LeftColumnClass ?>"><?php echo $jabatan_edit->type_guru->caption() ?><?php echo $jabatan_edit->type_guru->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $jabatan_edit->RightColumnClass ?>"><div <?php echo $jabatan_edit->type_guru->cellAttributes() ?>>
<span id="el_jabatan_type_guru">
<input type="text" data-table="jabatan" data-field="x_type_guru" name="x_type_guru" id="x_type_guru" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($jabatan_edit->type_guru->getPlaceHolder()) ?>" value="<?php echo $jabatan_edit->type_guru->EditValue ?>"<?php echo $jabatan_edit->type_guru->editAttributes() ?>>
</span>
<?php echo $jabatan_edit->type_guru->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($jabatan_edit->keterangan->Visible) { // keterangan ?>
	<div id="r_keterangan" class="form-group row">
		<label id="elh_jabatan_keterangan" for="x_keterangan" class="<?php echo $jabatan_edit->LeftColumnClass ?>"><?php echo $jabatan_edit->keterangan->caption() ?><?php echo $jabatan_edit->keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $jabatan_edit->RightColumnClass ?>"><div <?php echo $jabatan_edit->keterangan->cellAttributes() ?>>
<span id="el_jabatan_keterangan">
<input type="text" data-table="jabatan" data-field="x_keterangan" name="x_keterangan" id="x_keterangan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($jabatan_edit->keterangan->getPlaceHolder()) ?>" value="<?php echo $jabatan_edit->keterangan->EditValue ?>"<?php echo $jabatan_edit->keterangan->editAttributes() ?>>
</span>
<?php echo $jabatan_edit->keterangan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($jabatan_edit->c_by->Visible) { // c_by ?>
	<div id="r_c_by" class="form-group row">
		<label id="elh_jabatan_c_by" for="x_c_by" class="<?php echo $jabatan_edit->LeftColumnClass ?>"><?php echo $jabatan_edit->c_by->caption() ?><?php echo $jabatan_edit->c_by->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $jabatan_edit->RightColumnClass ?>"><div <?php echo $jabatan_edit->c_by->cellAttributes() ?>>
<span id="el_jabatan_c_by">
<input type="text" data-table="jabatan" data-field="x_c_by" name="x_c_by" id="x_c_by" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($jabatan_edit->c_by->getPlaceHolder()) ?>" value="<?php echo $jabatan_edit->c_by->EditValue ?>"<?php echo $jabatan_edit->c_by->editAttributes() ?>>
</span>
<?php echo $jabatan_edit->c_by->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($jabatan_edit->c_date->Visible) { // c_date ?>
	<div id="r_c_date" class="form-group row">
		<label id="elh_jabatan_c_date" for="x_c_date" class="<?php echo $jabatan_edit->LeftColumnClass ?>"><?php echo $jabatan_edit->c_date->caption() ?><?php echo $jabatan_edit->c_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $jabatan_edit->RightColumnClass ?>"><div <?php echo $jabatan_edit->c_date->cellAttributes() ?>>
<span id="el_jabatan_c_date">
<input type="text" data-table="jabatan" data-field="x_c_date" name="x_c_date" id="x_c_date" maxlength="19" placeholder="<?php echo HtmlEncode($jabatan_edit->c_date->getPlaceHolder()) ?>" value="<?php echo $jabatan_edit->c_date->EditValue ?>"<?php echo $jabatan_edit->c_date->editAttributes() ?>>
<?php if (!$jabatan_edit->c_date->ReadOnly && !$jabatan_edit->c_date->Disabled && !isset($jabatan_edit->c_date->EditAttrs["readonly"]) && !isset($jabatan_edit->c_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjabatanedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fjabatanedit", "x_c_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $jabatan_edit->c_date->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($jabatan_edit->u_by->Visible) { // u_by ?>
	<div id="r_u_by" class="form-group row">
		<label id="elh_jabatan_u_by" for="x_u_by" class="<?php echo $jabatan_edit->LeftColumnClass ?>"><?php echo $jabatan_edit->u_by->caption() ?><?php echo $jabatan_edit->u_by->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $jabatan_edit->RightColumnClass ?>"><div <?php echo $jabatan_edit->u_by->cellAttributes() ?>>
<span id="el_jabatan_u_by">
<input type="text" data-table="jabatan" data-field="x_u_by" name="x_u_by" id="x_u_by" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($jabatan_edit->u_by->getPlaceHolder()) ?>" value="<?php echo $jabatan_edit->u_by->EditValue ?>"<?php echo $jabatan_edit->u_by->editAttributes() ?>>
</span>
<?php echo $jabatan_edit->u_by->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($jabatan_edit->u_date->Visible) { // u_date ?>
	<div id="r_u_date" class="form-group row">
		<label id="elh_jabatan_u_date" for="x_u_date" class="<?php echo $jabatan_edit->LeftColumnClass ?>"><?php echo $jabatan_edit->u_date->caption() ?><?php echo $jabatan_edit->u_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $jabatan_edit->RightColumnClass ?>"><div <?php echo $jabatan_edit->u_date->cellAttributes() ?>>
<span id="el_jabatan_u_date">
<input type="text" data-table="jabatan" data-field="x_u_date" name="x_u_date" id="x_u_date" maxlength="19" placeholder="<?php echo HtmlEncode($jabatan_edit->u_date->getPlaceHolder()) ?>" value="<?php echo $jabatan_edit->u_date->EditValue ?>"<?php echo $jabatan_edit->u_date->editAttributes() ?>>
<?php if (!$jabatan_edit->u_date->ReadOnly && !$jabatan_edit->u_date->Disabled && !isset($jabatan_edit->u_date->EditAttrs["readonly"]) && !isset($jabatan_edit->u_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjabatanedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fjabatanedit", "x_u_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $jabatan_edit->u_date->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($jabatan_edit->aktif->Visible) { // aktif ?>
	<div id="r_aktif" class="form-group row">
		<label id="elh_jabatan_aktif" for="x_aktif" class="<?php echo $jabatan_edit->LeftColumnClass ?>"><?php echo $jabatan_edit->aktif->caption() ?><?php echo $jabatan_edit->aktif->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $jabatan_edit->RightColumnClass ?>"><div <?php echo $jabatan_edit->aktif->cellAttributes() ?>>
<span id="el_jabatan_aktif">
<input type="text" data-table="jabatan" data-field="x_aktif" name="x_aktif" id="x_aktif" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($jabatan_edit->aktif->getPlaceHolder()) ?>" value="<?php echo $jabatan_edit->aktif->EditValue ?>"<?php echo $jabatan_edit->aktif->editAttributes() ?>>
</span>
<?php echo $jabatan_edit->aktif->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="jabatan" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($jabatan_edit->id->CurrentValue) ?>">
<?php
	if (in_array("gajitunjangan", explode(",", $jabatan->getCurrentDetailTable())) && $gajitunjangan->DetailEdit) {
?>
<?php if ($jabatan->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("gajitunjangan", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "gajitunjangangrid.php" ?>
<?php } ?>
<?php if (!$jabatan_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $jabatan_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $jabatan_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$jabatan_edit->showPageFooter();
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
$jabatan_edit->terminate();
?>