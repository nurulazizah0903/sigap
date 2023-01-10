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
$hapus_barang_add = new hapus_barang_add();

// Run the page
$hapus_barang_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$hapus_barang_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fhapus_barangadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fhapus_barangadd = currentForm = new ew.Form("fhapus_barangadd", "add");

	// Validate form
	fhapus_barangadd.validate = function() {
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
			<?php if ($hapus_barang_add->Kode_Barang->Required) { ?>
				elm = this.getElements("x" + infix + "_Kode_Barang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $hapus_barang_add->Kode_Barang->caption(), $hapus_barang_add->Kode_Barang->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($hapus_barang_add->Nama_Barang->Required) { ?>
				elm = this.getElements("x" + infix + "_Nama_Barang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $hapus_barang_add->Nama_Barang->caption(), $hapus_barang_add->Nama_Barang->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($hapus_barang_add->Keterangan->Required) { ?>
				elm = this.getElements("x" + infix + "_Keterangan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $hapus_barang_add->Keterangan->caption(), $hapus_barang_add->Keterangan->RequiredErrorMessage)) ?>");
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
	fhapus_barangadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fhapus_barangadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fhapus_barangadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $hapus_barang_add->showPageHeader(); ?>
<?php
$hapus_barang_add->showMessage();
?>
<form name="fhapus_barangadd" id="fhapus_barangadd" class="<?php echo $hapus_barang_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="hapus_barang">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$hapus_barang_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($hapus_barang_add->Kode_Barang->Visible) { // Kode_Barang ?>
	<div id="r_Kode_Barang" class="form-group row">
		<label id="elh_hapus_barang_Kode_Barang" for="x_Kode_Barang" class="<?php echo $hapus_barang_add->LeftColumnClass ?>"><?php echo $hapus_barang_add->Kode_Barang->caption() ?><?php echo $hapus_barang_add->Kode_Barang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $hapus_barang_add->RightColumnClass ?>"><div <?php echo $hapus_barang_add->Kode_Barang->cellAttributes() ?>>
<span id="el_hapus_barang_Kode_Barang">
<input type="text" data-table="hapus_barang" data-field="x_Kode_Barang" name="x_Kode_Barang" id="x_Kode_Barang" size="30" maxlength="3" placeholder="<?php echo HtmlEncode($hapus_barang_add->Kode_Barang->getPlaceHolder()) ?>" value="<?php echo $hapus_barang_add->Kode_Barang->EditValue ?>"<?php echo $hapus_barang_add->Kode_Barang->editAttributes() ?>>
</span>
<?php echo $hapus_barang_add->Kode_Barang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($hapus_barang_add->Nama_Barang->Visible) { // Nama_Barang ?>
	<div id="r_Nama_Barang" class="form-group row">
		<label id="elh_hapus_barang_Nama_Barang" for="x_Nama_Barang" class="<?php echo $hapus_barang_add->LeftColumnClass ?>"><?php echo $hapus_barang_add->Nama_Barang->caption() ?><?php echo $hapus_barang_add->Nama_Barang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $hapus_barang_add->RightColumnClass ?>"><div <?php echo $hapus_barang_add->Nama_Barang->cellAttributes() ?>>
<span id="el_hapus_barang_Nama_Barang">
<input type="text" data-table="hapus_barang" data-field="x_Nama_Barang" name="x_Nama_Barang" id="x_Nama_Barang" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($hapus_barang_add->Nama_Barang->getPlaceHolder()) ?>" value="<?php echo $hapus_barang_add->Nama_Barang->EditValue ?>"<?php echo $hapus_barang_add->Nama_Barang->editAttributes() ?>>
</span>
<?php echo $hapus_barang_add->Nama_Barang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($hapus_barang_add->Keterangan->Visible) { // Keterangan ?>
	<div id="r_Keterangan" class="form-group row">
		<label id="elh_hapus_barang_Keterangan" for="x_Keterangan" class="<?php echo $hapus_barang_add->LeftColumnClass ?>"><?php echo $hapus_barang_add->Keterangan->caption() ?><?php echo $hapus_barang_add->Keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $hapus_barang_add->RightColumnClass ?>"><div <?php echo $hapus_barang_add->Keterangan->cellAttributes() ?>>
<span id="el_hapus_barang_Keterangan">
<textarea data-table="hapus_barang" data-field="x_Keterangan" name="x_Keterangan" id="x_Keterangan" cols="35" rows="4" placeholder="<?php echo HtmlEncode($hapus_barang_add->Keterangan->getPlaceHolder()) ?>"<?php echo $hapus_barang_add->Keterangan->editAttributes() ?>><?php echo $hapus_barang_add->Keterangan->EditValue ?></textarea>
</span>
<?php echo $hapus_barang_add->Keterangan->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$hapus_barang_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $hapus_barang_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $hapus_barang_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$hapus_barang_add->showPageFooter();
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
$hapus_barang_add->terminate();
?>