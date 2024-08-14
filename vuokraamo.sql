-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 13.08.2024 klo 11:15
-- Palvelimen versio: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vuokraamo`
--

-- --------------------------------------------------------

--
-- Rakenne taululle `asiakas`
--

CREATE TABLE `asiakas` (
  `asiakasID` int NOT NULL,
  `etunimi` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `sukunimi` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `sahkoposti` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `lahiosoite` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `postinumero` varchar(5) COLLATE utf8mb4_general_ci NOT NULL,
  `postitoimipaikka` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `puhelin` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `henkilotunnus` varchar(11) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vedos taulusta `asiakas`
--

INSERT INTO `asiakas` (`asiakasID`, `etunimi`, `sukunimi`, `sahkoposti`, `lahiosoite`, `postinumero`, `postitoimipaikka`, `puhelin`, `henkilotunnus`) VALUES
(1, 'Matti', 'Meikäläinen', 'matti.meikalainen@gmail.com', 'Salonkatu 1', '24100', 'Salo', '0441234567', '230500A234H'),
(2, 'Maija', 'Mattila', 'maija.mattila@sskky.fi', 'Salonkatu 2', '24100', 'Salo', '0443927820', '220601A456H'),
(5, 'Pekka', 'Pouta', 'pekka.pouta@gmail.com', 'Poudantie 52', '00500', 'Helsinki', '0509837722', '130476-3245'),
(6, 'Kalle', 'Nieminen', 'kalle.nieminen80@hotmail.com', 'Kylätie 12 as 5', '45100', 'Kauniainen', '0507238833', '110780-1145');

-- --------------------------------------------------------

--
-- Rakenne taululle `myyja`
--

CREATE TABLE `myyja` (
  `myyjaID` int NOT NULL,
  `nimi` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `kayttajatunnus` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `salasana` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `rooli` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vedos taulusta `myyja`
--

INSERT INTO `myyja` (`myyjaID`, `nimi`, `kayttajatunnus`, `salasana`, `rooli`) VALUES
(6, 'Saku Koivu', 'sakukoivu', '$2y$10$CMCT4AmK4iDPR0NnXmBIL.vub.Wv4OHoMlq0DMagLJ5psW1E33r.S', 'Myyjä'),
(7, 'Matti Lehtinen', 'matti.lehtinen', '$2y$10$CoLKR/yrbUwyt.Edd5Munu0OZvuiYlygtaYI2/o85TyUDX6fhOVRu', 'Myyjä');

-- --------------------------------------------------------

--
-- Rakenne taululle `tuote`
--

CREATE TABLE `tuote` (
  `tuoteID` int NOT NULL,
  `nimi` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kuvaus` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kpl` int NOT NULL,
  `painoraja` int NOT NULL,
  `kuva` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vedos taulusta `tuote`
--

INSERT INTO `tuote` (`tuoteID`, `nimi`, `kuvaus`, `kpl`, `painoraja`, `kuva`) VALUES
(4, 'Näyttö', '24 tuumainen näyttö', 1, 10, 'näyttö.jpeg'),
(5, 'Pelihiiri', 'Razer pelihiiri', 1, 5, 'razer.jpg'),
(6, 'Näppäimistö', 'Deltaco gaming keyboard', 5, 50, 'näppis.png');

-- --------------------------------------------------------

--
-- Rakenne taululle `vuokraus`
--

CREATE TABLE `vuokraus` (
  `vuokrausID` int NOT NULL,
  `asiakasID` int NOT NULL,
  `myyjaID` int NOT NULL,
  `vuokrauspvm` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vedos taulusta `vuokraus`
--

INSERT INTO `vuokraus` (`vuokrausID`, `asiakasID`, `myyjaID`, `vuokrauspvm`) VALUES
(17, 1, 7, '2024-08-13'),
(18, 6, 7, '2024-08-13');

-- --------------------------------------------------------

--
-- Rakenne taululle `vuokrausrivi`
--

CREATE TABLE `vuokrausrivi` (
  `vuokrausriviID` int NOT NULL,
  `vuokrausID` int NOT NULL,
  `tuoteID` int NOT NULL,
  `alkamisaika` date NOT NULL,
  `paattymisaika` date NOT NULL,
  `hinta` decimal(10,0) NOT NULL,
  `palautettu` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vedos taulusta `vuokrausrivi`
--

INSERT INTO `vuokrausrivi` (`vuokrausriviID`, `vuokrausID`, `tuoteID`, `alkamisaika`, `paattymisaika`, `hinta`, `palautettu`) VALUES
(11, 17, 4, '2024-08-13', '2024-08-20', 20, NULL),
(12, 17, 5, '2024-08-13', '2024-08-20', 15, NULL),
(13, 18, 6, '2024-08-14', '2024-08-16', 10, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `asiakas`
--
ALTER TABLE `asiakas`
  ADD PRIMARY KEY (`asiakasID`);

--
-- Indexes for table `myyja`
--
ALTER TABLE `myyja`
  ADD PRIMARY KEY (`myyjaID`);

--
-- Indexes for table `tuote`
--
ALTER TABLE `tuote`
  ADD PRIMARY KEY (`tuoteID`);

--
-- Indexes for table `vuokraus`
--
ALTER TABLE `vuokraus`
  ADD PRIMARY KEY (`vuokrausID`);

--
-- Indexes for table `vuokrausrivi`
--
ALTER TABLE `vuokrausrivi`
  ADD PRIMARY KEY (`vuokrausriviID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `asiakas`
--
ALTER TABLE `asiakas`
  MODIFY `asiakasID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `myyja`
--
ALTER TABLE `myyja`
  MODIFY `myyjaID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tuote`
--
ALTER TABLE `tuote`
  MODIFY `tuoteID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `vuokraus`
--
ALTER TABLE `vuokraus`
  MODIFY `vuokrausID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `vuokrausrivi`
--
ALTER TABLE `vuokrausrivi`
  MODIFY `vuokrausriviID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
