<?php

namespace PHPMaker2022\project1;

// Table
$proyek = Container("proyek");
?>
<?php if ($proyek->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_proyekmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($proyek->idProyek->Visible) { // idProyek ?>
        <tr id="r_idProyek"<?= $proyek->idProyek->rowAttributes() ?>>
            <td class="<?= $proyek->TableLeftColumnClass ?>"><?= $proyek->idProyek->caption() ?></td>
            <td<?= $proyek->idProyek->cellAttributes() ?>>
<span id="el_proyek_idProyek">
<span<?= $proyek->idProyek->viewAttributes() ?>>
<?= $proyek->idProyek->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($proyek->ajuan->Visible) { // ajuan ?>
        <tr id="r_ajuan"<?= $proyek->ajuan->rowAttributes() ?>>
            <td class="<?= $proyek->TableLeftColumnClass ?>"><?= $proyek->ajuan->caption() ?></td>
            <td<?= $proyek->ajuan->cellAttributes() ?>>
<span id="el_proyek_ajuan">
<span<?= $proyek->ajuan->viewAttributes() ?>>
<?= $proyek->ajuan->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($proyek->biayaTerkumpul->Visible) { // biayaTerkumpul ?>
        <tr id="r_biayaTerkumpul"<?= $proyek->biayaTerkumpul->rowAttributes() ?>>
            <td class="<?= $proyek->TableLeftColumnClass ?>"><?= $proyek->biayaTerkumpul->caption() ?></td>
            <td<?= $proyek->biayaTerkumpul->cellAttributes() ?>>
<span id="el_proyek_biayaTerkumpul">
<span<?= $proyek->biayaTerkumpul->viewAttributes() ?>>
<?= $proyek->biayaTerkumpul->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($proyek->tanggalMulai->Visible) { // tanggalMulai ?>
        <tr id="r_tanggalMulai"<?= $proyek->tanggalMulai->rowAttributes() ?>>
            <td class="<?= $proyek->TableLeftColumnClass ?>"><?= $proyek->tanggalMulai->caption() ?></td>
            <td<?= $proyek->tanggalMulai->cellAttributes() ?>>
<span id="el_proyek_tanggalMulai">
<span<?= $proyek->tanggalMulai->viewAttributes() ?>>
<?= $proyek->tanggalMulai->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($proyek->tanggalSelesai->Visible) { // tanggalSelesai ?>
        <tr id="r_tanggalSelesai"<?= $proyek->tanggalSelesai->rowAttributes() ?>>
            <td class="<?= $proyek->TableLeftColumnClass ?>"><?= $proyek->tanggalSelesai->caption() ?></td>
            <td<?= $proyek->tanggalSelesai->cellAttributes() ?>>
<span id="el_proyek_tanggalSelesai">
<span<?= $proyek->tanggalSelesai->viewAttributes() ?>>
<?= $proyek->tanggalSelesai->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($proyek->status->Visible) { // status ?>
        <tr id="r_status"<?= $proyek->status->rowAttributes() ?>>
            <td class="<?= $proyek->TableLeftColumnClass ?>"><?= $proyek->status->caption() ?></td>
            <td<?= $proyek->status->cellAttributes() ?>>
<span id="el_proyek_status">
<span<?= $proyek->status->viewAttributes() ?>>
<?= $proyek->status->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
