-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.38-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table surat.pejabat
CREATE TABLE IF NOT EXISTS `pejabatlama` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `kdjurusan` char(5) DEFAULT NULL,
  `jurusan` varchar(50) DEFAULT NULL,
  `level` tinyint(4) DEFAULT NULL,
  `kdjabatan` varchar(100) DEFAULT NULL,
  `iddosen` varchar(10) DEFAULT NULL,
  `nip` varchar(100) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  KEY `Index 1` (`no`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table surat.pejabat: ~44 rows (approximately)
DELETE FROM `pejabatlama`;
/*!40000 ALTER TABLE `pejabat` DISABLE KEYS */;
INSERT INTO `pejabatlama` (`no`, `kdjurusan`, `jurusan`, `level`, `kdjabatan`, `iddosen`, `nip`, `nama`, `jabatan`) VALUES
	(1, '6', 'SAINTEK', 1, 'dekan', '61004', '197310142001122002', 'Dr. Sri Harini, M.Si', 'Dekan'),
	(2, '6', 'SAINTEK', 2, 'wakildekan', '63007', '197709252006041003', 'Dr. Anton Prasetyo, M.Si', 'Wakil Dekan Bidang Akademik'),
	(3, '6', 'SAINTEK', 3, 'wakildekan', '62007', '197403252003121001', 'Dr. Dwi Suheriyanto,S.Si, M.P.', 'Wakil Dekan Bidang AUPK'),
	(4, '6', 'SAINTEK', 4, 'wakildekan', '64005', '197407302003121002', 'Dr. Imam Tazi,M.Si', 'Wakil Dekan Bidang Kemahasiswaan dan Kerja Sama'),
	(5, '64', 'Fisika', 5, 'kajur', '64002', '196505041990031003', 'Drs. Abdul Basid, M.Si', 'Kepala Program Studi Fisika'),
	(6, '63', 'Kimia', 5, 'kajur', '63008', '197906202006042002', 'Elok Kamilah Hayati, M.Si', 'Kepala Program Studi Kimia'),
	(7, '61', 'Matematika', 5, 'kajur', '61005', '196504142003121001', 'Dr. Usman Pagalay, M.Si', 'Kepala Program Studi Matematika'),
	(8, '65', 'Teknik Informatika', 5, 'kajur', '55022', '197404242009011008', 'Dr. Cahyo Crysdian, M.Cs', 'Kepala Program Studi Teknik Informatika'),
	(9, '66', 'Teknik Arsitektur', 5, 'kajur', '66009', '197909132006042001', 'Tarranita Kusumadewi, M.T.', 'Kepala Program Studi Teknik Arsitektur'),
	(11, '62', 'Biologi', 5, 'kajur', '62010', '197410182003122002', 'Dr. Evika Sandi Savitri, M.P.', 'Kepala Program Studi Biologi'),
	(12, '65', 'Teknik Informatika', 10, 'adminjurusan', 'admin-ti', '000000000000000000', 'Admin Teknik Informatika', 'Admin Teknik Informatika'),
	(13, '66', 'Teknik Arsitektur', 10, 'adminjurusan', 'admin-ta', '000000000000000000', 'Admin Arsitektur', 'Admin Arsitektur'),
	(14, '64', 'Fisika', 10, 'adminjurusan', 'admin-fis', '000000000000000000', 'Admin Fisika', 'Admin Fisika'),
	(15, '63', 'Kimia', 10, 'adminjurusan', 'admin-kim', '000000000000000000', 'Admin Kimia', 'Admin Kimia'),
	(16, '61', 'Matematika', 10, 'adminjurusan', 'admin-mat', '000000000000000000', 'Admin Matematika', 'Admin Matematika'),
	(17, '68', 'Perpustakaan dan Ilmu Informasi', 10, 'adminjurusan', 'admin-perp', '000000000000000000', 'Admin Perpustakaan', 'Admin Perpustakaan'),
	(18, '62', 'Biologi', 10, 'adminjurusan', 'admin-bio', '000000000000000000', 'Admin Biologi', 'Admin Biologi'),
	(19, '6', 'SAINTEK', 11, 'adminfakultas', 'akademik-s', '000000000000000000', 'Akademik Fakultas SAINTEK', 'Akademik Fakultas SAINTEK'),
	(20, '6', 'SAINTEK', 5, 'kabag', 'P00020', '197504182002122002', 'Faridah Abubakar M', 'Kepala Bagian AUPK Fakultas'),
	(21, '65', 'Teknik Informatika', 6, 'koorpkl', '65002', '197007312005011002', 'H. FATCHURROCHMAN,M.Kom', 'Koordinator PKL'),
	(22, '61', 'Matematika', 6, 'koorpkl', '61008', '19770521200512004', 'Ari Kusumastuti, M.Si', 'Koordinator PKL'),
	(23, '62', 'Biologi', 6, 'koorpkl', '52025', '197511062009122002', 'Kholifah Holil, M.Si', 'Koordinator PKL'),
	(24, '63', 'Kimia', 6, 'koorpkl', '63023', '19830125201608012068', 'Rif\'atul Mahmudah, S.Si, M.Si', 'Koordinator PKL'),
	(25, '64', 'Fisika', 6, 'koorpkl', '64006', '197405132003121001', 'FARID SAMSU HANANTO,S.Si., M.T.', 'Koordinator PKL'),
	(26, '66', 'Teknik Arsitektur', 6, 'koorpkl', '66107', '2014048701', 'Moh. Arsyad Bahar,S.T., M.Sc', 'Koordinator PKL'),
	(27, '68', 'Perpustakaan dan Ilmu Informasi', 6, 'koorpkl', '30254', '199002232018012001', 'Nita Siti Mudawamah, M.IP', 'Koordinator PKL'),
	(38, '6052', 'Magister Informatika', 5, 'kajur', '65001', '196805192003121001', 'Prof. Dr. Suhartono, M.Kom', 'Kepala Program Studi Magister Informatika'),
	(29, '84', 'Magister Informatika', 6, 'koorpkl', '65004', '197405102005011007', 'Dr. Muhammad Faisal, S.Kom, M.T', 'Sekretaris Program Studi Magister Informatika'),
	(30, '82', 'Magister Biologi', 5, 'kajur', '62003', '197109192000032001', 'Prof. Dr. drh. Hj. Bayyinatul Muchtaromah, M.Si', 'Kepala Program Studi Magister Biologi'),
	(31, '82', 'Magister Biologi', 6, 'koorpkl', '62001', '196301141999031001', 'Dr. Eko Budi Minarno, M.Pd', 'Sekretaris Program Studi Magister Biologi'),
	(10, '68', 'Perpustakaan dan Ilmu Informasi', 5, 'kajur', '65006', '196701182005011001', 'Dr. Ir. Mokhammad Amin Hariyadi, M.T', 'Kepala Program Studi Perpustakaan dan Ilmu Informasi'),
	(32, '6071', 'Perpustakaan dan Ilmu Informasi', 5, 'kajur', '65006', '196701182005011001', 'Dr. Ir. Mokhammad Amin Hariyadi, M.T', 'Kepala Program Studi Perpustakaan dan Ilmu Informasi'),
	(33, '6041', 'Fisika', 5, 'kajur', '64002', '196505041990031003', 'Drs. Abdul Basid, M.Si', 'Kepala Program Studi Fisika'),
	(34, '6031', 'Kimia', 5, 'kajur', '63008', '197906202006042002', 'Elok Kamilah Hayati, M.Si', 'Kepala Program Studi Kimia'),
	(35, '6021', 'Biologi', 5, 'kajur', '62010', '197410182003122002', 'Dr. Evika Sandi Savitri, M.P.', 'Kepala Program Studi Biologi'),
	(36, '6011', 'Matematika', 5, 'kajur', '61005', '196504142003121001', 'Dr. Usman Pagalay, M.Si', 'Kepala Program Studi Matematika'),
	(37, '6022', 'Magister Biologi', 5, 'kajur', '62003', '197109192000032001', 'Prof. Dr. drh. Hj. Bayyinatul Muchtaromah, M.Si', 'Kepala Program Studi Magister Biologi'),
	(28, '84', 'Magister Informatika', 5, 'kajur', '65001', '196805192003121001', 'Prof. Dr. Suhartono, M.Kom', 'Kepala Program Studi Magister Informatika'),
	(39, '6051', 'Teknik Informatika', 6, 'koorpkl', '65002', '197007312005011002', 'H. FATCHURROCHMAN,M.Kom', 'Koordinator PKL'),
	(40, '6011', 'Matematika', 6, 'koorpkl', '61008', '19770521200512004', 'Ari Kusumastuti, M.Si', 'Koordinator PKL'),
	(41, '6021', 'Biologi', 6, 'koorpkl', '52025', '197511062009122002', 'Kholifah Holil, M.Si', 'Koordinator PKL'),
	(42, '6031', 'Kimia', 6, 'koorpkl', '63023', '19830125201608012068', 'Rif\'atul Mahmudah, S.Si, M.Si', 'Koordinator PKL'),
	(43, '6041', 'Fisika', 6, 'koorpkl', '64006', '197405132003121001', 'FARID SAMSU HANANTO,S.Si., M.T.', 'Koordinator PKL'),
	(44, '6061', 'Teknik Arsitektur', 6, 'koorpkl', '66107', '2014048701', 'Moh. Arsyad Bahar,S.T., M.Sc', 'Koordinator PKL');
/*!40000 ALTER TABLE `pejabat` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
