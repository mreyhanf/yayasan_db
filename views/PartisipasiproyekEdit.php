<?php

namespace PHPMaker2022\project1;

// Page object
$PartisipasiproyekEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { partisipasiproyek: currentTable } });
var currentForm, currentPageID;
var fpartisipasiproyekedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fpartisipasiproyekedit = new ew.Form("fpartisipasiproyekedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fpartisipasiproyekedit;

    // Add fields
    var fields = currentTable.fields;
    fpartisipasiproyekedit.addFields([
        ["idAnggota", [fields.idAnggota.visible && fields.idAnggota.required ? ew.Validators.required(fields.idAnggota.caption) : null], fields.idAnggota.isInvalid],
        ["idProyek", [fields.idProyek.visible && fields.idProyek.required ? ew.Validators.required(fields.idProyek.caption) : null], fields.idProyek.isInvalid]
    ]);

    // Form_CustomValidate
    fpartisipasiproyekedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fpartisipasiproyekedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fpartisipasiproyekedit.lists.idAnggota = <?= $Page->idAnggota->toClientList($Page) ?>;
    fpartisipasiproyekedit.lists.idProyek = <?= $Page->idProyek->toClientList($Page) ?>;
    loadjs.done("fpartisipasiproyekedit");
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
<form name="fpartisipasiproyekedit" id="fpartisipasiproyekedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="partisipasiproyek">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "proyek") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="proyek">
<input type="hidden" name="fk_idProyek" value="<?= HtmlEncode($Page->idProyek->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->idAnggota->Visible) { // idAnggota ?>
    <div id="r_idAnggota"<?= $Page->idAnggota->rowAttributes() ?>>
        <label id="elh_partisipasiproyek_idAnggota" for="x_idAnggota" class="<?= $Page->LeftColumnClass ?>"><?= $Page->idAnggota->caption() ?><?= $Page->idAnggota->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->idAnggota->cellAttributes() ?>>
    <select
        id="x_idAnggota"
        name="x_idAnggota"
        class="form-select ew-select<?= $Page->idAnggota->isInvalidClass() ?>"
        data-select2-id="fpartisipasiproyekedit_x_idAnggota"
        data-table="partisipasiproyek"
        data-field="x_idAnggota"
        data-value-separator="<?= $Page->idAnggota->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->idAnggota->getPlaceHolder()) ?>"
        <?= $Page->idAnggota->editAttributes() ?>>
        <?= $Page->idAnggota->selectOptionListHtml("x_idAnggota") ?>
    </select>
    <?= $Page->idAnggota->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->idAnggota->getErrorMessage() ?></div>
<?= $Page->idAnggota->Lookup->getParamTag($Page, "p_x_idAnggota") ?>
<script>
loadjs.ready("fpartisipasiproyekedit", function() {
    var options = { name: "x_idAnggota", selectId: "fpartisipasiproyekedit_x_idAnggota" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fpartisipasiproyekedit.lists.idAnggota.lookupOptions.length) {
        options.data = { id: "x_idAnggota", form: "fpartisipasiproyekedit" };
    } else {
        options.ajax = { id: "x_idAnggota", form: "fpartisipasiproyekedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.partisipasiproyek.fields.idAnggota.selectOptions);
    ew.createSelect(options);
});
</script>
<input type="hidden" data-table="partisipasiproyek" data-field="x_idAnggota" data-hidden="1" name="o_idAnggota" id="o_idAnggota" value="<?= HtmlEncode($Page->idAnggota->OldValue ?? $Page->idAnggota->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->idProyek->Visible) { // idProyek ?>
    <div id="r_idProyek"<?= $Page->idProyek->rowAttributes() ?>>
        <label id="elh_partisipasiproyek_idProyek" for="x_idProyek" class="<?= $Page->LeftColumnClass ?>"><?= $Page->idProyek->caption() ?><?= $Page->idProyek->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->idProyek->cellAttributes() ?>>
<?php if ($Page->idProyek->getSessionValue() != "") { ?>
<span id="el_partisipasiproyek_idProyek">
<span<?= $Page->idProyek->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->idProyek->getDisplayValue($Page->idProyek->EditValue) ?></span></span>
</span>
<input type="hidden" id="x_idProyek" name="x_idProyek" value="<?= HtmlEncode($Page->idProyek->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
    <select
        id="x_idProyek"
        name="x_idProyek"
        class="form-select ew-select<?= $Page->idProyek->isInvalidClass() ?>"
        data-select2-id="fpartisipasiproyekedit_x_idProyek"
        data-table="partisipasiproyek"
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
loadjs.ready("fpartisipasiproyekedit", function() {
    var options = { name: "x_idProyek", selectId: "fpartisipasiproyekedit_x_idProyek" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fpartisipasiproyekedit.lists.idProyek.lookupOptions.length) {
        options.data = { id: "x_idProyek", form: "fpartisipasiproyekedit" };
    } else {
        options.ajax = { id: "x_idProyek", form: "fpartisipasiproyekedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.partisipasiproyek.fields.idProyek.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
<input type="hidden" data-table="partisipasiproyek" data-field="x_idProyek" data-hidden="1" name="o_idProyek" id="o_idProyek" value="<?= HtmlEncode($Page->idProyek->OldValue ?? $Page->idProyek->CurrentValue) ?>">
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
    ew.addEventHandlers("partisipasiproyek");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
