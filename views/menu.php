<?php

namespace PHPMaker2022\sigap;

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
$sideMenu->addMenuItem(56, "mi_potongan_sd", $MenuLanguage->MenuPhrase("56", "MenuText"), $MenuRelativePath . "PotonganSdList", -1, "", AllowListMenu('{AA20F783-9E3D-4187-A890-7D24D71E39F6}potongan_sd'), false, false, "", "", false, true);
$sideMenu->addMenuItem(57, "mi_potongan_smp", $MenuLanguage->MenuPhrase("57", "MenuText"), $MenuRelativePath . "PotonganSmpList", -1, "", AllowListMenu('{AA20F783-9E3D-4187-A890-7D24D71E39F6}potongan_smp'), false, false, "", "", false, true);
$sideMenu->addMenuItem(42, "mi_gajisd", $MenuLanguage->MenuPhrase("42", "MenuText"), $MenuRelativePath . "GajisdList", -1, "", AllowListMenu('{AA20F783-9E3D-4187-A890-7D24D71E39F6}gajisd'), false, false, "", "", false, true);
$sideMenu->addMenuItem(44, "mi_gajitk", $MenuLanguage->MenuPhrase("44", "MenuText"), $MenuRelativePath . "GajitkList", -1, "", AllowListMenu('{AA20F783-9E3D-4187-A890-7D24D71E39F6}gajitk'), false, false, "", "", false, true);
$sideMenu->addMenuItem(46, "mi_gajisma", $MenuLanguage->MenuPhrase("46", "MenuText"), $MenuRelativePath . "GajismaList", -1, "", AllowListMenu('{AA20F783-9E3D-4187-A890-7D24D71E39F6}gajisma'), false, false, "", "", false, true);
$sideMenu->addMenuItem(48, "mi_gajismk", $MenuLanguage->MenuPhrase("48", "MenuText"), $MenuRelativePath . "GajismkList", -1, "", AllowListMenu('{AA20F783-9E3D-4187-A890-7D24D71E39F6}gajismk'), false, false, "", "", false, true);
$sideMenu->addMenuItem(50, "mi_gajismp", $MenuLanguage->MenuPhrase("50", "MenuText"), $MenuRelativePath . "GajismpList", -1, "", AllowListMenu('{AA20F783-9E3D-4187-A890-7D24D71E39F6}gajismp'), false, false, "", "", false, true);
$sideMenu->addMenuItem(39, "mi_gaji", $MenuLanguage->MenuPhrase("39", "MenuText"), $MenuRelativePath . "GajiList", -1, "", AllowListMenu('{AA20F783-9E3D-4187-A890-7D24D71E39F6}gaji'), false, false, "", "", false, true);
$sideMenu->addMenuItem(32, "mi_potongan", $MenuLanguage->MenuPhrase("32", "MenuText"), $MenuRelativePath . "PotonganList", -1, "", AllowListMenu('{AA20F783-9E3D-4187-A890-7D24D71E39F6}potongan'), false, false, "", "", false, true);
$sideMenu->addMenuItem(21, "mi_pegawai", $MenuLanguage->MenuPhrase("21", "MenuText"), $MenuRelativePath . "PegawaiList", -1, "", AllowListMenu('{AA20F783-9E3D-4187-A890-7D24D71E39F6}pegawai'), false, false, "", "", false, true);
$sideMenu->addMenuItem(1, "mi_absen", $MenuLanguage->MenuPhrase("1", "MenuText"), $MenuRelativePath . "AbsenList", -1, "", AllowListMenu('{AA20F783-9E3D-4187-A890-7D24D71E39F6}absen'), false, false, "", "", false, true);
$sideMenu->addMenuItem(8, "mi_ijin", $MenuLanguage->MenuPhrase("8", "MenuText"), $MenuRelativePath . "IjinList", -1, "", AllowListMenu('{AA20F783-9E3D-4187-A890-7D24D71E39F6}ijin'), false, false, "", "", false, true);
$sideMenu->addMenuItem(17, "mi_lembur", $MenuLanguage->MenuPhrase("17", "MenuText"), $MenuRelativePath . "LemburList", -1, "", AllowListMenu('{AA20F783-9E3D-4187-A890-7D24D71E39F6}lembur'), false, false, "", "", false, true);
$sideMenu->addMenuItem(6, "mi_dinasluar", $MenuLanguage->MenuPhrase("6", "MenuText"), $MenuRelativePath . "DinasluarList", -1, "", AllowListMenu('{AA20F783-9E3D-4187-A890-7D24D71E39F6}dinasluar'), false, false, "", "", false, true);
$sideMenu->addMenuItem(22, "mi_penempatan", $MenuLanguage->MenuPhrase("22", "MenuText"), $MenuRelativePath . "PenempatanList", -1, "", AllowListMenu('{AA20F783-9E3D-4187-A890-7D24D71E39F6}penempatan'), false, false, "", "", false, true);
$sideMenu->addMenuItem(4, "mi_berita", $MenuLanguage->MenuPhrase("4", "MenuText"), $MenuRelativePath . "BeritaList", -1, "", AllowListMenu('{AA20F783-9E3D-4187-A890-7D24D71E39F6}berita'), false, false, "", "", false, true);
$sideMenu->addMenuItem(23, "mi_pengetahuan", $MenuLanguage->MenuPhrase("23", "MenuText"), $MenuRelativePath . "PengetahuanList", -1, "", AllowListMenu('{AA20F783-9E3D-4187-A890-7D24D71E39F6}pengetahuan'), false, false, "", "", false, true);
$sideMenu->addMenuItem(25, "mi_reimbursh", $MenuLanguage->MenuPhrase("25", "MenuText"), $MenuRelativePath . "ReimburshList", -1, "", AllowListMenu('{AA20F783-9E3D-4187-A890-7D24D71E39F6}reimbursh'), false, false, "", "", false, true);
$sideMenu->addMenuItem(26, "mi_uangmuka", $MenuLanguage->MenuPhrase("26", "MenuText"), $MenuRelativePath . "UangmukaList", -1, "", AllowListMenu('{AA20F783-9E3D-4187-A890-7D24D71E39F6}uangmuka'), false, false, "", "", false, true);
$sideMenu->addMenuItem(5, "mi_daftarbarang", $MenuLanguage->MenuPhrase("5", "MenuText"), $MenuRelativePath . "DaftarbarangList", -1, "", AllowListMenu('{AA20F783-9E3D-4187-A890-7D24D71E39F6}daftarbarang'), false, false, "", "", false, true);
$sideMenu->addMenuItem(29, "mci_Master", $MenuLanguage->MenuPhrase("29", "MenuText"), "", -1, "", true, false, true, "", "", false, true);
$sideMenu->addMenuItem(10, "mi_jenis_barang", $MenuLanguage->MenuPhrase("10", "MenuText"), $MenuRelativePath . "JenisBarangList", 29, "", AllowListMenu('{AA20F783-9E3D-4187-A890-7D24D71E39F6}jenis_barang'), false, false, "", "", false, true);
$sideMenu->addMenuItem(11, "mi_jenis_dinasluar", $MenuLanguage->MenuPhrase("11", "MenuText"), $MenuRelativePath . "JenisDinasluarList", 29, "", AllowListMenu('{AA20F783-9E3D-4187-A890-7D24D71E39F6}jenis_dinasluar'), false, false, "", "", false, true);
$sideMenu->addMenuItem(12, "mi_jenis_grup_berita", $MenuLanguage->MenuPhrase("12", "MenuText"), $MenuRelativePath . "JenisGrupBeritaList", 29, "", AllowListMenu('{AA20F783-9E3D-4187-A890-7D24D71E39F6}jenis_grup_berita'), false, false, "", "", false, true);
$sideMenu->addMenuItem(13, "mi_jenis_grup_ilmu", $MenuLanguage->MenuPhrase("13", "MenuText"), $MenuRelativePath . "JenisGrupIlmuList", 29, "", AllowListMenu('{AA20F783-9E3D-4187-A890-7D24D71E39F6}jenis_grup_ilmu'), false, false, "", "", false, true);
$sideMenu->addMenuItem(14, "mi_jenis_ijin", $MenuLanguage->MenuPhrase("14", "MenuText"), $MenuRelativePath . "JenisIjinList", 29, "", AllowListMenu('{AA20F783-9E3D-4187-A890-7D24D71E39F6}jenis_ijin'), false, false, "", "", false, true);
$sideMenu->addMenuItem(15, "mi_jenis_lembur", $MenuLanguage->MenuPhrase("15", "MenuText"), $MenuRelativePath . "JenisLemburList", 29, "", AllowListMenu('{AA20F783-9E3D-4187-A890-7D24D71E39F6}jenis_lembur'), false, false, "", "", false, true);
$sideMenu->addMenuItem(24, "mi_proyek", $MenuLanguage->MenuPhrase("24", "MenuText"), $MenuRelativePath . "ProyekList", 29, "", AllowListMenu('{AA20F783-9E3D-4187-A890-7D24D71E39F6}proyek'), false, false, "", "", false, true);
$sideMenu->addMenuItem(9, "mi_jabatan", $MenuLanguage->MenuPhrase("9", "MenuText"), $MenuRelativePath . "JabatanList", 29, "", AllowListMenu('{AA20F783-9E3D-4187-A890-7D24D71E39F6}jabatan'), false, false, "", "", false, true);
$sideMenu->addMenuItem(31, "mi_testtable", $MenuLanguage->MenuPhrase("31", "MenuText"), $MenuRelativePath . "TesttableList", 29, "", AllowListMenu('{AA20F783-9E3D-4187-A890-7D24D71E39F6}testtable'), false, false, "", "", false, true);
$sideMenu->addMenuItem(33, "mi_terlambat", $MenuLanguage->MenuPhrase("33", "MenuText"), $MenuRelativePath . "TerlambatList", 29, "", AllowListMenu('{AA20F783-9E3D-4187-A890-7D24D71E39F6}terlambat'), false, false, "", "", false, true);
$sideMenu->addMenuItem(35, "mi_agama", $MenuLanguage->MenuPhrase("35", "MenuText"), $MenuRelativePath . "AgamaList", 29, "", AllowListMenu('{AA20F783-9E3D-4187-A890-7D24D71E39F6}agama'), false, false, "", "", false, true);
$sideMenu->addMenuItem(36, "mi_tpendidikan", $MenuLanguage->MenuPhrase("36", "MenuText"), $MenuRelativePath . "TpendidikanList", 29, "", AllowListMenu('{AA20F783-9E3D-4187-A890-7D24D71E39F6}tpendidikan'), false, false, "", "", false, true);
$sideMenu->addMenuItem(37, "mi_m_tidakhadir", $MenuLanguage->MenuPhrase("37", "MenuText"), $MenuRelativePath . "MTidakhadirList", 29, "", AllowListMenu('{AA20F783-9E3D-4187-A890-7D24D71E39F6}m_tidakhadir'), false, false, "", "", false, true);
$sideMenu->addMenuItem(40, "mi_gender", $MenuLanguage->MenuPhrase("40", "MenuText"), $MenuRelativePath . "GenderList", 29, "", AllowListMenu('{AA20F783-9E3D-4187-A890-7D24D71E39F6}gender'), false, false, "", "", false, true);
$sideMenu->addMenuItem(41, "mi_bulan", $MenuLanguage->MenuPhrase("41", "MenuText"), $MenuRelativePath . "BulanList", 29, "", AllowListMenu('{AA20F783-9E3D-4187-A890-7D24D71E39F6}bulan'), false, false, "", "", false, true);
$sideMenu->addMenuItem(52, "mi_m_pulangcepat", $MenuLanguage->MenuPhrase("52", "MenuText"), $MenuRelativePath . "MPulangcepatList", 29, "", AllowListMenu('{AA20F783-9E3D-4187-A890-7D24D71E39F6}m_pulangcepat'), false, false, "", "", false, true);
$sideMenu->addMenuItem(53, "mi_m_sakit", $MenuLanguage->MenuPhrase("53", "MenuText"), $MenuRelativePath . "MSakitList", 29, "", AllowListMenu('{AA20F783-9E3D-4187-A890-7D24D71E39F6}m_sakit'), false, false, "", "", false, true);
$sideMenu->addMenuItem(54, "mi_gaji_pokok", $MenuLanguage->MenuPhrase("54", "MenuText"), $MenuRelativePath . "GajiPokokList", 29, "", AllowListMenu('{AA20F783-9E3D-4187-A890-7D24D71E39F6}gaji_pokok'), false, false, "", "", false, true);
$sideMenu->addMenuItem(55, "mi_ijazah", $MenuLanguage->MenuPhrase("55", "MenuText"), $MenuRelativePath . "IjazahList", 29, "", AllowListMenu('{AA20F783-9E3D-4187-A890-7D24D71E39F6}ijazah'), false, false, "", "", false, true);
$sideMenu->addMenuItem(30, "mci_Setting", $MenuLanguage->MenuPhrase("30", "MenuText"), "", -1, "", true, false, true, "", "", false, true);
$sideMenu->addMenuItem(27, "mi_userlevelpermissions", $MenuLanguage->MenuPhrase("27", "MenuText"), $MenuRelativePath . "UserlevelpermissionsList", 30, "", AllowListMenu('{AA20F783-9E3D-4187-A890-7D24D71E39F6}userlevelpermissions'), false, false, "", "", false, true);
$sideMenu->addMenuItem(28, "mi_userlevels", $MenuLanguage->MenuPhrase("28", "MenuText"), $MenuRelativePath . "UserlevelsList", 30, "", AllowListMenu('{AA20F783-9E3D-4187-A890-7D24D71E39F6}userlevels'), false, false, "", "", false, true);
$sideMenu->addMenuItem(3, "mi_audittrail", $MenuLanguage->MenuPhrase("3", "MenuText"), $MenuRelativePath . "AudittrailList", 30, "", AllowListMenu('{AA20F783-9E3D-4187-A890-7D24D71E39F6}audittrail'), false, false, "", "", false, true);
echo $sideMenu->toScript();
