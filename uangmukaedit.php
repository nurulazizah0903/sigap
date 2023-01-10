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
$uangmuka_edit = new uangmuka_edit();

// Run the page
$uangmuka_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$uangmuka_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fuangmukaedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fuangmukaedit = currentForm = new ew.Form("fuangmukaedit", "edit");

	// Validate form
	fuangmukaedit.validate = function() {
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
			<?php if ($uangmuka_edit->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $uangmuka_edit->id->caption(), $uangmuka_edit->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($uangmuka_edit->tgl->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $uangmuka_edit->tgl->caption(), $uangmuka_edit->tgl->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($uangmuka_edit->tgl->errorMessage()) ?>");
			<?php if ($uangmuka_edit->pembayar->Required) { ?>
				elm = this.getElements("x" + infix + "_pembayar");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $uangmuka_edit->pembayar->caption(), $uangmuka_edit->pembayar->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pembayar");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($uangmuka_edit->pembayar->errorMessage()) ?>");
			<?php if ($uangmuka_edit->peruntukan->Required) { ?>
				elm = this.getElements("x" + infix + "_peruntukan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $uangmuka_edit->peruntukan->caption(), $uangmuka_edit->peruntukan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($uangmuka_edit->penerima->Required) { ?>
				elm = this.getElements("x" + infix + "_penerima");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $uangmuka_edit->penerima->caption(), $uangmuka_edit->penerima->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_penerima");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($uangmuka_edit->penerima->errorMessage()) ?>");
			<?php if ($uangmuka_edit->rek_penerima->Required) { ?>
				elm = this.getElements("x" + infix + "_rek_penerima");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $uangmuka_edit->rek_penerima->caption(), $uangmuka_edit->rek_penerima->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($uangmuka_edit->tgl_terima->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_terima");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $uangmuka_edit->tgl_terima->caption(), $uangmuka_edit->tgl_terima->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_terima");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($uangmuka_edit->tgl_terima->errorMessage()) ?>");
			<?php if ($uangmuka_edit->total_terima->Required) { ?>
				elm = this.getElements("x" + infix + "_total_terima");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $uangmuka_edit->total_terima->caption(), $uangmuka_edit->total_terima->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_total_terima");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($uangmuka_edit->total_terima->errorMessage()) ?>");
			<?php if ($uangmuka_edit->tgl_tgjb->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_tgjb");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $uangmuka_edit->tgl_tgjb->caption(), $uangmuka_edit->tgl_tgjb->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_tgjb");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($uangmuka_edit->tgl_tgjb->errorMessage()) ?>");
			<?php if ($uangmuka_edit->jumlah_tgjb->Required) { ?>
				elm = this.getElements("x" + infix + "_jumlah_tgjb");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $uangmuka_edit->jumlah_tgjb->caption(), $uangmuka_edit->jumlah_tgjb->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jumlah_tgjb");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($uangmuka_edit->jumlah_tgjb->errorMessage()) ?>");
			<?php if ($uangmuka_edit->jenis->Required) { ?>
				elm = this.getElements("x" + infix + "_jenis");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $uangmuka_edit->jenis->caption(), $uangmuka_edit->jenis->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($uangmuka_edit->bukti1->Required) { ?>
				felm = this.getElements("x" + infix + "_bukti1");
				elm = this.getElements("fn_x" + infix + "_bukti1");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $uangmuka_edit->bukti1->caption(), $uangmuka_edit->bukti1->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($uangmuka_edit->bukti2->Required) { ?>
				felm = this.getElements("x" + infix + "_bukti2");
				elm = this.getElements("fn_x" + infix + "_bukti2");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $uangmuka_edit->bukti2->caption(), $uangmuka_edit->bukti2->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($uangmuka_edit->bukti3->Required) { ?>
				felm = this.getElements("x" + infix + "_bukti3");
				elm = this.getElements("fn_x" + infix + "_bukti3");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $uangmuka_edit->bukti3->caption(), $uangmuka_edit->bukti3->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($uangmuka_edit->bukti4->Required) { ?>
				felm = this.getElements("x" + infix + "_bukti4");
				elm = this.getElements("fn_x" + infix + "_bukti4");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $uangmuka_edit->bukti4->caption(), $uangmuka_edit->bukti4->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($uangmuka_edit->disetujui->Required) { ?>
				elm = this.getElements("x" + infix + "_disetujui");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $uangmuka_edit->disetujui->caption(), $uangmuka_edit->disetujui->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($uangmuka_edit->status->Required) { ?>
				elm = this.getElements("x" + infix + "_status");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $uangmuka_edit->status->caption(), $uangmuka_edit->status->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($uangmuka_edit->keterangan->Required) { ?>
				elm = this.getElements("x" + infix + "_keterangan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $uangmuka_edit->keterangan->caption(), $uangmuka_edit->keterangan->RequiredErrorMessage)) ?>");
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
	fuangmukaedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fuangmukaedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fuangmukaedit.lists["x_disetujui"] = <?php echo $uangmuka_edit->disetujui->Lookup->toClientList($uangmuka_edit) ?>;
	fuangmukaedit.lists["x_disetujui"].options = <?php echo JsonEncode($uangmuka_edit->disetujui->lookupOptions()) ?>;
	loadjs.done("fuangmukaedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $uangmuka_edit->showPageHeader(); ?>
<?php
$uangmuka_edit->showMessage();
?>
<form name="fuangmukaedit" id="fuangmukaedit" class="<?php echo $uangmuka_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="uangmuka">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$uangmuka_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($uangmuka_edit->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_uangmuka_id" class="<?php echo $uangmuka_edit->LeftColumnClass ?>"><?php echo $uangmuka_edit->id->caption() ?><?php echo $uangmuka_edit->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $uangmuka_edit->RightColumnClass ?>"><div <?php echo $uangmuka_edit->id->cellAttributes() ?>>
<span id="el_uangmuka_id">
<span<?php echo $uangmuka_edit->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($uangmuka_edit->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="uangmuka" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($uangmuka_edit->id->CurrentValue) ?>">
<?php echo $uangmuka_edit->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($uangmuka_edit->tgl->Visible) { // tgl ?>
	<div id="r_tgl" class="form-group row">
		<label id="elh_uangmuka_tgl" for="x_tgl" class="<?php echo $uangmuka_edit->LeftColumnClass ?>"><?php echo $uangmuka_edit->tgl->caption() ?><?php echo $uangmuka_edit->tgl->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $uangmuka_edit->RightColumnClass ?>"><div <?php echo $uangmuka_edit->tgl->cellAttributes() ?>>
<span id="el_uangmuka_tgl">
<input type="text" data-table="uangmuka" data-field="x_tgl" name="x_tgl" id="x_tgl" maxlength="19" placeholder="<?php echo HtmlEncode($uangmuka_edit->tgl->getPlaceHolder()) ?>" value="<?php echo $uangmuka_edit->tgl->EditValue ?>"<?php echo $uangmuka_edit->tgl->editAttributes() ?>>
<?php if (!$uangmuka_edit->tgl->ReadOnly && !$uangmuka_edit->tgl->Disabled && !isset($uangmuka_edit->tgl->EditAttrs["readonly"]) && !isset($uangmuka_edit->tgl->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fuangmukaedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fuangmukaedit", "x_tgl", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $uangmuka_edit->tgl->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($uangmuka_edit->pembayar->Visible) { // pembayar ?>
	<div id="r_pembayar" class="form-group row">
		<label id="elh_uangmuka_pembayar" for="x_pembayar" class="<?php echo $uangmuka_edit->LeftColumnClass ?>"><?php echo $uangmuka_edit->pembayar->caption() ?><?php echo $uangmuka_edit->pembayar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $uangmuka_edit->RightColumnClass ?>"><div <?php echo $uangmuka_edit->pembayar->cellAttributes() ?>>
<span id="el_uangmuka_pembayar">
<input type="text" data-table="uangmuka" data-field="x_pembayar" name="x_pembayar" id="x_pembayar" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($uangmuka_edit->pembayar->getPlaceHolder()) ?>" value="<?php echo $uangmuka_edit->pembayar->EditValue ?>"<?php echo $uangmuka_edit->pembayar->editAttributes() ?>>
</span>
<?php echo $uangmuka_edit->pembayar->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($uangmuka_edit->peruntukan->Visible) { // peruntukan ?>
	<div id="r_peruntukan" class="form-group row">
		<label id="elh_uangmuka_peruntukan" for="x_peruntukan" class="<?php echo $uangmuka_edit->LeftColumnClass ?>"><?php echo $uangmuka_edit->peruntukan->caption() ?><?php echo $uangmuka_edit->peruntukan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $uangmuka_edit->RightColumnClass ?>"><div <?php echo $uangmuka_edit->peruntukan->cellAttributes() ?>>
<span id="el_uangmuka_peruntukan">
<input type="text" data-table="uangmuka" data-field="x_peruntukan" name="x_peruntukan" id="x_peruntukan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($uangmuka_edit->peruntukan->getPlaceHolder()) ?>" value="<?php echo $uangmuka_edit->peruntukan->EditValue ?>"<?php echo $uangmuka_edit->peruntukan->editAttributes() ?>>
</span>
<?php echo $uangmuka_edit->peruntukan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($uangmuka_edit->penerima->Visible) { // penerima ?>
	<div id="r_penerima" class="form-group row">
		<label id="elh_uangmuka_penerima" for="x_penerima" class="<?php echo $uangmuka_edit->LeftColumnClass ?>"><?php echo $uangmuka_edit->penerima->caption() ?><?php echo $uangmuka_edit->penerima->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $uangmuka_edit->RightColumnClass ?>"><div <?php echo $uangmuka_edit->penerima->cellAttributes() ?>>
<span id="el_uangmuka_penerima">
<input type="text" data-table="uangmuka" data-field="x_penerima" name="x_penerima" id="x_penerima" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($uangmuka_edit->penerima->getPlaceHolder()) ?>" value="<?php echo $uangmuka_edit->penerima->EditValue ?>"<?php echo $uangmuka_edit->penerima->editAttributes() ?>>
</span>
<?php echo $uangmuka_edit->penerima->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($uangmuka_edit->rek_penerima->Visible) { // rek_penerima ?>
	<div id="r_rek_penerima" class="form-group row">
		<label id="elh_uangmuka_rek_penerima" for="x_rek_penerima" class="<?php echo $uangmuka_edit->LeftColumnClass ?>"><?php echo $uangmuka_edit->rek_penerima->caption() ?><?php echo $uangmuka_edit->rek_penerima->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $uangmuka_edit->RightColumnClass ?>"><div <?php echo $uangmuka_edit->rek_penerima->cellAttributes() ?>>
<span id="el_uangmuka_rek_penerima">
<input type="text" data-table="uangmuka" data-field="x_rek_penerima" name="x_rek_penerima" id="x_rek_penerima" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($uangmuka_edit->rek_penerima->getPlaceHolder()) ?>" value="<?php echo $uangmuka_edit->rek_penerima->EditValue ?>"<?php echo $uangmuka_edit->rek_penerima->editAttributes() ?>>
</span>
<?php echo $uangmuka_edit->rek_penerima->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($uangmuka_edit->tgl_terima->Visible) { // tgl_terima ?>
	<div id="r_tgl_terima" class="form-group row">
		<label id="elh_uangmuka_tgl_terima" for="x_tgl_terima" class="<?php echo $uangmuka_edit->LeftColumnClass ?>"><?php echo $uangmuka_edit->tgl_terima->caption() ?><?php echo $uangmuka_edit->tgl_terima->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $uangmuka_edit->RightColumnClass ?>"><div <?php echo $uangmuka_edit->tgl_terima->cellAttributes() ?>>
<span id="el_uangmuka_tgl_terima">
<input type="text" data-table="uangmuka" data-field="x_tgl_terima" name="x_tgl_terima" id="x_tgl_terima" maxlength="19" placeholder="<?php echo HtmlEncode($uangmuka_edit->tgl_terima->getPlaceHolder()) ?>" value="<?php echo $uangmuka_edit->tgl_terima->EditValue ?>"<?php echo $uangmuka_edit->tgl_terima->editAttributes() ?>>
<?php if (!$uangmuka_edit->tgl_terima->ReadOnly && !$uangmuka_edit->tgl_terima->Disabled && !isset($uangmuka_edit->tgl_terima->EditAttrs["readonly"]) && !isset($uangmuka_edit->tgl_terima->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fuangmukaedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fuangmukaedit", "x_tgl_terima", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $uangmuka_edit->tgl_terima->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($uangmuka_edit->total_terima->Visible) { // total_terima ?>
	<div id="r_total_terima" class="form-group row">
		<label id="elh_uangmuka_total_terima" for="x_total_terima" class="<?php echo $uangmuka_edit->LeftColumnClass ?>"><?php echo $uangmuka_edit->total_terima->caption() ?><?php echo $uangmuka_edit->total_terima->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $uangmuka_edit->RightColumnClass ?>"><div <?php echo $uangmuka_edit->total_terima->cellAttributes() ?>>
<span id="el_uangmuka_total_terima">
<input type="text" data-table="uangmuka" data-field="x_total_terima" name="x_total_terima" id="x_total_terima" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($uangmuka_edit->total_terima->getPlaceHolder()) ?>" value="<?php echo $uangmuka_edit->total_terima->EditValue ?>"<?php echo $uangmuka_edit->total_terima->editAttributes() ?>>
</span>
<?php echo $uangmuka_edit->total_terima->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($uangmuka_edit->tgl_tgjb->Visible) { // tgl_tgjb ?>
	<div id="r_tgl_tgjb" class="form-group row">
		<label id="elh_uangmuka_tgl_tgjb" for="x_tgl_tgjb" class="<?php echo $uangmuka_edit->LeftColumnClass ?>"><?php echo $uangmuka_edit->tgl_tgjb->caption() ?><?php echo $uangmuka_edit->tgl_tgjb->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $uangmuka_edit->RightColumnClass ?>"><div <?php echo $uangmuka_edit->tgl_tgjb->cellAttributes() ?>>
<span id="el_uangmuka_tgl_tgjb">
<input type="text" data-table="uangmuka" data-field="x_tgl_tgjb" name="x_tgl_tgjb" id="x_tgl_tgjb" maxlength="19" placeholder="<?php echo HtmlEncode($uangmuka_edit->tgl_tgjb->getPlaceHolder()) ?>" value="<?php echo $uangmuka_edit->tgl_tgjb->EditValue ?>"<?php echo $uangmuka_edit->tgl_tgjb->editAttributes() ?>>
<?php if (!$uangmuka_edit->tgl_tgjb->ReadOnly && !$uangmuka_edit->tgl_tgjb->Disabled && !isset($uangmuka_edit->tgl_tgjb->EditAttrs["readonly"]) && !isset($uangmuka_edit->tgl_tgjb->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fuangmukaedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fuangmukaedit", "x_tgl_tgjb", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $uangmuka_edit->tgl_tgjb->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($uangmuka_edit->jumlah_tgjb->Visible) { // jumlah_tgjb ?>
	<div id="r_jumlah_tgjb" class="form-group row">
		<label id="elh_uangmuka_jumlah_tgjb" for="x_jumlah_tgjb" class="<?php echo $uangmuka_edit->LeftColumnClass ?>"><?php echo $uangmuka_edit->jumlah_tgjb->caption() ?><?php echo $uangmuka_edit->jumlah_tgjb->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $uangmuka_edit->RightColumnClass ?>"><div <?php echo $uangmuka_edit->jumlah_tgjb->cellAttributes() ?>>
<span id="el_uangmuka_jumlah_tgjb">
<input type="text" data-table="uangmuka" data-field="x_jumlah_tgjb" name="x_jumlah_tgjb" id="x_jumlah_tgjb" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($uangmuka_edit->jumlah_tgjb->getPlaceHolder()) ?>" value="<?php echo $uangmuka_edit->jumlah_tgjb->EditValue ?>"<?php echo $uangmuka_edit->jumlah_tgjb->editAttributes() ?>>
</span>
<?php echo $uangmuka_edit->jumlah_tgjb->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($uangmuka_edit->jenis->Visible) { // jenis ?>
	<div id="r_jenis" class="form-group row">
		<label id="elh_uangmuka_jenis" for="x_jenis" class="<?php echo $uangmuka_edit->LeftColumnClass ?>"><?php echo $uangmuka_edit->jenis->caption() ?><?php echo $uangmuka_edit->jenis->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $uangmuka_edit->RightColumnClass ?>"><div <?php echo $uangmuka_edit->jenis->cellAttributes() ?>>
<span id="el_uangmuka_jenis">
<input type="text" data-table="uangmuka" data-field="x_jenis" name="x_jenis" id="x_jenis" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($uangmuka_edit->jenis->getPlaceHolder()) ?>" value="<?php echo $uangmuka_edit->jenis->EditValue ?>"<?php echo $uangmuka_edit->jenis->editAttributes() ?>>
</span>
<?php echo $uangmuka_edit->jenis->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($uangmuka_edit->bukti1->Visible) { // bukti1 ?>
	<div id="r_bukti1" class="form-group row">
		<label id="elh_uangmuka_bukti1" class="<?php echo $uangmuka_edit->LeftColumnClass ?>"><?php echo $uangmuka_edit->bukti1->caption() ?><?php echo $uangmuka_edit->bukti1->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $uangmuka_edit->RightColumnClass ?>"><div <?php echo $uangmuka_edit->bukti1->cellAttributes() ?>>
<span id="el_uangmuka_bukti1">
<div id="fd_x_bukti1">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $uangmuka_edit->bukti1->title() ?>" data-table="uangmuka" data-field="x_bukti1" name="x_bukti1" id="x_bukti1" lang="<?php echo CurrentLanguageID() ?>"<?php echo $uangmuka_edit->bukti1->editAttributes() ?><?php if ($uangmuka_edit->bukti1->ReadOnly || $uangmuka_edit->bukti1->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_bukti1"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_bukti1" id= "fn_x_bukti1" value="<?php echo $uangmuka_edit->bukti1->Upload->FileName ?>">
<input type="hidden" name="fa_x_bukti1" id= "fa_x_bukti1" value="<?php echo (Post("fa_x_bukti1") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_bukti1" id= "fs_x_bukti1" value="255">
<input type="hidden" name="fx_x_bukti1" id= "fx_x_bukti1" value="<?php echo $uangmuka_edit->bukti1->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_bukti1" id= "fm_x_bukti1" value="<?php echo $uangmuka_edit->bukti1->UploadMaxFileSize ?>">
</div>
<table id="ft_x_bukti1" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $uangmuka_edit->bukti1->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($uangmuka_edit->bukti2->Visible) { // bukti2 ?>
	<div id="r_bukti2" class="form-group row">
		<label id="elh_uangmuka_bukti2" class="<?php echo $uangmuka_edit->LeftColumnClass ?>"><?php echo $uangmuka_edit->bukti2->caption() ?><?php echo $uangmuka_edit->bukti2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $uangmuka_edit->RightColumnClass ?>"><div <?php echo $uangmuka_edit->bukti2->cellAttributes() ?>>
<span id="el_uangmuka_bukti2">
<div id="fd_x_bukti2">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $uangmuka_edit->bukti2->title() ?>" data-table="uangmuka" data-field="x_bukti2" name="x_bukti2" id="x_bukti2" lang="<?php echo CurrentLanguageID() ?>"<?php echo $uangmuka_edit->bukti2->editAttributes() ?><?php if ($uangmuka_edit->bukti2->ReadOnly || $uangmuka_edit->bukti2->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_bukti2"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_bukti2" id= "fn_x_bukti2" value="<?php echo $uangmuka_edit->bukti2->Upload->FileName ?>">
<input type="hidden" name="fa_x_bukti2" id= "fa_x_bukti2" value="<?php echo (Post("fa_x_bukti2") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_bukti2" id= "fs_x_bukti2" value="255">
<input type="hidden" name="fx_x_bukti2" id= "fx_x_bukti2" value="<?php echo $uangmuka_edit->bukti2->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_bukti2" id= "fm_x_bukti2" value="<?php echo $uangmuka_edit->bukti2->UploadMaxFileSize ?>">
</div>
<table id="ft_x_bukti2" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $uangmuka_edit->bukti2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($uangmuka_edit->bukti3->Visible) { // bukti3 ?>
	<div id="r_bukti3" class="form-group row">
		<label id="elh_uangmuka_bukti3" class="<?php echo $uangmuka_edit->LeftColumnClass ?>"><?php echo $uangmuka_edit->bukti3->caption() ?><?php echo $uangmuka_edit->bukti3->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $uangmuka_edit->RightColumnClass ?>"><div <?php echo $uangmuka_edit->bukti3->cellAttributes() ?>>
<span id="el_uangmuka_bukti3">
<div id="fd_x_bukti3">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $uangmuka_edit->bukti3->title() ?>" data-table="uangmuka" data-field="x_bukti3" name="x_bukti3" id="x_bukti3" lang="<?php echo CurrentLanguageID() ?>"<?php echo $uangmuka_edit->bukti3->editAttributes() ?><?php if ($uangmuka_edit->bukti3->ReadOnly || $uangmuka_edit->bukti3->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_bukti3"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_bukti3" id= "fn_x_bukti3" value="<?php echo $uangmuka_edit->bukti3->Upload->FileName ?>">
<input type="hidden" name="fa_x_bukti3" id= "fa_x_bukti3" value="<?php echo (Post("fa_x_bukti3") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_bukti3" id= "fs_x_bukti3" value="255">
<input type="hidden" name="fx_x_bukti3" id= "fx_x_bukti3" value="<?php echo $uangmuka_edit->bukti3->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_bukti3" id= "fm_x_bukti3" value="<?php echo $uangmuka_edit->bukti3->UploadMaxFileSize ?>">
</div>
<table id="ft_x_bukti3" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $uangmuka_edit->bukti3->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($uangmuka_edit->bukti4->Visible) { // bukti4 ?>
	<div id="r_bukti4" class="form-group row">
		<label id="elh_uangmuka_bukti4" class="<?php echo $uangmuka_edit->LeftColumnClass ?>"><?php echo $uangmuka_edit->bukti4->caption() ?><?php echo $uangmuka_edit->bukti4->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $uangmuka_edit->RightColumnClass ?>"><div <?php echo $uangmuka_edit->bukti4->cellAttributes() ?>>
<span id="el_uangmuka_bukti4">
<div id="fd_x_bukti4">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $uangmuka_edit->bukti4->title() ?>" data-table="uangmuka" data-field="x_bukti4" name="x_bukti4" id="x_bukti4" lang="<?php echo CurrentLanguageID() ?>"<?php echo $uangmuka_edit->bukti4->editAttributes() ?><?php if ($uangmuka_edit->bukti4->ReadOnly || $uangmuka_edit->bukti4->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_bukti4"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_bukti4" id= "fn_x_bukti4" value="<?php echo $uangmuka_edit->bukti4->Upload->FileName ?>">
<input type="hidden" name="fa_x_bukti4" id= "fa_x_bukti4" value="<?php echo (Post("fa_x_bukti4") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_bukti4" id= "fs_x_bukti4" value="255">
<input type="hidden" name="fx_x_bukti4" id= "fx_x_bukti4" value="<?php echo $uangmuka_edit->bukti4->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_bukti4" id= "fm_x_bukti4" value="<?php echo $uangmuka_edit->bukti4->UploadMaxFileSize ?>">
</div>
<table id="ft_x_bukti4" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $uangmuka_edit->bukti4->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($uangmuka_edit->disetujui->Visible) { // disetujui ?>
	<div id="r_disetujui" class="form-group row">
		<label id="elh_uangmuka_disetujui" class="<?php echo $uangmuka_edit->LeftColumnClass ?>"><?php echo $uangmuka_edit->disetujui->caption() ?><?php echo $uangmuka_edit->disetujui->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $uangmuka_edit->RightColumnClass ?>"><div <?php echo $uangmuka_edit->disetujui->cellAttributes() ?>>
<span id="el_uangmuka_disetujui">
<div id="tp_x_disetujui" class="ew-template"><input type="radio" class="custom-control-input" data-table="uangmuka" data-field="x_disetujui" data-value-separator="<?php echo $uangmuka_edit->disetujui->displayValueSeparatorAttribute() ?>" name="x_disetujui" id="x_disetujui" value="{value}"<?php echo $uangmuka_edit->disetujui->editAttributes() ?>></div>
<div id="dsl_x_disetujui" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $uangmuka_edit->disetujui->radioButtonListHtml(FALSE, "x_disetujui") ?>
</div></div>
<?php echo $uangmuka_edit->disetujui->Lookup->getParamTag($uangmuka_edit, "p_x_disetujui") ?>
</span>
<?php echo $uangmuka_edit->disetujui->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($uangmuka_edit->status->Visible) { // status ?>
	<div id="r_status" class="form-group row">
		<label id="elh_uangmuka_status" for="x_status" class="<?php echo $uangmuka_edit->LeftColumnClass ?>"><?php echo $uangmuka_edit->status->caption() ?><?php echo $uangmuka_edit->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $uangmuka_edit->RightColumnClass ?>"><div <?php echo $uangmuka_edit->status->cellAttributes() ?>>
<span id="el_uangmuka_status">
<input type="text" data-table="uangmuka" data-field="x_status" name="x_status" id="x_status" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($uangmuka_edit->status->getPlaceHolder()) ?>" value="<?php echo $uangmuka_edit->status->EditValue ?>"<?php echo $uangmuka_edit->status->editAttributes() ?>>
</span>
<?php echo $uangmuka_edit->status->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($uangmuka_edit->keterangan->Visible) { // keterangan ?>
	<div id="r_keterangan" class="form-group row">
		<label id="elh_uangmuka_keterangan" for="x_keterangan" class="<?php echo $uangmuka_edit->LeftColumnClass ?>"><?php echo $uangmuka_edit->keterangan->caption() ?><?php echo $uangmuka_edit->keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $uangmuka_edit->RightColumnClass ?>"><div <?php echo $uangmuka_edit->keterangan->cellAttributes() ?>>
<span id="el_uangmuka_keterangan">
<textarea data-table="uangmuka" data-field="x_keterangan" name="x_keterangan" id="x_keterangan" cols="35" rows="4" placeholder="<?php echo HtmlEncode($uangmuka_edit->keterangan->getPlaceHolder()) ?>"<?php echo $uangmuka_edit->keterangan->editAttributes() ?>><?php echo $uangmuka_edit->keterangan->EditValue ?></textarea>
</span>
<?php echo $uangmuka_edit->keterangan->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$uangmuka_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $uangmuka_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $uangmuka_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$uangmuka_edit->showPageFooter();
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
$uangmuka_edit->terminate();
?>