<?php

namespace PHPMaker2022\project1;

// Set up and run Grid object
$Grid = Container("KegiatanGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fkegiatangrid;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fkegiatangrid = new ew.Form("fkegiatangrid", "grid");
    fkegiatangrid.formKeyCountName = "<?= $Grid->FormKeyCountName ?>";

    // Add fields
    var currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { kegiatan: currentTable } });
    var fields = currentTable.fields;
    fkegiatangrid.addFields([
        ["idKegiatan", [fields.idKegiatan.visible && fields.idKegiatan.required ? ew.Validators.required(fields.idKegiatan.caption) : null], fields.idKegiatan.isInvalid],
        ["nama", [fields.nama.visible && fields.nama.required ? ew.Validators.required(fields.nama.caption) : null], fields.nama.isInvalid],
        ["deskripsi", [fields.deskripsi.visible && fields.deskripsi.required ? ew.Validators.required(fields.deskripsi.caption) : null], fields.deskripsi.isInvalid],
        ["penanggungJawab", [fields.penanggungJawab.visible && fields.penanggungJawab.required ? ew.Validators.required(fields.penanggungJawab.caption) : null], fields.penanggungJawab.isInvalid],
        ["tanggalMulai", [fields.tanggalMulai.visible && fields.tanggalMulai.required ? ew.Validators.required(fields.tanggalMulai.caption) : null, ew.Validators.datetime(fields.tanggalMulai.clientFormatPattern)], fields.tanggalMulai.isInvalid],
        ["tanggalSelesai", [fields.tanggalSelesai.visible && fields.tanggalSelesai.required ? ew.Validators.required(fields.tanggalSelesai.caption) : null, ew.Validators.datetime(fields.tanggalSelesai.clientFormatPattern)], fields.tanggalSelesai.isInvalid],
        ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid]
    ]);

    // Check empty row
    fkegiatangrid.emptyRow = function (rowIndex) {
        var fobj = this.getForm(),
            fields = [["nama",false],["deskripsi",false],["penanggungJawab",false],["tanggalMulai",false],["tanggalSelesai",false],["status",false]];
        if (fields.some(field => ew.valueChanged(fobj, rowIndex, ...field)))
            return false;
        return true;
    }

    // Form_CustomValidate
    fkegiatangrid.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fkegiatangrid.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fkegiatangrid.lists.penanggungJawab = <?= $Grid->penanggungJawab->toClientList($Grid) ?>;
    fkegiatangrid.lists.status = <?= $Grid->status->toClientList($Grid) ?>;
    loadjs.done("fkegiatangrid");
});
</script>
<?php } ?>
<?php
$Grid->renderOtherOptions();
?>
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> kegiatan">
<div id="fkegiatangrid" class="ew-form ew-list-form">
<div id="gmp_kegiatan" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_kegiatangrid" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Grid->RowType = ROWTYPE_HEADER;

// Render list options
$Grid->renderListOptions();

// Render list options (header, left)
$Grid->ListOptions->render("header", "left");
?>
<?php if ($Grid->idKegiatan->Visible) { // idKegiatan ?>
        <th data-name="idKegiatan" class="<?= $Grid->idKegiatan->headerCellClass() ?>"><div id="elh_kegiatan_idKegiatan" class="kegiatan_idKegiatan"><?= $Grid->renderFieldHeader($Grid->idKegiatan) ?></div></th>
<?php } ?>
<?php if ($Grid->nama->Visible) { // nama ?>
        <th data-name="nama" class="<?= $Grid->nama->headerCellClass() ?>"><div id="elh_kegiatan_nama" class="kegiatan_nama"><?= $Grid->renderFieldHeader($Grid->nama) ?></div></th>
<?php } ?>
<?php if ($Grid->deskripsi->Visible) { // deskripsi ?>
        <th data-name="deskripsi" class="<?= $Grid->deskripsi->headerCellClass() ?>"><div id="elh_kegiatan_deskripsi" class="kegiatan_deskripsi"><?= $Grid->renderFieldHeader($Grid->deskripsi) ?></div></th>
<?php } ?>
<?php if ($Grid->penanggungJawab->Visible) { // penanggungJawab ?>
        <th data-name="penanggungJawab" class="<?= $Grid->penanggungJawab->headerCellClass() ?>"><div id="elh_kegiatan_penanggungJawab" class="kegiatan_penanggungJawab"><?= $Grid->renderFieldHeader($Grid->penanggungJawab) ?></div></th>
<?php } ?>
<?php if ($Grid->tanggalMulai->Visible) { // tanggalMulai ?>
        <th data-name="tanggalMulai" class="<?= $Grid->tanggalMulai->headerCellClass() ?>"><div id="elh_kegiatan_tanggalMulai" class="kegiatan_tanggalMulai"><?= $Grid->renderFieldHeader($Grid->tanggalMulai) ?></div></th>
<?php } ?>
<?php if ($Grid->tanggalSelesai->Visible) { // tanggalSelesai ?>
        <th data-name="tanggalSelesai" class="<?= $Grid->tanggalSelesai->headerCellClass() ?>"><div id="elh_kegiatan_tanggalSelesai" class="kegiatan_tanggalSelesai"><?= $Grid->renderFieldHeader($Grid->tanggalSelesai) ?></div></th>
<?php } ?>
<?php if ($Grid->status->Visible) { // status ?>
        <th data-name="status" class="<?= $Grid->status->headerCellClass() ?>"><div id="elh_kegiatan_status" class="kegiatan_status"><?= $Grid->renderFieldHeader($Grid->status) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Grid->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody>
<?php
$Grid->StartRecord = 1;
$Grid->StopRecord = $Grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($Grid->isConfirm() || $Grid->EventCancelled)) {
    $CurrentForm->Index = -1;
    if ($CurrentForm->hasValue($Grid->FormKeyCountName) && ($Grid->isGridAdd() || $Grid->isGridEdit() || $Grid->isConfirm())) {
        $Grid->KeyCount = $CurrentForm->getValue($Grid->FormKeyCountName);
        $Grid->StopRecord = $Grid->StartRecord + $Grid->KeyCount - 1;
    }
}
$Grid->RecordCount = $Grid->StartRecord - 1;
if ($Grid->Recordset && !$Grid->Recordset->EOF) {
    // Nothing to do
} elseif ($Grid->isGridAdd() && !$Grid->AllowAddDeleteRow && $Grid->StopRecord == 0) {
    $Grid->StopRecord = $Grid->GridAddRowCount;
}

