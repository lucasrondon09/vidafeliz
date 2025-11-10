-- ========================================================================
-- Script SQL: Criação da Tabela de Disciplinas do Histórico Escolar
-- ========================================================================
-- Descrição: Tabela específica para gerenciar disciplinas utilizadas
--            exclusivamente no módulo de Histórico Escolar, separada
--            das disciplinas do sistema de lançamento de notas.
-- ========================================================================

-- Criar tabela de disciplinas do histórico escolar
CREATE TABLE IF NOT EXISTS `historico_disciplinas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Nome da disciplina',
  `carga_horaria` int DEFAULT NULL COMMENT 'Carga horária em horas',
  `observacao` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Observações adicionais sobre a disciplina',
  `ativo` tinyint(1) DEFAULT 1 COMMENT 'Status: 1=Ativo, 0=Inativo',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_ativo` (`ativo`),
  KEY `idx_deleted_at` (`deleted_at`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci 
COMMENT='Disciplinas específicas para o módulo de Histórico Escolar';

-- Inserir disciplinas padrão do currículo brasileiro
INSERT INTO `historico_disciplinas` (`descricao`, `carga_horaria`, `observacao`, `ativo`, `created_at`) VALUES
('Língua Portuguesa', 160, 'Disciplina obrigatória do currículo nacional', 1, NOW()),
('Matemática', 160, 'Disciplina obrigatória do currículo nacional', 1, NOW()),
('História', 120, 'Disciplina obrigatória do currículo nacional', 1, NOW()),
('Geografia', 120, 'Disciplina obrigatória do currículo nacional', 1, NOW()),
('Ciências', 120, 'Disciplina obrigatória do currículo nacional', 1, NOW()),
('Artes', 80, 'Disciplina obrigatória do currículo nacional', 1, NOW()),
('Educação Física', 80, 'Disciplina obrigatória do currículo nacional', 1, NOW()),
('Ensino Religioso', 60, 'Disciplina de matrícula facultativa', 1, NOW()),
('Língua Inglesa', 80, 'Disciplina obrigatória a partir do 6º ano', 1, NOW()),
('Filosofia', 60, 'Disciplina do ensino médio', 1, NOW()),
('Sociologia', 60, 'Disciplina do ensino médio', 1, NOW()),
('Física', 80, 'Disciplina do ensino médio', 1, NOW()),
('Química', 80, 'Disciplina do ensino médio', 1, NOW()),
('Biologia', 80, 'Disciplina do ensino médio', 1, NOW()),
('Literatura', 60, 'Disciplina do ensino médio', 1, NOW());

-- ========================================================================
-- Atualizar tabela historico_escolar_notas para referenciar nova tabela
-- ========================================================================
-- IMPORTANTE: Este comando deve ser executado APÓS migrar os dados existentes
-- Comentado por segurança - executar manualmente após validação

-- ALTER TABLE `historico_escolar_notas` 
-- CHANGE COLUMN `id_disciplina` `id_historico_disciplina` int DEFAULT NULL 
-- COMMENT 'Referência para historico_disciplinas';

-- ========================================================================
-- Script de Migração de Dados (OPCIONAL)
-- ========================================================================
-- Caso queira migrar disciplinas existentes da tabela 'disciplinas' 
-- para 'historico_disciplinas', execute o script abaixo:

-- INSERT INTO `historico_disciplinas` (`descricao`, `carga_horaria`, `ativo`, `created_at`)
-- SELECT `descricao`, `carga_horaria`, 1, NOW()
-- FROM `disciplinas`
-- WHERE `deleted_at` IS NULL;

-- ========================================================================
-- Verificação
-- ========================================================================
-- Consultar disciplinas criadas
-- SELECT * FROM historico_disciplinas WHERE deleted_at IS NULL ORDER BY descricao;
