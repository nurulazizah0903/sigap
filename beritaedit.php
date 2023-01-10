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
$berita_edit = new berita_edit();

// Run the page
$berita_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$berita_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fberitaedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fberitaedit = currentForm = new ew.Form("fberitaedit", "edit");

	// Validate form
	fberitaedit.validate = function() {
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
			<?php if ($berita_edit->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $berita_edit->id->caption(), $berita_edit->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($berita_edit->grup->Required) { ?>
				elm = this.getElements("x" + infix + "_grup");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $berita_edit->grup->caption(), $berita_edit->grup->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($berita_edit->judul->Required) { ?>
				elm = this.getElements("x" + infix + "_judul");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $berita_edit->judul->caption(), $berita_edit->judul->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($berita_edit->berita->Required) { ?>
				elm = this.getElements("x" + infix + "_berita");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $berita_edit->berita->caption(), $berita_edit->berita->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($berita_edit->gambar->Required) { ?>
				elm = this.getElements("x" + infix + "_gambar");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $berita_edit->gambar->caption(), $berita_edit->gambar->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($berita_edit->video->Required) { ?>
				elm = this.getElements("x" + infix + "_video");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $berita_edit->video->caption(), $berita_edit->video->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($berita_edit->c_by->Required) { ?>
				elm = this.getElements("x" + infix + "_c_by");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $berita_edit->c_by->caption(), $berita_edit->c_by->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($berita_edit->c_date->Required) { ?>
				elm = this.getElements("x" + infix + "_c_date");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $berita_edit->c_date->caption(), $berita_edit->c_date->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($berita_edit->aktif->Required) { ?>
				elm = this.getElements("x" + infix + "_aktif");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $berita_edit->aktif->caption(), $berita_edit->aktif->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_aktif");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($berita_edit->aktif->errorMessage()) ?>");

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
	fberitaedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fberitaedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fberitaedit.lists["x_c_by"] = <?php echo $berita_edit->c_by->Lookup->toClientList($berita_edit) ?>;
	fberitaedit.lists["x_c_by"].options = <?php echo JsonEncode($berita_edit->c_by->lookupOptions()) ?>;
	fberitaedit.autoSuggests["x_c_by"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fberitaedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $berita_edit->showPageHeader(); ?>
<?php
$berita_edit->showMessage();
?>
<form name="fberitaedit" id="fberitaedit" class="<?php echo $berita_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="berita">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$berita_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($berita_edit->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_berita_id" class="<?php echo $berita_edit->LeftColumnClass ?>"><?php echo $berita_edit->id->caption() ?><?php echo $berita_edit->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $berita_edit->RightColumnClass ?>"><div <?php echo $berita_edit->id->cellAttributes() ?>>
<span id="el_berita_id">
<span<?php echo $berita_edit->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($berita_edit->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="berita" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($berita_edit->id->CurrentValue) ?>">
<?php echo $berita_edit->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($berita_edit->grup->Visible) { // grup ?>
	<div id="r_grup" class="form-group row">
		<label id="elh_berita_grup" for="x_grup" class="<?php echo $berita_edit->LeftColumnClass ?>"><?php echo $berita_edit->grup->caption() ?><?php echo $berita_edit->grup->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $berita_edit->RightColumnClass ?>"><div <?php echo $berita_edit->grup->cellAttributes() ?>>
<span id="el_berita_grup">
<input type="text" data-table="berita" data-field="x_grup" name="x_grup" id="x_grup" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($berita_edit->grup->getPlaceHolder()) ?>" value="<?php echo $berita_edit->grup->EditValue ?>"<?php echo $berita_edit->grup->editAttributes() ?>>
</span>
<?php echo $berita_edit->grup->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($berita_edit->judul->Visible) { // judul ?>
	<div id="r_judul" class="form-group row">
		<label id="elh_berita_judul" for="x_judul" class="<?php echo $berita_edit->LeftColumnClass ?>"><?php echo $berita_edit->judul->caption() ?><?php echo $berita_edit->judul->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $berita_edit->RightColumnClass ?>"><div <?php echo $berita_edit->judul->cellAttributes() ?>>
<span id="el_berita_judul">
<input type="text" data-table="berita" data-field="x_judul" name="x_judul" id="x_judul" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($berita_edit->judul->getPlaceHolder()) ?>" value="<?php echo $berita_edit->judul->EditValue ?>"<?php echo $berita_edit->judul->editAttributes() ?>>
</span>
<?php echo $berita_edit->judul->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($berita_edit->berita->Visible) { // berita ?>
	<div id="r_berita" class="form-group row">
		<label id="elh_berita_berita" for="x_berita" class="<?php echo $berita_edit->LeftColumnClass ?>"><?php echo $berita_edit->berita->caption() ?><?php echo $berita_edit->berita->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $berita_edit->RightColumnClass ?>"><div <?php echo $berita_edit->berita->cellAttributes() ?>>
<span id="el_berita_berita">
<textarea data-table="berita" data-field="x_berita" name="x_berita" id="x_berita" cols="35" rows="4" placeholder="<?php echo HtmlEncode($berita_edit->berita->getPlaceHolder()) ?>"<?php echo $berita_edit->berita->editAttributes() ?>><?php echo $berita_edit->berita->EditValue ?></textarea>
</span>
<?php echo $berita_edit->berita->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($berita_edit->gambar->Visible) { // gambar ?>
	<div id="r_gambar" class="form-group row">
		<label id="elh_berita_gambar" for="x_gambar" class="<?php echo $berita_edit->LeftColumnClass ?>"><?php echo $berita_edit->gambar->caption() ?><?php echo $berita_edit->gambar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $berita_edit->RightColumnClass ?>"><div <?php echo $berita_edit->gambar->cellAttributes() ?>>
<span id="el_berita_gambar">
<input type="text" data-table="berita" data-field="x_gambar" name="x_gambar" id="x_gambar" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($berita_edit->gambar->getPlaceHolder()) ?>" value="<?php echo $berita_edit->gambar->EditValue ?>"<?php echo $berita_edit->gambar->editAttributes() ?>>
</span>
<?php echo $berita_edit->gambar->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($berita_edit->video->Visible) { // video ?>
	<div id="r_video" class="form-group row">
		<label id="elh_berita_video" for="x_video" class="<?php echo $berita_edit->LeftColumnClass ?>"><?php echo $berita_edit->video->caption() ?><?php echo $berita_edit->video->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $berita_edit->RightColumnClass ?>"><div <?php echo $berita_edit->video->cellAttributes() ?>>
<span id="el_berita_video">
<input type="text" data-table="berita" data-field="x_video" name="x_video" id="x_video" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($berita_edit->video->getPlaceHolder()) ?>" value="<?php echo $berita_edit->video->EditValue ?>"<?php echo $berita_edit->video->editAttributes() ?>>
</span>
<?php echo $berita_edit->video->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($berita_edit->aktif->Visible) { // aktif ?>
	<div id="r_aktif" class="form-group row">
		<label id="elh_berita_aktif" for="x_aktif" class="<?php echo $berita_edit->LeftColumnClass ?>"><?php echo $berita_edit->aktif->caption() ?><?php echo $berita_edit->aktif->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $berita_edit->RightColumnClass ?>"><div <?php echo $berita_edit->aktif->cellAttributes() ?>>
<span id="el_berita_aktif">
<input type="text" data-table="berita" data-field="x_aktif" name="x_aktif" id="x_aktif" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($berita_edit->aktif->getPlaceHolder()) ?>" value="<?php echo $berita_edit->aktif->EditValue ?>"<?php echo $berita_edit->aktif->editAttributes() ?>>
</span>
<?php echo $berita_edit->aktif->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("komentar", explode(",", $berita->getCurrentDetailTable())) && $komentar->DetailEdit) {
?>
<?php if ($berita->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("komentar", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "komentargrid.php" ?>
<?php } ?>
<?php if (!$berita_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $berita_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $berita_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$berita_edit->showPageFooter();
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
$berita_edit->terminate();
?>