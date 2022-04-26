<?php

namespace PHPMaker2022\project1;

// Page object
$ProyekList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { proyek: currentTable } });
var currentForm, currentPageID;
var fproyeklist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fproyeklist = new ew.Form("fproyeklist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fproyeklist;
    fproyeklist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";
    loadjs.done("fproyeklist");
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
<?php
$Page->renderOtherOptions();
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> proyek">
<form name="fproyeklist" id="fproyeklist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="proyek">
<div id="gmp_proyek" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_proyeklist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
<?php if ($Page->idProyek->Visible) { // idProyek ?>
        <th data-name="idProyek" class="<?= $Page->idProyek->headerCellClass() ?>"><div id="elh_proyek_idProyek" class="proyek_idProyek"><?= $Page->renderFieldHeader($Page->idProyek) ?></div></th>
<?php } ?>
<?php if ($Page->ajuan->Visible) { // ajuan ?>
        <th data-name="ajuan" class="<?= $Page->ajuan->headerCellClass() ?>"><div id="elh_proyek_ajuan" class="proyek_ajuan"><?= $Page->renderFieldHeader($Page->ajuan) ?></div></th>
<?php } ?>
<?php if ($Page->biayaTerkumpul->Visible) { // biayaTerkumpul ?>
        <th data-name="biayaTerkumpul" class="<?= $Page->biayaTerkumpul->headerCellClass() ?>"><div id="elh_proyek_biayaTerkumpul" class="proyek_biayaTerkumpul"><?= $Page->renderFieldHeader($Page->biayaTerkumpul) ?></div></th>
<?php } ?>
<?php if ($Page->tanggalMulai->Visible) { // tanggalMulai ?>
        <th data-name="tanggalMulai" class="<?= $Page->tanggalMulai->headerCellClass() ?>"><div id="elh_proyek_tanggalMulai" class="proyek_tanggalMulai"><?= $Page->renderFieldHeader($Page->tanggalMulai) ?></div></th>
<?php } ?>
<?php if ($Page->tanggalSelesai->Visible) { // tanggalSelesai ?>
        <th data-name="tanggalSelesai" class="<?= $Page->tanggalSelesai->headerCellClass() ?>"><div id="elh_proyek_tanggalSelesai" class="proyek_tanggalSelesai"><?= $Page->renderFieldHeader($Page->tanggalSelesai) ?></div></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th data-name="status" class="<?= $Page->status->headerCellClass() ?>"><div id="elh_proyek_status" class="proyek_status"><?= $Page->renderFieldHeader($Page->status) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_proyek",
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
    <?php if ($Page->idProyek->Visible) { // idProyek ?>
        <td data-name="idProyek"<?= $Page->idProyek->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_proyek_idProyek" class="el_proyek_idProyek">
<span<?= $Page->idProyek->viewAttributes() ?>>
<?= $Page->idProyek->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ajuan->Visible) { // ajuan ?>
        <td data-name="ajuan"<?= $Page->ajuan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_proyek_ajuan" class="el_proyek_ajuan">
<span<?= $Page->ajuan->viewAttributes() ?>>
<?= $Page->ajuan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->biayaTerkumpul->Visible) { // biayaTerkumpul ?>
        <td data-name="biayaTerkumpul"<?= $Page->biayaTerkumpul->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_proyek_biayaTerkumpul" class="el_proyek_biayaTerkumpul">
<span<?= $Page->biayaTerkumpul->viewAttributes() ?>>
<?= $Page->biayaTerkumpul->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tanggalMulai->Visible) { // tanggalMulai ?>
        <td data-name="tanggalMulai"<?= $Page->tanggalMulai->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_proyek_tanggalMulai" class="el_proyek_tanggalMulai">
<span<?= $Page->tanggalMulai->viewAttributes() ?>>
<?= $Page->tanggalMulai->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tanggalSelesai->Visible) { // tanggalSelesai ?>
        <td data-name="tanggalSelesai"<?= $Page->tanggalSelesai->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_proyek_tanggalSelesai" class="el_proyek_tanggalSelesai">
<span<?= $Page->tanggalSelesai->viewAttributes() ?>>
<?= $Page->tanggalSelesai->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->status->Visible) { // status ?>
        <td data-name="status"<?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_proyek_status" class="el_proyek_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
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
    ew.addEventHandlers("proyek");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
