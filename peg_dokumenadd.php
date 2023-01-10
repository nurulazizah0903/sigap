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
$peg_dokumen_add = new peg_dokumen_add();

// Run the page
$peg_dokumen_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$peg_dokumen_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpeg_dokumenadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fpeg_dokumenadd = currentForm = new ew.Form("fpeg_dokumenadd", "add");

	// Validate form
	fpeg_dokumenadd.validate = function() {
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
			<?php if ($peg_dokumen_add->pid->Required) { ?>
				elm = this.getElements("x" + infix + "_pid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $peg_dokumen_add->pid->caption(), $peg_dokumen_add->pid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pid");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($peg_dokumen_add->pid->errorMessage()) ?>");
			<?php if ($peg_dokumen_add->nama_dokumen->Required) { ?>
				elm = this.getElements("x" + infix + "_nama_dokumen");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $peg_dokumen_add->nama_dokumen->caption(), $peg_dokumen_add->nama_dokumen->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($peg_dokumen_add->file_dokumen->Required) { ?>
				elm = this.getElements("x" + infix + "_file_dokumen");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $peg_dokumen_add->file_dokumen->caption(), $peg_dokumen_add->file_dokumen->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($peg_dokumen_add->keterangan->Required) { ?>
				elm = this.getElements("x" + infix + "_keterangan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $peg_dokumen_add->keterangan->caption(), $peg_dokumen_add->keterangan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($peg_dokumen_add->c_date->Required) { ?>
				elm = this.getElements("x" + infix + "_c_date");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $peg_dokumen_add->c_date->caption(), $peg_dokumen_add->c_date->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_c_date");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($peg_dokumen_add->c_date->errorMessage()) ?>");
			<?php if ($peg_dokumen_add->u_date->Required) { ?>
				elm = this.getElements("x" + infix + "_u_date");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $peg_dokumen_add->u_date->caption(), $peg_dokumen_add->u_date->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_u_date");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($peg_dokumen_add->u_date->errorMessage()) ?>");
			<?php if ($peg_dokumen_add->c_by->Required) { ?>
				elm = this.getElements("x" + infix + "_c_by");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $peg_dokumen_add->c_by->caption(), $peg_dokumen_add->c_by->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_c_by");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($peg_dokumen_add->c_by->errorMessage()) ?>");
			<?php if ($peg_dokumen_add->u_by->Required) { ?>
				elm = this.getElements("x" + infix + "_u_by");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $peg_dokumen_add->u_by->caption(), $peg_dokumen_add->u_by->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_u_by");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($peg_dokumen_add->u_by->errorMessage()) ?>");

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
	fpeg_dokumenadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpeg_dokumenadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fpeg_dokumenadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $peg_dokumen_add->showPageHeader(); ?>
<?php
$peg_dokumen_add->showMessage();
?>
<form name="fpeg_dokumenadd" id="fpeg_dokumenadd" class="<?php echo $peg_dokumen_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="peg_dokumen">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$peg_dokumen_add->IsModal ?>">
<?php if ($peg_dokumen->getCurrentMasterTable() == "pegawai") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="pegawai">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($peg_dokumen_add->pid->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($peg_dokumen_add->pid->Visible) { // pid ?>
	<div id="r_pid" class="form-group row">
		<label id="elh_peg_dokumen_pid" for="x_pid" class="<?php echo $peg_dokumen_add->LeftColumnClass ?>"><?php echo $peg_dokumen_add->pid->caption() ?><?php echo $peg_dokumen_add->pid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $peg_dokumen_add->RightColumnClass ?>"><div <?php echo $peg_dokumen_add->pid->cellAttributes() ?>>
<?php if ($peg_dokumen_add->pid->getSessionValue() != "") { ?>
<span id="el_peg_dokumen_pid">
<span<?php echo $peg_dokumen_add->pid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($peg_dokumen_add->pid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_pid" name="x_pid" value="<?php echo HtmlEncode($peg_dokumen_add->pid->CurrentValue) ?>">
<?php } else { ?>
<span id="el_peg_dokumen_pid">
<input type="text" data-table="peg_dokumen" data-field="x_pid" name="x_pid" id="x_pid" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($peg_dokumen_add->pid->getPlaceHolder()) ?>" value="<?php echo $peg_dokumen_add->pid->EditValue ?>"<?php echo $peg_dokumen_add->pid->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $peg_dokumen_add->pid->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($peg_dokumen_add->nama_dokumen->Visible) { // nama_dokumen ?>
	<div id="r_nama_dokumen" class="form-group row">
		<label id="elh_peg_dokumen_nama_dokumen" for="x_nama_dokumen" class="<?php echo $peg_dokumen_add->LeftColumnClass ?>"><?php echo $peg_dokumen_add->nama_dokumen->caption() ?><?php echo $peg_dokumen_add->nama_dokumen->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $peg_dokumen_add->RightColumnClass ?>"><div <?php echo $peg_dokumen_add->nama_dokumen->cellAttributes() ?>>
<span id="el_peg_dokumen_nama_dokumen">
<input type="text" data-table="peg_dokumen" data-field="x_nama_dokumen" name="x_nama_dokumen" id="x_nama_dokumen" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($peg_dokumen_add->nama_dokumen->getPlaceHolder()) ?>" value="<?php echo $peg_dokumen_add->nama_dokumen->EditValue ?>"<?php echo $peg_dokumen_add->nama_dokumen->editAttributes() ?>>
</span>
<?php echo $peg_dokumen_add->nama_dokumen->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($peg_dokumen_add->file_dokumen->Visible) { // file_dokumen ?>
	<div id="r_file_dokumen" class="form-group row">
		<label id="elh_peg_dokumen_file_dokumen" for="x_file_dokumen" class="<?php echo $peg_dokumen_add->LeftColumnClass ?>"><?php echo $peg_dokumen_add->file_dokumen->caption() ?><?php echo $peg_dokumen_add->file_dokumen->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $peg_dokumen_add->RightColumnClass ?>"><div <?php echo $peg_dokumen_add->file_dokumen->cellAttributes() ?>>
<span id="el_peg_dokumen_file_dokumen">
<input type="text" data-table="peg_dokumen" data-field="x_file_dokumen" name="x_file_dokumen" id="x_file_dokumen" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($peg_dokumen_add->file_dokumen->getPlaceHolder()) ?>" value="<?php echo $peg_dokumen_add->file_dokumen->EditValue ?>"<?php echo $peg_dokumen_add->file_dokumen->editAttributes() ?>>
</span>
<?php echo $peg_dokumen_add->file_dokumen->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($peg_dokumen_add->keterangan->Visible) { // keterangan ?>
	<div id="r_keterangan" class="form-group row">
		<label id="elh_peg_dokumen_keterangan" for="x_keterangan" class="<?php echo $peg_dokumen_add->LeftColumnClass ?>"><?php echo $peg_dokumen_add->keterangan->caption() ?><?php echo $peg_dokumen_add->keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $peg_dokumen_add->RightColumnClass ?>"><div <?php echo $peg_dokumen_add->keterangan->cellAttributes() ?>>
<span id="el_peg_dokumen_keterangan">
<input type="text" data-table="peg_dokumen" data-field="x_keterangan" name="x_keterangan" id="x_keterangan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($peg_dokumen_add->keterangan->getPlaceHolder()) ?>" value="<?php echo $peg_dokumen_add->keterangan->EditValue ?>"<?php echo $peg_dokumen_add->keterangan->editAttributes() ?>>
</span>
<?php echo $peg_dokumen_add->keterangan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($peg_dokumen_add->c_date->Visible) { // c_date ?>
	<div id="r_c_date" class="form-group row">
		<label id="elh_peg_dokumen_c_date" for="x_c_date" class="<?php echo $peg_dokumen_add->LeftColumnClass ?>"><?php echo $peg_dokumen_add->c_date->caption() ?><?php echo $peg_dokumen_add->c_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $peg_dokumen_add->RightColumnClass ?>"><div <?php echo $peg_dokumen_add->c_date->cellAttributes() ?>>
<span id="el_peg_dokumen_c_date">
<input type="text" data-table="peg_dokumen" data-field="x_c_date" name="x_c_date" id="x_c_date" maxlength="19" placeholder="<?php echo HtmlEncode($peg_dokumen_add->c_date->getPlaceHolder()) ?>" value="<?php echo $peg_dokumen_add->c_date->EditValue ?>"<?php echo $peg_dokumen_add->c_date->editAttributes() ?>>
<?php if (!$peg_dokumen_add->c_date->ReadOnly && !$peg_dokumen_add->c_date->Disabled && !isset($peg_dokumen_add->c_date->EditAttrs["readonly"]) && !isset($peg_dokumen_add->c_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpeg_dokumenadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fpeg_dokumenadd", "x_c_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $peg_dokumen_add->c_date->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($peg_dokumen_add->u_date->Visible) { // u_date ?>
	<div id="r_u_date" class="form-group row">
		<label id="elh_peg_dokumen_u_date" for="x_u_date" class="<?php echo $peg_dokumen_add->LeftColumnClass ?>"><?php echo $peg_dokumen_add->u_date->caption() ?><?php echo $peg_dokumen_add->u_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $peg_dokumen_add->RightColumnClass ?>"><div <?php echo $peg_dokumen_add->u_date->cellAttributes() ?>>
<span id="el_peg_dokumen_u_date">
<input type="text" data-table="peg_dokumen" data-field="x_u_date" name="x_u_date" id="x_u_date" maxlength="19" placeholder="<?php echo HtmlEncode($peg_dokumen_add->u_date->getPlaceHolder()) ?>" value="<?php echo $peg_dokumen_add->u_date->EditValue ?>"<?php echo $peg_dokumen_add->u_date->editAttributes() ?>>
<?php if (!$peg_dokumen_add->u_date->ReadOnly && !$peg_dokumen_add->u_date->Disabled && !isset($peg_dokumen_add->u_date->EditAttrs["readonly"]) && !isset($peg_dokumen_add->u_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpeg_dokumenadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fpeg_dokumenadd", "x_u_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $peg_dokumen_add->u_date->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($peg_dokumen_add->c_by->Visible) { // c_by ?>
	<div id="r_c_by" class="form-group row">
		<label id="elh_peg_dokumen_c_by" for="x_c_by" class="<?php echo $peg_dokumen_add->LeftColumnClass ?>"><?php echo $peg_dokumen_add->c_by->caption() ?><?php echo $peg_dokumen_add->c_by->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $peg_dokumen_add->RightColumnClass ?>"><div <?php echo $peg_dokumen_add->c_by->cellAttributes() ?>>
<span id="el_peg_dokumen_c_by">
<input type="text" data-table="peg_dokumen" data-field="x_c_by" name="x_c_by" id="x_c_by" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($peg_dokumen_add->c_by->getPlaceHolder()) ?>" value="<?php echo $peg_dokumen_add->c_by->EditValue ?>"<?php echo $peg_dokumen_add->c_by->editAttributes() ?>>
</span>
<?php echo $peg_dokumen_add->c_by->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($peg_dokumen_add->u_by->Visible) { // u_by ?>
	<div id="r_u_by" class="form-group row">
		<label id="elh_peg_dokumen_u_by" for="x_u_by" class="<?php echo $peg_dokumen_add->LeftColumnClass ?>"><?php echo $peg_dokumen_add->u_by->caption() ?><?php echo $peg_dokumen_add->u_by->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $peg_dokumen_add->RightColumnClass ?>"><div <?php echo $peg_dokumen_add->u_by->cellAttributes() ?>>
<span id="el_peg_dokumen_u_by">
<input type="text" data-table="peg_dokumen" data-field="x_u_by" name="x_u_by" id="x_u_by" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($peg_dokumen_add->u_by->getPlaceHolder()) ?>" value="<?php echo $peg_dokumen_add->u_by->EditValue ?>"<?php echo $peg_dokumen_add->u_by->editAttributes() ?>>
</span>
<?php echo $peg_dokumen_add->u_by->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$peg_dokumen_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $peg_dokumen_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $peg_dokumen_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$peg_dokumen_add->showPageFooter();
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
$peg_dokumen_add->terminate();
?>