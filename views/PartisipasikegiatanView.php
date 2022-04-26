<?php

namespace PHPMaker2022\project1;

// Page object
$PartisipasikegiatanView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { partisipasikegiatan: currentTable } });
var currentForm, currentPageID;
var fpartisipasikegiatanview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fpartisipasikegiatanview = new ew.Form("fpartisipasikegiatanview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fpartisipasikegiatanview;
    loadjs.done("fpartisipasikegiatanview");
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
<form name="fpartisipasikegiatanview" id="fpartisipasikegiatanview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="partisipasikegiatan">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->idAnggota->Visible) { // idAnggota ?>
    <tr id="r_idAnggota"<?= $Page->idAnggota->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_partisipasikegiatan_idAnggota"><?= $Page->idAnggota->caption() ?></span></td>
        <td data-name="idAnggota"<?= $Page->idAnggota->cellAttributes() ?>>
<span id="el_partisipasikegiatan_idAnggota">
<span<?= $Page->idAnggota->viewAttributes() ?>>
<?= $Page->idAnggota->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->idKegiatan->Visible) { // idKegiatan ?>
    <tr id="r_idKegiatan"<?= $Page->idKegiatan->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_partisipasikegiatan_idKegiatan"><?= $Page->idKegiatan->caption() ?></span></td>
        <td data-name="idKegiatan"<?= $Page->idKegiatan->cellAttributes() ?>>
<span id="el_partisipasikegiatan_idKegiatan">
<span<?= $Page->idKegiatan->viewAttributes() ?>>
<?= $Page->idKegiatan->getViewValue() ?></span>
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
