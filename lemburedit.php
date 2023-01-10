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
$lembur_edit = new lembur_edit();

// Run the page
$lembur_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$lembur_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var flemburedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	flemburedit = currentForm = new ew.Form("flemburedit", "edit");

	// Validate form
	flemburedit.validate = function() {
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
			<?php if ($lembur_edit->pegawai->Required) { ?>
				elm = this.getElements("x" + infix + "_pegawai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $lembur_edit->pegawai->caption(), $lembur_edit->pegawai->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pegawai");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($lembur_edit->pegawai->errorMessage()) ?>");
			<?php if ($lembur_edit->pm->Required) { ?>
				elm = this.getElements("x" + infix + "_pm");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $lembur_edit->pm->caption(), $lembur_edit->pm->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pm");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($lembur_edit->pm->errorMessage()) ?>");
			<?php if ($lembur_edit->proyek->Required) { ?>
				elm = this.getElements("x" + infix + "_proyek");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $lembur_edit->proyek->caption(), $lembur_edit->proyek->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($lembur_edit->tgl->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $lembur_edit->tgl->caption(), $lembur_edit->tgl->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($lembur_edit->tgl->errorMessage()) ?>");
			<?php if ($lembur_edit->tgl_awal_lembur->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_awal_lembur");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $lembur_edit->tgl_awal_lembur->caption(), $lembur_edit->tgl_awal_lembur->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_awal_lembur");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($lembur_edit->tgl_awal_lembur->errorMessage()) ?>");
			<?php if ($lembur_edit->tgl_akhir_lembur->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_akhir_lembur");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $lembur_edit->tgl_akhir_lembur->caption(), $lembur_edit->tgl_akhir_lembur->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_akhir_lembur");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($lembur_edit->tgl_akhir_lembur->errorMessage()) ?>");
			<?php if ($lembur_edit->total_jam->Required) { ?>
				elm = this.getElements("x" + infix + "_total_jam");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $lembur_edit->total_jam->caption(), $lembur_edit->total_jam->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_total_jam");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($lembur_edit->total_jam->errorMessage()) ?>");
			<?php if ($lembur_edit->jenis->Required) { ?>
				elm = this.getElements("x" + infix + "_jenis");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $lembur_edit->jenis->caption(), $lembur_edit->jenis->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($lembur_edit->keterangan->Required) { ?>
				elm = this.getElements("x" + infix + "_keterangan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $lembur_edit->keterangan->caption(), $lembur_edit->keterangan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($lembur_edit->disetujui->Required) { ?>
				elm = this.getElements("x" + infix + "_disetujui");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $lembur_edit->disetujui->caption(), $lembur_edit->disetujui->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($lembur_edit->dokumen->Required) { ?>
				felm = this.getElements("x" + infix + "_dokumen");
				elm = this.getElements("fn_x" + infix + "_dokumen");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $lembur_edit->dokumen->caption(), $lembur_edit->dokumen->RequiredErrorMessage)) ?>");
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
	flemburedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	flemburedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	flemburedit.lists["x_disetujui"] = <?php echo $lembur_edit->disetujui->Lookup->toClientList($lembur_edit) ?>;
	flemburedit.lists["x_disetujui"].options = <?php echo JsonEncode($lembur_edit->disetujui->lookupOptions()) ?>;
	loadjs.done("flemburedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $lembur_edit->showPageHeader(); ?>
<?php
$lembur_edit->showMessage();
?>
<form name="flemburedit" id="flemburedit" class="<?php echo $lembur_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="lembur">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$lembur_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($lembur_edit->pegawai->Visible) { // pegawai ?>
	<div id="r_pegawai" class="form-group row">
		<label id="elh_lembur_pegawai" for="x_pegawai" class="<?php echo $lembur_edit->LeftColumnClass ?>"><?php echo $lembur_edit->pegawai->caption() ?><?php echo $lembur_edit->pegawai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $lembur_edit->RightColumnClass ?>"><div <?php echo $lembur_edit->pegawai->cellAttributes() ?>>
<span id="el_lembur_pegawai">
<input type="text" data-table="lembur" data-field="x_pegawai" name="x_pegawai" id="x_pegawai" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($lembur_edit->pegawai->getPlaceHolder()) ?>" value="<?php echo $lembur_edit->pegawai->EditValue ?>"<?php echo $lembur_edit->pegawai->editAttributes() ?>>
</span>
<?php echo $lembur_edit->pegawai->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($lembur_edit->pm->Visible) { // pm ?>
	<div id="r_pm" class="form-group row">
		<label id="elh_lembur_pm" for="x_pm" class="<?php echo $lembur_edit->LeftColumnClass ?>"><?php echo $lembur_edit->pm->caption() ?><?php echo $lembur_edit->pm->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $lembur_edit->RightColumnClass ?>"><div <?php echo $lembur_edit->pm->cellAttributes() ?>>
<span id="el_lembur_pm">
<input type="text" data-table="lembur" data-field="x_pm" name="x_pm" id="x_pm" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($lembur_edit->pm->getPlaceHolder()) ?>" value="<?php echo $lembur_edit->pm->EditValue ?>"<?php echo $lembur_edit->pm->editAttributes() ?>>
</span>
<?php echo $lembur_edit->pm->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($lembur_edit->proyek->Visible) { // proyek ?>
	<div id="r_proyek" class="form-group row">
		<label id="elh_lembur_proyek" for="x_proyek" class="<?php echo $lembur_edit->LeftColumnClass ?>"><?php echo $lembur_edit->proyek->caption() ?><?php echo $lembur_edit->proyek->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $lembur_edit->RightColumnClass ?>"><div <?php echo $lembur_edit->proyek->cellAttributes() ?>>
<span id="el_lembur_proyek">
<input type="text" data-table="lembur" data-field="x_proyek" name="x_proyek" id="x_proyek" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($lembur_edit->proyek->getPlaceHolder()) ?>" value="<?php echo $lembur_edit->proyek->EditValue ?>"<?php echo $lembur_edit->proyek->editAttributes() ?>>
</span>
<?php echo $lembur_edit->proyek->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($lembur_edit->tgl->Visible) { // tgl ?>
	<div id="r_tgl" class="form-group row">
		<label id="elh_lembur_tgl" for="x_tgl" class="<?php echo $lembur_edit->LeftColumnClass ?>"><?php echo $lembur_edit->tgl->caption() ?><?php echo $lembur_edit->tgl->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $lembur_edit->RightColumnClass ?>"><div <?php echo $lembur_edit->tgl->cellAttributes() ?>>
<span id="el_lembur_tgl">
<input type="text" data-table="lembur" data-field="x_tgl" name="x_tgl" id="x_tgl" maxlength="19" placeholder="<?php echo HtmlEncode($lembur_edit->tgl->getPlaceHolder()) ?>" value="<?php echo $lembur_edit->tgl->EditValue ?>"<?php echo $lembur_edit->tgl->editAttributes() ?>>
<?php if (!$lembur_edit->tgl->ReadOnly && !$lembur_edit->tgl->Disabled && !isset($lembur_edit->tgl->EditAttrs["readonly"]) && !isset($lembur_edit->tgl->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["flemburedit", "datetimepicker"], function() {
	ew.createDateTimePicker("flemburedit", "x_tgl", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $lembur_edit->tgl->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($lembur_edit->tgl_awal_lembur->Visible) { // tgl_awal_lembur ?>
	<div id="r_tgl_awal_lembur" class="form-group row">
		<label id="elh_lembur_tgl_awal_lembur" for="x_tgl_awal_lembur" class="<?php echo $lembur_edit->LeftColumnClass ?>"><?php echo $lembur_edit->tgl_awal_lembur->caption() ?><?php echo $lembur_edit->tgl_awal_lembur->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $lembur_edit->RightColumnClass ?>"><div <?php echo $lembur_edit->tgl_awal_lembur->cellAttributes() ?>>
<span id="el_lembur_tgl_awal_lembur">
<input type="text" data-table="lembur" data-field="x_tgl_awal_lembur" name="x_tgl_awal_lembur" id="x_tgl_awal_lembur" maxlength="19" placeholder="<?php echo HtmlEncode($lembur_edit->tgl_awal_lembur->getPlaceHolder()) ?>" value="<?php echo $lembur_edit->tgl_awal_lembur->EditValue ?>"<?php echo $lembur_edit->tgl_awal_lembur->editAttributes() ?>>
<?php if (!$lembur_edit->tgl_awal_lembur->ReadOnly && !$lembur_edit->tgl_awal_lembur->Disabled && !isset($lembur_edit->tgl_awal_lembur->EditAttrs["readonly"]) && !isset($lembur_edit->tgl_awal_lembur->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["flemburedit", "datetimepicker"], function() {
	ew.createDateTimePicker("flemburedit", "x_tgl_awal_lembur", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $lembur_edit->tgl_awal_lembur->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($lembur_edit->tgl_akhir_lembur->Visible) { // tgl_akhir_lembur ?>
	<div id="r_tgl_akhir_lembur" class="form-group row">
		<label id="elh_lembur_tgl_akhir_lembur" for="x_tgl_akhir_lembur" class="<?php echo $lembur_edit->LeftColumnClass ?>"><?php echo $lembur_edit->tgl_akhir_lembur->caption() ?><?php echo $lembur_edit->tgl_akhir_lembur->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $lembur_edit->RightColumnClass ?>"><div <?php echo $lembur_edit->tgl_akhir_lembur->cellAttributes() ?>>
<span id="el_lembur_tgl_akhir_lembur">
<input type="text" data-table="lembur" data-field="x_tgl_akhir_lembur" name="x_tgl_akhir_lembur" id="x_tgl_akhir_lembur" maxlength="19" placeholder="<?php echo HtmlEncode($lembur_edit->tgl_akhir_lembur->getPlaceHolder()) ?>" value="<?php echo $lembur_edit->tgl_akhir_lembur->EditValue ?>"<?php echo $lembur_edit->tgl_akhir_lembur->editAttributes() ?>>
<?php if (!$lembur_edit->tgl_akhir_lembur->ReadOnly && !$lembur_edit->tgl_akhir_lembur->Disabled && !isset($lembur_edit->tgl_akhir_lembur->EditAttrs["readonly"]) && !isset($lembur_edit->tgl_akhir_lembur->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["flemburedit", "datetimepicker"], function() {
	ew.createDateTimePicker("flemburedit", "x_tgl_akhir_lembur", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $lembur_edit->tgl_akhir_lembur->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($lembur_edit->total_jam->Visible) { // total_jam ?>
	<div id="r_total_jam" class="form-group row">
		<label id="elh_lembur_total_jam" for="x_total_jam" class="<?php echo $lembur_edit->LeftColumnClass ?>"><?php echo $lembur_edit->total_jam->caption() ?><?php echo $lembur_edit->total_jam->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $lembur_edit->RightColumnClass ?>"><div <?php echo $lembur_edit->total_jam->cellAttributes() ?>>
<span id="el_lembur_total_jam">
<input type="text" data-table="lembur" data-field="x_total_jam" name="x_total_jam" id="x_total_jam" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($lembur_edit->total_jam->getPlaceHolder()) ?>" value="<?php echo $lembur_edit->total_jam->EditValue ?>"<?php echo $lembur_edit->total_jam->editAttributes() ?>>
</span>
<?php echo $lembur_edit->total_jam->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($lembur_edit->jenis->Visible) { // jenis ?>
	<div id="r_jenis" class="form-group row">
		<label id="elh_lembur_jenis" for="x_jenis" class="<?php echo $lembur_edit->LeftColumnClass ?>"><?php echo $lembur_edit->jenis->caption() ?><?php echo $lembur_edit->jenis->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $lembur_edit->RightColumnClass ?>"><div <?php echo $lembur_edit->jenis->cellAttributes() ?>>
<span id="el_lembur_jenis">
<input type="text" data-table="lembur" data-field="x_jenis" name="x_jenis" id="x_jenis" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($lembur_edit->jenis->getPlaceHolder()) ?>" value="<?php echo $lembur_edit->jenis->EditValue ?>"<?php echo $lembur_edit->jenis->editAttributes() ?>>
</span>
<?php echo $lembur_edit->jenis->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($lembur_edit->keterangan->Visible) { // keterangan ?>
	<div id="r_keterangan" class="form-group row">
		<label id="elh_lembur_keterangan" for="x_keterangan" class="<?php echo $lembur_edit->LeftColumnClass ?>"><?php echo $lembur_edit->keterangan->caption() ?><?php echo $lembur_edit->keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $lembur_edit->RightColumnClass ?>"><div <?php echo $lembur_edit->keterangan->cellAttributes() ?>>
<span id="el_lembur_keterangan">
<input type="text" data-table="lembur" data-field="x_keterangan" name="x_keterangan" id="x_keterangan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($lembur_edit->keterangan->getPlaceHolder()) ?>" value="<?php echo $lembur_edit->keterangan->EditValue ?>"<?php echo $lembur_edit->keterangan->editAttributes() ?>>
</span>
<?php echo $lembur_edit->keterangan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($lembur_edit->disetujui->Visible) { // disetujui ?>
	<div id="r_disetujui" class="form-group row">
		<label id="elh_lembur_disetujui" class="<?php echo $lembur_edit->LeftColumnClass ?>"><?php echo $lembur_edit->disetujui->caption() ?><?php echo $lembur_edit->disetujui->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $lembur_edit->RightColumnClass ?>"><div <?php echo $lembur_edit->disetujui->cellAttributes() ?>>
<span id="el_lembur_disetujui">
<div id="tp_x_disetujui" class="ew-template"><input type="radio" class="custom-control-input" data-table="lembur" data-field="x_disetujui" data-value-separator="<?php echo $lembur_edit->disetujui->displayValueSeparatorAttribute() ?>" name="x_disetujui" id="x_disetujui" value="{value}"<?php echo $lembur_edit->disetujui->editAttributes() ?>></div>
<div id="dsl_x_disetujui" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $lembur_edit->disetujui->radioButtonListHtml(FALSE, "x_disetujui") ?>
</div></div>
<?php echo $lembur_edit->disetujui->Lookup->getParamTag($lembur_edit, "p_x_disetujui") ?>
</span>
<?php echo $lembur_edit->disetujui->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($lembur_edit->dokumen->Visible) { // dokumen ?>
	<div id="r_dokumen" class="form-group row">
		<label id="elh_lembur_dokumen" class="<?php echo $lembur_edit->LeftColumnClass ?>"><?php echo $lembur_edit->dokumen->caption() ?><?php echo $lembur_edit->dokumen->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $lembur_edit->RightColumnClass ?>"><div <?php echo $lembur_edit->dokumen->cellAttributes() ?>>
<span id="el_lembur_dokumen">
<div id="fd_x_dokumen">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $lembur_edit->dokumen->title() ?>" data-table="lembur" data-field="x_dokumen" name="x_dokumen" id="x_dokumen" lang="<?php echo CurrentLanguageID() ?>"<?php echo $lembur_edit->dokumen->editAttributes() ?><?php if ($lembur_edit->dokumen->ReadOnly || $lembur_edit->dokumen->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_dokumen"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_dokumen" id= "fn_x_dokumen" value="<?php echo $lembur_edit->dokumen->Upload->FileName ?>">
<input type="hidden" name="fa_x_dokumen" id= "fa_x_dokumen" value="<?php echo (Post("fa_x_dokumen") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_dokumen" id= "fs_x_dokumen" value="255">
<input type="hidden" name="fx_x_dokumen" id= "fx_x_dokumen" value="<?php echo $lembur_edit->dokumen->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_dokumen" id= "fm_x_dokumen" value="<?php echo $lembur_edit->dokumen->UploadMaxFileSize ?>">
</div>
<table id="ft_x_dokumen" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $lembur_edit->dokumen->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="lembur" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($lembur_edit->id->CurrentValue) ?>">
<?php if (!$lembur_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $lembur_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $lembur_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$lembur_edit->showPageFooter();
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
$lembur_edit->terminate();
?>