<?php

namespace PHPMaker2022\project1;

// Page object
$DonasiView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { donasi: currentTable } });
var currentForm, currentPageID;
var fdonasiview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fdonasiview = new ew.Form("fdonasiview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fdonasiview;
    loadjs.done("fdonasiview");
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
<form name="fdonasiview" id="fdonasiview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="donasi">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->idDonasi->Visible) { // idDonasi ?>
    <tr id="r_idDonasi"<?= $Page->idDonasi->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_donasi_idDonasi"><?= $Page->idDonasi->caption() ?></span></td>
        <td data-name="idDonasi"<?= $Page->idDonasi->cellAttributes() ?>>
<span id="el_donasi_idDonasi">
<span<?= $Page->idDonasi->viewAttributes() ?>>
<?= $Page->idDonasi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->idDonatur->Visible) { // idDonatur ?>
    <tr id="r_idDonatur"<?= $Page->idDonatur->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_donasi_idDonatur"><?= $Page->idDonatur->caption() ?></span></td>
        <td data-name="idDonatur"<?= $Page->idDonatur->cellAttributes() ?>>
<span id="el_donasi_idDonatur">
<span<?= $Page->idDonatur->viewAttributes() ?>>
<?= $Page->idDonatur->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nominal->Visible) { // nominal ?>
    <tr id="r_nominal"<?= $Page->nominal->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_donasi_nominal"><?= $Page->nominal->caption() ?></span></td>
        <td data-name="nominal"<?= $Page->nominal->cellAttributes() ?>>
<span id="el_donasi_nominal">
<span<?= $Page->nominal->viewAttributes() ?>>
<?= $Page->nominal->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->idProyek->Visible) { // idProyek ?>
    <tr id="r_idProyek"<?= $Page->idProyek->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_donasi_idProyek"><?= $Page->idProyek->caption() ?></span></td>
        <td data-name="idProyek"<?= $Page->idProyek->cellAttributes() ?>>
<span id="el_donasi_idProyek">
<span<?= $Page->idProyek->viewAttributes() ?>>
<?= $Page->idProyek->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->waktu->Visible) { // waktu ?>
    <tr id="r_waktu"<?= $Page->waktu->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_donasi_waktu"><?= $Page->waktu->caption() ?></span></td>
        <td data-name="waktu"<?= $Page->waktu->cellAttributes() ?>>
<span id="el_donasi_waktu">
<span<?= $Page->waktu->viewAttributes() ?>>
<?= $Page->waktu->getViewValue() ?></span>
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
