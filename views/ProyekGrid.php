<?php

namespace PHPMaker2022\project1;

// Set up and run Grid object
$Grid = Container("ProyekGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fproyekgrid;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fproyekgrid = new ew.Form("fproyekgrid", "grid");
    fproyekgrid.formKeyCountName = "<?= $Grid->FormKeyCountName ?>";

    // Add fields
    var currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { proyek: currentTable } });
    var fields = currentTable.fields;
    fproyekgrid.addFields([
        ["idProyek", [fields.idProyek.visible && fields.idProyek.required ? ew.Validators.required(fields.idProyek.caption) : null, ew.Validators.integer], fields.idProyek.isInvalid],
        ["ajuan", [fields.ajuan.visible && fields.ajuan.required ? ew.Validators.required(fields.ajuan.caption) : null], fields.ajuan.isInvalid],
        ["biayaTerkumpul", [fields.biayaTerkumpul.visible && fields.biayaTerkumpul.required ? ew.Validators.required(fields.biayaTerkumpul.caption) : null, ew.Validators.integer], fields.biayaTerkumpul.isInvalid],
        ["tanggalMulai", [fields.tanggalMulai.visible && fields.tanggalMulai.required ? ew.Validators.required(fields.tanggalMulai.caption) : null, ew.Validators.datetime(fields.tanggalMulai.clientFormatPattern)], fields.tanggalMulai.isInvalid],
        ["tanggalSelesai", [fields.tanggalSelesai.visible && fields.tanggalSelesai.required ? ew.Validators.required(fields.tanggalSelesai.caption) : null, ew.Validators.datetime(fields.tanggalSelesai.clientFormatPattern)], fields.tanggalSelesai.isInvalid],
        ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid]
    ]);

    // Check empty row
    fproyekgrid.emptyRow = function (rowIndex) {
        var fobj = this.getForm(),
            fields = [["ajuan",false],["biayaTerkumpul",false],["tanggalMulai",false],["tanggalSelesai",false],["status",false]];
        if (fields.some(field => ew.valueChanged(fobj, rowIndex, ...field)))
            return false;
        return true;
    }

    // Form_CustomValidate
    fproyekgrid.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fproyekgrid.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fproyekgrid.lists.ajuan = <?= $Grid->ajuan->toClientList($Grid) ?>;
    fproyekgrid.lists.status = <?= $Grid->status->toClientList($Grid) ?>;
    loadjs.done("fproyekgrid");
});
</script>
<?php } ?>
<?php
$Grid->renderOtherOptions();
?>
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> proyek">
<div id="fproyekgrid" class="ew-form ew-list-form">
<div id="gmp_proyek" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_proyekgrid" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
<?php if ($Grid->idProyek->Visible) { // idProyek ?>
        <th data-name="idProyek" class="<?= $Grid->idProyek->headerCellClass() ?>"><div id="elh_proyek_idProyek" class="proyek_idProyek"><?= $Grid->renderFieldHeader($Grid->idProyek) ?></div></th>
<?php } ?>
<?php if ($Grid->ajuan->Visible) { // ajuan ?>
        <th data-name="ajuan" class="<?= $Grid->ajuan->headerCellClass() ?>"><div id="elh_proyek_ajuan" class="proyek_ajuan"><?= $Grid->renderFieldHeader($Grid->ajuan) ?></div></th>
<?php } ?>
<?php if ($Grid->biayaTerkumpul->Visible) { // biayaTerkumpul ?>
        <th data-name="biayaTerkumpul" class="<?= $Grid->biayaTerkumpul->headerCellClass() ?>"><div id="elh_proyek_biayaTerkumpul" class="proyek_biayaTerkumpul"><?= $Grid->renderFieldHeader($Grid->biayaTerkumpul) ?></div></th>
<?php } ?>
<?php if ($Grid->tanggalMulai->Visible) { // tanggalMulai ?>
        <th data-name="tanggalMulai" class="<?= $Grid->tanggalMulai->headerCellClass() ?>"><div id="elh_proyek_tanggalMulai" class="proyek_tanggalMulai"><?= $Grid->renderFieldHeader($Grid->tanggalMulai) ?></div></th>
<?php } ?>
<?php if ($Grid->tanggalSelesai->Visible) { // tanggalSelesai ?>
        <th data-name="tanggalSelesai" class="<?= $Grid->tanggalSelesai->headerCellClass() ?>"><div id="elh_proyek_tanggalSelesai" class="proyek_tanggalSelesai"><?= $Grid->renderFieldHeader($Grid->tanggalSelesai) ?></div></th>
<?php } ?>
<?php if ($Grid->status->Visible) { // status ?>
        <th data-name="status" class="<?= $Grid->status->headerCellClass() ?>"><div id="elh_proyek_status" class="proyek_status"><?= $Grid->renderFieldHeader($Grid->status) ?></div></th>
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
            "id" => "r" . $Grid->RowCount . "_proyek",
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
    <?php if ($Grid->idProyek->Visible) { // idProyek ?>
        <td data-name="idProyek"<?= $Grid->idProyek->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_proyek_idProyek" class="el_proyek_idProyek"></span>
<input type="hidden" data-table="proyek" data-field="x_idProyek" data-hidden="1" name="o<?= $Grid->RowIndex ?>_idProyek" id="o<?= $Grid->RowIndex ?>_idProyek" value="<?= HtmlEncode($Grid->idProyek->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_proyek_idProyek" class="el_proyek_idProyek">
<span<?= $Grid->idProyek->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->idProyek->getDisplayValue($Grid->idProyek->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="proyek" data-field="x_idProyek" data-hidden="1" name="x<?= $Grid->RowIndex ?>_idProyek" id="x<?= $Grid->RowIndex ?>_idProyek" value="<?= HtmlEncode($Grid->idProyek->CurrentValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_proyek_idProyek" class="el_proyek_idProyek">
<span<?= $Grid->idProyek->viewAttributes() ?>>
<?= $Grid->idProyek->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="proyek" data-field="x_idProyek" data-hidden="1" name="fproyekgrid$x<?= $Grid->RowIndex ?>_idProyek" id="fproyekgrid$x<?= $Grid->RowIndex ?>_idProyek" value="<?= HtmlEncode($Grid->idProyek->FormValue) ?>">
<input type="hidden" data-table="proyek" data-field="x_idProyek" data-hidden="1" name="fproyekgrid$o<?= $Grid->RowIndex ?>_idProyek" id="fproyekgrid$o<?= $Grid->RowIndex ?>_idProyek" value="<?= HtmlEncode($Grid->idProyek->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="proyek" data-field="x_idProyek" data-hidden="1" name="x<?= $Grid->RowIndex ?>_idProyek" id="x<?= $Grid->RowIndex ?>_idProyek" value="<?= HtmlEncode($Grid->idProyek->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Grid->ajuan->Visible) { // ajuan ?>
        <td data-name="ajuan"<?= $Grid->ajuan->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($Grid->ajuan->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_proyek_ajuan" class="el_proyek_ajuan">
<span<?= $Grid->ajuan->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->ajuan->getDisplayValue($Grid->ajuan->ViewValue) ?></span></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_ajuan" name="x<?= $Grid->RowIndex ?>_ajuan" value="<?= HtmlEncode(FormatNumber($Grid->ajuan->CurrentValue, $Grid->ajuan->formatPattern())) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_proyek_ajuan" class="el_proyek_ajuan">
    <select
        id="x<?= $Grid->RowIndex ?>_ajuan"
        name="x<?= $Grid->RowIndex ?>_ajuan"
        class="form-select ew-select<?= $Grid->ajuan->isInvalidClass() ?>"
        data-select2-id="fproyekgrid_x<?= $Grid->RowIndex ?>_ajuan"
        data-table="proyek"
        data-field="x_ajuan"
        data-value-separator="<?= $Grid->ajuan->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->ajuan->getPlaceHolder()) ?>"
        <?= $Grid->ajuan->editAttributes() ?>>
        <?= $Grid->ajuan->selectOptionListHtml("x{$Grid->RowIndex}_ajuan") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->ajuan->getErrorMessage() ?></div>
<?= $Grid->ajuan->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_ajuan") ?>
<script>
loadjs.ready("fproyekgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_ajuan", selectId: "fproyekgrid_x<?= $Grid->RowIndex ?>_ajuan" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fproyekgrid.lists.ajuan.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_ajuan", form: "fproyekgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_ajuan", form: "fproyekgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.proyek.fields.ajuan.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<input type="hidden" data-table="proyek" data-field="x_ajuan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ajuan" id="o<?= $Grid->RowIndex ?>_ajuan" value="<?= HtmlEncode($Grid->ajuan->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($Grid->ajuan->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_proyek_ajuan" class="el_proyek_ajuan">
<span<?= $Grid->ajuan->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->ajuan->getDisplayValue($Grid->ajuan->ViewValue) ?></span></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_ajuan" name="x<?= $Grid->RowIndex ?>_ajuan" value="<?= HtmlEncode(FormatNumber($Grid->ajuan->CurrentValue, $Grid->ajuan->formatPattern())) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_proyek_ajuan" class="el_proyek_ajuan">
    <select
        id="x<?= $Grid->RowIndex ?>_ajuan"
        name="x<?= $Grid->RowIndex ?>_ajuan"
        class="form-select ew-select<?= $Grid->ajuan->isInvalidClass() ?>"
        data-select2-id="fproyekgrid_x<?= $Grid->RowIndex ?>_ajuan"
        data-table="proyek"
        data-field="x_ajuan"
        data-value-separator="<?= $Grid->ajuan->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->ajuan->getPlaceHolder()) ?>"
        <?= $Grid->ajuan->editAttributes() ?>>
        <?= $Grid->ajuan->selectOptionListHtml("x{$Grid->RowIndex}_ajuan") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->ajuan->getErrorMessage() ?></div>
<?= $Grid->ajuan->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_ajuan") ?>
<script>
loadjs.ready("fproyekgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_ajuan", selectId: "fproyekgrid_x<?= $Grid->RowIndex ?>_ajuan" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fproyekgrid.lists.ajuan.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_ajuan", form: "fproyekgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_ajuan", form: "fproyekgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.proyek.fields.ajuan.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_proyek_ajuan" class="el_proyek_ajuan">
<span<?= $Grid->ajuan->viewAttributes() ?>>
<?= $Grid->ajuan->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="proyek" data-field="x_ajuan" data-hidden="1" name="fproyekgrid$x<?= $Grid->RowIndex ?>_ajuan" id="fproyekgrid$x<?= $Grid->RowIndex ?>_ajuan" value="<?= HtmlEncode($Grid->ajuan->FormValue) ?>">
<input type="hidden" data-table="proyek" data-field="x_ajuan" data-hidden="1" name="fproyekgrid$o<?= $Grid->RowIndex ?>_ajuan" id="fproyekgrid$o<?= $Grid->RowIndex ?>_ajuan" value="<?= HtmlEncode($Grid->ajuan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->biayaTerkumpul->Visible) { // biayaTerkumpul ?>
        <td data-name="biayaTerkumpul"<?= $Grid->biayaTerkumpul->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_proyek_biayaTerkumpul" class="el_proyek_biayaTerkumpul">
<input type="<?= $Grid->biayaTerkumpul->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_biayaTerkumpul" id="x<?= $Grid->RowIndex ?>_biayaTerkumpul" data-table="proyek" data-field="x_biayaTerkumpul" value="<?= $Grid->biayaTerkumpul->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->biayaTerkumpul->getPlaceHolder()) ?>"<?= $Grid->biayaTerkumpul->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->biayaTerkumpul->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="proyek" data-field="x_biayaTerkumpul" data-hidden="1" name="o<?= $Grid->RowIndex ?>_biayaTerkumpul" id="o<?= $Grid->RowIndex ?>_biayaTerkumpul" value="<?= HtmlEncode($Grid->biayaTerkumpul->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_proyek_biayaTerkumpul" class="el_proyek_biayaTerkumpul">
<input type="<?= $Grid->biayaTerkumpul->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_biayaTerkumpul" id="x<?= $Grid->RowIndex ?>_biayaTerkumpul" data-table="proyek" data-field="x_biayaTerkumpul" value="<?= $Grid->biayaTerkumpul->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->biayaTerkumpul->getPlaceHolder()) ?>"<?= $Grid->biayaTerkumpul->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->biayaTerkumpul->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_proyek_biayaTerkumpul" class="el_proyek_biayaTerkumpul">
<span<?= $Grid->biayaTerkumpul->viewAttributes() ?>>
<?= $Grid->biayaTerkumpul->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="proyek" data-field="x_biayaTerkumpul" data-hidden="1" name="fproyekgrid$x<?= $Grid->RowIndex ?>_biayaTerkumpul" id="fproyekgrid$x<?= $Grid->RowIndex ?>_biayaTerkumpul" value="<?= HtmlEncode($Grid->biayaTerkumpul->FormValue) ?>">
<input type="hidden" data-table="proyek" data-field="x_biayaTerkumpul" data-hidden="1" name="fproyekgrid$o<?= $Grid->RowIndex ?>_biayaTerkumpul" id="fproyekgrid$o<?= $Grid->RowIndex ?>_biayaTerkumpul" value="<?= HtmlEncode($Grid->biayaTerkumpul->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->tanggalMulai->Visible) { // tanggalMulai ?>
        <td data-name="tanggalMulai"<?= $Grid->tanggalMulai->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_proyek_tanggalMulai" class="el_proyek_tanggalMulai">
<input type="<?= $Grid->tanggalMulai->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_tanggalMulai" id="x<?= $Grid->RowIndex ?>_tanggalMulai" data-table="proyek" data-field="x_tanggalMulai" value="<?= $Grid->tanggalMulai->EditValue ?>" placeholder="<?= HtmlEncode($Grid->tanggalMulai->getPlaceHolder()) ?>"<?= $Grid->tanggalMulai->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tanggalMulai->getErrorMessage() ?></div>
<?php if (!$Grid->tanggalMulai->ReadOnly && !$Grid->tanggalMulai->Disabled && !isset($Grid->tanggalMulai->EditAttrs["readonly"]) && !isset($Grid->tanggalMulai->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fproyekgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fproyekgrid", "x<?= $Grid->RowIndex ?>_tanggalMulai", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="proyek" data-field="x_tanggalMulai" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tanggalMulai" id="o<?= $Grid->RowIndex ?>_tanggalMulai" value="<?= HtmlEncode($Grid->tanggalMulai->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_proyek_tanggalMulai" class="el_proyek_tanggalMulai">
<input type="<?= $Grid->tanggalMulai->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_tanggalMulai" id="x<?= $Grid->RowIndex ?>_tanggalMulai" data-table="proyek" data-field="x_tanggalMulai" value="<?= $Grid->tanggalMulai->EditValue ?>" placeholder="<?= HtmlEncode($Grid->tanggalMulai->getPlaceHolder()) ?>"<?= $Grid->tanggalMulai->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tanggalMulai->getErrorMessage() ?></div>
<?php if (!$Grid->tanggalMulai->ReadOnly && !$Grid->tanggalMulai->Disabled && !isset($Grid->tanggalMulai->EditAttrs["readonly"]) && !isset($Grid->tanggalMulai->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fproyekgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fproyekgrid", "x<?= $Grid->RowIndex ?>_tanggalMulai", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_proyek_tanggalMulai" class="el_proyek_tanggalMulai">
<span<?= $Grid->tanggalMulai->viewAttributes() ?>>
<?= $Grid->tanggalMulai->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="proyek" data-field="x_tanggalMulai" data-hidden="1" name="fproyekgrid$x<?= $Grid->RowIndex ?>_tanggalMulai" id="fproyekgrid$x<?= $Grid->RowIndex ?>_tanggalMulai" value="<?= HtmlEncode($Grid->tanggalMulai->FormValue) ?>">
<input type="hidden" data-table="proyek" data-field="x_tanggalMulai" data-hidden="1" name="fproyekgrid$o<?= $Grid->RowIndex ?>_tanggalMulai" id="fproyekgrid$o<?= $Grid->RowIndex ?>_tanggalMulai" value="<?= HtmlEncode($Grid->tanggalMulai->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->tanggalSelesai->Visible) { // tanggalSelesai ?>
        <td data-name="tanggalSelesai"<?= $Grid->tanggalSelesai->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_proyek_tanggalSelesai" class="el_proyek_tanggalSelesai">
<input type="<?= $Grid->tanggalSelesai->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_tanggalSelesai" id="x<?= $Grid->RowIndex ?>_tanggalSelesai" data-table="proyek" data-field="x_tanggalSelesai" value="<?= $Grid->tanggalSelesai->EditValue ?>" placeholder="<?= HtmlEncode($Grid->tanggalSelesai->getPlaceHolder()) ?>"<?= $Grid->tanggalSelesai->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tanggalSelesai->getErrorMessage() ?></div>
<?php if (!$Grid->tanggalSelesai->ReadOnly && !$Grid->tanggalSelesai->Disabled && !isset($Grid->tanggalSelesai->EditAttrs["readonly"]) && !isset($Grid->tanggalSelesai->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fproyekgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fproyekgrid", "x<?= $Grid->RowIndex ?>_tanggalSelesai", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="proyek" data-field="x_tanggalSelesai" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tanggalSelesai" id="o<?= $Grid->RowIndex ?>_tanggalSelesai" value="<?= HtmlEncode($Grid->tanggalSelesai->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_proyek_tanggalSelesai" class="el_proyek_tanggalSelesai">
<input type="<?= $Grid->tanggalSelesai->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_tanggalSelesai" id="x<?= $Grid->RowIndex ?>_tanggalSelesai" data-table="proyek" data-field="x_tanggalSelesai" value="<?= $Grid->tanggalSelesai->EditValue ?>" placeholder="<?= HtmlEncode($Grid->tanggalSelesai->getPlaceHolder()) ?>"<?= $Grid->tanggalSelesai->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tanggalSelesai->getErrorMessage() ?></div>
<?php if (!$Grid->tanggalSelesai->ReadOnly && !$Grid->tanggalSelesai->Disabled && !isset($Grid->tanggalSelesai->EditAttrs["readonly"]) && !isset($Grid->tanggalSelesai->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fproyekgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fproyekgrid", "x<?= $Grid->RowIndex ?>_tanggalSelesai", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_proyek_tanggalSelesai" class="el_proyek_tanggalSelesai">
<span<?= $Grid->tanggalSelesai->viewAttributes() ?>>
<?= $Grid->tanggalSelesai->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="proyek" data-field="x_tanggalSelesai" data-hidden="1" name="fproyekgrid$x<?= $Grid->RowIndex ?>_tanggalSelesai" id="fproyekgrid$x<?= $Grid->RowIndex ?>_tanggalSelesai" value="<?= HtmlEncode($Grid->tanggalSelesai->FormValue) ?>">
<input type="hidden" data-table="proyek" data-field="x_tanggalSelesai" data-hidden="1" name="fproyekgrid$o<?= $Grid->RowIndex ?>_tanggalSelesai" id="fproyekgrid$o<?= $Grid->RowIndex ?>_tanggalSelesai" value="<?= HtmlEncode($Grid->tanggalSelesai->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->status->Visible) { // status ?>
        <td data-name="status"<?= $Grid->status->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_proyek_status" class="el_proyek_status">
<template id="tp_x<?= $Grid->RowIndex ?>_status">
    <div class="form-check">
        <input type="radio" class="form-check-input" data-table="proyek" data-field="x_status" name="x<?= $Grid->RowIndex ?>_status" id="x<?= $Grid->RowIndex ?>_status"<?= $Grid->status->editAttributes() ?>>
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
    data-table="proyek"
    data-field="x_status"
    data-value-separator="<?= $Grid->status->displayValueSeparatorAttribute() ?>"
    <?= $Grid->status->editAttributes() ?>></selection-list>
<div class="invalid-feedback"><?= $Grid->status->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="proyek" data-field="x_status" data-hidden="1" name="o<?= $Grid->RowIndex ?>_status" id="o<?= $Grid->RowIndex ?>_status" value="<?= HtmlEncode($Grid->status->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_proyek_status" class="el_proyek_status">
<template id="tp_x<?= $Grid->RowIndex ?>_status">
    <div class="form-check">
        <input type="radio" class="form-check-input" data-table="proyek" data-field="x_status" name="x<?= $Grid->RowIndex ?>_status" id="x<?= $Grid->RowIndex ?>_status"<?= $Grid->status->editAttributes() ?>>
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
    data-table="proyek"
    data-field="x_status"
    data-value-separator="<?= $Grid->status->displayValueSeparatorAttribute() ?>"
    <?= $Grid->status->editAttributes() ?>></selection-list>
<div class="invalid-feedback"><?= $Grid->status->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_proyek_status" class="el_proyek_status">
<span<?= $Grid->status->viewAttributes() ?>>
<?= $Grid->status->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="proyek" data-field="x_status" data-hidden="1" name="fproyekgrid$x<?= $Grid->RowIndex ?>_status" id="fproyekgrid$x<?= $Grid->RowIndex ?>_status" value="<?= HtmlEncode($Grid->status->FormValue) ?>">
<input type="hidden" data-table="proyek" data-field="x_status" data-hidden="1" name="fproyekgrid$o<?= $Grid->RowIndex ?>_status" id="fproyekgrid$o<?= $Grid->RowIndex ?>_status" value="<?= HtmlEncode($Grid->status->OldValue) ?>">
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
loadjs.ready(["fproyekgrid","load"], () => fproyekgrid.updateLists(<?= $Grid->RowIndex ?>));
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
    $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowIndex, "id" => "r0_proyek", "data-rowtype" => ROWTYPE_ADD]);
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
    <?php if ($Grid->idProyek->Visible) { // idProyek ?>
        <td data-name="idProyek">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_proyek_idProyek" class="el_proyek_idProyek"></span>
<?php } else { ?>
<span id="el$rowindex$_proyek_idProyek" class="el_proyek_idProyek">
<span<?= $Grid->idProyek->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->idProyek->getDisplayValue($Grid->idProyek->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="proyek" data-field="x_idProyek" data-hidden="1" name="x<?= $Grid->RowIndex ?>_idProyek" id="x<?= $Grid->RowIndex ?>_idProyek" value="<?= HtmlEncode($Grid->idProyek->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="proyek" data-field="x_idProyek" data-hidden="1" name="o<?= $Grid->RowIndex ?>_idProyek" id="o<?= $Grid->RowIndex ?>_idProyek" value="<?= HtmlEncode($Grid->idProyek->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->ajuan->Visible) { // ajuan ?>
        <td data-name="ajuan">
<?php if (!$Grid->isConfirm()) { ?>
<?php if ($Grid->ajuan->getSessionValue() != "") { ?>
<span id="el$rowindex$_proyek_ajuan" class="el_proyek_ajuan">
<span<?= $Grid->ajuan->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->ajuan->getDisplayValue($Grid->ajuan->ViewValue) ?></span></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_ajuan" name="x<?= $Grid->RowIndex ?>_ajuan" value="<?= HtmlEncode(FormatNumber($Grid->ajuan->CurrentValue, $Grid->ajuan->formatPattern())) ?>" data-hidden="1">
<?php } else { ?>
<span id="el$rowindex$_proyek_ajuan" class="el_proyek_ajuan">
    <select
        id="x<?= $Grid->RowIndex ?>_ajuan"
        name="x<?= $Grid->RowIndex ?>_ajuan"
        class="form-select ew-select<?= $Grid->ajuan->isInvalidClass() ?>"
        data-select2-id="fproyekgrid_x<?= $Grid->RowIndex ?>_ajuan"
        data-table="proyek"
        data-field="x_ajuan"
        data-value-separator="<?= $Grid->ajuan->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->ajuan->getPlaceHolder()) ?>"
        <?= $Grid->ajuan->editAttributes() ?>>
        <?= $Grid->ajuan->selectOptionListHtml("x{$Grid->RowIndex}_ajuan") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->ajuan->getErrorMessage() ?></div>
<?= $Grid->ajuan->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_ajuan") ?>
<script>
loadjs.ready("fproyekgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_ajuan", selectId: "fproyekgrid_x<?= $Grid->RowIndex ?>_ajuan" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fproyekgrid.lists.ajuan.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_ajuan", form: "fproyekgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_ajuan", form: "fproyekgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.proyek.fields.ajuan.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_proyek_ajuan" class="el_proyek_ajuan">
<span<?= $Grid->ajuan->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->ajuan->getDisplayValue($Grid->ajuan->ViewValue) ?></span></span>
</span>
<input type="hidden" data-table="proyek" data-field="x_ajuan" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ajuan" id="x<?= $Grid->RowIndex ?>_ajuan" value="<?= HtmlEncode($Grid->ajuan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="proyek" data-field="x_ajuan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ajuan" id="o<?= $Grid->RowIndex ?>_ajuan" value="<?= HtmlEncode($Grid->ajuan->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->biayaTerkumpul->Visible) { // biayaTerkumpul ?>
        <td data-name="biayaTerkumpul">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_proyek_biayaTerkumpul" class="el_proyek_biayaTerkumpul">
<input type="<?= $Grid->biayaTerkumpul->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_biayaTerkumpul" id="x<?= $Grid->RowIndex ?>_biayaTerkumpul" data-table="proyek" data-field="x_biayaTerkumpul" value="<?= $Grid->biayaTerkumpul->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->biayaTerkumpul->getPlaceHolder()) ?>"<?= $Grid->biayaTerkumpul->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->biayaTerkumpul->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_proyek_biayaTerkumpul" class="el_proyek_biayaTerkumpul">
<span<?= $Grid->biayaTerkumpul->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->biayaTerkumpul->getDisplayValue($Grid->biayaTerkumpul->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="proyek" data-field="x_biayaTerkumpul" data-hidden="1" name="x<?= $Grid->RowIndex ?>_biayaTerkumpul" id="x<?= $Grid->RowIndex ?>_biayaTerkumpul" value="<?= HtmlEncode($Grid->biayaTerkumpul->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="proyek" data-field="x_biayaTerkumpul" data-hidden="1" name="o<?= $Grid->RowIndex ?>_biayaTerkumpul" id="o<?= $Grid->RowIndex ?>_biayaTerkumpul" value="<?= HtmlEncode($Grid->biayaTerkumpul->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->tanggalMulai->Visible) { // tanggalMulai ?>
        <td data-name="tanggalMulai">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_proyek_tanggalMulai" class="el_proyek_tanggalMulai">
<input type="<?= $Grid->tanggalMulai->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_tanggalMulai" id="x<?= $Grid->RowIndex ?>_tanggalMulai" data-table="proyek" data-field="x_tanggalMulai" value="<?= $Grid->tanggalMulai->EditValue ?>" placeholder="<?= HtmlEncode($Grid->tanggalMulai->getPlaceHolder()) ?>"<?= $Grid->tanggalMulai->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tanggalMulai->getErrorMessage() ?></div>
<?php if (!$Grid->tanggalMulai->ReadOnly && !$Grid->tanggalMulai->Disabled && !isset($Grid->tanggalMulai->EditAttrs["readonly"]) && !isset($Grid->tanggalMulai->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fproyekgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fproyekgrid", "x<?= $Grid->RowIndex ?>_tanggalMulai", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_proyek_tanggalMulai" class="el_proyek_tanggalMulai">
<span<?= $Grid->tanggalMulai->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->tanggalMulai->getDisplayValue($Grid->tanggalMulai->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="proyek" data-field="x_tanggalMulai" data-hidden="1" name="x<?= $Grid->RowIndex ?>_tanggalMulai" id="x<?= $Grid->RowIndex ?>_tanggalMulai" value="<?= HtmlEncode($Grid->tanggalMulai->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="proyek" data-field="x_tanggalMulai" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tanggalMulai" id="o<?= $Grid->RowIndex ?>_tanggalMulai" value="<?= HtmlEncode($Grid->tanggalMulai->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->tanggalSelesai->Visible) { // tanggalSelesai ?>
        <td data-name="tanggalSelesai">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_proyek_tanggalSelesai" class="el_proyek_tanggalSelesai">
<input type="<?= $Grid->tanggalSelesai->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_tanggalSelesai" id="x<?= $Grid->RowIndex ?>_tanggalSelesai" data-table="proyek" data-field="x_tanggalSelesai" value="<?= $Grid->tanggalSelesai->EditValue ?>" placeholder="<?= HtmlEncode($Grid->tanggalSelesai->getPlaceHolder()) ?>"<?= $Grid->tanggalSelesai->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tanggalSelesai->getErrorMessage() ?></div>
<?php if (!$Grid->tanggalSelesai->ReadOnly && !$Grid->tanggalSelesai->Disabled && !isset($Grid->tanggalSelesai->EditAttrs["readonly"]) && !isset($Grid->tanggalSelesai->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fproyekgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fproyekgrid", "x<?= $Grid->RowIndex ?>_tanggalSelesai", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_proyek_tanggalSelesai" class="el_proyek_tanggalSelesai">
<span<?= $Grid->tanggalSelesai->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->tanggalSelesai->getDisplayValue($Grid->tanggalSelesai->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="proyek" data-field="x_tanggalSelesai" data-hidden="1" name="x<?= $Grid->RowIndex ?>_tanggalSelesai" id="x<?= $Grid->RowIndex ?>_tanggalSelesai" value="<?= HtmlEncode($Grid->tanggalSelesai->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="proyek" data-field="x_tanggalSelesai" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tanggalSelesai" id="o<?= $Grid->RowIndex ?>_tanggalSelesai" value="<?= HtmlEncode($Grid->tanggalSelesai->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->status->Visible) { // status ?>
        <td data-name="status">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_proyek_status" class="el_proyek_status">
<template id="tp_x<?= $Grid->RowIndex ?>_status">
    <div class="form-check">
        <input type="radio" class="form-check-input" data-table="proyek" data-field="x_status" name="x<?= $Grid->RowIndex ?>_status" id="x<?= $Grid->RowIndex ?>_status"<?= $Grid->status->editAttributes() ?>>
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
    data-table="proyek"
    data-field="x_status"
    data-value-separator="<?= $Grid->status->displayValueSeparatorAttribute() ?>"
    <?= $Grid->status->editAttributes() ?>></selection-list>
<div class="invalid-feedback"><?= $Grid->status->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_proyek_status" class="el_proyek_status">
<span<?= $Grid->status->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->status->getDisplayValue($Grid->status->ViewValue) ?></span></span>
</span>
<input type="hidden" data-table="proyek" data-field="x_status" data-hidden="1" name="x<?= $Grid->RowIndex ?>_status" id="x<?= $Grid->RowIndex ?>_status" value="<?= HtmlEncode($Grid->status->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="proyek" data-field="x_status" data-hidden="1" name="o<?= $Grid->RowIndex ?>_status" id="o<?= $Grid->RowIndex ?>_status" value="<?= HtmlEncode($Grid->status->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowIndex);
?>
<script>
loadjs.ready(["fproyekgrid","load"], () => fproyekgrid.updateLists(<?= $Grid->RowIndex ?>, true));
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
<input type="hidden" name="detailpage" value="fproyekgrid">
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
    ew.addEventHandlers("proyek");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
