-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Gen 18, 2022 alle 11:52
-- Versione del server: 10.4.14-MariaDB
-- Versione PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fantaroyale`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `amministratore`
--

CREATE TABLE `amministratore` (
  `id_admin` int(10) UNSIGNED NOT NULL,
  `admin_name` varchar(64) NOT NULL,
  `passwd` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `amministratore`
--

INSERT INTO `amministratore` (`id_admin`, `admin_name`, `passwd`) VALUES
(1, 'Alberto', '12345'),
(2, 'Pasquale', '12345'),
(6, 'Domenico', '$2y$10$D9wRUAhMV4fgKA3vWsxQ4eYDc6QPBhmn7Bgf3a8toM8kuJU2ymVgK'),
(7, 'Francesco', '$2y$10$vhiEfFOLFBkOJXXzY7CqreIi2OjJtV57xo8mUnkLYpXDWArW54BAy'),
(8, 'Giovanni', '$2y$10$oBpSZRRYxZI3Hx1HjDRST.TObciaEDO4kwSOPfSx8ZA12p0Xbi1A6');

-- --------------------------------------------------------

--
-- Struttura della tabella `articolo`
--

CREATE TABLE `articolo` (
  `id_articolo` int(10) UNSIGNED NOT NULL,
  `titolo` varchar(255) NOT NULL,
  `contenuto` text NOT NULL,
  `data_creazione` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tipologia` int(10) UNSIGNED NOT NULL,
  `autore` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `articolo`
--

INSERT INTO `articolo` (`id_articolo`, `titolo`, `contenuto`, `data_creazione`, `tipologia`, `autore`) VALUES
(26, 'Genoa-Sassuolo 2-2: cronaca, tabellino e voti del Fantacalcio', 'Nullam quis vehicula ex. Sed facilisis tellus urna, id ultricies risus condimentum at. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Nullam at lacus aliquam, mollis quam sit amet, malesuada urna. In id cursus augue, et ornare dolor. Aenean nec eros sapien. Aliquam at interdum mi. Donec a blandit sem, et congue odio. Praesent at est ac nibh elementum molestie. Morbi viverra finibus consectetur. Fusce lacinia quam eget tortor tincidunt pulvinar. Sed magna magna, pellentesque ac mi ac, feugiat posuere ante. Fusce neque nunc, pulvinar in condimentum eget, consectetur a ante. Quisque eu accumsan ipsum. Curabitur ac elit lacinia ex tincidunt suscipit. Vestibulum vel pretium nulla. Praesent convallis eget nisl sed sodales. Ut vel enim nibh. Sed sed ligula hendrerit, porttitor enim consectetur, blandit diam. Morbi volutpat eleifend vehicula. Pellentesque et ultricies tortor.', '2021-10-17 16:50:54', 3, 1),
(27, 'Udinese-Bologna: le formazioni ufficiali', 'Duis venenatis ligula at odio facilisis, rutrum rhoncus eros suscipit. Fusce vel tellus in leo lobortis mattis a a ante. Aenean sit amet lacinia quam. Sed eu nibh vestibulum, bibendum sem tincidunt, eleifend massa. Aenean volutpat blandit ipsum, non laoreet ligula elementum eu. Vestibulum ornare erat nec lectus mollis luctus. Phasellus vitae justo suscipit, tempor magna quis, faucibus dolor. Sed consequat vehicula lorem, imperdiet ullamcorper leo interdum non. Ut consectetur hendrerit porttitor. Aliquam tristique mollis velit nec imperdiet. Proin sit amet porttitor enim, quis finibus purus. Mauris et nunc commodo, laoreet enim rutrum, eleifend nulla.', '2021-10-17 16:55:10', 1, 2),
(28, 'Cagliari-Sampdoria 3-1: cronaca, tabellino e voti del fantacalci', 'Nunc at massa et libero placerat porttitor. In fringilla mi mi, at tempus tortor sollicitudin at. Sed laoreet ut ipsum nec aliquam. Nulla nec eros mollis, cursus magna et, efficitur magna. Vestibulum eu lobortis mauris. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer id eros vulputate, cursus mi eget, molestie sem. Sed ac massa quis mauris maximus ultricies. Curabitur a libero pulvinar, pulvinar quam non, sollicitudin augue. Fusce id tortor nec eros fringilla tristique. Sed nec finibus purus, ut venenatis nisl. Quisque eget neque eu ipsum accumsan tristique eu semper nisl.', '2021-10-17 16:55:49', 3, 2),
(29, 'Spezia, la prima perla di Kovalenko: \'Felice per il gol da tre p', 'Nunc at massa et libero placerat porttitor. In fringilla mi mi, at tempus tortor sollicitudin at. Sed laoreet ut ipsum nec aliquam. Nulla nec eros mollis, cursus magna et, efficitur magna. Vestibulum eu lobortis mauris. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer id eros vulputate, cursus mi eget, molestie sem. Sed ac massa quis mauris maximus ultricies. Curabitur a libero pulvinar, pulvinar quam non, sollicitudin augue. Fusce id tortor nec eros fringilla tristique. Sed nec finibus purus, ut venenatis nisl. Quisque eget neque eu ipsum accumsan tristique eu semper nisl.', '2021-10-17 16:56:46', 2, 1),
(31, 'Empoli-Atalanta: le formazioni ufficiali. Muriel salterà il match contro i toscani', 'Vivimus pretium auctor arcu, a hendrerit erat euismod sit amet. Duis eget venenatis tellus. Mauris porta, nulla in porttitor facilisis, ex felis gravida erat, ut blandit lorem tellus sit amet turpis. Nam in urna non turpis fermentum tincidunt eu at velit. Morbi sit amet rhoncus tellus. Sed tempor velit at sollicitudin dapibus. Pellentesque faucibus risus metus, vestibulum imperdiet enim pretium eget. Ut interdum mollis pulvinar. Morbi vel mauris ex. Integer consectetur urna sed tellus dapibus condimentum. Cras auctor ipsum at enim sagittis, vel scelerisque enim volutpat. Pellentesque molestie, tellus sed tristique tincidunt, mi nisi ultricies nulla, quis vestibulum est odio id nunc. Duis eu est egestas, hendrerit nulla vel, convallis ligula. Mauris finibus orci vel tincidunt convallis. Curabitur euismod id metus id maximus.', '2022-01-10 18:57:02', 3, 1),
(32, 'Genoa-Sassuolo: le formazioni ufficiali', 'In consectetur massa vel ex tempus fringilla. Aliquam a maximus massa. Suspendisse vel pretium sapien. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aenean nibh libero, convallis laoreet pharetra sed, vestibulum non tellus. Suspendisse dignissim erat vitae lectus gravida ornare. Mauris non diam vitae dui suscipit gravida in eget sapien. Nam pharetra laoreet neque, a eleifend magna condimentum ac. Nulla vitae vestibulum mi, ut ornare ipsum. Curabitur ornare sed eros eu vulputate. Phasellus a gravida elit. Proin dictum urna id libero ultrices pharetra. Quisque commodo, nibh in blandit sagittis, nulla orci porta mauris, vel pulvinar enim ex in massa. Sed pharetra nulla sed hendrerit vulputate.', '2021-10-17 16:59:11', 1, 1),
(33, 'Spezia, la prima perla di Kovalenko: Felice per il gol da tre punti', 'In consectetur massa vel ex tempus fringilla. Aliquam a maximus massa. Suspendisse vel pretium sapien. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aenean nibh libero, convallis laoreet pharetra sed, vestibulum non tellus. Suspendisse dignissim erat vitae lectus gravida ornare. Mauris non diam vitae dui suscipit gravida in eget sapien. Nam pharetra laoreet neque, a eleifend magna condimentum ac. Nulla vitae vestibulum mi, ut ornare ipsum. Curabitur ornare sed eros eu vulputate. Phasellus a gravida elit. Proin dictum urna id libero ultrices pharetra. Quisque commodo, nibh in blandit sagittis, nulla orci porta mauris, vel pulvinar enim ex in massa. Sed pharetra nulla sed hendrerit vulputate.', '2021-10-17 17:07:11', 1, 1),
(38, 'Simeone show: affossata la Lazio di Sarri da un poker del Cholito! ', 'Aliquam a maximus massa. Suspendisse vel pretium sapien. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aenean nibh libero, convallis laoreet pharetra sed, vestibulum non tellus. Suspendisse dignissim erat vitae lectus gravida ornare. Mauris non diam vitae dui suscipit gravida in eget sapien. Nam pharetra laoreet neque, a eleifend magna condimentum ac. Nulla vitae vestibulum mi, ut ornare ipsum. Curabitur ornare sed eros eu vulputate. Phasellus a gravida elit. Proin dictum urna id libero ultrices pharetra. Quisque commodo, nibh in blandit sagittis, nulla orci porta mauris, vel pulvinar enim ex in massa.', '2021-11-11 10:12:31', 3, 1),
(40, 'Stangata Juve! La capolista subisce una battuta d\'arresto al Mapei Stadium contro un ineluttabile Sassuolo', 'Proin tincidunt aliquam libero sed volutpat. Sed quam leo, cursus et sapien id, posuere luctus orci. Sed laoreet est in mauris sodales, a varius nunc varius. Curabitur lobortis fermentum sodales. Sed luctus sed magna non feugiat. Praesent pulvinar, libero sit amet interdum bibendum, ex massa lobortis metus, sodales placerat elit odio et nisi. Mauris tincidunt, lectus in tristique laoreet, enim tortor suscipit turpis, ac dignissim ligula metus ut ligula. Vivamus laoreet malesuada lorem at tincidunt. Integer lacinia, urna ut sodales egestas, sapien libero hendrerit sem, quis tincidunt libero orci et nunc. Pellentesque convallis eros diam, ac tempor turpis hendrerit id. Cras mattis dolor eget magna lacinia scelerisque. Nulla ipsum enim, eleifend sed suscipit in, accumsan sit amet diam. Aenean tellus urna, rhoncus id turpis ac, pellentesque interdum dolor. Proin imperdiet euismod cursus.', '2021-12-07 11:16:58', 3, 1),
(42, 'Le sorprese da schierare al Fantacalcio, UNDICI POSSIBILI SORPRESE DA SCHIERARE NELLA 21ª GIORNATA', 'Nullam varius sem vestibulum, dapibus tellus sed, porttitor neque. Integer libero est, fermentum id sodales ut, ultrices et libero. Praesent libero ipsum, dignissim ac molestie sed, bibendum sit amet erat. Morbi lacinia purus ac pulvinar imperdiet. Integer sed tortor tempus, vestibulum erat sit amet, feugiat lacus. Etiam et fringilla lacus. Vivamus a nulla ut leo semper pellentesque blandit eu nisi. Mauris in sodales mi. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Integer ac eros quis nisi viverra fermentum. Integer posuere ex quam, vitae consequat nunc lobortis ut. In mollis cursus.', '2022-01-16 14:59:45', 1, 7);

