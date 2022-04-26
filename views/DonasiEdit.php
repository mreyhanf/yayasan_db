<?php

namespace PHPMaker2022\project1;

// Page object
$DonasiEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { donasi: currentTable } });
var currentForm, currentPageID;
var fdonasiedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fdonasiedit = new ew.Form("fdonasiedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fdonasiedit;

    // Add fields
    var fields = currentTable.fields;
    fdonasiedit.addFields([
        ["idDonasi", [fields.idDonasi.visible && fields.idDonasi.required ? ew.Validators.required(fields.idDonasi.caption) : null], fields.idDonasi.isInvalid],
        ["idDonatur", [fields.idDonatur.visible && fields.idDonatur.required ? ew.Validators.required(fields.idDonatur.caption) : null], fields.idDonatur.isInvalid],
        ["nominal", [fields.nominal.visible && fields.nominal.required ? ew.Validators.required(fields.nominal.caption) : null, ew.Validators.integer], fields.nominal.isInvalid],
        ["idProyek", [fields.idProyek.visible && fields.idProyek.required ? ew.Validators.required(fields.idProyek.caption) : null], fields.idProyek.isInvalid],
        ["waktu", [fields.waktu.visible && fields.waktu.required ? ew.Validators.required(fields.waktu.caption) : null, ew.Validators.datetime(fields.waktu.clientFormatPattern)], fields.waktu.isInvalid]
    ]);

    // Form_CustomValidate
    fdonasiedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fdonasiedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fdonasiedit.lists.idDonatur = <?= $Page->idDonatur->toClientList($Page) ?>;
    fdonasiedit.lists.idProyek = <?= $Page->idProyek->toClientList($Page) ?>;
    loadjs.done("fdonasiedit");
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
<form name="fdonasiedit" id="fdonasiedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="donasi">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "donatur") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="donatur">
<input type="hidden" name="fk_idDonatur" value="<?= HtmlEncode($Page->idDonatur->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->idDonasi->Visible) { // idDonasi ?>
    <div id="r_idDonasi"<?= $Page->idDonasi->rowAttributes() ?>>
        <label id="elh_donasi_idDonasi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->idDonasi->caption() ?><?= $Page->idDonasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->idDonasi->cellAttributes() ?>>
<span id="el_donasi_idDonasi">
<span<?= $Page->idDonasi->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->idDonasi->getDisplayValue($Page->idDonasi->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="donasi" data-field="x_idDonasi" data-hidden="1" name="x_idDonasi" id="x_idDonasi" value="<?= HtmlEncode($Page->idDonasi->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->idDonatur->Visible) { // idDonatur ?>
    <div id="r_idDonatur"<?= $Page->idDonatur->rowAttributes() ?>>
        <label id="elh_donasi_idDonatur" for="x_idDonatur" class="<?= $Page->LeftColumnClass ?>"><?= $Page->idDonatur->caption() ?><?= $Page->idDonatur->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->idDonatur->cellAttributes() ?>>
<?php if ($Page->idDonatur->getSessionValue() != "") { ?>
<span id="el_donasi_idDonatur">
<span<?= $Page->idDonatur->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->idDonatur->getDisplayValue($Page->idDonatur->ViewValue) ?></span></span>
</span>
<input type="hidden" id="x_idDonatur" name="x_idDonatur" value="<?= HtmlEncode(FormatNumber($Page->idDonatur->CurrentValue, $Page->idDonatur->formatPattern())) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_donasi_idDonatur">
    <select
        id="x_idDonatur"
        name="x_idDonatur"
        class="form-select ew-select<?= $Page->idDonatur->isInvalidClass() ?>"
        data-select2-id="fdonasiedit_x_idDonatur"
        data-table="donasi"
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
loadjs.ready("fdonasiedit", function() {
    var options = { name: "x_idDonatur", selectId: "fdonasiedit_x_idDonatur" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fdonasiedit.lists.idDonatur.lookupOptions.length) {
        options.data = { id: "x_idDonatur", form: "fdonasiedit" };
    } else {
        options.ajax = { id: "x_idDonatur", form: "fdonasiedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.donasi.fields.idDonatur.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nominal->Visible) { // nominal ?>
    <div id="r_nominal"<?= $Page->nominal->rowAttributes() ?>>
        <label id="elh_donasi_nominal" for="x_nominal" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nominal->caption() ?><?= $Page->nominal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->nominal->cellAttributes() ?>>
<span id="el_donasi_nominal">
<input type="<?= $Page->nominal->getInputTextType() ?>" name="x_nominal" id="x_nominal" data-table="donasi" data-field="x_nominal" value="<?= $Page->nominal->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->nominal->getPlaceHolder()) ?>"<?= $Page->nominal->editAttributes() ?> aria-describedby="x_nominal_help">
<?= $Page->nominal->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nominal->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->idProyek->Visible) { // idProyek ?>
    <div id="r_idProyek"<?= $Page->idProyek->rowAttributes() ?>>
        <label id="elh_donasi_idProyek" for="x_idProyek" class="<?= $Page->LeftColumnClass ?>"><?= $Page->idProyek->caption() ?><?= $Page->idProyek->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->idProyek->cellAttributes() ?>>
<span id="el_donasi_idProyek">
    <select
        id="x_idProyek"
        name="x_idProyek"
        class="form-select ew-select<?= $Page->idProyek->isInvalidClass() ?>"
        data-select2-id="fdonasiedit_x_idProyek"
        data-table="donasi"
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
loadjs.ready("fdonasiedit", function() {
    var options = { name: "x_idProyek", selectId: "fdonasiedit_x_idProyek" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fdonasiedit.lists.idProyek.lookupOptions.length) {
        options.data = { id: "x_idProyek", form: "fdonasiedit" };
    } else {
        options.ajax = { id: "x_idProyek", form: "fdonasiedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.donasi.fields.idProyek.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->waktu->Visible) { // waktu ?>
    <div id="r_waktu"<?= $Page->waktu->rowAttributes() ?>>
        <label id="elh_donasi_waktu" for="x_waktu" class="<?= $Page->LeftColumnClass ?>"><?= $Page->waktu->caption() ?><?= $Page->waktu->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->waktu->cellAttributes() ?>>
<span id="el_donasi_waktu">
<input type="<?= $Page->waktu->getInputTextType() ?>" name="x_waktu" id="x_waktu" data-table="donasi" data-field="x_waktu" value="<?= $Page->waktu->EditValue ?>" placeholder="<?= HtmlEncode($Page->waktu->getPlaceHolder()) ?>"<?= $Page->waktu->editAttributes() ?> aria-describedby="x_waktu_help">
<?= $Page->waktu->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->waktu->getErrorMessage() ?></div>
<?php if (!$Page->waktu->ReadOnly && !$Page->waktu->Disabled && !isset($Page->waktu->EditAttrs["readonly"]) && !isset($Page->waktu->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdonasiedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fdonasiedit", "x_waktu", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
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
    ew.addEventHandlers("donasi");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
