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
$komentar_add = new komentar_add();

// Run the page
$komentar_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$komentar_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fkomentaradd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fkomentaradd = currentForm = new ew.Form("fkomentaradd", "add");

	// Validate form
	fkomentaradd.validate = function() {
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
			<?php if ($komentar_add->pid->Required) { ?>
				elm = this.getElements("x" + infix + "_pid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $komentar_add->pid->caption(), $komentar_add->pid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pid");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($komentar_add->pid->errorMessage()) ?>");
			<?php if ($komentar_add->komentar->Required) { ?>
				elm = this.getElements("x" + infix + "_komentar");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $komentar_add->komentar->caption(), $komentar_add->komentar->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($komentar_add->gambar->Required) { ?>
				elm = this.getElements("x" + infix + "_gambar");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $komentar_add->gambar->caption(), $komentar_add->gambar->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($komentar_add->video->Required) { ?>
				elm = this.getElements("x" + infix + "_video");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $komentar_add->video->caption(), $komentar_add->video->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($komentar_add->pegawai->Required) { ?>
				elm = this.getElements("x" + infix + "_pegawai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $komentar_add->pegawai->caption(), $komentar_add->pegawai->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pegawai");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($komentar_add->pegawai->errorMessage()) ?>");

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
	fkomentaradd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fkomentaradd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fkomentaradd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $komentar_add->showPageHeader(); ?>
<?php
$komentar_add->showMessage();
?>
<form name="fkomentaradd" id="fkomentaradd" class="<?php echo $komentar_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="komentar">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$komentar_add->IsModal ?>">
<?php if ($komentar->getCurrentMasterTable() == "berita") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="berita">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($komentar_add->pid->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($komentar_add->pid->Visible) { // pid ?>
	<div id="r_pid" class="form-group row">
		<label id="elh_komentar_pid" for="x_pid" class="<?php echo $komentar_add->LeftColumnClass ?>"><?php echo $komentar_add->pid->caption() ?><?php echo $komentar_add->pid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $komentar_add->RightColumnClass ?>"><div <?php echo $komentar_add->pid->cellAttributes() ?>>
<?php if ($komentar_add->pid->getSessionValue() != "") { ?>
<span id="el_komentar_pid">
<span<?php echo $komentar_add->pid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($komentar_add->pid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_pid" name="x_pid" value="<?php echo HtmlEncode($komentar_add->pid->CurrentValue) ?>">
<?php } else { ?>
<span id="el_komentar_pid">
<input type="text" data-table="komentar" data-field="x_pid" name="x_pid" id="x_pid" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($komentar_add->pid->getPlaceHolder()) ?>" value="<?php echo $komentar_add->pid->EditValue ?>"<?php echo $komentar_add->pid->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $komentar_add->pid->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($komentar_add->komentar->Visible) { // komentar ?>
	<div id="r_komentar" class="form-group row">
		<label id="elh_komentar_komentar" for="x_komentar" class="<?php echo $komentar_add->LeftColumnClass ?>"><?php echo $komentar_add->komentar->caption() ?><?php echo $komentar_add->komentar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $komentar_add->RightColumnClass ?>"><div <?php echo $komentar_add->komentar->cellAttributes() ?>>
<span id="el_komentar_komentar">
<textarea data-table="komentar" data-field="x_komentar" name="x_komentar" id="x_komentar" cols="35" rows="4" placeholder="<?php echo HtmlEncode($komentar_add->komentar->getPlaceHolder()) ?>"<?php echo $komentar_add->komentar->editAttributes() ?>><?php echo $komentar_add->komentar->EditValue ?></textarea>
</span>
<?php echo $komentar_add->komentar->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($komentar_add->gambar->Visible) { // gambar ?>
	<div id="r_gambar" class="form-group row">
		<label id="elh_komentar_gambar" for="x_gambar" class="<?php echo $komentar_add->LeftColumnClass ?>"><?php echo $komentar_add->gambar->caption() ?><?php echo $komentar_add->gambar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $komentar_add->RightColumnClass ?>"><div <?php echo $komentar_add->gambar->cellAttributes() ?>>
<span id="el_komentar_gambar">
<input type="text" data-table="komentar" data-field="x_gambar" name="x_gambar" id="x_gambar" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($komentar_add->gambar->getPlaceHolder()) ?>" value="<?php echo $komentar_add->gambar->EditValue ?>"<?php echo $komentar_add->gambar->editAttributes() ?>>
</span>
<?php echo $komentar_add->gambar->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($komentar_add->video->Visible) { // video ?>
	<div id="r_video" class="form-group row">
		<label id="elh_komentar_video" for="x_video" class="<?php echo $komentar_add->LeftColumnClass ?>"><?php echo $komentar_add->video->caption() ?><?php echo $komentar_add->video->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $komentar_add->RightColumnClass ?>"><div <?php echo $komentar_add->video->cellAttributes() ?>>
<span id="el_komentar_video">
<input type="text" data-table="komentar" data-field="x_video" name="x_video" id="x_video" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($komentar_add->video->getPlaceHolder()) ?>" value="<?php echo $komentar_add->video->EditValue ?>"<?php echo $komentar_add->video->editAttributes() ?>>
</span>
<?php echo $komentar_add->video->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($komentar_add->pegawai->Visible) { // pegawai ?>
	<div id="r_pegawai" class="form-group row">
		<label id="elh_komentar_pegawai" for="x_pegawai" class="<?php echo $komentar_add->LeftColumnClass ?>"><?php echo $komentar_add->pegawai->caption() ?><?php echo $komentar_add->pegawai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $komentar_add->RightColumnClass ?>"><div <?php echo $komentar_add->pegawai->cellAttributes() ?>>
<span id="el_komentar_pegawai">
<input type="text" data-table="komentar" data-field="x_pegawai" name="x_pegawai" id="x_pegawai" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($komentar_add->pegawai->getPlaceHolder()) ?>" value="<?php echo $komentar_add->pegawai->EditValue ?>"<?php echo $komentar_add->pegawai->editAttributes() ?>>
</span>
<?php echo $komentar_add->pegawai->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$komentar_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $komentar_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $komentar_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$komentar_add->showPageFooter();
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
$komentar_add->terminate();
?>