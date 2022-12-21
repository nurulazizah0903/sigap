<?php

namespace PHPMaker2022\sigap;

// Table
$jabatan = Container("jabatan");
?>
<?php if ($jabatan->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_jabatanmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($jabatan->id->Visible) { // id ?>
        <tr id="r_id"<?= $jabatan->id->rowAttributes() ?>>
            <td class="<?= $jabatan->TableLeftColumnClass ?>"><?= $jabatan->id->caption() ?></td>
            <td<?= $jabatan->id->cellAttributes() ?>>
<span id="el_jabatan_id">
<span<?= $jabatan->id->viewAttributes() ?>>
<?= $jabatan->id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jabatan->jenjang->Visible) { // jenjang ?>
        <tr id="r_jenjang"<?= $jabatan->jenjang->rowAttributes() ?>>
            <td class="<?= $jabatan->TableLeftColumnClass ?>"><?= $jabatan->jenjang->caption() ?></td>
            <td<?= $jabatan->jenjang->cellAttributes() ?>>
<span id="el_jabatan_jenjang">
<span<?= $jabatan->jenjang->viewAttributes() ?>>
<?= $jabatan->jenjang->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jabatan->nama_jabatan->Visible) { // nama_jabatan ?>
        <tr id="r_nama_jabatan"<?= $jabatan->nama_jabatan->rowAttributes() ?>>
            <td class="<?= $jabatan->TableLeftColumnClass ?>"><?= $jabatan->nama_jabatan->caption() ?></td>
            <td<?= $jabatan->nama_jabatan->cellAttributes() ?>>
<span id="el_jabatan_nama_jabatan">
<span<?= $jabatan->nama_jabatan->viewAttributes() ?>>
<?= $jabatan->nama_jabatan->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jabatan->keterangan->Visible) { // keterangan ?>
        <tr id="r_keterangan"<?= $jabatan->keterangan->rowAttributes() ?>>
            <td class="<?= $jabatan->TableLeftColumnClass ?>"><?= $jabatan->keterangan->caption() ?></td>
            <td<?= $jabatan->keterangan->cellAttributes() ?>>
<span id="el_jabatan_keterangan">
<span<?= $jabatan->keterangan->viewAttributes() ?>>
<?= $jabatan->keterangan->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jabatan->c_date->Visible) { // c_date ?>
        <tr id="r_c_date"<?= $jabatan->c_date->rowAttributes() ?>>
            <td class="<?= $jabatan->TableLeftColumnClass ?>"><?= $jabatan->c_date->caption() ?></td>
            <td<?= $jabatan->c_date->cellAttributes() ?>>
<span id="el_jabatan_c_date">
<span<?= $jabatan->c_date->viewAttributes() ?>>
<?= $jabatan->c_date->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jabatan->u_date->Visible) { // u_date ?>
        <tr id="r_u_date"<?= $jabatan->u_date->rowAttributes() ?>>
            <td class="<?= $jabatan->TableLeftColumnClass ?>"><?= $jabatan->u_date->caption() ?></td>
            <td<?= $jabatan->u_date->cellAttributes() ?>>
<span id="el_jabatan_u_date">
<span<?= $jabatan->u_date->viewAttributes() ?>>
<?= $jabatan->u_date->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jabatan->c_by->Visible) { // c_by ?>
        <tr id="r_c_by"<?= $jabatan->c_by->rowAttributes() ?>>
            <td class="<?= $jabatan->TableLeftColumnClass ?>"><?= $jabatan->c_by->caption() ?></td>
            <td<?= $jabatan->c_by->cellAttributes() ?>>
<span id="el_jabatan_c_by">
<span<?= $jabatan->c_by->viewAttributes() ?>>
<?= $jabatan->c_by->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jabatan->u_by->Visible) { // u_by ?>
        <tr id="r_u_by"<?= $jabatan->u_by->rowAttributes() ?>>
            <td class="<?= $jabatan->TableLeftColumnClass ?>"><?= $jabatan->u_by->caption() ?></td>
            <td<?= $jabatan->u_by->cellAttributes() ?>>
<span id="el_jabatan_u_by">
<span<?= $jabatan->u_by->viewAttributes() ?>>
<?= $jabatan->u_by->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($jabatan->aktif->Visible) { // aktif ?>
        <tr id="r_aktif"<?= $jabatan->aktif->rowAttributes() ?>>
            <td class="<?= $jabatan->TableLeftColumnClass ?>"><?= $jabatan->aktif->caption() ?></td>
            <td<?= $jabatan->aktif->cellAttributes() ?>>
<span id="el_jabatan_aktif">
<span<?= $jabatan->aktif->viewAttributes() ?>>
<?= $jabatan->aktif->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
