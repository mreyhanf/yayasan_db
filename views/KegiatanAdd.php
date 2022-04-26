<?php

namespace PHPMaker2022\project1;

// Page object
$KegiatanAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { kegiatan: currentTable } });
var currentForm, currentPageID;
var fkegiatanadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fkegiatanadd = new ew.Form("fkegiatanadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fkegiatanadd;

    // Add fields
    var fields = currentTable.fields;
    fkegiatanadd.addFields([
        ["nama", [fields.nama.visible && fields.nama.required ? ew.Validators.required(fields.nama.caption) : null], fields.nama.isInvalid],
        ["deskripsi", [fields.deskripsi.visible && fields.deskripsi.required ? ew.Validators.required(fields.deskripsi.caption) : null], fields.deskripsi.isInvalid],
        ["penanggungJawab", [fields.penanggungJawab.visible && fields.penanggungJawab.required ? ew.Validators.required(fields.penanggungJawab.caption) : null], fields.penanggungJawab.isInvalid],
        ["tanggalMulai", [fields.tanggalMulai.visible && fields.tanggalMulai.required ? ew.Validators.required(fields.tanggalMulai.caption) : null, ew.Validators.datetime(fields.tanggalMulai.clientFormatPattern)], fields.tanggalMulai.isInvalid],
        ["tanggalSelesai", [fields.tanggalSelesai.visible && fields.tanggalSelesai.required ? ew.Validators.required(fields.tanggalSelesai.caption) : null, ew.Validators.datetime(fields.tanggalSelesai.clientFormatPattern)], fields.tanggalSelesai.isInvalid],
        ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid]
    ]);

    // Form_CustomValidate
    fkegiatanadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fkegiatanadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fkegiatanadd.lists.penanggungJawab = <?= $Page->penanggungJawab->toClientList($Page) ?>;
    fkegiatanadd.lists.status = <?= $Page->status->toClientList($Page) ?>;
    loadjs.done("fkegiatanadd");
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
<form name="fkegiatanadd" id="fkegiatanadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="kegiatan">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->nama->Visible) { // nama ?>
    <div id="r_nama"<?= $Page->nama->rowAttributes() ?>>
        <label id="elh_kegiatan_nama" for="x_nama" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nama->caption() ?><?= $Page->nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->nama->cellAttributes() ?>>
