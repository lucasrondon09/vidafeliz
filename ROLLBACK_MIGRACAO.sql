-- ========================================================================
-- SCRIPT DE ROLLBACK: Reverter Migração do Histórico Escolar
-- ========================================================================
-- Este script reverte a migração parcial e restaura o estado original
-- ========================================================================

-- Remover tabelas criadas/modificadas
DROP TABLE IF EXISTS `historico_escolar`;
DROP TABLE IF EXISTS `historico_escolar_periodo`;
DROP TABLE IF EXISTS `historico_escolar_periodo_temp`;

-- Restaurar tabela original do backup
RENAME TABLE `historico_escolar_backup` TO `historico_escolar`;

-- Verificar restauração
SELECT 'ROLLBACK CONCLUÍDO!' AS status;
SELECT COUNT(*) AS total_registros FROM historico_escolar;

-- ========================================================================
-- ROLLBACK CONCLUÍDO!
-- ========================================================================
-- A tabela historico_escolar foi restaurada ao estado original
-- Você pode agora executar o script de migração corrigido
-- ========================================================================
