# 📋 ATIVIDADE PRÁTICA — Sessões em PHP

---

| **Campo**            | **Detalhe**                                      |
|----------------------|--------------------------------------------------|
| **Disciplina**       | Programação para Internet                        |
| **Curso**            | Análise e Desenvolvimento de Sistemas            |
| **Nível**            | Intermediário                                    |
| **Tema**             | Sessões em PHP                                   |
| **Pré-requisitos**   | PHP básico, HTML/CSS, Formulários, Arrays em PHP |

---

## 🎯 Objetivos de Aprendizagem

Ao final desta atividade, o aluno será capaz de:

1. ✅ Compreender o conceito de **sessões** e sua importância em aplicações web
2. ✅ Diferenciar **sessões** de **cookies**
3. ✅ Utilizar as funções `session_start()`, `$_SESSION`, `session_destroy()` e `session_unset()`
4. ✅ Implementar um **sistema de login** funcional com sessões
5. ✅ Criar **áreas protegidas** que exigem autenticação
6. ✅ Desenvolver um sistema com **múltiplos níveis de acesso**
7. ✅ Aplicar **boas práticas de segurança** no uso de sessões

---

## 📖 Introdução Teórica

### O que são Sessões? 🤔

Uma **sessão** é um mecanismo que permite ao servidor **armazenar informações sobre um usuário** enquanto ele navega pelas páginas de um site. Como o protocolo HTTP é **stateless** (sem estado), ou seja, cada requisição é independente, as sessões foram criadas para "lembrar" quem é o usuário.

**Analogia simples:**
> Imagine que você vai a um parque de diversões. Na entrada, você recebe uma **pulseira com um número único**. Cada vez que você vai a um brinquedo, o funcionário lê sua pulseira e sabe quem você é, o que já usou e o que pode usar. A **pulseira** é como o **ID da sessão**, e as **informações armazenadas** no sistema do parque são os **dados da sessão**.

### Diferença entre Sessões e Cookies 🍪 vs 🔐

| Característica         | **Cookie** 🍪                     | **Sessão** 🔐                          |
|------------------------|------------------------------------|-----------------------------------------|
| **Onde armazena?**     | No navegador (cliente)             | No servidor                             |
| **Segurança**          | Menos seguro (usuário pode editar) | Mais seguro (dados ficam no servidor)   |
| **Capacidade**         | ~4KB por cookie                    | Limitado pela memória do servidor       |
| **Duração**            | Pode persistir por dias/meses      | Encerra ao fechar o navegador (padrão)  |
| **Tipo de dados**      | Apenas texto (strings)             | Qualquer tipo de dado PHP               |
| **Visibilidade**       | Visível pelo usuário               | Invisível para o usuário                |
| **Uso comum**          | "Lembrar-me", preferências         | Login, carrinho de compras, permissões  |

### Como Funcionam as Sessões em PHP? ⚙️

```
┌──────────────────────────────────────────────────────────────────────┐
│                    CICLO DE VIDA DA SESSÃO                          │
├──────────────────────────────────────────────────────────────────────┤
│                                                                      │
│  1️⃣  Usuário acessa a página                                        │
│       │                                                              │
│       ▼                                                              │
│  2️⃣  PHP executa session_start()                                    │
│       │                                                              │
│       ├── Sessão NÃO existe? ──► Cria novo ID (ex: abc123def456)    │
│       │                          Cria arquivo no servidor            │
│       │                          Envia cookie PHPSESSID ao browser   │
│       │                                                              │
│       └── Sessão JÁ existe? ──► Lê cookie PHPSESSID do browser     │
│                                  Recupera dados do arquivo           │
│       │                                                              │
│       ▼                                                              │
│  3️⃣  PHP lê/grava dados em $_SESSION                                │
│       │                                                              │
│       ▼                                                              │
│  4️⃣  Usuário navega por outras páginas                              │
│       (cookie PHPSESSID é enviado automaticamente)                   │
│       │                                                              │
│       ▼                                                              │
│  5️⃣  Sessão é encerrada quando:                                     │
│       • Usuário fecha o navegador (padrão)                           │
│       • PHP executa session_destroy()                                │
│       • Tempo de inatividade expira (garbage collector)              │
│                                                                      │
└──────────────────────────────────────────────────────────────────────┘
```

### Funções Principais 🔧

| Função                | Descrição                                                |
|-----------------------|----------------------------------------------------------|
| `session_start()`     | Inicia ou retoma uma sessão existente                    |
| `$_SESSION`           | Superglobal (array) para ler/gravar dados da sessão      |
| `session_destroy()`   | Destrói todos os dados da sessão no servidor             |
| `session_unset()`     | Remove todas as variáveis da sessão                      |
| `session_id()`        | Retorna ou define o ID da sessão atual                   |
| `session_regenerate_id()` | Gera um novo ID de sessão (segurança)               |
| `session_status()`    | Retorna o estado atual da sessão                         |

---

## 🔑 Conceitos Importantes

### 1. `session_start()` — Iniciando a Sessão

Esta função **deve ser chamada no início de TODA página** que utilize sessões. Ela deve ser executada **antes de qualquer saída HTML** (antes de qualquer `echo`, tag HTML ou espaço em branco).

```php
<?php
// ✅ CORRETO — session_start() é a primeira coisa do arquivo
session_start();
echo "Olá, mundo!";
?>
```

```php
<!-- ❌ ERRADO — Há HTML antes do session_start() -->
<html>
<?php
session_start(); // Isso gera um erro!
?>
```

> ⚠️ **Erro comum:** `Warning: Cannot send session cookie - headers already sent`
> Isso acontece quando há qualquer saída (HTML, espaço, echo) antes do `session_start()`.

### 2. `$_SESSION` — A Superglobal

`$_SESSION` é um **array associativo** que funciona como "gavetas" onde você guarda informações do usuário. Tudo que você armazenar nela estará disponível em **qualquer página** (desde que `session_start()` tenha sido chamado).

```php
<?php
session_start();

// 📝 Gravando dados na sessão
$_SESSION['nome'] = 'Maria';
$_SESSION['email'] = 'maria@email.com';
$_SESSION['nivel'] = 3;
$_SESSION['logado'] = true;

// 📖 Lendo dados da sessão
echo $_SESSION['nome'];   // Maria
echo $_SESSION['nivel'];  // 3

// 🔍 Verificando se existe
if (isset($_SESSION['logado'])) {
    echo "Usuário está logado!";
}

// 🗑️ Removendo um item específico
unset($_SESSION['email']);
```

### 3. `session_destroy()` — Destruindo a Sessão

Remove **todos os dados** da sessão no servidor. Usado no **logout**.

```php
<?php
session_start();          // Precisa iniciar para poder destruir
session_unset();          // Limpa todas as variáveis
session_destroy();        // Destrói a sessão no servidor

// Opcional: Remove o cookie da sessão do navegador
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
```

### 4. `session_unset()` vs `session_destroy()`

