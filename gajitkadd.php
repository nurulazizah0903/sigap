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
$gajitk_add = new gajitk_add();

// Run the page
$gajitk_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gajitk_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fgajitkadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fgajitkadd = currentForm = new ew.Form("fgajitkadd", "add");

	// Validate form
	fgajitkadd.validate = function() {
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
			<?php if ($gajitk_add->tahun->Required) { ?>
				elm = this.getElements("x" + infix + "_tahun");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitk_add->tahun->caption(), $gajitk_add->tahun->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tahun");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitk_add->tahun->errorMessage()) ?>");
			<?php if ($gajitk_add->bulan->Required) { ?>
				elm = this.getElements("x" + infix + "_bulan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitk_add->bulan->caption(), $gajitk_add->bulan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($gajitk_add->datetime->Required) { ?>
				elm = this.getElements("x" + infix + "_datetime");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitk_add->datetime->caption(), $gajitk_add->datetime->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($gajitk_add->createby->Required) { ?>
				elm = this.getElements("x" + infix + "_createby");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitk_add->createby->caption(), $gajitk_add->createby->RequiredErrorMessage)) ?>");
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
	fgajitkadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fgajitkadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fgajitkadd.lists["x_bulan"] = <?php echo $gajitk_add->bulan->Lookup->toClientList($gajitk_add) ?>;
	fgajitkadd.lists["x_bulan"].options = <?php echo JsonEncode($gajitk_add->bulan->lookupOptions()) ?>;
	fgajitkadd.lists["x_createby"] = <?php echo $gajitk_add->createby->Lookup->toClientList($gajitk_add) ?>;
	fgajitkadd.lists["x_createby"].options = <?php echo JsonEncode($gajitk_add->createby->lookupOptions()) ?>;
	fgajitkadd.autoSuggests["x_createby"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fgajitkadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $gajitk_add->showPageHeader(); ?>
<?php
$gajitk_add->showMessage();
?>
<form name="fgajitkadd" id="fgajitkadd" class="<?php echo $gajitk_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gajitk">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$gajitk_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($gajitk_add->tahun->Visible) { // tahun ?>
	<div id="r_tahun" class="form-group row">
		<label id="elh_gajitk_tahun" for="x_tahun" class="<?php echo $gajitk_add->LeftColumnClass ?>"><?php echo $gajitk_add->tahun->caption() ?><?php echo $gajitk_add->tahun->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajitk_add->RightColumnClass ?>"><div <?php echo $gajitk_add->tahun->cellAttributes() ?>>
<span id="el_gajitk_tahun">
<input type="text" data-table="gajitk" data-field="x_tahun" name="x_tahun" id="x_tahun" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($gajitk_add->tahun->getPlaceHolder()) ?>" value="<?php echo $gajitk_add->tahun->EditValue ?>"<?php echo $gajitk_add->tahun->editAttributes() ?>>
</span>
<?php echo $gajitk_add->tahun->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajitk_add->bulan->Visible) { // bulan ?>
	<div id="r_bulan" class="form-group row">
		<label id="elh_gajitk_bulan" for="x_bulan" class="<?php echo $gajitk_add->LeftColumnClass ?>"><?php echo $gajitk_add->bulan->caption() ?><?php echo $gajitk_add->bulan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajitk_add->RightColumnClass ?>"><div <?php echo $gajitk_add->bulan->cellAttributes() ?>>
<span id="el_gajitk_bulan">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_bulan"><?php echo EmptyValue(strval($gajitk_add->bulan->ViewValue)) ? $Language->phrase("PleaseSelect") : $gajitk_add->bulan->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($gajitk_add->bulan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($gajitk_add->bulan->ReadOnly || $gajitk_add->bulan->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_bulan',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $gajitk_add->bulan->Lookup->getParamTag($gajitk_add, "p_x_bulan") ?>
<input type="hidden" data-table="gajitk" data-field="x_bulan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $gajitk_add->bulan->displayValueSeparatorAttribute() ?>" name="x_bulan" id="x_bulan" value="<?php echo $gajitk_add->bulan->CurrentValue ?>"<?php echo $gajitk_add->bulan->editAttributes() ?>>
</span>
<?php echo $gajitk_add->bulan->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("gajitk_detil", explode(",", $gajitk->getCurrentDetailTable())) && $gajitk_detil->DetailAdd) {
?>
<?php if ($gajitk->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("gajitk_detil", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "gajitk_detilgrid.php" ?>
<?php } ?>
<?php if (!$gajitk_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $gajitk_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $gajitk_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$gajitk_add->showPageFooter();
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
$gajitk_add->terminate();
?>