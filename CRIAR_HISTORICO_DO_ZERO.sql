-- ========================================================================
-- SCRIPT: Criar Estrutura do Histórico Escolar do Zero
-- ========================================================================
-- Descrição: Cria as 3 tabelas necessárias para o módulo de histórico escolar
-- Versão: 1.0 (Do zero - sem migração)
-- Data: 2025-11-10
-- ========================================================================
-- NOTA: A tabela historico_disciplinas já existe e está funcionando
-- ========================================================================

-- ========================================================================
-- TABELA 1: historico_escolar (Histórico Principal)
-- ========================================================================

DROP TABLE IF EXISTS `historico_escolar`;

CREATE TABLE `historico_escolar` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_aluno` INT NOT NULL COMMENT 'Aluno dono do histórico',
  `data_inicio` DATE NULL COMMENT 'Data de início da vida escolar',
  `situacao` ENUM('ativo', 'concluido', 'transferido', 'cancelado') 
    CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci
    DEFAULT 'ativo' COMMENT 'Status atual do histórico',
  `observacao_geral` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL COMMENT 'Observações gerais do histórico',
  `created_at` DATETIME NULL DEFAULT NULL,
  `updated_at` DATETIME NULL DEFAULT NULL,
  `deleted_at` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_aluno` (`id_aluno`),
  KEY `idx_situacao` (`situacao`),
  KEY `idx_deleted` (`deleted_at`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci
COMMENT='Histórico escolar principal de cada aluno';

-- ========================================================================
-- TABELA 2: historico_escolar_periodo (Períodos Letivos)
-- ========================================================================

DROP TABLE IF EXISTS `historico_escolar_periodo`;

CREATE TABLE `historico_escolar_periodo` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_historico` INT NOT NULL COMMENT 'Referência ao histórico principal',
  `estabelecimento` VARCHAR(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Nome da instituição',
  `municipio` VARCHAR(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Cidade',
  `uf` VARCHAR(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Estado (sigla)',
  `turma` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Série/Turma cursada',
  `ano_letivo` VARCHAR(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Ano letivo (ex: 2023)',
  `resultado` ENUM('aprovado', 'reprovado', 'cursando', 'transferido') 
    CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci
    DEFAULT 'cursando' COMMENT 'Resultado do período',
  `carga_horaria_total` INT NULL COMMENT 'Carga horária total do período',
  `frequencia` DECIMAL(5,2) NULL COMMENT 'Percentual de frequência',
  `observacao` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL COMMENT 'Observações específicas do período',
  `ordem` INT DEFAULT 0 COMMENT 'Ordem cronológica dos períodos',
  `created_at` DATETIME NULL DEFAULT NULL,
  `updated_at` DATETIME NULL DEFAULT NULL,
  `deleted_at` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_historico` (`id_historico`),
  KEY `idx_ano_letivo` (`ano_letivo`),
  KEY `idx_ordem` (`ordem`),
  KEY `idx_deleted` (`deleted_at`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci
COMMENT='Períodos/anos letivos do histórico escolar';

-- ========================================================================
-- TABELA 3: historico_escolar_notas (Disciplinas e Notas)
-- ========================================================================

DROP TABLE IF EXISTS `historico_escolar_notas`;

CREATE TABLE `historico_escolar_notas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_periodo` INT NOT NULL COMMENT 'Referência ao período letivo',
  `id_historico_disciplina` INT NOT NULL COMMENT 'Referência à disciplina',
  `nota` VARCHAR(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL COMMENT 'Nota obtida',
  `resultado` ENUM('aprovado', 'reprovado', 'dependencia', 'dispensado') 
    CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci
    DEFAULT 'aprovado' COMMENT 'Resultado na disciplina',
  `faltas` INT DEFAULT 0 COMMENT 'Número de faltas',
  `observacao` VARCHAR(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL COMMENT 'Observações',
  `created_at` DATETIME NULL DEFAULT NULL,
  `updated_at` DATETIME NULL DEFAULT NULL,
  `deleted_at` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_periodo` (`id_periodo`),
  KEY `idx_disciplina` (`id_historico_disciplina`),
  KEY `idx_deleted` (`deleted_at`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci
COMMENT='Disciplinas e notas de cada período do histórico';

-- ========================================================================
-- VERIFICAÇÃO FINAL
-- ========================================================================

SELECT '========================================' AS '';
SELECT 'ESTRUTURA CRIADA COM SUCESSO!' AS '';
SELECT '========================================' AS '';

-- Listar todas as tabelas do histórico
SELECT 
  TABLE_NAME AS tabela,
  TABLE_ROWS AS registros,
  TABLE_COMMENT AS descricao
FROM information_schema.TABLES
WHERE TABLE_SCHEMA = DATABASE()
  AND TABLE_NAME LIKE 'historico%'
ORDER BY TABLE_NAME;

SELECT '========================================' AS '';
SELECT 'Próximo passo: Criar Models e Controllers' AS '';
SELECT '========================================' AS '';

-- ========================================================================
-- ESTRUTURA CONCLUÍDA!
-- ========================================================================
-- Tabelas criadas:
-- 
-- 1. historico_escolar
--    - Histórico principal do aluno
--    - 1 registro por aluno
--
-- 2. historico_escolar_periodo
--    - Períodos/anos letivos
--    - Múltiplos registros por histórico
--
-- 3. historico_escolar_notas
--    - Disciplinas e notas
--    - Múltiplos registros por período
--
-- 4. historico_disciplinas (já existe)
--    - Cadastro de disciplinas
--
-- Relacionamentos:
-- alunos → historico_escolar → historico_escolar_periodo → historico_escolar_notas
--                                                              ↓
--                                                    historico_disciplinas
-- ========================================================================
