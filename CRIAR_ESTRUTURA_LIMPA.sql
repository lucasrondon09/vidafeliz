-- ========================================================================
-- SCRIPT: Criar Estrutura Limpa do Histórico Escolar
-- ========================================================================
-- Descrição: Cria apenas a tabela historico_escolar_periodo que está faltando
--            e ajusta a estrutura de historico_escolar_notas
-- Versão: 4.0 (Estrutura limpa - sem migração de dados)
-- Data: 2025-11-10
-- ========================================================================

-- ========================================================================
-- PASSO 1: CRIAR TABELA historico_escolar_periodo
-- ========================================================================

-- Verificar se já existe
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

SELECT 'Tabela historico_escolar_periodo criada com sucesso!' AS status;

-- ========================================================================
-- PASSO 2: AJUSTAR TABELA historico_escolar_notas
-- ========================================================================

-- Verificar se as colunas já existem antes de adicionar
SET @col_exists = (
  SELECT COUNT(*) 
  FROM information_schema.COLUMNS 
  WHERE TABLE_SCHEMA = DATABASE() 
    AND TABLE_NAME = 'historico_escolar_notas' 
    AND COLUMN_NAME = 'id_periodo'
);

-- Adicionar id_periodo se não existir
SET @sql = IF(@col_exists = 0,
  'ALTER TABLE `historico_escolar_notas` ADD COLUMN `id_periodo` INT NOT NULL COMMENT ''Referência ao período letivo'' AFTER `id`',
  'SELECT ''Coluna id_periodo já existe'' AS info'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Verificar se id_historico existe para renomear
SET @col_historico = (
  SELECT COUNT(*) 
  FROM information_schema.COLUMNS 
  WHERE TABLE_SCHEMA = DATABASE() 
    AND TABLE_NAME = 'historico_escolar_notas' 
    AND COLUMN_NAME = 'id_historico'
);

-- Remover id_historico se existir (não é mais necessário)
SET @sql = IF(@col_historico > 0,
  'ALTER TABLE `historico_escolar_notas` DROP COLUMN `id_historico`',
  'SELECT ''Coluna id_historico não existe'' AS info'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Verificar se id_disciplina existe para renomear
SET @col_disciplina = (
  SELECT COUNT(*) 
  FROM information_schema.COLUMNS 
  WHERE TABLE_SCHEMA = DATABASE() 
    AND TABLE_NAME = 'historico_escolar_notas' 
    AND COLUMN_NAME = 'id_disciplina'
);

-- Renomear id_disciplina para id_historico_disciplina se necessário
SET @sql = IF(@col_disciplina > 0,
  'ALTER TABLE `historico_escolar_notas` CHANGE COLUMN `id_disciplina` `id_historico_disciplina` INT NOT NULL COMMENT ''Referência à disciplina do histórico''',
  'SELECT ''Coluna id_disciplina não existe ou já foi renomeada'' AS info'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Verificar se resultado já existe
SET @col_resultado = (
  SELECT COUNT(*) 
  FROM information_schema.COLUMNS 
  WHERE TABLE_SCHEMA = DATABASE() 
    AND TABLE_NAME = 'historico_escolar_notas' 
    AND COLUMN_NAME = 'resultado'
);

-- Adicionar resultado se não existir
SET @sql = IF(@col_resultado = 0,
  'ALTER TABLE `historico_escolar_notas` ADD COLUMN `resultado` ENUM(''aprovado'', ''reprovado'', ''dependencia'', ''dispensado'') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT ''aprovado'' COMMENT ''Resultado na disciplina'' AFTER `nota`',
  'SELECT ''Coluna resultado já existe'' AS info'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Verificar se faltas já existe
SET @col_faltas = (
  SELECT COUNT(*) 
  FROM information_schema.COLUMNS 
  WHERE TABLE_SCHEMA = DATABASE() 
    AND TABLE_NAME = 'historico_escolar_notas' 
    AND COLUMN_NAME = 'faltas'
);

-- Adicionar faltas se não existir
SET @sql = IF(@col_faltas = 0,
  'ALTER TABLE `historico_escolar_notas` ADD COLUMN `faltas` INT DEFAULT 0 COMMENT ''Número de faltas'' AFTER `resultado`',
  'SELECT ''Coluna faltas já existe'' AS info'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Adicionar índices se não existirem
ALTER TABLE `historico_escolar_notas`
ADD KEY IF NOT EXISTS `idx_periodo` (`id_periodo`),
ADD KEY IF NOT EXISTS `idx_disciplina` (`id_historico_disciplina`);

-- Atualizar comentário da tabela
ALTER TABLE `historico_escolar_notas` 
COMMENT='Disciplinas e notas de cada período do histórico';

SELECT 'Tabela historico_escolar_notas ajustada com sucesso!' AS status;

-- ========================================================================
-- PASSO 3: LIMPAR TABELAS TEMPORÁRIAS E BACKUPS (OPCIONAL)
-- ========================================================================

-- Remover tabelas temporárias se existirem
DROP TABLE IF EXISTS `historico_escolar_periodo_temp`;

-- OPCIONAL: Remover backups (descomente se quiser limpar)
-- DROP TABLE IF EXISTS `historico_escolar_backup`;
-- DROP TABLE IF EXISTS `historico_escolar_notas_backup`;

SELECT 'Limpeza concluída!' AS status;

-- ========================================================================
-- PASSO 4: VERIFICAÇÃO FINAL
-- ========================================================================

SELECT '========== ESTRUTURA FINAL ==========' AS '';

-- Ver todas as tabelas do histórico
SELECT 
  TABLE_NAME AS tabela,
  TABLE_COMMENT AS descricao
FROM information_schema.TABLES
WHERE TABLE_SCHEMA = DATABASE()
  AND TABLE_NAME LIKE 'historico%'
  AND TABLE_NAME NOT LIKE '%backup%'
ORDER BY TABLE_NAME;

-- Ver estrutura de historico_escolar
SELECT '--- Estrutura: historico_escolar ---' AS '';
SELECT 
  COLUMN_NAME AS coluna,
  COLUMN_TYPE AS tipo,
  COLUMN_COMMENT AS descricao
FROM information_schema.COLUMNS
WHERE TABLE_SCHEMA = DATABASE()
  AND TABLE_NAME = 'historico_escolar'
ORDER BY ORDINAL_POSITION;

-- Ver estrutura de historico_escolar_periodo
SELECT '--- Estrutura: historico_escolar_periodo ---' AS '';
SELECT 
  COLUMN_NAME AS coluna,
  COLUMN_TYPE AS tipo,
  COLUMN_COMMENT AS descricao
FROM information_schema.COLUMNS
WHERE TABLE_SCHEMA = DATABASE()
  AND TABLE_NAME = 'historico_escolar_periodo'
ORDER BY ORDINAL_POSITION;

-- Ver estrutura de historico_escolar_notas
SELECT '--- Estrutura: historico_escolar_notas ---' AS '';
SELECT 
  COLUMN_NAME AS coluna,
  COLUMN_TYPE AS tipo,
  COLUMN_COMMENT AS descricao
FROM information_schema.COLUMNS
WHERE TABLE_SCHEMA = DATABASE()
  AND TABLE_NAME = 'historico_escolar_notas'
ORDER BY ORDINAL_POSITION;

-- Ver estrutura de historico_disciplinas
SELECT '--- Estrutura: historico_disciplinas ---' AS '';
SELECT 
  COLUMN_NAME AS coluna,
  COLUMN_TYPE AS tipo,
  COLUMN_COMMENT AS descricao
FROM information_schema.COLUMNS
WHERE TABLE_SCHEMA = DATABASE()
  AND TABLE_NAME = 'historico_disciplinas'
ORDER BY ORDINAL_POSITION;

SELECT '========== ESTRUTURA CRIADA COM SUCESSO! ==========' AS '';
SELECT 'Você pode agora começar a cadastrar históricos escolares!' AS '';

-- ========================================================================
-- ESTRUTURA CONCLUÍDA!
-- ========================================================================
-- Tabelas criadas:
-- 1. historico_escolar (histórico principal do aluno)
-- 2. historico_escolar_periodo (períodos/anos letivos)
-- 3. historico_escolar_notas (disciplinas e notas por período)
-- 4. historico_disciplinas (cadastro de disciplinas)
--
-- Relacionamentos:
-- alunos → historico_escolar → historico_escolar_periodo → historico_escolar_notas
--                                                              ↓
--                                                    historico_disciplinas
-- ========================================================================
