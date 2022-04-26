<?php

namespace PHPMaker2022\project1;

// Set up and run Grid object
$Grid = Container("DonasiGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fdonasigrid;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fdonasigrid = new ew.Form("fdonasigrid", "grid");
    fdonasigrid.formKeyCountName = "<?= $Grid->FormKeyCountName ?>";

    // Add fields
    var currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { donasi: currentTable } });
    var fields = currentTable.fields;
    fdonasigrid.addFields([
        ["idDonasi", [fields.idDonasi.visible && fields.idDonasi.required ? ew.Validators.required(fields.idDonasi.caption) : null], fields.idDonasi.isInvalid],
        ["idDonatur", [fields.idDonatur.visible && fields.idDonatur.required ? ew.Validators.required(fields.idDonatur.caption) : null], fields.idDonatur.isInvalid],
        ["nominal", [fields.nominal.visible && fields.nominal.required ? ew.Validators.required(fields.nominal.caption) : null, ew.Validators.integer], fields.nominal.isInvalid],
        ["idProyek", [fields.idProyek.visible && fields.idProyek.required ? ew.Validators.required(fields.idProyek.caption) : null], fields.idProyek.isInvalid],
        ["waktu", [fields.waktu.visible && fields.waktu.required ? ew.Validators.required(fields.waktu.caption) : null, ew.Validators.datetime(fields.waktu.clientFormatPattern)], fields.waktu.isInvalid]
    ]);

    // Check empty row
    fdonasigrid.emptyRow = function (rowIndex) {
        var fobj = this.getForm(),
            fields = [["idDonatur",false],["nominal",false],["idProyek",false],["waktu",false]];
        if (fields.some(field => ew.valueChanged(fobj, rowIndex, ...field)))
            return false;
        return true;
    }

    // Form_CustomValidate
    fdonasigrid.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fdonasigrid.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fdonasigrid.lists.idDonatur = <?= $Grid->idDonatur->toClientList($Grid) ?>;
    fdonasigrid.lists.idProyek = <?= $Grid->idProyek->toClientList($Grid) ?>;
    loadjs.done("fdonasigrid");
});
</script>
<?php } ?>
<?php
$Grid->renderOtherOptions();
?>
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> donasi">
<div id="fdonasigrid" class="ew-form ew-list-form">
<div id="gmp_donasi" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_donasigrid" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
<?php if ($Grid->idDonasi->Visible) { // idDonasi ?>
        <th data-name="idDonasi" class="<?= $Grid->idDonasi->headerCellClass() ?>"><div id="elh_donasi_idDonasi" class="donasi_idDonasi"><?= $Grid->renderFieldHeader($Grid->idDonasi) ?></div></th>
<?php } ?>
<?php if ($Grid->idDonatur->Visible) { // idDonatur ?>
        <th data-name="idDonatur" class="<?= $Grid->idDonatur->headerCellClass() ?>"><div id="elh_donasi_idDonatur" class="donasi_idDonatur"><?= $Grid->renderFieldHeader($Grid->idDonatur) ?></div></th>
<?php } ?>
<?php if ($Grid->nominal->Visible) { // nominal ?>
        <th data-name="nominal" class="<?= $Grid->nominal->headerCellClass() ?>"><div id="elh_donasi_nominal" class="donasi_nominal"><?= $Grid->renderFieldHeader($Grid->nominal) ?></div></th>
<?php } ?>
<?php if ($Grid->idProyek->Visible) { // idProyek ?>
        <th data-name="idProyek" class="<?= $Grid->idProyek->headerCellClass() ?>"><div id="elh_donasi_idProyek" class="donasi_idProyek"><?= $Grid->renderFieldHeader($Grid->idProyek) ?></div></th>
<?php } ?>
<?php if ($Grid->waktu->Visible) { // waktu ?>
        <th data-name="waktu" class="<?= $Grid->waktu->headerCellClass() ?>"><div id="elh_donasi_waktu" class="donasi_waktu"><?= $Grid->renderFieldHeader($Grid->waktu) ?></div></th>
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
            "id" => "r" . $Grid->RowCount . "_donasi",
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
    <?php if ($Grid->idDonasi->Visible) { // idDonasi ?>
        <td data-name="idDonasi"<?= $Grid->idDonasi->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_donasi_idDonasi" class="el_donasi_idDonasi"></span>
<input type="hidden" data-table="donasi" data-field="x_idDonasi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_idDonasi" id="o<?= $Grid->RowIndex ?>_idDonasi" value="<?= HtmlEncode($Grid->idDonasi->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_donasi_idDonasi" class="el_donasi_idDonasi">
<span<?= $Grid->idDonasi->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->idDonasi->getDisplayValue($Grid->idDonasi->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="donasi" data-field="x_idDonasi" data-hidden="1" name="x<?= $Grid->RowIndex ?>_idDonasi" id="x<?= $Grid->RowIndex ?>_idDonasi" value="<?= HtmlEncode($Grid->idDonasi->CurrentValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_donasi_idDonasi" class="el_donasi_idDonasi">
<span<?= $Grid->idDonasi->viewAttributes() ?>>
<?= $Grid->idDonasi->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="donasi" data-field="x_idDonasi" data-hidden="1" name="fdonasigrid$x<?= $Grid->RowIndex ?>_idDonasi" id="fdonasigrid$x<?= $Grid->RowIndex ?>_idDonasi" value="<?= HtmlEncode($Grid->idDonasi->FormValue) ?>">
<input type="hidden" data-table="donasi" data-field="x_idDonasi" data-hidden="1" name="fdonasigrid$o<?= $Grid->RowIndex ?>_idDonasi" id="fdonasigrid$o<?= $Grid->RowIndex ?>_idDonasi" value="<?= HtmlEncode($Grid->idDonasi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="donasi" data-field="x_idDonasi" data-hidden="1" name="x<?= $Grid->RowIndex ?>_idDonasi" id="x<?= $Grid->RowIndex ?>_idDonasi" value="<?= HtmlEncode($Grid->idDonasi->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Grid->idDonatur->Visible) { // idDonatur ?>
        <td data-name="idDonatur"<?= $Grid->idDonatur->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($Grid->idDonatur->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_donasi_idDonatur" class="el_donasi_idDonatur">
<span<?= $Grid->idDonatur->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->idDonatur->getDisplayValue($Grid->idDonatur->ViewValue) ?></span></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_idDonatur" name="x<?= $Grid->RowIndex ?>_idDonatur" value="<?= HtmlEncode(FormatNumber($Grid->idDonatur->CurrentValue, $Grid->idDonatur->formatPattern())) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_donasi_idDonatur" class="el_donasi_idDonatur">
    <select
        id="x<?= $Grid->RowIndex ?>_idDonatur"
        name="x<?= $Grid->RowIndex ?>_idDonatur"
        class="form-select ew-select<?= $Grid->idDonatur->isInvalidClass() ?>"
        data-select2-id="fdonasigrid_x<?= $Grid->RowIndex ?>_idDonatur"
        data-table="donasi"
        data-field="x_idDonatur"
        data-value-separator="<?= $Grid->idDonatur->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->idDonatur->getPlaceHolder()) ?>"
        <?= $Grid->idDonatur->editAttributes() ?>>
        <?= $Grid->idDonatur->selectOptionListHtml("x{$Grid->RowIndex}_idDonatur") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->idDonatur->getErrorMessage() ?></div>
<?= $Grid->idDonatur->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_idDonatur") ?>
<script>
loadjs.ready("fdonasigrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_idDonatur", selectId: "fdonasigrid_x<?= $Grid->RowIndex ?>_idDonatur" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fdonasigrid.lists.idDonatur.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_idDonatur", form: "fdonasigrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_idDonatur", form: "fdonasigrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.donasi.fields.idDonatur.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<input type="hidden" data-table="donasi" data-field="x_idDonatur" data-hidden="1" name="o<?= $Grid->RowIndex ?>_idDonatur" id="o<?= $Grid->RowIndex ?>_idDonatur" value="<?= HtmlEncode($Grid->idDonatur->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($Grid->idDonatur->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_donasi_idDonatur" class="el_donasi_idDonatur">
<span<?= $Grid->idDonatur->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->idDonatur->getDisplayValue($Grid->idDonatur->ViewValue) ?></span></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_idDonatur" name="x<?= $Grid->RowIndex ?>_idDonatur" value="<?= HtmlEncode(FormatNumber($Grid->idDonatur->CurrentValue, $Grid->idDonatur->formatPattern())) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_donasi_idDonatur" class="el_donasi_idDonatur">
    <select
        id="x<?= $Grid->RowIndex ?>_idDonatur"
        name="x<?= $Grid->RowIndex ?>_idDonatur"
        class="form-select ew-select<?= $Grid->idDonatur->isInvalidClass() ?>"
        data-select2-id="fdonasigrid_x<?= $Grid->RowIndex ?>_idDonatur"
        data-table="donasi"
        data-field="x_idDonatur"
        data-value-separator="<?= $Grid->idDonatur->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->idDonatur->getPlaceHolder()) ?>"
        <?= $Grid->idDonatur->editAttributes() ?>>
        <?= $Grid->idDonatur->selectOptionListHtml("x{$Grid->RowIndex}_idDonatur") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->idDonatur->getErrorMessage() ?></div>
<?= $Grid->idDonatur->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_idDonatur") ?>
<script>
loadjs.ready("fdonasigrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_idDonatur", selectId: "fdonasigrid_x<?= $Grid->RowIndex ?>_idDonatur" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fdonasigrid.lists.idDonatur.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_idDonatur", form: "fdonasigrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_idDonatur", form: "fdonasigrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.donasi.fields.idDonatur.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_donasi_idDonatur" class="el_donasi_idDonatur">
<span<?= $Grid->idDonatur->viewAttributes() ?>>
<?= $Grid->idDonatur->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="donasi" data-field="x_idDonatur" data-hidden="1" name="fdonasigrid$x<?= $Grid->RowIndex ?>_idDonatur" id="fdonasigrid$x<?= $Grid->RowIndex ?>_idDonatur" value="<?= HtmlEncode($Grid->idDonatur->FormValue) ?>">
<input type="hidden" data-table="donasi" data-field="x_idDonatur" data-hidden="1" name="fdonasigrid$o<?= $Grid->RowIndex ?>_idDonatur" id="fdonasigrid$o<?= $Grid->RowIndex ?>_idDonatur" value="<?= HtmlEncode($Grid->idDonatur->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->nominal->Visible) { // nominal ?>
        <td data-name="nominal"<?= $Grid->nominal->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_donasi_nominal" class="el_donasi_nominal">
<input type="<?= $Grid->nominal->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_nominal" id="x<?= $Grid->RowIndex ?>_nominal" data-table="donasi" data-field="x_nominal" value="<?= $Grid->nominal->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->nominal->getPlaceHolder()) ?>"<?= $Grid->nominal->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->nominal->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="donasi" data-field="x_nominal" data-hidden="1" name="o<?= $Grid->RowIndex ?>_nominal" id="o<?= $Grid->RowIndex ?>_nominal" value="<?= HtmlEncode($Grid->nominal->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_donasi_nominal" class="el_donasi_nominal">
<input type="<?= $Grid->nominal->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_nominal" id="x<?= $Grid->RowIndex ?>_nominal" data-table="donasi" data-field="x_nominal" value="<?= $Grid->nominal->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->nominal->getPlaceHolder()) ?>"<?= $Grid->nominal->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->nominal->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_donasi_nominal" class="el_donasi_nominal">
<span<?= $Grid->nominal->viewAttributes() ?>>
<?= $Grid->nominal->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="donasi" data-field="x_nominal" data-hidden="1" name="fdonasigrid$x<?= $Grid->RowIndex ?>_nominal" id="fdonasigrid$x<?= $Grid->RowIndex ?>_nominal" value="<?= HtmlEncode($Grid->nominal->FormValue) ?>">
<input type="hidden" data-table="donasi" data-field="x_nominal" data-hidden="1" name="fdonasigrid$o<?= $Grid->RowIndex ?>_nominal" id="fdonasigrid$o<?= $Grid->RowIndex ?>_nominal" value="<?= HtmlEncode($Grid->nominal->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->idProyek->Visible) { // idProyek ?>
        <td data-name="idProyek"<?= $Grid->idProyek->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_donasi_idProyek" class="el_donasi_idProyek">
    <select
        id="x<?= $Grid->RowIndex ?>_idProyek"
        name="x<?= $Grid->RowIndex ?>_idProyek"
        class="form-select ew-select<?= $Grid->idProyek->isInvalidClass() ?>"
        data-select2-id="fdonasigrid_x<?= $Grid->RowIndex ?>_idProyek"
        data-table="donasi"
        data-field="x_idProyek"
        data-value-separator="<?= $Grid->idProyek->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->idProyek->getPlaceHolder()) ?>"
        <?= $Grid->idProyek->editAttributes() ?>>
        <?= $Grid->idProyek->selectOptionListHtml("x{$Grid->RowIndex}_idProyek") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->idProyek->getErrorMessage() ?></div>
<?= $Grid->idProyek->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_idProyek") ?>
<script>
loadjs.ready("fdonasigrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_idProyek", selectId: "fdonasigrid_x<?= $Grid->RowIndex ?>_idProyek" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fdonasigrid.lists.idProyek.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_idProyek", form: "fdonasigrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_idProyek", form: "fdonasigrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.donasi.fields.idProyek.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<input type="hidden" data-table="donasi" data-field="x_idProyek" data-hidden="1" name="o<?= $Grid->RowIndex ?>_idProyek" id="o<?= $Grid->RowIndex ?>_idProyek" value="<?= HtmlEncode($Grid->idProyek->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_donasi_idProyek" class="el_donasi_idProyek">
    <select
        id="x<?= $Grid->RowIndex ?>_idProyek"
        name="x<?= $Grid->RowIndex ?>_idProyek"
        class="form-select ew-select<?= $Grid->idProyek->isInvalidClass() ?>"
        data-select2-id="fdonasigrid_x<?= $Grid->RowIndex ?>_idProyek"
        data-table="donasi"
        data-field="x_idProyek"
        data-value-separator="<?= $Grid->idProyek->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->idProyek->getPlaceHolder()) ?>"
        <?= $Grid->idProyek->editAttributes() ?>>
        <?= $Grid->idProyek->selectOptionListHtml("x{$Grid->RowIndex}_idProyek") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->idProyek->getErrorMessage() ?></div>
<?= $Grid->idProyek->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_idProyek") ?>
<script>
loadjs.ready("fdonasigrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_idProyek", selectId: "fdonasigrid_x<?= $Grid->RowIndex ?>_idProyek" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fdonasigrid.lists.idProyek.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_idProyek", form: "fdonasigrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_idProyek", form: "fdonasigrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.donasi.fields.idProyek.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_donasi_idProyek" class="el_donasi_idProyek">
<span<?= $Grid->idProyek->viewAttributes() ?>>
<?= $Grid->idProyek->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="donasi" data-field="x_idProyek" data-hidden="1" name="fdonasigrid$x<?= $Grid->RowIndex ?>_idProyek" id="fdonasigrid$x<?= $Grid->RowIndex ?>_idProyek" value="<?= HtmlEncode($Grid->idProyek->FormValue) ?>">
<input type="hidden" data-table="donasi" data-field="x_idProyek" data-hidden="1" name="fdonasigrid$o<?= $Grid->RowIndex ?>_idProyek" id="fdonasigrid$o<?= $Grid->RowIndex ?>_idProyek" value="<?= HtmlEncode($Grid->idProyek->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->waktu->Visible) { // waktu ?>
        <td data-name="waktu"<?= $Grid->waktu->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_donasi_waktu" class="el_donasi_waktu">
<input type="<?= $Grid->waktu->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_waktu" id="x<?= $Grid->RowIndex ?>_waktu" data-table="donasi" data-field="x_waktu" value="<?= $Grid->waktu->EditValue ?>" placeholder="<?= HtmlEncode($Grid->waktu->getPlaceHolder()) ?>"<?= $Grid->waktu->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->waktu->getErrorMessage() ?></div>
<?php if (!$Grid->waktu->ReadOnly && !$Grid->waktu->Disabled && !isset($Grid->waktu->EditAttrs["readonly"]) && !isset($Grid->waktu->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdonasigrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fdonasigrid", "x<?= $Grid->RowIndex ?>_waktu", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="donasi" data-field="x_waktu" data-hidden="1" name="o<?= $Grid->RowIndex ?>_waktu" id="o<?= $Grid->RowIndex ?>_waktu" value="<?= HtmlEncode($Grid->waktu->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_donasi_waktu" class="el_donasi_waktu">
<input type="<?= $Grid->waktu->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_waktu" id="x<?= $Grid->RowIndex ?>_waktu" data-table="donasi" data-field="x_waktu" value="<?= $Grid->waktu->EditValue ?>" placeholder="<?= HtmlEncode($Grid->waktu->getPlaceHolder()) ?>"<?= $Grid->waktu->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->waktu->getErrorMessage() ?></div>
<?php if (!$Grid->waktu->ReadOnly && !$Grid->waktu->Disabled && !isset($Grid->waktu->EditAttrs["readonly"]) && !isset($Grid->waktu->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdonasigrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fdonasigrid", "x<?= $Grid->RowIndex ?>_waktu", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_donasi_waktu" class="el_donasi_waktu">
<span<?= $Grid->waktu->viewAttributes() ?>>
<?= $Grid->waktu->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="donasi" data-field="x_waktu" data-hidden="1" name="fdonasigrid$x<?= $Grid->RowIndex ?>_waktu" id="fdonasigrid$x<?= $Grid->RowIndex ?>_waktu" value="<?= HtmlEncode($Grid->waktu->FormValue) ?>">
<input type="hidden" data-table="donasi" data-field="x_waktu" data-hidden="1" name="fdonasigrid$o<?= $Grid->RowIndex ?>_waktu" id="fdonasigrid$o<?= $Grid->RowIndex ?>_waktu" value="<?= HtmlEncode($Grid->waktu->OldValue) ?>">
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
loadjs.ready(["fdonasigrid","load"], () => fdonasigrid.updateLists(<?= $Grid->RowIndex ?>));
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
    $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowIndex, "id" => "r0_donasi", "data-rowtype" => ROWTYPE_ADD]);
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
    <?php if ($Grid->idDonasi->Visible) { // idDonasi ?>
        <td data-name="idDonasi">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_donasi_idDonasi" class="el_donasi_idDonasi"></span>
<?php } else { ?>
<span id="el$rowindex$_donasi_idDonasi" class="el_donasi_idDonasi">
<span<?= $Grid->idDonasi->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->idDonasi->getDisplayValue($Grid->idDonasi->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="donasi" data-field="x_idDonasi" data-hidden="1" name="x<?= $Grid->RowIndex ?>_idDonasi" id="x<?= $Grid->RowIndex ?>_idDonasi" value="<?= HtmlEncode($Grid->idDonasi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="donasi" data-field="x_idDonasi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_idDonasi" id="o<?= $Grid->RowIndex ?>_idDonasi" value="<?= HtmlEncode($Grid->idDonasi->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->idDonatur->Visible) { // idDonatur ?>
        <td data-name="idDonatur">
<?php if (!$Grid->isConfirm()) { ?>
<?php if ($Grid->idDonatur->getSessionValue() != "") { ?>
<span id="el$rowindex$_donasi_idDonatur" class="el_donasi_idDonatur">
<span<?= $Grid->idDonatur->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->idDonatur->getDisplayValue($Grid->idDonatur->ViewValue) ?></span></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_idDonatur" name="x<?= $Grid->RowIndex ?>_idDonatur" value="<?= HtmlEncode(FormatNumber($Grid->idDonatur->CurrentValue, $Grid->idDonatur->formatPattern())) ?>" data-hidden="1">
<?php } else { ?>
<span id="el$rowindex$_donasi_idDonatur" class="el_donasi_idDonatur">
    <select
        id="x<?= $Grid->RowIndex ?>_idDonatur"
        name="x<?= $Grid->RowIndex ?>_idDonatur"
        class="form-select ew-select<?= $Grid->idDonatur->isInvalidClass() ?>"
        data-select2-id="fdonasigrid_x<?= $Grid->RowIndex ?>_idDonatur"
        data-table="donasi"
        data-field="x_idDonatur"
        data-value-separator="<?= $Grid->idDonatur->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->idDonatur->getPlaceHolder()) ?>"
        <?= $Grid->idDonatur->editAttributes() ?>>
        <?= $Grid->idDonatur->selectOptionListHtml("x{$Grid->RowIndex}_idDonatur") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->idDonatur->getErrorMessage() ?></div>
<?= $Grid->idDonatur->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_idDonatur") ?>
<script>
loadjs.ready("fdonasigrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_idDonatur", selectId: "fdonasigrid_x<?= $Grid->RowIndex ?>_idDonatur" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fdonasigrid.lists.idDonatur.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_idDonatur", form: "fdonasigrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_idDonatur", form: "fdonasigrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.donasi.fields.idDonatur.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_donasi_idDonatur" class="el_donasi_idDonatur">
<span<?= $Grid->idDonatur->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->idDonatur->getDisplayValue($Grid->idDonatur->ViewValue) ?></span></span>
</span>
<input type="hidden" data-table="donasi" data-field="x_idDonatur" data-hidden="1" name="x<?= $Grid->RowIndex ?>_idDonatur" id="x<?= $Grid->RowIndex ?>_idDonatur" value="<?= HtmlEncode($Grid->idDonatur->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="donasi" data-field="x_idDonatur" data-hidden="1" name="o<?= $Grid->RowIndex ?>_idDonatur" id="o<?= $Grid->RowIndex ?>_idDonatur" value="<?= HtmlEncode($Grid->idDonatur->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->nominal->Visible) { // nominal ?>
        <td data-name="nominal">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_donasi_nominal" class="el_donasi_nominal">
<input type="<?= $Grid->nominal->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_nominal" id="x<?= $Grid->RowIndex ?>_nominal" data-table="donasi" data-field="x_nominal" value="<?= $Grid->nominal->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->nominal->getPlaceHolder()) ?>"<?= $Grid->nominal->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->nominal->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_donasi_nominal" class="el_donasi_nominal">
<span<?= $Grid->nominal->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->nominal->getDisplayValue($Grid->nominal->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="donasi" data-field="x_nominal" data-hidden="1" name="x<?= $Grid->RowIndex ?>_nominal" id="x<?= $Grid->RowIndex ?>_nominal" value="<?= HtmlEncode($Grid->nominal->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="donasi" data-field="x_nominal" data-hidden="1" name="o<?= $Grid->RowIndex ?>_nominal" id="o<?= $Grid->RowIndex ?>_nominal" value="<?= HtmlEncode($Grid->nominal->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->idProyek->Visible) { // idProyek ?>
        <td data-name="idProyek">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_donasi_idProyek" class="el_donasi_idProyek">
    <select
        id="x<?= $Grid->RowIndex ?>_idProyek"
        name="x<?= $Grid->RowIndex ?>_idProyek"
        class="form-select ew-select<?= $Grid->idProyek->isInvalidClass() ?>"
        data-select2-id="fdonasigrid_x<?= $Grid->RowIndex ?>_idProyek"
        data-table="donasi"
        data-field="x_idProyek"
        data-value-separator="<?= $Grid->idProyek->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->idProyek->getPlaceHolder()) ?>"
        <?= $Grid->idProyek->editAttributes() ?>>
        <?= $Grid->idProyek->selectOptionListHtml("x{$Grid->RowIndex}_idProyek") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->idProyek->getErrorMessage() ?></div>
<?= $Grid->idProyek->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_idProyek") ?>
<script>
loadjs.ready("fdonasigrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_idProyek", selectId: "fdonasigrid_x<?= $Grid->RowIndex ?>_idProyek" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fdonasigrid.lists.idProyek.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_idProyek", form: "fdonasigrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_idProyek", form: "fdonasigrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.donasi.fields.idProyek.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } else { ?>
<span id="el$rowindex$_donasi_idProyek" class="el_donasi_idProyek">
<span<?= $Grid->idProyek->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->idProyek->getDisplayValue($Grid->idProyek->ViewValue) ?></span></span>
</span>
<input type="hidden" data-table="donasi" data-field="x_idProyek" data-hidden="1" name="x<?= $Grid->RowIndex ?>_idProyek" id="x<?= $Grid->RowIndex ?>_idProyek" value="<?= HtmlEncode($Grid->idProyek->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="donasi" data-field="x_idProyek" data-hidden="1" name="o<?= $Grid->RowIndex ?>_idProyek" id="o<?= $Grid->RowIndex ?>_idProyek" value="<?= HtmlEncode($Grid->idProyek->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->waktu->Visible) { // waktu ?>
        <td data-name="waktu">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_donasi_waktu" class="el_donasi_waktu">
<input type="<?= $Grid->waktu->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_waktu" id="x<?= $Grid->RowIndex ?>_waktu" data-table="donasi" data-field="x_waktu" value="<?= $Grid->waktu->EditValue ?>" placeholder="<?= HtmlEncode($Grid->waktu->getPlaceHolder()) ?>"<?= $Grid->waktu->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->waktu->getErrorMessage() ?></div>
<?php if (!$Grid->waktu->ReadOnly && !$Grid->waktu->Disabled && !isset($Grid->waktu->EditAttrs["readonly"]) && !isset($Grid->waktu->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdonasigrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fdonasigrid", "x<?= $Grid->RowIndex ?>_waktu", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_donasi_waktu" class="el_donasi_waktu">
<span<?= $Grid->waktu->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->waktu->getDisplayValue($Grid->waktu->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="donasi" data-field="x_waktu" data-hidden="1" name="x<?= $Grid->RowIndex ?>_waktu" id="x<?= $Grid->RowIndex ?>_waktu" value="<?= HtmlEncode($Grid->waktu->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="donasi" data-field="x_waktu" data-hidden="1" name="o<?= $Grid->RowIndex ?>_waktu" id="o<?= $Grid->RowIndex ?>_waktu" value="<?= HtmlEncode($Grid->waktu->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowIndex);
?>
<script>
loadjs.ready(["fdonasigrid","load"], () => fdonasigrid.updateLists(<?= $Grid->RowIndex ?>, true));
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
<input type="hidden" name="detailpage" value="fdonasigrid">
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
    ew.addEventHandlers("donasi");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
