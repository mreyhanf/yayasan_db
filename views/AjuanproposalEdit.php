<?php

namespace PHPMaker2022\project1;

// Page object
$AjuanproposalEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { ajuanproposal: currentTable } });
var currentForm, currentPageID;
var fajuanproposaledit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fajuanproposaledit = new ew.Form("fajuanproposaledit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fajuanproposaledit;

    // Add fields
    var fields = currentTable.fields;
    fajuanproposaledit.addFields([
        ["idProyek", [fields.idProyek.visible && fields.idProyek.required ? ew.Validators.required(fields.idProyek.caption) : null], fields.idProyek.isInvalid],
        ["idTargetProposal", [fields.idTargetProposal.visible && fields.idTargetProposal.required ? ew.Validators.required(fields.idTargetProposal.caption) : null], fields.idTargetProposal.isInvalid],
        ["tanggalPengajuan", [fields.tanggalPengajuan.visible && fields.tanggalPengajuan.required ? ew.Validators.required(fields.tanggalPengajuan.caption) : null, ew.Validators.datetime(fields.tanggalPengajuan.clientFormatPattern)], fields.tanggalPengajuan.isInvalid],
        ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid]
    ]);

    // Form_CustomValidate
    fajuanproposaledit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fajuanproposaledit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fajuanproposaledit.lists.idProyek = <?= $Page->idProyek->toClientList($Page) ?>;
    fajuanproposaledit.lists.idTargetProposal = <?= $Page->idTargetProposal->toClientList($Page) ?>;
    fajuanproposaledit.lists.status = <?= $Page->status->toClientList($Page) ?>;
    loadjs.done("fajuanproposaledit");
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
<form name="fajuanproposaledit" id="fajuanproposaledit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="ajuanproposal">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->idProyek->Visible) { // idProyek ?>
    <div id="r_idProyek"<?= $Page->idProyek->rowAttributes() ?>>
        <label id="elh_ajuanproposal_idProyek" for="x_idProyek" class="<?= $Page->LeftColumnClass ?>"><?= $Page->idProyek->caption() ?><?= $Page->idProyek->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->idProyek->cellAttributes() ?>>
    <select
        id="x_idProyek"
        name="x_idProyek"
        class="form-select ew-select<?= $Page->idProyek->isInvalidClass() ?>"
        data-select2-id="fajuanproposaledit_x_idProyek"
        data-table="ajuanproposal"
        data-field="x_idProyek"
        data-value-separator="<?= $Page->idProyek->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->idProyek->getPlaceHolder()) ?>"
        <?= $Page->idProyek->editAttributes() ?>>
        <?= $Page->idProyek->selectOptionListHtml("x_idProyek") ?>
    </select>
    <?= $Page->idProyek->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->idProyek->getErrorMessage() ?></div>
