<?php

namespace PHPMaker2022\project1;

// Page object
$KontakanggotaAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { kontakanggota: currentTable } });
var currentForm, currentPageID;
var fkontakanggotaadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fkontakanggotaadd = new ew.Form("fkontakanggotaadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fkontakanggotaadd;

    // Add fields
    var fields = currentTable.fields;
    fkontakanggotaadd.addFields([
        ["kontak", [fields.kontak.visible && fields.kontak.required ? ew.Validators.required(fields.kontak.caption) : null], fields.kontak.isInvalid],
        ["idAnggota", [fields.idAnggota.visible && fields.idAnggota.required ? ew.Validators.required(fields.idAnggota.caption) : null], fields.idAnggota.isInvalid]
    ]);

    // Form_CustomValidate
    fkontakanggotaadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fkontakanggotaadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fkontakanggotaadd.lists.idAnggota = <?= $Page->idAnggota->toClientList($Page) ?>;
    loadjs.done("fkontakanggotaadd");
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
<form name="fkontakanggotaadd" id="fkontakanggotaadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="kontakanggota">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "anggota") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="anggota">
<input type="hidden" name="fk_idAnggota" value="<?= HtmlEncode($Page->idAnggota->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->kontak->Visible) { // kontak ?>
    <div id="r_kontak"<?= $Page->kontak->rowAttributes() ?>>
        <label id="elh_kontakanggota_kontak" for="x_kontak" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kontak->caption() ?><?= $Page->kontak->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->kontak->cellAttributes() ?>>
<span id="el_kontakanggota_kontak">
<input type="<?= $Page->kontak->getInputTextType() ?>" name="x_kontak" id="x_kontak" data-table="kontakanggota" data-field="x_kontak" value="<?= $Page->kontak->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->kontak->getPlaceHolder()) ?>"<?= $Page->kontak->editAttributes() ?> aria-describedby="x_kontak_help">
<?= $Page->kontak->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kontak->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->idAnggota->Visible) { // idAnggota ?>
    <div id="r_idAnggota"<?= $Page->idAnggota->rowAttributes() ?>>
        <label id="elh_kontakanggota_idAnggota" for="x_idAnggota" class="<?= $Page->LeftColumnClass ?>"><?= $Page->idAnggota->caption() ?><?= $Page->idAnggota->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->idAnggota->cellAttributes() ?>>
<?php if ($Page->idAnggota->getSessionValue() != "") { ?>
<span id="el_kontakanggota_idAnggota">
<span<?= $Page->idAnggota->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->idAnggota->getDisplayValue($Page->idAnggota->ViewValue) ?></span></span>
</span>
<input type="hidden" id="x_idAnggota" name="x_idAnggota" value="<?= HtmlEncode(FormatNumber($Page->idAnggota->CurrentValue, $Page->idAnggota->formatPattern())) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_kontakanggota_idAnggota">
    <select
        id="x_idAnggota"
        name="x_idAnggota"
        class="form-select ew-select<?= $Page->idAnggota->isInvalidClass() ?>"
        data-select2-id="fkontakanggotaadd_x_idAnggota"
        data-table="kontakanggota"
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
loadjs.ready("fkontakanggotaadd", function() {
    var options = { name: "x_idAnggota", selectId: "fkontakanggotaadd_x_idAnggota" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fkontakanggotaadd.lists.idAnggota.lookupOptions.length) {
        options.data = { id: "x_idAnggota", form: "fkontakanggotaadd" };
    } else {
        options.ajax = { id: "x_idAnggota", form: "fkontakanggotaadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.kontakanggota.fields.idAnggota.selectOptions);
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
    ew.addEventHandlers("kontakanggota");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
