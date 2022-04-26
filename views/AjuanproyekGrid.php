<?php

namespace PHPMaker2022\project1;

// Set up and run Grid object
$Grid = Container("AjuanproyekGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fajuanproyekgrid;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fajuanproyekgrid = new ew.Form("fajuanproyekgrid", "grid");
    fajuanproyekgrid.formKeyCountName = "<?= $Grid->FormKeyCountName ?>";

    // Add fields
    var currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { ajuanproyek: currentTable } });
    var fields = currentTable.fields;
    fajuanproyekgrid.addFields([
        ["idAjuanProyek", [fields.idAjuanProyek.visible && fields.idAjuanProyek.required ? ew.Validators.required(fields.idAjuanProyek.caption) : null], fields.idAjuanProyek.isInvalid],
        ["nama", [fields.nama.visible && fields.nama.required ? ew.Validators.required(fields.nama.caption) : null], fields.nama.isInvalid],
        ["pengaju", [fields.pengaju.visible && fields.pengaju.required ? ew.Validators.required(fields.pengaju.caption) : null], fields.pengaju.isInvalid],
        ["biaya", [fields.biaya.visible && fields.biaya.required ? ew.Validators.required(fields.biaya.caption) : null, ew.Validators.integer], fields.biaya.isInvalid],
        ["tanggalPengajuan", [fields.tanggalPengajuan.visible && fields.tanggalPengajuan.required ? ew.Validators.required(fields.tanggalPengajuan.caption) : null, ew.Validators.datetime(fields.tanggalPengajuan.clientFormatPattern)], fields.tanggalPengajuan.isInvalid],
        ["keputusan", [fields.keputusan.visible && fields.keputusan.required ? ew.Validators.required(fields.keputusan.caption) : null], fields.keputusan.isInvalid]
    ]);

    // Check empty row
    fajuanproyekgrid.emptyRow = function (rowIndex) {
        var fobj = this.getForm(),
            fields = [["nama",false],["pengaju",false],["biaya",false],["tanggalPengajuan",false],["keputusan",false]];
        if (fields.some(field => ew.valueChanged(fobj, rowIndex, ...field)))
            return false;
        return true;
    }

    // Form_CustomValidate
    fajuanproyekgrid.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fajuanproyekgrid.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fajuanproyekgrid.lists.keputusan = <?= $Grid->keputusan->toClientList($Grid) ?>;
    loadjs.done("fajuanproyekgrid");
});
</script>
<?php } ?>
<?php
$Grid->renderOtherOptions();
?>
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> ajuanproyek">
<div id="fajuanproyekgrid" class="ew-form ew-list-form">
<div id="gmp_ajuanproyek" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_ajuanproyekgrid" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
<?php if ($Grid->idAjuanProyek->Visible) { // idAjuanProyek ?>
        <th data-name="idAjuanProyek" class="<?= $Grid->idAjuanProyek->headerCellClass() ?>"><div id="elh_ajuanproyek_idAjuanProyek" class="ajuanproyek_idAjuanProyek"><?= $Grid->renderFieldHeader($Grid->idAjuanProyek) ?></div></th>
<?php } ?>
<?php if ($Grid->nama->Visible) { // nama ?>
        <th data-name="nama" class="<?= $Grid->nama->headerCellClass() ?>"><div id="elh_ajuanproyek_nama" class="ajuanproyek_nama"><?= $Grid->renderFieldHeader($Grid->nama) ?></div></th>
<?php } ?>
<?php if ($Grid->pengaju->Visible) { // pengaju ?>
        <th data-name="pengaju" class="<?= $Grid->pengaju->headerCellClass() ?>"><div id="elh_ajuanproyek_pengaju" class="ajuanproyek_pengaju"><?= $Grid->renderFieldHeader($Grid->pengaju) ?></div></th>
<?php } ?>
<?php if ($Grid->biaya->Visible) { // biaya ?>
        <th data-name="biaya" class="<?= $Grid->biaya->headerCellClass() ?>"><div id="elh_ajuanproyek_biaya" class="ajuanproyek_biaya"><?= $Grid->renderFieldHeader($Grid->biaya) ?></div></th>
<?php } ?>
<?php if ($Grid->tanggalPengajuan->Visible) { // tanggalPengajuan ?>
        <th data-name="tanggalPengajuan" class="<?= $Grid->tanggalPengajuan->headerCellClass() ?>"><div id="elh_ajuanproyek_tanggalPengajuan" class="ajuanproyek_tanggalPengajuan"><?= $Grid->renderFieldHeader($Grid->tanggalPengajuan) ?></div></th>
<?php } ?>
<?php if ($Grid->keputusan->Visible) { // keputusan ?>
        <th data-name="keputusan" class="<?= $Grid->keputusan->headerCellClass() ?>"><div id="elh_ajuanproyek_keputusan" class="ajuanproyek_keputusan"><?= $Grid->renderFieldHeader($Grid->keputusan) ?></div></th>
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
            "id" => "r" . $Grid->RowCount . "_ajuanproyek",
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
    <?php if ($Grid->idAjuanProyek->Visible) { // idAjuanProyek ?>
        <td data-name="idAjuanProyek"<?= $Grid->idAjuanProyek->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_ajuanproyek_idAjuanProyek" class="el_ajuanproyek_idAjuanProyek"></span>
<input type="hidden" data-table="ajuanproyek" data-field="x_idAjuanProyek" data-hidden="1" name="o<?= $Grid->RowIndex ?>_idAjuanProyek" id="o<?= $Grid->RowIndex ?>_idAjuanProyek" value="<?= HtmlEncode($Grid->idAjuanProyek->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_ajuanproyek_idAjuanProyek" class="el_ajuanproyek_idAjuanProyek">
<span<?= $Grid->idAjuanProyek->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->idAjuanProyek->getDisplayValue($Grid->idAjuanProyek->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="ajuanproyek" data-field="x_idAjuanProyek" data-hidden="1" name="x<?= $Grid->RowIndex ?>_idAjuanProyek" id="x<?= $Grid->RowIndex ?>_idAjuanProyek" value="<?= HtmlEncode($Grid->idAjuanProyek->CurrentValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_ajuanproyek_idAjuanProyek" class="el_ajuanproyek_idAjuanProyek">
<span<?= $Grid->idAjuanProyek->viewAttributes() ?>>
<?= $Grid->idAjuanProyek->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="ajuanproyek" data-field="x_idAjuanProyek" data-hidden="1" name="fajuanproyekgrid$x<?= $Grid->RowIndex ?>_idAjuanProyek" id="fajuanproyekgrid$x<?= $Grid->RowIndex ?>_idAjuanProyek" value="<?= HtmlEncode($Grid->idAjuanProyek->FormValue) ?>">
<input type="hidden" data-table="ajuanproyek" data-field="x_idAjuanProyek" data-hidden="1" name="fajuanproyekgrid$o<?= $Grid->RowIndex ?>_idAjuanProyek" id="fajuanproyekgrid$o<?= $Grid->RowIndex ?>_idAjuanProyek" value="<?= HtmlEncode($Grid->idAjuanProyek->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="ajuanproyek" data-field="x_idAjuanProyek" data-hidden="1" name="x<?= $Grid->RowIndex ?>_idAjuanProyek" id="x<?= $Grid->RowIndex ?>_idAjuanProyek" value="<?= HtmlEncode($Grid->idAjuanProyek->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Grid->nama->Visible) { // nama ?>
        <td data-name="nama"<?= $Grid->nama->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_ajuanproyek_nama" class="el_ajuanproyek_nama">
<input type="<?= $Grid->nama->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_nama" id="x<?= $Grid->RowIndex ?>_nama" data-table="ajuanproyek" data-field="x_nama" value="<?= $Grid->nama->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->nama->getPlaceHolder()) ?>"<?= $Grid->nama->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->nama->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="ajuanproyek" data-field="x_nama" data-hidden="1" name="o<?= $Grid->RowIndex ?>_nama" id="o<?= $Grid->RowIndex ?>_nama" value="<?= HtmlEncode($Grid->nama->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_ajuanproyek_nama" class="el_ajuanproyek_nama">
<input type="<?= $Grid->nama->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_nama" id="x<?= $Grid->RowIndex ?>_nama" data-table="ajuanproyek" data-field="x_nama" value="<?= $Grid->nama->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->nama->getPlaceHolder()) ?>"<?= $Grid->nama->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->nama->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_ajuanproyek_nama" class="el_ajuanproyek_nama">
<span<?= $Grid->nama->viewAttributes() ?>>
<?= $Grid->nama->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="ajuanproyek" data-field="x_nama" data-hidden="1" name="fajuanproyekgrid$x<?= $Grid->RowIndex ?>_nama" id="fajuanproyekgrid$x<?= $Grid->RowIndex ?>_nama" value="<?= HtmlEncode($Grid->nama->FormValue) ?>">
<input type="hidden" data-table="ajuanproyek" data-field="x_nama" data-hidden="1" name="fajuanproyekgrid$o<?= $Grid->RowIndex ?>_nama" id="fajuanproyekgrid$o<?= $Grid->RowIndex ?>_nama" value="<?= HtmlEncode($Grid->nama->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->pengaju->Visible) { // pengaju ?>
        <td data-name="pengaju"<?= $Grid->pengaju->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_ajuanproyek_pengaju" class="el_ajuanproyek_pengaju">
<input type="<?= $Grid->pengaju->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_pengaju" id="x<?= $Grid->RowIndex ?>_pengaju" data-table="ajuanproyek" data-field="x_pengaju" value="<?= $Grid->pengaju->EditValue ?>" size="30" maxlength="30" placeholder="<?= HtmlEncode($Grid->pengaju->getPlaceHolder()) ?>"<?= $Grid->pengaju->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->pengaju->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="ajuanproyek" data-field="x_pengaju" data-hidden="1" name="o<?= $Grid->RowIndex ?>_pengaju" id="o<?= $Grid->RowIndex ?>_pengaju" value="<?= HtmlEncode($Grid->pengaju->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_ajuanproyek_pengaju" class="el_ajuanproyek_pengaju">
<input type="<?= $Grid->pengaju->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_pengaju" id="x<?= $Grid->RowIndex ?>_pengaju" data-table="ajuanproyek" data-field="x_pengaju" value="<?= $Grid->pengaju->EditValue ?>" size="30" maxlength="30" placeholder="<?= HtmlEncode($Grid->pengaju->getPlaceHolder()) ?>"<?= $Grid->pengaju->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->pengaju->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_ajuanproyek_pengaju" class="el_ajuanproyek_pengaju">
<span<?= $Grid->pengaju->viewAttributes() ?>>
<?= $Grid->pengaju->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="ajuanproyek" data-field="x_pengaju" data-hidden="1" name="fajuanproyekgrid$x<?= $Grid->RowIndex ?>_pengaju" id="fajuanproyekgrid$x<?= $Grid->RowIndex ?>_pengaju" value="<?= HtmlEncode($Grid->pengaju->FormValue) ?>">
<input type="hidden" data-table="ajuanproyek" data-field="x_pengaju" data-hidden="1" name="fajuanproyekgrid$o<?= $Grid->RowIndex ?>_pengaju" id="fajuanproyekgrid$o<?= $Grid->RowIndex ?>_pengaju" value="<?= HtmlEncode($Grid->pengaju->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->biaya->Visible) { // biaya ?>
        <td data-name="biaya"<?= $Grid->biaya->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_ajuanproyek_biaya" class="el_ajuanproyek_biaya">
<input type="<?= $Grid->biaya->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_biaya" id="x<?= $Grid->RowIndex ?>_biaya" data-table="ajuanproyek" data-field="x_biaya" value="<?= $Grid->biaya->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->biaya->getPlaceHolder()) ?>"<?= $Grid->biaya->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->biaya->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="ajuanproyek" data-field="x_biaya" data-hidden="1" name="o<?= $Grid->RowIndex ?>_biaya" id="o<?= $Grid->RowIndex ?>_biaya" value="<?= HtmlEncode($Grid->biaya->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_ajuanproyek_biaya" class="el_ajuanproyek_biaya">
<input type="<?= $Grid->biaya->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_biaya" id="x<?= $Grid->RowIndex ?>_biaya" data-table="ajuanproyek" data-field="x_biaya" value="<?= $Grid->biaya->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->biaya->getPlaceHolder()) ?>"<?= $Grid->biaya->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->biaya->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_ajuanproyek_biaya" class="el_ajuanproyek_biaya">
<span<?= $Grid->biaya->viewAttributes() ?>>
<?= $Grid->biaya->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="ajuanproyek" data-field="x_biaya" data-hidden="1" name="fajuanproyekgrid$x<?= $Grid->RowIndex ?>_biaya" id="fajuanproyekgrid$x<?= $Grid->RowIndex ?>_biaya" value="<?= HtmlEncode($Grid->biaya->FormValue) ?>">
<input type="hidden" data-table="ajuanproyek" data-field="x_biaya" data-hidden="1" name="fajuanproyekgrid$o<?= $Grid->RowIndex ?>_biaya" id="fajuanproyekgrid$o<?= $Grid->RowIndex ?>_biaya" value="<?= HtmlEncode($Grid->biaya->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->tanggalPengajuan->Visible) { // tanggalPengajuan ?>
        <td data-name="tanggalPengajuan"<?= $Grid->tanggalPengajuan->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_ajuanproyek_tanggalPengajuan" class="el_ajuanproyek_tanggalPengajuan">
<input type="<?= $Grid->tanggalPengajuan->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_tanggalPengajuan" id="x<?= $Grid->RowIndex ?>_tanggalPengajuan" data-table="ajuanproyek" data-field="x_tanggalPengajuan" value="<?= $Grid->tanggalPengajuan->EditValue ?>" placeholder="<?= HtmlEncode($Grid->tanggalPengajuan->getPlaceHolder()) ?>"<?= $Grid->tanggalPengajuan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tanggalPengajuan->getErrorMessage() ?></div>
<?php if (!$Grid->tanggalPengajuan->ReadOnly && !$Grid->tanggalPengajuan->Disabled && !isset($Grid->tanggalPengajuan->EditAttrs["readonly"]) && !isset($Grid->tanggalPengajuan->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fajuanproyekgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fajuanproyekgrid", "x<?= $Grid->RowIndex ?>_tanggalPengajuan", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="ajuanproyek" data-field="x_tanggalPengajuan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tanggalPengajuan" id="o<?= $Grid->RowIndex ?>_tanggalPengajuan" value="<?= HtmlEncode($Grid->tanggalPengajuan->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_ajuanproyek_tanggalPengajuan" class="el_ajuanproyek_tanggalPengajuan">
<input type="<?= $Grid->tanggalPengajuan->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_tanggalPengajuan" id="x<?= $Grid->RowIndex ?>_tanggalPengajuan" data-table="ajuanproyek" data-field="x_tanggalPengajuan" value="<?= $Grid->tanggalPengajuan->EditValue ?>" placeholder="<?= HtmlEncode($Grid->tanggalPengajuan->getPlaceHolder()) ?>"<?= $Grid->tanggalPengajuan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tanggalPengajuan->getErrorMessage() ?></div>
<?php if (!$Grid->tanggalPengajuan->ReadOnly && !$Grid->tanggalPengajuan->Disabled && !isset($Grid->tanggalPengajuan->EditAttrs["readonly"]) && !isset($Grid->tanggalPengajuan->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fajuanproyekgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fajuanproyekgrid", "x<?= $Grid->RowIndex ?>_tanggalPengajuan", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_ajuanproyek_tanggalPengajuan" class="el_ajuanproyek_tanggalPengajuan">
<span<?= $Grid->tanggalPengajuan->viewAttributes() ?>>
<?= $Grid->tanggalPengajuan->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="ajuanproyek" data-field="x_tanggalPengajuan" data-hidden="1" name="fajuanproyekgrid$x<?= $Grid->RowIndex ?>_tanggalPengajuan" id="fajuanproyekgrid$x<?= $Grid->RowIndex ?>_tanggalPengajuan" value="<?= HtmlEncode($Grid->tanggalPengajuan->FormValue) ?>">
<input type="hidden" data-table="ajuanproyek" data-field="x_tanggalPengajuan" data-hidden="1" name="fajuanproyekgrid$o<?= $Grid->RowIndex ?>_tanggalPengajuan" id="fajuanproyekgrid$o<?= $Grid->RowIndex ?>_tanggalPengajuan" value="<?= HtmlEncode($Grid->tanggalPengajuan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->keputusan->Visible) { // keputusan ?>
        <td data-name="keputusan"<?= $Grid->keputusan->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_ajuanproyek_keputusan" class="el_ajuanproyek_keputusan">
<template id="tp_x<?= $Grid->RowIndex ?>_keputusan">
    <div class="form-check">
        <input type="radio" class="form-check-input" data-table="ajuanproyek" data-field="x_keputusan" name="x<?= $Grid->RowIndex ?>_keputusan" id="x<?= $Grid->RowIndex ?>_keputusan"<?= $Grid->keputusan->editAttributes() ?>>
        <label class="form-check-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_keputusan" class="ew-item-list"></div>
<selection-list hidden
    id="x<?= $Grid->RowIndex ?>_keputusan"
    name="x<?= $Grid->RowIndex ?>_keputusan"
    value="<?= HtmlEncode($Grid->keputusan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_keputusan"
    data-bs-target="dsl_x<?= $Grid->RowIndex ?>_keputusan"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->keputusan->isInvalidClass() ?>"
    data-table="ajuanproyek"
    data-field="x_keputusan"
    data-value-separator="<?= $Grid->keputusan->displayValueSeparatorAttribute() ?>"
    <?= $Grid->keputusan->editAttributes() ?>></selection-list>
<div class="invalid-feedback"><?= $Grid->keputusan->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="ajuanproyek" data-field="x_keputusan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_keputusan" id="o<?= $Grid->RowIndex ?>_keputusan" value="<?= HtmlEncode($Grid->keputusan->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_ajuanproyek_keputusan" class="el_ajuanproyek_keputusan">
<template id="tp_x<?= $Grid->RowIndex ?>_keputusan">
    <div class="form-check">
        <input type="radio" class="form-check-input" data-table="ajuanproyek" data-field="x_keputusan" name="x<?= $Grid->RowIndex ?>_keputusan" id="x<?= $Grid->RowIndex ?>_keputusan"<?= $Grid->keputusan->editAttributes() ?>>
        <label class="form-check-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_keputusan" class="ew-item-list"></div>
<selection-list hidden
    id="x<?= $Grid->RowIndex ?>_keputusan"
    name="x<?= $Grid->RowIndex ?>_keputusan"
    value="<?= HtmlEncode($Grid->keputusan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_keputusan"
    data-bs-target="dsl_x<?= $Grid->RowIndex ?>_keputusan"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->keputusan->isInvalidClass() ?>"
    data-table="ajuanproyek"
    data-field="x_keputusan"
    data-value-separator="<?= $Grid->keputusan->displayValueSeparatorAttribute() ?>"
    <?= $Grid->keputusan->editAttributes() ?>></selection-list>
<div class="invalid-feedback"><?= $Grid->keputusan->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_ajuanproyek_keputusan" class="el_ajuanproyek_keputusan">
<span<?= $Grid->keputusan->viewAttributes() ?>>
<?= $Grid->keputusan->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="ajuanproyek" data-field="x_keputusan" data-hidden="1" name="fajuanproyekgrid$x<?= $Grid->RowIndex ?>_keputusan" id="fajuanproyekgrid$x<?= $Grid->RowIndex ?>_keputusan" value="<?= HtmlEncode($Grid->keputusan->FormValue) ?>">
<input type="hidden" data-table="ajuanproyek" data-field="x_keputusan" data-hidden="1" name="fajuanproyekgrid$o<?= $Grid->RowIndex ?>_keputusan" id="fajuanproyekgrid$o<?= $Grid->RowIndex ?>_keputusan" value="<?= HtmlEncode($Grid->keputusan->OldValue) ?>">
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
loadjs.ready(["fajuanproyekgrid","load"], () => fajuanproyekgrid.updateLists(<?= $Grid->RowIndex ?>));
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
    $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowIndex, "id" => "r0_ajuanproyek", "data-rowtype" => ROWTYPE_ADD]);
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
    <?php if ($Grid->idAjuanProyek->Visible) { // idAjuanProyek ?>
        <td data-name="idAjuanProyek">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_ajuanproyek_idAjuanProyek" class="el_ajuanproyek_idAjuanProyek"></span>
<?php } else { ?>
<span id="el$rowindex$_ajuanproyek_idAjuanProyek" class="el_ajuanproyek_idAjuanProyek">
<span<?= $Grid->idAjuanProyek->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->idAjuanProyek->getDisplayValue($Grid->idAjuanProyek->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="ajuanproyek" data-field="x_idAjuanProyek" data-hidden="1" name="x<?= $Grid->RowIndex ?>_idAjuanProyek" id="x<?= $Grid->RowIndex ?>_idAjuanProyek" value="<?= HtmlEncode($Grid->idAjuanProyek->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ajuanproyek" data-field="x_idAjuanProyek" data-hidden="1" name="o<?= $Grid->RowIndex ?>_idAjuanProyek" id="o<?= $Grid->RowIndex ?>_idAjuanProyek" value="<?= HtmlEncode($Grid->idAjuanProyek->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->nama->Visible) { // nama ?>
        <td data-name="nama">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_ajuanproyek_nama" class="el_ajuanproyek_nama">
<input type="<?= $Grid->nama->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_nama" id="x<?= $Grid->RowIndex ?>_nama" data-table="ajuanproyek" data-field="x_nama" value="<?= $Grid->nama->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->nama->getPlaceHolder()) ?>"<?= $Grid->nama->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->nama->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_ajuanproyek_nama" class="el_ajuanproyek_nama">
<span<?= $Grid->nama->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->nama->getDisplayValue($Grid->nama->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="ajuanproyek" data-field="x_nama" data-hidden="1" name="x<?= $Grid->RowIndex ?>_nama" id="x<?= $Grid->RowIndex ?>_nama" value="<?= HtmlEncode($Grid->nama->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ajuanproyek" data-field="x_nama" data-hidden="1" name="o<?= $Grid->RowIndex ?>_nama" id="o<?= $Grid->RowIndex ?>_nama" value="<?= HtmlEncode($Grid->nama->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->pengaju->Visible) { // pengaju ?>
        <td data-name="pengaju">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_ajuanproyek_pengaju" class="el_ajuanproyek_pengaju">
<input type="<?= $Grid->pengaju->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_pengaju" id="x<?= $Grid->RowIndex ?>_pengaju" data-table="ajuanproyek" data-field="x_pengaju" value="<?= $Grid->pengaju->EditValue ?>" size="30" maxlength="30" placeholder="<?= HtmlEncode($Grid->pengaju->getPlaceHolder()) ?>"<?= $Grid->pengaju->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->pengaju->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_ajuanproyek_pengaju" class="el_ajuanproyek_pengaju">
<span<?= $Grid->pengaju->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->pengaju->getDisplayValue($Grid->pengaju->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="ajuanproyek" data-field="x_pengaju" data-hidden="1" name="x<?= $Grid->RowIndex ?>_pengaju" id="x<?= $Grid->RowIndex ?>_pengaju" value="<?= HtmlEncode($Grid->pengaju->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ajuanproyek" data-field="x_pengaju" data-hidden="1" name="o<?= $Grid->RowIndex ?>_pengaju" id="o<?= $Grid->RowIndex ?>_pengaju" value="<?= HtmlEncode($Grid->pengaju->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->biaya->Visible) { // biaya ?>
        <td data-name="biaya">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_ajuanproyek_biaya" class="el_ajuanproyek_biaya">
<input type="<?= $Grid->biaya->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_biaya" id="x<?= $Grid->RowIndex ?>_biaya" data-table="ajuanproyek" data-field="x_biaya" value="<?= $Grid->biaya->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->biaya->getPlaceHolder()) ?>"<?= $Grid->biaya->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->biaya->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_ajuanproyek_biaya" class="el_ajuanproyek_biaya">
<span<?= $Grid->biaya->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->biaya->getDisplayValue($Grid->biaya->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="ajuanproyek" data-field="x_biaya" data-hidden="1" name="x<?= $Grid->RowIndex ?>_biaya" id="x<?= $Grid->RowIndex ?>_biaya" value="<?= HtmlEncode($Grid->biaya->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ajuanproyek" data-field="x_biaya" data-hidden="1" name="o<?= $Grid->RowIndex ?>_biaya" id="o<?= $Grid->RowIndex ?>_biaya" value="<?= HtmlEncode($Grid->biaya->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->tanggalPengajuan->Visible) { // tanggalPengajuan ?>
        <td data-name="tanggalPengajuan">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_ajuanproyek_tanggalPengajuan" class="el_ajuanproyek_tanggalPengajuan">
<input type="<?= $Grid->tanggalPengajuan->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_tanggalPengajuan" id="x<?= $Grid->RowIndex ?>_tanggalPengajuan" data-table="ajuanproyek" data-field="x_tanggalPengajuan" value="<?= $Grid->tanggalPengajuan->EditValue ?>" placeholder="<?= HtmlEncode($Grid->tanggalPengajuan->getPlaceHolder()) ?>"<?= $Grid->tanggalPengajuan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tanggalPengajuan->getErrorMessage() ?></div>
<?php if (!$Grid->tanggalPengajuan->ReadOnly && !$Grid->tanggalPengajuan->Disabled && !isset($Grid->tanggalPengajuan->EditAttrs["readonly"]) && !isset($Grid->tanggalPengajuan->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fajuanproyekgrid", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fajuanproyekgrid", "x<?= $Grid->RowIndex ?>_tanggalPengajuan", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_ajuanproyek_tanggalPengajuan" class="el_ajuanproyek_tanggalPengajuan">
<span<?= $Grid->tanggalPengajuan->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->tanggalPengajuan->getDisplayValue($Grid->tanggalPengajuan->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="ajuanproyek" data-field="x_tanggalPengajuan" data-hidden="1" name="x<?= $Grid->RowIndex ?>_tanggalPengajuan" id="x<?= $Grid->RowIndex ?>_tanggalPengajuan" value="<?= HtmlEncode($Grid->tanggalPengajuan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ajuanproyek" data-field="x_tanggalPengajuan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tanggalPengajuan" id="o<?= $Grid->RowIndex ?>_tanggalPengajuan" value="<?= HtmlEncode($Grid->tanggalPengajuan->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->keputusan->Visible) { // keputusan ?>
        <td data-name="keputusan">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_ajuanproyek_keputusan" class="el_ajuanproyek_keputusan">
<template id="tp_x<?= $Grid->RowIndex ?>_keputusan">
    <div class="form-check">
        <input type="radio" class="form-check-input" data-table="ajuanproyek" data-field="x_keputusan" name="x<?= $Grid->RowIndex ?>_keputusan" id="x<?= $Grid->RowIndex ?>_keputusan"<?= $Grid->keputusan->editAttributes() ?>>
        <label class="form-check-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_keputusan" class="ew-item-list"></div>
<selection-list hidden
    id="x<?= $Grid->RowIndex ?>_keputusan"
    name="x<?= $Grid->RowIndex ?>_keputusan"
    value="<?= HtmlEncode($Grid->keputusan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_keputusan"
    data-bs-target="dsl_x<?= $Grid->RowIndex ?>_keputusan"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->keputusan->isInvalidClass() ?>"
    data-table="ajuanproyek"
    data-field="x_keputusan"
    data-value-separator="<?= $Grid->keputusan->displayValueSeparatorAttribute() ?>"
    <?= $Grid->keputusan->editAttributes() ?>></selection-list>
<div class="invalid-feedback"><?= $Grid->keputusan->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_ajuanproyek_keputusan" class="el_ajuanproyek_keputusan">
<span<?= $Grid->keputusan->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->keputusan->getDisplayValue($Grid->keputusan->ViewValue) ?></span></span>
</span>
<input type="hidden" data-table="ajuanproyek" data-field="x_keputusan" data-hidden="1" name="x<?= $Grid->RowIndex ?>_keputusan" id="x<?= $Grid->RowIndex ?>_keputusan" value="<?= HtmlEncode($Grid->keputusan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ajuanproyek" data-field="x_keputusan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_keputusan" id="o<?= $Grid->RowIndex ?>_keputusan" value="<?= HtmlEncode($Grid->keputusan->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowIndex);
?>
<script>
loadjs.ready(["fajuanproyekgrid","load"], () => fajuanproyekgrid.updateLists(<?= $Grid->RowIndex ?>, true));
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
<input type="hidden" name="detailpage" value="fajuanproyekgrid">
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
    ew.addEventHandlers("ajuanproyek");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
