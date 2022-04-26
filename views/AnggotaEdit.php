<?php

namespace PHPMaker2022\project1;

// Page object
$AnggotaEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { anggota: currentTable } });
var currentForm, currentPageID;
var fanggotaedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fanggotaedit = new ew.Form("fanggotaedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fanggotaedit;

    // Add fields
    var fields = currentTable.fields;
    fanggotaedit.addFields([
        ["idAnggota", [fields.idAnggota.visible && fields.idAnggota.required ? ew.Validators.required(fields.idAnggota.caption) : null], fields.idAnggota.isInvalid],
        ["nama", [fields.nama.visible && fields.nama.required ? ew.Validators.required(fields.nama.caption) : null], fields.nama.isInvalid],
        ["idJabatan", [fields.idJabatan.visible && fields.idJabatan.required ? ew.Validators.required(fields.idJabatan.caption) : null], fields.idJabatan.isInvalid],
        ["alamat", [fields.alamat.visible && fields.alamat.required ? ew.Validators.required(fields.alamat.caption) : null], fields.alamat.isInvalid],
        ["kesibukan", [fields.kesibukan.visible && fields.kesibukan.required ? ew.Validators.required(fields.kesibukan.caption) : null], fields.kesibukan.isInvalid]
    ]);

    // Form_CustomValidate
    fanggotaedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fanggotaedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fanggotaedit.lists.idJabatan = <?= $Page->idJabatan->toClientList($Page) ?>;
    fanggotaedit.lists.kesibukan = <?= $Page->kesibukan->toClientList($Page) ?>;
    loadjs.done("fanggotaedit");
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
<form name="fanggotaedit" id="fanggotaedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="anggota">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->idAnggota->Visible) { // idAnggota ?>
    <div id="r_idAnggota"<?= $Page->idAnggota->rowAttributes() ?>>
        <label id="elh_anggota_idAnggota" class="<?= $Page->LeftColumnClass ?>"><?= $Page->idAnggota->caption() ?><?= $Page->idAnggota->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->idAnggota->cellAttributes() ?>>
<span id="el_anggota_idAnggota">
<span<?= $Page->idAnggota->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->idAnggota->getDisplayValue($Page->idAnggota->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="anggota" data-field="x_idAnggota" data-hidden="1" name="x_idAnggota" id="x_idAnggota" value="<?= HtmlEncode($Page->idAnggota->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nama->Visible) { // nama ?>
    <div id="r_nama"<?= $Page->nama->rowAttributes() ?>>
        <label id="elh_anggota_nama" for="x_nama" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nama->caption() ?><?= $Page->nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->nama->cellAttributes() ?>>
<span id="el_anggota_nama">
<input type="<?= $Page->nama->getInputTextType() ?>" name="x_nama" id="x_nama" data-table="anggota" data-field="x_nama" value="<?= $Page->nama->EditValue ?>" size="30" maxlength="30" placeholder="<?= HtmlEncode($Page->nama->getPlaceHolder()) ?>"<?= $Page->nama->editAttributes() ?> aria-describedby="x_nama_help">
<?= $Page->nama->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nama->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->idJabatan->Visible) { // idJabatan ?>
    <div id="r_idJabatan"<?= $Page->idJabatan->rowAttributes() ?>>
        <label id="elh_anggota_idJabatan" for="x_idJabatan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->idJabatan->caption() ?><?= $Page->idJabatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->idJabatan->cellAttributes() ?>>
<span id="el_anggota_idJabatan">
    <select
        id="x_idJabatan"
        name="x_idJabatan"
        class="form-select ew-select<?= $Page->idJabatan->isInvalidClass() ?>"
        data-select2-id="fanggotaedit_x_idJabatan"
        data-table="anggota"
        data-field="x_idJabatan"
        data-value-separator="<?= $Page->idJabatan->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->idJabatan->getPlaceHolder()) ?>"
        <?= $Page->idJabatan->editAttributes() ?>>
        <?= $Page->idJabatan->selectOptionListHtml("x_idJabatan") ?>
    </select>
    <?= $Page->idJabatan->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->idJabatan->getErrorMessage() ?></div>
<?= $Page->idJabatan->Lookup->getParamTag($Page, "p_x_idJabatan") ?>
<script>
loadjs.ready("fanggotaedit", function() {
    var options = { name: "x_idJabatan", selectId: "fanggotaedit_x_idJabatan" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fanggotaedit.lists.idJabatan.lookupOptions.length) {
        options.data = { id: "x_idJabatan", form: "fanggotaedit" };
    } else {
        options.ajax = { id: "x_idJabatan", form: "fanggotaedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.anggota.fields.idJabatan.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->alamat->Visible) { // alamat ?>
    <div id="r_alamat"<?= $Page->alamat->rowAttributes() ?>>
        <label id="elh_anggota_alamat" for="x_alamat" class="<?= $Page->LeftColumnClass ?>"><?= $Page->alamat->caption() ?><?= $Page->alamat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->alamat->cellAttributes() ?>>
<span id="el_anggota_alamat">
<input type="<?= $Page->alamat->getInputTextType() ?>" name="x_alamat" id="x_alamat" data-table="anggota" data-field="x_alamat" value="<?= $Page->alamat->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->alamat->getPlaceHolder()) ?>"<?= $Page->alamat->editAttributes() ?> aria-describedby="x_alamat_help">
<?= $Page->alamat->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->alamat->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kesibukan->Visible) { // kesibukan ?>
    <div id="r_kesibukan"<?= $Page->kesibukan->rowAttributes() ?>>
        <label id="elh_anggota_kesibukan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kesibukan->caption() ?><?= $Page->kesibukan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->kesibukan->cellAttributes() ?>>
<span id="el_anggota_kesibukan">
<template id="tp_x_kesibukan">
    <div class="form-check">
        <input type="radio" class="form-check-input" data-table="anggota" data-field="x_kesibukan" name="x_kesibukan" id="x_kesibukan"<?= $Page->kesibukan->editAttributes() ?>>
        <label class="form-check-label"></label>
    </div>
</template>
<div id="dsl_x_kesibukan" class="ew-item-list"></div>
<selection-list hidden
    id="x_kesibukan"
    name="x_kesibukan"
    value="<?= HtmlEncode($Page->kesibukan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_kesibukan"
    data-bs-target="dsl_x_kesibukan"
    data-repeatcolumn="5"
    class="form-control<?= $Page->kesibukan->isInvalidClass() ?>"
    data-table="anggota"
    data-field="x_kesibukan"
    data-value-separator="<?= $Page->kesibukan->displayValueSeparatorAttribute() ?>"
    <?= $Page->kesibukan->editAttributes() ?>></selection-list>
<?= $Page->kesibukan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kesibukan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php
    if (in_array("kontakanggota", explode(",", $Page->getCurrentDetailTable())) && $kontakanggota->DetailEdit) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("kontakanggota", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "KontakanggotaGrid.php" ?>
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
    ew.addEventHandlers("anggota");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
