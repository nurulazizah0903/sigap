<?php

namespace PHPMaker2022\sigap;

// Table
$berita = Container("berita");
?>
<?php if ($berita->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_beritamaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($berita->grup->Visible) { // grup ?>
        <tr id="r_grup"<?= $berita->grup->rowAttributes() ?>>
            <td class="<?= $berita->TableLeftColumnClass ?>"><?= $berita->grup->caption() ?></td>
            <td<?= $berita->grup->cellAttributes() ?>>
<span id="el_berita_grup">
<span<?= $berita->grup->viewAttributes() ?>>
<?= $berita->grup->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($berita->judul->Visible) { // judul ?>
        <tr id="r_judul"<?= $berita->judul->rowAttributes() ?>>
            <td class="<?= $berita->TableLeftColumnClass ?>"><?= $berita->judul->caption() ?></td>
            <td<?= $berita->judul->cellAttributes() ?>>
<span id="el_berita_judul">
<span<?= $berita->judul->viewAttributes() ?>>
<?= $berita->judul->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($berita->c_by->Visible) { // c_by ?>
        <tr id="r_c_by"<?= $berita->c_by->rowAttributes() ?>>
            <td class="<?= $berita->TableLeftColumnClass ?>"><?= $berita->c_by->caption() ?></td>
            <td<?= $berita->c_by->cellAttributes() ?>>
<span id="el_berita_c_by">
<span<?= $berita->c_by->viewAttributes() ?>>
<?= $berita->c_by->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($berita->c_date->Visible) { // c_date ?>
        <tr id="r_c_date"<?= $berita->c_date->rowAttributes() ?>>
            <td class="<?= $berita->TableLeftColumnClass ?>"><?= $berita->c_date->caption() ?></td>
            <td<?= $berita->c_date->cellAttributes() ?>>
<span id="el_berita_c_date">
<span<?= $berita->c_date->viewAttributes() ?>>
<?= $berita->c_date->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($berita->aktif->Visible) { // aktif ?>
        <tr id="r_aktif"<?= $berita->aktif->rowAttributes() ?>>
            <td class="<?= $berita->TableLeftColumnClass ?>"><?= $berita->aktif->caption() ?></td>
            <td<?= $berita->aktif->cellAttributes() ?>>
<span id="el_berita_aktif">
<span<?= $berita->aktif->viewAttributes() ?>>
<?= $berita->aktif->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($berita->video->Visible) { // video ?>
        <tr id="r_video"<?= $berita->video->rowAttributes() ?>>
            <td class="<?= $berita->TableLeftColumnClass ?>"><?= $berita->video->caption() ?></td>
            <td<?= $berita->video->cellAttributes() ?>>
<span id="el_berita_video">
<span<?= $berita->video->viewAttributes() ?>>
<?= GetFileViewTag($berita->video, $berita->video->getViewValue(), false) ?>
</span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($berita->berita->Visible) { // berita ?>
        <tr id="r_berita"<?= $berita->berita->rowAttributes() ?>>
            <td class="<?= $berita->TableLeftColumnClass ?>"><?= $berita->berita->caption() ?></td>
            <td<?= $berita->berita->cellAttributes() ?>>
<span id="el_berita_berita">
<span<?= $berita->berita->viewAttributes() ?>>
<?= $berita->berita->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($berita->gambar->Visible) { // gambar ?>
        <tr id="r_gambar"<?= $berita->gambar->rowAttributes() ?>>
            <td class="<?= $berita->TableLeftColumnClass ?>"><?= $berita->gambar->caption() ?></td>
            <td<?= $berita->gambar->cellAttributes() ?>>
<span id="el_berita_gambar">
<span<?= $berita->gambar->viewAttributes() ?>>
<?= GetFileViewTag($berita->gambar, $berita->gambar->getViewValue(), false) ?>
</span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
