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
$jenis_lembur_edit = new jenis_lembur_edit();

// Run the page
$jenis_lembur_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$jenis_lembur_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fjenis_lemburedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fjenis_lemburedit = currentForm = new ew.Form("fjenis_lemburedit", "edit");

	// Validate form
	fjenis_lemburedit.validate = function() {
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
			<?php if ($jenis_lembur_edit->nama->Required) { ?>
				elm = this.getElements("x" + infix + "_nama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $jenis_lembur_edit->nama->caption(), $jenis_lembur_edit->nama->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($jenis_lembur_edit->aktif->Required) { ?>
				elm = this.getElements("x" + infix + "_aktif");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $jenis_lembur_edit->aktif->caption(), $jenis_lembur_edit->aktif->RequiredErrorMessage)) ?>");
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
	fjenis_lemburedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fjenis_lemburedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fjenis_lemburedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $jenis_lembur_edit->showPageHeader(); ?>
<?php
$jenis_lembur_edit->showMessage();
?>
<form name="fjenis_lemburedit" id="fjenis_lemburedit" class="<?php echo $jenis_lembur_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="jenis_lembur">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$jenis_lembur_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($jenis_lembur_edit->nama->Visible) { // nama ?>
	<div id="r_nama" class="form-group row">
		<label id="elh_jenis_lembur_nama" for="x_nama" class="<?php echo $jenis_lembur_edit->LeftColumnClass ?>"><?php echo $jenis_lembur_edit->nama->caption() ?><?php echo $jenis_lembur_edit->nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $jenis_lembur_edit->RightColumnClass ?>"><div <?php echo $jenis_lembur_edit->nama->cellAttributes() ?>>
<span id="el_jenis_lembur_nama">
<input type="text" data-table="jenis_lembur" data-field="x_nama" name="x_nama" id="x_nama" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($jenis_lembur_edit->nama->getPlaceHolder()) ?>" value="<?php echo $jenis_lembur_edit->nama->EditValue ?>"<?php echo $jenis_lembur_edit->nama->editAttributes() ?>>
</span>
<?php echo $jenis_lembur_edit->nama->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($jenis_lembur_edit->aktif->Visible) { // aktif ?>
	<div id="r_aktif" class="form-group row">
		<label id="elh_jenis_lembur_aktif" for="x_aktif" class="<?php echo $jenis_lembur_edit->LeftColumnClass ?>"><?php echo $jenis_lembur_edit->aktif->caption() ?><?php echo $jenis_lembur_edit->aktif->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $jenis_lembur_edit->RightColumnClass ?>"><div <?php echo $jenis_lembur_edit->aktif->cellAttributes() ?>>
<span id="el_jenis_lembur_aktif">
<input type="text" data-table="jenis_lembur" data-field="x_aktif" name="x_aktif" id="x_aktif" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($jenis_lembur_edit->aktif->getPlaceHolder()) ?>" value="<?php echo $jenis_lembur_edit->aktif->EditValue ?>"<?php echo $jenis_lembur_edit->aktif->editAttributes() ?>>
</span>
<?php echo $jenis_lembur_edit->aktif->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="jenis_lembur" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($jenis_lembur_edit->id->CurrentValue) ?>">
<?php if (!$jenis_lembur_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $jenis_lembur_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $jenis_lembur_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$jenis_lembur_edit->showPageFooter();
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
$jenis_lembur_edit->terminate();
?>