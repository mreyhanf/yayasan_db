<?php

namespace PHPMaker2022\project1;

// Set up and run Grid object
$Grid = Container("KontakdonaturGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fkontakdonaturgrid;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fkontakdonaturgrid = new ew.Form("fkontakdonaturgrid", "grid");
    fkontakdonaturgrid.formKeyCountName = "<?= $Grid->FormKeyCountName ?>";

    // Add fields
    var currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { kontakdonatur: currentTable } });
    var fields = currentTable.fields;
    fkontakdonaturgrid.addFields([
        ["kontak", [fields.kontak.visible && fields.kontak.required ? ew.Validators.required(fields.kontak.caption) : null], fields.kontak.isInvalid],
        ["idDonatur", [fields.idDonatur.visible && fields.idDonatur.required ? ew.Validators.required(fields.idDonatur.caption) : null], fields.idDonatur.isInvalid]
    ]);

    // Check empty row
    fkontakdonaturgrid.emptyRow = function (rowIndex) {
        var fobj = this.getForm(),
            fields = [["kontak",false],["idDonatur",false]];
        if (fields.some(field => ew.valueChanged(fobj, rowIndex, ...field)))
            return false;
        return true;
    }

    // Form_CustomValidate
    fkontakdonaturgrid.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fkontakdonaturgrid.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fkontakdonaturgrid.lists.idDonatur = <?= $Grid->idDonatur->toClientList($Grid) ?>;
    loadjs.done("fkontakdonaturgrid");
});
</script>
<?php } ?>
<?php
$Grid->renderOtherOptions();
?>
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> kontakdonatur">
<div id="fkontakdonaturgrid" class="ew-form ew-list-form">
<div id="gmp_kontakdonatur" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_kontakdonaturgrid" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
<?php if ($Grid->kontak->Visible) { // kontak ?>
        <th data-name="kontak" class="<?= $Grid->kontak->headerCellClass() ?>"><div id="elh_kontakdonatur_kontak" class="kontakdonatur_kontak"><?= $Grid->renderFieldHeader($Grid->kontak) ?></div></th>
<?php } ?>
<?php if ($Grid->idDonatur->Visible) { // idDonatur ?>
        <th data-name="idDonatur" class="<?= $Grid->idDonatur->headerCellClass() ?>"><div id="elh_kontakdonatur_idDonatur" class="kontakdonatur_idDonatur"><?= $Grid->renderFieldHeader($Grid->idDonatur) ?></div></th>
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
            "id" => "r" . $Grid->RowCount . "_kontakdonatur",
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
    <?php if ($Grid->kontak->Visible) { // kontak ?>
        <td data-name="kontak"<?= $Grid->kontak->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_kontakdonatur_kontak" class="el_kontakdonatur_kontak">
<input type="<?= $Grid->kontak->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_kontak" id="x<?= $Grid->RowIndex ?>_kontak" data-table="kontakdonatur" data-field="x_kontak" value="<?= $Grid->kontak->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->kontak->getPlaceHolder()) ?>"<?= $Grid->kontak->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->kontak->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="kontakdonatur" data-field="x_kontak" data-hidden="1" name="o<?= $Grid->RowIndex ?>_kontak" id="o<?= $Grid->RowIndex ?>_kontak" value="<?= HtmlEncode($Grid->kontak->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="<?= $Grid->kontak->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_kontak" id="x<?= $Grid->RowIndex ?>_kontak" data-table="kontakdonatur" data-field="x_kontak" value="<?= $Grid->kontak->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->kontak->getPlaceHolder()) ?>"<?= $Grid->kontak->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->kontak->getErrorMessage() ?></div>
<input type="hidden" data-table="kontakdonatur" data-field="x_kontak" data-hidden="1" name="o<?= $Grid->RowIndex ?>_kontak" id="o<?= $Grid->RowIndex ?>_kontak" value="<?= HtmlEncode($Grid->kontak->OldValue ?? $Grid->kontak->CurrentValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_kontakdonatur_kontak" class="el_kontakdonatur_kontak">
<span<?= $Grid->kontak->viewAttributes() ?>>
<?= $Grid->kontak->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="kontakdonatur" data-field="x_kontak" data-hidden="1" name="fkontakdonaturgrid$x<?= $Grid->RowIndex ?>_kontak" id="fkontakdonaturgrid$x<?= $Grid->RowIndex ?>_kontak" value="<?= HtmlEncode($Grid->kontak->FormValue) ?>">
<input type="hidden" data-table="kontakdonatur" data-field="x_kontak" data-hidden="1" name="fkontakdonaturgrid$o<?= $Grid->RowIndex ?>_kontak" id="fkontakdonaturgrid$o<?= $Grid->RowIndex ?>_kontak" value="<?= HtmlEncode($Grid->kontak->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="kontakdonatur" data-field="x_kontak" data-hidden="1" name="x<?= $Grid->RowIndex ?>_kontak" id="x<?= $Grid->RowIndex ?>_kontak" value="<?= HtmlEncode($Grid->kontak->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Grid->idDonatur->Visible) { // idDonatur ?>
        <td data-name="idDonatur"<?= $Grid->idDonatur->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($Grid->idDonatur->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_kontakdonatur_idDonatur" class="el_kontakdonatur_idDonatur">
<span<?= $Grid->idDonatur->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->idDonatur->getDisplayValue($Grid->idDonatur->ViewValue) ?></span></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_idDonatur" name="x<?= $Grid->RowIndex ?>_idDonatur" value="<?= HtmlEncode(FormatNumber($Grid->idDonatur->CurrentValue, $Grid->idDonatur->formatPattern())) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_kontakdonatur_idDonatur" class="el_kontakdonatur_idDonatur">
    <select
        id="x<?= $Grid->RowIndex ?>_idDonatur"
        name="x<?= $Grid->RowIndex ?>_idDonatur"
        class="form-select ew-select<?= $Grid->idDonatur->isInvalidClass() ?>"
        data-select2-id="fkontakdonaturgrid_x<?= $Grid->RowIndex ?>_idDonatur"
        data-table="kontakdonatur"
        data-field="x_idDonatur"
        data-value-separator="<?= $Grid->idDonatur->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->idDonatur->getPlaceHolder()) ?>"
        <?= $Grid->idDonatur->editAttributes() ?>>
        <?= $Grid->idDonatur->selectOptionListHtml("x{$Grid->RowIndex}_idDonatur") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->idDonatur->getErrorMessage() ?></div>
<?= $Grid->idDonatur->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_idDonatur") ?>
<script>
loadjs.ready("fkontakdonaturgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_idDonatur", selectId: "fkontakdonaturgrid_x<?= $Grid->RowIndex ?>_idDonatur" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fkontakdonaturgrid.lists.idDonatur.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_idDonatur", form: "fkontakdonaturgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_idDonatur", form: "fkontakdonaturgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.kontakdonatur.fields.idDonatur.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<input type="hidden" data-table="kontakdonatur" data-field="x_idDonatur" data-hidden="1" name="o<?= $Grid->RowIndex ?>_idDonatur" id="o<?= $Grid->RowIndex ?>_idDonatur" value="<?= HtmlEncode($Grid->idDonatur->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($Grid->idDonatur->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_kontakdonatur_idDonatur" class="el_kontakdonatur_idDonatur">
<span<?= $Grid->idDonatur->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->idDonatur->getDisplayValue($Grid->idDonatur->ViewValue) ?></span></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_idDonatur" name="x<?= $Grid->RowIndex ?>_idDonatur" value="<?= HtmlEncode(FormatNumber($Grid->idDonatur->CurrentValue, $Grid->idDonatur->formatPattern())) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_kontakdonatur_idDonatur" class="el_kontakdonatur_idDonatur">
    <select
        id="x<?= $Grid->RowIndex ?>_idDonatur"
        name="x<?= $Grid->RowIndex ?>_idDonatur"
        class="form-select ew-select<?= $Grid->idDonatur->isInvalidClass() ?>"
        data-select2-id="fkontakdonaturgrid_x<?= $Grid->RowIndex ?>_idDonatur"
        data-table="kontakdonatur"
        data-field="x_idDonatur"
        data-value-separator="<?= $Grid->idDonatur->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->idDonatur->getPlaceHolder()) ?>"
        <?= $Grid->idDonatur->editAttributes() ?>>
        <?= $Grid->idDonatur->selectOptionListHtml("x{$Grid->RowIndex}_idDonatur") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->idDonatur->getErrorMessage() ?></div>
<?= $Grid->idDonatur->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_idDonatur") ?>
<script>
loadjs.ready("fkontakdonaturgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_idDonatur", selectId: "fkontakdonaturgrid_x<?= $Grid->RowIndex ?>_idDonatur" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fkontakdonaturgrid.lists.idDonatur.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_idDonatur", form: "fkontakdonaturgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_idDonatur", form: "fkontakdonaturgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.kontakdonatur.fields.idDonatur.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_kontakdonatur_idDonatur" class="el_kontakdonatur_idDonatur">
<span<?= $Grid->idDonatur->viewAttributes() ?>>
<?= $Grid->idDonatur->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="kontakdonatur" data-field="x_idDonatur" data-hidden="1" name="fkontakdonaturgrid$x<?= $Grid->RowIndex ?>_idDonatur" id="fkontakdonaturgrid$x<?= $Grid->RowIndex ?>_idDonatur" value="<?= HtmlEncode($Grid->idDonatur->FormValue) ?>">
<input type="hidden" data-table="kontakdonatur" data-field="x_idDonatur" data-hidden="1" name="fkontakdonaturgrid$o<?= $Grid->RowIndex ?>_idDonatur" id="fkontakdonaturgrid$o<?= $Grid->RowIndex ?>_idDonatur" value="<?= HtmlEncode($Grid->idDonatur->OldValue) ?>">
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
loadjs.ready(["fkontakdonaturgrid","load"], () => fkontakdonaturgrid.updateLists(<?= $Grid->RowIndex ?>));
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
    $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowIndex, "id" => "r0_kontakdonatur", "data-rowtype" => ROWTYPE_ADD]);
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
    <?php if ($Grid->kontak->Visible) { // kontak ?>
        <td data-name="kontak">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_kontakdonatur_kontak" class="el_kontakdonatur_kontak">
<input type="<?= $Grid->kontak->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_kontak" id="x<?= $Grid->RowIndex ?>_kontak" data-table="kontakdonatur" data-field="x_kontak" value="<?= $Grid->kontak->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->kontak->getPlaceHolder()) ?>"<?= $Grid->kontak->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->kontak->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_kontakdonatur_kontak" class="el_kontakdonatur_kontak">
<span<?= $Grid->kontak->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->kontak->getDisplayValue($Grid->kontak->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="kontakdonatur" data-field="x_kontak" data-hidden="1" name="x<?= $Grid->RowIndex ?>_kontak" id="x<?= $Grid->RowIndex ?>_kontak" value="<?= HtmlEncode($Grid->kontak->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="kontakdonatur" data-field="x_kontak" data-hidden="1" name="o<?= $Grid->RowIndex ?>_kontak" id="o<?= $Grid->RowIndex ?>_kontak" value="<?= HtmlEncode($Grid->kontak->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->idDonatur->Visible) { // idDonatur ?>
        <td data-name="idDonatur">
<?php if (!$Grid->isConfirm()) { ?>
<?php if ($Grid->idDonatur->getSessionValue() != "") { ?>
<span id="el$rowindex$_kontakdonatur_idDonatur" class="el_kontakdonatur_idDonatur">
<span<?= $Grid->idDonatur->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->idDonatur->getDisplayValue($Grid->idDonatur->ViewValue) ?></span></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_idDonatur" name="x<?= $Grid->RowIndex ?>_idDonatur" value="<?= HtmlEncode(FormatNumber($Grid->idDonatur->CurrentValue, $Grid->idDonatur->formatPattern())) ?>" data-hidden="1">
<?php } else { ?>
<span id="el$rowindex$_kontakdonatur_idDonatur" class="el_kontakdonatur_idDonatur">
    <select
        id="x<?= $Grid->RowIndex ?>_idDonatur"
        name="x<?= $Grid->RowIndex ?>_idDonatur"
        class="form-select ew-select<?= $Grid->idDonatur->isInvalidClass() ?>"
        data-select2-id="fkontakdonaturgrid_x<?= $Grid->RowIndex ?>_idDonatur"
        data-table="kontakdonatur"
        data-field="x_idDonatur"
        data-value-separator="<?= $Grid->idDonatur->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->idDonatur->getPlaceHolder()) ?>"
        <?= $Grid->idDonatur->editAttributes() ?>>
        <?= $Grid->idDonatur->selectOptionListHtml("x{$Grid->RowIndex}_idDonatur") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->idDonatur->getErrorMessage() ?></div>
<?= $Grid->idDonatur->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_idDonatur") ?>
<script>
loadjs.ready("fkontakdonaturgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_idDonatur", selectId: "fkontakdonaturgrid_x<?= $Grid->RowIndex ?>_idDonatur" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fkontakdonaturgrid.lists.idDonatur.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_idDonatur", form: "fkontakdonaturgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_idDonatur", form: "fkontakdonaturgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.kontakdonatur.fields.idDonatur.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_kontakdonatur_idDonatur" class="el_kontakdonatur_idDonatur">
<span<?= $Grid->idDonatur->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->idDonatur->getDisplayValue($Grid->idDonatur->ViewValue) ?></span></span>
</span>
<input type="hidden" data-table="kontakdonatur" data-field="x_idDonatur" data-hidden="1" name="x<?= $Grid->RowIndex ?>_idDonatur" id="x<?= $Grid->RowIndex ?>_idDonatur" value="<?= HtmlEncode($Grid->idDonatur->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="kontakdonatur" data-field="x_idDonatur" data-hidden="1" name="o<?= $Grid->RowIndex ?>_idDonatur" id="o<?= $Grid->RowIndex ?>_idDonatur" value="<?= HtmlEncode($Grid->idDonatur->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowIndex);
?>
<script>
loadjs.ready(["fkontakdonaturgrid","load"], () => fkontakdonaturgrid.updateLists(<?= $Grid->RowIndex ?>, true));
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
<input type="hidden" name="detailpage" value="fkontakdonaturgrid">
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
    ew.addEventHandlers("kontakdonatur");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
