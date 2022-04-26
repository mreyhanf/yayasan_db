<?php

namespace PHPMaker2022\project1;

// Page object
$KontakdonaturAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { kontakdonatur: currentTable } });
var currentForm, currentPageID;
var fkontakdonaturadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fkontakdonaturadd = new ew.Form("fkontakdonaturadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fkontakdonaturadd;

    // Add fields
    var fields = currentTable.fields;
    fkontakdonaturadd.addFields([
        ["kontak", [fields.kontak.visible && fields.kontak.required ? ew.Validators.required(fields.kontak.caption) : null], fields.kontak.isInvalid],
        ["idDonatur", [fields.idDonatur.visible && fields.idDonatur.required ? ew.Validators.required(fields.idDonatur.caption) : null], fields.idDonatur.isInvalid]
    ]);

    // Form_CustomValidate
    fkontakdonaturadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fkontakdonaturadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fkontakdonaturadd.lists.idDonatur = <?= $Page->idDonatur->toClientList($Page) ?>;
    loadjs.done("fkontakdonaturadd");
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
<form name="fkontakdonaturadd" id="fkontakdonaturadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="kontakdonatur">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "donatur") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="donatur">
<input type="hidden" name="fk_idDonatur" value="<?= HtmlEncode($Page->idDonatur->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->kontak->Visible) { // kontak ?>
    <div id="r_kontak"<?= $Page->kontak->rowAttributes() ?>>
        <label id="elh_kontakdonatur_kontak" for="x_kontak" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kontak->caption() ?><?= $Page->kontak->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->kontak->cellAttributes() ?>>
<span id="el_kontakdonatur_kontak">
<input type="<?= $Page->kontak->getInputTextType() ?>" name="x_kontak" id="x_kontak" data-table="kontakdonatur" data-field="x_kontak" value="<?= $Page->kontak->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->kontak->getPlaceHolder()) ?>"<?= $Page->kontak->editAttributes() ?> aria-describedby="x_kontak_help">
<?= $Page->kontak->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kontak->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->idDonatur->Visible) { // idDonatur ?>
    <div id="r_idDonatur"<?= $Page->idDonatur->rowAttributes() ?>>
        <label id="elh_kontakdonatur_idDonatur" for="x_idDonatur" class="<?= $Page->LeftColumnClass ?>"><?= $Page->idDonatur->caption() ?><?= $Page->idDonatur->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->idDonatur->cellAttributes() ?>>
<?php if ($Page->idDonatur->getSessionValue() != "") { ?>
<span id="el_kontakdonatur_idDonatur">
<span<?= $Page->idDonatur->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->idDonatur->getDisplayValue($Page->idDonatur->ViewValue) ?></span></span>
</span>
<input type="hidden" id="x_idDonatur" name="x_idDonatur" value="<?= HtmlEncode(FormatNumber($Page->idDonatur->CurrentValue, $Page->idDonatur->formatPattern())) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_kontakdonatur_idDonatur">
    <select
        id="x_idDonatur"
        name="x_idDonatur"
        class="form-select ew-select<?= $Page->idDonatur->isInvalidClass() ?>"
        data-select2-id="fkontakdonaturadd_x_idDonatur"
        data-table="kontakdonatur"
        data-field="x_idDonatur"
        data-value-separator="<?= $Page->idDonatur->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->idDonatur->getPlaceHolder()) ?>"
        <?= $Page->idDonatur->editAttributes() ?>>
        <?= $Page->idDonatur->selectOptionListHtml("x_idDonatur") ?>
    </select>
    <?= $Page->idDonatur->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->idDonatur->getErrorMessage() ?></div>
<?= $Page->idDonatur->Lookup->getParamTag($Page, "p_x_idDonatur") ?>
<script>
loadjs.ready("fkontakdonaturadd", function() {
    var options = { name: "x_idDonatur", selectId: "fkontakdonaturadd_x_idDonatur" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fkontakdonaturadd.lists.idDonatur.lookupOptions.length) {
        options.data = { id: "x_idDonatur", form: "fkontakdonaturadd" };
    } else {
        options.ajax = { id: "x_idDonatur", form: "fkontakdonaturadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.kontakdonatur.fields.idDonatur.selectOptions);
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
    ew.addEventHandlers("kontakdonatur");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
