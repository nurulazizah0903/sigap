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
$m_karyawan_tk_edit = new m_karyawan_tk_edit();

// Run the page
$m_karyawan_tk_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_karyawan_tk_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_karyawan_tkedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fm_karyawan_tkedit = currentForm = new ew.Form("fm_karyawan_tkedit", "edit");

	// Validate form
	fm_karyawan_tkedit.validate = function() {
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
			<?php if ($m_karyawan_tk_edit->datetime->Required) { ?>
				elm = this.getElements("x" + infix + "_datetime");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_karyawan_tk_edit->datetime->caption(), $m_karyawan_tk_edit->datetime->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_karyawan_tk_edit->createby->Required) { ?>
				elm = this.getElements("x" + infix + "_createby");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_karyawan_tk_edit->createby->caption(), $m_karyawan_tk_edit->createby->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_createby");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_karyawan_tk_edit->createby->errorMessage()) ?>");
			<?php if ($m_karyawan_tk_edit->tahun->Required) { ?>
				elm = this.getElements("x" + infix + "_tahun");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_karyawan_tk_edit->tahun->caption(), $m_karyawan_tk_edit->tahun->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tahun");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_karyawan_tk_edit->tahun->errorMessage()) ?>");
			<?php if ($m_karyawan_tk_edit->bulan->Required) { ?>
				elm = this.getElements("x" + infix + "_bulan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_karyawan_tk_edit->bulan->caption(), $m_karyawan_tk_edit->bulan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_bulan");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_karyawan_tk_edit->bulan->errorMessage()) ?>");

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
	fm_karyawan_tkedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fm_karyawan_tkedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fm_karyawan_tkedit.lists["x_createby"] = <?php echo $m_karyawan_tk_edit->createby->Lookup->toClientList($m_karyawan_tk_edit) ?>;
	fm_karyawan_tkedit.lists["x_createby"].options = <?php echo JsonEncode($m_karyawan_tk_edit->createby->lookupOptions()) ?>;
	fm_karyawan_tkedit.autoSuggests["x_createby"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fm_karyawan_tkedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_karyawan_tk_edit->showPageHeader(); ?>
<?php
$m_karyawan_tk_edit->showMessage();
?>
<form name="fm_karyawan_tkedit" id="fm_karyawan_tkedit" class="<?php echo $m_karyawan_tk_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_karyawan_tk">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$m_karyawan_tk_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($m_karyawan_tk_edit->createby->Visible) { // createby ?>
	<div id="r_createby" class="form-group row">
		<label id="elh_m_karyawan_tk_createby" class="<?php echo $m_karyawan_tk_edit->LeftColumnClass ?>"><?php echo $m_karyawan_tk_edit->createby->caption() ?><?php echo $m_karyawan_tk_edit->createby->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_karyawan_tk_edit->RightColumnClass ?>"><div <?php echo $m_karyawan_tk_edit->createby->cellAttributes() ?>>
<span id="el_m_karyawan_tk_createby">
<?php
$onchange = $m_karyawan_tk_edit->createby->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$m_karyawan_tk_edit->createby->EditAttrs["onchange"] = "";
?>
<span id="as_x_createby">
	<input type="text" class="form-control" name="sv_x_createby" id="sv_x_createby" value="<?php echo RemoveHtml($m_karyawan_tk_edit->createby->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($m_karyawan_tk_edit->createby->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($m_karyawan_tk_edit->createby->getPlaceHolder()) ?>"<?php echo $m_karyawan_tk_edit->createby->editAttributes() ?>>
</span>
<input type="hidden" data-table="m_karyawan_tk" data-field="x_createby" data-value-separator="<?php echo $m_karyawan_tk_edit->createby->displayValueSeparatorAttribute() ?>" name="x_createby" id="x_createby" value="<?php echo HtmlEncode($m_karyawan_tk_edit->createby->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fm_karyawan_tkedit"], function() {
	fm_karyawan_tkedit.createAutoSuggest({"id":"x_createby","forceSelect":false});
});
</script>
<?php echo $m_karyawan_tk_edit->createby->Lookup->getParamTag($m_karyawan_tk_edit, "p_x_createby") ?>
</span>
<?php echo $m_karyawan_tk_edit->createby->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_karyawan_tk_edit->tahun->Visible) { // tahun ?>
	<div id="r_tahun" class="form-group row">
		<label id="elh_m_karyawan_tk_tahun" for="x_tahun" class="<?php echo $m_karyawan_tk_edit->LeftColumnClass ?>"><?php echo $m_karyawan_tk_edit->tahun->caption() ?><?php echo $m_karyawan_tk_edit->tahun->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_karyawan_tk_edit->RightColumnClass ?>"><div <?php echo $m_karyawan_tk_edit->tahun->cellAttributes() ?>>
<span id="el_m_karyawan_tk_tahun">
<input type="text" data-table="m_karyawan_tk" data-field="x_tahun" name="x_tahun" id="x_tahun" size="30" maxlength="5" placeholder="<?php echo HtmlEncode($m_karyawan_tk_edit->tahun->getPlaceHolder()) ?>" value="<?php echo $m_karyawan_tk_edit->tahun->EditValue ?>"<?php echo $m_karyawan_tk_edit->tahun->editAttributes() ?>>
</span>
<?php echo $m_karyawan_tk_edit->tahun->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_karyawan_tk_edit->bulan->Visible) { // bulan ?>
	<div id="r_bulan" class="form-group row">
		<label id="elh_m_karyawan_tk_bulan" for="x_bulan" class="<?php echo $m_karyawan_tk_edit->LeftColumnClass ?>"><?php echo $m_karyawan_tk_edit->bulan->caption() ?><?php echo $m_karyawan_tk_edit->bulan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_karyawan_tk_edit->RightColumnClass ?>"><div <?php echo $m_karyawan_tk_edit->bulan->cellAttributes() ?>>
<span id="el_m_karyawan_tk_bulan">
<input type="text" data-table="m_karyawan_tk" data-field="x_bulan" name="x_bulan" id="x_bulan" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($m_karyawan_tk_edit->bulan->getPlaceHolder()) ?>" value="<?php echo $m_karyawan_tk_edit->bulan->EditValue ?>"<?php echo $m_karyawan_tk_edit->bulan->editAttributes() ?>>
</span>
<?php echo $m_karyawan_tk_edit->bulan->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="m_karyawan_tk" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($m_karyawan_tk_edit->id->CurrentValue) ?>">
<?php
	if (in_array("gaji_karyawan_tk", explode(",", $m_karyawan_tk->getCurrentDetailTable())) && $gaji_karyawan_tk->DetailEdit) {
?>
<?php if ($m_karyawan_tk->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("gaji_karyawan_tk", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "gaji_karyawan_tkgrid.php" ?>
<?php } ?>
<?php if (!$m_karyawan_tk_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $m_karyawan_tk_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_karyawan_tk_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$m_karyawan_tk_edit->showPageFooter();
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
$m_karyawan_tk_edit->terminate();
?>