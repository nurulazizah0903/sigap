<?php

namespace PHPMaker2022\sigap;

// Page object
$GajismpDetilEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { gajismp_detil: currentTable } });
var currentForm, currentPageID;
var fgajismp_detiledit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fgajismp_detiledit = new ew.Form("fgajismp_detiledit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fgajismp_detiledit;

    // Add fields
    var fields = currentTable.fields;
    fgajismp_detiledit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["pid", [fields.pid.visible && fields.pid.required ? ew.Validators.required(fields.pid.caption) : null, ew.Validators.integer], fields.pid.isInvalid],
        ["pegawai_id", [fields.pegawai_id.visible && fields.pegawai_id.required ? ew.Validators.required(fields.pegawai_id.caption) : null, ew.Validators.integer], fields.pegawai_id.isInvalid],
        ["jabatan_id", [fields.jabatan_id.visible && fields.jabatan_id.required ? ew.Validators.required(fields.jabatan_id.caption) : null, ew.Validators.integer], fields.jabatan_id.isInvalid],
        ["masakerja", [fields.masakerja.visible && fields.masakerja.required ? ew.Validators.required(fields.masakerja.caption) : null, ew.Validators.integer], fields.masakerja.isInvalid],
        ["jumngajar", [fields.jumngajar.visible && fields.jumngajar.required ? ew.Validators.required(fields.jumngajar.caption) : null, ew.Validators.integer], fields.jumngajar.isInvalid],
        ["ijin", [fields.ijin.visible && fields.ijin.required ? ew.Validators.required(fields.ijin.caption) : null, ew.Validators.integer], fields.ijin.isInvalid],
        ["tunjangan_wkosis", [fields.tunjangan_wkosis.visible && fields.tunjangan_wkosis.required ? ew.Validators.required(fields.tunjangan_wkosis.caption) : null, ew.Validators.integer], fields.tunjangan_wkosis.isInvalid],
        ["nominal_baku", [fields.nominal_baku.visible && fields.nominal_baku.required ? ew.Validators.required(fields.nominal_baku.caption) : null, ew.Validators.integer], fields.nominal_baku.isInvalid],
        ["baku", [fields.baku.visible && fields.baku.required ? ew.Validators.required(fields.baku.caption) : null, ew.Validators.integer], fields.baku.isInvalid],
        ["kehadiran", [fields.kehadiran.visible && fields.kehadiran.required ? ew.Validators.required(fields.kehadiran.caption) : null, ew.Validators.integer], fields.kehadiran.isInvalid],
        ["prestasi", [fields.prestasi.visible && fields.prestasi.required ? ew.Validators.required(fields.prestasi.caption) : null, ew.Validators.integer], fields.prestasi.isInvalid],
        ["jumlahgaji", [fields.jumlahgaji.visible && fields.jumlahgaji.required ? ew.Validators.required(fields.jumlahgaji.caption) : null, ew.Validators.integer], fields.jumlahgaji.isInvalid],
        ["jumgajitotal", [fields.jumgajitotal.visible && fields.jumgajitotal.required ? ew.Validators.required(fields.jumgajitotal.caption) : null, ew.Validators.integer], fields.jumgajitotal.isInvalid],
        ["potongan1", [fields.potongan1.visible && fields.potongan1.required ? ew.Validators.required(fields.potongan1.caption) : null, ew.Validators.integer], fields.potongan1.isInvalid],
        ["potongan2", [fields.potongan2.visible && fields.potongan2.required ? ew.Validators.required(fields.potongan2.caption) : null, ew.Validators.integer], fields.potongan2.isInvalid],
        ["jumlahterima", [fields.jumlahterima.visible && fields.jumlahterima.required ? ew.Validators.required(fields.jumlahterima.caption) : null, ew.Validators.integer], fields.jumlahterima.isInvalid]
    ]);

    // Form_CustomValidate
    fgajismp_detiledit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fgajismp_detiledit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("fgajismp_detiledit");
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
<form name="fgajismp_detiledit" id="fgajismp_detiledit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="gajismp_detil">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "gajismp") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="gajismp">
<input type="hidden" name="fk_id" value="<?= HtmlEncode($Page->pid->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_gajismp_detil_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_gajismp_detil_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="gajismp_detil" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->pid->Visible) { // pid ?>
    <div id="r_pid"<?= $Page->pid->rowAttributes() ?>>
        <label id="elh_gajismp_detil_pid" for="x_pid" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pid->caption() ?><?= $Page->pid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->pid->cellAttributes() ?>>
