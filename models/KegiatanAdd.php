<?php

namespace PHPMaker2022\project1;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class KegiatanAdd extends Kegiatan
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'kegiatan';

    // Page object name
    public $PageObjName = "KegiatanAdd";

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

        // Table object (kegiatan)
        if (!isset($GLOBALS["kegiatan"]) || get_class($GLOBALS["kegiatan"]) == PROJECT_NAMESPACE . "kegiatan") {
            $GLOBALS["kegiatan"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'kegiatan');
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
                $tbl = Container("kegiatan");
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
                    if ($pageName == "KegiatanView") {
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
            $key .= @$ar['idKegiatan'];
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
            $this->idKegiatan->Visible = false;
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
    public $FormClassName = "ew-form ew-add-form";
    public $IsModal = false;
    public $IsMobileOrModal = false;
    public $DbMasterFilter = "";
    public $DbDetailFilter = "";
    public $StartRecord;
    public $Priv = 0;
    public $OldRecordset;
    public $CopyRecord;

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
        $this->idKegiatan->Visible = false;
        $this->nama->setVisibility();
        $this->deskripsi->setVisibility();
        $this->penanggungJawab->setVisibility();
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
        $this->setupLookupOptions($this->penanggungJawab);
        $this->setupLookupOptions($this->status);

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }
        $this->IsMobileOrModal = IsMobile() || $this->IsModal;
        $this->FormClassName = "ew-form ew-add-form";
        $postBack = false;

        // Set up current action
        if (IsApi()) {
            $this->CurrentAction = "insert"; // Add record directly
            $postBack = true;
        } elseif (Post("action") !== null) {
            $this->CurrentAction = Post("action"); // Get form action
            $this->setKey(Post($this->OldKeyName));
            $postBack = true;
        } else {
            // Load key values from QueryString
            if (($keyValue = Get("idKegiatan") ?? Route("idKegiatan")) !== null) {
                $this->idKegiatan->setQueryStringValue($keyValue);
            }
            $this->OldKey = $this->getKey(true); // Get from CurrentValue
            $this->CopyRecord = !EmptyValue($this->OldKey);
            if ($this->CopyRecord) {
                $this->CurrentAction = "copy"; // Copy record
            } else {
                $this->CurrentAction = "show"; // Display blank record
            }
        }

        // Load old record / default values
        $loaded = $this->loadOldRecord();

        // Load form values
        if ($postBack) {
            $this->loadFormValues(); // Load form values
        }

        // Set up detail parameters
        $this->setupDetailParms();

        // Validate form if post back
        if ($postBack) {
            if (!$this->validateForm()) {
                $this->EventCancelled = true; // Event cancelled
                $this->restoreFormValues(); // Restore form values
                if (IsApi()) {
                    $this->terminate();
                    return;
                } else {
                    $this->CurrentAction = "show"; // Form error, reset action
                }
            }
        }

        // Perform current action
        switch ($this->CurrentAction) {
            case "copy": // Copy an existing record
                if (!$loaded) { // Record not loaded
                    if ($this->getFailureMessage() == "") {
                        $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
                    }
                    $this->terminate("KegiatanList"); // No matching record, return to list
                    return;
                }

                // Set up detail parameters
                $this->setupDetailParms();
                break;
            case "insert": // Add new record
                $this->SendEmail = true; // Send email on add success
                if ($this->addRow($this->OldRecordset)) { // Add successful
                    if ($this->getSuccessMessage() == "" && Post("addopt") != "1") { // Skip success message for addopt (done in JavaScript)
                        $this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
                    }
                    if ($this->getCurrentDetailTable() != "") { // Master/detail add
                        $returnUrl = $this->getDetailUrl();
                    } else {
                        $returnUrl = $this->getReturnUrl();
                    }
                    if (GetPageName($returnUrl) == "KegiatanList") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "KegiatanView") {
                        $returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
                    }
                    if (IsApi()) { // Return to caller
                        $this->terminate(true);
                        return;
                    } else {
                        $this->terminate($returnUrl);
                        return;
                    }
                } elseif (IsApi()) { // API request, return
                    $this->terminate();
                    return;
                } else {
                    $this->EventCancelled = true; // Event cancelled
                    $this->restoreFormValues(); // Add failed, restore form values

                    // Set up detail parameters
                    $this->setupDetailParms();
                }
        }

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Render row based on row type
        $this->RowType = ROWTYPE_ADD; // Render add type

        // Render row
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

    // Load default values
    protected function loadDefaultValues()
    {
        $this->idKegiatan->CurrentValue = null;
        $this->idKegiatan->OldValue = $this->idKegiatan->CurrentValue;
        $this->nama->CurrentValue = null;
        $this->nama->OldValue = $this->nama->CurrentValue;
        $this->deskripsi->CurrentValue = null;
        $this->deskripsi->OldValue = $this->deskripsi->CurrentValue;
        $this->penanggungJawab->CurrentValue = null;
        $this->penanggungJawab->OldValue = $this->penanggungJawab->CurrentValue;
        $this->tanggalMulai->CurrentValue = null;
        $this->tanggalMulai->OldValue = $this->tanggalMulai->CurrentValue;
        $this->tanggalSelesai->CurrentValue = null;
        $this->tanggalSelesai->OldValue = $this->tanggalSelesai->CurrentValue;
        $this->status->CurrentValue = null;
        $this->status->OldValue = $this->status->CurrentValue;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;
        $validate = !Config("SERVER_VALIDATE");

        // Check field name 'nama' first before field var 'x_nama'
        $val = $CurrentForm->hasValue("nama") ? $CurrentForm->getValue("nama") : $CurrentForm->getValue("x_nama");
        if (!$this->nama->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->nama->Visible = false; // Disable update for API request
            } else {
                $this->nama->setFormValue($val);
            }
        }

        // Check field name 'deskripsi' first before field var 'x_deskripsi'
        $val = $CurrentForm->hasValue("deskripsi") ? $CurrentForm->getValue("deskripsi") : $CurrentForm->getValue("x_deskripsi");
        if (!$this->deskripsi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->deskripsi->Visible = false; // Disable update for API request
            } else {
                $this->deskripsi->setFormValue($val);
            }
        }

        // Check field name 'penanggungJawab' first before field var 'x_penanggungJawab'
        $val = $CurrentForm->hasValue("penanggungJawab") ? $CurrentForm->getValue("penanggungJawab") : $CurrentForm->getValue("x_penanggungJawab");
        if (!$this->penanggungJawab->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->penanggungJawab->Visible = false; // Disable update for API request
            } else {
                $this->penanggungJawab->setFormValue($val);
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

        // Check field name 'idKegiatan' first before field var 'x_idKegiatan'
        $val = $CurrentForm->hasValue("idKegiatan") ? $CurrentForm->getValue("idKegiatan") : $CurrentForm->getValue("x_idKegiatan");
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->nama->CurrentValue = $this->nama->FormValue;
        $this->deskripsi->CurrentValue = $this->deskripsi->FormValue;
        $this->penanggungJawab->CurrentValue = $this->penanggungJawab->FormValue;
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
        $this->idKegiatan->setDbValue($row['idKegiatan']);
        $this->nama->setDbValue($row['nama']);
        $this->deskripsi->setDbValue($row['deskripsi']);
        $this->penanggungJawab->setDbValue($row['penanggungJawab']);
        $this->tanggalMulai->setDbValue($row['tanggalMulai']);
        $this->tanggalSelesai->setDbValue($row['tanggalSelesai']);
        $this->status->setDbValue($row['status']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $this->loadDefaultValues();
        $row = [];
        $row['idKegiatan'] = $this->idKegiatan->CurrentValue;
        $row['nama'] = $this->nama->CurrentValue;
        $row['deskripsi'] = $this->deskripsi->CurrentValue;
        $row['penanggungJawab'] = $this->penanggungJawab->CurrentValue;
        $row['tanggalMulai'] = $this->tanggalMulai->CurrentValue;
        $row['tanggalSelesai'] = $this->tanggalSelesai->CurrentValue;
        $row['status'] = $this->status->CurrentValue;
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

        // idKegiatan
        $this->idKegiatan->RowCssClass = "row";

        // nama
        $this->nama->RowCssClass = "row";

        // deskripsi
        $this->deskripsi->RowCssClass = "row";

        // penanggungJawab
        $this->penanggungJawab->RowCssClass = "row";

        // tanggalMulai
        $this->tanggalMulai->RowCssClass = "row";

        // tanggalSelesai
        $this->tanggalSelesai->RowCssClass = "row";

        // status
        $this->status->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // idKegiatan
            $this->idKegiatan->ViewValue = $this->idKegiatan->CurrentValue;
            $this->idKegiatan->ViewCustomAttributes = "";

            // nama
            $this->nama->ViewValue = $this->nama->CurrentValue;
            $this->nama->ViewCustomAttributes = "";

            // deskripsi
            $this->deskripsi->ViewValue = $this->deskripsi->CurrentValue;
            $this->deskripsi->ViewCustomAttributes = "";

            // penanggungJawab
            $curVal = strval($this->penanggungJawab->CurrentValue);
            if ($curVal != "") {
                $this->penanggungJawab->ViewValue = $this->penanggungJawab->lookupCacheOption($curVal);
                if ($this->penanggungJawab->ViewValue === null) { // Lookup from database
                    $filterWrk = "`idAnggota`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->penanggungJawab->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->penanggungJawab->Lookup->renderViewRow($rswrk[0]);
                        $this->penanggungJawab->ViewValue = $this->penanggungJawab->displayValue($arwrk);
                    } else {
                        $this->penanggungJawab->ViewValue = FormatNumber($this->penanggungJawab->CurrentValue, $this->penanggungJawab->formatPattern());
                    }
                }
            } else {
                $this->penanggungJawab->ViewValue = null;
            }
            $this->penanggungJawab->ViewCustomAttributes = "";

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

            // nama
            $this->nama->LinkCustomAttributes = "";
            $this->nama->HrefValue = "";

            // deskripsi
            $this->deskripsi->LinkCustomAttributes = "";
            $this->deskripsi->HrefValue = "";

            // penanggungJawab
            $this->penanggungJawab->LinkCustomAttributes = "";
            $this->penanggungJawab->HrefValue = "";

            // tanggalMulai
            $this->tanggalMulai->LinkCustomAttributes = "";
            $this->tanggalMulai->HrefValue = "";

            // tanggalSelesai
            $this->tanggalSelesai->LinkCustomAttributes = "";
            $this->tanggalSelesai->HrefValue = "";

            // status
            $this->status->LinkCustomAttributes = "";
            $this->status->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // nama
            $this->nama->setupEditAttributes();
            $this->nama->EditCustomAttributes = "";
            if (!$this->nama->Raw) {
                $this->nama->CurrentValue = HtmlDecode($this->nama->CurrentValue);
            }
            $this->nama->EditValue = HtmlEncode($this->nama->CurrentValue);
            $this->nama->PlaceHolder = RemoveHtml($this->nama->caption());

            // deskripsi
            $this->deskripsi->setupEditAttributes();
            $this->deskripsi->EditCustomAttributes = "";
            $this->deskripsi->EditValue = HtmlEncode($this->deskripsi->CurrentValue);
            $this->deskripsi->PlaceHolder = RemoveHtml($this->deskripsi->caption());

            // penanggungJawab
            $this->penanggungJawab->setupEditAttributes();
            $this->penanggungJawab->EditCustomAttributes = "";
            $curVal = trim(strval($this->penanggungJawab->CurrentValue));
            if ($curVal != "") {
                $this->penanggungJawab->ViewValue = $this->penanggungJawab->lookupCacheOption($curVal);
            } else {
                $this->penanggungJawab->ViewValue = $this->penanggungJawab->Lookup !== null && is_array($this->penanggungJawab->lookupOptions()) ? $curVal : null;
            }
            if ($this->penanggungJawab->ViewValue !== null) { // Load from cache
                $this->penanggungJawab->EditValue = array_values($this->penanggungJawab->lookupOptions());
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`idAnggota`" . SearchString("=", $this->penanggungJawab->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->penanggungJawab->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->penanggungJawab->EditValue = $arwrk;
            }
            $this->penanggungJawab->PlaceHolder = RemoveHtml($this->penanggungJawab->caption());

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

            // Add refer script

            // nama
            $this->nama->LinkCustomAttributes = "";
            $this->nama->HrefValue = "";

            // deskripsi
            $this->deskripsi->LinkCustomAttributes = "";
            $this->deskripsi->HrefValue = "";

            // penanggungJawab
            $this->penanggungJawab->LinkCustomAttributes = "";
            $this->penanggungJawab->HrefValue = "";

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
        if ($this->nama->Required) {
            if (!$this->nama->IsDetailKey && EmptyValue($this->nama->FormValue)) {
                $this->nama->addErrorMessage(str_replace("%s", $this->nama->caption(), $this->nama->RequiredErrorMessage));
            }
        }
        if ($this->deskripsi->Required) {
            if (!$this->deskripsi->IsDetailKey && EmptyValue($this->deskripsi->FormValue)) {
                $this->deskripsi->addErrorMessage(str_replace("%s", $this->deskripsi->caption(), $this->deskripsi->RequiredErrorMessage));
            }
        }
        if ($this->penanggungJawab->Required) {
            if (!$this->penanggungJawab->IsDetailKey && EmptyValue($this->penanggungJawab->FormValue)) {
                $this->penanggungJawab->addErrorMessage(str_replace("%s", $this->penanggungJawab->caption(), $this->penanggungJawab->RequiredErrorMessage));
            }
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
        $detailPage = Container("PartisipasikegiatanGrid");
        if (in_array("partisipasikegiatan", $detailTblVar) && $detailPage->DetailAdd) {
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

    // Add record
    protected function addRow($rsold = null)
    {
        global $Language, $Security;
        $conn = $this->getConnection();

        // Begin transaction
        if ($this->getCurrentDetailTable() != "" && $this->UseTransaction) {
            $conn->beginTransaction();
        }

        // Load db values from rsold
        $this->loadDbValues($rsold);
        if ($rsold) {
        }
        $rsnew = [];

        // nama
        $this->nama->setDbValueDef($rsnew, $this->nama->CurrentValue, "", false);

        // deskripsi
        $this->deskripsi->setDbValueDef($rsnew, $this->deskripsi->CurrentValue, "", false);

        // penanggungJawab
        $this->penanggungJawab->setDbValueDef($rsnew, $this->penanggungJawab->CurrentValue, null, false);

        // tanggalMulai
        $this->tanggalMulai->setDbValueDef($rsnew, UnFormatDateTime($this->tanggalMulai->CurrentValue, $this->tanggalMulai->formatPattern()), CurrentDate(), false);

        // tanggalSelesai
        $this->tanggalSelesai->setDbValueDef($rsnew, UnFormatDateTime($this->tanggalSelesai->CurrentValue, $this->tanggalSelesai->formatPattern()), null, false);

        // status
        $this->status->setDbValueDef($rsnew, $this->status->CurrentValue, "", false);

        // Call Row Inserting event
        $insertRow = $this->rowInserting($rsold, $rsnew);
        if ($insertRow) {
            $addRow = $this->insert($rsnew);
            if ($addRow) {
            }
        } else {
            if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                // Use the message, do nothing
            } elseif ($this->CancelMessage != "") {
                $this->setFailureMessage($this->CancelMessage);
                $this->CancelMessage = "";
            } else {
                $this->setFailureMessage($Language->phrase("InsertCancelled"));
            }
            $addRow = false;
        }

        // Add detail records
        if ($addRow) {
            $detailTblVar = explode(",", $this->getCurrentDetailTable());
            $detailPage = Container("PartisipasikegiatanGrid");
            if (in_array("partisipasikegiatan", $detailTblVar) && $detailPage->DetailAdd) {
                $detailPage->idKegiatan->setSessionValue($this->idKegiatan->CurrentValue); // Set master key
                $Security->loadCurrentUserLevel($this->ProjectID . "partisipasikegiatan"); // Load user level of detail table
                $addRow = $detailPage->gridInsert();
                $Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
                if (!$addRow) {
                $detailPage->idKegiatan->setSessionValue(""); // Clear master key if insert failed
                }
            }
        }

        // Commit/Rollback transaction
        if ($this->getCurrentDetailTable() != "") {
            if ($addRow) {
                if ($this->UseTransaction) { // Commit transaction
                    $conn->commit();
                }
            } else {
                if ($this->UseTransaction) { // Rollback transaction
                    $conn->rollback();
                }
            }
        }
        if ($addRow) {
            // Call Row Inserted event
            $this->rowInserted($rsold, $rsnew);
        }

        // Clean upload path if any
        if ($addRow) {
        }

        // Write JSON for API request
        if (IsApi() && $addRow) {
            $row = $this->getRecordsFromRecordset([$rsnew], true);
            WriteJson(["success" => true, $this->TableVar => $row]);
        }
        return $addRow;
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
            if (in_array("partisipasikegiatan", $detailTblVar)) {
                $detailPageObj = Container("PartisipasikegiatanGrid");
                if ($detailPageObj->DetailAdd) {
                    if ($this->CopyRecord) {
                        $detailPageObj->CurrentMode = "copy";
                    } else {
                        $detailPageObj->CurrentMode = "add";
                    }
                    $detailPageObj->CurrentAction = "gridadd";

                    // Save current master table to detail table
                    $detailPageObj->setCurrentMasterTable($this->TableVar);
                    $detailPageObj->setStartRecordNumber(1);
                    $detailPageObj->idKegiatan->IsDetailKey = true;
                    $detailPageObj->idKegiatan->CurrentValue = $this->idKegiatan->CurrentValue;
                    $detailPageObj->idKegiatan->setSessionValue($detailPageObj->idKegiatan->CurrentValue);
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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("KegiatanList"), "", $this->TableVar, true);
        $pageId = ($this->isCopy()) ? "Copy" : "Add";
        $Breadcrumb->add("add", $pageId, $url);
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
                case "x_penanggungJawab":
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