| Função              | O que faz                                       |
|---------------------|--------------------------------------------------|
| `session_unset()`   | Remove as **variáveis** da sessão (esvazia)      |
| `session_destroy()` | Destrói a **sessão inteira** no servidor          |

> 💡 **Dica:** Para um logout completo, use **ambas** na sequência: primeiro `session_unset()`, depois `session_destroy()`.

### 5. Tempo de Expiração ⏱️

Por padrão, a sessão expira quando o navegador é fechado. Podemos configurar:

```php
<?php
// Define tempo máximo de inatividade (em segundos)
// 1800 segundos = 30 minutos
ini_set('session.gc_maxlifetime', 1800);

// Ou verificar manualmente:
session_start();

$tempo_limite = 1800; // 30 minutos

if (isset($_SESSION['ultimo_acesso'])) {
    $inatividade = time() - $_SESSION['ultimo_acesso'];
    if ($inatividade > $tempo_limite) {
        session_unset();
        session_destroy();
        header("Location: login.php?msg=sessao_expirada");
        exit();
    }
}

$_SESSION['ultimo_acesso'] = time();
```

### 6. Segurança Básica 🛡️

```php
<?php
session_start();

// 🔄 Regenerar ID a cada login (previne session fixation)
session_regenerate_id(true);

// 🔒 Armazenar IP e User-Agent para validação
$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
$_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];

// 🔍 Verificar em páginas protegidas
if ($_SESSION['ip'] !== $_SERVER['REMOTE_ADDR'] ||
    $_SESSION['user_agent'] !== $_SERVER['HTTP_USER_AGENT']) {
    // Possível tentativa de hijacking!
    session_destroy();
    header("Location: login.php?msg=sessao_invalida");
    exit();
}
```

---

## 📘 Exemplo Explicativo Básico

Vamos criar um **sistema de login simples** com 4 arquivos para entender como as sessões funcionam na prática.

### Estrutura do Exemplo:

```
exemplo-sessao/
├── login.php        (formulário de login)
├── autenticar.php   (valida credenciais e cria sessão)
├── painel.php       (área protegida)
└── logout.php       (destrói a sessão)
```

---

### 📄 Arquivo 1: `login.php` — Formulário de Login

```php
<?php
/**
 * login.php — Formulário de Login
 * 
 * Este arquivo exibe o formulário onde o usuário digita
 * seu e-mail e senha para acessar o sistema.
 */

// Inicia a sessão para verificar se já está logado
session_start();

// Se o usuário JÁ está logado, redireciona para o painel
// Isso evita que um usuário logado veja a tela de login novamente
if (isset($_SESSION['logado']) && $_SESSION['logado'] === true) {
    header("Location: painel.php");
    exit(); // IMPORTANTE: sempre usar exit() após header()
}

// Verifica se há mensagem de erro vinda da autenticação
$erro = '';
if (isset($_GET['erro'])) {
    switch ($_GET['erro']) {
        case 'credenciais':
            $erro = '❌ E-mail ou senha incorretos!';
            break;
        case 'sessao_expirada':
            $erro = '⏰ Sua sessão expirou. Faça login novamente.';
            break;
        case 'acesso_negado':
            $erro = '🚫 Você precisa estar logado para acessar essa página.';
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema</title>
    <style>
        /* Estilo simples para o formulário */
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background-color: #f0f2f5;
        }
        .login-box {
            background: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }
        .login-box h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }
        .btn {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .erro {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>🔐 Login</h2>

        <!-- Exibe mensagem de erro, se houver -->
        <?php if (!empty($erro)): ?>
            <div class="erro"><?php echo $erro; ?></div>
        <?php endif; ?>

        <!-- Formulário envia dados via POST para autenticar.php -->
        <form action="autenticar.php" method="POST">
            <div class="form-group">
                <label for="email">📧 E-mail:</label>
                <input type="email" id="email" name="email" 
                       placeholder="seu@email.com" required>
            </div>

            <div class="form-group">
                <label for="senha">🔑 Senha:</label>
                <input type="password" id="senha" name="senha" 
                       placeholder="Sua senha" required>
            </div>

            <button type="submit" class="btn">Entrar</button>
        </form>
    </div>
</body>
</html>
```

**🔍 Pontos-chave deste arquivo:**
- `session_start()` é chamado no topo para verificar se já há sessão ativa
- Se já estiver logado, redireciona com `header("Location: ...")` + `exit()`
- O formulário usa `method="POST"` (mais seguro que GET para senhas)
- Mensagens de erro são passadas via `$_GET['erro']`

---

### 📄 Arquivo 2: `autenticar.php` — Validação e Criação da Sessão

```php
<?php
/**
 * autenticar.php — Processa o Login
 * 
 * Recebe e-mail e senha via POST, valida as credenciais
 * e cria a sessão do usuário se estiver correto.
 */

// Inicia a sessão ANTES de qualquer outra coisa
session_start();

// ─── BANCO DE DADOS SIMULADO (hardcoded) ───
// Em um sistema real, esses dados viriam de um banco de dados
// e as senhas estariam criptografadas com password_hash()
$usuarios = [
    [
        'id' => 1,
        'nome' => 'Maria Silva',
        'email' => 'maria@email.com',
        'senha' => '123456'
    ],
    [
        'id' => 2,
        'nome' => 'João Santos',
        'email' => 'joao@email.com',
        'senha' => '654321'
    ]
];

// ─── VERIFICAÇÃO DO MÉTODO ───
// Garante que os dados chegaram via POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: login.php");
    exit();
}

// ─── RECEBE E LIMPA OS DADOS ───
// trim() remove espaços em branco no início e fim
// htmlspecialchars() previne injeção de HTML/JavaScript (XSS)
$email = trim(htmlspecialchars($_POST['email'] ?? ''));
$senha = trim($_POST['senha'] ?? '');

// ─── VALIDAÇÃO BÁSICA ───
if (empty($email) || empty($senha)) {
    header("Location: login.php?erro=credenciais");
    exit();
}

// ─── BUSCA O USUÁRIO ───
$usuario_encontrado = null;

foreach ($usuarios as $usuario) {
    // Compara e-mail (case-insensitive) e senha
    if (strtolower($usuario['email']) === strtolower($email) 
        && $usuario['senha'] === $senha) {
        $usuario_encontrado = $usuario;
        break; // Encontrou! Sai do loop
    }
}

// ─── RESULTADO DA AUTENTICAÇÃO ───
if ($usuario_encontrado) {
    // ✅ LOGIN BEM-SUCEDIDO!
    
    // Regenera o ID da sessão por segurança
    // Isso previne ataques de "session fixation"
    session_regenerate_id(true);
    
    // Armazena informações do usuário na sessão
    $_SESSION['logado'] = true;
    $_SESSION['usuario_id'] = $usuario_encontrado['id'];
    $_SESSION['usuario_nome'] = $usuario_encontrado['nome'];
    $_SESSION['usuario_email'] = $usuario_encontrado['email'];
    $_SESSION['login_hora'] = date('d/m/Y H:i:s');
    
    // Redireciona para o painel
    header("Location: painel.php");
    exit();
    
} else {
    // ❌ LOGIN FALHOU
    // Redireciona de volta ao login com mensagem de erro
    header("Location: login.php?erro=credenciais");
    exit();
}
```

