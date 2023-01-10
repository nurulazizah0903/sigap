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
$proyek_edit = new proyek_edit();

// Run the page
$proyek_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$proyek_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fproyekedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fproyekedit = currentForm = new ew.Form("fproyekedit", "edit");

	// Validate form
	fproyekedit.validate = function() {
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
			<?php if ($proyek_edit->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $proyek_edit->id->caption(), $proyek_edit->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($proyek_edit->klien->Required) { ?>
				elm = this.getElements("x" + infix + "_klien");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $proyek_edit->klien->caption(), $proyek_edit->klien->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($proyek_edit->proyek->Required) { ?>
				elm = this.getElements("x" + infix + "_proyek");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $proyek_edit->proyek->caption(), $proyek_edit->proyek->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($proyek_edit->tgl_awal->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_awal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $proyek_edit->tgl_awal->caption(), $proyek_edit->tgl_awal->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_awal");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($proyek_edit->tgl_awal->errorMessage()) ?>");
			<?php if ($proyek_edit->tgl_akhir->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_akhir");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $proyek_edit->tgl_akhir->caption(), $proyek_edit->tgl_akhir->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_akhir");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($proyek_edit->tgl_akhir->errorMessage()) ?>");
			<?php if ($proyek_edit->file_proyek->Required) { ?>
				felm = this.getElements("x" + infix + "_file_proyek");
				elm = this.getElements("fn_x" + infix + "_file_proyek");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $proyek_edit->file_proyek->caption(), $proyek_edit->file_proyek->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($proyek_edit->aktif->Required) { ?>
				elm = this.getElements("x" + infix + "_aktif");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $proyek_edit->aktif->caption(), $proyek_edit->aktif->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_aktif");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($proyek_edit->aktif->errorMessage()) ?>");

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
	fproyekedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fproyekedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fproyekedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $proyek_edit->showPageHeader(); ?>
<?php
$proyek_edit->showMessage();
?>
<form name="fproyekedit" id="fproyekedit" class="<?php echo $proyek_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="proyek">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$proyek_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($proyek_edit->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_proyek_id" class="<?php echo $proyek_edit->LeftColumnClass ?>"><?php echo $proyek_edit->id->caption() ?><?php echo $proyek_edit->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $proyek_edit->RightColumnClass ?>"><div <?php echo $proyek_edit->id->cellAttributes() ?>>
<span id="el_proyek_id">
<span<?php echo $proyek_edit->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($proyek_edit->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="proyek" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($proyek_edit->id->CurrentValue) ?>">
<?php echo $proyek_edit->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($proyek_edit->klien->Visible) { // klien ?>
	<div id="r_klien" class="form-group row">
		<label id="elh_proyek_klien" for="x_klien" class="<?php echo $proyek_edit->LeftColumnClass ?>"><?php echo $proyek_edit->klien->caption() ?><?php echo $proyek_edit->klien->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $proyek_edit->RightColumnClass ?>"><div <?php echo $proyek_edit->klien->cellAttributes() ?>>
<span id="el_proyek_klien">
<input type="text" data-table="proyek" data-field="x_klien" name="x_klien" id="x_klien" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($proyek_edit->klien->getPlaceHolder()) ?>" value="<?php echo $proyek_edit->klien->EditValue ?>"<?php echo $proyek_edit->klien->editAttributes() ?>>
</span>
<?php echo $proyek_edit->klien->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($proyek_edit->proyek->Visible) { // proyek ?>
	<div id="r_proyek" class="form-group row">
		<label id="elh_proyek_proyek" for="x_proyek" class="<?php echo $proyek_edit->LeftColumnClass ?>"><?php echo $proyek_edit->proyek->caption() ?><?php echo $proyek_edit->proyek->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $proyek_edit->RightColumnClass ?>"><div <?php echo $proyek_edit->proyek->cellAttributes() ?>>
<span id="el_proyek_proyek">
<input type="text" data-table="proyek" data-field="x_proyek" name="x_proyek" id="x_proyek" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($proyek_edit->proyek->getPlaceHolder()) ?>" value="<?php echo $proyek_edit->proyek->EditValue ?>"<?php echo $proyek_edit->proyek->editAttributes() ?>>
</span>
<?php echo $proyek_edit->proyek->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($proyek_edit->tgl_awal->Visible) { // tgl_awal ?>
	<div id="r_tgl_awal" class="form-group row">
		<label id="elh_proyek_tgl_awal" for="x_tgl_awal" class="<?php echo $proyek_edit->LeftColumnClass ?>"><?php echo $proyek_edit->tgl_awal->caption() ?><?php echo $proyek_edit->tgl_awal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $proyek_edit->RightColumnClass ?>"><div <?php echo $proyek_edit->tgl_awal->cellAttributes() ?>>
<span id="el_proyek_tgl_awal">
<input type="text" data-table="proyek" data-field="x_tgl_awal" name="x_tgl_awal" id="x_tgl_awal" maxlength="10" placeholder="<?php echo HtmlEncode($proyek_edit->tgl_awal->getPlaceHolder()) ?>" value="<?php echo $proyek_edit->tgl_awal->EditValue ?>"<?php echo $proyek_edit->tgl_awal->editAttributes() ?>>
<?php if (!$proyek_edit->tgl_awal->ReadOnly && !$proyek_edit->tgl_awal->Disabled && !isset($proyek_edit->tgl_awal->EditAttrs["readonly"]) && !isset($proyek_edit->tgl_awal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fproyekedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fproyekedit", "x_tgl_awal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $proyek_edit->tgl_awal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($proyek_edit->tgl_akhir->Visible) { // tgl_akhir ?>
	<div id="r_tgl_akhir" class="form-group row">
		<label id="elh_proyek_tgl_akhir" for="x_tgl_akhir" class="<?php echo $proyek_edit->LeftColumnClass ?>"><?php echo $proyek_edit->tgl_akhir->caption() ?><?php echo $proyek_edit->tgl_akhir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $proyek_edit->RightColumnClass ?>"><div <?php echo $proyek_edit->tgl_akhir->cellAttributes() ?>>
<span id="el_proyek_tgl_akhir">
<input type="text" data-table="proyek" data-field="x_tgl_akhir" name="x_tgl_akhir" id="x_tgl_akhir" maxlength="10" placeholder="<?php echo HtmlEncode($proyek_edit->tgl_akhir->getPlaceHolder()) ?>" value="<?php echo $proyek_edit->tgl_akhir->EditValue ?>"<?php echo $proyek_edit->tgl_akhir->editAttributes() ?>>
<?php if (!$proyek_edit->tgl_akhir->ReadOnly && !$proyek_edit->tgl_akhir->Disabled && !isset($proyek_edit->tgl_akhir->EditAttrs["readonly"]) && !isset($proyek_edit->tgl_akhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fproyekedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fproyekedit", "x_tgl_akhir", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $proyek_edit->tgl_akhir->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($proyek_edit->file_proyek->Visible) { // file_proyek ?>
	<div id="r_file_proyek" class="form-group row">
		<label id="elh_proyek_file_proyek" class="<?php echo $proyek_edit->LeftColumnClass ?>"><?php echo $proyek_edit->file_proyek->caption() ?><?php echo $proyek_edit->file_proyek->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $proyek_edit->RightColumnClass ?>"><div <?php echo $proyek_edit->file_proyek->cellAttributes() ?>>
<span id="el_proyek_file_proyek">
<div id="fd_x_file_proyek">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $proyek_edit->file_proyek->title() ?>" data-table="proyek" data-field="x_file_proyek" name="x_file_proyek" id="x_file_proyek" lang="<?php echo CurrentLanguageID() ?>"<?php echo $proyek_edit->file_proyek->editAttributes() ?><?php if ($proyek_edit->file_proyek->ReadOnly || $proyek_edit->file_proyek->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_file_proyek"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_file_proyek" id= "fn_x_file_proyek" value="<?php echo $proyek_edit->file_proyek->Upload->FileName ?>">
<input type="hidden" name="fa_x_file_proyek" id= "fa_x_file_proyek" value="<?php echo (Post("fa_x_file_proyek") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_file_proyek" id= "fs_x_file_proyek" value="255">
<input type="hidden" name="fx_x_file_proyek" id= "fx_x_file_proyek" value="<?php echo $proyek_edit->file_proyek->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_file_proyek" id= "fm_x_file_proyek" value="<?php echo $proyek_edit->file_proyek->UploadMaxFileSize ?>">
</div>
<table id="ft_x_file_proyek" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $proyek_edit->file_proyek->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($proyek_edit->aktif->Visible) { // aktif ?>
	<div id="r_aktif" class="form-group row">
		<label id="elh_proyek_aktif" for="x_aktif" class="<?php echo $proyek_edit->LeftColumnClass ?>"><?php echo $proyek_edit->aktif->caption() ?><?php echo $proyek_edit->aktif->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $proyek_edit->RightColumnClass ?>"><div <?php echo $proyek_edit->aktif->cellAttributes() ?>>
<span id="el_proyek_aktif">
<input type="text" data-table="proyek" data-field="x_aktif" name="x_aktif" id="x_aktif" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($proyek_edit->aktif->getPlaceHolder()) ?>" value="<?php echo $proyek_edit->aktif->EditValue ?>"<?php echo $proyek_edit->aktif->editAttributes() ?>>
</span>
<?php echo $proyek_edit->aktif->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$proyek_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $proyek_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $proyek_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$proyek_edit->showPageFooter();
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
$proyek_edit->terminate();
?>