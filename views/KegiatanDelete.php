<?php

namespace PHPMaker2022\project1;

// Page object
$KegiatanDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { kegiatan: currentTable } });
var currentForm, currentPageID;
var fkegiatandelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fkegiatandelete = new ew.Form("fkegiatandelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fkegiatandelete;
    loadjs.done("fkegiatandelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fkegiatandelete" id="fkegiatandelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="kegiatan">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table table-bordered table-hover table-sm ew-table">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->idKegiatan->Visible) { // idKegiatan ?>
        <th class="<?= $Page->idKegiatan->headerCellClass() ?>"><span id="elh_kegiatan_idKegiatan" class="kegiatan_idKegiatan"><?= $Page->idKegiatan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nama->Visible) { // nama ?>
        <th class="<?= $Page->nama->headerCellClass() ?>"><span id="elh_kegiatan_nama" class="kegiatan_nama"><?= $Page->nama->caption() ?></span></th>
<?php } ?>
<?php if ($Page->deskripsi->Visible) { // deskripsi ?>
        <th class="<?= $Page->deskripsi->headerCellClass() ?>"><span id="elh_kegiatan_deskripsi" class="kegiatan_deskripsi"><?= $Page->deskripsi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->penanggungJawab->Visible) { // penanggungJawab ?>
        <th class="<?= $Page->penanggungJawab->headerCellClass() ?>"><span id="elh_kegiatan_penanggungJawab" class="kegiatan_penanggungJawab"><?= $Page->penanggungJawab->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tanggalMulai->Visible) { // tanggalMulai ?>
        <th class="<?= $Page->tanggalMulai->headerCellClass() ?>"><span id="elh_kegiatan_tanggalMulai" class="kegiatan_tanggalMulai"><?= $Page->tanggalMulai->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tanggalSelesai->Visible) { // tanggalSelesai ?>
        <th class="<?= $Page->tanggalSelesai->headerCellClass() ?>"><span id="elh_kegiatan_tanggalSelesai" class="kegiatan_tanggalSelesai"><?= $Page->tanggalSelesai->caption() ?></span></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th class="<?= $Page->status->headerCellClass() ?>"><span id="elh_kegiatan_status" class="kegiatan_status"><?= $Page->status->caption() ?></span></th>
<?php } ?>
    </tr>
    </thead>
    <tbody>
<?php
$Page->RecordCount = 0;
$i = 0;
while (!$Page->Recordset->EOF) {
    $Page->RecordCount++;
    $Page->RowCount++;

    // Set row properties
    $Page->resetAttributes();
    $Page->RowType = ROWTYPE_VIEW; // View

    // Get the field contents
    $Page->loadRowValues($Page->Recordset);

    // Render row
    $Page->renderRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php if ($Page->idKegiatan->Visible) { // idKegiatan ?>
        <td<?= $Page->idKegiatan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kegiatan_idKegiatan" class="el_kegiatan_idKegiatan">
<span<?= $Page->idKegiatan->viewAttributes() ?>>
<?= $Page->idKegiatan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nama->Visible) { // nama ?>
        <td<?= $Page->nama->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kegiatan_nama" class="el_kegiatan_nama">
<span<?= $Page->nama->viewAttributes() ?>>
<?= $Page->nama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->deskripsi->Visible) { // deskripsi ?>
        <td<?= $Page->deskripsi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kegiatan_deskripsi" class="el_kegiatan_deskripsi">
<span<?= $Page->deskripsi->viewAttributes() ?>>
<?= $Page->deskripsi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->penanggungJawab->Visible) { // penanggungJawab ?>
        <td<?= $Page->penanggungJawab->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kegiatan_penanggungJawab" class="el_kegiatan_penanggungJawab">
<span<?= $Page->penanggungJawab->viewAttributes() ?>>
<?= $Page->penanggungJawab->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tanggalMulai->Visible) { // tanggalMulai ?>
        <td<?= $Page->tanggalMulai->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kegiatan_tanggalMulai" class="el_kegiatan_tanggalMulai">
<span<?= $Page->tanggalMulai->viewAttributes() ?>>
<?= $Page->tanggalMulai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tanggalSelesai->Visible) { // tanggalSelesai ?>
        <td<?= $Page->tanggalSelesai->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kegiatan_tanggalSelesai" class="el_kegiatan_tanggalSelesai">
<span<?= $Page->tanggalSelesai->viewAttributes() ?>>
<?= $Page->tanggalSelesai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <td<?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kegiatan_status" class="el_kegiatan_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
    </tr>
<?php
    $Page->Recordset->moveNext();
}
$Page->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
