<?php

namespace PHPMaker2022\sigap;

// Page object
$PegKeluargaAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { peg_keluarga: currentTable } });
var currentForm, currentPageID;
var fpeg_keluargaadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fpeg_keluargaadd = new ew.Form("fpeg_keluargaadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fpeg_keluargaadd;

    // Add fields
    var fields = currentTable.fields;
    fpeg_keluargaadd.addFields([
        ["nama", [fields.nama.visible && fields.nama.required ? ew.Validators.required(fields.nama.caption) : null], fields.nama.isInvalid],
        ["hp", [fields.hp.visible && fields.hp.required ? ew.Validators.required(fields.hp.caption) : null], fields.hp.isInvalid],
        ["hubungan", [fields.hubungan.visible && fields.hubungan.required ? ew.Validators.required(fields.hubungan.caption) : null], fields.hubungan.isInvalid],
        ["tgl_lahir", [fields.tgl_lahir.visible && fields.tgl_lahir.required ? ew.Validators.required(fields.tgl_lahir.caption) : null, ew.Validators.datetime(fields.tgl_lahir.clientFormatPattern)], fields.tgl_lahir.isInvalid],
        ["jen_kel", [fields.jen_kel.visible && fields.jen_kel.required ? ew.Validators.required(fields.jen_kel.caption) : null], fields.jen_kel.isInvalid],
        ["keterangan", [fields.keterangan.visible && fields.keterangan.required ? ew.Validators.required(fields.keterangan.caption) : null], fields.keterangan.isInvalid]
    ]);

    // Form_CustomValidate
    fpeg_keluargaadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fpeg_keluargaadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fpeg_keluargaadd.lists.jen_kel = <?= $Page->jen_kel->toClientList($Page) ?>;
    loadjs.done("fpeg_keluargaadd");
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
<form name="fpeg_keluargaadd" id="fpeg_keluargaadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="peg_keluarga">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "pegawai") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="pegawai">
<input type="hidden" name="fk_id" value="<?= HtmlEncode($Page->pid->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->nama->Visible) { // nama ?>
    <div id="r_nama"<?= $Page->nama->rowAttributes() ?>>
        <label id="elh_peg_keluarga_nama" for="x_nama" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nama->caption() ?><?= $Page->nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->nama->cellAttributes() ?>>
<span id="el_peg_keluarga_nama">
<input type="<?= $Page->nama->getInputTextType() ?>" name="x_nama" id="x_nama" data-table="peg_keluarga" data-field="x_nama" value="<?= $Page->nama->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->nama->getPlaceHolder()) ?>"<?= $Page->nama->editAttributes() ?> aria-describedby="x_nama_help">
<?= $Page->nama->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nama->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->hp->Visible) { // hp ?>
    <div id="r_hp"<?= $Page->hp->rowAttributes() ?>>
        <label id="elh_peg_keluarga_hp" for="x_hp" class="<?= $Page->LeftColumnClass ?>"><?= $Page->hp->caption() ?><?= $Page->hp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->hp->cellAttributes() ?>>
<span id="el_peg_keluarga_hp">
<input type="<?= $Page->hp->getInputTextType() ?>" name="x_hp" id="x_hp" data-table="peg_keluarga" data-field="x_hp" value="<?= $Page->hp->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->hp->getPlaceHolder()) ?>"<?= $Page->hp->editAttributes() ?> aria-describedby="x_hp_help">
<?= $Page->hp->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->hp->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->hubungan->Visible) { // hubungan ?>
    <div id="r_hubungan"<?= $Page->hubungan->rowAttributes() ?>>
        <label id="elh_peg_keluarga_hubungan" for="x_hubungan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->hubungan->caption() ?><?= $Page->hubungan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->hubungan->cellAttributes() ?>>
<span id="el_peg_keluarga_hubungan">
<input type="<?= $Page->hubungan->getInputTextType() ?>" name="x_hubungan" id="x_hubungan" data-table="peg_keluarga" data-field="x_hubungan" value="<?= $Page->hubungan->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->hubungan->getPlaceHolder()) ?>"<?= $Page->hubungan->editAttributes() ?> aria-describedby="x_hubungan_help">
<?= $Page->hubungan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->hubungan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tgl_lahir->Visible) { // tgl_lahir ?>
    <div id="r_tgl_lahir"<?= $Page->tgl_lahir->rowAttributes() ?>>
        <label id="elh_peg_keluarga_tgl_lahir" for="x_tgl_lahir" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tgl_lahir->caption() ?><?= $Page->tgl_lahir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tgl_lahir->cellAttributes() ?>>
<span id="el_peg_keluarga_tgl_lahir">
<input type="<?= $Page->tgl_lahir->getInputTextType() ?>" name="x_tgl_lahir" id="x_tgl_lahir" data-table="peg_keluarga" data-field="x_tgl_lahir" value="<?= $Page->tgl_lahir->EditValue ?>" placeholder="<?= HtmlEncode($Page->tgl_lahir->getPlaceHolder()) ?>"<?= $Page->tgl_lahir->editAttributes() ?> aria-describedby="x_tgl_lahir_help">
<?= $Page->tgl_lahir->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tgl_lahir->getErrorMessage() ?></div>
<?php if (!$Page->tgl_lahir->ReadOnly && !$Page->tgl_lahir->Disabled && !isset($Page->tgl_lahir->EditAttrs["readonly"]) && !isset($Page->tgl_lahir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpeg_keluargaadd", "datetimepicker"], function () {
    let format = "<?= DateFormat(0) ?>",
        options = {
            localization: {
                locale: ew.LANGUAGE_ID + "-u-nu-" + ew.getNumberingSystem()
            },
            display: {
                icons: {
                    previous: ew.IS_RTL ? "fas fa-chevron-right" : "fas fa-chevron-left",
                    next: ew.IS_RTL ? "fas fa-chevron-left" : "fas fa-chevron-right"
                },
                components: {
                    hours: !!format.match(/h/i),
                    minutes: !!format.match(/m/),
                    seconds: !!format.match(/s/i),
                    useTwentyfourHour: !!format.match(/H/)
                }
            },
            meta: {
                format
            }
        };
    ew.createDateTimePicker("fpeg_keluargaadd", "x_tgl_lahir", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jen_kel->Visible) { // jen_kel ?>
    <div id="r_jen_kel"<?= $Page->jen_kel->rowAttributes() ?>>
        <label id="elh_peg_keluarga_jen_kel" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jen_kel->caption() ?><?= $Page->jen_kel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->jen_kel->cellAttributes() ?>>
<span id="el_peg_keluarga_jen_kel">
<template id="tp_x_jen_kel">
    <div class="form-check">
        <input type="radio" class="form-check-input" data-table="peg_keluarga" data-field="x_jen_kel" name="x_jen_kel" id="x_jen_kel"<?= $Page->jen_kel->editAttributes() ?>>
        <label class="form-check-label"></label>
    </div>
</template>
<div id="dsl_x_jen_kel" class="ew-item-list"></div>
<selection-list hidden
    id="x_jen_kel"
    name="x_jen_kel"
    value="<?= HtmlEncode($Page->jen_kel->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_jen_kel"
    data-bs-target="dsl_x_jen_kel"
    data-repeatcolumn="5"
    class="form-control<?= $Page->jen_kel->isInvalidClass() ?>"
    data-table="peg_keluarga"
    data-field="x_jen_kel"
    data-value-separator="<?= $Page->jen_kel->displayValueSeparatorAttribute() ?>"
    <?= $Page->jen_kel->editAttributes() ?>></selection-list>
<?= $Page->jen_kel->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->jen_kel->getErrorMessage() ?></div>
<?= $Page->jen_kel->Lookup->getParamTag($Page, "p_x_jen_kel") ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
    <div id="r_keterangan"<?= $Page->keterangan->rowAttributes() ?>>
        <label id="elh_peg_keluarga_keterangan" for="x_keterangan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->keterangan->caption() ?><?= $Page->keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->keterangan->cellAttributes() ?>>
<span id="el_peg_keluarga_keterangan">
<textarea data-table="peg_keluarga" data-field="x_keterangan" name="x_keterangan" id="x_keterangan" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->keterangan->getPlaceHolder()) ?>"<?= $Page->keterangan->editAttributes() ?> aria-describedby="x_keterangan_help"><?= $Page->keterangan->EditValue ?></textarea>
<?= $Page->keterangan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->keterangan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
    <?php if (strval($Page->pid->getSessionValue() ?? "") != "") { ?>
    <input type="hidden" name="x_pid" id="x_pid" value="<?= HtmlEncode(strval($Page->pid->getSessionValue() ?? "")) ?>">
    <?php } ?>
<?php if (!$Page->IsModal) { ?>
<div class="row"><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("AddBtn") ?></button>
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
    ew.addEventHandlers("peg_keluarga");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
