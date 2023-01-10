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
$gajisd_add = new gajisd_add();

// Run the page
$gajisd_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gajisd_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fgajisdadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fgajisdadd = currentForm = new ew.Form("fgajisdadd", "add");

	// Validate form
	fgajisdadd.validate = function() {
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
			<?php if ($gajisd_add->tahun->Required) { ?>
				elm = this.getElements("x" + infix + "_tahun");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajisd_add->tahun->caption(), $gajisd_add->tahun->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tahun");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajisd_add->tahun->errorMessage()) ?>");
			<?php if ($gajisd_add->bulan->Required) { ?>
				elm = this.getElements("x" + infix + "_bulan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajisd_add->bulan->caption(), $gajisd_add->bulan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($gajisd_add->datetime->Required) { ?>
				elm = this.getElements("x" + infix + "_datetime");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajisd_add->datetime->caption(), $gajisd_add->datetime->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($gajisd_add->createby->Required) { ?>
				elm = this.getElements("x" + infix + "_createby");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajisd_add->createby->caption(), $gajisd_add->createby->RequiredErrorMessage)) ?>");
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
	fgajisdadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fgajisdadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fgajisdadd.lists["x_bulan"] = <?php echo $gajisd_add->bulan->Lookup->toClientList($gajisd_add) ?>;
	fgajisdadd.lists["x_bulan"].options = <?php echo JsonEncode($gajisd_add->bulan->lookupOptions()) ?>;
	fgajisdadd.lists["x_createby"] = <?php echo $gajisd_add->createby->Lookup->toClientList($gajisd_add) ?>;
	fgajisdadd.lists["x_createby"].options = <?php echo JsonEncode($gajisd_add->createby->lookupOptions()) ?>;
	fgajisdadd.autoSuggests["x_createby"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fgajisdadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $gajisd_add->showPageHeader(); ?>
<?php
$gajisd_add->showMessage();
?>
<form name="fgajisdadd" id="fgajisdadd" class="<?php echo $gajisd_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gajisd">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$gajisd_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($gajisd_add->tahun->Visible) { // tahun ?>
	<div id="r_tahun" class="form-group row">
		<label id="elh_gajisd_tahun" for="x_tahun" class="<?php echo $gajisd_add->LeftColumnClass ?>"><?php echo $gajisd_add->tahun->caption() ?><?php echo $gajisd_add->tahun->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajisd_add->RightColumnClass ?>"><div <?php echo $gajisd_add->tahun->cellAttributes() ?>>
<span id="el_gajisd_tahun">
<input type="text" data-table="gajisd" data-field="x_tahun" name="x_tahun" id="x_tahun" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($gajisd_add->tahun->getPlaceHolder()) ?>" value="<?php echo $gajisd_add->tahun->EditValue ?>"<?php echo $gajisd_add->tahun->editAttributes() ?>>
</span>
<?php echo $gajisd_add->tahun->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gajisd_add->bulan->Visible) { // bulan ?>
	<div id="r_bulan" class="form-group row">
		<label id="elh_gajisd_bulan" for="x_bulan" class="<?php echo $gajisd_add->LeftColumnClass ?>"><?php echo $gajisd_add->bulan->caption() ?><?php echo $gajisd_add->bulan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gajisd_add->RightColumnClass ?>"><div <?php echo $gajisd_add->bulan->cellAttributes() ?>>
<span id="el_gajisd_bulan">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_bulan"><?php echo EmptyValue(strval($gajisd_add->bulan->ViewValue)) ? $Language->phrase("PleaseSelect") : $gajisd_add->bulan->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($gajisd_add->bulan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($gajisd_add->bulan->ReadOnly || $gajisd_add->bulan->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_bulan',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $gajisd_add->bulan->Lookup->getParamTag($gajisd_add, "p_x_bulan") ?>
<input type="hidden" data-table="gajisd" data-field="x_bulan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $gajisd_add->bulan->displayValueSeparatorAttribute() ?>" name="x_bulan" id="x_bulan" value="<?php echo $gajisd_add->bulan->CurrentValue ?>"<?php echo $gajisd_add->bulan->editAttributes() ?>>
</span>
<?php echo $gajisd_add->bulan->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("gajisd_detil", explode(",", $gajisd->getCurrentDetailTable())) && $gajisd_detil->DetailAdd) {
?>
<?php if ($gajisd->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("gajisd_detil", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "gajisd_detilgrid.php" ?>
<?php } ?>
<?php if (!$gajisd_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $gajisd_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $gajisd_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$gajisd_add->showPageFooter();
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
$gajisd_add->terminate();
?>