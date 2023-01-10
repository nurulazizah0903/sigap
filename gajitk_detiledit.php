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
$gajitk_detil_edit = new gajitk_detil_edit();

// Run the page
$gajitk_detil_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gajitk_detil_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fgajitk_detiledit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fgajitk_detiledit = currentForm = new ew.Form("fgajitk_detiledit", "edit");

	// Validate form
	fgajitk_detiledit.validate = function() {
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
			<?php if ($gajitk_detil_edit->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitk_detil_edit->id->caption(), $gajitk_detil_edit->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($gajitk_detil_edit->pid->Required) { ?>
				elm = this.getElements("x" + infix + "_pid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitk_detil_edit->pid->caption(), $gajitk_detil_edit->pid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pid");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitk_detil_edit->pid->errorMessage()) ?>");
			<?php if ($gajitk_detil_edit->pegawai_id->Required) { ?>
				elm = this.getElements("x" + infix + "_pegawai_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitk_detil_edit->pegawai_id->caption(), $gajitk_detil_edit->pegawai_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($gajitk_detil_edit->jabatan_id->Required) { ?>
				elm = this.getElements("x" + infix + "_jabatan_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitk_detil_edit->jabatan_id->caption(), $gajitk_detil_edit->jabatan_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($gajitk_detil_edit->masakerja->Required) { ?>
				elm = this.getElements("x" + infix + "_masakerja");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitk_detil_edit->masakerja->caption(), $gajitk_detil_edit->masakerja->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_masakerja");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitk_detil_edit->masakerja->errorMessage()) ?>");
			<?php if ($gajitk_detil_edit->jumngajar->Required) { ?>
				elm = this.getElements("x" + infix + "_jumngajar");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitk_detil_edit->jumngajar->caption(), $gajitk_detil_edit->jumngajar->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jumngajar");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitk_detil_edit->jumngajar->errorMessage()) ?>");
			<?php if ($gajitk_detil_edit->ijin->Required) { ?>
				elm = this.getElements("x" + infix + "_ijin");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitk_detil_edit->ijin->caption(), $gajitk_detil_edit->ijin->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ijin");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitk_detil_edit->ijin->errorMessage()) ?>");
			<?php if ($gajitk_detil_edit->voucher->Required) { ?>
				elm = this.getElements("x" + infix + "_voucher");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitk_detil_edit->voucher->caption(), $gajitk_detil_edit->voucher->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_voucher");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitk_detil_edit->voucher->errorMessage()) ?>");
			<?php if ($gajitk_detil_edit->tunjangan_khusus->Required) { ?>
				elm = this.getElements("x" + infix + "_tunjangan_khusus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitk_detil_edit->tunjangan_khusus->caption(), $gajitk_detil_edit->tunjangan_khusus->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tunjangan_khusus");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitk_detil_edit->tunjangan_khusus->errorMessage()) ?>");
			<?php if ($gajitk_detil_edit->tunjangan_jabatan->Required) { ?>
				elm = this.getElements("x" + infix + "_tunjangan_jabatan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitk_detil_edit->tunjangan_jabatan->caption(), $gajitk_detil_edit->tunjangan_jabatan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tunjangan_jabatan");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitk_detil_edit->tunjangan_jabatan->errorMessage()) ?>");
			<?php if ($gajitk_detil_edit->baku->Required) { ?>
				elm = this.getElements("x" + infix + "_baku");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitk_detil_edit->baku->caption(), $gajitk_detil_edit->baku->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_baku");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitk_detil_edit->baku->errorMessage()) ?>");
			<?php if ($gajitk_detil_edit->kehadiran->Required) { ?>
				elm = this.getElements("x" + infix + "_kehadiran");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitk_detil_edit->kehadiran->caption(), $gajitk_detil_edit->kehadiran->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_kehadiran");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitk_detil_edit->kehadiran->errorMessage()) ?>");
			<?php if ($gajitk_detil_edit->prestasi->Required) { ?>
				elm = this.getElements("x" + infix + "_prestasi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitk_detil_edit->prestasi->caption(), $gajitk_detil_edit->prestasi->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_prestasi");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitk_detil_edit->prestasi->errorMessage()) ?>");
			<?php if ($gajitk_detil_edit->jumlahgaji->Required) { ?>
				elm = this.getElements("x" + infix + "_jumlahgaji");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitk_detil_edit->jumlahgaji->caption(), $gajitk_detil_edit->jumlahgaji->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jumlahgaji");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitk_detil_edit->jumlahgaji->errorMessage()) ?>");
			<?php if ($gajitk_detil_edit->jumgajitotal->Required) { ?>
				elm = this.getElements("x" + infix + "_jumgajitotal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitk_detil_edit->jumgajitotal->caption(), $gajitk_detil_edit->jumgajitotal->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jumgajitotal");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitk_detil_edit->jumgajitotal->errorMessage()) ?>");
			<?php if ($gajitk_detil_edit->potongan1->Required) { ?>
				elm = this.getElements("x" + infix + "_potongan1");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitk_detil_edit->potongan1->caption(), $gajitk_detil_edit->potongan1->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_potongan1");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitk_detil_edit->potongan1->errorMessage()) ?>");
			<?php if ($gajitk_detil_edit->potongan2->Required) { ?>
				elm = this.getElements("x" + infix + "_potongan2");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitk_detil_edit->potongan2->caption(), $gajitk_detil_edit->potongan2->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_potongan2");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitk_detil_edit->potongan2->errorMessage()) ?>");
			<?php if ($gajitk_detil_edit->jumlahterima->Required) { ?>
				elm = this.getElements("x" + infix + "_jumlahterima");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitk_detil_edit->jumlahterima->caption(), $gajitk_detil_edit->jumlahterima->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jumlahterima");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitk_detil_edit->jumlahterima->errorMessage()) ?>");

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
	fgajitk_detiledit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fgajitk_detiledit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fgajitk_detiledit.lists["x_pegawai_id"] = <?php echo $gajitk_detil_edit->pegawai_id->Lookup->toClientList($gajitk_detil_edit) ?>;
	fgajitk_detiledit.lists["x_pegawai_id"].options = <?php echo JsonEncode($gajitk_detil_edit->pegawai_id->lookupOptions()) ?>;
	fgajitk_detiledit.lists["x_jabatan_id"] = <?php echo $gajitk_detil_edit->jabatan_id->Lookup->toClientList($gajitk_detil_edit) ?>;
	fgajitk_detiledit.lists["x_jabatan_id"].options = <?php echo JsonEncode($gajitk_detil_edit->jabatan_id->lookupOptions()) ?>;
	loadjs.done("fgajitk_detiledit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $gajitk_detil_edit->showPageHeader(); ?>
<?php
$gajitk_detil_edit->showMessage();
?>
<form name="fgajitk_detiledit" id="fgajitk_detiledit" class="<?php echo $gajitk_detil_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gajitk_detil">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$gajitk_detil_edit->IsModal ?>">
<?php if ($gajitk_detil->getCurrentMasterTable() == "gajitk") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="gajitk">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($gajitk_detil_edit->pid->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($gajitk_detil_edit->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_gajitk_detil_id" class="<?php echo $gajitk_detil_edit->LeftColumnClass ?>"><?php echo $gajitk_detil_edit->id->caption() ?><?php echo $gajitk_detil_edit->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajitk_detil_edit->RightColumnClass ?>"><div <?php echo $gajitk_detil_edit->id->cellAttributes() ?>>
<span id="el_gajitk_detil_id">
<span<?php echo $gajitk_detil_edit->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gajitk_detil_edit->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="gajitk_detil" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($gajitk_detil_edit->id->CurrentValue) ?>">
<?php echo $gajitk_detil_edit->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajitk_detil_edit->pid->Visible) { // pid ?>
	<div id="r_pid" class="form-group row">
		<label id="elh_gajitk_detil_pid" for="x_pid" class="<?php echo $gajitk_detil_edit->LeftColumnClass ?>"><?php echo $gajitk_detil_edit->pid->caption() ?><?php echo $gajitk_detil_edit->pid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajitk_detil_edit->RightColumnClass ?>"><div <?php echo $gajitk_detil_edit->pid->cellAttributes() ?>>
<?php if ($gajitk_detil_edit->pid->getSessionValue() != "") { ?>
<span id="el_gajitk_detil_pid">
<span<?php echo $gajitk_detil_edit->pid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gajitk_detil_edit->pid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_pid" name="x_pid" value="<?php echo HtmlEncode($gajitk_detil_edit->pid->CurrentValue) ?>">
<?php } else { ?>
<span id="el_gajitk_detil_pid">
<input type="text" data-table="gajitk_detil" data-field="x_pid" name="x_pid" id="x_pid" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitk_detil_edit->pid->getPlaceHolder()) ?>" value="<?php echo $gajitk_detil_edit->pid->EditValue ?>"<?php echo $gajitk_detil_edit->pid->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $gajitk_detil_edit->pid->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajitk_detil_edit->pegawai_id->Visible) { // pegawai_id ?>
	<div id="r_pegawai_id" class="form-group row">
		<label id="elh_gajitk_detil_pegawai_id" for="x_pegawai_id" class="<?php echo $gajitk_detil_edit->LeftColumnClass ?>"><?php echo $gajitk_detil_edit->pegawai_id->caption() ?><?php echo $gajitk_detil_edit->pegawai_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajitk_detil_edit->RightColumnClass ?>"><div <?php echo $gajitk_detil_edit->pegawai_id->cellAttributes() ?>>
<span id="el_gajitk_detil_pegawai_id">
<?php $gajitk_detil_edit->pegawai_id->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_pegawai_id"><?php echo EmptyValue(strval($gajitk_detil_edit->pegawai_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $gajitk_detil_edit->pegawai_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($gajitk_detil_edit->pegawai_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($gajitk_detil_edit->pegawai_id->ReadOnly || $gajitk_detil_edit->pegawai_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_pegawai_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $gajitk_detil_edit->pegawai_id->Lookup->getParamTag($gajitk_detil_edit, "p_x_pegawai_id") ?>
<input type="hidden" data-table="gajitk_detil" data-field="x_pegawai_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $gajitk_detil_edit->pegawai_id->displayValueSeparatorAttribute() ?>" name="x_pegawai_id" id="x_pegawai_id" value="<?php echo $gajitk_detil_edit->pegawai_id->CurrentValue ?>"<?php echo $gajitk_detil_edit->pegawai_id->editAttributes() ?>>
</span>
<?php echo $gajitk_detil_edit->pegawai_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajitk_detil_edit->jabatan_id->Visible) { // jabatan_id ?>
	<div id="r_jabatan_id" class="form-group row">
		<label id="elh_gajitk_detil_jabatan_id" for="x_jabatan_id" class="<?php echo $gajitk_detil_edit->LeftColumnClass ?>"><?php echo $gajitk_detil_edit->jabatan_id->caption() ?><?php echo $gajitk_detil_edit->jabatan_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajitk_detil_edit->RightColumnClass ?>"><div <?php echo $gajitk_detil_edit->jabatan_id->cellAttributes() ?>>
<span id="el_gajitk_detil_jabatan_id">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="gajitk_detil" data-field="x_jabatan_id" data-value-separator="<?php echo $gajitk_detil_edit->jabatan_id->displayValueSeparatorAttribute() ?>" id="x_jabatan_id" name="x_jabatan_id"<?php echo $gajitk_detil_edit->jabatan_id->editAttributes() ?>>
			<?php echo $gajitk_detil_edit->jabatan_id->selectOptionListHtml("x_jabatan_id") ?>
		</select>
</div>
<?php echo $gajitk_detil_edit->jabatan_id->Lookup->getParamTag($gajitk_detil_edit, "p_x_jabatan_id") ?>
</span>
<?php echo $gajitk_detil_edit->jabatan_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajitk_detil_edit->masakerja->Visible) { // masakerja ?>
	<div id="r_masakerja" class="form-group row">
		<label id="elh_gajitk_detil_masakerja" for="x_masakerja" class="<?php echo $gajitk_detil_edit->LeftColumnClass ?>"><?php echo $gajitk_detil_edit->masakerja->caption() ?><?php echo $gajitk_detil_edit->masakerja->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajitk_detil_edit->RightColumnClass ?>"><div <?php echo $gajitk_detil_edit->masakerja->cellAttributes() ?>>
<span id="el_gajitk_detil_masakerja">
<input type="text" data-table="gajitk_detil" data-field="x_masakerja" name="x_masakerja" id="x_masakerja" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($gajitk_detil_edit->masakerja->getPlaceHolder()) ?>" value="<?php echo $gajitk_detil_edit->masakerja->EditValue ?>"<?php echo $gajitk_detil_edit->masakerja->editAttributes() ?>>
</span>
<?php echo $gajitk_detil_edit->masakerja->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajitk_detil_edit->jumngajar->Visible) { // jumngajar ?>
	<div id="r_jumngajar" class="form-group row">
		<label id="elh_gajitk_detil_jumngajar" for="x_jumngajar" class="<?php echo $gajitk_detil_edit->LeftColumnClass ?>"><?php echo $gajitk_detil_edit->jumngajar->caption() ?><?php echo $gajitk_detil_edit->jumngajar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajitk_detil_edit->RightColumnClass ?>"><div <?php echo $gajitk_detil_edit->jumngajar->cellAttributes() ?>>
<span id="el_gajitk_detil_jumngajar">
<input type="text" data-table="gajitk_detil" data-field="x_jumngajar" name="x_jumngajar" id="x_jumngajar" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($gajitk_detil_edit->jumngajar->getPlaceHolder()) ?>" value="<?php echo $gajitk_detil_edit->jumngajar->EditValue ?>"<?php echo $gajitk_detil_edit->jumngajar->editAttributes() ?>>
</span>
<?php echo $gajitk_detil_edit->jumngajar->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajitk_detil_edit->ijin->Visible) { // ijin ?>
	<div id="r_ijin" class="form-group row">
		<label id="elh_gajitk_detil_ijin" for="x_ijin" class="<?php echo $gajitk_detil_edit->LeftColumnClass ?>"><?php echo $gajitk_detil_edit->ijin->caption() ?><?php echo $gajitk_detil_edit->ijin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajitk_detil_edit->RightColumnClass ?>"><div <?php echo $gajitk_detil_edit->ijin->cellAttributes() ?>>
<span id="el_gajitk_detil_ijin">
<input type="text" data-table="gajitk_detil" data-field="x_ijin" name="x_ijin" id="x_ijin" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($gajitk_detil_edit->ijin->getPlaceHolder()) ?>" value="<?php echo $gajitk_detil_edit->ijin->EditValue ?>"<?php echo $gajitk_detil_edit->ijin->editAttributes() ?>>
</span>
<?php echo $gajitk_detil_edit->ijin->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajitk_detil_edit->voucher->Visible) { // voucher ?>
	<div id="r_voucher" class="form-group row">
		<label id="elh_gajitk_detil_voucher" for="x_voucher" class="<?php echo $gajitk_detil_edit->LeftColumnClass ?>"><?php echo $gajitk_detil_edit->voucher->caption() ?><?php echo $gajitk_detil_edit->voucher->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajitk_detil_edit->RightColumnClass ?>"><div <?php echo $gajitk_detil_edit->voucher->cellAttributes() ?>>
<span id="el_gajitk_detil_voucher">
<input type="text" data-table="gajitk_detil" data-field="x_voucher" name="x_voucher" id="x_voucher" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitk_detil_edit->voucher->getPlaceHolder()) ?>" value="<?php echo $gajitk_detil_edit->voucher->EditValue ?>"<?php echo $gajitk_detil_edit->voucher->editAttributes() ?>>
</span>
<?php echo $gajitk_detil_edit->voucher->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajitk_detil_edit->tunjangan_khusus->Visible) { // tunjangan_khusus ?>
	<div id="r_tunjangan_khusus" class="form-group row">
		<label id="elh_gajitk_detil_tunjangan_khusus" for="x_tunjangan_khusus" class="<?php echo $gajitk_detil_edit->LeftColumnClass ?>"><?php echo $gajitk_detil_edit->tunjangan_khusus->caption() ?><?php echo $gajitk_detil_edit->tunjangan_khusus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajitk_detil_edit->RightColumnClass ?>"><div <?php echo $gajitk_detil_edit->tunjangan_khusus->cellAttributes() ?>>
<span id="el_gajitk_detil_tunjangan_khusus">
<input type="text" data-table="gajitk_detil" data-field="x_tunjangan_khusus" name="x_tunjangan_khusus" id="x_tunjangan_khusus" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitk_detil_edit->tunjangan_khusus->getPlaceHolder()) ?>" value="<?php echo $gajitk_detil_edit->tunjangan_khusus->EditValue ?>"<?php echo $gajitk_detil_edit->tunjangan_khusus->editAttributes() ?>>
</span>
<?php echo $gajitk_detil_edit->tunjangan_khusus->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajitk_detil_edit->tunjangan_jabatan->Visible) { // tunjangan_jabatan ?>
	<div id="r_tunjangan_jabatan" class="form-group row">
		<label id="elh_gajitk_detil_tunjangan_jabatan" for="x_tunjangan_jabatan" class="<?php echo $gajitk_detil_edit->LeftColumnClass ?>"><?php echo $gajitk_detil_edit->tunjangan_jabatan->caption() ?><?php echo $gajitk_detil_edit->tunjangan_jabatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajitk_detil_edit->RightColumnClass ?>"><div <?php echo $gajitk_detil_edit->tunjangan_jabatan->cellAttributes() ?>>
<span id="el_gajitk_detil_tunjangan_jabatan">
<input type="text" data-table="gajitk_detil" data-field="x_tunjangan_jabatan" name="x_tunjangan_jabatan" id="x_tunjangan_jabatan" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitk_detil_edit->tunjangan_jabatan->getPlaceHolder()) ?>" value="<?php echo $gajitk_detil_edit->tunjangan_jabatan->EditValue ?>"<?php echo $gajitk_detil_edit->tunjangan_jabatan->editAttributes() ?>>
</span>
<?php echo $gajitk_detil_edit->tunjangan_jabatan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajitk_detil_edit->baku->Visible) { // baku ?>
	<div id="r_baku" class="form-group row">
		<label id="elh_gajitk_detil_baku" for="x_baku" class="<?php echo $gajitk_detil_edit->LeftColumnClass ?>"><?php echo $gajitk_detil_edit->baku->caption() ?><?php echo $gajitk_detil_edit->baku->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajitk_detil_edit->RightColumnClass ?>"><div <?php echo $gajitk_detil_edit->baku->cellAttributes() ?>>
<span id="el_gajitk_detil_baku">
<input type="text" data-table="gajitk_detil" data-field="x_baku" name="x_baku" id="x_baku" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitk_detil_edit->baku->getPlaceHolder()) ?>" value="<?php echo $gajitk_detil_edit->baku->EditValue ?>"<?php echo $gajitk_detil_edit->baku->editAttributes() ?>>
</span>
<?php echo $gajitk_detil_edit->baku->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajitk_detil_edit->kehadiran->Visible) { // kehadiran ?>
	<div id="r_kehadiran" class="form-group row">
		<label id="elh_gajitk_detil_kehadiran" for="x_kehadiran" class="<?php echo $gajitk_detil_edit->LeftColumnClass ?>"><?php echo $gajitk_detil_edit->kehadiran->caption() ?><?php echo $gajitk_detil_edit->kehadiran->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajitk_detil_edit->RightColumnClass ?>"><div <?php echo $gajitk_detil_edit->kehadiran->cellAttributes() ?>>
<span id="el_gajitk_detil_kehadiran">
<input type="text" data-table="gajitk_detil" data-field="x_kehadiran" name="x_kehadiran" id="x_kehadiran" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitk_detil_edit->kehadiran->getPlaceHolder()) ?>" value="<?php echo $gajitk_detil_edit->kehadiran->EditValue ?>"<?php echo $gajitk_detil_edit->kehadiran->editAttributes() ?>>
</span>
<?php echo $gajitk_detil_edit->kehadiran->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajitk_detil_edit->prestasi->Visible) { // prestasi ?>
	<div id="r_prestasi" class="form-group row">
		<label id="elh_gajitk_detil_prestasi" for="x_prestasi" class="<?php echo $gajitk_detil_edit->LeftColumnClass ?>"><?php echo $gajitk_detil_edit->prestasi->caption() ?><?php echo $gajitk_detil_edit->prestasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajitk_detil_edit->RightColumnClass ?>"><div <?php echo $gajitk_detil_edit->prestasi->cellAttributes() ?>>
<span id="el_gajitk_detil_prestasi">
<input type="text" data-table="gajitk_detil" data-field="x_prestasi" name="x_prestasi" id="x_prestasi" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitk_detil_edit->prestasi->getPlaceHolder()) ?>" value="<?php echo $gajitk_detil_edit->prestasi->EditValue ?>"<?php echo $gajitk_detil_edit->prestasi->editAttributes() ?>>
</span>
<?php echo $gajitk_detil_edit->prestasi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajitk_detil_edit->jumlahgaji->Visible) { // jumlahgaji ?>
	<div id="r_jumlahgaji" class="form-group row">
		<label id="elh_gajitk_detil_jumlahgaji" for="x_jumlahgaji" class="<?php echo $gajitk_detil_edit->LeftColumnClass ?>"><?php echo $gajitk_detil_edit->jumlahgaji->caption() ?><?php echo $gajitk_detil_edit->jumlahgaji->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajitk_detil_edit->RightColumnClass ?>"><div <?php echo $gajitk_detil_edit->jumlahgaji->cellAttributes() ?>>
<span id="el_gajitk_detil_jumlahgaji">
<input type="text" data-table="gajitk_detil" data-field="x_jumlahgaji" name="x_jumlahgaji" id="x_jumlahgaji" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitk_detil_edit->jumlahgaji->getPlaceHolder()) ?>" value="<?php echo $gajitk_detil_edit->jumlahgaji->EditValue ?>"<?php echo $gajitk_detil_edit->jumlahgaji->editAttributes() ?>>
</span>
<?php echo $gajitk_detil_edit->jumlahgaji->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajitk_detil_edit->jumgajitotal->Visible) { // jumgajitotal ?>
	<div id="r_jumgajitotal" class="form-group row">
		<label id="elh_gajitk_detil_jumgajitotal" for="x_jumgajitotal" class="<?php echo $gajitk_detil_edit->LeftColumnClass ?>"><?php echo $gajitk_detil_edit->jumgajitotal->caption() ?><?php echo $gajitk_detil_edit->jumgajitotal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajitk_detil_edit->RightColumnClass ?>"><div <?php echo $gajitk_detil_edit->jumgajitotal->cellAttributes() ?>>
<span id="el_gajitk_detil_jumgajitotal">
<input type="text" data-table="gajitk_detil" data-field="x_jumgajitotal" name="x_jumgajitotal" id="x_jumgajitotal" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitk_detil_edit->jumgajitotal->getPlaceHolder()) ?>" value="<?php echo $gajitk_detil_edit->jumgajitotal->EditValue ?>"<?php echo $gajitk_detil_edit->jumgajitotal->editAttributes() ?>>
</span>
<?php echo $gajitk_detil_edit->jumgajitotal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajitk_detil_edit->potongan1->Visible) { // potongan1 ?>
	<div id="r_potongan1" class="form-group row">
		<label id="elh_gajitk_detil_potongan1" for="x_potongan1" class="<?php echo $gajitk_detil_edit->LeftColumnClass ?>"><?php echo $gajitk_detil_edit->potongan1->caption() ?><?php echo $gajitk_detil_edit->potongan1->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajitk_detil_edit->RightColumnClass ?>"><div <?php echo $gajitk_detil_edit->potongan1->cellAttributes() ?>>
<span id="el_gajitk_detil_potongan1">
<input type="text" data-table="gajitk_detil" data-field="x_potongan1" name="x_potongan1" id="x_potongan1" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitk_detil_edit->potongan1->getPlaceHolder()) ?>" value="<?php echo $gajitk_detil_edit->potongan1->EditValue ?>"<?php echo $gajitk_detil_edit->potongan1->editAttributes() ?>>
</span>
<?php echo $gajitk_detil_edit->potongan1->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajitk_detil_edit->potongan2->Visible) { // potongan2 ?>
	<div id="r_potongan2" class="form-group row">
		<label id="elh_gajitk_detil_potongan2" for="x_potongan2" class="<?php echo $gajitk_detil_edit->LeftColumnClass ?>"><?php echo $gajitk_detil_edit->potongan2->caption() ?><?php echo $gajitk_detil_edit->potongan2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajitk_detil_edit->RightColumnClass ?>"><div <?php echo $gajitk_detil_edit->potongan2->cellAttributes() ?>>
<span id="el_gajitk_detil_potongan2">
<input type="text" data-table="gajitk_detil" data-field="x_potongan2" name="x_potongan2" id="x_potongan2" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitk_detil_edit->potongan2->getPlaceHolder()) ?>" value="<?php echo $gajitk_detil_edit->potongan2->EditValue ?>"<?php echo $gajitk_detil_edit->potongan2->editAttributes() ?>>
</span>
<?php echo $gajitk_detil_edit->potongan2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajitk_detil_edit->jumlahterima->Visible) { // jumlahterima ?>
	<div id="r_jumlahterima" class="form-group row">
		<label id="elh_gajitk_detil_jumlahterima" for="x_jumlahterima" class="<?php echo $gajitk_detil_edit->LeftColumnClass ?>"><?php echo $gajitk_detil_edit->jumlahterima->caption() ?><?php echo $gajitk_detil_edit->jumlahterima->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajitk_detil_edit->RightColumnClass ?>"><div <?php echo $gajitk_detil_edit->jumlahterima->cellAttributes() ?>>
<span id="el_gajitk_detil_jumlahterima">
<input type="text" data-table="gajitk_detil" data-field="x_jumlahterima" name="x_jumlahterima" id="x_jumlahterima" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitk_detil_edit->jumlahterima->getPlaceHolder()) ?>" value="<?php echo $gajitk_detil_edit->jumlahterima->EditValue ?>"<?php echo $gajitk_detil_edit->jumlahterima->editAttributes() ?>>
</span>
<?php echo $gajitk_detil_edit->jumlahterima->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$gajitk_detil_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $gajitk_detil_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $gajitk_detil_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$gajitk_detil_edit->showPageFooter();
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
$gajitk_detil_edit->terminate();
?>