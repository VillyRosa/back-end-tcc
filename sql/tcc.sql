-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28/04/2023 às 06:36
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `tcc`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `anexos_posts`
--

CREATE TABLE `anexos_posts` (
  `id_anexoposts` int(11) NOT NULL,
  `anexo_anexoposts` varchar(255) NOT NULL,
  `id_posts` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `materias`
--

CREATE TABLE `materias` (
  `id_materias` int(11) NOT NULL,
  `nome_materias` varchar(60) NOT NULL,
  `professor_materias` varchar(60) NOT NULL,
  `id_semestre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `materias`
--

INSERT INTO `materias` (`id_materias`, `nome_materias`, `professor_materias`, `id_semestre`) VALUES
(1, 'Administração geral', 'Luciana Marcondes', 1),
(2, 'Algoritmos', 'Ronnie Rillo', 1),
(3, 'Matemática discreta', 'Gabriela Mendes', 1),
(4, 'Inglês I', 'Luciane Berti', 1),
(5, 'Arquitetura e organização de computadores', 'Lucilena de Lima', 1),
(6, 'Programação em microinformática', 'Saulo Zambotti', 1),
(7, 'Laboratório de hardware', 'Saulo Zambotti', 1),
(8, 'Comunicação e expressão', 'Luciane Berti', 2),
(9, 'Sistema de informação', 'Renata Goes', 2),
(10, 'Cálculo', 'Gabriela Mendes', 2),
(11, 'Engenharia de software I', 'Lucilena de Lima', 2),
(12, 'Linguagem de programação', 'Ronnie Rillo', 2),
(13, 'Inglês II', 'Luciane Berti', 2),
(14, 'Contabilidade', 'Euclides Teixeira', 2),
(15, 'Estrutura de dados', 'Ronnie Rillo', 3),
(16, 'Sistemas operacionais I', 'Saulo Zambotti', 3),
(17, 'Economia e finanças', 'Euclides Teixeira', 3),
(18, 'Estatística', 'Célia Estevam', 3),
(19, 'Inglês III', 'Luciane Berti', 3),
(20, 'Sociedade e tecnologia', 'Luciana Marcondes', 3),
(21, 'Interação humano computador', 'Renata Goes', 3),
(22, 'Engenharia de software II', 'Renata Goes', 3),
(23, 'Engenharia de software III', 'Renata Goes', 4),
(24, 'Banco de dados', 'Samuel Stabile', 4),
(25, 'Programação orientada a objetos', 'Saulo Zambotti', 4),
(26, 'Programação script', 'Ronnie Rillo', 4),
(27, 'Metodologia', 'Luciana Marcondes', 4),
(28, 'Sistemas operacionais II', 'Saulo Zambotti', 4),
(29, 'Inglês IV', 'Luciane Berti', 4),
(30, 'Redes de computador', 'Saulo Zambotti', 5),
(31, 'Inglês V', 'Luciane Berti', 5),
(32, 'Programação para dispositivos móveis', 'Alexandre Silva', 5),
(33, 'Laboratório de engenharia de software', 'Renata Goes', 5),
(34, 'Programação linear', 'Célia Estevam', 5),
(35, 'Laboratório de banco de dados', 'Alexandre Silva', 5),
(36, 'Segurança da informação', 'Samuel Stabile', 5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `posts`
--

CREATE TABLE `posts` (
  `id_posts` int(11) NOT NULL,
  `conteudo_posts` varchar(255) NOT NULL,
  `datahora_posts` datetime NOT NULL,
  `resposta_posts` varchar(5) NOT NULL,
  `curtidas_posts` int(11) NOT NULL,
  `id_materia` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `semestre`
--

CREATE TABLE `semestre` (
  `id_semestre` int(11) NOT NULL,
  `nome_semestre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `semestre`
--

INSERT INTO `semestre` (`id_semestre`, `nome_semestre`) VALUES
(1, '1º semestre'),
(2, '2º semestre'),
(3, '3º semestre'),
(4, '4º semestre'),
(5, '5º semestre'),
(6, '6º semestre');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nome_usuario` varchar(60) NOT NULL,
  `email_usuario` varchar(40) NOT NULL,
  `senha_usuario` varchar(100) NOT NULL,
  `dataNascimento_usuario` date NOT NULL,
  `foto_usuario` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nome_usuario`, `email_usuario`, `senha_usuario`, `dataNascimento_usuario`, `foto_usuario`) VALUES
(1, 'Villy Rosa', 'villyrosa69@gmail.com', '20baf5233671cd5e1edcf2e24fda154e86b6d2cf', '2003-05-05', ''),
(2, 'Gustavo Scardovelli', 'gustavoscardovelli@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2003-05-20', '');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `anexos_posts`
--
ALTER TABLE `anexos_posts`
  ADD PRIMARY KEY (`id_anexoposts`),
  ADD KEY `id_posts` (`id_posts`);

--
-- Índices de tabela `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`id_materias`),
  ADD KEY `id_semestre` (`id_semestre`);

--
-- Índices de tabela `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id_posts`),
  ADD KEY `id_materia` (`id_materia`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices de tabela `semestre`
--
ALTER TABLE `semestre`
  ADD PRIMARY KEY (`id_semestre`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `anexos_posts`
--
ALTER TABLE `anexos_posts`
  MODIFY `id_anexoposts` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `materias`
--
ALTER TABLE `materias`
  MODIFY `id_materias` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de tabela `posts`
--
ALTER TABLE `posts`
  MODIFY `id_posts` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `semestre`
--
ALTER TABLE `semestre`
  MODIFY `id_semestre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `anexos_posts`
--
ALTER TABLE `anexos_posts`
  ADD CONSTRAINT `anexos_posts_ibfk_1` FOREIGN KEY (`id_posts`) REFERENCES `posts` (`id_posts`);

--
-- Restrições para tabelas `materias`
--
ALTER TABLE `materias`
  ADD CONSTRAINT `materias_ibfk_1` FOREIGN KEY (`id_semestre`) REFERENCES `semestre` (`id_semestre`);

--
-- Restrições para tabelas `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`id_materia`) REFERENCES `materias` (`id_materias`),
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
