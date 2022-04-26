<?php

namespace PHPMaker2022\project1;

// Page object
$PartisipasikegiatanEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { partisipasikegiatan: currentTable } });
var currentForm, currentPageID;
var fpartisipasikegiatanedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fpartisipasikegiatanedit = new ew.Form("fpartisipasikegiatanedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fpartisipasikegiatanedit;

    // Add fields
    var fields = currentTable.fields;
    fpartisipasikegiatanedit.addFields([
        ["idAnggota", [fields.idAnggota.visible && fields.idAnggota.required ? ew.Validators.required(fields.idAnggota.caption) : null], fields.idAnggota.isInvalid],
        ["idKegiatan", [fields.idKegiatan.visible && fields.idKegiatan.required ? ew.Validators.required(fields.idKegiatan.caption) : null], fields.idKegiatan.isInvalid]
    ]);

    // Form_CustomValidate
    fpartisipasikegiatanedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fpartisipasikegiatanedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fpartisipasikegiatanedit.lists.idAnggota = <?= $Page->idAnggota->toClientList($Page) ?>;
    fpartisipasikegiatanedit.lists.idKegiatan = <?= $Page->idKegiatan->toClientList($Page) ?>;
    loadjs.done("fpartisipasikegiatanedit");
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
<form name="fpartisipasikegiatanedit" id="fpartisipasikegiatanedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="partisipasikegiatan">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "kegiatan") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="kegiatan">
<input type="hidden" name="fk_idKegiatan" value="<?= HtmlEncode($Page->idKegiatan->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->idAnggota->Visible) { // idAnggota ?>
    <div id="r_idAnggota"<?= $Page->idAnggota->rowAttributes() ?>>
        <label id="elh_partisipasikegiatan_idAnggota" for="x_idAnggota" class="<?= $Page->LeftColumnClass ?>"><?= $Page->idAnggota->caption() ?><?= $Page->idAnggota->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->idAnggota->cellAttributes() ?>>
    <select
        id="x_idAnggota"
        name="x_idAnggota"
        class="form-select ew-select<?= $Page->idAnggota->isInvalidClass() ?>"
        data-select2-id="fpartisipasikegiatanedit_x_idAnggota"
        data-table="partisipasikegiatan"
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
loadjs.ready("fpartisipasikegiatanedit", function() {
    var options = { name: "x_idAnggota", selectId: "fpartisipasikegiatanedit_x_idAnggota" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fpartisipasikegiatanedit.lists.idAnggota.lookupOptions.length) {
        options.data = { id: "x_idAnggota", form: "fpartisipasikegiatanedit" };
    } else {
        options.ajax = { id: "x_idAnggota", form: "fpartisipasikegiatanedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.partisipasikegiatan.fields.idAnggota.selectOptions);
    ew.createSelect(options);
});
</script>
<input type="hidden" data-table="partisipasikegiatan" data-field="x_idAnggota" data-hidden="1" name="o_idAnggota" id="o_idAnggota" value="<?= HtmlEncode($Page->idAnggota->OldValue ?? $Page->idAnggota->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->idKegiatan->Visible) { // idKegiatan ?>
    <div id="r_idKegiatan"<?= $Page->idKegiatan->rowAttributes() ?>>
        <label id="elh_partisipasikegiatan_idKegiatan" for="x_idKegiatan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->idKegiatan->caption() ?><?= $Page->idKegiatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->idKegiatan->cellAttributes() ?>>
<?php if ($Page->idKegiatan->getSessionValue() != "") { ?>
<span id="el_partisipasikegiatan_idKegiatan">
<span<?= $Page->idKegiatan->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->idKegiatan->getDisplayValue($Page->idKegiatan->EditValue) ?></span></span>
</span>
<input type="hidden" id="x_idKegiatan" name="x_idKegiatan" value="<?= HtmlEncode($Page->idKegiatan->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
    <select
        id="x_idKegiatan"
        name="x_idKegiatan"
        class="form-select ew-select<?= $Page->idKegiatan->isInvalidClass() ?>"
        data-select2-id="fpartisipasikegiatanedit_x_idKegiatan"
        data-table="partisipasikegiatan"
        data-field="x_idKegiatan"
        data-value-separator="<?= $Page->idKegiatan->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->idKegiatan->getPlaceHolder()) ?>"
        <?= $Page->idKegiatan->editAttributes() ?>>
        <?= $Page->idKegiatan->selectOptionListHtml("x_idKegiatan") ?>
    </select>
    <?= $Page->idKegiatan->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->idKegiatan->getErrorMessage() ?></div>
<?= $Page->idKegiatan->Lookup->getParamTag($Page, "p_x_idKegiatan") ?>
<script>
loadjs.ready("fpartisipasikegiatanedit", function() {
    var options = { name: "x_idKegiatan", selectId: "fpartisipasikegiatanedit_x_idKegiatan" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fpartisipasikegiatanedit.lists.idKegiatan.lookupOptions.length) {
        options.data = { id: "x_idKegiatan", form: "fpartisipasikegiatanedit" };
    } else {
        options.ajax = { id: "x_idKegiatan", form: "fpartisipasikegiatanedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.partisipasikegiatan.fields.idKegiatan.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
<input type="hidden" data-table="partisipasikegiatan" data-field="x_idKegiatan" data-hidden="1" name="o_idKegiatan" id="o_idKegiatan" value="<?= HtmlEncode($Page->idKegiatan->OldValue ?? $Page->idKegiatan->CurrentValue) ?>">
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
    ew.addEventHandlers("partisipasikegiatan");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
