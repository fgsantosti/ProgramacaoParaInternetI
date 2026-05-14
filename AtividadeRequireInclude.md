# 📥 Incluindo Arquivos: `require_once` vs `include_once`

## 🎯 Introdução

Em projetos PHP, é comum dividir o código em **múltiplos arquivos** para melhorar a organização, reutilização e manutenção. Para usar código de um arquivo em outro, o PHP oferece comandos de inclusão.

**Por que dividir o código?**
- ✅ **Reutilização**: Escrever uma vez, usar em vários lugares
- ✅ **Organização**: Separar lógica, configuração e apresentação
- ✅ **Manutenção**: Facilita encontrar e corrigir bugs
- ✅ **Trabalho em equipe**: Diferentes pessoas trabalham em arquivos diferentes

---

## 📋 As 4 Formas de Incluir Arquivos

PHP oferece 4 comandos para incluir arquivos:

| Comando | Descrição |
|---------|-----------|
| `include` | Inclui arquivo, **continua** se não encontrar (WARNING) |
| `include_once` | Igual ao `include`, mas **só inclui 1 vez** |
| `require` | Inclui arquivo, **para tudo** se não encontrar (FATAL ERROR) |
| `require_once` | Igual ao `require`, mas **só inclui 1 vez** |

---

## 📊 Tabela Comparativa Completa

| Comando | O que faz | Se o arquivo não existir | Permite duplicação | Quando usar |
|---------|-----------|-------------------------|-------------------|-------------|
| **`include`** | Inclui e executa o arquivo | ⚠️ **WARNING** (continua) | ✅ Sim (pode incluir várias vezes) | Arquivos opcionais que podem ser incluídos múltiplas vezes |
| **`include_once`** | Inclui apenas 1 vez | ⚠️ **WARNING** (continua) | ❌ Não (inclui só 1 vez) | Templates, widgets opcionais |
| **`require`** | Inclui e executa o arquivo | ❌ **FATAL ERROR** (para) | ✅ Sim (pode incluir várias vezes) | Raramente usado |
| **`require_once`** | Inclui apenas 1 vez | ❌ **FATAL ERROR** (para) | ❌ Não (inclui só 1 vez) | Configurações, classes, funções essenciais |

---

## 🔴 `require_once` - Arquivos Essenciais

### 💡 O que é?

`require_once` inclui um arquivo **obrigatório** e garante que ele seja incluído **apenas uma vez**, mesmo que o comando apareça várias vezes no código.

**Características:**
- ❌ Se o arquivo não existir → **ERRO FATAL** (script para completamente)
- 🛡️ Previne redeclaração de funções/classes
- ✅ Use para arquivos **essenciais** ao funcionamento

---

### 📝 Exemplo Prático 1: Arquivo de Configuração

Configurações de banco de dados são **essenciais** — sem elas, o sistema não funciona.

#### 📄 Arquivo: `config/database.php`

```php
<?php
/**
 * Configurações do Banco de Dados
 * Arquivo ESSENCIAL para o sistema
 */

define('DB_HOST', 'localhost');
define('DB_NAME', 'meu_sistema');
define('DB_USER', 'root');
define('DB_PASS', '');

// Função para conectar ao banco
function conectarBanco() {
    try {
        $pdo = new PDO(
            "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
            DB_USER,
            DB_PASS
        );
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Erro de conexão: " . $e->getMessage());
    }
}
?>
```

#### 📄 Arquivo: `index.php`

```php
<?php
/**
 * Página principal que PRECISA das configurações
 */

// OBRIGATÓRIO: Inclui configurações do banco
require_once 'config/database.php';

// Agora podemos usar as constantes e funções
echo "Conectando ao banco: " . DB_NAME . "<br>";

$conexao = conectarBanco();
echo "Conexão estabelecida com sucesso!";
?>
```

**✅ Resultado:** Sistema funciona corretamente  
**❌ Se config/database.php não existir:** `Fatal error: require_once(): Failed opening required 'config/database.php'` → **Script para!**

---

### 📝 Exemplo Prático 2: Funções Auxiliares

#### 📄 Arquivo: `includes/funcoes.php`

```php
<?php
/**
 * Funções auxiliares essenciais
 */

// Formata CPF
function formatarCPF($cpf) {
    $cpf = preg_replace('/[^0-9]/', '', $cpf);
    return substr($cpf, 0, 3) . '.' . 
           substr($cpf, 3, 3) . '.' . 
           substr($cpf, 6, 3) . '-' . 
           substr($cpf, 9, 2);
}

// Formata moeda brasileira
function formatarMoeda($valor) {
    return 'R$ ' . number_format($valor, 2, ',', '.');
}

// Gera data por extenso
function dataExtenso($data) {
    $timestamp = strtotime($data);
    return strftime('%d de %B de %Y', $timestamp);
}
?>
```

