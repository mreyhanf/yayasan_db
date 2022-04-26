<?php

namespace PHPMaker2022\project1;

// Page object
$AnggotaDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { anggota: currentTable } });
var currentForm, currentPageID;
var fanggotadelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fanggotadelete = new ew.Form("fanggotadelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fanggotadelete;
    loadjs.done("fanggotadelete");
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
<form name="fanggotadelete" id="fanggotadelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="anggota">
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
        <th class="<?= $Page->idAnggota->headerCellClass() ?>"><span id="elh_anggota_idAnggota" class="anggota_idAnggota"><?= $Page->idAnggota->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nama->Visible) { // nama ?>
        <th class="<?= $Page->nama->headerCellClass() ?>"><span id="elh_anggota_nama" class="anggota_nama"><?= $Page->nama->caption() ?></span></th>
<?php } ?>
<?php if ($Page->idJabatan->Visible) { // idJabatan ?>
        <th class="<?= $Page->idJabatan->headerCellClass() ?>"><span id="elh_anggota_idJabatan" class="anggota_idJabatan"><?= $Page->idJabatan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->alamat->Visible) { // alamat ?>
        <th class="<?= $Page->alamat->headerCellClass() ?>"><span id="elh_anggota_alamat" class="anggota_alamat"><?= $Page->alamat->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kesibukan->Visible) { // kesibukan ?>
        <th class="<?= $Page->kesibukan->headerCellClass() ?>"><span id="elh_anggota_kesibukan" class="anggota_kesibukan"><?= $Page->kesibukan->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_anggota_idAnggota" class="el_anggota_idAnggota">
<span<?= $Page->idAnggota->viewAttributes() ?>>
<?= $Page->idAnggota->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nama->Visible) { // nama ?>
        <td<?= $Page->nama->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_anggota_nama" class="el_anggota_nama">
<span<?= $Page->nama->viewAttributes() ?>>
<?= $Page->nama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->idJabatan->Visible) { // idJabatan ?>
        <td<?= $Page->idJabatan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_anggota_idJabatan" class="el_anggota_idJabatan">
<span<?= $Page->idJabatan->viewAttributes() ?>>
<?= $Page->idJabatan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->alamat->Visible) { // alamat ?>
        <td<?= $Page->alamat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_anggota_alamat" class="el_anggota_alamat">
<span<?= $Page->alamat->viewAttributes() ?>>
<?= $Page->alamat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kesibukan->Visible) { // kesibukan ?>
        <td<?= $Page->kesibukan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_anggota_kesibukan" class="el_anggota_kesibukan">
<span<?= $Page->kesibukan->viewAttributes() ?>>
<?= $Page->kesibukan->getViewValue() ?></span>
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
