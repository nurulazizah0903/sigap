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
$reimbursh_edit = new reimbursh_edit();

// Run the page
$reimbursh_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$reimbursh_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var freimburshedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	freimburshedit = currentForm = new ew.Form("freimburshedit", "edit");

	// Validate form
	freimburshedit.validate = function() {
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
			<?php if ($reimbursh_edit->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $reimbursh_edit->id->caption(), $reimbursh_edit->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($reimbursh_edit->pegawai->Required) { ?>
				elm = this.getElements("x" + infix + "_pegawai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $reimbursh_edit->pegawai->caption(), $reimbursh_edit->pegawai->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pegawai");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($reimbursh_edit->pegawai->errorMessage()) ?>");
			<?php if ($reimbursh_edit->nama->Required) { ?>
				elm = this.getElements("x" + infix + "_nama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $reimbursh_edit->nama->caption(), $reimbursh_edit->nama->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($reimbursh_edit->tgl->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $reimbursh_edit->tgl->caption(), $reimbursh_edit->tgl->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($reimbursh_edit->total_pengajuan->Required) { ?>
				elm = this.getElements("x" + infix + "_total_pengajuan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $reimbursh_edit->total_pengajuan->caption(), $reimbursh_edit->total_pengajuan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_total_pengajuan");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($reimbursh_edit->total_pengajuan->errorMessage()) ?>");
			<?php if ($reimbursh_edit->tgl_pengajuan->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_pengajuan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $reimbursh_edit->tgl_pengajuan->caption(), $reimbursh_edit->tgl_pengajuan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_pengajuan");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($reimbursh_edit->tgl_pengajuan->errorMessage()) ?>");
			<?php if ($reimbursh_edit->jenis->Required) { ?>
				elm = this.getElements("x" + infix + "_jenis");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $reimbursh_edit->jenis->caption(), $reimbursh_edit->jenis->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($reimbursh_edit->keterangan->Required) { ?>
				elm = this.getElements("x" + infix + "_keterangan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $reimbursh_edit->keterangan->caption(), $reimbursh_edit->keterangan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($reimbursh_edit->rek_tujuan->Required) { ?>
				elm = this.getElements("x" + infix + "_rek_tujuan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $reimbursh_edit->rek_tujuan->caption(), $reimbursh_edit->rek_tujuan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($reimbursh_edit->bukti1->Required) { ?>
				elm = this.getElements("x" + infix + "_bukti1");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $reimbursh_edit->bukti1->caption(), $reimbursh_edit->bukti1->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($reimbursh_edit->bukti2->Required) { ?>
				elm = this.getElements("x" + infix + "_bukti2");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $reimbursh_edit->bukti2->caption(), $reimbursh_edit->bukti2->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($reimbursh_edit->bukti3->Required) { ?>
				elm = this.getElements("x" + infix + "_bukti3");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $reimbursh_edit->bukti3->caption(), $reimbursh_edit->bukti3->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($reimbursh_edit->bukti4->Required) { ?>
				elm = this.getElements("x" + infix + "_bukti4");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $reimbursh_edit->bukti4->caption(), $reimbursh_edit->bukti4->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($reimbursh_edit->disetujui->Required) { ?>
				elm = this.getElements("x" + infix + "_disetujui");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $reimbursh_edit->disetujui->caption(), $reimbursh_edit->disetujui->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($reimbursh_edit->pembayar->Required) { ?>
				elm = this.getElements("x" + infix + "_pembayar");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $reimbursh_edit->pembayar->caption(), $reimbursh_edit->pembayar->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($reimbursh_edit->terbayar->Required) { ?>
				elm = this.getElements("x" + infix + "_terbayar");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $reimbursh_edit->terbayar->caption(), $reimbursh_edit->terbayar->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($reimbursh_edit->tgl_pembayaran->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_pembayaran");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $reimbursh_edit->tgl_pembayaran->caption(), $reimbursh_edit->tgl_pembayaran->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_pembayaran");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($reimbursh_edit->tgl_pembayaran->errorMessage()) ?>");
			<?php if ($reimbursh_edit->jumlah_dibayar->Required) { ?>
				elm = this.getElements("x" + infix + "_jumlah_dibayar");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $reimbursh_edit->jumlah_dibayar->caption(), $reimbursh_edit->jumlah_dibayar->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jumlah_dibayar");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($reimbursh_edit->jumlah_dibayar->errorMessage()) ?>");

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
	freimburshedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	freimburshedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	freimburshedit.lists["x_pegawai"] = <?php echo $reimbursh_edit->pegawai->Lookup->toClientList($reimbursh_edit) ?>;
	freimburshedit.lists["x_pegawai"].options = <?php echo JsonEncode($reimbursh_edit->pegawai->lookupOptions()) ?>;
	freimburshedit.autoSuggests["x_pegawai"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	freimburshedit.lists["x_disetujui"] = <?php echo $reimbursh_edit->disetujui->Lookup->toClientList($reimbursh_edit) ?>;
	freimburshedit.lists["x_disetujui"].options = <?php echo JsonEncode($reimbursh_edit->disetujui->lookupOptions()) ?>;
	freimburshedit.lists["x_terbayar"] = <?php echo $reimbursh_edit->terbayar->Lookup->toClientList($reimbursh_edit) ?>;
	freimburshedit.lists["x_terbayar"].options = <?php echo JsonEncode($reimbursh_edit->terbayar->lookupOptions()) ?>;
	loadjs.done("freimburshedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $reimbursh_edit->showPageHeader(); ?>
<?php
$reimbursh_edit->showMessage();
?>
<form name="freimburshedit" id="freimburshedit" class="<?php echo $reimbursh_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="reimbursh">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$reimbursh_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($reimbursh_edit->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_reimbursh_id" class="<?php echo $reimbursh_edit->LeftColumnClass ?>"><?php echo $reimbursh_edit->id->caption() ?><?php echo $reimbursh_edit->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $reimbursh_edit->RightColumnClass ?>"><div <?php echo $reimbursh_edit->id->cellAttributes() ?>>
<span id="el_reimbursh_id">
<span<?php echo $reimbursh_edit->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($reimbursh_edit->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="reimbursh" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($reimbursh_edit->id->CurrentValue) ?>">
<?php echo $reimbursh_edit->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($reimbursh_edit->pegawai->Visible) { // pegawai ?>
	<div id="r_pegawai" class="form-group row">
		<label id="elh_reimbursh_pegawai" class="<?php echo $reimbursh_edit->LeftColumnClass ?>"><?php echo $reimbursh_edit->pegawai->caption() ?><?php echo $reimbursh_edit->pegawai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $reimbursh_edit->RightColumnClass ?>"><div <?php echo $reimbursh_edit->pegawai->cellAttributes() ?>>
<span id="el_reimbursh_pegawai">
<?php
$onchange = $reimbursh_edit->pegawai->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$reimbursh_edit->pegawai->EditAttrs["onchange"] = "";
?>
<span id="as_x_pegawai">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_pegawai" id="sv_x_pegawai" value="<?php echo RemoveHtml($reimbursh_edit->pegawai->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($reimbursh_edit->pegawai->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($reimbursh_edit->pegawai->getPlaceHolder()) ?>"<?php echo $reimbursh_edit->pegawai->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($reimbursh_edit->pegawai->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_pegawai',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($reimbursh_edit->pegawai->ReadOnly || $reimbursh_edit->pegawai->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="reimbursh" data-field="x_pegawai" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $reimbursh_edit->pegawai->displayValueSeparatorAttribute() ?>" name="x_pegawai" id="x_pegawai" value="<?php echo HtmlEncode($reimbursh_edit->pegawai->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["freimburshedit"], function() {
	freimburshedit.createAutoSuggest({"id":"x_pegawai","forceSelect":false});
});
</script>
<?php echo $reimbursh_edit->pegawai->Lookup->getParamTag($reimbursh_edit, "p_x_pegawai") ?>
</span>
<?php echo $reimbursh_edit->pegawai->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($reimbursh_edit->nama->Visible) { // nama ?>
	<div id="r_nama" class="form-group row">
		<label id="elh_reimbursh_nama" for="x_nama" class="<?php echo $reimbursh_edit->LeftColumnClass ?>"><?php echo $reimbursh_edit->nama->caption() ?><?php echo $reimbursh_edit->nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $reimbursh_edit->RightColumnClass ?>"><div <?php echo $reimbursh_edit->nama->cellAttributes() ?>>
<span id="el_reimbursh_nama">
<input type="text" data-table="reimbursh" data-field="x_nama" name="x_nama" id="x_nama" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($reimbursh_edit->nama->getPlaceHolder()) ?>" value="<?php echo $reimbursh_edit->nama->EditValue ?>"<?php echo $reimbursh_edit->nama->editAttributes() ?>>
</span>
<?php echo $reimbursh_edit->nama->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($reimbursh_edit->total_pengajuan->Visible) { // total_pengajuan ?>
	<div id="r_total_pengajuan" class="form-group row">
		<label id="elh_reimbursh_total_pengajuan" for="x_total_pengajuan" class="<?php echo $reimbursh_edit->LeftColumnClass ?>"><?php echo $reimbursh_edit->total_pengajuan->caption() ?><?php echo $reimbursh_edit->total_pengajuan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $reimbursh_edit->RightColumnClass ?>"><div <?php echo $reimbursh_edit->total_pengajuan->cellAttributes() ?>>
<span id="el_reimbursh_total_pengajuan">
<input type="text" data-table="reimbursh" data-field="x_total_pengajuan" name="x_total_pengajuan" id="x_total_pengajuan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($reimbursh_edit->total_pengajuan->getPlaceHolder()) ?>" value="<?php echo $reimbursh_edit->total_pengajuan->EditValue ?>"<?php echo $reimbursh_edit->total_pengajuan->editAttributes() ?>>
</span>
<?php echo $reimbursh_edit->total_pengajuan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($reimbursh_edit->tgl_pengajuan->Visible) { // tgl_pengajuan ?>
	<div id="r_tgl_pengajuan" class="form-group row">
		<label id="elh_reimbursh_tgl_pengajuan" for="x_tgl_pengajuan" class="<?php echo $reimbursh_edit->LeftColumnClass ?>"><?php echo $reimbursh_edit->tgl_pengajuan->caption() ?><?php echo $reimbursh_edit->tgl_pengajuan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $reimbursh_edit->RightColumnClass ?>"><div <?php echo $reimbursh_edit->tgl_pengajuan->cellAttributes() ?>>
<span id="el_reimbursh_tgl_pengajuan">
<input type="text" data-table="reimbursh" data-field="x_tgl_pengajuan" name="x_tgl_pengajuan" id="x_tgl_pengajuan" maxlength="19" placeholder="<?php echo HtmlEncode($reimbursh_edit->tgl_pengajuan->getPlaceHolder()) ?>" value="<?php echo $reimbursh_edit->tgl_pengajuan->EditValue ?>"<?php echo $reimbursh_edit->tgl_pengajuan->editAttributes() ?>>
<?php if (!$reimbursh_edit->tgl_pengajuan->ReadOnly && !$reimbursh_edit->tgl_pengajuan->Disabled && !isset($reimbursh_edit->tgl_pengajuan->EditAttrs["readonly"]) && !isset($reimbursh_edit->tgl_pengajuan->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["freimburshedit", "datetimepicker"], function() {
	ew.createDateTimePicker("freimburshedit", "x_tgl_pengajuan", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $reimbursh_edit->tgl_pengajuan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($reimbursh_edit->jenis->Visible) { // jenis ?>
	<div id="r_jenis" class="form-group row">
		<label id="elh_reimbursh_jenis" for="x_jenis" class="<?php echo $reimbursh_edit->LeftColumnClass ?>"><?php echo $reimbursh_edit->jenis->caption() ?><?php echo $reimbursh_edit->jenis->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $reimbursh_edit->RightColumnClass ?>"><div <?php echo $reimbursh_edit->jenis->cellAttributes() ?>>
<span id="el_reimbursh_jenis">
<input type="text" data-table="reimbursh" data-field="x_jenis" name="x_jenis" id="x_jenis" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($reimbursh_edit->jenis->getPlaceHolder()) ?>" value="<?php echo $reimbursh_edit->jenis->EditValue ?>"<?php echo $reimbursh_edit->jenis->editAttributes() ?>>
</span>
<?php echo $reimbursh_edit->jenis->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($reimbursh_edit->keterangan->Visible) { // keterangan ?>
	<div id="r_keterangan" class="form-group row">
		<label id="elh_reimbursh_keterangan" for="x_keterangan" class="<?php echo $reimbursh_edit->LeftColumnClass ?>"><?php echo $reimbursh_edit->keterangan->caption() ?><?php echo $reimbursh_edit->keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $reimbursh_edit->RightColumnClass ?>"><div <?php echo $reimbursh_edit->keterangan->cellAttributes() ?>>
<span id="el_reimbursh_keterangan">
<textarea data-table="reimbursh" data-field="x_keterangan" name="x_keterangan" id="x_keterangan" cols="35" rows="4" placeholder="<?php echo HtmlEncode($reimbursh_edit->keterangan->getPlaceHolder()) ?>"<?php echo $reimbursh_edit->keterangan->editAttributes() ?>><?php echo $reimbursh_edit->keterangan->EditValue ?></textarea>
</span>
<?php echo $reimbursh_edit->keterangan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($reimbursh_edit->rek_tujuan->Visible) { // rek_tujuan ?>
	<div id="r_rek_tujuan" class="form-group row">
		<label id="elh_reimbursh_rek_tujuan" for="x_rek_tujuan" class="<?php echo $reimbursh_edit->LeftColumnClass ?>"><?php echo $reimbursh_edit->rek_tujuan->caption() ?><?php echo $reimbursh_edit->rek_tujuan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $reimbursh_edit->RightColumnClass ?>"><div <?php echo $reimbursh_edit->rek_tujuan->cellAttributes() ?>>
<span id="el_reimbursh_rek_tujuan">
<input type="text" data-table="reimbursh" data-field="x_rek_tujuan" name="x_rek_tujuan" id="x_rek_tujuan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($reimbursh_edit->rek_tujuan->getPlaceHolder()) ?>" value="<?php echo $reimbursh_edit->rek_tujuan->EditValue ?>"<?php echo $reimbursh_edit->rek_tujuan->editAttributes() ?>>
</span>
<?php echo $reimbursh_edit->rek_tujuan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($reimbursh_edit->bukti1->Visible) { // bukti1 ?>
	<div id="r_bukti1" class="form-group row">
		<label id="elh_reimbursh_bukti1" for="x_bukti1" class="<?php echo $reimbursh_edit->LeftColumnClass ?>"><?php echo $reimbursh_edit->bukti1->caption() ?><?php echo $reimbursh_edit->bukti1->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $reimbursh_edit->RightColumnClass ?>"><div <?php echo $reimbursh_edit->bukti1->cellAttributes() ?>>
<span id="el_reimbursh_bukti1">
<input type="text" data-table="reimbursh" data-field="x_bukti1" name="x_bukti1" id="x_bukti1" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($reimbursh_edit->bukti1->getPlaceHolder()) ?>" value="<?php echo $reimbursh_edit->bukti1->EditValue ?>"<?php echo $reimbursh_edit->bukti1->editAttributes() ?>>
</span>
<?php echo $reimbursh_edit->bukti1->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($reimbursh_edit->bukti2->Visible) { // bukti2 ?>
	<div id="r_bukti2" class="form-group row">
		<label id="elh_reimbursh_bukti2" for="x_bukti2" class="<?php echo $reimbursh_edit->LeftColumnClass ?>"><?php echo $reimbursh_edit->bukti2->caption() ?><?php echo $reimbursh_edit->bukti2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $reimbursh_edit->RightColumnClass ?>"><div <?php echo $reimbursh_edit->bukti2->cellAttributes() ?>>
<span id="el_reimbursh_bukti2">
<input type="text" data-table="reimbursh" data-field="x_bukti2" name="x_bukti2" id="x_bukti2" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($reimbursh_edit->bukti2->getPlaceHolder()) ?>" value="<?php echo $reimbursh_edit->bukti2->EditValue ?>"<?php echo $reimbursh_edit->bukti2->editAttributes() ?>>
</span>
<?php echo $reimbursh_edit->bukti2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($reimbursh_edit->bukti3->Visible) { // bukti3 ?>
	<div id="r_bukti3" class="form-group row">
		<label id="elh_reimbursh_bukti3" for="x_bukti3" class="<?php echo $reimbursh_edit->LeftColumnClass ?>"><?php echo $reimbursh_edit->bukti3->caption() ?><?php echo $reimbursh_edit->bukti3->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $reimbursh_edit->RightColumnClass ?>"><div <?php echo $reimbursh_edit->bukti3->cellAttributes() ?>>
<span id="el_reimbursh_bukti3">
<input type="text" data-table="reimbursh" data-field="x_bukti3" name="x_bukti3" id="x_bukti3" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($reimbursh_edit->bukti3->getPlaceHolder()) ?>" value="<?php echo $reimbursh_edit->bukti3->EditValue ?>"<?php echo $reimbursh_edit->bukti3->editAttributes() ?>>
</span>
<?php echo $reimbursh_edit->bukti3->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($reimbursh_edit->bukti4->Visible) { // bukti4 ?>
	<div id="r_bukti4" class="form-group row">
		<label id="elh_reimbursh_bukti4" for="x_bukti4" class="<?php echo $reimbursh_edit->LeftColumnClass ?>"><?php echo $reimbursh_edit->bukti4->caption() ?><?php echo $reimbursh_edit->bukti4->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $reimbursh_edit->RightColumnClass ?>"><div <?php echo $reimbursh_edit->bukti4->cellAttributes() ?>>
<span id="el_reimbursh_bukti4">
<input type="text" data-table="reimbursh" data-field="x_bukti4" name="x_bukti4" id="x_bukti4" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($reimbursh_edit->bukti4->getPlaceHolder()) ?>" value="<?php echo $reimbursh_edit->bukti4->EditValue ?>"<?php echo $reimbursh_edit->bukti4->editAttributes() ?>>
</span>
<?php echo $reimbursh_edit->bukti4->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($reimbursh_edit->disetujui->Visible) { // disetujui ?>
	<div id="r_disetujui" class="form-group row">
		<label id="elh_reimbursh_disetujui" class="<?php echo $reimbursh_edit->LeftColumnClass ?>"><?php echo $reimbursh_edit->disetujui->caption() ?><?php echo $reimbursh_edit->disetujui->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $reimbursh_edit->RightColumnClass ?>"><div <?php echo $reimbursh_edit->disetujui->cellAttributes() ?>>
<span id="el_reimbursh_disetujui">
<div id="tp_x_disetujui" class="ew-template"><input type="radio" class="custom-control-input" data-table="reimbursh" data-field="x_disetujui" data-value-separator="<?php echo $reimbursh_edit->disetujui->displayValueSeparatorAttribute() ?>" name="x_disetujui" id="x_disetujui" value="{value}"<?php echo $reimbursh_edit->disetujui->editAttributes() ?>></div>
<div id="dsl_x_disetujui" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $reimbursh_edit->disetujui->radioButtonListHtml(FALSE, "x_disetujui") ?>
</div></div>
<?php echo $reimbursh_edit->disetujui->Lookup->getParamTag($reimbursh_edit, "p_x_disetujui") ?>
</span>
<?php echo $reimbursh_edit->disetujui->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($reimbursh_edit->pembayar->Visible) { // pembayar ?>
	<div id="r_pembayar" class="form-group row">
		<label id="elh_reimbursh_pembayar" for="x_pembayar" class="<?php echo $reimbursh_edit->LeftColumnClass ?>"><?php echo $reimbursh_edit->pembayar->caption() ?><?php echo $reimbursh_edit->pembayar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $reimbursh_edit->RightColumnClass ?>"><div <?php echo $reimbursh_edit->pembayar->cellAttributes() ?>>
<span id="el_reimbursh_pembayar">
<input type="text" data-table="reimbursh" data-field="x_pembayar" name="x_pembayar" id="x_pembayar" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($reimbursh_edit->pembayar->getPlaceHolder()) ?>" value="<?php echo $reimbursh_edit->pembayar->EditValue ?>"<?php echo $reimbursh_edit->pembayar->editAttributes() ?>>
</span>
<?php echo $reimbursh_edit->pembayar->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($reimbursh_edit->terbayar->Visible) { // terbayar ?>
	<div id="r_terbayar" class="form-group row">
		<label id="elh_reimbursh_terbayar" for="x_terbayar" class="<?php echo $reimbursh_edit->LeftColumnClass ?>"><?php echo $reimbursh_edit->terbayar->caption() ?><?php echo $reimbursh_edit->terbayar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $reimbursh_edit->RightColumnClass ?>"><div <?php echo $reimbursh_edit->terbayar->cellAttributes() ?>>
<span id="el_reimbursh_terbayar">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="reimbursh" data-field="x_terbayar" data-value-separator="<?php echo $reimbursh_edit->terbayar->displayValueSeparatorAttribute() ?>" id="x_terbayar" name="x_terbayar"<?php echo $reimbursh_edit->terbayar->editAttributes() ?>>
			<?php echo $reimbursh_edit->terbayar->selectOptionListHtml("x_terbayar") ?>
		</select>
</div>
<?php echo $reimbursh_edit->terbayar->Lookup->getParamTag($reimbursh_edit, "p_x_terbayar") ?>
</span>
<?php echo $reimbursh_edit->terbayar->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($reimbursh_edit->tgl_pembayaran->Visible) { // tgl_pembayaran ?>
	<div id="r_tgl_pembayaran" class="form-group row">
		<label id="elh_reimbursh_tgl_pembayaran" for="x_tgl_pembayaran" class="<?php echo $reimbursh_edit->LeftColumnClass ?>"><?php echo $reimbursh_edit->tgl_pembayaran->caption() ?><?php echo $reimbursh_edit->tgl_pembayaran->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $reimbursh_edit->RightColumnClass ?>"><div <?php echo $reimbursh_edit->tgl_pembayaran->cellAttributes() ?>>
<span id="el_reimbursh_tgl_pembayaran">
<input type="text" data-table="reimbursh" data-field="x_tgl_pembayaran" name="x_tgl_pembayaran" id="x_tgl_pembayaran" maxlength="19" placeholder="<?php echo HtmlEncode($reimbursh_edit->tgl_pembayaran->getPlaceHolder()) ?>" value="<?php echo $reimbursh_edit->tgl_pembayaran->EditValue ?>"<?php echo $reimbursh_edit->tgl_pembayaran->editAttributes() ?>>
<?php if (!$reimbursh_edit->tgl_pembayaran->ReadOnly && !$reimbursh_edit->tgl_pembayaran->Disabled && !isset($reimbursh_edit->tgl_pembayaran->EditAttrs["readonly"]) && !isset($reimbursh_edit->tgl_pembayaran->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["freimburshedit", "datetimepicker"], function() {
	ew.createDateTimePicker("freimburshedit", "x_tgl_pembayaran", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $reimbursh_edit->tgl_pembayaran->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($reimbursh_edit->jumlah_dibayar->Visible) { // jumlah_dibayar ?>
	<div id="r_jumlah_dibayar" class="form-group row">
		<label id="elh_reimbursh_jumlah_dibayar" for="x_jumlah_dibayar" class="<?php echo $reimbursh_edit->LeftColumnClass ?>"><?php echo $reimbursh_edit->jumlah_dibayar->caption() ?><?php echo $reimbursh_edit->jumlah_dibayar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $reimbursh_edit->RightColumnClass ?>"><div <?php echo $reimbursh_edit->jumlah_dibayar->cellAttributes() ?>>
<span id="el_reimbursh_jumlah_dibayar">
<input type="text" data-table="reimbursh" data-field="x_jumlah_dibayar" name="x_jumlah_dibayar" id="x_jumlah_dibayar" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($reimbursh_edit->jumlah_dibayar->getPlaceHolder()) ?>" value="<?php echo $reimbursh_edit->jumlah_dibayar->EditValue ?>"<?php echo $reimbursh_edit->jumlah_dibayar->editAttributes() ?>>
</span>
<?php echo $reimbursh_edit->jumlah_dibayar->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$reimbursh_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $reimbursh_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $reimbursh_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$reimbursh_edit->showPageFooter();
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
$reimbursh_edit->terminate();
?>