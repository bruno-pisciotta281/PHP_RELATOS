-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 11/08/2023 às 16:36
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.0.28

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
  `relato_id` char(36) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `email` varchar(110) DEFAULT NULL,
  `relato` text NOT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1 = aberto; 2 = andamento; 0 = fechado',
  `resposta` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tabela_de_relatos`
--

INSERT INTO `tabela_de_relatos` (`relato_id`, `nome`, `email`, `relato`, `data_criacao`, `status`, `resposta`) VALUES
('3aa55091-384d-11ee-92fa-d09466b4d983', 'anônimo', 'anonimo@anonimo', 'teste anônimo', '2023-08-11 13:44:44', 1, NULL),
('72f57759-3784-11ee-a490-d09466b4d983', 'Bruno Pisciotta', 'bruno.pisciotta43@gmail.com', 'Teste de Filtros na aplicação da página ', '2023-08-10 13:47:29', 1, 'ótimo!'),
('956e1be3-3784-11ee-a490-d09466b4d983', 'Alberto Einstoin ', 'alberto.eistoin@gmail.com', 'Gosto muito do escritório', '2023-08-10 13:48:27', 1, NULL),
('a051748d-3784-11ee-a490-d09466b4d983', 'anônimo', 'anonimo@anonimo', 'sou anônimo, ninguém sabem quem sou eu ', '2023-08-10 13:48:45', 1, NULL),
('c179b255-3784-11ee-a490-d09466b4d983', 'Geoge Alneida', 'gergealmeida@gmail.com', 'aquele testezin de leves', '2023-08-10 13:49:41', 1, NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tabela_de_relatos`
--
ALTER TABLE `tabela_de_relatos`
  ADD PRIMARY KEY (`relato_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
