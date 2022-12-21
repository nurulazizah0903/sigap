<?php

namespace PHPMaker2022\sigap;

// Page object
$PegSkillView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { peg_skill: currentTable } });
var currentForm, currentPageID;
var fpeg_skillview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fpeg_skillview = new ew.Form("fpeg_skillview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fpeg_skillview;
    loadjs.done("fpeg_skillview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fpeg_skillview" id="fpeg_skillview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="peg_skill">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_peg_skill_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_peg_skill_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->c_by->Visible) { // c_by ?>
    <tr id="r_c_by"<?= $Page->c_by->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_peg_skill_c_by"><?= $Page->c_by->caption() ?></span></td>
        <td data-name="c_by"<?= $Page->c_by->cellAttributes() ?>>
<span id="el_peg_skill_c_by">
<span<?= $Page->c_by->viewAttributes() ?>>
<?= $Page->c_by->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pid->Visible) { // pid ?>
    <tr id="r_pid"<?= $Page->pid->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_peg_skill_pid"><?= $Page->pid->caption() ?></span></td>
        <td data-name="pid"<?= $Page->pid->cellAttributes() ?>>
<span id="el_peg_skill_pid">
<span<?= $Page->pid->viewAttributes() ?>>
<?= $Page->pid->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->keahlian->Visible) { // keahlian ?>
    <tr id="r_keahlian"<?= $Page->keahlian->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_peg_skill_keahlian"><?= $Page->keahlian->caption() ?></span></td>
        <td data-name="keahlian"<?= $Page->keahlian->cellAttributes() ?>>
<span id="el_peg_skill_keahlian">
<span<?= $Page->keahlian->viewAttributes() ?>>
<?= $Page->keahlian->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tingkat->Visible) { // tingkat ?>
    <tr id="r_tingkat"<?= $Page->tingkat->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_peg_skill_tingkat"><?= $Page->tingkat->caption() ?></span></td>
        <td data-name="tingkat"<?= $Page->tingkat->cellAttributes() ?>>
<span id="el_peg_skill_tingkat">
<span<?= $Page->tingkat->viewAttributes() ?>>
<?= $Page->tingkat->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
    <tr id="r_keterangan"<?= $Page->keterangan->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_peg_skill_keterangan"><?= $Page->keterangan->caption() ?></span></td>
        <td data-name="keterangan"<?= $Page->keterangan->cellAttributes() ?>>
<span id="el_peg_skill_keterangan">
<span<?= $Page->keterangan->viewAttributes() ?>>
<?= $Page->keterangan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->bukti->Visible) { // bukti ?>
    <tr id="r_bukti"<?= $Page->bukti->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_peg_skill_bukti"><?= $Page->bukti->caption() ?></span></td>
        <td data-name="bukti"<?= $Page->bukti->cellAttributes() ?>>
<span id="el_peg_skill_bukti">
<span<?= $Page->bukti->viewAttributes() ?>>
<?= GetFileViewTag($Page->bukti, $Page->bukti->getViewValue(), false) ?>
</span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->c_date->Visible) { // c_date ?>
    <tr id="r_c_date"<?= $Page->c_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_peg_skill_c_date"><?= $Page->c_date->caption() ?></span></td>
        <td data-name="c_date"<?= $Page->c_date->cellAttributes() ?>>
<span id="el_peg_skill_c_date">
<span<?= $Page->c_date->viewAttributes() ?>>
<?= $Page->c_date->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->u_date->Visible) { // u_date ?>
    <tr id="r_u_date"<?= $Page->u_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_peg_skill_u_date"><?= $Page->u_date->caption() ?></span></td>
        <td data-name="u_date"<?= $Page->u_date->cellAttributes() ?>>
<span id="el_peg_skill_u_date">
<span<?= $Page->u_date->viewAttributes() ?>>
<?= $Page->u_date->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->u_by->Visible) { // u_by ?>
    <tr id="r_u_by"<?= $Page->u_by->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_peg_skill_u_by"><?= $Page->u_by->caption() ?></span></td>
        <td data-name="u_by"<?= $Page->u_by->cellAttributes() ?>>
<span id="el_peg_skill_u_by">
<span<?= $Page->u_by->viewAttributes() ?>>
<?= $Page->u_by->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
