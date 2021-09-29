-- --------------------------------------------------------
-- Host:                         10.10.7.113
-- Server version:               10.1.48-MariaDB-0ubuntu0.18.04.1 - Ubuntu 18.04
-- Server OS:                    debian-linux-gnu
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping data for table onlinev2.pejabat: ~30 rows (approximately)
DELETE FROM `pejabat`;
/*!40000 ALTER TABLE `pejabat` DISABLE KEYS */;
INSERT INTO `pejabat` (`no`, `prodi`, `kdjabatan`, `iddosen`, `nip`, `nama`, `jabatan`, `ttd`) VALUES
	(1, 'SAINTEK', 'dekan', '61004', '197310142001122002', 'Dr. Sri Harini, M.Si', 'Dekan', '197310142001122002.jpg');
INSERT INTO `pejabat` (`no`, `prodi`, `kdjabatan`, `iddosen`, `nip`, `nama`, `jabatan`, `ttd`) VALUES
	(2, 'SAINTEK', 'wadek1', '63007', '197709252006041003', 'Dr. Anton Prasetyo, M.Si', 'Wakil Dekan Bidang Akademik', '197709252006041003.png');
INSERT INTO `pejabat` (`no`, `prodi`, `kdjabatan`, `iddosen`, `nip`, `nama`, `jabatan`, `ttd`) VALUES
	(3, 'SAINTEK', 'wadek2', '63006', '197504102005012009', 'Dr. Akyunul Jannah, S.Si, M.P', 'Wakil Dekan Bidang AUPK', '197504102005012009.jpg');
INSERT INTO `pejabat` (`no`, `prodi`, `kdjabatan`, `iddosen`, `nip`, `nama`, `jabatan`, `ttd`) VALUES
	(4, 'SAINTEK', 'wadek3', '62007', '197403252003121001', 'Dr. Dwi Suheriyanto,S.Si, M.P.', 'Wakil Dekan Bidang Kemahasiswaan dan Kerja Sama', '197403252003121001.jpg');
INSERT INTO `pejabat` (`no`, `prodi`, `kdjabatan`, `iddosen`, `nip`, `nama`, `jabatan`, `ttd`) VALUES
	(49, 'Matematika', 'kaprodi', '61032', '197411292000122005', 'Dr. ELLY SUSANTI,S.Pd., M.Sc', 'Ketua Program Studi Matematika', NULL);
INSERT INTO `pejabat` (`no`, `prodi`, `kdjabatan`, `iddosen`, `nip`, `nama`, `jabatan`, `ttd`) VALUES
	(50, 'Matematika', 'sekprodi', '61011', '198005272008011012', 'FACHRUR ROZI,M.Si', 'Sekretaris Program Studi Matematika', NULL);
INSERT INTO `pejabat` (`no`, `prodi`, `kdjabatan`, `iddosen`, `nip`, `nama`, `jabatan`, `ttd`) VALUES
	(51, 'Biologi', 'kaprodi', '62010', '197410182003122002', 'Dr. EVIKA SANDI SAVITRI,M.P.', 'Ketua Program Studi Biologi', NULL);
INSERT INTO `pejabat` (`no`, `prodi`, `kdjabatan`, `iddosen`, `nip`, `nama`, `jabatan`, `ttd`) VALUES
	(52, 'Biologi', 'sekprodi', '62031', '198607252019032013', 'FITRIYAH, S.Si., M.Si', 'Sekretaris Program Studi Biologi', NULL);
INSERT INTO `pejabat` (`no`, `prodi`, `kdjabatan`, `iddosen`, `nip`, `nama`, `jabatan`, `ttd`) VALUES
	(53, 'Kimia', 'kaprodi', '63010', '198108112008012010', 'RACHMAWATI NINGSIH,M.Si', 'Ketua Program Studi Kimia', NULL);
INSERT INTO `pejabat` (`no`, `prodi`, `kdjabatan`, `iddosen`, `nip`, `nama`, `jabatan`, `ttd`) VALUES
	(54, 'Kimia', 'sekprodi', '63023', '19830125201608012068', 'RIF\'ATUL MAHMUDAH,M.Si', 'Sekretaris Program Studi Kimia', NULL);
