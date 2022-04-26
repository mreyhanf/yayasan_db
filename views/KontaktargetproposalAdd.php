<?php

namespace PHPMaker2022\project1;

// Page object
$KontaktargetproposalAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { kontaktargetproposal: currentTable } });
var currentForm, currentPageID;
var fkontaktargetproposaladd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fkontaktargetproposaladd = new ew.Form("fkontaktargetproposaladd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fkontaktargetproposaladd;

    // Add fields
    var fields = currentTable.fields;
    fkontaktargetproposaladd.addFields([
        ["kontak", [fields.kontak.visible && fields.kontak.required ? ew.Validators.required(fields.kontak.caption) : null], fields.kontak.isInvalid],
        ["idTargetProposal", [fields.idTargetProposal.visible && fields.idTargetProposal.required ? ew.Validators.required(fields.idTargetProposal.caption) : null], fields.idTargetProposal.isInvalid]
    ]);

    // Form_CustomValidate
    fkontaktargetproposaladd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fkontaktargetproposaladd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fkontaktargetproposaladd.lists.idTargetProposal = <?= $Page->idTargetProposal->toClientList($Page) ?>;
    loadjs.done("fkontaktargetproposaladd");
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
<form name="fkontaktargetproposaladd" id="fkontaktargetproposaladd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="kontaktargetproposal">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "targetproposal") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="targetproposal">
<input type="hidden" name="fk_idTargetProposal" value="<?= HtmlEncode($Page->idTargetProposal->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->kontak->Visible) { // kontak ?>
    <div id="r_kontak"<?= $Page->kontak->rowAttributes() ?>>
        <label id="elh_kontaktargetproposal_kontak" for="x_kontak" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kontak->caption() ?><?= $Page->kontak->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->kontak->cellAttributes() ?>>
<span id="el_kontaktargetproposal_kontak">
<input type="<?= $Page->kontak->getInputTextType() ?>" name="x_kontak" id="x_kontak" data-table="kontaktargetproposal" data-field="x_kontak" value="<?= $Page->kontak->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->kontak->getPlaceHolder()) ?>"<?= $Page->kontak->editAttributes() ?> aria-describedby="x_kontak_help">
<?= $Page->kontak->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kontak->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->idTargetProposal->Visible) { // idTargetProposal ?>
    <div id="r_idTargetProposal"<?= $Page->idTargetProposal->rowAttributes() ?>>
        <label id="elh_kontaktargetproposal_idTargetProposal" for="x_idTargetProposal" class="<?= $Page->LeftColumnClass ?>"><?= $Page->idTargetProposal->caption() ?><?= $Page->idTargetProposal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->idTargetProposal->cellAttributes() ?>>
<?php if ($Page->idTargetProposal->getSessionValue() != "") { ?>
<span id="el_kontaktargetproposal_idTargetProposal">
<span<?= $Page->idTargetProposal->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->idTargetProposal->getDisplayValue($Page->idTargetProposal->ViewValue) ?></span></span>
</span>
<input type="hidden" id="x_idTargetProposal" name="x_idTargetProposal" value="<?= HtmlEncode(FormatNumber($Page->idTargetProposal->CurrentValue, $Page->idTargetProposal->formatPattern())) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_kontaktargetproposal_idTargetProposal">
    <select
        id="x_idTargetProposal"
        name="x_idTargetProposal"
        class="form-select ew-select<?= $Page->idTargetProposal->isInvalidClass() ?>"
        data-select2-id="fkontaktargetproposaladd_x_idTargetProposal"
        data-table="kontaktargetproposal"
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
loadjs.ready("fkontaktargetproposaladd", function() {
    var options = { name: "x_idTargetProposal", selectId: "fkontaktargetproposaladd_x_idTargetProposal" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fkontaktargetproposaladd.lists.idTargetProposal.lookupOptions.length) {
        options.data = { id: "x_idTargetProposal", form: "fkontaktargetproposaladd" };
    } else {
        options.ajax = { id: "x_idTargetProposal", form: "fkontaktargetproposaladd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.kontaktargetproposal.fields.idTargetProposal.selectOptions);
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
    ew.addEventHandlers("kontaktargetproposal");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
