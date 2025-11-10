# Proposta: Reestruturação do Banco de Dados - Histórico Escolar

## 🎯 Objetivo

Criar uma estrutura de banco de dados normalizada e escalável para o módulo de Histórico Escolar, separando claramente o **histórico principal do aluno** dos **períodos letivos** cursados.

---

## 📊 Estrutura Atual (Problema)

### Tabela: `historico_escolar`

```
historico_escolar
├── id
├── id_aluno          ← Vinculado diretamente ao aluno
├── turma
├── estabelecimento
├── municipio
├── uf
├── ano
├── observacao
└── timestamps
```

**Problemas identificados:**
1. ❌ Cada registro representa um **período/ano letivo**, não um histórico completo
2. ❌ Um aluno pode ter múltiplos registros (um para cada ano)
3. ❌ Não há uma entidade "Histórico" que agrupe todos os períodos do aluno
4. ❌ Dificulta consultas e relatórios consolidados
5. ❌ Nomenclatura confusa (parece ser o histórico completo, mas é apenas um período)

---

## ✅ Estrutura Proposta (Solução)

### Arquitetura em 3 Camadas

```
historico_escolar (Histórico Principal)
    ↓ 1:N
historico_escolar_periodo (Períodos/Anos Letivos)
    ↓ 1:N
historico_escolar_notas (Disciplinas e Notas)
```

### 1. **Tabela: `historico_escolar`** (Histórico Principal)

**Propósito:** Representa o **histórico completo** de um aluno. Cada aluno tem **apenas 1 registro**.

