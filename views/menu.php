<?php

namespace PHPMaker2022\project1;

// Menu Language
if ($Language && function_exists(PROJECT_NAMESPACE . "Config") && $Language->LanguageFolder == Config("LANGUAGE_FOLDER")) {
    $MenuRelativePath = "";
    $MenuLanguage = &$Language;
} else { // Compat reports
    $LANGUAGE_FOLDER = "../lang/";
    $MenuRelativePath = "../";
    $MenuLanguage = Container("language");
}

// Navbar menu
$topMenu = new Menu("navbar", true, true);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", true, false);
$sideMenu->addMenuItem(3, "mi_anggota", $MenuLanguage->MenuPhrase("3", "MenuText"), $MenuRelativePath . "AnggotaList", -1, "", AllowListMenu('{38C46513-0B28-48C2-93E0-4388502DC508}anggota'), false, false, "", "", false);
$sideMenu->addMenuItem(9, "mi_kontakanggota", $MenuLanguage->MenuPhrase("9", "MenuText"), $MenuRelativePath . "KontakanggotaList?cmd=resetall", -1, "", AllowListMenu('{38C46513-0B28-48C2-93E0-4388502DC508}kontakanggota'), false, false, "", "", false);
$sideMenu->addMenuItem(6, "mi_jabatan", $MenuLanguage->MenuPhrase("6", "MenuText"), $MenuRelativePath . "JabatanList", -1, "", AllowListMenu('{38C46513-0B28-48C2-93E0-4388502DC508}jabatan'), false, false, "", "", false);
$sideMenu->addMenuItem(7, "mi_kegiatan", $MenuLanguage->MenuPhrase("7", "MenuText"), $MenuRelativePath . "KegiatanList", -1, "", AllowListMenu('{38C46513-0B28-48C2-93E0-4388502DC508}kegiatan'), false, false, "", "", false);
$sideMenu->addMenuItem(12, "mi_partisipasikegiatan", $MenuLanguage->MenuPhrase("12", "MenuText"), $MenuRelativePath . "PartisipasikegiatanList?cmd=resetall", -1, "", AllowListMenu('{38C46513-0B28-48C2-93E0-4388502DC508}partisipasikegiatan'), false, false, "", "", false);
$sideMenu->addMenuItem(4, "mi_donasi", $MenuLanguage->MenuPhrase("4", "MenuText"), $MenuRelativePath . "DonasiList?cmd=resetall", -1, "", AllowListMenu('{38C46513-0B28-48C2-93E0-4388502DC508}donasi'), false, false, "", "", false);
$sideMenu->addMenuItem(5, "mi_donatur", $MenuLanguage->MenuPhrase("5", "MenuText"), $MenuRelativePath . "DonaturList", -1, "", AllowListMenu('{38C46513-0B28-48C2-93E0-4388502DC508}donatur'), false, false, "", "", false);
$sideMenu->addMenuItem(10, "mi_kontakdonatur", $MenuLanguage->MenuPhrase("10", "MenuText"), $MenuRelativePath . "KontakdonaturList?cmd=resetall", -1, "", AllowListMenu('{38C46513-0B28-48C2-93E0-4388502DC508}kontakdonatur'), false, false, "", "", false);
$sideMenu->addMenuItem(14, "mi_proyek", $MenuLanguage->MenuPhrase("14", "MenuText"), $MenuRelativePath . "ProyekList", -1, "", AllowListMenu('{38C46513-0B28-48C2-93E0-4388502DC508}proyek'), false, false, "", "", false);
$sideMenu->addMenuItem(13, "mi_partisipasiproyek", $MenuLanguage->MenuPhrase("13", "MenuText"), $MenuRelativePath . "PartisipasiproyekList?cmd=resetall", -1, "", AllowListMenu('{38C46513-0B28-48C2-93E0-4388502DC508}partisipasiproyek'), false, false, "", "", false);
$sideMenu->addMenuItem(2, "mi_ajuanproyek", $MenuLanguage->MenuPhrase("2", "MenuText"), $MenuRelativePath . "AjuanproyekList?cmd=resetall", -1, "", AllowListMenu('{38C46513-0B28-48C2-93E0-4388502DC508}ajuanproyek'), false, false, "", "", false);
$sideMenu->addMenuItem(8, "mi_kontakajuanproyek", $MenuLanguage->MenuPhrase("8", "MenuText"), $MenuRelativePath . "KontakajuanproyekList?cmd=resetall", -1, "", AllowListMenu('{38C46513-0B28-48C2-93E0-4388502DC508}kontakajuanproyek'), false, false, "", "", false);
$sideMenu->addMenuItem(1, "mi_ajuanproposal", $MenuLanguage->MenuPhrase("1", "MenuText"), $MenuRelativePath . "AjuanproposalList", -1, "", AllowListMenu('{38C46513-0B28-48C2-93E0-4388502DC508}ajuanproposal'), false, false, "", "", false);
$sideMenu->addMenuItem(15, "mi_targetproposal", $MenuLanguage->MenuPhrase("15", "MenuText"), $MenuRelativePath . "TargetproposalList", -1, "", AllowListMenu('{38C46513-0B28-48C2-93E0-4388502DC508}targetproposal'), false, false, "", "", false);
$sideMenu->addMenuItem(11, "mi_kontaktargetproposal", $MenuLanguage->MenuPhrase("11", "MenuText"), $MenuRelativePath . "KontaktargetproposalList?cmd=resetall", -1, "", AllowListMenu('{38C46513-0B28-48C2-93E0-4388502DC508}kontaktargetproposal'), false, false, "", "", false);
$sideMenu->addMenuItem(16, "mi_users", $MenuLanguage->MenuPhrase("16", "MenuText"), $MenuRelativePath . "UsersList", -1, "", AllowListMenu('{38C46513-0B28-48C2-93E0-4388502DC508}users'), false, false, "", "", false);
$sideMenu->addMenuItem(17, "mi_userlevelpermissions", $MenuLanguage->MenuPhrase("17", "MenuText"), $MenuRelativePath . "UserlevelpermissionsList", -1, "", AllowListMenu('{38C46513-0B28-48C2-93E0-4388502DC508}userlevelpermissions'), false, false, "", "", false);
$sideMenu->addMenuItem(18, "mi_userlevels", $MenuLanguage->MenuPhrase("18", "MenuText"), $MenuRelativePath . "UserlevelsList", -1, "", AllowListMenu('{38C46513-0B28-48C2-93E0-4388502DC508}userlevels'), false, false, "", "", false);
echo $sideMenu->toScript();
