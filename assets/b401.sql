-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2020 at 05:07 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `b401`
--

-- --------------------------------------------------------

--
-- Table structure for table `asisten`
--

CREATE TABLE `asisten` (
  `asistenNRP` bigint(15) NOT NULL,
  `password` varchar(20) NOT NULL,
  `asistenNama` varchar(50) NOT NULL,
  `asistenHP` varchar(15) NOT NULL,
  `asistenEmail` varchar(20) NOT NULL,
  `asistenPic` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `asisten`
--

INSERT INTO `asisten` (`asistenNRP`, `password`, `asistenNama`, `asistenHP`, `asistenEmail`, `asistenPic`) VALUES
(7211840000029, '123', 'Tinezsia Adhisti', '082230469776', 'adhisti123@gmail.com', '1606491073_aaa.jpg'),
(7211840000077, 'putisyifa', 'Puti Syifa', '081555091198', 'puti_syifa@gmail.com', '1605948770_soldier_helmet_art_123765_1920x1080.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `asistensi`
--

CREATE TABLE `asistensi` (
  `id` int(11) NOT NULL,
  `asistenNRP` bigint(15) NOT NULL,
  `kelompok` varchar(35) NOT NULL,
  `jadwalId` int(150) NOT NULL,
  `praktikum` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `size` int(11) NOT NULL,
  `downloads` int(11) DEFAULT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'Process'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `asistensi`
--

INSERT INTO `asistensi` (`id`, `asistenNRP`, `kelompok`, `jadwalId`, `praktikum`, `name`, `size`, `downloads`, `status`) VALUES
(3, 7211840000029, 'Aragog', 10, 'LAB 1', 'Surat Pengumuman Lolos Semifinal Olim.pdf', 190856, 0, 'done'),
(5, 7211840000029, 'Aragog', 13, 'LAB 2', '072-029.pdf', 144741, 0, 'Process'),
(6, 7211840000077, 'Buckbeak', 4, 'LAB 1', 'TIM PENYISIHAN MAGE 6 - Sheet3.pdf', 23772, 0, 'Process');

-- --------------------------------------------------------

--
-- Table structure for table `jadwalasisten`
--

CREATE TABLE `jadwalasisten` (
  `id` int(11) NOT NULL,
  `asistenNRP` bigint(15) NOT NULL,
  `jadwalTanggal` date NOT NULL,
  `jadwalHari` varchar(15) NOT NULL,
  `mulai` time NOT NULL,
  `selesai` time NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwalasisten`
--

INSERT INTO `jadwalasisten` (`id`, `asistenNRP`, `jadwalTanggal`, `jadwalHari`, `mulai`, `selesai`, `status`) VALUES
(2, 7211840000077, '2020-11-10', 'Tuesday', '11:32:00', '00:32:00', 'Available'),
(4, 7211840000077, '2020-11-12', 'Thursday', '13:47:00', '14:47:00', 'Not Available'),
(10, 7211840000029, '2020-11-16', 'Monday', '18:30:00', '19:30:00', 'Not Available'),
(13, 7211840000029, '2020-11-20', 'Friday', '15:16:00', '16:16:00', 'Not Available'),
(18, 7211840000077, '2020-11-27', 'Saturday', '15:46:00', '16:46:00', 'Available'),
(19, 7211840000029, '2020-12-09', 'Wednesday', '22:31:00', '23:31:00', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `jadwalpraktikum`
--

CREATE TABLE `jadwalpraktikum` (
  `kelompok` varchar(20) NOT NULL,
  `praktikum` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jadwalpraktikum`
--

INSERT INTO `jadwalpraktikum` (`kelompok`, `praktikum`, `tanggal`, `jam`) VALUES
('Aragog', 'Praktikum 1', '2020-10-01', '19:00:00'),
('Buckbeak', 'Praktikum 1', '2020-10-01', '16:00:00'),
('Buckbeak', 'Praktikum 3', '2020-10-14', '16:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `praktikan`
--

CREATE TABLE `praktikan` (
  `praktikanId` int(150) NOT NULL,
  `praktikanNRP` bigint(15) NOT NULL,
  `password` varchar(100) NOT NULL,
  `praktikanKelompok` varchar(20) NOT NULL,
  `praktikanName` varchar(20) NOT NULL,
  `praktikanPhone` varchar(15) NOT NULL,
  `praktikanEmail` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `praktikan`
--

INSERT INTO `praktikan` (`praktikanId`, `praktikanNRP`, `password`, `praktikanKelompok`, `praktikanName`, `praktikanPhone`, `praktikanEmail`) VALUES
(8, 7211940000002, '15fbc02201f0a34c0078c230890f7991', 'Buckbeak', 'Cedric Diggory', '', 'cedrickindacool@gmail.com'),
(10, 7211940000001, 'df6f58808ebfd3e609c234cf2283a989', 'Aragog', 'Ginny Weasley', '', 'ginnyweasley@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `asisten`
--
ALTER TABLE `asisten`
  ADD PRIMARY KEY (`asistenNRP`);

--
-- Indexes for table `asistensi`
--
ALTER TABLE `asistensi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jadwalId` (`jadwalId`);

--
-- Indexes for table `jadwalasisten`
--
ALTER TABLE `jadwalasisten`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_NRP` (`asistenNRP`);

--
-- Indexes for table `praktikan`
--
ALTER TABLE `praktikan`
  ADD PRIMARY KEY (`praktikanId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `asistensi`
--
ALTER TABLE `asistensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jadwalasisten`
--
ALTER TABLE `jadwalasisten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `praktikan`
--
ALTER TABLE `praktikan`
  MODIFY `praktikanId` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `asistensi`
--
ALTER TABLE `asistensi`
  ADD CONSTRAINT `asistensi_ibfk_1` FOREIGN KEY (`jadwalId`) REFERENCES `jadwalasisten` (`id`);

--
-- Constraints for table `jadwalasisten`
--
ALTER TABLE `jadwalasisten`
  ADD CONSTRAINT `FK_NRP` FOREIGN KEY (`asistenNRP`) REFERENCES `asisten` (`asistenNRP`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
