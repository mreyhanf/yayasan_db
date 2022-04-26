<?php

namespace PHPMaker2022\project1;

// Page object
$ProyekView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { proyek: currentTable } });
var currentForm, currentPageID;
var fproyekview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fproyekview = new ew.Form("fproyekview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fproyekview;
    loadjs.done("fproyekview");
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
<form name="fproyekview" id="fproyekview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="proyek">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->idProyek->Visible) { // idProyek ?>
    <tr id="r_idProyek"<?= $Page->idProyek->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_proyek_idProyek"><?= $Page->idProyek->caption() ?></span></td>
        <td data-name="idProyek"<?= $Page->idProyek->cellAttributes() ?>>
<span id="el_proyek_idProyek">
<span<?= $Page->idProyek->viewAttributes() ?>>
<?= $Page->idProyek->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ajuan->Visible) { // ajuan ?>
    <tr id="r_ajuan"<?= $Page->ajuan->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_proyek_ajuan"><?= $Page->ajuan->caption() ?></span></td>
        <td data-name="ajuan"<?= $Page->ajuan->cellAttributes() ?>>
<span id="el_proyek_ajuan">
<span<?= $Page->ajuan->viewAttributes() ?>>
<?= $Page->ajuan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->biayaTerkumpul->Visible) { // biayaTerkumpul ?>
    <tr id="r_biayaTerkumpul"<?= $Page->biayaTerkumpul->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_proyek_biayaTerkumpul"><?= $Page->biayaTerkumpul->caption() ?></span></td>
        <td data-name="biayaTerkumpul"<?= $Page->biayaTerkumpul->cellAttributes() ?>>
<span id="el_proyek_biayaTerkumpul">
<span<?= $Page->biayaTerkumpul->viewAttributes() ?>>
<?= $Page->biayaTerkumpul->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tanggalMulai->Visible) { // tanggalMulai ?>
    <tr id="r_tanggalMulai"<?= $Page->tanggalMulai->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_proyek_tanggalMulai"><?= $Page->tanggalMulai->caption() ?></span></td>
        <td data-name="tanggalMulai"<?= $Page->tanggalMulai->cellAttributes() ?>>
<span id="el_proyek_tanggalMulai">
<span<?= $Page->tanggalMulai->viewAttributes() ?>>
<?= $Page->tanggalMulai->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tanggalSelesai->Visible) { // tanggalSelesai ?>
    <tr id="r_tanggalSelesai"<?= $Page->tanggalSelesai->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_proyek_tanggalSelesai"><?= $Page->tanggalSelesai->caption() ?></span></td>
        <td data-name="tanggalSelesai"<?= $Page->tanggalSelesai->cellAttributes() ?>>
<span id="el_proyek_tanggalSelesai">
<span<?= $Page->tanggalSelesai->viewAttributes() ?>>
<?= $Page->tanggalSelesai->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <tr id="r_status"<?= $Page->status->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_proyek_status"><?= $Page->status->caption() ?></span></td>
        <td data-name="status"<?= $Page->status->cellAttributes() ?>>
<span id="el_proyek_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
<?php
    if (in_array("partisipasiproyek", explode(",", $Page->getCurrentDetailTable())) && $partisipasiproyek->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("partisipasiproyek", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "PartisipasiproyekGrid.php" ?>
<?php } ?>
<?php
    if (in_array("ajuanproyek", explode(",", $Page->getCurrentDetailTable())) && $ajuanproyek->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("ajuanproyek", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "AjuanproyekGrid.php" ?>
<?php } ?>
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