**🔍 Pontos-chave deste arquivo:**
- Verifica se a requisição é POST (segurança)
- Sanitiza os dados com `trim()` e `htmlspecialchars()`
- Busca o usuário no array (simulando banco de dados)
- `session_regenerate_id(true)` gera novo ID (segurança contra fixation)
- Armazena dados na `$_SESSION` após login bem-sucedido
- Sempre usa `exit()` após `header("Location: ...")`

---

### 📄 Arquivo 3: `painel.php` — Área Protegida

```php
<?php
/**
 * painel.php — Área Protegida (Dashboard)
 * 
 * Esta página só pode ser acessada por usuários logados.
 * Se não estiver logado, redireciona para o login.
 */

// Inicia a sessão para verificar se o usuário está logado
session_start();

// ─── VERIFICAÇÃO DE AUTENTICAÇÃO ───
// Se NÃO existe a variável 'logado' na sessão, ou se é false...
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    // Redireciona para o login com mensagem de acesso negado
    header("Location: login.php?erro=acesso_negado");
    exit();
}

// Se chegou aqui, o usuário ESTÁ logado!
// Podemos usar os dados da sessão com segurança
$nome = $_SESSION['usuario_nome'];
$email = $_SESSION['usuario_email'];
$hora_login = $_SESSION['login_hora'];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel - Área Protegida</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f2f5;
        }
        .navbar {
            background-color: #007bff;
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            background-color: rgba(255,255,255,0.2);
            padding: 8px 16px;
            border-radius: 4px;
        }
        .navbar a:hover {
            background-color: rgba(255,255,255,0.3);
        }
        .container {
            max-width: 800px;
            margin: 30px auto;
            padding: 0 20px;
        }
        .card {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .card h3 {
            color: #333;
            margin-top: 0;
        }
        .info-item {
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        .info-item:last-child {
            border-bottom: none;
        }
        .info-item strong {
            color: #555;
        }
    </style>
</head>
<body>
    <!-- Barra de navegação com nome do usuário e botão de logout -->
    <div class="navbar">
        <span>👋 Olá, <strong><?php echo htmlspecialchars($nome); ?></strong></span>
        <a href="logout.php">🚪 Sair</a>
    </div>

    <div class="container">
        <div class="card">
            <h3>📊 Painel do Usuário</h3>
            <p>Bem-vindo à área protegida do sistema!</p>
            
            <div class="info-item">
                <strong>👤 Nome:</strong> 
                <?php echo htmlspecialchars($nome); ?>
            </div>
            <div class="info-item">
                <strong>📧 E-mail:</strong> 
                <?php echo htmlspecialchars($email); ?>
            </div>
            <div class="info-item">
                <strong>🕐 Login em:</strong> 
                <?php echo htmlspecialchars($hora_login); ?>
            </div>
            <div class="info-item">
                <strong>🔑 ID da Sessão:</strong> 
                <?php echo session_id(); ?>
            </div>
        </div>

        <div class="card">
            <h3>ℹ️ Sobre as Sessões</h3>
            <p>Esta página está protegida por sessão. Se você tentar 
            acessá-la sem estar logado, será redirecionado para o login.</p>
            <p>Experimente:</p>
            <ul>
                <li>Abrir esta URL em uma aba anônima (sem sessão)</li>
                <li>Clicar em "Sair" e tentar acessar novamente</li>
                <li>Observar o cookie <code>PHPSESSID</code> no navegador</li>
            </ul>
        </div>
    </div>
</body>
</html>
```

**🔍 Pontos-chave deste arquivo:**
- Verifica se `$_SESSION['logado']` existe e é `true`
- Se não estiver logado → redireciona para `login.php`
- Usa `htmlspecialchars()` ao exibir dados (prevenção XSS)
- Mostra informações armazenadas na sessão
- Link de logout para encerrar a sessão

---

### 📄 Arquivo 4: `logout.php` — Destruir a Sessão

```php
<?php
/**
 * logout.php — Encerra a Sessão do Usuário
 * 
 * Este arquivo destrói completamente a sessão,
 * removendo todos os dados e o cookie do navegador.
 */

// Inicia a sessão (necessário para poder destruí-la)
session_start();

// ─── PASSO 1: Limpar todas as variáveis da sessão ───
// Isso esvazia o array $_SESSION
session_unset();

// ─── PASSO 2: Destruir a sessão no servidor ───
// Remove o arquivo de sessão do servidor
session_destroy();

// ─── PASSO 3 (Opcional): Remover o cookie PHPSESSID ───
// Isso garante que o navegador também "esqueça" a sessão
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),       // Nome do cookie (PHPSESSID)
        '',                   // Valor vazio
        time() - 42000,       // Expiração no passado (força remoção)
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// ─── PASSO 4: Redirecionar para o login ───
header("Location: login.php");
exit();
```

**🔍 Pontos-chave deste arquivo:**
- `session_unset()` → esvazia as variáveis
- `session_destroy()` → destrói o arquivo de sessão no servidor
- Remove o cookie `PHPSESSID` do navegador
- Redireciona para a página de login

---

### 🔄 Fluxo Completo do Exemplo

```
┌─────────────┐     POST        ┌────────────────┐    Sessão OK    ┌────────────┐
│  login.php  │ ──────────────► │ autenticar.php │ ──────────────► │ painel.php │
│ (formulário)│  email + senha  │ (valida dados) │  $_SESSION OK   │  (protegido)│
└─────────────┘                 └────────────────┘                 └─────┬──────┘
      ▲                               │                                  │
      │                               │ Erro                             │
      │         ┌──────────────────────┘                                  │
      │         │ ?erro=credenciais                                      │ Logout
      │         ▼                                                        │
      └─────────────────────────────────────────────────────┐            │
                                                             │            ▼
                                                             │    ┌──────────────┐
                                                             │◄───│  logout.php  │
                                                             │    │ (destrói)    │
                                                                  └──────────────┘
```

---

## 🏆 O DESAFIO PRINCIPAL

### 🏢 Sistema de RH com Níveis de Acesso

#### Contexto

Você foi contratado para desenvolver um **sistema web para o departamento de Recursos Humanos** de uma empresa. O sistema deve ter controle de acesso com **4 níveis diferentes de permissão**, onde cada nível possui funcionalidades específicas.

---

### 📊 Níveis de Acesso

