<?php

namespace PHPMaker2022\project1;

// Table
$anggota = Container("anggota");
?>
<?php if ($anggota->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_anggotamaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($anggota->idAnggota->Visible) { // idAnggota ?>
        <tr id="r_idAnggota"<?= $anggota->idAnggota->rowAttributes() ?>>
            <td class="<?= $anggota->TableLeftColumnClass ?>"><?= $anggota->idAnggota->caption() ?></td>
            <td<?= $anggota->idAnggota->cellAttributes() ?>>
<span id="el_anggota_idAnggota">
<span<?= $anggota->idAnggota->viewAttributes() ?>>
<?= $anggota->idAnggota->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($anggota->nama->Visible) { // nama ?>
        <tr id="r_nama"<?= $anggota->nama->rowAttributes() ?>>
            <td class="<?= $anggota->TableLeftColumnClass ?>"><?= $anggota->nama->caption() ?></td>
            <td<?= $anggota->nama->cellAttributes() ?>>
<span id="el_anggota_nama">
<span<?= $anggota->nama->viewAttributes() ?>>
<?= $anggota->nama->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($anggota->idJabatan->Visible) { // idJabatan ?>
        <tr id="r_idJabatan"<?= $anggota->idJabatan->rowAttributes() ?>>
            <td class="<?= $anggota->TableLeftColumnClass ?>"><?= $anggota->idJabatan->caption() ?></td>
            <td<?= $anggota->idJabatan->cellAttributes() ?>>
<span id="el_anggota_idJabatan">
<span<?= $anggota->idJabatan->viewAttributes() ?>>
<?= $anggota->idJabatan->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($anggota->alamat->Visible) { // alamat ?>
        <tr id="r_alamat"<?= $anggota->alamat->rowAttributes() ?>>
            <td class="<?= $anggota->TableLeftColumnClass ?>"><?= $anggota->alamat->caption() ?></td>
            <td<?= $anggota->alamat->cellAttributes() ?>>
<span id="el_anggota_alamat">
<span<?= $anggota->alamat->viewAttributes() ?>>
<?= $anggota->alamat->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($anggota->kesibukan->Visible) { // kesibukan ?>
        <tr id="r_kesibukan"<?= $anggota->kesibukan->rowAttributes() ?>>
            <td class="<?= $anggota->TableLeftColumnClass ?>"><?= $anggota->kesibukan->caption() ?></td>
            <td<?= $anggota->kesibukan->cellAttributes() ?>>
<span id="el_anggota_kesibukan">
<span<?= $anggota->kesibukan->viewAttributes() ?>>
<?= $anggota->kesibukan->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
