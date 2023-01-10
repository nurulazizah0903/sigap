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
$gajisma_edit = new gajisma_edit();

// Run the page
$gajisma_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gajisma_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fgajismaedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fgajismaedit = currentForm = new ew.Form("fgajismaedit", "edit");

	// Validate form
	fgajismaedit.validate = function() {
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
			<?php if ($gajisma_edit->tahun->Required) { ?>
				elm = this.getElements("x" + infix + "_tahun");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajisma_edit->tahun->caption(), $gajisma_edit->tahun->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tahun");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajisma_edit->tahun->errorMessage()) ?>");
			<?php if ($gajisma_edit->bulan->Required) { ?>
				elm = this.getElements("x" + infix + "_bulan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajisma_edit->bulan->caption(), $gajisma_edit->bulan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($gajisma_edit->datetime->Required) { ?>
				elm = this.getElements("x" + infix + "_datetime");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajisma_edit->datetime->caption(), $gajisma_edit->datetime->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($gajisma_edit->createby->Required) { ?>
				elm = this.getElements("x" + infix + "_createby");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajisma_edit->createby->caption(), $gajisma_edit->createby->RequiredErrorMessage)) ?>");
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
	fgajismaedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fgajismaedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fgajismaedit.lists["x_bulan"] = <?php echo $gajisma_edit->bulan->Lookup->toClientList($gajisma_edit) ?>;
	fgajismaedit.lists["x_bulan"].options = <?php echo JsonEncode($gajisma_edit->bulan->lookupOptions()) ?>;
	fgajismaedit.lists["x_createby"] = <?php echo $gajisma_edit->createby->Lookup->toClientList($gajisma_edit) ?>;
	fgajismaedit.lists["x_createby"].options = <?php echo JsonEncode($gajisma_edit->createby->lookupOptions()) ?>;
	fgajismaedit.autoSuggests["x_createby"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fgajismaedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $gajisma_edit->showPageHeader(); ?>
<?php
$gajisma_edit->showMessage();
?>
<form name="fgajismaedit" id="fgajismaedit" class="<?php echo $gajisma_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gajisma">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$gajisma_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($gajisma_edit->tahun->Visible) { // tahun ?>
	<div id="r_tahun" class="form-group row">
		<label id="elh_gajisma_tahun" for="x_tahun" class="<?php echo $gajisma_edit->LeftColumnClass ?>"><?php echo $gajisma_edit->tahun->caption() ?><?php echo $gajisma_edit->tahun->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajisma_edit->RightColumnClass ?>"><div <?php echo $gajisma_edit->tahun->cellAttributes() ?>>
<span id="el_gajisma_tahun">
<input type="text" data-table="gajisma" data-field="x_tahun" name="x_tahun" id="x_tahun" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($gajisma_edit->tahun->getPlaceHolder()) ?>" value="<?php echo $gajisma_edit->tahun->EditValue ?>"<?php echo $gajisma_edit->tahun->editAttributes() ?>>
</span>
<?php echo $gajisma_edit->tahun->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajisma_edit->bulan->Visible) { // bulan ?>
	<div id="r_bulan" class="form-group row">
		<label id="elh_gajisma_bulan" for="x_bulan" class="<?php echo $gajisma_edit->LeftColumnClass ?>"><?php echo $gajisma_edit->bulan->caption() ?><?php echo $gajisma_edit->bulan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajisma_edit->RightColumnClass ?>"><div <?php echo $gajisma_edit->bulan->cellAttributes() ?>>
<span id="el_gajisma_bulan">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_bulan"><?php echo EmptyValue(strval($gajisma_edit->bulan->ViewValue)) ? $Language->phrase("PleaseSelect") : $gajisma_edit->bulan->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($gajisma_edit->bulan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($gajisma_edit->bulan->ReadOnly || $gajisma_edit->bulan->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_bulan',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $gajisma_edit->bulan->Lookup->getParamTag($gajisma_edit, "p_x_bulan") ?>
<input type="hidden" data-table="gajisma" data-field="x_bulan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $gajisma_edit->bulan->displayValueSeparatorAttribute() ?>" name="x_bulan" id="x_bulan" value="<?php echo $gajisma_edit->bulan->CurrentValue ?>"<?php echo $gajisma_edit->bulan->editAttributes() ?>>
</span>
<?php echo $gajisma_edit->bulan->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="gajisma" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($gajisma_edit->id->CurrentValue) ?>">
<?php
	if (in_array("gajisma_detil", explode(",", $gajisma->getCurrentDetailTable())) && $gajisma_detil->DetailEdit) {
?>
<?php if ($gajisma->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("gajisma_detil", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "gajisma_detilgrid.php" ?>
<?php } ?>
<?php if (!$gajisma_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $gajisma_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $gajisma_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$gajisma_edit->showPageFooter();
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
$gajisma_edit->terminate();
?>