```
┌─────────────────────────────────────────────────────────────────────┐
│                    HIERARQUIA DE NÍVEIS DE ACESSO                   │
├─────────────────────────────────────────────────────────────────────┤
│                                                                     │
│   Nível 4 ─── 👑 ADMINISTRADOR                                     │
│   │            • Acesso TOTAL ao sistema                            │
│   │            • Gerenciar usuários e permissões                    │
│   │            • Configurações do sistema                           │
│   │            • Logs de acesso                                     │
│   │                                                                 │
│   Nível 3 ─── 📋 RH (Recursos Humanos)                             │
│   │            • Tudo que o Gerente pode                            │
│   │            • Cadastrar novos funcionários                       │
│   │            • Gerar relatórios gerais                            │
│   │            • Gerenciar benefícios                               │
│   │                                                                 │
│   Nível 2 ─── 👔 GERENTE                                           │
│   │            • Tudo que o Usuário pode                            │
│   │            • Visualizar dados da sua equipe                     │
│   │            • Aprovar férias e atestados                         │
│   │                                                                 │
│   Nível 1 ─── 👤 USUÁRIO (Funcionário Comum)                       │
│                • Visualizar seus próprios dados                     │
│                • Acesso ao perfil pessoal                           │
│                • Visualização de holerites                          │
│                                                                     │
└─────────────────────────────────────────────────────────────────────┘
```

> 💡 **Regra importante:** Cada nível **herda** as permissões dos níveis inferiores. Ou seja, um Administrador (nível 4) pode acessar TUDO que os níveis 1, 2 e 3 acessam.

---

### 📝 Requisitos Funcionais

| #  | Requisito                                    | Descrição                                                                 |
|----|----------------------------------------------|---------------------------------------------------------------------------|
| 1  | Sistema de login                             | Formulário com e-mail e senha                                             |
| 2  | Validação de credenciais                     | Comparar dados informados com os cadastrados                              |
| 3  | Criação de sessão                            | Armazenar ID, nome, e-mail, nível e cargo na `$_SESSION`                  |
| 4  | Verificação de autenticação                  | Toda página protegida deve verificar se há sessão ativa                   |
| 5  | Verificação de nível de acesso               | Cada página deve verificar se o nível do usuário é suficiente             |
| 6  | Redirecionamento por permissão               | Usuário sem permissão deve ser redirecionado com mensagem clara           |
| 7  | Dashboard dinâmico                           | Página inicial mostra opções de acordo com o nível do usuário             |
| 8  | Logout seguro                                | Destrói sessão completamente e redireciona ao login                       |
| 9  | Mensagens de erro                            | Feedback claro para credenciais inválidas, acesso negado, sessão expirada |
| 10 | Proteção contra acesso direto                | Páginas protegidas não podem ser acessadas digitando URL diretamente      |

---

### 📁 Estrutura de Arquivos Sugerida

```
sistema-rh/
│
├── index.php                    ← Página de login (formulário)
├── autenticar.php               ← Processa o login (valida credenciais)
├── logout.php                   ← Encerra a sessão
│
├── includes/                    ← Arquivos auxiliares (não acessados diretamente)
│   ├── config.php               ← Configurações e dados dos usuários
│   ├── verificar_sessao.php     ← Verifica se está logado
│   └── verificar_nivel.php      ← Verifica nível de acesso
│
├── pages/                       ← Páginas do sistema (protegidas)
│   ├── dashboard.php            ← Página inicial após login
│   ├── perfil.php               ← Perfil pessoal (nível 1+)
│   ├── equipe.php               ← Dados da equipe (nível 2+)
│   ├── cadastro.php             ← Cadastro de funcionários (nível 3+)
│   └── admin.php                ← Painel administrativo (nível 4 apenas)
│
└── css/
    └── style.css                ← Estilos (opcional)
```

---

### 💾 Dados de Teste (Hardcoded)

Use estes dados no arquivo `includes/config.php`:

```php
<?php
/**
 * config.php — Configurações e Dados do Sistema
 * 
 * Em um sistema real, esses dados viriam de um banco de dados (MySQL, PostgreSQL, etc.)
 * Para fins didáticos, usamos arrays hardcoded.
 * 
 * ⚠️ ATENÇÃO: Em produção, NUNCA armazene senhas em texto puro!
 * Use password_hash() para criptografar e password_verify() para validar.
 */

// ─── NOME DO SISTEMA ───
define('NOME_SISTEMA', 'RH System - Gestão de Pessoas');

// ─── TEMPO MÁXIMO DE SESSÃO (em segundos) ───
// 1800 segundos = 30 minutos
define('TEMPO_SESSAO', 1800);

// ─── NÍVEIS DE ACESSO ───
// Constantes para evitar "números mágicos" no código
define('NIVEL_USUARIO', 1);
define('NIVEL_GERENTE', 2);
define('NIVEL_RH', 3);
define('NIVEL_ADMIN', 4);

// ─── NOMES DOS NÍVEIS (para exibição) ───
$nomes_niveis = [
    1 => '👤 Funcionário',
    2 => '👔 Gerente',
    3 => '📋 RH',
    4 => '👑 Administrador'
];

// ─── BANCO DE DADOS SIMULADO ───
// Array com 4 usuários, um de cada nível
$usuarios = [
    [
        'id'    => 1,
        'nome'  => 'João Silva',
        'email' => 'joao@empresa.com',
        'senha' => '123456',        // Em produção: password_hash('123456', PASSWORD_DEFAULT)
        'nivel' => NIVEL_USUARIO,    // Nível 1 — Funcionário
        'cargo' => 'Analista de Sistemas',
        'setor' => 'Tecnologia'
    ],
    [
        'id'    => 2,
        'nome'  => 'Maria Oliveira',
        'email' => 'maria@empresa.com',
        'senha' => '123456',
        'nivel' => NIVEL_GERENTE,    // Nível 2 — Gerente
        'cargo' => 'Gerente de Projetos',
        'setor' => 'Tecnologia'
    ],
    [
        'id'    => 3,
        'nome'  => 'Carlos Souza',
        'email' => 'carlos@empresa.com',
        'senha' => '123456',
        'nivel' => NIVEL_RH,         // Nível 3 — RH
        'cargo' => 'Analista de RH Sênior',
        'setor' => 'Recursos Humanos'
    ],
    [
        'id'    => 4,
        'nome'  => 'Ana Costa',
        'email' => 'ana@empresa.com',
        'senha' => '123456',
        'nivel' => NIVEL_ADMIN,      // Nível 4 — Administrador
        'cargo' => 'Diretora de TI',
        'setor' => 'Diretoria'
    ]
];
```

> 📌 **Tabela resumo dos usuários de teste:**

| E-mail               | Senha    | Nível | Cargo                     |
|----------------------|----------|-------|---------------------------|
| joao@empresa.com     | 123456   | 1     | Analista de Sistemas      |
| maria@empresa.com    | 123456   | 2     | Gerente de Projetos       |
| carlos@empresa.com   | 123456   | 3     | Analista de RH Sênior     |
| ana@empresa.com      | 123456   | 4     | Diretora de TI            |

---

### 🧩 Código Inicial (Templates)

