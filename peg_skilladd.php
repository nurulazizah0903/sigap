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
$peg_skill_add = new peg_skill_add();

// Run the page
$peg_skill_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$peg_skill_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpeg_skilladd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fpeg_skilladd = currentForm = new ew.Form("fpeg_skilladd", "add");

	// Validate form
	fpeg_skilladd.validate = function() {
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
			<?php if ($peg_skill_add->pid->Required) { ?>
				elm = this.getElements("x" + infix + "_pid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $peg_skill_add->pid->caption(), $peg_skill_add->pid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pid");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($peg_skill_add->pid->errorMessage()) ?>");
			<?php if ($peg_skill_add->keahlian->Required) { ?>
				elm = this.getElements("x" + infix + "_keahlian");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $peg_skill_add->keahlian->caption(), $peg_skill_add->keahlian->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($peg_skill_add->tingkat->Required) { ?>
				elm = this.getElements("x" + infix + "_tingkat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $peg_skill_add->tingkat->caption(), $peg_skill_add->tingkat->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($peg_skill_add->bukti->Required) { ?>
				elm = this.getElements("x" + infix + "_bukti");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $peg_skill_add->bukti->caption(), $peg_skill_add->bukti->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($peg_skill_add->keterangan->Required) { ?>
				elm = this.getElements("x" + infix + "_keterangan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $peg_skill_add->keterangan->caption(), $peg_skill_add->keterangan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($peg_skill_add->c_date->Required) { ?>
				elm = this.getElements("x" + infix + "_c_date");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $peg_skill_add->c_date->caption(), $peg_skill_add->c_date->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_c_date");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($peg_skill_add->c_date->errorMessage()) ?>");
			<?php if ($peg_skill_add->u_date->Required) { ?>
				elm = this.getElements("x" + infix + "_u_date");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $peg_skill_add->u_date->caption(), $peg_skill_add->u_date->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_u_date");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($peg_skill_add->u_date->errorMessage()) ?>");
			<?php if ($peg_skill_add->c_by->Required) { ?>
				elm = this.getElements("x" + infix + "_c_by");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $peg_skill_add->c_by->caption(), $peg_skill_add->c_by->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_c_by");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($peg_skill_add->c_by->errorMessage()) ?>");
			<?php if ($peg_skill_add->u_by->Required) { ?>
				elm = this.getElements("x" + infix + "_u_by");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $peg_skill_add->u_by->caption(), $peg_skill_add->u_by->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_u_by");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($peg_skill_add->u_by->errorMessage()) ?>");

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
	fpeg_skilladd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpeg_skilladd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fpeg_skilladd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $peg_skill_add->showPageHeader(); ?>
<?php
$peg_skill_add->showMessage();
?>
<form name="fpeg_skilladd" id="fpeg_skilladd" class="<?php echo $peg_skill_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="peg_skill">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$peg_skill_add->IsModal ?>">
<?php if ($peg_skill->getCurrentMasterTable() == "pegawai") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="pegawai">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($peg_skill_add->pid->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($peg_skill_add->pid->Visible) { // pid ?>
	<div id="r_pid" class="form-group row">
		<label id="elh_peg_skill_pid" for="x_pid" class="<?php echo $peg_skill_add->LeftColumnClass ?>"><?php echo $peg_skill_add->pid->caption() ?><?php echo $peg_skill_add->pid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $peg_skill_add->RightColumnClass ?>"><div <?php echo $peg_skill_add->pid->cellAttributes() ?>>
<?php if ($peg_skill_add->pid->getSessionValue() != "") { ?>
<span id="el_peg_skill_pid">
<span<?php echo $peg_skill_add->pid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($peg_skill_add->pid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_pid" name="x_pid" value="<?php echo HtmlEncode($peg_skill_add->pid->CurrentValue) ?>">
<?php } else { ?>
<span id="el_peg_skill_pid">
<input type="text" data-table="peg_skill" data-field="x_pid" name="x_pid" id="x_pid" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($peg_skill_add->pid->getPlaceHolder()) ?>" value="<?php echo $peg_skill_add->pid->EditValue ?>"<?php echo $peg_skill_add->pid->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $peg_skill_add->pid->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($peg_skill_add->keahlian->Visible) { // keahlian ?>
	<div id="r_keahlian" class="form-group row">
		<label id="elh_peg_skill_keahlian" for="x_keahlian" class="<?php echo $peg_skill_add->LeftColumnClass ?>"><?php echo $peg_skill_add->keahlian->caption() ?><?php echo $peg_skill_add->keahlian->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $peg_skill_add->RightColumnClass ?>"><div <?php echo $peg_skill_add->keahlian->cellAttributes() ?>>
<span id="el_peg_skill_keahlian">
<input type="text" data-table="peg_skill" data-field="x_keahlian" name="x_keahlian" id="x_keahlian" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($peg_skill_add->keahlian->getPlaceHolder()) ?>" value="<?php echo $peg_skill_add->keahlian->EditValue ?>"<?php echo $peg_skill_add->keahlian->editAttributes() ?>>
</span>
<?php echo $peg_skill_add->keahlian->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($peg_skill_add->tingkat->Visible) { // tingkat ?>
	<div id="r_tingkat" class="form-group row">
		<label id="elh_peg_skill_tingkat" for="x_tingkat" class="<?php echo $peg_skill_add->LeftColumnClass ?>"><?php echo $peg_skill_add->tingkat->caption() ?><?php echo $peg_skill_add->tingkat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $peg_skill_add->RightColumnClass ?>"><div <?php echo $peg_skill_add->tingkat->cellAttributes() ?>>
<span id="el_peg_skill_tingkat">
<input type="text" data-table="peg_skill" data-field="x_tingkat" name="x_tingkat" id="x_tingkat" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($peg_skill_add->tingkat->getPlaceHolder()) ?>" value="<?php echo $peg_skill_add->tingkat->EditValue ?>"<?php echo $peg_skill_add->tingkat->editAttributes() ?>>
</span>
<?php echo $peg_skill_add->tingkat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($peg_skill_add->bukti->Visible) { // bukti ?>
	<div id="r_bukti" class="form-group row">
		<label id="elh_peg_skill_bukti" for="x_bukti" class="<?php echo $peg_skill_add->LeftColumnClass ?>"><?php echo $peg_skill_add->bukti->caption() ?><?php echo $peg_skill_add->bukti->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $peg_skill_add->RightColumnClass ?>"><div <?php echo $peg_skill_add->bukti->cellAttributes() ?>>
<span id="el_peg_skill_bukti">
<input type="text" data-table="peg_skill" data-field="x_bukti" name="x_bukti" id="x_bukti" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($peg_skill_add->bukti->getPlaceHolder()) ?>" value="<?php echo $peg_skill_add->bukti->EditValue ?>"<?php echo $peg_skill_add->bukti->editAttributes() ?>>
</span>
<?php echo $peg_skill_add->bukti->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($peg_skill_add->keterangan->Visible) { // keterangan ?>
	<div id="r_keterangan" class="form-group row">
		<label id="elh_peg_skill_keterangan" for="x_keterangan" class="<?php echo $peg_skill_add->LeftColumnClass ?>"><?php echo $peg_skill_add->keterangan->caption() ?><?php echo $peg_skill_add->keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $peg_skill_add->RightColumnClass ?>"><div <?php echo $peg_skill_add->keterangan->cellAttributes() ?>>
<span id="el_peg_skill_keterangan">
<input type="text" data-table="peg_skill" data-field="x_keterangan" name="x_keterangan" id="x_keterangan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($peg_skill_add->keterangan->getPlaceHolder()) ?>" value="<?php echo $peg_skill_add->keterangan->EditValue ?>"<?php echo $peg_skill_add->keterangan->editAttributes() ?>>
</span>
<?php echo $peg_skill_add->keterangan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($peg_skill_add->c_date->Visible) { // c_date ?>
	<div id="r_c_date" class="form-group row">
		<label id="elh_peg_skill_c_date" for="x_c_date" class="<?php echo $peg_skill_add->LeftColumnClass ?>"><?php echo $peg_skill_add->c_date->caption() ?><?php echo $peg_skill_add->c_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $peg_skill_add->RightColumnClass ?>"><div <?php echo $peg_skill_add->c_date->cellAttributes() ?>>
<span id="el_peg_skill_c_date">
<input type="text" data-table="peg_skill" data-field="x_c_date" name="x_c_date" id="x_c_date" maxlength="19" placeholder="<?php echo HtmlEncode($peg_skill_add->c_date->getPlaceHolder()) ?>" value="<?php echo $peg_skill_add->c_date->EditValue ?>"<?php echo $peg_skill_add->c_date->editAttributes() ?>>
<?php if (!$peg_skill_add->c_date->ReadOnly && !$peg_skill_add->c_date->Disabled && !isset($peg_skill_add->c_date->EditAttrs["readonly"]) && !isset($peg_skill_add->c_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpeg_skilladd", "datetimepicker"], function() {
	ew.createDateTimePicker("fpeg_skilladd", "x_c_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $peg_skill_add->c_date->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($peg_skill_add->u_date->Visible) { // u_date ?>
	<div id="r_u_date" class="form-group row">
		<label id="elh_peg_skill_u_date" for="x_u_date" class="<?php echo $peg_skill_add->LeftColumnClass ?>"><?php echo $peg_skill_add->u_date->caption() ?><?php echo $peg_skill_add->u_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $peg_skill_add->RightColumnClass ?>"><div <?php echo $peg_skill_add->u_date->cellAttributes() ?>>
<span id="el_peg_skill_u_date">
<input type="text" data-table="peg_skill" data-field="x_u_date" name="x_u_date" id="x_u_date" maxlength="19" placeholder="<?php echo HtmlEncode($peg_skill_add->u_date->getPlaceHolder()) ?>" value="<?php echo $peg_skill_add->u_date->EditValue ?>"<?php echo $peg_skill_add->u_date->editAttributes() ?>>
<?php if (!$peg_skill_add->u_date->ReadOnly && !$peg_skill_add->u_date->Disabled && !isset($peg_skill_add->u_date->EditAttrs["readonly"]) && !isset($peg_skill_add->u_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpeg_skilladd", "datetimepicker"], function() {
	ew.createDateTimePicker("fpeg_skilladd", "x_u_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $peg_skill_add->u_date->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($peg_skill_add->c_by->Visible) { // c_by ?>
	<div id="r_c_by" class="form-group row">
		<label id="elh_peg_skill_c_by" for="x_c_by" class="<?php echo $peg_skill_add->LeftColumnClass ?>"><?php echo $peg_skill_add->c_by->caption() ?><?php echo $peg_skill_add->c_by->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $peg_skill_add->RightColumnClass ?>"><div <?php echo $peg_skill_add->c_by->cellAttributes() ?>>
<span id="el_peg_skill_c_by">
<input type="text" data-table="peg_skill" data-field="x_c_by" name="x_c_by" id="x_c_by" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($peg_skill_add->c_by->getPlaceHolder()) ?>" value="<?php echo $peg_skill_add->c_by->EditValue ?>"<?php echo $peg_skill_add->c_by->editAttributes() ?>>
</span>
<?php echo $peg_skill_add->c_by->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($peg_skill_add->u_by->Visible) { // u_by ?>
	<div id="r_u_by" class="form-group row">
		<label id="elh_peg_skill_u_by" for="x_u_by" class="<?php echo $peg_skill_add->LeftColumnClass ?>"><?php echo $peg_skill_add->u_by->caption() ?><?php echo $peg_skill_add->u_by->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $peg_skill_add->RightColumnClass ?>"><div <?php echo $peg_skill_add->u_by->cellAttributes() ?>>
<span id="el_peg_skill_u_by">
<input type="text" data-table="peg_skill" data-field="x_u_by" name="x_u_by" id="x_u_by" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($peg_skill_add->u_by->getPlaceHolder()) ?>" value="<?php echo $peg_skill_add->u_by->EditValue ?>"<?php echo $peg_skill_add->u_by->editAttributes() ?>>
</span>
<?php echo $peg_skill_add->u_by->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$peg_skill_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $peg_skill_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $peg_skill_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$peg_skill_add->showPageFooter();
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
$peg_skill_add->terminate();
?>