INSERT INTO `pejabat` (`no`, `prodi`, `kdjabatan`, `iddosen`, `nip`, `nama`, `jabatan`, `ttd`) VALUES
	(55, 'Fisika', 'kaprodi', '64005', '197407302003121002', 'Dr. IMAM TAZI,M.Si', 'Ketua Program Studi Fisika', NULL);
INSERT INTO `pejabat` (`no`, `prodi`, `kdjabatan`, `iddosen`, `nip`, `nama`, `jabatan`, `ttd`) VALUES
	(56, 'Fisika', 'sekprodi', '64004', '196912312006041003', 'IRJAN,M.Si', 'Sekretaris Program Studi Fisika', NULL);
INSERT INTO `pejabat` (`no`, `prodi`, `kdjabatan`, `iddosen`, `nip`, `nama`, `jabatan`, `ttd`) VALUES
	(57, 'Teknik Informatika', 'kaprodi', '65135', '197710202009121001', 'Dr. FACHRUL KURNIAWAN, ST., M. MT., IPM', 'Ketua Program Studi Teknik Informatika', NULL);
INSERT INTO `pejabat` (`no`, `prodi`, `kdjabatan`, `iddosen`, `nip`, `nama`, `jabatan`, `ttd`) VALUES
	(58, 'Teknik Informatika', 'sekprodi', '65139', '198306162011011004', 'YUNIFA MIFTACHUL ARIF, M.T.', 'Sekretaris Program Studi Teknik Informatika', NULL);
INSERT INTO `pejabat` (`no`, `prodi`, `kdjabatan`, `iddosen`, `nip`, `nama`, `jabatan`, `ttd`) VALUES
	(59, 'Teknik Arsitektur', 'kaprodi', '66006', '197104262005012005', 'Dr. NUNIK JUNARA,M.T', 'Ketua Program Studi Teknik Arsitektur', NULL);
INSERT INTO `pejabat` (`no`, `prodi`, `kdjabatan`, `iddosen`, `nip`, `nama`, `jabatan`, `ttd`) VALUES
	(60, 'Teknik Arsitektur', 'sekprodi', '66007', '198009172005012003', 'LULUK MASLUCHA,S.T, M.Sc', 'Sekretaris Program Studi Teknik Arsitektur', NULL);
INSERT INTO `pejabat` (`no`, `prodi`, `kdjabatan`, `iddosen`, `nip`, `nama`, `jabatan`, `ttd`) VALUES
	(61, 'Perpustakaan dan Ilmu Informasi', 'kaprodi', '65006', '196701182005011001', 'Dr. Ir. MOKHAMMAD AMIN HARIYADI, M.T', 'Ketua Program Studi Perpustakaan dan Ilmu Informasi', NULL);
INSERT INTO `pejabat` (`no`, `prodi`, `kdjabatan`, `iddosen`, `nip`, `nama`, `jabatan`, `ttd`) VALUES
	(62, 'Perpustakaan dan Ilmu Informasi', 'sekprodi', '30254', '199002232018012001', 'NITA SITI MUDAWAMAH,M.IP', 'Sekretaris Program Studi Perpustakaan dan Ilmu Informasi', NULL);
INSERT INTO `pejabat` (`no`, `prodi`, `kdjabatan`, `iddosen`, `nip`, `nama`, `jabatan`, `ttd`) VALUES
	(63, 'Magister Biologi', 'kaprodi', '62003', '197109192000032001', 'Prof. Dr. drh. Hj. BAYYINATUL MUCHTAROMAH, M.Si', 'Ketua Program Studi Magister Biologi', NULL);
INSERT INTO `pejabat` (`no`, `prodi`, `kdjabatan`, `iddosen`, `nip`, `nama`, `jabatan`, `ttd`) VALUES
	(64, 'Magister Biologi', 'sekprodi', '62001', '196301141999031001', 'Dr. EKO BUDI MINARNO,M.Pd', 'Sekretaris Program Studi Magister Biologi', NULL);
