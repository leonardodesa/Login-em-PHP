-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 09-Jul-2018 às 13:06
-- Versão do servidor: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `site_maqina`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `thumbs`
--

CREATE TABLE `thumbs` (
  `codigo` varchar(30) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `destaque` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `thumbs`
--

INSERT INTO `thumbs` (`codigo`, `nome`, `titulo`, `descricao`, `categoria`, `destaque`) VALUES
('01-thumbnail', 'Threads', 'Threads', 'as melhores roupas do mercado.', 'design', 1),
('02-thumbnail', 'Explore', 'Explore', 'Explore tudo que você puder.', 'design', 1),
('03-thumbnail', 'Itau', 'Itau titulo', 'itau descricao', 'motion', 1),
('04-thumbnail', 'citibanamex', 'citibanamex titulo', 'citibanamex descrição', 'rich-media', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `thumbs`
--
ALTER TABLE `thumbs`
  ADD PRIMARY KEY (`codigo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
