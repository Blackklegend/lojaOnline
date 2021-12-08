-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2021 at 01:46 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `loja_repo`
--

-- --------------------------------------------------------

--
-- Table structure for table `produtos`
--

CREATE TABLE `produtos` (
  `ID` int(11) NOT NULL,
  `preco` float DEFAULT NULL,
  `categoria` varchar(30) DEFAULT NULL,
  `imagePath` varchar(300) DEFAULT NULL,
  `nome` varchar(60) DEFAULT NULL,
  `descricao` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produtos`
--

INSERT INTO `produtos` (`ID`, `preco`, `categoria`, `imagePath`, `nome`, `descricao`) VALUES
(1, 59.99, 'Carregadores', 'https://images.kabum.com.br/produtos/fotos/95139/95139_6_1533061033_gg.jpg', 'Carregador', 'Um ótimo carregador'),
(2, 150, 'Fones', 'https://http2.mlstatic.com/D_NQ_NP_2X_916914-MLA46540739257_062021-V.webp', 'Fone de Ouvido JBL', 'Fone de ouvido JBL, qualidade boa 👍'),
(3, 150, 'Fones', 'https://http2.mlstatic.com/D_NQ_NP_2X_916914-MLA46540739257_062021-V.webp', 'Fone de Ouvido JBL', 'Fone de ouvido JBL, qualidade boa 👍'),
(4, 150, 'Fones', 'https://http2.mlstatic.com/D_NQ_NP_2X_916914-MLA46540739257_062021-V.webp', 'Fone de Ouvido JBL', 'Fone de ouvido JBL, qualidade boa 👍'),
(5, 150, 'Fones', 'https://http2.mlstatic.com/D_NQ_NP_2X_916914-MLA46540739257_062021-V.webp', 'Fone de Ouvido JBL', 'Fone de ouvido JBL, qualidade boa 👍'),
(6, 150, 'Fones', 'https://http2.mlstatic.com/D_NQ_NP_2X_916914-MLA46540739257_062021-V.webp', 'Fone de Ouvido JBL', 'Fone de ouvido JBL, qualidade boa 👍'),
(7, 150, 'Fones', 'https://http2.mlstatic.com/D_NQ_NP_2X_916914-MLA46540739257_062021-V.webp', 'Fone de Ouvido JBL', 'Fone de ouvido JBL, qualidade boa 👍'),
(8, 150, 'Fones', 'https://http2.mlstatic.com/D_NQ_NP_2X_916914-MLA46540739257_062021-V.webp', 'Fone de Ouvido JBL', 'Fone de ouvido JBL, qualidade boa 👍'),
(9, 150, 'Fones', 'https://http2.mlstatic.com/D_NQ_NP_2X_916914-MLA46540739257_062021-V.webp', 'Fone de Ouvido JBL', 'Fone de ouvido JBL, qualidade boa 👍'),
(10, 150, 'Fones', 'https://http2.mlstatic.com/D_NQ_NP_2X_916914-MLA46540739257_062021-V.webp', 'Fone de Ouvido JBL', 'Fone de ouvido JBL, qualidade boa 👍'),
(11, 150, 'Fones', 'https://http2.mlstatic.com/D_NQ_NP_2X_916914-MLA46540739257_062021-V.webp', 'Fone de Ouvido JBL', 'Fone de ouvido JBL, qualidade boa 👍'),
(12, 150, 'Fones', 'https://http2.mlstatic.com/D_NQ_NP_2X_916914-MLA46540739257_062021-V.webp', 'Fone de Ouvido JBL', 'Fone de ouvido JBL, qualidade boa 👍'),
(13, 150, 'Fones', 'https://http2.mlstatic.com/D_NQ_NP_2X_916914-MLA46540739257_062021-V.webp', 'Fone de Ouvido JBL', 'Fone de ouvido JBL, qualidade boa 👍'),
(14, 150, 'Fones', 'https://http2.mlstatic.com/D_NQ_NP_2X_916914-MLA46540739257_062021-V.webp', 'Fone de Ouvido JBL', 'Fone de ouvido JBL, qualidade boa 👍'),
(15, 150, 'Fones', 'https://http2.mlstatic.com/D_NQ_NP_2X_916914-MLA46540739257_062021-V.webp', 'Fone de Ouvido JBL', 'Fone de ouvido JBL, qualidade boa 👍'),
(33, 150, 'Fones', 'https://http2.mlstatic.com/D_NQ_NP_2X_916914-MLA46540739257_062021-V.webp', 'Fone de Ouvido JBL', 'Fone de ouvido JBL, qualidade boa 👍'),
(34, 150, 'Fones', 'https://http2.mlstatic.com/D_NQ_NP_2X_916914-MLA46540739257_062021-V.webp', 'Fone de Ouvido JBL', 'Fone de ouvido JBL, qualidade boa 👍'),
(35, 150, 'Fones', 'https://http2.mlstatic.com/D_NQ_NP_2X_916914-MLA46540739257_062021-V.webp', 'Fone de Ouvido JBL', 'Fone de ouvido JBL, qualidade boa 👍'),
(36, 59.99, 'Carregadores', 'https://images.kabum.com.br/produtos/fotos/95139/95139_6_1533061033_gg.jpg', 'Carregador', 'Um ótimo carregador'),
(37, 59.99, 'Carregadores', 'https://images.kabum.com.br/produtos/fotos/95139/95139_6_1533061033_gg.jpg', 'Carregador', 'Um ótimo carregador'),
(38, 59.99, 'Carregadores', 'https://images.kabum.com.br/produtos/fotos/95139/95139_6_1533061033_gg.jpg', 'Carregador', 'Um ótimo carregador'),
(39, 59.99, 'Carregadores', 'https://images.kabum.com.br/produtos/fotos/95139/95139_6_1533061033_gg.jpg', 'Carregador', 'Um ótimo carregador'),
(40, 160, 'Dakimakura', 'https://ae01.alicdn.com/kf/Hf072afc0e7b3484c8bc98608a2797c18r/2021-atualiza-o-anime-japon-s-dakimakura-corpo-travesseiro-caso-gawr-gura-abra-ando-corpo-capa.jpg_Q90.jpg_.webp', 'Dakimakura Gawr Gura', 'Dakimakura da gawr gura, adicionado a pedidos');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nome` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `cpf` text DEFAULT NULL,
  `bthDate` date DEFAULT NULL,
  `endereco` text DEFAULT NULL,
  `senha` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nome`, `email`, `cpf`, `bthDate`, `endereco`, `senha`) VALUES
(1, 'adwadw', 'vitormonteiro909@gmail.com', '241451651651', '2003-11-05', 'aeuhbfaeiuh', '$2y$10$4MVRPKqRU9WK9vILzLjsMeAv6xmLKXQjMngIAb1noSM6B9NQkoRnS'),
(2, 'VItor', 'bl4ckk10@gmail.com', '1316546', '2003-10-15', 'aietuaeiu', '$2y$10$DLYd.VEGqx2kInAszVnaFOHHekWjVvLWKaSOuv.kIP4LLSNfiu6b6'),
(3, '123', '123@org.com', '127.000.000.01', '1932-01-01', 'rua dos bobos numero 0', '$2y$10$FQned49DdKY9t3SIBOm7tu/uDhpX/L0aaBm45emKcTFP3brYvjWxi'),
(4, 'abc', 'a@a.com', 'abc', '1950-11-11', 'abc', '$2y$10$QCZrg0dlq.R.XNTrKT403eL1gBrdGLRNvot1GprVf5ZPs87vHd2Fm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
