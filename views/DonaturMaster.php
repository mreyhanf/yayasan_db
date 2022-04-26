<?php

namespace PHPMaker2022\project1;

// Table
$donatur = Container("donatur");
?>
<?php if ($donatur->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_donaturmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($donatur->idDonatur->Visible) { // idDonatur ?>
        <tr id="r_idDonatur"<?= $donatur->idDonatur->rowAttributes() ?>>
            <td class="<?= $donatur->TableLeftColumnClass ?>"><?= $donatur->idDonatur->caption() ?></td>
            <td<?= $donatur->idDonatur->cellAttributes() ?>>
<span id="el_donatur_idDonatur">
<span<?= $donatur->idDonatur->viewAttributes() ?>>
<?= $donatur->idDonatur->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($donatur->nama->Visible) { // nama ?>
        <tr id="r_nama"<?= $donatur->nama->rowAttributes() ?>>
            <td class="<?= $donatur->TableLeftColumnClass ?>"><?= $donatur->nama->caption() ?></td>
            <td<?= $donatur->nama->cellAttributes() ?>>
<span id="el_donatur_nama">
<span<?= $donatur->nama->viewAttributes() ?>>
<?= $donatur->nama->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