A seguir estão os **códigos iniciais completos e bem comentados** para guiar seu desenvolvimento.

---

#### 📄 `index.php` — Página de Login

```php
<?php
/**
 * index.php — Página de Login do Sistema de RH
 * 
 * Exibe o formulário de login.
 * Se já estiver logado, redireciona para o dashboard.
 */

// ─── INICIA A SESSÃO ───
session_start();

// ─── VERIFICA SE JÁ ESTÁ LOGADO ───
// Se a variável de sessão 'logado' existe e é true,
// o usuário já está autenticado — redireciona para o dashboard
if (isset($_SESSION['logado']) && $_SESSION['logado'] === true) {
    header("Location: pages/dashboard.php");
    exit();
}

// ─── CAPTURA MENSAGENS DE FEEDBACK ───
// Mensagens vêm via query string (GET) do autenticar.php ou de páginas protegidas
$mensagem = '';
$tipo_mensagem = ''; // 'erro' ou 'info'

if (isset($_GET['erro'])) {
    $tipo_mensagem = 'erro';
    switch ($_GET['erro']) {
        case 'credenciais':
            $mensagem = '❌ E-mail ou senha incorretos. Tente novamente.';
            break;
        case 'campos_vazios':
            $mensagem = '⚠️ Preencha todos os campos.';
            break;
        default:
            $mensagem = '❌ Ocorreu um erro. Tente novamente.';
    }
}

if (isset($_GET['msg'])) {
    switch ($_GET['msg']) {
        case 'logout':
            $tipo_mensagem = 'info';
            $mensagem = '✅ Você saiu do sistema com sucesso.';
            break;
        case 'sessao_expirada':
            $tipo_mensagem = 'erro';
            $mensagem = '⏰ Sua sessão expirou. Faça login novamente.';
            break;
        case 'acesso_negado':
            $tipo_mensagem = 'erro';
            $mensagem = '🚫 Você não tem permissão para acessar essa página.';
            break;
        case 'nao_logado':
            $tipo_mensagem = 'erro';
            $mensagem = '🔒 Você precisa fazer login para acessar o sistema.';
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - <?php echo NOME_SISTEMA ?? 'Sistema RH'; ?></title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-container {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 420px;
        }
        .login-container h1 {
            text-align: center;
            color: #333;
            margin-bottom: 10px;
            font-size: 24px;
        }
        .login-container .subtitulo {
            text-align: center;
            color: #777;
            margin-bottom: 30px;
            font-size: 14px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            color: #444;
            font-size: 14px;
        }
        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 15px;
            transition: border-color 0.3s;
        }
        .form-group input:focus {
            outline: none;
            border-color: #667eea;
        }
        .btn-login {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: opacity 0.3s;
        }
        .btn-login:hover {
            opacity: 0.9;
        }
        .msg-erro {
            background-color: #fee;
            color: #c33;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            font-size: 14px;
            border: 1px solid #fcc;
        }
        .msg-info {
            background-color: #e8f5e9;
            color: #2e7d32;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            font-size: 14px;
            border: 1px solid #c8e6c9;
        }
        .credenciais {
            margin-top: 25px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 8px;
            font-size: 12px;
            color: #666;
        }
        .credenciais h4 {
            margin-bottom: 8px;
            color: #444;
        }
        .credenciais code {
            background-color: #e9ecef;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 11px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>🏢 Sistema de RH</h1>
        <p class="subtitulo">Faça login para acessar o sistema</p>

        <!-- Mensagem de feedback (erro ou informação) -->
        <?php if (!empty($mensagem)): ?>
            <div class="msg-<?php echo $tipo_mensagem; ?>">
                <?php echo $mensagem; ?>
            </div>
        <?php endif; ?>

        <!-- Formulário de login -->
        <form action="autenticar.php" method="POST">
            <div class="form-group">
                <label for="email">📧 E-mail</label>
                <input type="email" id="email" name="email" 
                       placeholder="seu.email@empresa.com" required
                       autocomplete="email">
            </div>

            <div class="form-group">
                <label for="senha">🔑 Senha</label>
                <input type="password" id="senha" name="senha" 
                       placeholder="Digite sua senha" required
                       autocomplete="current-password">
            </div>

            <button type="submit" class="btn-login">🔐 Entrar no Sistema</button>
        </form>

        <!-- Dica com credenciais de teste (remover em produção!) -->
        <div class="credenciais">
            <h4>🧪 Credenciais de Teste:</h4>
            <p>👤 Funcionário: <code>joao@empresa.com</code></p>
            <p>👔 Gerente: <code>maria@empresa.com</code></p>
            <p>📋 RH: <code>carlos@empresa.com</code></p>
            <p>👑 Admin: <code>ana@empresa.com</code></p>
            <p>🔑 Senha (todos): <code>123456</code></p>
        </div>
    </div>
</body>
</html>
```

---

#### 📄 `autenticar.php` — Lógica de Autenticação

```php
<?php
/**
 * autenticar.php — Processa o Login do Sistema de RH
 * 
 * Recebe as credenciais via POST, valida contra os dados
 * do config.php e cria a sessão com informações do usuário
 * incluindo o nível de acesso.
 */

// ─── INICIA A SESSÃO ───
session_start();

// ─── CARREGA AS CONFIGURAÇÕES E DADOS ───
// O arquivo config.php contém o array $usuarios e as constantes
require_once 'includes/config.php';

// ─── VERIFICA MÉTODO HTTP ───
// O formulário deve enviar via POST. Se alguém tentar acessar
// diretamente pela URL (GET), redireciona para o login.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit();
}

// ─── RECEBE OS DADOS DO FORMULÁRIO ───
// trim() → remove espaços em branco extras
// filter_input() → filtra e sanitiza o e-mail
$email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
$senha = trim($_POST['senha'] ?? '');

// ─── VALIDAÇÃO: Campos não podem estar vazios ───
if (empty($email) || empty($senha)) {
    header("Location: index.php?erro=campos_vazios");
    exit();
}

// ─── BUSCA O USUÁRIO NO "BANCO DE DADOS" ───
$usuario_encontrado = null;

foreach ($usuarios as $usuario) {
    // Compara o e-mail (ignorando maiúsculas/minúsculas)
    // e verifica se a senha confere
    if (strtolower($usuario['email']) === strtolower($email)) {
        
        // ─── VERIFICAÇÃO DA SENHA ───
        // Aqui estamos comparando texto puro (APENAS para fins didáticos!)
        // Em produção, use: password_verify($senha, $usuario['senha_hash'])
        if ($usuario['senha'] === $senha) {
            $usuario_encontrado = $usuario;
        }
        break; // E-mail encontrado, não precisa continuar
    }
}

// ─── RESULTADO DA AUTENTICAÇÃO ───
if ($usuario_encontrado !== null) {
    
    // ✅ SUCESSO — Credenciais válidas!
    
    // 🔄 Regenera o ID da sessão (segurança contra session fixation)
    session_regenerate_id(true);
    
    // 📝 Armazena os dados do usuário na sessão
    $_SESSION['logado']         = true;
    $_SESSION['usuario_id']     = $usuario_encontrado['id'];
    $_SESSION['usuario_nome']   = $usuario_encontrado['nome'];
    $_SESSION['usuario_email']  = $usuario_encontrado['email'];
    $_SESSION['usuario_nivel']  = $usuario_encontrado['nivel'];  // ⭐ NÍVEL DE ACESSO!
    $_SESSION['usuario_cargo']  = $usuario_encontrado['cargo'];
    $_SESSION['usuario_setor']  = $usuario_encontrado['setor'];
    $_SESSION['login_hora']     = date('d/m/Y H:i:s');
    $_SESSION['ultimo_acesso']  = time(); // Para controle de timeout
    
    // 🔀 Redireciona para o dashboard
    header("Location: pages/dashboard.php");
    exit();
    
} else {
    
    // ❌ FALHA — Credenciais inválidas
    header("Location: index.php?erro=credenciais");
    exit();
}
```

