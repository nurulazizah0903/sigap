<?php

/**
 * PHPMaker 2020 user level settings
 */
namespace PHPMaker2020\sigap;

// User level info
$USER_LEVELS = [["-2","Anonymous"],
	["0","Default"]];

// User level priv info
$USER_LEVEL_PRIVS = [["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}absen","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}absen","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}absen_detil","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}absen_detil","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}agama","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}agama","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}audittrail","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}audittrail","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}barang","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}barang","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}barangnew","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}barangnew","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}berita","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}berita","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}bulan","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}bulan","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}daftarbarang","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}daftarbarang","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}dinasluar","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}dinasluar","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_karyawan_sd","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_karyawan_sd","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_karyawan_sma","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_karyawan_sma","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_karyawan_smk","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_karyawan_smk","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_karyawan_smp","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_karyawan_smp","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_karyawan_tk","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_karyawan_tk","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_pokok","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_pokok","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_sma","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_sma","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_smk","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_smk","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_smp","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_smp","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_tk","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_tk","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_tu_sd","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_tu_sd","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_tu_sma","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_tu_sma","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_tu_smk","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_tu_smk","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_tu_smp","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_tu_smp","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_tu_tk","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_tu_tk","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajisd","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajisd","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajisd_detil","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajisd_detil","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajisma","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajisma","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajisma_detil","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajisma_detil","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajismk","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajismk","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajismk_detil","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajismk_detil","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajismp","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajismp","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajismp_detil","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajismp_detil","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajitk","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajitk","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajitk_detil","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajitk_detil","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajitunjangan","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajitunjangan","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gender","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gender","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}hapus_barang","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}hapus_barang","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}hapus_barangnew","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}hapus_barangnew","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}ijazah","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}ijazah","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}ijin","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}ijin","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jabatan","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jabatan","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_barang","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_barang","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_dinasluar","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_dinasluar","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_grup_berita","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_grup_berita","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_grup_ilmu","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_grup_ilmu","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_ijin","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_ijin","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_lembur","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_lembur","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}komentar","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}komentar","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}lembur","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}lembur","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_karyawan_sd","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_karyawan_sd","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_karyawan_sma","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_karyawan_sma","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_karyawan_smk","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_karyawan_smk","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_karyawan_smp","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_karyawan_smp","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_karyawan_tk","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_karyawan_tk","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_pulangcepat","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_pulangcepat","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_sakit","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_sakit","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_sd","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_sd","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_sma","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_sma","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_smk","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_smk","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_smp","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_smp","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_tidakhadir","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_tidakhadir","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_tk","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_tk","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_tu_sd","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_tu_sd","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_tu_sma","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_tu_sma","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_tu_smk","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_tu_smk","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_tu_smp","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_tu_smp","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_tu_tk","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_tu_tk","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}mpendidikan","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}mpendidikan","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}peg_dokumen","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}peg_dokumen","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}peg_keluarga","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}peg_keluarga","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}peg_skill","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}peg_skill","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}pegawai","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}pegawai","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}penempatan","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}penempatan","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}pengetahuan","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}pengetahuan","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}potongan_sd","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}potongan_sd","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}potongan_sma","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}potongan_sma","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}potongan_smk","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}potongan_smk","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}potongan_smp","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}potongan_smp","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}potongan_tk","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}potongan_tk","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}proyek","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}proyek","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}reimbursh","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}reimbursh","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}setuju","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}setuju","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}terlambat","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}terlambat","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}testtable","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}testtable","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}totalgaji","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}totalgaji","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}tpendidikan","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}tpendidikan","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}uangmuka","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}uangmuka","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}userlevelpermissions","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}userlevelpermissions","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}userlevels","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}userlevels","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgaji","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgaji","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajikaryawan","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajikaryawan","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajikaryawansma","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajikaryawansma","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajikaryawansmk","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajikaryawansmk","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajikaryawansmp","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajikaryawansmp","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajikaryawantk","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajikaryawantk","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajisma","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajisma","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajismk","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajismk","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajismp","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajismp","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajitk","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajitk","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajitu","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajitu","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajitusma","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajitusma","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajitusmk","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajitusmk","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajitusmp","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajitusmp","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajitutk","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajitutk","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}tunjangan_tambahan","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}tunjangan_tambahan","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_jabatan","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_jabatan","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}tunjangan_berkala","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}tunjangan_berkala","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_kehadiran","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_kehadiran","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_pokok_tu","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_pokok_tu","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}sertif","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}sertif","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}tambahan_tugas","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}tambahan_tugas","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_piket","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_piket","0","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}test_api.php","-2","0"],
	["{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}test_api.php","0","0"]];

