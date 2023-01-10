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
$peg_keluarga_edit = new peg_keluarga_edit();

// Run the page
$peg_keluarga_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$peg_keluarga_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpeg_keluargaedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fpeg_keluargaedit = currentForm = new ew.Form("fpeg_keluargaedit", "edit");

	// Validate form
	fpeg_keluargaedit.validate = function() {
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
			<?php if ($peg_keluarga_edit->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $peg_keluarga_edit->id->caption(), $peg_keluarga_edit->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($peg_keluarga_edit->pid->Required) { ?>
				elm = this.getElements("x" + infix + "_pid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $peg_keluarga_edit->pid->caption(), $peg_keluarga_edit->pid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pid");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($peg_keluarga_edit->pid->errorMessage()) ?>");
			<?php if ($peg_keluarga_edit->nama->Required) { ?>
				elm = this.getElements("x" + infix + "_nama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $peg_keluarga_edit->nama->caption(), $peg_keluarga_edit->nama->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($peg_keluarga_edit->hp->Required) { ?>
				elm = this.getElements("x" + infix + "_hp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $peg_keluarga_edit->hp->caption(), $peg_keluarga_edit->hp->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($peg_keluarga_edit->hubungan->Required) { ?>
				elm = this.getElements("x" + infix + "_hubungan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $peg_keluarga_edit->hubungan->caption(), $peg_keluarga_edit->hubungan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($peg_keluarga_edit->tgl_lahir->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_lahir");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $peg_keluarga_edit->tgl_lahir->caption(), $peg_keluarga_edit->tgl_lahir->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_lahir");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($peg_keluarga_edit->tgl_lahir->errorMessage()) ?>");
			<?php if ($peg_keluarga_edit->keterangan->Required) { ?>
				elm = this.getElements("x" + infix + "_keterangan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $peg_keluarga_edit->keterangan->caption(), $peg_keluarga_edit->keterangan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($peg_keluarga_edit->jen_kel->Required) { ?>
				elm = this.getElements("x" + infix + "_jen_kel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $peg_keluarga_edit->jen_kel->caption(), $peg_keluarga_edit->jen_kel->RequiredErrorMessage)) ?>");
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
	fpeg_keluargaedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpeg_keluargaedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fpeg_keluargaedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $peg_keluarga_edit->showPageHeader(); ?>
<?php
$peg_keluarga_edit->showMessage();
?>
<form name="fpeg_keluargaedit" id="fpeg_keluargaedit" class="<?php echo $peg_keluarga_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="peg_keluarga">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$peg_keluarga_edit->IsModal ?>">
<?php if ($peg_keluarga->getCurrentMasterTable() == "pegawai") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="pegawai">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($peg_keluarga_edit->pid->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($peg_keluarga_edit->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_peg_keluarga_id" class="<?php echo $peg_keluarga_edit->LeftColumnClass ?>"><?php echo $peg_keluarga_edit->id->caption() ?><?php echo $peg_keluarga_edit->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $peg_keluarga_edit->RightColumnClass ?>"><div <?php echo $peg_keluarga_edit->id->cellAttributes() ?>>
<span id="el_peg_keluarga_id">
<span<?php echo $peg_keluarga_edit->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($peg_keluarga_edit->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="peg_keluarga" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($peg_keluarga_edit->id->CurrentValue) ?>">
<?php echo $peg_keluarga_edit->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($peg_keluarga_edit->pid->Visible) { // pid ?>
	<div id="r_pid" class="form-group row">
		<label id="elh_peg_keluarga_pid" for="x_pid" class="<?php echo $peg_keluarga_edit->LeftColumnClass ?>"><?php echo $peg_keluarga_edit->pid->caption() ?><?php echo $peg_keluarga_edit->pid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $peg_keluarga_edit->RightColumnClass ?>"><div <?php echo $peg_keluarga_edit->pid->cellAttributes() ?>>
<?php if ($peg_keluarga_edit->pid->getSessionValue() != "") { ?>
<span id="el_peg_keluarga_pid">
<span<?php echo $peg_keluarga_edit->pid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($peg_keluarga_edit->pid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_pid" name="x_pid" value="<?php echo HtmlEncode($peg_keluarga_edit->pid->CurrentValue) ?>">
<?php } else { ?>
<span id="el_peg_keluarga_pid">
<input type="text" data-table="peg_keluarga" data-field="x_pid" name="x_pid" id="x_pid" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($peg_keluarga_edit->pid->getPlaceHolder()) ?>" value="<?php echo $peg_keluarga_edit->pid->EditValue ?>"<?php echo $peg_keluarga_edit->pid->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $peg_keluarga_edit->pid->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($peg_keluarga_edit->nama->Visible) { // nama ?>
	<div id="r_nama" class="form-group row">
		<label id="elh_peg_keluarga_nama" for="x_nama" class="<?php echo $peg_keluarga_edit->LeftColumnClass ?>"><?php echo $peg_keluarga_edit->nama->caption() ?><?php echo $peg_keluarga_edit->nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $peg_keluarga_edit->RightColumnClass ?>"><div <?php echo $peg_keluarga_edit->nama->cellAttributes() ?>>
<span id="el_peg_keluarga_nama">
<input type="text" data-table="peg_keluarga" data-field="x_nama" name="x_nama" id="x_nama" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($peg_keluarga_edit->nama->getPlaceHolder()) ?>" value="<?php echo $peg_keluarga_edit->nama->EditValue ?>"<?php echo $peg_keluarga_edit->nama->editAttributes() ?>>
</span>
<?php echo $peg_keluarga_edit->nama->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($peg_keluarga_edit->hp->Visible) { // hp ?>
	<div id="r_hp" class="form-group row">
		<label id="elh_peg_keluarga_hp" for="x_hp" class="<?php echo $peg_keluarga_edit->LeftColumnClass ?>"><?php echo $peg_keluarga_edit->hp->caption() ?><?php echo $peg_keluarga_edit->hp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $peg_keluarga_edit->RightColumnClass ?>"><div <?php echo $peg_keluarga_edit->hp->cellAttributes() ?>>
<span id="el_peg_keluarga_hp">
<input type="text" data-table="peg_keluarga" data-field="x_hp" name="x_hp" id="x_hp" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($peg_keluarga_edit->hp->getPlaceHolder()) ?>" value="<?php echo $peg_keluarga_edit->hp->EditValue ?>"<?php echo $peg_keluarga_edit->hp->editAttributes() ?>>
</span>
<?php echo $peg_keluarga_edit->hp->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($peg_keluarga_edit->hubungan->Visible) { // hubungan ?>
	<div id="r_hubungan" class="form-group row">
		<label id="elh_peg_keluarga_hubungan" for="x_hubungan" class="<?php echo $peg_keluarga_edit->LeftColumnClass ?>"><?php echo $peg_keluarga_edit->hubungan->caption() ?><?php echo $peg_keluarga_edit->hubungan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $peg_keluarga_edit->RightColumnClass ?>"><div <?php echo $peg_keluarga_edit->hubungan->cellAttributes() ?>>
<span id="el_peg_keluarga_hubungan">
<input type="text" data-table="peg_keluarga" data-field="x_hubungan" name="x_hubungan" id="x_hubungan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($peg_keluarga_edit->hubungan->getPlaceHolder()) ?>" value="<?php echo $peg_keluarga_edit->hubungan->EditValue ?>"<?php echo $peg_keluarga_edit->hubungan->editAttributes() ?>>
</span>
<?php echo $peg_keluarga_edit->hubungan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($peg_keluarga_edit->tgl_lahir->Visible) { // tgl_lahir ?>
	<div id="r_tgl_lahir" class="form-group row">
		<label id="elh_peg_keluarga_tgl_lahir" for="x_tgl_lahir" class="<?php echo $peg_keluarga_edit->LeftColumnClass ?>"><?php echo $peg_keluarga_edit->tgl_lahir->caption() ?><?php echo $peg_keluarga_edit->tgl_lahir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $peg_keluarga_edit->RightColumnClass ?>"><div <?php echo $peg_keluarga_edit->tgl_lahir->cellAttributes() ?>>
<span id="el_peg_keluarga_tgl_lahir">
<input type="text" data-table="peg_keluarga" data-field="x_tgl_lahir" name="x_tgl_lahir" id="x_tgl_lahir" maxlength="19" placeholder="<?php echo HtmlEncode($peg_keluarga_edit->tgl_lahir->getPlaceHolder()) ?>" value="<?php echo $peg_keluarga_edit->tgl_lahir->EditValue ?>"<?php echo $peg_keluarga_edit->tgl_lahir->editAttributes() ?>>
<?php if (!$peg_keluarga_edit->tgl_lahir->ReadOnly && !$peg_keluarga_edit->tgl_lahir->Disabled && !isset($peg_keluarga_edit->tgl_lahir->EditAttrs["readonly"]) && !isset($peg_keluarga_edit->tgl_lahir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpeg_keluargaedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fpeg_keluargaedit", "x_tgl_lahir", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $peg_keluarga_edit->tgl_lahir->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($peg_keluarga_edit->keterangan->Visible) { // keterangan ?>
	<div id="r_keterangan" class="form-group row">
		<label id="elh_peg_keluarga_keterangan" for="x_keterangan" class="<?php echo $peg_keluarga_edit->LeftColumnClass ?>"><?php echo $peg_keluarga_edit->keterangan->caption() ?><?php echo $peg_keluarga_edit->keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $peg_keluarga_edit->RightColumnClass ?>"><div <?php echo $peg_keluarga_edit->keterangan->cellAttributes() ?>>
<span id="el_peg_keluarga_keterangan">
<textarea data-table="peg_keluarga" data-field="x_keterangan" name="x_keterangan" id="x_keterangan" cols="35" rows="4" placeholder="<?php echo HtmlEncode($peg_keluarga_edit->keterangan->getPlaceHolder()) ?>"<?php echo $peg_keluarga_edit->keterangan->editAttributes() ?>><?php echo $peg_keluarga_edit->keterangan->EditValue ?></textarea>
</span>
<?php echo $peg_keluarga_edit->keterangan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($peg_keluarga_edit->jen_kel->Visible) { // jen_kel ?>
	<div id="r_jen_kel" class="form-group row">
		<label id="elh_peg_keluarga_jen_kel" for="x_jen_kel" class="<?php echo $peg_keluarga_edit->LeftColumnClass ?>"><?php echo $peg_keluarga_edit->jen_kel->caption() ?><?php echo $peg_keluarga_edit->jen_kel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $peg_keluarga_edit->RightColumnClass ?>"><div <?php echo $peg_keluarga_edit->jen_kel->cellAttributes() ?>>
<span id="el_peg_keluarga_jen_kel">
<input type="text" data-table="peg_keluarga" data-field="x_jen_kel" name="x_jen_kel" id="x_jen_kel" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($peg_keluarga_edit->jen_kel->getPlaceHolder()) ?>" value="<?php echo $peg_keluarga_edit->jen_kel->EditValue ?>"<?php echo $peg_keluarga_edit->jen_kel->editAttributes() ?>>
</span>
<?php echo $peg_keluarga_edit->jen_kel->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$peg_keluarga_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $peg_keluarga_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $peg_keluarga_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$peg_keluarga_edit->showPageFooter();
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
$peg_keluarga_edit->terminate();
?>