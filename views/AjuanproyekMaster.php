<?php

namespace PHPMaker2022\project1;

// Table
$ajuanproyek = Container("ajuanproyek");
?>
<?php if ($ajuanproyek->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_ajuanproyekmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($ajuanproyek->idAjuanProyek->Visible) { // idAjuanProyek ?>
        <tr id="r_idAjuanProyek"<?= $ajuanproyek->idAjuanProyek->rowAttributes() ?>>
            <td class="<?= $ajuanproyek->TableLeftColumnClass ?>"><?= $ajuanproyek->idAjuanProyek->caption() ?></td>
            <td<?= $ajuanproyek->idAjuanProyek->cellAttributes() ?>>
<span id="el_ajuanproyek_idAjuanProyek">
<span<?= $ajuanproyek->idAjuanProyek->viewAttributes() ?>>
<?= $ajuanproyek->idAjuanProyek->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($ajuanproyek->nama->Visible) { // nama ?>
        <tr id="r_nama"<?= $ajuanproyek->nama->rowAttributes() ?>>
            <td class="<?= $ajuanproyek->TableLeftColumnClass ?>"><?= $ajuanproyek->nama->caption() ?></td>
            <td<?= $ajuanproyek->nama->cellAttributes() ?>>
<span id="el_ajuanproyek_nama">
<span<?= $ajuanproyek->nama->viewAttributes() ?>>
<?= $ajuanproyek->nama->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($ajuanproyek->pengaju->Visible) { // pengaju ?>
        <tr id="r_pengaju"<?= $ajuanproyek->pengaju->rowAttributes() ?>>
            <td class="<?= $ajuanproyek->TableLeftColumnClass ?>"><?= $ajuanproyek->pengaju->caption() ?></td>
            <td<?= $ajuanproyek->pengaju->cellAttributes() ?>>
<span id="el_ajuanproyek_pengaju">
<span<?= $ajuanproyek->pengaju->viewAttributes() ?>>
<?= $ajuanproyek->pengaju->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($ajuanproyek->biaya->Visible) { // biaya ?>
        <tr id="r_biaya"<?= $ajuanproyek->biaya->rowAttributes() ?>>
            <td class="<?= $ajuanproyek->TableLeftColumnClass ?>"><?= $ajuanproyek->biaya->caption() ?></td>
            <td<?= $ajuanproyek->biaya->cellAttributes() ?>>
<span id="el_ajuanproyek_biaya">
<span<?= $ajuanproyek->biaya->viewAttributes() ?>>
<?= $ajuanproyek->biaya->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($ajuanproyek->tanggalPengajuan->Visible) { // tanggalPengajuan ?>
        <tr id="r_tanggalPengajuan"<?= $ajuanproyek->tanggalPengajuan->rowAttributes() ?>>
            <td class="<?= $ajuanproyek->TableLeftColumnClass ?>"><?= $ajuanproyek->tanggalPengajuan->caption() ?></td>
            <td<?= $ajuanproyek->tanggalPengajuan->cellAttributes() ?>>
<span id="el_ajuanproyek_tanggalPengajuan">
<span<?= $ajuanproyek->tanggalPengajuan->viewAttributes() ?>>
<?= $ajuanproyek->tanggalPengajuan->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($ajuanproyek->keputusan->Visible) { // keputusan ?>
        <tr id="r_keputusan"<?= $ajuanproyek->keputusan->rowAttributes() ?>>
            <td class="<?= $ajuanproyek->TableLeftColumnClass ?>"><?= $ajuanproyek->keputusan->caption() ?></td>
            <td<?= $ajuanproyek->keputusan->cellAttributes() ?>>
<span id="el_ajuanproyek_keputusan">
<span<?= $ajuanproyek->keputusan->viewAttributes() ?>>
<?= $ajuanproyek->keputusan->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
