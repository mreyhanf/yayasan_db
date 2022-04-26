<?php

namespace PHPMaker2022\project1;

// Page object
$PartisipasiproyekView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { partisipasiproyek: currentTable } });
var currentForm, currentPageID;
var fpartisipasiproyekview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fpartisipasiproyekview = new ew.Form("fpartisipasiproyekview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fpartisipasiproyekview;
    loadjs.done("fpartisipasiproyekview");
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
<form name="fpartisipasiproyekview" id="fpartisipasiproyekview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="partisipasiproyek">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->idAnggota->Visible) { // idAnggota ?>
    <tr id="r_idAnggota"<?= $Page->idAnggota->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_partisipasiproyek_idAnggota"><?= $Page->idAnggota->caption() ?></span></td>
        <td data-name="idAnggota"<?= $Page->idAnggota->cellAttributes() ?>>
<span id="el_partisipasiproyek_idAnggota">
<span<?= $Page->idAnggota->viewAttributes() ?>>
<?= $Page->idAnggota->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->idProyek->Visible) { // idProyek ?>
    <tr id="r_idProyek"<?= $Page->idProyek->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_partisipasiproyek_idProyek"><?= $Page->idProyek->caption() ?></span></td>
        <td data-name="idProyek"<?= $Page->idProyek->cellAttributes() ?>>
<span id="el_partisipasiproyek_idProyek">
<span<?= $Page->idProyek->viewAttributes() ?>>
<?= $Page->idProyek->getViewValue() ?></span>
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
