-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2022 at 03:57 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wdp_rapor`
--

-- --------------------------------------------------------

--
-- Table structure for table `skl_absensi_siswa`
--

CREATE TABLE `skl_absensi_siswa` (
  `abs_id` bigint(20) NOT NULL,
  `abs_pd_id` bigint(20) DEFAULT NULL,
  `abs_ta_id` bigint(20) DEFAULT NULL,
  `abs_sakit` int(11) DEFAULT '0',
  `abs_izin` int(11) DEFAULT '0',
  `abs_alfa` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `skl_absensi_siswa`
--

INSERT INTO `skl_absensi_siswa` (`abs_id`, `abs_pd_id`, `abs_ta_id`, `abs_sakit`, `abs_izin`, `abs_alfa`) VALUES
(1, 1, 1, 1, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `skl_ekstrakurikuler`
--

CREATE TABLE `skl_ekstrakurikuler` (
  `eks_id` bigint(20) NOT NULL,
  `eks_nama` varchar(100) DEFAULT NULL,
  `eks_nilai` int(11) DEFAULT NULL,
  `eks_keterangan` varchar(100) DEFAULT NULL,
  `eks_pd_id` bigint(20) DEFAULT NULL,
  `eks_ta_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `skl_ekstrakurikuler`
--

INSERT INTO `skl_ekstrakurikuler` (`eks_id`, `eks_nama`, `eks_nilai`, `eks_keterangan`, `eks_pd_id`, `eks_ta_id`) VALUES
(3, 'Pramuka', 85, 'Baik', 1, 1),
(4, 'Rohis', 90, 'Sangat Baik', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `skl_guru`
--

CREATE TABLE `skl_guru` (
  `gru_id` bigint(20) NOT NULL,
  `gru_nip` varchar(20) DEFAULT NULL,
  `gru_nama` varchar(50) DEFAULT NULL,
  `gru_jk` smallint(1) DEFAULT NULL COMMENT '1=Laki-laki, 2=Perempuan',
  `gru_tpt_lahir` varchar(50) DEFAULT NULL,
  `gru_tgl_lahir` date DEFAULT NULL,
  `gru_nohp` varchar(20) DEFAULT NULL,
  `gru_email` varchar(100) DEFAULT NULL,
  `gru_alamat` varchar(100) DEFAULT NULL,
  `gru_agama` varchar(20) DEFAULT NULL,
  `gru_status` smallint(1) DEFAULT NULL,
  `gru_foto` text,
  `gru_date_created` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `skl_guru`
--

INSERT INTO `skl_guru` (`gru_id`, `gru_nip`, `gru_nama`, `gru_jk`, `gru_tpt_lahir`, `gru_tgl_lahir`, `gru_nohp`, `gru_email`, `gru_alamat`, `gru_agama`, `gru_status`, `gru_foto`, `gru_date_created`) VALUES
(1, '97234568', 'Anja Deni Kesuma, ST', 2, 'Teluk Kuantan', '1997-12-31', '081232464545', 'pung97@gmail.com', 'Jl. Garuda Sakti km 01', 'Islam', 1, 'foto_1645688494.png', '2022-02-24 14:41:34'),
(2, '984324634', 'Duis Tanti, ST', 2, 'Pasir Pengaraian', '1998-03-03', '0812343353', 'duis1998@gmail.com', 'Jl. Buluh Cina gg. buluh cina', 'Islam', 1, NULL, '2022-03-01 10:56:00');

-- --------------------------------------------------------

--
-- Table structure for table `skl_guru_mapel`
--

CREATE TABLE `skl_guru_mapel` (
  `gmp_id` bigint(20) NOT NULL,
  `gmp_gru_id` bigint(20) DEFAULT NULL,
  `gmp_mapel` bigint(20) DEFAULT NULL,
  `gmp_kelas` bigint(20) DEFAULT NULL,
  `gmp_ta` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `skl_guru_mapel`
--

INSERT INTO `skl_guru_mapel` (`gmp_id`, `gmp_gru_id`, `gmp_mapel`, `gmp_kelas`, `gmp_ta`) VALUES
(1, 1, 1, 1, 1),
(2, 2, 2, 2, 1),
(3, 1, 1, 2, 1),
(4, 2, 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `skl_kelas`
--

CREATE TABLE `skl_kelas` (
  `kls_id` bigint(20) NOT NULL,
  `kls_kode` varchar(20) DEFAULT NULL,
  `kls_nama` varchar(255) DEFAULT NULL,
  `kls_tingkat` int(11) DEFAULT NULL,
  `kls_wali_kelas` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `skl_kelas`
--

INSERT INTO `skl_kelas` (`kls_id`, `kls_kode`, `kls_nama`, `kls_tingkat`, `kls_wali_kelas`) VALUES
(1, 'KLS001', 'VII A', 1, '1'),
(2, 'KLS002', 'VII B', 1, '2');

-- --------------------------------------------------------

--
-- Table structure for table `skl_kelas_siswa`
--

CREATE TABLE `skl_kelas_siswa` (
  `kss_id` bigint(20) NOT NULL,
  `kss_kls_id` bigint(20) DEFAULT NULL,
  `kss_pd_id` bigint(20) DEFAULT NULL,
  `kss_ta_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `skl_kelas_siswa`
--

INSERT INTO `skl_kelas_siswa` (`kss_id`, `kss_kls_id`, `kss_pd_id`, `kss_ta_id`) VALUES
(1, 1, 1, 1),
(2, 2, 2, 1),
(3, 1, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `skl_login`
--

CREATE TABLE `skl_login` (
  `log_id` bigint(20) NOT NULL,
  `log_user` varchar(50) DEFAULT NULL,
  `log_nama` varchar(50) DEFAULT NULL,
  `log_pass` varchar(255) DEFAULT NULL,
  `log_level` smallint(1) DEFAULT NULL,
  `log_peg_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `skl_login`
--

INSERT INTO `skl_login` (`log_id`, `log_user`, `log_nama`, `log_pass`, `log_level`, `log_peg_id`) VALUES
(18, 'administrator', 'Administrator', 'ea60fc010787079d8aa3163ad9ef55e8', 1, NULL),
(19, 'admin', 'Admin', '21232f297a57a5a743894a0e4a801fc3', 2, NULL),
(20, '97234568', 'Anja Deni Kesuma, ST', '3e2e329864c44b10d85fc9f687278881', 3, 1),
(21, '984324634', 'Duis Tanti, ST', '827ccb0eea8a706c4c34a16891f84e7b', 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `skl_mata_pelajaran`
--

CREATE TABLE `skl_mata_pelajaran` (
  `mpl_id` bigint(20) NOT NULL,
  `mpl_kode` varchar(20) DEFAULT NULL,
  `mpl_nama` varchar(50) DEFAULT NULL,
  `mpl_kkm` int(20) DEFAULT NULL,
  `mpl_tingkat` smallint(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `skl_mata_pelajaran`
--

INSERT INTO `skl_mata_pelajaran` (`mpl_id`, `mpl_kode`, `mpl_nama`, `mpl_kkm`, `mpl_tingkat`) VALUES
(1, 'MPL001', 'Matematika', 75, 1),
(2, 'MPL002', 'Bahasa Indonesia', 80, 1);

-- --------------------------------------------------------

--
-- Table structure for table `skl_nilai_rapor`
--

CREATE TABLE `skl_nilai_rapor` (
  `rpr_id` bigint(20) NOT NULL,
  `rpr_pd_id` bigint(20) DEFAULT NULL,
  `rpr_mpl_id` bigint(20) DEFAULT NULL,
  `rpr_ta_id` bigint(20) DEFAULT NULL,
  `rpr_kls_id` bigint(20) DEFAULT NULL,
  `rpr_ph1` int(11) DEFAULT NULL,
  `rpr_ph2` int(11) DEFAULT NULL,
  `rpr_ph3` int(11) DEFAULT NULL,
  `rpr_rata_ph` int(11) DEFAULT NULL,
  `rpr_tgs1` int(11) DEFAULT NULL,
  `rpr_tgs2` int(11) DEFAULT NULL,
  `rpr_tgs3` int(11) DEFAULT NULL,
  `rpr_rata_tgs` int(11) DEFAULT NULL,
  `rpr_rata_nph` int(11) DEFAULT NULL,
  `rpr_pts` int(11) DEFAULT NULL,
  `rpr_pas` int(11) DEFAULT NULL,
  `rpr_nilai_akhir` int(11) DEFAULT NULL,
  `rpr_predikat` varchar(11) DEFAULT NULL,
  `rpr_deskripsi` varchar(20) DEFAULT NULL,
  `rpr_ph41` int(11) DEFAULT NULL,
  `rpr_ph42` int(11) DEFAULT NULL,
  `rpr_ph43` int(11) DEFAULT NULL,
  `rpr_rata_ph4` int(11) DEFAULT NULL,
  `rpr_status` smallint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `skl_nilai_rapor`
--

INSERT INTO `skl_nilai_rapor` (`rpr_id`, `rpr_pd_id`, `rpr_mpl_id`, `rpr_ta_id`, `rpr_kls_id`, `rpr_ph1`, `rpr_ph2`, `rpr_ph3`, `rpr_rata_ph`, `rpr_tgs1`, `rpr_tgs2`, `rpr_tgs3`, `rpr_rata_tgs`, `rpr_rata_nph`, `rpr_pts`, `rpr_pas`, `rpr_nilai_akhir`, `rpr_predikat`, `rpr_deskripsi`, `rpr_ph41`, `rpr_ph42`, `rpr_ph43`, `rpr_rata_ph4`, `rpr_status`) VALUES
(11, 1, 1, 1, 1, 80, 80, 85, 82, 90, 90, 70, 83, 83, 75, 80, 79, 'C', NULL, NULL, NULL, NULL, NULL, 1),
(13, 3, 2, 1, 1, 70, 70, 80, 73, 80, 75, 80, 78, 76, 85, 90, 84, 'B', NULL, NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `skl_ortu_wali`
--

CREATE TABLE `skl_ortu_wali` (
  `otw_id` int(11) NOT NULL,
  `otw_jenis` smallint(1) DEFAULT NULL COMMENT '1=ayah, 2=ibu, 3=wali',
  `otw_nama` varchar(30) DEFAULT NULL,
  `otw_thn_lahir` int(5) DEFAULT NULL,
  `otw_pekerjaan` varchar(100) DEFAULT NULL,
  `otw_alamat` varchar(100) DEFAULT NULL,
  `otw_nohp` varchar(20) DEFAULT NULL,
  `otw_agama` varchar(20) DEFAULT NULL,
  `otw_pd_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `skl_ortu_wali`
--

INSERT INTO `skl_ortu_wali` (`otw_id`, `otw_jenis`, `otw_nama`, `otw_thn_lahir`, `otw_pekerjaan`, `otw_alamat`, `otw_nohp`, `otw_agama`, `otw_pd_id`) VALUES
(1, 1, 'Selamet', 1969, 'Petani', 'Rawa Sekip', '08353452', 'Islam', 1);

-- --------------------------------------------------------

--
-- Table structure for table `skl_peserta_didik`
--

CREATE TABLE `skl_peserta_didik` (
  `pd_id` bigint(20) NOT NULL,
  `pd_nama` varchar(30) DEFAULT NULL,
  `pd_jk` smallint(1) DEFAULT NULL COMMENT '1=Laki-laki, 2=Perempuan',
  `pd_nisn` varchar(100) DEFAULT NULL,
  `pd_tpt_lahir` varchar(100) DEFAULT NULL,
  `pd_tgl_lahir` date DEFAULT NULL,
  `pd_nik` varchar(50) DEFAULT NULL,
  `pd_agama` varchar(20) DEFAULT NULL,
  `pd_foto` text,
  `pd_hp` varchar(15) DEFAULT NULL,
  `pd_anak_ke` int(11) DEFAULT NULL,
  `pd_status` smallint(1) DEFAULT NULL COMMENT '1=kandung, 2=tiri, 3=pungut',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `skl_peserta_didik`
--

INSERT INTO `skl_peserta_didik` (`pd_id`, `pd_nama`, `pd_jk`, `pd_nisn`, `pd_tpt_lahir`, `pd_tgl_lahir`, `pd_nik`, `pd_agama`, `pd_foto`, `pd_hp`, `pd_anak_ke`, `pd_status`, `date_created`) VALUES
(1, 'Novita Dewi', 2, '01394123', 'Aceh Darussalam', '1998-02-03', '124134341', 'Islam', 'foto-1645690750.7011.png', '0843584572', 2, 1, '2022-02-24 15:19:10'),
(2, 'Ardi Prima', 1, '0344357', 'Payakumbuh', '1998-06-07', '14234237', 'Islam', NULL, '08234352345', 1, 1, '2022-03-01 10:56:48'),
(3, 'Nanda Odela Pratiwi', 2, '8230423', 'Rengat', '1998-09-11', '1432323', 'Islam', NULL, '083453458734', 1, 1, '2022-03-07 13:11:36');

-- --------------------------------------------------------

--
-- Table structure for table `skl_sikap_siswa`
--

CREATE TABLE `skl_sikap_siswa` (
  `sks_id` bigint(20) NOT NULL,
  `sks_predikat_spiritual` varchar(11) DEFAULT NULL,
  `sks_deskripsi_spiritual` varchar(200) DEFAULT NULL,
  `sks_predikat_sosial` varchar(10) DEFAULT NULL,
  `sks_deskripsi_sosial` varchar(100) DEFAULT NULL,
  `sks_pd_id` bigint(20) DEFAULT NULL,
  `sks_ta_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `skl_sikap_siswa`
--

INSERT INTO `skl_sikap_siswa` (`sks_id`, `sks_predikat_spiritual`, `sks_deskripsi_spiritual`, `sks_predikat_sosial`, `sks_deskripsi_sosial`, `sks_pd_id`, `sks_ta_id`) VALUES
(1, 'Baik', 'coba', 'Cukup', 'coba 2', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `skl_tahun_ajaran`
--

CREATE TABLE `skl_tahun_ajaran` (
  `ta_id` bigint(20) NOT NULL,
  `ta_kode` varchar(20) DEFAULT NULL,
  `ta_tahun` varchar(20) DEFAULT NULL,
  `ta_semester` smallint(1) DEFAULT NULL COMMENT '1=ganjil, 2=genap',
  `ta_status` smallint(1) DEFAULT '0' COMMENT '1=aktif, 0=tidak aktif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `skl_tahun_ajaran`
--

INSERT INTO `skl_tahun_ajaran` (`ta_id`, `ta_kode`, `ta_tahun`, `ta_semester`, `ta_status`) VALUES
(1, 'AK2122', '2021/2022', 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `skl_absensi_siswa`
--
ALTER TABLE `skl_absensi_siswa`
  ADD PRIMARY KEY (`abs_id`) USING BTREE;

--
-- Indexes for table `skl_ekstrakurikuler`
--
ALTER TABLE `skl_ekstrakurikuler`
  ADD PRIMARY KEY (`eks_id`) USING BTREE;

--
-- Indexes for table `skl_guru`
--
ALTER TABLE `skl_guru`
  ADD PRIMARY KEY (`gru_id`) USING BTREE;

--
-- Indexes for table `skl_guru_mapel`
--
ALTER TABLE `skl_guru_mapel`
  ADD PRIMARY KEY (`gmp_id`) USING BTREE;

--
-- Indexes for table `skl_kelas`
--
ALTER TABLE `skl_kelas`
  ADD PRIMARY KEY (`kls_id`) USING BTREE;

--
-- Indexes for table `skl_kelas_siswa`
--
ALTER TABLE `skl_kelas_siswa`
  ADD PRIMARY KEY (`kss_id`) USING BTREE;

--
-- Indexes for table `skl_login`
--
ALTER TABLE `skl_login`
  ADD PRIMARY KEY (`log_id`) USING BTREE;

--
-- Indexes for table `skl_mata_pelajaran`
--
ALTER TABLE `skl_mata_pelajaran`
  ADD PRIMARY KEY (`mpl_id`) USING BTREE;

--
-- Indexes for table `skl_nilai_rapor`
--
ALTER TABLE `skl_nilai_rapor`
  ADD PRIMARY KEY (`rpr_id`);

--
-- Indexes for table `skl_ortu_wali`
--
ALTER TABLE `skl_ortu_wali`
  ADD PRIMARY KEY (`otw_id`) USING BTREE;

--
-- Indexes for table `skl_peserta_didik`
--
ALTER TABLE `skl_peserta_didik`
  ADD PRIMARY KEY (`pd_id`) USING BTREE;

--
-- Indexes for table `skl_sikap_siswa`
--
ALTER TABLE `skl_sikap_siswa`
  ADD PRIMARY KEY (`sks_id`) USING BTREE;

--
-- Indexes for table `skl_tahun_ajaran`
--
ALTER TABLE `skl_tahun_ajaran`
  ADD PRIMARY KEY (`ta_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `skl_absensi_siswa`
--
ALTER TABLE `skl_absensi_siswa`
  MODIFY `abs_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `skl_ekstrakurikuler`
--
ALTER TABLE `skl_ekstrakurikuler`
  MODIFY `eks_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `skl_guru`
--
ALTER TABLE `skl_guru`
  MODIFY `gru_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `skl_guru_mapel`
--
ALTER TABLE `skl_guru_mapel`
  MODIFY `gmp_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `skl_kelas`
--
ALTER TABLE `skl_kelas`
  MODIFY `kls_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `skl_kelas_siswa`
--
ALTER TABLE `skl_kelas_siswa`
  MODIFY `kss_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `skl_login`
--
ALTER TABLE `skl_login`
  MODIFY `log_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `skl_mata_pelajaran`
--
ALTER TABLE `skl_mata_pelajaran`
  MODIFY `mpl_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `skl_nilai_rapor`
--
ALTER TABLE `skl_nilai_rapor`
  MODIFY `rpr_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `skl_ortu_wali`
--
ALTER TABLE `skl_ortu_wali`
  MODIFY `otw_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `skl_peserta_didik`
--
ALTER TABLE `skl_peserta_didik`
  MODIFY `pd_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `skl_sikap_siswa`
--
ALTER TABLE `skl_sikap_siswa`
  MODIFY `sks_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `skl_tahun_ajaran`
--
ALTER TABLE `skl_tahun_ajaran`
  MODIFY `ta_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