---

#### 📄 `includes/verificar_sessao.php` — Verifica Autenticação

```php
<?php
/**
 * verificar_sessao.php — Verifica se o Usuário Está Logado
 * 
 * Este arquivo deve ser incluído (require_once) no TOPO
 * de TODAS as páginas que precisam de autenticação.
 * 
 * O que ele faz:
 * 1. Inicia a sessão (se ainda não foi iniciada)
 * 2. Verifica se existe sessão ativa (usuário logado)
 * 3. Verifica se a sessão não expirou (timeout)
 * 4. Atualiza o timestamp do último acesso
 * 5. Se não estiver logado ou sessão expirou → redireciona para login
 * 
 * USO:
 *   <?php require_once '../includes/verificar_sessao.php'; ?>
 */

// ─── INICIA SESSÃO (se ainda não iniciada) ───
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ─── CARREGA CONFIGURAÇÕES ───
// __DIR__ garante o caminho correto independente de onde o arquivo é incluído
require_once __DIR__ . '/config.php';

// ─── VERIFICAÇÃO 1: Sessão existe? ───
// Verifica se a variável 'logado' existe e é true
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    // Não está logado! Redireciona para o login
    header("Location: ../index.php?msg=nao_logado");
    exit();
}

// ─── VERIFICAÇÃO 2: Sessão expirou? ───
// Verifica quanto tempo se passou desde o último acesso
if (isset($_SESSION['ultimo_acesso'])) {
    $tempo_inativo = time() - $_SESSION['ultimo_acesso'];
    
    if ($tempo_inativo > TEMPO_SESSAO) {
        // Sessão expirou por inatividade!
        session_unset();
        session_destroy();
        header("Location: ../index.php?msg=sessao_expirada");
        exit();
    }
}

// ─── ATUALIZA TIMESTAMP ───
// Renova o contador de inatividade
$_SESSION['ultimo_acesso'] = time();
```

---

#### 📄 `includes/verificar_nivel.php` — Verifica Nível de Acesso

```php
<?php
/**
 * verificar_nivel.php — Verifica o Nível de Acesso do Usuário
 * 
 * Contém a função verificarNivel() que checa se o nível
 * do usuário logado é suficiente para acessar uma página.
 * 
 * LÓGICA:
 * - Cada página exige um nível MÍNIMO
 * - Usuários com nível MAIOR ou IGUAL podem acessar
 * - Exemplo: página exige nível 2
 *   • Nível 1 → ❌ Acesso negado
 *   • Nível 2 → ✅ Acesso permitido
 *   • Nível 3 → ✅ Acesso permitido
 *   • Nível 4 → ✅ Acesso permitido
 * 
 * USO:
 *   require_once '../includes/verificar_nivel.php';
 *   verificarNivel(NIVEL_GERENTE); // Exige nível 2+
 */

/**
 * Verifica se o usuário tem o nível de acesso mínimo necessário.
 * 
 * @param int $nivel_minimo O nível mínimo exigido para acessar a página
 *                          Use as constantes: NIVEL_USUARIO (1), 
 *                          NIVEL_GERENTE (2), NIVEL_RH (3), NIVEL_ADMIN (4)
 * @return void Redireciona e encerra se não tiver permissão
 */
function verificarNivel(int $nivel_minimo): void {
    
    // Verifica se o nível do usuário está definido na sessão
    if (!isset($_SESSION['usuario_nivel'])) {
        // Sessão corrompida ou incompleta
        header("Location: ../index.php?msg=nao_logado");
        exit();
    }
    
    // Obtém o nível do usuário logado
    $nivel_usuario = (int) $_SESSION['usuario_nivel'];
    
    // Compara: nível do usuário deve ser >= nível exigido
    if ($nivel_usuario < $nivel_minimo) {
        // ❌ Acesso negado! Nível insuficiente
        header("Location: ../pages/dashboard.php?msg=acesso_negado");
        exit();
    }
    
    // ✅ Se chegou aqui, o acesso é permitido!
    // A página continua normalmente
}

/**
 * Verifica se o usuário tem um nível EXATO (não superior).
 * Útil para páginas exclusivas de um nível específico.
 * 
 * @param int $nivel_exato O nível exato exigido
 * @return void
 */
function verificarNivelExato(int $nivel_exato): void {
    if (!isset($_SESSION['usuario_nivel'])) {
        header("Location: ../index.php?msg=nao_logado");
        exit();
    }
    
    if ((int) $_SESSION['usuario_nivel'] !== $nivel_exato) {
        header("Location: ../pages/dashboard.php?msg=acesso_negado");
        exit();
    }
}

/**
 * Retorna o nome amigável do nível de acesso.
 * 
 * @param int $nivel Número do nível (1-4)
 * @return string Nome do nível com emoji
 */
function getNomeNivel(int $nivel): string {
    $nomes = [
        1 => '👤 Funcionário',
        2 => '👔 Gerente',
        3 => '📋 RH',
        4 => '👑 Administrador'
    ];
    
    return $nomes[$nivel] ?? '❓ Desconhecido';
}
```

---

#### 📄 `pages/dashboard.php` — Dashboard com Conteúdo por Nível