// Initialize aggregate
$Grid->RowType = ROWTYPE_AGGREGATEINIT;
$Grid->resetAttributes();
$Grid->renderRow();
while ($Grid->RecordCount < $Grid->StopRecord) {
    $Grid->RecordCount++;
    if ($Grid->RecordCount >= $Grid->StartRecord) {
        $Grid->RowCount++;
        if ($Grid->isAdd() || $Grid->isGridAdd() || $Grid->isGridEdit() || $Grid->isConfirm()) {
            $Grid->RowIndex++;
            $CurrentForm->Index = $Grid->RowIndex;
            if ($CurrentForm->hasValue($Grid->FormActionName) && ($Grid->isConfirm() || $Grid->EventCancelled)) {
                $Grid->RowAction = strval($CurrentForm->getValue($Grid->FormActionName));
            } elseif ($Grid->isGridAdd()) {
                $Grid->RowAction = "insert";
            } else {
                $Grid->RowAction = "";
            }
        }

        // Set up key count
        $Grid->KeyCount = $Grid->RowIndex;

        // Init row class and style
        $Grid->resetAttributes();
        $Grid->CssClass = "";
        if ($Grid->isGridAdd()) {
            if ($Grid->CurrentMode == "copy") {
                $Grid->loadRowValues($Grid->Recordset); // Load row values
                $Grid->OldKey = $Grid->getKey(true); // Get from CurrentValue
            } else {
                $Grid->loadRowValues(); // Load default values
                $Grid->OldKey = "";
            }
        } else {
            $Grid->loadRowValues($Grid->Recordset); // Load row values
            $Grid->OldKey = $Grid->getKey(true); // Get from CurrentValue
        }
        $Grid->setKey($Grid->OldKey);
        $Grid->RowType = ROWTYPE_VIEW; // Render view
        if ($Grid->isGridAdd()) { // Grid add
            $Grid->RowType = ROWTYPE_ADD; // Render add
        }
        if ($Grid->isGridAdd() && $Grid->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) { // Insert failed
            $Grid->restoreCurrentRowFormValues($Grid->RowIndex); // Restore form values
        }
        if ($Grid->isGridEdit()) { // Grid edit
            if ($Grid->EventCancelled) {
                $Grid->restoreCurrentRowFormValues($Grid->RowIndex); // Restore form values
            }
            if ($Grid->RowAction == "insert") {
                $Grid->RowType = ROWTYPE_ADD; // Render add
            } else {
                $Grid->RowType = ROWTYPE_EDIT; // Render edit
            }
        }
        if ($Grid->isGridEdit() && ($Grid->RowType == ROWTYPE_EDIT || $Grid->RowType == ROWTYPE_ADD) && $Grid->EventCancelled) { // Update failed
            $Grid->restoreCurrentRowFormValues($Grid->RowIndex); // Restore form values
        }
        if ($Grid->RowType == ROWTYPE_EDIT) { // Edit row
            $Grid->EditRowCount++;
        }
        if ($Grid->isConfirm()) { // Confirm row
            $Grid->restoreCurrentRowFormValues($Grid->RowIndex); // Restore form values
        }

        // Set up row attributes
        $Grid->RowAttrs->merge([
            "data-rowindex" => $Grid->RowCount,
            "id" => "r" . $Grid->RowCount . "_kegiatan",
            "data-rowtype" => $Grid->RowType,
            "class" => ($Grid->RowCount % 2 != 1) ? "ew-table-alt-row" : "",
        ]);
        if ($Grid->isAdd() && $Grid->RowType == ROWTYPE_ADD || $Grid->isEdit() && $Grid->RowType == ROWTYPE_EDIT) { // Inline-Add/Edit row
            $Grid->RowAttrs->appendClass("table-active");
        }

        // Render row
        $Grid->renderRow();

        // Render list options
        $Grid->renderListOptions();

        // Skip delete row / empty row for confirm page
        if (
            $Page->RowAction != "delete" &&
            $Page->RowAction != "insertdelete" &&
            !($Page->RowAction == "insert" && $Page->isConfirm() && $Page->emptyRow())
        ) {
?>
    <tr <?= $Grid->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Grid->ListOptions->render("body", "left", $Grid->RowCount);
?>
    <?php if ($Grid->idKegiatan->Visible) { // idKegiatan ?>
        <td data-name="idKegiatan"<?= $Grid->idKegiatan->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_kegiatan_idKegiatan" class="el_kegiatan_idKegiatan"></span>
<input type="hidden" data-table="kegiatan" data-field="x_idKegiatan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_idKegiatan" id="o<?= $Grid->RowIndex ?>_idKegiatan" value="<?= HtmlEncode($Grid->idKegiatan->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_kegiatan_idKegiatan" class="el_kegiatan_idKegiatan">
<span<?= $Grid->idKegiatan->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->idKegiatan->getDisplayValue($Grid->idKegiatan->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="kegiatan" data-field="x_idKegiatan" data-hidden="1" name="x<?= $Grid->RowIndex ?>_idKegiatan" id="x<?= $Grid->RowIndex ?>_idKegiatan" value="<?= HtmlEncode($Grid->idKegiatan->CurrentValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_kegiatan_idKegiatan" class="el_kegiatan_idKegiatan">
<span<?= $Grid->idKegiatan->viewAttributes() ?>>
<?= $Grid->idKegiatan->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="kegiatan" data-field="x_idKegiatan" data-hidden="1" name="fkegiatangrid$x<?= $Grid->RowIndex ?>_idKegiatan" id="fkegiatangrid$x<?= $Grid->RowIndex ?>_idKegiatan" value="<?= HtmlEncode($Grid->idKegiatan->FormValue) ?>">
<input type="hidden" data-table="kegiatan" data-field="x_idKegiatan" data-hidden="1" name="fkegiatangrid$o<?= $Grid->RowIndex ?>_idKegiatan" id="fkegiatangrid$o<?= $Grid->RowIndex ?>_idKegiatan" value="<?= HtmlEncode($Grid->idKegiatan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="kegiatan" data-field="x_idKegiatan" data-hidden="1" name="x<?= $Grid->RowIndex ?>_idKegiatan" id="x<?= $Grid->RowIndex ?>_idKegiatan" value="<?= HtmlEncode($Grid->idKegiatan->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Grid->nama->Visible) { // nama ?>
        <td data-name="nama"<?= $Grid->nama->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_kegiatan_nama" class="el_kegiatan_nama">
<input type="<?= $Grid->nama->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_nama" id="x<?= $Grid->RowIndex ?>_nama" data-table="kegiatan" data-field="x_nama" value="<?= $Grid->nama->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->nama->getPlaceHolder()) ?>"<?= $Grid->nama->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->nama->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="kegiatan" data-field="x_nama" data-hidden="1" name="o<?= $Grid->RowIndex ?>_nama" id="o<?= $Grid->RowIndex ?>_nama" value="<?= HtmlEncode($Grid->nama->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_kegiatan_nama" class="el_kegiatan_nama">
<input type="<?= $Grid->nama->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_nama" id="x<?= $Grid->RowIndex ?>_nama" data-table="kegiatan" data-field="x_nama" value="<?= $Grid->nama->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->nama->getPlaceHolder()) ?>"<?= $Grid->nama->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->nama->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_kegiatan_nama" class="el_kegiatan_nama">
<span<?= $Grid->nama->viewAttributes() ?>>
<?= $Grid->nama->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="kegiatan" data-field="x_nama" data-hidden="1" name="fkegiatangrid$x<?= $Grid->RowIndex ?>_nama" id="fkegiatangrid$x<?= $Grid->RowIndex ?>_nama" value="<?= HtmlEncode($Grid->nama->FormValue) ?>">
<input type="hidden" data-table="kegiatan" data-field="x_nama" data-hidden="1" name="fkegiatangrid$o<?= $Grid->RowIndex ?>_nama" id="fkegiatangrid$o<?= $Grid->RowIndex ?>_nama" value="<?= HtmlEncode($Grid->nama->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->deskripsi->Visible) { // deskripsi ?>
        <td data-name="deskripsi"<?= $Grid->deskripsi->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_kegiatan_deskripsi" class="el_kegiatan_deskripsi">
<textarea data-table="kegiatan" data-field="x_deskripsi" name="x<?= $Grid->RowIndex ?>_deskripsi" id="x<?= $Grid->RowIndex ?>_deskripsi" cols="35" rows="4" placeholder="<?= HtmlEncode($Grid->deskripsi->getPlaceHolder()) ?>"<?= $Grid->deskripsi->editAttributes() ?>><?= $Grid->deskripsi->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Grid->deskripsi->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="kegiatan" data-field="x_deskripsi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_deskripsi" id="o<?= $Grid->RowIndex ?>_deskripsi" value="<?= HtmlEncode($Grid->deskripsi->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_kegiatan_deskripsi" class="el_kegiatan_deskripsi">
<textarea data-table="kegiatan" data-field="x_deskripsi" name="x<?= $Grid->RowIndex ?>_deskripsi" id="x<?= $Grid->RowIndex ?>_deskripsi" cols="35" rows="4" placeholder="<?= HtmlEncode($Grid->deskripsi->getPlaceHolder()) ?>"<?= $Grid->deskripsi->editAttributes() ?>><?= $Grid->deskripsi->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Grid->deskripsi->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_kegiatan_deskripsi" class="el_kegiatan_deskripsi">
<span<?= $Grid->deskripsi->viewAttributes() ?>>
<?= $Grid->deskripsi->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="kegiatan" data-field="x_deskripsi" data-hidden="1" name="fkegiatangrid$x<?= $Grid->RowIndex ?>_deskripsi" id="fkegiatangrid$x<?= $Grid->RowIndex ?>_deskripsi" value="<?= HtmlEncode($Grid->deskripsi->FormValue) ?>">
<input type="hidden" data-table="kegiatan" data-field="x_deskripsi" data-hidden="1" name="fkegiatangrid$o<?= $Grid->RowIndex ?>_deskripsi" id="fkegiatangrid$o<?= $Grid->RowIndex ?>_deskripsi" value="<?= HtmlEncode($Grid->deskripsi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->penanggungJawab->Visible) { // penanggungJawab ?>
        <td data-name="penanggungJawab"<?= $Grid->penanggungJawab->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($Grid->penanggungJawab->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_kegiatan_penanggungJawab" class="el_kegiatan_penanggungJawab">
<span<?= $Grid->penanggungJawab->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->penanggungJawab->getDisplayValue($Grid->penanggungJawab->ViewValue) ?></span></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_penanggungJawab" name="x<?= $Grid->RowIndex ?>_penanggungJawab" value="<?= HtmlEncode(FormatNumber($Grid->penanggungJawab->CurrentValue, $Grid->penanggungJawab->formatPattern())) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_kegiatan_penanggungJawab" class="el_kegiatan_penanggungJawab">
    <select
        id="x<?= $Grid->RowIndex ?>_penanggungJawab"
        name="x<?= $Grid->RowIndex ?>_penanggungJawab"
        class="form-select ew-select<?= $Grid->penanggungJawab->isInvalidClass() ?>"
        data-select2-id="fkegiatangrid_x<?= $Grid->RowIndex ?>_penanggungJawab"
        data-table="kegiatan"
        data-field="x_penanggungJawab"
        data-value-separator="<?= $Grid->penanggungJawab->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->penanggungJawab->getPlaceHolder()) ?>"
        <?= $Grid->penanggungJawab->editAttributes() ?>>
        <?= $Grid->penanggungJawab->selectOptionListHtml("x{$Grid->RowIndex}_penanggungJawab") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->penanggungJawab->getErrorMessage() ?></div>
<?= $Grid->penanggungJawab->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_penanggungJawab") ?>
<script>
loadjs.ready("fkegiatangrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_penanggungJawab", selectId: "fkegiatangrid_x<?= $Grid->RowIndex ?>_penanggungJawab" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fkegiatangrid.lists.penanggungJawab.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_penanggungJawab", form: "fkegiatangrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_penanggungJawab", form: "fkegiatangrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.kegiatan.fields.penanggungJawab.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<input type="hidden" data-table="kegiatan" data-field="x_penanggungJawab" data-hidden="1" name="o<?= $Grid->RowIndex ?>_penanggungJawab" id="o<?= $Grid->RowIndex ?>_penanggungJawab" value="<?= HtmlEncode($Grid->penanggungJawab->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($Grid->penanggungJawab->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_kegiatan_penanggungJawab" class="el_kegiatan_penanggungJawab">
<span<?= $Grid->penanggungJawab->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->penanggungJawab->getDisplayValue($Grid->penanggungJawab->ViewValue) ?></span></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_penanggungJawab" name="x<?= $Grid->RowIndex ?>_penanggungJawab" value="<?= HtmlEncode(FormatNumber($Grid->penanggungJawab->CurrentValue, $Grid->penanggungJawab->formatPattern())) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_kegiatan_penanggungJawab" class="el_kegiatan_penanggungJawab">
    <select
        id="x<?= $Grid->RowIndex ?>_penanggungJawab"
        name="x<?= $Grid->RowIndex ?>_penanggungJawab"
        class="form-select ew-select<?= $Grid->penanggungJawab->isInvalidClass() ?>"
        data-select2-id="fkegiatangrid_x<?= $Grid->RowIndex ?>_penanggungJawab"
        data-table="kegiatan"
        data-field="x_penanggungJawab"
        data-value-separator="<?= $Grid->penanggungJawab->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->penanggungJawab->getPlaceHolder()) ?>"
        <?= $Grid->penanggungJawab->editAttributes() ?>>
        <?= $Grid->penanggungJawab->selectOptionListHtml("x{$Grid->RowIndex}_penanggungJawab") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->penanggungJawab->getErrorMessage() ?></div>
<?= $Grid->penanggungJawab->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_penanggungJawab") ?>
<script>
loadjs.ready("fkegiatangrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_penanggungJawab", selectId: "fkegiatangrid_x<?= $Grid->RowIndex ?>_penanggungJawab" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fkegiatangrid.lists.penanggungJawab.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_penanggungJawab", form: "fkegiatangrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_penanggungJawab", form: "fkegiatangrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.kegiatan.fields.penanggungJawab.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_kegiatan_penanggungJawab" class="el_kegiatan_penanggungJawab">
<span<?= $Grid->penanggungJawab->viewAttributes() ?>>
<?= $Grid->penanggungJawab->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="kegiatan" data-field="x_penanggungJawab" data-hidden="1" name="fkegiatangrid$x<?= $Grid->RowIndex ?>_penanggungJawab" id="fkegiatangrid$x<?= $Grid->RowIndex ?>_penanggungJawab" value="<?= HtmlEncode($Grid->penanggungJawab->FormValue) ?>">
<input type="hidden" data-table="kegiatan" data-field="x_penanggungJawab" data-hidden="1" name="fkegiatangrid$o<?= $Grid->RowIndex ?>_penanggungJawab" id="fkegiatangrid$o<?= $Grid->RowIndex ?>_penanggungJawab" value="<?= HtmlEncode($Grid->penanggungJawab->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->tanggalMulai->Visible) { // tanggalMulai ?>
        <td data-name="tanggalMulai"<?= $Grid->tanggalMulai->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_kegiatan_tanggalMulai" class="el_kegiatan_tanggalMulai">
<input type="<?= $Grid->tanggalMulai->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_tanggalMulai" id="x<?= $Grid->RowIndex ?>_tanggalMulai" data-table="kegiatan" data-field="x_tanggalMulai" value="<?= $Grid->tanggalMulai->EditValue ?>" placeholder="<?= HtmlEncode($Grid->tanggalMulai->getPlaceHolder()) ?>"<?= $Grid->tanggalMulai->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tanggalMulai->getErrorMessage() ?></div>
<?php if (!$Grid->tanggalMulai->ReadOnly && !$Grid->tanggalMulai->Disabled && !isset($Grid->tanggalMulai->EditAttrs["readonly"]) && !isset($Grid->tanggalMulai->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fkegiatangrid", "datetimepicker"], function () {
    let format = "<?= DateFormat(0) ?>",
        options = {
        localization: {
            locale: ew.LANGUAGE_ID,
            numberingSystem: ew.getNumberingSystem()
        },
        display: {
            format,
            components: {
                hours: !!format.match(/h/i),
                minutes: !!format.match(/m/),
                seconds: !!format.match(/s/i)
            },
            icons: {
                previous: ew.IS_RTL ? "fas fa-chevron-right" : "fas fa-chevron-left",
                next: ew.IS_RTL ? "fas fa-chevron-left" : "fas fa-chevron-right"
            }
        }
    };
    ew.createDateTimePicker("fkegiatangrid", "x<?= $Grid->RowIndex ?>_tanggalMulai", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="kegiatan" data-field="x_tanggalMulai" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tanggalMulai" id="o<?= $Grid->RowIndex ?>_tanggalMulai" value="<?= HtmlEncode($Grid->tanggalMulai->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_kegiatan_tanggalMulai" class="el_kegiatan_tanggalMulai">
<input type="<?= $Grid->tanggalMulai->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_tanggalMulai" id="x<?= $Grid->RowIndex ?>_tanggalMulai" data-table="kegiatan" data-field="x_tanggalMulai" value="<?= $Grid->tanggalMulai->EditValue ?>" placeholder="<?= HtmlEncode($Grid->tanggalMulai->getPlaceHolder()) ?>"<?= $Grid->tanggalMulai->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tanggalMulai->getErrorMessage() ?></div>
<?php if (!$Grid->tanggalMulai->ReadOnly && !$Grid->tanggalMulai->Disabled && !isset($Grid->tanggalMulai->EditAttrs["readonly"]) && !isset($Grid->tanggalMulai->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fkegiatangrid", "datetimepicker"], function () {
    let format = "<?= DateFormat(0) ?>",
        options = {
        localization: {
            locale: ew.LANGUAGE_ID,
            numberingSystem: ew.getNumberingSystem()
        },
        display: {
            format,
            components: {
                hours: !!format.match(/h/i),
                minutes: !!format.match(/m/),
                seconds: !!format.match(/s/i)
            },
            icons: {
                previous: ew.IS_RTL ? "fas fa-chevron-right" : "fas fa-chevron-left",
                next: ew.IS_RTL ? "fas fa-chevron-left" : "fas fa-chevron-right"
            }
        }
    };
    ew.createDateTimePicker("fkegiatangrid", "x<?= $Grid->RowIndex ?>_tanggalMulai", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_kegiatan_tanggalMulai" class="el_kegiatan_tanggalMulai">
<span<?= $Grid->tanggalMulai->viewAttributes() ?>>
<?= $Grid->tanggalMulai->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="kegiatan" data-field="x_tanggalMulai" data-hidden="1" name="fkegiatangrid$x<?= $Grid->RowIndex ?>_tanggalMulai" id="fkegiatangrid$x<?= $Grid->RowIndex ?>_tanggalMulai" value="<?= HtmlEncode($Grid->tanggalMulai->FormValue) ?>">
<input type="hidden" data-table="kegiatan" data-field="x_tanggalMulai" data-hidden="1" name="fkegiatangrid$o<?= $Grid->RowIndex ?>_tanggalMulai" id="fkegiatangrid$o<?= $Grid->RowIndex ?>_tanggalMulai" value="<?= HtmlEncode($Grid->tanggalMulai->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->tanggalSelesai->Visible) { // tanggalSelesai ?>
        <td data-name="tanggalSelesai"<?= $Grid->tanggalSelesai->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_kegiatan_tanggalSelesai" class="el_kegiatan_tanggalSelesai">
<input type="<?= $Grid->tanggalSelesai->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_tanggalSelesai" id="x<?= $Grid->RowIndex ?>_tanggalSelesai" data-table="kegiatan" data-field="x_tanggalSelesai" value="<?= $Grid->tanggalSelesai->EditValue ?>" placeholder="<?= HtmlEncode($Grid->tanggalSelesai->getPlaceHolder()) ?>"<?= $Grid->tanggalSelesai->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tanggalSelesai->getErrorMessage() ?></div>
<?php if (!$Grid->tanggalSelesai->ReadOnly && !$Grid->tanggalSelesai->Disabled && !isset($Grid->tanggalSelesai->EditAttrs["readonly"]) && !isset($Grid->tanggalSelesai->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fkegiatangrid", "datetimepicker"], function () {
    let format = "<?= DateFormat(0) ?>",
        options = {
        localization: {
            locale: ew.LANGUAGE_ID,
            numberingSystem: ew.getNumberingSystem()
        },
        display: {
            format,
            components: {
                hours: !!format.match(/h/i),
                minutes: !!format.match(/m/),
                seconds: !!format.match(/s/i)
            },
            icons: {
                previous: ew.IS_RTL ? "fas fa-chevron-right" : "fas fa-chevron-left",
                next: ew.IS_RTL ? "fas fa-chevron-left" : "fas fa-chevron-right"
            }
        }
    };
    ew.createDateTimePicker("fkegiatangrid", "x<?= $Grid->RowIndex ?>_tanggalSelesai", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="kegiatan" data-field="x_tanggalSelesai" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tanggalSelesai" id="o<?= $Grid->RowIndex ?>_tanggalSelesai" value="<?= HtmlEncode($Grid->tanggalSelesai->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_kegiatan_tanggalSelesai" class="el_kegiatan_tanggalSelesai">
<input type="<?= $Grid->tanggalSelesai->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_tanggalSelesai" id="x<?= $Grid->RowIndex ?>_tanggalSelesai" data-table="kegiatan" data-field="x_tanggalSelesai" value="<?= $Grid->tanggalSelesai->EditValue ?>" placeholder="<?= HtmlEncode($Grid->tanggalSelesai->getPlaceHolder()) ?>"<?= $Grid->tanggalSelesai->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tanggalSelesai->getErrorMessage() ?></div>
<?php if (!$Grid->tanggalSelesai->ReadOnly && !$Grid->tanggalSelesai->Disabled && !isset($Grid->tanggalSelesai->EditAttrs["readonly"]) && !isset($Grid->tanggalSelesai->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fkegiatangrid", "datetimepicker"], function () {
    let format = "<?= DateFormat(0) ?>",
        options = {
        localization: {
            locale: ew.LANGUAGE_ID,
            numberingSystem: ew.getNumberingSystem()
        },
        display: {
            format,
            components: {
                hours: !!format.match(/h/i),
                minutes: !!format.match(/m/),
                seconds: !!format.match(/s/i)
            },
            icons: {
                previous: ew.IS_RTL ? "fas fa-chevron-right" : "fas fa-chevron-left",
                next: ew.IS_RTL ? "fas fa-chevron-left" : "fas fa-chevron-right"
            }
        }
    };
    ew.createDateTimePicker("fkegiatangrid", "x<?= $Grid->RowIndex ?>_tanggalSelesai", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_kegiatan_tanggalSelesai" class="el_kegiatan_tanggalSelesai">
<span<?= $Grid->tanggalSelesai->viewAttributes() ?>>
<?= $Grid->tanggalSelesai->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="kegiatan" data-field="x_tanggalSelesai" data-hidden="1" name="fkegiatangrid$x<?= $Grid->RowIndex ?>_tanggalSelesai" id="fkegiatangrid$x<?= $Grid->RowIndex ?>_tanggalSelesai" value="<?= HtmlEncode($Grid->tanggalSelesai->FormValue) ?>">
<input type="hidden" data-table="kegiatan" data-field="x_tanggalSelesai" data-hidden="1" name="fkegiatangrid$o<?= $Grid->RowIndex ?>_tanggalSelesai" id="fkegiatangrid$o<?= $Grid->RowIndex ?>_tanggalSelesai" value="<?= HtmlEncode($Grid->tanggalSelesai->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->status->Visible) { // status ?>
        <td data-name="status"<?= $Grid->status->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_kegiatan_status" class="el_kegiatan_status">
<template id="tp_x<?= $Grid->RowIndex ?>_status">
    <div class="form-check">
        <input type="radio" class="form-check-input" data-table="kegiatan" data-field="x_status" name="x<?= $Grid->RowIndex ?>_status" id="x<?= $Grid->RowIndex ?>_status"<?= $Grid->status->editAttributes() ?>>
        <label class="form-check-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_status" class="ew-item-list"></div>
<selection-list hidden
    id="x<?= $Grid->RowIndex ?>_status"
    name="x<?= $Grid->RowIndex ?>_status"
    value="<?= HtmlEncode($Grid->status->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_status"
    data-bs-target="dsl_x<?= $Grid->RowIndex ?>_status"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->status->isInvalidClass() ?>"
    data-table="kegiatan"
    data-field="x_status"
    data-value-separator="<?= $Grid->status->displayValueSeparatorAttribute() ?>"
    <?= $Grid->status->editAttributes() ?>></selection-list>
<div class="invalid-feedback"><?= $Grid->status->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="kegiatan" data-field="x_status" data-hidden="1" name="o<?= $Grid->RowIndex ?>_status" id="o<?= $Grid->RowIndex ?>_status" value="<?= HtmlEncode($Grid->status->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_kegiatan_status" class="el_kegiatan_status">
<template id="tp_x<?= $Grid->RowIndex ?>_status">
    <div class="form-check">
        <input type="radio" class="form-check-input" data-table="kegiatan" data-field="x_status" name="x<?= $Grid->RowIndex ?>_status" id="x<?= $Grid->RowIndex ?>_status"<?= $Grid->status->editAttributes() ?>>
        <label class="form-check-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_status" class="ew-item-list"></div>
<selection-list hidden
    id="x<?= $Grid->RowIndex ?>_status"
    name="x<?= $Grid->RowIndex ?>_status"
    value="<?= HtmlEncode($Grid->status->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_status"
    data-bs-target="dsl_x<?= $Grid->RowIndex ?>_status"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->status->isInvalidClass() ?>"
    data-table="kegiatan"
    data-field="x_status"
    data-value-separator="<?= $Grid->status->displayValueSeparatorAttribute() ?>"
    <?= $Grid->status->editAttributes() ?>></selection-list>
<div class="invalid-feedback"><?= $Grid->status->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_kegiatan_status" class="el_kegiatan_status">
<span<?= $Grid->status->viewAttributes() ?>>
<?= $Grid->status->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="kegiatan" data-field="x_status" data-hidden="1" name="fkegiatangrid$x<?= $Grid->RowIndex ?>_status" id="fkegiatangrid$x<?= $Grid->RowIndex ?>_status" value="<?= HtmlEncode($Grid->status->FormValue) ?>">
<input type="hidden" data-table="kegiatan" data-field="x_status" data-hidden="1" name="fkegiatangrid$o<?= $Grid->RowIndex ?>_status" id="fkegiatangrid$o<?= $Grid->RowIndex ?>_status" value="<?= HtmlEncode($Grid->status->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowCount);
?>
    </tr>
<?php if ($Grid->RowType == ROWTYPE_ADD || $Grid->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fkegiatangrid","load"], () => fkegiatangrid.updateLists(<?= $Grid->RowIndex ?>));
</script>
<?php } ?>
<?php
    }
    } // End delete row checking
    if (!$Grid->isGridAdd() || $Grid->CurrentMode == "copy")
        if (!$Grid->Recordset->EOF) {
            $Grid->Recordset->moveNext();
        }
}
?>
<?php
if ($Grid->CurrentMode == "add" || $Grid->CurrentMode == "copy" || $Grid->CurrentMode == "edit") {
    $Grid->RowIndex = '$rowindex$';
    $Grid->loadRowValues();

    // Set row properties
    $Grid->resetAttributes();
    $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowIndex, "id" => "r0_kegiatan", "data-rowtype" => ROWTYPE_ADD]);
    $Grid->RowAttrs->appendClass("ew-template");

    // Reset previous form error if any
    $Grid->resetFormError();

    // Render row
    $Grid->RowType = ROWTYPE_ADD;
    $Grid->renderRow();

    // Render list options
    $Grid->renderListOptions();
    $Grid->StartRowCount = 0;
?>
    <tr <?= $Grid->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Grid->ListOptions->render("body", "left", $Grid->RowIndex);
?>
    <?php if ($Grid->idKegiatan->Visible) { // idKegiatan ?>
        <td data-name="idKegiatan">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_kegiatan_idKegiatan" class="el_kegiatan_idKegiatan"></span>
<?php } else { ?>
<span id="el$rowindex$_kegiatan_idKegiatan" class="el_kegiatan_idKegiatan">
<span<?= $Grid->idKegiatan->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->idKegiatan->getDisplayValue($Grid->idKegiatan->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="kegiatan" data-field="x_idKegiatan" data-hidden="1" name="x<?= $Grid->RowIndex ?>_idKegiatan" id="x<?= $Grid->RowIndex ?>_idKegiatan" value="<?= HtmlEncode($Grid->idKegiatan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="kegiatan" data-field="x_idKegiatan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_idKegiatan" id="o<?= $Grid->RowIndex ?>_idKegiatan" value="<?= HtmlEncode($Grid->idKegiatan->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->nama->Visible) { // nama ?>
        <td data-name="nama">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_kegiatan_nama" class="el_kegiatan_nama">
<input type="<?= $Grid->nama->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_nama" id="x<?= $Grid->RowIndex ?>_nama" data-table="kegiatan" data-field="x_nama" value="<?= $Grid->nama->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->nama->getPlaceHolder()) ?>"<?= $Grid->nama->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->nama->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_kegiatan_nama" class="el_kegiatan_nama">
<span<?= $Grid->nama->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->nama->getDisplayValue($Grid->nama->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="kegiatan" data-field="x_nama" data-hidden="1" name="x<?= $Grid->RowIndex ?>_nama" id="x<?= $Grid->RowIndex ?>_nama" value="<?= HtmlEncode($Grid->nama->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="kegiatan" data-field="x_nama" data-hidden="1" name="o<?= $Grid->RowIndex ?>_nama" id="o<?= $Grid->RowIndex ?>_nama" value="<?= HtmlEncode($Grid->nama->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->deskripsi->Visible) { // deskripsi ?>
        <td data-name="deskripsi">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_kegiatan_deskripsi" class="el_kegiatan_deskripsi">
<textarea data-table="kegiatan" data-field="x_deskripsi" name="x<?= $Grid->RowIndex ?>_deskripsi" id="x<?= $Grid->RowIndex ?>_deskripsi" cols="35" rows="4" placeholder="<?= HtmlEncode($Grid->deskripsi->getPlaceHolder()) ?>"<?= $Grid->deskripsi->editAttributes() ?>><?= $Grid->deskripsi->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Grid->deskripsi->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_kegiatan_deskripsi" class="el_kegiatan_deskripsi">
<span<?= $Grid->deskripsi->viewAttributes() ?>>
<?= $Grid->deskripsi->ViewValue ?></span>
</span>
<input type="hidden" data-table="kegiatan" data-field="x_deskripsi" data-hidden="1" name="x<?= $Grid->RowIndex ?>_deskripsi" id="x<?= $Grid->RowIndex ?>_deskripsi" value="<?= HtmlEncode($Grid->deskripsi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="kegiatan" data-field="x_deskripsi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_deskripsi" id="o<?= $Grid->RowIndex ?>_deskripsi" value="<?= HtmlEncode($Grid->deskripsi->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->penanggungJawab->Visible) { // penanggungJawab ?>
        <td data-name="penanggungJawab">
<?php if (!$Grid->isConfirm()) { ?>
<?php if ($Grid->penanggungJawab->getSessionValue() != "") { ?>
<span id="el$rowindex$_kegiatan_penanggungJawab" class="el_kegiatan_penanggungJawab">
<span<?= $Grid->penanggungJawab->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->penanggungJawab->getDisplayValue($Grid->penanggungJawab->ViewValue) ?></span></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_penanggungJawab" name="x<?= $Grid->RowIndex ?>_penanggungJawab" value="<?= HtmlEncode(FormatNumber($Grid->penanggungJawab->CurrentValue, $Grid->penanggungJawab->formatPattern())) ?>" data-hidden="1">
<?php } else { ?>
<span id="el$rowindex$_kegiatan_penanggungJawab" class="el_kegiatan_penanggungJawab">
    <select
        id="x<?= $Grid->RowIndex ?>_penanggungJawab"
        name="x<?= $Grid->RowIndex ?>_penanggungJawab"
        class="form-select ew-select<?= $Grid->penanggungJawab->isInvalidClass() ?>"
        data-select2-id="fkegiatangrid_x<?= $Grid->RowIndex ?>_penanggungJawab"
        data-table="kegiatan"
        data-field="x_penanggungJawab"
        data-value-separator="<?= $Grid->penanggungJawab->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->penanggungJawab->getPlaceHolder()) ?>"
        <?= $Grid->penanggungJawab->editAttributes() ?>>
        <?= $Grid->penanggungJawab->selectOptionListHtml("x{$Grid->RowIndex}_penanggungJawab") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->penanggungJawab->getErrorMessage() ?></div>
<?= $Grid->penanggungJawab->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_penanggungJawab") ?>
<script>
loadjs.ready("fkegiatangrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_penanggungJawab", selectId: "fkegiatangrid_x<?= $Grid->RowIndex ?>_penanggungJawab" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fkegiatangrid.lists.penanggungJawab.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_penanggungJawab", form: "fkegiatangrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_penanggungJawab", form: "fkegiatangrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.kegiatan.fields.penanggungJawab.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_kegiatan_penanggungJawab" class="el_kegiatan_penanggungJawab">
<span<?= $Grid->penanggungJawab->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->penanggungJawab->getDisplayValue($Grid->penanggungJawab->ViewValue) ?></span></span>
</span>
<input type="hidden" data-table="kegiatan" data-field="x_penanggungJawab" data-hidden="1" name="x<?= $Grid->RowIndex ?>_penanggungJawab" id="x<?= $Grid->RowIndex ?>_penanggungJawab" value="<?= HtmlEncode($Grid->penanggungJawab->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="kegiatan" data-field="x_penanggungJawab" data-hidden="1" name="o<?= $Grid->RowIndex ?>_penanggungJawab" id="o<?= $Grid->RowIndex ?>_penanggungJawab" value="<?= HtmlEncode($Grid->penanggungJawab->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->tanggalMulai->Visible) { // tanggalMulai ?>
        <td data-name="tanggalMulai">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_kegiatan_tanggalMulai" class="el_kegiatan_tanggalMulai">
<input type="<?= $Grid->tanggalMulai->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_tanggalMulai" id="x<?= $Grid->RowIndex ?>_tanggalMulai" data-table="kegiatan" data-field="x_tanggalMulai" value="<?= $Grid->tanggalMulai->EditValue ?>" placeholder="<?= HtmlEncode($Grid->tanggalMulai->getPlaceHolder()) ?>"<?= $Grid->tanggalMulai->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tanggalMulai->getErrorMessage() ?></div>
<?php if (!$Grid->tanggalMulai->ReadOnly && !$Grid->tanggalMulai->Disabled && !isset($Grid->tanggalMulai->EditAttrs["readonly"]) && !isset($Grid->tanggalMulai->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fkegiatangrid", "datetimepicker"], function () {
    let format = "<?= DateFormat(0) ?>",
        options = {
        localization: {
            locale: ew.LANGUAGE_ID,
            numberingSystem: ew.getNumberingSystem()
        },
        display: {
            format,
            components: {
                hours: !!format.match(/h/i),
                minutes: !!format.match(/m/),
                seconds: !!format.match(/s/i)
            },
            icons: {
                previous: ew.IS_RTL ? "fas fa-chevron-right" : "fas fa-chevron-left",
                next: ew.IS_RTL ? "fas fa-chevron-left" : "fas fa-chevron-right"
            }
        }
    };
    ew.createDateTimePicker("fkegiatangrid", "x<?= $Grid->RowIndex ?>_tanggalMulai", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_kegiatan_tanggalMulai" class="el_kegiatan_tanggalMulai">
<span<?= $Grid->tanggalMulai->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->tanggalMulai->getDisplayValue($Grid->tanggalMulai->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="kegiatan" data-field="x_tanggalMulai" data-hidden="1" name="x<?= $Grid->RowIndex ?>_tanggalMulai" id="x<?= $Grid->RowIndex ?>_tanggalMulai" value="<?= HtmlEncode($Grid->tanggalMulai->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="kegiatan" data-field="x_tanggalMulai" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tanggalMulai" id="o<?= $Grid->RowIndex ?>_tanggalMulai" value="<?= HtmlEncode($Grid->tanggalMulai->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->tanggalSelesai->Visible) { // tanggalSelesai ?>
        <td data-name="tanggalSelesai">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_kegiatan_tanggalSelesai" class="el_kegiatan_tanggalSelesai">
<input type="<?= $Grid->tanggalSelesai->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_tanggalSelesai" id="x<?= $Grid->RowIndex ?>_tanggalSelesai" data-table="kegiatan" data-field="x_tanggalSelesai" value="<?= $Grid->tanggalSelesai->EditValue ?>" placeholder="<?= HtmlEncode($Grid->tanggalSelesai->getPlaceHolder()) ?>"<?= $Grid->tanggalSelesai->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tanggalSelesai->getErrorMessage() ?></div>
<?php if (!$Grid->tanggalSelesai->ReadOnly && !$Grid->tanggalSelesai->Disabled && !isset($Grid->tanggalSelesai->EditAttrs["readonly"]) && !isset($Grid->tanggalSelesai->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fkegiatangrid", "datetimepicker"], function () {
    let format = "<?= DateFormat(0) ?>",
        options = {
        localization: {
            locale: ew.LANGUAGE_ID,
            numberingSystem: ew.getNumberingSystem()
        },
        display: {
            format,
            components: {
                hours: !!format.match(/h/i),
                minutes: !!format.match(/m/),
                seconds: !!format.match(/s/i)
            },
            icons: {
                previous: ew.IS_RTL ? "fas fa-chevron-right" : "fas fa-chevron-left",
                next: ew.IS_RTL ? "fas fa-chevron-left" : "fas fa-chevron-right"
            }
        }
    };
    ew.createDateTimePicker("fkegiatangrid", "x<?= $Grid->RowIndex ?>_tanggalSelesai", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_kegiatan_tanggalSelesai" class="el_kegiatan_tanggalSelesai">
<span<?= $Grid->tanggalSelesai->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->tanggalSelesai->getDisplayValue($Grid->tanggalSelesai->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="kegiatan" data-field="x_tanggalSelesai" data-hidden="1" name="x<?= $Grid->RowIndex ?>_tanggalSelesai" id="x<?= $Grid->RowIndex ?>_tanggalSelesai" value="<?= HtmlEncode($Grid->tanggalSelesai->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="kegiatan" data-field="x_tanggalSelesai" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tanggalSelesai" id="o<?= $Grid->RowIndex ?>_tanggalSelesai" value="<?= HtmlEncode($Grid->tanggalSelesai->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->status->Visible) { // status ?>
        <td data-name="status">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_kegiatan_status" class="el_kegiatan_status">
<template id="tp_x<?= $Grid->RowIndex ?>_status">
    <div class="form-check">
        <input type="radio" class="form-check-input" data-table="kegiatan" data-field="x_status" name="x<?= $Grid->RowIndex ?>_status" id="x<?= $Grid->RowIndex ?>_status"<?= $Grid->status->editAttributes() ?>>
        <label class="form-check-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_status" class="ew-item-list"></div>
<selection-list hidden
    id="x<?= $Grid->RowIndex ?>_status"
    name="x<?= $Grid->RowIndex ?>_status"
    value="<?= HtmlEncode($Grid->status->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_status"
    data-bs-target="dsl_x<?= $Grid->RowIndex ?>_status"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->status->isInvalidClass() ?>"
    data-table="kegiatan"
    data-field="x_status"
    data-value-separator="<?= $Grid->status->displayValueSeparatorAttribute() ?>"
    <?= $Grid->status->editAttributes() ?>></selection-list>
<div class="invalid-feedback"><?= $Grid->status->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_kegiatan_status" class="el_kegiatan_status">
<span<?= $Grid->status->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->status->getDisplayValue($Grid->status->ViewValue) ?></span></span>
</span>
<input type="hidden" data-table="kegiatan" data-field="x_status" data-hidden="1" name="x<?= $Grid->RowIndex ?>_status" id="x<?= $Grid->RowIndex ?>_status" value="<?= HtmlEncode($Grid->status->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="kegiatan" data-field="x_status" data-hidden="1" name="o<?= $Grid->RowIndex ?>_status" id="o<?= $Grid->RowIndex ?>_status" value="<?= HtmlEncode($Grid->status->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowIndex);
?>
<script>
loadjs.ready(["fkegiatangrid","load"], () => fkegiatangrid.updateLists(<?= $Grid->RowIndex ?>, true));
</script>
    </tr>
<?php
}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($Grid->CurrentMode == "add" || $Grid->CurrentMode == "copy") { ?>
<input type="hidden" name="<?= $Grid->FormKeyCountName ?>" id="<?= $Grid->FormKeyCountName ?>" value="<?= $Grid->KeyCount ?>">
<?= $Grid->MultiSelectKey ?>
<?php } ?>
<?php if ($Grid->CurrentMode == "edit") { ?>
<input type="hidden" name="<?= $Grid->FormKeyCountName ?>" id="<?= $Grid->FormKeyCountName ?>" value="<?= $Grid->KeyCount ?>">
<?= $Grid->MultiSelectKey ?>
<?php } ?>
<?php if ($Grid->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fkegiatangrid">
</div><!-- /.ew-list-form -->
<?php
// Close recordset
if ($Grid->Recordset) {
    $Grid->Recordset->close();
}
?>
<?php if ($Grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $Grid->OtherOptions->render("body", "bottom") ?>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } else { ?>
<div class="ew-list-other-options">
<?php $Grid->OtherOptions->render("body") ?>
</div>
<?php } ?>
<?php if (!$Grid->isExport()) { ?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("kegiatan");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
