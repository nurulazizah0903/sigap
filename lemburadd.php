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
$lembur_add = new lembur_add();

// Run the page
$lembur_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$lembur_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var flemburadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	flemburadd = currentForm = new ew.Form("flemburadd", "add");

	// Validate form
	flemburadd.validate = function() {
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
			<?php if ($lembur_add->pegawai->Required) { ?>
				elm = this.getElements("x" + infix + "_pegawai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $lembur_add->pegawai->caption(), $lembur_add->pegawai->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pegawai");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($lembur_add->pegawai->errorMessage()) ?>");
			<?php if ($lembur_add->pm->Required) { ?>
				elm = this.getElements("x" + infix + "_pm");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $lembur_add->pm->caption(), $lembur_add->pm->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pm");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($lembur_add->pm->errorMessage()) ?>");
			<?php if ($lembur_add->proyek->Required) { ?>
				elm = this.getElements("x" + infix + "_proyek");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $lembur_add->proyek->caption(), $lembur_add->proyek->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($lembur_add->tgl->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $lembur_add->tgl->caption(), $lembur_add->tgl->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($lembur_add->tgl->errorMessage()) ?>");
			<?php if ($lembur_add->tgl_awal_lembur->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_awal_lembur");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $lembur_add->tgl_awal_lembur->caption(), $lembur_add->tgl_awal_lembur->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_awal_lembur");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($lembur_add->tgl_awal_lembur->errorMessage()) ?>");
			<?php if ($lembur_add->tgl_akhir_lembur->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_akhir_lembur");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $lembur_add->tgl_akhir_lembur->caption(), $lembur_add->tgl_akhir_lembur->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_akhir_lembur");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($lembur_add->tgl_akhir_lembur->errorMessage()) ?>");
			<?php if ($lembur_add->total_jam->Required) { ?>
				elm = this.getElements("x" + infix + "_total_jam");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $lembur_add->total_jam->caption(), $lembur_add->total_jam->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_total_jam");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($lembur_add->total_jam->errorMessage()) ?>");
			<?php if ($lembur_add->jenis->Required) { ?>
				elm = this.getElements("x" + infix + "_jenis");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $lembur_add->jenis->caption(), $lembur_add->jenis->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($lembur_add->keterangan->Required) { ?>
				elm = this.getElements("x" + infix + "_keterangan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $lembur_add->keterangan->caption(), $lembur_add->keterangan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($lembur_add->disetujui->Required) { ?>
				elm = this.getElements("x" + infix + "_disetujui");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $lembur_add->disetujui->caption(), $lembur_add->disetujui->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($lembur_add->dokumen->Required) { ?>
				felm = this.getElements("x" + infix + "_dokumen");
				elm = this.getElements("fn_x" + infix + "_dokumen");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $lembur_add->dokumen->caption(), $lembur_add->dokumen->RequiredErrorMessage)) ?>");
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
	flemburadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	flemburadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	flemburadd.lists["x_disetujui"] = <?php echo $lembur_add->disetujui->Lookup->toClientList($lembur_add) ?>;
	flemburadd.lists["x_disetujui"].options = <?php echo JsonEncode($lembur_add->disetujui->lookupOptions()) ?>;
	loadjs.done("flemburadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $lembur_add->showPageHeader(); ?>
<?php
$lembur_add->showMessage();
?>
<form name="flemburadd" id="flemburadd" class="<?php echo $lembur_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="lembur">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$lembur_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($lembur_add->pegawai->Visible) { // pegawai ?>
	<div id="r_pegawai" class="form-group row">
		<label id="elh_lembur_pegawai" for="x_pegawai" class="<?php echo $lembur_add->LeftColumnClass ?>"><?php echo $lembur_add->pegawai->caption() ?><?php echo $lembur_add->pegawai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $lembur_add->RightColumnClass ?>"><div <?php echo $lembur_add->pegawai->cellAttributes() ?>>
<span id="el_lembur_pegawai">
<input type="text" data-table="lembur" data-field="x_pegawai" name="x_pegawai" id="x_pegawai" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($lembur_add->pegawai->getPlaceHolder()) ?>" value="<?php echo $lembur_add->pegawai->EditValue ?>"<?php echo $lembur_add->pegawai->editAttributes() ?>>
</span>
<?php echo $lembur_add->pegawai->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($lembur_add->pm->Visible) { // pm ?>
	<div id="r_pm" class="form-group row">
		<label id="elh_lembur_pm" for="x_pm" class="<?php echo $lembur_add->LeftColumnClass ?>"><?php echo $lembur_add->pm->caption() ?><?php echo $lembur_add->pm->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $lembur_add->RightColumnClass ?>"><div <?php echo $lembur_add->pm->cellAttributes() ?>>
<span id="el_lembur_pm">
<input type="text" data-table="lembur" data-field="x_pm" name="x_pm" id="x_pm" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($lembur_add->pm->getPlaceHolder()) ?>" value="<?php echo $lembur_add->pm->EditValue ?>"<?php echo $lembur_add->pm->editAttributes() ?>>
</span>
<?php echo $lembur_add->pm->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($lembur_add->proyek->Visible) { // proyek ?>
	<div id="r_proyek" class="form-group row">
		<label id="elh_lembur_proyek" for="x_proyek" class="<?php echo $lembur_add->LeftColumnClass ?>"><?php echo $lembur_add->proyek->caption() ?><?php echo $lembur_add->proyek->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $lembur_add->RightColumnClass ?>"><div <?php echo $lembur_add->proyek->cellAttributes() ?>>
<span id="el_lembur_proyek">
<input type="text" data-table="lembur" data-field="x_proyek" name="x_proyek" id="x_proyek" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($lembur_add->proyek->getPlaceHolder()) ?>" value="<?php echo $lembur_add->proyek->EditValue ?>"<?php echo $lembur_add->proyek->editAttributes() ?>>
</span>
<?php echo $lembur_add->proyek->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($lembur_add->tgl->Visible) { // tgl ?>
	<div id="r_tgl" class="form-group row">
		<label id="elh_lembur_tgl" for="x_tgl" class="<?php echo $lembur_add->LeftColumnClass ?>"><?php echo $lembur_add->tgl->caption() ?><?php echo $lembur_add->tgl->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $lembur_add->RightColumnClass ?>"><div <?php echo $lembur_add->tgl->cellAttributes() ?>>
<span id="el_lembur_tgl">
<input type="text" data-table="lembur" data-field="x_tgl" name="x_tgl" id="x_tgl" maxlength="19" placeholder="<?php echo HtmlEncode($lembur_add->tgl->getPlaceHolder()) ?>" value="<?php echo $lembur_add->tgl->EditValue ?>"<?php echo $lembur_add->tgl->editAttributes() ?>>
<?php if (!$lembur_add->tgl->ReadOnly && !$lembur_add->tgl->Disabled && !isset($lembur_add->tgl->EditAttrs["readonly"]) && !isset($lembur_add->tgl->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["flemburadd", "datetimepicker"], function() {
	ew.createDateTimePicker("flemburadd", "x_tgl", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $lembur_add->tgl->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($lembur_add->tgl_awal_lembur->Visible) { // tgl_awal_lembur ?>
	<div id="r_tgl_awal_lembur" class="form-group row">
		<label id="elh_lembur_tgl_awal_lembur" for="x_tgl_awal_lembur" class="<?php echo $lembur_add->LeftColumnClass ?>"><?php echo $lembur_add->tgl_awal_lembur->caption() ?><?php echo $lembur_add->tgl_awal_lembur->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $lembur_add->RightColumnClass ?>"><div <?php echo $lembur_add->tgl_awal_lembur->cellAttributes() ?>>
<span id="el_lembur_tgl_awal_lembur">
<input type="text" data-table="lembur" data-field="x_tgl_awal_lembur" name="x_tgl_awal_lembur" id="x_tgl_awal_lembur" maxlength="19" placeholder="<?php echo HtmlEncode($lembur_add->tgl_awal_lembur->getPlaceHolder()) ?>" value="<?php echo $lembur_add->tgl_awal_lembur->EditValue ?>"<?php echo $lembur_add->tgl_awal_lembur->editAttributes() ?>>
<?php if (!$lembur_add->tgl_awal_lembur->ReadOnly && !$lembur_add->tgl_awal_lembur->Disabled && !isset($lembur_add->tgl_awal_lembur->EditAttrs["readonly"]) && !isset($lembur_add->tgl_awal_lembur->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["flemburadd", "datetimepicker"], function() {
	ew.createDateTimePicker("flemburadd", "x_tgl_awal_lembur", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $lembur_add->tgl_awal_lembur->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($lembur_add->tgl_akhir_lembur->Visible) { // tgl_akhir_lembur ?>
	<div id="r_tgl_akhir_lembur" class="form-group row">
		<label id="elh_lembur_tgl_akhir_lembur" for="x_tgl_akhir_lembur" class="<?php echo $lembur_add->LeftColumnClass ?>"><?php echo $lembur_add->tgl_akhir_lembur->caption() ?><?php echo $lembur_add->tgl_akhir_lembur->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $lembur_add->RightColumnClass ?>"><div <?php echo $lembur_add->tgl_akhir_lembur->cellAttributes() ?>>
<span id="el_lembur_tgl_akhir_lembur">
<input type="text" data-table="lembur" data-field="x_tgl_akhir_lembur" name="x_tgl_akhir_lembur" id="x_tgl_akhir_lembur" maxlength="19" placeholder="<?php echo HtmlEncode($lembur_add->tgl_akhir_lembur->getPlaceHolder()) ?>" value="<?php echo $lembur_add->tgl_akhir_lembur->EditValue ?>"<?php echo $lembur_add->tgl_akhir_lembur->editAttributes() ?>>
<?php if (!$lembur_add->tgl_akhir_lembur->ReadOnly && !$lembur_add->tgl_akhir_lembur->Disabled && !isset($lembur_add->tgl_akhir_lembur->EditAttrs["readonly"]) && !isset($lembur_add->tgl_akhir_lembur->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["flemburadd", "datetimepicker"], function() {
	ew.createDateTimePicker("flemburadd", "x_tgl_akhir_lembur", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $lembur_add->tgl_akhir_lembur->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($lembur_add->total_jam->Visible) { // total_jam ?>
	<div id="r_total_jam" class="form-group row">
		<label id="elh_lembur_total_jam" for="x_total_jam" class="<?php echo $lembur_add->LeftColumnClass ?>"><?php echo $lembur_add->total_jam->caption() ?><?php echo $lembur_add->total_jam->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $lembur_add->RightColumnClass ?>"><div <?php echo $lembur_add->total_jam->cellAttributes() ?>>
<span id="el_lembur_total_jam">
<input type="text" data-table="lembur" data-field="x_total_jam" name="x_total_jam" id="x_total_jam" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($lembur_add->total_jam->getPlaceHolder()) ?>" value="<?php echo $lembur_add->total_jam->EditValue ?>"<?php echo $lembur_add->total_jam->editAttributes() ?>>
</span>
<?php echo $lembur_add->total_jam->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($lembur_add->jenis->Visible) { // jenis ?>
	<div id="r_jenis" class="form-group row">
		<label id="elh_lembur_jenis" for="x_jenis" class="<?php echo $lembur_add->LeftColumnClass ?>"><?php echo $lembur_add->jenis->caption() ?><?php echo $lembur_add->jenis->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $lembur_add->RightColumnClass ?>"><div <?php echo $lembur_add->jenis->cellAttributes() ?>>
<span id="el_lembur_jenis">
<input type="text" data-table="lembur" data-field="x_jenis" name="x_jenis" id="x_jenis" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($lembur_add->jenis->getPlaceHolder()) ?>" value="<?php echo $lembur_add->jenis->EditValue ?>"<?php echo $lembur_add->jenis->editAttributes() ?>>
</span>
<?php echo $lembur_add->jenis->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($lembur_add->keterangan->Visible) { // keterangan ?>
	<div id="r_keterangan" class="form-group row">
		<label id="elh_lembur_keterangan" for="x_keterangan" class="<?php echo $lembur_add->LeftColumnClass ?>"><?php echo $lembur_add->keterangan->caption() ?><?php echo $lembur_add->keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $lembur_add->RightColumnClass ?>"><div <?php echo $lembur_add->keterangan->cellAttributes() ?>>
<span id="el_lembur_keterangan">
<input type="text" data-table="lembur" data-field="x_keterangan" name="x_keterangan" id="x_keterangan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($lembur_add->keterangan->getPlaceHolder()) ?>" value="<?php echo $lembur_add->keterangan->EditValue ?>"<?php echo $lembur_add->keterangan->editAttributes() ?>>
</span>
<?php echo $lembur_add->keterangan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($lembur_add->disetujui->Visible) { // disetujui ?>
	<div id="r_disetujui" class="form-group row">
		<label id="elh_lembur_disetujui" class="<?php echo $lembur_add->LeftColumnClass ?>"><?php echo $lembur_add->disetujui->caption() ?><?php echo $lembur_add->disetujui->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $lembur_add->RightColumnClass ?>"><div <?php echo $lembur_add->disetujui->cellAttributes() ?>>
<span id="el_lembur_disetujui">
<div id="tp_x_disetujui" class="ew-template"><input type="radio" class="custom-control-input" data-table="lembur" data-field="x_disetujui" data-value-separator="<?php echo $lembur_add->disetujui->displayValueSeparatorAttribute() ?>" name="x_disetujui" id="x_disetujui" value="{value}"<?php echo $lembur_add->disetujui->editAttributes() ?>></div>
<div id="dsl_x_disetujui" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $lembur_add->disetujui->radioButtonListHtml(FALSE, "x_disetujui") ?>
</div></div>
<?php echo $lembur_add->disetujui->Lookup->getParamTag($lembur_add, "p_x_disetujui") ?>
</span>
<?php echo $lembur_add->disetujui->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($lembur_add->dokumen->Visible) { // dokumen ?>
	<div id="r_dokumen" class="form-group row">
		<label id="elh_lembur_dokumen" class="<?php echo $lembur_add->LeftColumnClass ?>"><?php echo $lembur_add->dokumen->caption() ?><?php echo $lembur_add->dokumen->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $lembur_add->RightColumnClass ?>"><div <?php echo $lembur_add->dokumen->cellAttributes() ?>>
<span id="el_lembur_dokumen">
<div id="fd_x_dokumen">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $lembur_add->dokumen->title() ?>" data-table="lembur" data-field="x_dokumen" name="x_dokumen" id="x_dokumen" lang="<?php echo CurrentLanguageID() ?>"<?php echo $lembur_add->dokumen->editAttributes() ?><?php if ($lembur_add->dokumen->ReadOnly || $lembur_add->dokumen->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_dokumen"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_dokumen" id= "fn_x_dokumen" value="<?php echo $lembur_add->dokumen->Upload->FileName ?>">
<input type="hidden" name="fa_x_dokumen" id= "fa_x_dokumen" value="0">
<input type="hidden" name="fs_x_dokumen" id= "fs_x_dokumen" value="255">
<input type="hidden" name="fx_x_dokumen" id= "fx_x_dokumen" value="<?php echo $lembur_add->dokumen->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_dokumen" id= "fm_x_dokumen" value="<?php echo $lembur_add->dokumen->UploadMaxFileSize ?>">
</div>
<table id="ft_x_dokumen" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $lembur_add->dokumen->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$lembur_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $lembur_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $lembur_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$lembur_add->showPageFooter();
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
$lembur_add->terminate();
?>