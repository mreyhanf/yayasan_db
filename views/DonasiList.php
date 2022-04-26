<?php

namespace PHPMaker2022\project1;

// Page object
$DonasiList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { donasi: currentTable } });
var currentForm, currentPageID;
var fdonasilist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fdonasilist = new ew.Form("fdonasilist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fdonasilist;
    fdonasilist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";
    loadjs.done("fdonasilist");
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
<?php if ($Page->TotalRecords > 0 && $Page->ExportOptions->visible()) { ?>
<?php $Page->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->ImportOptions->visible()) { ?>
<?php $Page->ImportOptions->render("body") ?>
<?php } ?>
</div>
<?php } ?>
<?php if (!$Page->isExport() || Config("EXPORT_MASTER_RECORD") && $Page->isExport("print")) { ?>
<?php
if ($Page->DbMasterFilter != "" && $Page->getCurrentMasterTable() == "donatur") {
    if ($Page->MasterRecordExists) {
        include_once "views/DonaturMaster.php";
    }
}
?>
<?php } ?>
<?php
$Page->renderOtherOptions();
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> donasi">
<form name="fdonasilist" id="fdonasilist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="donasi">
<?php if ($Page->getCurrentMasterTable() == "donatur" && $Page->CurrentAction) { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="donatur">
<input type="hidden" name="fk_idDonatur" value="<?= HtmlEncode($Page->idDonatur->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_donasi" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_donasilist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Page->RowType = ROWTYPE_HEADER;

// Render list options
$Page->renderListOptions();

// Render list options (header, left)
$Page->ListOptions->render("header", "left");
?>
<?php if ($Page->idDonasi->Visible) { // idDonasi ?>
        <th data-name="idDonasi" class="<?= $Page->idDonasi->headerCellClass() ?>"><div id="elh_donasi_idDonasi" class="donasi_idDonasi"><?= $Page->renderFieldHeader($Page->idDonasi) ?></div></th>
<?php } ?>
<?php if ($Page->idDonatur->Visible) { // idDonatur ?>
        <th data-name="idDonatur" class="<?= $Page->idDonatur->headerCellClass() ?>"><div id="elh_donasi_idDonatur" class="donasi_idDonatur"><?= $Page->renderFieldHeader($Page->idDonatur) ?></div></th>
<?php } ?>
<?php if ($Page->nominal->Visible) { // nominal ?>
        <th data-name="nominal" class="<?= $Page->nominal->headerCellClass() ?>"><div id="elh_donasi_nominal" class="donasi_nominal"><?= $Page->renderFieldHeader($Page->nominal) ?></div></th>
<?php } ?>
<?php if ($Page->idProyek->Visible) { // idProyek ?>
        <th data-name="idProyek" class="<?= $Page->idProyek->headerCellClass() ?>"><div id="elh_donasi_idProyek" class="donasi_idProyek"><?= $Page->renderFieldHeader($Page->idProyek) ?></div></th>
<?php } ?>
<?php if ($Page->waktu->Visible) { // waktu ?>
        <th data-name="waktu" class="<?= $Page->waktu->headerCellClass() ?>"><div id="elh_donasi_waktu" class="donasi_waktu"><?= $Page->renderFieldHeader($Page->waktu) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Page->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody>
<?php
if ($Page->ExportAll && $Page->isExport()) {
    $Page->StopRecord = $Page->TotalRecords;
} else {
    // Set the last record to display
    if ($Page->TotalRecords > $Page->StartRecord + $Page->DisplayRecords - 1) {
        $Page->StopRecord = $Page->StartRecord + $Page->DisplayRecords - 1;
    } else {
        $Page->StopRecord = $Page->TotalRecords;
    }
}
$Page->RecordCount = $Page->StartRecord - 1;
if ($Page->Recordset && !$Page->Recordset->EOF) {
    // Nothing to do
} elseif ($Page->isGridAdd() && !$Page->AllowAddDeleteRow && $Page->StopRecord == 0) {
    $Page->StopRecord = $Page->GridAddRowCount;
}

// Initialize aggregate
$Page->RowType = ROWTYPE_AGGREGATEINIT;
$Page->resetAttributes();
$Page->renderRow();
while ($Page->RecordCount < $Page->StopRecord) {
    $Page->RecordCount++;
    if ($Page->RecordCount >= $Page->StartRecord) {
        $Page->RowCount++;

        // Set up key count
        $Page->KeyCount = $Page->RowIndex;

        // Init row class and style
        $Page->resetAttributes();
        $Page->CssClass = "";
        if ($Page->isGridAdd()) {
            $Page->loadRowValues(); // Load default values
            $Page->OldKey = "";
            $Page->setKey($Page->OldKey);
        } else {
            $Page->loadRowValues($Page->Recordset); // Load row values
            if ($Page->isGridEdit()) {
                $Page->OldKey = $Page->getKey(true); // Get from CurrentValue
                $Page->setKey($Page->OldKey);
            }
        }
        $Page->RowType = ROWTYPE_VIEW; // Render view

        // Set up row attributes
        $Page->RowAttrs->merge([
            "data-rowindex" => $Page->RowCount,
            "id" => "r" . $Page->RowCount . "_donasi",
            "data-rowtype" => $Page->RowType,
            "class" => ($Page->RowCount % 2 != 1) ? "ew-table-alt-row" : "",
        ]);
        if ($Page->isAdd() && $Page->RowType == ROWTYPE_ADD || $Page->isEdit() && $Page->RowType == ROWTYPE_EDIT) { // Inline-Add/Edit row
            $Page->RowAttrs->appendClass("table-active");
        }

        // Render row
        $Page->renderRow();

        // Render list options
        $Page->renderListOptions();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Page->ListOptions->render("body", "left", $Page->RowCount);
?>
    <?php if ($Page->idDonasi->Visible) { // idDonasi ?>
        <td data-name="idDonasi"<?= $Page->idDonasi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_donasi_idDonasi" class="el_donasi_idDonasi">
<span<?= $Page->idDonasi->viewAttributes() ?>>
<?= $Page->idDonasi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->idDonatur->Visible) { // idDonatur ?>
        <td data-name="idDonatur"<?= $Page->idDonatur->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_donasi_idDonatur" class="el_donasi_idDonatur">
<span<?= $Page->idDonatur->viewAttributes() ?>>
<?= $Page->idDonatur->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->nominal->Visible) { // nominal ?>
        <td data-name="nominal"<?= $Page->nominal->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_donasi_nominal" class="el_donasi_nominal">
<span<?= $Page->nominal->viewAttributes() ?>>
<?= $Page->nominal->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->idProyek->Visible) { // idProyek ?>
        <td data-name="idProyek"<?= $Page->idProyek->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_donasi_idProyek" class="el_donasi_idProyek">
<span<?= $Page->idProyek->viewAttributes() ?>>
<?= $Page->idProyek->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->waktu->Visible) { // waktu ?>
        <td data-name="waktu"<?= $Page->waktu->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_donasi_waktu" class="el_donasi_waktu">
<span<?= $Page->waktu->viewAttributes() ?>>
<?= $Page->waktu->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowCount);
?>
    </tr>
<?php
    }
    if (!$Page->isGridAdd()) {
        $Page->Recordset->moveNext();
    }
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$Page->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php
// Close recordset
if ($Page->Recordset) {
    $Page->Recordset->close();
}
?>
<?php if (!$Page->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$Page->isGridAdd()) { ?>
<form name="ew-pager-form" class="ew-form ew-pager-form" action="<?= CurrentPageUrl(false) ?>">
<?= $Page->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body", "bottom") ?>
</div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } else { ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
<?php } ?>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("donasi");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
