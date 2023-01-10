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
$hapus_barang_edit = new hapus_barang_edit();

// Run the page
$hapus_barang_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$hapus_barang_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fhapus_barangedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fhapus_barangedit = currentForm = new ew.Form("fhapus_barangedit", "edit");

	// Validate form
	fhapus_barangedit.validate = function() {
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
			<?php if ($hapus_barang_edit->ID_Hapus->Required) { ?>
				elm = this.getElements("x" + infix + "_ID_Hapus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $hapus_barang_edit->ID_Hapus->caption(), $hapus_barang_edit->ID_Hapus->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($hapus_barang_edit->Kode_Barang->Required) { ?>
				elm = this.getElements("x" + infix + "_Kode_Barang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $hapus_barang_edit->Kode_Barang->caption(), $hapus_barang_edit->Kode_Barang->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($hapus_barang_edit->Nama_Barang->Required) { ?>
				elm = this.getElements("x" + infix + "_Nama_Barang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $hapus_barang_edit->Nama_Barang->caption(), $hapus_barang_edit->Nama_Barang->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($hapus_barang_edit->Keterangan->Required) { ?>
				elm = this.getElements("x" + infix + "_Keterangan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $hapus_barang_edit->Keterangan->caption(), $hapus_barang_edit->Keterangan->RequiredErrorMessage)) ?>");
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
	fhapus_barangedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fhapus_barangedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fhapus_barangedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $hapus_barang_edit->showPageHeader(); ?>
<?php
$hapus_barang_edit->showMessage();
?>
<form name="fhapus_barangedit" id="fhapus_barangedit" class="<?php echo $hapus_barang_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="hapus_barang">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$hapus_barang_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($hapus_barang_edit->ID_Hapus->Visible) { // ID_Hapus ?>
	<div id="r_ID_Hapus" class="form-group row">
		<label id="elh_hapus_barang_ID_Hapus" class="<?php echo $hapus_barang_edit->LeftColumnClass ?>"><?php echo $hapus_barang_edit->ID_Hapus->caption() ?><?php echo $hapus_barang_edit->ID_Hapus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $hapus_barang_edit->RightColumnClass ?>"><div <?php echo $hapus_barang_edit->ID_Hapus->cellAttributes() ?>>
<span id="el_hapus_barang_ID_Hapus">
<span<?php echo $hapus_barang_edit->ID_Hapus->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($hapus_barang_edit->ID_Hapus->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="hapus_barang" data-field="x_ID_Hapus" name="x_ID_Hapus" id="x_ID_Hapus" value="<?php echo HtmlEncode($hapus_barang_edit->ID_Hapus->CurrentValue) ?>">
<?php echo $hapus_barang_edit->ID_Hapus->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($hapus_barang_edit->Kode_Barang->Visible) { // Kode_Barang ?>
	<div id="r_Kode_Barang" class="form-group row">
		<label id="elh_hapus_barang_Kode_Barang" for="x_Kode_Barang" class="<?php echo $hapus_barang_edit->LeftColumnClass ?>"><?php echo $hapus_barang_edit->Kode_Barang->caption() ?><?php echo $hapus_barang_edit->Kode_Barang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $hapus_barang_edit->RightColumnClass ?>"><div <?php echo $hapus_barang_edit->Kode_Barang->cellAttributes() ?>>
<span id="el_hapus_barang_Kode_Barang">
<input type="text" data-table="hapus_barang" data-field="x_Kode_Barang" name="x_Kode_Barang" id="x_Kode_Barang" size="30" maxlength="3" placeholder="<?php echo HtmlEncode($hapus_barang_edit->Kode_Barang->getPlaceHolder()) ?>" value="<?php echo $hapus_barang_edit->Kode_Barang->EditValue ?>"<?php echo $hapus_barang_edit->Kode_Barang->editAttributes() ?>>
</span>
<?php echo $hapus_barang_edit->Kode_Barang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($hapus_barang_edit->Nama_Barang->Visible) { // Nama_Barang ?>
	<div id="r_Nama_Barang" class="form-group row">
		<label id="elh_hapus_barang_Nama_Barang" for="x_Nama_Barang" class="<?php echo $hapus_barang_edit->LeftColumnClass ?>"><?php echo $hapus_barang_edit->Nama_Barang->caption() ?><?php echo $hapus_barang_edit->Nama_Barang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $hapus_barang_edit->RightColumnClass ?>"><div <?php echo $hapus_barang_edit->Nama_Barang->cellAttributes() ?>>
<span id="el_hapus_barang_Nama_Barang">
<input type="text" data-table="hapus_barang" data-field="x_Nama_Barang" name="x_Nama_Barang" id="x_Nama_Barang" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($hapus_barang_edit->Nama_Barang->getPlaceHolder()) ?>" value="<?php echo $hapus_barang_edit->Nama_Barang->EditValue ?>"<?php echo $hapus_barang_edit->Nama_Barang->editAttributes() ?>>
</span>
<?php echo $hapus_barang_edit->Nama_Barang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($hapus_barang_edit->Keterangan->Visible) { // Keterangan ?>
	<div id="r_Keterangan" class="form-group row">
		<label id="elh_hapus_barang_Keterangan" for="x_Keterangan" class="<?php echo $hapus_barang_edit->LeftColumnClass ?>"><?php echo $hapus_barang_edit->Keterangan->caption() ?><?php echo $hapus_barang_edit->Keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $hapus_barang_edit->RightColumnClass ?>"><div <?php echo $hapus_barang_edit->Keterangan->cellAttributes() ?>>
<span id="el_hapus_barang_Keterangan">
<textarea data-table="hapus_barang" data-field="x_Keterangan" name="x_Keterangan" id="x_Keterangan" cols="35" rows="4" placeholder="<?php echo HtmlEncode($hapus_barang_edit->Keterangan->getPlaceHolder()) ?>"<?php echo $hapus_barang_edit->Keterangan->editAttributes() ?>><?php echo $hapus_barang_edit->Keterangan->EditValue ?></textarea>
</span>
<?php echo $hapus_barang_edit->Keterangan->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$hapus_barang_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $hapus_barang_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $hapus_barang_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$hapus_barang_edit->showPageFooter();
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
$hapus_barang_edit->terminate();
?>