<span id="el_kegiatan_nama">
<input type="<?= $Page->nama->getInputTextType() ?>" name="x_nama" id="x_nama" data-table="kegiatan" data-field="x_nama" value="<?= $Page->nama->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->nama->getPlaceHolder()) ?>"<?= $Page->nama->editAttributes() ?> aria-describedby="x_nama_help">
<?= $Page->nama->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nama->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->deskripsi->Visible) { // deskripsi ?>
    <div id="r_deskripsi"<?= $Page->deskripsi->rowAttributes() ?>>
        <label id="elh_kegiatan_deskripsi" for="x_deskripsi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->deskripsi->caption() ?><?= $Page->deskripsi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->deskripsi->cellAttributes() ?>>
<span id="el_kegiatan_deskripsi">
<textarea data-table="kegiatan" data-field="x_deskripsi" name="x_deskripsi" id="x_deskripsi" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->deskripsi->getPlaceHolder()) ?>"<?= $Page->deskripsi->editAttributes() ?> aria-describedby="x_deskripsi_help"><?= $Page->deskripsi->EditValue ?></textarea>
<?= $Page->deskripsi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->deskripsi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->penanggungJawab->Visible) { // penanggungJawab ?>
    <div id="r_penanggungJawab"<?= $Page->penanggungJawab->rowAttributes() ?>>
        <label id="elh_kegiatan_penanggungJawab" for="x_penanggungJawab" class="<?= $Page->LeftColumnClass ?>"><?= $Page->penanggungJawab->caption() ?><?= $Page->penanggungJawab->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->penanggungJawab->cellAttributes() ?>>
<span id="el_kegiatan_penanggungJawab">
    <select
        id="x_penanggungJawab"
        name="x_penanggungJawab"
        class="form-select ew-select<?= $Page->penanggungJawab->isInvalidClass() ?>"
        data-select2-id="fkegiatanadd_x_penanggungJawab"
        data-table="kegiatan"
        data-field="x_penanggungJawab"
        data-value-separator="<?= $Page->penanggungJawab->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->penanggungJawab->getPlaceHolder()) ?>"
        <?= $Page->penanggungJawab->editAttributes() ?>>
        <?= $Page->penanggungJawab->selectOptionListHtml("x_penanggungJawab") ?>
    </select>
    <?= $Page->penanggungJawab->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->penanggungJawab->getErrorMessage() ?></div>
<?= $Page->penanggungJawab->Lookup->getParamTag($Page, "p_x_penanggungJawab") ?>
<script>
loadjs.ready("fkegiatanadd", function() {
    var options = { name: "x_penanggungJawab", selectId: "fkegiatanadd_x_penanggungJawab" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fkegiatanadd.lists.penanggungJawab.lookupOptions.length) {
        options.data = { id: "x_penanggungJawab", form: "fkegiatanadd" };
    } else {
        options.ajax = { id: "x_penanggungJawab", form: "fkegiatanadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.kegiatan.fields.penanggungJawab.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tanggalMulai->Visible) { // tanggalMulai ?>
    <div id="r_tanggalMulai"<?= $Page->tanggalMulai->rowAttributes() ?>>
        <label id="elh_kegiatan_tanggalMulai" for="x_tanggalMulai" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tanggalMulai->caption() ?><?= $Page->tanggalMulai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tanggalMulai->cellAttributes() ?>>
<span id="el_kegiatan_tanggalMulai">
<input type="<?= $Page->tanggalMulai->getInputTextType() ?>" name="x_tanggalMulai" id="x_tanggalMulai" data-table="kegiatan" data-field="x_tanggalMulai" value="<?= $Page->tanggalMulai->EditValue ?>" placeholder="<?= HtmlEncode($Page->tanggalMulai->getPlaceHolder()) ?>"<?= $Page->tanggalMulai->editAttributes() ?> aria-describedby="x_tanggalMulai_help">
<?= $Page->tanggalMulai->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tanggalMulai->getErrorMessage() ?></div>
<?php if (!$Page->tanggalMulai->ReadOnly && !$Page->tanggalMulai->Disabled && !isset($Page->tanggalMulai->EditAttrs["readonly"]) && !isset($Page->tanggalMulai->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fkegiatanadd", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fkegiatanadd", "x_tanggalMulai", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tanggalSelesai->Visible) { // tanggalSelesai ?>
    <div id="r_tanggalSelesai"<?= $Page->tanggalSelesai->rowAttributes() ?>>
        <label id="elh_kegiatan_tanggalSelesai" for="x_tanggalSelesai" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tanggalSelesai->caption() ?><?= $Page->tanggalSelesai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tanggalSelesai->cellAttributes() ?>>
<span id="el_kegiatan_tanggalSelesai">
<input type="<?= $Page->tanggalSelesai->getInputTextType() ?>" name="x_tanggalSelesai" id="x_tanggalSelesai" data-table="kegiatan" data-field="x_tanggalSelesai" value="<?= $Page->tanggalSelesai->EditValue ?>" placeholder="<?= HtmlEncode($Page->tanggalSelesai->getPlaceHolder()) ?>"<?= $Page->tanggalSelesai->editAttributes() ?> aria-describedby="x_tanggalSelesai_help">
<?= $Page->tanggalSelesai->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tanggalSelesai->getErrorMessage() ?></div>
<?php if (!$Page->tanggalSelesai->ReadOnly && !$Page->tanggalSelesai->Disabled && !isset($Page->tanggalSelesai->EditAttrs["readonly"]) && !isset($Page->tanggalSelesai->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fkegiatanadd", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fkegiatanadd", "x_tanggalSelesai", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <div id="r_status"<?= $Page->status->rowAttributes() ?>>
        <label id="elh_kegiatan_status" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status->caption() ?><?= $Page->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->status->cellAttributes() ?>>
<span id="el_kegiatan_status">
<template id="tp_x_status">
    <div class="form-check">
        <input type="radio" class="form-check-input" data-table="kegiatan" data-field="x_status" name="x_status" id="x_status"<?= $Page->status->editAttributes() ?>>
        <label class="form-check-label"></label>
    </div>
</template>
<div id="dsl_x_status" class="ew-item-list"></div>
<selection-list hidden
    id="x_status"
    name="x_status"
    value="<?= HtmlEncode($Page->status->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_status"
    data-bs-target="dsl_x_status"
    data-repeatcolumn="5"
    class="form-control<?= $Page->status->isInvalidClass() ?>"
    data-table="kegiatan"
    data-field="x_status"
    data-value-separator="<?= $Page->status->displayValueSeparatorAttribute() ?>"
    <?= $Page->status->editAttributes() ?>></selection-list>
<?= $Page->status->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->status->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php
    if (in_array("partisipasikegiatan", explode(",", $Page->getCurrentDetailTable())) && $partisipasikegiatan->DetailAdd) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("partisipasikegiatan", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "PartisipasikegiatanGrid.php" ?>
<?php } ?>
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
    ew.addEventHandlers("kegiatan");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