<?= $Page->idProyek->Lookup->getParamTag($Page, "p_x_idProyek") ?>
<script>
loadjs.ready("fajuanproposaledit", function() {
    var options = { name: "x_idProyek", selectId: "fajuanproposaledit_x_idProyek" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fajuanproposaledit.lists.idProyek.lookupOptions.length) {
        options.data = { id: "x_idProyek", form: "fajuanproposaledit" };
    } else {
        options.ajax = { id: "x_idProyek", form: "fajuanproposaledit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.ajuanproposal.fields.idProyek.selectOptions);
    ew.createSelect(options);
});
</script>
<input type="hidden" data-table="ajuanproposal" data-field="x_idProyek" data-hidden="1" name="o_idProyek" id="o_idProyek" value="<?= HtmlEncode($Page->idProyek->OldValue ?? $Page->idProyek->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->idTargetProposal->Visible) { // idTargetProposal ?>
    <div id="r_idTargetProposal"<?= $Page->idTargetProposal->rowAttributes() ?>>
        <label id="elh_ajuanproposal_idTargetProposal" for="x_idTargetProposal" class="<?= $Page->LeftColumnClass ?>"><?= $Page->idTargetProposal->caption() ?><?= $Page->idTargetProposal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->idTargetProposal->cellAttributes() ?>>
    <select
        id="x_idTargetProposal"
        name="x_idTargetProposal"
        class="form-select ew-select<?= $Page->idTargetProposal->isInvalidClass() ?>"
        data-select2-id="fajuanproposaledit_x_idTargetProposal"
        data-table="ajuanproposal"
        data-field="x_idTargetProposal"
        data-value-separator="<?= $Page->idTargetProposal->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->idTargetProposal->getPlaceHolder()) ?>"
        <?= $Page->idTargetProposal->editAttributes() ?>>
        <?= $Page->idTargetProposal->selectOptionListHtml("x_idTargetProposal") ?>
    </select>
    <?= $Page->idTargetProposal->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->idTargetProposal->getErrorMessage() ?></div>
<?= $Page->idTargetProposal->Lookup->getParamTag($Page, "p_x_idTargetProposal") ?>
<script>
loadjs.ready("fajuanproposaledit", function() {
    var options = { name: "x_idTargetProposal", selectId: "fajuanproposaledit_x_idTargetProposal" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fajuanproposaledit.lists.idTargetProposal.lookupOptions.length) {
        options.data = { id: "x_idTargetProposal", form: "fajuanproposaledit" };
    } else {
        options.ajax = { id: "x_idTargetProposal", form: "fajuanproposaledit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.ajuanproposal.fields.idTargetProposal.selectOptions);
    ew.createSelect(options);
});
</script>
<input type="hidden" data-table="ajuanproposal" data-field="x_idTargetProposal" data-hidden="1" name="o_idTargetProposal" id="o_idTargetProposal" value="<?= HtmlEncode($Page->idTargetProposal->OldValue ?? $Page->idTargetProposal->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tanggalPengajuan->Visible) { // tanggalPengajuan ?>
    <div id="r_tanggalPengajuan"<?= $Page->tanggalPengajuan->rowAttributes() ?>>
        <label id="elh_ajuanproposal_tanggalPengajuan" for="x_tanggalPengajuan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tanggalPengajuan->caption() ?><?= $Page->tanggalPengajuan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tanggalPengajuan->cellAttributes() ?>>
<span id="el_ajuanproposal_tanggalPengajuan">
<input type="<?= $Page->tanggalPengajuan->getInputTextType() ?>" name="x_tanggalPengajuan" id="x_tanggalPengajuan" data-table="ajuanproposal" data-field="x_tanggalPengajuan" value="<?= $Page->tanggalPengajuan->EditValue ?>" placeholder="<?= HtmlEncode($Page->tanggalPengajuan->getPlaceHolder()) ?>"<?= $Page->tanggalPengajuan->editAttributes() ?> aria-describedby="x_tanggalPengajuan_help">
<?= $Page->tanggalPengajuan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tanggalPengajuan->getErrorMessage() ?></div>
<?php if (!$Page->tanggalPengajuan->ReadOnly && !$Page->tanggalPengajuan->Disabled && !isset($Page->tanggalPengajuan->EditAttrs["readonly"]) && !isset($Page->tanggalPengajuan->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fajuanproposaledit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fajuanproposaledit", "x_tanggalPengajuan", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <div id="r_status"<?= $Page->status->rowAttributes() ?>>
        <label id="elh_ajuanproposal_status" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status->caption() ?><?= $Page->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->status->cellAttributes() ?>>
<span id="el_ajuanproposal_status">
<template id="tp_x_status">
    <div class="form-check">
        <input type="radio" class="form-check-input" data-table="ajuanproposal" data-field="x_status" name="x_status" id="x_status"<?= $Page->status->editAttributes() ?>>
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
    data-table="ajuanproposal"
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
    ew.addEventHandlers("ajuanproposal");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