```php
<?php
/**
 * dashboard.php — Página Inicial do Sistema (após login)
 * 
 * Esta página mostra um painel personalizado de acordo com
 * o nível de acesso do usuário logado.
 * 
 * Fluxo:
 * 1. Inclui verificar_sessao.php → garante que está logado
 * 2. Inclui verificar_nivel.php → para usar getNomeNivel()
 * 3. Exibe menu e cards de acordo com o nível
 */

// ─── PROTEÇÃO: Verifica se está logado ───
require_once '../includes/verificar_sessao.php';

// ─── CARREGA FUNÇÕES DE NÍVEL ───
require_once '../includes/verificar_nivel.php';

// ─── DADOS DO USUÁRIO LOGADO (vindos da sessão) ───
$nome  = htmlspecialchars($_SESSION['usuario_nome']);
$email = htmlspecialchars($_SESSION['usuario_email']);
$cargo = htmlspecialchars($_SESSION['usuario_cargo']);
$setor = htmlspecialchars($_SESSION['usuario_setor']);
$nivel = (int) $_SESSION['usuario_nivel'];
$hora_login = $_SESSION['login_hora'];

// ─── MENSAGEM DE FEEDBACK ───
$msg_feedback = '';
if (isset($_GET['msg']) && $_GET['msg'] === 'acesso_negado') {
    $msg_feedback = '🚫 Você não tem permissão para acessar a página solicitada.';
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistema de RH</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            color: #333;
        }

        /* ── Barra de Navegação ── */
        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .navbar .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .navbar .badge {
            background-color: rgba(255,255,255,0.2);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            background-color: rgba(255,255,255,0.15);
            padding: 8px 20px;
            border-radius: 6px;
            transition: background-color 0.3s;
        }
        .navbar a:hover {
            background-color: rgba(255,255,255,0.3);
        }

        /* ── Container Principal ── */
        .container {
            max-width: 1000px;
            margin: 30px auto;
            padding: 0 20px;
        }

        /* ── Cards de Menu ── */
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .menu-card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            transition: transform 0.2s, box-shadow 0.2s;
            text-decoration: none;
            color: #333;
            display: block;
        }
        .menu-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
        }
        .menu-card .icon {
            font-size: 36px;
            margin-bottom: 10px;
        }
        .menu-card h3 {
            margin-bottom: 8px;
            color: #444;
        }
        .menu-card p {
            color: #777;
            font-size: 14px;
            line-height: 1.5;
        }
        .menu-card .nivel-tag {
            display: inline-block;
            margin-top: 10px;
            padding: 3px 10px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
        }
        .tag-nivel1 { background: #e3f2fd; color: #1565c0; }
        .tag-nivel2 { background: #e8f5e9; color: #2e7d32; }
        .tag-nivel3 { background: #fff3e0; color: #e65100; }
        .tag-nivel4 { background: #fce4ec; color: #c62828; }

        /* ── Bem-vindo ── */
        .welcome-card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }
        .welcome-card h2 {
            margin-bottom: 5px;
        }
        .welcome-card .info {
            color: #777;
            font-size: 14px;
        }

        /* ── Alerta ── */
        .alerta {
            background-color: #fff3e0;
            color: #e65100;
            padding: 12px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid #ffe0b2;
        }
    </style>
</head>
<body>
    <!-- ═══ BARRA DE NAVEGAÇÃO ═══ -->
    <div class="navbar">
        <div class="user-info">
            <span>👋 <strong><?php echo $nome; ?></strong></span>
            <span class="badge"><?php echo getNomeNivel($nivel); ?></span>
        </div>
        <a href="../logout.php">🚪 Sair</a>
    </div>

    <div class="container">
        <!-- Mensagem de feedback -->
        <?php if (!empty($msg_feedback)): ?>
            <div class="alerta"><?php echo $msg_feedback; ?></div>
        <?php endif; ?>

        <!-- ═══ CARD DE BOAS-VINDAS ═══ -->
        <div class="welcome-card">
            <h2>📊 Dashboard</h2>
            <p class="info">
                <?php echo $cargo; ?> — <?php echo $setor; ?> | 
                Login: <?php echo $hora_login; ?>
            </p>
        </div>

        <!-- ═══ GRID DE MENUS ═══ -->
        <div class="menu-grid">

            <!-- ── NÍVEL 1+ (Todos podem ver) ── -->
            <a href="perfil.php" class="menu-card">
                <div class="icon">👤</div>
                <h3>Meu Perfil</h3>
                <p>Visualize e edite suas informações pessoais e dados cadastrais.</p>
                <span class="nivel-tag tag-nivel1">Nível 1+</span>
            </a>

            <a href="#" class="menu-card">
                <div class="icon">💰</div>
                <h3>Meus Holerites</h3>
                <p>Consulte seus contracheques e comprovantes de pagamento.</p>
                <span class="nivel-tag tag-nivel1">Nível 1+</span>
            </a>

            <!-- ── NÍVEL 2+ (Gerente ou superior) ── -->
            <?php if ($nivel >= NIVEL_GERENTE): ?>
            <a href="equipe.php" class="menu-card">
                <div class="icon">👥</div>
                <h3>Minha Equipe</h3>
                <p>Visualize os dados dos membros da sua equipe.</p>
                <span class="nivel-tag tag-nivel2">Nível 2+</span>
            </a>

            <a href="#" class="menu-card">
                <div class="icon">📅</div>
                <h3>Férias e Atestados</h3>
                <p>Aprove solicitações de férias e atestados médicos.</p>
                <span class="nivel-tag tag-nivel2">Nível 2+</span>
            </a>
            <?php endif; ?>

            <!-- ── NÍVEL 3+ (RH ou superior) ── -->
            <?php if ($nivel >= NIVEL_RH): ?>
            <a href="cadastro.php" class="menu-card">
                <div class="icon">📝</div>
                <h3>Cadastrar Funcionário</h3>
                <p>Cadastre novos funcionários no sistema.</p>
                <span class="nivel-tag tag-nivel3">Nível 3+</span>
            </a>

            <a href="#" class="menu-card">
                <div class="icon">📊</div>
                <h3>Relatórios</h3>
                <p>Gere relatórios gerais de RH e benefícios.</p>
                <span class="nivel-tag tag-nivel3">Nível 3+</span>
            </a>
            <?php endif; ?>

            <!-- ── NÍVEL 4 (Somente Admin) ── -->
            <?php if ($nivel >= NIVEL_ADMIN): ?>
            <a href="admin.php" class="menu-card">
                <div class="icon">⚙️</div>
                <h3>Administração</h3>
                <p>Gerencie usuários, permissões e configurações do sistema.</p>
                <span class="nivel-tag tag-nivel4">Nível 4</span>
            </a>

            <a href="#" class="menu-card">
                <div class="icon">📋</div>
                <h3>Logs de Acesso</h3>
                <p>Visualize o histórico de logins e ações no sistema.</p>
                <span class="nivel-tag tag-nivel4">Nível 4</span>
            </a>
            <?php endif; ?>

        </div><!-- /menu-grid -->
    </div><!-- /container -->
</body>
</html>
```

---

#### 📄 `logout.php` — Encerramento Seguro da Sessão

```php
<?php
/**
 * logout.php — Encerra a Sessão do Sistema de RH
 * 
 * Realiza 4 passos para um logout completo e seguro:
 * 1. Inicia a sessão (para poder destruí-la)
 * 2. Limpa todas as variáveis
 * 3. Destrói a sessão no servidor
 * 4. Remove o cookie do navegador
 */

// Passo 1: Inicia a sessão
session_start();

// Passo 2: Limpa as variáveis
session_unset();

// Passo 3: Destrói a sessão
session_destroy();

// Passo 4: Remove o cookie PHPSESSID
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Redireciona para o login com mensagem de sucesso
header("Location: index.php?msg=logout");
exit();
```

