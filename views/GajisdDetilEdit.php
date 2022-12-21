<?php

namespace PHPMaker2022\sigap;

// Page object
$GajisdDetilEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { gajisd_detil: currentTable } });
var currentForm, currentPageID;
var fgajisd_detiledit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fgajisd_detiledit = new ew.Form("fgajisd_detiledit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fgajisd_detiledit;

    // Add fields
    var fields = currentTable.fields;
    fgajisd_detiledit.addFields([
        ["pegawai_id", [fields.pegawai_id.visible && fields.pegawai_id.required ? ew.Validators.required(fields.pegawai_id.caption) : null, ew.Validators.integer], fields.pegawai_id.isInvalid],
        ["jabatan_id", [fields.jabatan_id.visible && fields.jabatan_id.required ? ew.Validators.required(fields.jabatan_id.caption) : null, ew.Validators.integer], fields.jabatan_id.isInvalid],
        ["masakerja", [fields.masakerja.visible && fields.masakerja.required ? ew.Validators.required(fields.masakerja.caption) : null, ew.Validators.integer], fields.masakerja.isInvalid],
        ["jumngajar", [fields.jumngajar.visible && fields.jumngajar.required ? ew.Validators.required(fields.jumngajar.caption) : null, ew.Validators.integer], fields.jumngajar.isInvalid],
        ["ijin", [fields.ijin.visible && fields.ijin.required ? ew.Validators.required(fields.ijin.caption) : null, ew.Validators.integer], fields.ijin.isInvalid],
        ["baku", [fields.baku.visible && fields.baku.required ? ew.Validators.required(fields.baku.caption) : null, ew.Validators.integer], fields.baku.isInvalid],
        ["kehadiran", [fields.kehadiran.visible && fields.kehadiran.required ? ew.Validators.required(fields.kehadiran.caption) : null, ew.Validators.integer], fields.kehadiran.isInvalid],
        ["prestasi", [fields.prestasi.visible && fields.prestasi.required ? ew.Validators.required(fields.prestasi.caption) : null, ew.Validators.integer], fields.prestasi.isInvalid],
        ["nominal_baku", [fields.nominal_baku.visible && fields.nominal_baku.required ? ew.Validators.required(fields.nominal_baku.caption) : null, ew.Validators.integer], fields.nominal_baku.isInvalid],
        ["jumlahterima", [fields.jumlahterima.visible && fields.jumlahterima.required ? ew.Validators.required(fields.jumlahterima.caption) : null, ew.Validators.integer], fields.jumlahterima.isInvalid],
        ["tunjangan_wkosis", [fields.tunjangan_wkosis.visible && fields.tunjangan_wkosis.required ? ew.Validators.required(fields.tunjangan_wkosis.caption) : null, ew.Validators.integer], fields.tunjangan_wkosis.isInvalid],
        ["potongan1", [fields.potongan1.visible && fields.potongan1.required ? ew.Validators.required(fields.potongan1.caption) : null, ew.Validators.integer], fields.potongan1.isInvalid],
        ["potongan2", [fields.potongan2.visible && fields.potongan2.required ? ew.Validators.required(fields.potongan2.caption) : null, ew.Validators.integer], fields.potongan2.isInvalid],
        ["jumlahgaji", [fields.jumlahgaji.visible && fields.jumlahgaji.required ? ew.Validators.required(fields.jumlahgaji.caption) : null, ew.Validators.integer], fields.jumlahgaji.isInvalid],
        ["jumgajitotal", [fields.jumgajitotal.visible && fields.jumgajitotal.required ? ew.Validators.required(fields.jumgajitotal.caption) : null, ew.Validators.integer], fields.jumgajitotal.isInvalid]
    ]);

    // Form_CustomValidate
    fgajisd_detiledit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fgajisd_detiledit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fgajisd_detiledit.lists.pegawai_id = <?= $Page->pegawai_id->toClientList($Page) ?>;
    fgajisd_detiledit.lists.jabatan_id = <?= $Page->jabatan_id->toClientList($Page) ?>;
    loadjs.done("fgajisd_detiledit");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fgajisd_detiledit" id="fgajisd_detiledit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="gajisd_detil">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "gajisd") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="gajisd">
