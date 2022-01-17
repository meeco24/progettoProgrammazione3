-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Gen 12, 2022 alle 17:36
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

-- --------------------------------------------------------

--
-- Struttura della tabella `club`
--

CREATE TABLE `club` (
  `id_club` int(10) UNSIGNED NOT NULL,
  `nome` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Struttura della tabella `giornata`
--

CREATE TABLE `giornata` (
  `id_giornata` int(2) UNSIGNED NOT NULL,
  `inizio_giornata` datetime DEFAULT NULL,
  `termine_giornata` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `ruolo`
--

CREATE TABLE `ruolo` (
  `id_ruolo` int(10) UNSIGNED NOT NULL,
  `descrizione` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Struttura della tabella `tipologia`
--

CREATE TABLE `tipologia` (
  `id_tipologia` int(10) UNSIGNED NOT NULL,
  `descrizione` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  MODIFY `id_admin` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `articolo`
--
ALTER TABLE `articolo`
  MODIFY `id_articolo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `calciatore`
--
ALTER TABLE `calciatore`
  MODIFY `id_calciatore` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `club`
--
ALTER TABLE `club`
  MODIFY `id_club` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `competizione`
--
ALTER TABLE `competizione`
  MODIFY `id_competizione` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `giocatore`
--
ALTER TABLE `giocatore`
  MODIFY `id_giocatore` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `ruolo`
--
ALTER TABLE `ruolo`
  MODIFY `id_ruolo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `squadra`
--
ALTER TABLE `squadra`
  MODIFY `id_squadra` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `tipologia`
--
ALTER TABLE `tipologia`
  MODIFY `id_tipologia` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

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
