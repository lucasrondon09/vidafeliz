-- ========================================================================
-- SCRIPT DE MIGRAÇÃO: Reestruturação do Histórico Escolar
-- ========================================================================
-- Descrição: Migra a estrutura atual para o novo modelo normalizado
-- Autor: Sistema Vida Feliz
-- Data: 2025-11-10
-- ========================================================================
-- ATENÇÃO: Faça backup do banco de dados antes de executar!
-- ========================================================================

-- ========================================================================
-- PASSO 1: BACKUP DA ESTRUTURA ATUAL
-- ========================================================================

-- Criar backup da tabela historico_escolar
DROP TABLE IF EXISTS `historico_escolar_backup`;
CREATE TABLE `historico_escolar_backup` AS SELECT * FROM `historico_escolar`;

-- Criar backup da tabela historico_escolar_notas
DROP TABLE IF EXISTS `historico_escolar_notas_backup`;
CREATE TABLE `historico_escolar_notas_backup` AS SELECT * FROM `historico_escolar_notas`;

-- Verificar backups
SELECT COUNT(*) AS total_historico_backup FROM historico_escolar_backup;
SELECT COUNT(*) AS total_notas_backup FROM historico_escolar_notas_backup;

-- ========================================================================
-- PASSO 2: RENOMEAR TABELA ATUAL
-- ========================================================================

-- Renomear historico_escolar para historico_escolar_periodo
RENAME TABLE `historico_escolar` TO `historico_escolar_periodo_temp`;

-- ========================================================================
-- PASSO 3: CRIAR NOVA TABELA historico_escolar (Histórico Principal)
-- ========================================================================