<input type="hidden" name="fk_id" value="<?= HtmlEncode($Page->pid->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->pegawai_id->Visible) { // pegawai_id ?>
    <div id="r_pegawai_id"<?= $Page->pegawai_id->rowAttributes() ?>>
        <label id="elh_gajisd_detil_pegawai_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pegawai_id->caption() ?><?= $Page->pegawai_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->pegawai_id->cellAttributes() ?>>
<span id="el_gajisd_detil_pegawai_id">
<?php $Page->pegawai_id->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
    <select
        id="x_pegawai_id"
        name="x_pegawai_id"
        class="form-control ew-select<?= $Page->pegawai_id->isInvalidClass() ?>"
        data-select2-id="fgajisd_detiledit_x_pegawai_id"
        data-table="gajisd_detil"
        data-field="x_pegawai_id"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->pegawai_id->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->pegawai_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->pegawai_id->getPlaceHolder()) ?>"
        <?= $Page->pegawai_id->editAttributes() ?>>
        <?= $Page->pegawai_id->selectOptionListHtml("x_pegawai_id") ?>
    </select>
    <?= $Page->pegawai_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->pegawai_id->getErrorMessage() ?></div>
<?= $Page->pegawai_id->Lookup->getParamTag($Page, "p_x_pegawai_id") ?>
<script>
loadjs.ready("fgajisd_detiledit", function() {
    var options = { name: "x_pegawai_id", selectId: "fgajisd_detiledit_x_pegawai_id" };
    if (fgajisd_detiledit.lists.pegawai_id.lookupOptions.length) {
        options.data = { id: "x_pegawai_id", form: "fgajisd_detiledit" };
    } else {
        options.ajax = { id: "x_pegawai_id", form: "fgajisd_detiledit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.gajisd_detil.fields.pegawai_id.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jabatan_id->Visible) { // jabatan_id ?>
    <div id="r_jabatan_id"<?= $Page->jabatan_id->rowAttributes() ?>>
        <label id="elh_gajisd_detil_jabatan_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jabatan_id->caption() ?><?= $Page->jabatan_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->jabatan_id->cellAttributes() ?>>
<span id="el_gajisd_detil_jabatan_id">
<?php
$onchange = $Page->jabatan_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$Page->jabatan_id->EditAttrs["onchange"] = "";
if (IsRTL()) {
    $Page->jabatan_id->EditAttrs["dir"] = "rtl";
}
?>
<span id="as_x_jabatan_id" class="ew-auto-suggest">
    <input type="<?= $Page->jabatan_id->getInputTextType() ?>" class="form-control" name="sv_x_jabatan_id" id="sv_x_jabatan_id" value="<?= RemoveHtml($Page->jabatan_id->EditValue) ?>" size="30" placeholder="<?= HtmlEncode($Page->jabatan_id->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Page->jabatan_id->getPlaceHolder()) ?>"<?= $Page->jabatan_id->editAttributes() ?> aria-describedby="x_jabatan_id_help">
</span>
<selection-list hidden class="form-control" data-table="gajisd_detil" data-field="x_jabatan_id" data-input="sv_x_jabatan_id" data-value-separator="<?= $Page->jabatan_id->displayValueSeparatorAttribute() ?>" name="x_jabatan_id" id="x_jabatan_id" value="<?= HtmlEncode($Page->jabatan_id->CurrentValue) ?>"<?= $onchange ?>></selection-list>
<?= $Page->jabatan_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->jabatan_id->getErrorMessage() ?></div>
<script>
loadjs.ready("fgajisd_detiledit", function() {
    fgajisd_detiledit.createAutoSuggest(Object.assign({"id":"x_jabatan_id","forceSelect":false}, ew.vars.tables.gajisd_detil.fields.jabatan_id.autoSuggestOptions));
});
</script>
<?= $Page->jabatan_id->Lookup->getParamTag($Page, "p_x_jabatan_id") ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->masakerja->Visible) { // masakerja ?>
    <div id="r_masakerja"<?= $Page->masakerja->rowAttributes() ?>>
        <label id="elh_gajisd_detil_masakerja" for="x_masakerja" class="<?= $Page->LeftColumnClass ?>"><?= $Page->masakerja->caption() ?><?= $Page->masakerja->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->masakerja->cellAttributes() ?>>
<span id="el_gajisd_detil_masakerja">
<input type="<?= $Page->masakerja->getInputTextType() ?>" name="x_masakerja" id="x_masakerja" data-table="gajisd_detil" data-field="x_masakerja" value="<?= $Page->masakerja->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->masakerja->getPlaceHolder()) ?>"<?= $Page->masakerja->editAttributes() ?> aria-describedby="x_masakerja_help">
<?= $Page->masakerja->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->masakerja->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jumngajar->Visible) { // jumngajar ?>
    <div id="r_jumngajar"<?= $Page->jumngajar->rowAttributes() ?>>
        <label id="elh_gajisd_detil_jumngajar" for="x_jumngajar" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jumngajar->caption() ?><?= $Page->jumngajar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->jumngajar->cellAttributes() ?>>
<span id="el_gajisd_detil_jumngajar">
<input type="<?= $Page->jumngajar->getInputTextType() ?>" name="x_jumngajar" id="x_jumngajar" data-table="gajisd_detil" data-field="x_jumngajar" value="<?= $Page->jumngajar->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->jumngajar->getPlaceHolder()) ?>"<?= $Page->jumngajar->editAttributes() ?> aria-describedby="x_jumngajar_help">
<?= $Page->jumngajar->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->jumngajar->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ijin->Visible) { // ijin ?>
    <div id="r_ijin"<?= $Page->ijin->rowAttributes() ?>>
        <label id="elh_gajisd_detil_ijin" for="x_ijin" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ijin->caption() ?><?= $Page->ijin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->ijin->cellAttributes() ?>>
<span id="el_gajisd_detil_ijin">
<input type="<?= $Page->ijin->getInputTextType() ?>" name="x_ijin" id="x_ijin" data-table="gajisd_detil" data-field="x_ijin" value="<?= $Page->ijin->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->ijin->getPlaceHolder()) ?>"<?= $Page->ijin->editAttributes() ?> aria-describedby="x_ijin_help">
<?= $Page->ijin->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ijin->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->baku->Visible) { // baku ?>
    <div id="r_baku"<?= $Page->baku->rowAttributes() ?>>
        <label id="elh_gajisd_detil_baku" for="x_baku" class="<?= $Page->LeftColumnClass ?>"><?= $Page->baku->caption() ?><?= $Page->baku->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->baku->cellAttributes() ?>>
<span id="el_gajisd_detil_baku">
<input type="<?= $Page->baku->getInputTextType() ?>" name="x_baku" id="x_baku" data-table="gajisd_detil" data-field="x_baku" value="<?= $Page->baku->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->baku->getPlaceHolder()) ?>"<?= $Page->baku->editAttributes() ?> aria-describedby="x_baku_help">
<?= $Page->baku->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->baku->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kehadiran->Visible) { // kehadiran ?>
    <div id="r_kehadiran"<?= $Page->kehadiran->rowAttributes() ?>>
        <label id="elh_gajisd_detil_kehadiran" for="x_kehadiran" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kehadiran->caption() ?><?= $Page->kehadiran->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->kehadiran->cellAttributes() ?>>
<span id="el_gajisd_detil_kehadiran">
<input type="<?= $Page->kehadiran->getInputTextType() ?>" name="x_kehadiran" id="x_kehadiran" data-table="gajisd_detil" data-field="x_kehadiran" value="<?= $Page->kehadiran->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->kehadiran->getPlaceHolder()) ?>"<?= $Page->kehadiran->editAttributes() ?> aria-describedby="x_kehadiran_help">
<?= $Page->kehadiran->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kehadiran->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->prestasi->Visible) { // prestasi ?>
    <div id="r_prestasi"<?= $Page->prestasi->rowAttributes() ?>>
        <label id="elh_gajisd_detil_prestasi" for="x_prestasi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->prestasi->caption() ?><?= $Page->prestasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->prestasi->cellAttributes() ?>>
<span id="el_gajisd_detil_prestasi">
<input type="<?= $Page->prestasi->getInputTextType() ?>" name="x_prestasi" id="x_prestasi" data-table="gajisd_detil" data-field="x_prestasi" value="<?= $Page->prestasi->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->prestasi->getPlaceHolder()) ?>"<?= $Page->prestasi->editAttributes() ?> aria-describedby="x_prestasi_help">
<?= $Page->prestasi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->prestasi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nominal_baku->Visible) { // nominal_baku ?>
    <div id="r_nominal_baku"<?= $Page->nominal_baku->rowAttributes() ?>>
        <label id="elh_gajisd_detil_nominal_baku" for="x_nominal_baku" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nominal_baku->caption() ?><?= $Page->nominal_baku->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->nominal_baku->cellAttributes() ?>>
<span id="el_gajisd_detil_nominal_baku">
<input type="<?= $Page->nominal_baku->getInputTextType() ?>" name="x_nominal_baku" id="x_nominal_baku" data-table="gajisd_detil" data-field="x_nominal_baku" value="<?= $Page->nominal_baku->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->nominal_baku->getPlaceHolder()) ?>"<?= $Page->nominal_baku->editAttributes() ?> aria-describedby="x_nominal_baku_help">
<?= $Page->nominal_baku->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nominal_baku->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jumlahterima->Visible) { // jumlahterima ?>
    <div id="r_jumlahterima"<?= $Page->jumlahterima->rowAttributes() ?>>
        <label id="elh_gajisd_detil_jumlahterima" for="x_jumlahterima" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jumlahterima->caption() ?><?= $Page->jumlahterima->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->jumlahterima->cellAttributes() ?>>
<span id="el_gajisd_detil_jumlahterima">
<input type="<?= $Page->jumlahterima->getInputTextType() ?>" name="x_jumlahterima" id="x_jumlahterima" data-table="gajisd_detil" data-field="x_jumlahterima" value="<?= $Page->jumlahterima->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->jumlahterima->getPlaceHolder()) ?>"<?= $Page->jumlahterima->editAttributes() ?> aria-describedby="x_jumlahterima_help">
<?= $Page->jumlahterima->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->jumlahterima->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tunjangan_wkosis->Visible) { // tunjangan_wkosis ?>
    <div id="r_tunjangan_wkosis"<?= $Page->tunjangan_wkosis->rowAttributes() ?>>
        <label id="elh_gajisd_detil_tunjangan_wkosis" for="x_tunjangan_wkosis" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tunjangan_wkosis->caption() ?><?= $Page->tunjangan_wkosis->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tunjangan_wkosis->cellAttributes() ?>>
<span id="el_gajisd_detil_tunjangan_wkosis">
<input type="<?= $Page->tunjangan_wkosis->getInputTextType() ?>" name="x_tunjangan_wkosis" id="x_tunjangan_wkosis" data-table="gajisd_detil" data-field="x_tunjangan_wkosis" value="<?= $Page->tunjangan_wkosis->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->tunjangan_wkosis->getPlaceHolder()) ?>"<?= $Page->tunjangan_wkosis->editAttributes() ?> aria-describedby="x_tunjangan_wkosis_help">
<?= $Page->tunjangan_wkosis->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tunjangan_wkosis->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->potongan1->Visible) { // potongan1 ?>
    <div id="r_potongan1"<?= $Page->potongan1->rowAttributes() ?>>
        <label id="elh_gajisd_detil_potongan1" for="x_potongan1" class="<?= $Page->LeftColumnClass ?>"><?= $Page->potongan1->caption() ?><?= $Page->potongan1->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->potongan1->cellAttributes() ?>>
<span id="el_gajisd_detil_potongan1">
<input type="<?= $Page->potongan1->getInputTextType() ?>" name="x_potongan1" id="x_potongan1" data-table="gajisd_detil" data-field="x_potongan1" value="<?= $Page->potongan1->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->potongan1->getPlaceHolder()) ?>"<?= $Page->potongan1->editAttributes() ?> aria-describedby="x_potongan1_help">
<?= $Page->potongan1->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->potongan1->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->potongan2->Visible) { // potongan2 ?>
    <div id="r_potongan2"<?= $Page->potongan2->rowAttributes() ?>>
        <label id="elh_gajisd_detil_potongan2" for="x_potongan2" class="<?= $Page->LeftColumnClass ?>"><?= $Page->potongan2->caption() ?><?= $Page->potongan2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->potongan2->cellAttributes() ?>>
<span id="el_gajisd_detil_potongan2">
<input type="<?= $Page->potongan2->getInputTextType() ?>" name="x_potongan2" id="x_potongan2" data-table="gajisd_detil" data-field="x_potongan2" value="<?= $Page->potongan2->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->potongan2->getPlaceHolder()) ?>"<?= $Page->potongan2->editAttributes() ?> aria-describedby="x_potongan2_help">
<?= $Page->potongan2->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->potongan2->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jumlahgaji->Visible) { // jumlahgaji ?>
    <div id="r_jumlahgaji"<?= $Page->jumlahgaji->rowAttributes() ?>>
        <label id="elh_gajisd_detil_jumlahgaji" for="x_jumlahgaji" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jumlahgaji->caption() ?><?= $Page->jumlahgaji->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->jumlahgaji->cellAttributes() ?>>
<span id="el_gajisd_detil_jumlahgaji">
<input type="<?= $Page->jumlahgaji->getInputTextType() ?>" name="x_jumlahgaji" id="x_jumlahgaji" data-table="gajisd_detil" data-field="x_jumlahgaji" value="<?= $Page->jumlahgaji->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->jumlahgaji->getPlaceHolder()) ?>"<?= $Page->jumlahgaji->editAttributes() ?> aria-describedby="x_jumlahgaji_help">
<?= $Page->jumlahgaji->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->jumlahgaji->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jumgajitotal->Visible) { // jumgajitotal ?>
    <div id="r_jumgajitotal"<?= $Page->jumgajitotal->rowAttributes() ?>>
        <label id="elh_gajisd_detil_jumgajitotal" for="x_jumgajitotal" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jumgajitotal->caption() ?><?= $Page->jumgajitotal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->jumgajitotal->cellAttributes() ?>>
<span id="el_gajisd_detil_jumgajitotal">
<input type="<?= $Page->jumgajitotal->getInputTextType() ?>" name="x_jumgajitotal" id="x_jumgajitotal" data-table="gajisd_detil" data-field="x_jumgajitotal" value="<?= $Page->jumgajitotal->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->jumgajitotal->getPlaceHolder()) ?>"<?= $Page->jumgajitotal->editAttributes() ?> aria-describedby="x_jumgajitotal_help">
<?= $Page->jumgajitotal->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->jumgajitotal->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
    <input type="hidden" data-table="gajisd_detil" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
<?php if (!$Page->IsModal) { ?>
<div class="row"><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
    </div><!-- /buttons offset -->
</div><!-- /buttons .row -->
<?php } ?>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("gajisd_detil");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
