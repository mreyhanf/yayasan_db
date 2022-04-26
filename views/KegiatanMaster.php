<?php

namespace PHPMaker2022\project1;

// Table
$kegiatan = Container("kegiatan");
?>
<?php if ($kegiatan->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_kegiatanmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($kegiatan->idKegiatan->Visible) { // idKegiatan ?>
        <tr id="r_idKegiatan"<?= $kegiatan->idKegiatan->rowAttributes() ?>>
            <td class="<?= $kegiatan->TableLeftColumnClass ?>"><?= $kegiatan->idKegiatan->caption() ?></td>
            <td<?= $kegiatan->idKegiatan->cellAttributes() ?>>
<span id="el_kegiatan_idKegiatan">
<span<?= $kegiatan->idKegiatan->viewAttributes() ?>>
<?= $kegiatan->idKegiatan->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($kegiatan->nama->Visible) { // nama ?>
        <tr id="r_nama"<?= $kegiatan->nama->rowAttributes() ?>>
            <td class="<?= $kegiatan->TableLeftColumnClass ?>"><?= $kegiatan->nama->caption() ?></td>
            <td<?= $kegiatan->nama->cellAttributes() ?>>
<span id="el_kegiatan_nama">
<span<?= $kegiatan->nama->viewAttributes() ?>>
<?= $kegiatan->nama->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($kegiatan->deskripsi->Visible) { // deskripsi ?>
        <tr id="r_deskripsi"<?= $kegiatan->deskripsi->rowAttributes() ?>>
            <td class="<?= $kegiatan->TableLeftColumnClass ?>"><?= $kegiatan->deskripsi->caption() ?></td>
            <td<?= $kegiatan->deskripsi->cellAttributes() ?>>
<span id="el_kegiatan_deskripsi">
<span<?= $kegiatan->deskripsi->viewAttributes() ?>>
<?= $kegiatan->deskripsi->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($kegiatan->penanggungJawab->Visible) { // penanggungJawab ?>
        <tr id="r_penanggungJawab"<?= $kegiatan->penanggungJawab->rowAttributes() ?>>
            <td class="<?= $kegiatan->TableLeftColumnClass ?>"><?= $kegiatan->penanggungJawab->caption() ?></td>
            <td<?= $kegiatan->penanggungJawab->cellAttributes() ?>>
<span id="el_kegiatan_penanggungJawab">
<span<?= $kegiatan->penanggungJawab->viewAttributes() ?>>
<?= $kegiatan->penanggungJawab->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($kegiatan->tanggalMulai->Visible) { // tanggalMulai ?>
        <tr id="r_tanggalMulai"<?= $kegiatan->tanggalMulai->rowAttributes() ?>>
            <td class="<?= $kegiatan->TableLeftColumnClass ?>"><?= $kegiatan->tanggalMulai->caption() ?></td>
            <td<?= $kegiatan->tanggalMulai->cellAttributes() ?>>
<span id="el_kegiatan_tanggalMulai">
<span<?= $kegiatan->tanggalMulai->viewAttributes() ?>>
<?= $kegiatan->tanggalMulai->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($kegiatan->tanggalSelesai->Visible) { // tanggalSelesai ?>
        <tr id="r_tanggalSelesai"<?= $kegiatan->tanggalSelesai->rowAttributes() ?>>
            <td class="<?= $kegiatan->TableLeftColumnClass ?>"><?= $kegiatan->tanggalSelesai->caption() ?></td>
            <td<?= $kegiatan->tanggalSelesai->cellAttributes() ?>>
<span id="el_kegiatan_tanggalSelesai">
<span<?= $kegiatan->tanggalSelesai->viewAttributes() ?>>
<?= $kegiatan->tanggalSelesai->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($kegiatan->status->Visible) { // status ?>
        <tr id="r_status"<?= $kegiatan->status->rowAttributes() ?>>
            <td class="<?= $kegiatan->TableLeftColumnClass ?>"><?= $kegiatan->status->caption() ?></td>
            <td<?= $kegiatan->status->cellAttributes() ?>>
<span id="el_kegiatan_status">
<span<?= $kegiatan->status->viewAttributes() ?>>
<?= $kegiatan->status->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
