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
$gender_edit = new gender_edit();

// Run the page
$gender_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gender_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fgenderedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fgenderedit = currentForm = new ew.Form("fgenderedit", "edit");

	// Validate form
	fgenderedit.validate = function() {
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
			<?php if ($gender_edit->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gender_edit->id->caption(), $gender_edit->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($gender_edit->gen->Required) { ?>
				elm = this.getElements("x" + infix + "_gen");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gender_edit->gen->caption(), $gender_edit->gen->RequiredErrorMessage)) ?>");
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
	fgenderedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fgenderedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fgenderedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $gender_edit->showPageHeader(); ?>
<?php
$gender_edit->showMessage();
?>
<form name="fgenderedit" id="fgenderedit" class="<?php echo $gender_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gender">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$gender_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($gender_edit->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_gender_id" class="<?php echo $gender_edit->LeftColumnClass ?>"><?php echo $gender_edit->id->caption() ?><?php echo $gender_edit->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gender_edit->RightColumnClass ?>"><div <?php echo $gender_edit->id->cellAttributes() ?>>
<span id="el_gender_id">
<span<?php echo $gender_edit->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gender_edit->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="gender" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($gender_edit->id->CurrentValue) ?>">
<?php echo $gender_edit->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gender_edit->gen->Visible) { // gen ?>
	<div id="r_gen" class="form-group row">
		<label id="elh_gender_gen" for="x_gen" class="<?php echo $gender_edit->LeftColumnClass ?>"><?php echo $gender_edit->gen->caption() ?><?php echo $gender_edit->gen->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gender_edit->RightColumnClass ?>"><div <?php echo $gender_edit->gen->cellAttributes() ?>>
<span id="el_gender_gen">
<input type="text" data-table="gender" data-field="x_gen" name="x_gen" id="x_gen" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($gender_edit->gen->getPlaceHolder()) ?>" value="<?php echo $gender_edit->gen->EditValue ?>"<?php echo $gender_edit->gen->editAttributes() ?>>
</span>
<?php echo $gender_edit->gen->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$gender_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $gender_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $gender_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$gender_edit->showPageFooter();
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
$gender_edit->terminate();
?>