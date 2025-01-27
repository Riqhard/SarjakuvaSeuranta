-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 27.01.2025 klo 11:54
-- Palvelimen versio: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sarjakuva_seuranta`
--

-- --------------------------------------------------------

--
-- Rakenne taululle `rememberme_tokens`
--

CREATE TABLE `rememberme_tokens` (
  `id` int(11) NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashed_validator` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `expiry` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vedos taulusta `rememberme_tokens`
--

INSERT INTO `rememberme_tokens` (`id`, `selector`, `hashed_validator`, `user_id`, `expiry`) VALUES
(58, 'bf2e0e050febdb26db417614993f5f28', '$2y$10$wLHOCYVWftmXYUQDskQYMuAOlEpMFkQXGC9AmSndCkNIAH0U2RzOW', 57, '2024-11-10 08:11:06'),
(59, '0c42d380acbc1ad0c44e4e6673e629b8', '$2y$10$2WeFGfwftZsoIKDRKe4vH.ALEcmhpwazW4cIVJ74c0c6AhQpgDpM.', 56, '2025-02-25 20:59:29');

-- --------------------------------------------------------

--
-- Rakenne taululle `resetpassword_tokens`
--

CREATE TABLE `resetpassword_tokens` (
  `users_id` int(9) NOT NULL,
  `token` varchar(255) NOT NULL,
  `voimassa` date NOT NULL,
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Rakenne taululle `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `value` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vedos taulusta `roles`
--

INSERT INTO `roles` (`id`, `name`, `value`) VALUES
(1, 'user', 1),
(2, 'mainuser', 2),
(3, 'admin', 4);

-- --------------------------------------------------------

--
-- Rakenne taululle `sarjakuvat`
--

CREATE TABLE `sarjakuvat` (
  `sarjakuva_id` smallint(6) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `image` varchar(500) DEFAULT NULL,
  `chapters` int(5) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vedos taulusta `sarjakuvat`
--

INSERT INTO `sarjakuvat` (`sarjakuva_id`, `title`, `description`, `image`, `chapters`, `created`) VALUES
(13, 'Fingerpori - 1', 'Fingerpori on mystinen maakunta jossakin päin Suomea. Sarjan maisemista löytyy niin kaupunkia kuin maalaispitäjääkin, ja sitä julkaisevat Helsingin Sanomien lisäksi jo mm. Aamulehti, Pohjalainen ja Karjalainen. Fingerporin lähistöllä sijaitsevat esimerkiksi Vatikaani, Mordor ja Mustanaamion pääkalloluola. Keskeisiä hahmoja ovat arkipäivän ihmettelijä Heimo Vesa ja suorasukainen kahvilanemäntä Rivo-Riitta.\r\n\r\nNauruhermoon iskevissä stripeissä historia toistaa vitsejään, sanaleikkiä lyödään ja käsitteitä levitellään.', 'Fingerpori-1_830fd9.jpg', 56, '2024-10-08 09:37:51'),
(18, 'Fingerpori - 2', 'Hassun hauska', 'Fingerpori-2_75d262.jpg', 150, '2024-10-11 10:10:31');

-- --------------------------------------------------------

--
-- Rakenne taululle `signup_tokens`
--

CREATE TABLE `signup_tokens` (
  `token` varchar(255) NOT NULL,
  `users_id` int(9) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Rakenne taululle `users`
--

CREATE TABLE `users` (
  `id` int(9) NOT NULL,
  `firstname` varchar(25) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `lastname` varchar(50) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobilenumber` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `is_active` enum('0','1') NOT NULL,
  `image` varchar(150) DEFAULT NULL,
  `role` int(4) NOT NULL DEFAULT 1,
  `created` datetime NOT NULL,
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Vedos taulusta `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `mobilenumber`, `password`, `token`, `is_active`, `image`, `role`, `created`, `updated`) VALUES
(56, 'Riku', '', 'RikuKilpimaa@hotmail.fi', '', '$2y$10$RVgG6H1pOga.i1Izmjh8ae36AiNEKEOmAVyFywcgNobGENkUUPfSK', '', '1', 'Asterix Ja Kadonnut Kilpi_5dbb1e.jpg', 3, '2024-10-07 08:58:53', '2024-10-10 07:08:10'),
(57, 'Riku', '', 'RalliRoope@jippii.fi', '', '$2y$10$vhX1R4uqTJIMorctCIZTduKIAp3iuGsVsvItI/I5W0N4y9WJsL08O', '', '1', 'fingerpori-17_d124ab.jpg', 1, '2024-10-08 08:21:13', '2024-10-11 07:27:12');

-- --------------------------------------------------------

--
-- Rakenne taululle `users_sarjakuvat`
--

CREATE TABLE `users_sarjakuvat` (
  `sarjakuva_id` smallint(5) UNSIGNED NOT NULL,
  `user_id` int(9) NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rememberme_tokens`
--
ALTER TABLE `rememberme_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indexes for table `resetpassword_tokens`
--
ALTER TABLE `resetpassword_tokens`
  ADD PRIMARY KEY (`users_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sarjakuvat`
--
ALTER TABLE `sarjakuvat`
  ADD PRIMARY KEY (`sarjakuva_id`);

--
-- Indexes for table `signup_tokens`
--
ALTER TABLE `signup_tokens`
  ADD PRIMARY KEY (`token`),
  ADD KEY `users_id` (`users_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `users_sarjakuvat`
--
ALTER TABLE `users_sarjakuvat`
  ADD PRIMARY KEY (`sarjakuva_id`,`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rememberme_tokens`
--
ALTER TABLE `rememberme_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sarjakuvat`
--
ALTER TABLE `sarjakuvat`
  MODIFY `sarjakuva_id` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- Rajoitteet vedostauluille
--

--
-- Rajoitteet taululle `rememberme_tokens`
--
ALTER TABLE `rememberme_tokens`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Rajoitteet taululle `resetpassword_tokens`
--
ALTER TABLE `resetpassword_tokens`
  ADD CONSTRAINT `resetpassword_tokens_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Rajoitteet taululle `signup_tokens`
--
ALTER TABLE `signup_tokens`
  ADD CONSTRAINT `signup_tokens_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