<?php if ($Page->pid->getSessionValue() != "") { ?>
<span<?= $Page->pid->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->pid->getDisplayValue($Page->pid->ViewValue))) ?>"></span>
<input type="hidden" id="x_pid" name="x_pid" value="<?= HtmlEncode($Page->pid->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_gajismp_detil_pid">
<input type="<?= $Page->pid->getInputTextType() ?>" name="x_pid" id="x_pid" data-table="gajismp_detil" data-field="x_pid" value="<?= $Page->pid->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->pid->getPlaceHolder()) ?>"<?= $Page->pid->editAttributes() ?> aria-describedby="x_pid_help">
<?= $Page->pid->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->pid->getErrorMessage() ?></div>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->pegawai_id->Visible) { // pegawai_id ?>
    <div id="r_pegawai_id"<?= $Page->pegawai_id->rowAttributes() ?>>
        <label id="elh_gajismp_detil_pegawai_id" for="x_pegawai_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pegawai_id->caption() ?><?= $Page->pegawai_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->pegawai_id->cellAttributes() ?>>
<span id="el_gajismp_detil_pegawai_id">
<input type="<?= $Page->pegawai_id->getInputTextType() ?>" name="x_pegawai_id" id="x_pegawai_id" data-table="gajismp_detil" data-field="x_pegawai_id" value="<?= $Page->pegawai_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->pegawai_id->getPlaceHolder()) ?>"<?= $Page->pegawai_id->editAttributes() ?> aria-describedby="x_pegawai_id_help">
<?= $Page->pegawai_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->pegawai_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jabatan_id->Visible) { // jabatan_id ?>
    <div id="r_jabatan_id"<?= $Page->jabatan_id->rowAttributes() ?>>
        <label id="elh_gajismp_detil_jabatan_id" for="x_jabatan_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jabatan_id->caption() ?><?= $Page->jabatan_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->jabatan_id->cellAttributes() ?>>
<span id="el_gajismp_detil_jabatan_id">
<input type="<?= $Page->jabatan_id->getInputTextType() ?>" name="x_jabatan_id" id="x_jabatan_id" data-table="gajismp_detil" data-field="x_jabatan_id" value="<?= $Page->jabatan_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->jabatan_id->getPlaceHolder()) ?>"<?= $Page->jabatan_id->editAttributes() ?> aria-describedby="x_jabatan_id_help">
<?= $Page->jabatan_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->jabatan_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->masakerja->Visible) { // masakerja ?>
    <div id="r_masakerja"<?= $Page->masakerja->rowAttributes() ?>>
        <label id="elh_gajismp_detil_masakerja" for="x_masakerja" class="<?= $Page->LeftColumnClass ?>"><?= $Page->masakerja->caption() ?><?= $Page->masakerja->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->masakerja->cellAttributes() ?>>
<span id="el_gajismp_detil_masakerja">
<input type="<?= $Page->masakerja->getInputTextType() ?>" name="x_masakerja" id="x_masakerja" data-table="gajismp_detil" data-field="x_masakerja" value="<?= $Page->masakerja->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->masakerja->getPlaceHolder()) ?>"<?= $Page->masakerja->editAttributes() ?> aria-describedby="x_masakerja_help">
<?= $Page->masakerja->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->masakerja->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jumngajar->Visible) { // jumngajar ?>
    <div id="r_jumngajar"<?= $Page->jumngajar->rowAttributes() ?>>
        <label id="elh_gajismp_detil_jumngajar" for="x_jumngajar" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jumngajar->caption() ?><?= $Page->jumngajar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->jumngajar->cellAttributes() ?>>
<span id="el_gajismp_detil_jumngajar">
<input type="<?= $Page->jumngajar->getInputTextType() ?>" name="x_jumngajar" id="x_jumngajar" data-table="gajismp_detil" data-field="x_jumngajar" value="<?= $Page->jumngajar->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->jumngajar->getPlaceHolder()) ?>"<?= $Page->jumngajar->editAttributes() ?> aria-describedby="x_jumngajar_help">
<?= $Page->jumngajar->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->jumngajar->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ijin->Visible) { // ijin ?>
    <div id="r_ijin"<?= $Page->ijin->rowAttributes() ?>>
        <label id="elh_gajismp_detil_ijin" for="x_ijin" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ijin->caption() ?><?= $Page->ijin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->ijin->cellAttributes() ?>>
<span id="el_gajismp_detil_ijin">
<input type="<?= $Page->ijin->getInputTextType() ?>" name="x_ijin" id="x_ijin" data-table="gajismp_detil" data-field="x_ijin" value="<?= $Page->ijin->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->ijin->getPlaceHolder()) ?>"<?= $Page->ijin->editAttributes() ?> aria-describedby="x_ijin_help">
<?= $Page->ijin->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ijin->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tunjangan_wkosis->Visible) { // tunjangan_wkosis ?>
    <div id="r_tunjangan_wkosis"<?= $Page->tunjangan_wkosis->rowAttributes() ?>>
        <label id="elh_gajismp_detil_tunjangan_wkosis" for="x_tunjangan_wkosis" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tunjangan_wkosis->caption() ?><?= $Page->tunjangan_wkosis->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tunjangan_wkosis->cellAttributes() ?>>
<span id="el_gajismp_detil_tunjangan_wkosis">
<input type="<?= $Page->tunjangan_wkosis->getInputTextType() ?>" name="x_tunjangan_wkosis" id="x_tunjangan_wkosis" data-table="gajismp_detil" data-field="x_tunjangan_wkosis" value="<?= $Page->tunjangan_wkosis->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->tunjangan_wkosis->getPlaceHolder()) ?>"<?= $Page->tunjangan_wkosis->editAttributes() ?> aria-describedby="x_tunjangan_wkosis_help">
<?= $Page->tunjangan_wkosis->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tunjangan_wkosis->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nominal_baku->Visible) { // nominal_baku ?>
    <div id="r_nominal_baku"<?= $Page->nominal_baku->rowAttributes() ?>>
        <label id="elh_gajismp_detil_nominal_baku" for="x_nominal_baku" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nominal_baku->caption() ?><?= $Page->nominal_baku->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->nominal_baku->cellAttributes() ?>>
<span id="el_gajismp_detil_nominal_baku">
<input type="<?= $Page->nominal_baku->getInputTextType() ?>" name="x_nominal_baku" id="x_nominal_baku" data-table="gajismp_detil" data-field="x_nominal_baku" value="<?= $Page->nominal_baku->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->nominal_baku->getPlaceHolder()) ?>"<?= $Page->nominal_baku->editAttributes() ?> aria-describedby="x_nominal_baku_help">
<?= $Page->nominal_baku->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nominal_baku->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->baku->Visible) { // baku ?>
    <div id="r_baku"<?= $Page->baku->rowAttributes() ?>>
        <label id="elh_gajismp_detil_baku" for="x_baku" class="<?= $Page->LeftColumnClass ?>"><?= $Page->baku->caption() ?><?= $Page->baku->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->baku->cellAttributes() ?>>
<span id="el_gajismp_detil_baku">
<input type="<?= $Page->baku->getInputTextType() ?>" name="x_baku" id="x_baku" data-table="gajismp_detil" data-field="x_baku" value="<?= $Page->baku->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->baku->getPlaceHolder()) ?>"<?= $Page->baku->editAttributes() ?> aria-describedby="x_baku_help">
<?= $Page->baku->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->baku->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kehadiran->Visible) { // kehadiran ?>
    <div id="r_kehadiran"<?= $Page->kehadiran->rowAttributes() ?>>
        <label id="elh_gajismp_detil_kehadiran" for="x_kehadiran" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kehadiran->caption() ?><?= $Page->kehadiran->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->kehadiran->cellAttributes() ?>>
<span id="el_gajismp_detil_kehadiran">
<input type="<?= $Page->kehadiran->getInputTextType() ?>" name="x_kehadiran" id="x_kehadiran" data-table="gajismp_detil" data-field="x_kehadiran" value="<?= $Page->kehadiran->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->kehadiran->getPlaceHolder()) ?>"<?= $Page->kehadiran->editAttributes() ?> aria-describedby="x_kehadiran_help">
<?= $Page->kehadiran->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kehadiran->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->prestasi->Visible) { // prestasi ?>
    <div id="r_prestasi"<?= $Page->prestasi->rowAttributes() ?>>
        <label id="elh_gajismp_detil_prestasi" for="x_prestasi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->prestasi->caption() ?><?= $Page->prestasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->prestasi->cellAttributes() ?>>
<span id="el_gajismp_detil_prestasi">
<input type="<?= $Page->prestasi->getInputTextType() ?>" name="x_prestasi" id="x_prestasi" data-table="gajismp_detil" data-field="x_prestasi" value="<?= $Page->prestasi->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->prestasi->getPlaceHolder()) ?>"<?= $Page->prestasi->editAttributes() ?> aria-describedby="x_prestasi_help">
<?= $Page->prestasi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->prestasi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jumlahgaji->Visible) { // jumlahgaji ?>
    <div id="r_jumlahgaji"<?= $Page->jumlahgaji->rowAttributes() ?>>
        <label id="elh_gajismp_detil_jumlahgaji" for="x_jumlahgaji" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jumlahgaji->caption() ?><?= $Page->jumlahgaji->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->jumlahgaji->cellAttributes() ?>>
<span id="el_gajismp_detil_jumlahgaji">
<input type="<?= $Page->jumlahgaji->getInputTextType() ?>" name="x_jumlahgaji" id="x_jumlahgaji" data-table="gajismp_detil" data-field="x_jumlahgaji" value="<?= $Page->jumlahgaji->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->jumlahgaji->getPlaceHolder()) ?>"<?= $Page->jumlahgaji->editAttributes() ?> aria-describedby="x_jumlahgaji_help">
<?= $Page->jumlahgaji->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->jumlahgaji->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jumgajitotal->Visible) { // jumgajitotal ?>
    <div id="r_jumgajitotal"<?= $Page->jumgajitotal->rowAttributes() ?>>
        <label id="elh_gajismp_detil_jumgajitotal" for="x_jumgajitotal" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jumgajitotal->caption() ?><?= $Page->jumgajitotal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->jumgajitotal->cellAttributes() ?>>
<span id="el_gajismp_detil_jumgajitotal">
<input type="<?= $Page->jumgajitotal->getInputTextType() ?>" name="x_jumgajitotal" id="x_jumgajitotal" data-table="gajismp_detil" data-field="x_jumgajitotal" value="<?= $Page->jumgajitotal->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->jumgajitotal->getPlaceHolder()) ?>"<?= $Page->jumgajitotal->editAttributes() ?> aria-describedby="x_jumgajitotal_help">
<?= $Page->jumgajitotal->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->jumgajitotal->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->potongan1->Visible) { // potongan1 ?>
    <div id="r_potongan1"<?= $Page->potongan1->rowAttributes() ?>>
        <label id="elh_gajismp_detil_potongan1" for="x_potongan1" class="<?= $Page->LeftColumnClass ?>"><?= $Page->potongan1->caption() ?><?= $Page->potongan1->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->potongan1->cellAttributes() ?>>
<span id="el_gajismp_detil_potongan1">
<input type="<?= $Page->potongan1->getInputTextType() ?>" name="x_potongan1" id="x_potongan1" data-table="gajismp_detil" data-field="x_potongan1" value="<?= $Page->potongan1->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->potongan1->getPlaceHolder()) ?>"<?= $Page->potongan1->editAttributes() ?> aria-describedby="x_potongan1_help">
<?= $Page->potongan1->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->potongan1->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->potongan2->Visible) { // potongan2 ?>
    <div id="r_potongan2"<?= $Page->potongan2->rowAttributes() ?>>
        <label id="elh_gajismp_detil_potongan2" for="x_potongan2" class="<?= $Page->LeftColumnClass ?>"><?= $Page->potongan2->caption() ?><?= $Page->potongan2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->potongan2->cellAttributes() ?>>
<span id="el_gajismp_detil_potongan2">
<input type="<?= $Page->potongan2->getInputTextType() ?>" name="x_potongan2" id="x_potongan2" data-table="gajismp_detil" data-field="x_potongan2" value="<?= $Page->potongan2->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->potongan2->getPlaceHolder()) ?>"<?= $Page->potongan2->editAttributes() ?> aria-describedby="x_potongan2_help">
<?= $Page->potongan2->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->potongan2->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jumlahterima->Visible) { // jumlahterima ?>
    <div id="r_jumlahterima"<?= $Page->jumlahterima->rowAttributes() ?>>
        <label id="elh_gajismp_detil_jumlahterima" for="x_jumlahterima" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jumlahterima->caption() ?><?= $Page->jumlahterima->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->jumlahterima->cellAttributes() ?>>
<span id="el_gajismp_detil_jumlahterima">
<input type="<?= $Page->jumlahterima->getInputTextType() ?>" name="x_jumlahterima" id="x_jumlahterima" data-table="gajismp_detil" data-field="x_jumlahterima" value="<?= $Page->jumlahterima->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->jumlahterima->getPlaceHolder()) ?>"<?= $Page->jumlahterima->editAttributes() ?> aria-describedby="x_jumlahterima_help">
<?= $Page->jumlahterima->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->jumlahterima->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
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
    ew.addEventHandlers("gajismp_detil");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
