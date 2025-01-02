-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 18/12/2024 às 17:00
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `Wallisson`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `dpe_dependente`
--

CREATE TABLE `dpe_dependente` (
  `dpe_id` int(11) NOT NULL,
  `flo_id` int(11) NOT NULL,
  `dpe_nome` varchar(100) NOT NULL,
  `dpe_data_de_nascimento` date NOT NULL,
  `dpe_grau_de_parentesco` enum('Conjuge','Filho','Pai','Mae') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `dpe_dependente`
--

INSERT INTO `dpe_dependente` (`dpe_id`, `flo_id`, `dpe_nome`, `dpe_data_de_nascimento`, `dpe_grau_de_parentesco`) VALUES
(9, 46, 'yyy', '2024-12-25', 'Pai'),
(10, 46, 'teste', '2024-12-18', 'Pai'),
(14, 59, 'fhgjhfhdfghfg', '2024-12-04', 'Conjuge'),
(15, 48, 'T', '2024-12-19', 'Filho'),
(16, 47, 'k', '2024-12-04', 'Conjuge');

-- --------------------------------------------------------

--
-- Estrutura para tabela `flo_filiado`
--

CREATE TABLE `flo_filiado` (
  `flo_id` int(11) NOT NULL,
  `flo_nome` varchar(100) NOT NULL,
  `flo_cpf` varchar(18) NOT NULL,
  `flo_rg` varchar(18) NOT NULL,
  `flo_data_de_nascimento` date NOT NULL,
  `flo_idade` int(11) NOT NULL,
  `flo_empresa` varchar(100) DEFAULT NULL,
  `flo_cargo` varchar(100) DEFAULT NULL,
  `flo_situacao` enum('Ativo','Aposentado','Licenciado') DEFAULT NULL,
  `flo_telefone_residencial` varchar(18) DEFAULT NULL,
  `flo_celular` varchar(18) DEFAULT NULL,
  `flo_data_ultima_atualizacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `flo_deletado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `flo_filiado`
--

INSERT INTO `flo_filiado` (`flo_id`, `flo_nome`, `flo_cpf`, `flo_rg`, `flo_data_de_nascimento`, `flo_idade`, `flo_empresa`, `flo_cargo`, `flo_situacao`, `flo_telefone_residencial`, `flo_celular`, `flo_data_ultima_atualizacao`, `flo_deletado`) VALUES
(42, 'Wallisson Silva', '12345678909', '12.345.675-1', '2001-04-18', 23, 'Moobi', 'Desenvolvedor', 'Ativo', '(11) 1234-5678', '(11) 91234-5679', '2024-12-18 15:44:20', 2),
(45, 'Maria Souza', '42863917584', '45.678.901-4', '1993-07-30', 30, 'Alpha Tech', 'Consultora', 'Ativo', '(41) 4234-5678', '(41) 91234-5679', '2024-12-18 15:57:13', 2),
(46, 'João Lima', '54923178635', '56.789.012-5', '2000-01-15', 24, 'Beta Systems', 'Engenheiro', 'Ativo', '(51) 5234-5678', '(51) 91234-5679', '2024-12-18 15:56:53', 2),
(47, 'Fernanda Alves', '69284351706', '67.890.123-6', '1995-05-10', 29, 'Gamma Innovations', 'Coordenadora', 'Ativo', '(61) 6234-5678', '(61) 91234-5679', '2024-12-18 15:43:57', 2),
(48, 'Rafael Mendes', '70395462829', '78.901.234-7', '1992-11-20', 31, 'Zeta Corp', 'Administrador', 'Aposentado', '(71) 7234-5678', '(71) 91234-5679', '2024-12-18 15:35:38', 2),
(49, 'Clara Santos', '81436524941', '89.012.345-8', '1997-02-28', 27, 'Omega Systems', 'Especialista', 'Ativo', '(81) 8234-5678', '(81) 91234-5679', '2024-12-17 18:07:42', 2),
(50, 'Paulo Silva', '92547638073', '90.123.456-9', '1988-08-05', 35, 'Delta Solutions', 'Técnico', 'Ativo', '(91) 9234-5678', '(91) 91234-5679', '2024-12-17 18:07:42', 2),
(51, 'Isabela Costa', '03658749190', '10.234.567-0', '1999-10-22', 24, 'Epsilon Corp', 'Estagiária', 'Ativo', '(31) 1234-5678', '(31) 91234-5679', '2024-12-17 18:07:42', 2),
(52, 'Felipe Nogueira', '14769850218', '11.345.678-1', '1996-06-18', 28, 'TechMax', 'Designer', 'Ativo', '(41) 2234-5678', '(41) 91234-5679', '2024-12-17 18:07:42', 2),
(53, 'Juliana Ramos', '25870961321', '12.456.789-2', '1987-12-25', 36, 'Prime Solutions', 'RH', 'Ativo', '(51) 3234-5678', '(51) 91234-5679', '2024-12-17 18:07:42', 2),
(54, 'Lucas Rocha', '36982072443', '13.567.890-3', '1994-04-09', 30, 'Infinity Tech', 'DevOps', 'Ativo', '(61) 4234-5678', '(61) 91234-5679', '2024-12-17 18:07:42', 2),
(55, 'Gabriela Lima', '47193183565', '14.678.901-4', '1990-03-15', 34, 'Digital Web', 'Analista', 'Ativo', '(71) 5234-5678', '(71) 91234-5679', '2024-12-17 18:07:42', 2),
(56, 'Diego Almeida', '58204294687', '15.789.012-5', '1993-08-01', 31, 'Nova Corp', '', 'Ativo', '(81) 6234-5678', '(81) 91234-5679', '2024-12-17 18:13:21', 2),
(57, 'Bianca Ferreira', '69315305709', '16.890.123-6', '1991-09-19', 33, 'Virtual Tech', 'Coordenadora', 'Ativo', '(91) 7234-5678', '(91) 91234-5679', '2024-12-17 18:13:21', 2),
(58, 'Gustavo Moreira', '80426416820', '17.901.234-7', '1989-02-25', 35, 'Matrix Systems', 'Administrador', 'Ativo', '(31) 8234-5678', '(31) 91234-5679', '2024-12-17 18:13:21', 2),
(59, 'Vanessa Teixeira', '91537527931', '18.012.345-8', '1992-01-17', 32, 'Cyber Innovations', 'Especialista', 'Ativo', '(41) 9234-5678', '(41) 91234-5679', '2024-12-17 18:39:52', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `uss_usuarios`
--

CREATE TABLE `uss_usuarios` (
  `uso_Id` int(11) NOT NULL,
  `uso_Nome` varchar(100) NOT NULL,
  `uso_Senha` varchar(100) NOT NULL,
  `uso_Tipo_Usuario` enum('Administrador','Comum') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `uss_usuarios`
--

INSERT INTO `uss_usuarios` (`uso_Id`, `uso_Nome`, `uso_Senha`, `uso_Tipo_Usuario`) VALUES
(9, 'admin', '$2y$10$.yb9ywyNbVp/Pm7gTJjWk.kbgpUAxt.TUxHxai1DOWsG.UCMRWdTG', 'Administrador'),
(14, 'bb', '$2y$10$zL1E81uliHsMW6t9/Vl4.Os75jthCnr.E0kq.U15j7qwP2e3PSnja', 'Administrador');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `dpe_dependente`
--
ALTER TABLE `dpe_dependente`
  ADD PRIMARY KEY (`dpe_id`),
  ADD KEY `fk_dpe_flo1` (`flo_id`);

--
-- Índices de tabela `flo_filiado`
--
ALTER TABLE `flo_filiado`
  ADD PRIMARY KEY (`flo_id`),
  ADD UNIQUE KEY `flo_CPF` (`flo_cpf`) USING BTREE;

--
-- Índices de tabela `uss_usuarios`
--
ALTER TABLE `uss_usuarios`
  ADD PRIMARY KEY (`uso_Id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `dpe_dependente`
--
ALTER TABLE `dpe_dependente`
  MODIFY `dpe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `flo_filiado`
--
ALTER TABLE `flo_filiado`
  MODIFY `flo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de tabela `uss_usuarios`
--
ALTER TABLE `uss_usuarios`
  MODIFY `uso_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `dpe_dependente`
--
ALTER TABLE `dpe_dependente`
  ADD CONSTRAINT `fk_dpe_flo1` FOREIGN KEY (`flo_id`) REFERENCES `flo_filiado` (`flo_Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
