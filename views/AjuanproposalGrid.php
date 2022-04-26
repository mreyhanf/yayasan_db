<?php

namespace PHPMaker2022\project1;

// Set up and run Grid object
$Grid = Container("AjuanproposalGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fajuanproposalgrid;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fajuanproposalgrid = new ew.Form("fajuanproposalgrid", "grid");
    fajuanproposalgrid.formKeyCountName = "<?= $Grid->FormKeyCountName ?>";

    // Add fields
    var currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { ajuanproposal: currentTable } });
    var fields = currentTable.fields;
    fajuanproposalgrid.addFields([
        ["idProyek", [fields.idProyek.visible && fields.idProyek.required ? ew.Validators.required(fields.idProyek.caption) : null], fields.idProyek.isInvalid],
        ["idTargetProposal", [fields.idTargetProposal.visible && fields.idTargetProposal.required ? ew.Validators.required(fields.idTargetProposal.caption) : null], fields.idTargetProposal.isInvalid],
        ["tanggalPengajuan", [fields.tanggalPengajuan.visible && fields.tanggalPengajuan.required ? ew.Validators.required(fields.tanggalPengajuan.caption) : null, ew.Validators.datetime(fields.tanggalPengajuan.clientFormatPattern)], fields.tanggalPengajuan.isInvalid],
        ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid]
    ]);

    // Check empty row
    fajuanproposalgrid.emptyRow = function (rowIndex) {
        var fobj = this.getForm(),
            fields = [["idProyek",false],["idTargetProposal",false],["tanggalPengajuan",false],["status",false]];
        if (fields.some(field => ew.valueChanged(fobj, rowIndex, ...field)))
            return false;
        return true;
    }

    // Form_CustomValidate
    fajuanproposalgrid.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fajuanproposalgrid.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fajuanproposalgrid.lists.idProyek = <?= $Grid->idProyek->toClientList($Grid) ?>;
    fajuanproposalgrid.lists.idTargetProposal = <?= $Grid->idTargetProposal->toClientList($Grid) ?>;
    fajuanproposalgrid.lists.status = <?= $Grid->status->toClientList($Grid) ?>;
    loadjs.done("fajuanproposalgrid");
});
</script>
<?php } ?>
<?php
$Grid->renderOtherOptions();
?>
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> ajuanproposal">
<div id="fajuanproposalgrid" class="ew-form ew-list-form">
<div id="gmp_ajuanproposal" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_ajuanproposalgrid" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
        <th data-name="idProyek" class="<?= $Grid->idProyek->headerCellClass() ?>"><div id="elh_ajuanproposal_idProyek" class="ajuanproposal_idProyek"><?= $Grid->renderFieldHeader($Grid->idProyek) ?></div></th>
