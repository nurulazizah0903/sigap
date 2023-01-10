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
$pengetahuan_edit = new pengetahuan_edit();

// Run the page
$pengetahuan_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pengetahuan_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpengetahuanedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fpengetahuanedit = currentForm = new ew.Form("fpengetahuanedit", "edit");

	// Validate form
	fpengetahuanedit.validate = function() {
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
			<?php if ($pengetahuan_edit->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pengetahuan_edit->id->caption(), $pengetahuan_edit->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pengetahuan_edit->grup->Required) { ?>
				elm = this.getElements("x" + infix + "_grup");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pengetahuan_edit->grup->caption(), $pengetahuan_edit->grup->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pengetahuan_edit->judul->Required) { ?>
				elm = this.getElements("x" + infix + "_judul");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pengetahuan_edit->judul->caption(), $pengetahuan_edit->judul->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pengetahuan_edit->isi->Required) { ?>
				elm = this.getElements("x" + infix + "_isi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pengetahuan_edit->isi->caption(), $pengetahuan_edit->isi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pengetahuan_edit->sumber_url->Required) { ?>
				elm = this.getElements("x" + infix + "_sumber_url");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pengetahuan_edit->sumber_url->caption(), $pengetahuan_edit->sumber_url->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pengetahuan_edit->dokumen->Required) { ?>
				elm = this.getElements("x" + infix + "_dokumen");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pengetahuan_edit->dokumen->caption(), $pengetahuan_edit->dokumen->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pengetahuan_edit->visual->Required) { ?>
				elm = this.getElements("x" + infix + "_visual");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pengetahuan_edit->visual->caption(), $pengetahuan_edit->visual->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pengetahuan_edit->c_by->Required) { ?>
				elm = this.getElements("x" + infix + "_c_by");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pengetahuan_edit->c_by->caption(), $pengetahuan_edit->c_by->RequiredErrorMessage)) ?>");
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
	fpengetahuanedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpengetahuanedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fpengetahuanedit.lists["x_c_by"] = <?php echo $pengetahuan_edit->c_by->Lookup->toClientList($pengetahuan_edit) ?>;
	fpengetahuanedit.lists["x_c_by"].options = <?php echo JsonEncode($pengetahuan_edit->c_by->lookupOptions()) ?>;
	fpengetahuanedit.autoSuggests["x_c_by"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fpengetahuanedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $pengetahuan_edit->showPageHeader(); ?>
<?php
$pengetahuan_edit->showMessage();
?>
<form name="fpengetahuanedit" id="fpengetahuanedit" class="<?php echo $pengetahuan_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pengetahuan">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$pengetahuan_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($pengetahuan_edit->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_pengetahuan_id" class="<?php echo $pengetahuan_edit->LeftColumnClass ?>"><?php echo $pengetahuan_edit->id->caption() ?><?php echo $pengetahuan_edit->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pengetahuan_edit->RightColumnClass ?>"><div <?php echo $pengetahuan_edit->id->cellAttributes() ?>>
<span id="el_pengetahuan_id">
<span<?php echo $pengetahuan_edit->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($pengetahuan_edit->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="pengetahuan" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($pengetahuan_edit->id->CurrentValue) ?>">
<?php echo $pengetahuan_edit->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pengetahuan_edit->grup->Visible) { // grup ?>
	<div id="r_grup" class="form-group row">
		<label id="elh_pengetahuan_grup" for="x_grup" class="<?php echo $pengetahuan_edit->LeftColumnClass ?>"><?php echo $pengetahuan_edit->grup->caption() ?><?php echo $pengetahuan_edit->grup->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pengetahuan_edit->RightColumnClass ?>"><div <?php echo $pengetahuan_edit->grup->cellAttributes() ?>>
<span id="el_pengetahuan_grup">
<input type="text" data-table="pengetahuan" data-field="x_grup" name="x_grup" id="x_grup" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($pengetahuan_edit->grup->getPlaceHolder()) ?>" value="<?php echo $pengetahuan_edit->grup->EditValue ?>"<?php echo $pengetahuan_edit->grup->editAttributes() ?>>
</span>
<?php echo $pengetahuan_edit->grup->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pengetahuan_edit->judul->Visible) { // judul ?>
	<div id="r_judul" class="form-group row">
		<label id="elh_pengetahuan_judul" for="x_judul" class="<?php echo $pengetahuan_edit->LeftColumnClass ?>"><?php echo $pengetahuan_edit->judul->caption() ?><?php echo $pengetahuan_edit->judul->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pengetahuan_edit->RightColumnClass ?>"><div <?php echo $pengetahuan_edit->judul->cellAttributes() ?>>
<span id="el_pengetahuan_judul">
<textarea data-table="pengetahuan" data-field="x_judul" name="x_judul" id="x_judul" cols="35" rows="4" placeholder="<?php echo HtmlEncode($pengetahuan_edit->judul->getPlaceHolder()) ?>"<?php echo $pengetahuan_edit->judul->editAttributes() ?>><?php echo $pengetahuan_edit->judul->EditValue ?></textarea>
</span>
<?php echo $pengetahuan_edit->judul->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pengetahuan_edit->isi->Visible) { // isi ?>
	<div id="r_isi" class="form-group row">
		<label id="elh_pengetahuan_isi" for="x_isi" class="<?php echo $pengetahuan_edit->LeftColumnClass ?>"><?php echo $pengetahuan_edit->isi->caption() ?><?php echo $pengetahuan_edit->isi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pengetahuan_edit->RightColumnClass ?>"><div <?php echo $pengetahuan_edit->isi->cellAttributes() ?>>
<span id="el_pengetahuan_isi">
<textarea data-table="pengetahuan" data-field="x_isi" name="x_isi" id="x_isi" cols="35" rows="4" placeholder="<?php echo HtmlEncode($pengetahuan_edit->isi->getPlaceHolder()) ?>"<?php echo $pengetahuan_edit->isi->editAttributes() ?>><?php echo $pengetahuan_edit->isi->EditValue ?></textarea>
</span>
<?php echo $pengetahuan_edit->isi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pengetahuan_edit->sumber_url->Visible) { // sumber_url ?>
	<div id="r_sumber_url" class="form-group row">
		<label id="elh_pengetahuan_sumber_url" for="x_sumber_url" class="<?php echo $pengetahuan_edit->LeftColumnClass ?>"><?php echo $pengetahuan_edit->sumber_url->caption() ?><?php echo $pengetahuan_edit->sumber_url->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pengetahuan_edit->RightColumnClass ?>"><div <?php echo $pengetahuan_edit->sumber_url->cellAttributes() ?>>
<span id="el_pengetahuan_sumber_url">
<input type="text" data-table="pengetahuan" data-field="x_sumber_url" name="x_sumber_url" id="x_sumber_url" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($pengetahuan_edit->sumber_url->getPlaceHolder()) ?>" value="<?php echo $pengetahuan_edit->sumber_url->EditValue ?>"<?php echo $pengetahuan_edit->sumber_url->editAttributes() ?>>
</span>
<?php echo $pengetahuan_edit->sumber_url->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pengetahuan_edit->dokumen->Visible) { // dokumen ?>
	<div id="r_dokumen" class="form-group row">
		<label id="elh_pengetahuan_dokumen" for="x_dokumen" class="<?php echo $pengetahuan_edit->LeftColumnClass ?>"><?php echo $pengetahuan_edit->dokumen->caption() ?><?php echo $pengetahuan_edit->dokumen->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pengetahuan_edit->RightColumnClass ?>"><div <?php echo $pengetahuan_edit->dokumen->cellAttributes() ?>>
<span id="el_pengetahuan_dokumen">
<input type="text" data-table="pengetahuan" data-field="x_dokumen" name="x_dokumen" id="x_dokumen" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($pengetahuan_edit->dokumen->getPlaceHolder()) ?>" value="<?php echo $pengetahuan_edit->dokumen->EditValue ?>"<?php echo $pengetahuan_edit->dokumen->editAttributes() ?>>
</span>
<?php echo $pengetahuan_edit->dokumen->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pengetahuan_edit->visual->Visible) { // visual ?>
	<div id="r_visual" class="form-group row">
		<label id="elh_pengetahuan_visual" for="x_visual" class="<?php echo $pengetahuan_edit->LeftColumnClass ?>"><?php echo $pengetahuan_edit->visual->caption() ?><?php echo $pengetahuan_edit->visual->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pengetahuan_edit->RightColumnClass ?>"><div <?php echo $pengetahuan_edit->visual->cellAttributes() ?>>
<span id="el_pengetahuan_visual">
<input type="text" data-table="pengetahuan" data-field="x_visual" name="x_visual" id="x_visual" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($pengetahuan_edit->visual->getPlaceHolder()) ?>" value="<?php echo $pengetahuan_edit->visual->EditValue ?>"<?php echo $pengetahuan_edit->visual->editAttributes() ?>>
</span>
<?php echo $pengetahuan_edit->visual->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$pengetahuan_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $pengetahuan_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $pengetahuan_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$pengetahuan_edit->showPageFooter();
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
$pengetahuan_edit->terminate();
?>