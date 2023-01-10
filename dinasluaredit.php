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
$dinasluar_edit = new dinasluar_edit();

// Run the page
$dinasluar_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$dinasluar_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdinasluaredit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fdinasluaredit = currentForm = new ew.Form("fdinasluaredit", "edit");

	// Validate form
	fdinasluaredit.validate = function() {
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
			<?php if ($dinasluar_edit->pegawai->Required) { ?>
				elm = this.getElements("x" + infix + "_pegawai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dinasluar_edit->pegawai->caption(), $dinasluar_edit->pegawai->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dinasluar_edit->pm->Required) { ?>
				elm = this.getElements("x" + infix + "_pm");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dinasluar_edit->pm->caption(), $dinasluar_edit->pm->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dinasluar_edit->proyek->Required) { ?>
				elm = this.getElements("x" + infix + "_proyek");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dinasluar_edit->proyek->caption(), $dinasluar_edit->proyek->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dinasluar_edit->tgl->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dinasluar_edit->tgl->caption(), $dinasluar_edit->tgl->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dinasluar_edit->tgl_dl_awal->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_dl_awal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dinasluar_edit->tgl_dl_awal->caption(), $dinasluar_edit->tgl_dl_awal->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_dl_awal");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($dinasluar_edit->tgl_dl_awal->errorMessage()) ?>");
			<?php if ($dinasluar_edit->tgl_dl_akhir->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_dl_akhir");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dinasluar_edit->tgl_dl_akhir->caption(), $dinasluar_edit->tgl_dl_akhir->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_dl_akhir");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($dinasluar_edit->tgl_dl_akhir->errorMessage()) ?>");
			<?php if ($dinasluar_edit->jenis->Required) { ?>
				elm = this.getElements("x" + infix + "_jenis");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dinasluar_edit->jenis->caption(), $dinasluar_edit->jenis->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dinasluar_edit->keterangan->Required) { ?>
				elm = this.getElements("x" + infix + "_keterangan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dinasluar_edit->keterangan->caption(), $dinasluar_edit->keterangan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dinasluar_edit->disetujui->Required) { ?>
				elm = this.getElements("x" + infix + "_disetujui");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dinasluar_edit->disetujui->caption(), $dinasluar_edit->disetujui->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dinasluar_edit->dokumen->Required) { ?>
				felm = this.getElements("x" + infix + "_dokumen");
				elm = this.getElements("fn_x" + infix + "_dokumen");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $dinasluar_edit->dokumen->caption(), $dinasluar_edit->dokumen->RequiredErrorMessage)) ?>");
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
	fdinasluaredit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdinasluaredit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdinasluaredit.lists["x_pegawai"] = <?php echo $dinasluar_edit->pegawai->Lookup->toClientList($dinasluar_edit) ?>;
	fdinasluaredit.lists["x_pegawai"].options = <?php echo JsonEncode($dinasluar_edit->pegawai->lookupOptions()) ?>;
	fdinasluaredit.lists["x_pm"] = <?php echo $dinasluar_edit->pm->Lookup->toClientList($dinasluar_edit) ?>;
	fdinasluaredit.lists["x_pm"].options = <?php echo JsonEncode($dinasluar_edit->pm->lookupOptions()) ?>;
	fdinasluaredit.lists["x_disetujui"] = <?php echo $dinasluar_edit->disetujui->Lookup->toClientList($dinasluar_edit) ?>;
	fdinasluaredit.lists["x_disetujui"].options = <?php echo JsonEncode($dinasluar_edit->disetujui->options(FALSE, TRUE)) ?>;
	loadjs.done("fdinasluaredit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $dinasluar_edit->showPageHeader(); ?>
<?php
$dinasluar_edit->showMessage();
?>
<form name="fdinasluaredit" id="fdinasluaredit" class="<?php echo $dinasluar_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="dinasluar">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$dinasluar_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($dinasluar_edit->pegawai->Visible) { // pegawai ?>
	<div id="r_pegawai" class="form-group row">
		<label id="elh_dinasluar_pegawai" for="x_pegawai" class="<?php echo $dinasluar_edit->LeftColumnClass ?>"><?php echo $dinasluar_edit->pegawai->caption() ?><?php echo $dinasluar_edit->pegawai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dinasluar_edit->RightColumnClass ?>"><div <?php echo $dinasluar_edit->pegawai->cellAttributes() ?>>
<span id="el_dinasluar_pegawai">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_pegawai"><?php echo EmptyValue(strval($dinasluar_edit->pegawai->ViewValue)) ? $Language->phrase("PleaseSelect") : $dinasluar_edit->pegawai->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($dinasluar_edit->pegawai->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($dinasluar_edit->pegawai->ReadOnly || $dinasluar_edit->pegawai->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_pegawai',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $dinasluar_edit->pegawai->Lookup->getParamTag($dinasluar_edit, "p_x_pegawai") ?>
<input type="hidden" data-table="dinasluar" data-field="x_pegawai" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $dinasluar_edit->pegawai->displayValueSeparatorAttribute() ?>" name="x_pegawai" id="x_pegawai" value="<?php echo $dinasluar_edit->pegawai->CurrentValue ?>"<?php echo $dinasluar_edit->pegawai->editAttributes() ?>>
</span>
<?php echo $dinasluar_edit->pegawai->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dinasluar_edit->pm->Visible) { // pm ?>
	<div id="r_pm" class="form-group row">
		<label id="elh_dinasluar_pm" for="x_pm" class="<?php echo $dinasluar_edit->LeftColumnClass ?>"><?php echo $dinasluar_edit->pm->caption() ?><?php echo $dinasluar_edit->pm->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dinasluar_edit->RightColumnClass ?>"><div <?php echo $dinasluar_edit->pm->cellAttributes() ?>>
<span id="el_dinasluar_pm">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_pm"><?php echo EmptyValue(strval($dinasluar_edit->pm->ViewValue)) ? $Language->phrase("PleaseSelect") : $dinasluar_edit->pm->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($dinasluar_edit->pm->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($dinasluar_edit->pm->ReadOnly || $dinasluar_edit->pm->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_pm',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $dinasluar_edit->pm->Lookup->getParamTag($dinasluar_edit, "p_x_pm") ?>
<input type="hidden" data-table="dinasluar" data-field="x_pm" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $dinasluar_edit->pm->displayValueSeparatorAttribute() ?>" name="x_pm" id="x_pm" value="<?php echo $dinasluar_edit->pm->CurrentValue ?>"<?php echo $dinasluar_edit->pm->editAttributes() ?>>
</span>
<?php echo $dinasluar_edit->pm->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dinasluar_edit->proyek->Visible) { // proyek ?>
	<div id="r_proyek" class="form-group row">
		<label id="elh_dinasluar_proyek" for="x_proyek" class="<?php echo $dinasluar_edit->LeftColumnClass ?>"><?php echo $dinasluar_edit->proyek->caption() ?><?php echo $dinasluar_edit->proyek->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dinasluar_edit->RightColumnClass ?>"><div <?php echo $dinasluar_edit->proyek->cellAttributes() ?>>
<span id="el_dinasluar_proyek">
<input type="text" data-table="dinasluar" data-field="x_proyek" name="x_proyek" id="x_proyek" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($dinasluar_edit->proyek->getPlaceHolder()) ?>" value="<?php echo $dinasluar_edit->proyek->EditValue ?>"<?php echo $dinasluar_edit->proyek->editAttributes() ?>>
</span>
<?php echo $dinasluar_edit->proyek->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dinasluar_edit->tgl_dl_awal->Visible) { // tgl_dl_awal ?>
	<div id="r_tgl_dl_awal" class="form-group row">
		<label id="elh_dinasluar_tgl_dl_awal" for="x_tgl_dl_awal" class="<?php echo $dinasluar_edit->LeftColumnClass ?>"><?php echo $dinasluar_edit->tgl_dl_awal->caption() ?><?php echo $dinasluar_edit->tgl_dl_awal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dinasluar_edit->RightColumnClass ?>"><div <?php echo $dinasluar_edit->tgl_dl_awal->cellAttributes() ?>>
<span id="el_dinasluar_tgl_dl_awal">
<input type="text" data-table="dinasluar" data-field="x_tgl_dl_awal" name="x_tgl_dl_awal" id="x_tgl_dl_awal" maxlength="10" placeholder="<?php echo HtmlEncode($dinasluar_edit->tgl_dl_awal->getPlaceHolder()) ?>" value="<?php echo $dinasluar_edit->tgl_dl_awal->EditValue ?>"<?php echo $dinasluar_edit->tgl_dl_awal->editAttributes() ?>>
<?php if (!$dinasluar_edit->tgl_dl_awal->ReadOnly && !$dinasluar_edit->tgl_dl_awal->Disabled && !isset($dinasluar_edit->tgl_dl_awal->EditAttrs["readonly"]) && !isset($dinasluar_edit->tgl_dl_awal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdinasluaredit", "datetimepicker"], function() {
	ew.createDateTimePicker("fdinasluaredit", "x_tgl_dl_awal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $dinasluar_edit->tgl_dl_awal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dinasluar_edit->tgl_dl_akhir->Visible) { // tgl_dl_akhir ?>
	<div id="r_tgl_dl_akhir" class="form-group row">
		<label id="elh_dinasluar_tgl_dl_akhir" for="x_tgl_dl_akhir" class="<?php echo $dinasluar_edit->LeftColumnClass ?>"><?php echo $dinasluar_edit->tgl_dl_akhir->caption() ?><?php echo $dinasluar_edit->tgl_dl_akhir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dinasluar_edit->RightColumnClass ?>"><div <?php echo $dinasluar_edit->tgl_dl_akhir->cellAttributes() ?>>
<span id="el_dinasluar_tgl_dl_akhir">
<input type="text" data-table="dinasluar" data-field="x_tgl_dl_akhir" name="x_tgl_dl_akhir" id="x_tgl_dl_akhir" maxlength="10" placeholder="<?php echo HtmlEncode($dinasluar_edit->tgl_dl_akhir->getPlaceHolder()) ?>" value="<?php echo $dinasluar_edit->tgl_dl_akhir->EditValue ?>"<?php echo $dinasluar_edit->tgl_dl_akhir->editAttributes() ?>>
<?php if (!$dinasluar_edit->tgl_dl_akhir->ReadOnly && !$dinasluar_edit->tgl_dl_akhir->Disabled && !isset($dinasluar_edit->tgl_dl_akhir->EditAttrs["readonly"]) && !isset($dinasluar_edit->tgl_dl_akhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdinasluaredit", "datetimepicker"], function() {
	ew.createDateTimePicker("fdinasluaredit", "x_tgl_dl_akhir", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $dinasluar_edit->tgl_dl_akhir->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dinasluar_edit->jenis->Visible) { // jenis ?>
	<div id="r_jenis" class="form-group row">
		<label id="elh_dinasluar_jenis" for="x_jenis" class="<?php echo $dinasluar_edit->LeftColumnClass ?>"><?php echo $dinasluar_edit->jenis->caption() ?><?php echo $dinasluar_edit->jenis->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dinasluar_edit->RightColumnClass ?>"><div <?php echo $dinasluar_edit->jenis->cellAttributes() ?>>
<span id="el_dinasluar_jenis">
<input type="text" data-table="dinasluar" data-field="x_jenis" name="x_jenis" id="x_jenis" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($dinasluar_edit->jenis->getPlaceHolder()) ?>" value="<?php echo $dinasluar_edit->jenis->EditValue ?>"<?php echo $dinasluar_edit->jenis->editAttributes() ?>>
</span>
<?php echo $dinasluar_edit->jenis->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dinasluar_edit->keterangan->Visible) { // keterangan ?>
	<div id="r_keterangan" class="form-group row">
		<label id="elh_dinasluar_keterangan" for="x_keterangan" class="<?php echo $dinasluar_edit->LeftColumnClass ?>"><?php echo $dinasluar_edit->keterangan->caption() ?><?php echo $dinasluar_edit->keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dinasluar_edit->RightColumnClass ?>"><div <?php echo $dinasluar_edit->keterangan->cellAttributes() ?>>
<span id="el_dinasluar_keterangan">
<input type="text" data-table="dinasluar" data-field="x_keterangan" name="x_keterangan" id="x_keterangan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($dinasluar_edit->keterangan->getPlaceHolder()) ?>" value="<?php echo $dinasluar_edit->keterangan->EditValue ?>"<?php echo $dinasluar_edit->keterangan->editAttributes() ?>>
</span>
<?php echo $dinasluar_edit->keterangan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dinasluar_edit->disetujui->Visible) { // disetujui ?>
	<div id="r_disetujui" class="form-group row">
		<label id="elh_dinasluar_disetujui" for="x_disetujui" class="<?php echo $dinasluar_edit->LeftColumnClass ?>"><?php echo $dinasluar_edit->disetujui->caption() ?><?php echo $dinasluar_edit->disetujui->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dinasluar_edit->RightColumnClass ?>"><div <?php echo $dinasluar_edit->disetujui->cellAttributes() ?>>
<span id="el_dinasluar_disetujui">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="dinasluar" data-field="x_disetujui" data-value-separator="<?php echo $dinasluar_edit->disetujui->displayValueSeparatorAttribute() ?>" id="x_disetujui" name="x_disetujui"<?php echo $dinasluar_edit->disetujui->editAttributes() ?>>
			<?php echo $dinasluar_edit->disetujui->selectOptionListHtml("x_disetujui") ?>
		</select>
</div>
</span>
<?php echo $dinasluar_edit->disetujui->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dinasluar_edit->dokumen->Visible) { // dokumen ?>
	<div id="r_dokumen" class="form-group row">
		<label id="elh_dinasluar_dokumen" class="<?php echo $dinasluar_edit->LeftColumnClass ?>"><?php echo $dinasluar_edit->dokumen->caption() ?><?php echo $dinasluar_edit->dokumen->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dinasluar_edit->RightColumnClass ?>"><div <?php echo $dinasluar_edit->dokumen->cellAttributes() ?>>
<span id="el_dinasluar_dokumen">
<div id="fd_x_dokumen">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $dinasluar_edit->dokumen->title() ?>" data-table="dinasluar" data-field="x_dokumen" name="x_dokumen" id="x_dokumen" lang="<?php echo CurrentLanguageID() ?>"<?php echo $dinasluar_edit->dokumen->editAttributes() ?><?php if ($dinasluar_edit->dokumen->ReadOnly || $dinasluar_edit->dokumen->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_dokumen"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_dokumen" id= "fn_x_dokumen" value="<?php echo $dinasluar_edit->dokumen->Upload->FileName ?>">
<input type="hidden" name="fa_x_dokumen" id= "fa_x_dokumen" value="<?php echo (Post("fa_x_dokumen") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_dokumen" id= "fs_x_dokumen" value="255">
<input type="hidden" name="fx_x_dokumen" id= "fx_x_dokumen" value="<?php echo $dinasluar_edit->dokumen->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_dokumen" id= "fm_x_dokumen" value="<?php echo $dinasluar_edit->dokumen->UploadMaxFileSize ?>">
</div>
<table id="ft_x_dokumen" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $dinasluar_edit->dokumen->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="dinasluar" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($dinasluar_edit->id->CurrentValue) ?>">
<?php if (!$dinasluar_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $dinasluar_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $dinasluar_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$dinasluar_edit->showPageFooter();
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
$dinasluar_edit->terminate();
?>