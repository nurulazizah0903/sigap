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
$ijin_edit = new ijin_edit();

// Run the page
$ijin_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ijin_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fijinedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fijinedit = currentForm = new ew.Form("fijinedit", "edit");

	// Validate form
	fijinedit.validate = function() {
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
			<?php if ($ijin_edit->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ijin_edit->id->caption(), $ijin_edit->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ijin_edit->pegawai->Required) { ?>
				elm = this.getElements("x" + infix + "_pegawai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ijin_edit->pegawai->caption(), $ijin_edit->pegawai->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pegawai");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ijin_edit->pegawai->errorMessage()) ?>");
			<?php if ($ijin_edit->tgl->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ijin_edit->tgl->caption(), $ijin_edit->tgl->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ijin_edit->tgl_ijin_awal->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_ijin_awal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ijin_edit->tgl_ijin_awal->caption(), $ijin_edit->tgl_ijin_awal->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_ijin_awal");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ijin_edit->tgl_ijin_awal->errorMessage()) ?>");
			<?php if ($ijin_edit->tgl_ijin_akhir->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_ijin_akhir");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ijin_edit->tgl_ijin_akhir->caption(), $ijin_edit->tgl_ijin_akhir->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_ijin_akhir");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ijin_edit->tgl_ijin_akhir->errorMessage()) ?>");
			<?php if ($ijin_edit->jenis->Required) { ?>
				elm = this.getElements("x" + infix + "_jenis");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ijin_edit->jenis->caption(), $ijin_edit->jenis->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ijin_edit->keterangan->Required) { ?>
				elm = this.getElements("x" + infix + "_keterangan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ijin_edit->keterangan->caption(), $ijin_edit->keterangan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ijin_edit->disetujui->Required) { ?>
				elm = this.getElements("x" + infix + "_disetujui");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ijin_edit->disetujui->caption(), $ijin_edit->disetujui->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ijin_edit->dokumen->Required) { ?>
				felm = this.getElements("x" + infix + "_dokumen");
				elm = this.getElements("fn_x" + infix + "_dokumen");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $ijin_edit->dokumen->caption(), $ijin_edit->dokumen->RequiredErrorMessage)) ?>");
			<?php } ?>

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
	fijinedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fijinedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fijinedit.lists["x_pegawai"] = <?php echo $ijin_edit->pegawai->Lookup->toClientList($ijin_edit) ?>;
	fijinedit.lists["x_pegawai"].options = <?php echo JsonEncode($ijin_edit->pegawai->lookupOptions()) ?>;
	fijinedit.autoSuggests["x_pegawai"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fijinedit.lists["x_disetujui"] = <?php echo $ijin_edit->disetujui->Lookup->toClientList($ijin_edit) ?>;
	fijinedit.lists["x_disetujui"].options = <?php echo JsonEncode($ijin_edit->disetujui->options(FALSE, TRUE)) ?>;
	loadjs.done("fijinedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ijin_edit->showPageHeader(); ?>
<?php
$ijin_edit->showMessage();
?>
<form name="fijinedit" id="fijinedit" class="<?php echo $ijin_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ijin">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$ijin_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($ijin_edit->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_ijin_id" class="<?php echo $ijin_edit->LeftColumnClass ?>"><?php echo $ijin_edit->id->caption() ?><?php echo $ijin_edit->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ijin_edit->RightColumnClass ?>"><div <?php echo $ijin_edit->id->cellAttributes() ?>>
<span id="el_ijin_id">
<span<?php echo $ijin_edit->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ijin_edit->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="ijin" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($ijin_edit->id->CurrentValue) ?>">
<?php echo $ijin_edit->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ijin_edit->pegawai->Visible) { // pegawai ?>
	<div id="r_pegawai" class="form-group row">
		<label id="elh_ijin_pegawai" class="<?php echo $ijin_edit->LeftColumnClass ?>"><?php echo $ijin_edit->pegawai->caption() ?><?php echo $ijin_edit->pegawai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ijin_edit->RightColumnClass ?>"><div <?php echo $ijin_edit->pegawai->cellAttributes() ?>>
<span id="el_ijin_pegawai">
<?php
$onchange = $ijin_edit->pegawai->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$ijin_edit->pegawai->EditAttrs["onchange"] = "";
?>
<span id="as_x_pegawai">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_pegawai" id="sv_x_pegawai" value="<?php echo RemoveHtml($ijin_edit->pegawai->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($ijin_edit->pegawai->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($ijin_edit->pegawai->getPlaceHolder()) ?>"<?php echo $ijin_edit->pegawai->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($ijin_edit->pegawai->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_pegawai',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($ijin_edit->pegawai->ReadOnly || $ijin_edit->pegawai->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="ijin" data-field="x_pegawai" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $ijin_edit->pegawai->displayValueSeparatorAttribute() ?>" name="x_pegawai" id="x_pegawai" value="<?php echo HtmlEncode($ijin_edit->pegawai->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fijinedit"], function() {
	fijinedit.createAutoSuggest({"id":"x_pegawai","forceSelect":false});
});
</script>
<?php echo $ijin_edit->pegawai->Lookup->getParamTag($ijin_edit, "p_x_pegawai") ?>
</span>
<?php echo $ijin_edit->pegawai->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ijin_edit->tgl_ijin_awal->Visible) { // tgl_ijin_awal ?>
	<div id="r_tgl_ijin_awal" class="form-group row">
		<label id="elh_ijin_tgl_ijin_awal" for="x_tgl_ijin_awal" class="<?php echo $ijin_edit->LeftColumnClass ?>"><?php echo $ijin_edit->tgl_ijin_awal->caption() ?><?php echo $ijin_edit->tgl_ijin_awal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ijin_edit->RightColumnClass ?>"><div <?php echo $ijin_edit->tgl_ijin_awal->cellAttributes() ?>>
<span id="el_ijin_tgl_ijin_awal">
<input type="text" data-table="ijin" data-field="x_tgl_ijin_awal" name="x_tgl_ijin_awal" id="x_tgl_ijin_awal" maxlength="10" placeholder="<?php echo HtmlEncode($ijin_edit->tgl_ijin_awal->getPlaceHolder()) ?>" value="<?php echo $ijin_edit->tgl_ijin_awal->EditValue ?>"<?php echo $ijin_edit->tgl_ijin_awal->editAttributes() ?>>
<?php if (!$ijin_edit->tgl_ijin_awal->ReadOnly && !$ijin_edit->tgl_ijin_awal->Disabled && !isset($ijin_edit->tgl_ijin_awal->EditAttrs["readonly"]) && !isset($ijin_edit->tgl_ijin_awal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fijinedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fijinedit", "x_tgl_ijin_awal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $ijin_edit->tgl_ijin_awal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ijin_edit->tgl_ijin_akhir->Visible) { // tgl_ijin_akhir ?>
	<div id="r_tgl_ijin_akhir" class="form-group row">
		<label id="elh_ijin_tgl_ijin_akhir" for="x_tgl_ijin_akhir" class="<?php echo $ijin_edit->LeftColumnClass ?>"><?php echo $ijin_edit->tgl_ijin_akhir->caption() ?><?php echo $ijin_edit->tgl_ijin_akhir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ijin_edit->RightColumnClass ?>"><div <?php echo $ijin_edit->tgl_ijin_akhir->cellAttributes() ?>>
<span id="el_ijin_tgl_ijin_akhir">
<input type="text" data-table="ijin" data-field="x_tgl_ijin_akhir" name="x_tgl_ijin_akhir" id="x_tgl_ijin_akhir" maxlength="10" placeholder="<?php echo HtmlEncode($ijin_edit->tgl_ijin_akhir->getPlaceHolder()) ?>" value="<?php echo $ijin_edit->tgl_ijin_akhir->EditValue ?>"<?php echo $ijin_edit->tgl_ijin_akhir->editAttributes() ?>>
<?php if (!$ijin_edit->tgl_ijin_akhir->ReadOnly && !$ijin_edit->tgl_ijin_akhir->Disabled && !isset($ijin_edit->tgl_ijin_akhir->EditAttrs["readonly"]) && !isset($ijin_edit->tgl_ijin_akhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fijinedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fijinedit", "x_tgl_ijin_akhir", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $ijin_edit->tgl_ijin_akhir->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ijin_edit->jenis->Visible) { // jenis ?>
	<div id="r_jenis" class="form-group row">
		<label id="elh_ijin_jenis" for="x_jenis" class="<?php echo $ijin_edit->LeftColumnClass ?>"><?php echo $ijin_edit->jenis->caption() ?><?php echo $ijin_edit->jenis->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ijin_edit->RightColumnClass ?>"><div <?php echo $ijin_edit->jenis->cellAttributes() ?>>
<span id="el_ijin_jenis">
<input type="text" data-table="ijin" data-field="x_jenis" name="x_jenis" id="x_jenis" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ijin_edit->jenis->getPlaceHolder()) ?>" value="<?php echo $ijin_edit->jenis->EditValue ?>"<?php echo $ijin_edit->jenis->editAttributes() ?>>
</span>
<?php echo $ijin_edit->jenis->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ijin_edit->keterangan->Visible) { // keterangan ?>
	<div id="r_keterangan" class="form-group row">
		<label id="elh_ijin_keterangan" for="x_keterangan" class="<?php echo $ijin_edit->LeftColumnClass ?>"><?php echo $ijin_edit->keterangan->caption() ?><?php echo $ijin_edit->keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ijin_edit->RightColumnClass ?>"><div <?php echo $ijin_edit->keterangan->cellAttributes() ?>>
<span id="el_ijin_keterangan">
<input type="text" data-table="ijin" data-field="x_keterangan" name="x_keterangan" id="x_keterangan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ijin_edit->keterangan->getPlaceHolder()) ?>" value="<?php echo $ijin_edit->keterangan->EditValue ?>"<?php echo $ijin_edit->keterangan->editAttributes() ?>>
</span>
<?php echo $ijin_edit->keterangan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ijin_edit->disetujui->Visible) { // disetujui ?>
	<div id="r_disetujui" class="form-group row">
		<label id="elh_ijin_disetujui" class="<?php echo $ijin_edit->LeftColumnClass ?>"><?php echo $ijin_edit->disetujui->caption() ?><?php echo $ijin_edit->disetujui->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ijin_edit->RightColumnClass ?>"><div <?php echo $ijin_edit->disetujui->cellAttributes() ?>>
<span id="el_ijin_disetujui">
<div id="tp_x_disetujui" class="ew-template"><input type="radio" class="custom-control-input" data-table="ijin" data-field="x_disetujui" data-value-separator="<?php echo $ijin_edit->disetujui->displayValueSeparatorAttribute() ?>" name="x_disetujui" id="x_disetujui" value="{value}"<?php echo $ijin_edit->disetujui->editAttributes() ?>></div>
<div id="dsl_x_disetujui" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $ijin_edit->disetujui->radioButtonListHtml(FALSE, "x_disetujui") ?>
</div></div>
</span>
<?php echo $ijin_edit->disetujui->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ijin_edit->dokumen->Visible) { // dokumen ?>
	<div id="r_dokumen" class="form-group row">
		<label id="elh_ijin_dokumen" class="<?php echo $ijin_edit->LeftColumnClass ?>"><?php echo $ijin_edit->dokumen->caption() ?><?php echo $ijin_edit->dokumen->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ijin_edit->RightColumnClass ?>"><div <?php echo $ijin_edit->dokumen->cellAttributes() ?>>
<span id="el_ijin_dokumen">
<div id="fd_x_dokumen">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $ijin_edit->dokumen->title() ?>" data-table="ijin" data-field="x_dokumen" name="x_dokumen" id="x_dokumen" lang="<?php echo CurrentLanguageID() ?>"<?php echo $ijin_edit->dokumen->editAttributes() ?><?php if ($ijin_edit->dokumen->ReadOnly || $ijin_edit->dokumen->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_dokumen"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_dokumen" id= "fn_x_dokumen" value="<?php echo $ijin_edit->dokumen->Upload->FileName ?>">
<input type="hidden" name="fa_x_dokumen" id= "fa_x_dokumen" value="<?php echo (Post("fa_x_dokumen") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_dokumen" id= "fs_x_dokumen" value="255">
<input type="hidden" name="fx_x_dokumen" id= "fx_x_dokumen" value="<?php echo $ijin_edit->dokumen->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_dokumen" id= "fm_x_dokumen" value="<?php echo $ijin_edit->dokumen->UploadMaxFileSize ?>">
</div>
<table id="ft_x_dokumen" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $ijin_edit->dokumen->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$ijin_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $ijin_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ijin_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$ijin_edit->showPageFooter();
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
$ijin_edit->terminate();
?>