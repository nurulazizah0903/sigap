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
$pengetahuan_add = new pengetahuan_add();

// Run the page
$pengetahuan_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pengetahuan_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpengetahuanadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fpengetahuanadd = currentForm = new ew.Form("fpengetahuanadd", "add");

	// Validate form
	fpengetahuanadd.validate = function() {
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
			<?php if ($pengetahuan_add->grup->Required) { ?>
				elm = this.getElements("x" + infix + "_grup");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pengetahuan_add->grup->caption(), $pengetahuan_add->grup->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pengetahuan_add->judul->Required) { ?>
				elm = this.getElements("x" + infix + "_judul");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pengetahuan_add->judul->caption(), $pengetahuan_add->judul->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pengetahuan_add->isi->Required) { ?>
				elm = this.getElements("x" + infix + "_isi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pengetahuan_add->isi->caption(), $pengetahuan_add->isi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pengetahuan_add->sumber_url->Required) { ?>
				elm = this.getElements("x" + infix + "_sumber_url");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pengetahuan_add->sumber_url->caption(), $pengetahuan_add->sumber_url->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pengetahuan_add->dokumen->Required) { ?>
				elm = this.getElements("x" + infix + "_dokumen");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pengetahuan_add->dokumen->caption(), $pengetahuan_add->dokumen->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pengetahuan_add->visual->Required) { ?>
				elm = this.getElements("x" + infix + "_visual");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pengetahuan_add->visual->caption(), $pengetahuan_add->visual->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pengetahuan_add->c_by->Required) { ?>
				elm = this.getElements("x" + infix + "_c_by");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pengetahuan_add->c_by->caption(), $pengetahuan_add->c_by->RequiredErrorMessage)) ?>");
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
	fpengetahuanadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpengetahuanadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fpengetahuanadd.lists["x_c_by"] = <?php echo $pengetahuan_add->c_by->Lookup->toClientList($pengetahuan_add) ?>;
	fpengetahuanadd.lists["x_c_by"].options = <?php echo JsonEncode($pengetahuan_add->c_by->lookupOptions()) ?>;
	fpengetahuanadd.autoSuggests["x_c_by"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fpengetahuanadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $pengetahuan_add->showPageHeader(); ?>
<?php
$pengetahuan_add->showMessage();
?>
<form name="fpengetahuanadd" id="fpengetahuanadd" class="<?php echo $pengetahuan_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pengetahuan">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$pengetahuan_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($pengetahuan_add->grup->Visible) { // grup ?>
	<div id="r_grup" class="form-group row">
		<label id="elh_pengetahuan_grup" for="x_grup" class="<?php echo $pengetahuan_add->LeftColumnClass ?>"><?php echo $pengetahuan_add->grup->caption() ?><?php echo $pengetahuan_add->grup->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pengetahuan_add->RightColumnClass ?>"><div <?php echo $pengetahuan_add->grup->cellAttributes() ?>>
<span id="el_pengetahuan_grup">
<input type="text" data-table="pengetahuan" data-field="x_grup" name="x_grup" id="x_grup" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($pengetahuan_add->grup->getPlaceHolder()) ?>" value="<?php echo $pengetahuan_add->grup->EditValue ?>"<?php echo $pengetahuan_add->grup->editAttributes() ?>>
</span>
<?php echo $pengetahuan_add->grup->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pengetahuan_add->judul->Visible) { // judul ?>
	<div id="r_judul" class="form-group row">
		<label id="elh_pengetahuan_judul" for="x_judul" class="<?php echo $pengetahuan_add->LeftColumnClass ?>"><?php echo $pengetahuan_add->judul->caption() ?><?php echo $pengetahuan_add->judul->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pengetahuan_add->RightColumnClass ?>"><div <?php echo $pengetahuan_add->judul->cellAttributes() ?>>
<span id="el_pengetahuan_judul">
<textarea data-table="pengetahuan" data-field="x_judul" name="x_judul" id="x_judul" cols="35" rows="4" placeholder="<?php echo HtmlEncode($pengetahuan_add->judul->getPlaceHolder()) ?>"<?php echo $pengetahuan_add->judul->editAttributes() ?>><?php echo $pengetahuan_add->judul->EditValue ?></textarea>
</span>
<?php echo $pengetahuan_add->judul->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pengetahuan_add->isi->Visible) { // isi ?>
	<div id="r_isi" class="form-group row">
		<label id="elh_pengetahuan_isi" for="x_isi" class="<?php echo $pengetahuan_add->LeftColumnClass ?>"><?php echo $pengetahuan_add->isi->caption() ?><?php echo $pengetahuan_add->isi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pengetahuan_add->RightColumnClass ?>"><div <?php echo $pengetahuan_add->isi->cellAttributes() ?>>
<span id="el_pengetahuan_isi">
<textarea data-table="pengetahuan" data-field="x_isi" name="x_isi" id="x_isi" cols="35" rows="4" placeholder="<?php echo HtmlEncode($pengetahuan_add->isi->getPlaceHolder()) ?>"<?php echo $pengetahuan_add->isi->editAttributes() ?>><?php echo $pengetahuan_add->isi->EditValue ?></textarea>
</span>
<?php echo $pengetahuan_add->isi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pengetahuan_add->sumber_url->Visible) { // sumber_url ?>
	<div id="r_sumber_url" class="form-group row">
		<label id="elh_pengetahuan_sumber_url" for="x_sumber_url" class="<?php echo $pengetahuan_add->LeftColumnClass ?>"><?php echo $pengetahuan_add->sumber_url->caption() ?><?php echo $pengetahuan_add->sumber_url->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pengetahuan_add->RightColumnClass ?>"><div <?php echo $pengetahuan_add->sumber_url->cellAttributes() ?>>
<span id="el_pengetahuan_sumber_url">
<input type="text" data-table="pengetahuan" data-field="x_sumber_url" name="x_sumber_url" id="x_sumber_url" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($pengetahuan_add->sumber_url->getPlaceHolder()) ?>" value="<?php echo $pengetahuan_add->sumber_url->EditValue ?>"<?php echo $pengetahuan_add->sumber_url->editAttributes() ?>>
</span>
<?php echo $pengetahuan_add->sumber_url->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pengetahuan_add->dokumen->Visible) { // dokumen ?>
	<div id="r_dokumen" class="form-group row">
		<label id="elh_pengetahuan_dokumen" for="x_dokumen" class="<?php echo $pengetahuan_add->LeftColumnClass ?>"><?php echo $pengetahuan_add->dokumen->caption() ?><?php echo $pengetahuan_add->dokumen->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pengetahuan_add->RightColumnClass ?>"><div <?php echo $pengetahuan_add->dokumen->cellAttributes() ?>>
<span id="el_pengetahuan_dokumen">
<input type="text" data-table="pengetahuan" data-field="x_dokumen" name="x_dokumen" id="x_dokumen" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($pengetahuan_add->dokumen->getPlaceHolder()) ?>" value="<?php echo $pengetahuan_add->dokumen->EditValue ?>"<?php echo $pengetahuan_add->dokumen->editAttributes() ?>>
</span>
<?php echo $pengetahuan_add->dokumen->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pengetahuan_add->visual->Visible) { // visual ?>
	<div id="r_visual" class="form-group row">
		<label id="elh_pengetahuan_visual" for="x_visual" class="<?php echo $pengetahuan_add->LeftColumnClass ?>"><?php echo $pengetahuan_add->visual->caption() ?><?php echo $pengetahuan_add->visual->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pengetahuan_add->RightColumnClass ?>"><div <?php echo $pengetahuan_add->visual->cellAttributes() ?>>
<span id="el_pengetahuan_visual">
<input type="text" data-table="pengetahuan" data-field="x_visual" name="x_visual" id="x_visual" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($pengetahuan_add->visual->getPlaceHolder()) ?>" value="<?php echo $pengetahuan_add->visual->EditValue ?>"<?php echo $pengetahuan_add->visual->editAttributes() ?>>
</span>
<?php echo $pengetahuan_add->visual->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$pengetahuan_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $pengetahuan_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $pengetahuan_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$pengetahuan_add->showPageFooter();
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
$pengetahuan_add->terminate();
?>