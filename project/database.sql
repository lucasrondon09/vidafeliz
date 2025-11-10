-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.3.0 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.5.0.6677
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Copiando estrutura para tabela startcommerce.banners
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

-- Copiando dados para a tabela startcommerce.banners: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela startcommerce.empresa
CREATE TABLE IF NOT EXISTS `empresa` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `endereco` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `uf` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cidade` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cep` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telefone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `site` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela startcommerce.empresa: 1 rows
/*!40000 ALTER TABLE `empresa` DISABLE KEYS */;
INSERT INTO `empresa` (`id`, `nome`, `endereco`, `uf`, `cidade`, `cep`, `telefone`, `email`, `site`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'VG Loja Virtual', 'Rua Acácia Amarela, num. 162', 'MT', 'Várzea Grande', '78058-000', '(65)9999-6565', 'cuiabalojavirtual@email.com.br', 'cuiabalojavirtual.com.br', '2025-01-22 15:19:22', '2025-01-22 15:33:23', NULL);
/*!40000 ALTER TABLE `empresa` ENABLE KEYS */;

-- Copiando estrutura para tabela startcommerce.galeria
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

-- Copiando dados para a tabela startcommerce.galeria: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela startcommerce.galeria_categorias
CREATE TABLE IF NOT EXISTS `galeria_categorias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(999) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Copiando dados para a tabela startcommerce.galeria_categorias: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela startcommerce.galeria_imagens
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

-- Copiando dados para a tabela startcommerce.galeria_imagens: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela startcommerce.noticias
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

-- Copiando dados para a tabela startcommerce.noticias: ~3 rows (aproximadamente)
INSERT INTO `noticias` (`id`, `idCategoria`, `idUsuario`, `titulo`, `subtitulo`, `texto`, `capa`, `dataNoticia`, `status`, `visualizacoes`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(18, 10, 149, 'Notícia 1', 'Notícia 1', '<span style="color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed laoreet leo tellus, ac egestas lectus feugiat eu. Nulla eu efficitur urna. Vivamus at massa sit amet nisl tincidunt vulputate sit amet non velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nunc lacinia justo ipsum, ut varius leo suscipit a. Morbi et fringilla risus. Ut dictum venenatis purus commodo porta.</span>                          \r\n                        ', 'http://local.axons/uploads/img/1675459769.png', '2023-02-03', 1, NULL, '2023-02-03 17:29:33', '2023-02-03 17:29:33', NULL),
	(19, 10, 149, 'Notícia 2', 'Notícia 2', '<span style="color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed laoreet leo tellus, ac egestas lectus feugiat eu. Nulla eu efficitur urna. Vivamus at massa sit amet nisl tincidunt vulputate sit amet non velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nunc lacinia justo ipsum, ut varius leo suscipit a. Morbi et fringilla risus. Ut dictum venenatis purus commodo porta.</span>                          \r\n                        ', 'http://local.axons/uploads/img/1675459800.png', '2023-02-03', 1, NULL, '2023-02-03 17:30:02', '2023-02-03 17:30:02', NULL),
	(20, 10, 149, 'Notícia 3', 'Notícia 3', '<span style="color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed laoreet leo tellus, ac egestas lectus feugiat eu. Nulla eu efficitur urna. Vivamus at massa sit amet nisl tincidunt vulputate sit amet non velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nunc lacinia justo ipsum, ut varius leo suscipit a. Morbi et fringilla risus. Ut dictum venenatis purus commodo porta.</span>                          \r\n                        ', 'http://local.axons/uploads/img/1675459834.png', '2023-02-03', 1, NULL, '2023-02-03 17:30:38', '2023-02-03 17:30:38', NULL);

-- Copiando estrutura para tabela startcommerce.noticias_categorias
CREATE TABLE IF NOT EXISTS `noticias_categorias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(999) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Copiando dados para a tabela startcommerce.noticias_categorias: ~47 rows (aproximadamente)
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

-- Copiando estrutura para tabela startcommerce.noticias_imagens
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

-- Copiando dados para a tabela startcommerce.noticias_imagens: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela startcommerce.produtos
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

