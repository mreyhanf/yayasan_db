<?php

namespace PHPMaker2022\project1;

// Page object
$AjuanproyekView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { ajuanproyek: currentTable } });
var currentForm, currentPageID;
var fajuanproyekview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fajuanproyekview = new ew.Form("fajuanproyekview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fajuanproyekview;
    loadjs.done("fajuanproyekview");
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
<form name="fajuanproyekview" id="fajuanproyekview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="ajuanproyek">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->idAjuanProyek->Visible) { // idAjuanProyek ?>
    <tr id="r_idAjuanProyek"<?= $Page->idAjuanProyek->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ajuanproyek_idAjuanProyek"><?= $Page->idAjuanProyek->caption() ?></span></td>
        <td data-name="idAjuanProyek"<?= $Page->idAjuanProyek->cellAttributes() ?>>
<span id="el_ajuanproyek_idAjuanProyek">
<span<?= $Page->idAjuanProyek->viewAttributes() ?>>
<?= $Page->idAjuanProyek->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nama->Visible) { // nama ?>
    <tr id="r_nama"<?= $Page->nama->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ajuanproyek_nama"><?= $Page->nama->caption() ?></span></td>
        <td data-name="nama"<?= $Page->nama->cellAttributes() ?>>
<span id="el_ajuanproyek_nama">
<span<?= $Page->nama->viewAttributes() ?>>
<?= $Page->nama->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pengaju->Visible) { // pengaju ?>
    <tr id="r_pengaju"<?= $Page->pengaju->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ajuanproyek_pengaju"><?= $Page->pengaju->caption() ?></span></td>
        <td data-name="pengaju"<?= $Page->pengaju->cellAttributes() ?>>
<span id="el_ajuanproyek_pengaju">
<span<?= $Page->pengaju->viewAttributes() ?>>
<?= $Page->pengaju->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->biaya->Visible) { // biaya ?>
    <tr id="r_biaya"<?= $Page->biaya->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ajuanproyek_biaya"><?= $Page->biaya->caption() ?></span></td>
        <td data-name="biaya"<?= $Page->biaya->cellAttributes() ?>>
<span id="el_ajuanproyek_biaya">
<span<?= $Page->biaya->viewAttributes() ?>>
<?= $Page->biaya->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tanggalPengajuan->Visible) { // tanggalPengajuan ?>
    <tr id="r_tanggalPengajuan"<?= $Page->tanggalPengajuan->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ajuanproyek_tanggalPengajuan"><?= $Page->tanggalPengajuan->caption() ?></span></td>
        <td data-name="tanggalPengajuan"<?= $Page->tanggalPengajuan->cellAttributes() ?>>
<span id="el_ajuanproyek_tanggalPengajuan">
<span<?= $Page->tanggalPengajuan->viewAttributes() ?>>
<?= $Page->tanggalPengajuan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->keputusan->Visible) { // keputusan ?>
    <tr id="r_keputusan"<?= $Page->keputusan->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ajuanproyek_keputusan"><?= $Page->keputusan->caption() ?></span></td>
        <td data-name="keputusan"<?= $Page->keputusan->cellAttributes() ?>>
<span id="el_ajuanproyek_keputusan">
<span<?= $Page->keputusan->viewAttributes() ?>>
<?= $Page->keputusan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
<?php
    if (in_array("kontakajuanproyek", explode(",", $Page->getCurrentDetailTable())) && $kontakajuanproyek->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("kontakajuanproyek", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "KontakajuanproyekGrid.php" ?>
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