#### 📄 Arquivo: `relatorio.php`

```php
<?php
/**
 * Relatório que depende das funções
 */

// Inclui funções OBRIGATÓRIAS
require_once 'includes/funcoes.php';

// Dados de exemplo
$cpf = '12345678900';
$salario = 5500.50;
$data = '2026-05-14';

// Usa as funções
echo "<h2>Relatório de Funcionário</h2>";
echo "<p><strong>CPF:</strong> " . formatarCPF($cpf) . "</p>";
echo "<p><strong>Salário:</strong> " . formatarMoeda($salario) . "</p>";
echo "<p><strong>Data de Admissão:</strong> " . dataExtenso($data) . "</p>";
?>
```

**Saída:**
```
Relatório de Funcionário
CPF: 123.456.789-00
Salário: R$ 5.500,50
Data de Admissão: 14 de May de 2026
```

---

### ⚠️ O que acontece sem o `_once`?

Se usar apenas `require` e incluir o arquivo 2 vezes:

```php
<?php
require 'includes/funcoes.php';
require 'includes/funcoes.php';  // Incluindo novamente
?>
```

**❌ Erro:**
```
Fatal error: Cannot redeclare formatarCPF() 
(previously declared in includes/funcoes.php:5) 
in includes/funcoes.php on line 5
```

**✅ Solução:** Usar `require_once` evita esse problema!

---

## 🟡 `include_once` - Arquivos Opcionais

### 💡 O que é?

`include_once` tenta incluir um arquivo **opcional** apenas uma vez. Se o arquivo não existir, o script **continua normalmente**.

**Características:**
- ⚠️ Se o arquivo não existir → **WARNING** (apenas aviso, continua executando)
- 🛡️ Previne inclusão duplicada
- ✅ Use para arquivos **opcionais** (templates, widgets, componentes extras)

---

### 📝 Exemplo Prático 1: Template de Header Opcional

#### 📄 Arquivo: `templates/header.php`

```php
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Meu Site</title>
    <style>
        header {
            background: #333;
            color: white;
            padding: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <header>
        <h1>🌟 Bem-vindo ao Meu Site</h1>
        <nav>
            <a href="index.php" style="color: white;">Home</a> | 
            <a href="sobre.php" style="color: white;">Sobre</a> | 
            <a href="contato.php" style="color: white;">Contato</a>
        </nav>
    </header>
    <main style="padding: 20px;">
```

#### 📄 Arquivo: `pagina.php`

```php
<?php
/**
 * Página que tenta incluir o header, mas funciona sem ele
 */

// Tenta incluir header (se não existir, continua)
include_once 'templates/header.php';
?>

<h2>Conteúdo da Página</h2>
<p>Este conteúdo aparece mesmo se o header não existir.</p>

<?php
// Fecha HTML se incluiu o header
if (file_exists('templates/footer.php')) {
    include_once 'templates/footer.php';
} else {
    echo "</main></body></html>";
}
?>
```

**Se `templates/header.php` existir:**
- ✅ Página exibe com header bonito

**Se `templates/header.php` NÃO existir:**
- ⚠️ Warning: include_once(templates/header.php): failed to open stream
- ✅ Página continua e exibe o conteúdo normalmente (sem header)

---

### 📝 Exemplo Prático 2: Widget de Publicidade Opcional

#### 📄 Arquivo: `widgets/publicidade.php`

```php
<div style="border: 2px solid #ff6b6b; padding: 15px; margin: 20px 0; background: #ffe5e5;">
    <h3 style="color: #ff6b6b;">📢 Publicidade</h3>
    <p><strong>Promoção Especial!</strong></p>
    <p>Aproveite 50% OFF em todos os produtos!</p>
    <button style="background: #ff6b6b; color: white; padding: 10px 20px; border: none; cursor: pointer;">
        Aproveitar Oferta
    </button>
</div>
```

#### 📄 Arquivo: `blog.php`

```php
<!DOCTYPE html>
<html>
<head>
    <title>Blog</title>
</head>
<body>
    <h1>📝 Meu Blog</h1>
    
    <article>
        <h2>Como Aprender PHP</h2>
        <p>PHP é uma linguagem poderosa para desenvolvimento web...</p>
    </article>
    
    <?php
    // Widget de publicidade (opcional)
    // Se existir, mostra. Se não existir, não tem problema.
    include_once 'widgets/publicidade.php';
    ?>
    
    <article>
        <h2>Dicas de Programação</h2>
        <p>Aqui estão algumas dicas valiosas...</p>
    </article>
</body>
</html>
```

