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
$peg_keluarga_add = new peg_keluarga_add();

// Run the page
$peg_keluarga_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$peg_keluarga_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpeg_keluargaadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fpeg_keluargaadd = currentForm = new ew.Form("fpeg_keluargaadd", "add");

	// Validate form
	fpeg_keluargaadd.validate = function() {
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
			<?php if ($peg_keluarga_add->pid->Required) { ?>
				elm = this.getElements("x" + infix + "_pid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $peg_keluarga_add->pid->caption(), $peg_keluarga_add->pid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pid");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($peg_keluarga_add->pid->errorMessage()) ?>");
			<?php if ($peg_keluarga_add->nama->Required) { ?>
				elm = this.getElements("x" + infix + "_nama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $peg_keluarga_add->nama->caption(), $peg_keluarga_add->nama->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($peg_keluarga_add->hp->Required) { ?>
				elm = this.getElements("x" + infix + "_hp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $peg_keluarga_add->hp->caption(), $peg_keluarga_add->hp->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($peg_keluarga_add->hubungan->Required) { ?>
				elm = this.getElements("x" + infix + "_hubungan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $peg_keluarga_add->hubungan->caption(), $peg_keluarga_add->hubungan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($peg_keluarga_add->tgl_lahir->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_lahir");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $peg_keluarga_add->tgl_lahir->caption(), $peg_keluarga_add->tgl_lahir->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_lahir");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($peg_keluarga_add->tgl_lahir->errorMessage()) ?>");
			<?php if ($peg_keluarga_add->keterangan->Required) { ?>
				elm = this.getElements("x" + infix + "_keterangan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $peg_keluarga_add->keterangan->caption(), $peg_keluarga_add->keterangan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($peg_keluarga_add->jen_kel->Required) { ?>
				elm = this.getElements("x" + infix + "_jen_kel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $peg_keluarga_add->jen_kel->caption(), $peg_keluarga_add->jen_kel->RequiredErrorMessage)) ?>");
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
	fpeg_keluargaadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpeg_keluargaadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fpeg_keluargaadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $peg_keluarga_add->showPageHeader(); ?>
<?php
$peg_keluarga_add->showMessage();
?>
<form name="fpeg_keluargaadd" id="fpeg_keluargaadd" class="<?php echo $peg_keluarga_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="peg_keluarga">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$peg_keluarga_add->IsModal ?>">
<?php if ($peg_keluarga->getCurrentMasterTable() == "pegawai") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="pegawai">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($peg_keluarga_add->pid->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($peg_keluarga_add->pid->Visible) { // pid ?>
	<div id="r_pid" class="form-group row">
		<label id="elh_peg_keluarga_pid" for="x_pid" class="<?php echo $peg_keluarga_add->LeftColumnClass ?>"><?php echo $peg_keluarga_add->pid->caption() ?><?php echo $peg_keluarga_add->pid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $peg_keluarga_add->RightColumnClass ?>"><div <?php echo $peg_keluarga_add->pid->cellAttributes() ?>>
<?php if ($peg_keluarga_add->pid->getSessionValue() != "") { ?>
<span id="el_peg_keluarga_pid">
<span<?php echo $peg_keluarga_add->pid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($peg_keluarga_add->pid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_pid" name="x_pid" value="<?php echo HtmlEncode($peg_keluarga_add->pid->CurrentValue) ?>">
<?php } else { ?>
<span id="el_peg_keluarga_pid">
<input type="text" data-table="peg_keluarga" data-field="x_pid" name="x_pid" id="x_pid" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($peg_keluarga_add->pid->getPlaceHolder()) ?>" value="<?php echo $peg_keluarga_add->pid->EditValue ?>"<?php echo $peg_keluarga_add->pid->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $peg_keluarga_add->pid->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($peg_keluarga_add->nama->Visible) { // nama ?>
	<div id="r_nama" class="form-group row">
		<label id="elh_peg_keluarga_nama" for="x_nama" class="<?php echo $peg_keluarga_add->LeftColumnClass ?>"><?php echo $peg_keluarga_add->nama->caption() ?><?php echo $peg_keluarga_add->nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $peg_keluarga_add->RightColumnClass ?>"><div <?php echo $peg_keluarga_add->nama->cellAttributes() ?>>
<span id="el_peg_keluarga_nama">
<input type="text" data-table="peg_keluarga" data-field="x_nama" name="x_nama" id="x_nama" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($peg_keluarga_add->nama->getPlaceHolder()) ?>" value="<?php echo $peg_keluarga_add->nama->EditValue ?>"<?php echo $peg_keluarga_add->nama->editAttributes() ?>>
</span>
<?php echo $peg_keluarga_add->nama->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($peg_keluarga_add->hp->Visible) { // hp ?>
	<div id="r_hp" class="form-group row">
		<label id="elh_peg_keluarga_hp" for="x_hp" class="<?php echo $peg_keluarga_add->LeftColumnClass ?>"><?php echo $peg_keluarga_add->hp->caption() ?><?php echo $peg_keluarga_add->hp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $peg_keluarga_add->RightColumnClass ?>"><div <?php echo $peg_keluarga_add->hp->cellAttributes() ?>>
<span id="el_peg_keluarga_hp">
<input type="text" data-table="peg_keluarga" data-field="x_hp" name="x_hp" id="x_hp" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($peg_keluarga_add->hp->getPlaceHolder()) ?>" value="<?php echo $peg_keluarga_add->hp->EditValue ?>"<?php echo $peg_keluarga_add->hp->editAttributes() ?>>
</span>
<?php echo $peg_keluarga_add->hp->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($peg_keluarga_add->hubungan->Visible) { // hubungan ?>
	<div id="r_hubungan" class="form-group row">
		<label id="elh_peg_keluarga_hubungan" for="x_hubungan" class="<?php echo $peg_keluarga_add->LeftColumnClass ?>"><?php echo $peg_keluarga_add->hubungan->caption() ?><?php echo $peg_keluarga_add->hubungan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $peg_keluarga_add->RightColumnClass ?>"><div <?php echo $peg_keluarga_add->hubungan->cellAttributes() ?>>
<span id="el_peg_keluarga_hubungan">
<input type="text" data-table="peg_keluarga" data-field="x_hubungan" name="x_hubungan" id="x_hubungan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($peg_keluarga_add->hubungan->getPlaceHolder()) ?>" value="<?php echo $peg_keluarga_add->hubungan->EditValue ?>"<?php echo $peg_keluarga_add->hubungan->editAttributes() ?>>
</span>
<?php echo $peg_keluarga_add->hubungan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($peg_keluarga_add->tgl_lahir->Visible) { // tgl_lahir ?>
	<div id="r_tgl_lahir" class="form-group row">
		<label id="elh_peg_keluarga_tgl_lahir" for="x_tgl_lahir" class="<?php echo $peg_keluarga_add->LeftColumnClass ?>"><?php echo $peg_keluarga_add->tgl_lahir->caption() ?><?php echo $peg_keluarga_add->tgl_lahir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $peg_keluarga_add->RightColumnClass ?>"><div <?php echo $peg_keluarga_add->tgl_lahir->cellAttributes() ?>>
<span id="el_peg_keluarga_tgl_lahir">
<input type="text" data-table="peg_keluarga" data-field="x_tgl_lahir" name="x_tgl_lahir" id="x_tgl_lahir" maxlength="19" placeholder="<?php echo HtmlEncode($peg_keluarga_add->tgl_lahir->getPlaceHolder()) ?>" value="<?php echo $peg_keluarga_add->tgl_lahir->EditValue ?>"<?php echo $peg_keluarga_add->tgl_lahir->editAttributes() ?>>
<?php if (!$peg_keluarga_add->tgl_lahir->ReadOnly && !$peg_keluarga_add->tgl_lahir->Disabled && !isset($peg_keluarga_add->tgl_lahir->EditAttrs["readonly"]) && !isset($peg_keluarga_add->tgl_lahir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpeg_keluargaadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fpeg_keluargaadd", "x_tgl_lahir", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $peg_keluarga_add->tgl_lahir->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($peg_keluarga_add->keterangan->Visible) { // keterangan ?>
	<div id="r_keterangan" class="form-group row">
		<label id="elh_peg_keluarga_keterangan" for="x_keterangan" class="<?php echo $peg_keluarga_add->LeftColumnClass ?>"><?php echo $peg_keluarga_add->keterangan->caption() ?><?php echo $peg_keluarga_add->keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $peg_keluarga_add->RightColumnClass ?>"><div <?php echo $peg_keluarga_add->keterangan->cellAttributes() ?>>
<span id="el_peg_keluarga_keterangan">
<textarea data-table="peg_keluarga" data-field="x_keterangan" name="x_keterangan" id="x_keterangan" cols="35" rows="4" placeholder="<?php echo HtmlEncode($peg_keluarga_add->keterangan->getPlaceHolder()) ?>"<?php echo $peg_keluarga_add->keterangan->editAttributes() ?>><?php echo $peg_keluarga_add->keterangan->EditValue ?></textarea>
</span>
<?php echo $peg_keluarga_add->keterangan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($peg_keluarga_add->jen_kel->Visible) { // jen_kel ?>
	<div id="r_jen_kel" class="form-group row">
		<label id="elh_peg_keluarga_jen_kel" for="x_jen_kel" class="<?php echo $peg_keluarga_add->LeftColumnClass ?>"><?php echo $peg_keluarga_add->jen_kel->caption() ?><?php echo $peg_keluarga_add->jen_kel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $peg_keluarga_add->RightColumnClass ?>"><div <?php echo $peg_keluarga_add->jen_kel->cellAttributes() ?>>
<span id="el_peg_keluarga_jen_kel">
<input type="text" data-table="peg_keluarga" data-field="x_jen_kel" name="x_jen_kel" id="x_jen_kel" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($peg_keluarga_add->jen_kel->getPlaceHolder()) ?>" value="<?php echo $peg_keluarga_add->jen_kel->EditValue ?>"<?php echo $peg_keluarga_add->jen_kel->editAttributes() ?>>
</span>
<?php echo $peg_keluarga_add->jen_kel->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$peg_keluarga_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $peg_keluarga_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $peg_keluarga_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$peg_keluarga_add->showPageFooter();
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
$peg_keluarga_add->terminate();
?>