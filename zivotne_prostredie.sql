-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 06, 2024 at 07:05 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zivotne_prostredie`
--

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE `data` (
  `id` int(16) NOT NULL,
  `kategoria_id` int(5) NOT NULL,
  `hodnota` decimal(5,2) NOT NULL,
  `senzor_id` int(5) NOT NULL,
  `datum` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_slovak_ci;

--
-- Dumping data for table `data`
--

INSERT INTO `data` (`id`, `kategoria_id`, `hodnota`, `senzor_id`, `datum`) VALUES
(1, 1, 40.00, 2, '2024-05-03 09:12:18'),
(2, 2, 18.00, 1, '2024-05-09 18:04:34'),
(3, 2, 8.00, 3, '2024-05-10 08:05:52'),
(4, 2, 19.00, 1, '2024-05-10 08:56:02'),
(12, 1, 20.50, 4, '2024-05-28 17:12:02'),
(13, 2, 50.00, 1, '2024-05-30 18:50:58'),
(14, 2, 15.00, 1, '2024-05-23 18:51:34'),
(15, 2, 15.55, 1, '2024-05-31 06:13:24');

-- --------------------------------------------------------

--
-- Table structure for table `kategoria`
--

CREATE TABLE `kategoria` (
  `id` int(5) NOT NULL,
  `nazov` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_slovak_ci;

--
-- Dumping data for table `kategoria`
--

INSERT INTO `kategoria` (`id`, `nazov`) VALUES
(1, 'vlhkost'),
(2, 'teplota');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(5) NOT NULL,
  `nazov` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_slovak_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `nazov`) VALUES
(1, 'vedec'),
(2, 'uradnik'),
(3, 'obyvatel'),
(4, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `senzor`
--

CREATE TABLE `senzor` (
  `id` int(5) NOT NULL,
  `lokacia` varchar(64) NOT NULL,
  `posledny_update` datetime NOT NULL DEFAULT current_timestamp(),
  `vybavenie` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_slovak_ci;

--
-- Dumping data for table `senzor`
--

INSERT INTO `senzor` (`id`, `lokacia`, `posledny_update`, `vybavenie`) VALUES
(1, 'Kysucké Nové Mesto', '2024-05-26 16:13:24', 'teplomer'),
(2, 'Kysucké Nové Mesto', '2024-05-03 09:09:09', 'vlhkomer'),
(3, 'Vranov nad Topľou', '2024-05-23 19:48:08', 'teplomer'),
(4, 'Žabokreky nad Nitrou', '2024-05-26 15:36:52', 'teplomer'),
(5, 'Žabokreky nad Nitrou', '2024-05-26 16:22:27', 'vlhkomer');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `meno` varchar(64) NOT NULL,
  `email` varchar(255) NOT NULL,
  `heslo` varchar(255) NOT NULL,
  `id_rola` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_slovak_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `meno`, `email`, `heslo`, `id_rola`) VALUES
(9, 'admin', 'admin@admin.admin', 'admin123', 4),
(14, 'uradnik uradnik', 'uradnik@uradnik.uradnik', 'uradnik123', 2),
(15, 'obyvatel obyvatel', 'obyvatel@obyvatel.obyvatel', 'obyvatel123', 3),
(16, 'vedec vedec', 'vedec@vedec.vedec', 'vedec123', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategoria_id` (`kategoria_id`),
  ADD KEY `senzor_id` (`senzor_id`);

--
-- Indexes for table `kategoria`
--
ALTER TABLE `kategoria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `senzor`
--
ALTER TABLE `senzor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `FK_rola` (`id_rola`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data`
--
ALTER TABLE `data`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `kategoria`
--
ALTER TABLE `kategoria`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `senzor`
--
ALTER TABLE `senzor`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data`
--
ALTER TABLE `data`
  ADD CONSTRAINT `data_ibfk_1` FOREIGN KEY (`kategoria_id`) REFERENCES `kategoria` (`id`),
  ADD CONSTRAINT `data_ibfk_2` FOREIGN KEY (`senzor_id`) REFERENCES `senzor` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_rola` FOREIGN KEY (`id_rola`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
