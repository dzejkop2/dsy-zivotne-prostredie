-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Pát 10. kvě 2024, 09:09
-- Verze serveru: 10.4.28-MariaDB
-- Verze PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `zivotne_prostredie`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `data`
--

CREATE TABLE `data` (
  `id` int(16) NOT NULL,
  `kategoria_id` int(5) NOT NULL,
  `hodnota` decimal(5,2) NOT NULL,
  `senzor_id` int(5) NOT NULL,
  `datum` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_slovak_ci;

--
-- Vypisuji data pro tabulku `data`
--

INSERT INTO `data` (`id`, `kategoria_id`, `hodnota`, `senzor_id`, `datum`) VALUES
(1, 1, 40.00, 2, '2024-05-03 09:12:18'),
(2, 2, 18.00, 1, '2024-05-09 18:04:34'),
(3, 2, 8.00, 3, '2024-05-10 08:05:52'),
(4, 2, 19.00, 1, '2024-05-10 08:56:02');

-- --------------------------------------------------------

--
-- Struktura tabulky `kategoria`
--

CREATE TABLE `kategoria` (
  `id` int(5) NOT NULL,
  `nazov` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_slovak_ci;

--
-- Vypisuji data pro tabulku `kategoria`
--

INSERT INTO `kategoria` (`id`, `nazov`) VALUES
(1, 'vlhkost'),
(2, 'teplota');

-- --------------------------------------------------------

--
-- Struktura tabulky `role`
--

CREATE TABLE `role` (
  `id` int(5) NOT NULL,
  `nazov` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_slovak_ci;

--
-- Vypisuji data pro tabulku `role`
--

INSERT INTO `role` (`id`, `nazov`) VALUES
(1, 'vedec'),
(2, 'uradnik');

-- --------------------------------------------------------

--
-- Struktura tabulky `senzor`
--

CREATE TABLE `senzor` (
  `id` int(5) NOT NULL,
  `lokacia` varchar(64) NOT NULL,
  `posledny_update` datetime NOT NULL DEFAULT current_timestamp(),
  `vybavenie` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_slovak_ci;

--
-- Vypisuji data pro tabulku `senzor`
--

INSERT INTO `senzor` (`id`, `lokacia`, `posledny_update`, `vybavenie`) VALUES
(1, 'Kysucké Nové Mesto', '2024-05-03 09:08:14', 'teplomer'),
(2, 'Kysucké Nové Mesto', '2024-05-03 09:09:09', 'vlhkomer'),
(3, 'Vranov nad Topľou', '2024-05-10 07:57:47', 'teplomer');

-- --------------------------------------------------------

--
-- Struktura tabulky `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `meno` varchar(64) NOT NULL,
  `email` varchar(255) NOT NULL,
  `heslo` varchar(255) NOT NULL,
  `id_rola` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_slovak_ci;

--
-- Vypisuji data pro tabulku `users`
--

INSERT INTO `users` (`id`, `meno`, `email`, `heslo`, `id_rola`) VALUES
(1, 'Tonko Maslak', 'tonko@tonko.tonko', 'tonislav123', 2);

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategoria_id` (`kategoria_id`),
  ADD KEY `senzor_id` (`senzor_id`);

--
-- Indexy pro tabulku `kategoria`
--
ALTER TABLE `kategoria`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pro tabulku `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pro tabulku `senzor`
--
ALTER TABLE `senzor`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pro tabulku `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `FK_rola` (`id_rola`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `data`
--
ALTER TABLE `data`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pro tabulku `kategoria`
--
ALTER TABLE `kategoria`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pro tabulku `role`
--
ALTER TABLE `role`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pro tabulku `senzor`
--
ALTER TABLE `senzor`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pro tabulku `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `data`
--
ALTER TABLE `data`
  ADD CONSTRAINT `data_ibfk_1` FOREIGN KEY (`kategoria_id`) REFERENCES `kategoria` (`id`),
  ADD CONSTRAINT `data_ibfk_2` FOREIGN KEY (`senzor_id`) REFERENCES `senzor` (`id`);

--
-- Omezení pro tabulku `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_rola` FOREIGN KEY (`id_rola`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
