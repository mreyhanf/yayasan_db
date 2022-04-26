<?php

namespace PHPMaker2022\project1;

// Page object
$TargetproposalEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { targetproposal: currentTable } });
var currentForm, currentPageID;
var ftargetproposaledit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    ftargetproposaledit = new ew.Form("ftargetproposaledit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = ftargetproposaledit;

    // Add fields
    var fields = currentTable.fields;
    ftargetproposaledit.addFields([
        ["idTargetProposal", [fields.idTargetProposal.visible && fields.idTargetProposal.required ? ew.Validators.required(fields.idTargetProposal.caption) : null], fields.idTargetProposal.isInvalid],
        ["nama", [fields.nama.visible && fields.nama.required ? ew.Validators.required(fields.nama.caption) : null], fields.nama.isInvalid],
        ["jenis", [fields.jenis.visible && fields.jenis.required ? ew.Validators.required(fields.jenis.caption) : null], fields.jenis.isInvalid]
    ]);

    // Form_CustomValidate
    ftargetproposaledit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    ftargetproposaledit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    ftargetproposaledit.lists.jenis = <?= $Page->jenis->toClientList($Page) ?>;
    loadjs.done("ftargetproposaledit");
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
<form name="ftargetproposaledit" id="ftargetproposaledit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="targetproposal">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->idTargetProposal->Visible) { // idTargetProposal ?>
    <div id="r_idTargetProposal"<?= $Page->idTargetProposal->rowAttributes() ?>>
        <label id="elh_targetproposal_idTargetProposal" class="<?= $Page->LeftColumnClass ?>"><?= $Page->idTargetProposal->caption() ?><?= $Page->idTargetProposal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->idTargetProposal->cellAttributes() ?>>
<span id="el_targetproposal_idTargetProposal">
<span<?= $Page->idTargetProposal->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->idTargetProposal->getDisplayValue($Page->idTargetProposal->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="targetproposal" data-field="x_idTargetProposal" data-hidden="1" name="x_idTargetProposal" id="x_idTargetProposal" value="<?= HtmlEncode($Page->idTargetProposal->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nama->Visible) { // nama ?>
    <div id="r_nama"<?= $Page->nama->rowAttributes() ?>>
        <label id="elh_targetproposal_nama" for="x_nama" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nama->caption() ?><?= $Page->nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->nama->cellAttributes() ?>>
<span id="el_targetproposal_nama">
<input type="<?= $Page->nama->getInputTextType() ?>" name="x_nama" id="x_nama" data-table="targetproposal" data-field="x_nama" value="<?= $Page->nama->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->nama->getPlaceHolder()) ?>"<?= $Page->nama->editAttributes() ?> aria-describedby="x_nama_help">
<?= $Page->nama->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nama->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jenis->Visible) { // jenis ?>
    <div id="r_jenis"<?= $Page->jenis->rowAttributes() ?>>
        <label id="elh_targetproposal_jenis" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jenis->caption() ?><?= $Page->jenis->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->jenis->cellAttributes() ?>>
<span id="el_targetproposal_jenis">
<template id="tp_x_jenis">
    <div class="form-check">
        <input type="radio" class="form-check-input" data-table="targetproposal" data-field="x_jenis" name="x_jenis" id="x_jenis"<?= $Page->jenis->editAttributes() ?>>
        <label class="form-check-label"></label>
    </div>
</template>
<div id="dsl_x_jenis" class="ew-item-list"></div>
<selection-list hidden
    id="x_jenis"
    name="x_jenis"
    value="<?= HtmlEncode($Page->jenis->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_jenis"
    data-bs-target="dsl_x_jenis"
    data-repeatcolumn="5"
    class="form-control<?= $Page->jenis->isInvalidClass() ?>"
    data-table="targetproposal"
    data-field="x_jenis"
    data-value-separator="<?= $Page->jenis->displayValueSeparatorAttribute() ?>"
    <?= $Page->jenis->editAttributes() ?>></selection-list>
<?= $Page->jenis->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->jenis->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php
    if (in_array("kontaktargetproposal", explode(",", $Page->getCurrentDetailTable())) && $kontaktargetproposal->DetailEdit) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("kontaktargetproposal", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "KontaktargetproposalGrid.php" ?>
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
    ew.addEventHandlers("targetproposal");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>