-- Copiando dados para a tabela startcommerce.produtos: ~2 rows (aproximadamente)
INSERT INTO `produtos` (`id`, `idCategoria`, `idUsuario`, `titulo`, `subtitulo`, `texto`, `capa`, `dataCadastro`, `status`, `visualizacoes`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(25, 1, 149, 'Cesta Frescor da Manhã', 'Cesta Frescor da Manhã', 'Cesta Frescor da Manhã                          \r\n                        ', 'http://local.starcommerce/uploads/img/1739991231.png', '2025-02-19', 1, NULL, '2025-02-19 14:53:54', '2025-02-19 15:11:55', '2025-02-19 15:11:55'),
	(27, 6, 149, 'Cesta Amore Mio', 'Cesta Amore Mio', 'Cesta Amore Mio                          \r\n                        ', 'http://local.starcommerce/uploads/img/1739992542.png', '2025-02-19', 1, NULL, '2025-02-19 15:15:44', '2025-02-19 15:15:44', NULL);

-- Copiando estrutura para tabela startcommerce.produtos_categorias
CREATE TABLE IF NOT EXISTS `produtos_categorias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(999) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Copiando dados para a tabela startcommerce.produtos_categorias: ~6 rows (aproximadamente)
INSERT INTO `produtos_categorias` (`id`, `titulo`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Cestas de café da manhã', '2025-02-19 14:41:59', '2025-02-19 14:48:22', NULL),
	(2, 'Canecas personalizadas', '2025-02-19 14:42:32', '2025-02-19 14:48:31', NULL),
	(3, 'Presentes', '2025-02-19 14:43:36', '2025-02-19 14:48:52', '2025-02-19 14:48:52'),
	(4, 'Presentes', '2025-02-19 14:49:27', '2025-02-19 14:49:31', '2025-02-19 14:49:31'),
	(5, 'Cesta Frescor da Manhã', '2025-02-19 14:53:28', '2025-02-19 14:53:28', NULL),
	(6, 'Cestas Dia dos Namorados', '2025-02-19 15:15:26', '2025-02-19 15:15:26', NULL);

-- Copiando estrutura para tabela startcommerce.produtos_imagens
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

-- Copiando dados para a tabela startcommerce.produtos_imagens: ~6 rows (aproximadamente)
INSERT INTO `produtos_imagens` (`id`, `idProduto`, `imagem`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(20, NULL, 'http://local.starcommerce/uploads/img/1739992669_f13227e971ab8f723eaa.jpg', '2025-02-19 15:17:49', '2025-02-19 15:17:49', NULL),
	(21, NULL, 'http://local.starcommerce/uploads/img/1739992669_619e33e44c2c6d0f5e40.jpg', '2025-02-19 15:17:49', '2025-02-19 15:17:49', NULL),
	(22, NULL, 'http://local.starcommerce/uploads/img/1739992669_d4f9e78bd7eb7a4dcaf2.jpg', '2025-02-19 15:17:49', '2025-02-19 15:17:49', NULL),
	(23, 27, 'http://local.starcommerce/uploads/img/1739992728_8bbd886611a21ac9d07c.jpg', '2025-02-19 15:18:48', '2025-02-19 15:18:48', NULL),
	(24, 27, 'http://local.starcommerce/uploads/img/1739992728_5cb3642dc411c54e42d2.jpg', '2025-02-19 15:18:48', '2025-02-19 15:18:48', NULL),
	(25, 27, 'http://local.starcommerce/uploads/img/1739992728_cd8d95d9e1d199341227.jpg', '2025-02-19 15:18:48', '2025-02-19 15:18:48', NULL);

-- Copiando estrutura para tabela startcommerce.servicos
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

-- Copiando dados para a tabela startcommerce.servicos: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela startcommerce.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `login` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `senha` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=155 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Copiando dados para a tabela startcommerce.usuarios: ~1 rows (aproximadamente)
INSERT INTO `usuarios` (`id`, `nome`, `login`, `senha`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(149, 'Administrador', 'admin', '$2y$10$37aLjE0t8FBKXZD5E6amzuOsFjeV8RwflHI9NOpGDFCsCSFHCzcxK', '2023-01-17 16:00:03', '2023-02-03 15:43:34', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