INSERT INTO `pejabat` (`no`, `prodi`, `kdjabatan`, `iddosen`, `nip`, `nama`, `jabatan`, `ttd`) VALUES
	(65, 'Magister Informatika', 'kaprodi', '55022', '197404242009011008', 'Dr. CAHYO CRYSDIAN,MCS', 'Ketua Program Studi Magister Informatika', NULL);
INSERT INTO `pejabat` (`no`, `prodi`, `kdjabatan`, `iddosen`, `nip`, `nama`, `jabatan`, `ttd`) VALUES
	(66, 'Magister Informatika', 'sekprodi', '65003', '197203092005012002', 'Dr. RIRIEN KUSUMAWATI, S.Si, M.Kom', 'Sekretaris Program Studi Magister Informatika', NULL);
INSERT INTO `pejabat` (`no`, `prodi`, `kdjabatan`, `iddosen`, `nip`, `nama`, `jabatan`, `ttd`) VALUES
	(67, 'SAINTEK', 'kabag-tu', 'P00020', '197504182002122002', 'Faridah Abubakar M', 'Kepala Bagian Tata Usaha Fakultas', NULL);
INSERT INTO `pejabat` (`no`, `prodi`, `kdjabatan`, `iddosen`, `nip`, `nama`, `jabatan`, `ttd`) VALUES
	(68, 'SAINTEK', 'kasubag-akademik', 'P00065', '198007252006041002', 'Andy Irawan', 'Kepala Sub Bagian Akademik', NULL);
INSERT INTO `pejabat` (`no`, `prodi`, `kdjabatan`, `iddosen`, `nip`, `nama`, `jabatan`, `ttd`) VALUES
	(69, 'SAINTEK', 'kasubag-pak', 'P00048', '197810172005012001', 'FITRIA AMALIA DEWI', 'Kepala Sub Bagian PAK', NULL);
INSERT INTO `pejabat` (`no`, `prodi`, `kdjabatan`, `iddosen`, `nip`, `nama`, `jabatan`, `ttd`) VALUES
	(70, 'Perpustakaan dan Ilmu Informasi', 'koorpkl', '68016', '198801122020122002', 'ANNISA FAJRIYAH,M.A.', '', NULL);
INSERT INTO `pejabat` (`no`, `prodi`, `kdjabatan`, `iddosen`, `nip`, `nama`, `jabatan`, `ttd`) VALUES
	(71, 'Kimia', 'koorpkl', '65029', '19900906201802012239', 'LULUATUL HAMIDATU ULYA,M.Sc', '', NULL);
INSERT INTO `pejabat` (`no`, `prodi`, `kdjabatan`, `iddosen`, `nip`, `nama`, `jabatan`, `ttd`) VALUES
	(72, 'Biologi', 'koorpkl', '62049', '199205072019032026', 'TYAS NYONITA PUNJUNGSARI,S.Pd., M.Sc', '', NULL);
INSERT INTO `pejabat` (`no`, `prodi`, `kdjabatan`, `iddosen`, `nip`, `nama`, `jabatan`, `ttd`) VALUES
	(73, 'Teknik Arsitektur', 'koorpkl', '66107', '198704142019031007', 'MOH. ARSYAD BAHAR,S.T., M.Sc', '', NULL);
INSERT INTO `pejabat` (`no`, `prodi`, `kdjabatan`, `iddosen`, `nip`, `nama`, `jabatan`, `ttd`) VALUES
	(74, 'Matematika', 'koorpkl', '61017', '19900511201608011057', 'MUHAMMAD KHUDZAIFAH,M.Si', '', NULL);
INSERT INTO `pejabat` (`no`, `prodi`, `kdjabatan`, `iddosen`, `nip`, `nama`, `jabatan`, `ttd`) VALUES
	(75, 'Teknik Informatika', 'koorpkl', '65102', '197806252008012006', 'HANI NURHAYATI,M.T', '', NULL);
INSERT INTO `pejabat` (`no`, `prodi`, `kdjabatan`, `iddosen`, `nip`, `nama`, `jabatan`, `ttd`) VALUES
	(76, 'Fisika', 'koorpkl', '64018', '19880605201802012242', 'UTIYA HIKMAH,S.Si., M.Si', '', NULL);
/*!40000 ALTER TABLE `pejabat` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
