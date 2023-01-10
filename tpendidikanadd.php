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
$tpendidikan_add = new tpendidikan_add();

// Run the page
$tpendidikan_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tpendidikan_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftpendidikanadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	ftpendidikanadd = currentForm = new ew.Form("ftpendidikanadd", "add");

	// Validate form
	ftpendidikanadd.validate = function() {
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
			<?php if ($tpendidikan_add->nourut->Required) { ?>
				elm = this.getElements("x" + infix + "_nourut");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tpendidikan_add->nourut->caption(), $tpendidikan_add->nourut->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_nourut");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($tpendidikan_add->nourut->errorMessage()) ?>");
			<?php if ($tpendidikan_add->name->Required) { ?>
				elm = this.getElements("x" + infix + "_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tpendidikan_add->name->caption(), $tpendidikan_add->name->RequiredErrorMessage)) ?>");
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
	ftpendidikanadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ftpendidikanadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ftpendidikanadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tpendidikan_add->showPageHeader(); ?>
<?php
$tpendidikan_add->showMessage();
?>
<form name="ftpendidikanadd" id="ftpendidikanadd" class="<?php echo $tpendidikan_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tpendidikan">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$tpendidikan_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($tpendidikan_add->nourut->Visible) { // nourut ?>
	<div id="r_nourut" class="form-group row">
		<label id="elh_tpendidikan_nourut" for="x_nourut" class="<?php echo $tpendidikan_add->LeftColumnClass ?>"><?php echo $tpendidikan_add->nourut->caption() ?><?php echo $tpendidikan_add->nourut->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tpendidikan_add->RightColumnClass ?>"><div <?php echo $tpendidikan_add->nourut->cellAttributes() ?>>
<span id="el_tpendidikan_nourut">
<input type="text" data-table="tpendidikan" data-field="x_nourut" name="x_nourut" id="x_nourut" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($tpendidikan_add->nourut->getPlaceHolder()) ?>" value="<?php echo $tpendidikan_add->nourut->EditValue ?>"<?php echo $tpendidikan_add->nourut->editAttributes() ?>>
</span>
<?php echo $tpendidikan_add->nourut->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tpendidikan_add->name->Visible) { // name ?>
	<div id="r_name" class="form-group row">
		<label id="elh_tpendidikan_name" for="x_name" class="<?php echo $tpendidikan_add->LeftColumnClass ?>"><?php echo $tpendidikan_add->name->caption() ?><?php echo $tpendidikan_add->name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tpendidikan_add->RightColumnClass ?>"><div <?php echo $tpendidikan_add->name->cellAttributes() ?>>
<span id="el_tpendidikan_name">
<input type="text" data-table="tpendidikan" data-field="x_name" name="x_name" id="x_name" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tpendidikan_add->name->getPlaceHolder()) ?>" value="<?php echo $tpendidikan_add->name->EditValue ?>"<?php echo $tpendidikan_add->name->editAttributes() ?>>
</span>
<?php echo $tpendidikan_add->name->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$tpendidikan_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tpendidikan_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tpendidikan_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tpendidikan_add->showPageFooter();
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
$tpendidikan_add->terminate();
?>