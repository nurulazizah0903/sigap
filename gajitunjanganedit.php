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
$gajitunjangan_edit = new gajitunjangan_edit();

// Run the page
$gajitunjangan_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gajitunjangan_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fgajitunjanganedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fgajitunjanganedit = currentForm = new ew.Form("fgajitunjanganedit", "edit");

	// Validate form
	fgajitunjanganedit.validate = function() {
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
			<?php if ($gajitunjangan_edit->pidjabatan->Required) { ?>
				elm = this.getElements("x" + infix + "_pidjabatan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitunjangan_edit->pidjabatan->caption(), $gajitunjangan_edit->pidjabatan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($gajitunjangan_edit->value_kehadiran->Required) { ?>
				elm = this.getElements("x" + infix + "_value_kehadiran");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitunjangan_edit->value_kehadiran->caption(), $gajitunjangan_edit->value_kehadiran->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_value_kehadiran");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitunjangan_edit->value_kehadiran->errorMessage()) ?>");
			<?php if ($gajitunjangan_edit->gapok->Required) { ?>
				elm = this.getElements("x" + infix + "_gapok");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitunjangan_edit->gapok->caption(), $gajitunjangan_edit->gapok->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_gapok");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitunjangan_edit->gapok->errorMessage()) ?>");
			<?php if ($gajitunjangan_edit->tunjangan_jabatan->Required) { ?>
				elm = this.getElements("x" + infix + "_tunjangan_jabatan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitunjangan_edit->tunjangan_jabatan->caption(), $gajitunjangan_edit->tunjangan_jabatan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tunjangan_jabatan");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitunjangan_edit->tunjangan_jabatan->errorMessage()) ?>");
			<?php if ($gajitunjangan_edit->reward->Required) { ?>
				elm = this.getElements("x" + infix + "_reward");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitunjangan_edit->reward->caption(), $gajitunjangan_edit->reward->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_reward");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitunjangan_edit->reward->errorMessage()) ?>");
			<?php if ($gajitunjangan_edit->lembur->Required) { ?>
				elm = this.getElements("x" + infix + "_lembur");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitunjangan_edit->lembur->caption(), $gajitunjangan_edit->lembur->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_lembur");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitunjangan_edit->lembur->errorMessage()) ?>");
			<?php if ($gajitunjangan_edit->piket->Required) { ?>
				elm = this.getElements("x" + infix + "_piket");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitunjangan_edit->piket->caption(), $gajitunjangan_edit->piket->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_piket");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitunjangan_edit->piket->errorMessage()) ?>");
			<?php if ($gajitunjangan_edit->inval->Required) { ?>
				elm = this.getElements("x" + infix + "_inval");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitunjangan_edit->inval->caption(), $gajitunjangan_edit->inval->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_inval");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitunjangan_edit->inval->errorMessage()) ?>");
			<?php if ($gajitunjangan_edit->jam_lebih->Required) { ?>
				elm = this.getElements("x" + infix + "_jam_lebih");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitunjangan_edit->jam_lebih->caption(), $gajitunjangan_edit->jam_lebih->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jam_lebih");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitunjangan_edit->jam_lebih->errorMessage()) ?>");
			<?php if ($gajitunjangan_edit->tunjangan_khusus->Required) { ?>
				elm = this.getElements("x" + infix + "_tunjangan_khusus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitunjangan_edit->tunjangan_khusus->caption(), $gajitunjangan_edit->tunjangan_khusus->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tunjangan_khusus");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitunjangan_edit->tunjangan_khusus->errorMessage()) ?>");
			<?php if ($gajitunjangan_edit->ekstrakuri->Required) { ?>
				elm = this.getElements("x" + infix + "_ekstrakuri");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitunjangan_edit->ekstrakuri->caption(), $gajitunjangan_edit->ekstrakuri->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ekstrakuri");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitunjangan_edit->ekstrakuri->errorMessage()) ?>");

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
	fgajitunjanganedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fgajitunjanganedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fgajitunjanganedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $gajitunjangan_edit->showPageHeader(); ?>
<?php
$gajitunjangan_edit->showMessage();
?>
<form name="fgajitunjanganedit" id="fgajitunjanganedit" class="<?php echo $gajitunjangan_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gajitunjangan">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$gajitunjangan_edit->IsModal ?>">
<?php if ($gajitunjangan->getCurrentMasterTable() == "jabatan") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="jabatan">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($gajitunjangan_edit->pidjabatan->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($gajitunjangan_edit->pidjabatan->Visible) { // pidjabatan ?>
	<div id="r_pidjabatan" class="form-group row">
		<label id="elh_gajitunjangan_pidjabatan" class="<?php echo $gajitunjangan_edit->LeftColumnClass ?>"><?php echo $gajitunjangan_edit->pidjabatan->caption() ?><?php echo $gajitunjangan_edit->pidjabatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajitunjangan_edit->RightColumnClass ?>"><div <?php echo $gajitunjangan_edit->pidjabatan->cellAttributes() ?>>
<span id="el_gajitunjangan_pidjabatan">
<span<?php echo $gajitunjangan_edit->pidjabatan->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gajitunjangan_edit->pidjabatan->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="gajitunjangan" data-field="x_pidjabatan" name="x_pidjabatan" id="x_pidjabatan" value="<?php echo HtmlEncode($gajitunjangan_edit->pidjabatan->CurrentValue) ?>">
<?php echo $gajitunjangan_edit->pidjabatan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajitunjangan_edit->value_kehadiran->Visible) { // value_kehadiran ?>
	<div id="r_value_kehadiran" class="form-group row">
		<label id="elh_gajitunjangan_value_kehadiran" for="x_value_kehadiran" class="<?php echo $gajitunjangan_edit->LeftColumnClass ?>"><?php echo $gajitunjangan_edit->value_kehadiran->caption() ?><?php echo $gajitunjangan_edit->value_kehadiran->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajitunjangan_edit->RightColumnClass ?>"><div <?php echo $gajitunjangan_edit->value_kehadiran->cellAttributes() ?>>
<span id="el_gajitunjangan_value_kehadiran">
<input type="text" data-table="gajitunjangan" data-field="x_value_kehadiran" name="x_value_kehadiran" id="x_value_kehadiran" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gajitunjangan_edit->value_kehadiran->getPlaceHolder()) ?>" value="<?php echo $gajitunjangan_edit->value_kehadiran->EditValue ?>"<?php echo $gajitunjangan_edit->value_kehadiran->editAttributes() ?>>
</span>
<?php echo $gajitunjangan_edit->value_kehadiran->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajitunjangan_edit->gapok->Visible) { // gapok ?>
	<div id="r_gapok" class="form-group row">
		<label id="elh_gajitunjangan_gapok" for="x_gapok" class="<?php echo $gajitunjangan_edit->LeftColumnClass ?>"><?php echo $gajitunjangan_edit->gapok->caption() ?><?php echo $gajitunjangan_edit->gapok->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajitunjangan_edit->RightColumnClass ?>"><div <?php echo $gajitunjangan_edit->gapok->cellAttributes() ?>>
<span id="el_gajitunjangan_gapok">
<input type="text" data-table="gajitunjangan" data-field="x_gapok" name="x_gapok" id="x_gapok" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitunjangan_edit->gapok->getPlaceHolder()) ?>" value="<?php echo $gajitunjangan_edit->gapok->EditValue ?>"<?php echo $gajitunjangan_edit->gapok->editAttributes() ?>>
</span>
<?php echo $gajitunjangan_edit->gapok->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajitunjangan_edit->tunjangan_jabatan->Visible) { // tunjangan_jabatan ?>
	<div id="r_tunjangan_jabatan" class="form-group row">
		<label id="elh_gajitunjangan_tunjangan_jabatan" for="x_tunjangan_jabatan" class="<?php echo $gajitunjangan_edit->LeftColumnClass ?>"><?php echo $gajitunjangan_edit->tunjangan_jabatan->caption() ?><?php echo $gajitunjangan_edit->tunjangan_jabatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajitunjangan_edit->RightColumnClass ?>"><div <?php echo $gajitunjangan_edit->tunjangan_jabatan->cellAttributes() ?>>
<span id="el_gajitunjangan_tunjangan_jabatan">
<input type="text" data-table="gajitunjangan" data-field="x_tunjangan_jabatan" name="x_tunjangan_jabatan" id="x_tunjangan_jabatan" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitunjangan_edit->tunjangan_jabatan->getPlaceHolder()) ?>" value="<?php echo $gajitunjangan_edit->tunjangan_jabatan->EditValue ?>"<?php echo $gajitunjangan_edit->tunjangan_jabatan->editAttributes() ?>>
</span>
<?php echo $gajitunjangan_edit->tunjangan_jabatan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajitunjangan_edit->reward->Visible) { // reward ?>
	<div id="r_reward" class="form-group row">
		<label id="elh_gajitunjangan_reward" for="x_reward" class="<?php echo $gajitunjangan_edit->LeftColumnClass ?>"><?php echo $gajitunjangan_edit->reward->caption() ?><?php echo $gajitunjangan_edit->reward->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajitunjangan_edit->RightColumnClass ?>"><div <?php echo $gajitunjangan_edit->reward->cellAttributes() ?>>
<span id="el_gajitunjangan_reward">
<input type="text" data-table="gajitunjangan" data-field="x_reward" name="x_reward" id="x_reward" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitunjangan_edit->reward->getPlaceHolder()) ?>" value="<?php echo $gajitunjangan_edit->reward->EditValue ?>"<?php echo $gajitunjangan_edit->reward->editAttributes() ?>>
</span>
<?php echo $gajitunjangan_edit->reward->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajitunjangan_edit->lembur->Visible) { // lembur ?>
	<div id="r_lembur" class="form-group row">
		<label id="elh_gajitunjangan_lembur" for="x_lembur" class="<?php echo $gajitunjangan_edit->LeftColumnClass ?>"><?php echo $gajitunjangan_edit->lembur->caption() ?><?php echo $gajitunjangan_edit->lembur->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajitunjangan_edit->RightColumnClass ?>"><div <?php echo $gajitunjangan_edit->lembur->cellAttributes() ?>>
<span id="el_gajitunjangan_lembur">
<input type="text" data-table="gajitunjangan" data-field="x_lembur" name="x_lembur" id="x_lembur" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitunjangan_edit->lembur->getPlaceHolder()) ?>" value="<?php echo $gajitunjangan_edit->lembur->EditValue ?>"<?php echo $gajitunjangan_edit->lembur->editAttributes() ?>>
</span>
<?php echo $gajitunjangan_edit->lembur->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajitunjangan_edit->piket->Visible) { // piket ?>
	<div id="r_piket" class="form-group row">
		<label id="elh_gajitunjangan_piket" for="x_piket" class="<?php echo $gajitunjangan_edit->LeftColumnClass ?>"><?php echo $gajitunjangan_edit->piket->caption() ?><?php echo $gajitunjangan_edit->piket->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajitunjangan_edit->RightColumnClass ?>"><div <?php echo $gajitunjangan_edit->piket->cellAttributes() ?>>
<span id="el_gajitunjangan_piket">
<input type="text" data-table="gajitunjangan" data-field="x_piket" name="x_piket" id="x_piket" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitunjangan_edit->piket->getPlaceHolder()) ?>" value="<?php echo $gajitunjangan_edit->piket->EditValue ?>"<?php echo $gajitunjangan_edit->piket->editAttributes() ?>>
</span>
<?php echo $gajitunjangan_edit->piket->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajitunjangan_edit->inval->Visible) { // inval ?>
	<div id="r_inval" class="form-group row">
		<label id="elh_gajitunjangan_inval" for="x_inval" class="<?php echo $gajitunjangan_edit->LeftColumnClass ?>"><?php echo $gajitunjangan_edit->inval->caption() ?><?php echo $gajitunjangan_edit->inval->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajitunjangan_edit->RightColumnClass ?>"><div <?php echo $gajitunjangan_edit->inval->cellAttributes() ?>>
<span id="el_gajitunjangan_inval">
<input type="text" data-table="gajitunjangan" data-field="x_inval" name="x_inval" id="x_inval" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitunjangan_edit->inval->getPlaceHolder()) ?>" value="<?php echo $gajitunjangan_edit->inval->EditValue ?>"<?php echo $gajitunjangan_edit->inval->editAttributes() ?>>
</span>
<?php echo $gajitunjangan_edit->inval->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajitunjangan_edit->jam_lebih->Visible) { // jam_lebih ?>
	<div id="r_jam_lebih" class="form-group row">
		<label id="elh_gajitunjangan_jam_lebih" for="x_jam_lebih" class="<?php echo $gajitunjangan_edit->LeftColumnClass ?>"><?php echo $gajitunjangan_edit->jam_lebih->caption() ?><?php echo $gajitunjangan_edit->jam_lebih->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajitunjangan_edit->RightColumnClass ?>"><div <?php echo $gajitunjangan_edit->jam_lebih->cellAttributes() ?>>
<span id="el_gajitunjangan_jam_lebih">
<input type="text" data-table="gajitunjangan" data-field="x_jam_lebih" name="x_jam_lebih" id="x_jam_lebih" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gajitunjangan_edit->jam_lebih->getPlaceHolder()) ?>" value="<?php echo $gajitunjangan_edit->jam_lebih->EditValue ?>"<?php echo $gajitunjangan_edit->jam_lebih->editAttributes() ?>>
</span>
<?php echo $gajitunjangan_edit->jam_lebih->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajitunjangan_edit->tunjangan_khusus->Visible) { // tunjangan_khusus ?>
	<div id="r_tunjangan_khusus" class="form-group row">
		<label id="elh_gajitunjangan_tunjangan_khusus" for="x_tunjangan_khusus" class="<?php echo $gajitunjangan_edit->LeftColumnClass ?>"><?php echo $gajitunjangan_edit->tunjangan_khusus->caption() ?><?php echo $gajitunjangan_edit->tunjangan_khusus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajitunjangan_edit->RightColumnClass ?>"><div <?php echo $gajitunjangan_edit->tunjangan_khusus->cellAttributes() ?>>
<span id="el_gajitunjangan_tunjangan_khusus">
<input type="text" data-table="gajitunjangan" data-field="x_tunjangan_khusus" name="x_tunjangan_khusus" id="x_tunjangan_khusus" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gajitunjangan_edit->tunjangan_khusus->getPlaceHolder()) ?>" value="<?php echo $gajitunjangan_edit->tunjangan_khusus->EditValue ?>"<?php echo $gajitunjangan_edit->tunjangan_khusus->editAttributes() ?>>
</span>
<?php echo $gajitunjangan_edit->tunjangan_khusus->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajitunjangan_edit->ekstrakuri->Visible) { // ekstrakuri ?>
	<div id="r_ekstrakuri" class="form-group row">
		<label id="elh_gajitunjangan_ekstrakuri" for="x_ekstrakuri" class="<?php echo $gajitunjangan_edit->LeftColumnClass ?>"><?php echo $gajitunjangan_edit->ekstrakuri->caption() ?><?php echo $gajitunjangan_edit->ekstrakuri->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajitunjangan_edit->RightColumnClass ?>"><div <?php echo $gajitunjangan_edit->ekstrakuri->cellAttributes() ?>>
<span id="el_gajitunjangan_ekstrakuri">
<input type="text" data-table="gajitunjangan" data-field="x_ekstrakuri" name="x_ekstrakuri" id="x_ekstrakuri" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gajitunjangan_edit->ekstrakuri->getPlaceHolder()) ?>" value="<?php echo $gajitunjangan_edit->ekstrakuri->EditValue ?>"<?php echo $gajitunjangan_edit->ekstrakuri->editAttributes() ?>>
</span>
<?php echo $gajitunjangan_edit->ekstrakuri->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="gajitunjangan" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($gajitunjangan_edit->id->CurrentValue) ?>">
<?php if (!$gajitunjangan_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $gajitunjangan_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $gajitunjangan_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$gajitunjangan_edit->showPageFooter();
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
$gajitunjangan_edit->terminate();
?>