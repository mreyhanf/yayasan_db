<?php

namespace PHPMaker2022\project1;

// Page object
$PartisipasikegiatanDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { partisipasikegiatan: currentTable } });
var currentForm, currentPageID;
var fpartisipasikegiatandelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fpartisipasikegiatandelete = new ew.Form("fpartisipasikegiatandelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fpartisipasikegiatandelete;
    loadjs.done("fpartisipasikegiatandelete");
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
<form name="fpartisipasikegiatandelete" id="fpartisipasikegiatandelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="partisipasikegiatan">
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
<?php if ($Page->idAnggota->Visible) { // idAnggota ?>
        <th class="<?= $Page->idAnggota->headerCellClass() ?>"><span id="elh_partisipasikegiatan_idAnggota" class="partisipasikegiatan_idAnggota"><?= $Page->idAnggota->caption() ?></span></th>
<?php } ?>
<?php if ($Page->idKegiatan->Visible) { // idKegiatan ?>
        <th class="<?= $Page->idKegiatan->headerCellClass() ?>"><span id="elh_partisipasikegiatan_idKegiatan" class="partisipasikegiatan_idKegiatan"><?= $Page->idKegiatan->caption() ?></span></th>
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
<?php if ($Page->idAnggota->Visible) { // idAnggota ?>
        <td<?= $Page->idAnggota->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_partisipasikegiatan_idAnggota" class="el_partisipasikegiatan_idAnggota">
<span<?= $Page->idAnggota->viewAttributes() ?>>
<?= $Page->idAnggota->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->idKegiatan->Visible) { // idKegiatan ?>
        <td<?= $Page->idKegiatan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_partisipasikegiatan_idKegiatan" class="el_partisipasikegiatan_idKegiatan">
<span<?= $Page->idKegiatan->viewAttributes() ?>>
<?= $Page->idKegiatan->getViewValue() ?></span>
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
