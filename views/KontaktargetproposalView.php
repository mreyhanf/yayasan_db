<?php

namespace PHPMaker2022\project1;

// Page object
$KontaktargetproposalView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { kontaktargetproposal: currentTable } });
var currentForm, currentPageID;
var fkontaktargetproposalview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fkontaktargetproposalview = new ew.Form("fkontaktargetproposalview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fkontaktargetproposalview;
    loadjs.done("fkontaktargetproposalview");
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
<form name="fkontaktargetproposalview" id="fkontaktargetproposalview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="kontaktargetproposal">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->kontak->Visible) { // kontak ?>
    <tr id="r_kontak"<?= $Page->kontak->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kontaktargetproposal_kontak"><?= $Page->kontak->caption() ?></span></td>
        <td data-name="kontak"<?= $Page->kontak->cellAttributes() ?>>
<span id="el_kontaktargetproposal_kontak">
<span<?= $Page->kontak->viewAttributes() ?>>
<?= $Page->kontak->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->idTargetProposal->Visible) { // idTargetProposal ?>
    <tr id="r_idTargetProposal"<?= $Page->idTargetProposal->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kontaktargetproposal_idTargetProposal"><?= $Page->idTargetProposal->caption() ?></span></td>
        <td data-name="idTargetProposal"<?= $Page->idTargetProposal->cellAttributes() ?>>
<span id="el_kontaktargetproposal_idTargetProposal">
<span<?= $Page->idTargetProposal->viewAttributes() ?>>
<?= $Page->idTargetProposal->getViewValue() ?></span>
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
