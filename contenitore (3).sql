-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Giu 14, 2024 alle 13:53
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `contenitore`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `giocatori`
--

CREATE TABLE `giocatori` (
  `nome` varchar(40) NOT NULL,
  `cognome` varchar(40) NOT NULL,
  `squadra` varchar(40) NOT NULL,
  `posizione` int(60) NOT NULL,
  `data_nascita` date NOT NULL,
  `idUtente` varchar(40) NOT NULL,
  `stip_inizio` date NOT NULL,
  `stip_fine` date NOT NULL,
  `totale` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dump dei dati per la tabella `giocatori`
--

INSERT INTO `giocatori` (`nome`, `cognome`, `squadra`, `posizione`, `data_nascita`, `idUtente`, `stip_inizio`, `stip_fine`, `totale`) VALUES
('a', '', 'b', 0, '2005-04-09', 'merefabio05@gmail.com', '2005-04-09', '2005-04-09', 3),
('a', 'a', 'a', 0, '2005-04-09', 'FABIOMERELLO@PEC.IT', '2005-04-09', '2005-04-09', 1),
('a', 'a', 'a', 0, '2005-04-09', 'merefabio05@gmail.com', '2005-04-09', '2005-04-09', 1),
('a', 'b', 'b', 0, '2005-04-09', 'merefabio05@gmail.com', '2005-04-09', '2005-04-09', 2),
('Lionel', 'Messi', 'InterMiami', 0, '2005-04-09', 'fabio.merello.2005@calvino.edu.it', '2005-04-09', '2005-04-09', 100000000);

-- --------------------------------------------------------

--
-- Struttura della tabella `statistiche_tecniche`
--

CREATE TABLE `statistiche_tecniche` (
  `calcio_dangolo` int(2) NOT NULL,
  `calcio_piazzato` int(2) NOT NULL,
  `contrasto` int(2) NOT NULL,
  `controllo_palla` int(2) NOT NULL,
  `passaggi_cross` int(2) NOT NULL,
  `dribbling` int(2) NOT NULL,
  `finalizzazione` int(2) NOT NULL,
  `marcatura` int(2) NOT NULL,
  `passaggi` int(2) NOT NULL,
  `rigori` int(2) NOT NULL,
  `rimesse_lunghe` int(2) NOT NULL,
  `tecnica` int(2) NOT NULL,
  `tiro_lontano` int(2) NOT NULL,
  `smarcatura` int(2) NOT NULL,
  `giocatore_nome` varchar(40) NOT NULL,
  `giocatore_cognome` varchar(40) NOT NULL,
  `idUtenti` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `email` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`email`, `password`) VALUES
('fabio.merello.2005@calvino.edu.it', '123456'),
('FABIOMERELLO@PEC.IT', '123456'),
('merefabio05@gmail.com', '123456');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `giocatori`
--
ALTER TABLE `giocatori`
  ADD PRIMARY KEY (`nome`,`cognome`,`idUtente`);

--
-- Indici per le tabelle `statistiche_tecniche`
--
ALTER TABLE `statistiche_tecniche`
  ADD PRIMARY KEY (`idUtenti`,`giocatore_cognome`,`giocatore_nome`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`email`,`password`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
