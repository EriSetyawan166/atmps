-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2022 at 12:10 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `social_media`
--

-- --------------------------------------------------------

--
-- Table structure for table `tweet2`
--

CREATE TABLE `tweet2` (
  `id` int(11) NOT NULL,
  `user_screen_name` text NOT NULL,
  `text` text NOT NULL,
  `sentiment` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tweet2`
--

INSERT INTO `tweet2` (`id`, `user_screen_name`, `text`, `sentiment`) VALUES
(1906, 'adhams', 'isibensin update hargabensin harga vivo revvo95 turun lain sih tampak ubah terima kasih lapor lapang mamang cuanidx -- web https t co vko34nej4g update bbm spbu hargabbm https t co pxc0lfpmig', 1),
(1907, 'Radar_Cirebon', 'harga bbm hari shell banting harga ron 92 bbm hargabbm https t co hjqefjqtfd', 0),
(1908, 'Radar_Cirebon', 'harga bbm hari untuk ron 92 shell super jadi murah bahkan kalah pertamax gin harga shell pertamax hargabbm https t co mttcplq7dd', 0),
(1909, 'DiswayOfficial', 'update harga bbm pertamina 16 november 2022 pertamax cs turun pertalite hargabbm subsidi pertamina pertamina https t co iie00ydkff', 0),
(1910, 'pwkcuk', '15 11 22 verifikasi calon terima danabansos dampak naik hargabbm pemprov jatim nelayan desa paloh paciran lamongan giatluhkansatminkalbwi puslatluhkp bppp banyuwangi dpp ipkani ipkani jatim ipkani la arochadiyan https t co zfr0zjytgs', 0),
(1911, 'alodav_', 'rt golkar2024dki singapura punya minyak punya kilang beli minyak kita btw sadar potensi penting kilang', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tweet2`
--
ALTER TABLE `tweet2`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tweet2`
--
ALTER TABLE `tweet2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1912;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
