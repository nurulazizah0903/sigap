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
$reimbursh_add = new reimbursh_add();

// Run the page
$reimbursh_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$reimbursh_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var freimburshadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	freimburshadd = currentForm = new ew.Form("freimburshadd", "add");

	// Validate form
	freimburshadd.validate = function() {
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
			<?php if ($reimbursh_add->pegawai->Required) { ?>
				elm = this.getElements("x" + infix + "_pegawai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $reimbursh_add->pegawai->caption(), $reimbursh_add->pegawai->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pegawai");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($reimbursh_add->pegawai->errorMessage()) ?>");
			<?php if ($reimbursh_add->nama->Required) { ?>
				elm = this.getElements("x" + infix + "_nama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $reimbursh_add->nama->caption(), $reimbursh_add->nama->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($reimbursh_add->tgl->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $reimbursh_add->tgl->caption(), $reimbursh_add->tgl->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($reimbursh_add->total_pengajuan->Required) { ?>
				elm = this.getElements("x" + infix + "_total_pengajuan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $reimbursh_add->total_pengajuan->caption(), $reimbursh_add->total_pengajuan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_total_pengajuan");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($reimbursh_add->total_pengajuan->errorMessage()) ?>");
			<?php if ($reimbursh_add->tgl_pengajuan->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_pengajuan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $reimbursh_add->tgl_pengajuan->caption(), $reimbursh_add->tgl_pengajuan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_pengajuan");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($reimbursh_add->tgl_pengajuan->errorMessage()) ?>");
			<?php if ($reimbursh_add->jenis->Required) { ?>
				elm = this.getElements("x" + infix + "_jenis");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $reimbursh_add->jenis->caption(), $reimbursh_add->jenis->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($reimbursh_add->keterangan->Required) { ?>
				elm = this.getElements("x" + infix + "_keterangan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $reimbursh_add->keterangan->caption(), $reimbursh_add->keterangan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($reimbursh_add->rek_tujuan->Required) { ?>
				elm = this.getElements("x" + infix + "_rek_tujuan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $reimbursh_add->rek_tujuan->caption(), $reimbursh_add->rek_tujuan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($reimbursh_add->bukti1->Required) { ?>
				elm = this.getElements("x" + infix + "_bukti1");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $reimbursh_add->bukti1->caption(), $reimbursh_add->bukti1->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($reimbursh_add->bukti2->Required) { ?>
				elm = this.getElements("x" + infix + "_bukti2");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $reimbursh_add->bukti2->caption(), $reimbursh_add->bukti2->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($reimbursh_add->bukti3->Required) { ?>
				elm = this.getElements("x" + infix + "_bukti3");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $reimbursh_add->bukti3->caption(), $reimbursh_add->bukti3->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($reimbursh_add->bukti4->Required) { ?>
				elm = this.getElements("x" + infix + "_bukti4");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $reimbursh_add->bukti4->caption(), $reimbursh_add->bukti4->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($reimbursh_add->disetujui->Required) { ?>
				elm = this.getElements("x" + infix + "_disetujui");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $reimbursh_add->disetujui->caption(), $reimbursh_add->disetujui->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($reimbursh_add->pembayar->Required) { ?>
				elm = this.getElements("x" + infix + "_pembayar");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $reimbursh_add->pembayar->caption(), $reimbursh_add->pembayar->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($reimbursh_add->terbayar->Required) { ?>
				elm = this.getElements("x" + infix + "_terbayar");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $reimbursh_add->terbayar->caption(), $reimbursh_add->terbayar->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($reimbursh_add->tgl_pembayaran->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_pembayaran");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $reimbursh_add->tgl_pembayaran->caption(), $reimbursh_add->tgl_pembayaran->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_pembayaran");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($reimbursh_add->tgl_pembayaran->errorMessage()) ?>");
			<?php if ($reimbursh_add->jumlah_dibayar->Required) { ?>
				elm = this.getElements("x" + infix + "_jumlah_dibayar");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $reimbursh_add->jumlah_dibayar->caption(), $reimbursh_add->jumlah_dibayar->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jumlah_dibayar");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($reimbursh_add->jumlah_dibayar->errorMessage()) ?>");

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
	freimburshadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	freimburshadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	freimburshadd.lists["x_pegawai"] = <?php echo $reimbursh_add->pegawai->Lookup->toClientList($reimbursh_add) ?>;
	freimburshadd.lists["x_pegawai"].options = <?php echo JsonEncode($reimbursh_add->pegawai->lookupOptions()) ?>;
	freimburshadd.autoSuggests["x_pegawai"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	freimburshadd.lists["x_disetujui"] = <?php echo $reimbursh_add->disetujui->Lookup->toClientList($reimbursh_add) ?>;
	freimburshadd.lists["x_disetujui"].options = <?php echo JsonEncode($reimbursh_add->disetujui->lookupOptions()) ?>;
	freimburshadd.lists["x_terbayar"] = <?php echo $reimbursh_add->terbayar->Lookup->toClientList($reimbursh_add) ?>;
	freimburshadd.lists["x_terbayar"].options = <?php echo JsonEncode($reimbursh_add->terbayar->lookupOptions()) ?>;
	loadjs.done("freimburshadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $reimbursh_add->showPageHeader(); ?>
<?php
$reimbursh_add->showMessage();
?>
<form name="freimburshadd" id="freimburshadd" class="<?php echo $reimbursh_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="reimbursh">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$reimbursh_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($reimbursh_add->pegawai->Visible) { // pegawai ?>
	<div id="r_pegawai" class="form-group row">
		<label id="elh_reimbursh_pegawai" class="<?php echo $reimbursh_add->LeftColumnClass ?>"><?php echo $reimbursh_add->pegawai->caption() ?><?php echo $reimbursh_add->pegawai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $reimbursh_add->RightColumnClass ?>"><div <?php echo $reimbursh_add->pegawai->cellAttributes() ?>>
<span id="el_reimbursh_pegawai">
<?php
$onchange = $reimbursh_add->pegawai->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$reimbursh_add->pegawai->EditAttrs["onchange"] = "";
?>
<span id="as_x_pegawai">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_pegawai" id="sv_x_pegawai" value="<?php echo RemoveHtml($reimbursh_add->pegawai->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($reimbursh_add->pegawai->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($reimbursh_add->pegawai->getPlaceHolder()) ?>"<?php echo $reimbursh_add->pegawai->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($reimbursh_add->pegawai->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_pegawai',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($reimbursh_add->pegawai->ReadOnly || $reimbursh_add->pegawai->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="reimbursh" data-field="x_pegawai" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $reimbursh_add->pegawai->displayValueSeparatorAttribute() ?>" name="x_pegawai" id="x_pegawai" value="<?php echo HtmlEncode($reimbursh_add->pegawai->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["freimburshadd"], function() {
	freimburshadd.createAutoSuggest({"id":"x_pegawai","forceSelect":false});
});
</script>
<?php echo $reimbursh_add->pegawai->Lookup->getParamTag($reimbursh_add, "p_x_pegawai") ?>
</span>
<?php echo $reimbursh_add->pegawai->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($reimbursh_add->nama->Visible) { // nama ?>
	<div id="r_nama" class="form-group row">
		<label id="elh_reimbursh_nama" for="x_nama" class="<?php echo $reimbursh_add->LeftColumnClass ?>"><?php echo $reimbursh_add->nama->caption() ?><?php echo $reimbursh_add->nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $reimbursh_add->RightColumnClass ?>"><div <?php echo $reimbursh_add->nama->cellAttributes() ?>>
<span id="el_reimbursh_nama">
<input type="text" data-table="reimbursh" data-field="x_nama" name="x_nama" id="x_nama" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($reimbursh_add->nama->getPlaceHolder()) ?>" value="<?php echo $reimbursh_add->nama->EditValue ?>"<?php echo $reimbursh_add->nama->editAttributes() ?>>
</span>
<?php echo $reimbursh_add->nama->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($reimbursh_add->total_pengajuan->Visible) { // total_pengajuan ?>
	<div id="r_total_pengajuan" class="form-group row">
		<label id="elh_reimbursh_total_pengajuan" for="x_total_pengajuan" class="<?php echo $reimbursh_add->LeftColumnClass ?>"><?php echo $reimbursh_add->total_pengajuan->caption() ?><?php echo $reimbursh_add->total_pengajuan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $reimbursh_add->RightColumnClass ?>"><div <?php echo $reimbursh_add->total_pengajuan->cellAttributes() ?>>
<span id="el_reimbursh_total_pengajuan">
<input type="text" data-table="reimbursh" data-field="x_total_pengajuan" name="x_total_pengajuan" id="x_total_pengajuan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($reimbursh_add->total_pengajuan->getPlaceHolder()) ?>" value="<?php echo $reimbursh_add->total_pengajuan->EditValue ?>"<?php echo $reimbursh_add->total_pengajuan->editAttributes() ?>>
</span>
<?php echo $reimbursh_add->total_pengajuan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($reimbursh_add->tgl_pengajuan->Visible) { // tgl_pengajuan ?>
	<div id="r_tgl_pengajuan" class="form-group row">
		<label id="elh_reimbursh_tgl_pengajuan" for="x_tgl_pengajuan" class="<?php echo $reimbursh_add->LeftColumnClass ?>"><?php echo $reimbursh_add->tgl_pengajuan->caption() ?><?php echo $reimbursh_add->tgl_pengajuan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $reimbursh_add->RightColumnClass ?>"><div <?php echo $reimbursh_add->tgl_pengajuan->cellAttributes() ?>>
<span id="el_reimbursh_tgl_pengajuan">
<input type="text" data-table="reimbursh" data-field="x_tgl_pengajuan" name="x_tgl_pengajuan" id="x_tgl_pengajuan" maxlength="19" placeholder="<?php echo HtmlEncode($reimbursh_add->tgl_pengajuan->getPlaceHolder()) ?>" value="<?php echo $reimbursh_add->tgl_pengajuan->EditValue ?>"<?php echo $reimbursh_add->tgl_pengajuan->editAttributes() ?>>
<?php if (!$reimbursh_add->tgl_pengajuan->ReadOnly && !$reimbursh_add->tgl_pengajuan->Disabled && !isset($reimbursh_add->tgl_pengajuan->EditAttrs["readonly"]) && !isset($reimbursh_add->tgl_pengajuan->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["freimburshadd", "datetimepicker"], function() {
	ew.createDateTimePicker("freimburshadd", "x_tgl_pengajuan", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $reimbursh_add->tgl_pengajuan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($reimbursh_add->jenis->Visible) { // jenis ?>
	<div id="r_jenis" class="form-group row">
		<label id="elh_reimbursh_jenis" for="x_jenis" class="<?php echo $reimbursh_add->LeftColumnClass ?>"><?php echo $reimbursh_add->jenis->caption() ?><?php echo $reimbursh_add->jenis->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $reimbursh_add->RightColumnClass ?>"><div <?php echo $reimbursh_add->jenis->cellAttributes() ?>>
<span id="el_reimbursh_jenis">
<input type="text" data-table="reimbursh" data-field="x_jenis" name="x_jenis" id="x_jenis" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($reimbursh_add->jenis->getPlaceHolder()) ?>" value="<?php echo $reimbursh_add->jenis->EditValue ?>"<?php echo $reimbursh_add->jenis->editAttributes() ?>>
</span>
<?php echo $reimbursh_add->jenis->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($reimbursh_add->keterangan->Visible) { // keterangan ?>
	<div id="r_keterangan" class="form-group row">
		<label id="elh_reimbursh_keterangan" for="x_keterangan" class="<?php echo $reimbursh_add->LeftColumnClass ?>"><?php echo $reimbursh_add->keterangan->caption() ?><?php echo $reimbursh_add->keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $reimbursh_add->RightColumnClass ?>"><div <?php echo $reimbursh_add->keterangan->cellAttributes() ?>>
<span id="el_reimbursh_keterangan">
<textarea data-table="reimbursh" data-field="x_keterangan" name="x_keterangan" id="x_keterangan" cols="35" rows="4" placeholder="<?php echo HtmlEncode($reimbursh_add->keterangan->getPlaceHolder()) ?>"<?php echo $reimbursh_add->keterangan->editAttributes() ?>><?php echo $reimbursh_add->keterangan->EditValue ?></textarea>
</span>
<?php echo $reimbursh_add->keterangan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($reimbursh_add->rek_tujuan->Visible) { // rek_tujuan ?>
	<div id="r_rek_tujuan" class="form-group row">
		<label id="elh_reimbursh_rek_tujuan" for="x_rek_tujuan" class="<?php echo $reimbursh_add->LeftColumnClass ?>"><?php echo $reimbursh_add->rek_tujuan->caption() ?><?php echo $reimbursh_add->rek_tujuan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $reimbursh_add->RightColumnClass ?>"><div <?php echo $reimbursh_add->rek_tujuan->cellAttributes() ?>>
<span id="el_reimbursh_rek_tujuan">
<input type="text" data-table="reimbursh" data-field="x_rek_tujuan" name="x_rek_tujuan" id="x_rek_tujuan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($reimbursh_add->rek_tujuan->getPlaceHolder()) ?>" value="<?php echo $reimbursh_add->rek_tujuan->EditValue ?>"<?php echo $reimbursh_add->rek_tujuan->editAttributes() ?>>
</span>
<?php echo $reimbursh_add->rek_tujuan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($reimbursh_add->bukti1->Visible) { // bukti1 ?>
	<div id="r_bukti1" class="form-group row">
		<label id="elh_reimbursh_bukti1" for="x_bukti1" class="<?php echo $reimbursh_add->LeftColumnClass ?>"><?php echo $reimbursh_add->bukti1->caption() ?><?php echo $reimbursh_add->bukti1->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $reimbursh_add->RightColumnClass ?>"><div <?php echo $reimbursh_add->bukti1->cellAttributes() ?>>
<span id="el_reimbursh_bukti1">
<input type="text" data-table="reimbursh" data-field="x_bukti1" name="x_bukti1" id="x_bukti1" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($reimbursh_add->bukti1->getPlaceHolder()) ?>" value="<?php echo $reimbursh_add->bukti1->EditValue ?>"<?php echo $reimbursh_add->bukti1->editAttributes() ?>>
</span>
<?php echo $reimbursh_add->bukti1->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($reimbursh_add->bukti2->Visible) { // bukti2 ?>
	<div id="r_bukti2" class="form-group row">
		<label id="elh_reimbursh_bukti2" for="x_bukti2" class="<?php echo $reimbursh_add->LeftColumnClass ?>"><?php echo $reimbursh_add->bukti2->caption() ?><?php echo $reimbursh_add->bukti2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $reimbursh_add->RightColumnClass ?>"><div <?php echo $reimbursh_add->bukti2->cellAttributes() ?>>
<span id="el_reimbursh_bukti2">
<input type="text" data-table="reimbursh" data-field="x_bukti2" name="x_bukti2" id="x_bukti2" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($reimbursh_add->bukti2->getPlaceHolder()) ?>" value="<?php echo $reimbursh_add->bukti2->EditValue ?>"<?php echo $reimbursh_add->bukti2->editAttributes() ?>>
</span>
<?php echo $reimbursh_add->bukti2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($reimbursh_add->bukti3->Visible) { // bukti3 ?>
	<div id="r_bukti3" class="form-group row">
		<label id="elh_reimbursh_bukti3" for="x_bukti3" class="<?php echo $reimbursh_add->LeftColumnClass ?>"><?php echo $reimbursh_add->bukti3->caption() ?><?php echo $reimbursh_add->bukti3->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $reimbursh_add->RightColumnClass ?>"><div <?php echo $reimbursh_add->bukti3->cellAttributes() ?>>
<span id="el_reimbursh_bukti3">
<input type="text" data-table="reimbursh" data-field="x_bukti3" name="x_bukti3" id="x_bukti3" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($reimbursh_add->bukti3->getPlaceHolder()) ?>" value="<?php echo $reimbursh_add->bukti3->EditValue ?>"<?php echo $reimbursh_add->bukti3->editAttributes() ?>>
</span>
<?php echo $reimbursh_add->bukti3->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($reimbursh_add->bukti4->Visible) { // bukti4 ?>
	<div id="r_bukti4" class="form-group row">
		<label id="elh_reimbursh_bukti4" for="x_bukti4" class="<?php echo $reimbursh_add->LeftColumnClass ?>"><?php echo $reimbursh_add->bukti4->caption() ?><?php echo $reimbursh_add->bukti4->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $reimbursh_add->RightColumnClass ?>"><div <?php echo $reimbursh_add->bukti4->cellAttributes() ?>>
<span id="el_reimbursh_bukti4">
<input type="text" data-table="reimbursh" data-field="x_bukti4" name="x_bukti4" id="x_bukti4" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($reimbursh_add->bukti4->getPlaceHolder()) ?>" value="<?php echo $reimbursh_add->bukti4->EditValue ?>"<?php echo $reimbursh_add->bukti4->editAttributes() ?>>
</span>
<?php echo $reimbursh_add->bukti4->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($reimbursh_add->disetujui->Visible) { // disetujui ?>
	<div id="r_disetujui" class="form-group row">
		<label id="elh_reimbursh_disetujui" class="<?php echo $reimbursh_add->LeftColumnClass ?>"><?php echo $reimbursh_add->disetujui->caption() ?><?php echo $reimbursh_add->disetujui->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $reimbursh_add->RightColumnClass ?>"><div <?php echo $reimbursh_add->disetujui->cellAttributes() ?>>
<span id="el_reimbursh_disetujui">
<div id="tp_x_disetujui" class="ew-template"><input type="radio" class="custom-control-input" data-table="reimbursh" data-field="x_disetujui" data-value-separator="<?php echo $reimbursh_add->disetujui->displayValueSeparatorAttribute() ?>" name="x_disetujui" id="x_disetujui" value="{value}"<?php echo $reimbursh_add->disetujui->editAttributes() ?>></div>
<div id="dsl_x_disetujui" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $reimbursh_add->disetujui->radioButtonListHtml(FALSE, "x_disetujui") ?>
</div></div>
<?php echo $reimbursh_add->disetujui->Lookup->getParamTag($reimbursh_add, "p_x_disetujui") ?>
</span>
<?php echo $reimbursh_add->disetujui->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($reimbursh_add->pembayar->Visible) { // pembayar ?>
	<div id="r_pembayar" class="form-group row">
		<label id="elh_reimbursh_pembayar" for="x_pembayar" class="<?php echo $reimbursh_add->LeftColumnClass ?>"><?php echo $reimbursh_add->pembayar->caption() ?><?php echo $reimbursh_add->pembayar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $reimbursh_add->RightColumnClass ?>"><div <?php echo $reimbursh_add->pembayar->cellAttributes() ?>>
<span id="el_reimbursh_pembayar">
<input type="text" data-table="reimbursh" data-field="x_pembayar" name="x_pembayar" id="x_pembayar" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($reimbursh_add->pembayar->getPlaceHolder()) ?>" value="<?php echo $reimbursh_add->pembayar->EditValue ?>"<?php echo $reimbursh_add->pembayar->editAttributes() ?>>
</span>
<?php echo $reimbursh_add->pembayar->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($reimbursh_add->terbayar->Visible) { // terbayar ?>
	<div id="r_terbayar" class="form-group row">
		<label id="elh_reimbursh_terbayar" for="x_terbayar" class="<?php echo $reimbursh_add->LeftColumnClass ?>"><?php echo $reimbursh_add->terbayar->caption() ?><?php echo $reimbursh_add->terbayar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $reimbursh_add->RightColumnClass ?>"><div <?php echo $reimbursh_add->terbayar->cellAttributes() ?>>
<span id="el_reimbursh_terbayar">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="reimbursh" data-field="x_terbayar" data-value-separator="<?php echo $reimbursh_add->terbayar->displayValueSeparatorAttribute() ?>" id="x_terbayar" name="x_terbayar"<?php echo $reimbursh_add->terbayar->editAttributes() ?>>
			<?php echo $reimbursh_add->terbayar->selectOptionListHtml("x_terbayar") ?>
		</select>
</div>
<?php echo $reimbursh_add->terbayar->Lookup->getParamTag($reimbursh_add, "p_x_terbayar") ?>
</span>
<?php echo $reimbursh_add->terbayar->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($reimbursh_add->tgl_pembayaran->Visible) { // tgl_pembayaran ?>
	<div id="r_tgl_pembayaran" class="form-group row">
		<label id="elh_reimbursh_tgl_pembayaran" for="x_tgl_pembayaran" class="<?php echo $reimbursh_add->LeftColumnClass ?>"><?php echo $reimbursh_add->tgl_pembayaran->caption() ?><?php echo $reimbursh_add->tgl_pembayaran->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $reimbursh_add->RightColumnClass ?>"><div <?php echo $reimbursh_add->tgl_pembayaran->cellAttributes() ?>>
<span id="el_reimbursh_tgl_pembayaran">
<input type="text" data-table="reimbursh" data-field="x_tgl_pembayaran" name="x_tgl_pembayaran" id="x_tgl_pembayaran" maxlength="19" placeholder="<?php echo HtmlEncode($reimbursh_add->tgl_pembayaran->getPlaceHolder()) ?>" value="<?php echo $reimbursh_add->tgl_pembayaran->EditValue ?>"<?php echo $reimbursh_add->tgl_pembayaran->editAttributes() ?>>
<?php if (!$reimbursh_add->tgl_pembayaran->ReadOnly && !$reimbursh_add->tgl_pembayaran->Disabled && !isset($reimbursh_add->tgl_pembayaran->EditAttrs["readonly"]) && !isset($reimbursh_add->tgl_pembayaran->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["freimburshadd", "datetimepicker"], function() {
	ew.createDateTimePicker("freimburshadd", "x_tgl_pembayaran", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $reimbursh_add->tgl_pembayaran->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($reimbursh_add->jumlah_dibayar->Visible) { // jumlah_dibayar ?>
	<div id="r_jumlah_dibayar" class="form-group row">
		<label id="elh_reimbursh_jumlah_dibayar" for="x_jumlah_dibayar" class="<?php echo $reimbursh_add->LeftColumnClass ?>"><?php echo $reimbursh_add->jumlah_dibayar->caption() ?><?php echo $reimbursh_add->jumlah_dibayar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $reimbursh_add->RightColumnClass ?>"><div <?php echo $reimbursh_add->jumlah_dibayar->cellAttributes() ?>>
<span id="el_reimbursh_jumlah_dibayar">
<input type="text" data-table="reimbursh" data-field="x_jumlah_dibayar" name="x_jumlah_dibayar" id="x_jumlah_dibayar" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($reimbursh_add->jumlah_dibayar->getPlaceHolder()) ?>" value="<?php echo $reimbursh_add->jumlah_dibayar->EditValue ?>"<?php echo $reimbursh_add->jumlah_dibayar->editAttributes() ?>>
</span>
<?php echo $reimbursh_add->jumlah_dibayar->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$reimbursh_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $reimbursh_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $reimbursh_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$reimbursh_add->showPageFooter();
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
$reimbursh_add->terminate();
?>