-- --------------------------------------------------------

--
-- Struttura della tabella `calciatore`
--

CREATE TABLE `calciatore` (
  `id_calciatore` int(10) UNSIGNED NOT NULL,
  `nominativo` varchar(64) NOT NULL,
  `prezzo` int(10) UNSIGNED NOT NULL,
  `ruolo` int(10) UNSIGNED NOT NULL,
  `club` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `calciatore`
--

INSERT INTO `calciatore` (`id_calciatore`, `nominativo`, `prezzo`, `ruolo`, `club`) VALUES
(38, 'Muriel', 40, 4, 1),
(40, 'Gosens', 30, 2, 1),
(43, 'Arnautovic', 20, 4, 2),
(44, 'Musso', 15, 1, 1),
(45, 'Handanovic', 17, 1, 7),
(46, 'Szczesny', 15, 1, 8),
(47, 'Maignan', 15, 1, 10),
(48, 'Meret', 14, 1, 11),
(49, 'Reina', 14, 1, 12),
(51, 'Audero', 10, 1, 14),
(53, 'Hernandez', 20, 2, 10),
(54, 'Cuadrado', 19, 2, 8),
(55, 'Skriniar', 16, 2, 7),
(56, 'Zappacosta', 15, 2, 1),
(57, 'Acerbi', 12, 2, 9),
(58, 'Yoshida', 9, 2, 14),
(59, 'Mkhitaryan', 31, 3, 12),
(60, 'Chiesa', 29, 3, 8),
(61, 'Kessie', 26, 3, 10),
(62, 'Malinovskyi', 25, 3, 1),
(64, 'Veretout', 25, 3, 12),
(65, 'Immobile', 39, 4, 9),
(66, 'Vlahovic', 33, 4, 5),
(67, 'Ibrahimovic', 32, 4, 10),
(68, 'Insigne', 32, 4, 11),
(74, 'Cragno', 9, 1, 3),
(75, 'Maehle', 12, 3, 1),
(76, 'Scamacca', 30, 4, 15),
(77, 'Silvestri', 7, 1, 18),
(78, 'Belec', 5, 1, 13),
(79, 'Erlic', 7, 2, 16),
(80, 'Bellanova', 4, 2, 3),
(81, 'Zortea', 2, 2, 13),
(82, 'Orsolini', 17, 3, 2),
(83, 'Bajrhami', 10, 3, 4),
(84, 'Mandragora', 8, 3, 17),
(85, 'Ricci', 5, 3, 4),
(86, 'Abrham', 25, 4, 12),
(87, 'Caputo', 22, 4, 14),
(88, 'Simeone', 17, 4, 20);

-- --------------------------------------------------------

--
-- Struttura della tabella `club`
--

CREATE TABLE `club` (
  `id_club` int(10) UNSIGNED NOT NULL,
  `nome` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `club`
--

INSERT INTO `club` (`id_club`, `nome`) VALUES
(1, 'Atalanta'),
(2, 'Bologna'),
(3, 'Cagliari'),
(4, 'Empoli'),
(5, 'Fiorentina'),
(6, 'Genoa'),
(7, 'Inter'),
(8, 'Juventus'),
(9, 'Lazio'),
(10, 'Milan'),
(11, 'Napoli'),
(12, 'Roma'),
(13, 'Salernitana'),
(14, 'Sampdoria'),
(15, 'Sassuolo'),
(16, 'Spezia'),
(17, 'Torino'),
(18, 'Udinese'),
(19, 'Venezia'),
(20, 'Verona');

-- --------------------------------------------------------

--
-- Struttura della tabella `competizione`
--

CREATE TABLE `competizione` (
  `id_competizione` int(10) UNSIGNED NOT NULL,
  `nome_competizione` varchar(64) NOT NULL,
  `data_creazione` datetime NOT NULL DEFAULT current_timestamp(),
  `prezzo_iscrizione` int(10) UNSIGNED NOT NULL,
  `numero_iscritti` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `max_iscritti` int(10) UNSIGNED DEFAULT NULL,
  `budget` int(10) UNSIGNED NOT NULL,
  `creatore` int(10) UNSIGNED NOT NULL,
  `data_termine` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `competizione`
--

INSERT INTO `competizione` (`id_competizione`, `nome_competizione`, `data_creazione`, `prezzo_iscrizione`, `numero_iscritti`, `max_iscritti`, `budget`, `creatore`, `data_termine`) VALUES
(39, 'Champions League', '2022-01-13 18:32:22', 35, 0, 150, 390, 6, '2022-08-31 00:00:00'),
(40, 'Europa League', '2022-01-13 18:36:44', 30, 1, 100, 400, 6, '2022-07-01 00:00:00'),
(41, 'Conference League', '2022-01-13 18:38:04', 20, 1, 80, 450, 6, '2022-06-14 20:30:00'),
(42, 'Serie A', '2022-01-13 18:40:02', 25, 3, 200, 350, 6, '2022-09-15 23:00:00'),
(43, 'Serie B', '2022-01-13 18:46:42', 20, 2, 120, 500, 6, '2022-05-31 21:00:00'),
(44, 'Premier League', '2022-01-13 18:50:55', 30, 4, 50, 300, 6, '2022-10-10 05:30:00');

-- --------------------------------------------------------

--
-- Struttura della tabella `formazione`
--

CREATE TABLE `formazione` (
  `squadra` int(10) UNSIGNED NOT NULL,
  `calciatore` int(10) UNSIGNED NOT NULL,
  `schierato` tinyint(1) NOT NULL DEFAULT 0,
  `giornata` int(10) UNSIGNED NOT NULL,
  `ora_inserimento` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `formazione`
--

INSERT INTO `formazione` (`squadra`, `calciatore`, `schierato`, `giornata`, `ora_inserimento`) VALUES
(34, 38, 0, 20, '2022-01-14 15:59:22'),
(34, 40, 1, 20, '2022-01-14 15:59:22'),
(34, 56, 1, 20, '2022-01-14 15:59:22'),
(34, 57, 1, 20, '2022-01-14 15:59:22'),
(34, 59, 1, 20, '2022-01-14 15:59:22'),
(34, 60, 1, 20, '2022-01-14 15:59:22'),
(34, 61, 1, 20, '2022-01-14 15:59:22'),
(34, 62, 0, 20, '2022-01-14 15:59:22'),
(34, 65, 1, 20, '2022-01-14 15:59:22'),
(34, 77, 1, 20, '2022-01-14 15:59:22'),
(34, 78, 0, 20, '2022-01-14 15:59:22'),
(34, 81, 0, 20, '2022-01-14 15:59:22'),
(34, 82, 1, 20, '2022-01-14 15:59:22'),
(34, 87, 1, 20, '2022-01-14 15:59:22'),
(34, 88, 1, 20, '2022-01-14 15:59:22'),
(35, 38, 1, 20, '2022-01-14 18:24:21'),
(35, 38, 0, 22, '2022-01-14 18:27:05'),
(35, 40, 1, 21, '2022-01-14 18:25:57'),
(35, 43, 0, 20, '2022-01-14 18:24:21'),
(35, 43, 1, 21, '2022-01-14 18:25:57'),
(35, 46, 1, 22, '2022-01-14 18:27:05'),
(35, 47, 1, 20, '2022-01-14 18:24:21'),
(35, 51, 0, 23, '2022-01-14 18:54:30'),
(35, 53, 1, 21, '2022-01-14 18:25:57'),
(35, 53, 1, 22, '2022-01-14 18:27:05'),
(35, 54, 1, 20, '2022-01-14 18:24:21'),
(35, 54, 1, 21, '2022-01-14 18:25:57'),
(35, 55, 0, 20, '2022-01-14 18:24:21'),
(35, 55, 0, 21, '2022-01-14 18:25:57'),
(35, 55, 1, 22, '2022-01-14 18:27:05'),
(35, 55, 1, 23, '2022-01-14 18:54:30'),
(35, 56, 1, 23, '2022-01-14 18:54:30'),
(35, 57, 1, 20, '2022-01-14 18:24:21'),
(35, 57, 0, 23, '2022-01-14 18:54:30'),
(35, 58, 1, 22, '2022-01-14 18:27:05'),
(35, 58, 1, 23, '2022-01-14 18:54:30'),
(35, 59, 1, 22, '2022-01-14 18:27:05'),
(35, 60, 1, 21, '2022-01-14 18:25:57'),
(35, 60, 1, 23, '2022-01-14 18:54:30'),
(35, 61, 1, 21, '2022-01-14 18:25:57'),
(35, 62, 1, 20, '2022-01-14 18:24:21'),
(35, 62, 1, 21, '2022-01-14 18:25:57'),
(35, 62, 1, 23, '2022-01-14 18:54:30'),
(35, 64, 1, 21, '2022-01-14 18:25:57'),
(35, 64, 1, 23, '2022-01-14 18:54:30'),
(35, 66, 1, 22, '2022-01-14 18:27:05'),
(35, 67, 1, 22, '2022-01-14 18:27:05'),
(35, 67, 1, 23, '2022-01-14 18:54:30'),
(35, 74, 1, 23, '2022-01-14 18:54:30'),
(35, 75, 0, 20, '2022-01-14 18:24:21'),
(35, 75, 1, 22, '2022-01-14 18:27:05'),
(35, 75, 0, 23, '2022-01-14 18:54:30'),
(35, 76, 1, 22, '2022-01-14 18:27:05'),
(35, 76, 1, 23, '2022-01-14 18:54:30'),
(35, 77, 0, 20, '2022-01-14 18:24:21'),
(35, 77, 0, 21, '2022-01-14 18:25:57'),
(35, 77, 0, 22, '2022-01-14 18:27:05'),
(35, 78, 1, 21, '2022-01-14 18:25:57'),
(35, 79, 1, 20, '2022-01-14 18:24:21'),
(35, 80, 0, 22, '2022-01-14 18:27:05'),
(35, 82, 1, 20, '2022-01-14 18:24:21'),
(35, 82, 1, 23, '2022-01-14 18:54:30'),
(35, 83, 1, 20, '2022-01-14 18:24:21'),
(35, 83, 0, 21, '2022-01-14 18:25:57'),
(35, 83, 1, 22, '2022-01-14 18:27:05'),
(35, 84, 1, 20, '2022-01-14 18:24:21'),
(35, 84, 1, 22, '2022-01-14 18:27:05'),
(35, 85, 0, 22, '2022-01-14 18:27:05'),
(35, 86, 1, 20, '2022-01-14 18:24:21'),
(35, 86, 1, 21, '2022-01-14 18:25:57'),
(35, 86, 1, 23, '2022-01-14 18:54:30'),
(35, 87, 1, 20, '2022-01-14 18:24:21'),
(35, 87, 1, 21, '2022-01-14 18:25:57'),
(35, 87, 0, 23, '2022-01-14 18:54:30'),
(35, 88, 0, 21, '2022-01-14 18:25:57'),
(39, 38, 1, 20, '2022-01-14 18:22:24'),
(39, 38, 1, 21, '2022-01-14 18:56:27'),
(39, 40, 1, 20, '2022-01-14 18:22:24'),
(39, 40, 1, 21, '2022-01-14 18:56:27'),
(39, 40, 1, 23, '2022-01-14 19:12:02'),
(39, 43, 0, 21, '2022-01-14 18:56:27'),
(39, 43, 0, 22, '2022-01-14 19:09:00'),
(39, 44, 0, 23, '2022-01-14 19:12:02'),
(39, 45, 1, 20, '2022-01-14 18:22:24'),
(39, 45, 1, 21, '2022-01-14 18:56:27'),
(39, 45, 1, 23, '2022-01-14 19:12:02'),
(39, 48, 1, 22, '2022-01-14 19:09:00'),
(39, 49, 0, 22, '2022-01-14 19:09:00'),
(39, 53, 1, 20, '2022-01-14 18:22:24'),
(39, 53, 1, 21, '2022-01-14 18:56:27'),
(39, 54, 0, 22, '2022-01-14 19:09:00'),
(39, 54, 1, 23, '2022-01-14 19:12:02'),
(39, 56, 1, 22, '2022-01-14 19:09:00'),
(39, 59, 1, 21, '2022-01-14 18:56:27'),
(39, 60, 1, 21, '2022-01-14 18:56:27'),
(39, 60, 1, 23, '2022-01-14 19:12:02'),
(39, 61, 1, 20, '2022-01-14 18:22:24'),
(39, 61, 0, 21, '2022-01-14 18:56:27'),
(39, 61, 1, 23, '2022-01-14 19:12:02'),
(39, 62, 1, 20, '2022-01-14 18:22:24'),
(39, 64, 1, 20, '2022-01-14 18:22:24'),
(39, 65, 1, 20, '2022-01-14 18:22:24'),
(39, 65, 1, 21, '2022-01-14 18:56:27'),
(39, 65, 1, 22, '2022-01-14 19:09:00'),
(39, 66, 1, 23, '2022-01-14 19:12:02'),
(39, 68, 1, 22, '2022-01-14 19:09:00'),
(39, 68, 1, 23, '2022-01-14 19:12:02'),
(39, 74, 0, 21, '2022-01-14 18:56:27'),
(39, 75, 1, 22, '2022-01-14 19:09:00'),
(39, 76, 1, 20, '2022-01-14 18:22:24'),
(39, 78, 0, 20, '2022-01-14 18:22:24'),
(39, 79, 1, 20, '2022-01-14 18:22:24'),
(39, 79, 1, 22, '2022-01-14 19:09:00'),
(39, 79, 0, 23, '2022-01-14 19:12:02'),
(39, 80, 0, 20, '2022-01-14 18:22:24'),
(39, 80, 0, 21, '2022-01-14 18:56:27'),
(39, 80, 1, 22, '2022-01-14 19:09:00'),
(39, 81, 1, 21, '2022-01-14 18:56:27'),
(39, 81, 1, 23, '2022-01-14 19:12:02'),
(39, 82, 0, 22, '2022-01-14 19:09:00'),
(39, 82, 1, 23, '2022-01-14 19:12:02'),
(39, 83, 1, 20, '2022-01-14 18:22:24'),
(39, 83, 1, 22, '2022-01-14 19:09:00'),
(39, 83, 1, 23, '2022-01-14 19:12:02'),
(39, 84, 1, 21, '2022-01-14 18:56:27'),
(39, 84, 1, 22, '2022-01-14 19:09:00'),
(39, 84, 0, 23, '2022-01-14 19:12:02'),
(39, 85, 0, 20, '2022-01-14 18:22:24'),
(39, 85, 1, 21, '2022-01-14 18:56:27'),
(39, 85, 1, 22, '2022-01-14 19:09:00'),
(39, 86, 1, 22, '2022-01-14 19:09:00'),
(39, 86, 0, 23, '2022-01-14 19:12:02'),
(39, 87, 1, 23, '2022-01-14 19:12:02'),
(39, 88, 0, 20, '2022-01-14 18:22:24'),
(39, 88, 1, 21, '2022-01-14 18:56:27'),
(40, 38, 1, 21, '2022-01-14 19:15:15'),
(40, 38, 1, 23, '2022-01-14 19:17:51'),
(40, 40, 0, 23, '2022-01-14 19:17:51'),
(40, 43, 1, 21, '2022-01-14 19:15:15'),
(40, 43, 1, 23, '2022-01-14 19:17:51'),
(40, 44, 0, 20, '2022-01-14 16:40:19'),
(40, 45, 1, 20, '2022-01-14 16:40:19'),
(40, 46, 1, 23, '2022-01-14 19:17:51'),
(40, 47, 1, 21, '2022-01-14 19:15:15'),
(40, 47, 0, 23, '2022-01-14 19:17:51'),
(40, 51, 1, 22, '2022-01-14 19:17:08'),
(40, 53, 1, 21, '2022-01-14 19:15:15'),
(40, 53, 1, 23, '2022-01-14 19:17:51'),
(40, 54, 0, 21, '2022-01-14 19:15:15'),
(40, 56, 1, 21, '2022-01-14 19:15:15'),
(40, 56, 1, 22, '2022-01-14 19:17:08'),
(40, 57, 1, 22, '2022-01-14 19:17:08'),
(40, 57, 1, 23, '2022-01-14 19:17:51'),
(40, 58, 1, 20, '2022-01-14 16:40:19'),
(40, 58, 1, 22, '2022-01-14 19:17:08'),
(40, 60, 1, 20, '2022-01-14 16:40:19'),
(40, 60, 1, 21, '2022-01-14 19:15:15'),
(40, 60, 1, 23, '2022-01-14 19:17:51'),
(40, 61, 1, 20, '2022-01-14 16:40:19'),
(40, 61, 1, 23, '2022-01-14 19:17:51'),
(40, 62, 0, 21, '2022-01-14 19:15:15'),
(40, 62, 0, 23, '2022-01-14 19:17:51'),
(40, 64, 1, 22, '2022-01-14 19:17:08'),
(40, 65, 1, 20, '2022-01-14 16:40:19'),
(40, 66, 1, 20, '2022-01-14 16:40:19'),
(40, 67, 0, 20, '2022-01-14 16:40:19'),
(40, 67, 1, 22, '2022-01-14 19:17:08'),
(40, 68, 1, 20, '2022-01-14 16:40:19'),
(40, 74, 0, 22, '2022-01-14 19:17:08'),
(40, 75, 1, 21, '2022-01-14 19:15:15'),
(40, 75, 1, 22, '2022-01-14 19:17:08'),
(40, 76, 1, 22, '2022-01-14 19:17:08'),
(40, 78, 0, 21, '2022-01-14 19:15:15'),
(40, 79, 0, 20, '2022-01-14 16:40:19'),
(40, 79, 1, 21, '2022-01-14 19:15:15'),
(40, 79, 0, 22, '2022-01-14 19:17:08'),
(40, 80, 1, 20, '2022-01-14 16:40:19'),
(40, 80, 1, 23, '2022-01-14 19:17:51'),
(40, 81, 1, 20, '2022-01-14 16:40:19'),
(40, 82, 1, 21, '2022-01-14 19:15:15'),
(40, 83, 1, 20, '2022-01-14 16:40:19'),
(40, 83, 1, 22, '2022-01-14 19:17:08'),
(40, 83, 1, 23, '2022-01-14 19:17:51'),
(40, 84, 1, 20, '2022-01-14 16:40:19'),
(40, 84, 1, 22, '2022-01-14 19:17:08'),
(40, 84, 1, 23, '2022-01-14 19:17:51'),
(40, 85, 0, 20, '2022-01-14 16:40:19'),
(40, 85, 1, 21, '2022-01-14 19:15:15'),
(40, 85, 0, 22, '2022-01-14 19:17:08'),
(40, 86, 1, 21, '2022-01-14 19:15:15'),
(40, 86, 1, 22, '2022-01-14 19:17:08'),
(40, 87, 0, 22, '2022-01-14 19:17:08'),
(40, 87, 1, 23, '2022-01-14 19:17:51'),
(40, 88, 0, 21, '2022-01-14 19:15:15'),
(40, 88, 0, 23, '2022-01-14 19:17:51'),
(41, 38, 1, 20, '2022-01-14 16:31:48'),
(41, 40, 1, 20, '2022-01-14 16:31:48'),
(41, 49, 1, 20, '2022-01-14 16:31:48'),
(41, 51, 0, 20, '2022-01-14 16:31:48'),
(41, 59, 1, 20, '2022-01-14 16:31:48'),
(41, 60, 1, 20, '2022-01-14 16:31:48'),
(41, 61, 1, 20, '2022-01-14 16:31:48'),
(41, 62, 0, 20, '2022-01-14 16:31:48'),
(41, 64, 1, 20, '2022-01-14 16:31:48'),
(41, 65, 1, 20, '2022-01-14 16:31:48'),
(41, 66, 1, 20, '2022-01-14 16:31:48'),
(41, 68, 0, 20, '2022-01-14 16:31:48'),
(41, 79, 1, 20, '2022-01-14 16:31:48'),
(41, 80, 1, 20, '2022-01-14 16:31:48'),
(41, 81, 0, 20, '2022-01-14 16:31:48'),
(42, 38, 0, 23, '2022-01-14 21:17:42'),
(42, 40, 1, 20, '2022-01-14 16:33:27'),
(42, 43, 1, 20, '2022-01-14 16:33:27'),
(42, 43, 0, 21, '2022-01-14 20:58:35'),
(42, 44, 1, 20, '2022-01-14 16:33:27'),
(42, 45, 0, 20, '2022-01-14 16:33:27'),
(42, 46, 1, 23, '2022-01-14 21:17:42'),
(42, 47, 1, 22, '2022-01-14 21:16:05'),
(42, 47, 0, 23, '2022-01-14 21:17:42'),
(42, 49, 0, 22, '2022-01-14 21:16:05'),
(42, 53, 1, 20, '2022-01-14 16:33:27'),
(42, 54, 1, 20, '2022-01-14 16:33:27'),
(42, 54, 1, 22, '2022-01-14 21:16:05'),
(42, 55, 0, 20, '2022-01-14 16:33:27'),
(42, 55, 1, 23, '2022-01-14 21:17:42'),
(42, 56, 0, 21, '2022-01-14 20:58:35'),
(42, 56, 1, 23, '2022-01-14 21:17:42'),
(42, 57, 1, 22, '2022-01-14 21:16:05'),
(42, 58, 1, 21, '2022-01-14 20:58:35'),
(42, 58, 1, 22, '2022-01-14 21:16:05'),
(42, 58, 0, 23, '2022-01-14 21:17:42'),
(42, 60, 1, 21, '2022-01-14 20:58:35'),
(42, 60, 1, 22, '2022-01-14 21:16:05'),
(42, 61, 1, 20, '2022-01-14 16:33:27'),
(42, 61, 1, 21, '2022-01-14 20:58:35'),
(42, 62, 1, 20, '2022-01-14 16:33:27'),
(42, 64, 1, 20, '2022-01-14 16:33:27'),
(42, 64, 0, 21, '2022-01-14 20:58:35'),
(42, 64, 1, 22, '2022-01-14 21:16:05'),
(42, 64, 0, 23, '2022-01-14 21:17:42'),
(42, 65, 1, 23, '2022-01-14 21:17:42'),
(42, 66, 1, 20, '2022-01-14 16:33:27'),
(42, 66, 1, 21, '2022-01-14 20:58:35'),
(42, 66, 1, 23, '2022-01-14 21:17:42'),
(42, 67, 1, 22, '2022-01-14 21:16:05'),
(42, 68, 1, 23, '2022-01-14 21:17:42'),
(42, 74, 0, 21, '2022-01-14 20:58:35'),
(42, 75, 1, 23, '2022-01-14 21:17:42'),
(42, 76, 0, 22, '2022-01-14 21:16:05'),
(42, 77, 1, 21, '2022-01-14 20:58:35'),
(42, 79, 1, 21, '2022-01-14 20:58:35'),
(42, 79, 0, 22, '2022-01-14 21:16:05'),
(42, 79, 1, 23, '2022-01-14 21:17:42'),
(42, 80, 1, 21, '2022-01-14 20:58:35'),
(42, 82, 1, 22, '2022-01-14 21:16:05'),
(42, 82, 1, 23, '2022-01-14 21:17:42'),
(42, 83, 1, 20, '2022-01-14 16:33:27'),
(42, 83, 1, 21, '2022-01-14 20:58:35'),
(42, 83, 1, 23, '2022-01-14 21:17:42'),
(42, 84, 1, 21, '2022-01-14 20:58:35'),
(42, 84, 0, 22, '2022-01-14 21:16:05'),
(42, 84, 1, 23, '2022-01-14 21:17:42'),
(42, 85, 0, 20, '2022-01-14 16:33:27'),
(42, 85, 1, 22, '2022-01-14 21:16:05'),
(42, 86, 1, 21, '2022-01-14 20:58:35'),
(42, 86, 1, 22, '2022-01-14 21:16:05'),
(42, 87, 1, 20, '2022-01-14 16:33:27'),
(42, 87, 1, 21, '2022-01-14 20:58:35'),
(42, 87, 1, 22, '2022-01-14 21:16:05'),
(42, 88, 0, 20, '2022-01-14 16:33:27'),
(43, 38, 1, 20, '2022-01-14 16:34:37'),
(43, 44, 0, 20, '2022-01-14 16:34:37'),
(43, 45, 1, 20, '2022-01-14 16:34:37'),
(43, 53, 1, 20, '2022-01-14 16:34:37'),
(43, 54, 1, 20, '2022-01-14 16:34:37'),
(43, 60, 1, 20, '2022-01-14 16:34:37'),
(43, 64, 1, 20, '2022-01-14 16:34:37'),
(43, 65, 1, 20, '2022-01-14 16:34:37'),
(43, 66, 0, 20, '2022-01-14 16:34:37'),
(43, 68, 1, 20, '2022-01-14 16:34:37'),
(43, 75, 1, 20, '2022-01-14 16:34:37'),
(43, 80, 1, 20, '2022-01-14 16:34:37'),
(43, 81, 0, 20, '2022-01-14 16:34:37'),
(43, 82, 1, 20, '2022-01-14 16:34:37'),
(43, 83, 0, 20, '2022-01-14 16:34:37'),
(44, 38, 1, 20, '2022-01-14 16:38:17'),
(44, 40, 1, 20, '2022-01-14 16:38:17'),
(44, 44, 0, 20, '2022-01-14 16:38:17'),
(44, 45, 1, 20, '2022-01-14 16:38:17'),
(44, 53, 1, 20, '2022-01-14 16:38:17'),
(44, 54, 1, 20, '2022-01-14 16:38:17'),
(44, 55, 0, 20, '2022-01-14 16:38:17'),
(44, 59, 1, 20, '2022-01-14 16:38:17'),
(44, 60, 1, 20, '2022-01-14 16:38:17'),
(44, 61, 1, 20, '2022-01-14 16:38:17'),
(44, 62, 1, 20, '2022-01-14 16:38:17'),
(44, 64, 0, 20, '2022-01-14 16:38:17'),
(44, 65, 1, 20, '2022-01-14 16:38:17'),
(44, 66, 1, 20, '2022-01-14 16:38:17'),
(44, 68, 0, 20, '2022-01-14 16:38:17');

-- --------------------------------------------------------

--
-- Struttura della tabella `giocatore`
--

CREATE TABLE `giocatore` (
  `id_giocatore` int(10) UNSIGNED NOT NULL,
  `nickname` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `passwd` varchar(64) NOT NULL,
  `email_paypal` varchar(64) NOT NULL,
  `eliminato` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `giocatore`
--

INSERT INTO `giocatore` (`id_giocatore`, `nickname`, `email`, `passwd`, `email_paypal`, `eliminato`) VALUES
(20, 'filippo', 'filippo@email.ok', '$2y$10$WOS58pZoWam9YZgY.XI/DeUjCHngKMVhEr7IGuXaite.jn/87D4xe', 'filippo@paypal.kappa', 0),
(21, 'Paolol', 'paolo@email.pa', '$2y$10$zZEMFe4UirRamV7.q9Nqo.NmbqHgtrYD.QzUCA0KHsByaFsaDiIna', 'paoloPaypal@pp.p', 0),
(22, 'meeco', 'domenico@gmail.com', '$2y$10$ytgyOZi.aVnlQoFYV6pjDOsG0aCXDZMPcFV6BS1bFTScSPt9wsNLe', 'domepp@paypal.it', 0),
(24, 'Frank', 'francesco@gmail.com', '$2y$10$MnfWSCJRjluTJmw5ZVpSYuwthHzR0MZIQUswg65Nd0PauwnasaKHG', 'cicc1@paypal.it', 0),
(26, 'ninni', 'zaza@e.it', '$2y$10$Tycdpd6N/q6b0/M6v.4.rOWwcEwpKUEyihd6lKy3.Q0rErzb8mGf2', 'ninni@pp.it', 0),
(27, 'Darion', 'dario@gmail.com', '$2y$10$iruENuIwvUuwy26G.TaU3OuS2ThrQVw9JejdaRUodFkbKKTPK/zM2', 'dario@paypal.it', 0),
(28, 'Giovanna', 'giovanna22@virgilio.it', '$2y$10$JpyeVB7EVZuQYP33IgmOQeL.3adAib3oSN51mP4LE6VIyK7riWdaa', 'giovanna@paypal.it', 0),
(29, 'Jacko', 'giacomo@gmail.com', '$2y$10$KYu8jH2Q.DV2rXZVnYZv5.R3hVGLX.sCv2RWWZV6MOcvDF7GixoBC', 'jackomo@paypal.it', 0),
(30, 'Sonya', 'sonia@libero.it', '$2y$10$vgbIejJB1bLMymesZF4ATO/TFoZiQ8OqERFZYo8ingx6QgJkLvKoS', 'sonya@paypal.it', 0),
(31, 'Giuse', 'giuseppe@hotmail.com', '$2y$10$xh7U7lLeh9a/PuH5gAbIMOzWQoC3hsQOiofzCjnbZJsIRDmnnsCCm', 'giuseppe@paypal.it', 0),
(32, 'Eleonora', 'eleonora@gmail.com', '$2y$10$5B9LbqfnEI/cbLvOP/mGj.IeS1VfAY.DIpAqSymO8uQq4IsqNKB32', 'eleonora@paypal.it', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `giornata`
--

CREATE TABLE `giornata` (
  `id_giornata` int(2) UNSIGNED NOT NULL,
  `inizio_giornata` datetime DEFAULT NULL,
  `termine_giornata` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `giornata`
--

INSERT INTO `giornata` (`id_giornata`, `inizio_giornata`, `termine_giornata`) VALUES
(1, '2021-08-21 18:30:00', '2021-08-23 23:30:00'),
(2, '2021-08-27 18:30:00', '2021-08-29 23:30:00'),
(3, '2021-09-11 15:00:00', '2021-09-13 23:30:00'),
(12, '2021-11-05 20:45:00', '2021-11-07 23:30:00'),
(13, '2021-11-20 15:00:00', '2021-11-22 23:30:00'),
(14, '2021-11-26 20:45:00', '2021-11-28 23:30:00'),
(15, '2021-11-30 15:00:00', '2021-12-02 23:30:00'),
(16, '2021-12-04 15:00:00', '2021-12-06 23:30:00'),
(17, '2021-12-10 20:45:00', '2021-12-13 23:30:00'),
(18, '2021-12-17 18:30:00', '2021-12-19 23:30:00'),
(19, '2021-12-21 18:30:00', '2021-12-22 23:30:00'),
(20, '2022-01-06 19:00:00', '2022-01-06 23:30:00'),
(21, '2022-01-09 15:00:00', '2022-01-09 17:30:00'),
(22, '2022-01-15 15:00:00', '2022-01-16 17:30:00'),
(23, '2022-01-23 15:00:00', '2022-01-23 17:30:00'),
(24, '2022-02-06 15:00:00', '2022-02-06 17:30:00'),
(25, '2022-02-13 15:00:00', '2022-02-13 17:30:00'),
(26, '2022-02-20 15:00:00', '2022-02-20 17:30:00');

-- --------------------------------------------------------

--
-- Struttura della tabella `ruolo`
--

CREATE TABLE `ruolo` (
  `id_ruolo` int(10) UNSIGNED NOT NULL,
  `descrizione` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `ruolo`
--

INSERT INTO `ruolo` (`id_ruolo`, `descrizione`) VALUES
(1, 'Portiere'),
(2, 'Difensore'),
(3, 'Centrocampista'),
(4, 'Attaccante');

-- --------------------------------------------------------

--
-- Struttura della tabella `scheda_tecnica`
--

CREATE TABLE `scheda_tecnica` (
  `calciatore` int(10) UNSIGNED NOT NULL,
  `goal` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `assist` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `clean_sheet` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `goal_subiti` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `ammonizioni` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `espulsioni` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `autogoal` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `scheda_tecnica`
--

INSERT INTO `scheda_tecnica` (`calciatore`, `goal`, `assist`, `clean_sheet`, `goal_subiti`, `ammonizioni`, `espulsioni`, `autogoal`) VALUES
(38, 0, 0, 0, 0, 0, 0, 0),
(40, 2, 0, 0, 0, 2, 1, 1),
(43, 1, 0, 0, 0, 0, 0, 0),
(44, 0, 0, 1, 1, 0, 0, 0),
(45, 0, 0, 1, 2, 1, 0, 0),
(46, 0, 0, 0, 1, 0, 0, 0),
(47, 0, 0, 0, 1, 0, 0, 0),
(48, 0, 0, 0, 1, 0, 0, 0),
(49, 0, 0, 0, 1, 0, 0, 0),
(51, 0, 0, 1, 1, 0, 0, 0),
(53, 1, 0, 0, 0, 0, 0, 0),
(54, 0, 0, 0, 0, 0, 0, 0),
(55, 0, 0, 0, 0, 0, 0, 0),
(56, 0, 0, 0, 0, 0, 0, 0),
(57, 0, 0, 0, 0, 0, 0, 0),
(58, 0, 0, 0, 0, 0, 0, 0),
(59, 0, 0, 0, 0, 0, 0, 0),
(60, 0, 0, 0, 0, 0, 0, 0),
(61, 0, 0, 0, 0, 0, 0, 0),
(62, 0, 0, 0, 0, 0, 0, 0),
(64, 0, 0, 0, 0, 0, 0, 0),
(65, 0, 0, 0, 0, 0, 0, 0),
(66, 1, 1, 0, 0, 1, 0, 0),
(67, 0, 0, 0, 0, 0, 0, 0),
(68, 0, 0, 0, 0, 0, 0, 0),
(74, 0, 0, 0, 1, 0, 0, 0),
(75, 0, 0, 0, 0, 0, 0, 0),
(76, 0, 0, 0, 0, 0, 0, 0),
(77, 0, 0, 0, 1, 0, 0, 0),
(78, 0, 0, 0, 1, 0, 0, 0),
(79, 0, 0, 0, 0, 0, 0, 0),
(80, 0, 0, 0, 0, 0, 0, 0),
(81, 0, 0, 0, 0, 0, 0, 0),
(82, 0, 0, 0, 0, 0, 0, 0),
(83, 0, 0, 0, 0, 0, 0, 0),
(84, 0, 0, 0, 0, 0, 0, 0),
(85, 0, 0, 0, 0, 0, 0, 0),
(86, 0, 0, 0, 0, 0, 0, 0),
(87, 0, 0, 0, 0, 0, 0, 0),
(88, 2, 0, 0, 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `squadra`
--

CREATE TABLE `squadra` (
  `id_squadra` int(10) UNSIGNED NOT NULL,
  `nome_squadra` varchar(64) NOT NULL,
  `presidente` int(10) UNSIGNED NOT NULL,
  `competizione` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `squadra`
--

INSERT INTO `squadra` (`id_squadra`, `nome_squadra`, `presidente`, `competizione`) VALUES
(34, 'Reggina 1914', 28, 42),
(35, 'Chelsea', 28, 44),
(36, 'Fenerbache', 28, 40),
(37, 'Genoa', 24, 42),
(38, 'Viterbese', 24, 43),
(39, 'Swansea', 24, 44),
(40, 'Tottenham', 29, 44),
(41, 'Frosinone', 29, 41),
(42, 'Manchester', 30, 44),
(43, 'Milan', 30, 42),
(44, 'Cittadella', 31, 43);

-- --------------------------------------------------------

--
-- Struttura della tabella `tipologia`
--

CREATE TABLE `tipologia` (
  `id_tipologia` int(10) UNSIGNED NOT NULL,
  `descrizione` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `tipologia`
--

INSERT INTO `tipologia` (`id_tipologia`, `descrizione`) VALUES
(1, 'consigli'),
(2, 'indisponibili'),
(3, 'news');

-- --------------------------------------------------------

--
-- Struttura della tabella `valutazione`
--

CREATE TABLE `valutazione` (
  `calciatore` int(10) UNSIGNED NOT NULL,
  `giornata` int(10) UNSIGNED NOT NULL,
  `voto` float UNSIGNED NOT NULL DEFAULT 0,
  `fantavoto` float UNSIGNED NOT NULL DEFAULT 0,
  `goal` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `assist` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `clean_sheet` int(10) UNSIGNED DEFAULT 0,
  `goal_subiti` int(10) UNSIGNED DEFAULT 0,
  `ammonizioni` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `espulsioni` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `autogoal` int(10) UNSIGNED DEFAULT 0,
  `rigore_sbagliato` int(10) UNSIGNED DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `valutazione`
--

INSERT INTO `valutazione` (`calciatore`, `giornata`, `voto`, `fantavoto`, `goal`, `assist`, `clean_sheet`, `goal_subiti`, `ammonizioni`, `espulsioni`, `autogoal`, `rigore_sbagliato`) VALUES
(38, 20, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(38, 22, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(38, 23, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(40, 1, 7, 10, 1, 0, 0, 0, 0, 0, 0, 0),
(40, 2, 2, 1, 0, 0, 0, 0, 2, 1, 1, 1),
(40, 13, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(40, 20, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(40, 22, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(40, 23, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(43, 2, 7, 10, 1, 0, 0, 0, 0, 0, 0, 0),
(43, 20, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(43, 21, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(43, 22, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(43, 23, 6, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(44, 20, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(44, 21, 6, 7, 0, 0, 1, 0, 0, 0, 0, 0),
(44, 22, 6, 5, 0, 0, 0, 1, 0, 0, 0, 0),
(44, 23, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(45, 1, 6, 7, 0, 0, 1, 0, 1, 0, 0, 0),
(45, 13, 6, 7, 0, 0, 1, 0, 0, 0, 0, 0),
(45, 20, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(45, 21, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(45, 22, 6, 5, 0, 0, 0, 1, 0, 0, 0, 0),
(45, 23, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(46, 20, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(46, 21, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(46, 22, 6, 5, 0, 0, 0, 1, 0, 0, 0, 0),
(46, 23, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(47, 20, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(47, 21, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(47, 22, 6, 5, 0, 0, 0, 1, 0, 0, 0, 0),
(47, 23, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(48, 20, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(48, 22, 6, 5, 0, 0, 0, 1, 0, 0, 0, 0),
(49, 20, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(49, 21, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(49, 22, 6, 5, 0, 0, 0, 1, 0, 0, 0, 0),
(49, 23, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(51, 20, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(51, 21, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(51, 22, 6, 5, 0, 0, 0, 1, 0, 0, 0, 0),
(51, 23, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(53, 1, 4, 3, 0, 0, 0, 0, 0, 1, 0, 0),
(53, 15, 7, 10, 1, 0, 0, 0, 0, 0, 0, 0),
(53, 20, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(53, 21, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(53, 23, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(54, 1, 4, 3, 0, 0, 0, 0, 0, 1, 0, 0),
(54, 20, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(54, 21, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(54, 22, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(54, 23, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(55, 1, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(55, 20, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(55, 21, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(55, 22, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(56, 20, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(56, 21, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(56, 22, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(56, 23, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(57, 1, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(57, 20, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(57, 21, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(57, 22, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(57, 23, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(58, 20, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(58, 21, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(58, 22, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(58, 23, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(59, 1, 7, 11, 1, 1, 0, 0, 0, 0, 0, 0),
(59, 20, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(59, 23, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(60, 1, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(60, 20, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(60, 23, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(61, 1, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(61, 20, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(61, 21, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(61, 22, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(61, 23, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(62, 1, 7, 9, 0, 2, 0, 0, 0, 0, 0, 0),
(62, 23, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(64, 1, 7, 10, 1, 0, 0, 0, 0, 0, 0, 0),
(64, 21, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(64, 22, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(64, 23, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(65, 1, 5, 5, 0, 0, 0, 0, 0, 0, 0, 0),
(65, 20, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(65, 21, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(65, 22, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(65, 23, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(66, 1, 7, 7, 0, 0, 0, 0, 0, 0, 0, 0),
(66, 15, 7, 10.5, 1, 1, 0, 0, 1, 0, 0, 0),
(66, 20, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(66, 21, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(66, 22, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(66, 23, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(67, 20, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(67, 21, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(67, 23, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(68, 1, 8, 13, 2, 0, 0, 0, 0, 0, 0, 0),
(68, 20, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(68, 21, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(68, 22, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(68, 23, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(74, 20, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(74, 21, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(74, 22, 6, 5, 0, 0, 0, 1, 0, 0, 0, 0),
(74, 23, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(75, 20, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(75, 21, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(75, 22, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(75, 23, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(76, 20, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(76, 21, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(76, 22, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(77, 21, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(77, 22, 6, 5, 0, 0, 0, 1, 0, 0, 0, 0),
(77, 23, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(78, 20, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(78, 21, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(78, 22, 6, 5, 0, 0, 0, 1, 0, 0, 0, 0),
(78, 23, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(79, 20, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(79, 21, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(79, 22, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(79, 23, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(80, 20, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(80, 22, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(80, 23, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(81, 20, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(81, 22, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(81, 23, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(82, 20, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(82, 21, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(82, 22, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(82, 23, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(83, 20, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(83, 21, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(83, 22, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(83, 23, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(84, 21, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(84, 22, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(84, 23, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(85, 20, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(85, 21, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(85, 22, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(86, 20, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(86, 21, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(86, 22, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(86, 23, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(87, 20, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(87, 22, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(87, 23, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(88, 20, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(88, 21, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0),
(88, 22, 8, 13.5, 2, 0, 0, 0, 1, 0, 0, 0);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `amministratore`
--
ALTER TABLE `amministratore`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `admin_name` (`admin_name`);

--
-- Indici per le tabelle `articolo`
--
ALTER TABLE `articolo`
  ADD PRIMARY KEY (`id_articolo`),
  ADD KEY `tipologia` (`tipologia`),
  ADD KEY `autore` (`autore`);

--
-- Indici per le tabelle `calciatore`
--
ALTER TABLE `calciatore`
  ADD PRIMARY KEY (`id_calciatore`),
  ADD UNIQUE KEY `nominativo` (`nominativo`),
  ADD KEY `ruolo` (`ruolo`),
  ADD KEY `club` (`club`);

--
-- Indici per le tabelle `club`
--
ALTER TABLE `club`
  ADD PRIMARY KEY (`id_club`);

--
-- Indici per le tabelle `competizione`
--
ALTER TABLE `competizione`
  ADD PRIMARY KEY (`id_competizione`),
  ADD KEY `creatore` (`creatore`);

--
-- Indici per le tabelle `formazione`
--
ALTER TABLE `formazione`
  ADD PRIMARY KEY (`squadra`,`calciatore`,`giornata`),
  ADD KEY `calciatore` (`calciatore`);

--
-- Indici per le tabelle `giocatore`
--
ALTER TABLE `giocatore`
  ADD PRIMARY KEY (`id_giocatore`),
  ADD UNIQUE KEY `nickname` (`nickname`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `email_paypal` (`email_paypal`);

--
-- Indici per le tabelle `giornata`
--
ALTER TABLE `giornata`
  ADD PRIMARY KEY (`id_giornata`);

--
-- Indici per le tabelle `ruolo`
--
ALTER TABLE `ruolo`
  ADD PRIMARY KEY (`id_ruolo`);

--
-- Indici per le tabelle `scheda_tecnica`
--
ALTER TABLE `scheda_tecnica`
  ADD PRIMARY KEY (`calciatore`);

--
-- Indici per le tabelle `squadra`
--
ALTER TABLE `squadra`
  ADD PRIMARY KEY (`id_squadra`),
  ADD KEY `presidente` (`presidente`),
  ADD KEY `competizione` (`competizione`);

--
-- Indici per le tabelle `tipologia`
--
ALTER TABLE `tipologia`
  ADD PRIMARY KEY (`id_tipologia`);

--
-- Indici per le tabelle `valutazione`
--
ALTER TABLE `valutazione`
  ADD PRIMARY KEY (`calciatore`,`giornata`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `amministratore`
--
ALTER TABLE `amministratore`
  MODIFY `id_admin` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT per la tabella `articolo`
--
ALTER TABLE `articolo`
  MODIFY `id_articolo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT per la tabella `calciatore`
--
ALTER TABLE `calciatore`
  MODIFY `id_calciatore` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT per la tabella `club`
--
ALTER TABLE `club`
  MODIFY `id_club` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT per la tabella `competizione`
--
ALTER TABLE `competizione`
  MODIFY `id_competizione` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT per la tabella `giocatore`
--
ALTER TABLE `giocatore`
  MODIFY `id_giocatore` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT per la tabella `ruolo`
--
ALTER TABLE `ruolo`
  MODIFY `id_ruolo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `squadra`
--
ALTER TABLE `squadra`
  MODIFY `id_squadra` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT per la tabella `tipologia`
--
ALTER TABLE `tipologia`
  MODIFY `id_tipologia` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `articolo`
--
ALTER TABLE `articolo`
  ADD CONSTRAINT `articolo_ibfk_1` FOREIGN KEY (`tipologia`) REFERENCES `tipologia` (`id_tipologia`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `articolo_ibfk_2` FOREIGN KEY (`autore`) REFERENCES `amministratore` (`id_admin`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `calciatore`
--
ALTER TABLE `calciatore`
  ADD CONSTRAINT `calciatore_ibfk_1` FOREIGN KEY (`ruolo`) REFERENCES `ruolo` (`id_ruolo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `calciatore_ibfk_2` FOREIGN KEY (`club`) REFERENCES `club` (`id_club`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `competizione`
--
ALTER TABLE `competizione`
  ADD CONSTRAINT `competizione_ibfk_1` FOREIGN KEY (`creatore`) REFERENCES `amministratore` (`id_admin`);

--
-- Limiti per la tabella `formazione`
--
ALTER TABLE `formazione`
  ADD CONSTRAINT `formazione_ibfk_1` FOREIGN KEY (`squadra`) REFERENCES `squadra` (`id_squadra`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `formazione_ibfk_2` FOREIGN KEY (`calciatore`) REFERENCES `calciatore` (`id_calciatore`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `scheda_tecnica`
--
ALTER TABLE `scheda_tecnica`
  ADD CONSTRAINT `scheda_tecnica_ibfk_1` FOREIGN KEY (`calciatore`) REFERENCES `calciatore` (`id_calciatore`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `squadra`
--
ALTER TABLE `squadra`
  ADD CONSTRAINT `squadra_ibfk_1` FOREIGN KEY (`presidente`) REFERENCES `giocatore` (`id_giocatore`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `squadra_ibfk_2` FOREIGN KEY (`competizione`) REFERENCES `competizione` (`id_competizione`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `valutazione`
--
ALTER TABLE `valutazione`
  ADD CONSTRAINT `valutazione_ibfk_1` FOREIGN KEY (`calciatore`) REFERENCES `calciatore` (`id_calciatore`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
