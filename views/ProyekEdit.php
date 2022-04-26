<?php

namespace PHPMaker2022\project1;

// Page object
$ProyekEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { proyek: currentTable } });
var currentForm, currentPageID;
var fproyekedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fproyekedit = new ew.Form("fproyekedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fproyekedit;

    // Add fields
    var fields = currentTable.fields;
    fproyekedit.addFields([
        ["idProyek", [fields.idProyek.visible && fields.idProyek.required ? ew.Validators.required(fields.idProyek.caption) : null, ew.Validators.integer], fields.idProyek.isInvalid],
        ["ajuan", [fields.ajuan.visible && fields.ajuan.required ? ew.Validators.required(fields.ajuan.caption) : null], fields.ajuan.isInvalid],
        ["biayaTerkumpul", [fields.biayaTerkumpul.visible && fields.biayaTerkumpul.required ? ew.Validators.required(fields.biayaTerkumpul.caption) : null, ew.Validators.integer], fields.biayaTerkumpul.isInvalid],
        ["tanggalMulai", [fields.tanggalMulai.visible && fields.tanggalMulai.required ? ew.Validators.required(fields.tanggalMulai.caption) : null, ew.Validators.datetime(fields.tanggalMulai.clientFormatPattern)], fields.tanggalMulai.isInvalid],
        ["tanggalSelesai", [fields.tanggalSelesai.visible && fields.tanggalSelesai.required ? ew.Validators.required(fields.tanggalSelesai.caption) : null, ew.Validators.datetime(fields.tanggalSelesai.clientFormatPattern)], fields.tanggalSelesai.isInvalid],
        ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid]
    ]);

    // Form_CustomValidate
    fproyekedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fproyekedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fproyekedit.lists.ajuan = <?= $Page->ajuan->toClientList($Page) ?>;
    fproyekedit.lists.status = <?= $Page->status->toClientList($Page) ?>;
    loadjs.done("fproyekedit");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fproyekedit" id="fproyekedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="proyek">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->idProyek->Visible) { // idProyek ?>
    <div id="r_idProyek"<?= $Page->idProyek->rowAttributes() ?>>
        <label id="elh_proyek_idProyek" for="x_idProyek" class="<?= $Page->LeftColumnClass ?>"><?= $Page->idProyek->caption() ?><?= $Page->idProyek->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->idProyek->cellAttributes() ?>>
<span id="el_proyek_idProyek">
<span<?= $Page->idProyek->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->idProyek->getDisplayValue($Page->idProyek->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="proyek" data-field="x_idProyek" data-hidden="1" name="x_idProyek" id="x_idProyek" value="<?= HtmlEncode($Page->idProyek->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ajuan->Visible) { // ajuan ?>
    <div id="r_ajuan"<?= $Page->ajuan->rowAttributes() ?>>
        <label id="elh_proyek_ajuan" for="x_ajuan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ajuan->caption() ?><?= $Page->ajuan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->ajuan->cellAttributes() ?>>
<span id="el_proyek_ajuan">
    <select
        id="x_ajuan"
        name="x_ajuan"
        class="form-select ew-select<?= $Page->ajuan->isInvalidClass() ?>"
        data-select2-id="fproyekedit_x_ajuan"
        data-table="proyek"
        data-field="x_ajuan"
        data-value-separator="<?= $Page->ajuan->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->ajuan->getPlaceHolder()) ?>"
        <?= $Page->ajuan->editAttributes() ?>>
        <?= $Page->ajuan->selectOptionListHtml("x_ajuan") ?>
    </select>
    <?= $Page->ajuan->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->ajuan->getErrorMessage() ?></div>
<?= $Page->ajuan->Lookup->getParamTag($Page, "p_x_ajuan") ?>
<script>
loadjs.ready("fproyekedit", function() {
    var options = { name: "x_ajuan", selectId: "fproyekedit_x_ajuan" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fproyekedit.lists.ajuan.lookupOptions.length) {
        options.data = { id: "x_ajuan", form: "fproyekedit" };
    } else {
        options.ajax = { id: "x_ajuan", form: "fproyekedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.proyek.fields.ajuan.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->biayaTerkumpul->Visible) { // biayaTerkumpul ?>
    <div id="r_biayaTerkumpul"<?= $Page->biayaTerkumpul->rowAttributes() ?>>
        <label id="elh_proyek_biayaTerkumpul" for="x_biayaTerkumpul" class="<?= $Page->LeftColumnClass ?>"><?= $Page->biayaTerkumpul->caption() ?><?= $Page->biayaTerkumpul->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->biayaTerkumpul->cellAttributes() ?>>
<span id="el_proyek_biayaTerkumpul">
<input type="<?= $Page->biayaTerkumpul->getInputTextType() ?>" name="x_biayaTerkumpul" id="x_biayaTerkumpul" data-table="proyek" data-field="x_biayaTerkumpul" value="<?= $Page->biayaTerkumpul->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->biayaTerkumpul->getPlaceHolder()) ?>"<?= $Page->biayaTerkumpul->editAttributes() ?> aria-describedby="x_biayaTerkumpul_help">
<?= $Page->biayaTerkumpul->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->biayaTerkumpul->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tanggalMulai->Visible) { // tanggalMulai ?>
    <div id="r_tanggalMulai"<?= $Page->tanggalMulai->rowAttributes() ?>>
        <label id="elh_proyek_tanggalMulai" for="x_tanggalMulai" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tanggalMulai->caption() ?><?= $Page->tanggalMulai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tanggalMulai->cellAttributes() ?>>
<span id="el_proyek_tanggalMulai">
<input type="<?= $Page->tanggalMulai->getInputTextType() ?>" name="x_tanggalMulai" id="x_tanggalMulai" data-table="proyek" data-field="x_tanggalMulai" value="<?= $Page->tanggalMulai->EditValue ?>" placeholder="<?= HtmlEncode($Page->tanggalMulai->getPlaceHolder()) ?>"<?= $Page->tanggalMulai->editAttributes() ?> aria-describedby="x_tanggalMulai_help">
<?= $Page->tanggalMulai->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tanggalMulai->getErrorMessage() ?></div>
<?php if (!$Page->tanggalMulai->ReadOnly && !$Page->tanggalMulai->Disabled && !isset($Page->tanggalMulai->EditAttrs["readonly"]) && !isset($Page->tanggalMulai->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fproyekedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fproyekedit", "x_tanggalMulai", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tanggalSelesai->Visible) { // tanggalSelesai ?>
    <div id="r_tanggalSelesai"<?= $Page->tanggalSelesai->rowAttributes() ?>>
        <label id="elh_proyek_tanggalSelesai" for="x_tanggalSelesai" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tanggalSelesai->caption() ?><?= $Page->tanggalSelesai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tanggalSelesai->cellAttributes() ?>>
<span id="el_proyek_tanggalSelesai">
<input type="<?= $Page->tanggalSelesai->getInputTextType() ?>" name="x_tanggalSelesai" id="x_tanggalSelesai" data-table="proyek" data-field="x_tanggalSelesai" value="<?= $Page->tanggalSelesai->EditValue ?>" placeholder="<?= HtmlEncode($Page->tanggalSelesai->getPlaceHolder()) ?>"<?= $Page->tanggalSelesai->editAttributes() ?> aria-describedby="x_tanggalSelesai_help">
<?= $Page->tanggalSelesai->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tanggalSelesai->getErrorMessage() ?></div>
<?php if (!$Page->tanggalSelesai->ReadOnly && !$Page->tanggalSelesai->Disabled && !isset($Page->tanggalSelesai->EditAttrs["readonly"]) && !isset($Page->tanggalSelesai->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fproyekedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fproyekedit", "x_tanggalSelesai", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <div id="r_status"<?= $Page->status->rowAttributes() ?>>
        <label id="elh_proyek_status" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status->caption() ?><?= $Page->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->status->cellAttributes() ?>>
<span id="el_proyek_status">
<template id="tp_x_status">
    <div class="form-check">
        <input type="radio" class="form-check-input" data-table="proyek" data-field="x_status" name="x_status" id="x_status"<?= $Page->status->editAttributes() ?>>
        <label class="form-check-label"></label>
    </div>
</template>
<div id="dsl_x_status" class="ew-item-list"></div>
<selection-list hidden
    id="x_status"
    name="x_status"
    value="<?= HtmlEncode($Page->status->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_status"
    data-bs-target="dsl_x_status"
    data-repeatcolumn="5"
    class="form-control<?= $Page->status->isInvalidClass() ?>"
    data-table="proyek"
    data-field="x_status"
    data-value-separator="<?= $Page->status->displayValueSeparatorAttribute() ?>"
    <?= $Page->status->editAttributes() ?>></selection-list>
<?= $Page->status->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->status->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php
    if (in_array("partisipasiproyek", explode(",", $Page->getCurrentDetailTable())) && $partisipasiproyek->DetailEdit) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("partisipasiproyek", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "PartisipasiproyekGrid.php" ?>
<?php } ?>
<?php
    if (in_array("ajuanproyek", explode(",", $Page->getCurrentDetailTable())) && $ajuanproyek->DetailEdit) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("ajuanproyek", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "AjuanproyekGrid.php" ?>
<?php } ?>
<?php if (!$Page->IsModal) { ?>
<div class="row"><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
    </div><!-- /buttons offset -->
</div><!-- /buttons .row -->
<?php } ?>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
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
