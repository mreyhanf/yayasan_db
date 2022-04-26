<?php

namespace PHPMaker2022\project1;

// Set up and run Grid object
$Grid = Container("KontakajuanproyekGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fkontakajuanproyekgrid;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fkontakajuanproyekgrid = new ew.Form("fkontakajuanproyekgrid", "grid");
    fkontakajuanproyekgrid.formKeyCountName = "<?= $Grid->FormKeyCountName ?>";

    // Add fields
    var currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { kontakajuanproyek: currentTable } });
    var fields = currentTable.fields;
    fkontakajuanproyekgrid.addFields([
        ["kontak", [fields.kontak.visible && fields.kontak.required ? ew.Validators.required(fields.kontak.caption) : null], fields.kontak.isInvalid],
        ["idAjuanProyek", [fields.idAjuanProyek.visible && fields.idAjuanProyek.required ? ew.Validators.required(fields.idAjuanProyek.caption) : null], fields.idAjuanProyek.isInvalid]
    ]);

    // Check empty row
    fkontakajuanproyekgrid.emptyRow = function (rowIndex) {
        var fobj = this.getForm(),
            fields = [["kontak",false],["idAjuanProyek",false]];
        if (fields.some(field => ew.valueChanged(fobj, rowIndex, ...field)))
            return false;
        return true;
    }

    // Form_CustomValidate
    fkontakajuanproyekgrid.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fkontakajuanproyekgrid.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fkontakajuanproyekgrid.lists.idAjuanProyek = <?= $Grid->idAjuanProyek->toClientList($Grid) ?>;
    loadjs.done("fkontakajuanproyekgrid");
});
</script>
<?php } ?>
<?php
$Grid->renderOtherOptions();
?>
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> kontakajuanproyek">
<div id="fkontakajuanproyekgrid" class="ew-form ew-list-form">
<div id="gmp_kontakajuanproyek" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_kontakajuanproyekgrid" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
        <th data-name="kontak" class="<?= $Grid->kontak->headerCellClass() ?>"><div id="elh_kontakajuanproyek_kontak" class="kontakajuanproyek_kontak"><?= $Grid->renderFieldHeader($Grid->kontak) ?></div></th>
