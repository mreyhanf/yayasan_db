<?php

namespace PHPMaker2022\project1;

// Page object
$ProyekDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { proyek: currentTable } });
var currentForm, currentPageID;
var fproyekdelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fproyekdelete = new ew.Form("fproyekdelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fproyekdelete;
    loadjs.done("fproyekdelete");
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
<form name="fproyekdelete" id="fproyekdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="proyek">
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
<?php if ($Page->idProyek->Visible) { // idProyek ?>
        <th class="<?= $Page->idProyek->headerCellClass() ?>"><span id="elh_proyek_idProyek" class="proyek_idProyek"><?= $Page->idProyek->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ajuan->Visible) { // ajuan ?>
        <th class="<?= $Page->ajuan->headerCellClass() ?>"><span id="elh_proyek_ajuan" class="proyek_ajuan"><?= $Page->ajuan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->biayaTerkumpul->Visible) { // biayaTerkumpul ?>
        <th class="<?= $Page->biayaTerkumpul->headerCellClass() ?>"><span id="elh_proyek_biayaTerkumpul" class="proyek_biayaTerkumpul"><?= $Page->biayaTerkumpul->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tanggalMulai->Visible) { // tanggalMulai ?>
        <th class="<?= $Page->tanggalMulai->headerCellClass() ?>"><span id="elh_proyek_tanggalMulai" class="proyek_tanggalMulai"><?= $Page->tanggalMulai->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tanggalSelesai->Visible) { // tanggalSelesai ?>
        <th class="<?= $Page->tanggalSelesai->headerCellClass() ?>"><span id="elh_proyek_tanggalSelesai" class="proyek_tanggalSelesai"><?= $Page->tanggalSelesai->caption() ?></span></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th class="<?= $Page->status->headerCellClass() ?>"><span id="elh_proyek_status" class="proyek_status"><?= $Page->status->caption() ?></span></th>
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
<?php if ($Page->idProyek->Visible) { // idProyek ?>
        <td<?= $Page->idProyek->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_proyek_idProyek" class="el_proyek_idProyek">
<span<?= $Page->idProyek->viewAttributes() ?>>
<?= $Page->idProyek->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ajuan->Visible) { // ajuan ?>
        <td<?= $Page->ajuan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_proyek_ajuan" class="el_proyek_ajuan">
<span<?= $Page->ajuan->viewAttributes() ?>>
<?= $Page->ajuan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->biayaTerkumpul->Visible) { // biayaTerkumpul ?>
        <td<?= $Page->biayaTerkumpul->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_proyek_biayaTerkumpul" class="el_proyek_biayaTerkumpul">
<span<?= $Page->biayaTerkumpul->viewAttributes() ?>>
<?= $Page->biayaTerkumpul->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tanggalMulai->Visible) { // tanggalMulai ?>
        <td<?= $Page->tanggalMulai->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_proyek_tanggalMulai" class="el_proyek_tanggalMulai">
<span<?= $Page->tanggalMulai->viewAttributes() ?>>
<?= $Page->tanggalMulai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tanggalSelesai->Visible) { // tanggalSelesai ?>
        <td<?= $Page->tanggalSelesai->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_proyek_tanggalSelesai" class="el_proyek_tanggalSelesai">
<span<?= $Page->tanggalSelesai->viewAttributes() ?>>
<?= $Page->tanggalSelesai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <td<?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_proyek_status" class="el_proyek_status">
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
