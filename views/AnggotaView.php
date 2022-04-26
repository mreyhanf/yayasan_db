<?php

namespace PHPMaker2022\project1;

// Page object
$AnggotaView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { anggota: currentTable } });
var currentForm, currentPageID;
var fanggotaview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fanggotaview = new ew.Form("fanggotaview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fanggotaview;
    loadjs.done("fanggotaview");
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
<form name="fanggotaview" id="fanggotaview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="anggota">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->idAnggota->Visible) { // idAnggota ?>
    <tr id="r_idAnggota"<?= $Page->idAnggota->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_anggota_idAnggota"><?= $Page->idAnggota->caption() ?></span></td>
        <td data-name="idAnggota"<?= $Page->idAnggota->cellAttributes() ?>>
<span id="el_anggota_idAnggota">
<span<?= $Page->idAnggota->viewAttributes() ?>>
<?= $Page->idAnggota->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nama->Visible) { // nama ?>
    <tr id="r_nama"<?= $Page->nama->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_anggota_nama"><?= $Page->nama->caption() ?></span></td>
        <td data-name="nama"<?= $Page->nama->cellAttributes() ?>>
<span id="el_anggota_nama">
<span<?= $Page->nama->viewAttributes() ?>>
<?= $Page->nama->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->idJabatan->Visible) { // idJabatan ?>
    <tr id="r_idJabatan"<?= $Page->idJabatan->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_anggota_idJabatan"><?= $Page->idJabatan->caption() ?></span></td>
        <td data-name="idJabatan"<?= $Page->idJabatan->cellAttributes() ?>>
<span id="el_anggota_idJabatan">
<span<?= $Page->idJabatan->viewAttributes() ?>>
<?= $Page->idJabatan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->alamat->Visible) { // alamat ?>
    <tr id="r_alamat"<?= $Page->alamat->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_anggota_alamat"><?= $Page->alamat->caption() ?></span></td>
        <td data-name="alamat"<?= $Page->alamat->cellAttributes() ?>>
<span id="el_anggota_alamat">
<span<?= $Page->alamat->viewAttributes() ?>>
<?= $Page->alamat->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kesibukan->Visible) { // kesibukan ?>
    <tr id="r_kesibukan"<?= $Page->kesibukan->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_anggota_kesibukan"><?= $Page->kesibukan->caption() ?></span></td>
        <td data-name="kesibukan"<?= $Page->kesibukan->cellAttributes() ?>>
<span id="el_anggota_kesibukan">
<span<?= $Page->kesibukan->viewAttributes() ?>>
<?= $Page->kesibukan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
<?php
    if (in_array("kontakanggota", explode(",", $Page->getCurrentDetailTable())) && $kontakanggota->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("kontakanggota", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "KontakanggotaGrid.php" ?>
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
