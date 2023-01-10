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
$pegawai_edit = new pegawai_edit();

// Run the page
$pegawai_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pegawai_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpegawaiedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fpegawaiedit = currentForm = new ew.Form("fpegawaiedit", "edit");

	// Validate form
	fpegawaiedit.validate = function() {
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
			<?php if ($pegawai_edit->nip->Required) { ?>
				elm = this.getElements("x" + infix + "_nip");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pegawai_edit->nip->caption(), $pegawai_edit->nip->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pegawai_edit->username->Required) { ?>
				elm = this.getElements("x" + infix + "_username");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pegawai_edit->username->caption(), $pegawai_edit->username->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pegawai_edit->password->Required) { ?>
				elm = this.getElements("x" + infix + "_password");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pegawai_edit->password->caption(), $pegawai_edit->password->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pegawai_edit->jenjang_id->Required) { ?>
				elm = this.getElements("x" + infix + "_jenjang_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pegawai_edit->jenjang_id->caption(), $pegawai_edit->jenjang_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pegawai_edit->jabatan->Required) { ?>
				elm = this.getElements("x" + infix + "_jabatan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pegawai_edit->jabatan->caption(), $pegawai_edit->jabatan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pegawai_edit->periode_jabatan->Required) { ?>
				elm = this.getElements("x" + infix + "_periode_jabatan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pegawai_edit->periode_jabatan->caption(), $pegawai_edit->periode_jabatan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_periode_jabatan");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($pegawai_edit->periode_jabatan->errorMessage()) ?>");
			<?php if ($pegawai_edit->type->Required) { ?>
				elm = this.getElements("x" + infix + "_type");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pegawai_edit->type->caption(), $pegawai_edit->type->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_type");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($pegawai_edit->type->errorMessage()) ?>");
			<?php if ($pegawai_edit->sertif->Required) { ?>
				elm = this.getElements("x" + infix + "_sertif");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pegawai_edit->sertif->caption(), $pegawai_edit->sertif->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pegawai_edit->tambahan->Required) { ?>
				elm = this.getElements("x" + infix + "_tambahan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pegawai_edit->tambahan->caption(), $pegawai_edit->tambahan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pegawai_edit->lama_kerja->Required) { ?>
				elm = this.getElements("x" + infix + "_lama_kerja");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pegawai_edit->lama_kerja->caption(), $pegawai_edit->lama_kerja->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_lama_kerja");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($pegawai_edit->lama_kerja->errorMessage()) ?>");
			<?php if ($pegawai_edit->nama->Required) { ?>
				elm = this.getElements("x" + infix + "_nama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pegawai_edit->nama->caption(), $pegawai_edit->nama->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pegawai_edit->alamat->Required) { ?>
				elm = this.getElements("x" + infix + "_alamat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pegawai_edit->alamat->caption(), $pegawai_edit->alamat->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pegawai_edit->_email->Required) { ?>
				elm = this.getElements("x" + infix + "__email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pegawai_edit->_email->caption(), $pegawai_edit->_email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pegawai_edit->wa->Required) { ?>
				elm = this.getElements("x" + infix + "_wa");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pegawai_edit->wa->caption(), $pegawai_edit->wa->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pegawai_edit->hp->Required) { ?>
				elm = this.getElements("x" + infix + "_hp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pegawai_edit->hp->caption(), $pegawai_edit->hp->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pegawai_edit->tgllahir->Required) { ?>
				elm = this.getElements("x" + infix + "_tgllahir");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pegawai_edit->tgllahir->caption(), $pegawai_edit->tgllahir->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgllahir");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($pegawai_edit->tgllahir->errorMessage()) ?>");
			<?php if ($pegawai_edit->rekbank->Required) { ?>
				elm = this.getElements("x" + infix + "_rekbank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pegawai_edit->rekbank->caption(), $pegawai_edit->rekbank->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pegawai_edit->pendidikan->Required) { ?>
				elm = this.getElements("x" + infix + "_pendidikan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pegawai_edit->pendidikan->caption(), $pegawai_edit->pendidikan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pegawai_edit->jurusan->Required) { ?>
				elm = this.getElements("x" + infix + "_jurusan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pegawai_edit->jurusan->caption(), $pegawai_edit->jurusan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pegawai_edit->agama->Required) { ?>
				elm = this.getElements("x" + infix + "_agama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pegawai_edit->agama->caption(), $pegawai_edit->agama->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pegawai_edit->jenkel->Required) { ?>
				elm = this.getElements("x" + infix + "_jenkel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pegawai_edit->jenkel->caption(), $pegawai_edit->jenkel->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pegawai_edit->status->Required) { ?>
				elm = this.getElements("x" + infix + "_status");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pegawai_edit->status->caption(), $pegawai_edit->status->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pegawai_edit->foto->Required) { ?>
				felm = this.getElements("x" + infix + "_foto");
				elm = this.getElements("fn_x" + infix + "_foto");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $pegawai_edit->foto->caption(), $pegawai_edit->foto->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pegawai_edit->file_cv->Required) { ?>
				felm = this.getElements("x" + infix + "_file_cv");
				elm = this.getElements("fn_x" + infix + "_file_cv");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $pegawai_edit->file_cv->caption(), $pegawai_edit->file_cv->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pegawai_edit->mulai_bekerja->Required) { ?>
				elm = this.getElements("x" + infix + "_mulai_bekerja");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pegawai_edit->mulai_bekerja->caption(), $pegawai_edit->mulai_bekerja->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_mulai_bekerja");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($pegawai_edit->mulai_bekerja->errorMessage()) ?>");
			<?php if ($pegawai_edit->keterangan->Required) { ?>
				elm = this.getElements("x" + infix + "_keterangan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pegawai_edit->keterangan->caption(), $pegawai_edit->keterangan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pegawai_edit->level->Required) { ?>
				elm = this.getElements("x" + infix + "_level");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pegawai_edit->level->caption(), $pegawai_edit->level->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pegawai_edit->aktif->Required) { ?>
				elm = this.getElements("x" + infix + "_aktif");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pegawai_edit->aktif->caption(), $pegawai_edit->aktif->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_aktif");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($pegawai_edit->aktif->errorMessage()) ?>");

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
	fpegawaiedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpegawaiedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fpegawaiedit.lists["x_jenjang_id"] = <?php echo $pegawai_edit->jenjang_id->Lookup->toClientList($pegawai_edit) ?>;
	fpegawaiedit.lists["x_jenjang_id"].options = <?php echo JsonEncode($pegawai_edit->jenjang_id->lookupOptions()) ?>;
	fpegawaiedit.lists["x_jabatan"] = <?php echo $pegawai_edit->jabatan->Lookup->toClientList($pegawai_edit) ?>;
	fpegawaiedit.lists["x_jabatan"].options = <?php echo JsonEncode($pegawai_edit->jabatan->lookupOptions()) ?>;
	fpegawaiedit.lists["x_type"] = <?php echo $pegawai_edit->type->Lookup->toClientList($pegawai_edit) ?>;
	fpegawaiedit.lists["x_type"].options = <?php echo JsonEncode($pegawai_edit->type->lookupOptions()) ?>;
	fpegawaiedit.autoSuggests["x_type"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fpegawaiedit.lists["x_sertif"] = <?php echo $pegawai_edit->sertif->Lookup->toClientList($pegawai_edit) ?>;
	fpegawaiedit.lists["x_sertif"].options = <?php echo JsonEncode($pegawai_edit->sertif->lookupOptions()) ?>;
	fpegawaiedit.lists["x_tambahan"] = <?php echo $pegawai_edit->tambahan->Lookup->toClientList($pegawai_edit) ?>;
	fpegawaiedit.lists["x_tambahan"].options = <?php echo JsonEncode($pegawai_edit->tambahan->lookupOptions()) ?>;
	fpegawaiedit.lists["x_pendidikan"] = <?php echo $pegawai_edit->pendidikan->Lookup->toClientList($pegawai_edit) ?>;
	fpegawaiedit.lists["x_pendidikan"].options = <?php echo JsonEncode($pegawai_edit->pendidikan->lookupOptions()) ?>;
	fpegawaiedit.lists["x_agama"] = <?php echo $pegawai_edit->agama->Lookup->toClientList($pegawai_edit) ?>;
	fpegawaiedit.lists["x_agama"].options = <?php echo JsonEncode($pegawai_edit->agama->lookupOptions()) ?>;
	fpegawaiedit.lists["x_jenkel"] = <?php echo $pegawai_edit->jenkel->Lookup->toClientList($pegawai_edit) ?>;
	fpegawaiedit.lists["x_jenkel"].options = <?php echo JsonEncode($pegawai_edit->jenkel->lookupOptions()) ?>;
	fpegawaiedit.lists["x_level"] = <?php echo $pegawai_edit->level->Lookup->toClientList($pegawai_edit) ?>;
	fpegawaiedit.lists["x_level"].options = <?php echo JsonEncode($pegawai_edit->level->lookupOptions()) ?>;
	loadjs.done("fpegawaiedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $pegawai_edit->showPageHeader(); ?>
<?php
$pegawai_edit->showMessage();
?>
<form name="fpegawaiedit" id="fpegawaiedit" class="<?php echo $pegawai_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pegawai">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$pegawai_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($pegawai_edit->nip->Visible) { // nip ?>
	<div id="r_nip" class="form-group row">
		<label id="elh_pegawai_nip" for="x_nip" class="<?php echo $pegawai_edit->LeftColumnClass ?>"><?php echo $pegawai_edit->nip->caption() ?><?php echo $pegawai_edit->nip->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pegawai_edit->RightColumnClass ?>"><div <?php echo $pegawai_edit->nip->cellAttributes() ?>>
<span id="el_pegawai_nip">
<input type="text" data-table="pegawai" data-field="x_nip" name="x_nip" id="x_nip" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($pegawai_edit->nip->getPlaceHolder()) ?>" value="<?php echo $pegawai_edit->nip->EditValue ?>"<?php echo $pegawai_edit->nip->editAttributes() ?>>
</span>
<?php echo $pegawai_edit->nip->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_edit->username->Visible) { // username ?>
	<div id="r_username" class="form-group row">
		<label id="elh_pegawai_username" for="x_username" class="<?php echo $pegawai_edit->LeftColumnClass ?>"><?php echo $pegawai_edit->username->caption() ?><?php echo $pegawai_edit->username->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pegawai_edit->RightColumnClass ?>"><div <?php echo $pegawai_edit->username->cellAttributes() ?>>
<span id="el_pegawai_username">
<input type="text" data-table="pegawai" data-field="x_username" name="x_username" id="x_username" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($pegawai_edit->username->getPlaceHolder()) ?>" value="<?php echo $pegawai_edit->username->EditValue ?>"<?php echo $pegawai_edit->username->editAttributes() ?>>
</span>
<?php echo $pegawai_edit->username->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_edit->password->Visible) { // password ?>
	<div id="r_password" class="form-group row">
		<label id="elh_pegawai_password" for="x_password" class="<?php echo $pegawai_edit->LeftColumnClass ?>"><?php echo $pegawai_edit->password->caption() ?><?php echo $pegawai_edit->password->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pegawai_edit->RightColumnClass ?>"><div <?php echo $pegawai_edit->password->cellAttributes() ?>>
<span id="el_pegawai_password">
<input type="text" data-table="pegawai" data-field="x_password" name="x_password" id="x_password" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($pegawai_edit->password->getPlaceHolder()) ?>" value="<?php echo $pegawai_edit->password->EditValue ?>"<?php echo $pegawai_edit->password->editAttributes() ?>>
</span>
<?php echo $pegawai_edit->password->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_edit->jenjang_id->Visible) { // jenjang_id ?>
	<div id="r_jenjang_id" class="form-group row">
		<label id="elh_pegawai_jenjang_id" for="x_jenjang_id" class="<?php echo $pegawai_edit->LeftColumnClass ?>"><?php echo $pegawai_edit->jenjang_id->caption() ?><?php echo $pegawai_edit->jenjang_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pegawai_edit->RightColumnClass ?>"><div <?php echo $pegawai_edit->jenjang_id->cellAttributes() ?>>
<span id="el_pegawai_jenjang_id">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_jenjang_id"><?php echo EmptyValue(strval($pegawai_edit->jenjang_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $pegawai_edit->jenjang_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($pegawai_edit->jenjang_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($pegawai_edit->jenjang_id->ReadOnly || $pegawai_edit->jenjang_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_jenjang_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $pegawai_edit->jenjang_id->Lookup->getParamTag($pegawai_edit, "p_x_jenjang_id") ?>
<input type="hidden" data-table="pegawai" data-field="x_jenjang_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $pegawai_edit->jenjang_id->displayValueSeparatorAttribute() ?>" name="x_jenjang_id" id="x_jenjang_id" value="<?php echo $pegawai_edit->jenjang_id->CurrentValue ?>"<?php echo $pegawai_edit->jenjang_id->editAttributes() ?>>
</span>
<?php echo $pegawai_edit->jenjang_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_edit->jabatan->Visible) { // jabatan ?>
	<div id="r_jabatan" class="form-group row">
		<label id="elh_pegawai_jabatan" for="x_jabatan" class="<?php echo $pegawai_edit->LeftColumnClass ?>"><?php echo $pegawai_edit->jabatan->caption() ?><?php echo $pegawai_edit->jabatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pegawai_edit->RightColumnClass ?>"><div <?php echo $pegawai_edit->jabatan->cellAttributes() ?>>
<span id="el_pegawai_jabatan">
<?php $pegawai_edit->jabatan->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_jabatan"><?php echo EmptyValue(strval($pegawai_edit->jabatan->ViewValue)) ? $Language->phrase("PleaseSelect") : $pegawai_edit->jabatan->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($pegawai_edit->jabatan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($pegawai_edit->jabatan->ReadOnly || $pegawai_edit->jabatan->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_jabatan',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $pegawai_edit->jabatan->Lookup->getParamTag($pegawai_edit, "p_x_jabatan") ?>
<input type="hidden" data-table="pegawai" data-field="x_jabatan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $pegawai_edit->jabatan->displayValueSeparatorAttribute() ?>" name="x_jabatan" id="x_jabatan" value="<?php echo $pegawai_edit->jabatan->CurrentValue ?>"<?php echo $pegawai_edit->jabatan->editAttributes() ?>>
</span>
<?php echo $pegawai_edit->jabatan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_edit->periode_jabatan->Visible) { // periode_jabatan ?>
	<div id="r_periode_jabatan" class="form-group row">
		<label id="elh_pegawai_periode_jabatan" for="x_periode_jabatan" class="<?php echo $pegawai_edit->LeftColumnClass ?>"><?php echo $pegawai_edit->periode_jabatan->caption() ?><?php echo $pegawai_edit->periode_jabatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pegawai_edit->RightColumnClass ?>"><div <?php echo $pegawai_edit->periode_jabatan->cellAttributes() ?>>
<span id="el_pegawai_periode_jabatan">
<input type="text" data-table="pegawai" data-field="x_periode_jabatan" name="x_periode_jabatan" id="x_periode_jabatan" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($pegawai_edit->periode_jabatan->getPlaceHolder()) ?>" value="<?php echo $pegawai_edit->periode_jabatan->EditValue ?>"<?php echo $pegawai_edit->periode_jabatan->editAttributes() ?>>
</span>
<?php echo $pegawai_edit->periode_jabatan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_edit->type->Visible) { // type ?>
	<div id="r_type" class="form-group row">
		<label id="elh_pegawai_type" class="<?php echo $pegawai_edit->LeftColumnClass ?>"><?php echo $pegawai_edit->type->caption() ?><?php echo $pegawai_edit->type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pegawai_edit->RightColumnClass ?>"><div <?php echo $pegawai_edit->type->cellAttributes() ?>>
<span id="el_pegawai_type">
<?php
$onchange = $pegawai_edit->type->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$pegawai_edit->type->EditAttrs["onchange"] = "";
?>
<span id="as_x_type">
	<input type="text" class="form-control" name="sv_x_type" id="sv_x_type" value="<?php echo RemoveHtml($pegawai_edit->type->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($pegawai_edit->type->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($pegawai_edit->type->getPlaceHolder()) ?>"<?php echo $pegawai_edit->type->editAttributes() ?>>
</span>
<input type="hidden" data-table="pegawai" data-field="x_type" data-value-separator="<?php echo $pegawai_edit->type->displayValueSeparatorAttribute() ?>" name="x_type" id="x_type" value="<?php echo HtmlEncode($pegawai_edit->type->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fpegawaiedit"], function() {
	fpegawaiedit.createAutoSuggest({"id":"x_type","forceSelect":false});
});
</script>
<?php echo $pegawai_edit->type->Lookup->getParamTag($pegawai_edit, "p_x_type") ?>
</span>
<?php echo $pegawai_edit->type->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_edit->sertif->Visible) { // sertif ?>
	<div id="r_sertif" class="form-group row">
		<label id="elh_pegawai_sertif" for="x_sertif" class="<?php echo $pegawai_edit->LeftColumnClass ?>"><?php echo $pegawai_edit->sertif->caption() ?><?php echo $pegawai_edit->sertif->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pegawai_edit->RightColumnClass ?>"><div <?php echo $pegawai_edit->sertif->cellAttributes() ?>>
<span id="el_pegawai_sertif">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_sertif"><?php echo EmptyValue(strval($pegawai_edit->sertif->ViewValue)) ? $Language->phrase("PleaseSelect") : $pegawai_edit->sertif->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($pegawai_edit->sertif->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($pegawai_edit->sertif->ReadOnly || $pegawai_edit->sertif->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_sertif',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $pegawai_edit->sertif->Lookup->getParamTag($pegawai_edit, "p_x_sertif") ?>
<input type="hidden" data-table="pegawai" data-field="x_sertif" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $pegawai_edit->sertif->displayValueSeparatorAttribute() ?>" name="x_sertif" id="x_sertif" value="<?php echo $pegawai_edit->sertif->CurrentValue ?>"<?php echo $pegawai_edit->sertif->editAttributes() ?>>
</span>
<?php echo $pegawai_edit->sertif->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_edit->tambahan->Visible) { // tambahan ?>
	<div id="r_tambahan" class="form-group row">
		<label id="elh_pegawai_tambahan" for="x_tambahan" class="<?php echo $pegawai_edit->LeftColumnClass ?>"><?php echo $pegawai_edit->tambahan->caption() ?><?php echo $pegawai_edit->tambahan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pegawai_edit->RightColumnClass ?>"><div <?php echo $pegawai_edit->tambahan->cellAttributes() ?>>
<span id="el_pegawai_tambahan">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_tambahan"><?php echo EmptyValue(strval($pegawai_edit->tambahan->ViewValue)) ? $Language->phrase("PleaseSelect") : $pegawai_edit->tambahan->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($pegawai_edit->tambahan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($pegawai_edit->tambahan->ReadOnly || $pegawai_edit->tambahan->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_tambahan',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $pegawai_edit->tambahan->Lookup->getParamTag($pegawai_edit, "p_x_tambahan") ?>
<input type="hidden" data-table="pegawai" data-field="x_tambahan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $pegawai_edit->tambahan->displayValueSeparatorAttribute() ?>" name="x_tambahan" id="x_tambahan" value="<?php echo $pegawai_edit->tambahan->CurrentValue ?>"<?php echo $pegawai_edit->tambahan->editAttributes() ?>>
</span>
<?php echo $pegawai_edit->tambahan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_edit->lama_kerja->Visible) { // lama_kerja ?>
	<div id="r_lama_kerja" class="form-group row">
		<label id="elh_pegawai_lama_kerja" for="x_lama_kerja" class="<?php echo $pegawai_edit->LeftColumnClass ?>"><?php echo $pegawai_edit->lama_kerja->caption() ?><?php echo $pegawai_edit->lama_kerja->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pegawai_edit->RightColumnClass ?>"><div <?php echo $pegawai_edit->lama_kerja->cellAttributes() ?>>
<span id="el_pegawai_lama_kerja">
<input type="text" data-table="pegawai" data-field="x_lama_kerja" name="x_lama_kerja" id="x_lama_kerja" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($pegawai_edit->lama_kerja->getPlaceHolder()) ?>" value="<?php echo $pegawai_edit->lama_kerja->EditValue ?>"<?php echo $pegawai_edit->lama_kerja->editAttributes() ?>>
</span>
<?php echo $pegawai_edit->lama_kerja->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_edit->nama->Visible) { // nama ?>
	<div id="r_nama" class="form-group row">
		<label id="elh_pegawai_nama" for="x_nama" class="<?php echo $pegawai_edit->LeftColumnClass ?>"><?php echo $pegawai_edit->nama->caption() ?><?php echo $pegawai_edit->nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pegawai_edit->RightColumnClass ?>"><div <?php echo $pegawai_edit->nama->cellAttributes() ?>>
<span id="el_pegawai_nama">
<input type="text" data-table="pegawai" data-field="x_nama" name="x_nama" id="x_nama" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($pegawai_edit->nama->getPlaceHolder()) ?>" value="<?php echo $pegawai_edit->nama->EditValue ?>"<?php echo $pegawai_edit->nama->editAttributes() ?>>
</span>
<?php echo $pegawai_edit->nama->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_edit->alamat->Visible) { // alamat ?>
	<div id="r_alamat" class="form-group row">
		<label id="elh_pegawai_alamat" for="x_alamat" class="<?php echo $pegawai_edit->LeftColumnClass ?>"><?php echo $pegawai_edit->alamat->caption() ?><?php echo $pegawai_edit->alamat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pegawai_edit->RightColumnClass ?>"><div <?php echo $pegawai_edit->alamat->cellAttributes() ?>>
<span id="el_pegawai_alamat">
<input type="text" data-table="pegawai" data-field="x_alamat" name="x_alamat" id="x_alamat" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($pegawai_edit->alamat->getPlaceHolder()) ?>" value="<?php echo $pegawai_edit->alamat->EditValue ?>"<?php echo $pegawai_edit->alamat->editAttributes() ?>>
</span>
<?php echo $pegawai_edit->alamat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_edit->_email->Visible) { // email ?>
	<div id="r__email" class="form-group row">
		<label id="elh_pegawai__email" for="x__email" class="<?php echo $pegawai_edit->LeftColumnClass ?>"><?php echo $pegawai_edit->_email->caption() ?><?php echo $pegawai_edit->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pegawai_edit->RightColumnClass ?>"><div <?php echo $pegawai_edit->_email->cellAttributes() ?>>
<span id="el_pegawai__email">
<input type="text" data-table="pegawai" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($pegawai_edit->_email->getPlaceHolder()) ?>" value="<?php echo $pegawai_edit->_email->EditValue ?>"<?php echo $pegawai_edit->_email->editAttributes() ?>>
</span>
<?php echo $pegawai_edit->_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_edit->wa->Visible) { // wa ?>
	<div id="r_wa" class="form-group row">
		<label id="elh_pegawai_wa" for="x_wa" class="<?php echo $pegawai_edit->LeftColumnClass ?>"><?php echo $pegawai_edit->wa->caption() ?><?php echo $pegawai_edit->wa->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pegawai_edit->RightColumnClass ?>"><div <?php echo $pegawai_edit->wa->cellAttributes() ?>>
<span id="el_pegawai_wa">
<input type="text" data-table="pegawai" data-field="x_wa" name="x_wa" id="x_wa" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($pegawai_edit->wa->getPlaceHolder()) ?>" value="<?php echo $pegawai_edit->wa->EditValue ?>"<?php echo $pegawai_edit->wa->editAttributes() ?>>
</span>
<?php echo $pegawai_edit->wa->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_edit->hp->Visible) { // hp ?>
	<div id="r_hp" class="form-group row">
		<label id="elh_pegawai_hp" for="x_hp" class="<?php echo $pegawai_edit->LeftColumnClass ?>"><?php echo $pegawai_edit->hp->caption() ?><?php echo $pegawai_edit->hp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pegawai_edit->RightColumnClass ?>"><div <?php echo $pegawai_edit->hp->cellAttributes() ?>>
<span id="el_pegawai_hp">
<input type="text" data-table="pegawai" data-field="x_hp" name="x_hp" id="x_hp" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($pegawai_edit->hp->getPlaceHolder()) ?>" value="<?php echo $pegawai_edit->hp->EditValue ?>"<?php echo $pegawai_edit->hp->editAttributes() ?>>
</span>
<?php echo $pegawai_edit->hp->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_edit->tgllahir->Visible) { // tgllahir ?>
	<div id="r_tgllahir" class="form-group row">
		<label id="elh_pegawai_tgllahir" for="x_tgllahir" class="<?php echo $pegawai_edit->LeftColumnClass ?>"><?php echo $pegawai_edit->tgllahir->caption() ?><?php echo $pegawai_edit->tgllahir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pegawai_edit->RightColumnClass ?>"><div <?php echo $pegawai_edit->tgllahir->cellAttributes() ?>>
<span id="el_pegawai_tgllahir">
<input type="text" data-table="pegawai" data-field="x_tgllahir" name="x_tgllahir" id="x_tgllahir" maxlength="10" placeholder="<?php echo HtmlEncode($pegawai_edit->tgllahir->getPlaceHolder()) ?>" value="<?php echo $pegawai_edit->tgllahir->EditValue ?>"<?php echo $pegawai_edit->tgllahir->editAttributes() ?>>
<?php if (!$pegawai_edit->tgllahir->ReadOnly && !$pegawai_edit->tgllahir->Disabled && !isset($pegawai_edit->tgllahir->EditAttrs["readonly"]) && !isset($pegawai_edit->tgllahir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpegawaiedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fpegawaiedit", "x_tgllahir", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $pegawai_edit->tgllahir->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_edit->rekbank->Visible) { // rekbank ?>
	<div id="r_rekbank" class="form-group row">
		<label id="elh_pegawai_rekbank" for="x_rekbank" class="<?php echo $pegawai_edit->LeftColumnClass ?>"><?php echo $pegawai_edit->rekbank->caption() ?><?php echo $pegawai_edit->rekbank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pegawai_edit->RightColumnClass ?>"><div <?php echo $pegawai_edit->rekbank->cellAttributes() ?>>
<span id="el_pegawai_rekbank">
<input type="text" data-table="pegawai" data-field="x_rekbank" name="x_rekbank" id="x_rekbank" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($pegawai_edit->rekbank->getPlaceHolder()) ?>" value="<?php echo $pegawai_edit->rekbank->EditValue ?>"<?php echo $pegawai_edit->rekbank->editAttributes() ?>>
</span>
<?php echo $pegawai_edit->rekbank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_edit->pendidikan->Visible) { // pendidikan ?>
	<div id="r_pendidikan" class="form-group row">
		<label id="elh_pegawai_pendidikan" for="x_pendidikan" class="<?php echo $pegawai_edit->LeftColumnClass ?>"><?php echo $pegawai_edit->pendidikan->caption() ?><?php echo $pegawai_edit->pendidikan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pegawai_edit->RightColumnClass ?>"><div <?php echo $pegawai_edit->pendidikan->cellAttributes() ?>>
<span id="el_pegawai_pendidikan">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_pendidikan"><?php echo EmptyValue(strval($pegawai_edit->pendidikan->ViewValue)) ? $Language->phrase("PleaseSelect") : $pegawai_edit->pendidikan->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($pegawai_edit->pendidikan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($pegawai_edit->pendidikan->ReadOnly || $pegawai_edit->pendidikan->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_pendidikan',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $pegawai_edit->pendidikan->Lookup->getParamTag($pegawai_edit, "p_x_pendidikan") ?>
<input type="hidden" data-table="pegawai" data-field="x_pendidikan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $pegawai_edit->pendidikan->displayValueSeparatorAttribute() ?>" name="x_pendidikan" id="x_pendidikan" value="<?php echo $pegawai_edit->pendidikan->CurrentValue ?>"<?php echo $pegawai_edit->pendidikan->editAttributes() ?>>
</span>
<?php echo $pegawai_edit->pendidikan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_edit->jurusan->Visible) { // jurusan ?>
	<div id="r_jurusan" class="form-group row">
		<label id="elh_pegawai_jurusan" for="x_jurusan" class="<?php echo $pegawai_edit->LeftColumnClass ?>"><?php echo $pegawai_edit->jurusan->caption() ?><?php echo $pegawai_edit->jurusan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pegawai_edit->RightColumnClass ?>"><div <?php echo $pegawai_edit->jurusan->cellAttributes() ?>>
<span id="el_pegawai_jurusan">
<input type="text" data-table="pegawai" data-field="x_jurusan" name="x_jurusan" id="x_jurusan" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($pegawai_edit->jurusan->getPlaceHolder()) ?>" value="<?php echo $pegawai_edit->jurusan->EditValue ?>"<?php echo $pegawai_edit->jurusan->editAttributes() ?>>
</span>
<?php echo $pegawai_edit->jurusan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_edit->agama->Visible) { // agama ?>
	<div id="r_agama" class="form-group row">
		<label id="elh_pegawai_agama" for="x_agama" class="<?php echo $pegawai_edit->LeftColumnClass ?>"><?php echo $pegawai_edit->agama->caption() ?><?php echo $pegawai_edit->agama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pegawai_edit->RightColumnClass ?>"><div <?php echo $pegawai_edit->agama->cellAttributes() ?>>
<span id="el_pegawai_agama">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="pegawai" data-field="x_agama" data-value-separator="<?php echo $pegawai_edit->agama->displayValueSeparatorAttribute() ?>" id="x_agama" name="x_agama"<?php echo $pegawai_edit->agama->editAttributes() ?>>
			<?php echo $pegawai_edit->agama->selectOptionListHtml("x_agama") ?>
		</select>
</div>
<?php echo $pegawai_edit->agama->Lookup->getParamTag($pegawai_edit, "p_x_agama") ?>
</span>
<?php echo $pegawai_edit->agama->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_edit->jenkel->Visible) { // jenkel ?>
	<div id="r_jenkel" class="form-group row">
		<label id="elh_pegawai_jenkel" class="<?php echo $pegawai_edit->LeftColumnClass ?>"><?php echo $pegawai_edit->jenkel->caption() ?><?php echo $pegawai_edit->jenkel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pegawai_edit->RightColumnClass ?>"><div <?php echo $pegawai_edit->jenkel->cellAttributes() ?>>
<span id="el_pegawai_jenkel">
<div id="tp_x_jenkel" class="ew-template"><input type="radio" class="custom-control-input" data-table="pegawai" data-field="x_jenkel" data-value-separator="<?php echo $pegawai_edit->jenkel->displayValueSeparatorAttribute() ?>" name="x_jenkel" id="x_jenkel" value="{value}"<?php echo $pegawai_edit->jenkel->editAttributes() ?>></div>
<div id="dsl_x_jenkel" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $pegawai_edit->jenkel->radioButtonListHtml(FALSE, "x_jenkel") ?>
</div></div>
<?php echo $pegawai_edit->jenkel->Lookup->getParamTag($pegawai_edit, "p_x_jenkel") ?>
</span>
<?php echo $pegawai_edit->jenkel->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_edit->status->Visible) { // status ?>
	<div id="r_status" class="form-group row">
		<label id="elh_pegawai_status" for="x_status" class="<?php echo $pegawai_edit->LeftColumnClass ?>"><?php echo $pegawai_edit->status->caption() ?><?php echo $pegawai_edit->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pegawai_edit->RightColumnClass ?>"><div <?php echo $pegawai_edit->status->cellAttributes() ?>>
<span id="el_pegawai_status">
<input type="text" data-table="pegawai" data-field="x_status" name="x_status" id="x_status" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($pegawai_edit->status->getPlaceHolder()) ?>" value="<?php echo $pegawai_edit->status->EditValue ?>"<?php echo $pegawai_edit->status->editAttributes() ?>>
</span>
<?php echo $pegawai_edit->status->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_edit->foto->Visible) { // foto ?>
	<div id="r_foto" class="form-group row">
		<label id="elh_pegawai_foto" class="<?php echo $pegawai_edit->LeftColumnClass ?>"><?php echo $pegawai_edit->foto->caption() ?><?php echo $pegawai_edit->foto->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pegawai_edit->RightColumnClass ?>"><div <?php echo $pegawai_edit->foto->cellAttributes() ?>>
<span id="el_pegawai_foto">
<div id="fd_x_foto">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $pegawai_edit->foto->title() ?>" data-table="pegawai" data-field="x_foto" name="x_foto" id="x_foto" lang="<?php echo CurrentLanguageID() ?>"<?php echo $pegawai_edit->foto->editAttributes() ?><?php if ($pegawai_edit->foto->ReadOnly || $pegawai_edit->foto->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_foto"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_foto" id= "fn_x_foto" value="<?php echo $pegawai_edit->foto->Upload->FileName ?>">
<input type="hidden" name="fa_x_foto" id= "fa_x_foto" value="<?php echo (Post("fa_x_foto") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_foto" id= "fs_x_foto" value="255">
<input type="hidden" name="fx_x_foto" id= "fx_x_foto" value="<?php echo $pegawai_edit->foto->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_foto" id= "fm_x_foto" value="<?php echo $pegawai_edit->foto->UploadMaxFileSize ?>">
</div>
<table id="ft_x_foto" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $pegawai_edit->foto->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_edit->file_cv->Visible) { // file_cv ?>
	<div id="r_file_cv" class="form-group row">
		<label id="elh_pegawai_file_cv" class="<?php echo $pegawai_edit->LeftColumnClass ?>"><?php echo $pegawai_edit->file_cv->caption() ?><?php echo $pegawai_edit->file_cv->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pegawai_edit->RightColumnClass ?>"><div <?php echo $pegawai_edit->file_cv->cellAttributes() ?>>
<span id="el_pegawai_file_cv">
<div id="fd_x_file_cv">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $pegawai_edit->file_cv->title() ?>" data-table="pegawai" data-field="x_file_cv" name="x_file_cv" id="x_file_cv" lang="<?php echo CurrentLanguageID() ?>"<?php echo $pegawai_edit->file_cv->editAttributes() ?><?php if ($pegawai_edit->file_cv->ReadOnly || $pegawai_edit->file_cv->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_file_cv"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_file_cv" id= "fn_x_file_cv" value="<?php echo $pegawai_edit->file_cv->Upload->FileName ?>">
<input type="hidden" name="fa_x_file_cv" id= "fa_x_file_cv" value="<?php echo (Post("fa_x_file_cv") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_file_cv" id= "fs_x_file_cv" value="255">
<input type="hidden" name="fx_x_file_cv" id= "fx_x_file_cv" value="<?php echo $pegawai_edit->file_cv->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_file_cv" id= "fm_x_file_cv" value="<?php echo $pegawai_edit->file_cv->UploadMaxFileSize ?>">
</div>
<table id="ft_x_file_cv" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $pegawai_edit->file_cv->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_edit->mulai_bekerja->Visible) { // mulai_bekerja ?>
	<div id="r_mulai_bekerja" class="form-group row">
		<label id="elh_pegawai_mulai_bekerja" for="x_mulai_bekerja" class="<?php echo $pegawai_edit->LeftColumnClass ?>"><?php echo $pegawai_edit->mulai_bekerja->caption() ?><?php echo $pegawai_edit->mulai_bekerja->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pegawai_edit->RightColumnClass ?>"><div <?php echo $pegawai_edit->mulai_bekerja->cellAttributes() ?>>
<span id="el_pegawai_mulai_bekerja">
<input type="text" data-table="pegawai" data-field="x_mulai_bekerja" name="x_mulai_bekerja" id="x_mulai_bekerja" maxlength="10" placeholder="<?php echo HtmlEncode($pegawai_edit->mulai_bekerja->getPlaceHolder()) ?>" value="<?php echo $pegawai_edit->mulai_bekerja->EditValue ?>"<?php echo $pegawai_edit->mulai_bekerja->editAttributes() ?>>
<?php if (!$pegawai_edit->mulai_bekerja->ReadOnly && !$pegawai_edit->mulai_bekerja->Disabled && !isset($pegawai_edit->mulai_bekerja->EditAttrs["readonly"]) && !isset($pegawai_edit->mulai_bekerja->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpegawaiedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fpegawaiedit", "x_mulai_bekerja", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $pegawai_edit->mulai_bekerja->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_edit->keterangan->Visible) { // keterangan ?>
	<div id="r_keterangan" class="form-group row">
		<label id="elh_pegawai_keterangan" for="x_keterangan" class="<?php echo $pegawai_edit->LeftColumnClass ?>"><?php echo $pegawai_edit->keterangan->caption() ?><?php echo $pegawai_edit->keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pegawai_edit->RightColumnClass ?>"><div <?php echo $pegawai_edit->keterangan->cellAttributes() ?>>
<span id="el_pegawai_keterangan">
<input type="text" data-table="pegawai" data-field="x_keterangan" name="x_keterangan" id="x_keterangan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($pegawai_edit->keterangan->getPlaceHolder()) ?>" value="<?php echo $pegawai_edit->keterangan->EditValue ?>"<?php echo $pegawai_edit->keterangan->editAttributes() ?>>
</span>
<?php echo $pegawai_edit->keterangan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_edit->level->Visible) { // level ?>
	<div id="r_level" class="form-group row">
		<label id="elh_pegawai_level" for="x_level" class="<?php echo $pegawai_edit->LeftColumnClass ?>"><?php echo $pegawai_edit->level->caption() ?><?php echo $pegawai_edit->level->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pegawai_edit->RightColumnClass ?>"><div <?php echo $pegawai_edit->level->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<span id="el_pegawai_level">
<input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($pegawai_edit->level->EditValue)) ?>">
</span>
<?php } else { ?>
<span id="el_pegawai_level">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="pegawai" data-field="x_level" data-value-separator="<?php echo $pegawai_edit->level->displayValueSeparatorAttribute() ?>" id="x_level" name="x_level"<?php echo $pegawai_edit->level->editAttributes() ?>>
			<?php echo $pegawai_edit->level->selectOptionListHtml("x_level") ?>
		</select>
</div>
<?php echo $pegawai_edit->level->Lookup->getParamTag($pegawai_edit, "p_x_level") ?>
</span>
<?php } ?>
<?php echo $pegawai_edit->level->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_edit->aktif->Visible) { // aktif ?>
	<div id="r_aktif" class="form-group row">
		<label id="elh_pegawai_aktif" for="x_aktif" class="<?php echo $pegawai_edit->LeftColumnClass ?>"><?php echo $pegawai_edit->aktif->caption() ?><?php echo $pegawai_edit->aktif->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pegawai_edit->RightColumnClass ?>"><div <?php echo $pegawai_edit->aktif->cellAttributes() ?>>
<span id="el_pegawai_aktif">
<input type="text" data-table="pegawai" data-field="x_aktif" name="x_aktif" id="x_aktif" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($pegawai_edit->aktif->getPlaceHolder()) ?>" value="<?php echo $pegawai_edit->aktif->EditValue ?>"<?php echo $pegawai_edit->aktif->editAttributes() ?>>
</span>
<?php echo $pegawai_edit->aktif->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="pegawai" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($pegawai_edit->id->CurrentValue) ?>">
<?php
	if (in_array("peg_skill", explode(",", $pegawai->getCurrentDetailTable())) && $peg_skill->DetailEdit) {
?>
<?php if ($pegawai->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("peg_skill", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "peg_skillgrid.php" ?>
<?php } ?>
<?php
	if (in_array("peg_keluarga", explode(",", $pegawai->getCurrentDetailTable())) && $peg_keluarga->DetailEdit) {
?>
<?php if ($pegawai->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("peg_keluarga", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "peg_keluargagrid.php" ?>
<?php } ?>
<?php
	if (in_array("peg_dokumen", explode(",", $pegawai->getCurrentDetailTable())) && $peg_dokumen->DetailEdit) {
?>
<?php if ($pegawai->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("peg_dokumen", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "peg_dokumengrid.php" ?>
<?php } ?>
<?php if (!$pegawai_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $pegawai_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $pegawai_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$pegawai_edit->showPageFooter();
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
$pegawai_edit->terminate();
?>