**Resultado:**
- Se `widgets/publicidade.php` existe → Publicidade aparece entre os artigos
- Se não existe → Blog funciona normalmente, apenas sem a publicidade

---

## ⚡ Diferença Principal: ERRO FATAL vs WARNING

### Teste Comparativo

#### 📄 Arquivo: `teste_require.php`

```php
<?php
echo "1. Início do script<br>";

// Tenta incluir arquivo que NÃO EXISTE
require_once 'arquivo_inexistente.php';

echo "2. Esta linha NUNCA será executada<br>";
?>
```

**Saída:**
```
1. Início do script
Fatal error: require_once(): Failed opening required 'arquivo_inexistente.php'
```
**Script para aqui! ❌**

---

#### 📄 Arquivo: `teste_include.php`

```php
<?php
echo "1. Início do script<br>";

// Tenta incluir arquivo que NÃO EXISTE
include_once 'arquivo_inexistente.php';

echo "2. Esta linha SERÁ executada normalmente<br>";
echo "3. O script continua funcionando!<br>";
?>
```

**Saída:**
```
1. Início do script
Warning: include_once(arquivo_inexistente.php): failed to open stream: No such file or directory
2. Esta linha SERÁ executada normalmente
3. O script continua funcionando!
```
**Script continua! ✅**

---

## 🎯 Quando Usar Cada Um?

### ✅ Use `require_once` para:

| Situação | Exemplo |
|----------|---------|
| **Configurações essenciais** | `config/database.php` |
| **Conexão com banco de dados** | `includes/conexao.php` |
| **Funções obrigatórias** | `includes/funcoes.php` |
| **Classes necessárias** | `classes/Usuario.php` |
| **Autoloader** | `vendor/autoload.php` (Composer) |
| **Constantes do sistema** | `config/constantes.php` |
| **Arquivos de segurança** | `includes/autenticacao.php` |

**Regra:** Se sem o arquivo o sistema **não funciona** → `require_once`

---

### ✅ Use `include_once` para:

| Situação | Exemplo |
|----------|---------|
| **Templates de layout** | `templates/header.php` |
| **Componentes opcionais** | `widgets/publicidade.php` |
| **Módulos extras** | `modulos/chat.php` |
| **Temas personalizados** | `themes/tema-escuro.php` |
| **Plugins opcionais** | `plugins/analytics.php` |
| **Arquivos de idioma** | `lang/pt_BR.php` |
| **Elementos condicionais** | `includes/admin-menu.php` |

**Regra:** Se sem o arquivo o sistema **ainda funciona** → `include_once`

---

## 📚 Boas Práticas

### ✅ O que fazer

```php
<?php
// ✅ BOM: Usar caminhos absolutos com __DIR__
require_once __DIR__ . '/config/database.php';

// ✅ BOM: Organizar includes no topo do arquivo
require_once 'includes/funcoes.php';
require_once 'includes/validacao.php';
include_once 'templates/header.php';

// ✅ BOM: Comentar o propósito
require_once 'config/app.php';  // Configurações da aplicação
?>
```

### ❌ O que evitar

```php
<?php
// ❌ RUIM: Include dentro de loop (ineficiente)
for ($i = 0; $i < 10; $i++) {
    include_once 'arquivo.php';  // Só inclui 1 vez mesmo assim
}

// ❌ RUIM: Caminhos relativos confusos
require_once '../../../config.php';

// ❌ RUIM: Usar require sem _once para funções
require 'funcoes.php';
require 'funcoes.php';  // Erro de redeclaração!

// ❌ RUIM: Misturar lógica e includes
echo "Teste";
require_once 'config.php';
echo "Mais teste";
require_once 'funcoes.php';
?>
```

---

## 🏗️ Exemplo Completo: Sistema Modular

### Estrutura do Projeto

```
meu-sistema/
│
├── index.php                    ← Página principal
│
├── config/
│   ├── database.php             ← Configurações DB (require_once)
│   └── constantes.php           ← Constantes (require_once)
│
├── includes/
│   ├── funcoes.php              ← Funções essenciais (require_once)
│   └── validacao.php            ← Validações (require_once)
│
└── templates/
    ├── header.php               ← Cabeçalho (include_once)
    ├── sidebar.php              ← Barra lateral (include_once)
    └── footer.php               ← Rodapé (include_once)
```

---

### 📄 Arquivo: `index.php` (Completo)

