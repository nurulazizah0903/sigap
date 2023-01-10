-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.3.0.6589
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for sigap2
CREATE DATABASE IF NOT EXISTS `sigap2` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `sigap2`;

-- Dumping structure for table sigap2.absen
CREATE TABLE IF NOT EXISTS `absen` (
  `id` int NOT NULL AUTO_INCREMENT,
  `bulan` int DEFAULT NULL,
  `tahun` int DEFAULT NULL,
  `jumlah_hari_kerja` smallint DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `createuser` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.absen: ~0 rows (approximately)

-- Dumping structure for table sigap2.absen_detil
CREATE TABLE IF NOT EXISTS `absen_detil` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pid` int DEFAULT NULL,
  `pegawai` int DEFAULT NULL,
  `masuk` smallint DEFAULT NULL,
  `absen` smallint DEFAULT NULL,
  `ijin` smallint DEFAULT NULL,
  `cuti` smallint DEFAULT NULL,
  `dinas_luar` smallint DEFAULT NULL,
  `terlambat` smallint DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.absen_detil: ~0 rows (approximately)

-- Dumping structure for table sigap2.agama
CREATE TABLE IF NOT EXISTS `agama` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table sigap2.agama: ~6 rows (approximately)
INSERT INTO `agama` (`id`, `name`) VALUES
	(1, 'ISLAM'),
	(2, 'Kristen'),
	(3, 'Katolik'),
	(4, 'Hindu'),
	(5, 'Buddha'),
	(6, 'konghucu');

-- Dumping structure for table sigap2.audittrail
CREATE TABLE IF NOT EXISTS `audittrail` (
  `id` int NOT NULL AUTO_INCREMENT,
  `datetime` datetime NOT NULL,
  `script` varchar(80) DEFAULT NULL,
  `user` varchar(80) DEFAULT NULL,
  `action` varchar(80) DEFAULT NULL,
  `table` varchar(80) DEFAULT NULL,
  `field` varchar(80) DEFAULT NULL,
  `keyvalue` longtext,
  `oldvalue` longtext,
  `newvalue` longtext,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2120 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.audittrail: ~1,119 rows (approximately)
INSERT INTO `audittrail` (`id`, `datetime`, `script`, `user`, `action`, `table`, `field`, `keyvalue`, `oldvalue`, `newvalue`) VALUES
	(1001, '2022-12-14 06:57:53', '/sigap/GajiDelete/32', 'Administrator', '*** Batch delete successful ***', 'gaji', '', '', '', ''),
	(1002, '2022-12-14 06:58:18', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'pid', '33', '', NULL),
	(1003, '2022-12-14 06:58:18', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'jabatan_id', '33', '', '1'),
	(1004, '2022-12-14 06:58:18', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'pegawai', '33', '', '110124'),
	(1005, '2022-12-14 06:58:18', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'lembur', '33', '', '4'),
	(1006, '2022-12-14 06:58:18', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'kehadiran', '33', '', '12'),
	(1007, '2022-12-14 06:58:18', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'piket_count', '33', '', '4'),
	(1008, '2022-12-14 06:58:18', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'month', '33', '', NULL),
	(1009, '2022-12-14 06:58:18', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'datetime', '33', '', '2022-12-14 06:58:18'),
	(1010, '2022-12-14 06:58:18', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'b1', '33', '', '1'),
	(1011, '2022-12-14 06:58:19', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_lembur', '33', '', '40000'),
	(1012, '2022-12-14 06:58:19', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'gapok', '33', '', '80000'),
	(1013, '2022-12-14 06:58:19', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_inval', '33', '', '10000'),
	(1014, '2022-12-14 06:58:19', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_reward', '33', '', '40000'),
	(1015, '2022-12-14 06:58:19', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_piket', '33', '', '30000'),
	(1016, '2022-12-14 06:58:19', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'tj_jabatan', '33', '', '12000'),
	(1017, '2022-12-14 06:58:19', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'tugastambahan', '33', '', '70000'),
	(1018, '2022-12-14 06:58:19', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'sub_total', '33', '', '1252000'),
	(1019, '2022-12-14 06:58:19', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'potongan', '33', '', NULL),
	(1020, '2022-12-14 06:58:19', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'total', '33', '', '1252000'),
	(1021, '2022-12-14 06:58:19', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'id', '33', '', '33'),
	(1022, '2022-12-14 07:00:02', '/sigap/GajiDelete/33', 'Administrator', '*** Batch delete begin ***', 'gaji', '', '', '', ''),
	(1023, '2022-12-14 07:00:02', '/sigap/GajiDelete/33', 'Administrator', 'D', 'gaji', 'id', '33', '33', ''),
	(1024, '2022-12-14 07:00:02', '/sigap/GajiDelete/33', 'Administrator', 'D', 'gaji', 'pegawai', '33', '110124', ''),
	(1025, '2022-12-14 07:00:02', '/sigap/GajiDelete/33', 'Administrator', 'D', 'gaji', 'datetime', '33', '2022-12-14 06:58:18', ''),
	(1026, '2022-12-14 07:00:02', '/sigap/GajiDelete/33', 'Administrator', 'D', 'gaji', 'month', '33', NULL, ''),
	(1027, '2022-12-14 07:00:02', '/sigap/GajiDelete/33', 'Administrator', 'D', 'gaji', 'lembur', '33', '4', ''),
	(1028, '2022-12-14 07:00:02', '/sigap/GajiDelete/33', 'Administrator', 'D', 'gaji', 'value_lembur', '33', '40000', ''),
	(1029, '2022-12-14 07:00:02', '/sigap/GajiDelete/33', 'Administrator', 'D', 'gaji', 'jabatan_id', '33', '1', ''),
	(1030, '2022-12-14 07:00:02', '/sigap/GajiDelete/33', 'Administrator', 'D', 'gaji', 'gapok', '33', '80000', ''),
	(1031, '2022-12-14 07:00:02', '/sigap/GajiDelete/33', 'Administrator', 'D', 'gaji', 'total', '33', '1252000', ''),
	(1032, '2022-12-14 07:00:02', '/sigap/GajiDelete/33', 'Administrator', 'D', 'gaji', 'value_reward', '33', '40000', ''),
	(1033, '2022-12-14 07:00:02', '/sigap/GajiDelete/33', 'Administrator', 'D', 'gaji', 'value_inval', '33', '10000', ''),
	(1034, '2022-12-14 07:00:02', '/sigap/GajiDelete/33', 'Administrator', 'D', 'gaji', 'piket_count', '33', '4', ''),
	(1035, '2022-12-14 07:00:02', '/sigap/GajiDelete/33', 'Administrator', 'D', 'gaji', 'value_piket', '33', '30000', ''),
	(1036, '2022-12-14 07:00:02', '/sigap/GajiDelete/33', 'Administrator', 'D', 'gaji', 'tugastambahan', '33', '70000', ''),
	(1037, '2022-12-14 07:00:02', '/sigap/GajiDelete/33', 'Administrator', 'D', 'gaji', 'tj_jabatan', '33', '12000', ''),
	(1038, '2022-12-14 07:00:02', '/sigap/GajiDelete/33', 'Administrator', 'D', 'gaji', 'kehadiran', '33', '12', ''),
	(1039, '2022-12-14 07:00:02', '/sigap/GajiDelete/33', 'Administrator', 'D', 'gaji', 'sub_total', '33', '1252000', ''),
	(1040, '2022-12-14 07:00:02', '/sigap/GajiDelete/33', 'Administrator', 'D', 'gaji', 'potongan', '33', NULL, ''),
	(1041, '2022-12-14 07:00:02', '/sigap/GajiDelete/33', 'Administrator', 'D', 'gaji', 'pid', '33', NULL, ''),
	(1042, '2022-12-14 07:00:02', '/sigap/GajiDelete/33', 'Administrator', 'D', 'gaji', 'b1', '33', '1', ''),
	(1043, '2022-12-14 07:00:02', '/sigap/GajiDelete/33', 'Administrator', '*** Batch delete successful ***', 'gaji', '', '', '', ''),
	(1044, '2022-12-14 07:00:23', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'pid', '34', '', NULL),
	(1045, '2022-12-14 07:00:23', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'jabatan_id', '34', '', '1'),
	(1046, '2022-12-14 07:00:23', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'pegawai', '34', '', '110124'),
	(1047, '2022-12-14 07:00:23', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'lembur', '34', '', '4'),
	(1048, '2022-12-14 07:00:23', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'kehadiran', '34', '', '12'),
	(1049, '2022-12-14 07:00:23', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'piket_count', '34', '', '4'),
	(1050, '2022-12-14 07:00:23', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'month', '34', '', NULL),
	(1051, '2022-12-14 07:00:23', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'datetime', '34', '', '2022-12-14 07:00:23'),
	(1052, '2022-12-14 07:00:23', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'b1', '34', '', NULL),
	(1053, '2022-12-14 07:00:23', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_lembur', '34', '', '40000'),
	(1054, '2022-12-14 07:00:23', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'gapok', '34', '', '80000'),
	(1055, '2022-12-14 07:00:23', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_inval', '34', '', '10000'),
	(1056, '2022-12-14 07:00:23', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_reward', '34', '', '40000'),
	(1057, '2022-12-14 07:00:23', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_piket', '34', '', '30000'),
	(1058, '2022-12-14 07:00:23', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'tj_jabatan', '34', '', '12000'),
	(1059, '2022-12-14 07:00:23', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'tugastambahan', '34', '', '70000'),
	(1060, '2022-12-14 07:00:23', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'sub_total', '34', '', '1252000'),
	(1061, '2022-12-14 07:00:23', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'potongan', '34', '', NULL),
	(1062, '2022-12-14 07:00:23', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'total', '34', '', '1252000'),
	(1063, '2022-12-14 07:00:23', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'id', '34', '', '34'),
	(1064, '2022-12-14 07:01:54', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'pid', '35', '', NULL),
	(1065, '2022-12-14 07:01:54', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'jabatan_id', '35', '', '1'),
	(1066, '2022-12-14 07:01:54', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'pegawai', '35', '', '110124'),
	(1067, '2022-12-14 07:01:54', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'lembur', '35', '', '1'),
	(1068, '2022-12-14 07:01:54', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'kehadiran', '35', '', '12'),
	(1069, '2022-12-14 07:01:54', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'piket_count', '35', '', NULL),
	(1070, '2022-12-14 07:01:54', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'month', '35', '', NULL),
	(1071, '2022-12-14 07:01:54', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'datetime', '35', '', '2022-12-14 07:01:54'),
	(1072, '2022-12-14 07:01:54', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'b1', '35', '', NULL),
	(1073, '2022-12-14 07:01:54', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_lembur', '35', '', '40000'),
	(1074, '2022-12-14 07:01:54', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'gapok', '35', '', '80000'),
	(1075, '2022-12-14 07:01:54', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_inval', '35', '', '10000'),
	(1076, '2022-12-14 07:01:54', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_reward', '35', '', '40000'),
	(1077, '2022-12-14 07:01:54', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_piket', '35', '', '30000'),
	(1078, '2022-12-14 07:01:54', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'tj_jabatan', '35', '', '12000'),
	(1079, '2022-12-14 07:01:54', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'tugastambahan', '35', '', '70000'),
	(1080, '2022-12-14 07:01:54', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'sub_total', '35', '', '1132000'),
	(1081, '2022-12-14 07:01:54', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'potongan', '35', '', '230000'),
	(1082, '2022-12-14 07:01:54', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'total', '35', '', '902000'),
	(1083, '2022-12-14 07:01:54', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'id', '35', '', '35'),
	(1084, '2022-12-14 07:02:34', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'pid', '36', '', NULL),
	(1085, '2022-12-14 07:02:34', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'jabatan_id', '36', '', '1'),
	(1086, '2022-12-14 07:02:34', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'pegawai', '36', '', '110124'),
	(1087, '2022-12-14 07:02:34', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'lembur', '36', '', '4'),
	(1088, '2022-12-14 07:02:34', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'kehadiran', '36', '', '12'),
	(1089, '2022-12-14 07:02:34', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'piket_count', '36', '', NULL),
	(1090, '2022-12-14 07:02:34', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'month', '36', '', NULL),
	(1091, '2022-12-14 07:02:34', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'datetime', '36', '', '2022-12-14 07:02:34'),
	(1092, '2022-12-14 07:02:34', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'b1', '36', '', NULL),
	(1093, '2022-12-14 07:02:34', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_lembur', '36', '', '40000'),
	(1094, '2022-12-14 07:02:34', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'gapok', '36', '', '80000'),
	(1095, '2022-12-14 07:02:34', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_inval', '36', '', '10000'),
	(1096, '2022-12-14 07:02:34', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_reward', '36', '', '40000'),
	(1097, '2022-12-14 07:02:34', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_piket', '36', '', '30000'),
	(1098, '2022-12-14 07:02:34', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'tj_jabatan', '36', '', '12000'),
	(1099, '2022-12-14 07:02:34', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'tugastambahan', '36', '', '70000'),
	(1100, '2022-12-14 07:02:34', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'sub_total', '36', '', '1252000'),
	(1101, '2022-12-14 07:02:34', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'potongan', '36', '', NULL),
	(1102, '2022-12-14 07:02:34', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'total', '36', '', '1252000'),
	(1103, '2022-12-14 07:02:34', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'id', '36', '', '36'),
	(1104, '2022-12-14 07:02:54', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'pid', '37', '', NULL),
	(1105, '2022-12-14 07:02:54', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'jabatan_id', '37', '', '2'),
	(1106, '2022-12-14 07:02:54', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'pegawai', '37', '', '110124'),
	(1107, '2022-12-14 07:02:54', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'lembur', '37', '', '1'),
	(1108, '2022-12-14 07:02:54', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'kehadiran', '37', '', '12'),
	(1109, '2022-12-14 07:02:54', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'piket_count', '37', '', NULL),
	(1110, '2022-12-14 07:02:54', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'month', '37', '', NULL),
	(1111, '2022-12-14 07:02:54', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'datetime', '37', '', '2022-12-14 07:02:54'),
	(1112, '2022-12-14 07:02:54', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'b1', '37', '', '1'),
	(1113, '2022-12-14 07:02:54', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_lembur', '37', '', '42000'),
	(1114, '2022-12-14 07:02:54', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'gapok', '37', '', '40000'),
	(1115, '2022-12-14 07:02:54', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_inval', '37', '', '10000'),
	(1116, '2022-12-14 07:02:54', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_reward', '37', '', '30000'),
	(1117, '2022-12-14 07:02:54', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_piket', '37', '', '30000'),
	(1118, '2022-12-14 07:02:54', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'tj_jabatan', '37', '', '21000'),
	(1119, '2022-12-14 07:02:54', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'tugastambahan', '37', '', '70000'),
	(1120, '2022-12-14 07:02:54', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'sub_total', '37', '', '653000'),
	(1121, '2022-12-14 07:02:54', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'potongan', '37', '', NULL),
	(1122, '2022-12-14 07:02:54', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'total', '37', '', '653000'),
	(1123, '2022-12-14 07:02:54', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'id', '37', '', '37'),
	(1124, '2022-12-14 07:04:29', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'nama', '39', '', '110123'),
	(1125, '2022-12-14 07:04:29', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'terlambat', '39', '', '2'),
	(1126, '2022-12-14 07:04:29', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'izin', '39', '', '2'),
	(1127, '2022-12-14 07:04:29', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'sakit', '39', '', '2'),
	(1128, '2022-12-14 07:04:29', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'tidakhadir', '39', '', '3'),
	(1129, '2022-12-14 07:04:29', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'month', '39', '', NULL),
	(1130, '2022-12-14 07:04:29', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'datetime', '39', '', '2022-12-14 07:04:29'),
	(1131, '2022-12-14 07:04:29', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'u_by', '39', '', '-1'),
	(1132, '2022-12-14 07:04:29', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'b', '39', '', NULL),
	(1133, '2022-12-14 07:04:29', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_izin', '39', '', '40000'),
	(1134, '2022-12-14 07:04:29', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_terlambat', '39', '', '15000'),
	(1135, '2022-12-14 07:04:29', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_sakit', '39', '', '20000'),
	(1136, '2022-12-14 07:04:29', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_tidakhadir', '39', '', '40000'),
	(1137, '2022-12-14 07:04:29', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'total', '39', '', '270000'),
	(1138, '2022-12-14 07:04:29', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'id', '39', '', '39'),
	(1139, '2022-12-14 07:05:16', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'pid', '38', '', NULL),
	(1140, '2022-12-14 07:05:16', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'jabatan_id', '38', '', '1'),
	(1141, '2022-12-14 07:05:16', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'pegawai', '38', '', '110124'),
	(1142, '2022-12-14 07:05:16', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'lembur', '38', '', '1'),
	(1143, '2022-12-14 07:05:16', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'kehadiran', '38', '', '12'),
	(1144, '2022-12-14 07:05:16', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'piket_count', '38', '', '4'),
	(1145, '2022-12-14 07:05:16', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'month', '38', '', NULL),
	(1146, '2022-12-14 07:05:16', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'datetime', '38', '', '2022-12-14 07:05:16'),
	(1147, '2022-12-14 07:05:16', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'b1', '38', '', NULL),
	(1148, '2022-12-14 07:05:16', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_lembur', '38', '', '40000'),
	(1149, '2022-12-14 07:05:16', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'gapok', '38', '', '80000'),
	(1150, '2022-12-14 07:05:16', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_inval', '38', '', '10000'),
	(1151, '2022-12-14 07:05:16', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_reward', '38', '', '40000'),
	(1152, '2022-12-14 07:05:16', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_piket', '38', '', '30000'),
	(1153, '2022-12-14 07:05:16', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'tj_jabatan', '38', '', '12000'),
	(1154, '2022-12-14 07:05:16', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'tugastambahan', '38', '', '70000'),
	(1155, '2022-12-14 07:05:16', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'sub_total', '38', '', '1132000'),
	(1156, '2022-12-14 07:05:16', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'potongan', '38', '', NULL),
	(1157, '2022-12-14 07:05:16', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'total', '38', '', '1132000'),
	(1158, '2022-12-14 07:05:16', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'id', '38', '', '38'),
	(1159, '2022-12-14 07:06:26', '/sigap/GajiDelete/38', 'Administrator', '*** Batch delete begin ***', 'gaji', '', '', '', ''),
	(1160, '2022-12-14 07:06:26', '/sigap/GajiDelete/38', 'Administrator', 'D', 'gaji', 'id', '38', '38', ''),
	(1161, '2022-12-14 07:06:26', '/sigap/GajiDelete/38', 'Administrator', 'D', 'gaji', 'pegawai', '38', '110124', ''),
	(1162, '2022-12-14 07:06:26', '/sigap/GajiDelete/38', 'Administrator', 'D', 'gaji', 'datetime', '38', '2022-12-14 07:05:16', ''),
	(1163, '2022-12-14 07:06:26', '/sigap/GajiDelete/38', 'Administrator', 'D', 'gaji', 'month', '38', NULL, ''),
	(1164, '2022-12-14 07:06:26', '/sigap/GajiDelete/38', 'Administrator', 'D', 'gaji', 'lembur', '38', '1', ''),
	(1165, '2022-12-14 07:06:26', '/sigap/GajiDelete/38', 'Administrator', 'D', 'gaji', 'value_lembur', '38', '40000', ''),
	(1166, '2022-12-14 07:06:26', '/sigap/GajiDelete/38', 'Administrator', 'D', 'gaji', 'jabatan_id', '38', '1', ''),
	(1167, '2022-12-14 07:06:26', '/sigap/GajiDelete/38', 'Administrator', 'D', 'gaji', 'gapok', '38', '80000', ''),
	(1168, '2022-12-14 07:06:26', '/sigap/GajiDelete/38', 'Administrator', 'D', 'gaji', 'total', '38', '1132000', ''),
	(1169, '2022-12-14 07:06:26', '/sigap/GajiDelete/38', 'Administrator', 'D', 'gaji', 'value_reward', '38', '40000', ''),
	(1170, '2022-12-14 07:06:26', '/sigap/GajiDelete/38', 'Administrator', 'D', 'gaji', 'value_inval', '38', '10000', ''),
	(1171, '2022-12-14 07:06:26', '/sigap/GajiDelete/38', 'Administrator', 'D', 'gaji', 'piket_count', '38', '4', ''),
	(1172, '2022-12-14 07:06:26', '/sigap/GajiDelete/38', 'Administrator', 'D', 'gaji', 'value_piket', '38', '30000', ''),
	(1173, '2022-12-14 07:06:26', '/sigap/GajiDelete/38', 'Administrator', 'D', 'gaji', 'tugastambahan', '38', '70000', ''),
	(1174, '2022-12-14 07:06:26', '/sigap/GajiDelete/38', 'Administrator', 'D', 'gaji', 'tj_jabatan', '38', '12000', ''),
	(1175, '2022-12-14 07:06:26', '/sigap/GajiDelete/38', 'Administrator', 'D', 'gaji', 'kehadiran', '38', '12', ''),
	(1176, '2022-12-14 07:06:26', '/sigap/GajiDelete/38', 'Administrator', 'D', 'gaji', 'sub_total', '38', '1132000', ''),
	(1177, '2022-12-14 07:06:26', '/sigap/GajiDelete/38', 'Administrator', 'D', 'gaji', 'potongan', '38', NULL, ''),
	(1178, '2022-12-14 07:06:26', '/sigap/GajiDelete/38', 'Administrator', 'D', 'gaji', 'pid', '38', NULL, ''),
	(1179, '2022-12-14 07:06:26', '/sigap/GajiDelete/38', 'Administrator', 'D', 'gaji', 'b1', '38', NULL, ''),
	(1180, '2022-12-14 07:06:26', '/sigap/GajiDelete/38', 'Administrator', '*** Batch delete successful ***', 'gaji', '', '', '', ''),
	(1181, '2022-12-14 07:06:45', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'pid', '39', '', NULL),
	(1182, '2022-12-14 07:06:45', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'jabatan_id', '39', '', '1'),
	(1183, '2022-12-14 07:06:45', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'pegawai', '39', '', '110124'),
	(1184, '2022-12-14 07:06:45', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'lembur', '39', '', '4'),
	(1185, '2022-12-14 07:06:45', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'kehadiran', '39', '', '12'),
	(1186, '2022-12-14 07:06:45', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'piket_count', '39', '', '4'),
	(1187, '2022-12-14 07:06:45', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'month', '39', '', NULL),
	(1188, '2022-12-14 07:06:45', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'datetime', '39', '', '2022-12-14 07:06:45'),
	(1189, '2022-12-14 07:06:45', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'b1', '39', '', NULL),
	(1190, '2022-12-14 07:06:45', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_lembur', '39', '', '40000'),
	(1191, '2022-12-14 07:06:45', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'gapok', '39', '', '80000'),
	(1192, '2022-12-14 07:06:45', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_inval', '39', '', '10000'),
	(1193, '2022-12-14 07:06:45', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_reward', '39', '', '40000'),
	(1194, '2022-12-14 07:06:45', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_piket', '39', '', '30000'),
	(1195, '2022-12-14 07:06:45', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'tj_jabatan', '39', '', '12000'),
	(1196, '2022-12-14 07:06:45', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'tugastambahan', '39', '', '70000'),
	(1197, '2022-12-14 07:06:45', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'sub_total', '39', '', '1252000'),
	(1198, '2022-12-14 07:06:45', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'potongan', '39', '', NULL),
	(1199, '2022-12-14 07:06:45', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'total', '39', '', '1252000'),
	(1200, '2022-12-14 07:06:45', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'id', '39', '', '39'),
	(1201, '2022-12-14 07:20:57', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'jabatan_id', '40', '', '1'),
	(1202, '2022-12-14 07:20:57', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'pegawai', '40', '', '110123'),
	(1203, '2022-12-14 07:20:57', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'lembur', '40', '', '1'),
	(1204, '2022-12-14 07:20:57', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'kehadiran', '40', '', '12'),
	(1205, '2022-12-14 07:20:57', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'piket_count', '40', '', '12'),
	(1206, '2022-12-14 07:20:57', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'month', '40', '', NULL),
	(1207, '2022-12-14 07:20:57', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'datetime', '40', '', '2022-12-14 07:20:57'),
	(1208, '2022-12-14 07:20:57', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_lembur', '40', '', '40000'),
	(1209, '2022-12-14 07:20:57', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'gapok', '40', '', '80000'),
	(1210, '2022-12-14 07:20:57', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_inval', '40', '', '10000'),
	(1211, '2022-12-14 07:20:57', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_reward', '40', '', '40000'),
	(1212, '2022-12-14 07:20:57', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_piket', '40', '', '30000'),
	(1213, '2022-12-14 07:20:57', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'tj_jabatan', '40', '', '12000'),
	(1214, '2022-12-14 07:20:57', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'tugastambahan', '40', '', '70000'),
	(1215, '2022-12-14 07:20:57', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'sub_total', '40', '', '1132000'),
	(1216, '2022-12-14 07:20:57', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'potongan', '40', '', NULL),
	(1217, '2022-12-14 07:20:57', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'total', '40', '', '1132000'),
	(1218, '2022-12-14 07:20:57', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'id', '40', '', '40'),
	(1219, '2022-12-14 07:21:50', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'jabatan_id', '41', '', '1'),
	(1220, '2022-12-14 07:21:50', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'pegawai', '41', '', '110123'),
	(1221, '2022-12-14 07:21:50', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'lembur', '41', '', '4'),
	(1222, '2022-12-14 07:21:50', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'kehadiran', '41', '', '12'),
	(1223, '2022-12-14 07:21:50', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'piket_count', '41', '', NULL),
	(1224, '2022-12-14 07:21:50', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'month', '41', '', NULL),
	(1225, '2022-12-14 07:21:50', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'datetime', '41', '', '2022-12-14 07:21:50'),
	(1226, '2022-12-14 07:21:50', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_lembur', '41', '', '40000'),
	(1227, '2022-12-14 07:21:50', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'gapok', '41', '', '80000'),
	(1228, '2022-12-14 07:21:50', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_inval', '41', '', '10000'),
	(1229, '2022-12-14 07:21:50', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_reward', '41', '', '40000'),
	(1230, '2022-12-14 07:21:50', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_piket', '41', '', '30000'),
	(1231, '2022-12-14 07:21:50', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'tj_jabatan', '41', '', '12000'),
	(1232, '2022-12-14 07:21:50', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'tugastambahan', '41', '', '70000'),
	(1233, '2022-12-14 07:21:50', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'sub_total', '41', '', '1252000'),
	(1234, '2022-12-14 07:21:50', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'potongan', '41', '', '270000'),
	(1235, '2022-12-14 07:21:50', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'total', '41', '', '982000'),
	(1236, '2022-12-14 07:21:50', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'id', '41', '', '41'),
	(1237, '2022-12-14 07:26:56', '/sigap/GajiDelete/39', 'Administrator', '*** Batch delete begin ***', 'gaji', '', '', '', ''),
	(1238, '2022-12-14 07:26:56', '/sigap/GajiDelete/39', 'Administrator', 'D', 'gaji', 'id', '39', '39', ''),
	(1239, '2022-12-14 07:26:56', '/sigap/GajiDelete/39', 'Administrator', 'D', 'gaji', 'pegawai', '39', '110124', ''),
	(1240, '2022-12-14 07:26:56', '/sigap/GajiDelete/39', 'Administrator', 'D', 'gaji', 'datetime', '39', '2022-12-14 07:06:45', ''),
	(1241, '2022-12-14 07:26:56', '/sigap/GajiDelete/39', 'Administrator', 'D', 'gaji', 'month', '39', NULL, ''),
	(1242, '2022-12-14 07:26:56', '/sigap/GajiDelete/39', 'Administrator', 'D', 'gaji', 'lembur', '39', '4', ''),
	(1243, '2022-12-14 07:26:56', '/sigap/GajiDelete/39', 'Administrator', 'D', 'gaji', 'value_lembur', '39', '40000', ''),
	(1244, '2022-12-14 07:26:56', '/sigap/GajiDelete/39', 'Administrator', 'D', 'gaji', 'jabatan_id', '39', '1', ''),
	(1245, '2022-12-14 07:26:56', '/sigap/GajiDelete/39', 'Administrator', 'D', 'gaji', 'gapok', '39', '80000', ''),
	(1246, '2022-12-14 07:26:56', '/sigap/GajiDelete/39', 'Administrator', 'D', 'gaji', 'total', '39', '1252000', ''),
	(1247, '2022-12-14 07:26:56', '/sigap/GajiDelete/39', 'Administrator', 'D', 'gaji', 'value_reward', '39', '40000', ''),
	(1248, '2022-12-14 07:26:56', '/sigap/GajiDelete/39', 'Administrator', 'D', 'gaji', 'value_inval', '39', '10000', ''),
	(1249, '2022-12-14 07:26:56', '/sigap/GajiDelete/39', 'Administrator', 'D', 'gaji', 'piket_count', '39', '4', ''),
	(1250, '2022-12-14 07:26:56', '/sigap/GajiDelete/39', 'Administrator', 'D', 'gaji', 'value_piket', '39', '30000', ''),
	(1251, '2022-12-14 07:26:56', '/sigap/GajiDelete/39', 'Administrator', 'D', 'gaji', 'tugastambahan', '39', '70000', ''),
	(1252, '2022-12-14 07:26:56', '/sigap/GajiDelete/39', 'Administrator', 'D', 'gaji', 'tj_jabatan', '39', '12000', ''),
	(1253, '2022-12-14 07:26:56', '/sigap/GajiDelete/39', 'Administrator', 'D', 'gaji', 'kehadiran', '39', '12', ''),
	(1254, '2022-12-14 07:26:56', '/sigap/GajiDelete/39', 'Administrator', 'D', 'gaji', 'sub_total', '39', '1252000', ''),
	(1255, '2022-12-14 07:26:56', '/sigap/GajiDelete/39', 'Administrator', 'D', 'gaji', 'potongan', '39', NULL, ''),
	(1256, '2022-12-14 07:26:56', '/sigap/GajiDelete/39', 'Administrator', '*** Batch delete successful ***', 'gaji', '', '', '', ''),
	(1257, '2022-12-14 07:27:09', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'nama', '40', '', '110124'),
	(1258, '2022-12-14 07:27:09', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'terlambat', '40', '', '2'),
	(1259, '2022-12-14 07:27:09', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'izin', '40', '', '2'),
	(1260, '2022-12-14 07:27:09', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'sakit', '40', '', '2'),
	(1261, '2022-12-14 07:27:09', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'tidakhadir', '40', '', '3'),
	(1262, '2022-12-14 07:27:09', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'month', '40', '', '2022-12'),
	(1263, '2022-12-14 07:27:09', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'datetime', '40', '', '2022-12-14 07:27:09'),
	(1264, '2022-12-14 07:27:09', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'u_by', '40', '', '-1'),
	(1265, '2022-12-14 07:27:09', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_izin', '40', '', '40000'),
	(1266, '2022-12-14 07:27:09', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_terlambat', '40', '', '15000'),
	(1267, '2022-12-14 07:27:09', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_sakit', '40', '', '20000'),
	(1268, '2022-12-14 07:27:09', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_tidakhadir', '40', '', '40000'),
	(1269, '2022-12-14 07:27:09', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'total', '40', '', '270000'),
	(1270, '2022-12-14 07:27:09', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'id', '40', '', '40'),
	(1271, '2022-12-14 07:27:26', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'jabatan_id', '42', '', '2'),
	(1272, '2022-12-14 07:27:26', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'pegawai', '42', '', '110124'),
	(1273, '2022-12-14 07:27:26', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'lembur', '42', '', '12'),
	(1274, '2022-12-14 07:27:26', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'kehadiran', '42', '', '12'),
	(1275, '2022-12-14 07:27:26', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'piket_count', '42', '', '12'),
	(1276, '2022-12-14 07:27:26', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'month', '42', '', NULL),
	(1277, '2022-12-14 07:27:26', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'datetime', '42', '', '2022-12-14 07:27:26'),
	(1278, '2022-12-14 07:27:26', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_lembur', '42', '', '42000'),
	(1279, '2022-12-14 07:27:26', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'gapok', '42', '', '40000'),
	(1280, '2022-12-14 07:27:26', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_inval', '42', '', '10000'),
	(1281, '2022-12-14 07:27:26', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_reward', '42', '', '30000'),
	(1282, '2022-12-14 07:27:26', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_piket', '42', '', '30000'),
	(1283, '2022-12-14 07:27:26', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'tj_jabatan', '42', '', '21000'),
	(1284, '2022-12-14 07:27:26', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'tugastambahan', '42', '', '70000'),
	(1285, '2022-12-14 07:27:26', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'sub_total', '42', '', '1475000'),
	(1286, '2022-12-14 07:27:26', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'potongan', '42', '', NULL),
	(1287, '2022-12-14 07:27:26', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'total', '42', '', '1475000'),
	(1288, '2022-12-14 07:27:26', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'id', '42', '', '42'),
	(1289, '2022-12-14 07:27:34', '/sigap/GajiDelete/42', 'Administrator', '*** Batch delete begin ***', 'gaji', '', '', '', ''),
	(1290, '2022-12-14 07:27:34', '/sigap/GajiDelete/42', 'Administrator', 'D', 'gaji', 'id', '42', '42', ''),
	(1291, '2022-12-14 07:27:34', '/sigap/GajiDelete/42', 'Administrator', 'D', 'gaji', 'pegawai', '42', '110124', ''),
	(1292, '2022-12-14 07:27:34', '/sigap/GajiDelete/42', 'Administrator', 'D', 'gaji', 'datetime', '42', '2022-12-14 07:27:26', ''),
	(1293, '2022-12-14 07:27:34', '/sigap/GajiDelete/42', 'Administrator', 'D', 'gaji', 'month', '42', NULL, ''),
	(1294, '2022-12-14 07:27:34', '/sigap/GajiDelete/42', 'Administrator', 'D', 'gaji', 'lembur', '42', '12', ''),
	(1295, '2022-12-14 07:27:34', '/sigap/GajiDelete/42', 'Administrator', 'D', 'gaji', 'value_lembur', '42', '42000', ''),
	(1296, '2022-12-14 07:27:34', '/sigap/GajiDelete/42', 'Administrator', 'D', 'gaji', 'jabatan_id', '42', '2', ''),
	(1297, '2022-12-14 07:27:34', '/sigap/GajiDelete/42', 'Administrator', 'D', 'gaji', 'gapok', '42', '40000', ''),
	(1298, '2022-12-14 07:27:34', '/sigap/GajiDelete/42', 'Administrator', 'D', 'gaji', 'total', '42', '1475000', ''),
	(1299, '2022-12-14 07:27:34', '/sigap/GajiDelete/42', 'Administrator', 'D', 'gaji', 'value_reward', '42', '30000', ''),
	(1300, '2022-12-14 07:27:34', '/sigap/GajiDelete/42', 'Administrator', 'D', 'gaji', 'value_inval', '42', '10000', ''),
	(1301, '2022-12-14 07:27:34', '/sigap/GajiDelete/42', 'Administrator', 'D', 'gaji', 'piket_count', '42', '12', ''),
	(1302, '2022-12-14 07:27:34', '/sigap/GajiDelete/42', 'Administrator', 'D', 'gaji', 'value_piket', '42', '30000', ''),
	(1303, '2022-12-14 07:27:34', '/sigap/GajiDelete/42', 'Administrator', 'D', 'gaji', 'tugastambahan', '42', '70000', ''),
	(1304, '2022-12-14 07:27:34', '/sigap/GajiDelete/42', 'Administrator', 'D', 'gaji', 'tj_jabatan', '42', '21000', ''),
	(1305, '2022-12-14 07:27:34', '/sigap/GajiDelete/42', 'Administrator', 'D', 'gaji', 'kehadiran', '42', '12', ''),
	(1306, '2022-12-14 07:27:34', '/sigap/GajiDelete/42', 'Administrator', 'D', 'gaji', 'sub_total', '42', '1475000', ''),
	(1307, '2022-12-14 07:27:34', '/sigap/GajiDelete/42', 'Administrator', 'D', 'gaji', 'potongan', '42', NULL, ''),
	(1308, '2022-12-14 07:27:34', '/sigap/GajiDelete/42', 'Administrator', '*** Batch delete successful ***', 'gaji', '', '', '', ''),
	(1309, '2022-12-14 07:27:52', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'jabatan_id', '43', '', '2'),
	(1310, '2022-12-14 07:27:52', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'pegawai', '43', '', '110124'),
	(1311, '2022-12-14 07:27:52', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'lembur', '43', '', '12'),
	(1312, '2022-12-14 07:27:52', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'kehadiran', '43', '', '12'),
	(1313, '2022-12-14 07:27:52', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'piket_count', '43', '', '12'),
	(1314, '2022-12-14 07:27:52', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'month', '43', '', '2022-12'),
	(1315, '2022-12-14 07:27:52', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'datetime', '43', '', '2022-12-14 07:27:52'),
	(1316, '2022-12-14 07:27:52', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_lembur', '43', '', '42000'),
	(1317, '2022-12-14 07:27:52', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'gapok', '43', '', '40000'),
	(1318, '2022-12-14 07:27:52', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_inval', '43', '', '10000'),
	(1319, '2022-12-14 07:27:52', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_reward', '43', '', '30000'),
	(1320, '2022-12-14 07:27:52', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_piket', '43', '', '30000'),
	(1321, '2022-12-14 07:27:52', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'tj_jabatan', '43', '', '21000'),
	(1322, '2022-12-14 07:27:52', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'tugastambahan', '43', '', '70000'),
	(1323, '2022-12-14 07:27:52', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'sub_total', '43', '', '1475000'),
	(1324, '2022-12-14 07:27:52', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'potongan', '43', '', NULL),
	(1325, '2022-12-14 07:27:52', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'total', '43', '', '1475000'),
	(1326, '2022-12-14 07:27:52', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'id', '43', '', '43'),
	(1327, '2022-12-14 07:31:26', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'jabatan_id', '44', '', '1'),
	(1328, '2022-12-14 07:31:26', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'pegawai', '44', '', '110124'),
	(1329, '2022-12-14 07:31:26', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'lembur', '44', '', '12'),
	(1330, '2022-12-14 07:31:26', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'kehadiran', '44', '', NULL),
	(1331, '2022-12-14 07:31:26', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'piket_count', '44', '', NULL),
	(1332, '2022-12-14 07:31:26', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'month', '44', '', '2022-12'),
	(1333, '2022-12-14 07:31:26', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'datetime', '44', '', '2022-12-14 07:31:26'),
	(1334, '2022-12-14 07:31:26', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_lembur', '44', '', '40000'),
	(1335, '2022-12-14 07:31:26', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'gapok', '44', '', '80000'),
	(1336, '2022-12-14 07:31:26', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_inval', '44', '', '10000'),
	(1337, '2022-12-14 07:31:26', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_reward', '44', '', '40000'),
	(1338, '2022-12-14 07:31:26', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_piket', '44', '', '30000'),
	(1339, '2022-12-14 07:31:26', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'tj_jabatan', '44', '', '12000'),
	(1340, '2022-12-14 07:31:26', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'tugastambahan', '44', '', '70000'),
	(1341, '2022-12-14 07:31:26', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'sub_total', '44', '', '612000'),
	(1342, '2022-12-14 07:31:26', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'potongan', '44', '', '270000'),
	(1343, '2022-12-14 07:31:26', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'total', '44', '', '342000'),
	(1344, '2022-12-14 07:31:26', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'id', '44', '', '44'),
	(1345, '2022-12-14 07:31:57', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'nama', '41', '', '110124'),
	(1346, '2022-12-14 07:31:57', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'terlambat', '41', '', '2'),
	(1347, '2022-12-14 07:31:57', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'izin', '41', '', '2'),
	(1348, '2022-12-14 07:31:57', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'sakit', '41', '', NULL),
	(1349, '2022-12-14 07:31:57', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'tidakhadir', '41', '', NULL),
	(1350, '2022-12-14 07:31:57', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'month', '41', '', '2022-11'),
	(1351, '2022-12-14 07:31:57', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'datetime', '41', '', '2022-12-14 07:31:57'),
	(1352, '2022-12-14 07:31:57', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'u_by', '41', '', '-1'),
	(1353, '2022-12-14 07:31:57', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_izin', '41', '', '40000'),
	(1354, '2022-12-14 07:31:57', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_terlambat', '41', '', '15000'),
	(1355, '2022-12-14 07:31:57', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_sakit', '41', '', '20000'),
	(1356, '2022-12-14 07:31:57', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_tidakhadir', '41', '', '40000'),
	(1357, '2022-12-14 07:31:57', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'total', '41', '', '110000'),
	(1358, '2022-12-14 07:31:57', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'id', '41', '', '41'),
	(1359, '2022-12-14 07:32:19', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'jabatan_id', '45', '', '1'),
	(1360, '2022-12-14 07:32:19', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'pegawai', '45', '', '110124'),
	(1361, '2022-12-14 07:32:19', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'lembur', '45', '', '12'),
	(1362, '2022-12-14 07:32:19', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'kehadiran', '45', '', '14'),
	(1363, '2022-12-14 07:32:19', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'piket_count', '45', '', NULL),
	(1364, '2022-12-14 07:32:19', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'month', '45', '', '2022-11'),
	(1365, '2022-12-14 07:32:19', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'datetime', '45', '', '2022-12-14 07:32:19'),
	(1366, '2022-12-14 07:32:19', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_lembur', '45', '', '40000'),
	(1367, '2022-12-14 07:32:19', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'gapok', '45', '', '80000'),
	(1368, '2022-12-14 07:32:19', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_inval', '45', '', '10000'),
	(1369, '2022-12-14 07:32:19', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_reward', '45', '', '40000'),
	(1370, '2022-12-14 07:32:19', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_piket', '45', '', '30000'),
	(1371, '2022-12-14 07:32:19', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'tj_jabatan', '45', '', '12000'),
	(1372, '2022-12-14 07:32:19', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'tugastambahan', '45', '', '70000'),
	(1373, '2022-12-14 07:32:19', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'sub_total', '45', '', '1732000'),
	(1374, '2022-12-14 07:32:19', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'potongan', '45', '', '270000'),
	(1375, '2022-12-14 07:32:19', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'total', '45', '', '1462000'),
	(1376, '2022-12-14 07:32:19', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'id', '45', '', '45'),
	(1377, '2022-12-14 07:43:48', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'jabatan_id', '46', '', '1'),
	(1378, '2022-12-14 07:43:48', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'pegawai', '46', '', '110124'),
	(1379, '2022-12-14 07:43:48', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'lembur', '46', '', '4'),
	(1380, '2022-12-14 07:43:48', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'kehadiran', '46', '', '12'),
	(1381, '2022-12-14 07:43:48', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'piket_count', '46', '', '4'),
	(1382, '2022-12-14 07:43:48', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'month', '46', '', '2022-12'),
	(1383, '2022-12-14 07:43:48', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'datetime', '46', '', '2022-12-14 07:43:48'),
	(1384, '2022-12-14 07:43:48', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_lembur', '46', '', '40000'),
	(1385, '2022-12-14 07:43:48', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'gapok', '46', '', '80000'),
	(1386, '2022-12-14 07:43:48', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_inval', '46', '', '10000'),
	(1387, '2022-12-14 07:43:48', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_reward', '46', '', '40000'),
	(1388, '2022-12-14 07:43:48', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_piket', '46', '', '30000'),
	(1389, '2022-12-14 07:43:48', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'tj_jabatan', '46', '', '12000'),
	(1390, '2022-12-14 07:43:48', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'tugastambahan', '46', '', '70000'),
	(1391, '2022-12-14 07:43:48', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'sub_total', '46', '', '1252000'),
	(1392, '2022-12-14 07:43:48', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'potongan', '46', '', '270000'),
	(1393, '2022-12-14 07:43:48', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'total', '46', '', '982000'),
	(1394, '2022-12-14 07:43:48', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'id', '46', '', '46'),
	(1395, '2022-12-14 07:44:35', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'jabatan_id', '47', '', '1'),
	(1396, '2022-12-14 07:44:35', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'pegawai', '47', '', '110124'),
	(1397, '2022-12-14 07:44:35', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'lembur', '47', '', '1'),
	(1398, '2022-12-14 07:44:35', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'kehadiran', '47', '', '12'),
	(1399, '2022-12-14 07:44:35', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'piket_count', '47', '', '4'),
	(1400, '2022-12-14 07:44:35', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'month', '47', '', '2022-11'),
	(1401, '2022-12-14 07:44:35', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'datetime', '47', '', '2022-12-14 07:44:35'),
	(1402, '2022-12-14 07:44:35', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_lembur', '47', '', '40000'),
	(1403, '2022-12-14 07:44:35', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'gapok', '47', '', '80000'),
	(1404, '2022-12-14 07:44:35', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_inval', '47', '', '10000'),
	(1405, '2022-12-14 07:44:35', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_reward', '47', '', '40000'),
	(1406, '2022-12-14 07:44:35', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_piket', '47', '', '30000'),
	(1407, '2022-12-14 07:44:35', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'tj_jabatan', '47', '', '12000'),
	(1408, '2022-12-14 07:44:35', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'tugastambahan', '47', '', '70000'),
	(1409, '2022-12-14 07:44:35', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'sub_total', '47', '', '1132000'),
	(1410, '2022-12-14 07:44:35', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'potongan', '47', '', '270000'),
	(1411, '2022-12-14 07:44:35', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'total', '47', '', '862000'),
	(1412, '2022-12-14 07:44:35', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'id', '47', '', '47'),
	(1413, '2022-12-14 07:53:26', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'jabatan_id', '48', '', '2'),
	(1414, '2022-12-14 07:53:26', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'pegawai', '48', '', '110124'),
	(1415, '2022-12-14 07:53:26', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'lembur', '48', '', '1'),
	(1416, '2022-12-14 07:53:26', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'kehadiran', '48', '', '12'),
	(1417, '2022-12-14 07:53:26', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'piket_count', '48', '', NULL),
	(1418, '2022-12-14 07:53:26', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'month', '48', '', '2022-11'),
	(1419, '2022-12-14 07:53:26', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'datetime', '48', '', '2022-12-14 07:53:26'),
	(1420, '2022-12-14 07:53:26', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_lembur', '48', '', '42000'),
	(1421, '2022-12-14 07:53:26', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'gapok', '48', '', '40000'),
	(1422, '2022-12-14 07:53:26', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_inval', '48', '', '10000'),
	(1423, '2022-12-14 07:53:26', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_reward', '48', '', '30000'),
	(1424, '2022-12-14 07:53:26', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_piket', '48', '', '30000'),
	(1425, '2022-12-14 07:53:26', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'tj_jabatan', '48', '', '21000'),
	(1426, '2022-12-14 07:53:26', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'tugastambahan', '48', '', '70000'),
	(1427, '2022-12-14 07:53:26', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'sub_total', '48', '', '653000'),
	(1428, '2022-12-14 07:53:26', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'potongan', '48', '', '270000'),
	(1429, '2022-12-14 07:53:26', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'total', '48', '', '383000'),
	(1430, '2022-12-14 07:53:26', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'id', '48', '', '48'),
	(1431, '2022-12-14 07:57:27', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'nama', '42', '', '110123'),
	(1432, '2022-12-14 07:57:27', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'terlambat', '42', '', '2'),
	(1433, '2022-12-14 07:57:27', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'izin', '42', '', '2'),
	(1434, '2022-12-14 07:57:27', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'sakit', '42', '', '2'),
	(1435, '2022-12-14 07:57:27', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'tidakhadir', '42', '', NULL),
	(1436, '2022-12-14 07:57:27', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'month', '42', '', NULL),
	(1437, '2022-12-14 07:57:27', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'datetime', '42', '', '2022-12-14 07:57:27'),
	(1438, '2022-12-14 07:57:27', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'u_by', '42', '', '-1'),
	(1439, '2022-12-14 07:57:27', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_izin', '42', '', '40000'),
	(1440, '2022-12-14 07:57:27', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_terlambat', '42', '', '15000'),
	(1441, '2022-12-14 07:57:27', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_sakit', '42', '', '20000'),
	(1442, '2022-12-14 07:57:27', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_tidakhadir', '42', '', '40000'),
	(1443, '2022-12-14 07:57:27', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'total', '42', '', '150000'),
	(1444, '2022-12-14 07:57:27', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'id', '42', '', '42'),
	(1445, '2022-12-14 07:57:53', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'jabatan_id', '49', '', '1'),
	(1446, '2022-12-14 07:57:53', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'pegawai', '49', '', '110123'),
	(1447, '2022-12-14 07:57:53', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'lembur', '49', '', '4'),
	(1448, '2022-12-14 07:57:53', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'kehadiran', '49', '', '3'),
	(1449, '2022-12-14 07:57:53', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'piket_count', '49', '', '4'),
	(1450, '2022-12-14 07:57:53', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'month', '49', '', NULL),
	(1451, '2022-12-14 07:57:53', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'datetime', '49', '', '2022-12-14 07:57:53'),
	(1452, '2022-12-14 07:57:53', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_lembur', '49', '', '40000'),
	(1453, '2022-12-14 07:57:53', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'gapok', '49', '', '80000'),
	(1454, '2022-12-14 07:57:53', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_inval', '49', '', '10000'),
	(1455, '2022-12-14 07:57:53', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_reward', '49', '', '40000'),
	(1456, '2022-12-14 07:57:53', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_piket', '49', '', '30000'),
	(1457, '2022-12-14 07:57:53', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'tj_jabatan', '49', '', '12000'),
	(1458, '2022-12-14 07:57:53', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'tugastambahan', '49', '', '70000'),
	(1459, '2022-12-14 07:57:53', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'sub_total', '49', '', '532000'),
	(1460, '2022-12-14 07:57:53', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'potongan', '49', '', NULL),
	(1461, '2022-12-14 07:57:53', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'total', '49', '', '532000'),
	(1462, '2022-12-14 07:57:53', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'id', '49', '', '49'),
	(1463, '2022-12-14 07:58:13', '/sigap/PotonganEdit/42', 'Administrator', 'U', 'potongan', 'month', '42', NULL, '2022-12'),
	(1464, '2022-12-14 07:58:34', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'jabatan_id', '50', '', '2'),
	(1465, '2022-12-14 07:58:34', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'pegawai', '50', '', '110123'),
	(1466, '2022-12-14 07:58:34', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'lembur', '50', '', '1'),
	(1467, '2022-12-14 07:58:34', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'kehadiran', '50', '', '14'),
	(1468, '2022-12-14 07:58:34', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'piket_count', '50', '', '1'),
	(1469, '2022-12-14 07:58:34', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'month', '50', '', '2022-11'),
	(1470, '2022-12-14 07:58:34', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'datetime', '50', '', '2022-12-14 07:58:34'),
	(1471, '2022-12-14 07:58:34', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_lembur', '50', '', '42000'),
	(1472, '2022-12-14 07:58:34', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'gapok', '50', '', '40000'),
	(1473, '2022-12-14 07:58:34', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_inval', '50', '', '10000'),
	(1474, '2022-12-14 07:58:34', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_reward', '50', '', '30000'),
	(1475, '2022-12-14 07:58:34', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_piket', '50', '', '30000'),
	(1476, '2022-12-14 07:58:34', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'tj_jabatan', '50', '', '21000'),
	(1477, '2022-12-14 07:58:34', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'tugastambahan', '50', '', '70000'),
	(1478, '2022-12-14 07:58:34', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'sub_total', '50', '', '763000'),
	(1479, '2022-12-14 07:58:34', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'potongan', '50', '', NULL),
	(1480, '2022-12-14 07:58:34', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'total', '50', '', '763000'),
	(1481, '2022-12-14 07:58:34', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'id', '50', '', '50'),
	(1482, '2022-12-14 07:58:58', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'jabatan_id', '51', '', '1'),
	(1483, '2022-12-14 07:58:58', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'pegawai', '51', '', '110123'),
	(1484, '2022-12-14 07:58:58', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'lembur', '51', '', '1'),
	(1485, '2022-12-14 07:58:58', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'kehadiran', '51', '', '14'),
	(1486, '2022-12-14 07:58:58', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'piket_count', '51', '', '4'),
	(1487, '2022-12-14 07:58:58', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'month', '51', '', '2022-12'),
	(1488, '2022-12-14 07:58:58', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'datetime', '51', '', '2022-12-14 07:58:58'),
	(1489, '2022-12-14 07:58:58', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_lembur', '51', '', '40000'),
	(1490, '2022-12-14 07:58:58', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'gapok', '51', '', '80000'),
	(1491, '2022-12-14 07:58:58', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_inval', '51', '', '10000'),
	(1492, '2022-12-14 07:58:58', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_reward', '51', '', '40000'),
	(1493, '2022-12-14 07:58:58', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_piket', '51', '', '30000'),
	(1494, '2022-12-14 07:58:58', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'tj_jabatan', '51', '', '12000'),
	(1495, '2022-12-14 07:58:58', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'tugastambahan', '51', '', '70000'),
	(1496, '2022-12-14 07:58:58', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'sub_total', '51', '', '1292000'),
	(1497, '2022-12-14 07:58:58', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'potongan', '51', '', NULL),
	(1498, '2022-12-14 07:58:58', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'total', '51', '', '1292000'),
	(1499, '2022-12-14 07:58:58', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'id', '51', '', '51'),
	(1500, '2022-12-14 07:59:50', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'nama', '43', '', '110124'),
	(1501, '2022-12-14 07:59:50', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'terlambat', '43', '', '2'),
	(1502, '2022-12-14 07:59:50', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'izin', '43', '', NULL),
	(1503, '2022-12-14 07:59:50', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'sakit', '43', '', NULL),
	(1504, '2022-12-14 07:59:50', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'tidakhadir', '43', '', NULL),
	(1505, '2022-12-14 07:59:50', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'month', '43', '', '2022-12'),
	(1506, '2022-12-14 07:59:50', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'datetime', '43', '', '2022-12-14 07:59:50'),
	(1507, '2022-12-14 07:59:50', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'u_by', '43', '', '-1'),
	(1508, '2022-12-14 07:59:50', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_izin', '43', '', '40000'),
	(1509, '2022-12-14 07:59:50', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_terlambat', '43', '', '15000'),
	(1510, '2022-12-14 07:59:50', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_sakit', '43', '', '20000'),
	(1511, '2022-12-14 07:59:50', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_tidakhadir', '43', '', '40000'),
	(1512, '2022-12-14 07:59:50', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'total', '43', '', '30000'),
	(1513, '2022-12-14 07:59:50', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'id', '43', '', '43'),
	(1514, '2022-12-14 08:00:10', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'jabatan_id', '52', '', '2'),
	(1515, '2022-12-14 08:00:10', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'pegawai', '52', '', '110124'),
	(1516, '2022-12-14 08:00:10', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'lembur', '52', '', '1'),
	(1517, '2022-12-14 08:00:10', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'kehadiran', '52', '', '12'),
	(1518, '2022-12-14 08:00:10', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'piket_count', '52', '', NULL),
	(1519, '2022-12-14 08:00:10', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'month', '52', '', '2022-12'),
	(1520, '2022-12-14 08:00:10', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'datetime', '52', '', '2022-12-14 08:00:10'),
	(1521, '2022-12-14 08:00:10', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_lembur', '52', '', '42000'),
	(1522, '2022-12-14 08:00:10', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'gapok', '52', '', '40000'),
	(1523, '2022-12-14 08:00:10', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_inval', '52', '', '10000'),
	(1524, '2022-12-14 08:00:10', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_reward', '52', '', '30000'),
	(1525, '2022-12-14 08:00:10', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_piket', '52', '', '30000'),
	(1526, '2022-12-14 08:00:10', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'tj_jabatan', '52', '', '21000'),
	(1527, '2022-12-14 08:00:10', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'tugastambahan', '52', '', '70000'),
	(1528, '2022-12-14 08:00:10', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'sub_total', '52', '', '653000'),
	(1529, '2022-12-14 08:00:10', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'potongan', '52', '', '150000'),
	(1530, '2022-12-14 08:00:10', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'total', '52', '', '503000'),
	(1531, '2022-12-14 08:00:10', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'id', '52', '', '52'),
	(1532, '2022-12-14 08:01:16', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'jabatan_id', '53', '', '1'),
	(1533, '2022-12-14 08:01:16', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'pegawai', '53', '', '110124'),
	(1534, '2022-12-14 08:01:16', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'lembur', '53', '', '4'),
	(1535, '2022-12-14 08:01:16', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'kehadiran', '53', '', '14'),
	(1536, '2022-12-14 08:01:16', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'piket_count', '53', '', NULL),
	(1537, '2022-12-14 08:01:16', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'month', '53', '', '2022-12'),
	(1538, '2022-12-14 08:01:16', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'datetime', '53', '', '2022-12-14 08:01:16'),
	(1539, '2022-12-14 08:01:16', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_lembur', '53', '', '40000'),
	(1540, '2022-12-14 08:01:16', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'gapok', '53', '', '80000'),
	(1541, '2022-12-14 08:01:16', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_inval', '53', '', '10000'),
	(1542, '2022-12-14 08:01:16', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_reward', '53', '', '40000'),
	(1543, '2022-12-14 08:01:16', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_piket', '53', '', '30000'),
	(1544, '2022-12-14 08:01:16', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'tj_jabatan', '53', '', '12000'),
	(1545, '2022-12-14 08:01:16', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'tugastambahan', '53', '', '70000'),
	(1546, '2022-12-14 08:01:16', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'sub_total', '53', '', '1412000'),
	(1547, '2022-12-14 08:01:16', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'potongan', '53', '', '150000'),
	(1548, '2022-12-14 08:01:16', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'total', '53', '', '1262000'),
	(1549, '2022-12-14 08:01:16', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'id', '53', '', '53'),
	(1550, '2022-12-14 08:01:59', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'jabatan_id', '54', '', '1'),
	(1551, '2022-12-14 08:01:59', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'pegawai', '54', '', '110123'),
	(1552, '2022-12-14 08:01:59', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'lembur', '54', '', NULL),
	(1553, '2022-12-14 08:01:59', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'kehadiran', '54', '', '14'),
	(1554, '2022-12-14 08:01:59', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'piket_count', '54', '', NULL),
	(1555, '2022-12-14 08:01:59', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'month', '54', '', '2022-12'),
	(1556, '2022-12-14 08:01:59', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'datetime', '54', '', '2022-12-14 08:01:59'),
	(1557, '2022-12-14 08:01:59', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_lembur', '54', '', '40000'),
	(1558, '2022-12-14 08:01:59', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'gapok', '54', '', '80000'),
	(1559, '2022-12-14 08:01:59', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_inval', '54', '', '10000'),
	(1560, '2022-12-14 08:01:59', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_reward', '54', '', '40000'),
	(1561, '2022-12-14 08:01:59', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_piket', '54', '', '30000'),
	(1562, '2022-12-14 08:01:59', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'tj_jabatan', '54', '', '12000'),
	(1563, '2022-12-14 08:01:59', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'tugastambahan', '54', '', '70000'),
	(1564, '2022-12-14 08:01:59', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'sub_total', '54', '', '1252000'),
	(1565, '2022-12-14 08:01:59', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'potongan', '54', '', '150000'),
	(1566, '2022-12-14 08:01:59', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'total', '54', '', '1102000'),
	(1567, '2022-12-14 08:01:59', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'id', '54', '', '54'),
	(1568, '2022-12-14 08:02:47', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'nama', '44', '', '110123'),
	(1569, '2022-12-14 08:02:47', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'terlambat', '44', '', '2'),
	(1570, '2022-12-14 08:02:47', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'izin', '44', '', '2'),
	(1571, '2022-12-14 08:02:47', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'sakit', '44', '', '1'),
	(1572, '2022-12-14 08:02:47', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'tidakhadir', '44', '', '1'),
	(1573, '2022-12-14 08:02:47', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'month', '44', '', '2022-12'),
	(1574, '2022-12-14 08:02:47', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'datetime', '44', '', '2022-12-14 08:02:47'),
	(1575, '2022-12-14 08:02:47', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'u_by', '44', '', '-1'),
	(1576, '2022-12-14 08:02:47', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_izin', '44', '', '40000'),
	(1577, '2022-12-14 08:02:47', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_terlambat', '44', '', '15000'),
	(1578, '2022-12-14 08:02:47', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_sakit', '44', '', '20000'),
	(1579, '2022-12-14 08:02:47', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_tidakhadir', '44', '', '40000'),
	(1580, '2022-12-14 08:02:47', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'total', '44', '', '170000'),
	(1581, '2022-12-14 08:02:47', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'id', '44', '', '44'),
	(1582, '2022-12-14 08:03:13', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'jabatan_id', '55', '', '2'),
	(1583, '2022-12-14 08:03:13', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'pegawai', '55', '', '110123'),
	(1584, '2022-12-14 08:03:13', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'lembur', '55', '', '1'),
	(1585, '2022-12-14 08:03:13', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'kehadiran', '55', '', '12'),
	(1586, '2022-12-14 08:03:13', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'piket_count', '55', '', NULL),
	(1587, '2022-12-14 08:03:13', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'month', '55', '', '2022-12'),
	(1588, '2022-12-14 08:03:13', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'datetime', '55', '', '2022-12-14 08:03:13'),
	(1589, '2022-12-14 08:03:13', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_lembur', '55', '', '42000'),
	(1590, '2022-12-14 08:03:13', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'gapok', '55', '', '40000'),
	(1591, '2022-12-14 08:03:13', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_inval', '55', '', '10000'),
	(1592, '2022-12-14 08:03:13', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_reward', '55', '', '30000'),
	(1593, '2022-12-14 08:03:13', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_piket', '55', '', '30000'),
	(1594, '2022-12-14 08:03:13', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'tj_jabatan', '55', '', '21000'),
	(1595, '2022-12-14 08:03:13', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'tugastambahan', '55', '', '70000'),
	(1596, '2022-12-14 08:03:13', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'sub_total', '55', '', '653000'),
	(1597, '2022-12-14 08:03:13', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'potongan', '55', '', NULL),
	(1598, '2022-12-14 08:03:13', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'total', '55', '', '653000'),
	(1599, '2022-12-14 08:03:13', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'id', '55', '', '55'),
	(1600, '2022-12-14 08:03:36', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'jabatan_id', '56', '', '1'),
	(1601, '2022-12-14 08:03:36', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'pegawai', '56', '', '110124'),
	(1602, '2022-12-14 08:03:36', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'lembur', '56', '', '1'),
	(1603, '2022-12-14 08:03:36', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'kehadiran', '56', '', '12'),
	(1604, '2022-12-14 08:03:36', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'piket_count', '56', '', '4'),
	(1605, '2022-12-14 08:03:36', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'month', '56', '', '2022-12'),
	(1606, '2022-12-14 08:03:36', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'datetime', '56', '', '2022-12-14 08:03:36'),
	(1607, '2022-12-14 08:03:36', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_lembur', '56', '', '40000'),
	(1608, '2022-12-14 08:03:36', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'gapok', '56', '', '80000'),
	(1609, '2022-12-14 08:03:36', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_inval', '56', '', '10000'),
	(1610, '2022-12-14 08:03:36', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_reward', '56', '', '40000'),
	(1611, '2022-12-14 08:03:36', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_piket', '56', '', '30000'),
	(1612, '2022-12-14 08:03:36', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'tj_jabatan', '56', '', '12000'),
	(1613, '2022-12-14 08:03:36', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'tugastambahan', '56', '', '70000'),
	(1614, '2022-12-14 08:03:36', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'sub_total', '56', '', '1132000'),
	(1615, '2022-12-14 08:03:36', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'potongan', '56', '', '170000'),
	(1616, '2022-12-14 08:03:36', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'total', '56', '', '962000'),
	(1617, '2022-12-14 08:03:36', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'id', '56', '', '56'),
	(1618, '2022-12-14 08:25:23', '/sigap/JenisBarangAdd', 'Administrator', 'A', 'jenis_barang', 'nama', '1', '', 'Elektronik'),
	(1619, '2022-12-14 08:25:23', '/sigap/JenisBarangAdd', 'Administrator', 'A', 'jenis_barang', 'aktif', '1', '', '1'),
	(1620, '2022-12-14 08:25:23', '/sigap/JenisBarangAdd', 'Administrator', 'A', 'jenis_barang', 'id', '1', '', '1'),
	(1621, '2022-12-14 08:26:22', '/sigap/JenisBarangAdd/1', 'Administrator', 'A', 'jenis_barang', 'nama', '2', '', 'Perlengkapan'),
	(1622, '2022-12-14 08:26:22', '/sigap/JenisBarangAdd/1', 'Administrator', 'A', 'jenis_barang', 'aktif', '2', '', '1'),
	(1623, '2022-12-14 08:26:22', '/sigap/JenisBarangAdd/1', 'Administrator', 'A', 'jenis_barang', 'id', '2', '', '2'),
	(1624, '2022-12-14 08:27:02', '/sigap/JenisIjinAdd', 'Administrator', 'A', 'jenis_ijin', 'nama', '3', '', 'Tanpa keterangan'),
	(1625, '2022-12-14 08:27:02', '/sigap/JenisIjinAdd', 'Administrator', 'A', 'jenis_ijin', 'aktif', '3', '', '1'),
	(1626, '2022-12-14 08:27:02', '/sigap/JenisIjinAdd', 'Administrator', 'A', 'jenis_ijin', 'value', '3', '', '50000'),
	(1627, '2022-12-14 08:27:02', '/sigap/JenisIjinAdd', 'Administrator', 'A', 'jenis_ijin', 'id', '3', '', '3'),
	(1628, '2022-12-14 08:28:18', '/sigap/JenisIjinDelete/3', 'Administrator', '*** Batch delete begin ***', 'jenis_ijin', '', '', '', ''),
	(1629, '2022-12-14 08:28:18', '/sigap/JenisIjinDelete/3', 'Administrator', 'D', 'jenis_ijin', 'id', '3', '3', ''),
	(1630, '2022-12-14 08:28:18', '/sigap/JenisIjinDelete/3', 'Administrator', 'D', 'jenis_ijin', 'nama', '3', 'Tanpa keterangan', ''),
	(1631, '2022-12-14 08:28:18', '/sigap/JenisIjinDelete/3', 'Administrator', 'D', 'jenis_ijin', 'aktif', '3', '1', ''),
	(1632, '2022-12-14 08:28:18', '/sigap/JenisIjinDelete/3', 'Administrator', 'D', 'jenis_ijin', 'value', '3', '50000', ''),
	(1633, '2022-12-14 08:28:18', '/sigap/JenisIjinDelete/3', 'Administrator', '*** Batch delete successful ***', 'jenis_ijin', '', '', '', ''),
	(1634, '2022-12-14 08:28:33', '/sigap/JenisLemburAdd', 'Administrator', 'A', 'jenis_lembur', 'nama', '1', '', 'Kejar deadline'),
	(1635, '2022-12-14 08:28:33', '/sigap/JenisLemburAdd', 'Administrator', 'A', 'jenis_lembur', 'aktif', '1', '', NULL),
	(1636, '2022-12-14 08:28:33', '/sigap/JenisLemburAdd', 'Administrator', 'A', 'jenis_lembur', 'id', '1', '', '1'),
	(1637, '2022-12-14 08:28:39', '/sigap/JenisLemburEdit/1', 'Administrator', 'U', 'jenis_lembur', 'aktif', '1', NULL, '1'),
	(1638, '2022-12-15 02:25:01', '/sigap/login', 'Administrator', 'login', '::1', '', '', '', ''),
	(1639, '2022-12-15 04:09:02', '/sigap/login', 'Administrator', 'login', '::1', '', '', '', ''),
	(1640, '2022-12-15 07:57:13', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'jabatan_id', '57', '', '1'),
	(1641, '2022-12-15 07:57:13', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'pegawai', '57', '', '110123'),
	(1642, '2022-12-15 07:57:13', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'lembur', '57', '', '1'),
	(1643, '2022-12-15 07:57:13', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'kehadiran', '57', '', '1'),
	(1644, '2022-12-15 07:57:13', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'piket_count', '57', '', '1'),
	(1645, '2022-12-15 07:57:13', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'month', '57', '', NULL),
	(1646, '2022-12-15 07:57:13', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'datetime', '57', '', '2022-12-15 07:57:13'),
	(1647, '2022-12-15 07:57:13', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_lembur', '57', '', '40000'),
	(1648, '2022-12-15 07:57:13', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'gapok', '57', '', '80000'),
	(1649, '2022-12-15 07:57:13', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_inval', '57', '', '10000'),
	(1650, '2022-12-15 07:57:13', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_reward', '57', '', '40000'),
	(1651, '2022-12-15 07:57:13', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'value_piket', '57', '', '30000'),
	(1652, '2022-12-15 07:57:13', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'tj_jabatan', '57', '', '12000'),
	(1653, '2022-12-15 07:57:13', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'tugastambahan', '57', '', '70000'),
	(1654, '2022-12-15 07:57:13', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'sub_total', '57', '', '252000'),
	(1655, '2022-12-15 07:57:13', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'potongan', '57', '', '170000'),
	(1656, '2022-12-15 07:57:13', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'total', '57', '', '82000'),
	(1657, '2022-12-15 07:57:13', '/sigap/GajiAdd', 'Administrator', 'A', 'gaji', 'id', '57', '', '57'),
	(1658, '2022-12-15 10:17:49', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'nama', '45', '', '110123'),
	(1659, '2022-12-15 10:17:49', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'jenjang_id', '45', '', '1'),
	(1660, '2022-12-15 10:17:49', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'jabatan_id', '45', '', '1'),
	(1661, '2022-12-15 10:17:49', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'terlambat', '45', '', '1'),
	(1662, '2022-12-15 10:17:49', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'izin', '45', '', '1'),
	(1663, '2022-12-15 10:17:49', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'sakit', '45', '', '1'),
	(1664, '2022-12-15 10:17:49', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'tidakhadir', '45', '', NULL),
	(1665, '2022-12-15 10:17:49', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'datetime', '45', '', '2022-12-15 10:17:49'),
	(1666, '2022-12-15 10:17:49', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'u_by', '45', '', '-1'),
	(1667, '2022-12-15 10:17:49', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'pulcep', '45', '', NULL),
	(1668, '2022-12-15 10:17:49', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_pulcep', '45', '', NULL),
	(1669, '2022-12-15 10:17:49', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'tidakhadirjam', '45', '', NULL),
	(1670, '2022-12-15 10:17:49', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'tidakhadirjamvalue', '45', '', NULL),
	(1671, '2022-12-15 10:17:49', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'sakitperjam', '45', '', NULL),
	(1672, '2022-12-15 10:17:49', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'sakitperjamvalue', '45', '', NULL),
	(1673, '2022-12-15 10:17:49', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'month', '45', '', NULL),
	(1674, '2022-12-15 10:17:49', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_izin', '45', '', '40000'),
	(1675, '2022-12-15 10:17:49', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_terlambat', '45', '', NULL),
	(1676, '2022-12-15 10:17:49', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_sakit', '45', '', '20000'),
	(1677, '2022-12-15 10:17:49', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_tidakhadir', '45', '', '40000'),
	(1678, '2022-12-15 10:17:49', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'total', '45', '', '80000'),
	(1679, '2022-12-15 10:17:49', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'id', '45', '', '45'),
	(1680, '2022-12-15 10:41:46', '/sigap/JenisIjinEdit/1', 'Administrator', 'U', 'jenis_ijin', 'jenjang_id', '1', NULL, '1'),
	(1681, '2022-12-15 10:41:46', '/sigap/JenisIjinEdit/1', 'Administrator', 'U', 'jenis_ijin', 'jabatan_id', '1', NULL, '1'),
	(1682, '2022-12-15 10:42:15', '/sigap/JenisIjinEdit/2', 'Administrator', 'U', 'jenis_ijin', 'jenjang_id', '2', NULL, '1'),
	(1683, '2022-12-15 10:42:15', '/sigap/JenisIjinEdit/2', 'Administrator', 'U', 'jenis_ijin', 'jabatan_id', '2', NULL, '2'),
	(1684, '2022-12-15 10:42:15', '/sigap/JenisIjinEdit/2', 'Administrator', 'U', 'jenis_ijin', 'value', '2', '20000', '4000'),
	(1685, '2022-12-15 10:42:15', '/sigap/JenisIjinEdit/2', 'Administrator', 'U', 'jenis_ijin', 'valueperjam', '2', NULL, '20000'),
	(1686, '2022-12-15 10:42:30', '/sigap/JenisIjinEdit/1', 'Administrator', 'U', 'jenis_ijin', 'value', '1', '40000', '4200'),
	(1687, '2022-12-15 10:42:30', '/sigap/JenisIjinEdit/1', 'Administrator', 'U', 'jenis_ijin', 'valueperjam', '1', NULL, '23000'),
	(1688, '2022-12-15 11:17:25', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'month', '46', '', NULL),
	(1689, '2022-12-15 11:17:25', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'nama', '46', '', '110123'),
	(1690, '2022-12-15 11:17:25', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'jenjang_id', '46', '', '1'),
	(1691, '2022-12-15 11:17:25', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'jabatan_id', '46', '', '1'),
	(1692, '2022-12-15 11:17:25', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'terlambat', '46', '', '1'),
	(1693, '2022-12-15 11:17:25', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'izin', '46', '', '1'),
	(1694, '2022-12-15 11:17:25', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'sakit', '46', '', '1'),
	(1695, '2022-12-15 11:17:25', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'sakitperjam', '46', '', '1'),
	(1696, '2022-12-15 11:17:25', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'sakitperjamvalue', '46', '', NULL),
	(1697, '2022-12-15 11:17:25', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'tidakhadir', '46', '', '12'),
	(1698, '2022-12-15 11:17:25', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'pulcep', '46', '', '0'),
	(1699, '2022-12-15 11:17:25', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_pulcep', '46', '', NULL),
	(1700, '2022-12-15 11:17:25', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'tidakhadirjam', '46', '', '0'),
	(1701, '2022-12-15 11:17:25', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'tidakhadirjamvalue', '46', '', NULL),
	(1702, '2022-12-15 11:17:25', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'u_by', '46', '', '-1'),
	(1703, '2022-12-15 11:17:25', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'datetime', '46', '', '2022-12-15 11:17:25'),
	(1704, '2022-12-15 11:17:25', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_izin', '46', '', '4200'),
	(1705, '2022-12-15 11:17:25', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_sakit', '46', '', NULL),
	(1706, '2022-12-15 11:17:25', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_tidakhadir', '46', '', NULL),
	(1707, '2022-12-15 11:17:25', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_terlambat', '46', '', '15000'),
	(1708, '2022-12-15 11:17:25', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'total', '46', '', '548200'),
	(1709, '2022-12-15 11:17:25', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'id', '46', '', '46'),
	(1710, '2022-12-15 11:19:27', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'month', '47', '', NULL),
	(1711, '2022-12-15 11:19:27', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'nama', '47', '', '110123'),
	(1712, '2022-12-15 11:19:27', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'jenjang_id', '47', '', '1'),
	(1713, '2022-12-15 11:19:27', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'jabatan_id', '47', '', '1'),
	(1714, '2022-12-15 11:19:27', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'terlambat', '47', '', '1'),
	(1715, '2022-12-15 11:19:27', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'izin', '47', '', '1'),
	(1716, '2022-12-15 11:19:27', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'sakit', '47', '', '1'),
	(1717, '2022-12-15 11:19:27', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'sakitperjam', '47', '', '1'),
	(1718, '2022-12-15 11:19:27', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'sakitperjamvalue', '47', '', NULL),
	(1719, '2022-12-15 11:19:27', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'tidakhadir', '47', '', NULL),
	(1720, '2022-12-15 11:19:27', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'pulcep', '47', '', '0'),
	(1721, '2022-12-15 11:19:27', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_pulcep', '47', '', NULL),
	(1722, '2022-12-15 11:19:27', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'tidakhadirjam', '47', '', '0'),
	(1723, '2022-12-15 11:19:27', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'tidakhadirjamvalue', '47', '', NULL),
	(1724, '2022-12-15 11:19:27', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'u_by', '47', '', '-1'),
	(1725, '2022-12-15 11:19:27', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'datetime', '47', '', '2022-12-15 11:19:27'),
	(1726, '2022-12-15 11:19:27', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_izin', '47', '', '4200'),
	(1727, '2022-12-15 11:19:27', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_sakit', '47', '', '40000'),
	(1728, '2022-12-15 11:19:27', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_tidakhadir', '47', '', '40000'),
	(1729, '2022-12-15 11:19:27', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_terlambat', '47', '', '15000'),
	(1730, '2022-12-15 11:19:27', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'total', '47', '', '68200'),
	(1731, '2022-12-15 11:19:27', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'id', '47', '', '47'),
	(1732, '2022-12-15 11:22:20', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'month', '48', '', NULL),
	(1733, '2022-12-15 11:22:20', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'nama', '48', '', '110123'),
	(1734, '2022-12-15 11:22:20', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'jenjang_id', '48', '', '1'),
	(1735, '2022-12-15 11:22:20', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'jabatan_id', '48', '', '1'),
	(1736, '2022-12-15 11:22:20', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'terlambat', '48', '', '1'),
	(1737, '2022-12-15 11:22:20', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'izin', '48', '', '1'),
	(1738, '2022-12-15 11:22:20', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'sakit', '48', '', '1'),
	(1739, '2022-12-15 11:22:20', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'sakitperjam', '48', '', '1'),
	(1740, '2022-12-15 11:22:20', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'sakitperjamvalue', '48', '', '9000'),
	(1741, '2022-12-15 11:22:20', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'tidakhadir', '48', '', '1'),
	(1742, '2022-12-15 11:22:20', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'pulcep', '48', '', '0'),
	(1743, '2022-12-15 11:22:20', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_pulcep', '48', '', NULL),
	(1744, '2022-12-15 11:22:20', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'tidakhadirjam', '48', '', '0'),
	(1745, '2022-12-15 11:22:20', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'tidakhadirjamvalue', '48', '', '9000'),
	(1746, '2022-12-15 11:22:20', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'u_by', '48', '', '-1'),
	(1747, '2022-12-15 11:22:20', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'datetime', '48', '', '2022-12-15 11:22:20'),
	(1748, '2022-12-15 11:22:20', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_izin', '48', '', '4200'),
	(1749, '2022-12-15 11:22:20', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_sakit', '48', '', '40000'),
	(1750, '2022-12-15 11:22:20', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_tidakhadir', '48', '', '40000'),
	(1751, '2022-12-15 11:22:21', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_terlambat', '48', '', '15000'),
	(1752, '2022-12-15 11:22:21', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'total', '48', '', '108200'),
	(1753, '2022-12-15 11:22:21', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'id', '48', '', '48'),
	(1754, '2022-12-15 11:27:44', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'month', '49', '', NULL),
	(1755, '2022-12-15 11:27:44', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'nama', '49', '', '110123'),
	(1756, '2022-12-15 11:27:44', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'jenjang_id', '49', '', '1'),
	(1757, '2022-12-15 11:27:44', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'jabatan_id', '49', '', '1'),
	(1758, '2022-12-15 11:27:44', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'terlambat', '49', '', '1'),
	(1759, '2022-12-15 11:27:44', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'izin', '49', '', '1'),
	(1760, '2022-12-15 11:27:44', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'sakit', '49', '', '1'),
	(1761, '2022-12-15 11:27:44', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'sakitperjam', '49', '', NULL),
	(1762, '2022-12-15 11:27:44', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'sakitperjamvalue', '49', '', '9000'),
	(1763, '2022-12-15 11:27:44', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'tidakhadir', '49', '', '1'),
	(1764, '2022-12-15 11:27:44', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'pulcep', '49', '', '20000'),
	(1765, '2022-12-15 11:27:44', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_pulcep', '49', '', NULL),
	(1766, '2022-12-15 11:27:44', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'tidakhadirjam', '49', '', '1'),
	(1767, '2022-12-15 11:27:44', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'tidakhadirjamvalue', '49', '', '9000'),
	(1768, '2022-12-15 11:27:44', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'u_by', '49', '', '-1'),
	(1769, '2022-12-15 11:27:44', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'datetime', '49', '', '2022-12-15 11:27:44'),
	(1770, '2022-12-15 11:27:44', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_izin', '49', '', '4200'),
	(1771, '2022-12-15 11:27:44', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_sakit', '49', '', '40000'),
	(1772, '2022-12-15 11:27:44', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_tidakhadir', '49', '', '40000'),
	(1773, '2022-12-15 11:27:44', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_terlambat', '49', '', '15000'),
	(1774, '2022-12-15 11:27:44', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'total', '49', '', '99200'),
	(1775, '2022-12-15 11:27:44', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'id', '49', '', '49'),
	(1776, '2022-12-15 11:31:07', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'month', '50', '', '2022-12'),
	(1777, '2022-12-15 11:31:07', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'nama', '50', '', NULL),
	(1778, '2022-12-15 11:31:07', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'jenjang_id', '50', '', '1'),
	(1779, '2022-12-15 11:31:07', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'jabatan_id', '50', '', '1'),
	(1780, '2022-12-15 11:31:07', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'terlambat', '50', '', '1'),
	(1781, '2022-12-15 11:31:07', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'izin', '50', '', '1'),
	(1782, '2022-12-15 11:31:07', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'sakit', '50', '', '1'),
	(1783, '2022-12-15 11:31:07', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'sakitperjam', '50', '', '1'),
	(1784, '2022-12-15 11:31:07', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'sakitperjamvalue', '50', '', '9000'),
	(1785, '2022-12-15 11:31:07', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'tidakhadir', '50', '', NULL),
	(1786, '2022-12-15 11:31:07', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'pulcep', '50', '', '20000'),
	(1787, '2022-12-15 11:31:07', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_pulcep', '50', '', NULL),
	(1788, '2022-12-15 11:31:07', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'tidakhadirjam', '50', '', '1'),
	(1789, '2022-12-15 11:31:07', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'tidakhadirjamvalue', '50', '', '9000'),
	(1790, '2022-12-15 11:31:07', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'u_by', '50', '', '-1'),
	(1791, '2022-12-15 11:31:07', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'datetime', '50', '', '2022-12-15 11:31:07'),
	(1792, '2022-12-15 11:31:07', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_izin', '50', '', '4200'),
	(1793, '2022-12-15 11:31:07', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_sakit', '50', '', '40000'),
	(1794, '2022-12-15 11:31:07', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_tidakhadir', '50', '', '40000'),
	(1795, '2022-12-15 11:31:07', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_terlambat', '50', '', '15000'),
	(1796, '2022-12-15 11:31:07', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'total', '50', '', '88200'),
	(1797, '2022-12-15 11:31:07', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'id', '50', '', '50'),
	(1798, '2022-12-15 11:32:32', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'month', '51', '', NULL),
	(1799, '2022-12-15 11:32:32', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'nama', '51', '', '110123'),
	(1800, '2022-12-15 11:32:32', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'jenjang_id', '51', '', '1'),
	(1801, '2022-12-15 11:32:32', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'jabatan_id', '51', '', '1'),
	(1802, '2022-12-15 11:32:32', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'terlambat', '51', '', '2'),
	(1803, '2022-12-15 11:32:32', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'izin', '51', '', '1'),
	(1804, '2022-12-15 11:32:32', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'sakit', '51', '', '1'),
	(1805, '2022-12-15 11:32:32', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'sakitperjam', '51', '', NULL),
	(1806, '2022-12-15 11:32:32', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'sakitperjamvalue', '51', '', '9000'),
	(1807, '2022-12-15 11:32:32', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'tidakhadir', '51', '', NULL),
	(1808, '2022-12-15 11:32:32', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'pulcep', '51', '', NULL),
	(1809, '2022-12-15 11:32:32', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_pulcep', '51', '', NULL),
	(1810, '2022-12-15 11:32:32', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'tidakhadirjam', '51', '', '1'),
	(1811, '2022-12-15 11:32:32', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'tidakhadirjamvalue', '51', '', '9000'),
	(1812, '2022-12-15 11:32:32', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'u_by', '51', '', '-1'),
	(1813, '2022-12-15 11:32:32', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'datetime', '51', '', '2022-12-15 11:32:32'),
	(1814, '2022-12-15 11:32:32', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_izin', '51', '', '4200'),
	(1815, '2022-12-15 11:32:32', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_sakit', '51', '', '40000'),
	(1816, '2022-12-15 11:32:32', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_tidakhadir', '51', '', '40000'),
	(1817, '2022-12-15 11:32:32', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_terlambat', '51', '', '15000'),
	(1818, '2022-12-15 11:32:32', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'total', '51', '', '94200'),
	(1819, '2022-12-15 11:32:32', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'id', '51', '', '51'),
	(1820, '2022-12-15 11:33:27', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'month', '52', '', NULL),
	(1821, '2022-12-15 11:33:27', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'nama', '52', '', '110124'),
	(1822, '2022-12-15 11:33:27', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'jenjang_id', '52', '', '1'),
	(1823, '2022-12-15 11:33:27', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'jabatan_id', '52', '', '1'),
	(1824, '2022-12-15 11:33:27', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'terlambat', '52', '', '1'),
	(1825, '2022-12-15 11:33:27', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'izin', '52', '', '1'),
	(1826, '2022-12-15 11:33:27', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'sakit', '52', '', NULL),
	(1827, '2022-12-15 11:33:27', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'sakitperjam', '52', '', NULL),
	(1828, '2022-12-15 11:33:27', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'sakitperjamvalue', '52', '', '9000'),
	(1829, '2022-12-15 11:33:27', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'tidakhadir', '52', '', NULL),
	(1830, '2022-12-15 11:33:27', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'pulcep', '52', '', '1'),
	(1831, '2022-12-15 11:33:27', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_pulcep', '52', '', '7000'),
	(1832, '2022-12-15 11:33:27', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'tidakhadirjam', '52', '', '1'),
	(1833, '2022-12-15 11:33:27', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'tidakhadirjamvalue', '52', '', '9000'),
	(1834, '2022-12-15 11:33:27', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'u_by', '52', '', '-1'),
	(1835, '2022-12-15 11:33:27', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'datetime', '52', '', '2022-12-15 11:33:27'),
	(1836, '2022-12-15 11:33:27', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_izin', '52', '', '4200'),
	(1837, '2022-12-15 11:33:27', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_sakit', '52', '', '40000'),
	(1838, '2022-12-15 11:33:27', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_tidakhadir', '52', '', '40000'),
	(1839, '2022-12-15 11:33:27', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_terlambat', '52', '', '15000'),
	(1840, '2022-12-15 11:33:27', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'total', '52', '', '39200'),
	(1841, '2022-12-15 11:33:28', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'id', '52', '', '52'),
	(1842, '2022-12-16 03:04:45', '/sigap/login', 'Administrator', 'login', '::1', '', '', '', ''),
	(1843, '2022-12-16 03:47:44', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'month', '53', '', NULL),
	(1844, '2022-12-16 03:47:44', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'nama', '53', '', '110123'),
	(1845, '2022-12-16 03:47:44', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'jenjang_id', '53', '', '1'),
	(1846, '2022-12-16 03:47:44', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'jabatan_id', '53', '', '1'),
	(1847, '2022-12-16 03:47:44', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'terlambat', '53', '', NULL),
	(1848, '2022-12-16 03:47:44', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'izin', '53', '', '3'),
	(1849, '2022-12-16 03:47:44', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'izinperjam', '53', '', NULL),
	(1850, '2022-12-16 03:47:44', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'izinperjamvalue', '53', '', '9000'),
	(1851, '2022-12-16 03:47:44', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'sakit', '53', '', NULL),
	(1852, '2022-12-16 03:47:44', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'sakitperjam', '53', '', NULL),
	(1853, '2022-12-16 03:47:44', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'sakitperjamvalue', '53', '', NULL),
	(1854, '2022-12-16 03:47:44', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'tidakhadir', '53', '', NULL),
	(1855, '2022-12-16 03:47:44', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'pulcep', '53', '', '2'),
	(1856, '2022-12-16 03:47:44', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'tidakhadirjam', '53', '', '1'),
	(1857, '2022-12-16 03:47:44', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'u_by', '53', '', '-1'),
	(1858, '2022-12-16 03:47:44', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'datetime', '53', '', '2022-12-16 03:47:44'),
	(1859, '2022-12-16 03:47:44', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_izin', '53', '', '40000'),
	(1860, '2022-12-16 03:47:44', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'tidakhadirjamvalue', '53', '', '9000'),
	(1861, '2022-12-16 03:47:44', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_tidakhadir', '53', '', '40000'),
	(1862, '2022-12-16 03:47:44', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_pulcep', '53', '', '20000'),
	(1863, '2022-12-16 03:47:44', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_terlambat', '53', '', '15000'),
	(1864, '2022-12-16 03:47:44', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'id', '53', '', '53'),
	(1865, '2022-12-16 03:49:50', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'month', '54', '', NULL),
	(1866, '2022-12-16 03:49:50', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'nama', '54', '', '110123'),
	(1867, '2022-12-16 03:49:50', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'jenjang_id', '54', '', '1'),
	(1868, '2022-12-16 03:49:50', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'jabatan_id', '54', '', '1'),
	(1869, '2022-12-16 03:49:50', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'terlambat', '54', '', '2'),
	(1870, '2022-12-16 03:49:50', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'izin', '54', '', '2'),
	(1871, '2022-12-16 03:49:50', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'izinperjam', '54', '', NULL),
	(1872, '2022-12-16 03:49:50', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'izinperjamvalue', '54', '', '9000'),
	(1873, '2022-12-16 03:49:50', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'sakit', '54', '', NULL),
	(1874, '2022-12-16 03:49:50', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'sakitperjam', '54', '', NULL),
	(1875, '2022-12-16 03:49:50', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'sakitperjamvalue', '54', '', NULL),
	(1876, '2022-12-16 03:49:50', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'tidakhadir', '54', '', NULL),
	(1877, '2022-12-16 03:49:50', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'pulcep', '54', '', '2'),
	(1878, '2022-12-16 03:49:50', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'tidakhadirjam', '54', '', '2'),
	(1879, '2022-12-16 03:49:50', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'u_by', '54', '', '-1'),
	(1880, '2022-12-16 03:49:50', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'datetime', '54', '', '2022-12-16 03:49:50'),
	(1881, '2022-12-16 03:49:50', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_izin', '54', '', '40000'),
	(1882, '2022-12-16 03:49:50', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_sakit', '54', '', NULL),
	(1883, '2022-12-16 03:49:50', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'tidakhadirjamvalue', '54', '', '9000'),
	(1884, '2022-12-16 03:49:50', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_tidakhadir', '54', '', '40000'),
	(1885, '2022-12-16 03:49:50', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_pulcep', '54', '', '20000'),
	(1886, '2022-12-16 03:49:50', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_terlambat', '54', '', '15000'),
	(1887, '2022-12-16 03:49:50', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'total', '54', '', '150000'),
	(1888, '2022-12-16 03:49:50', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'id', '54', '', '54'),
	(1889, '2022-12-16 03:51:25', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'month', '55', '', NULL),
	(1890, '2022-12-16 03:51:25', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'nama', '55', '', '110123'),
	(1891, '2022-12-16 03:51:25', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'jenjang_id', '55', '', '1'),
	(1892, '2022-12-16 03:51:25', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'jabatan_id', '55', '', '1'),
	(1893, '2022-12-16 03:51:25', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'terlambat', '55', '', '2'),
	(1894, '2022-12-16 03:51:25', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'izin', '55', '', '2'),
	(1895, '2022-12-16 03:51:25', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'izinperjam', '55', '', NULL),
	(1896, '2022-12-16 03:51:25', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'izinperjamvalue', '55', '', '9000'),
	(1897, '2022-12-16 03:51:25', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'sakit', '55', '', NULL),
	(1898, '2022-12-16 03:51:25', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'sakitperjam', '55', '', NULL),
	(1899, '2022-12-16 03:51:25', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'sakitperjamvalue', '55', '', '4000'),
	(1900, '2022-12-16 03:51:25', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'tidakhadir', '55', '', NULL),
	(1901, '2022-12-16 03:51:25', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'pulcep', '55', '', '2'),
	(1902, '2022-12-16 03:51:25', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'tidakhadirjam', '55', '', '2'),
	(1903, '2022-12-16 03:51:25', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'u_by', '55', '', '-1'),
	(1904, '2022-12-16 03:51:25', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'datetime', '55', '', '2022-12-16 03:51:25'),
	(1905, '2022-12-16 03:51:25', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_izin', '55', '', '40000'),
	(1906, '2022-12-16 03:51:25', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_sakit', '55', '', '23000'),
	(1907, '2022-12-16 03:51:25', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'tidakhadirjamvalue', '55', '', '9000'),
	(1908, '2022-12-16 03:51:25', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_tidakhadir', '55', '', '40000'),
	(1909, '2022-12-16 03:51:25', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_pulcep', '55', '', '20000'),
	(1910, '2022-12-16 03:51:25', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_terlambat', '55', '', '15000'),
	(1911, '2022-12-16 03:51:25', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'total', '55', '', '150000'),
	(1912, '2022-12-16 03:51:25', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'id', '55', '', '55'),
	(1913, '2022-12-16 03:56:51', '/sigap/PotonganAdd/55', 'Administrator', 'A', 'potongan', 'month', '56', '', NULL),
	(1914, '2022-12-16 03:56:51', '/sigap/PotonganAdd/55', 'Administrator', 'A', 'potongan', 'nama', '56', '', '110124'),
	(1915, '2022-12-16 03:56:51', '/sigap/PotonganAdd/55', 'Administrator', 'A', 'potongan', 'jenjang_id', '56', '', NULL),
	(1916, '2022-12-16 03:56:51', '/sigap/PotonganAdd/55', 'Administrator', 'A', 'potongan', 'jabatan_id', '56', '', NULL),
	(1917, '2022-12-16 03:56:51', '/sigap/PotonganAdd/55', 'Administrator', 'A', 'potongan', 'terlambat', '56', '', '2'),
	(1918, '2022-12-16 03:56:51', '/sigap/PotonganAdd/55', 'Administrator', 'A', 'potongan', 'izin', '56', '', '2'),
	(1919, '2022-12-16 03:56:51', '/sigap/PotonganAdd/55', 'Administrator', 'A', 'potongan', 'izinperjam', '56', '', NULL),
	(1920, '2022-12-16 03:56:51', '/sigap/PotonganAdd/55', 'Administrator', 'A', 'potongan', 'izinperjamvalue', '56', '', NULL),
	(1921, '2022-12-16 03:56:51', '/sigap/PotonganAdd/55', 'Administrator', 'A', 'potongan', 'sakit', '56', '', NULL),
	(1922, '2022-12-16 03:56:51', '/sigap/PotonganAdd/55', 'Administrator', 'A', 'potongan', 'sakitperjam', '56', '', NULL),
	(1923, '2022-12-16 03:56:51', '/sigap/PotonganAdd/55', 'Administrator', 'A', 'potongan', 'sakitperjamvalue', '56', '', '4000'),
	(1924, '2022-12-16 03:56:51', '/sigap/PotonganAdd/55', 'Administrator', 'A', 'potongan', 'tidakhadir', '56', '', NULL),
	(1925, '2022-12-16 03:56:51', '/sigap/PotonganAdd/55', 'Administrator', 'A', 'potongan', 'pulcep', '56', '', '2'),
	(1926, '2022-12-16 03:56:51', '/sigap/PotonganAdd/55', 'Administrator', 'A', 'potongan', 'tidakhadirjam', '56', '', '2'),
	(1927, '2022-12-16 03:56:51', '/sigap/PotonganAdd/55', 'Administrator', 'A', 'potongan', 'u_by', '56', '', '-1'),
	(1928, '2022-12-16 03:56:51', '/sigap/PotonganAdd/55', 'Administrator', 'A', 'potongan', 'datetime', '56', '', '2022-12-16 03:56:51'),
	(1929, '2022-12-16 03:56:51', '/sigap/PotonganAdd/55', 'Administrator', 'A', 'potongan', 'value_izin', '56', '', NULL),
	(1930, '2022-12-16 03:56:51', '/sigap/PotonganAdd/55', 'Administrator', 'A', 'potongan', 'value_sakit', '56', '', '23000'),
	(1931, '2022-12-16 03:56:51', '/sigap/PotonganAdd/55', 'Administrator', 'A', 'potongan', 'tidakhadirjamvalue', '56', '', NULL),
	(1932, '2022-12-16 03:56:51', '/sigap/PotonganAdd/55', 'Administrator', 'A', 'potongan', 'value_tidakhadir', '56', '', NULL),
	(1933, '2022-12-16 03:56:51', '/sigap/PotonganAdd/55', 'Administrator', 'A', 'potongan', 'value_pulcep', '56', '', '20000'),
	(1934, '2022-12-16 03:56:51', '/sigap/PotonganAdd/55', 'Administrator', 'A', 'potongan', 'value_terlambat', '56', '', '15000'),
	(1935, '2022-12-16 03:56:51', '/sigap/PotonganAdd/55', 'Administrator', 'A', 'potongan', 'id', '56', '', '56'),
	(1936, '2022-12-16 03:57:28', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'month', '57', '', NULL),
	(1937, '2022-12-16 03:57:28', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'nama', '57', '', '110124'),
	(1938, '2022-12-16 03:57:28', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'jenjang_id', '57', '', '1'),
	(1939, '2022-12-16 03:57:28', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'jabatan_id', '57', '', '1'),
	(1940, '2022-12-16 03:57:28', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'terlambat', '57', '', '2'),
	(1941, '2022-12-16 03:57:28', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'izin', '57', '', '2'),
	(1942, '2022-12-16 03:57:28', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'izinperjam', '57', '', NULL),
	(1943, '2022-12-16 03:57:28', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'izinperjamvalue', '57', '', '9000'),
	(1944, '2022-12-16 03:57:28', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'sakit', '57', '', NULL),
	(1945, '2022-12-16 03:57:28', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'sakitperjam', '57', '', NULL),
	(1946, '2022-12-16 03:57:28', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'sakitperjamvalue', '57', '', '4000'),
	(1947, '2022-12-16 03:57:28', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'tidakhadir', '57', '', NULL),
	(1948, '2022-12-16 03:57:28', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'pulcep', '57', '', '2'),
	(1949, '2022-12-16 03:57:28', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'tidakhadirjam', '57', '', '2'),
	(1950, '2022-12-16 03:57:28', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'u_by', '57', '', '-1'),
	(1951, '2022-12-16 03:57:28', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'datetime', '57', '', '2022-12-16 03:57:28'),
	(1952, '2022-12-16 03:57:28', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_izin', '57', '', '40000'),
	(1953, '2022-12-16 03:57:28', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_sakit', '57', '', '23000'),
	(1954, '2022-12-16 03:57:28', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'tidakhadirjamvalue', '57', '', '9000'),
	(1955, '2022-12-16 03:57:28', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_tidakhadir', '57', '', '40000'),
	(1956, '2022-12-16 03:57:28', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_pulcep', '57', '', '20000'),
	(1957, '2022-12-16 03:57:28', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_terlambat', '57', '', '15000'),
	(1958, '2022-12-16 03:57:28', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'total', '57', '', '150000'),
	(1959, '2022-12-16 03:57:28', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'id', '57', '', '57'),
	(1960, '2022-12-16 03:59:15', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'month', '58', '', NULL),
	(1961, '2022-12-16 03:59:15', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'nama', '58', '', '110124'),
	(1962, '2022-12-16 03:59:15', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'jenjang_id', '58', '', '1'),
	(1963, '2022-12-16 03:59:15', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'jabatan_id', '58', '', '1'),
	(1964, '2022-12-16 03:59:15', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'terlambat', '58', '', '2'),
	(1965, '2022-12-16 03:59:15', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'izin', '58', '', '2'),
	(1966, '2022-12-16 03:59:15', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'izinperjam', '58', '', NULL),
	(1967, '2022-12-16 03:59:15', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'izinperjamvalue', '58', '', '9000'),
	(1968, '2022-12-16 03:59:15', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'sakit', '58', '', NULL),
	(1969, '2022-12-16 03:59:15', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'sakitperjam', '58', '', NULL),
	(1970, '2022-12-16 03:59:15', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'sakitperjamvalue', '58', '', '4000'),
	(1971, '2022-12-16 03:59:15', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'tidakhadir', '58', '', NULL),
	(1972, '2022-12-16 03:59:15', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'pulcep', '58', '', '2'),
	(1973, '2022-12-16 03:59:15', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'tidakhadirjam', '58', '', '2'),
	(1974, '2022-12-16 03:59:15', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'u_by', '58', '', '-1'),
	(1975, '2022-12-16 03:59:15', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'datetime', '58', '', '2022-12-16 03:59:15'),
	(1976, '2022-12-16 03:59:15', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_izin', '58', '', '40000'),
	(1977, '2022-12-16 03:59:15', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_sakit', '58', '', '23000'),
	(1978, '2022-12-16 03:59:15', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'tidakhadirjamvalue', '58', '', '9000'),
	(1979, '2022-12-16 03:59:15', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_tidakhadir', '58', '', '40000'),
	(1980, '2022-12-16 03:59:15', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_pulcep', '58', '', '20000'),
	(1981, '2022-12-16 03:59:15', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_terlambat', '58', '', '15000'),
	(1982, '2022-12-16 03:59:15', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'total', '58', '', '168000'),
	(1983, '2022-12-16 03:59:15', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'id', '58', '', '58'),
	(1984, '2022-12-16 04:03:38', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'month', '59', '', NULL),
	(1985, '2022-12-16 04:03:38', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'nama', '59', '', '110123'),
	(1986, '2022-12-16 04:03:38', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'jenjang_id', '59', '', '1'),
	(1987, '2022-12-16 04:03:38', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'jabatan_id', '59', '', '1'),
	(1988, '2022-12-16 04:03:38', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'terlambat', '59', '', '2'),
	(1989, '2022-12-16 04:03:38', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'izin', '59', '', '2'),
	(1990, '2022-12-16 04:03:38', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'izinperjam', '59', '', NULL),
	(1991, '2022-12-16 04:03:38', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'izinperjamvalue', '59', '', '9000'),
	(1992, '2022-12-16 04:03:38', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'sakit', '59', '', NULL),
	(1993, '2022-12-16 04:03:38', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'sakitperjam', '59', '', NULL),
	(1994, '2022-12-16 04:03:38', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'sakitperjamvalue', '59', '', '4000'),
	(1995, '2022-12-16 04:03:38', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'tidakhadir', '59', '', NULL),
	(1996, '2022-12-16 04:03:38', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'pulcep', '59', '', '2'),
	(1997, '2022-12-16 04:03:38', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'tidakhadirjam', '59', '', '2'),
	(1998, '2022-12-16 04:03:38', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'u_by', '59', '', '-1'),
	(1999, '2022-12-16 04:03:38', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'datetime', '59', '', '2022-12-16 04:03:38'),
	(2000, '2022-12-16 04:03:38', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_izin', '59', '', '40000'),
	(2001, '2022-12-16 04:03:38', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_sakit', '59', '', '23000'),
	(2002, '2022-12-16 04:03:38', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'tidakhadirjamvalue', '59', '', '9000'),
	(2003, '2022-12-16 04:03:38', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_tidakhadir', '59', '', '40000'),
	(2004, '2022-12-16 04:03:38', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_pulcep', '59', '', '20000'),
	(2005, '2022-12-16 04:03:38', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_terlambat', '59', '', '15000'),
	(2006, '2022-12-16 04:03:38', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'total', '59', '', '168000'),
	(2007, '2022-12-16 04:03:38', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'id', '59', '', '59'),
	(2008, '2022-12-16 04:07:30', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'month', '60', '', NULL),
	(2009, '2022-12-16 04:07:30', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'nama', '60', '', '110124'),
	(2010, '2022-12-16 04:07:30', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'jenjang_id', '60', '', '1'),
	(2011, '2022-12-16 04:07:30', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'jabatan_id', '60', '', '2'),
	(2012, '2022-12-16 04:07:30', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'terlambat', '60', '', '2'),
	(2013, '2022-12-16 04:07:30', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'izin', '60', '', '2'),
	(2014, '2022-12-16 04:07:30', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'izinperjam', '60', '', NULL),
	(2015, '2022-12-16 04:07:30', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'izinperjamvalue', '60', '', '4000'),
	(2016, '2022-12-16 04:07:30', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'sakit', '60', '', NULL),
	(2017, '2022-12-16 04:07:30', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'sakitperjam', '60', '', NULL),
	(2018, '2022-12-16 04:07:30', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'sakitperjamvalue', '60', '', NULL),
	(2019, '2022-12-16 04:07:30', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'tidakhadir', '60', '', NULL),
	(2020, '2022-12-16 04:07:30', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'pulcep', '60', '', '2'),
	(2021, '2022-12-16 04:07:30', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'tidakhadirjam', '60', '', '2'),
	(2022, '2022-12-16 04:07:30', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'u_by', '60', '', '-1'),
	(2023, '2022-12-16 04:07:30', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'datetime', '60', '', '2022-12-16 04:07:30'),
	(2024, '2022-12-16 04:07:30', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_izin', '60', '', '30000'),
	(2025, '2022-12-16 04:07:30', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_sakit', '60', '', NULL),
	(2026, '2022-12-16 04:07:30', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'tidakhadirjamvalue', '60', '', '4000'),
	(2027, '2022-12-16 04:07:30', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_tidakhadir', '60', '', '30000'),
	(2028, '2022-12-16 04:07:30', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_pulcep', '60', '', '18000'),
	(2029, '2022-12-16 04:07:30', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_terlambat', '60', '', '30000'),
	(2030, '2022-12-16 04:07:30', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'total', '60', '', '164000'),
	(2031, '2022-12-16 04:07:30', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'id', '60', '', '60'),
	(2032, '2022-12-16 04:08:54', '/sigap/PotonganDelete/60', 'Administrator', '*** Batch delete begin ***', 'potongan', '', '', '', ''),
	(2033, '2022-12-16 04:08:54', '/sigap/PotonganDelete/60', 'Administrator', 'D', 'potongan', 'id', '60', '60', ''),
	(2034, '2022-12-16 04:08:54', '/sigap/PotonganDelete/60', 'Administrator', 'D', 'potongan', 'nama', '60', '110124', ''),
	(2035, '2022-12-16 04:08:54', '/sigap/PotonganDelete/60', 'Administrator', 'D', 'potongan', 'terlambat', '60', '2', ''),
	(2036, '2022-12-16 04:08:54', '/sigap/PotonganDelete/60', 'Administrator', 'D', 'potongan', 'value_terlambat', '60', '30000', ''),
	(2037, '2022-12-16 04:08:54', '/sigap/PotonganDelete/60', 'Administrator', 'D', 'potongan', 'izin', '60', '2', ''),
	(2038, '2022-12-16 04:08:54', '/sigap/PotonganDelete/60', 'Administrator', 'D', 'potongan', 'value_izin', '60', '30000', ''),
	(2039, '2022-12-16 04:08:54', '/sigap/PotonganDelete/60', 'Administrator', 'D', 'potongan', 'jabatan_id', '60', '2', ''),
	(2040, '2022-12-16 04:08:54', '/sigap/PotonganDelete/60', 'Administrator', 'D', 'potongan', 'sakit', '60', NULL, ''),
	(2041, '2022-12-16 04:08:54', '/sigap/PotonganDelete/60', 'Administrator', 'D', 'potongan', 'value_sakit', '60', NULL, ''),
	(2042, '2022-12-16 04:08:54', '/sigap/PotonganDelete/60', 'Administrator', 'D', 'potongan', 'total', '60', '164000', ''),
	(2043, '2022-12-16 04:08:54', '/sigap/PotonganDelete/60', 'Administrator', 'D', 'potongan', 'tidakhadir', '60', NULL, ''),
	(2044, '2022-12-16 04:08:54', '/sigap/PotonganDelete/60', 'Administrator', 'D', 'potongan', 'value_tidakhadir', '60', '30000', ''),
	(2045, '2022-12-16 04:08:54', '/sigap/PotonganDelete/60', 'Administrator', 'D', 'potongan', 'month', '60', NULL, ''),
	(2046, '2022-12-16 04:08:54', '/sigap/PotonganDelete/60', 'Administrator', 'D', 'potongan', 'datetime', '60', '2022-12-16 04:07:30', ''),
	(2047, '2022-12-16 04:08:54', '/sigap/PotonganDelete/60', 'Administrator', 'D', 'potongan', 'u_by', '60', '-1', ''),
	(2048, '2022-12-16 04:08:54', '/sigap/PotonganDelete/60', 'Administrator', 'D', 'potongan', 'pulcep', '60', '2', ''),
	(2049, '2022-12-16 04:08:54', '/sigap/PotonganDelete/60', 'Administrator', 'D', 'potongan', 'value_pulcep', '60', '18000', ''),
	(2050, '2022-12-16 04:08:54', '/sigap/PotonganDelete/60', 'Administrator', 'D', 'potongan', 'tidakhadirjam', '60', '2', ''),
	(2051, '2022-12-16 04:08:54', '/sigap/PotonganDelete/60', 'Administrator', 'D', 'potongan', 'tidakhadirjamvalue', '60', '4000', ''),
	(2052, '2022-12-16 04:08:54', '/sigap/PotonganDelete/60', 'Administrator', 'D', 'potongan', 'sakitperjam', '60', NULL, ''),
	(2053, '2022-12-16 04:08:54', '/sigap/PotonganDelete/60', 'Administrator', 'D', 'potongan', 'sakitperjamvalue', '60', NULL, ''),
	(2054, '2022-12-16 04:08:54', '/sigap/PotonganDelete/60', 'Administrator', 'D', 'potongan', 'jenjang_id', '60', '1', ''),
	(2055, '2022-12-16 04:08:54', '/sigap/PotonganDelete/60', 'Administrator', 'D', 'potongan', 'izinperjam', '60', NULL, ''),
	(2056, '2022-12-16 04:08:54', '/sigap/PotonganDelete/60', 'Administrator', 'D', 'potongan', 'izinperjamvalue', '60', '4000', ''),
	(2057, '2022-12-16 04:08:54', '/sigap/PotonganDelete/60', 'Administrator', '*** Batch delete successful ***', 'potongan', '', '', '', ''),
	(2058, '2022-12-16 04:09:21', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'month', '61', '', NULL),
	(2059, '2022-12-16 04:09:21', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'nama', '61', '', '110124'),
	(2060, '2022-12-16 04:09:21', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'jenjang_id', '61', '', '1'),
	(2061, '2022-12-16 04:09:21', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'jabatan_id', '61', '', '2'),
	(2062, '2022-12-16 04:09:21', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'terlambat', '61', '', '2'),
	(2063, '2022-12-16 04:09:21', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'izin', '61', '', '2'),
	(2064, '2022-12-16 04:09:21', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'izinperjam', '61', '', NULL),
	(2065, '2022-12-16 04:09:21', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'izinperjamvalue', '61', '', '4000'),
	(2066, '2022-12-16 04:09:21', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'sakit', '61', '', NULL),
	(2067, '2022-12-16 04:09:21', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'sakitperjam', '61', '', NULL),
	(2068, '2022-12-16 04:09:21', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'sakitperjamvalue', '61', '', '7000'),
	(2069, '2022-12-16 04:09:21', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'tidakhadir', '61', '', NULL),
	(2070, '2022-12-16 04:09:21', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'pulcep', '61', '', '2'),
	(2071, '2022-12-16 04:09:21', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'tidakhadirjam', '61', '', '2'),
	(2072, '2022-12-16 04:09:21', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'u_by', '61', '', '-1'),
	(2073, '2022-12-16 04:09:21', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'datetime', '61', '', '2022-12-16 04:09:21'),
	(2074, '2022-12-16 04:09:21', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_izin', '61', '', '30000'),
	(2075, '2022-12-16 04:09:21', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_sakit', '61', '', '27000'),
	(2076, '2022-12-16 04:09:21', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'tidakhadirjamvalue', '61', '', '4000'),
	(2077, '2022-12-16 04:09:21', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_tidakhadir', '61', '', '30000'),
	(2078, '2022-12-16 04:09:21', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_pulcep', '61', '', '18000'),
	(2079, '2022-12-16 04:09:21', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_terlambat', '61', '', '30000'),
	(2080, '2022-12-16 04:09:21', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'total', '61', '', '164000'),
	(2081, '2022-12-16 04:09:21', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'id', '61', '', '61'),
	(2082, '2022-12-16 04:15:59', '/sigap/JabatanEdit/1', 'Administrator', 'U', 'jabatan', 'nama_jabatan', '1', 'CTO', 'TU'),
	(2083, '2022-12-16 04:16:12', '/sigap/JabatanEdit/2', 'Administrator', 'U', 'jabatan', 'nama_jabatan', '2', 'HRD', 'Kepala TU'),
	(2084, '2022-12-16 07:05:09', '/sigap/JabatanAdd', 'Administrator', 'A', 'jabatan', 'jenjang', '3', '', '1'),
	(2085, '2022-12-16 07:05:09', '/sigap/JabatanAdd', 'Administrator', 'A', 'jabatan', 'nama_jabatan', '3', '', 'Petugas Kebersihan'),
	(2086, '2022-12-16 07:05:09', '/sigap/JabatanAdd', 'Administrator', 'A', 'jabatan', 'keterangan', '3', '', 'baru'),
	(2087, '2022-12-16 07:05:09', '/sigap/JabatanAdd', 'Administrator', 'A', 'jabatan', 'c_date', '3', '', NULL),
	(2088, '2022-12-16 07:05:09', '/sigap/JabatanAdd', 'Administrator', 'A', 'jabatan', 'u_date', '3', '', '2022-12-16 07:05:09'),
	(2089, '2022-12-16 07:05:09', '/sigap/JabatanAdd', 'Administrator', 'A', 'jabatan', 'c_by', '3', '', NULL),
	(2090, '2022-12-16 07:05:09', '/sigap/JabatanAdd', 'Administrator', 'A', 'jabatan', 'u_by', '3', '', '-1'),
	(2091, '2022-12-16 07:05:09', '/sigap/JabatanAdd', 'Administrator', 'A', 'jabatan', 'aktif', '3', '', '1'),
	(2092, '2022-12-16 07:05:09', '/sigap/JabatanAdd', 'Administrator', 'A', 'jabatan', 'id', '3', '', '3'),
	(2093, '2022-12-16 07:06:02', '/sigap/JabatanEdit/1', 'Administrator', 'U', 'jabatan', 'jenjang', '1', NULL, '1'),
	(2094, '2022-12-16 07:08:49', '/sigap/JabatanEdit/2', 'Administrator', 'U', 'jabatan', 'jenjang', '2', NULL, '1'),
	(2095, '2022-12-16 09:14:07', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'month', '62', '', NULL),
	(2096, '2022-12-16 09:14:07', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'nama', '62', '', '110124'),
	(2097, '2022-12-16 09:14:07', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'jenjang_id', '62', '', '1'),
	(2098, '2022-12-16 09:14:07', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'jabatan_id', '62', '', '1'),
	(2099, '2022-12-16 09:14:07', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'terlambat', '62', '', '1'),
	(2100, '2022-12-16 09:14:07', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'izin', '62', '', '1'),
	(2101, '2022-12-16 09:14:07', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'izinperjam', '62', '', NULL),
	(2102, '2022-12-16 09:14:07', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'izinperjamvalue', '62', '', '9000'),
	(2103, '2022-12-16 09:14:07', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'sakit', '62', '', NULL),
	(2104, '2022-12-16 09:14:07', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'sakitperjam', '62', '', NULL),
	(2105, '2022-12-16 09:14:07', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'sakitperjamvalue', '62', '', '4000'),
	(2106, '2022-12-16 09:14:07', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'tidakhadir', '62', '', NULL),
	(2107, '2022-12-16 09:14:07', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'pulcep', '62', '', '1'),
	(2108, '2022-12-16 09:14:07', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'tidakhadirjam', '62', '', '1'),
	(2109, '2022-12-16 09:14:07', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'u_by', '62', '', '-1'),
	(2110, '2022-12-16 09:14:08', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'datetime', '62', '', '2022-12-16 09:14:07'),
	(2111, '2022-12-16 09:14:08', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_izin', '62', '', '40000'),
	(2112, '2022-12-16 09:14:08', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_sakit', '62', '', '23000'),
	(2113, '2022-12-16 09:14:08', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'tidakhadirjamvalue', '62', '', '9000'),
	(2114, '2022-12-16 09:14:08', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_tidakhadir', '62', '', '40000'),
	(2115, '2022-12-16 09:14:08', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_pulcep', '62', '', '20000'),
	(2116, '2022-12-16 09:14:08', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'value_terlambat', '62', '', '30000'),
	(2117, '2022-12-16 09:14:08', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'total', '62', '', '99000'),
	(2118, '2022-12-16 09:14:08', '/sigap/PotonganAdd', 'Administrator', 'A', 'potongan', 'id', '62', '', '62'),
	(2119, '2022-12-19 05:25:48', '/sigap/login', 'Administrator', 'login', '::1', '', '', '', '');

-- Dumping structure for table sigap2.barang
CREATE TABLE IF NOT EXISTS `barang` (
  `Kode_Barang` char(3) NOT NULL,
  `Nama_Barang` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`Kode_Barang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table sigap2.barang: 5 rows
/*!40000 ALTER TABLE `barang` DISABLE KEYS */;
INSERT INTO `barang` (`Kode_Barang`, `Nama_Barang`) VALUES
	('001', 'Barang Pertama'),
	('002', 'Barang Kedua'),
	('003', 'Barang Ketiga'),
	('004', 'Barang Keempat'),
	('005', 'Barang Kelima');
/*!40000 ALTER TABLE `barang` ENABLE KEYS */;

-- Dumping structure for table sigap2.barangnew
CREATE TABLE IF NOT EXISTS `barangnew` (
  `kode_barang` char(50) DEFAULT NULL,
  `nama_barang` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table sigap2.barangnew: ~0 rows (approximately)

-- Dumping structure for table sigap2.berita
CREATE TABLE IF NOT EXISTS `berita` (
  `id` int NOT NULL AUTO_INCREMENT,
  `grup` varchar(255) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `berita` text,
  `gambar` varchar(255) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `c_by` int DEFAULT NULL,
  `c_date` datetime DEFAULT NULL,
  `aktif` tinyint DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.berita: ~0 rows (approximately)

-- Dumping structure for table sigap2.bulan
CREATE TABLE IF NOT EXISTS `bulan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `bulan` varchar(50) DEFAULT NULL,
  `nourut` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table sigap2.bulan: ~12 rows (approximately)
INSERT INTO `bulan` (`id`, `bulan`, `nourut`) VALUES
	(1, 'januari', 1),
	(2, 'Februari', 2),
	(3, 'Maret', 3),
	(4, 'April', 4),
	(5, 'Mei', 5),
	(6, 'Juni', 6),
	(7, 'Juli', 7),
	(8, 'Agustus', 8),
	(9, 'September', 9),
	(10, 'Oktober', 10),
	(11, 'November', 11),
	(12, 'Desember', 12);

-- Dumping structure for table sigap2.daftarbarang
CREATE TABLE IF NOT EXISTS `daftarbarang` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `jenis` varchar(50) DEFAULT NULL,
  `sepsifikasi` varchar(255) DEFAULT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `tgl_terima` datetime DEFAULT NULL,
  `tgl_beli` datetime DEFAULT NULL,
  `harga` int DEFAULT NULL,
  `dokumen` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `pemegang` int DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.daftarbarang: ~0 rows (approximately)

-- Dumping structure for table sigap2.dinasluar
CREATE TABLE IF NOT EXISTS `dinasluar` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pegawai` int DEFAULT NULL,
  `pm` int DEFAULT NULL,
  `proyek` varchar(255) DEFAULT NULL,
  `tgl` datetime DEFAULT NULL,
  `tgl_dl_awal` date DEFAULT NULL,
  `tgl_dl_akhir` date DEFAULT NULL,
  `jenis` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `disetujui` varchar(5) DEFAULT NULL,
  `dokumen` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.dinasluar: ~0 rows (approximately)

-- Dumping structure for table sigap2.gaji
CREATE TABLE IF NOT EXISTS `gaji` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pegawai` varchar(50) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `month` date DEFAULT NULL,
  `lembur` int DEFAULT NULL,
  `value_lembur` bigint DEFAULT NULL,
  `jabatan_id` int DEFAULT NULL,
  `gapok` bigint DEFAULT NULL,
  `total` bigint DEFAULT NULL,
  `value_reward` bigint DEFAULT NULL,
  `value_inval` bigint DEFAULT NULL,
  `piket_count` int DEFAULT NULL,
  `value_piket` bigint DEFAULT NULL,
  `tugastambahan` bigint DEFAULT NULL,
  `tj_jabatan` bigint DEFAULT NULL,
  `kehadiran` int DEFAULT NULL,
  `sub_total` bigint DEFAULT NULL,
  `potongan` bigint DEFAULT NULL,
  `jenjang_id` int DEFAULT NULL,
  `penyesuaian` bigint DEFAULT NULL,
  `pid` int DEFAULT NULL,
  `jp` int DEFAULT NULL,
  `type` int DEFAULT NULL,
  `jenis_guru` int DEFAULT NULL,
  `tambahan` int DEFAULT NULL,
  `value_kehadiran` bigint DEFAULT NULL,
  `periode` int DEFAULT NULL,
  `tunjangan_periode` bigint DEFAULT NULL,
  `total_gapok` bigint DEFAULT NULL,
  `lama_kerja` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table sigap2.gaji: ~29 rows (approximately)
INSERT INTO `gaji` (`id`, `pegawai`, `datetime`, `month`, `lembur`, `value_lembur`, `jabatan_id`, `gapok`, `total`, `value_reward`, `value_inval`, `piket_count`, `value_piket`, `tugastambahan`, `tj_jabatan`, `kehadiran`, `sub_total`, `potongan`, `jenjang_id`, `penyesuaian`, `pid`, `jp`, `type`, `jenis_guru`, `tambahan`, `value_kehadiran`, `periode`, `tunjangan_periode`, `total_gapok`, `lama_kerja`) VALUES
	(58, 'farhan kebab', '2022-12-23 03:49:10', '2022-12-23', 2, 42000, NULL, 40000, 2674000, 30000, 10000, 2, 30000, 70000, 1500000, 23, 2674000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(59, 'farhan kebab', '2022-12-23 03:54:03', '2022-12-23', 2, 42000, NULL, 40000, 2764000, 30000, 10000, 5, 30000, 70000, 1500000, 23, 2764000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(60, 'YUNIARTI', '2022-12-23 03:56:10', '2022-12-23', 2, 42000, NULL, 40000, 2614000, 30000, 10000, NULL, 30000, 70000, 1500000, 23, 2614000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(61, 'YUNIARTI', '2022-12-23 03:57:13', '2022-12-23', 2, 42000, NULL, 40000, 1694000, 30000, 10000, NULL, 30000, 70000, 1500000, NULL, 1694000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(62, 'farhan kebab', '2022-12-23 03:59:53', '2022-12-23', 2, 42000, NULL, 40000, 1694000, 30000, 10000, NULL, 30000, 70000, 1500000, NULL, 1694000, 186000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(63, 'farhan kebab', '2022-12-23 04:12:57', '2022-12-23', 2, 42000, NULL, 40000, 1694000, 30000, 10000, NULL, 30000, 70000, 1500000, NULL, 1694000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(64, 'farhan kebab', '2022-12-23 07:04:21', '2022-12-23', 2, 42000, NULL, 40000, 2504000, 30000, 10000, 3, 30000, 70000, 1500000, 18, 2504000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(65, '', '2022-12-28 04:52:00', '2022-12-28', 2, NULL, 2, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, 12, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(66, '', '2022-12-28 04:57:26', '2022-12-28', 2, NULL, 2, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, 12, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(67, '110123', '2022-12-28 04:58:59', '2022-12-29', 2, NULL, 2, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, 12, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(68, '110123', '2022-12-28 05:07:35', '2022-12-28', 2, 40000, 2, 80000, 1854000, 40000, 10000, 2, 30000, 70000, NULL, 23, 2040000, 186000, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(69, '110123', '2022-12-28 06:19:09', '2022-12-28', 2, 42000, 2, 40000, 1834000, 30000, 10000, 2, 30000, 70000, 1500000, 2, 1834000, 220000, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(70, '110123', '2022-12-28 06:19:58', '2022-12-31', 2, 42000, 2, 40000, 3304000, 30000, 10000, 23, 30000, 70000, 1500000, 23, 3304000, 220000, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(71, '110123', '2023-01-03 03:47:19', '2023-01-03', 2, 42000, 2, 40000, 2234000, 30000, 10000, 2, 30000, 70000, 1500000, 12, 2234000, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(72, '110123', NULL, NULL, NULL, 42000, 2, 40000, 1610000, 30000, 10000, NULL, 30000, 70000, 1500000, NULL, 1610000, NULL, 1, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(73, '110123', '2023-01-04 10:07:07', '2023-01-04', 2, 42000, 2, 40000, 1694000, 30000, 10000, NULL, 30000, 70000, 1500000, NULL, 1694000, NULL, 1, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(74, '110123', '2023-01-04 10:10:34', NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(75, '110123', NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(76, '110124', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(77, '10234', NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(78, '110123', NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(79, '10432', NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(80, '110123', NULL, NULL, NULL, 42000, 2, 40000, 1610000, 30000, 10000, NULL, 30000, 70000, 1500000, NULL, 1610000, NULL, 1, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(81, '110123', NULL, NULL, NULL, 42000, 2, 40000, 1610000, 30000, 10000, NULL, 30000, 70000, 1500000, NULL, 1610000, NULL, 1, NULL, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(83, '110123', NULL, NULL, NULL, 42000, 2, 40000, 1610000, 30000, 10000, NULL, 30000, 70000, 1500000, NULL, 1610000, NULL, NULL, NULL, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(84, '110123', NULL, NULL, NULL, 42000, 2, 40000, 1610000, 30000, 10000, NULL, 30000, 70000, 1500000, NULL, 1610000, NULL, NULL, NULL, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(85, '110123', NULL, NULL, NULL, 42000, 2, 40000, 1610000, 30000, 10000, NULL, 30000, 70000, 1500000, NULL, 1610000, NULL, NULL, NULL, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(86, '110123', NULL, NULL, NULL, 42000, 2, 40000, 1610000, 30000, 10000, NULL, 30000, 70000, 1500000, NULL, 1610000, NULL, NULL, NULL, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(87, '110123', NULL, NULL, NULL, 42000, 2, 40000, 1610000, 30000, 10000, NULL, 30000, 70000, 1500000, NULL, 1610000, NULL, NULL, NULL, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- Dumping structure for table sigap2.gajisd
CREATE TABLE IF NOT EXISTS `gajisd` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tahun` smallint DEFAULT NULL,
  `bulan` int DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `createby` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.gajisd: ~1 rows (approximately)
INSERT INTO `gajisd` (`id`, `tahun`, `bulan`, `datetime`, `createby`) VALUES
	(1, 2, 2, NULL, NULL);

-- Dumping structure for table sigap2.gajisd_detil
CREATE TABLE IF NOT EXISTS `gajisd_detil` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pid` int DEFAULT NULL,
  `pegawai_id` varchar(50) DEFAULT NULL,
  `jabatan_id` int DEFAULT NULL,
  `masakerja` smallint DEFAULT NULL,
  `jumngajar` smallint DEFAULT NULL,
  `ijin` smallint DEFAULT NULL,
  `tunjangan_wkosis` int DEFAULT NULL,
  `nominal_baku` int DEFAULT NULL,
  `baku` int DEFAULT NULL,
  `kehadiran` int DEFAULT NULL,
  `prestasi` int DEFAULT NULL,
  `jumlahgaji` int DEFAULT NULL,
  `jumgajitotal` int DEFAULT NULL,
  `potongan1` int DEFAULT NULL,
  `potongan2` int DEFAULT NULL,
  `jumlahterima` int DEFAULT NULL,
  `jp` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.gajisd_detil: ~0 rows (approximately)

-- Dumping structure for table sigap2.gajisma
CREATE TABLE IF NOT EXISTS `gajisma` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tahun` smallint DEFAULT NULL,
  `bulan` int DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `createby` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.gajisma: ~0 rows (approximately)

-- Dumping structure for table sigap2.gajisma_detil
CREATE TABLE IF NOT EXISTS `gajisma_detil` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pid` int DEFAULT NULL,
  `pegawai_id` varchar(50) DEFAULT NULL,
  `jabatan_id` int DEFAULT NULL,
  `masakerja` smallint DEFAULT NULL,
  `jumngajar` smallint DEFAULT NULL,
  `ijin` smallint DEFAULT NULL,
  `tunjangan_wkosis` int DEFAULT NULL,
  `nominal_baku` int DEFAULT NULL,
  `baku` int DEFAULT NULL,
  `kehadiran` int DEFAULT NULL,
  `prestasi` int DEFAULT NULL,
  `jumlahgaji` int DEFAULT NULL,
  `jumgajitotal` int DEFAULT NULL,
  `potongan1` int DEFAULT NULL,
  `potongan2` int DEFAULT NULL,
  `jumlahterima` int DEFAULT NULL,
  `jp` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.gajisma_detil: ~0 rows (approximately)

-- Dumping structure for table sigap2.gajismk
CREATE TABLE IF NOT EXISTS `gajismk` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tahun` smallint DEFAULT NULL,
  `bulan` int DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `createby` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.gajismk: ~0 rows (approximately)

-- Dumping structure for table sigap2.gajismk_detil
CREATE TABLE IF NOT EXISTS `gajismk_detil` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pid` int DEFAULT NULL,
  `pegawai_id` varchar(50) DEFAULT NULL,
  `jabatan_id` int DEFAULT NULL,
  `masakerja` smallint DEFAULT NULL,
  `jumngajar` smallint DEFAULT NULL,
  `ijin` smallint DEFAULT NULL,
  `tunjangan_wkosis` int DEFAULT NULL,
  `nominal_baku` int DEFAULT NULL,
  `baku` int DEFAULT NULL,
  `kehadiran` int DEFAULT NULL,
  `prestasi` int DEFAULT NULL,
  `jumlahgaji` int DEFAULT NULL,
  `jumgajitotal` int DEFAULT NULL,
  `potongan1` int DEFAULT NULL,
  `potongan2` int DEFAULT NULL,
  `jumlahterima` int DEFAULT NULL,
  `jp` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.gajismk_detil: ~0 rows (approximately)

-- Dumping structure for table sigap2.gajismp
CREATE TABLE IF NOT EXISTS `gajismp` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tahun` smallint DEFAULT NULL,
  `bulan` int DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `createby` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.gajismp: ~0 rows (approximately)

-- Dumping structure for table sigap2.gajismp_detil
CREATE TABLE IF NOT EXISTS `gajismp_detil` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pid` int DEFAULT NULL,
  `pegawai_id` varchar(50) DEFAULT NULL,
  `jabatan_id` int DEFAULT NULL,
  `masakerja` smallint DEFAULT NULL,
  `jumngajar` smallint DEFAULT NULL,
  `ijin` smallint DEFAULT NULL,
  `tunjangan_wkosis` int DEFAULT NULL,
  `nominal_baku` int DEFAULT NULL,
  `baku` int DEFAULT NULL,
  `kehadiran` int DEFAULT NULL,
  `prestasi` int DEFAULT NULL,
  `jumlahgaji` int DEFAULT NULL,
  `jumgajitotal` int DEFAULT NULL,
  `potongan1` int DEFAULT NULL,
  `potongan2` int DEFAULT NULL,
  `jumlahterima` int DEFAULT NULL,
  `jp` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.gajismp_detil: ~0 rows (approximately)

-- Dumping structure for table sigap2.gajitk
CREATE TABLE IF NOT EXISTS `gajitk` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tahun` smallint DEFAULT NULL,
  `bulan` int DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `createby` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table sigap2.gajitk: ~0 rows (approximately)

-- Dumping structure for table sigap2.gajitk_detil
CREATE TABLE IF NOT EXISTS `gajitk_detil` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pid` int DEFAULT NULL,
  `pegawai_id` int DEFAULT NULL,
  `jabatan_id` int DEFAULT NULL,
  `masakerja` smallint DEFAULT NULL,
  `jumngajar` smallint DEFAULT NULL,
  `ijin` smallint DEFAULT NULL,
  `voucher` int DEFAULT NULL,
  `tunjangan_khusus` int DEFAULT NULL,
  `tunjangan_jabatan` int DEFAULT NULL,
  `baku` int DEFAULT NULL,
  `kehadiran` int DEFAULT NULL,
  `prestasi` int DEFAULT NULL,
  `jumlahgaji` int DEFAULT NULL,
  `jumgajitotal` int DEFAULT NULL,
  `potongan1` int DEFAULT NULL,
  `potongan2` int DEFAULT NULL,
  `jumlahterima` int DEFAULT NULL,
  `jp` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table sigap2.gajitk_detil: ~0 rows (approximately)

-- Dumping structure for table sigap2.gajitunjangan
CREATE TABLE IF NOT EXISTS `gajitunjangan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pidjabatan` int DEFAULT NULL,
  `value_kehadiran` bigint DEFAULT NULL,
  `gapok` int DEFAULT NULL,
  `tunjangan_jabatan` int DEFAULT NULL,
  `reward` int DEFAULT NULL,
  `lembur` int DEFAULT NULL,
  `piket` int DEFAULT NULL,
  `inval` int DEFAULT NULL,
  `jam_lebih` bigint DEFAULT NULL,
  `tunjangan_khusus` bigint DEFAULT NULL,
  `ekstrakuri` bigint DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.gajitunjangan: ~9 rows (approximately)
INSERT INTO `gajitunjangan` (`id`, `pidjabatan`, `value_kehadiran`, `gapok`, `tunjangan_jabatan`, `reward`, `lembur`, `piket`, `inval`, `jam_lebih`, `tunjangan_khusus`, `ekstrakuri`) VALUES
	(1, 1, 65500, 80000, NULL, 40000, 40000, 30000, 10000, 70000, 120000, NULL),
	(2, 2, 65500, 40000, 1500000, 30000, 42000, 30000, 10000, 70000, NULL, NULL),
	(3, 3, 60000, 300000, NULL, NULL, NULL, NULL, NULL, 10000, NULL, NULL),
	(4, 5, 56000, NULL, NULL, 50000, 50000, 30000, NULL, NULL, NULL, NULL),
	(5, 9, NULL, NULL, NULL, 50000, 30000, 35000, 25000, NULL, NULL, NULL),
	(6, 11, 60000, 300000, NULL, NULL, 10000, NULL, NULL, NULL, NULL, NULL),
	(7, 10, 60000, 300000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(8, 12, 75000, 450000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(9, 6, 60000, 300000, 50000, 200000, 30000, 25000, 35000, 30000, 250000, NULL);

-- Dumping structure for table sigap2.gaji_karyawan_sd
CREATE TABLE IF NOT EXISTS `gaji_karyawan_sd` (
  `id` int NOT NULL AUTO_INCREMENT,
  `datetime` datetime DEFAULT NULL,
  `pegawai` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `jabatan_id` int DEFAULT NULL,
  `jenjang_id` int DEFAULT NULL,
  `month` date DEFAULT NULL,
  `gapok` bigint DEFAULT NULL,
  `value_reward` bigint DEFAULT NULL,
  `value_inval` bigint DEFAULT NULL,
  `kehadiran` int DEFAULT NULL,
  `sub_total` bigint DEFAULT NULL,
  `potongan` bigint DEFAULT NULL,
  `penyesuaian` bigint DEFAULT NULL,
  `total` bigint DEFAULT NULL,
  `by` int DEFAULT NULL,
  `pid` int DEFAULT NULL,
  `jp` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.gaji_karyawan_sd: ~13 rows (approximately)
INSERT INTO `gaji_karyawan_sd` (`id`, `datetime`, `pegawai`, `jabatan_id`, `jenjang_id`, `month`, `gapok`, `value_reward`, `value_inval`, `kehadiran`, `sub_total`, `potongan`, `penyesuaian`, `total`, `by`, `pid`, `jp`) VALUES
	(58, '2022-12-23 03:49:10', 'farhan kebab', NULL, NULL, '2022-12-23', 40000, 30000, 10000, 23, 2674000, NULL, NULL, 2674000, NULL, NULL, NULL),
	(59, '2022-12-23 03:54:03', 'farhan kebab', NULL, NULL, '2022-12-23', 40000, 30000, 10000, 23, 2764000, NULL, NULL, 2764000, NULL, NULL, NULL),
	(60, '2022-12-23 03:56:10', 'YUNIARTI', NULL, NULL, '2022-12-23', 40000, 30000, 10000, 23, 2614000, NULL, NULL, 2614000, NULL, NULL, NULL),
	(61, '2022-12-23 03:57:13', 'YUNIARTI', NULL, NULL, '2022-12-23', 40000, 30000, 10000, NULL, 1694000, NULL, NULL, 1694000, NULL, NULL, NULL),
	(62, '2022-12-23 03:59:53', 'farhan kebab', NULL, NULL, '2022-12-23', 40000, 30000, 10000, NULL, 1694000, 186000, NULL, 1694000, NULL, NULL, NULL),
	(63, '2022-12-23 04:12:57', 'farhan kebab', NULL, NULL, '2022-12-23', 40000, 30000, 10000, NULL, 1694000, NULL, NULL, 1694000, NULL, NULL, NULL),
	(64, '2022-12-23 07:04:21', 'farhan kebab', NULL, NULL, '2022-12-23', 40000, 30000, 10000, 18, 2504000, NULL, NULL, 2504000, NULL, NULL, NULL),
	(65, '2022-12-28 04:52:00', '', 2, 1, '2022-12-28', NULL, NULL, NULL, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(66, '2022-12-28 04:57:26', '', 2, 1, '2022-12-28', NULL, NULL, NULL, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(67, '2022-12-28 04:58:59', '110123', 2, 1, '2022-12-29', NULL, NULL, NULL, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(68, '2022-12-28 05:07:35', '110123', 2, 1, '2022-12-28', 80000, 40000, 10000, 23, 2040000, 186000, NULL, 1854000, NULL, NULL, NULL),
	(69, '2022-12-28 06:19:09', '110123', 2, 1, '2022-12-28', 40000, 30000, 10000, 2, 1834000, 220000, NULL, 1834000, NULL, NULL, NULL),
	(70, '2022-12-28 06:19:58', '110123', 2, 1, '2022-12-31', 40000, 30000, 10000, 23, 3304000, 220000, NULL, 3304000, NULL, NULL, NULL);

-- Dumping structure for table sigap2.gaji_karyawan_sma
CREATE TABLE IF NOT EXISTS `gaji_karyawan_sma` (
  `id` int NOT NULL AUTO_INCREMENT,
  `datetime` datetime DEFAULT NULL,
  `pegawai` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `jabatan_id` int DEFAULT NULL,
  `jenjang_id` int DEFAULT NULL,
  `month` date DEFAULT NULL,
  `gapok` bigint DEFAULT NULL,
  `value_reward` bigint DEFAULT NULL,
  `value_inval` bigint DEFAULT NULL,
  `kehadiran` int DEFAULT NULL,
  `sub_total` bigint DEFAULT NULL,
  `potongan` bigint DEFAULT NULL,
  `penyesuaian` bigint DEFAULT NULL,
  `total` bigint DEFAULT NULL,
  `by` int DEFAULT NULL,
  `pid` int DEFAULT NULL,
  `jp` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.gaji_karyawan_sma: ~0 rows (approximately)

-- Dumping structure for table sigap2.gaji_karyawan_smk
CREATE TABLE IF NOT EXISTS `gaji_karyawan_smk` (
  `id` int NOT NULL AUTO_INCREMENT,
  `datetime` datetime DEFAULT NULL,
  `pegawai` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `jabatan_id` int DEFAULT NULL,
  `jenjang_id` int DEFAULT NULL,
  `month` date DEFAULT NULL,
  `gapok` bigint DEFAULT NULL,
  `value_reward` bigint DEFAULT NULL,
  `value_inval` bigint DEFAULT NULL,
  `kehadiran` int DEFAULT NULL,
  `sub_total` bigint DEFAULT NULL,
  `potongan` bigint DEFAULT NULL,
  `penyesuaian` bigint DEFAULT NULL,
  `total` bigint DEFAULT NULL,
  `by` int DEFAULT NULL,
  `pid` int DEFAULT NULL,
  `jp` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.gaji_karyawan_smk: ~1 rows (approximately)
INSERT INTO `gaji_karyawan_smk` (`id`, `datetime`, `pegawai`, `jabatan_id`, `jenjang_id`, `month`, `gapok`, `value_reward`, `value_inval`, `kehadiran`, `sub_total`, `potongan`, `penyesuaian`, `total`, `by`, `pid`, `jp`) VALUES
	(71, NULL, '110123', 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL);

-- Dumping structure for table sigap2.gaji_karyawan_smp
CREATE TABLE IF NOT EXISTS `gaji_karyawan_smp` (
  `id` int NOT NULL AUTO_INCREMENT,
  `datetime` datetime DEFAULT NULL,
  `pegawai` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `jabatan_id` int DEFAULT NULL,
  `jenjang_id` int DEFAULT NULL,
  `month` date DEFAULT NULL,
  `gapok` bigint DEFAULT NULL,
  `value_reward` bigint DEFAULT NULL,
  `value_inval` bigint DEFAULT NULL,
  `kehadiran` int DEFAULT NULL,
  `sub_total` bigint DEFAULT NULL,
  `potongan` bigint DEFAULT NULL,
  `penyesuaian` bigint DEFAULT NULL,
  `total` bigint DEFAULT NULL,
  `by` int DEFAULT NULL,
  `pid` int DEFAULT NULL,
  `jp` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.gaji_karyawan_smp: ~0 rows (approximately)

-- Dumping structure for table sigap2.gaji_karyawan_tk
CREATE TABLE IF NOT EXISTS `gaji_karyawan_tk` (
  `id` int NOT NULL AUTO_INCREMENT,
  `datetime` datetime DEFAULT NULL,
  `pegawai` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `jabatan_id` int DEFAULT NULL,
  `jenjang_id` int DEFAULT NULL,
  `month` date DEFAULT NULL,
  `gapok` bigint DEFAULT NULL,
  `value_reward` bigint DEFAULT NULL,
  `value_inval` bigint DEFAULT NULL,
  `kehadiran` int DEFAULT NULL,
  `sub_total` bigint DEFAULT NULL,
  `potongan` bigint DEFAULT NULL,
  `penyesuaian` bigint DEFAULT NULL,
  `total` bigint DEFAULT NULL,
  `by` int DEFAULT NULL,
  `pid` int DEFAULT NULL,
  `jp` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.gaji_karyawan_tk: ~0 rows (approximately)

-- Dumping structure for table sigap2.gaji_pokok
CREATE TABLE IF NOT EXISTS `gaji_pokok` (
  `id` int NOT NULL AUTO_INCREMENT,
  `jenjang_id` int DEFAULT NULL,
  `lama_kerja` int DEFAULT NULL,
  `value` bigint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=310 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table sigap2.gaji_pokok: ~255 rows (approximately)
INSERT INTO `gaji_pokok` (`id`, `jenjang_id`, `lama_kerja`, `value`) VALUES
	(2, 4, 0, 1500),
	(3, 4, 1, 1500),
	(4, 4, 2, 2500),
	(5, 4, 3, 2500),
	(6, 4, 4, 2500),
	(7, 4, 5, 3000),
	(8, 4, 6, 3000),
	(9, 4, 7, 3000),
	(10, 4, 8, 3500),
	(11, 4, 9, 3500),
	(12, 4, 10, 3500),
	(13, 4, 11, 4000),
	(14, 4, 12, 4000),
	(15, 4, 13, 4000),
	(16, 4, 14, 4500),
	(17, 4, 15, 4500),
	(18, 4, 16, 4500),
	(19, 4, 17, 5000),
	(20, 4, 18, 5000),
	(21, 4, 19, 5000),
	(23, 4, 20, 5500),
	(24, 4, 21, 5500),
	(25, 4, 22, 5500),
	(26, 4, 23, 6000),
	(27, 4, 24, 6000),
	(28, 4, 25, 6000),
	(29, 4, 26, 6500),
	(30, 4, 27, 6500),
	(31, 4, 28, 6500),
	(32, 4, 29, 7000),
	(33, 4, 30, 7000),
	(34, 4, 31, 7000),
	(35, 4, 32, 7500),
	(36, 4, 33, 7500),
	(37, 4, 34, 7500),
	(38, 4, 35, 8000),
	(39, 4, 36, 8000),
	(40, 4, 37, 8000),
	(41, 4, 38, 8500),
	(42, 4, 39, 8500),
	(43, 4, 40, 8500),
	(44, 4, 41, 9000),
	(45, 4, 42, 9000),
	(46, 4, 43, 9000),
	(47, 4, 44, 9500),
	(48, 4, 45, 9500),
	(49, 4, 46, 9500),
	(50, 4, 47, 10000),
	(51, 4, 48, 10000),
	(52, 4, 49, 10000),
	(53, 4, 50, 10500),
	(106, 3, 0, 1500),
	(107, 3, 1, 1500),
	(108, 3, 2, 2500),
	(109, 3, 3, 2500),
	(110, 3, 4, 2500),
	(111, 3, 5, 3000),
	(112, 3, 6, 3000),
	(113, 3, 7, 3000),
	(114, 3, 8, 3500),
	(115, 3, 9, 3500),
	(116, 3, 10, 3500),
	(117, 3, 11, 4000),
	(118, 3, 12, 4000),
	(119, 3, 13, 4000),
	(120, 3, 14, 4500),
	(121, 3, 15, 4500),
	(122, 3, 16, 4500),
	(123, 3, 17, 5000),
	(124, 3, 18, 5000),
	(125, 3, 19, 5000),
	(126, 3, 20, 5500),
	(127, 3, 21, 5500),
	(128, 3, 22, 5500),
	(129, 3, 23, 6000),
	(130, 3, 24, 6000),
	(131, 3, 25, 6000),
	(132, 3, 26, 6500),
	(133, 3, 27, 6500),
	(134, 3, 28, 6500),
	(135, 3, 29, 7000),
	(136, 3, 30, 7000),
	(137, 3, 31, 7000),
	(138, 3, 32, 7500),
	(139, 3, 33, 7500),
	(140, 3, 34, 7500),
	(141, 3, 35, 8000),
	(142, 3, 36, 8000),
	(143, 3, 37, 8000),
	(144, 3, 38, 8500),
	(145, 3, 39, 8500),
	(146, 3, 40, 8500),
	(147, 3, 41, 9000),
	(148, 3, 42, 9000),
	(149, 3, 43, 9000),
	(150, 3, 44, 9500),
	(151, 3, 45, 9500),
	(152, 3, 46, 9500),
	(153, 3, 47, 10000),
	(154, 3, 48, 10000),
	(155, 3, 49, 10000),
	(156, 3, 50, 10500),
	(157, 2, 0, 1500),
	(158, 2, 1, 1500),
	(159, 2, 2, 2500),
	(160, 2, 3, 2500),
	(161, 2, 4, 2500),
	(162, 2, 5, 3000),
	(163, 2, 6, 3000),
	(164, 2, 7, 3000),
	(165, 2, 8, 3500),
	(166, 2, 9, 3500),
	(167, 2, 10, 3500),
	(168, 2, 11, 4000),
	(169, 2, 12, 4000),
	(170, 2, 13, 4000),
	(171, 2, 14, 4500),
	(172, 2, 15, 4500),
	(173, 2, 16, 4500),
	(174, 2, 17, 5000),
	(175, 2, 18, 5000),
	(176, 2, 19, 5000),
	(177, 2, 20, 5500),
	(178, 2, 21, 5500),
	(179, 2, 22, 5500),
	(180, 2, 23, 6000),
	(181, 2, 24, 6000),
	(182, 2, 25, 6000),
	(183, 2, 26, 6500),
	(184, 2, 27, 6500),
	(185, 2, 28, 6500),
	(186, 2, 29, 7000),
	(187, 2, 30, 7000),
	(188, 2, 31, 7000),
	(189, 2, 32, 7500),
	(190, 2, 33, 7500),
	(191, 2, 34, 7500),
	(192, 2, 35, 8000),
	(193, 2, 36, 8000),
	(194, 2, 37, 8000),
	(195, 2, 38, 8500),
	(196, 2, 39, 8500),
	(197, 2, 40, 8500),
	(198, 2, 41, 9000),
	(199, 2, 42, 9000),
	(200, 2, 43, 9000),
	(201, 2, 44, 9500),
	(202, 2, 45, 9500),
	(203, 2, 46, 9500),
	(204, 2, 47, 10000),
	(205, 2, 48, 10000),
	(206, 2, 49, 10000),
	(207, 2, 50, 10500),
	(208, 5, 0, 1500),
	(209, 5, 1, 1500),
	(210, 5, 2, 2500),
	(211, 5, 3, 2500),
	(212, 5, 4, 2500),
	(213, 5, 5, 3000),
	(214, 5, 6, 3000),
	(215, 5, 7, 3000),
	(216, 5, 8, 3500),
	(217, 5, 9, 3500),
	(218, 5, 10, 3500),
	(219, 5, 11, 4000),
	(220, 5, 12, 4000),
	(221, 5, 13, 4000),
	(222, 5, 14, 4500),
	(223, 5, 15, 4500),
	(224, 5, 16, 4500),
	(225, 5, 17, 5000),
	(226, 5, 18, 5000),
	(227, 5, 19, 5000),
	(228, 5, 20, 5500),
	(229, 5, 21, 5500),
	(230, 5, 22, 5500),
	(231, 5, 23, 6000),
	(232, 5, 24, 6000),
	(233, 5, 25, 6000),
	(234, 5, 26, 6500),
	(235, 5, 27, 6500),
	(236, 5, 28, 6500),
	(237, 5, 29, 7000),
	(238, 5, 30, 7000),
	(239, 5, 31, 7000),
	(240, 5, 32, 7500),
	(241, 5, 33, 7500),
	(242, 5, 34, 7500),
	(243, 5, 35, 8000),
	(244, 5, 36, 8000),
	(245, 5, 37, 8000),
	(246, 5, 38, 8500),
	(247, 5, 39, 8500),
	(248, 5, 40, 8500),
	(249, 5, 41, 9000),
	(250, 5, 42, 9000),
	(251, 5, 43, 9000),
	(252, 5, 44, 9500),
	(253, 5, 45, 9500),
	(254, 5, 46, 9500),
	(255, 5, 47, 10000),
	(256, 5, 48, 10000),
	(257, 5, 49, 10000),
	(258, 5, 50, 10500),
	(259, 1, 0, 1500),
	(260, 1, 1, 1500),
	(261, 1, 2, 2500),
	(262, 1, 3, 2500),
	(263, 1, 4, 2500),
	(264, 1, 5, 3000),
	(265, 1, 6, 3000),
	(266, 1, 7, 3000),
	(267, 1, 8, 3500),
	(268, 1, 9, 3500),
	(269, 1, 10, 3500),
	(270, 1, 11, 4000),
	(271, 1, 12, 4000),
	(272, 1, 13, 4000),
	(273, 1, 14, 4500),
	(274, 1, 15, 4500),
	(275, 1, 16, 4500),
	(276, 1, 17, 5000),
	(277, 1, 18, 5000),
	(278, 1, 19, 5000),
	(279, 1, 20, 5500),
	(280, 1, 21, 5500),
	(281, 1, 22, 5500),
	(282, 1, 23, 6000),
	(283, 1, 24, 6000),
	(284, 1, 25, 6000),
	(285, 1, 26, 6500),
	(286, 1, 27, 6500),
	(287, 1, 28, 6500),
	(288, 1, 29, 7000),
	(289, 1, 30, 7000),
	(290, 1, 31, 7000),
	(291, 1, 32, 7500),
	(292, 1, 33, 7500),
	(293, 1, 34, 7500),
	(294, 1, 35, 8000),
	(295, 1, 36, 8000),
	(296, 1, 37, 8000),
	(297, 1, 38, 8500),
	(298, 1, 39, 8500),
	(299, 1, 40, 8500),
	(300, 1, 41, 9000),
	(301, 1, 42, 9000),
	(302, 1, 43, 9000),
	(303, 1, 44, 9500),
	(304, 1, 45, 9500),
	(305, 1, 46, 9500),
	(306, 1, 47, 10000),
	(307, 1, 48, 10000),
	(308, 1, 49, 10000),
	(309, 1, 50, 10500);

-- Dumping structure for table sigap2.gaji_pokok_tu
CREATE TABLE IF NOT EXISTS `gaji_pokok_tu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `jenjang_id` int DEFAULT NULL,
  `lama_kerja` int DEFAULT NULL,
  `value` bigint DEFAULT NULL,
  `ijazah` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.gaji_pokok_tu: ~30 rows (approximately)
INSERT INTO `gaji_pokok_tu` (`id`, `jenjang_id`, `lama_kerja`, `value`, `ijazah`) VALUES
	(54, 3, 0, 65000, 1),
	(55, 3, 0, 80000, 2),
	(56, 3, 3, 77500, 1),
	(57, 3, 3, 92500, 2),
	(58, 3, 6, 90000, 1),
	(59, 3, 6, 105000, 2),
	(60, 3, 9, 102500, 1),
	(61, 3, 9, 117500, 2),
	(62, 3, 12, 115000, 1),
	(63, 3, 12, 130000, 2),
	(64, 3, 15, 127500, 1),
	(65, 3, 15, 142500, 2),
	(66, 3, 18, 140000, 1),
	(67, 3, 18, 155000, 2),
	(68, 3, 21, 152500, 1),
	(69, 3, 21, 167500, 2),
	(70, 3, 24, 165000, 1),
	(71, 3, 24, 180000, 2),
	(72, 3, 27, 177500, 1),
	(73, 3, 27, 192500, 2),
	(74, 3, 30, 190000, 1),
	(75, 3, 30, 205000, 2),
	(76, 3, 33, 202500, 1),
	(77, 3, 33, 217500, 2),
	(78, 3, 36, 201500, 1),
	(79, 3, 36, 230000, 2),
	(80, 3, 39, 227500, 1),
	(81, 3, 39, 242500, 2),
	(82, 3, 42, 240000, 1),
	(83, 3, 42, 255000, 2);

-- Dumping structure for table sigap2.gaji_sma
CREATE TABLE IF NOT EXISTS `gaji_sma` (
  `id` int NOT NULL AUTO_INCREMENT,
  `datetime` datetime DEFAULT NULL,
  `month` date DEFAULT NULL,
  `pegawai` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `jenjang_id` int DEFAULT NULL,
  `jabatan_id` int DEFAULT NULL,
  `lembur` int DEFAULT NULL,
  `value_lembur` bigint DEFAULT NULL,
  `kehadiran` int DEFAULT NULL,
  `gapok` bigint DEFAULT NULL,
  `value_reward` bigint DEFAULT NULL,
  `value_inval` bigint DEFAULT NULL,
  `piket_count` int DEFAULT NULL,
  `value_piket` bigint DEFAULT NULL,
  `tugastambahan` bigint DEFAULT NULL,
  `tj_jabatan` bigint DEFAULT NULL,
  `sub_total` bigint DEFAULT NULL,
  `potongan` bigint DEFAULT NULL,
  `penyesuaian` bigint DEFAULT NULL,
  `total` bigint DEFAULT NULL,
  `by` int DEFAULT NULL,
  `pid` int DEFAULT NULL,
  `jp` int DEFAULT NULL,
  `type` int DEFAULT NULL,
  `jenis_guru` int DEFAULT NULL,
  `tambahan` int DEFAULT NULL,
  `value_kehadiran` int DEFAULT NULL,
  `periode` int DEFAULT NULL,
  `tunjangan_periode` bigint DEFAULT NULL,
  `total_gapok` bigint DEFAULT NULL,
  `lama_kerja` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=131 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.gaji_sma: ~26 rows (approximately)
INSERT INTO `gaji_sma` (`id`, `datetime`, `month`, `pegawai`, `jenjang_id`, `jabatan_id`, `lembur`, `value_lembur`, `kehadiran`, `gapok`, `value_reward`, `value_inval`, `piket_count`, `value_piket`, `tugastambahan`, `tj_jabatan`, `sub_total`, `potongan`, `penyesuaian`, `total`, `by`, `pid`, `jp`, `type`, `jenis_guru`, `tambahan`, `value_kehadiran`, `periode`, `tunjangan_periode`, `total_gapok`, `lama_kerja`) VALUES
	(105, NULL, NULL, '10230', 4, 5, NULL, 30000, NULL, NULL, 50000, 25000, NULL, 8250, 125000, NULL, 200000, NULL, NULL, 200000, NULL, 16, NULL, 1, 2, 2, 66000, 7, NULL, NULL, NULL),
	(106, NULL, NULL, '10230', 4, 5, NULL, 30000, NULL, NULL, 50000, 25000, NULL, 8250, 125000, NULL, 200000, NULL, NULL, 200000, NULL, 16, NULL, 1, 2, 2, 66000, NULL, NULL, NULL, NULL),
	(107, NULL, NULL, '10230', 4, 5, NULL, 30000, NULL, NULL, 50000, 25000, NULL, 8250, 125000, NULL, 200000, NULL, NULL, 200000, NULL, 16, NULL, 1, 2, 2, 66000, 2, NULL, NULL, NULL),
	(108, NULL, NULL, '10230', 4, 5, NULL, 30000, NULL, NULL, 50000, 25000, NULL, 8250, 125000, NULL, 200000, NULL, NULL, 200000, NULL, 16, NULL, 1, 2, 2, 66000, 1, NULL, NULL, NULL),
	(109, NULL, NULL, '10230', 4, 5, NULL, 30000, NULL, NULL, 50000, 25000, NULL, 8250, 125000, NULL, 200000, NULL, NULL, 200000, NULL, 16, NULL, 1, 2, 2, 66000, 7, NULL, NULL, NULL),
	(110, NULL, NULL, '10230', 4, 5, NULL, 30000, NULL, NULL, 50000, 25000, NULL, 8250, 125000, NULL, 200000, NULL, NULL, 200000, NULL, 16, NULL, 1, 2, 2, 66000, 4, NULL, NULL, NULL),
	(111, NULL, NULL, '10230', 4, 5, NULL, 30000, NULL, NULL, 50000, 25000, NULL, 8250, 125000, NULL, 200000, NULL, NULL, 200000, NULL, 16, NULL, 1, 2, 2, 66000, NULL, 382500, NULL, NULL),
	(112, NULL, NULL, '10230', 4, 5, NULL, 30000, NULL, NULL, 50000, 25000, NULL, 7000, 125000, NULL, 200000, NULL, NULL, 200000, NULL, 17, NULL, 1, 1, 2, 56000, NULL, NULL, NULL, NULL),
	(113, NULL, NULL, '10230', 4, 5, NULL, 30000, NULL, NULL, 50000, 25000, NULL, 7000, 125000, NULL, 200000, NULL, NULL, 200000, NULL, 17, NULL, 1, 1, 2, 56000, NULL, NULL, NULL, NULL),
	(114, NULL, NULL, '10230', 4, 5, NULL, 30000, NULL, NULL, 50000, 25000, NULL, 7000, 125000, NULL, 200000, NULL, NULL, 200000, NULL, 17, NULL, 1, 1, 2, 56000, 7, 697500, NULL, NULL),
	(115, NULL, NULL, '10230', 4, 5, NULL, 30000, NULL, NULL, 50000, 25000, NULL, 7000, 125000, NULL, 200000, 220000, NULL, -20000, NULL, 18, NULL, 1, 1, 2, 56000, NULL, NULL, NULL, NULL),
	(116, NULL, NULL, '10230', 4, 5, NULL, 30000, NULL, NULL, 50000, 25000, NULL, 7000, 125000, NULL, 200000, 220000, NULL, -20000, NULL, 18, NULL, 1, 1, 2, 56000, NULL, NULL, NULL, NULL),
	(117, NULL, NULL, '10230', 4, 5, NULL, 30000, NULL, NULL, 50000, 25000, NULL, 7000, 125000, NULL, 200000, 220000, NULL, -20000, NULL, 19, NULL, 1, 1, 2, 56000, 3, 487000, NULL, 2),
	(118, NULL, NULL, '10230', 4, 5, NULL, 30000, NULL, NULL, 50000, 25000, NULL, 7000, 125000, NULL, 200000, 220000, NULL, -20000, NULL, 19, NULL, 1, 1, 2, 56000, 3, 487000, NULL, 2),
	(119, NULL, NULL, '10230', 4, 5, NULL, 30000, NULL, NULL, 50000, 25000, NULL, 7000, 125000, NULL, 200000, 220000, NULL, -20000, NULL, 19, NULL, 1, 1, 2, 56000, 3, 487000, NULL, 2),
	(120, NULL, NULL, '10230', 4, 5, NULL, 30000, NULL, NULL, 50000, 25000, NULL, 7000, 125000, NULL, 200000, 220000, NULL, -20000, NULL, 19, NULL, 1, 1, 2, 56000, 3, 487000, NULL, 2),
	(121, NULL, NULL, '10230', 4, 5, NULL, 30000, NULL, NULL, 50000, 25000, NULL, 7000, 125000, NULL, 200000, 220000, NULL, -20000, NULL, 19, NULL, 1, 1, 2, 56000, 3, 487000, NULL, 2),
	(122, NULL, NULL, '10230', 4, 5, NULL, 30000, NULL, NULL, 50000, 25000, NULL, 7000, 125000, NULL, 200000, 220000, NULL, -20000, NULL, 19, NULL, 1, 1, 2, 56000, 3, 487000, NULL, 2),
	(123, NULL, NULL, '10230', 4, 5, NULL, 30000, NULL, NULL, 50000, 25000, NULL, 7000, 125000, NULL, 200000, 220000, NULL, -20000, NULL, 19, NULL, 1, 1, 2, 56000, 3, 487000, NULL, 2),
	(124, NULL, NULL, '10230', 4, 5, NULL, 30000, NULL, 1500, 50000, 25000, NULL, 7000, 125000, NULL, 200000, 220000, NULL, -20000, NULL, 19, NULL, 1, 1, 2, 56000, 3, 487000, 0, 2),
	(125, NULL, NULL, '10230', 4, 5, NULL, 30000, NULL, 1500, 50000, 25000, NULL, 7000, 125000, NULL, 200000, 220000, NULL, -20000, NULL, 19, NULL, 1, 1, 2, 56000, 3, 487000, 0, 2),
	(126, NULL, NULL, '10230', 4, 5, 2, 30000, 23, 1500, 50000, 25000, NULL, 7000, 125000, NULL, 1566000, 220000, NULL, 1346000, NULL, 19, 12, 1, 1, 2, 56000, 3, 487000, 18000, 2),
	(127, NULL, NULL, '10230', 4, 5, NULL, 30000, NULL, 1500, 50000, 25000, NULL, 7000, 125000, NULL, 200000, 220000, NULL, -20000, NULL, 20, NULL, 1, 1, 2, 56000, 3, 487000, 0, 2),
	(128, NULL, NULL, '10230', 4, 5, NULL, 30000, NULL, 1500, 50000, 25000, NULL, 7000, 125000, NULL, 200000, 220000, NULL, -20000, NULL, 20, NULL, 1, 1, 2, 56000, 3, 487000, 0, 2),
	(129, NULL, NULL, '10230', 4, 5, NULL, 30000, NULL, 1500, 50000, 25000, NULL, 7000, 125000, NULL, 200000, 220000, NULL, -20000, NULL, 20, NULL, 1, 1, 2, 56000, 3, 487000, 0, 2),
	(130, NULL, NULL, '10230', 4, 5, 2, 30000, 2, 1500, 50000, 25000, 2, 7000, 125000, NULL, 876000, 220000, 20000, 676000, NULL, 20, 2, 1, 1, 2, 56000, 3, 487000, 3000, 2);

-- Dumping structure for table sigap2.gaji_smk
CREATE TABLE IF NOT EXISTS `gaji_smk` (
  `id` int NOT NULL AUTO_INCREMENT,
  `datetime` datetime DEFAULT NULL,
  `month` date DEFAULT NULL,
  `pegawai` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `jenjang_id` int DEFAULT NULL,
  `jabatan_id` int DEFAULT NULL,
  `lembur` int DEFAULT NULL,
  `value_lembur` bigint DEFAULT NULL,
  `kehadiran` int DEFAULT NULL,
  `gapok` bigint DEFAULT NULL,
  `value_reward` bigint DEFAULT NULL,
  `value_inval` bigint DEFAULT NULL,
  `piket_count` int DEFAULT NULL,
  `value_piket` bigint DEFAULT NULL,
  `tugastambahan` bigint DEFAULT NULL,
  `tj_jabatan` bigint DEFAULT NULL,
  `sub_total` bigint DEFAULT NULL,
  `potongan` bigint DEFAULT NULL,
  `penyesuaian` bigint DEFAULT NULL,
  `total` bigint DEFAULT NULL,
  `by` int DEFAULT NULL,
  `pid` int DEFAULT NULL,
  `jp` int DEFAULT NULL,
  `type` int DEFAULT NULL,
  `jenis_guru` int DEFAULT NULL,
  `tambahan` int DEFAULT NULL,
  `value_kehadiran` bigint DEFAULT NULL,
  `periode` int DEFAULT NULL,
  `tunjangan_periode` bigint DEFAULT NULL,
  `total_gapok` bigint DEFAULT NULL,
  `lama_kerja` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.gaji_smk: ~0 rows (approximately)

-- Dumping structure for table sigap2.gaji_smp
CREATE TABLE IF NOT EXISTS `gaji_smp` (
  `id` int NOT NULL AUTO_INCREMENT,
  `datetime` datetime DEFAULT NULL,
  `month` date DEFAULT NULL,
  `pegawai` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `jenjang_id` int DEFAULT NULL,
  `jabatan_id` int DEFAULT NULL,
  `lembur` int DEFAULT NULL,
  `value_lembur` bigint DEFAULT NULL,
  `kehadiran` int DEFAULT NULL,
  `gapok` bigint DEFAULT NULL,
  `value_reward` bigint DEFAULT NULL,
  `value_inval` bigint DEFAULT NULL,
  `piket_count` int DEFAULT NULL,
  `value_piket` bigint DEFAULT NULL,
  `tugastambahan` bigint DEFAULT NULL,
  `tj_jabatan` bigint DEFAULT NULL,
  `sub_total` bigint DEFAULT NULL,
  `potongan` bigint DEFAULT NULL,
  `penyesuaian` bigint DEFAULT NULL,
  `total` bigint DEFAULT NULL,
  `by` int DEFAULT NULL,
  `pid` int DEFAULT NULL,
  `jp` int DEFAULT NULL,
  `type` int DEFAULT NULL,
  `jenis_guru` int DEFAULT NULL,
  `tambahan` int DEFAULT NULL,
  `value_kehadiran` bigint DEFAULT NULL,
  `periode` int DEFAULT NULL,
  `tunjangan_periode` bigint DEFAULT NULL,
  `total_gapok` bigint DEFAULT NULL,
  `lama_kerja` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.gaji_smp: ~0 rows (approximately)

-- Dumping structure for table sigap2.gaji_tk
CREATE TABLE IF NOT EXISTS `gaji_tk` (
  `id` int NOT NULL AUTO_INCREMENT,
  `datetime` datetime DEFAULT NULL,
  `month` date DEFAULT NULL,
  `pegawai` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `jenjang_id` int DEFAULT NULL,
  `jabatan_id` int DEFAULT NULL,
  `lembur` int DEFAULT NULL,
  `value_lembur` bigint DEFAULT NULL,
  `kehadiran` int DEFAULT NULL,
  `gapok` bigint DEFAULT NULL,
  `value_reward` bigint DEFAULT NULL,
  `value_inval` bigint DEFAULT NULL,
  `piket_count` int DEFAULT NULL,
  `value_piket` bigint DEFAULT NULL,
  `tugastambahan` bigint DEFAULT NULL,
  `tj_jabatan` bigint DEFAULT NULL,
  `sub_total` bigint DEFAULT NULL,
  `potongan` bigint DEFAULT NULL,
  `penyesuaian` bigint DEFAULT NULL,
  `total` bigint DEFAULT NULL,
  `by` int DEFAULT NULL,
  `pid` int DEFAULT NULL,
  `jp` int DEFAULT NULL,
  `type` int DEFAULT NULL,
  `jenis_guru` int DEFAULT NULL,
  `tambahan` int DEFAULT NULL,
  `value_kehadiran` bigint DEFAULT NULL,
  `periode` int DEFAULT NULL,
  `tunjangan_periode` bigint DEFAULT NULL,
  `total_gapok` bigint DEFAULT NULL,
  `lama_kerja` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.gaji_tk: ~0 rows (approximately)

-- Dumping structure for table sigap2.gaji_tu_sd
CREATE TABLE IF NOT EXISTS `gaji_tu_sd` (
  `id` int NOT NULL AUTO_INCREMENT,
  `datetime` datetime DEFAULT NULL,
  `pegawai` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `jenjang_id` int DEFAULT NULL,
  `jabatan_id` int DEFAULT NULL,
  `month` date DEFAULT NULL,
  `gapok` bigint DEFAULT NULL,
  `kehadiran` int DEFAULT NULL,
  `lembur` int DEFAULT NULL,
  `value_lembur` bigint DEFAULT NULL,
  `value_reward` bigint DEFAULT NULL,
  `value_inval` bigint DEFAULT NULL,
  `piket_count` int DEFAULT NULL,
  `value_piket` bigint DEFAULT NULL,
  `tugastambahan` bigint DEFAULT NULL,
  `tj_jabatan` bigint DEFAULT NULL,
  `potongan` bigint DEFAULT NULL,
  `sub_total` bigint DEFAULT NULL,
  `penyesuaian` bigint DEFAULT NULL,
  `total` bigint DEFAULT NULL,
  `by` int DEFAULT NULL,
  `pid` int DEFAULT NULL,
  `ijasah` int DEFAULT NULL,
  `tunjangan2` bigint DEFAULT NULL,
  `tambahan` int DEFAULT NULL,
  `type_jabatan` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.gaji_tu_sd: ~14 rows (approximately)
INSERT INTO `gaji_tu_sd` (`id`, `datetime`, `pegawai`, `jenjang_id`, `jabatan_id`, `month`, `gapok`, `kehadiran`, `lembur`, `value_lembur`, `value_reward`, `value_inval`, `piket_count`, `value_piket`, `tugastambahan`, `tj_jabatan`, `potongan`, `sub_total`, `penyesuaian`, `total`, `by`, `pid`, `ijasah`, `tunjangan2`, `tambahan`, `type_jabatan`) VALUES
	(58, '2022-12-23 03:49:10', 'farhan kebab', NULL, NULL, '2022-12-23', 40000, 23, 2, 42000, 30000, 10000, 2, 30000, 70000, 1500000, NULL, 2674000, NULL, 2674000, NULL, NULL, NULL, NULL, NULL, NULL),
	(59, '2022-12-23 03:54:03', 'farhan kebab', NULL, NULL, '2022-12-23', 40000, 23, 2, 42000, 30000, 10000, 5, 30000, 70000, 1500000, NULL, 2764000, NULL, 2764000, NULL, NULL, NULL, NULL, NULL, NULL),
	(60, '2022-12-23 03:56:10', 'YUNIARTI', NULL, NULL, '2022-12-23', 40000, 23, 2, 42000, 30000, 10000, NULL, 30000, 70000, 1500000, NULL, 2614000, NULL, 2614000, NULL, NULL, NULL, NULL, NULL, NULL),
	(61, '2022-12-23 03:57:13', 'YUNIARTI', NULL, NULL, '2022-12-23', 40000, NULL, 2, 42000, 30000, 10000, NULL, 30000, 70000, 1500000, NULL, 1694000, NULL, 1694000, NULL, NULL, NULL, NULL, NULL, NULL),
	(62, '2022-12-23 03:59:53', 'farhan kebab', NULL, NULL, '2022-12-23', 40000, NULL, 2, 42000, 30000, 10000, NULL, 30000, 70000, 1500000, 186000, 1694000, NULL, 1694000, NULL, NULL, NULL, NULL, NULL, NULL),
	(63, '2022-12-23 04:12:57', 'farhan kebab', NULL, NULL, '2022-12-23', 40000, NULL, 2, 42000, 30000, 10000, NULL, 30000, 70000, 1500000, NULL, 1694000, NULL, 1694000, NULL, NULL, NULL, NULL, NULL, NULL),
	(64, '2022-12-23 07:04:21', 'farhan kebab', NULL, NULL, '2022-12-23', 40000, 18, 2, 42000, 30000, 10000, 3, 30000, 70000, 1500000, NULL, 2504000, NULL, 2504000, NULL, NULL, NULL, NULL, NULL, NULL),
	(65, '2022-12-28 04:52:00', '', 1, 2, '2022-12-28', NULL, 12, 2, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(66, '2022-12-28 04:57:26', '', 1, 2, '2022-12-28', NULL, 12, 2, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(67, '2022-12-28 04:58:59', '110123', 1, 2, '2022-12-29', NULL, 12, 2, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(68, '2022-12-28 05:07:35', '110123', 1, 2, '2022-12-28', 80000, 23, 2, 40000, 40000, 10000, 2, 30000, 70000, NULL, 186000, 2040000, NULL, 1854000, NULL, NULL, NULL, NULL, NULL, NULL),
	(69, '2022-12-28 06:19:09', '110123', 1, 2, '2022-12-28', 40000, 2, 2, 42000, 30000, 10000, 2, 30000, 70000, 1500000, 220000, 1834000, NULL, 1834000, NULL, NULL, NULL, NULL, NULL, NULL),
	(70, '2022-12-28 06:19:58', '110123', 1, 2, '2022-12-31', 40000, 23, 2, 42000, 30000, 10000, 23, 30000, 70000, 1500000, 220000, 3304000, NULL, 3304000, NULL, NULL, NULL, NULL, NULL, NULL),
	(71, NULL, '102321', 2, 6, NULL, NULL, NULL, NULL, 30000, 200000, 35000, NULL, 25000, 250000, NULL, NULL, 515000, NULL, 515000, NULL, 2, NULL, NULL, NULL, NULL);

-- Dumping structure for table sigap2.gaji_tu_sma
CREATE TABLE IF NOT EXISTS `gaji_tu_sma` (
  `id` int NOT NULL AUTO_INCREMENT,
  `datetime` datetime DEFAULT NULL,
  `pegawai` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `jenjang_id` int DEFAULT NULL,
  `jabatan_id` int DEFAULT NULL,
  `month` date DEFAULT NULL,
  `gapok` bigint DEFAULT NULL,
  `kehadiran` int DEFAULT NULL,
  `lembur` int DEFAULT NULL,
  `value_lembur` bigint DEFAULT NULL,
  `value_reward` bigint DEFAULT NULL,
  `value_inval` bigint DEFAULT NULL,
  `piket_count` int DEFAULT NULL,
  `value_piket` bigint DEFAULT NULL,
  `tugastambahan` bigint DEFAULT NULL,
  `tj_jabatan` bigint DEFAULT NULL,
  `potongan` bigint DEFAULT NULL,
  `sub_total` bigint DEFAULT NULL,
  `penyesuaian` bigint DEFAULT NULL,
  `total` bigint DEFAULT NULL,
  `by` int DEFAULT NULL,
  `pid` int DEFAULT NULL,
  `tunjangan2` bigint DEFAULT NULL,
  `tambahan` int DEFAULT NULL,
  `type_jabatan` int DEFAULT NULL,
  `ijasah` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.gaji_tu_sma: ~0 rows (approximately)

-- Dumping structure for table sigap2.gaji_tu_smk
CREATE TABLE IF NOT EXISTS `gaji_tu_smk` (
  `id` int NOT NULL AUTO_INCREMENT,
  `datetime` datetime DEFAULT NULL,
  `pegawai` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `jenjang_id` int DEFAULT NULL,
  `jabatan_id` int DEFAULT NULL,
  `month` date DEFAULT NULL,
  `gapok` bigint DEFAULT NULL,
  `kehadiran` int DEFAULT NULL,
  `lembur` int DEFAULT NULL,
  `value_lembur` bigint DEFAULT NULL,
  `value_reward` bigint DEFAULT NULL,
  `value_inval` bigint DEFAULT NULL,
  `piket_count` int DEFAULT NULL,
  `value_piket` bigint DEFAULT NULL,
  `tugastambahan` bigint DEFAULT NULL,
  `tj_jabatan` bigint DEFAULT NULL,
  `potongan` bigint DEFAULT NULL,
  `sub_total` bigint DEFAULT NULL,
  `penyesuaian` bigint DEFAULT NULL,
  `total` bigint DEFAULT NULL,
  `by` int DEFAULT NULL,
  `pid` int DEFAULT NULL,
  `jp` int DEFAULT NULL,
  `ijasah` int DEFAULT NULL,
  `tunjangan2` bigint DEFAULT NULL,
  `tambahan` int DEFAULT NULL,
  `type_jabatan` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.gaji_tu_smk: ~0 rows (approximately)

-- Dumping structure for table sigap2.gaji_tu_smp
CREATE TABLE IF NOT EXISTS `gaji_tu_smp` (
  `id` int NOT NULL AUTO_INCREMENT,
  `datetime` datetime DEFAULT NULL,
  `pegawai` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `jenjang_id` int DEFAULT NULL,
  `jabatan_id` int DEFAULT NULL,
  `month` date DEFAULT NULL,
  `gapok` bigint DEFAULT NULL,
  `kehadiran` int DEFAULT NULL,
  `lembur` int DEFAULT NULL,
  `value_lembur` bigint DEFAULT NULL,
  `value_reward` bigint DEFAULT NULL,
  `value_inval` bigint DEFAULT NULL,
  `piket_count` int DEFAULT NULL,
  `value_piket` bigint DEFAULT NULL,
  `tugastambahan` bigint DEFAULT NULL,
  `tj_jabatan` bigint DEFAULT NULL,
  `potongan` bigint DEFAULT NULL,
  `sub_total` bigint DEFAULT NULL,
  `penyesuaian` bigint DEFAULT NULL,
  `total` bigint DEFAULT NULL,
  `by` int DEFAULT NULL,
  `pid` int DEFAULT NULL,
  `tunjangan2` bigint DEFAULT NULL,
  `tambahan` int DEFAULT NULL,
  `type_jabatan` int DEFAULT NULL,
  `ijasah` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.gaji_tu_smp: ~0 rows (approximately)

-- Dumping structure for table sigap2.gaji_tu_tk
CREATE TABLE IF NOT EXISTS `gaji_tu_tk` (
  `id` int NOT NULL AUTO_INCREMENT,
  `datetime` datetime DEFAULT NULL,
  `pegawai` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `jenjang_id` int DEFAULT NULL,
  `jabatan_id` int DEFAULT NULL,
  `month` date DEFAULT NULL,
  `gapok` bigint DEFAULT NULL,
  `kehadiran` int DEFAULT NULL,
  `lembur` int DEFAULT NULL,
  `value_lembur` bigint DEFAULT NULL,
  `value_reward` bigint DEFAULT NULL,
  `value_inval` bigint DEFAULT NULL,
  `piket_count` int DEFAULT NULL,
  `value_piket` bigint DEFAULT NULL,
  `tugastambahan` bigint DEFAULT NULL,
  `tj_jabatan` bigint DEFAULT NULL,
  `potongan` bigint DEFAULT NULL,
  `sub_total` bigint DEFAULT NULL,
  `penyesuaian` bigint DEFAULT NULL,
  `total` bigint DEFAULT NULL,
  `by` int DEFAULT NULL,
  `pid` int DEFAULT NULL,
  `tunjangan2` bigint DEFAULT NULL,
  `tambahan` int DEFAULT NULL,
  `type_jabatan` int DEFAULT NULL,
  `ijasah` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.gaji_tu_tk: ~0 rows (approximately)

-- Dumping structure for table sigap2.gender
CREATE TABLE IF NOT EXISTS `gender` (
  `id` int NOT NULL AUTO_INCREMENT,
  `gen` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table sigap2.gender: ~2 rows (approximately)
INSERT INTO `gender` (`id`, `gen`) VALUES
	(1, 'Pria'),
	(2, 'Wanita');

-- Dumping structure for table sigap2.hapus_barang
CREATE TABLE IF NOT EXISTS `hapus_barang` (
  `ID_Hapus` int NOT NULL AUTO_INCREMENT,
  `Kode_Barang` char(3) DEFAULT NULL,
  `Nama_Barang` varchar(20) DEFAULT NULL,
  `Keterangan` text,
  PRIMARY KEY (`ID_Hapus`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table sigap2.hapus_barang: 0 rows
/*!40000 ALTER TABLE `hapus_barang` DISABLE KEYS */;
/*!40000 ALTER TABLE `hapus_barang` ENABLE KEYS */;

-- Dumping structure for table sigap2.hapus_barangnew
CREATE TABLE IF NOT EXISTS `hapus_barangnew` (
  `id_hapus` int NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(50) DEFAULT NULL,
  `nama_barang` varchar(50) DEFAULT NULL,
  `keterangan` text,
  PRIMARY KEY (`id_hapus`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table sigap2.hapus_barangnew: ~0 rows (approximately)

-- Dumping structure for table sigap2.ijazah
CREATE TABLE IF NOT EXISTS `ijazah` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table sigap2.ijazah: ~2 rows (approximately)
INSERT INTO `ijazah` (`id`, `name`) VALUES
	(1, 'SMA'),
	(2, 'S1');

-- Dumping structure for table sigap2.ijin
CREATE TABLE IF NOT EXISTS `ijin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pegawai` int DEFAULT NULL,
  `tgl` datetime DEFAULT NULL,
  `tgl_ijin_awal` date DEFAULT NULL,
  `tgl_ijin_akhir` date DEFAULT NULL,
  `jenis` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `disetujui` varchar(5) DEFAULT NULL,
  `dokumen` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.ijin: ~0 rows (approximately)

-- Dumping structure for table sigap2.jabatan
CREATE TABLE IF NOT EXISTS `jabatan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_jabatan` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `c_date` datetime DEFAULT NULL,
  `u_date` datetime DEFAULT NULL,
  `c_by` int DEFAULT NULL,
  `u_by` int DEFAULT NULL,
  `aktif` tinyint DEFAULT NULL,
  `jenjang` int DEFAULT NULL,
  `type_jabatan` int DEFAULT NULL,
  `type_guru` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.jabatan: ~13 rows (approximately)
INSERT INTO `jabatan` (`id`, `nama_jabatan`, `keterangan`, `c_date`, `u_date`, `c_by`, `u_by`, `aktif`, `jenjang`, `type_jabatan`, `type_guru`) VALUES
	(5, 'Kepala Sekolah', 'baru', NULL, NULL, NULL, NULL, NULL, 4, 1, NULL),
	(6, 'TU', NULL, NULL, NULL, NULL, NULL, NULL, 4, 2, NULL),
	(7, 'Kepala TU', NULL, NULL, NULL, NULL, NULL, NULL, 4, 2, NULL),
	(8, 'Guru BK', NULL, NULL, NULL, NULL, NULL, NULL, 4, 1, NULL),
	(9, 'Guru Mapel', NULL, NULL, NULL, NULL, NULL, NULL, 4, 1, NULL),
	(10, 'Petugas Keamanan', NULL, NULL, NULL, NULL, NULL, NULL, 4, 3, NULL),
	(11, 'Petugas Kebersihan', NULL, NULL, NULL, NULL, NULL, NULL, 4, 3, NULL),
	(12, 'Teknisi Listrik', NULL, NULL, NULL, NULL, NULL, NULL, 4, 3, NULL),
	(13, 'Wali Kelas', 'baru', NULL, NULL, NULL, NULL, NULL, 4, 1, NULL),
	(14, 'Bendahara', NULL, NULL, NULL, NULL, NULL, NULL, 4, 1, NULL),
	(15, 'Wakil Kepala Sekolah', 'baru', NULL, NULL, NULL, NULL, NULL, 4, 1, NULL),
	(16, 'Pustakawan', 'baru', NULL, NULL, NULL, NULL, NULL, 4, 2, NULL),
	(17, 'Teknisi Komputer', 'baru', NULL, NULL, NULL, NULL, NULL, 4, 2, NULL);

-- Dumping structure for table sigap2.jenis_barang
CREATE TABLE IF NOT EXISTS `jenis_barang` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `aktif` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.jenis_barang: ~2 rows (approximately)
INSERT INTO `jenis_barang` (`id`, `nama`, `aktif`) VALUES
	(1, 'Elektronik', '1'),
	(2, 'Perlengkapan', '1');

-- Dumping structure for table sigap2.jenis_dinasluar
CREATE TABLE IF NOT EXISTS `jenis_dinasluar` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `aktif` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.jenis_dinasluar: ~0 rows (approximately)

-- Dumping structure for table sigap2.jenis_grup_berita
CREATE TABLE IF NOT EXISTS `jenis_grup_berita` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `aktif` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.jenis_grup_berita: ~0 rows (approximately)

-- Dumping structure for table sigap2.jenis_grup_ilmu
CREATE TABLE IF NOT EXISTS `jenis_grup_ilmu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `aktif` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.jenis_grup_ilmu: ~0 rows (approximately)

-- Dumping structure for table sigap2.jenis_ijin
CREATE TABLE IF NOT EXISTS `jenis_ijin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `aktif` varchar(255) DEFAULT NULL,
  `value` bigint DEFAULT NULL,
  `valueperjam` bigint DEFAULT NULL,
  `jabatan_id` int DEFAULT NULL,
  `jenjang_id` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.jenis_ijin: ~2 rows (approximately)
INSERT INTO `jenis_ijin` (`id`, `nama`, `aktif`, `value`, `valueperjam`, `jabatan_id`, `jenjang_id`) VALUES
	(1, 'izin', '1', 4200, 23000, 1, 1),
	(2, 'sakit', '1', 4000, 20000, 2, 1);

-- Dumping structure for table sigap2.jenis_jabatan
CREATE TABLE IF NOT EXISTS `jenis_jabatan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table sigap2.jenis_jabatan: ~3 rows (approximately)
INSERT INTO `jenis_jabatan` (`id`, `name`) VALUES
	(1, 'Pimpinan &amp; Guru'),
	(2, 'Tenaga Kependidikan'),
	(3, 'Karyawan');

-- Dumping structure for table sigap2.jenis_lembur
CREATE TABLE IF NOT EXISTS `jenis_lembur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `aktif` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.jenis_lembur: ~1 rows (approximately)
INSERT INTO `jenis_lembur` (`id`, `nama`, `aktif`) VALUES
	(1, 'Kejar deadline', '1');

-- Dumping structure for table sigap2.komentar
CREATE TABLE IF NOT EXISTS `komentar` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pid` int DEFAULT NULL,
  `komentar` varchar(500) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `pegawai` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.komentar: ~0 rows (approximately)

-- Dumping structure for table sigap2.lembur
CREATE TABLE IF NOT EXISTS `lembur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pegawai` int DEFAULT NULL,
  `proyek` varchar(255) DEFAULT NULL,
  `pm` int DEFAULT NULL,
  `tgl` datetime DEFAULT NULL,
  `tgl_awal_lembur` datetime DEFAULT NULL,
  `tgl_akhir_lembur` datetime DEFAULT NULL,
  `total_jam` smallint DEFAULT NULL,
  `jenis` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `disetujui` varchar(5) DEFAULT NULL,
  `dokumen` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.lembur: ~0 rows (approximately)

-- Dumping structure for table sigap2.mpendidikan
CREATE TABLE IF NOT EXISTS `mpendidikan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table sigap2.mpendidikan: ~10 rows (approximately)
INSERT INTO `mpendidikan` (`id`, `name`) VALUES
	(1, 'SD'),
	(2, 'SMP'),
	(3, 'SMA'),
	(4, 'SMK'),
	(5, 'D1'),
	(6, 'D2'),
	(7, 'D3'),
	(8, 'S1'),
	(9, 'S2'),
	(10, 'S3');

-- Dumping structure for table sigap2.m_karyawan_sd
CREATE TABLE IF NOT EXISTS `m_karyawan_sd` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tahun` smallint DEFAULT NULL,
  `bulan` int DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `createby` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.m_karyawan_sd: ~0 rows (approximately)

-- Dumping structure for table sigap2.m_karyawan_sma
CREATE TABLE IF NOT EXISTS `m_karyawan_sma` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tahun` smallint DEFAULT NULL,
  `bulan` int DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `createby` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.m_karyawan_sma: ~0 rows (approximately)

-- Dumping structure for table sigap2.m_karyawan_smk
CREATE TABLE IF NOT EXISTS `m_karyawan_smk` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tahun` smallint DEFAULT NULL,
  `bulan` int DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `createby` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.m_karyawan_smk: ~1 rows (approximately)
INSERT INTO `m_karyawan_smk` (`id`, `tahun`, `bulan`, `datetime`, `createby`) VALUES
	(2, 2023, 2, '2023-01-04 04:04:06', 2);

-- Dumping structure for table sigap2.m_karyawan_smp
CREATE TABLE IF NOT EXISTS `m_karyawan_smp` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tahun` smallint DEFAULT NULL,
  `bulan` int DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `createby` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.m_karyawan_smp: ~0 rows (approximately)

-- Dumping structure for table sigap2.m_karyawan_tk
CREATE TABLE IF NOT EXISTS `m_karyawan_tk` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tahun` smallint DEFAULT NULL,
  `bulan` int DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `createby` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.m_karyawan_tk: ~0 rows (approximately)

-- Dumping structure for table sigap2.m_kehadiran
CREATE TABLE IF NOT EXISTS `m_kehadiran` (
  `id` int NOT NULL AUTO_INCREMENT,
  `jenjang` int DEFAULT NULL,
  `jenis_jabatan` int DEFAULT NULL,
  `sertif` int DEFAULT NULL,
  `value` bigint DEFAULT NULL,
  `jabatan` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table sigap2.m_kehadiran: ~6 rows (approximately)
INSERT INTO `m_kehadiran` (`id`, `jenjang`, `jenis_jabatan`, `sertif`, `value`, `jabatan`) VALUES
	(1, 4, 1, 1, 56000, NULL),
	(2, 4, 1, 2, 66000, NULL),
	(3, 4, 2, NULL, 54000, NULL),
	(4, 4, 3, NULL, 60000, 10),
	(5, 4, 3, NULL, 60000, 11),
	(6, 4, 3, NULL, 75000, 12);

-- Dumping structure for table sigap2.m_piket
CREATE TABLE IF NOT EXISTS `m_piket` (
  `id` int NOT NULL AUTO_INCREMENT,
  `jenjang` int DEFAULT NULL,
  `type_jabatan` int DEFAULT NULL,
  `jenis_sertif` int DEFAULT NULL,
  `value` bigint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table sigap2.m_piket: ~10 rows (approximately)
INSERT INTO `m_piket` (`id`, `jenjang`, `type_jabatan`, `jenis_sertif`, `value`) VALUES
	(1, 4, 1, 1, 7000),
	(2, 4, 1, 2, 8250),
	(3, 5, 1, 1, 7000),
	(4, 5, 1, 2, 8250),
	(5, 1, 1, 1, 7000),
	(6, 1, 1, 2, 8250),
	(7, 2, 1, 1, 7000),
	(8, 2, 1, 2, 8250),
	(9, 3, 1, 1, 7000),
	(10, 3, 1, 2, 8250);

-- Dumping structure for table sigap2.m_pulangcepat
CREATE TABLE IF NOT EXISTS `m_pulangcepat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `jenjang_id` int DEFAULT NULL,
  `jabatan_id` int DEFAULT NULL,
  `perjam` bigint DEFAULT NULL,
  `perhari` bigint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table sigap2.m_pulangcepat: ~2 rows (approximately)
INSERT INTO `m_pulangcepat` (`id`, `jenjang_id`, `jabatan_id`, `perjam`, `perhari`) VALUES
	(1, 1, 1, 7000, 20000),
	(2, 1, 2, 3000, 18000);

-- Dumping structure for table sigap2.m_sakit
CREATE TABLE IF NOT EXISTS `m_sakit` (
  `id` int NOT NULL AUTO_INCREMENT,
  `jenjang_id` int DEFAULT NULL,
  `jabatan` int DEFAULT NULL,
  `perhari` bigint DEFAULT NULL,
  `perjam` bigint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table sigap2.m_sakit: ~2 rows (approximately)
INSERT INTO `m_sakit` (`id`, `jenjang_id`, `jabatan`, `perhari`, `perjam`) VALUES
	(1, 1, 1, 23000, 4000),
	(2, 1, 2, 27000, 7000);

-- Dumping structure for table sigap2.m_sd
CREATE TABLE IF NOT EXISTS `m_sd` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tahun` smallint DEFAULT NULL,
  `bulan` int DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `createby` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.m_sd: ~8 rows (approximately)
INSERT INTO `m_sd` (`id`, `tahun`, `bulan`, `datetime`, `createby`) VALUES
	(2, 2023, 1, '2023-01-04 09:30:16', -1),
	(3, 2023, 3, '2023-01-04 10:05:53', -1),
	(4, 2023, 3, '2023-01-04 10:10:19', -1),
	(5, 2023, 12, '2023-01-04 10:12:51', -1),
	(6, 2023, 8, '2023-01-04 10:14:06', 2),
	(7, 2023, 5, '2023-01-04 10:15:31', 3),
	(8, NULL, NULL, '2023-01-04 10:32:39', NULL),
	(10, 2024, 1, '2023-01-04 11:35:08', -1);

-- Dumping structure for table sigap2.m_sma
CREATE TABLE IF NOT EXISTS `m_sma` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tahun` smallint DEFAULT NULL,
  `bulan` int DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `createby` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.m_sma: ~19 rows (approximately)
INSERT INTO `m_sma` (`id`, `tahun`, `bulan`, `datetime`, `createby`) VALUES
	(2, 2023, NULL, '2023-01-04 08:07:42', 2),
	(3, 2023, 1, '2023-01-10 02:17:16', NULL),
	(4, 2023, 3, '2023-01-10 02:39:31', NULL),
	(5, 2023, NULL, '2023-01-10 02:40:08', NULL),
	(6, 2023, NULL, '2023-01-10 02:40:29', NULL),
	(7, NULL, 9, '2023-01-10 02:54:05', NULL),
	(8, 2024, NULL, '2023-01-10 02:56:42', NULL),
	(9, 2025, 4, '2023-01-10 02:57:52', NULL),
	(10, 2026, NULL, '2023-01-10 03:03:59', NULL),
	(11, 2024, 9, '2023-01-10 03:10:31', 2),
	(12, 2026, 11, '2023-01-10 03:11:36', NULL),
	(13, NULL, NULL, '2023-01-10 03:46:51', NULL),
	(14, 2021, 5, '2023-01-10 04:23:05', NULL),
	(15, 2030, 1, '2023-01-10 04:32:59', NULL),
	(16, NULL, NULL, '2023-01-10 05:18:34', NULL),
	(17, 2026, NULL, '2023-01-10 06:26:49', NULL),
	(18, NULL, NULL, '2023-01-10 06:30:46', NULL),
	(19, NULL, NULL, '2023-01-10 08:14:11', NULL),
	(20, 2303, 1, '2023-01-10 16:57:42', -1);

-- Dumping structure for table sigap2.m_smk
CREATE TABLE IF NOT EXISTS `m_smk` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tahun` smallint DEFAULT NULL,
  `bulan` int DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `createby` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.m_smk: ~0 rows (approximately)

-- Dumping structure for table sigap2.m_smp
CREATE TABLE IF NOT EXISTS `m_smp` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tahun` smallint DEFAULT NULL,
  `bulan` int DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `createby` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.m_smp: ~0 rows (approximately)

-- Dumping structure for table sigap2.m_tidakhadir
CREATE TABLE IF NOT EXISTS `m_tidakhadir` (
  `id` int NOT NULL AUTO_INCREMENT,
  `value` bigint DEFAULT NULL,
  `perjam_value` bigint DEFAULT NULL,
  `jabatan_id` int DEFAULT NULL,
  `jenjang_id` int DEFAULT NULL,
  `jenis` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table sigap2.m_tidakhadir: ~2 rows (approximately)
INSERT INTO `m_tidakhadir` (`id`, `value`, `perjam_value`, `jabatan_id`, `jenjang_id`, `jenis`) VALUES
	(1, 60000, 6500, 10, 3, NULL),
	(2, 75000, 9375, 12, 1, NULL);

-- Dumping structure for table sigap2.m_tk
CREATE TABLE IF NOT EXISTS `m_tk` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tahun` smallint DEFAULT NULL,
  `bulan` int DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `createby` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.m_tk: ~1 rows (approximately)
INSERT INTO `m_tk` (`id`, `tahun`, `bulan`, `datetime`, `createby`) VALUES
	(1, 2, 2, NULL, NULL);

-- Dumping structure for table sigap2.m_tu_sd
CREATE TABLE IF NOT EXISTS `m_tu_sd` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tahun` smallint DEFAULT NULL,
  `bulan` int DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `createby` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.m_tu_sd: ~1 rows (approximately)
INSERT INTO `m_tu_sd` (`id`, `tahun`, `bulan`, `datetime`, `createby`) VALUES
	(2, NULL, NULL, '2023-01-10 20:18:35', NULL);

-- Dumping structure for table sigap2.m_tu_sma
CREATE TABLE IF NOT EXISTS `m_tu_sma` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tahun` smallint DEFAULT NULL,
  `bulan` int DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `createby` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.m_tu_sma: ~0 rows (approximately)

-- Dumping structure for table sigap2.m_tu_smk
CREATE TABLE IF NOT EXISTS `m_tu_smk` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tahun` smallint DEFAULT NULL,
  `bulan` int DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `createby` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.m_tu_smk: ~0 rows (approximately)

-- Dumping structure for table sigap2.m_tu_smp
CREATE TABLE IF NOT EXISTS `m_tu_smp` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tahun` smallint DEFAULT NULL,
  `bulan` int DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `createby` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.m_tu_smp: ~0 rows (approximately)

-- Dumping structure for table sigap2.m_tu_tk
CREATE TABLE IF NOT EXISTS `m_tu_tk` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tahun` smallint DEFAULT NULL,
  `bulan` int DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `createby` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.m_tu_tk: ~0 rows (approximately)

-- Dumping structure for table sigap2.pegawai
CREATE TABLE IF NOT EXISTS `pegawai` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pid` int DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `wa` varchar(255) DEFAULT NULL,
  `hp` varchar(255) DEFAULT NULL,
  `tgllahir` date DEFAULT NULL,
  `nip` varchar(50) DEFAULT NULL,
  `rekbank` varchar(255) DEFAULT NULL,
  `pendidikan` int DEFAULT NULL,
  `jurusan` varchar(50) DEFAULT NULL,
  `agama` varchar(20) DEFAULT NULL,
  `jenkel` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `file_cv` varchar(255) DEFAULT NULL,
  `jabatan` int DEFAULT NULL,
  `mulai_bekerja` date DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `level` int DEFAULT '1',
  `aktif` tinyint DEFAULT '1',
  `jenjang_id` int DEFAULT NULL,
  `type` int DEFAULT NULL,
  `sertif` int DEFAULT NULL,
  `tambahan` int DEFAULT NULL,
  `periode_jabatan` int DEFAULT NULL,
  `lama_kerja` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.pegawai: ~6 rows (approximately)
INSERT INTO `pegawai` (`id`, `pid`, `nama`, `alamat`, `email`, `wa`, `hp`, `tgllahir`, `nip`, `rekbank`, `pendidikan`, `jurusan`, `agama`, `jenkel`, `status`, `foto`, `file_cv`, `jabatan`, `mulai_bekerja`, `keterangan`, `username`, `password`, `level`, `aktif`, `jenjang_id`, `type`, `sertif`, `tambahan`, `periode_jabatan`, `lama_kerja`) VALUES
	(6, NULL, 'Fitria', 'surabaya', 'fitria@gmail.com', NULL, NULL, NULL, '10230', NULL, NULL, NULL, NULL, 'Wanita', NULL, NULL, NULL, 5, NULL, NULL, 'Fitria', 'asdf123', 1, 1, 4, 1, 1, 2, 3, 2),
	(11, NULL, 'Dito', 'surabaya', 'dito@gmail.com', '085970248011', NULL, NULL, '10235', NULL, NULL, NULL, NULL, 'Wanita', NULL, NULL, NULL, 9, NULL, NULL, 'dito', 'asdf123', 1, 1, 5, 1, 2, NULL, NULL, NULL),
	(12, NULL, 'fira', 'surabaya', 'fitria@gmail.com', NULL, NULL, NULL, '10236', NULL, NULL, NULL, NULL, 'Wanita', NULL, NULL, NULL, 5, NULL, NULL, 'alvira', 'asdf123', 1, 1, 1, 1, 2, NULL, NULL, NULL),
	(13, NULL, 'Farhan kebab', 'surabaya', 'kebab@gmail.com', NULL, NULL, NULL, '10237', NULL, NULL, NULL, NULL, 'Wanita', NULL, NULL, NULL, 5, NULL, NULL, 'farhan', 'asdf123', 1, 1, 2, 1, 2, NULL, NULL, NULL),
	(14, NULL, 'ardi', 'surabaya', 'kebab@gmail.com', NULL, NULL, NULL, '10238', NULL, NULL, NULL, NULL, 'Wanita', NULL, NULL, NULL, 5, NULL, NULL, 'ardi', 'asdf123', 1, 1, 3, 1, 2, NULL, NULL, NULL),
	(30, NULL, 'asep', 'surabaya', 'kebab@gmail.com', NULL, NULL, NULL, '102321', NULL, NULL, NULL, NULL, 'Wanita', NULL, NULL, NULL, 6, NULL, NULL, 'asep', 'asdf123', 1, 1, 2, 2, 2, NULL, NULL, NULL),
	(31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'unitsma', 'asdf123', 6, 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(32, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'unitsmp', 'asdf123', 5, 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'unitsmk', 'asdf123', 7, 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(34, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'unitsd', 'asdf123', 4, 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'unittk', 'asdf123', 3, 1, NULL, NULL, NULL, NULL, NULL, NULL);

-- Dumping structure for table sigap2.peg_dokumen
CREATE TABLE IF NOT EXISTS `peg_dokumen` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pid` int DEFAULT NULL,
  `nama_dokumen` varchar(255) DEFAULT NULL,
  `file_dokumen` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `c_date` datetime DEFAULT NULL,
  `u_date` datetime DEFAULT NULL,
  `c_by` int DEFAULT NULL,
  `u_by` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.peg_dokumen: ~0 rows (approximately)

-- Dumping structure for table sigap2.peg_keluarga
CREATE TABLE IF NOT EXISTS `peg_keluarga` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pid` int DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `hp` varchar(255) DEFAULT NULL,
  `hubungan` varchar(255) DEFAULT NULL,
  `tgl_lahir` datetime DEFAULT NULL,
  `keterangan` varchar(500) DEFAULT NULL,
  `jen_kel` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.peg_keluarga: ~0 rows (approximately)

-- Dumping structure for table sigap2.peg_skill
CREATE TABLE IF NOT EXISTS `peg_skill` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pid` int DEFAULT NULL,
  `keahlian` varchar(255) DEFAULT NULL,
  `tingkat` varchar(255) DEFAULT NULL,
  `bukti` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `c_date` datetime DEFAULT NULL,
  `u_date` datetime DEFAULT NULL,
  `c_by` int DEFAULT NULL,
  `u_by` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.peg_skill: ~0 rows (approximately)

-- Dumping structure for table sigap2.penempatan
CREATE TABLE IF NOT EXISTS `penempatan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pegawai` int DEFAULT NULL,
  `project` varchar(255) DEFAULT NULL,
  `jabatan` int DEFAULT NULL,
  `tgl_mulai` date DEFAULT NULL,
  `tgl_akhir` date DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.penempatan: ~0 rows (approximately)

-- Dumping structure for table sigap2.pengetahuan
CREATE TABLE IF NOT EXISTS `pengetahuan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `grup` varchar(255) DEFAULT NULL,
  `judul` varchar(500) DEFAULT NULL,
  `isi` text,
  `sumber_url` varchar(255) DEFAULT NULL,
  `dokumen` varchar(255) DEFAULT NULL,
  `visual` varchar(255) DEFAULT NULL,
  `c_by` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.pengetahuan: ~0 rows (approximately)

-- Dumping structure for table sigap2.potongan_sd
CREATE TABLE IF NOT EXISTS `potongan_sd` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `terlambat` int DEFAULT NULL,
  `value_terlambat` bigint DEFAULT NULL,
  `izin` int DEFAULT NULL,
  `value_izin` bigint DEFAULT NULL,
  `jabatan_id` int DEFAULT NULL,
  `sakit` int DEFAULT NULL,
  `value_sakit` bigint DEFAULT NULL,
  `totalpotongan` bigint DEFAULT NULL,
  `tidakhadir` int DEFAULT NULL,
  `value_tidakhadir` bigint DEFAULT NULL,
  `month` date DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `u_by` int DEFAULT NULL,
  `pulcep` int DEFAULT NULL,
  `value_pulcep` bigint DEFAULT NULL,
  `tidakhadirjam` int DEFAULT NULL,
  `tidakhadirjamvalue` bigint DEFAULT NULL,
  `sakitperjam` int DEFAULT NULL,
  `sakitperjamvalue` bigint DEFAULT NULL,
  `jenjang_id` int DEFAULT NULL,
  `izinperjam` int DEFAULT NULL,
  `izinperjamvalue` bigint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table sigap2.potongan_sd: ~11 rows (approximately)
INSERT INTO `potongan_sd` (`id`, `nama`, `terlambat`, `value_terlambat`, `izin`, `value_izin`, `jabatan_id`, `sakit`, `value_sakit`, `totalpotongan`, `tidakhadir`, `value_tidakhadir`, `month`, `datetime`, `u_by`, `pulcep`, `value_pulcep`, `tidakhadirjam`, `tidakhadirjamvalue`, `sakitperjam`, `sakitperjamvalue`, `jenjang_id`, `izinperjam`, `izinperjamvalue`) VALUES
	(59, '110123', 2, 15000, 2, 40000, 1, NULL, 23000, 168000, NULL, 40000, NULL, '2022-12-16 04:03:38', -1, 2, 20000, 2, 9000, NULL, 4000, 1, NULL, 9000),
	(61, '110124', 2, 30000, 2, 30000, 2, NULL, 27000, 164000, NULL, 30000, NULL, '2022-12-16 04:09:21', -1, 2, 18000, 2, 4000, NULL, 7000, 1, NULL, 4000),
	(62, '110124', 1, 30000, 1, 40000, 1, NULL, 23000, 99000, NULL, 40000, NULL, '2022-12-16 09:14:07', -1, 1, 20000, 1, 9000, NULL, 4000, 1, NULL, 9000),
	(63, NULL, NULL, 30000, NULL, 40000, 1, NULL, 23000, NULL, NULL, 40000, NULL, NULL, NULL, NULL, 20000, NULL, 9000, NULL, 4000, 1, NULL, 9000),
	(64, 'YUNIARTI', 2, 30000, 2, 40000, 1, NULL, 23000, NULL, NULL, 40000, NULL, NULL, NULL, NULL, 20000, NULL, 9000, NULL, 4000, 1, NULL, 9000),
	(65, 'farhan kebab', 2, 30000, 2, 40000, 1, 2, 23000, NULL, 2, 40000, NULL, NULL, -1, 2, 20000, 2, 9000, 2, 4000, 1, 2, 9000),
	(66, 'YUNIARTI', 2, 30000, 2, 40000, 1, 2, 23000, NULL, NULL, 40000, NULL, NULL, -1, NULL, 20000, NULL, 9000, NULL, 4000, 1, NULL, 9000),
	(67, 'farhan kebab', 2, 30000, 2, 40000, 1, 2, 23000, 186000, NULL, 40000, NULL, NULL, -1, NULL, 20000, NULL, 9000, NULL, 4000, 1, NULL, 9000),
	(68, '110123', 2, 30000, 2, 40000, 2, NULL, 23000, 220000, 2, 40000, '2022-12-28', '2022-12-28 05:09:23', -1, NULL, 20000, NULL, 9000, NULL, 4000, 1, NULL, 9000),
	(69, '110124', 2, 15000, 2, 40000, 1, 2, NULL, NULL, 2, 40000, '2023-01-04', '2023-01-04 09:06:31', -1, 2, 20000, NULL, 9000, 2, NULL, 1, 3, 9000),
	(70, '110124', 2, 15000, 2, 40000, 1, 3, NULL, 410000, 3, 40000, '2023-01-04', '2023-01-04 09:07:36', -1, 3, 20000, NULL, 9000, NULL, NULL, 1, NULL, 9000);

-- Dumping structure for table sigap2.potongan_sma
CREATE TABLE IF NOT EXISTS `potongan_sma` (
  `id` int NOT NULL AUTO_INCREMENT,
  `datetime` datetime DEFAULT NULL,
  `month` date DEFAULT NULL,
  `nama` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `jenjang_id` int DEFAULT NULL,
  `jabatan_id` int DEFAULT NULL,
  `terlambat` int DEFAULT NULL,
  `value_terlambat` bigint DEFAULT NULL,
  `izin` int DEFAULT NULL,
  `value_izin` bigint DEFAULT NULL,
  `u_by` int DEFAULT NULL,
  `sakit` int DEFAULT NULL,
  `value_sakit` bigint DEFAULT NULL,
  `totalpotongan` bigint DEFAULT NULL,
  `tidakhadir` int DEFAULT NULL,
  `value_tidakhadir` bigint DEFAULT NULL,
  `pulcep` int DEFAULT NULL,
  `value_pulcep` bigint DEFAULT NULL,
  `tidakhadirjam` int DEFAULT NULL,
  `tidakhadirjamvalue` bigint DEFAULT NULL,
  `sakitperjam` int DEFAULT NULL,
  `sakitperjamvalue` bigint DEFAULT NULL,
  `izinperjam` int DEFAULT NULL,
  `izinperjamvalue` bigint DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.potongan_sma: ~9 rows (approximately)
INSERT INTO `potongan_sma` (`id`, `datetime`, `month`, `nama`, `jenjang_id`, `jabatan_id`, `terlambat`, `value_terlambat`, `izin`, `value_izin`, `u_by`, `sakit`, `value_sakit`, `totalpotongan`, `tidakhadir`, `value_tidakhadir`, `pulcep`, `value_pulcep`, `tidakhadirjam`, `tidakhadirjamvalue`, `sakitperjam`, `sakitperjamvalue`, `izinperjam`, `izinperjamvalue`) VALUES
	(59, '2022-12-16 04:03:38', NULL, '110123', 1, 1, 2, 15000, 2, 40000, -1, NULL, 23000, 168000, NULL, 40000, 2, 20000, 2, 9000, NULL, 4000, NULL, 9000),
	(61, '2022-12-16 04:09:21', NULL, '110124', 1, 2, 2, 30000, 2, 30000, -1, NULL, 27000, 164000, NULL, 30000, 2, 18000, 2, 4000, NULL, 7000, NULL, 4000),
	(62, '2022-12-16 09:14:07', NULL, '110124', 1, 1, 1, 30000, 1, 40000, -1, NULL, 23000, 99000, NULL, 40000, 1, 20000, 1, 9000, NULL, 4000, NULL, 9000),
	(63, NULL, NULL, NULL, 1, 1, NULL, 30000, NULL, 40000, NULL, NULL, 23000, NULL, NULL, 40000, NULL, 20000, NULL, 9000, NULL, 4000, NULL, 9000),
	(64, NULL, NULL, 'YUNIARTI', 1, 1, 2, 30000, 2, 40000, NULL, NULL, 23000, NULL, NULL, 40000, NULL, 20000, NULL, 9000, NULL, 4000, NULL, 9000),
	(65, NULL, NULL, 'farhan kebab', 1, 1, 2, 30000, 2, 40000, -1, 2, 23000, NULL, 2, 40000, 2, 20000, 2, 9000, 2, 4000, 2, 9000),
	(66, NULL, NULL, 'YUNIARTI', 1, 1, 2, 30000, 2, 40000, -1, 2, 23000, NULL, NULL, 40000, NULL, 20000, NULL, 9000, NULL, 4000, NULL, 9000),
	(67, NULL, NULL, 'farhan kebab', 1, 1, 2, 30000, 2, 40000, -1, 2, 23000, 186000, NULL, 40000, NULL, 20000, NULL, 9000, NULL, 4000, NULL, 9000),
	(68, '2022-12-28 05:09:23', '2022-12-28', '110123', 1, 2, 2, 30000, 2, 40000, -1, NULL, 23000, 220000, 2, 40000, NULL, 20000, NULL, 9000, NULL, 4000, NULL, 9000);

-- Dumping structure for table sigap2.potongan_smk
CREATE TABLE IF NOT EXISTS `potongan_smk` (
  `id` int NOT NULL AUTO_INCREMENT,
  `u_by` int DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `month` date DEFAULT NULL,
  `nama` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `jenjang_id` int DEFAULT NULL,
  `jabatan_id` int DEFAULT NULL,
  `terlambat` int DEFAULT NULL,
  `value_terlambat` bigint DEFAULT NULL,
  `izin` int DEFAULT NULL,
  `value_izin` bigint DEFAULT NULL,
  `sakit` int DEFAULT NULL,
  `value_sakit` bigint DEFAULT NULL,
  `totalpotongan` bigint DEFAULT NULL,
  `tidakhadir` int DEFAULT NULL,
  `value_tidakhadir` bigint DEFAULT NULL,
  `pulcep` int DEFAULT NULL,
  `value_pulcep` bigint DEFAULT NULL,
  `tidakhadirjam` int DEFAULT NULL,
  `tidakhadirjamvalue` bigint DEFAULT NULL,
  `sakitperjam` int DEFAULT NULL,
  `sakitperjamvalue` bigint DEFAULT NULL,
  `izinperjam` int DEFAULT NULL,
  `izinperjamvalue` bigint DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.potongan_smk: ~9 rows (approximately)
INSERT INTO `potongan_smk` (`id`, `u_by`, `datetime`, `month`, `nama`, `jenjang_id`, `jabatan_id`, `terlambat`, `value_terlambat`, `izin`, `value_izin`, `sakit`, `value_sakit`, `totalpotongan`, `tidakhadir`, `value_tidakhadir`, `pulcep`, `value_pulcep`, `tidakhadirjam`, `tidakhadirjamvalue`, `sakitperjam`, `sakitperjamvalue`, `izinperjam`, `izinperjamvalue`) VALUES
	(59, -1, '2022-12-16 04:03:38', NULL, '110123', 1, 1, 2, 15000, 2, 40000, NULL, 23000, 168000, NULL, 40000, 2, 20000, 2, 9000, NULL, 4000, NULL, 9000),
	(61, -1, '2022-12-16 04:09:21', NULL, '110124', 1, 2, 2, 30000, 2, 30000, NULL, 27000, 164000, NULL, 30000, 2, 18000, 2, 4000, NULL, 7000, NULL, 4000),
	(62, -1, '2022-12-16 09:14:07', NULL, '110124', 1, 1, 1, 30000, 1, 40000, NULL, 23000, 99000, NULL, 40000, 1, 20000, 1, 9000, NULL, 4000, NULL, 9000),
	(63, NULL, NULL, NULL, NULL, 1, 1, NULL, 30000, NULL, 40000, NULL, 23000, NULL, NULL, 40000, NULL, 20000, NULL, 9000, NULL, 4000, NULL, 9000),
	(64, NULL, NULL, NULL, 'YUNIARTI', 1, 1, 2, 30000, 2, 40000, NULL, 23000, NULL, NULL, 40000, NULL, 20000, NULL, 9000, NULL, 4000, NULL, 9000),
	(65, -1, NULL, NULL, 'farhan kebab', 1, 1, 2, 30000, 2, 40000, 2, 23000, NULL, 2, 40000, 2, 20000, 2, 9000, 2, 4000, 2, 9000),
	(66, -1, NULL, NULL, 'YUNIARTI', 1, 1, 2, 30000, 2, 40000, 2, 23000, NULL, NULL, 40000, NULL, 20000, NULL, 9000, NULL, 4000, NULL, 9000),
	(67, -1, NULL, NULL, 'farhan kebab', 1, 1, 2, 30000, 2, 40000, 2, 23000, 186000, NULL, 40000, NULL, 20000, NULL, 9000, NULL, 4000, NULL, 9000),
	(68, -1, '2022-12-28 05:09:23', '2022-12-28', '110123', 1, 2, 2, 30000, 2, 40000, NULL, 23000, 220000, 2, 40000, NULL, 20000, NULL, 9000, NULL, 4000, NULL, 9000);

-- Dumping structure for table sigap2.potongan_smp
CREATE TABLE IF NOT EXISTS `potongan_smp` (
  `id` int NOT NULL AUTO_INCREMENT,
  `u_by` int DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `month` date DEFAULT NULL,
  `nama` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `jenjang_id` int DEFAULT NULL,
  `jabatan_id` int DEFAULT NULL,
  `terlambat` int DEFAULT NULL,
  `value_terlambat` bigint DEFAULT NULL,
  `izin` int DEFAULT NULL,
  `value_izin` bigint DEFAULT NULL,
  `sakit` int DEFAULT NULL,
  `value_sakit` bigint DEFAULT NULL,
  `totalpotongan` bigint DEFAULT NULL,
  `tidakhadir` int DEFAULT NULL,
  `value_tidakhadir` bigint DEFAULT NULL,
  `pulcep` int DEFAULT NULL,
  `value_pulcep` bigint DEFAULT NULL,
  `tidakhadirjam` int DEFAULT NULL,
  `tidakhadirjamvalue` bigint DEFAULT NULL,
  `sakitperjam` int DEFAULT NULL,
  `sakitperjamvalue` bigint DEFAULT NULL,
  `izinperjam` int DEFAULT NULL,
  `izinperjamvalue` bigint DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.potongan_smp: ~9 rows (approximately)
INSERT INTO `potongan_smp` (`id`, `u_by`, `datetime`, `month`, `nama`, `jenjang_id`, `jabatan_id`, `terlambat`, `value_terlambat`, `izin`, `value_izin`, `sakit`, `value_sakit`, `totalpotongan`, `tidakhadir`, `value_tidakhadir`, `pulcep`, `value_pulcep`, `tidakhadirjam`, `tidakhadirjamvalue`, `sakitperjam`, `sakitperjamvalue`, `izinperjam`, `izinperjamvalue`) VALUES
	(59, -1, '2022-12-16 04:03:38', NULL, '110123', 1, 1, 2, 15000, 2, 40000, NULL, 23000, 168000, NULL, 40000, 2, 20000, 2, 9000, NULL, 4000, NULL, 9000),
	(61, -1, '2022-12-16 04:09:21', NULL, '110124', 1, 2, 2, 30000, 2, 30000, NULL, 27000, 164000, NULL, 30000, 2, 18000, 2, 4000, NULL, 7000, NULL, 4000),
	(62, -1, '2022-12-16 09:14:07', NULL, '110124', 1, 1, 1, 30000, 1, 40000, NULL, 23000, 99000, NULL, 40000, 1, 20000, 1, 9000, NULL, 4000, NULL, 9000),
	(63, NULL, NULL, NULL, NULL, 1, 1, NULL, 30000, NULL, 40000, NULL, 23000, NULL, NULL, 40000, NULL, 20000, NULL, 9000, NULL, 4000, NULL, 9000),
	(64, NULL, NULL, NULL, 'YUNIARTI', 1, 1, 2, 30000, 2, 40000, NULL, 23000, NULL, NULL, 40000, NULL, 20000, NULL, 9000, NULL, 4000, NULL, 9000),
	(65, -1, NULL, NULL, 'farhan kebab', 1, 1, 2, 30000, 2, 40000, 2, 23000, NULL, 2, 40000, 2, 20000, 2, 9000, 2, 4000, 2, 9000),
	(66, -1, NULL, NULL, 'YUNIARTI', 1, 1, 2, 30000, 2, 40000, 2, 23000, NULL, NULL, 40000, NULL, 20000, NULL, 9000, NULL, 4000, NULL, 9000),
	(67, -1, NULL, NULL, 'farhan kebab', 1, 1, 2, 30000, 2, 40000, 2, 23000, 186000, NULL, 40000, NULL, 20000, NULL, 9000, NULL, 4000, NULL, 9000),
	(68, -1, '2022-12-28 05:09:23', '2022-12-28', '110123', 1, 2, 2, 30000, 2, 40000, NULL, 23000, 220000, 2, 40000, NULL, 20000, NULL, 9000, NULL, 4000, NULL, 9000);

-- Dumping structure for table sigap2.potongan_tk
CREATE TABLE IF NOT EXISTS `potongan_tk` (
  `id` int NOT NULL AUTO_INCREMENT,
  `u_by` int DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `month` date DEFAULT NULL,
  `nama` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `jenjang_id` int DEFAULT NULL,
  `jabatan_id` int DEFAULT NULL,
  `terlambat` int DEFAULT NULL,
  `value_terlambat` bigint DEFAULT NULL,
  `izin` int DEFAULT NULL,
  `value_izin` bigint DEFAULT NULL,
  `sakit` int DEFAULT NULL,
  `value_sakit` bigint DEFAULT NULL,
  `totalpotongan` bigint DEFAULT NULL,
  `tidakhadir` int DEFAULT NULL,
  `value_tidakhadir` bigint DEFAULT NULL,
  `pulcep` int DEFAULT NULL,
  `value_pulcep` bigint DEFAULT NULL,
  `tidakhadirjam` int DEFAULT NULL,
  `tidakhadirjamvalue` bigint DEFAULT NULL,
  `sakitperjam` int DEFAULT NULL,
  `sakitperjamvalue` bigint DEFAULT NULL,
  `izinperjam` int DEFAULT NULL,
  `izinperjamvalue` bigint DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.potongan_tk: ~9 rows (approximately)
INSERT INTO `potongan_tk` (`id`, `u_by`, `datetime`, `month`, `nama`, `jenjang_id`, `jabatan_id`, `terlambat`, `value_terlambat`, `izin`, `value_izin`, `sakit`, `value_sakit`, `totalpotongan`, `tidakhadir`, `value_tidakhadir`, `pulcep`, `value_pulcep`, `tidakhadirjam`, `tidakhadirjamvalue`, `sakitperjam`, `sakitperjamvalue`, `izinperjam`, `izinperjamvalue`) VALUES
	(59, -1, '2022-12-16 04:03:38', NULL, '110123', 1, 1, 2, 15000, 2, 40000, NULL, 23000, 168000, NULL, 40000, 2, 20000, 2, 9000, NULL, 4000, NULL, 9000),
	(61, -1, '2022-12-16 04:09:21', NULL, '110124', 1, 2, 2, 30000, 2, 30000, NULL, 27000, 164000, NULL, 30000, 2, 18000, 2, 4000, NULL, 7000, NULL, 4000),
	(62, -1, '2022-12-16 09:14:07', NULL, '110124', 1, 1, 1, 30000, 1, 40000, NULL, 23000, 99000, NULL, 40000, 1, 20000, 1, 9000, NULL, 4000, NULL, 9000),
	(63, NULL, NULL, NULL, NULL, 1, 1, NULL, 30000, NULL, 40000, NULL, 23000, NULL, NULL, 40000, NULL, 20000, NULL, 9000, NULL, 4000, NULL, 9000),
	(64, NULL, NULL, NULL, 'YUNIARTI', 1, 1, 2, 30000, 2, 40000, NULL, 23000, NULL, NULL, 40000, NULL, 20000, NULL, 9000, NULL, 4000, NULL, 9000),
	(65, -1, NULL, NULL, 'farhan kebab', 1, 1, 2, 30000, 2, 40000, 2, 23000, NULL, 2, 40000, 2, 20000, 2, 9000, 2, 4000, 2, 9000),
	(66, -1, NULL, NULL, 'YUNIARTI', 1, 1, 2, 30000, 2, 40000, 2, 23000, NULL, NULL, 40000, NULL, 20000, NULL, 9000, NULL, 4000, NULL, 9000),
	(67, -1, NULL, NULL, 'farhan kebab', 1, 1, 2, 30000, 2, 40000, 2, 23000, 186000, NULL, 40000, NULL, 20000, NULL, 9000, NULL, 4000, NULL, 9000),
	(68, -1, '2022-12-28 05:09:23', '2022-12-28', '110123', 1, 2, 2, 30000, 2, 40000, NULL, 23000, 220000, 2, 40000, NULL, 20000, NULL, 9000, NULL, 4000, NULL, 9000);

-- Dumping structure for table sigap2.proyek
CREATE TABLE IF NOT EXISTS `proyek` (
  `id` int NOT NULL AUTO_INCREMENT,
  `klien` varchar(255) DEFAULT NULL,
  `proyek` varchar(255) DEFAULT NULL,
  `tgl_awal` date DEFAULT NULL,
  `tgl_akhir` date DEFAULT NULL,
  `file_proyek` varchar(255) DEFAULT NULL,
  `aktif` tinyint DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.proyek: ~2 rows (approximately)
INSERT INTO `proyek` (`id`, `klien`, `proyek`, `tgl_awal`, `tgl_akhir`, `file_proyek`, `aktif`) VALUES
	(1, 'Yayasan salib suci', 'YSS', NULL, NULL, NULL, 1),
	(2, 'PERKI Surabaya', 'ACSA 2022', '2022-06-17', '2022-10-30', NULL, 0);

-- Dumping structure for table sigap2.reimbursh
CREATE TABLE IF NOT EXISTS `reimbursh` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pegawai` int DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `tgl` datetime DEFAULT NULL,
  `total_pengajuan` int DEFAULT NULL,
  `tgl_pengajuan` datetime DEFAULT NULL,
  `jenis` varchar(255) DEFAULT NULL,
  `keterangan` varchar(500) DEFAULT NULL,
  `rek_tujuan` varchar(255) DEFAULT NULL,
  `bukti1` varchar(255) DEFAULT NULL,
  `bukti2` varchar(255) DEFAULT NULL,
  `bukti3` varchar(255) DEFAULT NULL,
  `bukti4` varchar(255) DEFAULT NULL,
  `disetujui` varchar(5) DEFAULT NULL,
  `pembayar` varchar(255) DEFAULT NULL,
  `terbayar` varchar(5) DEFAULT NULL,
  `tgl_pembayaran` datetime DEFAULT NULL,
  `jumlah_dibayar` int DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.reimbursh: ~0 rows (approximately)

-- Dumping structure for table sigap2.sertif
CREATE TABLE IF NOT EXISTS `sertif` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table sigap2.sertif: ~2 rows (approximately)
INSERT INTO `sertif` (`id`, `name`) VALUES
	(1, 'Sertifikasi'),
	(2, 'Non Sertifikasi');

-- Dumping structure for table sigap2.setuju
CREATE TABLE IF NOT EXISTS `setuju` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table sigap2.setuju: ~2 rows (approximately)
INSERT INTO `setuju` (`id`, `name`) VALUES
	(1, 'ya'),
	(2, 'tidak');

-- Dumping structure for table sigap2.tambahan_tugas
CREATE TABLE IF NOT EXISTS `tambahan_tugas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table sigap2.tambahan_tugas: ~6 rows (approximately)
INSERT INTO `tambahan_tugas` (`id`, `name`) VALUES
	(1, 'K3'),
	(2, 'Wali Kelas'),
	(3, 'Pembina OSIS'),
	(4, 'Koor BK'),
	(5, 'Staff BPOPP'),
	(6, 'Staff BOS');

-- Dumping structure for table sigap2.terlambat
CREATE TABLE IF NOT EXISTS `terlambat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `value` bigint DEFAULT NULL,
  `jenjang_id` int DEFAULT NULL,
  `jabatan_id` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table sigap2.terlambat: ~2 rows (approximately)
INSERT INTO `terlambat` (`id`, `value`, `jenjang_id`, `jabatan_id`) VALUES
	(1, 15000, 1, 1),
	(2, 30000, 1, 2);

-- Dumping structure for table sigap2.testtable
CREATE TABLE IF NOT EXISTS `testtable` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `nojob` varchar(50) DEFAULT NULL,
  `stuffingdate` datetime DEFAULT NULL,
  `shipper` varchar(50) DEFAULT NULL,
  `stuffingloc` varchar(50) DEFAULT NULL,
  `party` varchar(50) DEFAULT NULL,
  `typeparty` varchar(50) DEFAULT NULL,
  `jumlahparty` int DEFAULT NULL,
  `shipping` varchar(50) DEFAULT NULL,
  `bookingnumer` varchar(50) DEFAULT NULL,
  `shippingline` varchar(50) DEFAULT NULL,
  `port` varchar(50) DEFAULT NULL,
  `surjal` varchar(50) DEFAULT NULL,
  `nota` varchar(50) DEFAULT NULL,
  `invoice` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table sigap2.testtable: ~6 rows (approximately)
INSERT INTO `testtable` (`id`, `date`, `nojob`, `stuffingdate`, `shipper`, `stuffingloc`, `party`, `typeparty`, `jumlahparty`, `shipping`, `bookingnumer`, `shippingline`, `port`, `surjal`, `nota`, `invoice`) VALUES
	(1, '2022-12-08 00:00:00', '220180', '2022-12-08 00:00:00', 'SUNPAPER', 'SUB', 'asd', NULL, NULL, NULL, NULL, NULL, NULL, 'ok', 'ok', 'ok'),
	(2, '2022-12-08 00:00:00', '220180', '2022-12-08 00:00:00', 'SUNPAPER', 'SUB', 'as', NULL, NULL, NULL, NULL, NULL, NULL, 'ok1', 'ok', NULL),
	(3, '2022-12-08 00:00:00', '220180', '2022-12-08 00:00:00', 'SUNPAPER', 'SUB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(4, '2022-12-08 00:00:00', '220180', '2022-12-08 00:00:00', 'SUNPAPER', 'SUB', 'as', NULL, NULL, NULL, NULL, NULL, NULL, 'ok', 'ok', 'belum'),
	(5, '2022-12-08 00:00:00', '220181', '2022-12-08 00:00:00', 'SUNPAPER', 'SUB', 'as', NULL, NULL, NULL, NULL, NULL, NULL, 'ok1', 'ok', NULL),
	(6, '2022-12-08 00:00:00', '2201803', '2022-12-08 00:00:00', 'SUNPAPER', 'SUB', 'asd', NULL, NULL, NULL, NULL, NULL, NULL, 'ok', 'ok', 'ok');

-- Dumping structure for table sigap2.totalgaji
CREATE TABLE IF NOT EXISTS `totalgaji` (
  `id` int DEFAULT NULL,
  `nama` int DEFAULT NULL,
  `jabatan` int DEFAULT NULL,
  `valuejabatan` bigint DEFAULT NULL,
  `valuetunjangan` bigint DEFAULT NULL,
  `value_lembur` bigint DEFAULT NULL,
  `Column 7` int DEFAULT NULL,
  `Column 8` int DEFAULT NULL,
  `Column 9` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table sigap2.totalgaji: ~0 rows (approximately)

-- Dumping structure for table sigap2.tpendidikan
CREATE TABLE IF NOT EXISTS `tpendidikan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `nourut` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table sigap2.tpendidikan: ~5 rows (approximately)
INSERT INTO `tpendidikan` (`id`, `name`, `nourut`) VALUES
	(1, 'SD', 2),
	(2, 'SMP', 3),
	(3, 'SMA', 4),
	(4, 'SMK', 5),
	(12, 'TK', 1);

-- Dumping structure for table sigap2.tunjangan_berkala
CREATE TABLE IF NOT EXISTS `tunjangan_berkala` (
  `id` int NOT NULL AUTO_INCREMENT,
  `jenjang` int DEFAULT NULL,
  `kualifikasi` int DEFAULT NULL,
  `lama` int DEFAULT NULL,
  `value` bigint DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=141 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.tunjangan_berkala: ~120 rows (approximately)
INSERT INTO `tunjangan_berkala` (`id`, `jenjang`, `kualifikasi`, `lama`, `value`) VALUES
	(21, 3, 5, 1, 382500),
	(22, 3, 15, 1, 330000),
	(23, 3, 5, 2, 435000),
	(24, 3, 15, 2, 382500),
	(25, 3, 5, 3, 487000),
	(26, 3, 15, 3, 435000),
	(27, 3, 5, 4, 450000),
	(28, 3, 15, 4, 487000),
	(29, 3, 5, 5, 592000),
	(30, 3, 15, 5, 540000),
	(31, 3, 5, 6, 645000),
	(32, 3, 15, 6, 592000),
	(33, 3, 5, 7, 697500),
	(34, 3, 15, 7, 645000),
	(35, 3, 5, 8, 750000),
	(36, 3, 15, 8, 697500),
	(37, 3, 5, 9, 802500),
	(38, 3, 15, 9, 750000),
	(39, 3, 5, 10, 855000),
	(40, 3, 15, 10, 802500),
	(41, 3, 5, 1, 382500),
	(42, 3, 15, 1, 330000),
	(43, 3, 5, 2, 435000),
	(44, 3, 15, 2, 382500),
	(45, 3, 5, 3, 487000),
	(46, 3, 15, 3, 435000),
	(47, 3, 5, 4, 450000),
	(48, 3, 15, 4, 487000),
	(49, 3, 5, 5, 592000),
	(50, 3, 15, 5, 540000),
	(51, 3, 5, 6, 645000),
	(52, 3, 15, 6, 592000),
	(53, 3, 5, 7, 697500),
	(54, 3, 15, 7, 645000),
	(55, 3, 5, 8, 750000),
	(56, 3, 15, 8, 697500),
	(57, 3, 5, 9, 802500),
	(58, 3, 15, 9, 750000),
	(59, 3, 5, 10, 855000),
	(60, 3, 15, 10, 802500),
	(61, 2, 5, 1, 382500),
	(62, 2, 15, 1, 330000),
	(63, 2, 5, 2, 435000),
	(64, 2, 15, 2, 382500),
	(65, 2, 5, 3, 487000),
	(66, 2, 15, 3, 435000),
	(67, 2, 5, 4, 450000),
	(68, 2, 15, 4, 487000),
	(69, 2, 5, 5, 592000),
	(70, 2, 15, 5, 540000),
	(71, 2, 5, 6, 645000),
	(72, 2, 15, 6, 592000),
	(73, 2, 5, 7, 697500),
	(74, 2, 15, 7, 645000),
	(75, 2, 5, 8, 750000),
	(76, 2, 15, 8, 697500),
	(77, 2, 5, 9, 802500),
	(78, 2, 15, 9, 750000),
	(79, 2, 5, 10, 855000),
	(80, 2, 15, 10, 802500),
	(81, 1, 5, 1, 382500),
	(82, 1, 15, 1, 330000),
	(83, 1, 5, 2, 435000),
	(84, 1, 15, 2, 382500),
	(85, 1, 5, 3, 487000),
	(86, 1, 15, 3, 435000),
	(87, 1, 5, 4, 450000),
	(88, 1, 15, 4, 487000),
	(89, 1, 5, 5, 592000),
	(90, 1, 15, 5, 540000),
	(91, 1, 5, 6, 645000),
	(92, 1, 15, 6, 592000),
	(93, 1, 5, 7, 697500),
	(94, 1, 15, 7, 645000),
	(95, 1, 5, 8, 750000),
	(96, 1, 15, 8, 697500),
	(97, 1, 5, 9, 802500),
	(98, 1, 15, 9, 750000),
	(99, 1, 5, 10, 855000),
	(100, 1, 15, 10, 802500),
	(101, 5, 5, 1, 382500),
	(102, 5, 15, 1, 330000),
	(103, 5, 5, 2, 435000),
	(104, 5, 15, 2, 382500),
	(105, 5, 5, 3, 487000),
	(106, 5, 15, 3, 435000),
	(107, 5, 5, 4, 450000),
	(108, 5, 15, 4, 487000),
	(109, 5, 5, 5, 592000),
	(110, 5, 15, 5, 540000),
	(111, 5, 5, 6, 645000),
	(112, 5, 15, 6, 592000),
	(113, 5, 5, 7, 697500),
	(114, 5, 15, 7, 645000),
	(115, 5, 5, 8, 750000),
	(116, 5, 15, 8, 697500),
	(117, 5, 5, 9, 802500),
	(118, 5, 15, 9, 750000),
	(119, 5, 5, 10, 855000),
	(120, 5, 15, 10, 802500),
	(121, 4, 5, 1, 382500),
	(122, 4, 15, 1, 330000),
	(123, 4, 5, 2, 435000),
	(124, 4, 15, 2, 382500),
	(125, 4, 5, 3, 487000),
	(126, 4, 15, 3, 435000),
	(127, 4, 5, 4, 450000),
	(128, 4, 15, 4, 487000),
	(129, 4, 5, 5, 592000),
	(130, 4, 15, 5, 540000),
	(131, 4, 5, 6, 645000),
	(132, 4, 15, 6, 592000),
	(133, 4, 5, 7, 697500),
	(134, 4, 15, 7, 645000),
	(135, 4, 5, 8, 750000),
	(136, 4, 15, 8, 697500),
	(137, 4, 5, 9, 802500),
	(138, 4, 15, 9, 750000),
	(139, 4, 5, 10, 855000),
	(140, 4, 15, 10, 802500);

-- Dumping structure for table sigap2.tunjangan_tambahan
CREATE TABLE IF NOT EXISTS `tunjangan_tambahan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `jenjang` int DEFAULT NULL,
  `kualifikasi` int DEFAULT NULL,
  `value` bigint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table sigap2.tunjangan_tambahan: ~8 rows (approximately)
INSERT INTO `tunjangan_tambahan` (`id`, `jenjang`, `kualifikasi`, `value`) VALUES
	(5, 4, 3, 100000),
	(6, 4, 5, 100000),
	(7, 4, 6, 100000),
	(8, 4, 4, 100000),
	(9, 4, 2, 125000),
	(10, 5, 2, 100000),
	(11, 5, 1, 300000),
	(12, 5, 3, 75000);

-- Dumping structure for table sigap2.uangmuka
CREATE TABLE IF NOT EXISTS `uangmuka` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tgl` datetime DEFAULT NULL,
  `pembayar` int DEFAULT NULL,
  `peruntukan` varchar(255) DEFAULT NULL,
  `penerima` int DEFAULT NULL,
  `rek_penerima` varchar(255) DEFAULT NULL,
  `tgl_terima` datetime DEFAULT NULL,
  `total_terima` int DEFAULT NULL,
  `tgl_tgjb` datetime DEFAULT NULL,
  `jumlah_tgjb` int DEFAULT NULL,
  `jenis` varchar(255) DEFAULT NULL,
  `keterangan` varchar(500) DEFAULT NULL,
  `bukti1` varchar(255) DEFAULT NULL,
  `bukti2` varchar(255) DEFAULT NULL,
  `bukti3` varchar(255) DEFAULT NULL,
  `bukti4` varchar(255) DEFAULT NULL,
  `disetujui` varchar(5) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.uangmuka: ~0 rows (approximately)

-- Dumping structure for table sigap2.userlevelpermissions
CREATE TABLE IF NOT EXISTS `userlevelpermissions` (
  `userlevelid` int NOT NULL,
  `tablename` varchar(255) NOT NULL,
  `permission` int NOT NULL,
  PRIMARY KEY (`userlevelid`,`tablename`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.userlevelpermissions: ~730 rows (approximately)
INSERT INTO `userlevelpermissions` (`userlevelid`, `tablename`, `permission`) VALUES
	(-2, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}absen', 0),
	(-2, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}absen_detil', 0),
	(-2, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}agama', 0),
	(-2, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}audittrail', 0),
	(-2, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}berita', 0),
	(-2, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}bulan', 0),
	(-2, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}daftarbarang', 0),
	(-2, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}dinasluar', 0),
	(-2, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji', 0),
	(-2, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajisd', 0),
	(-2, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajisd_detil', 0),
	(-2, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajisma', 0),
	(-2, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajisma_detil', 0),
	(-2, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajismk', 0),
	(-2, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajismk_detil', 0),
	(-2, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajismp', 0),
	(-2, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajismp_detil', 0),
	(-2, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajitk', 0),
	(-2, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajitk_detil', 0),
	(-2, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajitunjangan', 0),
	(-2, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_pokok', 0),
	(-2, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gender', 0),
	(-2, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}ijazah', 0),
	(-2, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}ijin', 0),
	(-2, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jabatan', 0),
	(-2, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_barang', 0),
	(-2, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_dinasluar', 0),
	(-2, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_grup_berita', 0),
	(-2, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_grup_ilmu', 0),
	(-2, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_ijin', 0),
	(-2, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_lembur', 0),
	(-2, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}komentar', 0),
	(-2, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}lembur', 0),
	(-2, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_pulangcepat', 0),
	(-2, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_sakit', 0),
	(-2, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_tidakhadir', 0),
	(-2, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}pegawai', 0),
	(-2, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}peg_dokumen', 0),
	(-2, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}peg_keluarga', 0),
	(-2, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}peg_skill', 0),
	(-2, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}penempatan', 0),
	(-2, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}pengetahuan', 0),
	(-2, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}potongan', 0),
	(-2, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}potongan_sd', 0),
	(-2, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}potongan_smp', 0),
	(-2, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}proyek', 0),
	(-2, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}reimbursh', 0),
	(-2, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}terlambat', 0),
	(-2, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}testtable', 0),
	(-2, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}totalgaji', 0),
	(-2, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}tpendidikan', 0),
	(-2, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}uangmuka', 0),
	(-2, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}userlevelpermissions', 0),
	(-2, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}userlevels', 0),
	(-2, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}dinasluar', 0),
	(-2, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}ijin', 0),
	(-2, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}jabatan', 0),
	(-2, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}pegawai', 0),
	(-2, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}peg_dokumen', 0),
	(-2, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}peg_skill', 0),
	(-2, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}penempatan', 0),
	(-2, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}proyek', 0),
	(-2, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}userlevelpermissions', 0),
	(-2, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}userlevels', 0),
	(0, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}absen', 0),
	(0, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}absen_detil', 0),
	(0, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}agama', 0),
	(0, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}audittrail', 0),
	(0, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}berita', 0),
	(0, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}bulan', 0),
	(0, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}daftarbarang', 0),
	(0, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}dinasluar', 0),
	(0, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji', 0),
	(0, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajisd', 0),
	(0, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajisd_detil', 0),
	(0, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajisma', 0),
	(0, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajisma_detil', 0),
	(0, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajismk', 0),
	(0, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajismk_detil', 0),
	(0, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajismp', 0),
	(0, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajismp_detil', 0),
	(0, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajitk', 0),
	(0, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajitk_detil', 0),
	(0, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajitunjangan', 0),
	(0, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_pokok', 0),
	(0, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gender', 0),
	(0, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}ijazah', 0),
	(0, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}ijin', 0),
	(0, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jabatan', 0),
	(0, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_barang', 0),
	(0, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_dinasluar', 0),
	(0, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_grup_berita', 0),
	(0, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_grup_ilmu', 0),
	(0, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_ijin', 0),
	(0, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_lembur', 0),
	(0, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}komentar', 0),
	(0, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}lembur', 0),
	(0, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_pulangcepat', 0),
	(0, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_sakit', 0),
	(0, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_tidakhadir', 0),
	(0, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}pegawai', 0),
	(0, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}peg_dokumen', 0),
	(0, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}peg_keluarga', 0),
	(0, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}peg_skill', 0),
	(0, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}penempatan', 0),
	(0, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}pengetahuan', 0),
	(0, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}potongan', 0),
	(0, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}potongan_sd', 0),
	(0, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}potongan_smp', 0),
	(0, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}proyek', 0),
	(0, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}reimbursh', 0),
	(0, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}terlambat', 0),
	(0, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}testtable', 0),
	(0, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}totalgaji', 0),
	(0, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}tpendidikan', 0),
	(0, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}uangmuka', 0),
	(0, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}userlevelpermissions', 0),
	(0, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}userlevels', 0),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}absen', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}absen_detil', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}agama', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}audittrail', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}barang', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}barangnew', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}berita', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}bulan', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}daftarbarang', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}dinasluar', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajisd', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajisd_detil', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajisma', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajisma_detil', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajismk', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajismk_detil', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajismp', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajismp_detil', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajitk', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajitk_detil', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajitunjangan', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_karyawan_sd', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_karyawan_sma', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_karyawan_smk', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_karyawan_smp', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_karyawan_tk', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_pokok', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_sma', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_smk', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_smp', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_tk', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_tu_sd', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_tu_sma', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_tu_smk', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_tu_smp', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_tu_tk', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gender', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}hapus_barang', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}hapus_barangnew', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}ijazah', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}ijin', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jabatan', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_barang', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_dinasluar', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_grup_berita', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_grup_ilmu', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_ijin', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_lembur', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}komentar', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}lembur', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}mpendidikan', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_karyawan_tk', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_pulangcepat', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_sakit', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_tidakhadir', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_tk', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_tu_tk', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}pegawai', 367),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}peg_dokumen', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}peg_keluarga', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}peg_skill', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}penempatan', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}pengetahuan', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}potongan_sd', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}potongan_sma', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}potongan_smk', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}potongan_smp', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}potongan_tk', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}proyek', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}reimbursh', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}setuju', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}terlambat', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}testtable', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}totalgaji', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}tpendidikan', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}uangmuka', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}userlevelpermissions', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}userlevels', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgaji', 367),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajikaryawan', 367),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajikaryawansma', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajikaryawansmk', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajikaryawansmp', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajikaryawantk', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajisma', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajismk', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajismp', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajitk', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajitu', 367),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajitusma', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajitusmk', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajitusmp', 271),
	(1, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajitutk', 271),
	(1, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}absen', 0),
	(1, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}absen_detil', 0),
	(1, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}audittrail', 0),
	(1, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}berita', 104),
	(1, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}daftarbarang', 0),
	(1, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}dinasluar', 111),
	(1, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}ijin', 111),
	(1, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}jabatan', 0),
	(1, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}jenis_barang', 0),
	(1, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}jenis_dinasluar', 0),
	(1, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}jenis_grup_berita', 0),
	(1, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}jenis_grup_ilmu', 0),
	(1, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}jenis_ijin', 0),
	(1, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}jenis_lembur', 0),
	(1, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}komentar', 0),
	(1, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}lembur', 111),
	(1, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}pegawai', 108),
	(1, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}peg_dokumen', 111),
	(1, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}peg_keluarga', 111),
	(1, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}peg_skill', 111),
	(1, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}penempatan', 0),
	(1, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}pengetahuan', 109),
	(1, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}proyek', 0),
	(1, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}reimbursh', 111),
	(1, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}uangmuka', 111),
	(1, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}userlevelpermissions', 0),
	(1, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}userlevels', 0),
	(1, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}v_admin', 0),
	(1, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}v_pm', 0),
	(2, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}absen', 0),
	(2, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}absen_detil', 0),
	(2, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}audittrail', 0),
	(2, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}berita', 0),
	(2, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}daftarbarang', 111),
	(2, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}dinasluar', 108),
	(2, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}ijin', 108),
	(2, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}jabatan', 0),
	(2, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}jenis_barang', 111),
	(2, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}jenis_dinasluar', 0),
	(2, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}jenis_grup_berita', 0),
	(2, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}jenis_grup_ilmu', 0),
	(2, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}jenis_ijin', 0),
	(2, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}jenis_lembur', 0),
	(2, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}komentar', 0),
	(2, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}lembur', 104),
	(2, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}pegawai', 0),
	(2, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}peg_dokumen', 0),
	(2, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}peg_keluarga', 0),
	(2, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}peg_skill', 0),
	(2, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}penempatan', 0),
	(2, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}pengetahuan', 0),
	(2, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}proyek', 0),
	(2, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}reimbursh', 108),
	(2, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}uangmuka', 108),
	(2, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}userlevelpermissions', 0),
	(2, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}userlevels', 0),
	(2, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}v_admin', 0),
	(2, '{FB7F1C69-BEAA-490D-AA3A-561A2CBD209C}v_pm', 0),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}absen', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}absen_detil', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}agama', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}audittrail', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}barang', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}barangnew', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}berita', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}bulan', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}daftarbarang', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}dinasluar', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji', 495),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajisd', 495),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajisd_detil', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajisma', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajisma_detil', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajismk', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajismk_detil', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajismp', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajismp_detil', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajitk', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajitk_detil', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajitunjangan', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_karyawan_sd', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_karyawan_sma', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_karyawan_smk', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_karyawan_smp', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_karyawan_tk', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_pokok', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_pokok_tu', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_sma', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_smk', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_smp', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_tk', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_tu_sd', 495),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_tu_sma', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_tu_smk', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_tu_smp', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_tu_tk', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gender', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}hapus_barang', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}hapus_barangnew', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}ijazah', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}ijin', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jabatan', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_barang', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_dinasluar', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_grup_berita', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_grup_ilmu', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_ijin', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_jabatan', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_lembur', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}komentar', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}lembur', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}mpendidikan', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_karyawan_sd', 303),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_karyawan_sma', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_karyawan_smk', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_karyawan_smp', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_karyawan_tk', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_kehadiran', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_piket', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_pulangcepat', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_sakit', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_sd', 303),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_sma', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_smk', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_smp', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_tidakhadir', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_tk', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_tu_sd', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_tu_sma', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_tu_smk', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_tu_smp', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_tu_tk', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}pegawai', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}peg_dokumen', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}peg_keluarga', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}peg_skill', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}penempatan', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}pengetahuan', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}potongan_sd', 495),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}potongan_sma', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}potongan_smk', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}potongan_smp', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}potongan_tk', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}proyek', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}reimbursh', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}sertif', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}setuju', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}tambahan_tugas', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}terlambat', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}testtable', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}test_api.php', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}totalgaji', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}tpendidikan', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}tunjangan_berkala', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}tunjangan_tambahan', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}uangmuka', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}userlevelpermissions', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}userlevels', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgaji', 495),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajikaryawan', 495),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajikaryawansma', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajikaryawansmk', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajikaryawansmp', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajikaryawantk', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajisma', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajismk', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajismp', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajitk', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajitu', 495),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajitusma', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajitusmk', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajitusmp', 256),
	(3, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajitutk', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}absen', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}absen_detil', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}agama', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}audittrail', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}barang', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}barangnew', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}berita', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}bulan', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}daftarbarang', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}dinasluar', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajisd', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajisd_detil', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajisma', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajisma_detil', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajismk', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajismk_detil', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajismp', 495),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajismp_detil', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajitk', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajitk_detil', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajitunjangan', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_karyawan_sd', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_karyawan_sma', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_karyawan_smk', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_karyawan_smp', 495),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_karyawan_tk', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_pokok', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_pokok_tu', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_sma', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_smk', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_smp', 495),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_tk', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_tu_sd', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_tu_sma', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_tu_smk', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_tu_smp', 511),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_tu_tk', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gender', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}hapus_barang', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}hapus_barangnew', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}ijazah', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}ijin', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jabatan', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_barang', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_dinasluar', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_grup_berita', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_grup_ilmu', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_ijin', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_jabatan', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_lembur', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}komentar', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}lembur', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}mpendidikan', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_karyawan_sd', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_karyawan_sma', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_karyawan_smk', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_karyawan_smp', 495),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_karyawan_tk', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_kehadiran', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_piket', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_pulangcepat', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_sakit', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_sd', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_sma', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_smk', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_smp', 495),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_tidakhadir', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_tk', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_tu_sd', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_tu_sma', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_tu_smk', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_tu_smp', 495),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_tu_tk', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}pegawai', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}peg_dokumen', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}peg_keluarga', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}peg_skill', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}penempatan', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}pengetahuan', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}potongan_sd', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}potongan_sma', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}potongan_smk', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}potongan_smp', 495),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}potongan_tk', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}proyek', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}reimbursh', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}sertif', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}setuju', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}tambahan_tugas', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}terlambat', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}testtable', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}test_api.php', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}totalgaji', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}tpendidikan', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}tunjangan_berkala', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}tunjangan_tambahan', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}uangmuka', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}userlevelpermissions', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}userlevels', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgaji', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajikaryawan', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajikaryawansma', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajikaryawansmk', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajikaryawansmp', 495),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajikaryawantk', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajisma', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajismk', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajismp', 495),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajitk', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajitu', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajitusma', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajitusmk', 256),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajitusmp', 495),
	(5, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajitutk', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}absen', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}absen_detil', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}agama', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}audittrail', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}barang', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}barangnew', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}berita', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}bulan', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}daftarbarang', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}dinasluar', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajisd', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajisd_detil', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajisma', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajisma_detil', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajismk', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajismk_detil', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajismp', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajismp_detil', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajitk', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajitk_detil', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajitunjangan', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_karyawan_sd', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_karyawan_sma', 495),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_karyawan_smk', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_karyawan_smp', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_karyawan_tk', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_pokok', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_pokok_tu', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_sma', 495),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_smk', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_smp', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_tk', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_tu_sd', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_tu_sma', 495),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_tu_smk', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_tu_smp', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_tu_tk', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gender', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}hapus_barang', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}hapus_barangnew', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}ijazah', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}ijin', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jabatan', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_barang', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_dinasluar', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_grup_berita', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_grup_ilmu', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_ijin', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_jabatan', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_lembur', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}komentar', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}lembur', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}mpendidikan', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_karyawan_sd', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_karyawan_sma', 495),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_karyawan_smk', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_karyawan_smp', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_karyawan_tk', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_kehadiran', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_piket', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_pulangcepat', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_sakit', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_sd', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_sma', 495),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_smk', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_smp', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_tidakhadir', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_tk', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_tu_sd', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_tu_sma', 495),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_tu_smk', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_tu_smp', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_tu_tk', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}pegawai', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}peg_dokumen', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}peg_keluarga', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}peg_skill', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}penempatan', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}pengetahuan', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}potongan_sd', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}potongan_sma', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}potongan_smk', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}potongan_smp', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}potongan_tk', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}proyek', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}reimbursh', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}sertif', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}setuju', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}tambahan_tugas', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}terlambat', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}testtable', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}test_api.php', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}totalgaji', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}tpendidikan', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}tunjangan_berkala', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}tunjangan_tambahan', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}uangmuka', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}userlevelpermissions', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}userlevels', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgaji', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajikaryawan', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajikaryawansma', 495),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajikaryawansmk', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajikaryawansmp', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajikaryawantk', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajisma', 495),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajismk', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajismp', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajitk', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajitu', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajitusma', 495),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajitusmk', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajitusmp', 256),
	(6, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajitutk', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}absen', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}absen_detil', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}agama', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}audittrail', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}barang', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}barangnew', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}berita', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}bulan', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}daftarbarang', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}dinasluar', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajisd', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajisd_detil', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajisma', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajisma_detil', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajismk', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajismk_detil', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajismp', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajismp_detil', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajitk', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajitk_detil', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gajitunjangan', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_karyawan_sd', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_karyawan_sma', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_karyawan_smk', 495),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_karyawan_smp', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_karyawan_tk', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_pokok', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_pokok_tu', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_sma', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_smk', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_smp', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_tk', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_tu_sd', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_tu_sma', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_tu_smk', 495),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_tu_smp', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gaji_tu_tk', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}gender', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}hapus_barang', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}hapus_barangnew', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}ijazah', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}ijin', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jabatan', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_barang', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_dinasluar', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_grup_berita', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_grup_ilmu', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_ijin', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_jabatan', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}jenis_lembur', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}komentar', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}lembur', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}mpendidikan', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_karyawan_sd', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_karyawan_sma', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_karyawan_smk', 495),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_karyawan_smp', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_karyawan_tk', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_kehadiran', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_piket', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_pulangcepat', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_sakit', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_sd', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_sma', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_smk', 495),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_smp', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_tidakhadir', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_tk', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_tu_sd', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_tu_sma', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_tu_smk', 495),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_tu_smp', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}m_tu_tk', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}pegawai', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}peg_dokumen', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}peg_keluarga', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}peg_skill', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}penempatan', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}pengetahuan', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}potongan_sd', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}potongan_sma', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}potongan_smk', 495),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}potongan_smp', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}potongan_tk', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}proyek', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}reimbursh', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}sertif', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}setuju', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}tambahan_tugas', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}terlambat', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}testtable', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}test_api.php', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}totalgaji', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}tpendidikan', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}tunjangan_berkala', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}tunjangan_tambahan', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}uangmuka', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}userlevelpermissions', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}userlevels', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgaji', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajikaryawan', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajikaryawansma', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajikaryawansmk', 495),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajikaryawansmp', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajikaryawantk', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajisma', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajismk', 495),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajismp', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajitk', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajitu', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajitusma', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajitusmk', 495),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajitusmp', 256),
	(7, '{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}v_totalgajitutk', 256);

-- Dumping structure for table sigap2.userlevels
CREATE TABLE IF NOT EXISTS `userlevels` (
  `userlevelid` int NOT NULL,
  `userlevelname` varchar(80) NOT NULL,
  PRIMARY KEY (`userlevelid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table sigap2.userlevels: ~10 rows (approximately)
INSERT INTO `userlevels` (`userlevelid`, `userlevelname`) VALUES
	(-2, 'Anonymous'),
	(-1, 'Administrator'),
	(0, 'Default'),
	(1, 'Pegawai'),
	(2, 'Admin & Keuangan'),
	(3, 'unit tk'),
	(4, 'unit sd'),
	(5, 'unit smp'),
	(6, 'unit sma'),
	(7, 'unit smk');

-- Dumping structure for view sigap2.v_totalgaji
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_totalgaji` (
	`id` INT(10) NOT NULL,
	`tahun` SMALLINT(5) NULL,
	`bulan` INT(10) NULL,
	`datetime` DATETIME NULL,
	`pegawai` VARCHAR(50) NULL COLLATE 'utf8mb4_0900_ai_ci',
	`total` BIGINT(19) NULL
) ENGINE=MyISAM;

-- Dumping structure for view sigap2.v_totalgajikaryawan
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_totalgajikaryawan` (
	`id` INT(10) NOT NULL,
	`datetime` DATETIME NULL,
	`pegawai` VARCHAR(50) NULL COLLATE 'utf8mb4_0900_ai_ci',
	`total` BIGINT(19) NULL,
	`tahun` SMALLINT(5) NULL,
	`bulan` INT(10) NULL
) ENGINE=MyISAM;

-- Dumping structure for view sigap2.v_totalgajikaryawansma
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_totalgajikaryawansma` (
	`id` INT(10) NOT NULL,
	`tahun` SMALLINT(5) NULL,
	`bulan` INT(10) NULL,
	`pegawai` VARCHAR(50) NULL COLLATE 'utf8mb4_0900_ai_ci',
	`total` BIGINT(19) NULL,
	`datetime` DATETIME NULL
) ENGINE=MyISAM;

-- Dumping structure for view sigap2.v_totalgajikaryawansmk
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_totalgajikaryawansmk` (
	`id` INT(10) NOT NULL,
	`tahun` SMALLINT(5) NULL,
	`bulan` INT(10) NULL,
	`datetime` DATETIME NULL,
	`pegawai` VARCHAR(50) NULL COLLATE 'utf8mb4_0900_ai_ci',
	`total` BIGINT(19) NULL
) ENGINE=MyISAM;

-- Dumping structure for view sigap2.v_totalgajikaryawansmp
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_totalgajikaryawansmp` (
	`id` INT(10) NOT NULL,
	`datetime` DATETIME NULL,
	`tahun` SMALLINT(5) NULL,
	`bulan` INT(10) NULL,
	`pegawai` VARCHAR(50) NULL COLLATE 'utf8mb4_0900_ai_ci',
	`total` BIGINT(19) NULL
) ENGINE=MyISAM;

-- Dumping structure for view sigap2.v_totalgajikaryawantk
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_totalgajikaryawantk` (
	`id` INT(10) NOT NULL,
	`datetime` DATETIME NULL,
	`tahun` SMALLINT(5) NULL,
	`bulan` INT(10) NULL,
	`pegawai` VARCHAR(50) NULL COLLATE 'utf8mb4_0900_ai_ci',
	`total` BIGINT(19) NULL
) ENGINE=MyISAM;

-- Dumping structure for view sigap2.v_totalgajisma
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_totalgajisma` (
	`id` INT(10) NOT NULL,
	`tahun` SMALLINT(5) NULL,
	`bulan` INT(10) NULL,
	`datetime` DATETIME NULL,
	`pegawai` VARCHAR(50) NULL COLLATE 'utf8mb4_0900_ai_ci',
	`total` BIGINT(19) NULL
) ENGINE=MyISAM;

-- Dumping structure for view sigap2.v_totalgajismk
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_totalgajismk` (
	`id` INT(10) NOT NULL,
	`tahun` SMALLINT(5) NULL,
	`bulan` INT(10) NULL,
	`datetime` DATETIME NULL,
	`pegawai` VARCHAR(50) NULL COLLATE 'utf8mb4_0900_ai_ci',
	`total` BIGINT(19) NULL
) ENGINE=MyISAM;

-- Dumping structure for view sigap2.v_totalgajismp
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_totalgajismp` (
	`id` INT(10) NOT NULL,
	`datetime` DATETIME NULL,
	`tahun` SMALLINT(5) NULL,
	`bulan` INT(10) NULL,
	`pegawai` VARCHAR(50) NULL COLLATE 'utf8mb4_0900_ai_ci',
	`total` BIGINT(19) NULL
) ENGINE=MyISAM;

-- Dumping structure for view sigap2.v_totalgajitk
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_totalgajitk` (
	`id` INT(10) NOT NULL,
	`tahun` SMALLINT(5) NULL,
	`bulan` INT(10) NULL,
	`datetime` DATETIME NULL,
	`pegawai` VARCHAR(50) NULL COLLATE 'utf8mb4_0900_ai_ci',
	`total` BIGINT(19) NULL
) ENGINE=MyISAM;

-- Dumping structure for view sigap2.v_totalgajitu
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_totalgajitu` (
	`id` INT(10) NOT NULL,
	`tahun` SMALLINT(5) NULL,
	`bulan` INT(10) NULL,
	`datetime` DATETIME NULL,
	`pegawai` VARCHAR(50) NULL COLLATE 'utf8mb4_0900_ai_ci',
	`total` BIGINT(19) NULL
) ENGINE=MyISAM;

-- Dumping structure for view sigap2.v_totalgajitusma
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_totalgajitusma` (
	`id` INT(10) NOT NULL,
	`datetime` DATETIME NULL,
	`tahun` SMALLINT(5) NULL,
	`bulan` INT(10) NULL,
	`pegawai` VARCHAR(50) NULL COLLATE 'utf8mb4_0900_ai_ci',
	`total` BIGINT(19) NULL
) ENGINE=MyISAM;

-- Dumping structure for view sigap2.v_totalgajitusmk
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_totalgajitusmk` (
	`id` INT(10) NOT NULL,
	`tahun` SMALLINT(5) NULL,
	`bulan` INT(10) NULL,
	`datetime` DATETIME NULL,
	`pegawai` VARCHAR(50) NULL COLLATE 'utf8mb4_0900_ai_ci',
	`total` BIGINT(19) NULL
) ENGINE=MyISAM;

-- Dumping structure for view sigap2.v_totalgajitusmp
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_totalgajitusmp` (
	`id` INT(10) NOT NULL,
	`tahun` SMALLINT(5) NULL,
	`bulan` INT(10) NULL,
	`pegawai` VARCHAR(50) NULL COLLATE 'utf8mb4_0900_ai_ci',
	`total` BIGINT(19) NULL,
	`datetime` DATETIME NULL
) ENGINE=MyISAM;

-- Dumping structure for view sigap2.v_totalgajitutk
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_totalgajitutk` (
	`id` INT(10) NOT NULL,
	`tahun` SMALLINT(5) NULL,
	`bulan` INT(10) NULL,
	`datetime` DATETIME NULL,
	`pegawai` VARCHAR(50) NULL COLLATE 'utf8mb4_0900_ai_ci',
	`total` BIGINT(19) NULL
) ENGINE=MyISAM;

-- Dumping structure for view sigap2.v_totalgaji
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_totalgaji`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_totalgaji` AS select `m_sd`.`id` AS `id`,`m_sd`.`tahun` AS `tahun`,`m_sd`.`bulan` AS `bulan`,`m_sd`.`datetime` AS `datetime`,`gaji`.`pegawai` AS `pegawai`,`gaji`.`total` AS `total` from (`m_sd` join `gaji` on((`m_sd`.`id` = `gaji`.`pid`)));

-- Dumping structure for view sigap2.v_totalgajikaryawan
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_totalgajikaryawan`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_totalgajikaryawan` AS select `m_karyawan_sd`.`id` AS `id`,`m_karyawan_sd`.`datetime` AS `datetime`,`gaji_karyawan_sd`.`pegawai` AS `pegawai`,`gaji_karyawan_sd`.`total` AS `total`,`m_karyawan_sd`.`tahun` AS `tahun`,`m_karyawan_sd`.`bulan` AS `bulan` from (`gaji_karyawan_sd` join `m_karyawan_sd` on((`m_karyawan_sd`.`id` = `gaji_karyawan_sd`.`pid`)));

-- Dumping structure for view sigap2.v_totalgajikaryawansma
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_totalgajikaryawansma`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_totalgajikaryawansma` AS select `m_karyawan_sma`.`id` AS `id`,`m_karyawan_sma`.`tahun` AS `tahun`,`m_karyawan_sma`.`bulan` AS `bulan`,`gaji_karyawan_sma`.`pegawai` AS `pegawai`,`gaji_karyawan_sma`.`total` AS `total`,`m_karyawan_sma`.`datetime` AS `datetime` from (`gaji_karyawan_sma` join `m_karyawan_sma` on((`m_karyawan_sma`.`id` = `gaji_karyawan_sma`.`pid`)));

-- Dumping structure for view sigap2.v_totalgajikaryawansmk
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_totalgajikaryawansmk`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_totalgajikaryawansmk` AS select `m_karyawan_smk`.`id` AS `id`,`m_karyawan_smk`.`tahun` AS `tahun`,`m_karyawan_smk`.`bulan` AS `bulan`,`m_karyawan_smk`.`datetime` AS `datetime`,`gaji_karyawan_smk`.`pegawai` AS `pegawai`,`gaji_karyawan_smk`.`total` AS `total` from (`gaji_karyawan_smk` join `m_karyawan_smk` on((`m_karyawan_smk`.`id` = `gaji_karyawan_smk`.`pid`)));

-- Dumping structure for view sigap2.v_totalgajikaryawansmp
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_totalgajikaryawansmp`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_totalgajikaryawansmp` AS select `m_karyawan_smp`.`id` AS `id`,`m_karyawan_smp`.`datetime` AS `datetime`,`m_karyawan_smp`.`tahun` AS `tahun`,`m_karyawan_smp`.`bulan` AS `bulan`,`gaji_karyawan_smp`.`pegawai` AS `pegawai`,`gaji_karyawan_smp`.`total` AS `total` from (`m_karyawan_smp` join `gaji_karyawan_smp` on((`m_karyawan_smp`.`id` = `gaji_karyawan_smp`.`pid`)));

-- Dumping structure for view sigap2.v_totalgajikaryawantk
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_totalgajikaryawantk`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_totalgajikaryawantk` AS select `m_karyawan_tk`.`id` AS `id`,`m_karyawan_tk`.`datetime` AS `datetime`,`m_karyawan_tk`.`tahun` AS `tahun`,`m_karyawan_tk`.`bulan` AS `bulan`,`gaji_karyawan_tk`.`pegawai` AS `pegawai`,`gaji_karyawan_tk`.`total` AS `total` from (`m_karyawan_tk` join `gaji_karyawan_tk` on((`m_karyawan_tk`.`id` = `gaji_karyawan_tk`.`pid`)));

-- Dumping structure for view sigap2.v_totalgajisma
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_totalgajisma`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_totalgajisma` AS select `m_sma`.`id` AS `id`,`m_sma`.`tahun` AS `tahun`,`m_sma`.`bulan` AS `bulan`,`m_sma`.`datetime` AS `datetime`,`gaji_sma`.`pegawai` AS `pegawai`,`gaji_sma`.`total` AS `total` from (`m_sma` join `gaji_sma` on((`m_sma`.`id` = `gaji_sma`.`pid`)));

-- Dumping structure for view sigap2.v_totalgajismk
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_totalgajismk`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_totalgajismk` AS select `m_smk`.`id` AS `id`,`m_smk`.`tahun` AS `tahun`,`m_smk`.`bulan` AS `bulan`,`m_smk`.`datetime` AS `datetime`,`gaji_smk`.`pegawai` AS `pegawai`,`gaji_smk`.`total` AS `total` from (`m_smk` join `gaji_smk` on((`m_smk`.`id` = `gaji_smk`.`pid`)));

-- Dumping structure for view sigap2.v_totalgajismp
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_totalgajismp`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_totalgajismp` AS select `m_smp`.`id` AS `id`,`m_smp`.`datetime` AS `datetime`,`m_smp`.`tahun` AS `tahun`,`m_smp`.`bulan` AS `bulan`,`gaji_smp`.`pegawai` AS `pegawai`,`gaji_smp`.`total` AS `total` from (`m_smp` join `gaji_smp` on((`m_smp`.`id` = `gaji_smp`.`pid`)));

-- Dumping structure for view sigap2.v_totalgajitk
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_totalgajitk`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_totalgajitk` AS select `m_tk`.`id` AS `id`,`m_tk`.`tahun` AS `tahun`,`m_tk`.`bulan` AS `bulan`,`m_tk`.`datetime` AS `datetime`,`gaji_tk`.`pegawai` AS `pegawai`,`gaji_tk`.`total` AS `total` from (`m_tk` join `gaji_tk` on((`m_tk`.`id` = `gaji_tk`.`pid`)));

-- Dumping structure for view sigap2.v_totalgajitu
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_totalgajitu`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_totalgajitu` AS select `m_tu_sd`.`id` AS `id`,`m_tu_sd`.`tahun` AS `tahun`,`m_tu_sd`.`bulan` AS `bulan`,`m_tu_sd`.`datetime` AS `datetime`,`gaji_tu_sd`.`pegawai` AS `pegawai`,`gaji_tu_sd`.`total` AS `total` from (`gaji_tu_sd` join `m_tu_sd` on((`m_tu_sd`.`id` = `gaji_tu_sd`.`pid`)));

-- Dumping structure for view sigap2.v_totalgajitusma
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_totalgajitusma`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_totalgajitusma` AS select `m_tu_sma`.`id` AS `id`,`m_tu_sma`.`datetime` AS `datetime`,`m_tu_sma`.`tahun` AS `tahun`,`m_tu_sma`.`bulan` AS `bulan`,`gaji_tu_sma`.`pegawai` AS `pegawai`,`gaji_tu_sma`.`total` AS `total` from (`m_tu_sma` join `gaji_tu_sma` on((`m_tu_sma`.`id` = `gaji_tu_sma`.`pid`)));

-- Dumping structure for view sigap2.v_totalgajitusmk
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_totalgajitusmk`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_totalgajitusmk` AS select `m_tu_smk`.`id` AS `id`,`m_tu_smk`.`tahun` AS `tahun`,`m_tu_smk`.`bulan` AS `bulan`,`m_tu_smk`.`datetime` AS `datetime`,`gaji_tu_smk`.`pegawai` AS `pegawai`,`gaji_tu_smk`.`total` AS `total` from (`m_tu_smk` join `gaji_tu_smk` on((`m_tu_smk`.`id` = `gaji_tu_smk`.`pid`)));

-- Dumping structure for view sigap2.v_totalgajitusmp
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_totalgajitusmp`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_totalgajitusmp` AS select `m_tu_smp`.`id` AS `id`,`m_tu_smp`.`tahun` AS `tahun`,`m_tu_smp`.`bulan` AS `bulan`,`gaji_tu_smp`.`pegawai` AS `pegawai`,`gaji_tu_smp`.`total` AS `total`,`m_tu_smp`.`datetime` AS `datetime` from (`m_tu_smp` join `gaji_tu_smp` on((`m_tu_smp`.`id` = `gaji_tu_smp`.`pid`)));

-- Dumping structure for view sigap2.v_totalgajitutk
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_totalgajitutk`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_totalgajitutk` AS select `m_tu_tk`.`id` AS `id`,`m_tu_tk`.`tahun` AS `tahun`,`m_tu_tk`.`bulan` AS `bulan`,`m_tu_tk`.`datetime` AS `datetime`,`gaji_tu_tk`.`pegawai` AS `pegawai`,`gaji_tu_tk`.`total` AS `total` from (`m_tu_tk` join `gaji_tu_tk` on((`m_tu_tk`.`id` = `gaji_tu_tk`.`pid`)));

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
