-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2021. Nov 22. 19:38
-- Kiszolgáló verziója: 10.4.21-MariaDB
-- PHP verzió: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `web2_2`
--
CREATE DATABASE IF NOT EXISTS `web2_2` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `web2_2`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalok`
--

CREATE TABLE `felhasznalok` (
  `id` int(10) UNSIGNED NOT NULL,
  `csaladi_nev` varchar(45) NOT NULL DEFAULT '',
  `utonev` varchar(45) NOT NULL DEFAULT '',
  `bejelentkezes` varchar(12) NOT NULL DEFAULT '',
  `jelszo` varchar(40) NOT NULL DEFAULT '',
  `jogosultsag` varchar(3) NOT NULL DEFAULT '_1_'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `felhasznalok`
--

INSERT INTO `felhasznalok` (`id`, `csaladi_nev`, `utonev`, `bejelentkezes`, `jelszo`, `jogosultsag`) VALUES
(1, 'Rendszer', 'Admin', 'Admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', '__1'),
(2, 'Családi_2', 'Utónév_2', 'Login2', '6cf8efacae19431476020c1e2ebd2d8acca8f5c0', '_1_'),
(3, 'Családi_3', 'Utónév_3', 'Login3', 'df4d8ad070f0d1585e172a2150038df5cc6c891a', '_1_'),
(4, 'Családi_4', 'Utónév_4', 'Login4', 'b020c308c155d6bbd7eb7d27bd30c0573acbba5b', '_1_'),
(5, 'Családi_5', 'Utónév_5', 'Login5', '9ab1a4743b30b5e9c037e6a645f0cfee80fb41d4', '_1_'),
(6, 'Családi_6', 'Utónév_6', 'Login6', '7ca01f28594b1a06239b1d96fc716477d198470b', '_1_'),
(7, 'Családi_7', 'Utónév_7', 'Login7', '41ad7e5406d8f1af2deef2ade4753009976328f8', '_1_'),
(8, 'Családi_8', 'Utónév_8', 'Login8', '3a340fe3599746234ef89591e372d4dd8b590053', '_1_'),
(9, 'Családi_9', 'Utónév_9', 'Login9', 'c0298f7d314ecbc5651da5679a0a240833a88238', '_1_'),
(10, 'Családi_10', 'Utónév_10', 'Login10', 'a477427c183664b57f977661ac3167b64823f366', '_1_'),
(11, 'bubu', 'Maci', 'Azika', '8cb2237d0679ca88db6464eac60da96345513964', '_1_'),
(12, 'Szelig', 'Zsolt', 'Azeiel', '0b747df08c101950f4d1c5c76b04da20f1a2904f', '_1_'),
(13, 'Jonas', 'Mihaly', 'Dzsoni', '11904a4e8b77f6242e2d288705023adad00a9310', '_1_');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `lakig`
--

CREATE TABLE `lakig` (
  `igeny` date DEFAULT NULL,
  `szolgid` smallint(5) UNSIGNED DEFAULT NULL,
  `mennyiseg` int(11) UNSIGNED DEFAULT NULL,
  `azon` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `lakig`
--

INSERT INTO `lakig` (`igeny`, `szolgid`, `mennyiseg`, `azon`) VALUES
('2018-01-04', 5, 1, 1),
('2018-01-11', 5, 1, 2),
('2018-01-18', 4, 2, 3),
('2018-01-18', 5, 1, 4),
('2018-01-17', 3, 1, 5),
('2018-01-24', 5, 1, 6),
('2018-01-30', 1, 3, 7),
('2018-01-31', 4, 1, 8),
('2018-02-01', 5, 1, 9),
('2018-02-08', 5, 1, 10),
('2018-02-13', 4, 1, 11),
('2018-02-15', 5, 1, 12),
('2018-02-22', 5, 1, 13),
('2018-02-27', 1, 2, 14),
('2018-03-02', 4, 1, 15),
('2018-03-01', 5, 1, 16),
('2018-03-04', 3, 2, 17),
('2018-03-08', 5, 1, 18),
('2018-03-15', 5, 1, 19),
('2018-03-21', 5, 1, 20),
('2018-03-29', 5, 1, 21),
('2018-04-03', 3, 6, 22),
('2018-04-05', 5, 1, 23),
('2018-04-11', 3, 19, 24),
('2018-04-09', 4, 1, 25),
('2018-04-10', 5, 1, 26),
('2018-04-19', 5, 1, 27),
('2018-04-26', 5, 1, 28),
('2018-04-29', 3, 5, 29),
('2018-05-03', 5, 1, 30),
('2018-05-06', 3, 4, 31),
('2018-05-10', 5, 1, 32),
('2018-05-16', 3, 3, 33),
('2018-05-17', 5, 1, 34),
('2018-05-21', 3, 3, 35),
('2018-05-22', 1, 1, 36),
('2018-05-24', 4, 1, 37),
('2018-05-24', 5, 1, 38),
('2018-05-27', 3, 3, 39),
('2018-05-31', 5, 1, 40),
('2018-06-03', 5, 1, 41),
('2018-06-04', 3, 5, 42),
('2018-06-04', 1, 3, 43),
('2018-06-06', 4, 3, 44),
('2018-06-07', 5, 1, 45),
('2018-06-10', 5, 1, 46),
('2018-06-10', 3, 2, 47),
('2018-06-14', 5, 1, 48),
('2018-06-17', 5, 1, 49),
('2018-06-20', 3, 2, 50),
('2018-06-20', 4, 1, 51),
('2018-06-21', 5, 1, 52),
('2018-06-24', 5, 1, 53),
('2018-06-25', 3, 2, 54),
('2018-06-27', 5, 1, 55),
('2018-07-01', 5, 1, 56),
('2018-07-02', 3, 1, 57),
('2018-07-02', 4, 3, 58),
('2018-07-05', 5, 1, 59),
('2018-07-08', 5, 1, 60),
('2018-07-08', 3, 3, 61),
('2018-07-12', 5, 1, 62),
('2018-07-15', 5, 1, 63),
('2018-07-16', 3, 1, 64),
('2018-07-18', 1, 1, 65),
('2018-07-19', 4, 2, 66),
('2018-07-19', 5, 1, 67),
('2018-07-22', 5, 1, 68),
('2018-07-22', 3, 1, 69),
('2018-07-26', 5, 1, 70),
('2018-07-29', 5, 1, 71),
('2018-07-31', 3, 2, 72),
('2018-08-26', 5, 1, 73),
('2018-08-29', 3, 3, 74),
('2018-08-27', 1, 1, 75),
('2018-08-29', 4, 1, 76),
('2018-08-30', 5, 1, 77),
('2018-09-01', 3, 4, 78),
('2018-09-06', 5, 1, 79),
('2018-09-09', 3, 3, 80),
('2018-09-10', 1, 3, 81),
('2018-09-13', 5, 1, 82),
('2018-09-18', 3, 2, 83),
('2018-09-20', 5, 1, 84),
('2018-09-23', 3, 1, 85),
('2018-09-24', 4, 2, 86),
('2018-09-27', 5, 1, 87),
('2018-09-29', 3, 1, 88),
('2018-10-04', 5, 1, 89),
('2018-10-10', 3, 2, 90),
('2018-10-10', 5, 1, 91),
('2018-10-15', 3, 2, 92),
('2018-10-18', 5, 1, 93),
('2018-10-22', 3, 6, 94),
('2018-10-25', 5, 1, 95),
('2018-10-31', 3, 3, 96),
('2018-11-01', 5, 1, 97),
('2018-11-04', 3, 13, 98),
('2018-11-05', 1, 2, 99),
('2018-11-07', 4, 1, 100),
('2018-11-15', 5, 1, 101),
('2018-11-17', 3, 7, 102),
('2018-11-22', 5, 1, 103),
('2018-11-26', 3, 3, 104),
('2018-11-29', 5, 1, 105),
('2018-12-06', 5, 1, 106),
('2018-12-13', 5, 1, 107),
('2018-12-19', 4, 2, 108),
('2018-12-20', 5, 1, 109),
('2018-12-26', 5, 1, 110);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `menu`
--

CREATE TABLE `menu` (
  `url` varchar(30) NOT NULL,
  `nev` varchar(30) NOT NULL,
  `szulo` varchar(30) NOT NULL,
  `jogosultsag` varchar(3) NOT NULL,
  `sorrend` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `menu`
--

INSERT INTO `menu` (`url`, `nev`, `szulo`, `jogosultsag`, `sorrend`) VALUES
('admin', 'Admin', '', '001', 80),
('ajax', 'Ajax', '', '111', 50),
('belepes', 'Belépés', '', '100', 60),
('javascript', 'Javascript', '', '111', 21),
('kilepes', 'Kilépés', '', '011', 70),
('nyitolap', 'Nyitólap', '', '111', 10),
('regisztracio', 'Regisztráció', '', '100', 60),
('rest', 'REST', '', '111', 40),
('tcpdf', 'TCPDF', '', '111', 40);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `naptar`
--

CREATE TABLE `naptar` (
  `datum` date DEFAULT NULL,
  `szolgid` smallint(5) UNSIGNED DEFAULT NULL,
  `azon` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `naptar`
--

INSERT INTO `naptar` (`datum`, `szolgid`, `azon`) VALUES
('2018-01-03', 1, 1),
('2018-01-03', 4, 2),
('2018-01-04', 5, 3),
('2018-01-11', 5, 4),
('2018-01-17', 1, 5),
('2018-01-17', 4, 6),
('2018-01-18', 5, 7),
('2018-01-18', 3, 8),
('2018-01-25', 5, 9),
('2018-01-25', 3, 10),
('2018-01-31', 1, 11),
('2018-01-31', 4, 12),
('2018-02-01', 5, 13),
('2018-02-08', 5, 14),
('2018-02-14', 1, 15),
('2018-02-14', 4, 16),
('2018-02-15', 5, 17),
('2018-02-22', 5, 18),
('2018-02-28', 1, 19),
('2018-02-28', 4, 20),
('2018-03-01', 5, 21),
('2018-03-05', 3, 22),
('2018-03-08', 5, 23),
('2018-03-12', 3, 24),
('2018-03-14', 1, 25),
('2018-03-14', 4, 26),
('2018-03-15', 5, 27),
('2018-03-19', 3, 28),
('2018-03-22', 5, 29),
('2018-03-26', 3, 30),
('2018-03-28', 1, 31),
('2018-03-28', 4, 32),
('2018-03-29', 5, 33),
('2018-04-02', 3, 34),
('2018-04-05', 5, 35),
('2018-04-09', 3, 36),
('2018-04-11', 1, 37),
('2018-04-11', 4, 38),
('2018-04-12', 5, 39),
('2018-04-16', 3, 40),
('2018-04-19', 5, 41),
('2018-04-23', 3, 42),
('2018-04-25', 1, 43),
('2018-04-25', 4, 44),
('2018-04-26', 5, 45),
('2018-04-30', 3, 46),
('2018-05-03', 5, 47),
('2018-05-07', 3, 48),
('2018-05-09', 1, 49),
('2018-05-09', 4, 50),
('2018-05-10', 5, 51),
('2018-05-14', 3, 52),
('2018-05-17', 5, 53),
('2018-05-21', 3, 54),
('2018-05-23', 1, 55),
('2018-05-23', 4, 56),
('2018-05-24', 5, 57),
('2018-05-28', 3, 58),
('2018-05-31', 5, 59),
('2018-06-03', 5, 60),
('2018-06-04', 3, 61),
('2018-06-06', 1, 62),
('2018-06-06', 4, 63),
('2018-06-07', 5, 64),
('2018-06-10', 5, 65),
('2018-06-11', 3, 66),
('2018-06-14', 5, 67),
('2018-06-17', 5, 68),
('2018-06-18', 3, 69),
('2018-06-20', 1, 70),
('2018-06-20', 4, 71),
('2018-06-21', 5, 72),
('2018-06-24', 5, 73),
('2018-06-25', 3, 74),
('2018-06-28', 5, 75),
('2018-07-01', 5, 76),
('2018-07-02', 3, 77),
('2018-07-04', 1, 78),
('2018-07-04', 4, 79),
('2018-07-05', 5, 80),
('2018-07-08', 5, 81),
('2018-07-09', 3, 82),
('2018-07-12', 5, 83),
('2018-07-15', 5, 84),
('2018-07-16', 3, 85),
('2018-07-18', 1, 86),
('2018-07-18', 4, 87),
('2018-07-19', 5, 88),
('2018-07-22', 5, 89),
('2018-07-23', 3, 90),
('2018-07-26', 5, 91),
('2018-07-29', 5, 92),
('2018-07-30', 3, 93),
('2018-08-01', 1, 94),
('2018-08-01', 4, 95),
('2018-08-02', 5, 96),
('2018-08-05', 5, 97),
('2018-08-06', 3, 98),
('2018-08-09', 5, 99),
('2018-08-12', 5, 100),
('2018-08-13', 3, 101),
('2018-08-15', 1, 102),
('2018-08-15', 4, 103),
('2018-08-16', 5, 104),
('2018-08-19', 5, 105),
('2018-08-20', 3, 106),
('2018-08-23', 5, 107),
('2018-08-26', 5, 108),
('2018-08-27', 3, 109),
('2018-08-29', 1, 110),
('2018-08-29', 4, 111),
('2018-08-30', 5, 112),
('2018-09-03', 3, 113),
('2018-09-06', 5, 114),
('2018-09-10', 3, 115),
('2018-09-12', 1, 116),
('2018-09-12', 4, 117),
('2018-09-13', 5, 118),
('2018-09-17', 3, 119),
('2018-09-20', 5, 120),
('2018-09-24', 3, 121),
('2018-09-26', 1, 122),
('2018-09-26', 4, 123),
('2018-09-27', 5, 124),
('2018-10-01', 3, 125),
('2018-10-04', 5, 126),
('2018-10-08', 3, 127),
('2018-10-10', 1, 128),
('2018-10-10', 4, 129),
('2018-10-11', 5, 130),
('2018-10-15', 3, 131),
('2018-10-18', 5, 132),
('2018-10-22', 3, 133),
('2018-10-24', 1, 134),
('2018-10-24', 4, 135),
('2018-10-25', 5, 136),
('2018-10-29', 3, 137),
('2018-11-01', 5, 138),
('2018-11-05', 3, 139),
('2018-11-07', 1, 140),
('2018-11-07', 4, 141),
('2018-11-08', 5, 142),
('2018-11-12', 3, 143),
('2018-11-15', 5, 144),
('2018-11-19', 3, 145),
('2018-11-21', 1, 146),
('2018-11-21', 4, 147),
('2018-11-22', 5, 148),
('2018-11-26', 3, 149),
('2018-11-29', 5, 150),
('2018-12-05', 1, 151),
('2018-12-05', 4, 152),
('2018-12-06', 5, 153),
('2018-12-13', 5, 154),
('2018-12-19', 1, 155),
('2018-12-20', 5, 156),
('2018-12-27', 5, 157);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `szolgaltatas`
--

CREATE TABLE `szolgaltatas` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `tipus` varchar(55) DEFAULT NULL,
  `jelentes` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `szolgaltatas`
--

INSERT INTO `szolgaltatas` (`id`, `tipus`, `jelentes`) VALUES
(1, 'mua', 'Műanyag hulladék: PET palack, kozmetikai flakonok(PP+HDPE), szatyor, zacskó.'),
(2, 'uv', 'Üveg hulladék: színes és fehér üveg.'),
(3, 'zold', 'Zöldhulladék: komposztálható, kerti hulladékok.'),
(4, 'pa', 'Papírhulladékok: újságok, könyvek, kartondobozok.'),
(5, 'kom', 'Kommunális hulladék: szilárd, a lakókörnyezetünkben található, nem lebomló, nem veszélyes hulladék.');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `felhasznalok`
--
ALTER TABLE `felhasznalok`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `lakig`
--
ALTER TABLE `lakig`
  ADD PRIMARY KEY (`azon`),
  ADD KEY `szolgid` (`szolgid`);

--
-- A tábla indexei `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`url`);

--
-- A tábla indexei `naptar`
--
ALTER TABLE `naptar`
  ADD PRIMARY KEY (`azon`),
  ADD KEY `szolgid` (`szolgid`);

--
-- A tábla indexei `szolgaltatas`
--
ALTER TABLE `szolgaltatas`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `felhasznalok`
--
ALTER TABLE `felhasznalok`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT a táblához `lakig`
--
ALTER TABLE `lakig`
  MODIFY `azon` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT a táblához `naptar`
--
ALTER TABLE `naptar`
  MODIFY `azon` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT a táblához `szolgaltatas`
--
ALTER TABLE `szolgaltatas`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `lakig`
--
ALTER TABLE `lakig`
  ADD CONSTRAINT `lakig_fk1` FOREIGN KEY (`szolgid`) REFERENCES `szolgaltatas` (`id`);

--
-- Megkötések a táblához `naptar`
--
ALTER TABLE `naptar`
  ADD CONSTRAINT `naptar_fk1` FOREIGN KEY (`szolgid`) REFERENCES `szolgaltatas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
