<?php

namespace PHPMaker2022\project1;

// Page object
$KegiatanView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { kegiatan: currentTable } });
var currentForm, currentPageID;
var fkegiatanview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fkegiatanview = new ew.Form("fkegiatanview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fkegiatanview;
    loadjs.done("fkegiatanview");
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
<form name="fkegiatanview" id="fkegiatanview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="kegiatan">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->idKegiatan->Visible) { // idKegiatan ?>
    <tr id="r_idKegiatan"<?= $Page->idKegiatan->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kegiatan_idKegiatan"><?= $Page->idKegiatan->caption() ?></span></td>
        <td data-name="idKegiatan"<?= $Page->idKegiatan->cellAttributes() ?>>
<span id="el_kegiatan_idKegiatan">
<span<?= $Page->idKegiatan->viewAttributes() ?>>
<?= $Page->idKegiatan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nama->Visible) { // nama ?>
    <tr id="r_nama"<?= $Page->nama->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kegiatan_nama"><?= $Page->nama->caption() ?></span></td>
        <td data-name="nama"<?= $Page->nama->cellAttributes() ?>>
<span id="el_kegiatan_nama">
<span<?= $Page->nama->viewAttributes() ?>>
<?= $Page->nama->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->deskripsi->Visible) { // deskripsi ?>
    <tr id="r_deskripsi"<?= $Page->deskripsi->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kegiatan_deskripsi"><?= $Page->deskripsi->caption() ?></span></td>
        <td data-name="deskripsi"<?= $Page->deskripsi->cellAttributes() ?>>
<span id="el_kegiatan_deskripsi">
<span<?= $Page->deskripsi->viewAttributes() ?>>
<?= $Page->deskripsi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->penanggungJawab->Visible) { // penanggungJawab ?>
    <tr id="r_penanggungJawab"<?= $Page->penanggungJawab->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kegiatan_penanggungJawab"><?= $Page->penanggungJawab->caption() ?></span></td>
        <td data-name="penanggungJawab"<?= $Page->penanggungJawab->cellAttributes() ?>>
<span id="el_kegiatan_penanggungJawab">
<span<?= $Page->penanggungJawab->viewAttributes() ?>>
<?= $Page->penanggungJawab->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tanggalMulai->Visible) { // tanggalMulai ?>
    <tr id="r_tanggalMulai"<?= $Page->tanggalMulai->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kegiatan_tanggalMulai"><?= $Page->tanggalMulai->caption() ?></span></td>
        <td data-name="tanggalMulai"<?= $Page->tanggalMulai->cellAttributes() ?>>
<span id="el_kegiatan_tanggalMulai">
<span<?= $Page->tanggalMulai->viewAttributes() ?>>
<?= $Page->tanggalMulai->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tanggalSelesai->Visible) { // tanggalSelesai ?>
    <tr id="r_tanggalSelesai"<?= $Page->tanggalSelesai->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kegiatan_tanggalSelesai"><?= $Page->tanggalSelesai->caption() ?></span></td>
        <td data-name="tanggalSelesai"<?= $Page->tanggalSelesai->cellAttributes() ?>>
<span id="el_kegiatan_tanggalSelesai">
<span<?= $Page->tanggalSelesai->viewAttributes() ?>>
<?= $Page->tanggalSelesai->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <tr id="r_status"<?= $Page->status->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kegiatan_status"><?= $Page->status->caption() ?></span></td>
        <td data-name="status"<?= $Page->status->cellAttributes() ?>>
<span id="el_kegiatan_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
<?php
    if (in_array("partisipasikegiatan", explode(",", $Page->getCurrentDetailTable())) && $partisipasikegiatan->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("partisipasikegiatan", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "PartisipasikegiatanGrid.php" ?>
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
