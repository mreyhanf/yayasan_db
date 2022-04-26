<?php

namespace PHPMaker2022\project1;

// Page object
$KontakdonaturDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { kontakdonatur: currentTable } });
var currentForm, currentPageID;
var fkontakdonaturdelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fkontakdonaturdelete = new ew.Form("fkontakdonaturdelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fkontakdonaturdelete;
    loadjs.done("fkontakdonaturdelete");
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
<form name="fkontakdonaturdelete" id="fkontakdonaturdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="kontakdonatur">
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
<?php if ($Page->kontak->Visible) { // kontak ?>
        <th class="<?= $Page->kontak->headerCellClass() ?>"><span id="elh_kontakdonatur_kontak" class="kontakdonatur_kontak"><?= $Page->kontak->caption() ?></span></th>
<?php } ?>
<?php if ($Page->idDonatur->Visible) { // idDonatur ?>
        <th class="<?= $Page->idDonatur->headerCellClass() ?>"><span id="elh_kontakdonatur_idDonatur" class="kontakdonatur_idDonatur"><?= $Page->idDonatur->caption() ?></span></th>
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
<?php if ($Page->kontak->Visible) { // kontak ?>
        <td<?= $Page->kontak->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kontakdonatur_kontak" class="el_kontakdonatur_kontak">
<span<?= $Page->kontak->viewAttributes() ?>>
<?= $Page->kontak->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->idDonatur->Visible) { // idDonatur ?>
        <td<?= $Page->idDonatur->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kontakdonatur_idDonatur" class="el_kontakdonatur_idDonatur">
<span<?= $Page->idDonatur->viewAttributes() ?>>
<?= $Page->idDonatur->getViewValue() ?></span>
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