// User level table info
$USER_LEVEL_TABLES = [["absen","absen","Absen",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["absen_detil","absen_detil","Absen Detil",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["agama","agama","Agama",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["audittrail","audittrail","Audittrail",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["barang","barang","barang",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["barangnew","barangnew","barangnew",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["berita","berita","Berita",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["bulan","bulan","bulan",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["daftarbarang","daftarbarang","Daftar Barang",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["dinasluar","dinasluar","Dinas Luar",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["gaji","gaji","Gaji Guru SD",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["gaji_karyawan_sd","gaji_karyawan_sd","Gaji Karyawan SD",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["gaji_karyawan_sma","gaji_karyawan_sma","Gaji Karyawan SMA",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["gaji_karyawan_smk","gaji_karyawan_smk","Gaji Karyawan SMK",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["gaji_karyawan_smp","gaji_karyawan_smp","Gaji Karyawan SMP",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["gaji_karyawan_tk","gaji_karyawan_tk","Gaji Karyawan TK",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["gaji_pokok","gaji_pokok","Gaji Pokok",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["gaji_sma","gaji_sma","Gaji Guru SMA",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["gaji_smk","gaji_smk","Gaji Guru SMK",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["gaji_smp","gaji_smp","Gaji Guru SMP",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["gaji_tk","gaji_tk","Gaji Guru TK",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["gaji_tu_sd","gaji_tu_sd","gaji TU SD",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["gaji_tu_sma","gaji_tu_sma","Gaji TU SMA",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["gaji_tu_smk","gaji_tu_smk","Gaji TU SMK",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["gaji_tu_smp","gaji_tu_smp","Gaji TU SMP",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["gaji_tu_tk","gaji_tu_tk","Gaji TU TK",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["gajisd","gajisd","Gaji SD",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["gajisd_detil","gajisd_detil","Gaji SD Detil",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["gajisma","gajisma","Gaji SMA",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["gajisma_detil","gajisma_detil","Gaji SMA Detil",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["gajismk","gajismk","Gaji SMK",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["gajismk_detil","gajismk_detil","Gaji SMK Detil",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["gajismp","gajismp","Gaji SMP",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["gajismp_detil","gajismp_detil","Gaji SMP Detil",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["gajitk","gajitk","Gaji TK",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["gajitk_detil","gajitk_detil","Gajitk Detil",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["gajitunjangan","gajitunjangan","Gaji Tunjangan",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["gender","gender","Gender",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["hapus_barang","hapus_barang","hapus barang",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["hapus_barangnew","hapus_barangnew","hapus barangnew",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["ijazah","ijazah","Ijazah",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["ijin","ijin","Izin",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["jabatan","jabatan","Jabatan",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["jenis_barang","jenis_barang","Jenis Barang",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["jenis_dinasluar","jenis_dinasluar","jenis dinasluar",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["jenis_grup_berita","jenis_grup_berita","jenis grup berita",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["jenis_grup_ilmu","jenis_grup_ilmu","jenis grup ilmu",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["jenis_ijin","jenis_ijin","jenis ijin",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["jenis_lembur","jenis_lembur","jenis lembur",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["komentar","komentar","Komentar",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["lembur","lembur","Lembur",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["m_karyawan_sd","m_karyawan_sd","Detil Gaji Karyawan SD",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["m_karyawan_sma","m_karyawan_sma","Detil Gaji Karyawan SMA",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["m_karyawan_smk","m_karyawan_smk","Detil Gaji Karyawan SMK",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["m_karyawan_smp","m_karyawan_smp","Detil Gaji Karyawan SMP",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["m_karyawan_tk","m_karyawan_tk","Detil Gaji karyawan TK",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["m_pulangcepat","m_pulangcepat","M Pulang Cepat",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["m_sakit","m_sakit","M Sakit",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["m_sd","m_sd","Detil Gaji Guru SD",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["m_sma","m_sma","Detil Gaji Guru SMA",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["m_smk","m_smk","Detil Gaji Guru SMK",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["m_smp","m_smp","Detil Gaji Guru SMP",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["m_tidakhadir","m_tidakhadir","M Tidak Hadir",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["m_tk","m_tk","Detil Gaji Guru tk",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["m_tu_sd","m_tu_sd","Detil Gaji TU SD",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["m_tu_sma","m_tu_sma","Detil Gaji TU SMA",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["m_tu_smk","m_tu_smk","Detil Gaji TU SMK",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["m_tu_smp","m_tu_smp","Detil Gaji TU SMP",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["m_tu_tk","m_tu_tk","Detil Gaji TU TK",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["mpendidikan","mpendidikan","Master Pendidikan",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["peg_dokumen","peg_dokumen","Pegawai Dokumen",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["peg_keluarga","peg_keluarga","Pegawai Keluarga",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["peg_skill","peg_skill","Pegawai Skill",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["pegawai","pegawai","Pegawai",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["penempatan","penempatan","Penempatan",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["pengetahuan","pengetahuan","Pengetahuan",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["potongan_sd","potongan_sd","Potongan SD",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["potongan_sma","potongan_sma","Potongan SMA",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["potongan_smk","potongan_smk","Potongan SMK",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["potongan_smp","potongan_smp","Potongan SMP",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["potongan_tk","potongan_tk","Potongan TK",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["proyek","proyek","Proyek",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["reimbursh","reimbursh","Reimbursh",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["setuju","setuju","M Setuju",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["terlambat","terlambat","Terlambat",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["testtable","testtable","testtable",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["totalgaji","totalgaji","totalgaji",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["tpendidikan","tpendidikan","Pendidikan",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["uangmuka","uangmuka","Uang Muka",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["userlevelpermissions","userlevelpermissions","userlevelpermissions",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["userlevels","userlevels","userlevels",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["v_totalgaji","v_totalgaji","Total Gaji Guru SD",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["v_totalgajikaryawan","v_totalgajikaryawan","Total Gaji Karyawan SD",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["v_totalgajikaryawansma","v_totalgajikaryawansma","Total Gaji Karyawan SMA",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["v_totalgajikaryawansmk","v_totalgajikaryawansmk","Total Gaji Karyawan SMK",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["v_totalgajikaryawansmp","v_totalgajikaryawansmp","Total Gaji Karyawan SMP",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["v_totalgajikaryawantk","v_totalgajikaryawantk","Total Gaji Karyawan TK",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["v_totalgajisma","v_totalgajisma","Total Gaji GuruSMA",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["v_totalgajismk","v_totalgajismk","Total Gaji Guru SMK",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["v_totalgajismp","v_totalgajismp","Total Gaji SMP",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["v_totalgajitk","v_totalgajitk","Total Gaji Guru TK",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["v_totalgajitu","v_totalgajitu","Total Gaji TU SD",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["v_totalgajitusma","v_totalgajitusma","Total Gaji TU SMA",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["v_totalgajitusmk","v_totalgajitusmk","Total Gaji TU SMK",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["v_totalgajitusmp","v_totalgajitusmp","Total Gaji TU SMP",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["v_totalgajitutk","v_totalgajitutk","Total Gaji TU TK",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["tunjangan_tambahan","tunjangan_tambahan","Tunjangan Tugas Tambahan",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["jenis_jabatan","jenis_jabatan","Jenis Jabatan",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["tunjangan_berkala","tunjangan_berkala","Tunjangan Berkala",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["m_kehadiran","m_kehadiran","Setting Kehadiran",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["gaji_pokok_tu","gaji_pokok_tu","Gaji Pokok TU",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["sertif","sertif","Sertifikasi",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["tambahan_tugas","tambahan_tugas","M Tambahan Tugas",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["m_piket","m_piket","Setting Piket",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"],
	["test_api.php","test_api","Test Api",true,"{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}"]];