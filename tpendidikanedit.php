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
$tpendidikan_edit = new tpendidikan_edit();

// Run the page
$tpendidikan_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tpendidikan_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftpendidikanedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ftpendidikanedit = currentForm = new ew.Form("ftpendidikanedit", "edit");

	// Validate form
	ftpendidikanedit.validate = function() {
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
			<?php if ($tpendidikan_edit->nourut->Required) { ?>
				elm = this.getElements("x" + infix + "_nourut");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tpendidikan_edit->nourut->caption(), $tpendidikan_edit->nourut->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_nourut");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($tpendidikan_edit->nourut->errorMessage()) ?>");
			<?php if ($tpendidikan_edit->name->Required) { ?>
				elm = this.getElements("x" + infix + "_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tpendidikan_edit->name->caption(), $tpendidikan_edit->name->RequiredErrorMessage)) ?>");
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
	ftpendidikanedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ftpendidikanedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ftpendidikanedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tpendidikan_edit->showPageHeader(); ?>
<?php
$tpendidikan_edit->showMessage();
?>
<form name="ftpendidikanedit" id="ftpendidikanedit" class="<?php echo $tpendidikan_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tpendidikan">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$tpendidikan_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($tpendidikan_edit->nourut->Visible) { // nourut ?>
	<div id="r_nourut" class="form-group row">
		<label id="elh_tpendidikan_nourut" for="x_nourut" class="<?php echo $tpendidikan_edit->LeftColumnClass ?>"><?php echo $tpendidikan_edit->nourut->caption() ?><?php echo $tpendidikan_edit->nourut->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tpendidikan_edit->RightColumnClass ?>"><div <?php echo $tpendidikan_edit->nourut->cellAttributes() ?>>
<span id="el_tpendidikan_nourut">
<input type="text" data-table="tpendidikan" data-field="x_nourut" name="x_nourut" id="x_nourut" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($tpendidikan_edit->nourut->getPlaceHolder()) ?>" value="<?php echo $tpendidikan_edit->nourut->EditValue ?>"<?php echo $tpendidikan_edit->nourut->editAttributes() ?>>
</span>
<?php echo $tpendidikan_edit->nourut->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tpendidikan_edit->name->Visible) { // name ?>
	<div id="r_name" class="form-group row">
		<label id="elh_tpendidikan_name" for="x_name" class="<?php echo $tpendidikan_edit->LeftColumnClass ?>"><?php echo $tpendidikan_edit->name->caption() ?><?php echo $tpendidikan_edit->name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tpendidikan_edit->RightColumnClass ?>"><div <?php echo $tpendidikan_edit->name->cellAttributes() ?>>
<span id="el_tpendidikan_name">
<input type="text" data-table="tpendidikan" data-field="x_name" name="x_name" id="x_name" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tpendidikan_edit->name->getPlaceHolder()) ?>" value="<?php echo $tpendidikan_edit->name->EditValue ?>"<?php echo $tpendidikan_edit->name->editAttributes() ?>>
</span>
<?php echo $tpendidikan_edit->name->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="tpendidikan" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($tpendidikan_edit->id->CurrentValue) ?>">
<?php if (!$tpendidikan_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tpendidikan_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tpendidikan_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tpendidikan_edit->showPageFooter();
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
$tpendidikan_edit->terminate();
?>