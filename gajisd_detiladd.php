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
$gajisd_detil_add = new gajisd_detil_add();

// Run the page
$gajisd_detil_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gajisd_detil_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fgajisd_detiladd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fgajisd_detiladd = currentForm = new ew.Form("fgajisd_detiladd", "add");

	// Validate form
	fgajisd_detiladd.validate = function() {
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
			<?php if ($gajisd_detil_add->pid->Required) { ?>
				elm = this.getElements("x" + infix + "_pid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajisd_detil_add->pid->caption(), $gajisd_detil_add->pid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pid");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajisd_detil_add->pid->errorMessage()) ?>");
			<?php if ($gajisd_detil_add->pegawai_id->Required) { ?>
				elm = this.getElements("x" + infix + "_pegawai_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajisd_detil_add->pegawai_id->caption(), $gajisd_detil_add->pegawai_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($gajisd_detil_add->jabatan_id->Required) { ?>
				elm = this.getElements("x" + infix + "_jabatan_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajisd_detil_add->jabatan_id->caption(), $gajisd_detil_add->jabatan_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jabatan_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajisd_detil_add->jabatan_id->errorMessage()) ?>");
			<?php if ($gajisd_detil_add->masakerja->Required) { ?>
				elm = this.getElements("x" + infix + "_masakerja");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajisd_detil_add->masakerja->caption(), $gajisd_detil_add->masakerja->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_masakerja");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajisd_detil_add->masakerja->errorMessage()) ?>");
			<?php if ($gajisd_detil_add->jumngajar->Required) { ?>
				elm = this.getElements("x" + infix + "_jumngajar");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajisd_detil_add->jumngajar->caption(), $gajisd_detil_add->jumngajar->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jumngajar");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajisd_detil_add->jumngajar->errorMessage()) ?>");
			<?php if ($gajisd_detil_add->ijin->Required) { ?>
				elm = this.getElements("x" + infix + "_ijin");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajisd_detil_add->ijin->caption(), $gajisd_detil_add->ijin->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ijin");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajisd_detil_add->ijin->errorMessage()) ?>");
			<?php if ($gajisd_detil_add->tunjangan_wkosis->Required) { ?>
				elm = this.getElements("x" + infix + "_tunjangan_wkosis");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajisd_detil_add->tunjangan_wkosis->caption(), $gajisd_detil_add->tunjangan_wkosis->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tunjangan_wkosis");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajisd_detil_add->tunjangan_wkosis->errorMessage()) ?>");
			<?php if ($gajisd_detil_add->nominal_baku->Required) { ?>
				elm = this.getElements("x" + infix + "_nominal_baku");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajisd_detil_add->nominal_baku->caption(), $gajisd_detil_add->nominal_baku->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_nominal_baku");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajisd_detil_add->nominal_baku->errorMessage()) ?>");
			<?php if ($gajisd_detil_add->baku->Required) { ?>
				elm = this.getElements("x" + infix + "_baku");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajisd_detil_add->baku->caption(), $gajisd_detil_add->baku->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_baku");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajisd_detil_add->baku->errorMessage()) ?>");
			<?php if ($gajisd_detil_add->kehadiran->Required) { ?>
				elm = this.getElements("x" + infix + "_kehadiran");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajisd_detil_add->kehadiran->caption(), $gajisd_detil_add->kehadiran->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_kehadiran");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajisd_detil_add->kehadiran->errorMessage()) ?>");
			<?php if ($gajisd_detil_add->prestasi->Required) { ?>
				elm = this.getElements("x" + infix + "_prestasi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajisd_detil_add->prestasi->caption(), $gajisd_detil_add->prestasi->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_prestasi");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajisd_detil_add->prestasi->errorMessage()) ?>");
			<?php if ($gajisd_detil_add->jumlahgaji->Required) { ?>
				elm = this.getElements("x" + infix + "_jumlahgaji");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajisd_detil_add->jumlahgaji->caption(), $gajisd_detil_add->jumlahgaji->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jumlahgaji");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajisd_detil_add->jumlahgaji->errorMessage()) ?>");
			<?php if ($gajisd_detil_add->jumgajitotal->Required) { ?>
				elm = this.getElements("x" + infix + "_jumgajitotal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajisd_detil_add->jumgajitotal->caption(), $gajisd_detil_add->jumgajitotal->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jumgajitotal");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajisd_detil_add->jumgajitotal->errorMessage()) ?>");
			<?php if ($gajisd_detil_add->potongan1->Required) { ?>
				elm = this.getElements("x" + infix + "_potongan1");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajisd_detil_add->potongan1->caption(), $gajisd_detil_add->potongan1->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_potongan1");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajisd_detil_add->potongan1->errorMessage()) ?>");
			<?php if ($gajisd_detil_add->potongan2->Required) { ?>
				elm = this.getElements("x" + infix + "_potongan2");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajisd_detil_add->potongan2->caption(), $gajisd_detil_add->potongan2->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_potongan2");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajisd_detil_add->potongan2->errorMessage()) ?>");
			<?php if ($gajisd_detil_add->jumlahterima->Required) { ?>
				elm = this.getElements("x" + infix + "_jumlahterima");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajisd_detil_add->jumlahterima->caption(), $gajisd_detil_add->jumlahterima->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jumlahterima");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajisd_detil_add->jumlahterima->errorMessage()) ?>");

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
	fgajisd_detiladd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fgajisd_detiladd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fgajisd_detiladd.lists["x_pegawai_id"] = <?php echo $gajisd_detil_add->pegawai_id->Lookup->toClientList($gajisd_detil_add) ?>;
	fgajisd_detiladd.lists["x_pegawai_id"].options = <?php echo JsonEncode($gajisd_detil_add->pegawai_id->lookupOptions()) ?>;
	fgajisd_detiladd.autoSuggests["x_pegawai_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fgajisd_detiladd.lists["x_jabatan_id"] = <?php echo $gajisd_detil_add->jabatan_id->Lookup->toClientList($gajisd_detil_add) ?>;
	fgajisd_detiladd.lists["x_jabatan_id"].options = <?php echo JsonEncode($gajisd_detil_add->jabatan_id->lookupOptions()) ?>;
	fgajisd_detiladd.autoSuggests["x_jabatan_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fgajisd_detiladd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $gajisd_detil_add->showPageHeader(); ?>
<?php
$gajisd_detil_add->showMessage();
?>
<form name="fgajisd_detiladd" id="fgajisd_detiladd" class="<?php echo $gajisd_detil_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gajisd_detil">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$gajisd_detil_add->IsModal ?>">
<?php if ($gajisd_detil->getCurrentMasterTable() == "gajisd") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="gajisd">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($gajisd_detil_add->pid->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($gajisd_detil_add->pid->Visible) { // pid ?>
	<div id="r_pid" class="form-group row">
		<label id="elh_gajisd_detil_pid" for="x_pid" class="<?php echo $gajisd_detil_add->LeftColumnClass ?>"><?php echo $gajisd_detil_add->pid->caption() ?><?php echo $gajisd_detil_add->pid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajisd_detil_add->RightColumnClass ?>"><div <?php echo $gajisd_detil_add->pid->cellAttributes() ?>>
<?php if ($gajisd_detil_add->pid->getSessionValue() != "") { ?>
<span id="el_gajisd_detil_pid">
<span<?php echo $gajisd_detil_add->pid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gajisd_detil_add->pid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_pid" name="x_pid" value="<?php echo HtmlEncode($gajisd_detil_add->pid->CurrentValue) ?>">
<?php } else { ?>
<span id="el_gajisd_detil_pid">
<input type="text" data-table="gajisd_detil" data-field="x_pid" name="x_pid" id="x_pid" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajisd_detil_add->pid->getPlaceHolder()) ?>" value="<?php echo $gajisd_detil_add->pid->EditValue ?>"<?php echo $gajisd_detil_add->pid->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $gajisd_detil_add->pid->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajisd_detil_add->pegawai_id->Visible) { // pegawai_id ?>
	<div id="r_pegawai_id" class="form-group row">
		<label id="elh_gajisd_detil_pegawai_id" class="<?php echo $gajisd_detil_add->LeftColumnClass ?>"><?php echo $gajisd_detil_add->pegawai_id->caption() ?><?php echo $gajisd_detil_add->pegawai_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajisd_detil_add->RightColumnClass ?>"><div <?php echo $gajisd_detil_add->pegawai_id->cellAttributes() ?>>
<span id="el_gajisd_detil_pegawai_id">
<?php
$onchange = $gajisd_detil_add->pegawai_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$gajisd_detil_add->pegawai_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_pegawai_id">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_pegawai_id" id="sv_x_pegawai_id" value="<?php echo RemoveHtml($gajisd_detil_add->pegawai_id->EditValue) ?>" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($gajisd_detil_add->pegawai_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($gajisd_detil_add->pegawai_id->getPlaceHolder()) ?>"<?php echo $gajisd_detil_add->pegawai_id->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($gajisd_detil_add->pegawai_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_pegawai_id',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($gajisd_detil_add->pegawai_id->ReadOnly || $gajisd_detil_add->pegawai_id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="gajisd_detil" data-field="x_pegawai_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $gajisd_detil_add->pegawai_id->displayValueSeparatorAttribute() ?>" name="x_pegawai_id" id="x_pegawai_id" value="<?php echo HtmlEncode($gajisd_detil_add->pegawai_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fgajisd_detiladd"], function() {
	fgajisd_detiladd.createAutoSuggest({"id":"x_pegawai_id","forceSelect":false});
});
</script>
<?php echo $gajisd_detil_add->pegawai_id->Lookup->getParamTag($gajisd_detil_add, "p_x_pegawai_id") ?>
</span>
<?php echo $gajisd_detil_add->pegawai_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajisd_detil_add->jabatan_id->Visible) { // jabatan_id ?>
	<div id="r_jabatan_id" class="form-group row">
		<label id="elh_gajisd_detil_jabatan_id" class="<?php echo $gajisd_detil_add->LeftColumnClass ?>"><?php echo $gajisd_detil_add->jabatan_id->caption() ?><?php echo $gajisd_detil_add->jabatan_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajisd_detil_add->RightColumnClass ?>"><div <?php echo $gajisd_detil_add->jabatan_id->cellAttributes() ?>>
<span id="el_gajisd_detil_jabatan_id">
<?php
$onchange = $gajisd_detil_add->jabatan_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$gajisd_detil_add->jabatan_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_jabatan_id">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_jabatan_id" id="sv_x_jabatan_id" value="<?php echo RemoveHtml($gajisd_detil_add->jabatan_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajisd_detil_add->jabatan_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($gajisd_detil_add->jabatan_id->getPlaceHolder()) ?>"<?php echo $gajisd_detil_add->jabatan_id->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($gajisd_detil_add->jabatan_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_jabatan_id',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($gajisd_detil_add->jabatan_id->ReadOnly || $gajisd_detil_add->jabatan_id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="gajisd_detil" data-field="x_jabatan_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $gajisd_detil_add->jabatan_id->displayValueSeparatorAttribute() ?>" name="x_jabatan_id" id="x_jabatan_id" value="<?php echo HtmlEncode($gajisd_detil_add->jabatan_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fgajisd_detiladd"], function() {
	fgajisd_detiladd.createAutoSuggest({"id":"x_jabatan_id","forceSelect":false});
});
</script>
<?php echo $gajisd_detil_add->jabatan_id->Lookup->getParamTag($gajisd_detil_add, "p_x_jabatan_id") ?>
</span>
<?php echo $gajisd_detil_add->jabatan_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajisd_detil_add->masakerja->Visible) { // masakerja ?>
	<div id="r_masakerja" class="form-group row">
		<label id="elh_gajisd_detil_masakerja" for="x_masakerja" class="<?php echo $gajisd_detil_add->LeftColumnClass ?>"><?php echo $gajisd_detil_add->masakerja->caption() ?><?php echo $gajisd_detil_add->masakerja->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajisd_detil_add->RightColumnClass ?>"><div <?php echo $gajisd_detil_add->masakerja->cellAttributes() ?>>
<span id="el_gajisd_detil_masakerja">
<input type="text" data-table="gajisd_detil" data-field="x_masakerja" name="x_masakerja" id="x_masakerja" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($gajisd_detil_add->masakerja->getPlaceHolder()) ?>" value="<?php echo $gajisd_detil_add->masakerja->EditValue ?>"<?php echo $gajisd_detil_add->masakerja->editAttributes() ?>>
</span>
<?php echo $gajisd_detil_add->masakerja->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajisd_detil_add->jumngajar->Visible) { // jumngajar ?>
	<div id="r_jumngajar" class="form-group row">
		<label id="elh_gajisd_detil_jumngajar" for="x_jumngajar" class="<?php echo $gajisd_detil_add->LeftColumnClass ?>"><?php echo $gajisd_detil_add->jumngajar->caption() ?><?php echo $gajisd_detil_add->jumngajar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajisd_detil_add->RightColumnClass ?>"><div <?php echo $gajisd_detil_add->jumngajar->cellAttributes() ?>>
<span id="el_gajisd_detil_jumngajar">
<input type="text" data-table="gajisd_detil" data-field="x_jumngajar" name="x_jumngajar" id="x_jumngajar" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($gajisd_detil_add->jumngajar->getPlaceHolder()) ?>" value="<?php echo $gajisd_detil_add->jumngajar->EditValue ?>"<?php echo $gajisd_detil_add->jumngajar->editAttributes() ?>>
</span>
<?php echo $gajisd_detil_add->jumngajar->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajisd_detil_add->ijin->Visible) { // ijin ?>
	<div id="r_ijin" class="form-group row">
		<label id="elh_gajisd_detil_ijin" for="x_ijin" class="<?php echo $gajisd_detil_add->LeftColumnClass ?>"><?php echo $gajisd_detil_add->ijin->caption() ?><?php echo $gajisd_detil_add->ijin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajisd_detil_add->RightColumnClass ?>"><div <?php echo $gajisd_detil_add->ijin->cellAttributes() ?>>
<span id="el_gajisd_detil_ijin">
<input type="text" data-table="gajisd_detil" data-field="x_ijin" name="x_ijin" id="x_ijin" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($gajisd_detil_add->ijin->getPlaceHolder()) ?>" value="<?php echo $gajisd_detil_add->ijin->EditValue ?>"<?php echo $gajisd_detil_add->ijin->editAttributes() ?>>
</span>
<?php echo $gajisd_detil_add->ijin->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajisd_detil_add->tunjangan_wkosis->Visible) { // tunjangan_wkosis ?>
	<div id="r_tunjangan_wkosis" class="form-group row">
		<label id="elh_gajisd_detil_tunjangan_wkosis" for="x_tunjangan_wkosis" class="<?php echo $gajisd_detil_add->LeftColumnClass ?>"><?php echo $gajisd_detil_add->tunjangan_wkosis->caption() ?><?php echo $gajisd_detil_add->tunjangan_wkosis->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajisd_detil_add->RightColumnClass ?>"><div <?php echo $gajisd_detil_add->tunjangan_wkosis->cellAttributes() ?>>
<span id="el_gajisd_detil_tunjangan_wkosis">
<input type="text" data-table="gajisd_detil" data-field="x_tunjangan_wkosis" name="x_tunjangan_wkosis" id="x_tunjangan_wkosis" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajisd_detil_add->tunjangan_wkosis->getPlaceHolder()) ?>" value="<?php echo $gajisd_detil_add->tunjangan_wkosis->EditValue ?>"<?php echo $gajisd_detil_add->tunjangan_wkosis->editAttributes() ?>>
</span>
<?php echo $gajisd_detil_add->tunjangan_wkosis->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajisd_detil_add->nominal_baku->Visible) { // nominal_baku ?>
	<div id="r_nominal_baku" class="form-group row">
		<label id="elh_gajisd_detil_nominal_baku" for="x_nominal_baku" class="<?php echo $gajisd_detil_add->LeftColumnClass ?>"><?php echo $gajisd_detil_add->nominal_baku->caption() ?><?php echo $gajisd_detil_add->nominal_baku->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajisd_detil_add->RightColumnClass ?>"><div <?php echo $gajisd_detil_add->nominal_baku->cellAttributes() ?>>
<span id="el_gajisd_detil_nominal_baku">
<input type="text" data-table="gajisd_detil" data-field="x_nominal_baku" name="x_nominal_baku" id="x_nominal_baku" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajisd_detil_add->nominal_baku->getPlaceHolder()) ?>" value="<?php echo $gajisd_detil_add->nominal_baku->EditValue ?>"<?php echo $gajisd_detil_add->nominal_baku->editAttributes() ?>>
</span>
<?php echo $gajisd_detil_add->nominal_baku->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajisd_detil_add->baku->Visible) { // baku ?>
	<div id="r_baku" class="form-group row">
		<label id="elh_gajisd_detil_baku" for="x_baku" class="<?php echo $gajisd_detil_add->LeftColumnClass ?>"><?php echo $gajisd_detil_add->baku->caption() ?><?php echo $gajisd_detil_add->baku->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajisd_detil_add->RightColumnClass ?>"><div <?php echo $gajisd_detil_add->baku->cellAttributes() ?>>
<span id="el_gajisd_detil_baku">
<input type="text" data-table="gajisd_detil" data-field="x_baku" name="x_baku" id="x_baku" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajisd_detil_add->baku->getPlaceHolder()) ?>" value="<?php echo $gajisd_detil_add->baku->EditValue ?>"<?php echo $gajisd_detil_add->baku->editAttributes() ?>>
</span>
<?php echo $gajisd_detil_add->baku->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajisd_detil_add->kehadiran->Visible) { // kehadiran ?>
	<div id="r_kehadiran" class="form-group row">
		<label id="elh_gajisd_detil_kehadiran" for="x_kehadiran" class="<?php echo $gajisd_detil_add->LeftColumnClass ?>"><?php echo $gajisd_detil_add->kehadiran->caption() ?><?php echo $gajisd_detil_add->kehadiran->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajisd_detil_add->RightColumnClass ?>"><div <?php echo $gajisd_detil_add->kehadiran->cellAttributes() ?>>
<span id="el_gajisd_detil_kehadiran">
<input type="text" data-table="gajisd_detil" data-field="x_kehadiran" name="x_kehadiran" id="x_kehadiran" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajisd_detil_add->kehadiran->getPlaceHolder()) ?>" value="<?php echo $gajisd_detil_add->kehadiran->EditValue ?>"<?php echo $gajisd_detil_add->kehadiran->editAttributes() ?>>
</span>
<?php echo $gajisd_detil_add->kehadiran->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajisd_detil_add->prestasi->Visible) { // prestasi ?>
	<div id="r_prestasi" class="form-group row">
		<label id="elh_gajisd_detil_prestasi" for="x_prestasi" class="<?php echo $gajisd_detil_add->LeftColumnClass ?>"><?php echo $gajisd_detil_add->prestasi->caption() ?><?php echo $gajisd_detil_add->prestasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajisd_detil_add->RightColumnClass ?>"><div <?php echo $gajisd_detil_add->prestasi->cellAttributes() ?>>
<span id="el_gajisd_detil_prestasi">
<input type="text" data-table="gajisd_detil" data-field="x_prestasi" name="x_prestasi" id="x_prestasi" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajisd_detil_add->prestasi->getPlaceHolder()) ?>" value="<?php echo $gajisd_detil_add->prestasi->EditValue ?>"<?php echo $gajisd_detil_add->prestasi->editAttributes() ?>>
</span>
<?php echo $gajisd_detil_add->prestasi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajisd_detil_add->jumlahgaji->Visible) { // jumlahgaji ?>
	<div id="r_jumlahgaji" class="form-group row">
		<label id="elh_gajisd_detil_jumlahgaji" for="x_jumlahgaji" class="<?php echo $gajisd_detil_add->LeftColumnClass ?>"><?php echo $gajisd_detil_add->jumlahgaji->caption() ?><?php echo $gajisd_detil_add->jumlahgaji->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajisd_detil_add->RightColumnClass ?>"><div <?php echo $gajisd_detil_add->jumlahgaji->cellAttributes() ?>>
<span id="el_gajisd_detil_jumlahgaji">
<input type="text" data-table="gajisd_detil" data-field="x_jumlahgaji" name="x_jumlahgaji" id="x_jumlahgaji" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajisd_detil_add->jumlahgaji->getPlaceHolder()) ?>" value="<?php echo $gajisd_detil_add->jumlahgaji->EditValue ?>"<?php echo $gajisd_detil_add->jumlahgaji->editAttributes() ?>>
</span>
<?php echo $gajisd_detil_add->jumlahgaji->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajisd_detil_add->jumgajitotal->Visible) { // jumgajitotal ?>
	<div id="r_jumgajitotal" class="form-group row">
		<label id="elh_gajisd_detil_jumgajitotal" for="x_jumgajitotal" class="<?php echo $gajisd_detil_add->LeftColumnClass ?>"><?php echo $gajisd_detil_add->jumgajitotal->caption() ?><?php echo $gajisd_detil_add->jumgajitotal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajisd_detil_add->RightColumnClass ?>"><div <?php echo $gajisd_detil_add->jumgajitotal->cellAttributes() ?>>
<span id="el_gajisd_detil_jumgajitotal">
<input type="text" data-table="gajisd_detil" data-field="x_jumgajitotal" name="x_jumgajitotal" id="x_jumgajitotal" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajisd_detil_add->jumgajitotal->getPlaceHolder()) ?>" value="<?php echo $gajisd_detil_add->jumgajitotal->EditValue ?>"<?php echo $gajisd_detil_add->jumgajitotal->editAttributes() ?>>
</span>
<?php echo $gajisd_detil_add->jumgajitotal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajisd_detil_add->potongan1->Visible) { // potongan1 ?>
	<div id="r_potongan1" class="form-group row">
		<label id="elh_gajisd_detil_potongan1" for="x_potongan1" class="<?php echo $gajisd_detil_add->LeftColumnClass ?>"><?php echo $gajisd_detil_add->potongan1->caption() ?><?php echo $gajisd_detil_add->potongan1->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajisd_detil_add->RightColumnClass ?>"><div <?php echo $gajisd_detil_add->potongan1->cellAttributes() ?>>
<span id="el_gajisd_detil_potongan1">
<input type="text" data-table="gajisd_detil" data-field="x_potongan1" name="x_potongan1" id="x_potongan1" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajisd_detil_add->potongan1->getPlaceHolder()) ?>" value="<?php echo $gajisd_detil_add->potongan1->EditValue ?>"<?php echo $gajisd_detil_add->potongan1->editAttributes() ?>>
</span>
<?php echo $gajisd_detil_add->potongan1->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajisd_detil_add->potongan2->Visible) { // potongan2 ?>
	<div id="r_potongan2" class="form-group row">
		<label id="elh_gajisd_detil_potongan2" for="x_potongan2" class="<?php echo $gajisd_detil_add->LeftColumnClass ?>"><?php echo $gajisd_detil_add->potongan2->caption() ?><?php echo $gajisd_detil_add->potongan2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajisd_detil_add->RightColumnClass ?>"><div <?php echo $gajisd_detil_add->potongan2->cellAttributes() ?>>
<span id="el_gajisd_detil_potongan2">
<input type="text" data-table="gajisd_detil" data-field="x_potongan2" name="x_potongan2" id="x_potongan2" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajisd_detil_add->potongan2->getPlaceHolder()) ?>" value="<?php echo $gajisd_detil_add->potongan2->EditValue ?>"<?php echo $gajisd_detil_add->potongan2->editAttributes() ?>>
</span>
<?php echo $gajisd_detil_add->potongan2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajisd_detil_add->jumlahterima->Visible) { // jumlahterima ?>
	<div id="r_jumlahterima" class="form-group row">
		<label id="elh_gajisd_detil_jumlahterima" for="x_jumlahterima" class="<?php echo $gajisd_detil_add->LeftColumnClass ?>"><?php echo $gajisd_detil_add->jumlahterima->caption() ?><?php echo $gajisd_detil_add->jumlahterima->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajisd_detil_add->RightColumnClass ?>"><div <?php echo $gajisd_detil_add->jumlahterima->cellAttributes() ?>>
<span id="el_gajisd_detil_jumlahterima">
<input type="text" data-table="gajisd_detil" data-field="x_jumlahterima" name="x_jumlahterima" id="x_jumlahterima" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajisd_detil_add->jumlahterima->getPlaceHolder()) ?>" value="<?php echo $gajisd_detil_add->jumlahterima->EditValue ?>"<?php echo $gajisd_detil_add->jumlahterima->editAttributes() ?>>
</span>
<?php echo $gajisd_detil_add->jumlahterima->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$gajisd_detil_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $gajisd_detil_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $gajisd_detil_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$gajisd_detil_add->showPageFooter();
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
$gajisd_detil_add->terminate();
?>