```sql
CREATE TABLE `historico_escolar` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_aluno` INT NOT NULL COMMENT 'Aluno dono do histórico',
  `data_inicio` DATE NULL COMMENT 'Data de início da vida escolar',
  `situacao` ENUM('ativo', 'concluido', 'transferido', 'cancelado') DEFAULT 'ativo',
  `observacao_geral` TEXT NULL COMMENT 'Observações gerais do histórico',
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `deleted_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_aluno` (`id_aluno`, `deleted_at`),
  KEY `idx_situacao` (`situacao`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
COMMENT='Histórico escolar principal de cada aluno';
```

**Campos:**
- `id_aluno`: Vínculo único com o aluno
- `data_inicio`: Quando o aluno iniciou sua vida escolar
- `situacao`: Status atual do histórico
- `observacao_geral`: Observações que se aplicam a todo o histórico

**Relacionamento:** 1 Aluno → 1 Histórico

---

### 2. **Tabela: `historico_escolar_periodo`** (Períodos Letivos)

**Propósito:** Representa cada **ano/período letivo** cursado pelo aluno em diferentes instituições.

```sql
CREATE TABLE `historico_escolar_periodo` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_historico` INT NOT NULL COMMENT 'Referência ao histórico principal',
  `estabelecimento` VARCHAR(500) NOT NULL COMMENT 'Nome da instituição',
  `municipio` VARCHAR(200) NOT NULL COMMENT 'Cidade',
  `uf` VARCHAR(2) NOT NULL COMMENT 'Estado (sigla)',
  `turma` VARCHAR(100) NOT NULL COMMENT 'Série/Turma cursada',
  `ano_letivo` VARCHAR(4) NOT NULL COMMENT 'Ano letivo (ex: 2023)',
  `resultado` ENUM('aprovado', 'reprovado', 'cursando', 'transferido') DEFAULT 'cursando',
  `carga_horaria_total` INT NULL COMMENT 'Carga horária total do período',
  `frequencia` DECIMAL(5,2) NULL COMMENT 'Percentual de frequência',
  `observacao` TEXT NULL COMMENT 'Observações específicas do período',
  `ordem` INT DEFAULT 0 COMMENT 'Ordem cronológica dos períodos',
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `deleted_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  KEY `idx_historico` (`id_historico`),
  KEY `idx_ano_letivo` (`ano_letivo`),
  KEY `idx_ordem` (`ordem`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
COMMENT='Períodos/anos letivos do histórico escolar';
```

**Campos principais:**
- `id_historico`: Vincula ao histórico principal (não mais ao aluno diretamente)
- `estabelecimento`, `municipio`, `uf`: Dados da instituição
- `turma`, `ano_letivo`: Identificação do período
- `resultado`: Status do período (aprovado, reprovado, etc.)
- `carga_horaria_total`: Soma das cargas horárias das disciplinas
- `frequencia`: Percentual de presença
- `ordem`: Para ordenar cronologicamente os períodos

**Relacionamento:** 1 Histórico → N Períodos

---

### 3. **Tabela: `historico_escolar_notas`** (Disciplinas e Notas)

**Propósito:** Armazena as **disciplinas cursadas e notas** de cada período letivo.

```sql
CREATE TABLE `historico_escolar_notas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_periodo` INT NOT NULL COMMENT 'Referência ao período letivo',
  `id_historico_disciplina` INT NOT NULL COMMENT 'Referência à disciplina',
  `nota` VARCHAR(10) NULL COMMENT 'Nota obtida',
  `resultado` ENUM('aprovado', 'reprovado', 'dependencia', 'dispensado') DEFAULT 'aprovado',
  `faltas` INT DEFAULT 0 COMMENT 'Número de faltas na disciplina',
  `observacao` VARCHAR(500) NULL COMMENT 'Observações sobre a disciplina',
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `deleted_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  KEY `idx_periodo` (`id_periodo`),
  KEY `idx_disciplina` (`id_historico_disciplina`),
  UNIQUE KEY `uk_periodo_disciplina` (`id_periodo`, `id_historico_disciplina`, `deleted_at`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
COMMENT='Disciplinas e notas de cada período do histórico';
```

**Mudanças importantes:**
- ✅ `id_periodo` ao invés de `id_historico` (vincula ao período específico)
- ✅ `id_historico_disciplina` ao invés de `id_disciplina` (usa a tabela específica de disciplinas do histórico)
- ✅ Campos adicionais: `resultado`, `faltas`
- ✅ Constraint única: não permite duplicar disciplina no mesmo período

**Relacionamento:** 1 Período → N Disciplinas/Notas

---

## 🔄 Relacionamentos Completos

```
alunos (1) ────────────── (1) historico_escolar
                                    │
                                    │ 1:N
                                    ↓
                          historico_escolar_periodo
                                    │
                                    │ 1:N
                                    ↓
                          historico_escolar_notas
                                    │
                                    │ N:1
                                    ↓
                          historico_disciplinas
```

---

## 📋 Comparação: Antes vs Depois

### Cenário: Aluno cursou 3 anos em escolas diferentes

#### ❌ Estrutura Antiga

```
historico_escolar
├── id: 1, id_aluno: 10, turma: "1º Ano", ano: "2021", estabelecimento: "Escola A"
├── id: 2, id_aluno: 10, turma: "2º Ano", ano: "2022", estabelecimento: "Escola B"
└── id: 3, id_aluno: 10, turma: "3º Ano", ano: "2023", estabelecimento: "Escola C"
```

**Problemas:**
- 3 registros "soltos" sem agrupamento
- Difícil saber qual é o histórico "principal"
- Não há informações consolidadas

#### ✅ Estrutura Nova

```
historico_escolar (1 registro)
└── id: 1, id_aluno: 10, situacao: "ativo"
    │
    └── historico_escolar_periodo (3 registros)
        ├── id: 1, id_historico: 1, turma: "1º Ano", ano: "2021", estabelecimento: "Escola A"
        ├── id: 2, id_historico: 1, turma: "2º Ano", ano: "2022", estabelecimento: "Escola B"
        └── id: 3, id_historico: 1, turma: "3º Ano", ano: "2023", estabelecimento: "Escola C"
```

**Vantagens:**
- 1 histórico principal agrupa todos os períodos
- Estrutura hierárquica clara
- Fácil consultar todo o histórico do aluno
- Permite adicionar informações gerais no histórico principal

---

## 🎯 Benefícios da Nova Estrutura

### 1. **Organização Lógica**
- ✅ Separação clara entre "histórico completo" e "períodos letivos"
- ✅ Estrutura hierárquica intuitiva
- ✅ Nomenclatura correta e autoexplicativa

### 2. **Escalabilidade**
- ✅ Fácil adicionar novos períodos
- ✅ Suporta históricos complexos (múltiplas escolas, transferências)
- ✅ Permite campos específicos por nível (histórico, período, nota)

### 3. **Consultas Eficientes**
- ✅ Buscar histórico completo: `SELECT * FROM historico_escolar WHERE id_aluno = ?`
- ✅ Buscar períodos: `SELECT * FROM historico_escolar_periodo WHERE id_historico = ?`
- ✅ Relatórios consolidados mais simples

### 4. **Integridade de Dados**
- ✅ Constraints e índices adequados
- ✅ Relacionamentos bem definidos
- ✅ Evita duplicações

### 5. **Funcionalidades Futuras**
- ✅ Cálculo de média geral do histórico
- ✅ Estatísticas por período
- ✅ Comparação entre períodos
- ✅ Relatórios de progressão acadêmica

---

## 🔧 Migração de Dados

### Estratégia de Migração

**Passo 1:** Criar tabela `historico_escolar` (nova)
**Passo 2:** Renomear tabela atual para `historico_escolar_periodo`
**Passo 3:** Criar registros de histórico principal para cada aluno
**Passo 4:** Atualizar `historico_escolar_periodo` com `id_historico`
**Passo 5:** Atualizar `historico_escolar_notas` para referenciar períodos

### Script de Migração (será fornecido)

```sql
-- 1. Backup da tabela atual
CREATE TABLE historico_escolar_backup AS SELECT * FROM historico_escolar;

-- 2. Renomear tabela atual
RENAME TABLE historico_escolar TO historico_escolar_periodo;

-- 3. Criar nova tabela historico_escolar
-- (script completo será fornecido)

-- 4. Migrar dados
-- (script completo será fornecido)
```

---

## 📝 Próximos Passos

1. ✅ **Aprovar a estrutura proposta**
2. 🔄 **Criar scripts SQL completos de migração**
3. 🔄 **Atualizar Models no CodeIgniter**
4. 🔄 **Criar Controllers para o novo módulo**
5. 🔄 **Desenvolver Views (interface)**
6. 🔄 **Testar migração em ambiente de desenvolvimento**

---

## ❓ Perguntas para Validação

Antes de prosseguir, confirme:

1. **A estrutura proposta atende às necessidades?**
2. **Há algum campo adicional necessário?**
3. **A lógica de relacionamentos está clara?**
4. **Posso prosseguir com a criação dos scripts SQL?**

---

## 💡 Observações Importantes

- ✅ A estrutura é **retrocompatível** (dados existentes serão migrados)
- ✅ Usa **soft delete** em todas as tabelas
- ✅ Mantém **timestamps automáticos**
- ✅ Índices otimizados para consultas frequentes
- ✅ Comentários em todos os campos para documentação

---

**Aguardando sua aprovação para prosseguir com a implementação!** 🚀