---

## 💡 Dicas e Boas Práticas

### ✅ O que FAZER:

| #  | Prática                                        | Explicação                                                    |
|----|------------------------------------------------|---------------------------------------------------------------|
| 1  | `session_start()` no topo de TODA página       | Deve ser antes de qualquer saída HTML                         |
| 2  | Usar `exit()` após `header("Location: ...")`   | Garante que o código para de executar após redirecionamento   |
| 3  | Sanitizar dados: `htmlspecialchars()`           | Previne ataques XSS (Cross-Site Scripting)                    |
| 4  | Usar `session_regenerate_id(true)` no login     | Previne ataques de session fixation                           |
| 5  | Verificar sessão em TODAS as páginas protegidas | Impede acesso direto via URL                                  |
| 6  | Usar `password_hash()` em produção              | Nunca armazene senhas em texto puro                           |
| 7  | Implementar timeout de inatividade              | Sessões não devem durar para sempre                           |
| 8  | Usar constantes para níveis (`NIVEL_ADMIN`)     | Evita "números mágicos" e torna o código mais legível         |

### ❌ O que NÃO FAZER:

| #  | Prática Ruim                              | Por quê                                                        |
|----|-------------------------------------------|----------------------------------------------------------------|
| 1  | Esquecer `session_start()`                | A sessão simplesmente não funciona                             |
| 2  | Guardar senha na sessão                   | Dados da sessão ficam no servidor, mas é desnecessário         |
| 3  | Confiar em dados da sessão sem validar    | Sempre verifique se os dados existem antes de usar             |
| 4  | Usar apenas `session_destroy()` no logout | Sem `session_unset()`, as variáveis podem persistir            |
| 5  | Comparar nível com `==` ao invés de `>=`  | Um admin (nível 4) deve acessar tudo, não só nível 4           |

---

## 📊 Critérios de Avaliação

| Critério                                         | Pontos | Descrição                                                          |
|--------------------------------------------------|--------|--------------------------------------------------------------------|
| **Login funcional**                              | 15     | Formulário envia dados e autentica corretamente                    |
| **Sessão criada corretamente**                   | 15     | Armazena ID, nome, e-mail, nível e cargo na sessão                |
| **Verificação de sessão ativa**                  | 10     | Páginas protegidas redirecionam se não logado                      |
| **Verificação de nível de acesso**               | 20     | Cada página verifica o nível mínimo e bloqueia se insuficiente     |
| **Dashboard dinâmico**                           | 15     | Conteúdo muda conforme o nível do usuário                         |
| **Logout completo**                              | 10     | Destrói sessão, limpa variáveis e remove cookie                   |
| **Mensagens de feedback**                        | 5      | Erro no login, acesso negado, sessão expirada, logout             |
| **Código organizado e comentado**                | 5      | Estrutura de pastas, indentação, comentários úteis                 |
| **Boas práticas de segurança**                   | 5      | Sanitização, regenerate_id, verificação de método POST            |
| **TOTAL**                                        | **100**|                                                                    |

---

## 🌟 Desafios Extras (Opcional — Pontos Bônus)

Para alunos que quiserem ir além do básico:

### 🏅 Desafio Extra 1: "Lembrar-me" com Cookies (+10 pontos)
Adicione um checkbox "Lembrar-me" no login. Se marcado, crie um cookie que dure 30 dias para que o usuário não precise fazer login toda vez.

```php
// Dica: No autenticar.php, após login bem-sucedido
if (isset($_POST['lembrar']) && $_POST['lembrar'] === 'sim') {
    // Cria cookie com token seguro que dura 30 dias
    $token = bin2hex(random_bytes(32));
    setcookie('lembrar_token', $token, time() + (86400 * 30), '/');
    // Armazene o token associado ao ID do usuário
}
```

### 🏅 Desafio Extra 2: Timeout de Inatividade Visível (+5 pontos)
Mostre um contador regressivo na tela que avisa o usuário quando a sessão está prestes a expirar (ex: "Sua sessão expira em 5 minutos").

### 🏅 Desafio Extra 3: Log de Acessos (+10 pontos)
Crie um arquivo de log (`logs/acessos.txt`) que registre cada login e logout com data/hora, nome do usuário e IP. Na página de admin (nível 4), exiba esses logs.

```php
// Dica: Função para registrar log
function registrarLog(string $acao, string $usuario, string $email): void {
    $linha = date('Y-m-d H:i:s') . " | {$acao} | {$usuario} | {$email} | " 
             . $_SERVER['REMOTE_ADDR'] . PHP_EOL;
    file_put_contents(__DIR__ . '/../logs/acessos.txt', $linha, FILE_APPEND);
}
```

### 🏅 Desafio Extra 4: Campo "Último Acesso" (+5 pontos)
Armazene a data/hora do último login de cada usuário. Ao fazer login novamente, exiba: "Seu último acesso foi em DD/MM/YYYY às HH:MM".

---

## 📚 Recursos Adicionais

### 📖 Documentação Oficial PHP
- [Sessões em PHP](https://www.php.net/manual/pt_BR/book.session.php)
- [session_start()](https://www.php.net/manual/pt_BR/function.session-start.php)
- [$_SESSION](https://www.php.net/manual/pt_BR/reserved.variables.session.php)
- [session_destroy()](https://www.php.net/manual/pt_BR/function.session-destroy.php)
- [session_regenerate_id()](https://www.php.net/manual/pt_BR/function.session-regenerate-id.php)
- [password_hash()](https://www.php.net/manual/pt_BR/function.password-hash.php)
- [password_verify()](https://www.php.net/manual/pt_BR/function.password-verify.php)

### 🎓 Tutoriais Recomendados
- [W3Schools — PHP Sessions](https://www.w3schools.com/php/php_sessions.asp)
- [PHP.net — Segurança em Sessões](https://www.php.net/manual/pt_BR/session.security.php)
- [MDN Web Docs — HTTP Cookies](https://developer.mozilla.org/pt-BR/docs/Web/HTTP/Cookies)

### 🛠️ Ferramentas Úteis
- [XAMPP](https://www.apachefriends.org/) — Ambiente local com Apache + PHP + MySQL
- [VS Code](https://code.visualstudio.com/) — Editor de código com extensões PHP
- [PHP Intelephense](https://marketplace.visualstudio.com/items?itemName=bmewburn.vscode-intelephense-client) — Extensão PHP para VS Code
- [Postman](https://www.postman.com/) — Para testar requisições HTTP

---

> 📌 **Lembre-se:** A melhor forma de aprender é **praticando**! Não copie o código pronto — digite tudo, teste, quebre, conserte. É assim que o aprendizado acontece! 💪

---

*Atividade elaborada para a disciplina de Programação para Internet — ADS*
