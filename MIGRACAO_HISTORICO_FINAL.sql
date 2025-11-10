-- ========================================================================
-- SCRIPT DE MIGRAÇÃO FINAL: Reestruturação do Histórico Escolar
-- ========================================================================
-- Versão: 3.0 (Corrigido com base na estrutura real do banco)
-- Data: 2025-11-10
-- ========================================================================
-- ATENÇÃO: Execute o ROLLBACK_MIGRACAO.sql primeiro se houver migração parcial!
-- ========================================================================

-- ========================================================================
-- PASSO 1: VERIFICAR SE JÁ EXISTE MIGRAÇÃO PARCIAL
-- ========================================================================

-- Se existir historico_escolar com estrutura nova, significa que já foi migrado parcialmente
-- Neste caso, execute ROLLBACK_MIGRACAO.sql primeiro!

SELECT 
  CASE 
    WHEN EXISTS (
      SELECT 1 FROM information_schema.COLUMNS 
      WHERE TABLE_SCHEMA = DATABASE() 
        AND TABLE_NAME = 'historico_escolar' 
        AND COLUMN_NAME = 'id_aluno'
    ) THEN 'ATENÇÃO: Migração já iniciada! Execute ROLLBACK primeiro!'
    ELSE 'OK: Pode prosseguir com a migração'
  END AS status_verificacao;

-- ========================================================================
-- PASSO 2: BACKUP DA ESTRUTURA ATUAL
-- ========================================================================

-- Criar backup da tabela historico_escolar (estrutura antiga)
DROP TABLE IF EXISTS `historico_escolar_backup`;
CREATE TABLE `historico_escolar_backup` AS SELECT * FROM `historico_escolar`;

-- Criar backup da tabela historico_escolar_notas
DROP TABLE IF EXISTS `historico_escolar_notas_backup`;
CREATE TABLE `historico_escolar_notas_backup` AS SELECT * FROM `historico_escolar_notas`;

-- Verificar backups
SELECT 
  'Backup criado' AS status,
  (SELECT COUNT(*) FROM historico_escolar_backup) AS total_historico_backup,
  (SELECT COUNT(*) FROM historico_escolar_notas_backup) AS total_notas_backup;

-- ========================================================================
-- PASSO 3: RENOMEAR TABELA ATUAL
-- ========================================================================

-- Renomear historico_escolar para historico_escolar_periodo_temp
RENAME TABLE `historico_escolar` TO `historico_escolar_periodo_temp`;

SELECT 'Tabela renomeada para historico_escolar_periodo_temp' AS status;

-- ========================================================================
-- PASSO 4: CRIAR NOVA TABELA historico_escolar (Histórico Principal)
-- ========================================================================

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

SELECT 'Tabela historico_escolar criada' AS status;

-- ========================================================================
-- PASSO 5: CRIAR NOVA TABELA historico_escolar_periodo
-- ========================================================================

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

SELECT 'Tabela historico_escolar_periodo criada' AS status;

-- ========================================================================
-- PASSO 6: MIGRAR DADOS - Criar Históricos Principais
-- ========================================================================

-- Inserir um registro de histórico para cada aluno que possui períodos
INSERT INTO `historico_escolar` (`id_aluno`, `data_inicio`, `situacao`, `created_at`, `updated_at`)
SELECT 
  `id_aluno`,
  STR_TO_DATE(CONCAT(MIN(`ano`), '-01-01'), '%Y-%m-%d') AS data_inicio,
  'ativo' AS situacao,
  MIN(`created_at`) AS created_at,
  NOW() AS updated_at
FROM `historico_escolar_periodo_temp`
WHERE `deleted_at` IS NULL
GROUP BY `id_aluno`;

SELECT CONCAT('Criados ', COUNT(*), ' históricos principais') AS status FROM historico_escolar;

-- ========================================================================
-- PASSO 7: MIGRAR DADOS - Períodos Letivos
-- ========================================================================

-- Inserir períodos vinculando ao histórico principal
INSERT INTO `historico_escolar_periodo` (
  `id_historico`,
  `estabelecimento`,
  `municipio`,
  `uf`,
  `turma`,
  `ano_letivo`,
  `resultado`,
  `observacao`,
  `ordem`,
  `created_at`,
  `updated_at`,
  `deleted_at`
)
SELECT 
  h.id AS id_historico,
  COALESCE(p.estabelecimento, '') AS estabelecimento,
  COALESCE(p.municipio, '') AS municipio,
  COALESCE(p.uf, '') AS uf,
  COALESCE(p.turma, '') AS turma,
  COALESCE(p.ano, '') AS ano_letivo,
  'cursando' AS resultado,
  p.observacao,
  0 AS ordem,
  p.created_at,
  p.updated_at,
  p.deleted_at
FROM `historico_escolar_periodo_temp` p
INNER JOIN `historico_escolar` h ON h.id_aluno = p.id_aluno
ORDER BY p.id_aluno, p.ano;

SELECT CONCAT('Migrados ', COUNT(*), ' períodos letivos') AS status FROM historico_escolar_periodo;

-- ========================================================================
-- PASSO 8: ATUALIZAR ORDEM DOS PERÍODOS
-- ========================================================================

-- Criar tabela temporária com ordem calculada
CREATE TEMPORARY TABLE temp_ordem AS
SELECT 
  p.id,
  @row_num := IF(@prev_historico = p.id_historico, @row_num + 1, 1) AS nova_ordem,
  @prev_historico := p.id_historico
FROM historico_escolar_periodo p
CROSS JOIN (SELECT @row_num := 0, @prev_historico := 0) AS vars
ORDER BY p.id_historico, p.ano_letivo;

-- Atualizar ordem
UPDATE historico_escolar_periodo p
INNER JOIN temp_ordem t ON t.id = p.id
SET p.ordem = t.nova_ordem;

