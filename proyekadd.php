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
$proyek_add = new proyek_add();

// Run the page
$proyek_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$proyek_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fproyekadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fproyekadd = currentForm = new ew.Form("fproyekadd", "add");

	// Validate form
	fproyekadd.validate = function() {
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
			<?php if ($proyek_add->klien->Required) { ?>
				elm = this.getElements("x" + infix + "_klien");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $proyek_add->klien->caption(), $proyek_add->klien->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($proyek_add->proyek->Required) { ?>
				elm = this.getElements("x" + infix + "_proyek");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $proyek_add->proyek->caption(), $proyek_add->proyek->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($proyek_add->tgl_awal->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_awal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $proyek_add->tgl_awal->caption(), $proyek_add->tgl_awal->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_awal");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($proyek_add->tgl_awal->errorMessage()) ?>");
			<?php if ($proyek_add->tgl_akhir->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_akhir");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $proyek_add->tgl_akhir->caption(), $proyek_add->tgl_akhir->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_akhir");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($proyek_add->tgl_akhir->errorMessage()) ?>");
			<?php if ($proyek_add->file_proyek->Required) { ?>
				felm = this.getElements("x" + infix + "_file_proyek");
				elm = this.getElements("fn_x" + infix + "_file_proyek");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $proyek_add->file_proyek->caption(), $proyek_add->file_proyek->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($proyek_add->aktif->Required) { ?>
				elm = this.getElements("x" + infix + "_aktif");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $proyek_add->aktif->caption(), $proyek_add->aktif->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_aktif");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($proyek_add->aktif->errorMessage()) ?>");

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
	fproyekadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fproyekadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fproyekadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $proyek_add->showPageHeader(); ?>
<?php
$proyek_add->showMessage();
?>
<form name="fproyekadd" id="fproyekadd" class="<?php echo $proyek_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="proyek">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$proyek_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($proyek_add->klien->Visible) { // klien ?>
	<div id="r_klien" class="form-group row">
		<label id="elh_proyek_klien" for="x_klien" class="<?php echo $proyek_add->LeftColumnClass ?>"><?php echo $proyek_add->klien->caption() ?><?php echo $proyek_add->klien->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $proyek_add->RightColumnClass ?>"><div <?php echo $proyek_add->klien->cellAttributes() ?>>
<span id="el_proyek_klien">
<input type="text" data-table="proyek" data-field="x_klien" name="x_klien" id="x_klien" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($proyek_add->klien->getPlaceHolder()) ?>" value="<?php echo $proyek_add->klien->EditValue ?>"<?php echo $proyek_add->klien->editAttributes() ?>>
</span>
<?php echo $proyek_add->klien->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($proyek_add->proyek->Visible) { // proyek ?>
	<div id="r_proyek" class="form-group row">
		<label id="elh_proyek_proyek" for="x_proyek" class="<?php echo $proyek_add->LeftColumnClass ?>"><?php echo $proyek_add->proyek->caption() ?><?php echo $proyek_add->proyek->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $proyek_add->RightColumnClass ?>"><div <?php echo $proyek_add->proyek->cellAttributes() ?>>
<span id="el_proyek_proyek">
<input type="text" data-table="proyek" data-field="x_proyek" name="x_proyek" id="x_proyek" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($proyek_add->proyek->getPlaceHolder()) ?>" value="<?php echo $proyek_add->proyek->EditValue ?>"<?php echo $proyek_add->proyek->editAttributes() ?>>
</span>
<?php echo $proyek_add->proyek->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($proyek_add->tgl_awal->Visible) { // tgl_awal ?>
	<div id="r_tgl_awal" class="form-group row">
		<label id="elh_proyek_tgl_awal" for="x_tgl_awal" class="<?php echo $proyek_add->LeftColumnClass ?>"><?php echo $proyek_add->tgl_awal->caption() ?><?php echo $proyek_add->tgl_awal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $proyek_add->RightColumnClass ?>"><div <?php echo $proyek_add->tgl_awal->cellAttributes() ?>>
<span id="el_proyek_tgl_awal">
<input type="text" data-table="proyek" data-field="x_tgl_awal" name="x_tgl_awal" id="x_tgl_awal" maxlength="10" placeholder="<?php echo HtmlEncode($proyek_add->tgl_awal->getPlaceHolder()) ?>" value="<?php echo $proyek_add->tgl_awal->EditValue ?>"<?php echo $proyek_add->tgl_awal->editAttributes() ?>>
<?php if (!$proyek_add->tgl_awal->ReadOnly && !$proyek_add->tgl_awal->Disabled && !isset($proyek_add->tgl_awal->EditAttrs["readonly"]) && !isset($proyek_add->tgl_awal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fproyekadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fproyekadd", "x_tgl_awal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $proyek_add->tgl_awal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($proyek_add->tgl_akhir->Visible) { // tgl_akhir ?>
	<div id="r_tgl_akhir" class="form-group row">
		<label id="elh_proyek_tgl_akhir" for="x_tgl_akhir" class="<?php echo $proyek_add->LeftColumnClass ?>"><?php echo $proyek_add->tgl_akhir->caption() ?><?php echo $proyek_add->tgl_akhir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $proyek_add->RightColumnClass ?>"><div <?php echo $proyek_add->tgl_akhir->cellAttributes() ?>>
<span id="el_proyek_tgl_akhir">
<input type="text" data-table="proyek" data-field="x_tgl_akhir" name="x_tgl_akhir" id="x_tgl_akhir" maxlength="10" placeholder="<?php echo HtmlEncode($proyek_add->tgl_akhir->getPlaceHolder()) ?>" value="<?php echo $proyek_add->tgl_akhir->EditValue ?>"<?php echo $proyek_add->tgl_akhir->editAttributes() ?>>
<?php if (!$proyek_add->tgl_akhir->ReadOnly && !$proyek_add->tgl_akhir->Disabled && !isset($proyek_add->tgl_akhir->EditAttrs["readonly"]) && !isset($proyek_add->tgl_akhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fproyekadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fproyekadd", "x_tgl_akhir", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $proyek_add->tgl_akhir->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($proyek_add->file_proyek->Visible) { // file_proyek ?>
	<div id="r_file_proyek" class="form-group row">
		<label id="elh_proyek_file_proyek" class="<?php echo $proyek_add->LeftColumnClass ?>"><?php echo $proyek_add->file_proyek->caption() ?><?php echo $proyek_add->file_proyek->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $proyek_add->RightColumnClass ?>"><div <?php echo $proyek_add->file_proyek->cellAttributes() ?>>
<span id="el_proyek_file_proyek">
<div id="fd_x_file_proyek">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $proyek_add->file_proyek->title() ?>" data-table="proyek" data-field="x_file_proyek" name="x_file_proyek" id="x_file_proyek" lang="<?php echo CurrentLanguageID() ?>"<?php echo $proyek_add->file_proyek->editAttributes() ?><?php if ($proyek_add->file_proyek->ReadOnly || $proyek_add->file_proyek->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_file_proyek"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_file_proyek" id= "fn_x_file_proyek" value="<?php echo $proyek_add->file_proyek->Upload->FileName ?>">
<input type="hidden" name="fa_x_file_proyek" id= "fa_x_file_proyek" value="0">
<input type="hidden" name="fs_x_file_proyek" id= "fs_x_file_proyek" value="255">
<input type="hidden" name="fx_x_file_proyek" id= "fx_x_file_proyek" value="<?php echo $proyek_add->file_proyek->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_file_proyek" id= "fm_x_file_proyek" value="<?php echo $proyek_add->file_proyek->UploadMaxFileSize ?>">
</div>
<table id="ft_x_file_proyek" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $proyek_add->file_proyek->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($proyek_add->aktif->Visible) { // aktif ?>
	<div id="r_aktif" class="form-group row">
		<label id="elh_proyek_aktif" for="x_aktif" class="<?php echo $proyek_add->LeftColumnClass ?>"><?php echo $proyek_add->aktif->caption() ?><?php echo $proyek_add->aktif->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $proyek_add->RightColumnClass ?>"><div <?php echo $proyek_add->aktif->cellAttributes() ?>>
<span id="el_proyek_aktif">
<input type="text" data-table="proyek" data-field="x_aktif" name="x_aktif" id="x_aktif" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($proyek_add->aktif->getPlaceHolder()) ?>" value="<?php echo $proyek_add->aktif->EditValue ?>"<?php echo $proyek_add->aktif->editAttributes() ?>>
</span>
<?php echo $proyek_add->aktif->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$proyek_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $proyek_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $proyek_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$proyek_add->showPageFooter();
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
$proyek_add->terminate();
?>