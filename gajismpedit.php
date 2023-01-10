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
$gajismp_edit = new gajismp_edit();

// Run the page
$gajismp_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gajismp_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fgajismpedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fgajismpedit = currentForm = new ew.Form("fgajismpedit", "edit");

	// Validate form
	fgajismpedit.validate = function() {
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
			<?php if ($gajismp_edit->tahun->Required) { ?>
				elm = this.getElements("x" + infix + "_tahun");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajismp_edit->tahun->caption(), $gajismp_edit->tahun->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tahun");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajismp_edit->tahun->errorMessage()) ?>");
			<?php if ($gajismp_edit->bulan->Required) { ?>
				elm = this.getElements("x" + infix + "_bulan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajismp_edit->bulan->caption(), $gajismp_edit->bulan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($gajismp_edit->datetime->Required) { ?>
				elm = this.getElements("x" + infix + "_datetime");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajismp_edit->datetime->caption(), $gajismp_edit->datetime->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($gajismp_edit->createby->Required) { ?>
				elm = this.getElements("x" + infix + "_createby");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajismp_edit->createby->caption(), $gajismp_edit->createby->RequiredErrorMessage)) ?>");
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
	fgajismpedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fgajismpedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fgajismpedit.lists["x_bulan"] = <?php echo $gajismp_edit->bulan->Lookup->toClientList($gajismp_edit) ?>;
	fgajismpedit.lists["x_bulan"].options = <?php echo JsonEncode($gajismp_edit->bulan->lookupOptions()) ?>;
	fgajismpedit.lists["x_createby"] = <?php echo $gajismp_edit->createby->Lookup->toClientList($gajismp_edit) ?>;
	fgajismpedit.lists["x_createby"].options = <?php echo JsonEncode($gajismp_edit->createby->lookupOptions()) ?>;
	fgajismpedit.autoSuggests["x_createby"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fgajismpedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $gajismp_edit->showPageHeader(); ?>
<?php
$gajismp_edit->showMessage();
?>
<form name="fgajismpedit" id="fgajismpedit" class="<?php echo $gajismp_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gajismp">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$gajismp_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($gajismp_edit->tahun->Visible) { // tahun ?>
	<div id="r_tahun" class="form-group row">
		<label id="elh_gajismp_tahun" for="x_tahun" class="<?php echo $gajismp_edit->LeftColumnClass ?>"><?php echo $gajismp_edit->tahun->caption() ?><?php echo $gajismp_edit->tahun->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajismp_edit->RightColumnClass ?>"><div <?php echo $gajismp_edit->tahun->cellAttributes() ?>>
<span id="el_gajismp_tahun">
<input type="text" data-table="gajismp" data-field="x_tahun" name="x_tahun" id="x_tahun" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($gajismp_edit->tahun->getPlaceHolder()) ?>" value="<?php echo $gajismp_edit->tahun->EditValue ?>"<?php echo $gajismp_edit->tahun->editAttributes() ?>>
</span>
<?php echo $gajismp_edit->tahun->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajismp_edit->bulan->Visible) { // bulan ?>
	<div id="r_bulan" class="form-group row">
		<label id="elh_gajismp_bulan" for="x_bulan" class="<?php echo $gajismp_edit->LeftColumnClass ?>"><?php echo $gajismp_edit->bulan->caption() ?><?php echo $gajismp_edit->bulan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajismp_edit->RightColumnClass ?>"><div <?php echo $gajismp_edit->bulan->cellAttributes() ?>>
<span id="el_gajismp_bulan">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_bulan"><?php echo EmptyValue(strval($gajismp_edit->bulan->ViewValue)) ? $Language->phrase("PleaseSelect") : $gajismp_edit->bulan->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($gajismp_edit->bulan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($gajismp_edit->bulan->ReadOnly || $gajismp_edit->bulan->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_bulan',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $gajismp_edit->bulan->Lookup->getParamTag($gajismp_edit, "p_x_bulan") ?>
<input type="hidden" data-table="gajismp" data-field="x_bulan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $gajismp_edit->bulan->displayValueSeparatorAttribute() ?>" name="x_bulan" id="x_bulan" value="<?php echo $gajismp_edit->bulan->CurrentValue ?>"<?php echo $gajismp_edit->bulan->editAttributes() ?>>
</span>
<?php echo $gajismp_edit->bulan->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="gajismp" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($gajismp_edit->id->CurrentValue) ?>">
<?php
	if (in_array("gajismp_detil", explode(",", $gajismp->getCurrentDetailTable())) && $gajismp_detil->DetailEdit) {
?>
<?php if ($gajismp->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("gajismp_detil", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "gajismp_detilgrid.php" ?>
<?php } ?>
<?php if (!$gajismp_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $gajismp_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $gajismp_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$gajismp_edit->showPageFooter();
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
$gajismp_edit->terminate();
?>