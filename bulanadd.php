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
$bulan_add = new bulan_add();

// Run the page
$bulan_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$bulan_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fbulanadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fbulanadd = currentForm = new ew.Form("fbulanadd", "add");

	// Validate form
	fbulanadd.validate = function() {
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
			<?php if ($bulan_add->nourut->Required) { ?>
				elm = this.getElements("x" + infix + "_nourut");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bulan_add->nourut->caption(), $bulan_add->nourut->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_nourut");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bulan_add->nourut->errorMessage()) ?>");
			<?php if ($bulan_add->bulan->Required) { ?>
				elm = this.getElements("x" + infix + "_bulan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bulan_add->bulan->caption(), $bulan_add->bulan->RequiredErrorMessage)) ?>");
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
	fbulanadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fbulanadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fbulanadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $bulan_add->showPageHeader(); ?>
<?php
$bulan_add->showMessage();
?>
<form name="fbulanadd" id="fbulanadd" class="<?php echo $bulan_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="bulan">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$bulan_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($bulan_add->nourut->Visible) { // nourut ?>
	<div id="r_nourut" class="form-group row">
		<label id="elh_bulan_nourut" for="x_nourut" class="<?php echo $bulan_add->LeftColumnClass ?>"><?php echo $bulan_add->nourut->caption() ?><?php echo $bulan_add->nourut->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bulan_add->RightColumnClass ?>"><div <?php echo $bulan_add->nourut->cellAttributes() ?>>
<span id="el_bulan_nourut">
<input type="text" data-table="bulan" data-field="x_nourut" name="x_nourut" id="x_nourut" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($bulan_add->nourut->getPlaceHolder()) ?>" value="<?php echo $bulan_add->nourut->EditValue ?>"<?php echo $bulan_add->nourut->editAttributes() ?>>
</span>
<?php echo $bulan_add->nourut->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bulan_add->bulan->Visible) { // bulan ?>
	<div id="r_bulan" class="form-group row">
		<label id="elh_bulan_bulan" for="x_bulan" class="<?php echo $bulan_add->LeftColumnClass ?>"><?php echo $bulan_add->bulan->caption() ?><?php echo $bulan_add->bulan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bulan_add->RightColumnClass ?>"><div <?php echo $bulan_add->bulan->cellAttributes() ?>>
<span id="el_bulan_bulan">
<input type="text" data-table="bulan" data-field="x_bulan" name="x_bulan" id="x_bulan" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($bulan_add->bulan->getPlaceHolder()) ?>" value="<?php echo $bulan_add->bulan->EditValue ?>"<?php echo $bulan_add->bulan->editAttributes() ?>>
</span>
<?php echo $bulan_add->bulan->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$bulan_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $bulan_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $bulan_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$bulan_add->showPageFooter();
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
$bulan_add->terminate();
?>