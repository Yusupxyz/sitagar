-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 20, 2022 at 06:33 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sitager`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_berkas`
--

CREATE TABLE `data_berkas` (
  `id` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `sertifikasi` varchar(200) NOT NULL,
  `ijazah` varchar(200) NOT NULL,
  `transkrip` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `data_pegawai`
--

CREATE TABLE `data_pegawai` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `nik` varchar(30) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` varchar(50) NOT NULL,
  `jk` enum('0','1') NOT NULL,
  `pendidikan_terakhir` varchar(20) NOT NULL,
  `alamat` varchar(300) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `tahun_lulus` year(4) NOT NULL,
  `tanggal_sk_awal` varchar(50) NOT NULL,
  `tempat_tugas` varchar(100) NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status_verif` enum('0','1','2') NOT NULL DEFAULT '0',
  `catatan_verif` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User'),
(4, 'pimpinan', 'pemimpin');

-- --------------------------------------------------------

--
-- Table structure for table `groups_menu`
--

CREATE TABLE `groups_menu` (
  `id_groups` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups_menu`
--

INSERT INTO `groups_menu` (`id_groups`, `id_menu`) VALUES
(1, 8),
(1, 89),
(1, 42),
(1, 43),
(1, 44),
(1, 40),
(1, 91),
(1, 93),
(2, 94),
(2, 97),
(2, 95),
(1, 1),
(4, 1),
(1, 3),
(4, 3),
(1, 90),
(2, 90),
(4, 90),
(4, 98),
(4, 92),
(1, 99);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `kategori` char(2) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `min` int(10) NOT NULL,
  `max` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `kategori`, `keterangan`, `min`, `max`) VALUES
(1, 'A', 'Sangat Baik', 90, 100),
(2, 'B', 'Baik', 71, 80),
(3, 'C', 'Cukup', 65, 70),
(4, 'D', 'Kurang', 0, 65);

-- --------------------------------------------------------

--
-- Table structure for table `laporan_kinerja`
--

CREATE TABLE `laporan_kinerja` (
  `id` int(11) NOT NULL,
  `kegiatan` varchar(100) NOT NULL,
  `laporan` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `sort` int(11) NOT NULL DEFAULT 99,
  `level` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `icon` varchar(125) NOT NULL,
  `label` varchar(25) NOT NULL,
  `link` varchar(125) NOT NULL,
  `id` varchar(25) NOT NULL DEFAULT '#',
  `id_menu_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `sort`, `level`, `parent_id`, `icon`, `label`, `link`, `id`, `id_menu_type`) VALUES
(1, 0, 1, 0, 'empty', 'NAVIGASI UTAMA', '#', '#', 1),
(3, 1, 2, 1, 'fas fa-tachometer-alt', 'Beranda', 'dashboard', '#', 1),
(8, 12, 2, 40, 'fas fa-bars', 'Menu', 'cms/menu/side-menu', 'navMenu', 1),
(40, 10, 1, 0, 'empty', 'SETTING', '#', '#', 1),
(42, 14, 2, 40, 'fas fa-users-cog', 'User', '#', '1', 1),
(43, 15, 3, 42, 'fas fa-angle-double-right', 'Users', 'users', '1', 1),
(44, 16, 3, 42, 'fas fa-angle-double-right', 'Groups', 'groups', '2', 1),
(89, 13, 2, 40, 'fas fa-th-list', 'Menu Type', 'menu_type', 'menu_type', 1),
(90, 2, 1, 0, 'empty', 'UTAMA', '#', '#', 1),
(91, 7, 2, 90, 'fas fa-address-book', 'Data Pegawai Honorer', 'data_pegawai', '1', 1),
(92, 9, 2, 90, 'fas fa-database', 'Nilai Laporan Kinerja', 'nilai_laporan_kinerja', '2', 1),
(93, 8, 2, 90, 'fas fa-check', 'Verifikasi Data', 'verifikasi', '2', 1),
(94, 4, 2, 90, 'far fa-address-card', 'Biodata Diri', 'biodata_diri', '1', 1),
(95, 5, 2, 90, 'far fa-arrow-alt-circle-up', 'Unggah Berkas', 'data_berkas', '2', 1),
(97, 6, 2, 90, 'fas fa-align-center', 'Laporan Kinerja', 'laporan_kinerja', '4', 1),
(98, 3, 2, 90, 'far fa-address-card', 'Data Pegawai Honorer', 'daftar_pegawai', '1', 1),
(99, 11, 2, 40, 'far fa-calendar-alt', 'Kategori Nilai', 'kategori', '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu_type`
--

CREATE TABLE `menu_type` (
  `id_menu_type` int(11) NOT NULL,
  `type` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu_type`
--

INSERT INTO `menu_type` (`id_menu_type`, `type`) VALUES
(1, 'Side menu');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id` int(11) NOT NULL,
  `id_laporan_kinerja` int(11) NOT NULL,
  `tanggung_jawab` int(10) NOT NULL,
  `ketaatan` int(10) NOT NULL,
  `produktivitas` int(50) NOT NULL,
  `efesiensi` int(10) NOT NULL,
  `inovasi` int(10) NOT NULL,
  `kerja_sama` int(10) NOT NULL,
  `efektivitas` int(10) NOT NULL,
  `kecepatan` int(10) NOT NULL,
  `skor` int(10) NOT NULL,
  `id_kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(254) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `id_member` int(11) NOT NULL,
  `foto` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `id_member`, `foto`) VALUES
(1, '127.0.0.1', 'administrator', '$2y$08$mr9S/fF7pRzaQNd6KGHGkOATYnjBkZal85.Sk3XeO6uqTmftcNriq', '', 'admin@admin.com', '', 'm0vyKu2zW7L8PTG20bquF.707e055aeea8a30aca', 1541329145, '9M0SinsEBUuvB84r8JCLse', 1268889823, 1647754295, 1, 'Admin', 'istrator', 'ADMIN', '0', 0, 'd4a6a70372809d140297689f8d880319.jpg'),
(12, '::1', 'yusufxyz114@gmail.com', '$2y$08$BR2ZZlKEWSkL1UFzuPc9eOgSIhmtYAr6f4VslnKLEnEP85bv0SSyi', NULL, '1213', NULL, NULL, NULL, NULL, 1646585215, 1647745322, 1, '', '', '', '', 0, '7e1b6d3bb364ae941c3df865ed12fe8b.jpeg'),
(14, '::1', 'harianto@gmail.com', '$2y$08$3905T9R3LaFcJsOpS/0klu1agRD.ugQqVRmsWAqr.3UiqX4Olk8Ce', NULL, 'harianto@gmail.com', NULL, NULL, NULL, NULL, 1646949545, 1647748792, 1, 'Harianto', 'Purnomo', 'd', '00', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(3, 1, 1),
(26, 2, 2),
(27, 3, 3),
(30, 6, 2),
(31, 7, 2),
(32, 8, 2),
(33, 9, 2),
(34, 10, 2),
(35, 11, 2),
(36, 12, 2),
(37, 13, 2),
(40, 14, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_berkas`
--
ALTER TABLE `data_berkas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_pegawai`
--
ALTER TABLE `data_pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laporan_kinerja`
--
ALTER TABLE `laporan_kinerja`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `menu_type`
--
ALTER TABLE `menu_type`
  ADD PRIMARY KEY (`id_menu_type`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_berkas`
--
ALTER TABLE `data_berkas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `data_pegawai`
--
ALTER TABLE `data_pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `laporan_kinerja`
--
ALTER TABLE `laporan_kinerja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `menu_type`
--
ALTER TABLE `menu_type`
  MODIFY `id_menu_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
