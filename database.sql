-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           9.1.0 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.11.0.7065
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Copiando estrutura para tabela secretaria_digital.alunos
CREATE TABLE IF NOT EXISTS `alunos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_pai` int NOT NULL DEFAULT '0',
  `matricula` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nome` varchar(999) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rg` varchar(999) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cpf` varchar(999) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(999) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nascimento` varchar(999) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefone` varchar(999) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(999) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `naturalidade` varchar(999) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nacionalidade` varchar(999) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `endereco` varchar(999) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numero` varchar(999) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `complemento` varchar(999) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bairro` varchar(999) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cidade` varchar(999) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` varchar(999) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cep` varchar(999) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela secretaria_digital.alunos: 12 rows
/*!40000 ALTER TABLE `alunos` DISABLE KEYS */;
INSERT INTO `alunos` (`id`, `id_pai`, `matricula`, `nome`, `rg`, `cpf`, `foto`, `nascimento`, `telefone`, `email`, `naturalidade`, `nacionalidade`, `endereco`, `numero`, `complemento`, `bairro`, `cidade`, `estado`, `cep`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 92, '20250001', 'Murilo Rafael Passos Rondon', '5654654654654', '65465465465', NULL, '2016-12-28', '65984518769', 'murilo@email.com', 'Cuiabano', 'Brasileiro', 'Rua 6', '162', 'Torre 1, Apto 36', 'Parque das Nações', 'Cuiabá', 'MT', '78056851', '2025-04-12 22:23:32', '2025-05-19 09:42:54', NULL),
	(2, 92, '20250002', 'Isadora Passos Rondon', '12321321321', '12312132132', NULL, '2018-11-01', '65984518769', 'isadora@email.com', 'Cuiabá-MT', 'Brasileira', 'Rua 6', '162', 'Torre 1, Apto 36', 'Parque das Nações', 'Cuiabá', 'MT', '78056851', '2025-04-12 22:30:13', '2025-04-25 10:11:09', NULL),
	(26, 92, '20250003', 'LUCAS RAFAEL MUNIZ RONDON', '', '21321321321', NULL, '', '65984518769', 'lucasrondon@gmail.com', '', '', 'Rua', '6', '', 'Parque das Nações', 'Cuiabá', 'MT', '78056851', '2025-04-21 12:53:25', '2025-04-21 12:54:06', '2025-04-21 12:54:06'),
	(27, 92, '20250003', 'LUCAS RAFAEL MUNIZ RONDON', '', '', NULL, '', '65984518769', 'lucasrondon@gmail.com', '', '', 'Rua', '6', '', 'Parque das Nações', 'Cuiabá', 'MT', '78056851', '2025-04-21 12:54:14', '2025-04-21 19:33:52', NULL),
	(28, 92, '20250004', 'Maria Do Carmo Muniz Rondon', '', '', NULL, '', '', '', '', '', 'Rua', '6', '', '', 'Cuiabá', 'MT', '78056851', '2025-04-21 17:51:13', '2025-04-21 18:40:44', NULL),
	(29, 97, '20250005', 'Marcio', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', '', '2025-04-21 18:51:52', '2025-04-21 18:51:52', NULL),
	(30, 92, '20250006', 'Olivia Moura', '', '21213213213', NULL, '', '', '', '', '', '', '', '', '', '', '', '', '2025-05-19 09:43:23', '2025-05-19 09:43:45', NULL),
	(31, 97, '20250007', 'Marina Gomes', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', '', '2025-05-19 10:58:14', '2025-05-19 10:59:01', NULL),
	(32, 97, '20250008', 'Eduardo Gomes', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', '', '2025-05-19 10:58:22', '2025-05-19 10:58:22', NULL),
	(33, 97, '20250009', 'João da Silva Gomes', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', '', '2025-05-19 10:58:31', '2025-05-19 10:58:31', NULL),
	(34, 97, '20250010', 'Otavio Gomes', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', '', '2025-05-19 10:58:43', '2025-05-19 10:58:43', NULL),
	(35, 97, '20250011', 'Joana Gomes', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', '', '2025-05-19 10:58:51', '2025-05-19 10:58:51', NULL);
/*!40000 ALTER TABLE `alunos` ENABLE KEYS */;

-- Copiando estrutura para tabela secretaria_digital.alunos_faltas
CREATE TABLE IF NOT EXISTS `alunos_faltas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_aluno` int DEFAULT NULL,
  `id_turma` int DEFAULT NULL,
  `id_disciplina` int DEFAULT NULL,
  `bimestre` int DEFAULT NULL,
  `falta` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_alunos_faltas_alunos` (`id_aluno`) USING BTREE,
  KEY `FK_alunos_faltas_turmas` (`id_turma`) USING BTREE,
  KEY `FK_alunos_faltas_disciplinas` (`id_disciplina`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela secretaria_digital.alunos_faltas: 16 rows
/*!40000 ALTER TABLE `alunos_faltas` DISABLE KEYS */;
INSERT INTO `alunos_faltas` (`id`, `id_aluno`, `id_turma`, `id_disciplina`, `bimestre`, `falta`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(68, 2, 1, 31, 1, 2, '2025-07-07 10:25:02', '2025-07-08 09:27:18', NULL),
	(69, 2, 1, 31, 2, 1, '2025-07-07 10:25:02', '2025-07-08 09:27:18', NULL),
	(70, 2, 1, 31, 3, 3, '2025-07-07 10:25:02', '2025-07-08 09:27:18', NULL),
	(71, 2, 1, 31, 4, 3, '2025-07-07 10:25:02', '2025-07-08 09:27:18', NULL),
	(72, 29, 1, 31, 1, 1, '2025-07-07 10:25:02', '2025-07-08 09:27:18', NULL),
	(73, 29, 1, 31, 2, 2, '2025-07-07 10:25:02', '2025-07-08 09:27:18', NULL),
	(74, 29, 1, 31, 3, 3, '2025-07-07 10:25:02', '2025-07-08 09:27:18', NULL),
	(75, 29, 1, 31, 4, 2, '2025-07-07 10:25:02', '2025-07-08 09:27:18', NULL),
	(76, 1, 1, 31, 1, 1, '2025-07-08 09:27:18', '2025-07-08 09:27:18', NULL),
	(77, 1, 1, 31, 2, 3, '2025-07-08 09:27:18', '2025-07-08 09:27:18', NULL),
	(78, 1, 1, 31, 3, 2, '2025-07-08 09:27:18', '2025-07-08 09:27:18', NULL),
	(79, 1, 1, 31, 4, 2, '2025-07-08 09:27:18', '2025-07-08 09:27:18', NULL),
	(80, 2, 1, 35, 1, 1, '2025-08-18 21:45:07', '2025-08-18 21:45:07', NULL),
	(81, 2, 1, 35, 2, 2, '2025-08-18 21:45:07', '2025-08-18 21:45:07', NULL),
	(82, 2, 1, 35, 3, 3, '2025-08-18 21:45:07', '2025-08-18 21:45:07', NULL),
	(83, 2, 1, 35, 4, 4, '2025-08-18 21:45:07', '2025-08-18 21:45:07', NULL);
/*!40000 ALTER TABLE `alunos_faltas` ENABLE KEYS */;

-- Copiando estrutura para tabela secretaria_digital.alunos_info_complemetares
CREATE TABLE IF NOT EXISTS `alunos_info_complemetares` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_aluno` int DEFAULT NULL,
  `id_turma` int DEFAULT NULL,
  `observacao` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `situacao` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `alunoInfo` (`id_aluno`),
  KEY `turmaInfo` (`id_turma`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela secretaria_digital.alunos_info_complemetares: 2 rows
/*!40000 ALTER TABLE `alunos_info_complemetares` DISABLE KEYS */;
INSERT INTO `alunos_info_complemetares` (`id`, `id_aluno`, `id_turma`, `observacao`, `situacao`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 2, 1, '', 'cursando', '2025-07-08 10:41:02', '2025-07-08 10:41:02', NULL),
	(2, 29, 1, 'Transferido para Escola Estadual Maria Hermínia Alves', 'transferido', '2025-07-08 10:46:38', '2025-07-08 10:46:38', NULL);
/*!40000 ALTER TABLE `alunos_info_complemetares` ENABLE KEYS */;

-- Copiando estrutura para tabela secretaria_digital.alunos_notas
CREATE TABLE IF NOT EXISTS `alunos_notas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_aluno` int DEFAULT NULL,
  `id_turma` int DEFAULT NULL,
  `id_disciplina` int DEFAULT NULL,
  `bimestre` int DEFAULT NULL,
  `nota` decimal(4,2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_alunos_notas_alunos` (`id_aluno`) USING BTREE,
  KEY `FK_alunos_notas_turmas` (`id_turma`) USING BTREE,
  KEY `FK_alunos_notas_disciplinas` (`id_disciplina`) USING BTREE,
  CONSTRAINT `alunos_notas_chk_1` CHECK ((`nota` between 0.00 and 10.00))
) ENGINE=MyISAM AUTO_INCREMENT=182 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela secretaria_digital.alunos_notas: 17 rows
/*!40000 ALTER TABLE `alunos_notas` DISABLE KEYS */;
INSERT INTO `alunos_notas` (`id`, `id_aluno`, `id_turma`, `id_disciplina`, `bimestre`, `nota`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(165, 2, 1, 31, 1, 10.00, '2025-07-07 10:25:02', '2025-07-08 09:27:18', NULL),
	(166, 2, 1, 31, 2, 9.50, '2025-07-07 10:25:02', '2025-07-08 09:27:18', NULL),
	(167, 2, 1, 31, 3, 8.00, '2025-07-07 10:25:02', '2025-07-08 09:27:18', NULL),
	(168, 2, 1, 31, 4, 7.00, '2025-07-07 10:25:02', '2025-07-08 09:27:18', NULL),
	(169, 29, 1, 31, 1, 9.50, '2025-07-07 10:25:02', '2025-07-08 09:27:18', NULL),
	(170, 29, 1, 31, 2, 10.00, '2025-07-07 10:25:02', '2025-07-08 09:27:18', NULL),
	(171, 29, 1, 31, 3, 8.00, '2025-07-07 10:25:02', '2025-07-08 09:27:18', NULL),
	(172, 29, 1, 31, 4, 7.50, '2025-07-07 10:25:02', '2025-07-08 09:27:18', NULL),
	(173, 2, 1, 36, 1, 7.00, '2025-07-07 19:41:04', '2025-07-07 19:41:05', NULL),
	(174, 1, 1, 31, 1, 8.00, '2025-07-08 09:27:18', '2025-07-08 09:27:18', NULL),
	(175, 1, 1, 31, 2, 9.00, '2025-07-08 09:27:18', '2025-07-08 09:27:18', NULL),
	(176, 1, 1, 31, 3, 4.00, '2025-07-08 09:27:18', '2025-07-08 09:27:18', NULL),
	(177, 1, 1, 31, 4, 10.00, '2025-07-08 09:27:18', '2025-07-08 09:27:18', NULL),
	(178, 2, 1, 35, 1, 10.00, '2025-08-18 21:45:07', '2025-08-18 21:45:07', NULL),
	(179, 2, 1, 35, 2, 9.00, '2025-08-18 21:45:07', '2025-08-18 21:45:07', NULL),
	(180, 2, 1, 35, 3, 5.00, '2025-08-18 21:45:07', '2025-08-18 21:45:07', NULL),
	(181, 2, 1, 35, 4, 10.00, '2025-08-18 21:45:07', '2025-08-18 21:45:07', NULL);
/*!40000 ALTER TABLE `alunos_notas` ENABLE KEYS */;

-- Copiando estrutura para tabela secretaria_digital.avaliacao_individual
CREATE TABLE IF NOT EXISTS `avaliacao_individual` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(200) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `categoria` int DEFAULT NULL COMMENT '1- Aspectos Físicos, 2- Aspectos Sociais, 3- Aspectos Cognitivos, 4 - Habilidades Linguisticas, 5- Habilidades Matemáticas',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Copiando dados para a tabela secretaria_digital.avaliacao_individual: ~49 rows (aproximadamente)
INSERT INTO `avaliacao_individual` (`id`, `descricao`, `categoria`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Respeita limite da folha e desenho', 1, '2025-07-09 22:21:44', '2025-07-09 22:21:45', NULL),
	(2, 'Tem equilíbrio e agilidade', 1, '2025-07-09 22:22:43', '2025-07-09 22:22:45', NULL),
	(3, 'Se expressa corporalmente', 1, '2025-07-09 22:22:44', '2025-07-09 22:22:45', NULL),
	(4, 'Brinca e interage	', 1, '2025-07-09 22:23:09', '2025-07-09 22:23:10', NULL),
	(5, 'Tem coordenação motora grossa', 1, '2025-07-09 22:23:26', '2025-07-09 22:23:26', NULL),
	(6, 'Tem coordenação motora fina', 1, '2025-07-09 22:23:36', '2025-07-09 22:23:38', NULL),
	(7, 'Lateralidade definida', 1, '2025-07-09 22:23:49', '2025-07-09 22:23:49', NULL),
	(8, 'Orientação especial', 1, '2025-07-09 22:24:00', '2025-07-09 22:24:00', NULL),
	(9, 'Respeita regras e combinados', 2, '2025-07-09 22:24:20', '2025-07-09 22:24:21', NULL),
	(10, 'Trabalha em equipe', 2, '2025-07-09 22:24:40', '2025-07-09 22:24:41', NULL),
	(11, 'Ajuda nas tarefinhas dos adultos', 2, '2025-07-09 22:24:51', '2025-07-09 22:24:51', NULL),
	(12, 'Empresta/compartilha brinquedos', 2, '2025-07-09 22:25:04', '2025-07-09 22:25:05', NULL),
	(13, 'Tem consciência do eu, você e nós', 2, '2025-07-09 22:25:15', '2025-07-09 22:25:16', NULL),
	(14, 'Manifesta opiniões pessoais', 2, '2025-07-09 22:25:25', '2025-07-09 22:25:26', NULL),
	(15, 'Comunica-se com clareza', 3, '2025-07-09 22:25:59', '2025-07-09 22:26:00', NULL),
	(16, 'Compara dois ou mais objetos', 3, '2025-07-09 22:26:10', '2025-07-09 22:26:11', NULL),
	(17, 'Constrói com blocos e cubos', 3, '2025-07-09 22:26:19', '2025-07-09 22:26:22', NULL),
	(18, 'Ouve histórias atentamente', 3, '2025-07-09 22:26:37', '2025-07-09 22:26:38', NULL),
	(19, 'Reconta histórias com coerência', 3, '2025-07-09 22:26:48', '2025-07-09 22:26:49', NULL),
	(20, 'Canta músicas inteiras', 3, '2025-07-09 22:27:04', '2025-07-09 22:27:04', NULL),
	(21, 'Acompanha os ritmos musicais', 3, '2025-07-09 23:06:38', '2025-07-09 23:06:39', NULL),
	(22, 'Faz uso dos pronomes eu e você', 4, '2025-07-09 22:27:18', '2025-07-09 22:27:19', NULL),
	(23, 'Articula frases com várias palavras', 4, '2025-07-09 22:27:30', '2025-07-09 22:27:31', NULL),
	(24, 'Identifica e traça as vogais A, E, I, O e U', 4, '2025-07-09 22:27:50', '2025-07-09 22:27:51', NULL),
	(25, 'Identifica outras palavras que se iniciam com as vogais A, E, I, O e U', 4, '2025-07-09 22:28:05', '2025-07-09 22:28:05', NULL),
	(26, 'Identifica o próprio nome', 4, '2025-07-09 22:28:21', '2025-07-09 22:28:22', NULL),
	(27, 'Copia o próprio nome com modelo', 4, '2025-07-09 22:28:43', '2025-07-09 22:28:45', NULL),
	(28, 'Escreve o próprio nome sem ajuda', 4, '2025-07-09 22:28:56', '2025-07-09 22:28:57', NULL),
	(29, 'Compreende as cantigas populares e consegue interpretá-las através de desenhos e respostas orais', 4, '2025-07-09 22:29:10', '2025-07-09 22:29:10', NULL),
	(30, 'Identifica tipo de alimentos', 4, '2025-07-09 22:29:22', '2025-07-09 22:29:23', NULL),
	(31, 'Identifica tipo de animais e seu habitat', 4, '2025-07-09 22:29:35', '2025-07-09 22:29:36', NULL),
	(32, 'Identifica objetos do seu dia a dia', 4, '2025-07-09 22:29:52', '2025-07-09 22:29:53', NULL),
	(33, 'Identifica e aplica técnicas de higiene', 4, '2025-07-09 22:30:04', '2025-07-09 22:30:04', NULL),
	(34, 'Identifica a importância da natureza e coleta seletiva', 4, '2025-07-09 22:30:17', '2025-07-09 22:30:18', NULL),
	(35, 'Identifica e traça os numerais 1,2,3,4 e 5', 5, '2025-07-09 22:30:34', '2025-07-09 22:30:34', NULL),
	(36, 'Faz contagem Oral', 5, '2025-07-09 22:30:47', '2025-07-09 22:30:47', NULL),
	(37, 'Realiza agrupamentos de 1,2,3,4, e 5', 5, '2025-07-09 22:30:59', '2025-07-09 22:30:59', NULL),
	(38, 'Relaciona número à respectiva quantidade', 5, '2025-07-09 22:31:11', '2025-07-09 22:31:12', NULL),
	(39, 'Identifica uma sequência', 5, '2025-07-09 22:31:21', '2025-07-09 22:31:22', NULL),
	(40, 'Identifica cores', 5, '2025-07-09 22:31:32', '2025-07-09 22:31:32', NULL),
	(41, 'Identifica igual/diferente', 5, '2025-07-09 22:31:44', '2025-07-09 22:31:44', NULL),
	(42, 'Identifica lento/rápido', 5, '2025-07-09 22:31:54', '2025-07-09 22:31:55', NULL),
	(43, 'Identifica grande/pequeno', 5, '2025-07-09 22:32:05', '2025-07-09 22:32:05', NULL),
	(44, 'Identifica estreito/largo', 5, '2025-07-09 22:32:18', '2025-07-09 22:32:19', NULL),
	(45, 'Identifica leve/pesado', 5, '2025-07-09 22:32:31', '2025-07-09 22:32:32', NULL),
	(46, 'Identifica perto/longe', 5, '2025-07-09 22:32:44', '2025-07-09 22:32:45', NULL),
	(47, 'Identifica alto/baixo', 5, '2025-07-09 22:32:55', '2025-07-09 22:32:57', NULL),
	(48, 'Separa objetos por forma, textura, sombra e tamanho', 5, '2025-07-09 22:33:10', '2025-07-09 22:33:11', NULL),
	(49, 'Identifica e representa as formas geométricas', 5, '2025-07-09 22:33:32', '2025-07-09 22:33:32', NULL);

-- Copiando estrutura para tabela secretaria_digital.avaliacao_individual_aluno_turma
CREATE TABLE IF NOT EXISTS `avaliacao_individual_aluno_turma` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_aluno` int DEFAULT NULL,
  `id_turma` int DEFAULT NULL,
  `id_avaliacao` int DEFAULT NULL,
  `bimestre` int DEFAULT NULL,
  `resposta` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `alunoAvaliacao` (`id_aluno`),
  KEY `turmaAvaliacao` (`id_turma`),
  KEY `avaliacaoIndividual` (`id_avaliacao`)
) ENGINE=MyISAM AUTO_INCREMENT=275 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela secretaria_digital.avaliacao_individual_aluno_turma: 70 rows
/*!40000 ALTER TABLE `avaliacao_individual_aluno_turma` DISABLE KEYS */;
INSERT INTO `avaliacao_individual_aluno_turma` (`id`, `id_aluno`, `id_turma`, `id_avaliacao`, `bimestre`, `resposta`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(156, 30, 2, 9, 3, 's', '2025-08-08 11:09:01', '2025-08-08 11:09:01', NULL),
	(157, 30, 2, 10, 3, 's', '2025-08-08 11:09:01', '2025-08-08 11:09:01', NULL),
	(158, 30, 2, 11, 3, 'n', '2025-08-08 11:09:01', '2025-08-08 11:09:01', NULL),
	(159, 30, 2, 12, 3, 'p', '2025-08-08 11:09:01', '2025-08-08 11:09:01', NULL),
	(160, 30, 2, 14, 3, 'p', '2025-08-08 11:09:01', '2025-08-08 11:09:01', NULL),
	(210, 32, 2, 1, 1, 's', '2025-08-08 11:47:37', '2025-08-08 11:47:37', NULL),
	(211, 32, 2, 2, 1, 's', '2025-08-08 11:47:37', '2025-08-08 11:47:37', NULL),
	(212, 32, 2, 3, 1, 's', '2025-08-08 11:47:37', '2025-08-08 11:47:37', NULL),
	(213, 32, 2, 4, 1, 's', '2025-08-08 11:47:37', '2025-08-08 11:47:37', NULL),
	(214, 32, 2, 5, 1, 's', '2025-08-08 11:47:37', '2025-08-08 11:47:37', NULL),
	(215, 32, 2, 6, 1, 's', '2025-08-08 11:47:37', '2025-08-08 11:47:37', NULL),
	(216, 32, 2, 7, 1, 's', '2025-08-08 11:47:37', '2025-08-08 11:47:37', NULL),
	(217, 32, 2, 8, 1, 's', '2025-08-08 11:47:37', '2025-08-08 11:47:37', NULL),
	(218, 32, 2, 1, 2, 'n', '2025-08-08 11:47:54', '2025-08-08 11:47:54', NULL),
	(219, 32, 2, 2, 2, 'n', '2025-08-08 11:47:54', '2025-08-08 11:47:54', NULL),
	(220, 32, 2, 3, 2, 'n', '2025-08-08 11:47:54', '2025-08-08 11:47:54', NULL),
	(221, 32, 2, 4, 2, 'n', '2025-08-08 11:47:54', '2025-08-08 11:47:54', NULL),
	(222, 32, 2, 5, 2, 'n', '2025-08-08 11:47:54', '2025-08-08 11:47:54', NULL),
	(223, 32, 2, 6, 2, 'n', '2025-08-08 11:47:54', '2025-08-08 11:47:54', NULL),
	(224, 32, 2, 7, 2, 'n', '2025-08-08 11:47:54', '2025-08-08 11:47:54', NULL),
	(225, 32, 2, 8, 2, 'n', '2025-08-08 11:47:54', '2025-08-08 11:47:54', NULL),
	(226, 30, 2, 1, 1, 's', '2025-08-18 21:45:36', '2025-08-18 21:45:36', NULL),
	(227, 30, 2, 2, 1, 'p', '2025-08-18 21:45:36', '2025-08-18 21:45:36', NULL),
	(228, 30, 2, 3, 1, 'n', '2025-08-18 21:45:36', '2025-08-18 21:45:36', NULL),
	(229, 30, 2, 4, 1, 's', '2025-08-18 21:45:36', '2025-08-18 21:45:36', NULL),
	(230, 30, 2, 5, 1, 'p', '2025-08-18 21:45:36', '2025-08-18 21:45:36', NULL),
	(231, 30, 2, 6, 1, 'n', '2025-08-18 21:45:36', '2025-08-18 21:45:36', NULL),
	(232, 30, 2, 7, 1, 's', '2025-08-18 21:45:36', '2025-08-18 21:45:36', NULL),
	(233, 30, 2, 8, 1, 'p', '2025-08-18 21:45:36', '2025-08-18 21:45:36', NULL),
	(234, 30, 2, 9, 1, 's', '2025-08-18 21:45:36', '2025-08-18 21:45:36', NULL),
	(235, 30, 2, 10, 1, 's', '2025-08-18 21:45:36', '2025-08-18 21:45:36', NULL),
	(236, 30, 2, 11, 1, 's', '2025-08-18 21:45:36', '2025-08-18 21:45:36', NULL),
	(237, 30, 2, 12, 1, 's', '2025-08-18 21:45:36', '2025-08-18 21:45:36', NULL),
	(238, 30, 2, 13, 1, 's', '2025-08-18 21:45:36', '2025-08-18 21:45:36', NULL),
	(239, 30, 2, 14, 1, 's', '2025-08-18 21:45:36', '2025-08-18 21:45:36', NULL),
	(240, 30, 2, 15, 1, 'p', '2025-08-18 21:45:36', '2025-08-18 21:45:36', NULL),
	(241, 30, 2, 16, 1, 'p', '2025-08-18 21:45:36', '2025-08-18 21:45:36', NULL),
	(242, 30, 2, 17, 1, 'p', '2025-08-18 21:45:36', '2025-08-18 21:45:36', NULL),
	(243, 30, 2, 18, 1, 'p', '2025-08-18 21:45:36', '2025-08-18 21:45:36', NULL),
	(244, 30, 2, 19, 1, 'p', '2025-08-18 21:45:36', '2025-08-18 21:45:36', NULL),
	(245, 30, 2, 20, 1, 'p', '2025-08-18 21:45:36', '2025-08-18 21:45:36', NULL),
	(246, 30, 2, 21, 1, 'p', '2025-08-18 21:45:36', '2025-08-18 21:45:36', NULL),
	(247, 30, 2, 22, 1, 'p', '2025-08-18 21:45:36', '2025-08-18 21:45:36', NULL),
	(248, 30, 2, 23, 1, 'p', '2025-08-18 21:45:36', '2025-08-18 21:45:36', NULL),
	(249, 30, 2, 24, 1, 'p', '2025-08-18 21:45:36', '2025-08-18 21:45:36', NULL),
	(250, 30, 2, 25, 1, 'p', '2025-08-18 21:45:36', '2025-08-18 21:45:36', NULL),
	(251, 30, 2, 26, 1, 'p', '2025-08-18 21:45:36', '2025-08-18 21:45:36', NULL),
	(252, 30, 2, 27, 1, 'p', '2025-08-18 21:45:36', '2025-08-18 21:45:36', NULL),
	(253, 30, 2, 28, 1, 'n', '2025-08-18 21:45:36', '2025-08-18 21:45:36', NULL),
	(254, 30, 2, 29, 1, 'n', '2025-08-18 21:45:36', '2025-08-18 21:45:36', NULL),
	(255, 30, 2, 30, 1, 'n', '2025-08-18 21:45:36', '2025-08-18 21:45:36', NULL),
	(256, 30, 2, 31, 1, 'n', '2025-08-18 21:45:36', '2025-08-18 21:45:36', NULL),
	(257, 30, 2, 32, 1, 'n', '2025-08-18 21:45:36', '2025-08-18 21:45:36', NULL),
	(258, 30, 2, 33, 1, 'n', '2025-08-18 21:45:36', '2025-08-18 21:45:36', NULL),
	(259, 30, 2, 34, 1, 'n', '2025-08-18 21:45:36', '2025-08-18 21:45:36', NULL),
	(260, 30, 2, 35, 1, 's', '2025-08-18 21:45:36', '2025-08-18 21:45:36', NULL),
	(261, 30, 2, 36, 1, 's', '2025-08-18 21:45:36', '2025-08-18 21:45:36', NULL),
	(262, 30, 2, 37, 1, 's', '2025-08-18 21:45:36', '2025-08-18 21:45:36', NULL),
	(263, 30, 2, 38, 1, 's', '2025-08-18 21:45:36', '2025-08-18 21:45:36', NULL),
	(264, 30, 2, 39, 1, 's', '2025-08-18 21:45:36', '2025-08-18 21:45:36', NULL),
	(265, 30, 2, 40, 1, 's', '2025-08-18 21:45:36', '2025-08-18 21:45:36', NULL),
	(266, 30, 2, 41, 1, 's', '2025-08-18 21:45:36', '2025-08-18 21:45:36', NULL),
	(267, 30, 2, 42, 1, 's', '2025-08-18 21:45:36', '2025-08-18 21:45:36', NULL),
	(268, 30, 2, 43, 1, 's', '2025-08-18 21:45:36', '2025-08-18 21:45:36', NULL),
	(269, 30, 2, 44, 1, 's', '2025-08-18 21:45:36', '2025-08-18 21:45:36', NULL),
	(270, 30, 2, 45, 1, 's', '2025-08-18 21:45:36', '2025-08-18 21:45:36', NULL),
	(271, 30, 2, 46, 1, 's', '2025-08-18 21:45:36', '2025-08-18 21:45:36', NULL),
	(272, 30, 2, 47, 1, 's', '2025-08-18 21:45:36', '2025-08-18 21:45:36', NULL),
	(273, 30, 2, 48, 1, 's', '2025-08-18 21:45:36', '2025-08-18 21:45:36', NULL),
	(274, 30, 2, 49, 1, 's', '2025-08-18 21:45:36', '2025-08-18 21:45:36', NULL);
/*!40000 ALTER TABLE `avaliacao_individual_aluno_turma` ENABLE KEYS */;

-- Copiando estrutura para tabela secretaria_digital.banners
CREATE TABLE IF NOT EXISTS `banners` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(999) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `link` varchar(999) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `texto` mediumtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `posicao` int DEFAULT NULL,
  `status` int DEFAULT '0',
  `imagem` varchar(999) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Copiando dados para a tabela secretaria_digital.banners: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela secretaria_digital.disciplinas
CREATE TABLE IF NOT EXISTS `disciplinas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `carga_horaria` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela secretaria_digital.disciplinas: 8 rows
/*!40000 ALTER TABLE `disciplinas` DISABLE KEYS */;
INSERT INTO `disciplinas` (`id`, `descricao`, `carga_horaria`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Português', 160, '2025-05-01 15:51:26', '2025-07-08 08:35:27', NULL),
	(3, 'Matemática', 160, '2025-05-17 11:31:05', '2025-07-08 08:35:37', NULL),
	(4, 'História', 120, '2025-05-17 11:31:11', '2025-07-08 08:33:27', NULL),
	(5, 'Geografia', 120, '2025-05-17 11:31:16', '2025-07-08 08:33:36', NULL),
	(6, 'Artes', 80, '2025-05-17 11:31:21', '2025-07-08 08:34:34', NULL),
	(7, 'Ensino Religioso', 60, '2025-05-17 11:31:27', '2025-07-08 08:35:56', NULL),
	(8, 'Ciências', NULL, '2025-07-08 08:27:41', '2025-07-08 08:31:45', '2025-07-08 08:31:45'),
	(9, 'Ciências', 100, '2025-07-08 08:32:00', '2025-07-08 08:32:00', NULL);
/*!40000 ALTER TABLE `disciplinas` ENABLE KEYS */;

-- Copiando estrutura para tabela secretaria_digital.empresa
CREATE TABLE IF NOT EXISTS `empresa` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `endereco` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `uf` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cidade` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cep` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telefone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `site` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela secretaria_digital.empresa: 1 rows
/*!40000 ALTER TABLE `empresa` DISABLE KEYS */;
INSERT INTO `empresa` (`id`, `nome`, `endereco`, `uf`, `cidade`, `cep`, `telefone`, `email`, `site`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Vida Feliz Escola', 'CPA 3 - Rua 7, quadra 1 - número 15', 'MT', 'Cuiabá', ' 78058-334', '(65) 99328-0039', '', 'vidafelizescola.com.br', '2025-01-22 15:19:22', '2025-03-16 17:33:35', NULL);
/*!40000 ALTER TABLE `empresa` ENABLE KEYS */;

-- Copiando estrutura para tabela secretaria_digital.galeria
CREATE TABLE IF NOT EXISTS `galeria` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idUsuario` int DEFAULT '0',
  `idCategoria` int DEFAULT NULL,
  `titulo` varchar(999) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `capa` varchar(999) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `status` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `galeria_usuarios` (`idUsuario`),
  KEY `galeria_categorias` (`idCategoria`),
  CONSTRAINT `galeria_categorias` FOREIGN KEY (`idCategoria`) REFERENCES `galeria_categorias` (`id`),
  CONSTRAINT `galeria_usuarios` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Copiando dados para a tabela secretaria_digital.galeria: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela secretaria_digital.galeria_categorias
CREATE TABLE IF NOT EXISTS `galeria_categorias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(999) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Copiando dados para a tabela secretaria_digital.galeria_categorias: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela secretaria_digital.galeria_imagens
CREATE TABLE IF NOT EXISTS `galeria_imagens` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idGaleria` int DEFAULT NULL,
  `imagem` varchar(999) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `galeria_images` (`idGaleria`),
  CONSTRAINT `galeria_images` FOREIGN KEY (`idGaleria`) REFERENCES `galeria` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Copiando dados para a tabela secretaria_digital.galeria_imagens: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela secretaria_digital.historico_escolar
CREATE TABLE IF NOT EXISTS `historico_escolar` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_aluno` int DEFAULT NULL,
  `turma` varchar(50) DEFAULT NULL,
  `estabelecimento` varchar(500) DEFAULT NULL,
  `municipio` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `uf` varchar(10) DEFAULT NULL,
  `ano` varchar(50) DEFAULT NULL,
  `observacao` varchar(1000) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela secretaria_digital.historico_escolar: 3 rows
/*!40000 ALTER TABLE `historico_escolar` DISABLE KEYS */;
INSERT INTO `historico_escolar` (`id`, `id_aluno`, `turma`, `estabelecimento`, `municipio`, `uf`, `ano`, `observacao`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 'teste teste', 'teste teste', 'teste teste', 'PE', '1975', 'teste teste', '2025-09-02 21:02:50', '2025-09-03 08:22:29', '2025-09-03 08:22:29'),
	(2, 1, 'teste', 'teste', 'teste', 'MT', '2025', 'testes', '2025-09-03 07:38:48', '2025-09-03 07:38:48', NULL),
	(3, 27, '3º ANO C', 'Dione Augusta', 'CUIABÁ', 'MT', '2003', 'Dependência de Matemática', '2025-09-03 19:41:17', '2025-09-03 19:41:17', NULL);
/*!40000 ALTER TABLE `historico_escolar` ENABLE KEYS */;

-- Copiando estrutura para tabela secretaria_digital.historico_escolar_notas
CREATE TABLE IF NOT EXISTS `historico_escolar_notas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_disciplina` int DEFAULT NULL,
  `id_historico` int DEFAULT NULL,
  `nota` varchar(10) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela secretaria_digital.historico_escolar_notas: 13 rows
/*!40000 ALTER TABLE `historico_escolar_notas` DISABLE KEYS */;
INSERT INTO `historico_escolar_notas` (`id`, `id_disciplina`, `id_historico`, `nota`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 2, '10', '2025-09-03 09:31:12', '2025-09-03 19:36:48', '2025-09-03 19:36:48'),
	(2, 3, 2, '10', '2025-09-03 19:17:05', '2025-09-03 19:17:05', NULL),
	(3, 4, 2, '7.5', '2025-09-03 19:24:12', '2025-09-03 19:24:12', NULL),
	(4, 5, 2, '6.5', '2025-09-03 19:24:20', '2025-09-03 19:24:20', NULL),
	(5, 7, 2, '8.7', '2025-09-03 19:24:46', '2025-09-03 19:24:46', NULL),
	(6, 6, 2, '9.5', '2025-09-03 19:25:04', '2025-09-03 19:36:21', NULL),
	(7, 1, 3, '7.5', '2025-09-03 19:41:34', '2025-09-03 19:41:34', NULL),
	(8, 3, 3, '7', '2025-09-03 19:41:38', '2025-09-03 19:41:38', NULL),
	(9, 4, 3, '7.9', '2025-09-03 19:41:54', '2025-09-03 19:41:54', NULL),
	(10, 5, 3, '8.5', '2025-09-03 19:42:02', '2025-09-03 19:42:02', NULL),
	(11, 6, 3, '7.52', '2025-09-03 19:42:09', '2025-09-03 19:42:09', NULL),
	(12, 7, 3, '9.5', '2025-09-03 19:42:20', '2025-09-03 19:42:20', NULL),
	(13, 9, 3, '7.6', '2025-09-03 19:42:25', '2025-09-03 19:42:25', NULL);
/*!40000 ALTER TABLE `historico_escolar_notas` ENABLE KEYS */;

-- Copiando estrutura para tabela secretaria_digital.noticias
CREATE TABLE IF NOT EXISTS `noticias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idCategoria` int DEFAULT NULL,
  `idUsuario` int DEFAULT NULL,
  `titulo` varchar(999) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `subtitulo` varchar(999) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `texto` mediumtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `capa` varchar(999) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `dataNoticia` date DEFAULT NULL,
  `status` int DEFAULT '0',
  `visualizacoes` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `noticia-categoria` (`idCategoria`),
  KEY `noticia-usuario` (`idUsuario`),
  CONSTRAINT `noticia-categoria` FOREIGN KEY (`idCategoria`) REFERENCES `noticias_categorias` (`id`),
  CONSTRAINT `noticia-usuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Copiando dados para a tabela secretaria_digital.noticias: ~3 rows (aproximadamente)
INSERT INTO `noticias` (`id`, `idCategoria`, `idUsuario`, `titulo`, `subtitulo`, `texto`, `capa`, `dataNoticia`, `status`, `visualizacoes`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(18, 10, 149, 'Notícia 1', 'Notícia 1', '<span style="color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed laoreet leo tellus, ac egestas lectus feugiat eu. Nulla eu efficitur urna. Vivamus at massa sit amet nisl tincidunt vulputate sit amet non velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nunc lacinia justo ipsum, ut varius leo suscipit a. Morbi et fringilla risus. Ut dictum venenatis purus commodo porta.</span>                          \r\n                        ', 'http://local.axons/uploads/img/1675459769.png', '2023-02-03', 1, NULL, '2023-02-03 17:29:33', '2023-02-03 17:29:33', NULL),
	(19, 10, 149, 'Notícia 2', 'Notícia 2', '<span style="color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed laoreet leo tellus, ac egestas lectus feugiat eu. Nulla eu efficitur urna. Vivamus at massa sit amet nisl tincidunt vulputate sit amet non velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nunc lacinia justo ipsum, ut varius leo suscipit a. Morbi et fringilla risus. Ut dictum venenatis purus commodo porta.</span>                          \r\n                        ', 'http://local.axons/uploads/img/1675459800.png', '2023-02-03', 1, NULL, '2023-02-03 17:30:02', '2023-02-03 17:30:02', NULL),
	(20, 10, 149, 'Notícia 3', 'Notícia 3', '<span style="color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed laoreet leo tellus, ac egestas lectus feugiat eu. Nulla eu efficitur urna. Vivamus at massa sit amet nisl tincidunt vulputate sit amet non velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nunc lacinia justo ipsum, ut varius leo suscipit a. Morbi et fringilla risus. Ut dictum venenatis purus commodo porta.</span>                          \r\n                        ', 'http://local.axons/uploads/img/1675459834.png', '2023-02-03', 1, NULL, '2023-02-03 17:30:38', '2023-02-03 17:30:38', NULL);

-- Copiando estrutura para tabela secretaria_digital.noticias_categorias
CREATE TABLE IF NOT EXISTS `noticias_categorias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(999) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Copiando dados para a tabela secretaria_digital.noticias_categorias: ~47 rows (aproximadamente)
INSERT INTO `noticias_categorias` (`id`, `titulo`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(10, 'Axons', '2023-02-03 17:27:17', '2023-02-03 17:28:11', NULL),
	(11, 'Teste', '2025-01-21 13:13:29', '2025-01-21 15:56:35', '2025-01-21 15:56:35'),
	(12, 'Teste 2', '2025-01-21 13:14:39', '2025-01-21 15:56:37', '2025-01-21 15:56:37'),
	(13, 'Teste 3', '2025-01-21 13:15:27', '2025-01-21 15:56:40', '2025-01-21 15:56:40'),
	(14, 'Teste 4', '2025-01-21 13:20:13', '2025-01-21 15:56:45', '2025-01-21 15:56:45'),
	(15, 'teste 5', '2025-01-21 13:31:00', '2025-01-21 15:56:42', '2025-01-21 15:56:42'),
	(16, 'teste 6', '2025-01-21 13:31:26', '2025-01-21 15:56:48', '2025-01-21 15:56:48'),
	(17, 'teste 6', '2025-01-21 13:31:29', '2025-01-21 15:56:50', '2025-01-21 15:56:50'),
	(18, 'teste 7', '2025-01-21 13:32:39', '2025-01-21 15:56:53', '2025-01-21 15:56:53'),
	(19, 'teste 7', '2025-01-21 13:34:27', '2025-01-21 15:56:32', '2025-01-21 15:56:32'),
	(20, 'teste 8', '2025-01-21 13:35:39', '2025-01-21 15:56:55', '2025-01-21 15:56:55'),
	(21, 'teste 8', '2025-01-21 13:35:43', '2025-01-21 15:56:57', '2025-01-21 15:56:57'),
	(22, 'teste 9', '2025-01-21 13:39:55', '2025-01-21 15:57:00', '2025-01-21 15:57:00'),
	(23, 'teste 10', '2025-01-21 13:41:34', '2025-01-21 15:57:02', '2025-01-21 15:57:02'),
	(24, 'teste 10', '2025-01-21 13:44:39', '2025-01-21 15:57:04', '2025-01-21 15:57:04'),
	(25, 'teste 10', '2025-01-21 13:48:15', '2025-01-21 15:57:06', '2025-01-21 15:57:06'),
	(26, 'Teste 11', '2025-01-21 13:48:38', '2025-01-21 15:57:09', '2025-01-21 15:57:09'),
	(27, 'teste 12', '2025-01-21 13:49:32', '2025-01-21 15:57:11', '2025-01-21 15:57:11'),
	(28, 'teste 13', '2025-01-21 13:50:18', '2025-01-21 15:57:13', '2025-01-21 15:57:13'),
	(29, 'Teste 14', '2025-01-21 14:15:16', '2025-01-21 15:57:15', '2025-01-21 15:57:15'),
	(30, 'Teste 14', '2025-01-21 14:33:54', '2025-01-21 15:57:17', '2025-01-21 15:57:17'),
	(31, 'Teste 15', '2025-01-21 14:35:15', '2025-01-21 15:57:20', '2025-01-21 15:57:20'),
	(32, 'Teste 16', '2025-01-21 14:38:06', '2025-01-21 15:57:22', '2025-01-21 15:57:22'),
	(33, 'teste 17', '2025-01-21 14:51:45', '2025-01-21 15:57:24', '2025-01-21 15:57:24'),
	(34, 'teste 18', '2025-01-21 14:53:03', '2025-01-21 15:57:26', '2025-01-21 15:57:26'),
	(35, 'teste 18', '2025-01-21 14:53:26', '2025-01-21 15:57:29', '2025-01-21 15:57:29'),
	(36, 'Teste 19', '2025-01-21 15:35:03', '2025-01-21 15:57:31', '2025-01-21 15:57:31'),
	(37, 'teste 20', '2025-01-21 15:43:50', '2025-01-21 15:57:33', '2025-01-21 15:57:33'),
	(38, 'teste 21', '2025-01-21 15:44:32', '2025-01-21 15:57:35', '2025-01-21 15:57:35'),
	(39, 'teste 22', '2025-01-21 15:47:52', '2025-01-21 15:57:37', '2025-01-21 15:57:37'),
	(40, 'teste 22', '2025-01-21 15:48:33', '2025-01-21 15:57:39', '2025-01-21 15:57:39'),
	(41, 'teste 23', '2025-01-21 15:48:45', '2025-01-21 15:57:41', '2025-01-21 15:57:41'),
	(42, 'teste 24', '2025-01-21 15:51:17', '2025-01-21 15:57:43', '2025-01-21 15:57:43'),
	(43, 'teste 22', '2025-01-21 15:51:46', '2025-01-21 15:56:29', '2025-01-21 15:56:29'),
	(44, 'teste 25', '2025-01-21 15:55:08', '2025-01-21 15:55:50', '2025-01-21 15:55:50'),
	(45, 'teste', '2025-01-21 15:58:03', '2025-01-21 15:58:03', NULL),
	(46, 'teste 1', '2025-01-21 15:58:54', '2025-01-21 15:58:54', NULL),
	(47, 'teste 2', '2025-01-21 15:59:31', '2025-01-21 15:59:31', NULL),
	(48, 'teste 3', '2025-01-21 16:01:55', '2025-01-21 16:01:55', NULL),
	(49, 'teste 4', '2025-01-21 16:02:30', '2025-01-21 16:02:30', NULL),
	(50, 'teste 5', '2025-01-21 16:04:40', '2025-01-21 16:04:40', NULL),
	(51, 'teste 6', '2025-01-21 16:06:59', '2025-01-21 16:06:59', NULL),
	(52, 'Teste 7', '2025-01-23 13:10:08', '2025-01-23 13:10:08', NULL),
	(53, 'Cestas', '2025-02-19 14:41:18', '2025-02-19 14:41:18', NULL),
	(54, 'Cestas dias das mulheres', '2025-02-19 14:44:05', '2025-02-19 14:44:05', NULL),
	(55, 'Cestas Namorados', '2025-02-19 15:13:17', '2025-02-19 15:13:17', NULL),
	(56, 'Cestas Namorados', '2025-02-19 15:14:00', '2025-02-19 15:14:00', NULL);

-- Copiando estrutura para tabela secretaria_digital.noticias_imagens
CREATE TABLE IF NOT EXISTS `noticias_imagens` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idNoticia` int DEFAULT NULL,
  `imagem` varchar(999) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `noticia_images` (`idNoticia`) USING BTREE,
  CONSTRAINT `noticia_images` FOREIGN KEY (`idNoticia`) REFERENCES `noticias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Copiando dados para a tabela secretaria_digital.noticias_imagens: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela secretaria_digital.pais
CREATE TABLE IF NOT EXISTS `pais` (
  `id` int NOT NULL AUTO_INCREMENT,
  `matricula` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `mae_nome` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mae_cpf` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mae_rg` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mae_nascimento` date DEFAULT NULL,
  `mae_estado_civil` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mae_telefone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mae_email` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mae_profissao` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mae_empresa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mae_naturalidade` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mae_nacionalidade` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mae_endereco` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mae_numero` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mae_complemento` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mae_bairro` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mae_cidade` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mae_estado` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mae_cep` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mae_resp_financeiro` int DEFAULT '0',
  `mae_resp_pedagogico` int DEFAULT '0',
  `pai_nome` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pai_cpf` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pai_rg` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pai_nascimento` date DEFAULT NULL,
  `pai_estado_civil` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pai_telefone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pai_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pai_profissao` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pai_empresa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pai_naturalidade` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pai_nacionalidade` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pai_endereco` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pai_numero` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pai_complemento` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pai_bairro` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pai_cidade` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pai_estado` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pai_cep` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pai_parentesco` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pai_resp_financeiro` int DEFAULT '0',
  `pai_resp_pedagogico` int DEFAULT '0',
  `resp_finan_nome` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resp_finan_parentesco` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resp_finan_cpf` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resp_finan_rg` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resp_finan_nascimento` date DEFAULT NULL,
  `resp_finan_estado_civil` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resp_finan_telefone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resp_finan_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resp_finan_profissao` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resp_finan_empresa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resp_finan_naturalidade` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resp_finan_nacionalidade` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resp_finan_endereco` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resp_finan_numero` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resp_finan_complemento` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resp_finan_bairro` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resp_finan_cidade` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resp_finan_estado` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resp_finan_cep` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=98 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela secretaria_digital.pais: 6 rows
/*!40000 ALTER TABLE `pais` DISABLE KEYS */;
INSERT INTO `pais` (`id`, `matricula`, `mae_nome`, `mae_cpf`, `mae_rg`, `mae_nascimento`, `mae_estado_civil`, `mae_telefone`, `mae_email`, `mae_profissao`, `mae_empresa`, `mae_naturalidade`, `mae_nacionalidade`, `mae_endereco`, `mae_numero`, `mae_complemento`, `mae_bairro`, `mae_cidade`, `mae_estado`, `mae_cep`, `mae_resp_financeiro`, `mae_resp_pedagogico`, `pai_nome`, `pai_cpf`, `pai_rg`, `pai_nascimento`, `pai_estado_civil`, `pai_telefone`, `pai_email`, `pai_profissao`, `pai_empresa`, `pai_naturalidade`, `pai_nacionalidade`, `pai_endereco`, `pai_numero`, `pai_complemento`, `pai_bairro`, `pai_cidade`, `pai_estado`, `pai_cep`, `pai_parentesco`, `pai_resp_financeiro`, `pai_resp_pedagogico`, `resp_finan_nome`, `resp_finan_parentesco`, `resp_finan_cpf`, `resp_finan_rg`, `resp_finan_nascimento`, `resp_finan_estado_civil`, `resp_finan_telefone`, `resp_finan_email`, `resp_finan_profissao`, `resp_finan_empresa`, `resp_finan_naturalidade`, `resp_finan_nacionalidade`, `resp_finan_endereco`, `resp_finan_numero`, `resp_finan_complemento`, `resp_finan_bairro`, `resp_finan_cidade`, `resp_finan_estado`, `resp_finan_cep`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(92, '20250001', 'Vivian Caroline Passos Rondon', '021.632.371-17', '1321321321321', '1986-06-14', 'Casado(a)', '(65) 98451-8769', 'viviancprondon@gmail.com', 'Nutricionista', 'Sabores da Terra', 'Cuiabana', 'Brasileira', 'Rua 6', '162', '', 'Parque das Nações', 'Cuiabá', 'MT', '78056-851', 1, 1, 'Lucas Rafael Muniz Rondon', '011.046.441-93', '21231321231', '1986-09-09', 'Casado(a)', '(65) 98451-8769', 'lucasrondon@gmail.com', 'Engenheiro de Software', 'Ministério Público do Estado de Mato Grosso', 'Cuiabano', 'Brasileiro', 'Rua 6', '162', '', 'Parque das Nações', 'Cuiabá', 'MT', '78056-851', NULL, 1, 0, '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2025-04-12 16:49:25', '2025-04-12 23:01:20', NULL),
	(93, '20250002', 'teste', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2025-04-12 16:50:42', '2025-04-12 16:50:50', '2025-04-12 16:50:50'),
	(94, '20250002', 'teste', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2025-04-12 22:48:40', '2025-04-12 22:48:45', '2025-04-12 22:48:45'),
	(95, '20250002', 'teste', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2025-04-12 22:49:28', '2025-04-12 22:49:34', '2025-04-12 22:49:34'),
	(96, '20250002', 'teste', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2025-04-12 23:00:58', '2025-04-12 23:01:07', '2025-04-12 23:01:07'),
	(97, '20250002', 'JOAQUIM RONDON', '', '', '0000-00-00', '', '65984518769', '', '', '', '', '', 'Rus', '6', '', '', 'Acorizal', 'MT', '78056851', 0, 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 0, 0, '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2025-04-21 18:51:38', '2025-04-21 18:51:38', NULL);
/*!40000 ALTER TABLE `pais` ENABLE KEYS */;

-- Copiando estrutura para tabela secretaria_digital.parametros
CREATE TABLE IF NOT EXISTS `parametros` (
  `id` int NOT NULL AUTO_INCREMENT,
  `chave` varchar(999) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `valor` varchar(999) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `observacao` varchar(999) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela secretaria_digital.parametros: 4 rows
/*!40000 ALTER TABLE `parametros` DISABLE KEYS */;
INSERT INTO `parametros` (`id`, `chave`, `valor`, `observacao`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'ANO_LETIVO', '2025', 'Configuração para ativar o ano letivo do sistema', '2025-04-17 19:19:24', '2025-05-27 08:25:39', NULL),
	(2, 'MEDIA_ESCOLAR', '6', 'Configuração da média escolar para cálculos de notas', '2025-04-17 19:20:12', '2025-04-17 19:20:14', NULL),
	(3, 'teste', 'teste', 'teste', '2025-05-27 09:04:07', '2025-05-27 09:05:35', '2025-05-27 09:05:35'),
	(4, 'testes', 'testes', 'testes', '2025-05-27 09:05:44', '2025-05-27 09:15:01', '2025-05-27 09:15:01');
/*!40000 ALTER TABLE `parametros` ENABLE KEYS */;

-- Copiando estrutura para tabela secretaria_digital.produtos
CREATE TABLE IF NOT EXISTS `produtos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idCategoria` int DEFAULT NULL,
  `idUsuario` int DEFAULT NULL,
  `titulo` varchar(999) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `subtitulo` varchar(999) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `texto` mediumtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `capa` varchar(999) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `dataCadastro` date DEFAULT NULL,
  `status` int DEFAULT '0',
  `visualizacoes` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `produtos-categoria` (`idCategoria`) USING BTREE,
  KEY `produtos-usuario` (`idUsuario`) USING BTREE,
  CONSTRAINT `produtos-categoria` FOREIGN KEY (`idCategoria`) REFERENCES `produtos_categorias` (`id`),
  CONSTRAINT `produtos-usuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Copiando dados para a tabela secretaria_digital.produtos: ~2 rows (aproximadamente)
INSERT INTO `produtos` (`id`, `idCategoria`, `idUsuario`, `titulo`, `subtitulo`, `texto`, `capa`, `dataCadastro`, `status`, `visualizacoes`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(25, 1, 149, 'Cesta Frescor da Manhã', 'Cesta Frescor da Manhã', 'Cesta Frescor da Manhã                          \r\n                        ', 'http://local.starcommerce/uploads/img/1739991231.png', '2025-02-19', 1, NULL, '2025-02-19 14:53:54', '2025-02-19 15:11:55', '2025-02-19 15:11:55'),
	(27, 6, 149, 'Cesta Amore Mio', 'Cesta Amore Mio', 'Cesta Amore Mio                          \r\n                        ', 'http://local.starcommerce/uploads/img/1739992542.png', '2025-02-19', 1, NULL, '2025-02-19 15:15:44', '2025-02-19 15:15:44', NULL);

-- Copiando estrutura para tabela secretaria_digital.produtos_categorias
CREATE TABLE IF NOT EXISTS `produtos_categorias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(999) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Copiando dados para a tabela secretaria_digital.produtos_categorias: ~6 rows (aproximadamente)
INSERT INTO `produtos_categorias` (`id`, `titulo`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Cestas de café da manhã', '2025-02-19 14:41:59', '2025-02-19 14:48:22', NULL),
	(2, 'Canecas personalizadas', '2025-02-19 14:42:32', '2025-02-19 14:48:31', NULL),
	(3, 'Presentes', '2025-02-19 14:43:36', '2025-02-19 14:48:52', '2025-02-19 14:48:52'),
	(4, 'Presentes', '2025-02-19 14:49:27', '2025-02-19 14:49:31', '2025-02-19 14:49:31'),
	(5, 'Cesta Frescor da Manhã', '2025-02-19 14:53:28', '2025-02-19 14:53:28', NULL),
	(6, 'Cestas Dia dos Namorados', '2025-02-19 15:15:26', '2025-02-19 15:15:26', NULL);

-- Copiando estrutura para tabela secretaria_digital.produtos_imagens
CREATE TABLE IF NOT EXISTS `produtos_imagens` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idProduto` int DEFAULT NULL,
  `imagem` varchar(999) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `produtos_images` (`idProduto`) USING BTREE,
  CONSTRAINT `produtos_images` FOREIGN KEY (`idProduto`) REFERENCES `produtos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Copiando dados para a tabela secretaria_digital.produtos_imagens: ~6 rows (aproximadamente)
INSERT INTO `produtos_imagens` (`id`, `idProduto`, `imagem`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(20, NULL, 'http://local.starcommerce/uploads/img/1739992669_f13227e971ab8f723eaa.jpg', '2025-02-19 15:17:49', '2025-02-19 15:17:49', NULL),
	(21, NULL, 'http://local.starcommerce/uploads/img/1739992669_619e33e44c2c6d0f5e40.jpg', '2025-02-19 15:17:49', '2025-02-19 15:17:49', NULL),
	(22, NULL, 'http://local.starcommerce/uploads/img/1739992669_d4f9e78bd7eb7a4dcaf2.jpg', '2025-02-19 15:17:49', '2025-02-19 15:17:49', NULL),
	(23, 27, 'http://local.starcommerce/uploads/img/1739992728_8bbd886611a21ac9d07c.jpg', '2025-02-19 15:18:48', '2025-02-19 15:18:48', NULL),
	(24, 27, 'http://local.starcommerce/uploads/img/1739992728_5cb3642dc411c54e42d2.jpg', '2025-02-19 15:18:48', '2025-02-19 15:18:48', NULL),
	(25, 27, 'http://local.starcommerce/uploads/img/1739992728_cd8d95d9e1d199341227.jpg', '2025-02-19 15:18:48', '2025-02-19 15:18:48', NULL);

-- Copiando estrutura para tabela secretaria_digital.servicos
CREATE TABLE IF NOT EXISTS `servicos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(999) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `subtitulo` varchar(999) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `texto` mediumtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `capa` varchar(999) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `status` int DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Copiando dados para a tabela secretaria_digital.servicos: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela secretaria_digital.turmas
CREATE TABLE IF NOT EXISTS `turmas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `periodo` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '1: Matutino, 2: Vespertino, 3: Noturno ',
  `grau` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '1: Educação Infantil, 2: Ensino Fundamentol, 3: Ensino Médio, 4: Ensino Superior',
  `ano_letivo` int DEFAULT NULL,
  `dias_letivos` int DEFAULT NULL,
  `carga_horaria` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela secretaria_digital.turmas: 9 rows
/*!40000 ALTER TABLE `turmas` DISABLE KEYS */;
INSERT INTO `turmas` (`id`, `nome`, `periodo`, `grau`, `ano_letivo`, `dias_letivos`, `carga_horaria`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, '1º ANO A', '1', '2', 2025, 57, 800, '2025-04-21 09:54:05', '2025-07-08 08:43:34', NULL),
	(2, '1º ANO B', '2', '1', 2025, 57, 800, '2025-04-21 09:54:52', '2025-07-09 19:50:12', NULL),
	(3, 'teste', '3', '1', 2025, NULL, NULL, '2025-04-21 10:07:29', '2025-04-21 10:07:44', '2025-04-21 10:07:44'),
	(4, '1º ANO C', '2', '1', 2025, NULL, NULL, '2025-04-21 10:27:27', '2025-04-21 10:27:27', NULL),
	(5, 'Teste', '1', '1', 2024, NULL, NULL, '2025-04-25 10:10:31', '2025-04-25 10:11:32', '2025-04-25 10:11:32'),
	(6, '1º ANO A', '1', '2', 2026, NULL, NULL, '2025-05-21 10:32:35', '2025-05-21 10:32:35', NULL),
	(7, '2º ANO A', '1', '1', 2025, NULL, NULL, '2025-06-25 20:52:04', '2025-06-25 20:52:04', NULL),
	(8, '2º ANO B', '2', '1', 2025, NULL, NULL, '2025-06-25 20:56:40', '2025-06-25 20:56:40', NULL),
	(9, 'teste', '1', '1', 2025, NULL, 800, '2025-07-08 08:19:42', '2025-07-08 08:19:42', NULL);
/*!40000 ALTER TABLE `turmas` ENABLE KEYS */;

-- Copiando estrutura para tabela secretaria_digital.turma_aluno
CREATE TABLE IF NOT EXISTS `turma_aluno` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_aluno` int NOT NULL,
  `id_turma` int NOT NULL,
  `ano_letivo` int NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_aluno` (`id_aluno`),
  KEY `FK_turma` (`id_turma`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela secretaria_digital.turma_aluno: 5 rows
/*!40000 ALTER TABLE `turma_aluno` DISABLE KEYS */;
INSERT INTO `turma_aluno` (`id`, `id_aluno`, `id_turma`, `ano_letivo`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(29, 2, 1, 2025, '2025-07-07 10:21:26', '2025-07-07 10:21:26', NULL),
	(30, 29, 1, 2025, '2025-07-07 10:22:51', '2025-07-07 10:22:51', NULL),
	(31, 1, 1, 2025, '2025-07-08 09:26:40', '2025-07-08 09:26:40', NULL),
	(33, 30, 2, 2025, '2025-07-09 19:50:27', '2025-07-09 19:50:27', NULL),
	(34, 32, 2, 2025, '2025-08-08 11:46:42', '2025-08-08 11:46:42', NULL);
/*!40000 ALTER TABLE `turma_aluno` ENABLE KEYS */;

-- Copiando estrutura para tabela secretaria_digital.turma_disciplina
CREATE TABLE IF NOT EXISTS `turma_disciplina` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_turma` int DEFAULT NULL,
  `id_disciplina` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__turmas` (`id_turma`),
  KEY `FK__disciplinas` (`id_disciplina`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela secretaria_digital.turma_disciplina: 6 rows
/*!40000 ALTER TABLE `turma_disciplina` DISABLE KEYS */;
INSERT INTO `turma_disciplina` (`id`, `id_turma`, `id_disciplina`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(31, 1, 1, '2025-07-07 10:23:09', '2025-07-07 10:23:09', NULL),
	(32, 1, 3, '2025-07-07 10:23:09', '2025-07-07 10:23:09', NULL),
	(33, 1, 4, '2025-07-07 10:23:09', '2025-07-07 10:23:09', NULL),
	(34, 1, 5, '2025-07-07 10:23:09', '2025-07-07 10:23:09', NULL),
	(35, 1, 6, '2025-07-07 10:23:09', '2025-07-07 10:23:09', NULL),
	(36, 1, 7, '2025-07-07 10:23:09', '2025-07-07 10:23:09', NULL);
/*!40000 ALTER TABLE `turma_disciplina` ENABLE KEYS */;

-- Copiando estrutura para tabela secretaria_digital.turma_disciplina_professor
CREATE TABLE IF NOT EXISTS `turma_disciplina_professor` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_turma` int NOT NULL DEFAULT '0',
  `id_disciplina` int DEFAULT NULL,
  `id_usuario` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__disciplinas` (`id_disciplina`),
  KEY `FK__turmas` (`id_turma`),
  KEY `FK__usuarios` (`id_usuario`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela secretaria_digital.turma_disciplina_professor: 6 rows
/*!40000 ALTER TABLE `turma_disciplina_professor` DISABLE KEYS */;
INSERT INTO `turma_disciplina_professor` (`id`, `id_turma`, `id_disciplina`, `id_usuario`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(44, 1, 1, 163, '2025-07-07 10:23:18', '2025-07-07 10:23:18', NULL),
	(45, 1, 3, 163, '2025-07-07 10:23:24', '2025-07-07 10:23:24', NULL),
	(46, 1, 4, 163, '2025-07-07 10:23:29', '2025-07-07 10:23:29', NULL),
	(47, 1, 5, 163, '2025-07-07 10:23:35', '2025-07-07 10:23:35', NULL),
	(48, 1, 6, 163, '2025-07-07 10:23:42', '2025-07-07 10:23:42', NULL),
	(49, 1, 7, 163, '2025-07-07 10:23:48', '2025-07-07 10:23:48', NULL);
/*!40000 ALTER TABLE `turma_disciplina_professor` ENABLE KEYS */;

-- Copiando estrutura para tabela secretaria_digital.turma_professor
CREATE TABLE IF NOT EXISTS `turma_professor` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_turma` int NOT NULL DEFAULT '0',
  `id_professor` int NOT NULL DEFAULT '0',
  `id_auxiliar` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__turmas` (`id_turma`),
  KEY `FK__usuarios` (`id_professor`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela secretaria_digital.turma_professor: 1 rows
/*!40000 ALTER TABLE `turma_professor` DISABLE KEYS */;
INSERT INTO `turma_professor` (`id`, `id_turma`, `id_professor`, `id_auxiliar`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(39, 2, 160, 162, '2025-07-29 07:49:00', '2025-07-29 07:49:00', NULL);
/*!40000 ALTER TABLE `turma_professor` ENABLE KEYS */;

-- Copiando estrutura para tabela secretaria_digital.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `login` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `senha` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `perfil` int DEFAULT NULL COMMENT '1-Administrador; 2-Secretária; 3-Professor',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=164 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Copiando dados para a tabela secretaria_digital.usuarios: ~10 rows (aproximadamente)
INSERT INTO `usuarios` (`id`, `nome`, `login`, `senha`, `perfil`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(149, 'Administrador', 'admin', '$2y$10$37aLjE0t8FBKXZD5E6amzuOsFjeV8RwflHI9NOpGDFCsCSFHCzcxK', 1, '2023-01-17 16:00:03', '2023-02-03 15:43:34', NULL),
	(155, 'testete', 'testeetes', '$2y$10$XlsJw7O0JJ/TgEkhoPfOcebPK4ie4WN1kqZDQi8vjSjeXmWfhJTX2', NULL, '2025-04-12 17:22:51', '2025-04-12 17:23:02', '2025-04-12 17:23:02'),
	(156, 'testeteste', 'testeteste', '$2y$10$kmEg4u3SEXOCnsmcZcYrXuxBauptrE0/rVxmbUxKhdjL4TqpH3a1C', NULL, '2025-04-17 18:49:07', '2025-04-17 18:49:26', '2025-04-17 18:49:26'),
	(157, 'teste', 'teste', '$2y$10$DIBZdimOanl2ajs99/VPzOiUUIs6X.p9lngDAG9n6tYj2151W.c2W', NULL, '2025-04-17 19:03:55', '2025-04-17 19:03:55', NULL),
	(158, 'testes', 'teste', '$2y$10$Rfg8Cm0KJ2wK/oqJotg3DeNPwl.BB1p4XiyJ4VRjsGHPdngYWx6YK', 3, '2025-04-17 19:06:29', '2025-04-17 19:06:29', NULL),
	(159, 'Letícia Teles', 'leticia.teles', '$2y$10$.2ySB1ObwkRy3uXqPgawO.whAAixy7c2rTkVVuk65o4WHm7Zz5lce', 3, '2025-05-01 18:22:59', '2025-05-01 18:22:59', NULL),
	(160, 'Abraão Fernandes', 'abraao.fernandes', '$2y$10$yHfjkm6d75NOQvbRA7K4QOgBhKH3MNl1J4RUxfpgPryryAU9/djoi', 3, '2025-05-01 18:23:33', '2025-08-12 09:29:50', NULL),
	(161, 'Camila Pitanga', 'camila.pitanga', '$2y$10$okTlHKZlVc.I6sERl6BNwer.t8oWv886hk1qJLRI1CbQ7ylCdcUIS', 3, '2025-05-01 18:23:51', '2025-05-01 18:23:51', NULL),
	(162, 'Mauricio Carvalho', 'mauricio.carvalho', '$2y$10$IZ3mkENZo9gnUjnf2vBaduclCZ7UrMkZIYIZmGT0t2GaDXo5yDXlG', 3, '2025-05-01 18:24:16', '2025-05-01 18:24:16', NULL),
	(163, 'Admin Professor', 'admin.professor', '$2y$10$1vogF0G2IP79UAAXu./sM.8jie1BQxMd3efweUE9Q2VlyeUj.KW4.', 3, '2025-07-04 09:05:39', '2025-07-04 09:05:39', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
