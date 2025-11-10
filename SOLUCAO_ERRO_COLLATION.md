# Solução: Erro de Collation na Migração

## 🔴 Erro Identificado

```
Erro SQL (1267): Illegal mix of collations 
(utf8mb4_unicode_ci,IMPLICIT) and 
(utf8mb4_0900_ai_ci,IMPLICIT) for operation '='
```

## 🎯 Causa do Problema

O erro ocorre porque as tabelas do seu banco de dados usam **collations diferentes**:

- **Tabela antiga** (`historico_escolar`): `utf8mb4_0900_ai_ci`
- **Tabela nova** (criada no script): `utf8mb4_unicode_ci`

Quando o script tenta fazer **JOIN** entre essas tabelas, o MySQL não consegue comparar strings com collations diferentes.

## ✅ Solução Aplicada

Criei um **novo script de migração (V2)** que:

### 1. Usa Collation Uniforme
Todas as novas tabelas agora usam **`utf8mb4_0900_ai_ci`** (mesma da sua tabela original):

```sql
CREATE TABLE `historico_escolar` (
  ...
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
```

### 2. Define Collation em Campos Específicos
Campos de texto (VARCHAR, TEXT, ENUM) agora têm collation explícita:

```sql
`situacao` ENUM('ativo', 'concluido', 'transferido', 'cancelado') 
  CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci
  DEFAULT 'ativo'
```

### 3. Melhora no Mapeamento de Dados
Adicionei uma **tabela temporária** para mapear corretamente os IDs antigos para novos:

```sql
CREATE TEMPORARY TABLE temp_mapping AS
SELECT 
  n.id AS id_nota,
  np.id AS id_periodo_novo
FROM historico_escolar_notas n
INNER JOIN historico_escolar_periodo_temp p ON p.id = n.id_historico_old
...
```

### 4. Tratamento de Valores NULL
Adicionei `COALESCE` para evitar problemas com campos vazios:

```sql
COALESCE(p.estabelecimento, '') AS estabelecimento,
COALESCE(p.municipio, '') AS municipio,
```

## 📋 Como Usar o Novo Script

### Opção 1: Executar Script Completo (Recomendado)

1. **Abra o arquivo:** `MIGRACAO_HISTORICO_ESCOLAR_V2.sql`
2. **Execute no seu cliente MySQL** (HeidiSQL, phpMyAdmin, etc.)
3. **Aguarde a conclusão** (o script mostra mensagens de progresso)

### Opção 2: Executar Passo a Passo

Se preferir executar com mais controle:

```sql
-- 1. Fazer backup
CREATE TABLE historico_escolar_backup AS SELECT * FROM historico_escolar;
CREATE TABLE historico_escolar_notas_backup AS SELECT * FROM historico_escolar_notas;

-- 2. Renomear tabela atual
RENAME TABLE historico_escolar TO historico_escolar_periodo_temp;

-- 3. Criar nova tabela historico_escolar
-- (copiar do script V2)

-- 4. Continuar com os demais passos...
```

## 🔍 Verificações Pós-Migração

Após executar o script, verifique:

### 1. Contagem de Registros
```sql
SELECT 
  'Históricos' AS tabela, COUNT(*) AS total FROM historico_escolar
UNION ALL
SELECT 
  'Períodos' AS tabela, COUNT(*) AS total FROM historico_escolar_periodo
UNION ALL
SELECT 
  'Notas' AS tabela, COUNT(*) AS total FROM historico_escolar_notas;
```

### 2. Relacionamentos
```sql
SELECT 
  h.id AS id_historico,
  h.id_aluno,
  COUNT(DISTINCT p.id) AS total_periodos,
  COUNT(DISTINCT n.id) AS total_notas
FROM historico_escolar h
LEFT JOIN historico_escolar_periodo p ON p.id_historico = h.id
LEFT JOIN historico_escolar_notas n ON n.id_periodo = p.id
GROUP BY h.id, h.id_aluno;
```

### 3. Notas Órfãs (não deve retornar nada)
```sql
SELECT COUNT(*) AS notas_orfas 
FROM historico_escolar_notas 
WHERE id_periodo IS NULL;
```

## 🔄 Rollback (Se Necessário)

Se algo der errado, você pode reverter:

```sql
-- Remover tabelas novas
DROP TABLE IF EXISTS historico_escolar;
DROP TABLE IF EXISTS historico_escolar_periodo;

-- Restaurar backups
RENAME TABLE historico_escolar_backup TO historico_escolar;
-- (historico_escolar_notas não foi modificada estruturalmente no backup)
```

## 📊 Diferenças entre Collations

### utf8mb4_unicode_ci
- Mais antigo
- Compatível com versões antigas do MySQL
- Ordenação baseada em Unicode padrão

### utf8mb4_0900_ai_ci (Sua atual)
- Mais moderno (MySQL 8.0+)
- Melhor performance
- Ordenação baseada em Unicode 9.0
- **AI** = Accent Insensitive (ignora acentos)
- **CI** = Case Insensitive (ignora maiúsculas/minúsculas)

**Mantivemos `utf8mb4_0900_ai_ci` por ser a sua padrão atual.**

## ⚠️ Importante

1. **Faça backup completo do banco** antes de executar
2. **Execute em ambiente de teste** primeiro, se possível
3. **Verifique os resultados** após a migração
4. **Mantenha os backups** por alguns dias

## 🚀 Próximos Passos Após Migração

1. ✅ Verificar integridade dos dados
2. ✅ Atualizar Models no CodeIgniter
3. ✅ Criar Controllers para o novo módulo
4. ✅ Desenvolver Views
5. ✅ Testar funcionalidades

## 💡 Dica

Se ainda encontrar erros de collation em outras partes do sistema, você pode verificar a collation de todas as tabelas:

```sql
SELECT 
  TABLE_NAME,
  TABLE_COLLATION
FROM information_schema.TABLES
WHERE TABLE_SCHEMA = 'nome_do_seu_banco'
ORDER BY TABLE_NAME;
```

---

**O script V2 está pronto para uso e deve resolver o erro de collation!** 🎉
