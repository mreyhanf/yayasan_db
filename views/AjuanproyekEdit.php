<?php

namespace PHPMaker2022\project1;

// Page object
$AjuanproyekEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { ajuanproyek: currentTable } });
var currentForm, currentPageID;
var fajuanproyekedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fajuanproyekedit = new ew.Form("fajuanproyekedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fajuanproyekedit;

    // Add fields
    var fields = currentTable.fields;
    fajuanproyekedit.addFields([
        ["idAjuanProyek", [fields.idAjuanProyek.visible && fields.idAjuanProyek.required ? ew.Validators.required(fields.idAjuanProyek.caption) : null], fields.idAjuanProyek.isInvalid],
        ["nama", [fields.nama.visible && fields.nama.required ? ew.Validators.required(fields.nama.caption) : null], fields.nama.isInvalid],
        ["pengaju", [fields.pengaju.visible && fields.pengaju.required ? ew.Validators.required(fields.pengaju.caption) : null], fields.pengaju.isInvalid],
        ["biaya", [fields.biaya.visible && fields.biaya.required ? ew.Validators.required(fields.biaya.caption) : null, ew.Validators.integer], fields.biaya.isInvalid],
        ["tanggalPengajuan", [fields.tanggalPengajuan.visible && fields.tanggalPengajuan.required ? ew.Validators.required(fields.tanggalPengajuan.caption) : null, ew.Validators.datetime(fields.tanggalPengajuan.clientFormatPattern)], fields.tanggalPengajuan.isInvalid],
        ["keputusan", [fields.keputusan.visible && fields.keputusan.required ? ew.Validators.required(fields.keputusan.caption) : null], fields.keputusan.isInvalid]
    ]);

    // Form_CustomValidate
    fajuanproyekedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fajuanproyekedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fajuanproyekedit.lists.keputusan = <?= $Page->keputusan->toClientList($Page) ?>;
    loadjs.done("fajuanproyekedit");
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
<form name="fajuanproyekedit" id="fajuanproyekedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="ajuanproyek">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "proyek") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="proyek">
<input type="hidden" name="fk_ajuan" value="<?= HtmlEncode($Page->idAjuanProyek->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->idAjuanProyek->Visible) { // idAjuanProyek ?>
    <div id="r_idAjuanProyek"<?= $Page->idAjuanProyek->rowAttributes() ?>>
        <label id="elh_ajuanproyek_idAjuanProyek" class="<?= $Page->LeftColumnClass ?>"><?= $Page->idAjuanProyek->caption() ?><?= $Page->idAjuanProyek->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->idAjuanProyek->cellAttributes() ?>>
<span id="el_ajuanproyek_idAjuanProyek">
<span<?= $Page->idAjuanProyek->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->idAjuanProyek->getDisplayValue($Page->idAjuanProyek->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="ajuanproyek" data-field="x_idAjuanProyek" data-hidden="1" name="x_idAjuanProyek" id="x_idAjuanProyek" value="<?= HtmlEncode($Page->idAjuanProyek->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nama->Visible) { // nama ?>
    <div id="r_nama"<?= $Page->nama->rowAttributes() ?>>
        <label id="elh_ajuanproyek_nama" for="x_nama" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nama->caption() ?><?= $Page->nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->nama->cellAttributes() ?>>
<span id="el_ajuanproyek_nama">
<input type="<?= $Page->nama->getInputTextType() ?>" name="x_nama" id="x_nama" data-table="ajuanproyek" data-field="x_nama" value="<?= $Page->nama->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->nama->getPlaceHolder()) ?>"<?= $Page->nama->editAttributes() ?> aria-describedby="x_nama_help">
<?= $Page->nama->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nama->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->pengaju->Visible) { // pengaju ?>
    <div id="r_pengaju"<?= $Page->pengaju->rowAttributes() ?>>
        <label id="elh_ajuanproyek_pengaju" for="x_pengaju" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pengaju->caption() ?><?= $Page->pengaju->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->pengaju->cellAttributes() ?>>
<span id="el_ajuanproyek_pengaju">
<input type="<?= $Page->pengaju->getInputTextType() ?>" name="x_pengaju" id="x_pengaju" data-table="ajuanproyek" data-field="x_pengaju" value="<?= $Page->pengaju->EditValue ?>" size="30" maxlength="30" placeholder="<?= HtmlEncode($Page->pengaju->getPlaceHolder()) ?>"<?= $Page->pengaju->editAttributes() ?> aria-describedby="x_pengaju_help">
<?= $Page->pengaju->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->pengaju->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->biaya->Visible) { // biaya ?>
    <div id="r_biaya"<?= $Page->biaya->rowAttributes() ?>>
        <label id="elh_ajuanproyek_biaya" for="x_biaya" class="<?= $Page->LeftColumnClass ?>"><?= $Page->biaya->caption() ?><?= $Page->biaya->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->biaya->cellAttributes() ?>>
<span id="el_ajuanproyek_biaya">
<input type="<?= $Page->biaya->getInputTextType() ?>" name="x_biaya" id="x_biaya" data-table="ajuanproyek" data-field="x_biaya" value="<?= $Page->biaya->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->biaya->getPlaceHolder()) ?>"<?= $Page->biaya->editAttributes() ?> aria-describedby="x_biaya_help">
<?= $Page->biaya->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->biaya->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tanggalPengajuan->Visible) { // tanggalPengajuan ?>
    <div id="r_tanggalPengajuan"<?= $Page->tanggalPengajuan->rowAttributes() ?>>
        <label id="elh_ajuanproyek_tanggalPengajuan" for="x_tanggalPengajuan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tanggalPengajuan->caption() ?><?= $Page->tanggalPengajuan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tanggalPengajuan->cellAttributes() ?>>
<span id="el_ajuanproyek_tanggalPengajuan">
<input type="<?= $Page->tanggalPengajuan->getInputTextType() ?>" name="x_tanggalPengajuan" id="x_tanggalPengajuan" data-table="ajuanproyek" data-field="x_tanggalPengajuan" value="<?= $Page->tanggalPengajuan->EditValue ?>" placeholder="<?= HtmlEncode($Page->tanggalPengajuan->getPlaceHolder()) ?>"<?= $Page->tanggalPengajuan->editAttributes() ?> aria-describedby="x_tanggalPengajuan_help">
<?= $Page->tanggalPengajuan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tanggalPengajuan->getErrorMessage() ?></div>
<?php if (!$Page->tanggalPengajuan->ReadOnly && !$Page->tanggalPengajuan->Disabled && !isset($Page->tanggalPengajuan->EditAttrs["readonly"]) && !isset($Page->tanggalPengajuan->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fajuanproyekedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fajuanproyekedit", "x_tanggalPengajuan", jQuery.extend(true, {"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->keputusan->Visible) { // keputusan ?>
    <div id="r_keputusan"<?= $Page->keputusan->rowAttributes() ?>>
        <label id="elh_ajuanproyek_keputusan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->keputusan->caption() ?><?= $Page->keputusan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->keputusan->cellAttributes() ?>>
<span id="el_ajuanproyek_keputusan">
<template id="tp_x_keputusan">
    <div class="form-check">
        <input type="radio" class="form-check-input" data-table="ajuanproyek" data-field="x_keputusan" name="x_keputusan" id="x_keputusan"<?= $Page->keputusan->editAttributes() ?>>
        <label class="form-check-label"></label>
    </div>
</template>
<div id="dsl_x_keputusan" class="ew-item-list"></div>
<selection-list hidden
    id="x_keputusan"
    name="x_keputusan"
    value="<?= HtmlEncode($Page->keputusan->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_keputusan"
    data-bs-target="dsl_x_keputusan"
    data-repeatcolumn="5"
    class="form-control<?= $Page->keputusan->isInvalidClass() ?>"
    data-table="ajuanproyek"
    data-field="x_keputusan"
    data-value-separator="<?= $Page->keputusan->displayValueSeparatorAttribute() ?>"
    <?= $Page->keputusan->editAttributes() ?>></selection-list>
<?= $Page->keputusan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->keputusan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php
    if (in_array("kontakajuanproyek", explode(",", $Page->getCurrentDetailTable())) && $kontakajuanproyek->DetailEdit) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("kontakajuanproyek", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "KontakajuanproyekGrid.php" ?>
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
    ew.addEventHandlers("ajuanproyek");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
