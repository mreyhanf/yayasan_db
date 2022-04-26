<?php

namespace PHPMaker2022\project1;

// Page object
$PartisipasiproyekDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { partisipasiproyek: currentTable } });
var currentForm, currentPageID;
var fpartisipasiproyekdelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fpartisipasiproyekdelete = new ew.Form("fpartisipasiproyekdelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fpartisipasiproyekdelete;
    loadjs.done("fpartisipasiproyekdelete");
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
<form name="fpartisipasiproyekdelete" id="fpartisipasiproyekdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="partisipasiproyek">
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
        <th class="<?= $Page->idAnggota->headerCellClass() ?>"><span id="elh_partisipasiproyek_idAnggota" class="partisipasiproyek_idAnggota"><?= $Page->idAnggota->caption() ?></span></th>
<?php } ?>
<?php if ($Page->idProyek->Visible) { // idProyek ?>
        <th class="<?= $Page->idProyek->headerCellClass() ?>"><span id="elh_partisipasiproyek_idProyek" class="partisipasiproyek_idProyek"><?= $Page->idProyek->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_partisipasiproyek_idAnggota" class="el_partisipasiproyek_idAnggota">
<span<?= $Page->idAnggota->viewAttributes() ?>>
<?= $Page->idAnggota->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->idProyek->Visible) { // idProyek ?>
        <td<?= $Page->idProyek->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_partisipasiproyek_idProyek" class="el_partisipasiproyek_idProyek">
<span<?= $Page->idProyek->viewAttributes() ?>>
<?= $Page->idProyek->getViewValue() ?></span>
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