CREATE TABLE `historico_escolar` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_aluno` INT NOT NULL COMMENT 'Aluno dono do histórico',
  `data_inicio` DATE NULL COMMENT 'Data de início da vida escolar',
  `situacao` ENUM('ativo', 'concluido', 'transferido', 'cancelado') 
    DEFAULT 'ativo' COMMENT 'Status atual do histórico',
  `observacao_geral` TEXT NULL COMMENT 'Observações gerais do histórico',
  `created_at` DATETIME NULL DEFAULT NULL,
  `updated_at` DATETIME NULL DEFAULT NULL,
  `deleted_at` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_aluno` (`id_aluno`),
  KEY `idx_situacao` (`situacao`),
  KEY `idx_deleted` (`deleted_at`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
COMMENT='Histórico escolar principal de cada aluno';

-- ========================================================================
-- PASSO 4: CRIAR NOVA TABELA historico_escolar_periodo
-- ========================================================================

CREATE TABLE `historico_escolar_periodo` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_historico` INT NOT NULL COMMENT 'Referência ao histórico principal',
  `estabelecimento` VARCHAR(500) NOT NULL COMMENT 'Nome da instituição',
  `municipio` VARCHAR(200) NOT NULL COMMENT 'Cidade',
  `uf` VARCHAR(2) NOT NULL COMMENT 'Estado (sigla)',
  `turma` VARCHAR(100) NOT NULL COMMENT 'Série/Turma cursada',
  `ano_letivo` VARCHAR(4) NOT NULL COMMENT 'Ano letivo (ex: 2023)',
  `resultado` ENUM('aprovado', 'reprovado', 'cursando', 'transferido') 
    DEFAULT 'cursando' COMMENT 'Resultado do período',
  `carga_horaria_total` INT NULL COMMENT 'Carga horária total do período',
  `frequencia` DECIMAL(5,2) NULL COMMENT 'Percentual de frequência',
  `observacao` TEXT NULL COMMENT 'Observações específicas do período',
  `ordem` INT DEFAULT 0 COMMENT 'Ordem cronológica dos períodos',
  `created_at` DATETIME NULL DEFAULT NULL,
  `updated_at` DATETIME NULL DEFAULT NULL,
  `deleted_at` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_historico` (`id_historico`),
  KEY `idx_ano_letivo` (`ano_letivo`),
  KEY `idx_ordem` (`ordem`),
  KEY `idx_deleted` (`deleted_at`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
COMMENT='Períodos/anos letivos do histórico escolar';

-- ========================================================================
-- PASSO 5: MIGRAR DADOS - Criar Históricos Principais
-- ========================================================================

-- Inserir um registro de histórico para cada aluno que possui períodos
INSERT INTO `historico_escolar` (`id_aluno`, `data_inicio`, `situacao`, `created_at`, `updated_at`)
SELECT 
  `id_aluno`,
  MIN(STR_TO_DATE(CONCAT(`ano`, '-01-01'), '%Y-%m-%d')) AS data_inicio,
  'ativo' AS situacao,
  MIN(`created_at`) AS created_at,
  NOW() AS updated_at
FROM `historico_escolar_periodo_temp`
WHERE `deleted_at` IS NULL
GROUP BY `id_aluno`;

-- Verificar históricos criados
SELECT COUNT(*) AS total_historicos_criados FROM historico_escolar;

-- ========================================================================
-- PASSO 6: MIGRAR DADOS - Períodos Letivos
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
  p.estabelecimento,
  p.municipio,
  p.uf,
  p.turma,
  p.ano AS ano_letivo,
  'cursando' AS resultado,
  p.observacao,
  0 AS ordem,
  p.created_at,
  p.updated_at,
  p.deleted_at
FROM `historico_escolar_periodo_temp` p
INNER JOIN `historico_escolar` h ON h.id_aluno = p.id_aluno
ORDER BY p.id_aluno, p.ano;

-- Atualizar ordem cronológica dos períodos
SET @row_number = 0;
SET @current_historico = 0;

UPDATE `historico_escolar_periodo` p
INNER JOIN (
  SELECT 
    id,
    @row_number := IF(@current_historico = id_historico, @row_number + 1, 1) AS ordem,
    @current_historico := id_historico AS id_historico
  FROM `historico_escolar_periodo`
  ORDER BY id_historico, ano_letivo
) AS ranked ON p.id = ranked.id
SET p.ordem = ranked.ordem;

-- Verificar períodos migrados
SELECT COUNT(*) AS total_periodos_migrados FROM historico_escolar_periodo;

-- ========================================================================
-- PASSO 7: ATUALIZAR TABELA historico_escolar_notas
-- ========================================================================

-- Adicionar coluna id_periodo (temporariamente NULL)
ALTER TABLE `historico_escolar_notas` 
ADD COLUMN `id_periodo` INT NULL AFTER `id`;

-- Renomear coluna id_historico para id_historico_old (manter temporariamente)
ALTER TABLE `historico_escolar_notas` 
CHANGE COLUMN `id_historico` `id_historico_old` INT NULL;

-- Renomear coluna id_disciplina para id_historico_disciplina
ALTER TABLE `historico_escolar_notas` 
CHANGE COLUMN `id_disciplina` `id_historico_disciplina` INT NULL;

-- Atualizar id_periodo baseado no id_historico_old
UPDATE `historico_escolar_notas` n
INNER JOIN `historico_escolar_periodo_temp` p ON p.id = n.id_historico_old
INNER JOIN `historico_escolar` h ON h.id_aluno = p.id_aluno
INNER JOIN `historico_escolar_periodo` np ON np.id_historico = h.id 
  AND np.ano_letivo = p.ano 
  AND np.turma = p.turma
SET n.id_periodo = np.id;

-- Adicionar novos campos
ALTER TABLE `historico_escolar_notas` 
ADD COLUMN `resultado` ENUM('aprovado', 'reprovado', 'dependencia', 'dispensado') 
  DEFAULT 'aprovado' AFTER `nota`,
ADD COLUMN `faltas` INT DEFAULT 0 AFTER `resultado`;

-- Remover coluna antiga id_historico_old
ALTER TABLE `historico_escolar_notas` 
DROP COLUMN `id_historico_old`;

-- Tornar id_periodo NOT NULL
ALTER TABLE `historico_escolar_notas` 
MODIFY COLUMN `id_periodo` INT NOT NULL;

-- Adicionar índices
ALTER TABLE `historico_escolar_notas`
ADD KEY `idx_periodo` (`id_periodo`),
ADD KEY `idx_disciplina` (`id_historico_disciplina`);

-- Verificar notas migradas
SELECT COUNT(*) AS total_notas_migradas FROM historico_escolar_notas;

-- ========================================================================
-- PASSO 8: LIMPAR TABELA TEMPORÁRIA
-- ========================================================================

-- Remover tabela temporária
DROP TABLE IF EXISTS `historico_escolar_periodo_temp`;

-- ========================================================================
-- PASSO 9: VERIFICAÇÕES FINAIS
-- ========================================================================

-- Verificar integridade dos dados
SELECT 
  'Históricos' AS tabela,
  COUNT(*) AS total
FROM historico_escolar
UNION ALL
SELECT 
  'Períodos' AS tabela,
  COUNT(*) AS total
FROM historico_escolar_periodo
UNION ALL
SELECT 
  'Notas' AS tabela,
  COUNT(*) AS total
FROM historico_escolar_notas;

-- Verificar relacionamentos
SELECT 
  h.id AS id_historico,
  h.id_aluno,
  COUNT(DISTINCT p.id) AS total_periodos,
  COUNT(DISTINCT n.id) AS total_notas
FROM historico_escolar h
LEFT JOIN historico_escolar_periodo p ON p.id_historico = h.id
LEFT JOIN historico_escolar_notas n ON n.id_periodo = p.id
GROUP BY h.id, h.id_aluno;

-- ========================================================================
-- PASSO 10: ATUALIZAR COMENTÁRIOS E METADADOS
-- ========================================================================

ALTER TABLE `historico_escolar_notas` 
COMMENT='Disciplinas e notas de cada período do histórico';

-- ========================================================================
-- MIGRAÇÃO CONCLUÍDA!
-- ========================================================================
-- Os backups foram mantidos nas tabelas:
-- - historico_escolar_backup
-- - historico_escolar_notas_backup
-- 
-- Em caso de problemas, você pode restaurar usando:
-- DROP TABLE historico_escolar;
-- RENAME TABLE historico_escolar_backup TO historico_escolar;
-- ========================================================================