<?php } ?>
<?php if ($Grid->idTargetProposal->Visible) { // idTargetProposal ?>
        <th data-name="idTargetProposal" class="<?= $Grid->idTargetProposal->headerCellClass() ?>"><div id="elh_ajuanproposal_idTargetProposal" class="ajuanproposal_idTargetProposal"><?= $Grid->renderFieldHeader($Grid->idTargetProposal) ?></div></th>
<?php } ?>
<?php if ($Grid->tanggalPengajuan->Visible) { // tanggalPengajuan ?>
        <th data-name="tanggalPengajuan" class="<?= $Grid->tanggalPengajuan->headerCellClass() ?>"><div id="elh_ajuanproposal_tanggalPengajuan" class="ajuanproposal_tanggalPengajuan"><?= $Grid->renderFieldHeader($Grid->tanggalPengajuan) ?></div></th>
<?php } ?>
<?php if ($Grid->status->Visible) { // status ?>
        <th data-name="status" class="<?= $Grid->status->headerCellClass() ?>"><div id="elh_ajuanproposal_status" class="ajuanproposal_status"><?= $Grid->renderFieldHeader($Grid->status) ?></div></th>
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
            "id" => "r" . $Grid->RowCount . "_ajuanproposal",
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
<span id="el<?= $Grid->RowCount ?>_ajuanproposal_idProyek" class="el_ajuanproposal_idProyek">
    <select
        id="x<?= $Grid->RowIndex ?>_idProyek"
        name="x<?= $Grid->RowIndex ?>_idProyek"
        class="form-select ew-select<?= $Grid->idProyek->isInvalidClass() ?>"
        data-select2-id="fajuanproposalgrid_x<?= $Grid->RowIndex ?>_idProyek"
        data-table="ajuanproposal"
        data-field="x_idProyek"
        data-value-separator="<?= $Grid->idProyek->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->idProyek->getPlaceHolder()) ?>"
        <?= $Grid->idProyek->editAttributes() ?>>
        <?= $Grid->idProyek->selectOptionListHtml("x{$Grid->RowIndex}_idProyek") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->idProyek->getErrorMessage() ?></div>
<?= $Grid->idProyek->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_idProyek") ?>
<script>
loadjs.ready("fajuanproposalgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_idProyek", selectId: "fajuanproposalgrid_x<?= $Grid->RowIndex ?>_idProyek" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fajuanproposalgrid.lists.idProyek.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_idProyek", form: "fajuanproposalgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_idProyek", form: "fajuanproposalgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.ajuanproposal.fields.idProyek.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<input type="hidden" data-table="ajuanproposal" data-field="x_idProyek" data-hidden="1" name="o<?= $Grid->RowIndex ?>_idProyek" id="o<?= $Grid->RowIndex ?>_idProyek" value="<?= HtmlEncode($Grid->idProyek->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
    <select
        id="x<?= $Grid->RowIndex ?>_idProyek"
        name="x<?= $Grid->RowIndex ?>_idProyek"
        class="form-select ew-select<?= $Grid->idProyek->isInvalidClass() ?>"
        data-select2-id="fajuanproposalgrid_x<?= $Grid->RowIndex ?>_idProyek"
        data-table="ajuanproposal"
        data-field="x_idProyek"
        data-value-separator="<?= $Grid->idProyek->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->idProyek->getPlaceHolder()) ?>"
        <?= $Grid->idProyek->editAttributes() ?>>
        <?= $Grid->idProyek->selectOptionListHtml("x{$Grid->RowIndex}_idProyek") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->idProyek->getErrorMessage() ?></div>
<?= $Grid->idProyek->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_idProyek") ?>
<script>
loadjs.ready("fajuanproposalgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_idProyek", selectId: "fajuanproposalgrid_x<?= $Grid->RowIndex ?>_idProyek" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fajuanproposalgrid.lists.idProyek.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_idProyek", form: "fajuanproposalgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_idProyek", form: "fajuanproposalgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.ajuanproposal.fields.idProyek.selectOptions);
    ew.createSelect(options);
});
</script>
<input type="hidden" data-table="ajuanproposal" data-field="x_idProyek" data-hidden="1" name="o<?= $Grid->RowIndex ?>_idProyek" id="o<?= $Grid->RowIndex ?>_idProyek" value="<?= HtmlEncode($Grid->idProyek->OldValue ?? $Grid->idProyek->CurrentValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_ajuanproposal_idProyek" class="el_ajuanproposal_idProyek">
<span<?= $Grid->idProyek->viewAttributes() ?>>
<?= $Grid->idProyek->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="ajuanproposal" data-field="x_idProyek" data-hidden="1" name="fajuanproposalgrid$x<?= $Grid->RowIndex ?>_idProyek" id="fajuanproposalgrid$x<?= $Grid->RowIndex ?>_idProyek" value="<?= HtmlEncode($Grid->idProyek->FormValue) ?>">
<input type="hidden" data-table="ajuanproposal" data-field="x_idProyek" data-hidden="1" name="fajuanproposalgrid$o<?= $Grid->RowIndex ?>_idProyek" id="fajuanproposalgrid$o<?= $Grid->RowIndex ?>_idProyek" value="<?= HtmlEncode($Grid->idProyek->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="ajuanproposal" data-field="x_idProyek" data-hidden="1" name="x<?= $Grid->RowIndex ?>_idProyek" id="x<?= $Grid->RowIndex ?>_idProyek" value="<?= HtmlEncode($Grid->idProyek->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Grid->idTargetProposal->Visible) { // idTargetProposal ?>
        <td data-name="idTargetProposal"<?= $Grid->idTargetProposal->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($Grid->idTargetProposal->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_ajuanproposal_idTargetProposal" class="el_ajuanproposal_idTargetProposal">
<span<?= $Grid->idTargetProposal->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->idTargetProposal->getDisplayValue($Grid->idTargetProposal->ViewValue) ?></span></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_idTargetProposal" name="x<?= $Grid->RowIndex ?>_idTargetProposal" value="<?= HtmlEncode(FormatNumber($Grid->idTargetProposal->CurrentValue, $Grid->idTargetProposal->formatPattern())) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_ajuanproposal_idTargetProposal" class="el_ajuanproposal_idTargetProposal">
    <select
        id="x<?= $Grid->RowIndex ?>_idTargetProposal"
        name="x<?= $Grid->RowIndex ?>_idTargetProposal"
        class="form-select ew-select<?= $Grid->idTargetProposal->isInvalidClass() ?>"
        data-select2-id="fajuanproposalgrid_x<?= $Grid->RowIndex ?>_idTargetProposal"
        data-table="ajuanproposal"
        data-field="x_idTargetProposal"
        data-value-separator="<?= $Grid->idTargetProposal->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->idTargetProposal->getPlaceHolder()) ?>"
        <?= $Grid->idTargetProposal->editAttributes() ?>>
        <?= $Grid->idTargetProposal->selectOptionListHtml("x{$Grid->RowIndex}_idTargetProposal") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->idTargetProposal->getErrorMessage() ?></div>
<?= $Grid->idTargetProposal->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_idTargetProposal") ?>
<script>
loadjs.ready("fajuanproposalgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_idTargetProposal", selectId: "fajuanproposalgrid_x<?= $Grid->RowIndex ?>_idTargetProposal" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fajuanproposalgrid.lists.idTargetProposal.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_idTargetProposal", form: "fajuanproposalgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_idTargetProposal", form: "fajuanproposalgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.ajuanproposal.fields.idTargetProposal.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<input type="hidden" data-table="ajuanproposal" data-field="x_idTargetProposal" data-hidden="1" name="o<?= $Grid->RowIndex ?>_idTargetProposal" id="o<?= $Grid->RowIndex ?>_idTargetProposal" value="<?= HtmlEncode($Grid->idTargetProposal->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($Grid->idTargetProposal->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_ajuanproposal_idTargetProposal" class="el_ajuanproposal_idTargetProposal">
<span<?= $Grid->idTargetProposal->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->idTargetProposal->getDisplayValue($Grid->idTargetProposal->EditValue) ?></span></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_idTargetProposal" name="x<?= $Grid->RowIndex ?>_idTargetProposal" value="<?= HtmlEncode($Grid->idTargetProposal->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
    <select
        id="x<?= $Grid->RowIndex ?>_idTargetProposal"
        name="x<?= $Grid->RowIndex ?>_idTargetProposal"
        class="form-select ew-select<?= $Grid->idTargetProposal->isInvalidClass() ?>"
        data-select2-id="fajuanproposalgrid_x<?= $Grid->RowIndex ?>_idTargetProposal"
        data-table="ajuanproposal"
        data-field="x_idTargetProposal"
        data-value-separator="<?= $Grid->idTargetProposal->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->idTargetProposal->getPlaceHolder()) ?>"
        <?= $Grid->idTargetProposal->editAttributes() ?>>
        <?= $Grid->idTargetProposal->selectOptionListHtml("x{$Grid->RowIndex}_idTargetProposal") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->idTargetProposal->getErrorMessage() ?></div>
<?= $Grid->idTargetProposal->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_idTargetProposal") ?>
<script>
loadjs.ready("fajuanproposalgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_idTargetProposal", selectId: "fajuanproposalgrid_x<?= $Grid->RowIndex ?>_idTargetProposal" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fajuanproposalgrid.lists.idTargetProposal.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_idTargetProposal", form: "fajuanproposalgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_idTargetProposal", form: "fajuanproposalgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.ajuanproposal.fields.idTargetProposal.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
<input type="hidden" data-table="ajuanproposal" data-field="x_idTargetProposal" data-hidden="1" name="o<?= $Grid->RowIndex ?>_idTargetProposal" id="o<?= $Grid->RowIndex ?>_idTargetProposal" value="<?= HtmlEncode($Grid->idTargetProposal->OldValue ?? $Grid->idTargetProposal->CurrentValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_ajuanproposal_idTargetProposal" class="el_ajuanproposal_idTargetProposal">
<span<?= $Grid->idTargetProposal->viewAttributes() ?>>
<?= $Grid->idTargetProposal->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="ajuanproposal" data-field="x_idTargetProposal" data-hidden="1" name="fajuanproposalgrid$x<?= $Grid->RowIndex ?>_idTargetProposal" id="fajuanproposalgrid$x<?= $Grid->RowIndex ?>_idTargetProposal" value="<?= HtmlEncode($Grid->idTargetProposal->FormValue) ?>">
<input type="hidden" data-table="ajuanproposal" data-field="x_idTargetProposal" data-hidden="1" name="fajuanproposalgrid$o<?= $Grid->RowIndex ?>_idTargetProposal" id="fajuanproposalgrid$o<?= $Grid->RowIndex ?>_idTargetProposal" value="<?= HtmlEncode($Grid->idTargetProposal->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="ajuanproposal" data-field="x_idTargetProposal" data-hidden="1" name="x<?= $Grid->RowIndex ?>_idTargetProposal" id="x<?= $Grid->RowIndex ?>_idTargetProposal" value="<?= HtmlEncode($Grid->idTargetProposal->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Grid->tanggalPengajuan->Visible) { // tanggalPengajuan ?>
        <td data-name="tanggalPengajuan"<?= $Grid->tanggalPengajuan->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_ajuanproposal_tanggalPengajuan" class="el_ajuanproposal_tanggalPengajuan">
<input type="<?= $Grid->tanggalPengajuan->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_tanggalPengajuan" id="x<?= $Grid->RowIndex ?>_tanggalPengajuan" data-table="ajuanproposal" data-field="x_tanggalPengajuan" value="<?= $Grid->tanggalPengajuan->EditValue ?>" placeholder="<?= HtmlEncode($Grid->tanggalPengajuan->getPlaceHolder()) ?>"<?= $Grid->tanggalPengajuan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tanggalPengajuan->getErrorMessage() ?></div>
<?php if (!$Grid->tanggalPengajuan->ReadOnly && !$Grid->tanggalPengajuan->Disabled && !isset($Grid->tanggalPengajuan->EditAttrs["readonly"]) && !isset($Grid->tanggalPengajuan->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fajuanproposalgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fajuanproposalgrid", "x<?= $Grid->RowIndex ?>_tanggalPengajuan", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="ajuanproposal" data-field="x_tanggalPengajuan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tanggalPengajuan" id="o<?= $Grid->RowIndex ?>_tanggalPengajuan" value="<?= HtmlEncode($Grid->tanggalPengajuan->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_ajuanproposal_tanggalPengajuan" class="el_ajuanproposal_tanggalPengajuan">
<input type="<?= $Grid->tanggalPengajuan->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_tanggalPengajuan" id="x<?= $Grid->RowIndex ?>_tanggalPengajuan" data-table="ajuanproposal" data-field="x_tanggalPengajuan" value="<?= $Grid->tanggalPengajuan->EditValue ?>" placeholder="<?= HtmlEncode($Grid->tanggalPengajuan->getPlaceHolder()) ?>"<?= $Grid->tanggalPengajuan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tanggalPengajuan->getErrorMessage() ?></div>
<?php if (!$Grid->tanggalPengajuan->ReadOnly && !$Grid->tanggalPengajuan->Disabled && !isset($Grid->tanggalPengajuan->EditAttrs["readonly"]) && !isset($Grid->tanggalPengajuan->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fajuanproposalgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fajuanproposalgrid", "x<?= $Grid->RowIndex ?>_tanggalPengajuan", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_ajuanproposal_tanggalPengajuan" class="el_ajuanproposal_tanggalPengajuan">
<span<?= $Grid->tanggalPengajuan->viewAttributes() ?>>
<?= $Grid->tanggalPengajuan->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="ajuanproposal" data-field="x_tanggalPengajuan" data-hidden="1" name="fajuanproposalgrid$x<?= $Grid->RowIndex ?>_tanggalPengajuan" id="fajuanproposalgrid$x<?= $Grid->RowIndex ?>_tanggalPengajuan" value="<?= HtmlEncode($Grid->tanggalPengajuan->FormValue) ?>">
<input type="hidden" data-table="ajuanproposal" data-field="x_tanggalPengajuan" data-hidden="1" name="fajuanproposalgrid$o<?= $Grid->RowIndex ?>_tanggalPengajuan" id="fajuanproposalgrid$o<?= $Grid->RowIndex ?>_tanggalPengajuan" value="<?= HtmlEncode($Grid->tanggalPengajuan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->status->Visible) { // status ?>
        <td data-name="status"<?= $Grid->status->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_ajuanproposal_status" class="el_ajuanproposal_status">
<template id="tp_x<?= $Grid->RowIndex ?>_status">
    <div class="form-check">
        <input type="radio" class="form-check-input" data-table="ajuanproposal" data-field="x_status" name="x<?= $Grid->RowIndex ?>_status" id="x<?= $Grid->RowIndex ?>_status"<?= $Grid->status->editAttributes() ?>>
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
    data-table="ajuanproposal"
    data-field="x_status"
    data-value-separator="<?= $Grid->status->displayValueSeparatorAttribute() ?>"
    <?= $Grid->status->editAttributes() ?>></selection-list>
<div class="invalid-feedback"><?= $Grid->status->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="ajuanproposal" data-field="x_status" data-hidden="1" name="o<?= $Grid->RowIndex ?>_status" id="o<?= $Grid->RowIndex ?>_status" value="<?= HtmlEncode($Grid->status->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_ajuanproposal_status" class="el_ajuanproposal_status">
<template id="tp_x<?= $Grid->RowIndex ?>_status">
    <div class="form-check">
        <input type="radio" class="form-check-input" data-table="ajuanproposal" data-field="x_status" name="x<?= $Grid->RowIndex ?>_status" id="x<?= $Grid->RowIndex ?>_status"<?= $Grid->status->editAttributes() ?>>
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
    data-table="ajuanproposal"
    data-field="x_status"
    data-value-separator="<?= $Grid->status->displayValueSeparatorAttribute() ?>"
    <?= $Grid->status->editAttributes() ?>></selection-list>
<div class="invalid-feedback"><?= $Grid->status->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_ajuanproposal_status" class="el_ajuanproposal_status">
<span<?= $Grid->status->viewAttributes() ?>>
<?= $Grid->status->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="ajuanproposal" data-field="x_status" data-hidden="1" name="fajuanproposalgrid$x<?= $Grid->RowIndex ?>_status" id="fajuanproposalgrid$x<?= $Grid->RowIndex ?>_status" value="<?= HtmlEncode($Grid->status->FormValue) ?>">
<input type="hidden" data-table="ajuanproposal" data-field="x_status" data-hidden="1" name="fajuanproposalgrid$o<?= $Grid->RowIndex ?>_status" id="fajuanproposalgrid$o<?= $Grid->RowIndex ?>_status" value="<?= HtmlEncode($Grid->status->OldValue) ?>">
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
loadjs.ready(["fajuanproposalgrid","load"], () => fajuanproposalgrid.updateLists(<?= $Grid->RowIndex ?>));
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
    $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowIndex, "id" => "r0_ajuanproposal", "data-rowtype" => ROWTYPE_ADD]);
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
<span id="el$rowindex$_ajuanproposal_idProyek" class="el_ajuanproposal_idProyek">
    <select
        id="x<?= $Grid->RowIndex ?>_idProyek"
        name="x<?= $Grid->RowIndex ?>_idProyek"
        class="form-select ew-select<?= $Grid->idProyek->isInvalidClass() ?>"
        data-select2-id="fajuanproposalgrid_x<?= $Grid->RowIndex ?>_idProyek"
        data-table="ajuanproposal"
        data-field="x_idProyek"
        data-value-separator="<?= $Grid->idProyek->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->idProyek->getPlaceHolder()) ?>"
        <?= $Grid->idProyek->editAttributes() ?>>
        <?= $Grid->idProyek->selectOptionListHtml("x{$Grid->RowIndex}_idProyek") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->idProyek->getErrorMessage() ?></div>
<?= $Grid->idProyek->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_idProyek") ?>
<script>
loadjs.ready("fajuanproposalgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_idProyek", selectId: "fajuanproposalgrid_x<?= $Grid->RowIndex ?>_idProyek" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fajuanproposalgrid.lists.idProyek.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_idProyek", form: "fajuanproposalgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_idProyek", form: "fajuanproposalgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.ajuanproposal.fields.idProyek.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } else { ?>
<span id="el$rowindex$_ajuanproposal_idProyek" class="el_ajuanproposal_idProyek">
<span<?= $Grid->idProyek->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->idProyek->getDisplayValue($Grid->idProyek->ViewValue) ?></span></span>
</span>
<input type="hidden" data-table="ajuanproposal" data-field="x_idProyek" data-hidden="1" name="x<?= $Grid->RowIndex ?>_idProyek" id="x<?= $Grid->RowIndex ?>_idProyek" value="<?= HtmlEncode($Grid->idProyek->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ajuanproposal" data-field="x_idProyek" data-hidden="1" name="o<?= $Grid->RowIndex ?>_idProyek" id="o<?= $Grid->RowIndex ?>_idProyek" value="<?= HtmlEncode($Grid->idProyek->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->idTargetProposal->Visible) { // idTargetProposal ?>
        <td data-name="idTargetProposal">
<?php if (!$Grid->isConfirm()) { ?>
<?php if ($Grid->idTargetProposal->getSessionValue() != "") { ?>
<span id="el$rowindex$_ajuanproposal_idTargetProposal" class="el_ajuanproposal_idTargetProposal">
<span<?= $Grid->idTargetProposal->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->idTargetProposal->getDisplayValue($Grid->idTargetProposal->ViewValue) ?></span></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_idTargetProposal" name="x<?= $Grid->RowIndex ?>_idTargetProposal" value="<?= HtmlEncode(FormatNumber($Grid->idTargetProposal->CurrentValue, $Grid->idTargetProposal->formatPattern())) ?>" data-hidden="1">
<?php } else { ?>
<span id="el$rowindex$_ajuanproposal_idTargetProposal" class="el_ajuanproposal_idTargetProposal">
    <select
        id="x<?= $Grid->RowIndex ?>_idTargetProposal"
        name="x<?= $Grid->RowIndex ?>_idTargetProposal"
        class="form-select ew-select<?= $Grid->idTargetProposal->isInvalidClass() ?>"
        data-select2-id="fajuanproposalgrid_x<?= $Grid->RowIndex ?>_idTargetProposal"
        data-table="ajuanproposal"
        data-field="x_idTargetProposal"
        data-value-separator="<?= $Grid->idTargetProposal->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->idTargetProposal->getPlaceHolder()) ?>"
        <?= $Grid->idTargetProposal->editAttributes() ?>>
        <?= $Grid->idTargetProposal->selectOptionListHtml("x{$Grid->RowIndex}_idTargetProposal") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->idTargetProposal->getErrorMessage() ?></div>
<?= $Grid->idTargetProposal->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_idTargetProposal") ?>
<script>
loadjs.ready("fajuanproposalgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_idTargetProposal", selectId: "fajuanproposalgrid_x<?= $Grid->RowIndex ?>_idTargetProposal" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fajuanproposalgrid.lists.idTargetProposal.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_idTargetProposal", form: "fajuanproposalgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_idTargetProposal", form: "fajuanproposalgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.ajuanproposal.fields.idTargetProposal.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_ajuanproposal_idTargetProposal" class="el_ajuanproposal_idTargetProposal">
<span<?= $Grid->idTargetProposal->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->idTargetProposal->getDisplayValue($Grid->idTargetProposal->ViewValue) ?></span></span>
</span>
<input type="hidden" data-table="ajuanproposal" data-field="x_idTargetProposal" data-hidden="1" name="x<?= $Grid->RowIndex ?>_idTargetProposal" id="x<?= $Grid->RowIndex ?>_idTargetProposal" value="<?= HtmlEncode($Grid->idTargetProposal->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ajuanproposal" data-field="x_idTargetProposal" data-hidden="1" name="o<?= $Grid->RowIndex ?>_idTargetProposal" id="o<?= $Grid->RowIndex ?>_idTargetProposal" value="<?= HtmlEncode($Grid->idTargetProposal->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->tanggalPengajuan->Visible) { // tanggalPengajuan ?>
        <td data-name="tanggalPengajuan">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_ajuanproposal_tanggalPengajuan" class="el_ajuanproposal_tanggalPengajuan">
<input type="<?= $Grid->tanggalPengajuan->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_tanggalPengajuan" id="x<?= $Grid->RowIndex ?>_tanggalPengajuan" data-table="ajuanproposal" data-field="x_tanggalPengajuan" value="<?= $Grid->tanggalPengajuan->EditValue ?>" placeholder="<?= HtmlEncode($Grid->tanggalPengajuan->getPlaceHolder()) ?>"<?= $Grid->tanggalPengajuan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tanggalPengajuan->getErrorMessage() ?></div>
<?php if (!$Grid->tanggalPengajuan->ReadOnly && !$Grid->tanggalPengajuan->Disabled && !isset($Grid->tanggalPengajuan->EditAttrs["readonly"]) && !isset($Grid->tanggalPengajuan->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fajuanproposalgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fajuanproposalgrid", "x<?= $Grid->RowIndex ?>_tanggalPengajuan", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_ajuanproposal_tanggalPengajuan" class="el_ajuanproposal_tanggalPengajuan">
<span<?= $Grid->tanggalPengajuan->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->tanggalPengajuan->getDisplayValue($Grid->tanggalPengajuan->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="ajuanproposal" data-field="x_tanggalPengajuan" data-hidden="1" name="x<?= $Grid->RowIndex ?>_tanggalPengajuan" id="x<?= $Grid->RowIndex ?>_tanggalPengajuan" value="<?= HtmlEncode($Grid->tanggalPengajuan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ajuanproposal" data-field="x_tanggalPengajuan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tanggalPengajuan" id="o<?= $Grid->RowIndex ?>_tanggalPengajuan" value="<?= HtmlEncode($Grid->tanggalPengajuan->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->status->Visible) { // status ?>
        <td data-name="status">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_ajuanproposal_status" class="el_ajuanproposal_status">
<template id="tp_x<?= $Grid->RowIndex ?>_status">
    <div class="form-check">
        <input type="radio" class="form-check-input" data-table="ajuanproposal" data-field="x_status" name="x<?= $Grid->RowIndex ?>_status" id="x<?= $Grid->RowIndex ?>_status"<?= $Grid->status->editAttributes() ?>>
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
    data-table="ajuanproposal"
    data-field="x_status"
    data-value-separator="<?= $Grid->status->displayValueSeparatorAttribute() ?>"
    <?= $Grid->status->editAttributes() ?>></selection-list>
<div class="invalid-feedback"><?= $Grid->status->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_ajuanproposal_status" class="el_ajuanproposal_status">
<span<?= $Grid->status->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->status->getDisplayValue($Grid->status->ViewValue) ?></span></span>
</span>
<input type="hidden" data-table="ajuanproposal" data-field="x_status" data-hidden="1" name="x<?= $Grid->RowIndex ?>_status" id="x<?= $Grid->RowIndex ?>_status" value="<?= HtmlEncode($Grid->status->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ajuanproposal" data-field="x_status" data-hidden="1" name="o<?= $Grid->RowIndex ?>_status" id="o<?= $Grid->RowIndex ?>_status" value="<?= HtmlEncode($Grid->status->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowIndex);
?>
<script>
loadjs.ready(["fajuanproposalgrid","load"], () => fajuanproposalgrid.updateLists(<?= $Grid->RowIndex ?>, true));
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
<input type="hidden" name="detailpage" value="fajuanproposalgrid">
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
    ew.addEventHandlers("ajuanproposal");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
