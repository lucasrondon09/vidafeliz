-- ========================================================================
-- SCRIPT DE VERIFICAÇÃO: Estrutura da Tabela historico_escolar
-- ========================================================================
-- Execute este script primeiro para verificar a estrutura real da tabela
-- ========================================================================

-- Ver estrutura completa da tabela
DESCRIBE historico_escolar;

-- Ver colunas e tipos
SELECT 
  COLUMN_NAME,
  COLUMN_TYPE,
  IS_NULLABLE,
  COLUMN_DEFAULT,
  COLUMN_COMMENT
FROM information_schema.COLUMNS
WHERE TABLE_SCHEMA = DATABASE()
  AND TABLE_NAME = 'historico_escolar'
ORDER BY ORDINAL_POSITION;

-- Ver alguns registros de exemplo
SELECT * FROM historico_escolar LIMIT 5;
