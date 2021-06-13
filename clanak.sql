-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2021 at 04:43 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clanak`
--

-- --------------------------------------------------------

--
-- Table structure for table `clanak`
--

CREATE TABLE `clanak` (
  `id` int(11) NOT NULL,
  `datum` varchar(32) COLLATE utf8mb4_croatian_ci NOT NULL,
  `naslov` varchar(64) COLLATE utf8mb4_croatian_ci NOT NULL,
  `podnaslov` text COLLATE utf8mb4_croatian_ci NOT NULL,
  `kategorija` varchar(64) COLLATE utf8mb4_croatian_ci NOT NULL,
  `slika` varchar(64) COLLATE utf8mb4_croatian_ci NOT NULL,
  `sadrzaj` text COLLATE utf8mb4_croatian_ci NOT NULL,
  `arhiva` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_croatian_ci;

--
-- Dumping data for table `clanak`
--

INSERT INTO `clanak` (`id`, `datum`, `naslov`, `podnaslov`, `kategorija`, `slika`, `sadrzaj`, `arhiva`) VALUES
(1, '06/13/2021', 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse rhoncus nisl eu dolor ultrici.', 'EUROPA', 'angela.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse rhoncus nisl eu dolor ultricies imperdiet. Vestibulum justo nulla, viverra vitae augue eget, mollis hendrerit arcu. Phasellus at consectetur lacus, quis accumsan quam. Duis tristique, sem ac posuere maximus, sapien massa hendrerit sapien, vel hendrerit est lacus id diam. Cras pulvinar auctor risus eu molestie. Duis congue mi at posuere porta. Praesent blandit varius facilisis. Etiam fermentum hendrerit augue, eget venenatis turpis convallis vitae. Aenean ut imperdiet ipsum. Fusce commodo nec nulla ac lobortis.Vivamus et nibh ultrices, condimentum lectus at, viverra magna. In hac habitasse platea dictumst. Donec viverra nibh in vehicula imperdiet. Fusce id sollicitudin orci, ultricies pellentesque orci. Aliquam finibus lobortis augue et lacinia. Aenean tempor metus vitae tortor hendrerit accumsan. Morbi id nisl mi. ', 1),
(2, '06/13/2021', 'In rutrum libero feugiat', 'Morbi ultricies malesuada nunc, at scelerisque arcu iaculis sit amet. Quisque auctor lectus felis.', 'EUROPA', 'angela2.jpg', 'In rutrum libero feugiat, commodo sapien mattis, maximus nulla. Phasellus cursus vehicula euismod. Donec volutpat turpis ac venenatis interdum. Fusce commodo nunc id pulvinar porta. Sed mattis ullamcorper erat, vel vestibulum purus dictum vel. Nam laoreet tempor gravida. Morbi commodo id ipsum at gravida. Donec scelerisque ex sit amet eros mollis, nec accumsan tortor cursus. Donec venenatis tempor pulvinar. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris ac tempus velit. Ut luctus mattis libero, a gravida nibh mollis eget. Etiam non hendrerit lectus. Pellentesque rhoncus neque nec massa sagittis, vel lacinia dolor cursus. In finibus iaculis ex vehicula vestibulum. ', 1),
(3, '06/13/2021', 'Angela Merkel Two', 'Insertiran nekakav tekst za testiranje :)', 'EUROPA', 'angela2.jpg', 'In rutrum libero feugiat, commodo sapien mattis, maximus nulla. Phasellus cursus vehicula euismod. Donec volutpat turpis ac venenatis interdum. Fusce commodo nunc id pulvinar porta. Sed mattis ullamcorper erat, vel vestibulum purus dictum vel. Nam laoreet tempor gravida. Morbi commodo id ipsum at gravida. Donec scelerisque ex sit amet eros mollis, nec accumsan tortor cursus. Donec venenatis tempor pulvinar. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris ac tempus velit. Ut luctus mattis libero, a gravida nibh mollis eget. Etiam non hendrerit lectus. Pellentesque rhoncus neque nec massa sagittis, vel lacinia dolor cursus. In finibus iaculis ex vehicula vestibulum. ', 1),
(4, '06/13/2021', 'Skriveni Clanak', 'Nevidljivi clanak.', 'EUROPA', 'burek.jpg', 'Ovaj clanak se ne bi trebao prikazivati na početnoj stranici.', 0),
(5, '06/13/2021', 'Morbi ultricies malesuada nunc', 'Morbi ultricies malesuada nunc, at scelerisque arcu iaculis sit amet. Quisque auctor lectus felis.', 'TEKNAUTAS', 'tek.jpg', 'Nunc nec ex tempus, placerat lacus quis, sodales augue. Donec et tincidunt velit. Praesent faucibus nunc risus, at condimentum sem gravida vel. Duis magna elit, porttitor ultricies massa a, sagittis dapibus risus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id` int(11) NOT NULL,
  `ime` varchar(32) COLLATE utf8mb4_croatian_ci NOT NULL,
  `prezime` varchar(32) COLLATE utf8mb4_croatian_ci NOT NULL,
  `korisnicko_ime` varchar(32) COLLATE utf8mb4_croatian_ci NOT NULL,
  `lozinka` varchar(255) COLLATE utf8mb4_croatian_ci NOT NULL,
  `razina` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_croatian_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `ime`, `prezime`, `korisnicko_ime`, `lozinka`, `razina`) VALUES
(1, 'Admin', '01', 'Administrator', '$2y$10$i522ejqAtAD1P7hT5prqhOYwpamvVObVCySrqM4KXzJPG/r.gijQe', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clanak`
--
ALTER TABLE `clanak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `korisnicko_ime` (`korisnicko_ime`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clanak`
--
ALTER TABLE `clanak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
