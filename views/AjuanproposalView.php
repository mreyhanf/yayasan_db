<?php

namespace PHPMaker2022\project1;

// Page object
$AjuanproposalView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { ajuanproposal: currentTable } });
var currentForm, currentPageID;
var fajuanproposalview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fajuanproposalview = new ew.Form("fajuanproposalview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fajuanproposalview;
    loadjs.done("fajuanproposalview");
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
<form name="fajuanproposalview" id="fajuanproposalview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="ajuanproposal">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->idProyek->Visible) { // idProyek ?>
    <tr id="r_idProyek"<?= $Page->idProyek->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ajuanproposal_idProyek"><?= $Page->idProyek->caption() ?></span></td>
        <td data-name="idProyek"<?= $Page->idProyek->cellAttributes() ?>>
<span id="el_ajuanproposal_idProyek">
<span<?= $Page->idProyek->viewAttributes() ?>>
<?= $Page->idProyek->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->idTargetProposal->Visible) { // idTargetProposal ?>
    <tr id="r_idTargetProposal"<?= $Page->idTargetProposal->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ajuanproposal_idTargetProposal"><?= $Page->idTargetProposal->caption() ?></span></td>
        <td data-name="idTargetProposal"<?= $Page->idTargetProposal->cellAttributes() ?>>
<span id="el_ajuanproposal_idTargetProposal">
<span<?= $Page->idTargetProposal->viewAttributes() ?>>
<?= $Page->idTargetProposal->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tanggalPengajuan->Visible) { // tanggalPengajuan ?>
    <tr id="r_tanggalPengajuan"<?= $Page->tanggalPengajuan->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ajuanproposal_tanggalPengajuan"><?= $Page->tanggalPengajuan->caption() ?></span></td>
        <td data-name="tanggalPengajuan"<?= $Page->tanggalPengajuan->cellAttributes() ?>>
<span id="el_ajuanproposal_tanggalPengajuan">
<span<?= $Page->tanggalPengajuan->viewAttributes() ?>>
<?= $Page->tanggalPengajuan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <tr id="r_status"<?= $Page->status->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ajuanproposal_status"><?= $Page->status->caption() ?></span></td>
        <td data-name="status"<?= $Page->status->cellAttributes() ?>>
<span id="el_ajuanproposal_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
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
