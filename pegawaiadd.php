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
$pegawai_add = new pegawai_add();

// Run the page
$pegawai_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pegawai_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpegawaiadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fpegawaiadd = currentForm = new ew.Form("fpegawaiadd", "add");

	// Validate form
	fpegawaiadd.validate = function() {
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
			<?php if ($pegawai_add->pid->Required) { ?>
				elm = this.getElements("x" + infix + "_pid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pegawai_add->pid->caption(), $pegawai_add->pid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pid");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($pegawai_add->pid->errorMessage()) ?>");
			<?php if ($pegawai_add->nip->Required) { ?>
				elm = this.getElements("x" + infix + "_nip");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pegawai_add->nip->caption(), $pegawai_add->nip->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pegawai_add->username->Required) { ?>
				elm = this.getElements("x" + infix + "_username");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pegawai_add->username->caption(), $pegawai_add->username->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pegawai_add->password->Required) { ?>
				elm = this.getElements("x" + infix + "_password");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pegawai_add->password->caption(), $pegawai_add->password->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pegawai_add->jenjang_id->Required) { ?>
				elm = this.getElements("x" + infix + "_jenjang_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pegawai_add->jenjang_id->caption(), $pegawai_add->jenjang_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pegawai_add->jabatan->Required) { ?>
				elm = this.getElements("x" + infix + "_jabatan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pegawai_add->jabatan->caption(), $pegawai_add->jabatan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pegawai_add->periode_jabatan->Required) { ?>
				elm = this.getElements("x" + infix + "_periode_jabatan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pegawai_add->periode_jabatan->caption(), $pegawai_add->periode_jabatan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_periode_jabatan");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($pegawai_add->periode_jabatan->errorMessage()) ?>");
			<?php if ($pegawai_add->type->Required) { ?>
				elm = this.getElements("x" + infix + "_type");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pegawai_add->type->caption(), $pegawai_add->type->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_type");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($pegawai_add->type->errorMessage()) ?>");
			<?php if ($pegawai_add->sertif->Required) { ?>
				elm = this.getElements("x" + infix + "_sertif");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pegawai_add->sertif->caption(), $pegawai_add->sertif->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pegawai_add->tambahan->Required) { ?>
				elm = this.getElements("x" + infix + "_tambahan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pegawai_add->tambahan->caption(), $pegawai_add->tambahan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pegawai_add->lama_kerja->Required) { ?>
				elm = this.getElements("x" + infix + "_lama_kerja");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pegawai_add->lama_kerja->caption(), $pegawai_add->lama_kerja->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_lama_kerja");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($pegawai_add->lama_kerja->errorMessage()) ?>");
			<?php if ($pegawai_add->nama->Required) { ?>
				elm = this.getElements("x" + infix + "_nama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pegawai_add->nama->caption(), $pegawai_add->nama->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pegawai_add->alamat->Required) { ?>
				elm = this.getElements("x" + infix + "_alamat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pegawai_add->alamat->caption(), $pegawai_add->alamat->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pegawai_add->_email->Required) { ?>
				elm = this.getElements("x" + infix + "__email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pegawai_add->_email->caption(), $pegawai_add->_email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pegawai_add->wa->Required) { ?>
				elm = this.getElements("x" + infix + "_wa");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pegawai_add->wa->caption(), $pegawai_add->wa->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pegawai_add->hp->Required) { ?>
				elm = this.getElements("x" + infix + "_hp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pegawai_add->hp->caption(), $pegawai_add->hp->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pegawai_add->tgllahir->Required) { ?>
				elm = this.getElements("x" + infix + "_tgllahir");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pegawai_add->tgllahir->caption(), $pegawai_add->tgllahir->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgllahir");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($pegawai_add->tgllahir->errorMessage()) ?>");
			<?php if ($pegawai_add->rekbank->Required) { ?>
				elm = this.getElements("x" + infix + "_rekbank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pegawai_add->rekbank->caption(), $pegawai_add->rekbank->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pegawai_add->pendidikan->Required) { ?>
				elm = this.getElements("x" + infix + "_pendidikan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pegawai_add->pendidikan->caption(), $pegawai_add->pendidikan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pegawai_add->jurusan->Required) { ?>
				elm = this.getElements("x" + infix + "_jurusan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pegawai_add->jurusan->caption(), $pegawai_add->jurusan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pegawai_add->agama->Required) { ?>
				elm = this.getElements("x" + infix + "_agama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pegawai_add->agama->caption(), $pegawai_add->agama->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pegawai_add->jenkel->Required) { ?>
				elm = this.getElements("x" + infix + "_jenkel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pegawai_add->jenkel->caption(), $pegawai_add->jenkel->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pegawai_add->status->Required) { ?>
				elm = this.getElements("x" + infix + "_status");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pegawai_add->status->caption(), $pegawai_add->status->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pegawai_add->foto->Required) { ?>
				felm = this.getElements("x" + infix + "_foto");
				elm = this.getElements("fn_x" + infix + "_foto");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $pegawai_add->foto->caption(), $pegawai_add->foto->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pegawai_add->file_cv->Required) { ?>
				felm = this.getElements("x" + infix + "_file_cv");
				elm = this.getElements("fn_x" + infix + "_file_cv");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $pegawai_add->file_cv->caption(), $pegawai_add->file_cv->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pegawai_add->mulai_bekerja->Required) { ?>
				elm = this.getElements("x" + infix + "_mulai_bekerja");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pegawai_add->mulai_bekerja->caption(), $pegawai_add->mulai_bekerja->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_mulai_bekerja");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($pegawai_add->mulai_bekerja->errorMessage()) ?>");
			<?php if ($pegawai_add->keterangan->Required) { ?>
				elm = this.getElements("x" + infix + "_keterangan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pegawai_add->keterangan->caption(), $pegawai_add->keterangan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pegawai_add->level->Required) { ?>
				elm = this.getElements("x" + infix + "_level");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pegawai_add->level->caption(), $pegawai_add->level->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pegawai_add->aktif->Required) { ?>
				elm = this.getElements("x" + infix + "_aktif");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pegawai_add->aktif->caption(), $pegawai_add->aktif->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_aktif");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($pegawai_add->aktif->errorMessage()) ?>");

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
	fpegawaiadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpegawaiadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fpegawaiadd.lists["x_jenjang_id"] = <?php echo $pegawai_add->jenjang_id->Lookup->toClientList($pegawai_add) ?>;
	fpegawaiadd.lists["x_jenjang_id"].options = <?php echo JsonEncode($pegawai_add->jenjang_id->lookupOptions()) ?>;
	fpegawaiadd.lists["x_jabatan"] = <?php echo $pegawai_add->jabatan->Lookup->toClientList($pegawai_add) ?>;
	fpegawaiadd.lists["x_jabatan"].options = <?php echo JsonEncode($pegawai_add->jabatan->lookupOptions()) ?>;
	fpegawaiadd.lists["x_type"] = <?php echo $pegawai_add->type->Lookup->toClientList($pegawai_add) ?>;
	fpegawaiadd.lists["x_type"].options = <?php echo JsonEncode($pegawai_add->type->lookupOptions()) ?>;
	fpegawaiadd.autoSuggests["x_type"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fpegawaiadd.lists["x_sertif"] = <?php echo $pegawai_add->sertif->Lookup->toClientList($pegawai_add) ?>;
	fpegawaiadd.lists["x_sertif"].options = <?php echo JsonEncode($pegawai_add->sertif->lookupOptions()) ?>;
	fpegawaiadd.lists["x_tambahan"] = <?php echo $pegawai_add->tambahan->Lookup->toClientList($pegawai_add) ?>;
	fpegawaiadd.lists["x_tambahan"].options = <?php echo JsonEncode($pegawai_add->tambahan->lookupOptions()) ?>;
	fpegawaiadd.lists["x_pendidikan"] = <?php echo $pegawai_add->pendidikan->Lookup->toClientList($pegawai_add) ?>;
	fpegawaiadd.lists["x_pendidikan"].options = <?php echo JsonEncode($pegawai_add->pendidikan->lookupOptions()) ?>;
	fpegawaiadd.lists["x_agama"] = <?php echo $pegawai_add->agama->Lookup->toClientList($pegawai_add) ?>;
	fpegawaiadd.lists["x_agama"].options = <?php echo JsonEncode($pegawai_add->agama->lookupOptions()) ?>;
	fpegawaiadd.lists["x_jenkel"] = <?php echo $pegawai_add->jenkel->Lookup->toClientList($pegawai_add) ?>;
	fpegawaiadd.lists["x_jenkel"].options = <?php echo JsonEncode($pegawai_add->jenkel->lookupOptions()) ?>;
	fpegawaiadd.lists["x_level"] = <?php echo $pegawai_add->level->Lookup->toClientList($pegawai_add) ?>;
	fpegawaiadd.lists["x_level"].options = <?php echo JsonEncode($pegawai_add->level->lookupOptions()) ?>;
	loadjs.done("fpegawaiadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $pegawai_add->showPageHeader(); ?>
<?php
$pegawai_add->showMessage();
?>
<form name="fpegawaiadd" id="fpegawaiadd" class="<?php echo $pegawai_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pegawai">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$pegawai_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($pegawai_add->pid->Visible) { // pid ?>
	<div id="r_pid" class="form-group row">
		<label id="elh_pegawai_pid" for="x_pid" class="<?php echo $pegawai_add->LeftColumnClass ?>"><?php echo $pegawai_add->pid->caption() ?><?php echo $pegawai_add->pid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pegawai_add->RightColumnClass ?>"><div <?php echo $pegawai_add->pid->cellAttributes() ?>>
<span id="el_pegawai_pid">
<input type="text" data-table="pegawai" data-field="x_pid" name="x_pid" id="x_pid" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($pegawai_add->pid->getPlaceHolder()) ?>" value="<?php echo $pegawai_add->pid->EditValue ?>"<?php echo $pegawai_add->pid->editAttributes() ?>>
</span>
<?php echo $pegawai_add->pid->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_add->nip->Visible) { // nip ?>
	<div id="r_nip" class="form-group row">
		<label id="elh_pegawai_nip" for="x_nip" class="<?php echo $pegawai_add->LeftColumnClass ?>"><?php echo $pegawai_add->nip->caption() ?><?php echo $pegawai_add->nip->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pegawai_add->RightColumnClass ?>"><div <?php echo $pegawai_add->nip->cellAttributes() ?>>
<span id="el_pegawai_nip">
<input type="text" data-table="pegawai" data-field="x_nip" name="x_nip" id="x_nip" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($pegawai_add->nip->getPlaceHolder()) ?>" value="<?php echo $pegawai_add->nip->EditValue ?>"<?php echo $pegawai_add->nip->editAttributes() ?>>
</span>
<?php echo $pegawai_add->nip->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_add->username->Visible) { // username ?>
	<div id="r_username" class="form-group row">
		<label id="elh_pegawai_username" for="x_username" class="<?php echo $pegawai_add->LeftColumnClass ?>"><?php echo $pegawai_add->username->caption() ?><?php echo $pegawai_add->username->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pegawai_add->RightColumnClass ?>"><div <?php echo $pegawai_add->username->cellAttributes() ?>>
<span id="el_pegawai_username">
<input type="text" data-table="pegawai" data-field="x_username" name="x_username" id="x_username" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($pegawai_add->username->getPlaceHolder()) ?>" value="<?php echo $pegawai_add->username->EditValue ?>"<?php echo $pegawai_add->username->editAttributes() ?>>
</span>
<?php echo $pegawai_add->username->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_add->password->Visible) { // password ?>
	<div id="r_password" class="form-group row">
		<label id="elh_pegawai_password" for="x_password" class="<?php echo $pegawai_add->LeftColumnClass ?>"><?php echo $pegawai_add->password->caption() ?><?php echo $pegawai_add->password->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pegawai_add->RightColumnClass ?>"><div <?php echo $pegawai_add->password->cellAttributes() ?>>
<span id="el_pegawai_password">
<input type="text" data-table="pegawai" data-field="x_password" name="x_password" id="x_password" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($pegawai_add->password->getPlaceHolder()) ?>" value="<?php echo $pegawai_add->password->EditValue ?>"<?php echo $pegawai_add->password->editAttributes() ?>>
</span>
<?php echo $pegawai_add->password->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_add->jenjang_id->Visible) { // jenjang_id ?>
	<div id="r_jenjang_id" class="form-group row">
		<label id="elh_pegawai_jenjang_id" for="x_jenjang_id" class="<?php echo $pegawai_add->LeftColumnClass ?>"><?php echo $pegawai_add->jenjang_id->caption() ?><?php echo $pegawai_add->jenjang_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pegawai_add->RightColumnClass ?>"><div <?php echo $pegawai_add->jenjang_id->cellAttributes() ?>>
<span id="el_pegawai_jenjang_id">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_jenjang_id"><?php echo EmptyValue(strval($pegawai_add->jenjang_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $pegawai_add->jenjang_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($pegawai_add->jenjang_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($pegawai_add->jenjang_id->ReadOnly || $pegawai_add->jenjang_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_jenjang_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $pegawai_add->jenjang_id->Lookup->getParamTag($pegawai_add, "p_x_jenjang_id") ?>
<input type="hidden" data-table="pegawai" data-field="x_jenjang_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $pegawai_add->jenjang_id->displayValueSeparatorAttribute() ?>" name="x_jenjang_id" id="x_jenjang_id" value="<?php echo $pegawai_add->jenjang_id->CurrentValue ?>"<?php echo $pegawai_add->jenjang_id->editAttributes() ?>>
</span>
<?php echo $pegawai_add->jenjang_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_add->jabatan->Visible) { // jabatan ?>
	<div id="r_jabatan" class="form-group row">
		<label id="elh_pegawai_jabatan" for="x_jabatan" class="<?php echo $pegawai_add->LeftColumnClass ?>"><?php echo $pegawai_add->jabatan->caption() ?><?php echo $pegawai_add->jabatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pegawai_add->RightColumnClass ?>"><div <?php echo $pegawai_add->jabatan->cellAttributes() ?>>
<span id="el_pegawai_jabatan">
<?php $pegawai_add->jabatan->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_jabatan"><?php echo EmptyValue(strval($pegawai_add->jabatan->ViewValue)) ? $Language->phrase("PleaseSelect") : $pegawai_add->jabatan->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($pegawai_add->jabatan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($pegawai_add->jabatan->ReadOnly || $pegawai_add->jabatan->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_jabatan',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $pegawai_add->jabatan->Lookup->getParamTag($pegawai_add, "p_x_jabatan") ?>
<input type="hidden" data-table="pegawai" data-field="x_jabatan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $pegawai_add->jabatan->displayValueSeparatorAttribute() ?>" name="x_jabatan" id="x_jabatan" value="<?php echo $pegawai_add->jabatan->CurrentValue ?>"<?php echo $pegawai_add->jabatan->editAttributes() ?>>
</span>
<?php echo $pegawai_add->jabatan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_add->periode_jabatan->Visible) { // periode_jabatan ?>
	<div id="r_periode_jabatan" class="form-group row">
		<label id="elh_pegawai_periode_jabatan" for="x_periode_jabatan" class="<?php echo $pegawai_add->LeftColumnClass ?>"><?php echo $pegawai_add->periode_jabatan->caption() ?><?php echo $pegawai_add->periode_jabatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pegawai_add->RightColumnClass ?>"><div <?php echo $pegawai_add->periode_jabatan->cellAttributes() ?>>
<span id="el_pegawai_periode_jabatan">
<input type="text" data-table="pegawai" data-field="x_periode_jabatan" name="x_periode_jabatan" id="x_periode_jabatan" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($pegawai_add->periode_jabatan->getPlaceHolder()) ?>" value="<?php echo $pegawai_add->periode_jabatan->EditValue ?>"<?php echo $pegawai_add->periode_jabatan->editAttributes() ?>>
</span>
<?php echo $pegawai_add->periode_jabatan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_add->type->Visible) { // type ?>
	<div id="r_type" class="form-group row">
		<label id="elh_pegawai_type" class="<?php echo $pegawai_add->LeftColumnClass ?>"><?php echo $pegawai_add->type->caption() ?><?php echo $pegawai_add->type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pegawai_add->RightColumnClass ?>"><div <?php echo $pegawai_add->type->cellAttributes() ?>>
<span id="el_pegawai_type">
<?php
$onchange = $pegawai_add->type->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$pegawai_add->type->EditAttrs["onchange"] = "";
?>
<span id="as_x_type">
	<input type="text" class="form-control" name="sv_x_type" id="sv_x_type" value="<?php echo RemoveHtml($pegawai_add->type->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($pegawai_add->type->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($pegawai_add->type->getPlaceHolder()) ?>"<?php echo $pegawai_add->type->editAttributes() ?>>
</span>
<input type="hidden" data-table="pegawai" data-field="x_type" data-value-separator="<?php echo $pegawai_add->type->displayValueSeparatorAttribute() ?>" name="x_type" id="x_type" value="<?php echo HtmlEncode($pegawai_add->type->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fpegawaiadd"], function() {
	fpegawaiadd.createAutoSuggest({"id":"x_type","forceSelect":false});
});
</script>
<?php echo $pegawai_add->type->Lookup->getParamTag($pegawai_add, "p_x_type") ?>
</span>
<?php echo $pegawai_add->type->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_add->sertif->Visible) { // sertif ?>
	<div id="r_sertif" class="form-group row">
		<label id="elh_pegawai_sertif" for="x_sertif" class="<?php echo $pegawai_add->LeftColumnClass ?>"><?php echo $pegawai_add->sertif->caption() ?><?php echo $pegawai_add->sertif->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pegawai_add->RightColumnClass ?>"><div <?php echo $pegawai_add->sertif->cellAttributes() ?>>
<span id="el_pegawai_sertif">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_sertif"><?php echo EmptyValue(strval($pegawai_add->sertif->ViewValue)) ? $Language->phrase("PleaseSelect") : $pegawai_add->sertif->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($pegawai_add->sertif->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($pegawai_add->sertif->ReadOnly || $pegawai_add->sertif->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_sertif',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $pegawai_add->sertif->Lookup->getParamTag($pegawai_add, "p_x_sertif") ?>
<input type="hidden" data-table="pegawai" data-field="x_sertif" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $pegawai_add->sertif->displayValueSeparatorAttribute() ?>" name="x_sertif" id="x_sertif" value="<?php echo $pegawai_add->sertif->CurrentValue ?>"<?php echo $pegawai_add->sertif->editAttributes() ?>>
</span>
<?php echo $pegawai_add->sertif->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_add->tambahan->Visible) { // tambahan ?>
	<div id="r_tambahan" class="form-group row">
		<label id="elh_pegawai_tambahan" for="x_tambahan" class="<?php echo $pegawai_add->LeftColumnClass ?>"><?php echo $pegawai_add->tambahan->caption() ?><?php echo $pegawai_add->tambahan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pegawai_add->RightColumnClass ?>"><div <?php echo $pegawai_add->tambahan->cellAttributes() ?>>
<span id="el_pegawai_tambahan">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_tambahan"><?php echo EmptyValue(strval($pegawai_add->tambahan->ViewValue)) ? $Language->phrase("PleaseSelect") : $pegawai_add->tambahan->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($pegawai_add->tambahan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($pegawai_add->tambahan->ReadOnly || $pegawai_add->tambahan->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_tambahan',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $pegawai_add->tambahan->Lookup->getParamTag($pegawai_add, "p_x_tambahan") ?>
<input type="hidden" data-table="pegawai" data-field="x_tambahan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $pegawai_add->tambahan->displayValueSeparatorAttribute() ?>" name="x_tambahan" id="x_tambahan" value="<?php echo $pegawai_add->tambahan->CurrentValue ?>"<?php echo $pegawai_add->tambahan->editAttributes() ?>>
</span>
<?php echo $pegawai_add->tambahan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_add->lama_kerja->Visible) { // lama_kerja ?>
	<div id="r_lama_kerja" class="form-group row">
		<label id="elh_pegawai_lama_kerja" for="x_lama_kerja" class="<?php echo $pegawai_add->LeftColumnClass ?>"><?php echo $pegawai_add->lama_kerja->caption() ?><?php echo $pegawai_add->lama_kerja->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pegawai_add->RightColumnClass ?>"><div <?php echo $pegawai_add->lama_kerja->cellAttributes() ?>>
<span id="el_pegawai_lama_kerja">
<input type="text" data-table="pegawai" data-field="x_lama_kerja" name="x_lama_kerja" id="x_lama_kerja" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($pegawai_add->lama_kerja->getPlaceHolder()) ?>" value="<?php echo $pegawai_add->lama_kerja->EditValue ?>"<?php echo $pegawai_add->lama_kerja->editAttributes() ?>>
</span>
<?php echo $pegawai_add->lama_kerja->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_add->nama->Visible) { // nama ?>
	<div id="r_nama" class="form-group row">
		<label id="elh_pegawai_nama" for="x_nama" class="<?php echo $pegawai_add->LeftColumnClass ?>"><?php echo $pegawai_add->nama->caption() ?><?php echo $pegawai_add->nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pegawai_add->RightColumnClass ?>"><div <?php echo $pegawai_add->nama->cellAttributes() ?>>
<span id="el_pegawai_nama">
<input type="text" data-table="pegawai" data-field="x_nama" name="x_nama" id="x_nama" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($pegawai_add->nama->getPlaceHolder()) ?>" value="<?php echo $pegawai_add->nama->EditValue ?>"<?php echo $pegawai_add->nama->editAttributes() ?>>
</span>
<?php echo $pegawai_add->nama->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_add->alamat->Visible) { // alamat ?>
	<div id="r_alamat" class="form-group row">
		<label id="elh_pegawai_alamat" for="x_alamat" class="<?php echo $pegawai_add->LeftColumnClass ?>"><?php echo $pegawai_add->alamat->caption() ?><?php echo $pegawai_add->alamat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pegawai_add->RightColumnClass ?>"><div <?php echo $pegawai_add->alamat->cellAttributes() ?>>
<span id="el_pegawai_alamat">
<input type="text" data-table="pegawai" data-field="x_alamat" name="x_alamat" id="x_alamat" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($pegawai_add->alamat->getPlaceHolder()) ?>" value="<?php echo $pegawai_add->alamat->EditValue ?>"<?php echo $pegawai_add->alamat->editAttributes() ?>>
</span>
<?php echo $pegawai_add->alamat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_add->_email->Visible) { // email ?>
	<div id="r__email" class="form-group row">
		<label id="elh_pegawai__email" for="x__email" class="<?php echo $pegawai_add->LeftColumnClass ?>"><?php echo $pegawai_add->_email->caption() ?><?php echo $pegawai_add->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pegawai_add->RightColumnClass ?>"><div <?php echo $pegawai_add->_email->cellAttributes() ?>>
<span id="el_pegawai__email">
<input type="text" data-table="pegawai" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($pegawai_add->_email->getPlaceHolder()) ?>" value="<?php echo $pegawai_add->_email->EditValue ?>"<?php echo $pegawai_add->_email->editAttributes() ?>>
</span>
<?php echo $pegawai_add->_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_add->wa->Visible) { // wa ?>
	<div id="r_wa" class="form-group row">
		<label id="elh_pegawai_wa" for="x_wa" class="<?php echo $pegawai_add->LeftColumnClass ?>"><?php echo $pegawai_add->wa->caption() ?><?php echo $pegawai_add->wa->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pegawai_add->RightColumnClass ?>"><div <?php echo $pegawai_add->wa->cellAttributes() ?>>
<span id="el_pegawai_wa">
<input type="text" data-table="pegawai" data-field="x_wa" name="x_wa" id="x_wa" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($pegawai_add->wa->getPlaceHolder()) ?>" value="<?php echo $pegawai_add->wa->EditValue ?>"<?php echo $pegawai_add->wa->editAttributes() ?>>
</span>
<?php echo $pegawai_add->wa->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_add->hp->Visible) { // hp ?>
	<div id="r_hp" class="form-group row">
		<label id="elh_pegawai_hp" for="x_hp" class="<?php echo $pegawai_add->LeftColumnClass ?>"><?php echo $pegawai_add->hp->caption() ?><?php echo $pegawai_add->hp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pegawai_add->RightColumnClass ?>"><div <?php echo $pegawai_add->hp->cellAttributes() ?>>
<span id="el_pegawai_hp">
<input type="text" data-table="pegawai" data-field="x_hp" name="x_hp" id="x_hp" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($pegawai_add->hp->getPlaceHolder()) ?>" value="<?php echo $pegawai_add->hp->EditValue ?>"<?php echo $pegawai_add->hp->editAttributes() ?>>
</span>
<?php echo $pegawai_add->hp->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_add->tgllahir->Visible) { // tgllahir ?>
	<div id="r_tgllahir" class="form-group row">
		<label id="elh_pegawai_tgllahir" for="x_tgllahir" class="<?php echo $pegawai_add->LeftColumnClass ?>"><?php echo $pegawai_add->tgllahir->caption() ?><?php echo $pegawai_add->tgllahir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pegawai_add->RightColumnClass ?>"><div <?php echo $pegawai_add->tgllahir->cellAttributes() ?>>
<span id="el_pegawai_tgllahir">
<input type="text" data-table="pegawai" data-field="x_tgllahir" name="x_tgllahir" id="x_tgllahir" maxlength="10" placeholder="<?php echo HtmlEncode($pegawai_add->tgllahir->getPlaceHolder()) ?>" value="<?php echo $pegawai_add->tgllahir->EditValue ?>"<?php echo $pegawai_add->tgllahir->editAttributes() ?>>
<?php if (!$pegawai_add->tgllahir->ReadOnly && !$pegawai_add->tgllahir->Disabled && !isset($pegawai_add->tgllahir->EditAttrs["readonly"]) && !isset($pegawai_add->tgllahir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpegawaiadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fpegawaiadd", "x_tgllahir", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $pegawai_add->tgllahir->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_add->rekbank->Visible) { // rekbank ?>
	<div id="r_rekbank" class="form-group row">
		<label id="elh_pegawai_rekbank" for="x_rekbank" class="<?php echo $pegawai_add->LeftColumnClass ?>"><?php echo $pegawai_add->rekbank->caption() ?><?php echo $pegawai_add->rekbank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pegawai_add->RightColumnClass ?>"><div <?php echo $pegawai_add->rekbank->cellAttributes() ?>>
<span id="el_pegawai_rekbank">
<input type="text" data-table="pegawai" data-field="x_rekbank" name="x_rekbank" id="x_rekbank" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($pegawai_add->rekbank->getPlaceHolder()) ?>" value="<?php echo $pegawai_add->rekbank->EditValue ?>"<?php echo $pegawai_add->rekbank->editAttributes() ?>>
</span>
<?php echo $pegawai_add->rekbank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_add->pendidikan->Visible) { // pendidikan ?>
	<div id="r_pendidikan" class="form-group row">
		<label id="elh_pegawai_pendidikan" for="x_pendidikan" class="<?php echo $pegawai_add->LeftColumnClass ?>"><?php echo $pegawai_add->pendidikan->caption() ?><?php echo $pegawai_add->pendidikan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pegawai_add->RightColumnClass ?>"><div <?php echo $pegawai_add->pendidikan->cellAttributes() ?>>
<span id="el_pegawai_pendidikan">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_pendidikan"><?php echo EmptyValue(strval($pegawai_add->pendidikan->ViewValue)) ? $Language->phrase("PleaseSelect") : $pegawai_add->pendidikan->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($pegawai_add->pendidikan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($pegawai_add->pendidikan->ReadOnly || $pegawai_add->pendidikan->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_pendidikan',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $pegawai_add->pendidikan->Lookup->getParamTag($pegawai_add, "p_x_pendidikan") ?>
<input type="hidden" data-table="pegawai" data-field="x_pendidikan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $pegawai_add->pendidikan->displayValueSeparatorAttribute() ?>" name="x_pendidikan" id="x_pendidikan" value="<?php echo $pegawai_add->pendidikan->CurrentValue ?>"<?php echo $pegawai_add->pendidikan->editAttributes() ?>>
</span>
<?php echo $pegawai_add->pendidikan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_add->jurusan->Visible) { // jurusan ?>
	<div id="r_jurusan" class="form-group row">
		<label id="elh_pegawai_jurusan" for="x_jurusan" class="<?php echo $pegawai_add->LeftColumnClass ?>"><?php echo $pegawai_add->jurusan->caption() ?><?php echo $pegawai_add->jurusan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pegawai_add->RightColumnClass ?>"><div <?php echo $pegawai_add->jurusan->cellAttributes() ?>>
<span id="el_pegawai_jurusan">
<input type="text" data-table="pegawai" data-field="x_jurusan" name="x_jurusan" id="x_jurusan" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($pegawai_add->jurusan->getPlaceHolder()) ?>" value="<?php echo $pegawai_add->jurusan->EditValue ?>"<?php echo $pegawai_add->jurusan->editAttributes() ?>>
</span>
<?php echo $pegawai_add->jurusan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_add->agama->Visible) { // agama ?>
	<div id="r_agama" class="form-group row">
		<label id="elh_pegawai_agama" for="x_agama" class="<?php echo $pegawai_add->LeftColumnClass ?>"><?php echo $pegawai_add->agama->caption() ?><?php echo $pegawai_add->agama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pegawai_add->RightColumnClass ?>"><div <?php echo $pegawai_add->agama->cellAttributes() ?>>
<span id="el_pegawai_agama">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="pegawai" data-field="x_agama" data-value-separator="<?php echo $pegawai_add->agama->displayValueSeparatorAttribute() ?>" id="x_agama" name="x_agama"<?php echo $pegawai_add->agama->editAttributes() ?>>
			<?php echo $pegawai_add->agama->selectOptionListHtml("x_agama") ?>
		</select>
</div>
<?php echo $pegawai_add->agama->Lookup->getParamTag($pegawai_add, "p_x_agama") ?>
</span>
<?php echo $pegawai_add->agama->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_add->jenkel->Visible) { // jenkel ?>
	<div id="r_jenkel" class="form-group row">
		<label id="elh_pegawai_jenkel" class="<?php echo $pegawai_add->LeftColumnClass ?>"><?php echo $pegawai_add->jenkel->caption() ?><?php echo $pegawai_add->jenkel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pegawai_add->RightColumnClass ?>"><div <?php echo $pegawai_add->jenkel->cellAttributes() ?>>
<span id="el_pegawai_jenkel">
<div id="tp_x_jenkel" class="ew-template"><input type="radio" class="custom-control-input" data-table="pegawai" data-field="x_jenkel" data-value-separator="<?php echo $pegawai_add->jenkel->displayValueSeparatorAttribute() ?>" name="x_jenkel" id="x_jenkel" value="{value}"<?php echo $pegawai_add->jenkel->editAttributes() ?>></div>
<div id="dsl_x_jenkel" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $pegawai_add->jenkel->radioButtonListHtml(FALSE, "x_jenkel") ?>
</div></div>
<?php echo $pegawai_add->jenkel->Lookup->getParamTag($pegawai_add, "p_x_jenkel") ?>
</span>
<?php echo $pegawai_add->jenkel->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_add->status->Visible) { // status ?>
	<div id="r_status" class="form-group row">
		<label id="elh_pegawai_status" for="x_status" class="<?php echo $pegawai_add->LeftColumnClass ?>"><?php echo $pegawai_add->status->caption() ?><?php echo $pegawai_add->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pegawai_add->RightColumnClass ?>"><div <?php echo $pegawai_add->status->cellAttributes() ?>>
<span id="el_pegawai_status">
<input type="text" data-table="pegawai" data-field="x_status" name="x_status" id="x_status" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($pegawai_add->status->getPlaceHolder()) ?>" value="<?php echo $pegawai_add->status->EditValue ?>"<?php echo $pegawai_add->status->editAttributes() ?>>
</span>
<?php echo $pegawai_add->status->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_add->foto->Visible) { // foto ?>
	<div id="r_foto" class="form-group row">
		<label id="elh_pegawai_foto" class="<?php echo $pegawai_add->LeftColumnClass ?>"><?php echo $pegawai_add->foto->caption() ?><?php echo $pegawai_add->foto->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pegawai_add->RightColumnClass ?>"><div <?php echo $pegawai_add->foto->cellAttributes() ?>>
<span id="el_pegawai_foto">
<div id="fd_x_foto">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $pegawai_add->foto->title() ?>" data-table="pegawai" data-field="x_foto" name="x_foto" id="x_foto" lang="<?php echo CurrentLanguageID() ?>"<?php echo $pegawai_add->foto->editAttributes() ?><?php if ($pegawai_add->foto->ReadOnly || $pegawai_add->foto->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_foto"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_foto" id= "fn_x_foto" value="<?php echo $pegawai_add->foto->Upload->FileName ?>">
<input type="hidden" name="fa_x_foto" id= "fa_x_foto" value="0">
<input type="hidden" name="fs_x_foto" id= "fs_x_foto" value="255">
<input type="hidden" name="fx_x_foto" id= "fx_x_foto" value="<?php echo $pegawai_add->foto->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_foto" id= "fm_x_foto" value="<?php echo $pegawai_add->foto->UploadMaxFileSize ?>">
</div>
<table id="ft_x_foto" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $pegawai_add->foto->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_add->file_cv->Visible) { // file_cv ?>
	<div id="r_file_cv" class="form-group row">
		<label id="elh_pegawai_file_cv" class="<?php echo $pegawai_add->LeftColumnClass ?>"><?php echo $pegawai_add->file_cv->caption() ?><?php echo $pegawai_add->file_cv->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pegawai_add->RightColumnClass ?>"><div <?php echo $pegawai_add->file_cv->cellAttributes() ?>>
<span id="el_pegawai_file_cv">
<div id="fd_x_file_cv">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $pegawai_add->file_cv->title() ?>" data-table="pegawai" data-field="x_file_cv" name="x_file_cv" id="x_file_cv" lang="<?php echo CurrentLanguageID() ?>"<?php echo $pegawai_add->file_cv->editAttributes() ?><?php if ($pegawai_add->file_cv->ReadOnly || $pegawai_add->file_cv->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_file_cv"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_file_cv" id= "fn_x_file_cv" value="<?php echo $pegawai_add->file_cv->Upload->FileName ?>">
<input type="hidden" name="fa_x_file_cv" id= "fa_x_file_cv" value="0">
<input type="hidden" name="fs_x_file_cv" id= "fs_x_file_cv" value="255">
<input type="hidden" name="fx_x_file_cv" id= "fx_x_file_cv" value="<?php echo $pegawai_add->file_cv->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_file_cv" id= "fm_x_file_cv" value="<?php echo $pegawai_add->file_cv->UploadMaxFileSize ?>">
</div>
<table id="ft_x_file_cv" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $pegawai_add->file_cv->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_add->mulai_bekerja->Visible) { // mulai_bekerja ?>
	<div id="r_mulai_bekerja" class="form-group row">
		<label id="elh_pegawai_mulai_bekerja" for="x_mulai_bekerja" class="<?php echo $pegawai_add->LeftColumnClass ?>"><?php echo $pegawai_add->mulai_bekerja->caption() ?><?php echo $pegawai_add->mulai_bekerja->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pegawai_add->RightColumnClass ?>"><div <?php echo $pegawai_add->mulai_bekerja->cellAttributes() ?>>
<span id="el_pegawai_mulai_bekerja">
<input type="text" data-table="pegawai" data-field="x_mulai_bekerja" name="x_mulai_bekerja" id="x_mulai_bekerja" maxlength="10" placeholder="<?php echo HtmlEncode($pegawai_add->mulai_bekerja->getPlaceHolder()) ?>" value="<?php echo $pegawai_add->mulai_bekerja->EditValue ?>"<?php echo $pegawai_add->mulai_bekerja->editAttributes() ?>>
<?php if (!$pegawai_add->mulai_bekerja->ReadOnly && !$pegawai_add->mulai_bekerja->Disabled && !isset($pegawai_add->mulai_bekerja->EditAttrs["readonly"]) && !isset($pegawai_add->mulai_bekerja->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpegawaiadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fpegawaiadd", "x_mulai_bekerja", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $pegawai_add->mulai_bekerja->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_add->keterangan->Visible) { // keterangan ?>
	<div id="r_keterangan" class="form-group row">
		<label id="elh_pegawai_keterangan" for="x_keterangan" class="<?php echo $pegawai_add->LeftColumnClass ?>"><?php echo $pegawai_add->keterangan->caption() ?><?php echo $pegawai_add->keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pegawai_add->RightColumnClass ?>"><div <?php echo $pegawai_add->keterangan->cellAttributes() ?>>
<span id="el_pegawai_keterangan">
<input type="text" data-table="pegawai" data-field="x_keterangan" name="x_keterangan" id="x_keterangan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($pegawai_add->keterangan->getPlaceHolder()) ?>" value="<?php echo $pegawai_add->keterangan->EditValue ?>"<?php echo $pegawai_add->keterangan->editAttributes() ?>>
</span>
<?php echo $pegawai_add->keterangan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_add->level->Visible) { // level ?>
	<div id="r_level" class="form-group row">
		<label id="elh_pegawai_level" for="x_level" class="<?php echo $pegawai_add->LeftColumnClass ?>"><?php echo $pegawai_add->level->caption() ?><?php echo $pegawai_add->level->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pegawai_add->RightColumnClass ?>"><div <?php echo $pegawai_add->level->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<span id="el_pegawai_level">
<input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($pegawai_add->level->EditValue)) ?>">
</span>
<?php } else { ?>
<span id="el_pegawai_level">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="pegawai" data-field="x_level" data-value-separator="<?php echo $pegawai_add->level->displayValueSeparatorAttribute() ?>" id="x_level" name="x_level"<?php echo $pegawai_add->level->editAttributes() ?>>
			<?php echo $pegawai_add->level->selectOptionListHtml("x_level") ?>
		</select>
</div>
<?php echo $pegawai_add->level->Lookup->getParamTag($pegawai_add, "p_x_level") ?>
</span>
<?php } ?>
<?php echo $pegawai_add->level->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_add->aktif->Visible) { // aktif ?>
	<div id="r_aktif" class="form-group row">
		<label id="elh_pegawai_aktif" for="x_aktif" class="<?php echo $pegawai_add->LeftColumnClass ?>"><?php echo $pegawai_add->aktif->caption() ?><?php echo $pegawai_add->aktif->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pegawai_add->RightColumnClass ?>"><div <?php echo $pegawai_add->aktif->cellAttributes() ?>>
<span id="el_pegawai_aktif">
<input type="text" data-table="pegawai" data-field="x_aktif" name="x_aktif" id="x_aktif" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($pegawai_add->aktif->getPlaceHolder()) ?>" value="<?php echo $pegawai_add->aktif->EditValue ?>"<?php echo $pegawai_add->aktif->editAttributes() ?>>
</span>
<?php echo $pegawai_add->aktif->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("peg_skill", explode(",", $pegawai->getCurrentDetailTable())) && $peg_skill->DetailAdd) {
?>
<?php if ($pegawai->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("peg_skill", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "peg_skillgrid.php" ?>
<?php } ?>
<?php
	if (in_array("peg_keluarga", explode(",", $pegawai->getCurrentDetailTable())) && $peg_keluarga->DetailAdd) {
?>
<?php if ($pegawai->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("peg_keluarga", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "peg_keluargagrid.php" ?>
<?php } ?>
<?php
	if (in_array("peg_dokumen", explode(",", $pegawai->getCurrentDetailTable())) && $peg_dokumen->DetailAdd) {
?>
<?php if ($pegawai->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("peg_dokumen", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "peg_dokumengrid.php" ?>
<?php } ?>
<?php if (!$pegawai_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $pegawai_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $pegawai_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$pegawai_add->showPageFooter();
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
$pegawai_add->terminate();
?>