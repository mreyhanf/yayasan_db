<?php

namespace PHPMaker2022\project1;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class ProyekEdit extends Proyek
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'proyek';

    // Page object name
    public $PageObjName = "ProyekEdit";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // Page headings
    public $Heading = "";
    public $Subheading = "";
    public $PageHeader;
    public $PageFooter;

    // Page layout
    public $UseLayout = true;

    // Page terminated
    private $terminated = false;

    // Page heading
    public function pageHeading()
    {
        global $Language;
        if ($this->Heading != "") {
            return $this->Heading;
        }
        if (method_exists($this, "tableCaption")) {
            return $this->tableCaption();
        }
        return "";
    }

    // Page subheading
    public function pageSubheading()
    {
        global $Language;
        if ($this->Subheading != "") {
            return $this->Subheading;
        }
        if ($this->TableName) {
            return $Language->phrase($this->PageID);
        }
        return "";
    }

    // Page name
    public function pageName()
    {
        return CurrentPageName();
    }

    // Page URL
    public function pageUrl($withArgs = true)
    {
        $route = GetRoute();
        $args = $route->getArguments();
        if (!$withArgs) {
            foreach ($args as $key => &$val) {
                $val = "";
            }
            unset($val);
        }
        $url = rtrim(UrlFor($route->getName(), $args), "/") . "?";
        if ($this->UseTokenInUrl) {
            $url .= "t=" . $this->TableVar . "&"; // Add page token
        }
        return $url;
    }

    // Show Page Header
    public function showPageHeader()
    {
        $header = $this->PageHeader;
        $this->pageDataRendering($header);
        if ($header != "") { // Header exists, display
            echo '<p id="ew-page-header">' . $header . '</p>';
        }
    }

    // Show Page Footer
    public function showPageFooter()
    {
        $footer = $this->PageFooter;
        $this->pageDataRendered($footer);
        if ($footer != "") { // Footer exists, display
            echo '<p id="ew-page-footer">' . $footer . '</p>';
        }
    }

    // Validate page request
    protected function isPageRequest()
    {
        global $CurrentForm;
        if ($this->UseTokenInUrl) {
            if ($CurrentForm) {
                return $this->TableVar == $CurrentForm->getValue("t");
            }
            if (Get("t") !== null) {
                return $this->TableVar == Get("t");
            }
        }
        return true;
    }

    // Constructor
    public function __construct()
    {
        global $Language, $DashboardReport, $DebugTimer;
        global $UserTable;

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("language");

        // Parent constuctor
        parent::__construct();

        // Table object (proyek)
        if (!isset($GLOBALS["proyek"]) || get_class($GLOBALS["proyek"]) == PROJECT_NAMESPACE . "proyek") {
            $GLOBALS["proyek"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'proyek');
        }

        // Start timer
        $DebugTimer = Container("timer");

        // Debug message
        LoadDebugMessage();

        // Open connection
        $GLOBALS["Conn"] = $GLOBALS["Conn"] ?? $this->getConnection();

        // User table object
        $UserTable = Container("usertable");
    }

    // Get content from stream
    public function getContents($stream = null): string
    {
        global $Response;
        return is_object($Response) ? $Response->getBody() : ob_get_clean();
    }

    // Is lookup
    public function isLookup()
    {
        return SameText(Route(0), Config("API_LOOKUP_ACTION"));
    }

    // Is AutoFill
    public function isAutoFill()
    {
        return $this->isLookup() && SameText(Post("ajax"), "autofill");
    }

    // Is AutoSuggest
    public function isAutoSuggest()
    {
        return $this->isLookup() && SameText(Post("ajax"), "autosuggest");
    }

    // Is modal lookup
    public function isModalLookup()
    {
        return $this->isLookup() && SameText(Post("ajax"), "modal");
    }

    // Is terminated
    public function isTerminated()
    {
        return $this->terminated;
    }

    /**
     * Terminate page
     *
     * @param string $url URL for direction
     * @return void
     */
    public function terminate($url = "")
    {
        if ($this->terminated) {
            return;
        }
        global $ExportFileName, $TempImages, $DashboardReport, $Response;

        // Page is terminated
        $this->terminated = true;

         // Page Unload event
        if (method_exists($this, "pageUnload")) {
            $this->pageUnload();
        }

        // Global Page Unloaded event (in userfn*.php)
        Page_Unloaded();

        // Export
        if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
            $content = $this->getContents();
            if ($ExportFileName == "") {
                $ExportFileName = $this->TableVar;
            }
            $class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
            if (class_exists($class)) {
                $tbl = Container("proyek");
                $doc = new $class($tbl);
                $doc->Text = @$content;
                if ($this->isExport("email")) {
                    echo $this->exportEmail($doc->Text);
                } else {
                    $doc->export();
                }
                DeleteTempImages(); // Delete temp images
                return;
            }
        }
        if (!IsApi() && method_exists($this, "pageRedirecting")) {
            $this->pageRedirecting($url);
        }

        // Close connection
        CloseConnections();

        // Return for API
        if (IsApi()) {
            $res = $url === true;
            if (!$res) { // Show error
                WriteJson(array_merge(["success" => false], $this->getMessages()));
            }
            return;
        } else { // Check if response is JSON
            if (StartsString("application/json", $Response->getHeaderLine("Content-type")) && $Response->getBody()->getSize()) { // With JSON response
                $this->clearMessages();
                return;
            }
        }

        // Go to URL if specified
        if ($url != "") {
            if (!Config("DEBUG") && ob_get_length()) {
                ob_end_clean();
            }

            // Handle modal response
            if ($this->IsModal) { // Show as modal
                $row = ["url" => GetUrl($url), "modal" => "1"];
                $pageName = GetPageName($url);
                if ($pageName != $this->getListUrl()) { // Not List page
                    $row["caption"] = $this->getModalCaption($pageName);
                    if ($pageName == "ProyekView") {
                        $row["view"] = "1";
                    }
                } else { // List page should not be shown as modal => error
                    $row["error"] = $this->getFailureMessage();
                    $this->clearFailureMessage();
                }
                WriteJson($row);
            } else {
                SaveDebugMessage();
                Redirect(GetUrl($url));
            }
        }
        return; // Return to controller
    }

    // Get records from recordset
    protected function getRecordsFromRecordset($rs, $current = false)
    {
        $rows = [];
        if (is_object($rs)) { // Recordset
            while ($rs && !$rs->EOF) {
                $this->loadRowValues($rs); // Set up DbValue/CurrentValue
                $row = $this->getRecordFromArray($rs->fields);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
                $rs->moveNext();
            }
        } elseif (is_array($rs)) {
            foreach ($rs as $ar) {
                $row = $this->getRecordFromArray($ar);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
            }
        }
        return $rows;
    }

    // Get record from array
    protected function getRecordFromArray($ar)
    {
        $row = [];
        if (is_array($ar)) {
            foreach ($ar as $fldname => $val) {
                if (array_key_exists($fldname, $this->Fields) && ($this->Fields[$fldname]->Visible || $this->Fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
                    $fld = &$this->Fields[$fldname];
                    if ($fld->HtmlTag == "FILE") { // Upload field
                        if (EmptyValue($val)) {
                            $row[$fldname] = null;
                        } else {
                            if ($fld->DataType == DATATYPE_BLOB) {
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . $fld->Param . "/" . rawurlencode($this->getRecordKeyValue($ar))));
                                $row[$fldname] = ["type" => ContentType($val), "url" => $url, "name" => $fld->Param . ContentExtension($val)];
                            } elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $val)));
                                $row[$fldname] = ["type" => MimeContentType($val), "url" => $url, "name" => $val];
                            } else { // Multiple files
                                $files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
                                $ar = [];
                                foreach ($files as $file) {
                                    $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                        "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $file)));
                                    if (!EmptyValue($file)) {
                                        $ar[] = ["type" => MimeContentType($file), "url" => $url, "name" => $file];
                                    }
                                }
                                $row[$fldname] = $ar;
                            }
                        }
                    } else {
                        $row[$fldname] = $val;
                    }
                }
            }
        }
        return $row;
    }

    // Get record key value from array
    protected function getRecordKeyValue($ar)
    {
        $key = "";
        if (is_array($ar)) {
            $key .= @$ar['idProyek'];
        }
        return $key;
    }

    /**
     * Hide fields for add/edit
     *
     * @return void
     */
    protected function hideFieldsForAddEdit()
    {
        if ($this->isAdd() || $this->isCopy() || $this->isGridAdd()) {
            $this->idProyek->Visible = false;
        }
    }

    // Lookup data
    public function lookup($ar = null)
    {
        global $Language, $Security;

        // Get lookup object
        $fieldName = $ar["field"] ?? Post("field");
        $lookup = $this->Fields[$fieldName]->Lookup;

        // Get lookup parameters
        $lookupType = $ar["ajax"] ?? Post("ajax", "unknown");
        $pageSize = -1;
        $offset = -1;
        $searchValue = "";
        if (SameText($lookupType, "modal") || SameText($lookupType, "filter")) {
            $searchValue = $ar["q"] ?? Param("q") ?? $ar["sv"] ?? Post("sv", "");
            $pageSize = $ar["n"] ?? Param("n") ?? $ar["recperpage"] ?? Post("recperpage", 10);
        } elseif (SameText($lookupType, "autosuggest")) {
            $searchValue = $ar["q"] ?? Param("q", "");
            $pageSize = $ar["n"] ?? Param("n", -1);
            $pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
            if ($pageSize <= 0) {
                $pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
            }
        }
        $start = $ar["start"] ?? Param("start", -1);
        $start = is_numeric($start) ? (int)$start : -1;
        $page = $ar["page"] ?? Param("page", -1);
        $page = is_numeric($page) ? (int)$page : -1;
        $offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
        $userSelect = Decrypt($ar["s"] ?? Post("s", ""));
        $userFilter = Decrypt($ar["f"] ?? Post("f", ""));
        $userOrderBy = Decrypt($ar["o"] ?? Post("o", ""));
        $keys = $ar["keys"] ?? Post("keys");
        $lookup->LookupType = $lookupType; // Lookup type
        $lookup->FilterValues = []; // Clear filter values first
        if ($keys !== null) { // Selected records from modal
            if (is_array($keys)) {
                $keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
            }
            $lookup->FilterFields = []; // Skip parent fields if any
            $lookup->FilterValues[] = $keys; // Lookup values
            $pageSize = -1; // Show all records
        } else { // Lookup values
            $lookup->FilterValues[] = $ar["v0"] ?? $ar["lookupValue"] ?? Post("v0", Post("lookupValue", ""));
        }
        $cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
        for ($i = 1; $i <= $cnt; $i++) {
            $lookup->FilterValues[] = $ar["v" . $i] ?? Post("v" . $i, "");
        }
        $lookup->SearchValue = $searchValue;
        $lookup->PageSize = $pageSize;
        $lookup->Offset = $offset;
        if ($userSelect != "") {
            $lookup->UserSelect = $userSelect;
        }
        if ($userFilter != "") {
            $lookup->UserFilter = $userFilter;
        }
        if ($userOrderBy != "") {
            $lookup->UserOrderBy = $userOrderBy;
        }
        return $lookup->toJson($this, !is_array($ar)); // Use settings from current page
    }

    // Properties
    public $FormClassName = "ew-form ew-edit-form";
    public $IsModal = false;
    public $IsMobileOrModal = false;
    public $DbMasterFilter;
    public $DbDetailFilter;
    public $HashValue; // Hash Value
    public $DisplayRecords = 1;
    public $StartRecord;
    public $StopRecord;
    public $TotalRecords = 0;
    public $RecordRange = 10;
    public $RecordCount;

    /**
     * Page run
     *
     * @return void
     */
    public function run()
    {
        global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
            $SkipHeaderFooter;

        // Is modal
        $this->IsModal = Param("modal") == "1";
        $this->UseLayout = $this->UseLayout && !$this->IsModal;

        // Use layout
        $this->UseLayout = $this->UseLayout && ConvertToBool(Param("layout", true));

        // Create form object
        $CurrentForm = new HttpForm();
        $this->CurrentAction = Param("action"); // Set up current action
        $this->idProyek->setVisibility();
        $this->ajuan->setVisibility();
        $this->biayaTerkumpul->setVisibility();
        $this->tanggalMulai->setVisibility();
        $this->tanggalSelesai->setVisibility();
        $this->status->setVisibility();
        $this->hideFieldsForAddEdit();

        // Set lookup cache
        if (!in_array($this->PageID, Config("LOOKUP_CACHE_PAGE_IDS"))) {
            $this->setUseLookupCache(false);
        }

        // Global Page Loading event (in userfn*.php)
        Page_Loading();

        // Page Load event
        if (method_exists($this, "pageLoad")) {
            $this->pageLoad();
        }

        // Set up lookup cache
        $this->setupLookupOptions($this->ajuan);
        $this->setupLookupOptions($this->status);

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }
        $this->IsMobileOrModal = IsMobile() || $this->IsModal;
        $this->FormClassName = "ew-form ew-edit-form";
        $loaded = false;
        $postBack = false;

        // Set up current action and primary key
        if (IsApi()) {
            // Load key values
            $loaded = true;
            if (($keyValue = Get("idProyek") ?? Key(0) ?? Route(2)) !== null) {
                $this->idProyek->setQueryStringValue($keyValue);
                $this->idProyek->setOldValue($this->idProyek->QueryStringValue);
            } elseif (Post("idProyek") !== null) {
                $this->idProyek->setFormValue(Post("idProyek"));
                $this->idProyek->setOldValue($this->idProyek->FormValue);
            } else {
                $loaded = false; // Unable to load key
            }

            // Load record
            if ($loaded) {
                $loaded = $this->loadRow();
            }
            if (!$loaded) {
                $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
                $this->terminate();
                return;
            }
            $this->CurrentAction = "update"; // Update record directly
            $this->OldKey = $this->getKey(true); // Get from CurrentValue
            $postBack = true;
        } else {
            if (Post("action") !== null) {
                $this->CurrentAction = Post("action"); // Get action code
                if (!$this->isShow()) { // Not reload record, handle as postback
                    $postBack = true;
                }

                // Get key from Form
                $this->setKey(Post($this->OldKeyName), $this->isShow());
            } else {
                $this->CurrentAction = "show"; // Default action is display

                // Load key from QueryString
                $loadByQuery = false;
                if (($keyValue = Get("idProyek") ?? Route("idProyek")) !== null) {
                    $this->idProyek->setQueryStringValue($keyValue);
                    $loadByQuery = true;
                } else {
                    $this->idProyek->CurrentValue = null;
                }
            }

            // Load recordset
            if ($this->isShow()) {
                    // Load current record
                    $loaded = $this->loadRow();
                $this->OldKey = $loaded ? $this->getKey(true) : ""; // Get from CurrentValue
            }
        }

        // Process form if post back
        if ($postBack) {
            $this->loadFormValues(); // Get form values

            // Set up detail parameters
            $this->setupDetailParms();
        }

        // Validate form if post back
        if ($postBack) {
            if (!$this->validateForm()) {
                $this->EventCancelled = true; // Event cancelled
                $this->restoreFormValues();
                if (IsApi()) {
                    $this->terminate();
                    return;
                } else {
                    $this->CurrentAction = ""; // Form error, reset action
                }
            }
        }

        // Perform current action
        switch ($this->CurrentAction) {
            case "show": // Get a record to display
                    if (!$loaded) { // Load record based on key
                        if ($this->getFailureMessage() == "") {
                            $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
                        }
                        $this->terminate("ProyekList"); // No matching record, return to list
                        return;
                    }

                // Set up detail parameters
                $this->setupDetailParms();
                break;
            case "update": // Update
                if ($this->getCurrentDetailTable() != "") { // Master/detail edit
                    $returnUrl = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=" . $this->getCurrentDetailTable()); // Master/Detail view page
                } else {
                    $returnUrl = $this->getReturnUrl();
                }
                if (GetPageName($returnUrl) == "ProyekList") {
                    $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                }
                $this->SendEmail = true; // Send email on update success
                if ($this->editRow()) { // Update record based on key
                    if ($this->getSuccessMessage() == "") {
                        $this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Update success
                    }
                    if (IsApi()) {
                        $this->terminate(true);
                        return;
                    } else {
                        $this->terminate($returnUrl); // Return to caller
                        return;
                    }
                } elseif (IsApi()) { // API request, return
                    $this->terminate();
                    return;
                } elseif ($this->getFailureMessage() == $Language->phrase("NoRecord")) {
                    $this->terminate($returnUrl); // Return to caller
                    return;
                } else {
                    $this->EventCancelled = true; // Event cancelled
                    $this->restoreFormValues(); // Restore form values if update failed

                    // Set up detail parameters
                    $this->setupDetailParms();
                }
        }

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Render the record
        $this->RowType = ROWTYPE_EDIT; // Render as Edit
        $this->resetAttributes();
        $this->renderRow();

        // Set LoginStatus / Page_Rendering / Page_Render
        if (!IsApi() && !$this->isTerminated()) {
            // Setup login status
            SetupLoginStatus();

            // Pass login status to client side
            SetClientVar("login", LoginStatus());

            // Global Page Rendering event (in userfn*.php)
            Page_Rendering();

            // Page Render event
            if (method_exists($this, "pageRender")) {
                $this->pageRender();
            }

            // Render search option
            if (method_exists($this, "renderSearchOptions")) {
                $this->renderSearchOptions();
            }
        }
    }

    // Get upload files
    protected function getUploadFiles()
    {
        global $CurrentForm, $Language;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;
        $validate = !Config("SERVER_VALIDATE");

        // Check field name 'idProyek' first before field var 'x_idProyek'
        $val = $CurrentForm->hasValue("idProyek") ? $CurrentForm->getValue("idProyek") : $CurrentForm->getValue("x_idProyek");
        if (!$this->idProyek->IsDetailKey) {
            $this->idProyek->setFormValue($val, true, $validate);
        }

        // Check field name 'ajuan' first before field var 'x_ajuan'
        $val = $CurrentForm->hasValue("ajuan") ? $CurrentForm->getValue("ajuan") : $CurrentForm->getValue("x_ajuan");
        if (!$this->ajuan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ajuan->Visible = false; // Disable update for API request
            } else {
                $this->ajuan->setFormValue($val);
            }
        }

        // Check field name 'biayaTerkumpul' first before field var 'x_biayaTerkumpul'
        $val = $CurrentForm->hasValue("biayaTerkumpul") ? $CurrentForm->getValue("biayaTerkumpul") : $CurrentForm->getValue("x_biayaTerkumpul");
        if (!$this->biayaTerkumpul->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->biayaTerkumpul->Visible = false; // Disable update for API request
            } else {
                $this->biayaTerkumpul->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'tanggalMulai' first before field var 'x_tanggalMulai'
        $val = $CurrentForm->hasValue("tanggalMulai") ? $CurrentForm->getValue("tanggalMulai") : $CurrentForm->getValue("x_tanggalMulai");
        if (!$this->tanggalMulai->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tanggalMulai->Visible = false; // Disable update for API request
            } else {
                $this->tanggalMulai->setFormValue($val, true, $validate);
            }
            $this->tanggalMulai->CurrentValue = UnFormatDateTime($this->tanggalMulai->CurrentValue, $this->tanggalMulai->formatPattern());
        }

        // Check field name 'tanggalSelesai' first before field var 'x_tanggalSelesai'
        $val = $CurrentForm->hasValue("tanggalSelesai") ? $CurrentForm->getValue("tanggalSelesai") : $CurrentForm->getValue("x_tanggalSelesai");
        if (!$this->tanggalSelesai->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tanggalSelesai->Visible = false; // Disable update for API request
            } else {
                $this->tanggalSelesai->setFormValue($val, true, $validate);
            }
            $this->tanggalSelesai->CurrentValue = UnFormatDateTime($this->tanggalSelesai->CurrentValue, $this->tanggalSelesai->formatPattern());
        }

        // Check field name 'status' first before field var 'x_status'
        $val = $CurrentForm->hasValue("status") ? $CurrentForm->getValue("status") : $CurrentForm->getValue("x_status");
        if (!$this->status->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->status->Visible = false; // Disable update for API request
            } else {
                $this->status->setFormValue($val);
            }
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->idProyek->CurrentValue = $this->idProyek->FormValue;
        $this->ajuan->CurrentValue = $this->ajuan->FormValue;
        $this->biayaTerkumpul->CurrentValue = $this->biayaTerkumpul->FormValue;
        $this->tanggalMulai->CurrentValue = $this->tanggalMulai->FormValue;
        $this->tanggalMulai->CurrentValue = UnFormatDateTime($this->tanggalMulai->CurrentValue, $this->tanggalMulai->formatPattern());
        $this->tanggalSelesai->CurrentValue = $this->tanggalSelesai->FormValue;
        $this->tanggalSelesai->CurrentValue = UnFormatDateTime($this->tanggalSelesai->CurrentValue, $this->tanggalSelesai->formatPattern());
        $this->status->CurrentValue = $this->status->FormValue;
    }

    /**
     * Load row based on key values
     *
     * @return void
     */
    public function loadRow()
    {
        global $Security, $Language;
        $filter = $this->getRecordFilter();

        // Call Row Selecting event
        $this->rowSelecting($filter);

        // Load SQL based on filter
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        $res = false;
        $row = $conn->fetchAssociative($sql);
        if ($row) {
            $res = true;
            $this->loadRowValues($row); // Load row values
        }
        return $res;
    }

    /**
     * Load row values from recordset or record
     *
     * @param Recordset|array $rs Record
     * @return void
     */
    public function loadRowValues($rs = null)
    {
        if (is_array($rs)) {
            $row = $rs;
        } elseif ($rs && property_exists($rs, "fields")) { // Recordset
            $row = $rs->fields;
        } else {
            $row = $this->newRow();
        }
        if (!$row) {
            return;
        }

        // Call Row Selected event
        $this->rowSelected($row);
        $this->idProyek->setDbValue($row['idProyek']);
        $this->ajuan->setDbValue($row['ajuan']);
        $this->biayaTerkumpul->setDbValue($row['biayaTerkumpul']);
        $this->tanggalMulai->setDbValue($row['tanggalMulai']);
        $this->tanggalSelesai->setDbValue($row['tanggalSelesai']);
        $this->status->setDbValue($row['status']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['idProyek'] = null;
        $row['ajuan'] = null;
        $row['biayaTerkumpul'] = null;
        $row['tanggalMulai'] = null;
        $row['tanggalSelesai'] = null;
        $row['status'] = null;
        return $row;
    }

    // Load old record
    protected function loadOldRecord()
    {
        // Load old record
        $this->OldRecordset = null;
        $validKey = $this->OldKey != "";
        if ($validKey) {
            $this->CurrentFilter = $this->getRecordFilter();
            $sql = $this->getCurrentSql();
            $conn = $this->getConnection();
            $this->OldRecordset = LoadRecordset($sql, $conn);
        }
        $this->loadRowValues($this->OldRecordset); // Load row values
        return $validKey;
    }

    // Render row values based on field settings
    public function renderRow()
    {
        global $Security, $Language, $CurrentLanguage;

        // Initialize URLs

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // idProyek
        $this->idProyek->RowCssClass = "row";

        // ajuan
        $this->ajuan->RowCssClass = "row";

        // biayaTerkumpul
        $this->biayaTerkumpul->RowCssClass = "row";

        // tanggalMulai
        $this->tanggalMulai->RowCssClass = "row";

        // tanggalSelesai
        $this->tanggalSelesai->RowCssClass = "row";

        // status
        $this->status->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // idProyek
            $this->idProyek->ViewValue = $this->idProyek->CurrentValue;
            $this->idProyek->ViewCustomAttributes = "";

            // ajuan
            $curVal = strval($this->ajuan->CurrentValue);
            if ($curVal != "") {
                $this->ajuan->ViewValue = $this->ajuan->lookupCacheOption($curVal);
                if ($this->ajuan->ViewValue === null) { // Lookup from database
                    $filterWrk = "`idAjuanProyek`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->ajuan->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->ajuan->Lookup->renderViewRow($rswrk[0]);
                        $this->ajuan->ViewValue = $this->ajuan->displayValue($arwrk);
                    } else {
                        $this->ajuan->ViewValue = FormatNumber($this->ajuan->CurrentValue, $this->ajuan->formatPattern());
                    }
                }
            } else {
                $this->ajuan->ViewValue = null;
            }
            $this->ajuan->ViewCustomAttributes = "";

            // biayaTerkumpul
            $this->biayaTerkumpul->ViewValue = $this->biayaTerkumpul->CurrentValue;
            $this->biayaTerkumpul->ViewValue = FormatNumber($this->biayaTerkumpul->ViewValue, $this->biayaTerkumpul->formatPattern());
            $this->biayaTerkumpul->ViewCustomAttributes = "";

            // tanggalMulai
            $this->tanggalMulai->ViewValue = $this->tanggalMulai->CurrentValue;
            $this->tanggalMulai->ViewValue = FormatDateTime($this->tanggalMulai->ViewValue, $this->tanggalMulai->formatPattern());
            $this->tanggalMulai->ViewCustomAttributes = "";

            // tanggalSelesai
            $this->tanggalSelesai->ViewValue = $this->tanggalSelesai->CurrentValue;
            $this->tanggalSelesai->ViewValue = FormatDateTime($this->tanggalSelesai->ViewValue, $this->tanggalSelesai->formatPattern());
            $this->tanggalSelesai->ViewCustomAttributes = "";

            // status
            if (strval($this->status->CurrentValue) != "") {
                $this->status->ViewValue = $this->status->optionCaption($this->status->CurrentValue);
            } else {
                $this->status->ViewValue = null;
            }
            $this->status->ViewCustomAttributes = "";

            // idProyek
            $this->idProyek->LinkCustomAttributes = "";
            $this->idProyek->HrefValue = "";

            // ajuan
            $this->ajuan->LinkCustomAttributes = "";
            $this->ajuan->HrefValue = "";

            // biayaTerkumpul
            $this->biayaTerkumpul->LinkCustomAttributes = "";
            $this->biayaTerkumpul->HrefValue = "";

            // tanggalMulai
            $this->tanggalMulai->LinkCustomAttributes = "";
            $this->tanggalMulai->HrefValue = "";

            // tanggalSelesai
            $this->tanggalSelesai->LinkCustomAttributes = "";
            $this->tanggalSelesai->HrefValue = "";

            // status
            $this->status->LinkCustomAttributes = "";
            $this->status->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // idProyek
            $this->idProyek->setupEditAttributes();
            $this->idProyek->EditCustomAttributes = "";
            $this->idProyek->EditValue = $this->idProyek->CurrentValue;
            $this->idProyek->ViewCustomAttributes = "";

            // ajuan
            $this->ajuan->setupEditAttributes();
            $this->ajuan->EditCustomAttributes = "";
            $curVal = trim(strval($this->ajuan->CurrentValue));
            if ($curVal != "") {
                $this->ajuan->ViewValue = $this->ajuan->lookupCacheOption($curVal);
            } else {
                $this->ajuan->ViewValue = $this->ajuan->Lookup !== null && is_array($this->ajuan->lookupOptions()) ? $curVal : null;
            }
            if ($this->ajuan->ViewValue !== null) { // Load from cache
                $this->ajuan->EditValue = array_values($this->ajuan->lookupOptions());
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`idAjuanProyek`" . SearchString("=", $this->ajuan->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->ajuan->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->ajuan->EditValue = $arwrk;
            }
            $this->ajuan->PlaceHolder = RemoveHtml($this->ajuan->caption());

            // biayaTerkumpul
            $this->biayaTerkumpul->setupEditAttributes();
            $this->biayaTerkumpul->EditCustomAttributes = "";
            $this->biayaTerkumpul->EditValue = HtmlEncode($this->biayaTerkumpul->CurrentValue);
            $this->biayaTerkumpul->PlaceHolder = RemoveHtml($this->biayaTerkumpul->caption());
            if (strval($this->biayaTerkumpul->EditValue) != "" && is_numeric($this->biayaTerkumpul->EditValue)) {
                $this->biayaTerkumpul->EditValue = FormatNumber($this->biayaTerkumpul->EditValue, null);
            }

            // tanggalMulai
            $this->tanggalMulai->setupEditAttributes();
            $this->tanggalMulai->EditCustomAttributes = "";
            $this->tanggalMulai->EditValue = HtmlEncode(FormatDateTime($this->tanggalMulai->CurrentValue, $this->tanggalMulai->formatPattern()));
            $this->tanggalMulai->PlaceHolder = RemoveHtml($this->tanggalMulai->caption());

            // tanggalSelesai
            $this->tanggalSelesai->setupEditAttributes();
            $this->tanggalSelesai->EditCustomAttributes = "";
            $this->tanggalSelesai->EditValue = HtmlEncode(FormatDateTime($this->tanggalSelesai->CurrentValue, $this->tanggalSelesai->formatPattern()));
            $this->tanggalSelesai->PlaceHolder = RemoveHtml($this->tanggalSelesai->caption());

            // status
            $this->status->EditCustomAttributes = "";
            $this->status->EditValue = $this->status->options(false);
            $this->status->PlaceHolder = RemoveHtml($this->status->caption());

            // Edit refer script

            // idProyek
            $this->idProyek->LinkCustomAttributes = "";
            $this->idProyek->HrefValue = "";

            // ajuan
            $this->ajuan->LinkCustomAttributes = "";
            $this->ajuan->HrefValue = "";

            // biayaTerkumpul
            $this->biayaTerkumpul->LinkCustomAttributes = "";
            $this->biayaTerkumpul->HrefValue = "";

            // tanggalMulai
            $this->tanggalMulai->LinkCustomAttributes = "";
            $this->tanggalMulai->HrefValue = "";

            // tanggalSelesai
            $this->tanggalSelesai->LinkCustomAttributes = "";
            $this->tanggalSelesai->HrefValue = "";

            // status
            $this->status->LinkCustomAttributes = "";
            $this->status->HrefValue = "";
        }
        if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) { // Add/Edit/Search row
            $this->setupFieldTitles();
        }

        // Call Row Rendered event
        if ($this->RowType != ROWTYPE_AGGREGATEINIT) {
            $this->rowRendered();
        }
    }

    // Validate form
    protected function validateForm()
    {
        global $Language;

        // Check if validation required
        if (!Config("SERVER_VALIDATE")) {
            return true;
        }
        $validateForm = true;
        if ($this->idProyek->Required) {
            if (!$this->idProyek->IsDetailKey && EmptyValue($this->idProyek->FormValue)) {
                $this->idProyek->addErrorMessage(str_replace("%s", $this->idProyek->caption(), $this->idProyek->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->idProyek->FormValue)) {
            $this->idProyek->addErrorMessage($this->idProyek->getErrorMessage(false));
        }
        if ($this->ajuan->Required) {
            if (!$this->ajuan->IsDetailKey && EmptyValue($this->ajuan->FormValue)) {
                $this->ajuan->addErrorMessage(str_replace("%s", $this->ajuan->caption(), $this->ajuan->RequiredErrorMessage));
            }
        }
        if ($this->biayaTerkumpul->Required) {
            if (!$this->biayaTerkumpul->IsDetailKey && EmptyValue($this->biayaTerkumpul->FormValue)) {
                $this->biayaTerkumpul->addErrorMessage(str_replace("%s", $this->biayaTerkumpul->caption(), $this->biayaTerkumpul->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->biayaTerkumpul->FormValue)) {
            $this->biayaTerkumpul->addErrorMessage($this->biayaTerkumpul->getErrorMessage(false));
        }
        if ($this->tanggalMulai->Required) {
            if (!$this->tanggalMulai->IsDetailKey && EmptyValue($this->tanggalMulai->FormValue)) {
                $this->tanggalMulai->addErrorMessage(str_replace("%s", $this->tanggalMulai->caption(), $this->tanggalMulai->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->tanggalMulai->FormValue, $this->tanggalMulai->formatPattern())) {
            $this->tanggalMulai->addErrorMessage($this->tanggalMulai->getErrorMessage(false));
        }
        if ($this->tanggalSelesai->Required) {
            if (!$this->tanggalSelesai->IsDetailKey && EmptyValue($this->tanggalSelesai->FormValue)) {
                $this->tanggalSelesai->addErrorMessage(str_replace("%s", $this->tanggalSelesai->caption(), $this->tanggalSelesai->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->tanggalSelesai->FormValue, $this->tanggalSelesai->formatPattern())) {
            $this->tanggalSelesai->addErrorMessage($this->tanggalSelesai->getErrorMessage(false));
        }
        if ($this->status->Required) {
            if ($this->status->FormValue == "") {
                $this->status->addErrorMessage(str_replace("%s", $this->status->caption(), $this->status->RequiredErrorMessage));
            }
        }

        // Validate detail grid
        $detailTblVar = explode(",", $this->getCurrentDetailTable());
        $detailPage = Container("PartisipasiproyekGrid");
        if (in_array("partisipasiproyek", $detailTblVar) && $detailPage->DetailEdit) {
            $validateForm = $validateForm && $detailPage->validateGridForm();
        }
        $detailPage = Container("AjuanproyekGrid");
        if (in_array("ajuanproyek", $detailTblVar) && $detailPage->DetailEdit) {
            $validateForm = $validateForm && $detailPage->validateGridForm();
        }

        // Return validate result
        $validateForm = $validateForm && !$this->hasInvalidFields();

        // Call Form_CustomValidate event
        $formCustomError = "";
        $validateForm = $validateForm && $this->formCustomValidate($formCustomError);
        if ($formCustomError != "") {
            $this->setFailureMessage($formCustomError);
        }
        return $validateForm;
    }

    // Update record based on key values
    protected function editRow()
    {
        global $Security, $Language;
        $oldKeyFilter = $this->getRecordFilter();
        $filter = $this->applyUserIDFilters($oldKeyFilter);
        $conn = $this->getConnection();
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $rsold = $conn->fetchAssociative($sql);
        if (!$rsold) {
            $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
            $editRow = false; // Update Failed
        } else {
            // Begin transaction
            if ($this->getCurrentDetailTable() != "" && $this->UseTransaction) {
                $conn->beginTransaction();
            }

            // Save old values
            $this->loadDbValues($rsold);
            $rsnew = [];

            // ajuan
            $this->ajuan->setDbValueDef($rsnew, $this->ajuan->CurrentValue, 0, $this->ajuan->ReadOnly);

            // biayaTerkumpul
            $this->biayaTerkumpul->setDbValueDef($rsnew, $this->biayaTerkumpul->CurrentValue, null, $this->biayaTerkumpul->ReadOnly);

            // tanggalMulai
            $this->tanggalMulai->setDbValueDef($rsnew, UnFormatDateTime($this->tanggalMulai->CurrentValue, $this->tanggalMulai->formatPattern()), CurrentDate(), $this->tanggalMulai->ReadOnly);

            // tanggalSelesai
            $this->tanggalSelesai->setDbValueDef($rsnew, UnFormatDateTime($this->tanggalSelesai->CurrentValue, $this->tanggalSelesai->formatPattern()), null, $this->tanggalSelesai->ReadOnly);

            // status
            $this->status->setDbValueDef($rsnew, $this->status->CurrentValue, "", $this->status->ReadOnly);

            // Call Row Updating event
            $updateRow = $this->rowUpdating($rsold, $rsnew);
            if ($updateRow) {
                if (count($rsnew) > 0) {
                    $editRow = $this->update($rsnew, "", $rsold);
                } else {
                    $editRow = true; // No field to update
                }
                if ($editRow) {
                }

                // Update detail records
                $detailTblVar = explode(",", $this->getCurrentDetailTable());
                if ($editRow) {
                    $detailPage = Container("PartisipasiproyekGrid");
                    if (in_array("partisipasiproyek", $detailTblVar) && $detailPage->DetailEdit) {
                        $Security->loadCurrentUserLevel($this->ProjectID . "partisipasiproyek"); // Load user level of detail table
                        $editRow = $detailPage->gridUpdate();
                        $Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
                    }
                }
                if ($editRow) {
                    $detailPage = Container("AjuanproyekGrid");
                    if (in_array("ajuanproyek", $detailTblVar) && $detailPage->DetailEdit) {
                        $Security->loadCurrentUserLevel($this->ProjectID . "ajuanproyek"); // Load user level of detail table
                        $editRow = $detailPage->gridUpdate();
                        $Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
                    }
                }

                // Commit/Rollback transaction
                if ($this->getCurrentDetailTable() != "") {
                    if ($editRow) {
                        if ($this->UseTransaction) { // Commit transaction
                            $conn->commit();
                        }
                    } else {
                        if ($this->UseTransaction) { // Rollback transaction
                            $conn->rollback();
                        }
                    }
                }
            } else {
                if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                    // Use the message, do nothing
                } elseif ($this->CancelMessage != "") {
                    $this->setFailureMessage($this->CancelMessage);
                    $this->CancelMessage = "";
                } else {
                    $this->setFailureMessage($Language->phrase("UpdateCancelled"));
                }
                $editRow = false;
            }
        }

        // Call Row_Updated event
        if ($editRow) {
            $this->rowUpdated($rsold, $rsnew);
        }

        // Clean upload path if any
        if ($editRow) {
        }

        // Write JSON for API request
        if (IsApi() && $editRow) {
            $row = $this->getRecordsFromRecordset([$rsnew], true);
            WriteJson(["success" => true, $this->TableVar => $row]);
        }
        return $editRow;
    }

    // Set up detail parms based on QueryString
    protected function setupDetailParms()
    {
        // Get the keys for master table
        $detailTblVar = Get(Config("TABLE_SHOW_DETAIL"));
        if ($detailTblVar !== null) {
            $this->setCurrentDetailTable($detailTblVar);
        } else {
            $detailTblVar = $this->getCurrentDetailTable();
        }
        if ($detailTblVar != "") {
            $detailTblVar = explode(",", $detailTblVar);
            if (in_array("partisipasiproyek", $detailTblVar)) {
                $detailPageObj = Container("PartisipasiproyekGrid");
                if ($detailPageObj->DetailEdit) {
                    $detailPageObj->CurrentMode = "edit";
                    $detailPageObj->CurrentAction = "gridedit";

                    // Save current master table to detail table
                    $detailPageObj->setCurrentMasterTable($this->TableVar);
                    $detailPageObj->setStartRecordNumber(1);
                    $detailPageObj->idProyek->IsDetailKey = true;
                    $detailPageObj->idProyek->CurrentValue = $this->idProyek->CurrentValue;
                    $detailPageObj->idProyek->setSessionValue($detailPageObj->idProyek->CurrentValue);
                }
            }
            if (in_array("ajuanproyek", $detailTblVar)) {
                $detailPageObj = Container("AjuanproyekGrid");
                if ($detailPageObj->DetailEdit) {
                    $detailPageObj->CurrentMode = "edit";
                    $detailPageObj->CurrentAction = "gridedit";

                    // Save current master table to detail table
                    $detailPageObj->setCurrentMasterTable($this->TableVar);
                    $detailPageObj->setStartRecordNumber(1);
                    $detailPageObj->idAjuanProyek->IsDetailKey = true;
                    $detailPageObj->idAjuanProyek->CurrentValue = $this->ajuan->CurrentValue;
                    $detailPageObj->idAjuanProyek->setSessionValue($detailPageObj->idAjuanProyek->CurrentValue);
                }
            }
        }
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("ProyekList"), "", $this->TableVar, true);
        $pageId = "edit";
        $Breadcrumb->add("edit", $pageId, $url);
    }

    // Setup lookup options
    public function setupLookupOptions($fld)
    {
        if ($fld->Lookup !== null && $fld->Lookup->Options === null) {
            // Get default connection and filter
            $conn = $this->getConnection();
            $lookupFilter = "";

            // No need to check any more
            $fld->Lookup->Options = [];

            // Set up lookup SQL and connection
            switch ($fld->FieldVar) {
                case "x_ajuan":
                    break;
                case "x_status":
                    break;
                default:
                    $lookupFilter = "";
                    break;
            }

            // Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
            $sql = $fld->Lookup->getSql(false, "", $lookupFilter, $this);

            // Set up lookup cache
            if (!$fld->hasLookupOptions() && $fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0) {
                $totalCnt = $this->getRecordCount($sql, $conn);
                if ($totalCnt > $fld->LookupCacheCount) { // Total count > cache count, do not cache
                    return;
                }
                $rows = $conn->executeQuery($sql)->fetchAll();
                $ar = [];
                foreach ($rows as $row) {
                    $row = $fld->Lookup->renderViewRow($row, Container($fld->Lookup->LinkTable));
                    $ar[strval($row["lf"])] = $row;
                }
                $fld->Lookup->Options = $ar;
            }
        }
    }

    // Set up starting record parameters
    public function setupStartRecord()
    {
        if ($this->DisplayRecords == 0) {
            return;
        }
        if ($this->isPageRequest()) { // Validate request
            $startRec = Get(Config("TABLE_START_REC"));
            $pageNo = Get(Config("TABLE_PAGE_NO"));
            if ($pageNo !== null) { // Check for "pageno" parameter first
                $pageNo = ParseInteger($pageNo);
                if (is_numeric($pageNo)) {
                    $this->StartRecord = ($pageNo - 1) * $this->DisplayRecords + 1;
                    if ($this->StartRecord <= 0) {
                        $this->StartRecord = 1;
                    } elseif ($this->StartRecord >= (int)(($this->TotalRecords - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1) {
                        $this->StartRecord = (int)(($this->TotalRecords - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1;
                    }
                    $this->setStartRecordNumber($this->StartRecord);
                }
            } elseif ($startRec !== null) { // Check for "start" parameter
                $this->StartRecord = $startRec;
                $this->setStartRecordNumber($this->StartRecord);
            }
        }
        $this->StartRecord = $this->getStartRecordNumber();

        // Check if correct start record counter
        if (!is_numeric($this->StartRecord) || $this->StartRecord == "") { // Avoid invalid start record counter
            $this->StartRecord = 1; // Reset start record counter
            $this->setStartRecordNumber($this->StartRecord);
        } elseif ($this->StartRecord > $this->TotalRecords) { // Avoid starting record > total records
            $this->StartRecord = (int)(($this->TotalRecords - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1; // Point to last page first record
            $this->setStartRecordNumber($this->StartRecord);
        } elseif (($this->StartRecord - 1) % $this->DisplayRecords != 0) {
            $this->StartRecord = (int)(($this->StartRecord - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1; // Point to page boundary
            $this->setStartRecordNumber($this->StartRecord);
        }
    }

    // Page Load event
    public function pageLoad()
    {
        //Log("Page Load");
    }

    // Page Unload event
    public function pageUnload()
    {
        //Log("Page Unload");
    }

    // Page Redirecting event
    public function pageRedirecting(&$url)
    {
        // Example:
        //$url = "your URL";
    }

    // Message Showing event
    // $type = ''|'success'|'failure'|'warning'
    public function messageShowing(&$msg, $type)
    {
        if ($type == 'success') {
            //$msg = "your success message";
        } elseif ($type == 'failure') {
            //$msg = "your failure message";
        } elseif ($type == 'warning') {
            //$msg = "your warning message";
        } else {
            //$msg = "your message";
        }
    }

    // Page Render event
    public function pageRender()
    {
        //Log("Page Render");
    }

    // Page Data Rendering event
    public function pageDataRendering(&$header)
    {
        // Example:
        //$header = "your header";
    }

    // Page Data Rendered event
    public function pageDataRendered(&$footer)
    {
        // Example:
        //$footer = "your footer";
    }

    // Form Custom Validate event
    public function formCustomValidate(&$customError)
    {
        // Return error message in $customError
        return true;
    }
}
