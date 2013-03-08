-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 08, 2013 at 03:56 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cismart_tutorial_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `ex_data`
--

CREATE TABLE IF NOT EXISTS `ex_data` (
  `id_data` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `teks` varchar(50) DEFAULT NULL,
  `radiobaten` enum('single','suami','istri','anak') DEFAULT NULL,
  `selekbok` enum('yes','no') DEFAULT NULL,
  `selekbok_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_data`),
  KEY `FK_ex_data` (`selekbok_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `ex_data`
--

INSERT INTO `ex_data` (`id_data`, `teks`, `radiobaten`, `selekbok`, `selekbok_id`) VALUES
(3, 'rty', 'suami', 'yes', 4),
(4, 'Tambah lagi', 'suami', 'yes', 4),
(5, 'Masih Kurang', 'single', 'yes', 5);

-- --------------------------------------------------------

--
-- Table structure for table `ex_reference`
--

CREATE TABLE IF NOT EXISTS `ex_reference` (
  `id_ref` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_ref`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `ex_reference`
--

INSERT INTO `ex_reference` (`id_ref`, `nama`) VALUES
(1, 'Welly Widodo'),
(2, 'Maas Dianto'),
(3, 'Sambada Pamungkas'),
(4, 'Herlambang Sentosa'),
(5, 'Barid Yulianto'),
(6, 'Super Chow');

-- --------------------------------------------------------

--
-- Table structure for table `sys_build_menu_m`
--

CREATE TABLE IF NOT EXISTS `sys_build_menu_m` (
  `id_nav` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_parent` int(11) DEFAULT NULL,
  `judul` varchar(50) DEFAULT NULL,
  `deskripsi` varchar(100) DEFAULT NULL,
  `url_menu` varchar(255) DEFAULT NULL,
  `no_menu` int(11) unsigned DEFAULT NULL,
  `displayed` enum('yes','no') DEFAULT 'yes',
  PRIMARY KEY (`id_nav`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `sys_build_menu_m`
--

INSERT INTO `sys_build_menu_m` (`id_nav`, `id_parent`, `judul`, `deskripsi`, `url_menu`, `no_menu`, `displayed`) VALUES
(1, 0, 'Welcome', 'Selamat Datang', 'home/welcome', 1, 'yes'),
(2, 0, 'Templates', 'Contoh Standard Kode', 'template/intro', 2, 'yes'),
(4, 1, 'Selamat Datang', 'Selamat Datang', 'home/welcome', 11, 'yes'),
(5, 2, 'Controller Example', 'Halaman contoh controller', 'template/intro/controller', 21, 'yes'),
(20, 2, 'CRUD Templates', 'Halaman pengelolaan CRUD', 'template/crud', 22, 'yes'),
(21, 20, 'Tambah Data', 'Halaman form tambah data', 'template/crud/add', 221, 'yes'),
(22, 20, 'Edit Data', 'Halaman form edit data', 'template/crud/edit', 222, 'yes'),
(23, 20, 'Hapus Data', 'Halaman form hapus data', 'template/crud/hapus', 223, 'yes'),
(24, 2, 'Pagination with CI', 'Halaman contoh paging data', 'template/example/pagination', 23, 'yes'),
(25, 2, 'File Uploader', 'Halaman contoh upload', 'template/example/uploader', 24, 'yes'),
(26, 2, 'JQuery UI', 'Berkolaborasi dengan JQuery', 'template/example/jqueryui', 25, 'yes'),
(27, 2, 'JQuery Ajax', 'Berkolaborasi dengan Ajax', 'template/example/ajax_form', 26, 'yes'),
(28, 2, 'CI Email', 'Halaman pengelolaan email', 'template/example/email', 27, 'yes'),
(29, 2, 'PHP Excel', 'Halaman contoh pengelolaan php excel', 'template/excel', 28, 'yes'),
(30, 2, 'PHP PDF', 'Halaman contoh pengelolaan PDF', 'template/pdf', 29, 'yes'),
(31, 29, 'PHP Read Excel', 'Halaman contoh read excel', 'template/excel/read', 281, 'yes'),
(32, 2, 'PHP Jasper Report', 'Halaman Contoh PHP dengan Jasper Report', 'template/jasper', 29, 'yes'),
(33, 32, 'Jasper Report Print', 'Halaman print / output', 'template/jasper/report', 291, 'yes'),
(34, 2, 'Fusion Chart', 'Halaman grafik', 'template/chart', 30, 'yes');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ex_data`
--
ALTER TABLE `ex_data`
  ADD CONSTRAINT `FK_ex_data` FOREIGN KEY (`selekbok_id`) REFERENCES `ex_reference` (`id_ref`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
