<?php

namespace PHPMaker2022\sigap;

use Slim\Views\PhpRenderer;
use Slim\Csrf\Guard;
use Psr\Container\ContainerInterface;
use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;
use Doctrine\DBAL\Logging\LoggerChain;
use Doctrine\DBAL\Logging\DebugStack;

return [
    "cache" => function (ContainerInterface $c) {
        return new \Slim\HttpCache\CacheProvider();
    },
    "view" => function (ContainerInterface $c) {
        return new PhpRenderer("views/");
    },
    "flash" => function (ContainerInterface $c) {
        return new \Slim\Flash\Messages();
    },
    "audit" => function (ContainerInterface $c) {
        $logger = new Logger("audit"); // For audit trail
        $logger->pushHandler(new AuditTrailHandler("audit.log"));
        return $logger;
    },
    "log" => function (ContainerInterface $c) {
        global $RELATIVE_PATH;
        $logger = new Logger("log");
        $logger->pushHandler(new RotatingFileHandler($RELATIVE_PATH . "log.log"));
        return $logger;
    },
    "sqllogger" => function (ContainerInterface $c) {
        $loggers = [];
        if (Config("DEBUG")) {
            $loggers[] = $c->get("debugstack");
        }
        return (count($loggers) > 0) ? new LoggerChain($loggers) : null;
    },
    "csrf" => function (ContainerInterface $c) {
        global $ResponseFactory;
        return new Guard($ResponseFactory, Config("CSRF_PREFIX"));
    },
    "debugstack" => \DI\create(DebugStack::class),
    "debugsqllogger" => \DI\create(DebugSqlLogger::class),
    "security" => \DI\create(AdvancedSecurity::class),
    "profile" => \DI\create(UserProfile::class),
    "language" => \DI\create(Language::class),
    "timer" => \DI\create(Timer::class),
    "session" => \DI\create(HttpSession::class),

    // Tables
    "absen" => \DI\create(Absen::class),
    "absen_detil" => \DI\create(AbsenDetil::class),
    "audittrail" => \DI\create(Audittrail::class),
    "berita" => \DI\create(Berita::class),
    "daftarbarang" => \DI\create(Daftarbarang::class),
    "dinasluar" => \DI\create(Dinasluar::class),
    "gajitunjangan" => \DI\create(Gajitunjangan::class),
    "ijin" => \DI\create(Ijin::class),
    "jabatan" => \DI\create(Jabatan::class),
    "jenis_barang" => \DI\create(JenisBarang::class),
    "jenis_dinasluar" => \DI\create(JenisDinasluar::class),
    "jenis_grup_berita" => \DI\create(JenisGrupBerita::class),
    "jenis_grup_ilmu" => \DI\create(JenisGrupIlmu::class),
    "jenis_ijin" => \DI\create(JenisIjin::class),
    "jenis_lembur" => \DI\create(JenisLembur::class),
    "komentar" => \DI\create(Komentar::class),
    "lembur" => \DI\create(Lembur::class),
    "peg_dokumen" => \DI\create(PegDokumen::class),
    "peg_keluarga" => \DI\create(PegKeluarga::class),
    "peg_skill" => \DI\create(PegSkill::class),
    "pegawai" => \DI\create(Pegawai::class),
    "penempatan" => \DI\create(Penempatan::class),
    "pengetahuan" => \DI\create(Pengetahuan::class),
    "proyek" => \DI\create(Proyek::class),
    "reimbursh" => \DI\create(Reimbursh::class),
    "uangmuka" => \DI\create(Uangmuka::class),
    "userlevelpermissions" => \DI\create(Userlevelpermissions::class),
    "userlevels" => \DI\create(Userlevels::class),
    "testtable" => \DI\create(Testtable::class),
    "potongan" => \DI\create(Potongan::class),
    "terlambat" => \DI\create(Terlambat::class),
    "totalgaji" => \DI\create(Totalgaji::class),
    "agama" => \DI\create(Agama::class),
    "tpendidikan" => \DI\create(Tpendidikan::class),
    "m_tidakhadir" => \DI\create(MTidakhadir::class),
    "gaji" => \DI\create(Gaji::class),
    "gender" => \DI\create(Gender::class),
    "bulan" => \DI\create(Bulan::class),
    "gajisd" => \DI\create(Gajisd::class),
    "gajisd_detil" => \DI\create(GajisdDetil::class),
    "gajitk" => \DI\create(Gajitk::class),
    "gajitk_detil" => \DI\create(GajitkDetil::class),
    "gajisma" => \DI\create(Gajisma::class),
    "gajisma_detil" => \DI\create(GajismaDetil::class),
    "gajismk" => \DI\create(Gajismk::class),
    "gajismk_detil" => \DI\create(GajismkDetil::class),
    "gajismp" => \DI\create(Gajismp::class),
    "gajismp_detil" => \DI\create(GajismpDetil::class),
    "m_pulangcepat" => \DI\create(MPulangcepat::class),
    "m_sakit" => \DI\create(MSakit::class),
    "gaji_pokok" => \DI\create(GajiPokok::class),
    "ijazah" => \DI\create(Ijazah::class),
    "potongan_sd" => \DI\create(PotonganSd::class),
    "potongan_smp" => \DI\create(PotonganSmp::class),

    // User table
    "usertable" => \DI\get("pegawai"),
];
