-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22/01/2024 às 21:34
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `relatos`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tabela_de_relatos`
--

CREATE TABLE `tabela_de_relatos` (
  `relato_id` varchar(36) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `relato` text DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Em Aberto',
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `resposta` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tabela_de_relatos`
--

INSERT INTO `tabela_de_relatos` (`relato_id`, `nome`, `email`, `relato`, `status`, `data_criacao`, `resposta`) VALUES
('98240914-b947-11ee-bc42-34735ab1446f', 'anônimo', 'anonimo@anonimo', 'teste anônimo 01', 'em_aberto', '2024-01-22 16:59:22', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tratativas`
--

CREATE TABLE `tratativas` (
  `tratativa_id` int(11) NOT NULL,
  `relato_id` varchar(36) DEFAULT NULL,
  `resposta` text DEFAULT NULL,
  `data_tratativa` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tratativas`
--

INSERT INTO `tratativas` (`tratativa_id`, `relato_id`, `resposta`, `data_tratativa`) VALUES
(1, '98240914-b947-11ee-bc42-34735ab1446f', 'teste Tratativa 01', '2024-01-22 16:59:49'),
(2, '98240914-b947-11ee-bc42-34735ab1446f', 'teste Tratativa 02', '2024-01-22 16:59:57');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tabela_de_relatos`
--
ALTER TABLE `tabela_de_relatos`
  ADD PRIMARY KEY (`relato_id`);

--
-- Índices de tabela `tratativas`
--
ALTER TABLE `tratativas`
  ADD PRIMARY KEY (`tratativa_id`),
  ADD KEY `relato_id` (`relato_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tratativas`
--
ALTER TABLE `tratativas`
  MODIFY `tratativa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `tratativas`
--
ALTER TABLE `tratativas`
  ADD CONSTRAINT `tratativas_ibfk_1` FOREIGN KEY (`relato_id`) REFERENCES `tabela_de_relatos` (`relato_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
