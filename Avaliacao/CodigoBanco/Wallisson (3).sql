-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 05/12/2024 às 21:09
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
CREATE DATABASE IF NOT EXISTS `Wallisson` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `Wallisson`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `dps_dependentes`
--

DROP TABLE IF EXISTS `dps_dependentes`;
CREATE TABLE `dps_dependentes` (
  `dpe_Id` int(11) NOT NULL,
  `flo_Id` int(11) NOT NULL,
  `dpe_Nome` varchar(100) NOT NULL,
  `dpe_Data_De_Nascimento` date NOT NULL,
  `dpe_Grau_De_parentesco` enum('Conjuge','Filho','Pai','Mae') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `dps_dependentes`
--

INSERT INTO `dps_dependentes` (`dpe_Id`, `flo_Id`, `dpe_Nome`, `dpe_Data_De_Nascimento`, `dpe_Grau_De_parentesco`) VALUES
(1, 13, 'teste', '2024-11-27', 'Conjuge'),
(2, 17, 'y', '2024-12-26', 'Pai'),
(3, 17, 'u', '2024-12-30', 'Mae'),
(6, 13, 'p', '2024-12-31', 'Filho');

-- --------------------------------------------------------

--
-- Estrutura para tabela `fls_filiados`
--

DROP TABLE IF EXISTS `fls_filiados`;
CREATE TABLE `fls_filiados` (
  `flo_Id` int(11) NOT NULL,
  `flo_Nome` varchar(100) NOT NULL,
  `flo_CPF` varchar(18) NOT NULL,
  `flo_RG` varchar(18) NOT NULL,
  `flo_Data_De_Nascimento` date NOT NULL,
  `flo_Idade` int(11) NOT NULL,
  `flo_Empresa` varchar(100) DEFAULT NULL,
  `flo_Cargo` varchar(100) DEFAULT NULL,
  `flo_Situacao` enum('Ativo','Aposentado','Licenciado') DEFAULT NULL,
  `flo_Telefone_Residencial` varchar(18) DEFAULT NULL,
  `flo_Celular` varchar(18) DEFAULT NULL,
  `flo_Data_Ultima_Atualizacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `fls_filiados`
--

INSERT INTO `fls_filiados` (`flo_Id`, `flo_Nome`, `flo_CPF`, `flo_RG`, `flo_Data_De_Nascimento`, `flo_Idade`, `flo_Empresa`, `flo_Cargo`, `flo_Situacao`, `flo_Telefone_Residencial`, `flo_Celular`, `flo_Data_Ultima_Atualizacao`) VALUES
(13, 'wallisson', '123.456.789-09', '12.345.675-1', '2001-04-18', 23, 'Moobi', 'Desenvolvedorr', 'Ativo', '(11) 1234-5678', '(11) 91234-5679', '2024-12-03 16:46:59'),
(17, 'wad', '987.654.321-00', '12.345.675-1', '1993-04-04', 31, NULL, NULL, NULL, '(11) 1234-5678', '(11) 91234-5679', '2024-12-05 15:12:16'),
(21, 'Ana Oliveira', '251.987.463-00', '23.456.789-2', '1998-03-22', 26, 'Tech Corp', 'Analista', 'Ativo', '(21) 2234-5678', '(21) 91234-5679', '2024-12-05 14:43:47'),
(22, 'Carlos Pereira', '317.526.894-12', '34.567.890-3', '1985-09-12', 38, 'Web Solutions', 'Gerente', 'Ativo', '(31) 3234-5678', '(31) 91234-5679', '2024-12-05 14:43:47'),
(23, 'Maria Souza', '428.639.175-84', '45.678.901-4', '1993-07-30', 30, 'Alpha Tech', 'Consultora', 'Ativo', '(41) 4234-5678', '(41) 91234-5679', '2024-12-05 14:43:47'),
(24, 'João Lima', '549.231.786-35', '56.789.012-5', '2000-01-15', 24, 'Beta Systems', 'Engenheiro', 'Ativo', '(51) 5234-5678', '(51) 91234-5679', '2024-12-05 14:43:47'),
(25, 'Fernanda Alves', '692.843.517-06', '67.890.123-6', '1995-05-10', 29, 'Gamma Innovations', 'Coordenadora', 'Ativo', '(61) 6234-5678', '(61) 91234-5679', '2024-12-05 14:43:47'),
(26, 'Rafael Mendes', '703.954.628-29', '78.901.234-7', '1992-11-20', 31, 'Zeta Corp', 'Administrador', 'Ativo', '(71) 7234-5678', '(71) 91234-5679', '2024-12-05 14:43:47'),
(27, 'Clara Santos', '814.365.249-41', '89.012.345-8', '1997-02-28', 27, 'Omega Systems', 'Especialista', 'Ativo', '(81) 8234-5678', '(81) 91234-5679', '2024-12-05 14:43:47'),
(28, 'Paulo Silva', '925.476.380-73', '90.123.456-9', '1988-08-05', 35, 'Delta Solutions', 'Técnico', 'Ativo', '(91) 9234-5678', '(91) 91234-5679', '2024-12-05 14:43:47'),
(29, 'Isabela Costa', '036.587.491-90', '10.234.567-0', '1999-10-22', 24, 'Epsilon Corp', 'Estagiária', 'Ativo', '(31) 1234-5678', '(31) 91234-5679', '2024-12-05 14:43:47'),
(30, 'Felipe Nogueira', '147.698.502-18', '11.345.678-1', '1996-06-18', 28, 'TechMax', 'Designer', 'Ativo', '(41) 2234-5678', '(41) 91234-5679', '2024-12-05 14:43:47'),
(31, 'Juliana Ramos', '258.709.613-21', '12.456.789-2', '1987-12-25', 36, 'Prime Solutions', 'RH', 'Ativo', '(51) 3234-5678', '(51) 91234-5679', '2024-12-05 14:43:47'),
(32, 'Lucas Rocha', '369.820.724-43', '13.567.890-3', '1994-04-09', 30, 'Infinity Tech', 'DevOps', 'Ativo', '(61) 4234-5678', '(61) 91234-5679', '2024-12-05 14:43:47'),
(33, 'Gabriela Lima', '471.931.835-65', '14.678.901-4', '1990-03-15', 34, 'Digital Web', 'Analista', 'Ativo', '(71) 5234-5678', '(71) 91234-5679', '2024-12-05 14:43:47'),
(34, 'Diego Almeida', '582.042.946-87', '15.789.012-5', '1993-08-01', 31, 'Nova Corp', 'Engenheiro', 'Ativo', '(81) 6234-5678', '(81) 91234-5679', '2024-12-05 14:43:47'),
(35, 'Bianca Ferreira', '693.153.057-09', '16.890.123-6', '1991-09-19', 33, 'Virtual Tech', 'Coordenadora', 'Ativo', '(91) 7234-5678', '(91) 91234-5679', '2024-12-05 14:43:47'),
(36, 'Gustavo Moreira', '804.264.168-20', '17.901.234-7', '1989-02-25', 35, 'Matrix Systems', 'Administrador', 'Ativo', '(31) 8234-5678', '(31) 91234-5679', '2024-12-05 14:43:47'),
(37, 'Vanessa Teixeira', '915.375.279-31', '18.012.345-8', '1992-01-17', 32, 'Cyber Innovations', 'Especialista', 'Ativo', '(41) 9234-5678', '(41) 91234-5679', '2024-12-05 14:43:47'),
(38, 'Pedro Matos', '126.486.390-42', '19.123.456-9', '1986-07-30', 37, 'NextGen Solutions', 'Técnico', 'Ativo', '(51) 1234-5678', '(51) 91234-5679', '2024-12-05 14:43:47'),
(39, 'Larissa Cardoso', '237.597.401-53', '20.234.567-0', '2001-05-14', 22, 'Ultra Systems', 'Estagiária', 'Ativo', '(61) 2234-5678', '(61) 91234-5679', '2024-12-05 14:43:47');

-- --------------------------------------------------------

--
-- Estrutura para tabela `uss_usuarios`
--

DROP TABLE IF EXISTS `uss_usuarios`;
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
(8, 'aa', '$2y$10$92pe1NpRmr9YfGG6cO2oVeUIkr1Zeu196jrN0paqCZ/2sbSUA/qu2', 'Administrador'),
(9, 'admin', '$2y$10$.yb9ywyNbVp/Pm7gTJjWk.kbgpUAxt.TUxHxai1DOWsG.UCMRWdTG', 'Administrador');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `dps_dependentes`
--
ALTER TABLE `dps_dependentes`
  ADD PRIMARY KEY (`dpe_Id`),
  ADD KEY `flo_Id` (`flo_Id`);

--
-- Índices de tabela `fls_filiados`
--
ALTER TABLE `fls_filiados`
  ADD PRIMARY KEY (`flo_Id`),
  ADD UNIQUE KEY `flo_CPF` (`flo_CPF`);

--
-- Índices de tabela `uss_usuarios`
--
ALTER TABLE `uss_usuarios`
  ADD PRIMARY KEY (`uso_Id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `dps_dependentes`
--
ALTER TABLE `dps_dependentes`
  MODIFY `dpe_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `fls_filiados`
--
ALTER TABLE `fls_filiados`
  MODIFY `flo_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de tabela `uss_usuarios`
--
ALTER TABLE `uss_usuarios`
  MODIFY `uso_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `dps_dependentes`
--
ALTER TABLE `dps_dependentes`
  ADD CONSTRAINT `dps_dependentes_ibfk_1` FOREIGN KEY (`flo_Id`) REFERENCES `fls_filiados` (`flo_Id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