```php
<?php
/**
 * Página Principal do Sistema
 * Demonstra uso correto de require_once e include_once
 */

// ============================================
// 1. ARQUIVOS ESSENCIAIS (require_once)
// ============================================

// Configurações do banco (OBRIGATÓRIO)
require_once __DIR__ . '/config/database.php';

// Constantes do sistema (OBRIGATÓRIO)
require_once __DIR__ . '/config/constantes.php';

// Funções auxiliares (OBRIGATÓRIO)
require_once __DIR__ . '/includes/funcoes.php';

// Funções de validação (OBRIGATÓRIO)
require_once __DIR__ . '/includes/validacao.php';

// ============================================
// 2. TEMPLATES OPCIONAIS (include_once)
// ============================================

// Header (opcional, mas recomendado)
include_once __DIR__ . '/templates/header.php';

// Sidebar (opcional)
include_once __DIR__ . '/templates/sidebar.php';
?>

<!-- CONTEÚDO PRINCIPAL -->
<div class="conteudo">
    <h1>Bem-vindo ao Sistema</h1>
    
    <?php
    // Usando funções incluídas
    $usuario = 'João Silva';
    $saldo = 1500.75;
    
    echo "<p>Usuário: " . sanitizarTexto($usuario) . "</p>";
    echo "<p>Saldo: " . formatarMoeda($saldo) . "</p>";
    ?>
</div>

<?php
// Footer (opcional)
include_once __DIR__ . '/templates/footer.php';
?>
```

---

## 🔄 Resumo Visual - Fluxo de Decisão

```
┌─────────────────────────────────────────┐
│ Preciso incluir um arquivo externo...  │
└──────────────┬──────────────────────────┘
               │
               ▼
     ┌─────────────────────┐
     │ O arquivo é         │
     │ ESSENCIAL para o    │◄─── Exemplo: config.php,
     │ funcionamento?      │     funcoes.php, classes
     └─────────┬───────────┘
               │
        ┌──────┴──────┐
        │             │
       SIM           NÃO
        │             │
        ▼             ▼
   ┌─────────┐   ┌──────────┐
   │ require │   │ include  │◄─── Exemplo: header.php,
   │  _once  │   │  _once   │     widgets, templates
   └─────────┘   └──────────┘
        │             │
        ▼             ▼
   ┌─────────┐   ┌──────────┐
   │ ERRO    │   │ WARNING  │
   │ FATAL   │   │ (script  │
   │ (para)  │   │ continua)│
   └─────────┘   └──────────┘
```

---

## 📝 Exercícios Rápidos

### Exercício 1: Identificar o Comando Correto

Para cada situação, escolha `require_once` ou `include_once`:

```php
<?php
// a) Incluir configurações do banco de dados
__________ 'config/db.php';

// b) Incluir banner de promoção opcional
__________ 'widgets/banner.php';

// c) Incluir classe de autenticação
__________ 'classes/Auth.php';

// d) Incluir tema visual personalizado
__________ 'themes/dark-mode.php';
?>
```

**Resposta:**
- a) `require_once` (essencial)
- b) `include_once` (opcional)
- c) `require_once` (essencial)
- d) `include_once` (opcional)

---

### Exercício 2: Corrigir o Código

Identifique e corrija os erros:

```php
<?php
// Incluindo funções
require 'funcoes.php';
require 'funcoes.php';  // ❌ O que está errado aqui?

// Incluindo configuração essencial
include_once 'config.php';  // ❌ O que está errado aqui?
?>
```

**Resposta:**
```php
<?php
// ✅ Correto: usar require_once para evitar redeclaração
require_once 'funcoes.php';

// ✅ Correto: config é essencial, usar require_once
require_once 'config.php';
?>
```

---

### Exercício 3: Criar Estrutura

Crie a estrutura completa de um sistema de blog com:
- Arquivo de configuração (essencial)
- Funções de formatação (essencial)
- Header (opcional)
- Footer (opcional)

**Resposta:**

```php
<?php
// blog.php

// Arquivos essenciais
require_once 'config/settings.php';
require_once 'includes/funcoes.php';

// Templates opcionais
include_once 'templates/header.php';
?>

<article>
    <h1>Meu Primeiro Post</h1>
    <p>Conteúdo do post...</p>
</article>

<?php
include_once 'templates/footer.php';
?>
```

---

## 🎓 Conclusão

### Resumo Final

| | `require_once` | `include_once` |
|---|---|---|
| **Uso** | Arquivos **essenciais** | Arquivos **opcionais** |
| **Erro** | Fatal (para tudo) | Warning (continua) |
| **Exemplos** | Config, funções, classes | Templates, widgets |
| **Quando** | Sistema **não funciona** sem | Sistema **funciona** sem |

### Dica de Ouro 💡

> **"Se o arquivo falta e o sistema quebra → `require_once`"**  
> **"Se o arquivo falta e o sistema continua → `include_once`"**

---

*Seção criada para o tutorial de PHP - Disciplina de Programação para Internet - Curso ADS*
