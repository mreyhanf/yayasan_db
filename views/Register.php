<?php

namespace PHPMaker2022\project1;

// Page object
$Register = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { users: currentTable } });
var currentForm, currentPageID;
var fregister;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fregister = new ew.Form("fregister", "register");
    currentPageID = ew.PAGE_ID = "register";
    currentForm = fregister;

    // Add fields
    var fields = currentTable.fields;
    fregister.addFields([
        ["_username", [fields._username.visible && fields._username.required ? ew.Validators.required(fields._username.caption) : null, ew.Validators.username(fields._username.raw)], fields._username.isInvalid],
        ["c__password", [ew.Validators.required(ew.language.phrase("ConfirmPassword")), ew.Validators.mismatchPassword], fields._password.isInvalid],
        ["_password", [fields._password.visible && fields._password.required ? ew.Validators.required(fields._password.caption) : null, ew.Validators.password(fields._password.raw)], fields._password.isInvalid],
        ["user_level", [fields.user_level.visible && fields.user_level.required ? ew.Validators.required(fields.user_level.caption) : null], fields.user_level.isInvalid]
    ]);

    // Form_CustomValidate
    fregister.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fregister.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fregister.lists.user_level = <?= $Page->user_level->toClientList($Page) ?>;
    loadjs.done("fregister");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fregister" id="fregister" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="t" value="users">
<input type="hidden" name="action" id="action" value="insert">
<div class="ew-register-div"><!-- page* -->
<?php if ($Page->_username->Visible) { // username ?>
    <div id="r__username"<?= $Page->_username->rowAttributes() ?>>
        <label id="elh_users__username" for="x__username" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_username->caption() ?><?= $Page->_username->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->_username->cellAttributes() ?>>
<span id="el_users__username">
<input type="<?= $Page->_username->getInputTextType() ?>" name="x__username" id="x__username" data-table="users" data-field="x__username" value="<?= $Page->_username->EditValue ?>" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->_username->getPlaceHolder()) ?>"<?= $Page->_username->editAttributes() ?> aria-describedby="x__username_help">
<?= $Page->_username->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_username->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_password->Visible) { // password ?>
    <div id="r__password"<?= $Page->_password->rowAttributes() ?>>
        <label id="elh_users__password" for="x__password" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_password->caption() ?><?= $Page->_password->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->_password->cellAttributes() ?>>
<span id="el_users__password">
<input type="<?= $Page->_password->getInputTextType() ?>" name="x__password" id="x__password" data-table="users" data-field="x__password" value="<?= $Page->_password->EditValue ?>" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->_password->getPlaceHolder()) ?>"<?= $Page->_password->editAttributes() ?> aria-describedby="x__password_help">
<?= $Page->_password->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_password->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_password->Visible) { // password ?>
    <div id="r_c__password" class="row">
        <label id="elh_c_users__password" for="c__password" class="<?= $Page->LeftColumnClass ?>"><?= $Language->phrase("Confirm") ?> <?= $Page->_password->caption() ?><?= $Page->_password->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->_password->cellAttributes() ?>>
<span id="el_c_users__password">
<input type="<?= $Page->_password->getInputTextType() ?>" name="c__password" id="c__password" data-table="users" data-field="x__password" value="<?= $Page->_password->EditValue ?>" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->_password->getPlaceHolder()) ?>"<?= $Page->_password->editAttributes() ?> aria-describedby="x__password_help">
<?= $Page->_password->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_password->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Page->IsModal) { ?>
<div class="row"><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("RegisterBtn") ?></button>
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
    ew.addEventHandlers("users");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your startup script here, no need to add script tags.
});
</script>
