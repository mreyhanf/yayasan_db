<?php

namespace PHPMaker2022\project1;

// Table
$targetproposal = Container("targetproposal");
?>
<?php if ($targetproposal->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_targetproposalmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($targetproposal->idTargetProposal->Visible) { // idTargetProposal ?>
        <tr id="r_idTargetProposal"<?= $targetproposal->idTargetProposal->rowAttributes() ?>>
            <td class="<?= $targetproposal->TableLeftColumnClass ?>"><?= $targetproposal->idTargetProposal->caption() ?></td>
            <td<?= $targetproposal->idTargetProposal->cellAttributes() ?>>
<span id="el_targetproposal_idTargetProposal">
<span<?= $targetproposal->idTargetProposal->viewAttributes() ?>>
<?= $targetproposal->idTargetProposal->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($targetproposal->nama->Visible) { // nama ?>
        <tr id="r_nama"<?= $targetproposal->nama->rowAttributes() ?>>
            <td class="<?= $targetproposal->TableLeftColumnClass ?>"><?= $targetproposal->nama->caption() ?></td>
            <td<?= $targetproposal->nama->cellAttributes() ?>>
<span id="el_targetproposal_nama">
<span<?= $targetproposal->nama->viewAttributes() ?>>
<?= $targetproposal->nama->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($targetproposal->jenis->Visible) { // jenis ?>
        <tr id="r_jenis"<?= $targetproposal->jenis->rowAttributes() ?>>
            <td class="<?= $targetproposal->TableLeftColumnClass ?>"><?= $targetproposal->jenis->caption() ?></td>
            <td<?= $targetproposal->jenis->cellAttributes() ?>>
<span id="el_targetproposal_jenis">
<span<?= $targetproposal->jenis->viewAttributes() ?>>
<?= $targetproposal->jenis->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
