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
$ijin_add = new ijin_add();

// Run the page
$ijin_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ijin_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fijinadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fijinadd = currentForm = new ew.Form("fijinadd", "add");

	// Validate form
	fijinadd.validate = function() {
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
			<?php if ($ijin_add->pegawai->Required) { ?>
				elm = this.getElements("x" + infix + "_pegawai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ijin_add->pegawai->caption(), $ijin_add->pegawai->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pegawai");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ijin_add->pegawai->errorMessage()) ?>");
			<?php if ($ijin_add->tgl->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ijin_add->tgl->caption(), $ijin_add->tgl->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ijin_add->tgl_ijin_awal->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_ijin_awal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ijin_add->tgl_ijin_awal->caption(), $ijin_add->tgl_ijin_awal->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_ijin_awal");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ijin_add->tgl_ijin_awal->errorMessage()) ?>");
			<?php if ($ijin_add->tgl_ijin_akhir->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_ijin_akhir");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ijin_add->tgl_ijin_akhir->caption(), $ijin_add->tgl_ijin_akhir->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_ijin_akhir");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ijin_add->tgl_ijin_akhir->errorMessage()) ?>");
			<?php if ($ijin_add->jenis->Required) { ?>
				elm = this.getElements("x" + infix + "_jenis");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ijin_add->jenis->caption(), $ijin_add->jenis->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ijin_add->keterangan->Required) { ?>
				elm = this.getElements("x" + infix + "_keterangan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ijin_add->keterangan->caption(), $ijin_add->keterangan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ijin_add->disetujui->Required) { ?>
				elm = this.getElements("x" + infix + "_disetujui");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ijin_add->disetujui->caption(), $ijin_add->disetujui->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ijin_add->dokumen->Required) { ?>
				felm = this.getElements("x" + infix + "_dokumen");
				elm = this.getElements("fn_x" + infix + "_dokumen");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $ijin_add->dokumen->caption(), $ijin_add->dokumen->RequiredErrorMessage)) ?>");
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
	fijinadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fijinadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fijinadd.lists["x_pegawai"] = <?php echo $ijin_add->pegawai->Lookup->toClientList($ijin_add) ?>;
	fijinadd.lists["x_pegawai"].options = <?php echo JsonEncode($ijin_add->pegawai->lookupOptions()) ?>;
	fijinadd.autoSuggests["x_pegawai"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fijinadd.lists["x_disetujui"] = <?php echo $ijin_add->disetujui->Lookup->toClientList($ijin_add) ?>;
	fijinadd.lists["x_disetujui"].options = <?php echo JsonEncode($ijin_add->disetujui->options(FALSE, TRUE)) ?>;
	loadjs.done("fijinadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ijin_add->showPageHeader(); ?>
<?php
$ijin_add->showMessage();
?>
<form name="fijinadd" id="fijinadd" class="<?php echo $ijin_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ijin">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$ijin_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($ijin_add->pegawai->Visible) { // pegawai ?>
	<div id="r_pegawai" class="form-group row">
		<label id="elh_ijin_pegawai" class="<?php echo $ijin_add->LeftColumnClass ?>"><?php echo $ijin_add->pegawai->caption() ?><?php echo $ijin_add->pegawai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ijin_add->RightColumnClass ?>"><div <?php echo $ijin_add->pegawai->cellAttributes() ?>>
<span id="el_ijin_pegawai">
<?php
$onchange = $ijin_add->pegawai->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$ijin_add->pegawai->EditAttrs["onchange"] = "";
?>
<span id="as_x_pegawai">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_pegawai" id="sv_x_pegawai" value="<?php echo RemoveHtml($ijin_add->pegawai->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($ijin_add->pegawai->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($ijin_add->pegawai->getPlaceHolder()) ?>"<?php echo $ijin_add->pegawai->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($ijin_add->pegawai->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_pegawai',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($ijin_add->pegawai->ReadOnly || $ijin_add->pegawai->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="ijin" data-field="x_pegawai" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $ijin_add->pegawai->displayValueSeparatorAttribute() ?>" name="x_pegawai" id="x_pegawai" value="<?php echo HtmlEncode($ijin_add->pegawai->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fijinadd"], function() {
	fijinadd.createAutoSuggest({"id":"x_pegawai","forceSelect":false});
});
</script>
<?php echo $ijin_add->pegawai->Lookup->getParamTag($ijin_add, "p_x_pegawai") ?>
</span>
<?php echo $ijin_add->pegawai->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ijin_add->tgl_ijin_awal->Visible) { // tgl_ijin_awal ?>
	<div id="r_tgl_ijin_awal" class="form-group row">
		<label id="elh_ijin_tgl_ijin_awal" for="x_tgl_ijin_awal" class="<?php echo $ijin_add->LeftColumnClass ?>"><?php echo $ijin_add->tgl_ijin_awal->caption() ?><?php echo $ijin_add->tgl_ijin_awal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ijin_add->RightColumnClass ?>"><div <?php echo $ijin_add->tgl_ijin_awal->cellAttributes() ?>>
<span id="el_ijin_tgl_ijin_awal">
<input type="text" data-table="ijin" data-field="x_tgl_ijin_awal" name="x_tgl_ijin_awal" id="x_tgl_ijin_awal" maxlength="10" placeholder="<?php echo HtmlEncode($ijin_add->tgl_ijin_awal->getPlaceHolder()) ?>" value="<?php echo $ijin_add->tgl_ijin_awal->EditValue ?>"<?php echo $ijin_add->tgl_ijin_awal->editAttributes() ?>>
<?php if (!$ijin_add->tgl_ijin_awal->ReadOnly && !$ijin_add->tgl_ijin_awal->Disabled && !isset($ijin_add->tgl_ijin_awal->EditAttrs["readonly"]) && !isset($ijin_add->tgl_ijin_awal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fijinadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fijinadd", "x_tgl_ijin_awal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $ijin_add->tgl_ijin_awal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ijin_add->tgl_ijin_akhir->Visible) { // tgl_ijin_akhir ?>
	<div id="r_tgl_ijin_akhir" class="form-group row">
		<label id="elh_ijin_tgl_ijin_akhir" for="x_tgl_ijin_akhir" class="<?php echo $ijin_add->LeftColumnClass ?>"><?php echo $ijin_add->tgl_ijin_akhir->caption() ?><?php echo $ijin_add->tgl_ijin_akhir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ijin_add->RightColumnClass ?>"><div <?php echo $ijin_add->tgl_ijin_akhir->cellAttributes() ?>>
<span id="el_ijin_tgl_ijin_akhir">
<input type="text" data-table="ijin" data-field="x_tgl_ijin_akhir" name="x_tgl_ijin_akhir" id="x_tgl_ijin_akhir" maxlength="10" placeholder="<?php echo HtmlEncode($ijin_add->tgl_ijin_akhir->getPlaceHolder()) ?>" value="<?php echo $ijin_add->tgl_ijin_akhir->EditValue ?>"<?php echo $ijin_add->tgl_ijin_akhir->editAttributes() ?>>
<?php if (!$ijin_add->tgl_ijin_akhir->ReadOnly && !$ijin_add->tgl_ijin_akhir->Disabled && !isset($ijin_add->tgl_ijin_akhir->EditAttrs["readonly"]) && !isset($ijin_add->tgl_ijin_akhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fijinadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fijinadd", "x_tgl_ijin_akhir", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $ijin_add->tgl_ijin_akhir->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ijin_add->jenis->Visible) { // jenis ?>
	<div id="r_jenis" class="form-group row">
		<label id="elh_ijin_jenis" for="x_jenis" class="<?php echo $ijin_add->LeftColumnClass ?>"><?php echo $ijin_add->jenis->caption() ?><?php echo $ijin_add->jenis->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ijin_add->RightColumnClass ?>"><div <?php echo $ijin_add->jenis->cellAttributes() ?>>
<span id="el_ijin_jenis">
<input type="text" data-table="ijin" data-field="x_jenis" name="x_jenis" id="x_jenis" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ijin_add->jenis->getPlaceHolder()) ?>" value="<?php echo $ijin_add->jenis->EditValue ?>"<?php echo $ijin_add->jenis->editAttributes() ?>>
</span>
<?php echo $ijin_add->jenis->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ijin_add->keterangan->Visible) { // keterangan ?>
	<div id="r_keterangan" class="form-group row">
		<label id="elh_ijin_keterangan" for="x_keterangan" class="<?php echo $ijin_add->LeftColumnClass ?>"><?php echo $ijin_add->keterangan->caption() ?><?php echo $ijin_add->keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ijin_add->RightColumnClass ?>"><div <?php echo $ijin_add->keterangan->cellAttributes() ?>>
<span id="el_ijin_keterangan">
<input type="text" data-table="ijin" data-field="x_keterangan" name="x_keterangan" id="x_keterangan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ijin_add->keterangan->getPlaceHolder()) ?>" value="<?php echo $ijin_add->keterangan->EditValue ?>"<?php echo $ijin_add->keterangan->editAttributes() ?>>
</span>
<?php echo $ijin_add->keterangan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ijin_add->disetujui->Visible) { // disetujui ?>
	<div id="r_disetujui" class="form-group row">
		<label id="elh_ijin_disetujui" class="<?php echo $ijin_add->LeftColumnClass ?>"><?php echo $ijin_add->disetujui->caption() ?><?php echo $ijin_add->disetujui->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ijin_add->RightColumnClass ?>"><div <?php echo $ijin_add->disetujui->cellAttributes() ?>>
<span id="el_ijin_disetujui">
<div id="tp_x_disetujui" class="ew-template"><input type="radio" class="custom-control-input" data-table="ijin" data-field="x_disetujui" data-value-separator="<?php echo $ijin_add->disetujui->displayValueSeparatorAttribute() ?>" name="x_disetujui" id="x_disetujui" value="{value}"<?php echo $ijin_add->disetujui->editAttributes() ?>></div>
<div id="dsl_x_disetujui" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $ijin_add->disetujui->radioButtonListHtml(FALSE, "x_disetujui") ?>
</div></div>
</span>
<?php echo $ijin_add->disetujui->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ijin_add->dokumen->Visible) { // dokumen ?>
	<div id="r_dokumen" class="form-group row">
		<label id="elh_ijin_dokumen" class="<?php echo $ijin_add->LeftColumnClass ?>"><?php echo $ijin_add->dokumen->caption() ?><?php echo $ijin_add->dokumen->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ijin_add->RightColumnClass ?>"><div <?php echo $ijin_add->dokumen->cellAttributes() ?>>
<span id="el_ijin_dokumen">
<div id="fd_x_dokumen">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $ijin_add->dokumen->title() ?>" data-table="ijin" data-field="x_dokumen" name="x_dokumen" id="x_dokumen" lang="<?php echo CurrentLanguageID() ?>"<?php echo $ijin_add->dokumen->editAttributes() ?><?php if ($ijin_add->dokumen->ReadOnly || $ijin_add->dokumen->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_dokumen"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_dokumen" id= "fn_x_dokumen" value="<?php echo $ijin_add->dokumen->Upload->FileName ?>">
<input type="hidden" name="fa_x_dokumen" id= "fa_x_dokumen" value="0">
<input type="hidden" name="fs_x_dokumen" id= "fs_x_dokumen" value="255">
<input type="hidden" name="fx_x_dokumen" id= "fx_x_dokumen" value="<?php echo $ijin_add->dokumen->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_dokumen" id= "fm_x_dokumen" value="<?php echo $ijin_add->dokumen->UploadMaxFileSize ?>">
</div>
<table id="ft_x_dokumen" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $ijin_add->dokumen->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$ijin_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $ijin_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ijin_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$ijin_add->showPageFooter();
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
$ijin_add->terminate();
?>