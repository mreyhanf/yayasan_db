<?php

namespace PHPMaker2022\project1;

// Page object
$DonasiDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { donasi: currentTable } });
var currentForm, currentPageID;
var fdonasidelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fdonasidelete = new ew.Form("fdonasidelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fdonasidelete;
    loadjs.done("fdonasidelete");
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
<form name="fdonasidelete" id="fdonasidelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="donasi">
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
<?php if ($Page->idDonasi->Visible) { // idDonasi ?>
        <th class="<?= $Page->idDonasi->headerCellClass() ?>"><span id="elh_donasi_idDonasi" class="donasi_idDonasi"><?= $Page->idDonasi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->idDonatur->Visible) { // idDonatur ?>
        <th class="<?= $Page->idDonatur->headerCellClass() ?>"><span id="elh_donasi_idDonatur" class="donasi_idDonatur"><?= $Page->idDonatur->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nominal->Visible) { // nominal ?>
        <th class="<?= $Page->nominal->headerCellClass() ?>"><span id="elh_donasi_nominal" class="donasi_nominal"><?= $Page->nominal->caption() ?></span></th>
<?php } ?>
<?php if ($Page->idProyek->Visible) { // idProyek ?>
        <th class="<?= $Page->idProyek->headerCellClass() ?>"><span id="elh_donasi_idProyek" class="donasi_idProyek"><?= $Page->idProyek->caption() ?></span></th>
<?php } ?>
<?php if ($Page->waktu->Visible) { // waktu ?>
        <th class="<?= $Page->waktu->headerCellClass() ?>"><span id="elh_donasi_waktu" class="donasi_waktu"><?= $Page->waktu->caption() ?></span></th>
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
<?php if ($Page->idDonasi->Visible) { // idDonasi ?>
        <td<?= $Page->idDonasi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_donasi_idDonasi" class="el_donasi_idDonasi">
<span<?= $Page->idDonasi->viewAttributes() ?>>
<?= $Page->idDonasi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->idDonatur->Visible) { // idDonatur ?>
        <td<?= $Page->idDonatur->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_donasi_idDonatur" class="el_donasi_idDonatur">
<span<?= $Page->idDonatur->viewAttributes() ?>>
<?= $Page->idDonatur->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nominal->Visible) { // nominal ?>
        <td<?= $Page->nominal->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_donasi_nominal" class="el_donasi_nominal">
<span<?= $Page->nominal->viewAttributes() ?>>
<?= $Page->nominal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->idProyek->Visible) { // idProyek ?>
        <td<?= $Page->idProyek->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_donasi_idProyek" class="el_donasi_idProyek">
<span<?= $Page->idProyek->viewAttributes() ?>>
<?= $Page->idProyek->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->waktu->Visible) { // waktu ?>
        <td<?= $Page->waktu->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_donasi_waktu" class="el_donasi_waktu">
<span<?= $Page->waktu->viewAttributes() ?>>
<?= $Page->waktu->getViewValue() ?></span>
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
