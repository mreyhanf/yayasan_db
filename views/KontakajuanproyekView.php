<?php

namespace PHPMaker2022\project1;

// Page object
$KontakajuanproyekView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { kontakajuanproyek: currentTable } });
var currentForm, currentPageID;
var fkontakajuanproyekview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fkontakajuanproyekview = new ew.Form("fkontakajuanproyekview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fkontakajuanproyekview;
    loadjs.done("fkontakajuanproyekview");
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
<form name="fkontakajuanproyekview" id="fkontakajuanproyekview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="kontakajuanproyek">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->kontak->Visible) { // kontak ?>
    <tr id="r_kontak"<?= $Page->kontak->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kontakajuanproyek_kontak"><?= $Page->kontak->caption() ?></span></td>
        <td data-name="kontak"<?= $Page->kontak->cellAttributes() ?>>
<span id="el_kontakajuanproyek_kontak">
<span<?= $Page->kontak->viewAttributes() ?>>
<?= $Page->kontak->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->idAjuanProyek->Visible) { // idAjuanProyek ?>
    <tr id="r_idAjuanProyek"<?= $Page->idAjuanProyek->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kontakajuanproyek_idAjuanProyek"><?= $Page->idAjuanProyek->caption() ?></span></td>
        <td data-name="idAjuanProyek"<?= $Page->idAjuanProyek->cellAttributes() ?>>
<span id="el_kontakajuanproyek_idAjuanProyek">
<span<?= $Page->idAjuanProyek->viewAttributes() ?>>
<?= $Page->idAjuanProyek->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
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
