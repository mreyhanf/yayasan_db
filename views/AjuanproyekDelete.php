<?php

namespace PHPMaker2022\project1;

// Page object
$AjuanproyekDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { ajuanproyek: currentTable } });
var currentForm, currentPageID;
var fajuanproyekdelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fajuanproyekdelete = new ew.Form("fajuanproyekdelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fajuanproyekdelete;
    loadjs.done("fajuanproyekdelete");
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
<form name="fajuanproyekdelete" id="fajuanproyekdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="ajuanproyek">
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
<?php if ($Page->idAjuanProyek->Visible) { // idAjuanProyek ?>
        <th class="<?= $Page->idAjuanProyek->headerCellClass() ?>"><span id="elh_ajuanproyek_idAjuanProyek" class="ajuanproyek_idAjuanProyek"><?= $Page->idAjuanProyek->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nama->Visible) { // nama ?>
        <th class="<?= $Page->nama->headerCellClass() ?>"><span id="elh_ajuanproyek_nama" class="ajuanproyek_nama"><?= $Page->nama->caption() ?></span></th>
<?php } ?>
<?php if ($Page->pengaju->Visible) { // pengaju ?>
        <th class="<?= $Page->pengaju->headerCellClass() ?>"><span id="elh_ajuanproyek_pengaju" class="ajuanproyek_pengaju"><?= $Page->pengaju->caption() ?></span></th>
<?php } ?>
<?php if ($Page->biaya->Visible) { // biaya ?>
        <th class="<?= $Page->biaya->headerCellClass() ?>"><span id="elh_ajuanproyek_biaya" class="ajuanproyek_biaya"><?= $Page->biaya->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tanggalPengajuan->Visible) { // tanggalPengajuan ?>
        <th class="<?= $Page->tanggalPengajuan->headerCellClass() ?>"><span id="elh_ajuanproyek_tanggalPengajuan" class="ajuanproyek_tanggalPengajuan"><?= $Page->tanggalPengajuan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->keputusan->Visible) { // keputusan ?>
        <th class="<?= $Page->keputusan->headerCellClass() ?>"><span id="elh_ajuanproyek_keputusan" class="ajuanproyek_keputusan"><?= $Page->keputusan->caption() ?></span></th>
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
<?php if ($Page->idAjuanProyek->Visible) { // idAjuanProyek ?>
        <td<?= $Page->idAjuanProyek->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ajuanproyek_idAjuanProyek" class="el_ajuanproyek_idAjuanProyek">
<span<?= $Page->idAjuanProyek->viewAttributes() ?>>
<?= $Page->idAjuanProyek->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nama->Visible) { // nama ?>
        <td<?= $Page->nama->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ajuanproyek_nama" class="el_ajuanproyek_nama">
<span<?= $Page->nama->viewAttributes() ?>>
<?= $Page->nama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->pengaju->Visible) { // pengaju ?>
        <td<?= $Page->pengaju->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ajuanproyek_pengaju" class="el_ajuanproyek_pengaju">
<span<?= $Page->pengaju->viewAttributes() ?>>
<?= $Page->pengaju->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->biaya->Visible) { // biaya ?>
        <td<?= $Page->biaya->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ajuanproyek_biaya" class="el_ajuanproyek_biaya">
<span<?= $Page->biaya->viewAttributes() ?>>
<?= $Page->biaya->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tanggalPengajuan->Visible) { // tanggalPengajuan ?>
        <td<?= $Page->tanggalPengajuan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ajuanproyek_tanggalPengajuan" class="el_ajuanproyek_tanggalPengajuan">
<span<?= $Page->tanggalPengajuan->viewAttributes() ?>>
<?= $Page->tanggalPengajuan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->keputusan->Visible) { // keputusan ?>
        <td<?= $Page->keputusan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ajuanproyek_keputusan" class="el_ajuanproyek_keputusan">
<span<?= $Page->keputusan->viewAttributes() ?>>
<?= $Page->keputusan->getViewValue() ?></span>
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
