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
$gajismp_detil_edit = new gajismp_detil_edit();

// Run the page
$gajismp_detil_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gajismp_detil_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fgajismp_detiledit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fgajismp_detiledit = currentForm = new ew.Form("fgajismp_detiledit", "edit");

	// Validate form
	fgajismp_detiledit.validate = function() {
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
			<?php if ($gajismp_detil_edit->pid->Required) { ?>
				elm = this.getElements("x" + infix + "_pid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajismp_detil_edit->pid->caption(), $gajismp_detil_edit->pid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pid");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajismp_detil_edit->pid->errorMessage()) ?>");
			<?php if ($gajismp_detil_edit->pegawai_id->Required) { ?>
				elm = this.getElements("x" + infix + "_pegawai_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajismp_detil_edit->pegawai_id->caption(), $gajismp_detil_edit->pegawai_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($gajismp_detil_edit->jabatan_id->Required) { ?>
				elm = this.getElements("x" + infix + "_jabatan_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajismp_detil_edit->jabatan_id->caption(), $gajismp_detil_edit->jabatan_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($gajismp_detil_edit->masakerja->Required) { ?>
				elm = this.getElements("x" + infix + "_masakerja");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajismp_detil_edit->masakerja->caption(), $gajismp_detil_edit->masakerja->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_masakerja");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajismp_detil_edit->masakerja->errorMessage()) ?>");
			<?php if ($gajismp_detil_edit->jumngajar->Required) { ?>
				elm = this.getElements("x" + infix + "_jumngajar");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajismp_detil_edit->jumngajar->caption(), $gajismp_detil_edit->jumngajar->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jumngajar");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajismp_detil_edit->jumngajar->errorMessage()) ?>");
			<?php if ($gajismp_detil_edit->ijin->Required) { ?>
				elm = this.getElements("x" + infix + "_ijin");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajismp_detil_edit->ijin->caption(), $gajismp_detil_edit->ijin->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ijin");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajismp_detil_edit->ijin->errorMessage()) ?>");
			<?php if ($gajismp_detil_edit->tunjangan_wkosis->Required) { ?>
				elm = this.getElements("x" + infix + "_tunjangan_wkosis");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajismp_detil_edit->tunjangan_wkosis->caption(), $gajismp_detil_edit->tunjangan_wkosis->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tunjangan_wkosis");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajismp_detil_edit->tunjangan_wkosis->errorMessage()) ?>");
			<?php if ($gajismp_detil_edit->nominal_baku->Required) { ?>
				elm = this.getElements("x" + infix + "_nominal_baku");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajismp_detil_edit->nominal_baku->caption(), $gajismp_detil_edit->nominal_baku->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_nominal_baku");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajismp_detil_edit->nominal_baku->errorMessage()) ?>");
			<?php if ($gajismp_detil_edit->baku->Required) { ?>
				elm = this.getElements("x" + infix + "_baku");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajismp_detil_edit->baku->caption(), $gajismp_detil_edit->baku->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_baku");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajismp_detil_edit->baku->errorMessage()) ?>");
			<?php if ($gajismp_detil_edit->kehadiran->Required) { ?>
				elm = this.getElements("x" + infix + "_kehadiran");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajismp_detil_edit->kehadiran->caption(), $gajismp_detil_edit->kehadiran->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_kehadiran");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajismp_detil_edit->kehadiran->errorMessage()) ?>");
			<?php if ($gajismp_detil_edit->prestasi->Required) { ?>
				elm = this.getElements("x" + infix + "_prestasi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajismp_detil_edit->prestasi->caption(), $gajismp_detil_edit->prestasi->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_prestasi");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajismp_detil_edit->prestasi->errorMessage()) ?>");
			<?php if ($gajismp_detil_edit->jumlahgaji->Required) { ?>
				elm = this.getElements("x" + infix + "_jumlahgaji");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajismp_detil_edit->jumlahgaji->caption(), $gajismp_detil_edit->jumlahgaji->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jumlahgaji");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajismp_detil_edit->jumlahgaji->errorMessage()) ?>");
			<?php if ($gajismp_detil_edit->jumgajitotal->Required) { ?>
				elm = this.getElements("x" + infix + "_jumgajitotal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajismp_detil_edit->jumgajitotal->caption(), $gajismp_detil_edit->jumgajitotal->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jumgajitotal");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajismp_detil_edit->jumgajitotal->errorMessage()) ?>");
			<?php if ($gajismp_detil_edit->potongan1->Required) { ?>
				elm = this.getElements("x" + infix + "_potongan1");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajismp_detil_edit->potongan1->caption(), $gajismp_detil_edit->potongan1->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_potongan1");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajismp_detil_edit->potongan1->errorMessage()) ?>");
			<?php if ($gajismp_detil_edit->potongan2->Required) { ?>
				elm = this.getElements("x" + infix + "_potongan2");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajismp_detil_edit->potongan2->caption(), $gajismp_detil_edit->potongan2->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_potongan2");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajismp_detil_edit->potongan2->errorMessage()) ?>");
			<?php if ($gajismp_detil_edit->jumlahterima->Required) { ?>
				elm = this.getElements("x" + infix + "_jumlahterima");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajismp_detil_edit->jumlahterima->caption(), $gajismp_detil_edit->jumlahterima->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jumlahterima");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajismp_detil_edit->jumlahterima->errorMessage()) ?>");

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
	fgajismp_detiledit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fgajismp_detiledit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fgajismp_detiledit.lists["x_pegawai_id"] = <?php echo $gajismp_detil_edit->pegawai_id->Lookup->toClientList($gajismp_detil_edit) ?>;
	fgajismp_detiledit.lists["x_pegawai_id"].options = <?php echo JsonEncode($gajismp_detil_edit->pegawai_id->lookupOptions()) ?>;
	fgajismp_detiledit.autoSuggests["x_pegawai_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fgajismp_detiledit.lists["x_jabatan_id"] = <?php echo $gajismp_detil_edit->jabatan_id->Lookup->toClientList($gajismp_detil_edit) ?>;
	fgajismp_detiledit.lists["x_jabatan_id"].options = <?php echo JsonEncode($gajismp_detil_edit->jabatan_id->lookupOptions()) ?>;
	loadjs.done("fgajismp_detiledit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $gajismp_detil_edit->showPageHeader(); ?>
<?php
$gajismp_detil_edit->showMessage();
?>
<form name="fgajismp_detiledit" id="fgajismp_detiledit" class="<?php echo $gajismp_detil_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gajismp_detil">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$gajismp_detil_edit->IsModal ?>">
<?php if ($gajismp_detil->getCurrentMasterTable() == "gajismp") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="gajismp">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($gajismp_detil_edit->pid->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($gajismp_detil_edit->pid->Visible) { // pid ?>
	<div id="r_pid" class="form-group row">
		<label id="elh_gajismp_detil_pid" for="x_pid" class="<?php echo $gajismp_detil_edit->LeftColumnClass ?>"><?php echo $gajismp_detil_edit->pid->caption() ?><?php echo $gajismp_detil_edit->pid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajismp_detil_edit->RightColumnClass ?>"><div <?php echo $gajismp_detil_edit->pid->cellAttributes() ?>>
<?php if ($gajismp_detil_edit->pid->getSessionValue() != "") { ?>
<span id="el_gajismp_detil_pid">
<span<?php echo $gajismp_detil_edit->pid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gajismp_detil_edit->pid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_pid" name="x_pid" value="<?php echo HtmlEncode($gajismp_detil_edit->pid->CurrentValue) ?>">
<?php } else { ?>
<span id="el_gajismp_detil_pid">
<input type="text" data-table="gajismp_detil" data-field="x_pid" name="x_pid" id="x_pid" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajismp_detil_edit->pid->getPlaceHolder()) ?>" value="<?php echo $gajismp_detil_edit->pid->EditValue ?>"<?php echo $gajismp_detil_edit->pid->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $gajismp_detil_edit->pid->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajismp_detil_edit->pegawai_id->Visible) { // pegawai_id ?>
	<div id="r_pegawai_id" class="form-group row">
		<label id="elh_gajismp_detil_pegawai_id" class="<?php echo $gajismp_detil_edit->LeftColumnClass ?>"><?php echo $gajismp_detil_edit->pegawai_id->caption() ?><?php echo $gajismp_detil_edit->pegawai_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajismp_detil_edit->RightColumnClass ?>"><div <?php echo $gajismp_detil_edit->pegawai_id->cellAttributes() ?>>
<span id="el_gajismp_detil_pegawai_id">
<?php
$onchange = $gajismp_detil_edit->pegawai_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$gajismp_detil_edit->pegawai_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_pegawai_id">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_pegawai_id" id="sv_x_pegawai_id" value="<?php echo RemoveHtml($gajismp_detil_edit->pegawai_id->EditValue) ?>" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($gajismp_detil_edit->pegawai_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($gajismp_detil_edit->pegawai_id->getPlaceHolder()) ?>"<?php echo $gajismp_detil_edit->pegawai_id->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($gajismp_detil_edit->pegawai_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_pegawai_id',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($gajismp_detil_edit->pegawai_id->ReadOnly || $gajismp_detil_edit->pegawai_id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="gajismp_detil" data-field="x_pegawai_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $gajismp_detil_edit->pegawai_id->displayValueSeparatorAttribute() ?>" name="x_pegawai_id" id="x_pegawai_id" value="<?php echo HtmlEncode($gajismp_detil_edit->pegawai_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fgajismp_detiledit"], function() {
	fgajismp_detiledit.createAutoSuggest({"id":"x_pegawai_id","forceSelect":false});
});
</script>
<?php echo $gajismp_detil_edit->pegawai_id->Lookup->getParamTag($gajismp_detil_edit, "p_x_pegawai_id") ?>
</span>
<?php echo $gajismp_detil_edit->pegawai_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajismp_detil_edit->jabatan_id->Visible) { // jabatan_id ?>
	<div id="r_jabatan_id" class="form-group row">
		<label id="elh_gajismp_detil_jabatan_id" for="x_jabatan_id" class="<?php echo $gajismp_detil_edit->LeftColumnClass ?>"><?php echo $gajismp_detil_edit->jabatan_id->caption() ?><?php echo $gajismp_detil_edit->jabatan_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajismp_detil_edit->RightColumnClass ?>"><div <?php echo $gajismp_detil_edit->jabatan_id->cellAttributes() ?>>
<span id="el_gajismp_detil_jabatan_id">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="gajismp_detil" data-field="x_jabatan_id" data-value-separator="<?php echo $gajismp_detil_edit->jabatan_id->displayValueSeparatorAttribute() ?>" id="x_jabatan_id" name="x_jabatan_id"<?php echo $gajismp_detil_edit->jabatan_id->editAttributes() ?>>
			<?php echo $gajismp_detil_edit->jabatan_id->selectOptionListHtml("x_jabatan_id") ?>
		</select>
</div>
<?php echo $gajismp_detil_edit->jabatan_id->Lookup->getParamTag($gajismp_detil_edit, "p_x_jabatan_id") ?>
</span>
<?php echo $gajismp_detil_edit->jabatan_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajismp_detil_edit->masakerja->Visible) { // masakerja ?>
	<div id="r_masakerja" class="form-group row">
		<label id="elh_gajismp_detil_masakerja" for="x_masakerja" class="<?php echo $gajismp_detil_edit->LeftColumnClass ?>"><?php echo $gajismp_detil_edit->masakerja->caption() ?><?php echo $gajismp_detil_edit->masakerja->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajismp_detil_edit->RightColumnClass ?>"><div <?php echo $gajismp_detil_edit->masakerja->cellAttributes() ?>>
<span id="el_gajismp_detil_masakerja">
<input type="text" data-table="gajismp_detil" data-field="x_masakerja" name="x_masakerja" id="x_masakerja" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($gajismp_detil_edit->masakerja->getPlaceHolder()) ?>" value="<?php echo $gajismp_detil_edit->masakerja->EditValue ?>"<?php echo $gajismp_detil_edit->masakerja->editAttributes() ?>>
</span>
<?php echo $gajismp_detil_edit->masakerja->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajismp_detil_edit->jumngajar->Visible) { // jumngajar ?>
	<div id="r_jumngajar" class="form-group row">
		<label id="elh_gajismp_detil_jumngajar" for="x_jumngajar" class="<?php echo $gajismp_detil_edit->LeftColumnClass ?>"><?php echo $gajismp_detil_edit->jumngajar->caption() ?><?php echo $gajismp_detil_edit->jumngajar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajismp_detil_edit->RightColumnClass ?>"><div <?php echo $gajismp_detil_edit->jumngajar->cellAttributes() ?>>
<span id="el_gajismp_detil_jumngajar">
<input type="text" data-table="gajismp_detil" data-field="x_jumngajar" name="x_jumngajar" id="x_jumngajar" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($gajismp_detil_edit->jumngajar->getPlaceHolder()) ?>" value="<?php echo $gajismp_detil_edit->jumngajar->EditValue ?>"<?php echo $gajismp_detil_edit->jumngajar->editAttributes() ?>>
</span>
<?php echo $gajismp_detil_edit->jumngajar->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajismp_detil_edit->ijin->Visible) { // ijin ?>
	<div id="r_ijin" class="form-group row">
		<label id="elh_gajismp_detil_ijin" for="x_ijin" class="<?php echo $gajismp_detil_edit->LeftColumnClass ?>"><?php echo $gajismp_detil_edit->ijin->caption() ?><?php echo $gajismp_detil_edit->ijin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajismp_detil_edit->RightColumnClass ?>"><div <?php echo $gajismp_detil_edit->ijin->cellAttributes() ?>>
<span id="el_gajismp_detil_ijin">
<input type="text" data-table="gajismp_detil" data-field="x_ijin" name="x_ijin" id="x_ijin" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($gajismp_detil_edit->ijin->getPlaceHolder()) ?>" value="<?php echo $gajismp_detil_edit->ijin->EditValue ?>"<?php echo $gajismp_detil_edit->ijin->editAttributes() ?>>
</span>
<?php echo $gajismp_detil_edit->ijin->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajismp_detil_edit->tunjangan_wkosis->Visible) { // tunjangan_wkosis ?>
	<div id="r_tunjangan_wkosis" class="form-group row">
		<label id="elh_gajismp_detil_tunjangan_wkosis" for="x_tunjangan_wkosis" class="<?php echo $gajismp_detil_edit->LeftColumnClass ?>"><?php echo $gajismp_detil_edit->tunjangan_wkosis->caption() ?><?php echo $gajismp_detil_edit->tunjangan_wkosis->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajismp_detil_edit->RightColumnClass ?>"><div <?php echo $gajismp_detil_edit->tunjangan_wkosis->cellAttributes() ?>>
<span id="el_gajismp_detil_tunjangan_wkosis">
<input type="text" data-table="gajismp_detil" data-field="x_tunjangan_wkosis" name="x_tunjangan_wkosis" id="x_tunjangan_wkosis" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajismp_detil_edit->tunjangan_wkosis->getPlaceHolder()) ?>" value="<?php echo $gajismp_detil_edit->tunjangan_wkosis->EditValue ?>"<?php echo $gajismp_detil_edit->tunjangan_wkosis->editAttributes() ?>>
</span>
<?php echo $gajismp_detil_edit->tunjangan_wkosis->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajismp_detil_edit->nominal_baku->Visible) { // nominal_baku ?>
	<div id="r_nominal_baku" class="form-group row">
		<label id="elh_gajismp_detil_nominal_baku" for="x_nominal_baku" class="<?php echo $gajismp_detil_edit->LeftColumnClass ?>"><?php echo $gajismp_detil_edit->nominal_baku->caption() ?><?php echo $gajismp_detil_edit->nominal_baku->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajismp_detil_edit->RightColumnClass ?>"><div <?php echo $gajismp_detil_edit->nominal_baku->cellAttributes() ?>>
<span id="el_gajismp_detil_nominal_baku">
<input type="text" data-table="gajismp_detil" data-field="x_nominal_baku" name="x_nominal_baku" id="x_nominal_baku" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajismp_detil_edit->nominal_baku->getPlaceHolder()) ?>" value="<?php echo $gajismp_detil_edit->nominal_baku->EditValue ?>"<?php echo $gajismp_detil_edit->nominal_baku->editAttributes() ?>>
</span>
<?php echo $gajismp_detil_edit->nominal_baku->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajismp_detil_edit->baku->Visible) { // baku ?>
	<div id="r_baku" class="form-group row">
		<label id="elh_gajismp_detil_baku" for="x_baku" class="<?php echo $gajismp_detil_edit->LeftColumnClass ?>"><?php echo $gajismp_detil_edit->baku->caption() ?><?php echo $gajismp_detil_edit->baku->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajismp_detil_edit->RightColumnClass ?>"><div <?php echo $gajismp_detil_edit->baku->cellAttributes() ?>>
<span id="el_gajismp_detil_baku">
<input type="text" data-table="gajismp_detil" data-field="x_baku" name="x_baku" id="x_baku" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajismp_detil_edit->baku->getPlaceHolder()) ?>" value="<?php echo $gajismp_detil_edit->baku->EditValue ?>"<?php echo $gajismp_detil_edit->baku->editAttributes() ?>>
</span>
<?php echo $gajismp_detil_edit->baku->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajismp_detil_edit->kehadiran->Visible) { // kehadiran ?>
	<div id="r_kehadiran" class="form-group row">
		<label id="elh_gajismp_detil_kehadiran" for="x_kehadiran" class="<?php echo $gajismp_detil_edit->LeftColumnClass ?>"><?php echo $gajismp_detil_edit->kehadiran->caption() ?><?php echo $gajismp_detil_edit->kehadiran->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajismp_detil_edit->RightColumnClass ?>"><div <?php echo $gajismp_detil_edit->kehadiran->cellAttributes() ?>>
<span id="el_gajismp_detil_kehadiran">
<input type="text" data-table="gajismp_detil" data-field="x_kehadiran" name="x_kehadiran" id="x_kehadiran" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajismp_detil_edit->kehadiran->getPlaceHolder()) ?>" value="<?php echo $gajismp_detil_edit->kehadiran->EditValue ?>"<?php echo $gajismp_detil_edit->kehadiran->editAttributes() ?>>
</span>
<?php echo $gajismp_detil_edit->kehadiran->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajismp_detil_edit->prestasi->Visible) { // prestasi ?>
	<div id="r_prestasi" class="form-group row">
		<label id="elh_gajismp_detil_prestasi" for="x_prestasi" class="<?php echo $gajismp_detil_edit->LeftColumnClass ?>"><?php echo $gajismp_detil_edit->prestasi->caption() ?><?php echo $gajismp_detil_edit->prestasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajismp_detil_edit->RightColumnClass ?>"><div <?php echo $gajismp_detil_edit->prestasi->cellAttributes() ?>>
<span id="el_gajismp_detil_prestasi">
<input type="text" data-table="gajismp_detil" data-field="x_prestasi" name="x_prestasi" id="x_prestasi" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajismp_detil_edit->prestasi->getPlaceHolder()) ?>" value="<?php echo $gajismp_detil_edit->prestasi->EditValue ?>"<?php echo $gajismp_detil_edit->prestasi->editAttributes() ?>>
</span>
<?php echo $gajismp_detil_edit->prestasi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajismp_detil_edit->jumlahgaji->Visible) { // jumlahgaji ?>
	<div id="r_jumlahgaji" class="form-group row">
		<label id="elh_gajismp_detil_jumlahgaji" for="x_jumlahgaji" class="<?php echo $gajismp_detil_edit->LeftColumnClass ?>"><?php echo $gajismp_detil_edit->jumlahgaji->caption() ?><?php echo $gajismp_detil_edit->jumlahgaji->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajismp_detil_edit->RightColumnClass ?>"><div <?php echo $gajismp_detil_edit->jumlahgaji->cellAttributes() ?>>
<span id="el_gajismp_detil_jumlahgaji">
<input type="text" data-table="gajismp_detil" data-field="x_jumlahgaji" name="x_jumlahgaji" id="x_jumlahgaji" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajismp_detil_edit->jumlahgaji->getPlaceHolder()) ?>" value="<?php echo $gajismp_detil_edit->jumlahgaji->EditValue ?>"<?php echo $gajismp_detil_edit->jumlahgaji->editAttributes() ?>>
</span>
<?php echo $gajismp_detil_edit->jumlahgaji->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajismp_detil_edit->jumgajitotal->Visible) { // jumgajitotal ?>
	<div id="r_jumgajitotal" class="form-group row">
		<label id="elh_gajismp_detil_jumgajitotal" for="x_jumgajitotal" class="<?php echo $gajismp_detil_edit->LeftColumnClass ?>"><?php echo $gajismp_detil_edit->jumgajitotal->caption() ?><?php echo $gajismp_detil_edit->jumgajitotal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajismp_detil_edit->RightColumnClass ?>"><div <?php echo $gajismp_detil_edit->jumgajitotal->cellAttributes() ?>>
<span id="el_gajismp_detil_jumgajitotal">
<input type="text" data-table="gajismp_detil" data-field="x_jumgajitotal" name="x_jumgajitotal" id="x_jumgajitotal" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajismp_detil_edit->jumgajitotal->getPlaceHolder()) ?>" value="<?php echo $gajismp_detil_edit->jumgajitotal->EditValue ?>"<?php echo $gajismp_detil_edit->jumgajitotal->editAttributes() ?>>
</span>
<?php echo $gajismp_detil_edit->jumgajitotal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajismp_detil_edit->potongan1->Visible) { // potongan1 ?>
	<div id="r_potongan1" class="form-group row">
		<label id="elh_gajismp_detil_potongan1" for="x_potongan1" class="<?php echo $gajismp_detil_edit->LeftColumnClass ?>"><?php echo $gajismp_detil_edit->potongan1->caption() ?><?php echo $gajismp_detil_edit->potongan1->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajismp_detil_edit->RightColumnClass ?>"><div <?php echo $gajismp_detil_edit->potongan1->cellAttributes() ?>>
<span id="el_gajismp_detil_potongan1">
<input type="text" data-table="gajismp_detil" data-field="x_potongan1" name="x_potongan1" id="x_potongan1" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajismp_detil_edit->potongan1->getPlaceHolder()) ?>" value="<?php echo $gajismp_detil_edit->potongan1->EditValue ?>"<?php echo $gajismp_detil_edit->potongan1->editAttributes() ?>>
</span>
<?php echo $gajismp_detil_edit->potongan1->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajismp_detil_edit->potongan2->Visible) { // potongan2 ?>
	<div id="r_potongan2" class="form-group row">
		<label id="elh_gajismp_detil_potongan2" for="x_potongan2" class="<?php echo $gajismp_detil_edit->LeftColumnClass ?>"><?php echo $gajismp_detil_edit->potongan2->caption() ?><?php echo $gajismp_detil_edit->potongan2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajismp_detil_edit->RightColumnClass ?>"><div <?php echo $gajismp_detil_edit->potongan2->cellAttributes() ?>>
<span id="el_gajismp_detil_potongan2">
<input type="text" data-table="gajismp_detil" data-field="x_potongan2" name="x_potongan2" id="x_potongan2" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajismp_detil_edit->potongan2->getPlaceHolder()) ?>" value="<?php echo $gajismp_detil_edit->potongan2->EditValue ?>"<?php echo $gajismp_detil_edit->potongan2->editAttributes() ?>>
</span>
<?php echo $gajismp_detil_edit->potongan2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajismp_detil_edit->jumlahterima->Visible) { // jumlahterima ?>
	<div id="r_jumlahterima" class="form-group row">
		<label id="elh_gajismp_detil_jumlahterima" for="x_jumlahterima" class="<?php echo $gajismp_detil_edit->LeftColumnClass ?>"><?php echo $gajismp_detil_edit->jumlahterima->caption() ?><?php echo $gajismp_detil_edit->jumlahterima->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajismp_detil_edit->RightColumnClass ?>"><div <?php echo $gajismp_detil_edit->jumlahterima->cellAttributes() ?>>
<span id="el_gajismp_detil_jumlahterima">
<input type="text" data-table="gajismp_detil" data-field="x_jumlahterima" name="x_jumlahterima" id="x_jumlahterima" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajismp_detil_edit->jumlahterima->getPlaceHolder()) ?>" value="<?php echo $gajismp_detil_edit->jumlahterima->EditValue ?>"<?php echo $gajismp_detil_edit->jumlahterima->editAttributes() ?>>
</span>
<?php echo $gajismp_detil_edit->jumlahterima->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="gajismp_detil" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($gajismp_detil_edit->id->CurrentValue) ?>">
<?php if (!$gajismp_detil_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $gajismp_detil_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $gajismp_detil_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$gajismp_detil_edit->showPageFooter();
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
$gajismp_detil_edit->terminate();
?>