DROP TEMPORARY TABLE temp_ordem;

SELECT 'Ordem dos períodos atualizada' AS status;

-- ========================================================================
-- PASSO 9: ATUALIZAR TABELA historico_escolar_notas
-- ========================================================================

-- Adicionar coluna id_periodo
ALTER TABLE `historico_escolar_notas` 
ADD COLUMN `id_periodo` INT NULL COMMENT 'Referência ao período letivo' AFTER `id`;

-- Renomear id_historico para id_historico_old
ALTER TABLE `historico_escolar_notas` 
CHANGE COLUMN `id_historico` `id_historico_old` INT NULL;

-- Renomear id_disciplina para id_historico_disciplina  
ALTER TABLE `historico_escolar_notas` 
CHANGE COLUMN `id_disciplina` `id_historico_disciplina` INT NULL;

SELECT 'Colunas da tabela historico_escolar_notas atualizadas' AS status;

-- ========================================================================
-- PASSO 10: MAPEAR NOTAS PARA PERÍODOS
-- ========================================================================

-- Criar mapeamento temporário
CREATE TEMPORARY TABLE temp_notas_mapping AS
SELECT 
  n.id AS id_nota,
  np.id AS id_periodo_novo
FROM historico_escolar_notas n
INNER JOIN historico_escolar_periodo_temp pt ON pt.id = n.id_historico_old
INNER JOIN historico_escolar h ON h.id_aluno = pt.id_aluno
INNER JOIN historico_escolar_periodo np ON np.id_historico = h.id 
  AND np.ano_letivo = pt.ano 
  AND np.turma = pt.turma;

-- Atualizar id_periodo
UPDATE historico_escolar_notas n
INNER JOIN temp_notas_mapping tm ON tm.id_nota = n.id
SET n.id_periodo = tm.id_periodo_novo;

DROP TEMPORARY TABLE temp_notas_mapping;

SELECT CONCAT('Mapeadas ', COUNT(*), ' notas para períodos') AS status 
FROM historico_escolar_notas 
WHERE id_periodo IS NOT NULL;

-- ========================================================================
-- PASSO 11: ADICIONAR NOVOS CAMPOS EM historico_escolar_notas
-- ========================================================================

ALTER TABLE `historico_escolar_notas` 
ADD COLUMN `resultado` ENUM('aprovado', 'reprovado', 'dependencia', 'dispensado') 
  CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci
  DEFAULT 'aprovado' AFTER `nota`,
ADD COLUMN `faltas` INT DEFAULT 0 AFTER `resultado`;

-- Remover coluna antiga
ALTER TABLE `historico_escolar_notas` 
DROP COLUMN `id_historico_old`;

-- Tornar id_periodo NOT NULL
ALTER TABLE `historico_escolar_notas` 
MODIFY COLUMN `id_periodo` INT NOT NULL;

-- Adicionar índices
ALTER TABLE `historico_escolar_notas`
ADD KEY `idx_periodo` (`id_periodo`),
ADD KEY `idx_disciplina` (`id_historico_disciplina`);

SELECT 'Estrutura de historico_escolar_notas finalizada' AS status;

-- ========================================================================
-- PASSO 12: LIMPAR TABELA TEMPORÁRIA
-- ========================================================================

DROP TABLE IF EXISTS `historico_escolar_periodo_temp`;

SELECT 'Tabela temporária removida' AS status;

-- ========================================================================
-- PASSO 13: VERIFICAÇÕES FINAIS
-- ========================================================================

SELECT '========== RELATÓRIO FINAL DA MIGRAÇÃO ==========' AS '';

SELECT 
  'Históricos Principais' AS tabela,
  COUNT(*) AS total,
  COUNT(CASE WHEN deleted_at IS NULL THEN 1 END) AS ativos
FROM historico_escolar
UNION ALL
SELECT 
  'Períodos Letivos' AS tabela,
  COUNT(*) AS total,
  COUNT(CASE WHEN deleted_at IS NULL THEN 1 END) AS ativos
FROM historico_escolar_periodo
UNION ALL
SELECT 
  'Notas/Disciplinas' AS tabela,
  COUNT(*) AS total,
  COUNT(CASE WHEN deleted_at IS NULL THEN 1 END) AS ativos
FROM historico_escolar_notas;

-- Verificar relacionamentos
SELECT 
  h.id AS id_historico,
  h.id_aluno,
  COUNT(DISTINCT p.id) AS total_periodos,
  COUNT(DISTINCT n.id) AS total_notas
FROM historico_escolar h
LEFT JOIN historico_escolar_periodo p ON p.id_historico = h.id AND p.deleted_at IS NULL
LEFT JOIN historico_escolar_notas n ON n.id_periodo = p.id AND n.deleted_at IS NULL
WHERE h.deleted_at IS NULL
GROUP BY h.id, h.id_aluno
LIMIT 10;

-- Verificar notas órfãs
SELECT 
  CASE 
    WHEN COUNT(*) = 0 THEN '✓ Nenhuma nota órfã encontrada'
    ELSE CONCAT('⚠ ATENÇÃO: ', COUNT(*), ' notas sem período!')
  END AS verificacao_notas
FROM historico_escolar_notas 
WHERE id_periodo IS NULL AND deleted_at IS NULL;

SELECT '========== MIGRAÇÃO CONCLUÍDA COM SUCESSO! ==========' AS '';

-- ========================================================================
-- MIGRAÇÃO CONCLUÍDA!
-- ========================================================================
-- Backups mantidos em:
-- - historico_escolar_backup
-- - historico_escolar_notas_backup
--
-- Para reverter (se necessário):
-- Execute o script ROLLBACK_MIGRACAO.sql
-- ========================================================================
