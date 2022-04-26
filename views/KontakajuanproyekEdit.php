<?php

namespace PHPMaker2022\project1;

// Page object
$KontakajuanproyekEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { kontakajuanproyek: currentTable } });
var currentForm, currentPageID;
var fkontakajuanproyekedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fkontakajuanproyekedit = new ew.Form("fkontakajuanproyekedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fkontakajuanproyekedit;

    // Add fields
    var fields = currentTable.fields;
    fkontakajuanproyekedit.addFields([
        ["kontak", [fields.kontak.visible && fields.kontak.required ? ew.Validators.required(fields.kontak.caption) : null], fields.kontak.isInvalid],
        ["idAjuanProyek", [fields.idAjuanProyek.visible && fields.idAjuanProyek.required ? ew.Validators.required(fields.idAjuanProyek.caption) : null], fields.idAjuanProyek.isInvalid]
    ]);

    // Form_CustomValidate
    fkontakajuanproyekedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fkontakajuanproyekedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fkontakajuanproyekedit.lists.idAjuanProyek = <?= $Page->idAjuanProyek->toClientList($Page) ?>;
    loadjs.done("fkontakajuanproyekedit");
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
<form name="fkontakajuanproyekedit" id="fkontakajuanproyekedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="kontakajuanproyek">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "ajuanproyek") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="ajuanproyek">
<input type="hidden" name="fk_idAjuanProyek" value="<?= HtmlEncode($Page->idAjuanProyek->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->kontak->Visible) { // kontak ?>
    <div id="r_kontak"<?= $Page->kontak->rowAttributes() ?>>
        <label id="elh_kontakajuanproyek_kontak" for="x_kontak" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kontak->caption() ?><?= $Page->kontak->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->kontak->cellAttributes() ?>>
<input type="<?= $Page->kontak->getInputTextType() ?>" name="x_kontak" id="x_kontak" data-table="kontakajuanproyek" data-field="x_kontak" value="<?= $Page->kontak->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->kontak->getPlaceHolder()) ?>"<?= $Page->kontak->editAttributes() ?> aria-describedby="x_kontak_help">
<?= $Page->kontak->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kontak->getErrorMessage() ?></div>
<input type="hidden" data-table="kontakajuanproyek" data-field="x_kontak" data-hidden="1" name="o_kontak" id="o_kontak" value="<?= HtmlEncode($Page->kontak->OldValue ?? $Page->kontak->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->idAjuanProyek->Visible) { // idAjuanProyek ?>
    <div id="r_idAjuanProyek"<?= $Page->idAjuanProyek->rowAttributes() ?>>
        <label id="elh_kontakajuanproyek_idAjuanProyek" for="x_idAjuanProyek" class="<?= $Page->LeftColumnClass ?>"><?= $Page->idAjuanProyek->caption() ?><?= $Page->idAjuanProyek->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->idAjuanProyek->cellAttributes() ?>>
<?php if ($Page->idAjuanProyek->getSessionValue() != "") { ?>
<span id="el_kontakajuanproyek_idAjuanProyek">
<span<?= $Page->idAjuanProyek->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->idAjuanProyek->getDisplayValue($Page->idAjuanProyek->ViewValue) ?></span></span>
</span>
<input type="hidden" id="x_idAjuanProyek" name="x_idAjuanProyek" value="<?= HtmlEncode(FormatNumber($Page->idAjuanProyek->CurrentValue, $Page->idAjuanProyek->formatPattern())) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_kontakajuanproyek_idAjuanProyek">
    <select
        id="x_idAjuanProyek"
        name="x_idAjuanProyek"
        class="form-select ew-select<?= $Page->idAjuanProyek->isInvalidClass() ?>"
        data-select2-id="fkontakajuanproyekedit_x_idAjuanProyek"
        data-table="kontakajuanproyek"
        data-field="x_idAjuanProyek"
        data-value-separator="<?= $Page->idAjuanProyek->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->idAjuanProyek->getPlaceHolder()) ?>"
        <?= $Page->idAjuanProyek->editAttributes() ?>>
        <?= $Page->idAjuanProyek->selectOptionListHtml("x_idAjuanProyek") ?>
    </select>
    <?= $Page->idAjuanProyek->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->idAjuanProyek->getErrorMessage() ?></div>
<?= $Page->idAjuanProyek->Lookup->getParamTag($Page, "p_x_idAjuanProyek") ?>
<script>
loadjs.ready("fkontakajuanproyekedit", function() {
    var options = { name: "x_idAjuanProyek", selectId: "fkontakajuanproyekedit_x_idAjuanProyek" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fkontakajuanproyekedit.lists.idAjuanProyek.lookupOptions.length) {
        options.data = { id: "x_idAjuanProyek", form: "fkontakajuanproyekedit" };
    } else {
        options.ajax = { id: "x_idAjuanProyek", form: "fkontakajuanproyekedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.kontakajuanproyek.fields.idAjuanProyek.selectOptions);
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
    ew.addEventHandlers("kontakajuanproyek");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