<?php } ?>
<?php if ($Grid->idAjuanProyek->Visible) { // idAjuanProyek ?>
        <th data-name="idAjuanProyek" class="<?= $Grid->idAjuanProyek->headerCellClass() ?>"><div id="elh_kontakajuanproyek_idAjuanProyek" class="kontakajuanproyek_idAjuanProyek"><?= $Grid->renderFieldHeader($Grid->idAjuanProyek) ?></div></th>
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
            "id" => "r" . $Grid->RowCount . "_kontakajuanproyek",
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
<span id="el<?= $Grid->RowCount ?>_kontakajuanproyek_kontak" class="el_kontakajuanproyek_kontak">
<input type="<?= $Grid->kontak->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_kontak" id="x<?= $Grid->RowIndex ?>_kontak" data-table="kontakajuanproyek" data-field="x_kontak" value="<?= $Grid->kontak->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->kontak->getPlaceHolder()) ?>"<?= $Grid->kontak->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->kontak->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="kontakajuanproyek" data-field="x_kontak" data-hidden="1" name="o<?= $Grid->RowIndex ?>_kontak" id="o<?= $Grid->RowIndex ?>_kontak" value="<?= HtmlEncode($Grid->kontak->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="<?= $Grid->kontak->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_kontak" id="x<?= $Grid->RowIndex ?>_kontak" data-table="kontakajuanproyek" data-field="x_kontak" value="<?= $Grid->kontak->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->kontak->getPlaceHolder()) ?>"<?= $Grid->kontak->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->kontak->getErrorMessage() ?></div>
<input type="hidden" data-table="kontakajuanproyek" data-field="x_kontak" data-hidden="1" name="o<?= $Grid->RowIndex ?>_kontak" id="o<?= $Grid->RowIndex ?>_kontak" value="<?= HtmlEncode($Grid->kontak->OldValue ?? $Grid->kontak->CurrentValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_kontakajuanproyek_kontak" class="el_kontakajuanproyek_kontak">
<span<?= $Grid->kontak->viewAttributes() ?>>
<?= $Grid->kontak->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="kontakajuanproyek" data-field="x_kontak" data-hidden="1" name="fkontakajuanproyekgrid$x<?= $Grid->RowIndex ?>_kontak" id="fkontakajuanproyekgrid$x<?= $Grid->RowIndex ?>_kontak" value="<?= HtmlEncode($Grid->kontak->FormValue) ?>">
<input type="hidden" data-table="kontakajuanproyek" data-field="x_kontak" data-hidden="1" name="fkontakajuanproyekgrid$o<?= $Grid->RowIndex ?>_kontak" id="fkontakajuanproyekgrid$o<?= $Grid->RowIndex ?>_kontak" value="<?= HtmlEncode($Grid->kontak->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="kontakajuanproyek" data-field="x_kontak" data-hidden="1" name="x<?= $Grid->RowIndex ?>_kontak" id="x<?= $Grid->RowIndex ?>_kontak" value="<?= HtmlEncode($Grid->kontak->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Grid->idAjuanProyek->Visible) { // idAjuanProyek ?>
        <td data-name="idAjuanProyek"<?= $Grid->idAjuanProyek->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($Grid->idAjuanProyek->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_kontakajuanproyek_idAjuanProyek" class="el_kontakajuanproyek_idAjuanProyek">
<span<?= $Grid->idAjuanProyek->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->idAjuanProyek->getDisplayValue($Grid->idAjuanProyek->ViewValue) ?></span></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_idAjuanProyek" name="x<?= $Grid->RowIndex ?>_idAjuanProyek" value="<?= HtmlEncode(FormatNumber($Grid->idAjuanProyek->CurrentValue, $Grid->idAjuanProyek->formatPattern())) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_kontakajuanproyek_idAjuanProyek" class="el_kontakajuanproyek_idAjuanProyek">
    <select
        id="x<?= $Grid->RowIndex ?>_idAjuanProyek"
        name="x<?= $Grid->RowIndex ?>_idAjuanProyek"
        class="form-select ew-select<?= $Grid->idAjuanProyek->isInvalidClass() ?>"
        data-select2-id="fkontakajuanproyekgrid_x<?= $Grid->RowIndex ?>_idAjuanProyek"
        data-table="kontakajuanproyek"
        data-field="x_idAjuanProyek"
        data-value-separator="<?= $Grid->idAjuanProyek->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->idAjuanProyek->getPlaceHolder()) ?>"
        <?= $Grid->idAjuanProyek->editAttributes() ?>>
        <?= $Grid->idAjuanProyek->selectOptionListHtml("x{$Grid->RowIndex}_idAjuanProyek") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->idAjuanProyek->getErrorMessage() ?></div>
<?= $Grid->idAjuanProyek->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_idAjuanProyek") ?>
<script>
loadjs.ready("fkontakajuanproyekgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_idAjuanProyek", selectId: "fkontakajuanproyekgrid_x<?= $Grid->RowIndex ?>_idAjuanProyek" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fkontakajuanproyekgrid.lists.idAjuanProyek.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_idAjuanProyek", form: "fkontakajuanproyekgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_idAjuanProyek", form: "fkontakajuanproyekgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.kontakajuanproyek.fields.idAjuanProyek.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<input type="hidden" data-table="kontakajuanproyek" data-field="x_idAjuanProyek" data-hidden="1" name="o<?= $Grid->RowIndex ?>_idAjuanProyek" id="o<?= $Grid->RowIndex ?>_idAjuanProyek" value="<?= HtmlEncode($Grid->idAjuanProyek->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($Grid->idAjuanProyek->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_kontakajuanproyek_idAjuanProyek" class="el_kontakajuanproyek_idAjuanProyek">
<span<?= $Grid->idAjuanProyek->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->idAjuanProyek->getDisplayValue($Grid->idAjuanProyek->ViewValue) ?></span></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_idAjuanProyek" name="x<?= $Grid->RowIndex ?>_idAjuanProyek" value="<?= HtmlEncode(FormatNumber($Grid->idAjuanProyek->CurrentValue, $Grid->idAjuanProyek->formatPattern())) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_kontakajuanproyek_idAjuanProyek" class="el_kontakajuanproyek_idAjuanProyek">
    <select
        id="x<?= $Grid->RowIndex ?>_idAjuanProyek"
        name="x<?= $Grid->RowIndex ?>_idAjuanProyek"
        class="form-select ew-select<?= $Grid->idAjuanProyek->isInvalidClass() ?>"
        data-select2-id="fkontakajuanproyekgrid_x<?= $Grid->RowIndex ?>_idAjuanProyek"
        data-table="kontakajuanproyek"
        data-field="x_idAjuanProyek"
        data-value-separator="<?= $Grid->idAjuanProyek->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->idAjuanProyek->getPlaceHolder()) ?>"
        <?= $Grid->idAjuanProyek->editAttributes() ?>>
        <?= $Grid->idAjuanProyek->selectOptionListHtml("x{$Grid->RowIndex}_idAjuanProyek") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->idAjuanProyek->getErrorMessage() ?></div>
<?= $Grid->idAjuanProyek->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_idAjuanProyek") ?>
<script>
loadjs.ready("fkontakajuanproyekgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_idAjuanProyek", selectId: "fkontakajuanproyekgrid_x<?= $Grid->RowIndex ?>_idAjuanProyek" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fkontakajuanproyekgrid.lists.idAjuanProyek.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_idAjuanProyek", form: "fkontakajuanproyekgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_idAjuanProyek", form: "fkontakajuanproyekgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.kontakajuanproyek.fields.idAjuanProyek.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_kontakajuanproyek_idAjuanProyek" class="el_kontakajuanproyek_idAjuanProyek">
<span<?= $Grid->idAjuanProyek->viewAttributes() ?>>
<?= $Grid->idAjuanProyek->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="kontakajuanproyek" data-field="x_idAjuanProyek" data-hidden="1" name="fkontakajuanproyekgrid$x<?= $Grid->RowIndex ?>_idAjuanProyek" id="fkontakajuanproyekgrid$x<?= $Grid->RowIndex ?>_idAjuanProyek" value="<?= HtmlEncode($Grid->idAjuanProyek->FormValue) ?>">
<input type="hidden" data-table="kontakajuanproyek" data-field="x_idAjuanProyek" data-hidden="1" name="fkontakajuanproyekgrid$o<?= $Grid->RowIndex ?>_idAjuanProyek" id="fkontakajuanproyekgrid$o<?= $Grid->RowIndex ?>_idAjuanProyek" value="<?= HtmlEncode($Grid->idAjuanProyek->OldValue) ?>">
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
loadjs.ready(["fkontakajuanproyekgrid","load"], () => fkontakajuanproyekgrid.updateLists(<?= $Grid->RowIndex ?>));
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
    $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowIndex, "id" => "r0_kontakajuanproyek", "data-rowtype" => ROWTYPE_ADD]);
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
<span id="el$rowindex$_kontakajuanproyek_kontak" class="el_kontakajuanproyek_kontak">
<input type="<?= $Grid->kontak->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_kontak" id="x<?= $Grid->RowIndex ?>_kontak" data-table="kontakajuanproyek" data-field="x_kontak" value="<?= $Grid->kontak->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->kontak->getPlaceHolder()) ?>"<?= $Grid->kontak->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->kontak->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_kontakajuanproyek_kontak" class="el_kontakajuanproyek_kontak">
<span<?= $Grid->kontak->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->kontak->getDisplayValue($Grid->kontak->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="kontakajuanproyek" data-field="x_kontak" data-hidden="1" name="x<?= $Grid->RowIndex ?>_kontak" id="x<?= $Grid->RowIndex ?>_kontak" value="<?= HtmlEncode($Grid->kontak->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="kontakajuanproyek" data-field="x_kontak" data-hidden="1" name="o<?= $Grid->RowIndex ?>_kontak" id="o<?= $Grid->RowIndex ?>_kontak" value="<?= HtmlEncode($Grid->kontak->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->idAjuanProyek->Visible) { // idAjuanProyek ?>
        <td data-name="idAjuanProyek">
<?php if (!$Grid->isConfirm()) { ?>
<?php if ($Grid->idAjuanProyek->getSessionValue() != "") { ?>
<span id="el$rowindex$_kontakajuanproyek_idAjuanProyek" class="el_kontakajuanproyek_idAjuanProyek">
<span<?= $Grid->idAjuanProyek->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->idAjuanProyek->getDisplayValue($Grid->idAjuanProyek->ViewValue) ?></span></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_idAjuanProyek" name="x<?= $Grid->RowIndex ?>_idAjuanProyek" value="<?= HtmlEncode(FormatNumber($Grid->idAjuanProyek->CurrentValue, $Grid->idAjuanProyek->formatPattern())) ?>" data-hidden="1">
<?php } else { ?>
<span id="el$rowindex$_kontakajuanproyek_idAjuanProyek" class="el_kontakajuanproyek_idAjuanProyek">
    <select
        id="x<?= $Grid->RowIndex ?>_idAjuanProyek"
        name="x<?= $Grid->RowIndex ?>_idAjuanProyek"
        class="form-select ew-select<?= $Grid->idAjuanProyek->isInvalidClass() ?>"
        data-select2-id="fkontakajuanproyekgrid_x<?= $Grid->RowIndex ?>_idAjuanProyek"
        data-table="kontakajuanproyek"
        data-field="x_idAjuanProyek"
        data-value-separator="<?= $Grid->idAjuanProyek->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->idAjuanProyek->getPlaceHolder()) ?>"
        <?= $Grid->idAjuanProyek->editAttributes() ?>>
        <?= $Grid->idAjuanProyek->selectOptionListHtml("x{$Grid->RowIndex}_idAjuanProyek") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->idAjuanProyek->getErrorMessage() ?></div>
<?= $Grid->idAjuanProyek->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_idAjuanProyek") ?>
<script>
loadjs.ready("fkontakajuanproyekgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_idAjuanProyek", selectId: "fkontakajuanproyekgrid_x<?= $Grid->RowIndex ?>_idAjuanProyek" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fkontakajuanproyekgrid.lists.idAjuanProyek.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_idAjuanProyek", form: "fkontakajuanproyekgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_idAjuanProyek", form: "fkontakajuanproyekgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.kontakajuanproyek.fields.idAjuanProyek.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_kontakajuanproyek_idAjuanProyek" class="el_kontakajuanproyek_idAjuanProyek">
<span<?= $Grid->idAjuanProyek->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->idAjuanProyek->getDisplayValue($Grid->idAjuanProyek->ViewValue) ?></span></span>
</span>
<input type="hidden" data-table="kontakajuanproyek" data-field="x_idAjuanProyek" data-hidden="1" name="x<?= $Grid->RowIndex ?>_idAjuanProyek" id="x<?= $Grid->RowIndex ?>_idAjuanProyek" value="<?= HtmlEncode($Grid->idAjuanProyek->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="kontakajuanproyek" data-field="x_idAjuanProyek" data-hidden="1" name="o<?= $Grid->RowIndex ?>_idAjuanProyek" id="o<?= $Grid->RowIndex ?>_idAjuanProyek" value="<?= HtmlEncode($Grid->idAjuanProyek->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowIndex);
?>
<script>
loadjs.ready(["fkontakajuanproyekgrid","load"], () => fkontakajuanproyekgrid.updateLists(<?= $Grid->RowIndex ?>, true));
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
<input type="hidden" name="detailpage" value="fkontakajuanproyekgrid">
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
    ew.addEventHandlers("kontakajuanproyek");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
