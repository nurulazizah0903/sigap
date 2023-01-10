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
$bulan_edit = new bulan_edit();

// Run the page
$bulan_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$bulan_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fbulanedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fbulanedit = currentForm = new ew.Form("fbulanedit", "edit");

	// Validate form
	fbulanedit.validate = function() {
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
			<?php if ($bulan_edit->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bulan_edit->id->caption(), $bulan_edit->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bulan_edit->nourut->Required) { ?>
				elm = this.getElements("x" + infix + "_nourut");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bulan_edit->nourut->caption(), $bulan_edit->nourut->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_nourut");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bulan_edit->nourut->errorMessage()) ?>");
			<?php if ($bulan_edit->bulan->Required) { ?>
				elm = this.getElements("x" + infix + "_bulan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bulan_edit->bulan->caption(), $bulan_edit->bulan->RequiredErrorMessage)) ?>");
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
	fbulanedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fbulanedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fbulanedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $bulan_edit->showPageHeader(); ?>
<?php
$bulan_edit->showMessage();
?>
<form name="fbulanedit" id="fbulanedit" class="<?php echo $bulan_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="bulan">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$bulan_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($bulan_edit->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_bulan_id" class="<?php echo $bulan_edit->LeftColumnClass ?>"><?php echo $bulan_edit->id->caption() ?><?php echo $bulan_edit->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bulan_edit->RightColumnClass ?>"><div <?php echo $bulan_edit->id->cellAttributes() ?>>
<span id="el_bulan_id">
<span<?php echo $bulan_edit->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bulan_edit->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="bulan" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($bulan_edit->id->CurrentValue) ?>">
<?php echo $bulan_edit->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bulan_edit->nourut->Visible) { // nourut ?>
	<div id="r_nourut" class="form-group row">
		<label id="elh_bulan_nourut" for="x_nourut" class="<?php echo $bulan_edit->LeftColumnClass ?>"><?php echo $bulan_edit->nourut->caption() ?><?php echo $bulan_edit->nourut->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bulan_edit->RightColumnClass ?>"><div <?php echo $bulan_edit->nourut->cellAttributes() ?>>
<span id="el_bulan_nourut">
<input type="text" data-table="bulan" data-field="x_nourut" name="x_nourut" id="x_nourut" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($bulan_edit->nourut->getPlaceHolder()) ?>" value="<?php echo $bulan_edit->nourut->EditValue ?>"<?php echo $bulan_edit->nourut->editAttributes() ?>>
</span>
<?php echo $bulan_edit->nourut->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bulan_edit->bulan->Visible) { // bulan ?>
	<div id="r_bulan" class="form-group row">
		<label id="elh_bulan_bulan" for="x_bulan" class="<?php echo $bulan_edit->LeftColumnClass ?>"><?php echo $bulan_edit->bulan->caption() ?><?php echo $bulan_edit->bulan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bulan_edit->RightColumnClass ?>"><div <?php echo $bulan_edit->bulan->cellAttributes() ?>>
<span id="el_bulan_bulan">
<input type="text" data-table="bulan" data-field="x_bulan" name="x_bulan" id="x_bulan" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($bulan_edit->bulan->getPlaceHolder()) ?>" value="<?php echo $bulan_edit->bulan->EditValue ?>"<?php echo $bulan_edit->bulan->editAttributes() ?>>
</span>
<?php echo $bulan_edit->bulan->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$bulan_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $bulan_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $bulan_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$bulan_edit->showPageFooter();
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
$bulan_edit->terminate();
?>