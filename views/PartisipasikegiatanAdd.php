<?php

namespace PHPMaker2022\project1;

// Page object
$PartisipasikegiatanAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { partisipasikegiatan: currentTable } });
var currentForm, currentPageID;
var fpartisipasikegiatanadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fpartisipasikegiatanadd = new ew.Form("fpartisipasikegiatanadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fpartisipasikegiatanadd;

    // Add fields
    var fields = currentTable.fields;
    fpartisipasikegiatanadd.addFields([
        ["idAnggota", [fields.idAnggota.visible && fields.idAnggota.required ? ew.Validators.required(fields.idAnggota.caption) : null], fields.idAnggota.isInvalid],
        ["idKegiatan", [fields.idKegiatan.visible && fields.idKegiatan.required ? ew.Validators.required(fields.idKegiatan.caption) : null], fields.idKegiatan.isInvalid]
    ]);

    // Form_CustomValidate
    fpartisipasikegiatanadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fpartisipasikegiatanadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fpartisipasikegiatanadd.lists.idAnggota = <?= $Page->idAnggota->toClientList($Page) ?>;
    fpartisipasikegiatanadd.lists.idKegiatan = <?= $Page->idKegiatan->toClientList($Page) ?>;
    loadjs.done("fpartisipasikegiatanadd");
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
<form name="fpartisipasikegiatanadd" id="fpartisipasikegiatanadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="partisipasikegiatan">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "kegiatan") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="kegiatan">
<input type="hidden" name="fk_idKegiatan" value="<?= HtmlEncode($Page->idKegiatan->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->idAnggota->Visible) { // idAnggota ?>
    <div id="r_idAnggota"<?= $Page->idAnggota->rowAttributes() ?>>
        <label id="elh_partisipasikegiatan_idAnggota" for="x_idAnggota" class="<?= $Page->LeftColumnClass ?>"><?= $Page->idAnggota->caption() ?><?= $Page->idAnggota->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->idAnggota->cellAttributes() ?>>
<span id="el_partisipasikegiatan_idAnggota">
    <select
        id="x_idAnggota"
        name="x_idAnggota"
        class="form-select ew-select<?= $Page->idAnggota->isInvalidClass() ?>"
        data-select2-id="fpartisipasikegiatanadd_x_idAnggota"
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
loadjs.ready("fpartisipasikegiatanadd", function() {
    var options = { name: "x_idAnggota", selectId: "fpartisipasikegiatanadd_x_idAnggota" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fpartisipasikegiatanadd.lists.idAnggota.lookupOptions.length) {
        options.data = { id: "x_idAnggota", form: "fpartisipasikegiatanadd" };
    } else {
        options.ajax = { id: "x_idAnggota", form: "fpartisipasikegiatanadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.partisipasikegiatan.fields.idAnggota.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
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
<span class="form-control-plaintext"><?= $Page->idKegiatan->getDisplayValue($Page->idKegiatan->ViewValue) ?></span></span>
</span>
<input type="hidden" id="x_idKegiatan" name="x_idKegiatan" value="<?= HtmlEncode(FormatNumber($Page->idKegiatan->CurrentValue, $Page->idKegiatan->formatPattern())) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_partisipasikegiatan_idKegiatan">
    <select
        id="x_idKegiatan"
        name="x_idKegiatan"
        class="form-select ew-select<?= $Page->idKegiatan->isInvalidClass() ?>"
        data-select2-id="fpartisipasikegiatanadd_x_idKegiatan"
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
loadjs.ready("fpartisipasikegiatanadd", function() {
    var options = { name: "x_idKegiatan", selectId: "fpartisipasikegiatanadd_x_idKegiatan" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fpartisipasikegiatanadd.lists.idKegiatan.lookupOptions.length) {
        options.data = { id: "x_idKegiatan", form: "fpartisipasikegiatanadd" };
    } else {
        options.ajax = { id: "x_idKegiatan", form: "fpartisipasikegiatanadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.partisipasikegiatan.fields.idKegiatan.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Page->IsModal) { ?>
<div class="row"><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("AddBtn") ?></button>
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
