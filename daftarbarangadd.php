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
$daftarbarang_add = new daftarbarang_add();

// Run the page
$daftarbarang_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$daftarbarang_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdaftarbarangadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fdaftarbarangadd = currentForm = new ew.Form("fdaftarbarangadd", "add");

	// Validate form
	fdaftarbarangadd.validate = function() {
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
			<?php if ($daftarbarang_add->pemegang->Required) { ?>
				elm = this.getElements("x" + infix + "_pemegang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $daftarbarang_add->pemegang->caption(), $daftarbarang_add->pemegang->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pemegang");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($daftarbarang_add->pemegang->errorMessage()) ?>");
			<?php if ($daftarbarang_add->nama->Required) { ?>
				elm = this.getElements("x" + infix + "_nama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $daftarbarang_add->nama->caption(), $daftarbarang_add->nama->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($daftarbarang_add->jenis->Required) { ?>
				elm = this.getElements("x" + infix + "_jenis");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $daftarbarang_add->jenis->caption(), $daftarbarang_add->jenis->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($daftarbarang_add->sepsifikasi->Required) { ?>
				elm = this.getElements("x" + infix + "_sepsifikasi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $daftarbarang_add->sepsifikasi->caption(), $daftarbarang_add->sepsifikasi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($daftarbarang_add->tgl_terima->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_terima");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $daftarbarang_add->tgl_terima->caption(), $daftarbarang_add->tgl_terima->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_terima");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($daftarbarang_add->tgl_terima->errorMessage()) ?>");
			<?php if ($daftarbarang_add->tgl_beli->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_beli");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $daftarbarang_add->tgl_beli->caption(), $daftarbarang_add->tgl_beli->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_beli");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($daftarbarang_add->tgl_beli->errorMessage()) ?>");
			<?php if ($daftarbarang_add->harga->Required) { ?>
				elm = this.getElements("x" + infix + "_harga");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $daftarbarang_add->harga->caption(), $daftarbarang_add->harga->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_harga");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($daftarbarang_add->harga->errorMessage()) ?>");
			<?php if ($daftarbarang_add->dokumen->Required) { ?>
				felm = this.getElements("x" + infix + "_dokumen");
				elm = this.getElements("fn_x" + infix + "_dokumen");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $daftarbarang_add->dokumen->caption(), $daftarbarang_add->dokumen->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($daftarbarang_add->foto->Required) { ?>
				felm = this.getElements("x" + infix + "_foto");
				elm = this.getElements("fn_x" + infix + "_foto");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $daftarbarang_add->foto->caption(), $daftarbarang_add->foto->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($daftarbarang_add->keterangan->Required) { ?>
				elm = this.getElements("x" + infix + "_keterangan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $daftarbarang_add->keterangan->caption(), $daftarbarang_add->keterangan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($daftarbarang_add->deskripsi->Required) { ?>
				elm = this.getElements("x" + infix + "_deskripsi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $daftarbarang_add->deskripsi->caption(), $daftarbarang_add->deskripsi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($daftarbarang_add->status->Required) { ?>
				elm = this.getElements("x" + infix + "_status");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $daftarbarang_add->status->caption(), $daftarbarang_add->status->RequiredErrorMessage)) ?>");
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
	fdaftarbarangadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdaftarbarangadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdaftarbarangadd.lists["x_pemegang"] = <?php echo $daftarbarang_add->pemegang->Lookup->toClientList($daftarbarang_add) ?>;
	fdaftarbarangadd.lists["x_pemegang"].options = <?php echo JsonEncode($daftarbarang_add->pemegang->lookupOptions()) ?>;
	fdaftarbarangadd.autoSuggests["x_pemegang"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fdaftarbarangadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $daftarbarang_add->showPageHeader(); ?>
<?php
$daftarbarang_add->showMessage();
?>
<form name="fdaftarbarangadd" id="fdaftarbarangadd" class="<?php echo $daftarbarang_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="daftarbarang">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$daftarbarang_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($daftarbarang_add->pemegang->Visible) { // pemegang ?>
	<div id="r_pemegang" class="form-group row">
		<label id="elh_daftarbarang_pemegang" class="<?php echo $daftarbarang_add->LeftColumnClass ?>"><?php echo $daftarbarang_add->pemegang->caption() ?><?php echo $daftarbarang_add->pemegang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $daftarbarang_add->RightColumnClass ?>"><div <?php echo $daftarbarang_add->pemegang->cellAttributes() ?>>
<span id="el_daftarbarang_pemegang">
<?php
$onchange = $daftarbarang_add->pemegang->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$daftarbarang_add->pemegang->EditAttrs["onchange"] = "";
?>
<span id="as_x_pemegang">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_pemegang" id="sv_x_pemegang" value="<?php echo RemoveHtml($daftarbarang_add->pemegang->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($daftarbarang_add->pemegang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($daftarbarang_add->pemegang->getPlaceHolder()) ?>"<?php echo $daftarbarang_add->pemegang->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($daftarbarang_add->pemegang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_pemegang',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($daftarbarang_add->pemegang->ReadOnly || $daftarbarang_add->pemegang->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="daftarbarang" data-field="x_pemegang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $daftarbarang_add->pemegang->displayValueSeparatorAttribute() ?>" name="x_pemegang" id="x_pemegang" value="<?php echo HtmlEncode($daftarbarang_add->pemegang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdaftarbarangadd"], function() {
	fdaftarbarangadd.createAutoSuggest({"id":"x_pemegang","forceSelect":true});
});
</script>
<?php echo $daftarbarang_add->pemegang->Lookup->getParamTag($daftarbarang_add, "p_x_pemegang") ?>
</span>
<?php echo $daftarbarang_add->pemegang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($daftarbarang_add->nama->Visible) { // nama ?>
	<div id="r_nama" class="form-group row">
		<label id="elh_daftarbarang_nama" for="x_nama" class="<?php echo $daftarbarang_add->LeftColumnClass ?>"><?php echo $daftarbarang_add->nama->caption() ?><?php echo $daftarbarang_add->nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $daftarbarang_add->RightColumnClass ?>"><div <?php echo $daftarbarang_add->nama->cellAttributes() ?>>
<span id="el_daftarbarang_nama">
<input type="text" data-table="daftarbarang" data-field="x_nama" name="x_nama" id="x_nama" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($daftarbarang_add->nama->getPlaceHolder()) ?>" value="<?php echo $daftarbarang_add->nama->EditValue ?>"<?php echo $daftarbarang_add->nama->editAttributes() ?>>
</span>
<?php echo $daftarbarang_add->nama->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($daftarbarang_add->jenis->Visible) { // jenis ?>
	<div id="r_jenis" class="form-group row">
		<label id="elh_daftarbarang_jenis" for="x_jenis" class="<?php echo $daftarbarang_add->LeftColumnClass ?>"><?php echo $daftarbarang_add->jenis->caption() ?><?php echo $daftarbarang_add->jenis->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $daftarbarang_add->RightColumnClass ?>"><div <?php echo $daftarbarang_add->jenis->cellAttributes() ?>>
<span id="el_daftarbarang_jenis">
<input type="text" data-table="daftarbarang" data-field="x_jenis" name="x_jenis" id="x_jenis" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($daftarbarang_add->jenis->getPlaceHolder()) ?>" value="<?php echo $daftarbarang_add->jenis->EditValue ?>"<?php echo $daftarbarang_add->jenis->editAttributes() ?>>
</span>
<?php echo $daftarbarang_add->jenis->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($daftarbarang_add->sepsifikasi->Visible) { // sepsifikasi ?>
	<div id="r_sepsifikasi" class="form-group row">
		<label id="elh_daftarbarang_sepsifikasi" for="x_sepsifikasi" class="<?php echo $daftarbarang_add->LeftColumnClass ?>"><?php echo $daftarbarang_add->sepsifikasi->caption() ?><?php echo $daftarbarang_add->sepsifikasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $daftarbarang_add->RightColumnClass ?>"><div <?php echo $daftarbarang_add->sepsifikasi->cellAttributes() ?>>
<span id="el_daftarbarang_sepsifikasi">
<input type="text" data-table="daftarbarang" data-field="x_sepsifikasi" name="x_sepsifikasi" id="x_sepsifikasi" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($daftarbarang_add->sepsifikasi->getPlaceHolder()) ?>" value="<?php echo $daftarbarang_add->sepsifikasi->EditValue ?>"<?php echo $daftarbarang_add->sepsifikasi->editAttributes() ?>>
</span>
<?php echo $daftarbarang_add->sepsifikasi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($daftarbarang_add->tgl_terima->Visible) { // tgl_terima ?>
	<div id="r_tgl_terima" class="form-group row">
		<label id="elh_daftarbarang_tgl_terima" for="x_tgl_terima" class="<?php echo $daftarbarang_add->LeftColumnClass ?>"><?php echo $daftarbarang_add->tgl_terima->caption() ?><?php echo $daftarbarang_add->tgl_terima->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $daftarbarang_add->RightColumnClass ?>"><div <?php echo $daftarbarang_add->tgl_terima->cellAttributes() ?>>
<span id="el_daftarbarang_tgl_terima">
<input type="text" data-table="daftarbarang" data-field="x_tgl_terima" name="x_tgl_terima" id="x_tgl_terima" maxlength="19" placeholder="<?php echo HtmlEncode($daftarbarang_add->tgl_terima->getPlaceHolder()) ?>" value="<?php echo $daftarbarang_add->tgl_terima->EditValue ?>"<?php echo $daftarbarang_add->tgl_terima->editAttributes() ?>>
<?php if (!$daftarbarang_add->tgl_terima->ReadOnly && !$daftarbarang_add->tgl_terima->Disabled && !isset($daftarbarang_add->tgl_terima->EditAttrs["readonly"]) && !isset($daftarbarang_add->tgl_terima->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdaftarbarangadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fdaftarbarangadd", "x_tgl_terima", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $daftarbarang_add->tgl_terima->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($daftarbarang_add->tgl_beli->Visible) { // tgl_beli ?>
	<div id="r_tgl_beli" class="form-group row">
		<label id="elh_daftarbarang_tgl_beli" for="x_tgl_beli" class="<?php echo $daftarbarang_add->LeftColumnClass ?>"><?php echo $daftarbarang_add->tgl_beli->caption() ?><?php echo $daftarbarang_add->tgl_beli->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $daftarbarang_add->RightColumnClass ?>"><div <?php echo $daftarbarang_add->tgl_beli->cellAttributes() ?>>
<span id="el_daftarbarang_tgl_beli">
<input type="text" data-table="daftarbarang" data-field="x_tgl_beli" name="x_tgl_beli" id="x_tgl_beli" maxlength="19" placeholder="<?php echo HtmlEncode($daftarbarang_add->tgl_beli->getPlaceHolder()) ?>" value="<?php echo $daftarbarang_add->tgl_beli->EditValue ?>"<?php echo $daftarbarang_add->tgl_beli->editAttributes() ?>>
<?php if (!$daftarbarang_add->tgl_beli->ReadOnly && !$daftarbarang_add->tgl_beli->Disabled && !isset($daftarbarang_add->tgl_beli->EditAttrs["readonly"]) && !isset($daftarbarang_add->tgl_beli->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdaftarbarangadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fdaftarbarangadd", "x_tgl_beli", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $daftarbarang_add->tgl_beli->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($daftarbarang_add->harga->Visible) { // harga ?>
	<div id="r_harga" class="form-group row">
		<label id="elh_daftarbarang_harga" for="x_harga" class="<?php echo $daftarbarang_add->LeftColumnClass ?>"><?php echo $daftarbarang_add->harga->caption() ?><?php echo $daftarbarang_add->harga->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $daftarbarang_add->RightColumnClass ?>"><div <?php echo $daftarbarang_add->harga->cellAttributes() ?>>
<span id="el_daftarbarang_harga">
<input type="text" data-table="daftarbarang" data-field="x_harga" name="x_harga" id="x_harga" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($daftarbarang_add->harga->getPlaceHolder()) ?>" value="<?php echo $daftarbarang_add->harga->EditValue ?>"<?php echo $daftarbarang_add->harga->editAttributes() ?>>
</span>
<?php echo $daftarbarang_add->harga->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($daftarbarang_add->dokumen->Visible) { // dokumen ?>
	<div id="r_dokumen" class="form-group row">
		<label id="elh_daftarbarang_dokumen" class="<?php echo $daftarbarang_add->LeftColumnClass ?>"><?php echo $daftarbarang_add->dokumen->caption() ?><?php echo $daftarbarang_add->dokumen->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $daftarbarang_add->RightColumnClass ?>"><div <?php echo $daftarbarang_add->dokumen->cellAttributes() ?>>
<span id="el_daftarbarang_dokumen">
<div id="fd_x_dokumen">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $daftarbarang_add->dokumen->title() ?>" data-table="daftarbarang" data-field="x_dokumen" name="x_dokumen" id="x_dokumen" lang="<?php echo CurrentLanguageID() ?>"<?php echo $daftarbarang_add->dokumen->editAttributes() ?><?php if ($daftarbarang_add->dokumen->ReadOnly || $daftarbarang_add->dokumen->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_dokumen"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_dokumen" id= "fn_x_dokumen" value="<?php echo $daftarbarang_add->dokumen->Upload->FileName ?>">
<input type="hidden" name="fa_x_dokumen" id= "fa_x_dokumen" value="0">
<input type="hidden" name="fs_x_dokumen" id= "fs_x_dokumen" value="255">
<input type="hidden" name="fx_x_dokumen" id= "fx_x_dokumen" value="<?php echo $daftarbarang_add->dokumen->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_dokumen" id= "fm_x_dokumen" value="<?php echo $daftarbarang_add->dokumen->UploadMaxFileSize ?>">
</div>
<table id="ft_x_dokumen" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $daftarbarang_add->dokumen->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($daftarbarang_add->foto->Visible) { // foto ?>
	<div id="r_foto" class="form-group row">
		<label id="elh_daftarbarang_foto" class="<?php echo $daftarbarang_add->LeftColumnClass ?>"><?php echo $daftarbarang_add->foto->caption() ?><?php echo $daftarbarang_add->foto->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $daftarbarang_add->RightColumnClass ?>"><div <?php echo $daftarbarang_add->foto->cellAttributes() ?>>
<span id="el_daftarbarang_foto">
<div id="fd_x_foto">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $daftarbarang_add->foto->title() ?>" data-table="daftarbarang" data-field="x_foto" name="x_foto" id="x_foto" lang="<?php echo CurrentLanguageID() ?>"<?php echo $daftarbarang_add->foto->editAttributes() ?><?php if ($daftarbarang_add->foto->ReadOnly || $daftarbarang_add->foto->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_foto"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_foto" id= "fn_x_foto" value="<?php echo $daftarbarang_add->foto->Upload->FileName ?>">
<input type="hidden" name="fa_x_foto" id= "fa_x_foto" value="0">
<input type="hidden" name="fs_x_foto" id= "fs_x_foto" value="255">
<input type="hidden" name="fx_x_foto" id= "fx_x_foto" value="<?php echo $daftarbarang_add->foto->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_foto" id= "fm_x_foto" value="<?php echo $daftarbarang_add->foto->UploadMaxFileSize ?>">
</div>
<table id="ft_x_foto" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $daftarbarang_add->foto->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($daftarbarang_add->keterangan->Visible) { // keterangan ?>
	<div id="r_keterangan" class="form-group row">
		<label id="elh_daftarbarang_keterangan" for="x_keterangan" class="<?php echo $daftarbarang_add->LeftColumnClass ?>"><?php echo $daftarbarang_add->keterangan->caption() ?><?php echo $daftarbarang_add->keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $daftarbarang_add->RightColumnClass ?>"><div <?php echo $daftarbarang_add->keterangan->cellAttributes() ?>>
<span id="el_daftarbarang_keterangan">
<input type="text" data-table="daftarbarang" data-field="x_keterangan" name="x_keterangan" id="x_keterangan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($daftarbarang_add->keterangan->getPlaceHolder()) ?>" value="<?php echo $daftarbarang_add->keterangan->EditValue ?>"<?php echo $daftarbarang_add->keterangan->editAttributes() ?>>
</span>
<?php echo $daftarbarang_add->keterangan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($daftarbarang_add->deskripsi->Visible) { // deskripsi ?>
	<div id="r_deskripsi" class="form-group row">
		<label id="elh_daftarbarang_deskripsi" for="x_deskripsi" class="<?php echo $daftarbarang_add->LeftColumnClass ?>"><?php echo $daftarbarang_add->deskripsi->caption() ?><?php echo $daftarbarang_add->deskripsi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $daftarbarang_add->RightColumnClass ?>"><div <?php echo $daftarbarang_add->deskripsi->cellAttributes() ?>>
<span id="el_daftarbarang_deskripsi">
<input type="text" data-table="daftarbarang" data-field="x_deskripsi" name="x_deskripsi" id="x_deskripsi" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($daftarbarang_add->deskripsi->getPlaceHolder()) ?>" value="<?php echo $daftarbarang_add->deskripsi->EditValue ?>"<?php echo $daftarbarang_add->deskripsi->editAttributes() ?>>
</span>
<?php echo $daftarbarang_add->deskripsi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($daftarbarang_add->status->Visible) { // status ?>
	<div id="r_status" class="form-group row">
		<label id="elh_daftarbarang_status" for="x_status" class="<?php echo $daftarbarang_add->LeftColumnClass ?>"><?php echo $daftarbarang_add->status->caption() ?><?php echo $daftarbarang_add->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $daftarbarang_add->RightColumnClass ?>"><div <?php echo $daftarbarang_add->status->cellAttributes() ?>>
<span id="el_daftarbarang_status">
<input type="text" data-table="daftarbarang" data-field="x_status" name="x_status" id="x_status" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($daftarbarang_add->status->getPlaceHolder()) ?>" value="<?php echo $daftarbarang_add->status->EditValue ?>"<?php echo $daftarbarang_add->status->editAttributes() ?>>
</span>
<?php echo $daftarbarang_add->status->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$daftarbarang_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $daftarbarang_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $daftarbarang_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$daftarbarang_add->showPageFooter();
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
$daftarbarang_add->terminate();
?>