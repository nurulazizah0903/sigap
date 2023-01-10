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
$uangmuka_add = new uangmuka_add();

// Run the page
$uangmuka_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$uangmuka_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fuangmukaadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fuangmukaadd = currentForm = new ew.Form("fuangmukaadd", "add");

	// Validate form
	fuangmukaadd.validate = function() {
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
			<?php if ($uangmuka_add->tgl->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $uangmuka_add->tgl->caption(), $uangmuka_add->tgl->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($uangmuka_add->tgl->errorMessage()) ?>");
			<?php if ($uangmuka_add->pembayar->Required) { ?>
				elm = this.getElements("x" + infix + "_pembayar");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $uangmuka_add->pembayar->caption(), $uangmuka_add->pembayar->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pembayar");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($uangmuka_add->pembayar->errorMessage()) ?>");
			<?php if ($uangmuka_add->peruntukan->Required) { ?>
				elm = this.getElements("x" + infix + "_peruntukan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $uangmuka_add->peruntukan->caption(), $uangmuka_add->peruntukan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($uangmuka_add->penerima->Required) { ?>
				elm = this.getElements("x" + infix + "_penerima");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $uangmuka_add->penerima->caption(), $uangmuka_add->penerima->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_penerima");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($uangmuka_add->penerima->errorMessage()) ?>");
			<?php if ($uangmuka_add->rek_penerima->Required) { ?>
				elm = this.getElements("x" + infix + "_rek_penerima");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $uangmuka_add->rek_penerima->caption(), $uangmuka_add->rek_penerima->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($uangmuka_add->tgl_terima->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_terima");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $uangmuka_add->tgl_terima->caption(), $uangmuka_add->tgl_terima->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_terima");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($uangmuka_add->tgl_terima->errorMessage()) ?>");
			<?php if ($uangmuka_add->total_terima->Required) { ?>
				elm = this.getElements("x" + infix + "_total_terima");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $uangmuka_add->total_terima->caption(), $uangmuka_add->total_terima->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_total_terima");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($uangmuka_add->total_terima->errorMessage()) ?>");
			<?php if ($uangmuka_add->tgl_tgjb->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_tgjb");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $uangmuka_add->tgl_tgjb->caption(), $uangmuka_add->tgl_tgjb->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_tgjb");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($uangmuka_add->tgl_tgjb->errorMessage()) ?>");
			<?php if ($uangmuka_add->jumlah_tgjb->Required) { ?>
				elm = this.getElements("x" + infix + "_jumlah_tgjb");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $uangmuka_add->jumlah_tgjb->caption(), $uangmuka_add->jumlah_tgjb->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jumlah_tgjb");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($uangmuka_add->jumlah_tgjb->errorMessage()) ?>");
			<?php if ($uangmuka_add->jenis->Required) { ?>
				elm = this.getElements("x" + infix + "_jenis");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $uangmuka_add->jenis->caption(), $uangmuka_add->jenis->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($uangmuka_add->bukti1->Required) { ?>
				felm = this.getElements("x" + infix + "_bukti1");
				elm = this.getElements("fn_x" + infix + "_bukti1");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $uangmuka_add->bukti1->caption(), $uangmuka_add->bukti1->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($uangmuka_add->bukti2->Required) { ?>
				felm = this.getElements("x" + infix + "_bukti2");
				elm = this.getElements("fn_x" + infix + "_bukti2");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $uangmuka_add->bukti2->caption(), $uangmuka_add->bukti2->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($uangmuka_add->bukti3->Required) { ?>
				felm = this.getElements("x" + infix + "_bukti3");
				elm = this.getElements("fn_x" + infix + "_bukti3");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $uangmuka_add->bukti3->caption(), $uangmuka_add->bukti3->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($uangmuka_add->bukti4->Required) { ?>
				felm = this.getElements("x" + infix + "_bukti4");
				elm = this.getElements("fn_x" + infix + "_bukti4");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $uangmuka_add->bukti4->caption(), $uangmuka_add->bukti4->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($uangmuka_add->disetujui->Required) { ?>
				elm = this.getElements("x" + infix + "_disetujui");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $uangmuka_add->disetujui->caption(), $uangmuka_add->disetujui->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($uangmuka_add->status->Required) { ?>
				elm = this.getElements("x" + infix + "_status");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $uangmuka_add->status->caption(), $uangmuka_add->status->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($uangmuka_add->keterangan->Required) { ?>
				elm = this.getElements("x" + infix + "_keterangan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $uangmuka_add->keterangan->caption(), $uangmuka_add->keterangan->RequiredErrorMessage)) ?>");
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
	fuangmukaadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fuangmukaadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fuangmukaadd.lists["x_disetujui"] = <?php echo $uangmuka_add->disetujui->Lookup->toClientList($uangmuka_add) ?>;
	fuangmukaadd.lists["x_disetujui"].options = <?php echo JsonEncode($uangmuka_add->disetujui->lookupOptions()) ?>;
	loadjs.done("fuangmukaadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $uangmuka_add->showPageHeader(); ?>
<?php
$uangmuka_add->showMessage();
?>
<form name="fuangmukaadd" id="fuangmukaadd" class="<?php echo $uangmuka_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="uangmuka">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$uangmuka_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($uangmuka_add->tgl->Visible) { // tgl ?>
	<div id="r_tgl" class="form-group row">
		<label id="elh_uangmuka_tgl" for="x_tgl" class="<?php echo $uangmuka_add->LeftColumnClass ?>"><?php echo $uangmuka_add->tgl->caption() ?><?php echo $uangmuka_add->tgl->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $uangmuka_add->RightColumnClass ?>"><div <?php echo $uangmuka_add->tgl->cellAttributes() ?>>
<span id="el_uangmuka_tgl">
<input type="text" data-table="uangmuka" data-field="x_tgl" name="x_tgl" id="x_tgl" maxlength="19" placeholder="<?php echo HtmlEncode($uangmuka_add->tgl->getPlaceHolder()) ?>" value="<?php echo $uangmuka_add->tgl->EditValue ?>"<?php echo $uangmuka_add->tgl->editAttributes() ?>>
<?php if (!$uangmuka_add->tgl->ReadOnly && !$uangmuka_add->tgl->Disabled && !isset($uangmuka_add->tgl->EditAttrs["readonly"]) && !isset($uangmuka_add->tgl->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fuangmukaadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fuangmukaadd", "x_tgl", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $uangmuka_add->tgl->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($uangmuka_add->pembayar->Visible) { // pembayar ?>
	<div id="r_pembayar" class="form-group row">
		<label id="elh_uangmuka_pembayar" for="x_pembayar" class="<?php echo $uangmuka_add->LeftColumnClass ?>"><?php echo $uangmuka_add->pembayar->caption() ?><?php echo $uangmuka_add->pembayar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $uangmuka_add->RightColumnClass ?>"><div <?php echo $uangmuka_add->pembayar->cellAttributes() ?>>
<span id="el_uangmuka_pembayar">
<input type="text" data-table="uangmuka" data-field="x_pembayar" name="x_pembayar" id="x_pembayar" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($uangmuka_add->pembayar->getPlaceHolder()) ?>" value="<?php echo $uangmuka_add->pembayar->EditValue ?>"<?php echo $uangmuka_add->pembayar->editAttributes() ?>>
</span>
<?php echo $uangmuka_add->pembayar->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($uangmuka_add->peruntukan->Visible) { // peruntukan ?>
	<div id="r_peruntukan" class="form-group row">
		<label id="elh_uangmuka_peruntukan" for="x_peruntukan" class="<?php echo $uangmuka_add->LeftColumnClass ?>"><?php echo $uangmuka_add->peruntukan->caption() ?><?php echo $uangmuka_add->peruntukan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $uangmuka_add->RightColumnClass ?>"><div <?php echo $uangmuka_add->peruntukan->cellAttributes() ?>>
<span id="el_uangmuka_peruntukan">
<input type="text" data-table="uangmuka" data-field="x_peruntukan" name="x_peruntukan" id="x_peruntukan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($uangmuka_add->peruntukan->getPlaceHolder()) ?>" value="<?php echo $uangmuka_add->peruntukan->EditValue ?>"<?php echo $uangmuka_add->peruntukan->editAttributes() ?>>
</span>
<?php echo $uangmuka_add->peruntukan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($uangmuka_add->penerima->Visible) { // penerima ?>
	<div id="r_penerima" class="form-group row">
		<label id="elh_uangmuka_penerima" for="x_penerima" class="<?php echo $uangmuka_add->LeftColumnClass ?>"><?php echo $uangmuka_add->penerima->caption() ?><?php echo $uangmuka_add->penerima->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $uangmuka_add->RightColumnClass ?>"><div <?php echo $uangmuka_add->penerima->cellAttributes() ?>>
<span id="el_uangmuka_penerima">
<input type="text" data-table="uangmuka" data-field="x_penerima" name="x_penerima" id="x_penerima" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($uangmuka_add->penerima->getPlaceHolder()) ?>" value="<?php echo $uangmuka_add->penerima->EditValue ?>"<?php echo $uangmuka_add->penerima->editAttributes() ?>>
</span>
<?php echo $uangmuka_add->penerima->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($uangmuka_add->rek_penerima->Visible) { // rek_penerima ?>
	<div id="r_rek_penerima" class="form-group row">
		<label id="elh_uangmuka_rek_penerima" for="x_rek_penerima" class="<?php echo $uangmuka_add->LeftColumnClass ?>"><?php echo $uangmuka_add->rek_penerima->caption() ?><?php echo $uangmuka_add->rek_penerima->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $uangmuka_add->RightColumnClass ?>"><div <?php echo $uangmuka_add->rek_penerima->cellAttributes() ?>>
<span id="el_uangmuka_rek_penerima">
<input type="text" data-table="uangmuka" data-field="x_rek_penerima" name="x_rek_penerima" id="x_rek_penerima" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($uangmuka_add->rek_penerima->getPlaceHolder()) ?>" value="<?php echo $uangmuka_add->rek_penerima->EditValue ?>"<?php echo $uangmuka_add->rek_penerima->editAttributes() ?>>
</span>
<?php echo $uangmuka_add->rek_penerima->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($uangmuka_add->tgl_terima->Visible) { // tgl_terima ?>
	<div id="r_tgl_terima" class="form-group row">
		<label id="elh_uangmuka_tgl_terima" for="x_tgl_terima" class="<?php echo $uangmuka_add->LeftColumnClass ?>"><?php echo $uangmuka_add->tgl_terima->caption() ?><?php echo $uangmuka_add->tgl_terima->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $uangmuka_add->RightColumnClass ?>"><div <?php echo $uangmuka_add->tgl_terima->cellAttributes() ?>>
<span id="el_uangmuka_tgl_terima">
<input type="text" data-table="uangmuka" data-field="x_tgl_terima" name="x_tgl_terima" id="x_tgl_terima" maxlength="19" placeholder="<?php echo HtmlEncode($uangmuka_add->tgl_terima->getPlaceHolder()) ?>" value="<?php echo $uangmuka_add->tgl_terima->EditValue ?>"<?php echo $uangmuka_add->tgl_terima->editAttributes() ?>>
<?php if (!$uangmuka_add->tgl_terima->ReadOnly && !$uangmuka_add->tgl_terima->Disabled && !isset($uangmuka_add->tgl_terima->EditAttrs["readonly"]) && !isset($uangmuka_add->tgl_terima->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fuangmukaadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fuangmukaadd", "x_tgl_terima", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $uangmuka_add->tgl_terima->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($uangmuka_add->total_terima->Visible) { // total_terima ?>
	<div id="r_total_terima" class="form-group row">
		<label id="elh_uangmuka_total_terima" for="x_total_terima" class="<?php echo $uangmuka_add->LeftColumnClass ?>"><?php echo $uangmuka_add->total_terima->caption() ?><?php echo $uangmuka_add->total_terima->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $uangmuka_add->RightColumnClass ?>"><div <?php echo $uangmuka_add->total_terima->cellAttributes() ?>>
<span id="el_uangmuka_total_terima">
<input type="text" data-table="uangmuka" data-field="x_total_terima" name="x_total_terima" id="x_total_terima" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($uangmuka_add->total_terima->getPlaceHolder()) ?>" value="<?php echo $uangmuka_add->total_terima->EditValue ?>"<?php echo $uangmuka_add->total_terima->editAttributes() ?>>
</span>
<?php echo $uangmuka_add->total_terima->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($uangmuka_add->tgl_tgjb->Visible) { // tgl_tgjb ?>
	<div id="r_tgl_tgjb" class="form-group row">
		<label id="elh_uangmuka_tgl_tgjb" for="x_tgl_tgjb" class="<?php echo $uangmuka_add->LeftColumnClass ?>"><?php echo $uangmuka_add->tgl_tgjb->caption() ?><?php echo $uangmuka_add->tgl_tgjb->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $uangmuka_add->RightColumnClass ?>"><div <?php echo $uangmuka_add->tgl_tgjb->cellAttributes() ?>>
<span id="el_uangmuka_tgl_tgjb">
<input type="text" data-table="uangmuka" data-field="x_tgl_tgjb" name="x_tgl_tgjb" id="x_tgl_tgjb" maxlength="19" placeholder="<?php echo HtmlEncode($uangmuka_add->tgl_tgjb->getPlaceHolder()) ?>" value="<?php echo $uangmuka_add->tgl_tgjb->EditValue ?>"<?php echo $uangmuka_add->tgl_tgjb->editAttributes() ?>>
<?php if (!$uangmuka_add->tgl_tgjb->ReadOnly && !$uangmuka_add->tgl_tgjb->Disabled && !isset($uangmuka_add->tgl_tgjb->EditAttrs["readonly"]) && !isset($uangmuka_add->tgl_tgjb->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fuangmukaadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fuangmukaadd", "x_tgl_tgjb", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $uangmuka_add->tgl_tgjb->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($uangmuka_add->jumlah_tgjb->Visible) { // jumlah_tgjb ?>
	<div id="r_jumlah_tgjb" class="form-group row">
		<label id="elh_uangmuka_jumlah_tgjb" for="x_jumlah_tgjb" class="<?php echo $uangmuka_add->LeftColumnClass ?>"><?php echo $uangmuka_add->jumlah_tgjb->caption() ?><?php echo $uangmuka_add->jumlah_tgjb->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $uangmuka_add->RightColumnClass ?>"><div <?php echo $uangmuka_add->jumlah_tgjb->cellAttributes() ?>>
<span id="el_uangmuka_jumlah_tgjb">
<input type="text" data-table="uangmuka" data-field="x_jumlah_tgjb" name="x_jumlah_tgjb" id="x_jumlah_tgjb" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($uangmuka_add->jumlah_tgjb->getPlaceHolder()) ?>" value="<?php echo $uangmuka_add->jumlah_tgjb->EditValue ?>"<?php echo $uangmuka_add->jumlah_tgjb->editAttributes() ?>>
</span>
<?php echo $uangmuka_add->jumlah_tgjb->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($uangmuka_add->jenis->Visible) { // jenis ?>
	<div id="r_jenis" class="form-group row">
		<label id="elh_uangmuka_jenis" for="x_jenis" class="<?php echo $uangmuka_add->LeftColumnClass ?>"><?php echo $uangmuka_add->jenis->caption() ?><?php echo $uangmuka_add->jenis->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $uangmuka_add->RightColumnClass ?>"><div <?php echo $uangmuka_add->jenis->cellAttributes() ?>>
<span id="el_uangmuka_jenis">
<input type="text" data-table="uangmuka" data-field="x_jenis" name="x_jenis" id="x_jenis" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($uangmuka_add->jenis->getPlaceHolder()) ?>" value="<?php echo $uangmuka_add->jenis->EditValue ?>"<?php echo $uangmuka_add->jenis->editAttributes() ?>>
</span>
<?php echo $uangmuka_add->jenis->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($uangmuka_add->bukti1->Visible) { // bukti1 ?>
	<div id="r_bukti1" class="form-group row">
		<label id="elh_uangmuka_bukti1" class="<?php echo $uangmuka_add->LeftColumnClass ?>"><?php echo $uangmuka_add->bukti1->caption() ?><?php echo $uangmuka_add->bukti1->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $uangmuka_add->RightColumnClass ?>"><div <?php echo $uangmuka_add->bukti1->cellAttributes() ?>>
<span id="el_uangmuka_bukti1">
<div id="fd_x_bukti1">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $uangmuka_add->bukti1->title() ?>" data-table="uangmuka" data-field="x_bukti1" name="x_bukti1" id="x_bukti1" lang="<?php echo CurrentLanguageID() ?>"<?php echo $uangmuka_add->bukti1->editAttributes() ?><?php if ($uangmuka_add->bukti1->ReadOnly || $uangmuka_add->bukti1->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_bukti1"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_bukti1" id= "fn_x_bukti1" value="<?php echo $uangmuka_add->bukti1->Upload->FileName ?>">
<input type="hidden" name="fa_x_bukti1" id= "fa_x_bukti1" value="0">
<input type="hidden" name="fs_x_bukti1" id= "fs_x_bukti1" value="255">
<input type="hidden" name="fx_x_bukti1" id= "fx_x_bukti1" value="<?php echo $uangmuka_add->bukti1->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_bukti1" id= "fm_x_bukti1" value="<?php echo $uangmuka_add->bukti1->UploadMaxFileSize ?>">
</div>
<table id="ft_x_bukti1" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $uangmuka_add->bukti1->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($uangmuka_add->bukti2->Visible) { // bukti2 ?>
	<div id="r_bukti2" class="form-group row">
		<label id="elh_uangmuka_bukti2" class="<?php echo $uangmuka_add->LeftColumnClass ?>"><?php echo $uangmuka_add->bukti2->caption() ?><?php echo $uangmuka_add->bukti2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $uangmuka_add->RightColumnClass ?>"><div <?php echo $uangmuka_add->bukti2->cellAttributes() ?>>
<span id="el_uangmuka_bukti2">
<div id="fd_x_bukti2">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $uangmuka_add->bukti2->title() ?>" data-table="uangmuka" data-field="x_bukti2" name="x_bukti2" id="x_bukti2" lang="<?php echo CurrentLanguageID() ?>"<?php echo $uangmuka_add->bukti2->editAttributes() ?><?php if ($uangmuka_add->bukti2->ReadOnly || $uangmuka_add->bukti2->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_bukti2"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_bukti2" id= "fn_x_bukti2" value="<?php echo $uangmuka_add->bukti2->Upload->FileName ?>">
<input type="hidden" name="fa_x_bukti2" id= "fa_x_bukti2" value="0">
<input type="hidden" name="fs_x_bukti2" id= "fs_x_bukti2" value="255">
<input type="hidden" name="fx_x_bukti2" id= "fx_x_bukti2" value="<?php echo $uangmuka_add->bukti2->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_bukti2" id= "fm_x_bukti2" value="<?php echo $uangmuka_add->bukti2->UploadMaxFileSize ?>">
</div>
<table id="ft_x_bukti2" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $uangmuka_add->bukti2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($uangmuka_add->bukti3->Visible) { // bukti3 ?>
	<div id="r_bukti3" class="form-group row">
		<label id="elh_uangmuka_bukti3" class="<?php echo $uangmuka_add->LeftColumnClass ?>"><?php echo $uangmuka_add->bukti3->caption() ?><?php echo $uangmuka_add->bukti3->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $uangmuka_add->RightColumnClass ?>"><div <?php echo $uangmuka_add->bukti3->cellAttributes() ?>>
<span id="el_uangmuka_bukti3">
<div id="fd_x_bukti3">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $uangmuka_add->bukti3->title() ?>" data-table="uangmuka" data-field="x_bukti3" name="x_bukti3" id="x_bukti3" lang="<?php echo CurrentLanguageID() ?>"<?php echo $uangmuka_add->bukti3->editAttributes() ?><?php if ($uangmuka_add->bukti3->ReadOnly || $uangmuka_add->bukti3->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_bukti3"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_bukti3" id= "fn_x_bukti3" value="<?php echo $uangmuka_add->bukti3->Upload->FileName ?>">
<input type="hidden" name="fa_x_bukti3" id= "fa_x_bukti3" value="0">
<input type="hidden" name="fs_x_bukti3" id= "fs_x_bukti3" value="255">
<input type="hidden" name="fx_x_bukti3" id= "fx_x_bukti3" value="<?php echo $uangmuka_add->bukti3->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_bukti3" id= "fm_x_bukti3" value="<?php echo $uangmuka_add->bukti3->UploadMaxFileSize ?>">
</div>
<table id="ft_x_bukti3" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $uangmuka_add->bukti3->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($uangmuka_add->bukti4->Visible) { // bukti4 ?>
	<div id="r_bukti4" class="form-group row">
		<label id="elh_uangmuka_bukti4" class="<?php echo $uangmuka_add->LeftColumnClass ?>"><?php echo $uangmuka_add->bukti4->caption() ?><?php echo $uangmuka_add->bukti4->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $uangmuka_add->RightColumnClass ?>"><div <?php echo $uangmuka_add->bukti4->cellAttributes() ?>>
<span id="el_uangmuka_bukti4">
<div id="fd_x_bukti4">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $uangmuka_add->bukti4->title() ?>" data-table="uangmuka" data-field="x_bukti4" name="x_bukti4" id="x_bukti4" lang="<?php echo CurrentLanguageID() ?>"<?php echo $uangmuka_add->bukti4->editAttributes() ?><?php if ($uangmuka_add->bukti4->ReadOnly || $uangmuka_add->bukti4->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_bukti4"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_bukti4" id= "fn_x_bukti4" value="<?php echo $uangmuka_add->bukti4->Upload->FileName ?>">
<input type="hidden" name="fa_x_bukti4" id= "fa_x_bukti4" value="0">
<input type="hidden" name="fs_x_bukti4" id= "fs_x_bukti4" value="255">
<input type="hidden" name="fx_x_bukti4" id= "fx_x_bukti4" value="<?php echo $uangmuka_add->bukti4->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_bukti4" id= "fm_x_bukti4" value="<?php echo $uangmuka_add->bukti4->UploadMaxFileSize ?>">
</div>
<table id="ft_x_bukti4" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $uangmuka_add->bukti4->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($uangmuka_add->disetujui->Visible) { // disetujui ?>
	<div id="r_disetujui" class="form-group row">
		<label id="elh_uangmuka_disetujui" class="<?php echo $uangmuka_add->LeftColumnClass ?>"><?php echo $uangmuka_add->disetujui->caption() ?><?php echo $uangmuka_add->disetujui->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $uangmuka_add->RightColumnClass ?>"><div <?php echo $uangmuka_add->disetujui->cellAttributes() ?>>
<span id="el_uangmuka_disetujui">
<div id="tp_x_disetujui" class="ew-template"><input type="radio" class="custom-control-input" data-table="uangmuka" data-field="x_disetujui" data-value-separator="<?php echo $uangmuka_add->disetujui->displayValueSeparatorAttribute() ?>" name="x_disetujui" id="x_disetujui" value="{value}"<?php echo $uangmuka_add->disetujui->editAttributes() ?>></div>
<div id="dsl_x_disetujui" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $uangmuka_add->disetujui->radioButtonListHtml(FALSE, "x_disetujui") ?>
</div></div>
<?php echo $uangmuka_add->disetujui->Lookup->getParamTag($uangmuka_add, "p_x_disetujui") ?>
</span>
<?php echo $uangmuka_add->disetujui->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($uangmuka_add->status->Visible) { // status ?>
	<div id="r_status" class="form-group row">
		<label id="elh_uangmuka_status" for="x_status" class="<?php echo $uangmuka_add->LeftColumnClass ?>"><?php echo $uangmuka_add->status->caption() ?><?php echo $uangmuka_add->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $uangmuka_add->RightColumnClass ?>"><div <?php echo $uangmuka_add->status->cellAttributes() ?>>
<span id="el_uangmuka_status">
<input type="text" data-table="uangmuka" data-field="x_status" name="x_status" id="x_status" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($uangmuka_add->status->getPlaceHolder()) ?>" value="<?php echo $uangmuka_add->status->EditValue ?>"<?php echo $uangmuka_add->status->editAttributes() ?>>
</span>
<?php echo $uangmuka_add->status->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($uangmuka_add->keterangan->Visible) { // keterangan ?>
	<div id="r_keterangan" class="form-group row">
		<label id="elh_uangmuka_keterangan" for="x_keterangan" class="<?php echo $uangmuka_add->LeftColumnClass ?>"><?php echo $uangmuka_add->keterangan->caption() ?><?php echo $uangmuka_add->keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $uangmuka_add->RightColumnClass ?>"><div <?php echo $uangmuka_add->keterangan->cellAttributes() ?>>
<span id="el_uangmuka_keterangan">
<textarea data-table="uangmuka" data-field="x_keterangan" name="x_keterangan" id="x_keterangan" cols="35" rows="4" placeholder="<?php echo HtmlEncode($uangmuka_add->keterangan->getPlaceHolder()) ?>"<?php echo $uangmuka_add->keterangan->editAttributes() ?>><?php echo $uangmuka_add->keterangan->EditValue ?></textarea>
</span>
<?php echo $uangmuka_add->keterangan->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$uangmuka_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $uangmuka_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $uangmuka_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$uangmuka_add->showPageFooter();
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
$uangmuka_add->terminate();
?>