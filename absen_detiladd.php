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
$absen_detil_add = new absen_detil_add();

// Run the page
$absen_detil_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$absen_detil_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fabsen_detiladd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fabsen_detiladd = currentForm = new ew.Form("fabsen_detiladd", "add");

	// Validate form
	fabsen_detiladd.validate = function() {
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
			<?php if ($absen_detil_add->pid->Required) { ?>
				elm = this.getElements("x" + infix + "_pid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $absen_detil_add->pid->caption(), $absen_detil_add->pid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pid");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($absen_detil_add->pid->errorMessage()) ?>");
			<?php if ($absen_detil_add->pegawai->Required) { ?>
				elm = this.getElements("x" + infix + "_pegawai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $absen_detil_add->pegawai->caption(), $absen_detil_add->pegawai->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pegawai");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($absen_detil_add->pegawai->errorMessage()) ?>");
			<?php if ($absen_detil_add->masuk->Required) { ?>
				elm = this.getElements("x" + infix + "_masuk");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $absen_detil_add->masuk->caption(), $absen_detil_add->masuk->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_masuk");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($absen_detil_add->masuk->errorMessage()) ?>");
			<?php if ($absen_detil_add->absen->Required) { ?>
				elm = this.getElements("x" + infix + "_absen");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $absen_detil_add->absen->caption(), $absen_detil_add->absen->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_absen");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($absen_detil_add->absen->errorMessage()) ?>");
			<?php if ($absen_detil_add->ijin->Required) { ?>
				elm = this.getElements("x" + infix + "_ijin");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $absen_detil_add->ijin->caption(), $absen_detil_add->ijin->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ijin");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($absen_detil_add->ijin->errorMessage()) ?>");
			<?php if ($absen_detil_add->cuti->Required) { ?>
				elm = this.getElements("x" + infix + "_cuti");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $absen_detil_add->cuti->caption(), $absen_detil_add->cuti->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_cuti");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($absen_detil_add->cuti->errorMessage()) ?>");
			<?php if ($absen_detil_add->dinas_luar->Required) { ?>
				elm = this.getElements("x" + infix + "_dinas_luar");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $absen_detil_add->dinas_luar->caption(), $absen_detil_add->dinas_luar->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_dinas_luar");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($absen_detil_add->dinas_luar->errorMessage()) ?>");
			<?php if ($absen_detil_add->terlambat->Required) { ?>
				elm = this.getElements("x" + infix + "_terlambat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $absen_detil_add->terlambat->caption(), $absen_detil_add->terlambat->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_terlambat");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($absen_detil_add->terlambat->errorMessage()) ?>");

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
	fabsen_detiladd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fabsen_detiladd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fabsen_detiladd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $absen_detil_add->showPageHeader(); ?>
<?php
$absen_detil_add->showMessage();
?>
<form name="fabsen_detiladd" id="fabsen_detiladd" class="<?php echo $absen_detil_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="absen_detil">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$absen_detil_add->IsModal ?>">
<?php if ($absen_detil->getCurrentMasterTable() == "absen") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="absen">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($absen_detil_add->pid->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($absen_detil_add->pid->Visible) { // pid ?>
	<div id="r_pid" class="form-group row">
		<label id="elh_absen_detil_pid" for="x_pid" class="<?php echo $absen_detil_add->LeftColumnClass ?>"><?php echo $absen_detil_add->pid->caption() ?><?php echo $absen_detil_add->pid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $absen_detil_add->RightColumnClass ?>"><div <?php echo $absen_detil_add->pid->cellAttributes() ?>>
<?php if ($absen_detil_add->pid->getSessionValue() != "") { ?>
<span id="el_absen_detil_pid">
<span<?php echo $absen_detil_add->pid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($absen_detil_add->pid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_pid" name="x_pid" value="<?php echo HtmlEncode($absen_detil_add->pid->CurrentValue) ?>">
<?php } else { ?>
<span id="el_absen_detil_pid">
<input type="text" data-table="absen_detil" data-field="x_pid" name="x_pid" id="x_pid" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($absen_detil_add->pid->getPlaceHolder()) ?>" value="<?php echo $absen_detil_add->pid->EditValue ?>"<?php echo $absen_detil_add->pid->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $absen_detil_add->pid->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($absen_detil_add->pegawai->Visible) { // pegawai ?>
	<div id="r_pegawai" class="form-group row">
		<label id="elh_absen_detil_pegawai" for="x_pegawai" class="<?php echo $absen_detil_add->LeftColumnClass ?>"><?php echo $absen_detil_add->pegawai->caption() ?><?php echo $absen_detil_add->pegawai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $absen_detil_add->RightColumnClass ?>"><div <?php echo $absen_detil_add->pegawai->cellAttributes() ?>>
<span id="el_absen_detil_pegawai">
<input type="text" data-table="absen_detil" data-field="x_pegawai" name="x_pegawai" id="x_pegawai" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($absen_detil_add->pegawai->getPlaceHolder()) ?>" value="<?php echo $absen_detil_add->pegawai->EditValue ?>"<?php echo $absen_detil_add->pegawai->editAttributes() ?>>
</span>
<?php echo $absen_detil_add->pegawai->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($absen_detil_add->masuk->Visible) { // masuk ?>
	<div id="r_masuk" class="form-group row">
		<label id="elh_absen_detil_masuk" for="x_masuk" class="<?php echo $absen_detil_add->LeftColumnClass ?>"><?php echo $absen_detil_add->masuk->caption() ?><?php echo $absen_detil_add->masuk->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $absen_detil_add->RightColumnClass ?>"><div <?php echo $absen_detil_add->masuk->cellAttributes() ?>>
<span id="el_absen_detil_masuk">
<input type="text" data-table="absen_detil" data-field="x_masuk" name="x_masuk" id="x_masuk" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($absen_detil_add->masuk->getPlaceHolder()) ?>" value="<?php echo $absen_detil_add->masuk->EditValue ?>"<?php echo $absen_detil_add->masuk->editAttributes() ?>>
</span>
<?php echo $absen_detil_add->masuk->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($absen_detil_add->absen->Visible) { // absen ?>
	<div id="r_absen" class="form-group row">
		<label id="elh_absen_detil_absen" for="x_absen" class="<?php echo $absen_detil_add->LeftColumnClass ?>"><?php echo $absen_detil_add->absen->caption() ?><?php echo $absen_detil_add->absen->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $absen_detil_add->RightColumnClass ?>"><div <?php echo $absen_detil_add->absen->cellAttributes() ?>>
<span id="el_absen_detil_absen">
<input type="text" data-table="absen_detil" data-field="x_absen" name="x_absen" id="x_absen" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($absen_detil_add->absen->getPlaceHolder()) ?>" value="<?php echo $absen_detil_add->absen->EditValue ?>"<?php echo $absen_detil_add->absen->editAttributes() ?>>
</span>
<?php echo $absen_detil_add->absen->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($absen_detil_add->ijin->Visible) { // ijin ?>
	<div id="r_ijin" class="form-group row">
		<label id="elh_absen_detil_ijin" for="x_ijin" class="<?php echo $absen_detil_add->LeftColumnClass ?>"><?php echo $absen_detil_add->ijin->caption() ?><?php echo $absen_detil_add->ijin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $absen_detil_add->RightColumnClass ?>"><div <?php echo $absen_detil_add->ijin->cellAttributes() ?>>
<span id="el_absen_detil_ijin">
<input type="text" data-table="absen_detil" data-field="x_ijin" name="x_ijin" id="x_ijin" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($absen_detil_add->ijin->getPlaceHolder()) ?>" value="<?php echo $absen_detil_add->ijin->EditValue ?>"<?php echo $absen_detil_add->ijin->editAttributes() ?>>
</span>
<?php echo $absen_detil_add->ijin->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($absen_detil_add->cuti->Visible) { // cuti ?>
	<div id="r_cuti" class="form-group row">
		<label id="elh_absen_detil_cuti" for="x_cuti" class="<?php echo $absen_detil_add->LeftColumnClass ?>"><?php echo $absen_detil_add->cuti->caption() ?><?php echo $absen_detil_add->cuti->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $absen_detil_add->RightColumnClass ?>"><div <?php echo $absen_detil_add->cuti->cellAttributes() ?>>
<span id="el_absen_detil_cuti">
<input type="text" data-table="absen_detil" data-field="x_cuti" name="x_cuti" id="x_cuti" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($absen_detil_add->cuti->getPlaceHolder()) ?>" value="<?php echo $absen_detil_add->cuti->EditValue ?>"<?php echo $absen_detil_add->cuti->editAttributes() ?>>
</span>
<?php echo $absen_detil_add->cuti->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($absen_detil_add->dinas_luar->Visible) { // dinas_luar ?>
	<div id="r_dinas_luar" class="form-group row">
		<label id="elh_absen_detil_dinas_luar" for="x_dinas_luar" class="<?php echo $absen_detil_add->LeftColumnClass ?>"><?php echo $absen_detil_add->dinas_luar->caption() ?><?php echo $absen_detil_add->dinas_luar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $absen_detil_add->RightColumnClass ?>"><div <?php echo $absen_detil_add->dinas_luar->cellAttributes() ?>>
<span id="el_absen_detil_dinas_luar">
<input type="text" data-table="absen_detil" data-field="x_dinas_luar" name="x_dinas_luar" id="x_dinas_luar" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($absen_detil_add->dinas_luar->getPlaceHolder()) ?>" value="<?php echo $absen_detil_add->dinas_luar->EditValue ?>"<?php echo $absen_detil_add->dinas_luar->editAttributes() ?>>
</span>
<?php echo $absen_detil_add->dinas_luar->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($absen_detil_add->terlambat->Visible) { // terlambat ?>
	<div id="r_terlambat" class="form-group row">
		<label id="elh_absen_detil_terlambat" for="x_terlambat" class="<?php echo $absen_detil_add->LeftColumnClass ?>"><?php echo $absen_detil_add->terlambat->caption() ?><?php echo $absen_detil_add->terlambat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $absen_detil_add->RightColumnClass ?>"><div <?php echo $absen_detil_add->terlambat->cellAttributes() ?>>
<span id="el_absen_detil_terlambat">
<input type="text" data-table="absen_detil" data-field="x_terlambat" name="x_terlambat" id="x_terlambat" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($absen_detil_add->terlambat->getPlaceHolder()) ?>" value="<?php echo $absen_detil_add->terlambat->EditValue ?>"<?php echo $absen_detil_add->terlambat->editAttributes() ?>>
</span>
<?php echo $absen_detil_add->terlambat->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$absen_detil_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $absen_detil_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $absen_detil_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$absen_detil_add->showPageFooter();
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
$absen_detil_add->terminate();
?>