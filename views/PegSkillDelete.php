<?php

namespace PHPMaker2022\sigap;

// Page object
$PegSkillDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { peg_skill: currentTable } });
var currentForm, currentPageID;
var fpeg_skilldelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fpeg_skilldelete = new ew.Form("fpeg_skilldelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fpeg_skilldelete;
    loadjs.done("fpeg_skilldelete");
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
<form name="fpeg_skilldelete" id="fpeg_skilldelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="peg_skill">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table table-bordered table-hover table-sm ew-table">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->c_by->Visible) { // c_by ?>
        <th class="<?= $Page->c_by->headerCellClass() ?>"><span id="elh_peg_skill_c_by" class="peg_skill_c_by"><?= $Page->c_by->caption() ?></span></th>
<?php } ?>
<?php if ($Page->keahlian->Visible) { // keahlian ?>
        <th class="<?= $Page->keahlian->headerCellClass() ?>"><span id="elh_peg_skill_keahlian" class="peg_skill_keahlian"><?= $Page->keahlian->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tingkat->Visible) { // tingkat ?>
        <th class="<?= $Page->tingkat->headerCellClass() ?>"><span id="elh_peg_skill_tingkat" class="peg_skill_tingkat"><?= $Page->tingkat->caption() ?></span></th>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
        <th class="<?= $Page->keterangan->headerCellClass() ?>"><span id="elh_peg_skill_keterangan" class="peg_skill_keterangan"><?= $Page->keterangan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->bukti->Visible) { // bukti ?>
        <th class="<?= $Page->bukti->headerCellClass() ?>"><span id="elh_peg_skill_bukti" class="peg_skill_bukti"><?= $Page->bukti->caption() ?></span></th>
<?php } ?>
<?php if ($Page->c_date->Visible) { // c_date ?>
        <th class="<?= $Page->c_date->headerCellClass() ?>"><span id="elh_peg_skill_c_date" class="peg_skill_c_date"><?= $Page->c_date->caption() ?></span></th>
<?php } ?>
<?php if ($Page->u_date->Visible) { // u_date ?>
        <th class="<?= $Page->u_date->headerCellClass() ?>"><span id="elh_peg_skill_u_date" class="peg_skill_u_date"><?= $Page->u_date->caption() ?></span></th>
<?php } ?>
<?php if ($Page->u_by->Visible) { // u_by ?>
        <th class="<?= $Page->u_by->headerCellClass() ?>"><span id="elh_peg_skill_u_by" class="peg_skill_u_by"><?= $Page->u_by->caption() ?></span></th>
<?php } ?>
    </tr>
    </thead>
    <tbody>
<?php
$Page->RecordCount = 0;
$i = 0;
while (!$Page->Recordset->EOF) {
    $Page->RecordCount++;
    $Page->RowCount++;

    // Set row properties
    $Page->resetAttributes();
    $Page->RowType = ROWTYPE_VIEW; // View

    // Get the field contents
    $Page->loadRowValues($Page->Recordset);

    // Render row
    $Page->renderRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php if ($Page->c_by->Visible) { // c_by ?>
        <td<?= $Page->c_by->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_peg_skill_c_by" class="el_peg_skill_c_by">
<span<?= $Page->c_by->viewAttributes() ?>>
<?= $Page->c_by->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->keahlian->Visible) { // keahlian ?>
        <td<?= $Page->keahlian->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_peg_skill_keahlian" class="el_peg_skill_keahlian">
<span<?= $Page->keahlian->viewAttributes() ?>>
<?= $Page->keahlian->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tingkat->Visible) { // tingkat ?>
        <td<?= $Page->tingkat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_peg_skill_tingkat" class="el_peg_skill_tingkat">
<span<?= $Page->tingkat->viewAttributes() ?>>
<?= $Page->tingkat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
        <td<?= $Page->keterangan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_peg_skill_keterangan" class="el_peg_skill_keterangan">
<span<?= $Page->keterangan->viewAttributes() ?>>
<?= $Page->keterangan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->bukti->Visible) { // bukti ?>
        <td<?= $Page->bukti->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_peg_skill_bukti" class="el_peg_skill_bukti">
<span<?= $Page->bukti->viewAttributes() ?>>
<?= GetFileViewTag($Page->bukti, $Page->bukti->getViewValue(), false) ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($Page->c_date->Visible) { // c_date ?>
        <td<?= $Page->c_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_peg_skill_c_date" class="el_peg_skill_c_date">
<span<?= $Page->c_date->viewAttributes() ?>>
<?= $Page->c_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->u_date->Visible) { // u_date ?>
        <td<?= $Page->u_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_peg_skill_u_date" class="el_peg_skill_u_date">
<span<?= $Page->u_date->viewAttributes() ?>>
<?= $Page->u_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->u_by->Visible) { // u_by ?>
        <td<?= $Page->u_by->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_peg_skill_u_by" class="el_peg_skill_u_by">
<span<?= $Page->u_by->viewAttributes() ?>>
<?= $Page->u_by->getViewValue() ?></span>
</span>
</td>
<?php } ?>
    </tr>
<?php
    $Page->Recordset->moveNext();
}
$Page->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
