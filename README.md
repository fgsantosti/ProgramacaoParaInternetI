# 🐘 PHP — Do Básico ao Avançado

### Disciplina: Programação para Internet
### Curso: Análise e Desenvolvimento de Sistemas

> **Pré-requisitos:** HTML, CSS e JavaScript básico (já estudados anteriormente).

---

## 📋 Sumário

1. [Introdução ao PHP](#1-introdução-ao-php)
2. [Ambiente de Desenvolvimento](#2-ambiente-de-desenvolvimento)
3. [Sintaxe Básica](#3-sintaxe-básica)
4. [Variáveis e Tipos de Dados](#4-variáveis-e-tipos-de-dados)
5. [Operadores](#5-operadores)
6. [Estruturas de Controle](#6-estruturas-de-controle)
7. [Estruturas de Repetição](#7-estruturas-de-repetição)
8. [Arrays](#8-arrays)
9. [Funções](#9-funções)
10. [Manipulação de Strings](#10-manipulação-de-strings)
11. [Formulários e Superglobais](#11-formulários-e-superglobais)
12. [Manipulação de Arquivos](#12-manipulação-de-arquivos)
13. [Sessões e Cookies](#13-sessões-e-cookies)
14. [Programação Orientada a Objetos (POO)](#14-programação-orientada-a-objetos-poo)
15. [Tratamento de Erros e Exceções](#15-tratamento-de-erros-e-exceções)
16. [Banco de Dados com PDO](#16-banco-de-dados-com-pdo)
17. [Segurança em PHP](#17-segurança-em-php)
18. [Namespaces e Autoload](#18-namespaces-e-autoload)
19. [Composer e Gerenciamento de Dependências](#19-composer-e-gerenciamento-de-dependências)
20. [API REST com PHP](#20-api-rest-com-php)
21. [Padrões de Projeto (Design Patterns)](#21-padrões-de-projeto-design-patterns)
22. [Boas Práticas e PSRs](#22-boas-práticas-e-psrs)
23. [Projeto Final Integrador](#23-projeto-final-integrador)

---

## 1. Introdução ao PHP

### 1.1 O que é PHP?

**PHP** (*PHP: Hypertext Preprocessor*) é uma linguagem de programação de código aberto, amplamente utilizada para o desenvolvimento web do lado do servidor (*server-side*). Diferente do JavaScript (que vocês já estudaram e que roda no navegador), o PHP é executado no **servidor** e envia apenas o resultado (HTML) para o navegador do cliente.

### 1.2 Como o PHP funciona?

```
┌──────────┐    Requisição HTTP     ┌──────────────┐
│ Navegador │ ───────────────────▶  │  Servidor Web │
│ (Cliente) │                       │ (Apache/Nginx)│
│           │ ◀──────────────────── │       +       │
│           │    Resposta (HTML)    │  Interpretador │
└──────────┘                       │     PHP        │
                                   └──────────────┘
```

**Fluxo de execução:**
1. O usuário acessa uma página `.php` pelo navegador.
2. O servidor web recebe a requisição e aciona o interpretador PHP.
3. O PHP processa o código, podendo acessar banco de dados, arquivos etc.
4. O resultado (geralmente HTML) é enviado de volta ao navegador.
5. O navegador renderiza o HTML recebido.

### 1.3 Por que aprender PHP?

- 🌐 Utilizado por **mais de 75%** dos sites que usam linguagem server-side (WordPress, Facebook, Wikipedia).
- 📚 Ampla documentação e comunidade ativa.
- 🔧 Integração nativa com diversos bancos de dados (MySQL, PostgreSQL, SQLite).
- 🚀 Frameworks modernos e robustos (Laravel, Symfony, CodeIgniter).
- 💼 Grande demanda no mercado de trabalho.

---

## 2. Ambiente de Desenvolvimento

### 2.1 Ferramentas necessárias

Para desenvolver em PHP, precisamos de:

| Componente          | Descrição                                    | Exemplos            |
|---------------------|----------------------------------------------|---------------------|
| **Servidor Web**    | Recebe requisições HTTP e serve os arquivos   | Apache, Nginx       |
| **Interpretador PHP** | Processa o código PHP                       | PHP 8.x             |
| **Banco de Dados**  | Armazena dados da aplicação                  | MySQL, MariaDB      |
| **Editor de Código** | Ferramenta para escrever o código            | VS Code, PHPStorm   |

### 2.2 Pacotes integrados (tudo-em-um)

A maneira mais simples de configurar o ambiente é utilizar pacotes que já incluem Apache + PHP + MySQL:

- **Windows:** [XAMPP](https://www.apachefriends.org/) ou [WampServer](https://www.wampserver.com/)
- **macOS:** [MAMP](https://www.mamp.info/)
- **Linux:** LAMP (instalação via terminal)

### 2.3 Instalando o XAMPP (passo a passo)

1. Acesse [apachefriends.org](https://www.apachefriends.org/) e baixe a versão correspondente ao seu sistema operacional.
2. Execute o instalador e siga as instruções (mantenha as opções padrão).
3. Após a instalação, abra o **Painel de Controle do XAMPP**.
4. Inicie os módulos **Apache** e **MySQL**.
5. Acesse `http://localhost` no navegador para confirmar que está funcionando.

### 2.4 Onde salvar os arquivos?

Os arquivos PHP devem ser salvos na pasta raiz do servidor:

| Sistema  | Caminho padrão                    |
|----------|-----------------------------------|
| Windows  | `C:\xampp\htdocs\`                |
| macOS    | `/Applications/MAMP/htdocs/`     |
| Linux    | `/var/www/html/`                  |

### 2.5 Primeiro teste — Verificando a instalação

Crie o arquivo `info.php` na pasta `htdocs`:

```php
<?php
phpinfo();
?>
```

Acesse `http://localhost/info.php` no navegador. Se aparecer uma página com informações detalhadas do PHP, a instalação está correta!

> ⚠️ **Atenção:** Remova este arquivo após o teste, pois ele expõe informações sensíveis do servidor.

---

## 3. Sintaxe Básica

### 3.1 Tags de abertura e fechamento

O código PHP é delimitado pelas tags `<?php` e `?>`:

```php
<?php
    // Seu código PHP aqui
?>
```

> 💡 **Dica:** Em arquivos que contêm **apenas** código PHP (sem HTML), é recomendado **omitir** a tag de fechamento `?>` para evitar problemas com espaços em branco.

### 3.2 Incorporando PHP no HTML

Como vocês já conhecem HTML, vejam como o PHP se integra com ele:

```php
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Minha primeira página PHP</title>
</head>
<body>
    <h1>Bem-vindo ao PHP!</h1>
    <p>Hoje é <?php echo date('d/m/Y'); ?></p>
    <p>Hora atual do servidor: <?php echo date('H:i:s'); ?></p>
</body>
</html>
```

**Resultado no navegador:**
> Bem-vindo ao PHP!  
> Hoje é 27/04/2026  
> Hora atual do servidor: 14:30:25

### 3.3 Exibindo dados na tela

Existem diversas formas de exibir informações:

```php
<?php
// echo - a mais utilizada (aceita múltiplos argumentos)
echo "Olá, mundo!";
echo "Nome: ", "João", " - Idade: ", 20;

// print - semelhante ao echo (aceita apenas um argumento)
print "Olá, mundo!";

// Atalho para exibir dentro do HTML
?>
<p>O resultado é: <?= 10 + 5 ?></p>
<!-- <?= é equivalente a <?php echo -->
```

### 3.4 Comentários

```php
<?php
// Comentário de uma linha

# Também é comentário de uma linha

/*
   Comentário de
   múltiplas linhas
*/

/**
 * Comentário de documentação (DocBlock)
 * Usado para documentar funções e classes
 * @param string $nome Nome do usuário
 * @return string Mensagem de saudação
 */
```

### 3.5 Ponto e vírgula

Toda instrução em PHP deve terminar com ponto e vírgula (`;`):

```php
<?php
echo "Primeira linha";   // ✅ Correto
echo "Segunda linha"     // ❌ Erro! Faltou o ponto e vírgula
echo "Terceira linha";   // ✅ Correto
```

### 3.6 Sensibilidade a maiúsculas/minúsculas

```php
<?php
// Palavras-chave, funções e classes NÃO diferenciam maiúsculas/minúsculas
ECHO "Olá!";      // ✅ Funciona
Echo "Olá!";      // ✅ Funciona
echo "Olá!";      // ✅ Funciona

// Variáveis SÃO sensíveis a maiúsculas/minúsculas
$nome = "João";
echo $Nome;        // ❌ Undefined variable (é diferente de $nome)
echo $nome;        // ✅ Correto
```

---

## 4. Variáveis e Tipos de Dados

### 4.1 Declarando variáveis

Em PHP, toda variável começa com o símbolo `$`. Não é necessário declarar o tipo — o PHP determina automaticamente (tipagem dinâmica):

```php
<?php
$nome = "Maria";          // string
$idade = 22;              // inteiro (int)
$altura = 1.68;           // ponto flutuante (float)
$estudante = true;        // booleano (bool)
$cursos = ["PHP", "JS"];  // array
$endereco = null;         // nulo
```

### 4.2 Regras para nomes de variáveis

```php
<?php
// ✅ Nomes válidos
$nome = "Ana";
$_idade = 25;
$nomCompleto = "Ana Silva";
$item2 = "Teclado";

// ❌ Nomes inválidos
$2item = "Mouse";        // Não pode começar com número
$nome completo = "Ana";  // Não pode ter espaço
$minha-var = 10;         // Não pode ter hífen
```

### 4.3 Tipos de dados

PHP possui 8 tipos de dados primitivos:

| Tipo       | Categoria   | Exemplo                        | Descrição                        |
|------------|-------------|--------------------------------|----------------------------------|
| `string`   | Escalar     | `"Olá, mundo!"`                | Texto                            |
| `int`      | Escalar     | `42`                           | Números inteiros                 |
| `float`    | Escalar     | `3.14`                         | Números decimais                 |
| `bool`     | Escalar     | `true`, `false`                | Verdadeiro ou falso              |
| `array`    | Composto    | `[1, 2, 3]`                    | Coleção de valores               |
| `object`   | Composto    | `new Produto()`                | Instância de uma classe          |
| `null`     | Especial    | `null`                         | Ausência de valor                |
| `resource` | Especial    | `fopen("arquivo.txt", "r")`    | Referência a recurso externo     |

### 4.4 Verificando e convertendo tipos

```php
<?php
$valor = "42";

// Verificando o tipo
echo gettype($valor);          // string
var_dump($valor);              // string(2) "42"

// Verificações específicas
var_dump(is_string($valor));   // bool(true)
var_dump(is_int($valor));      // bool(false)
var_dump(is_numeric($valor));  // bool(true) - verifica se "parece" um número

// Conversão de tipos (casting)
$numero = (int) $valor;        // Converte string para inteiro
$decimal = (float) "3.14";    // Converte string para float
$texto = (string) 42;         // Converte inteiro para string
$booleano = (bool) 1;         // Converte para booleano (true)
```

### 4.5 Constantes

Constantes são valores que **não podem ser alterados** após serem definidos:

```php
<?php
// Forma tradicional
define("NOME_SISTEMA", "Loja Virtual ADS");
define("VERSAO", "2.0");
define("MAX_TENTATIVAS_LOGIN", 3);

// Forma moderna (PHP 5.3+)
const TAXA_JUROS = 0.05;
const MOEDA = "BRL";

echo NOME_SISTEMA;  // Loja Virtual ADS (sem $ na frente!)

// Constantes "mágicas" do PHP (predefinidas)
echo __FILE__;       // Caminho completo do arquivo atual
echo __LINE__;       // Número da linha atual
echo __DIR__;        // Diretório do arquivo atual
echo __FUNCTION__;   // Nome da função atual
echo PHP_VERSION;    // Versão do PHP instalada
```

---

## 5. Operadores

### 5.1 Operadores aritméticos

```php
<?php
$a = 10;
$b = 3;

echo $a + $b;   // 13  (adição)
echo $a - $b;   // 7   (subtração)
echo $a * $b;   // 30  (multiplicação)
echo $a / $b;   // 3.333... (divisão)
echo $a % $b;   // 1   (módulo - resto da divisão)
echo $a ** $b;  // 1000 (exponenciação - 10³)

// Exemplo prático: calculando desconto em um produto
$preco = 150.00;
$desconto = 15; // 15%
$precoFinal = $preco - ($preco * $desconto / 100);
echo "Preço final: R$ " . number_format($precoFinal, 2, ',', '.'); 
// Preço final: R$ 127,50
```

### 5.2 Operadores de atribuição

```php
<?php
$x = 10;       // Atribuição simples

$x += 5;       // $x = $x + 5   → 15
$x -= 3;       // $x = $x - 3   → 12
$x *= 2;       // $x = $x * 2   → 24
$x /= 4;       // $x = $x / 4   → 6
$x %= 4;       // $x = $x % 4   → 2
$x .= " reais"; // Concatenação: $x = $x . " reais" → "2 reais"
```

### 5.3 Operadores de comparação

```php
<?php
$a = 5;
$b = "5";

// Comparação simples (compara apenas o valor)
var_dump($a == $b);   // true  (5 é igual a "5" em valor)
var_dump($a != $b);   // false

// Comparação estrita (compara valor E tipo)
var_dump($a === $b);  // false (int !== string)
var_dump($a !== $b);  // true

// Outros operadores de comparação
var_dump($a > 3);     // true
var_dump($a < 3);     // false
var_dump($a >= 5);    // true
var_dump($a <= 4);    // false

// Operador spaceship (PHP 7+) — retorna -1, 0 ou 1
echo 1 <=> 2;   // -1 (menor)
echo 1 <=> 1;   //  0 (igual)
echo 2 <=> 1;   //  1 (maior)

// Operador null coalescing (PHP 7+)
$nome = $_GET['nome'] ?? 'Visitante';
// Se $_GET['nome'] existir e não for null, usa seu valor; senão, usa 'Visitante'
```

> ⚠️ **Importante:** Sempre prefira `===` (comparação estrita) ao invés de `==` para evitar bugs causados pela conversão automática de tipos do PHP.

### 5.4 Operadores lógicos

```php
<?php
$idade = 20;
$temCarteira = true;

// AND (&&) — ambas as condições devem ser verdadeiras
if ($idade >= 18 && $temCarteira) {
    echo "Pode dirigir!";
}

// OR (||) — pelo menos uma condição deve ser verdadeira
$temPix = false;
$temCartao = true;
if ($temPix || $temCartao) {
    echo "Pode pagar!";
}

// NOT (!) — inverte o valor
$bloqueado = false;
if (!$bloqueado) {
    echo "Conta ativa";
}
```

### 5.5 Operador de concatenação

```php
<?php
$nome = "Carlos";
$sobrenome = "Silva";

// Concatenação com ponto (.)
$nomeCompleto = $nome . " " . $sobrenome;
echo $nomeCompleto;  // Carlos Silva

// Interpolação em aspas duplas (mais prático)
echo "Olá, $nome $sobrenome!";           // Olá, Carlos Silva!
echo "Olá, {$nome} {$sobrenome}!";       // Olá, Carlos Silva! (com chaves para clareza)

// Aspas simples NÃO interpretam variáveis
echo 'Olá, $nome';  // Olá, $nome (literal)
```

---

## 6. Estruturas de Controle

### 6.1 if / else / elseif

```php
<?php
$nota = 7.5;

if ($nota >= 7.0) {
    echo "Aprovado! ✅";
} elseif ($nota >= 5.0) {
    echo "Recuperação ⚠️";
} else {
    echo "Reprovado ❌";
}
```

**Exemplo contextualizado — Sistema de notas com conceito:**

```php
<?php
$nota = 8.5;
$frequencia = 80; // percentual

if ($frequencia < 75) {
    $situacao = "Reprovado por falta";
    $conceito = "RF";
} elseif ($nota >= 9.0) {
    $situacao = "Aprovado";
    $conceito = "A";
} elseif ($nota >= 7.0) {
    $situacao = "Aprovado";
    $conceito = "B";
} elseif ($nota >= 5.0) {
    $situacao = "Recuperação";
    $conceito = "C";
} else {
    $situacao = "Reprovado";
    $conceito = "D";
}

echo "Nota: $nota | Frequência: $frequencia% | Conceito: $conceito | Situação: $situacao";
// Nota: 8.5 | Frequência: 80% | Conceito: B | Situação: Aprovado
```

### 6.2 Operador ternário

Uma forma simplificada de `if/else` para atribuições:

```php
<?php
$idade = 17;

// Sintaxe: condição ? valor_se_verdadeiro : valor_se_falso
$categoria = ($idade >= 18) ? "Adulto" : "Menor de idade";
echo $categoria;  // Menor de idade

// Exemplo prático: exibir mensagem de estoque
$quantidade = 0;
$status = ($quantidade > 0) ? "Em estoque ($quantidade un.)" : "Esgotado";
echo $status;  // Esgotado
```

### 6.3 switch

Ideal quando uma variável pode assumir muitos valores distintos:

```php
<?php
$diaSemana = date('l'); // Retorna o dia da semana em inglês

switch ($diaSemana) {
    case 'Monday':
        echo "Segunda-feira — Início da semana! 💪";
        break;
    case 'Tuesday':
        echo "Terça-feira — Mantenha o ritmo!";
        break;
    case 'Wednesday':
        echo "Quarta-feira — Metade da semana!";
        break;
    case 'Thursday':
        echo "Quinta-feira — Quase lá!";
        break;
    case 'Friday':
        echo "Sexta-feira — Finalmente! 🎉";
        break;
    case 'Saturday':
    case 'Sunday':
        echo "Fim de semana — Aproveite! 🏖️";
        break;
    default:
        echo "Dia não reconhecido.";
}
```

> ⚠️ **Não esqueça o `break`!** Sem ele, o PHP continua executando os `case` seguintes (comportamento chamado *fall-through*).

### 6.4 match (PHP 8+)

O `match` é uma versão moderna e mais segura do `switch`:

```php
<?php
$statusCode = 404;

$mensagem = match ($statusCode) {
    200 => "OK — Requisição bem-sucedida",
    301 => "Movido permanentemente",
    404 => "Página não encontrada",
    500 => "Erro interno do servidor",
    default => "Status desconhecido",
};

echo $mensagem;  // Página não encontrada
```

**Diferenças em relação ao `switch`:**
- Usa comparação **estrita** (`===`).
- Não precisa de `break`.
- Retorna um valor (pode ser atribuído a uma variável).
- Lança `UnhandledMatchError` se nenhum caso combinar e não houver `default`.

---

## 7. Estruturas de Repetição

### 7.1 for

Usado quando sabemos **quantas vezes** o loop deve executar:

```php
<?php
// Contando de 1 a 10
for ($i = 1; $i <= 10; $i++) {
    echo "$i ";
}
// Saída: 1 2 3 4 5 6 7 8 9 10

// Exemplo prático: gerando uma tabela HTML de multiplicação
echo "<table border='1'>";
echo "<tr><th colspan='11'>Tabuada do 7</th></tr>";
for ($i = 1; $i <= 10; $i++) {
    $resultado = 7 * $i;
    echo "<tr><td>7 × $i</td><td>=</td><td>$resultado</td></tr>";
}
echo "</table>";
```

### 7.2 while

Usado quando **não sabemos** quantas repetições serão necessárias:

```php
<?php
// Exemplo: simulando um caixa eletrônico
$saldo = 1000.00;
$saques = [200, 150, 300, 500]; // tentativas de saque
$indice = 0;

echo "Saldo inicial: R$ " . number_format($saldo, 2, ',', '.') . "<br>";

while ($indice < count($saques) && $saldo > 0) {
    $valorSaque = $saques[$indice];
    
    if ($valorSaque <= $saldo) {
        $saldo -= $valorSaque;
        echo "✅ Saque de R$ {$valorSaque} realizado. Saldo: R$ " 
             . number_format($saldo, 2, ',', '.') . "<br>";
    } else {
        echo "❌ Saque de R$ {$valorSaque} negado. Saldo insuficiente.<br>";
    }
    
    $indice++;
}

echo "Saldo final: R$ " . number_format($saldo, 2, ',', '.'); 
```

### 7.3 do...while

Garante que o bloco execute **pelo menos uma vez**:

```php
<?php
// Exemplo: menu de opções (sempre mostra pelo menos uma vez)
$opcao = 0;

do {
    echo "===== MENU =====\n";
    echo "1 - Cadastrar produto\n";
    echo "2 - Listar produtos\n";
    echo "3 - Buscar produto\n";
    echo "0 - Sair\n";
    echo "================\n";
    
    // Em um sistema real, $opcao viria de um input
    $opcao = 0; // Simulando a escolha "Sair"
    
} while ($opcao != 0);

echo "Sistema encerrado.";
```

### 7.4 foreach

A estrutura **mais usada** para percorrer arrays:

```php
<?php
// Array simples
$linguagens = ["PHP", "JavaScript", "Python", "Java"];

echo "<h3>Linguagens de Programação:</h3>";
echo "<ul>";
foreach ($linguagens as $linguagem) {
    echo "<li>$linguagem</li>";
}
echo "</ul>";

// Array associativo (chave => valor)
$aluno = [
    "nome" => "Ana Paula",
    "curso" => "ADS",
    "semestre" => 3,
    "media" => 8.5
];

echo "<h3>Dados do Aluno:</h3>";
echo "<table border='1'>";
foreach ($aluno as $campo => $valor) {
    echo "<tr><th>" . ucfirst($campo) . "</th><td>$valor</td></tr>";
}
echo "</table>";
```

### 7.5 Controle de loops: break e continue

```php
<?php
// break — interrompe o loop imediatamente
echo "Buscando o número 5:<br>";
for ($i = 1; $i <= 10; $i++) {
    if ($i == 5) {
        echo "Encontrei o $i! Parando a busca.";
        break;
    }
    echo "$i... ";
}
// Saída: 1... 2... 3... 4... Encontrei o 5! Parando a busca.

echo "<br><br>";

// continue — pula para a próxima iteração
echo "Números ímpares de 1 a 10: ";
for ($i = 1; $i <= 10; $i++) {
    if ($i % 2 == 0) {
        continue; // Pula os pares
    }
    echo "$i ";
}
// Saída: 1 3 5 7 9
```

---

## 8. Arrays

Arrays são uma das estruturas de dados mais importantes do PHP. Permitem armazenar **múltiplos valores** em uma única variável.

### 8.1 Arrays indexados

```php
<?php
// Criando arrays
$frutas = ["Maçã", "Banana", "Laranja", "Uva"];
$numeros = array(10, 20, 30, 40); // sintaxe alternativa

// Acessando elementos (índice começa em 0)
echo $frutas[0];  // Maçã
echo $frutas[2];  // Laranja

// Adicionando elementos
$frutas[] = "Manga";           // Adiciona ao final
array_push($frutas, "Abacaxi"); // Também adiciona ao final

// Removendo elementos
unset($frutas[1]);             // Remove "Banana" (mantém os índices)
array_splice($frutas, 1, 1);  // Remove e reindexa

// Tamanho do array
echo count($frutas);
```

### 8.2 Arrays associativos

Usam **chaves nomeadas** ao invés de índices numéricos:

```php
<?php
// Cadastro de um produto
$produto = [
    "id" => 1,
    "nome" => "Notebook Dell",
    "preco" => 3499.90,
    "categoria" => "Informática",
    "estoque" => 15,
    "ativo" => true
];

echo "Produto: " . $produto["nome"] . "<br>";
echo "Preço: R$ " . number_format($produto["preco"], 2, ',', '.') . "<br>";
echo "Estoque: " . $produto["estoque"] . " unidades<br>";

// Verificando se uma chave existe
if (array_key_exists("desconto", $produto)) {
    echo "Desconto: " . $produto["desconto"];
} else {
    echo "Este produto não possui desconto.";
}
```

### 8.3 Arrays multidimensionais

```php
<?php
// Lista de alunos com suas notas
$turma = [
    [
        "nome" => "Carlos Silva",
        "notas" => [8.5, 7.0, 9.0, 6.5]
    ],
    [
        "nome" => "Ana Souza",
        "notas" => [9.0, 8.5, 10.0, 9.5]
    ],
    [
        "nome" => "Pedro Lima",
        "notas" => [5.0, 6.0, 4.5, 7.0]
    ]
];

// Exibindo boletim em tabela HTML
echo "<table border='1' cellpadding='8'>";
echo "<tr><th>Aluno</th><th>N1</th><th>N2</th><th>N3</th><th>N4</th><th>Média</th><th>Situação</th></tr>";

foreach ($turma as $aluno) {
    $media = array_sum($aluno["notas"]) / count($aluno["notas"]);
    $situacao = ($media >= 7.0) ? "✅ Aprovado" : (($media >= 5.0) ? "⚠️ Recuperação" : "❌ Reprovado");
    
    echo "<tr>";
    echo "<td>{$aluno['nome']}</td>";
    foreach ($aluno["notas"] as $nota) {
        echo "<td>$nota</td>";
    }
    echo "<td><strong>" . number_format($media, 1) . "</strong></td>";
    echo "<td>$situacao</td>";
    echo "</tr>";
}
echo "</table>";
```

### 8.4 Funções úteis para arrays

```php
<?php
$numeros = [3, 1, 4, 1, 5, 9, 2, 6, 5, 3, 5];

// Ordenação
sort($numeros);              // Ordena em ordem crescente
rsort($numeros);             // Ordena em ordem decrescente

// Para arrays associativos
$precos = ["Arroz" => 5.90, "Feijão" => 8.50, "Macarrão" => 3.20];
asort($precos);              // Ordena por VALOR (mantém chaves)
ksort($precos);              // Ordena por CHAVE

// Busca
$pos = array_search("Arroz", array_keys($precos));  // Encontra a posição
$existe = in_array(5.90, $precos);                    // Verifica se o valor existe

// Transformação
$nomes = ["ana", "carlos", "beatriz"];
$nomesMaiusculos = array_map('strtoupper', $nomes);  // ["ANA", "CARLOS", "BEATRIZ"]

// Filtragem
$idades = [15, 22, 17, 30, 12, 25];
$maiores = array_filter($idades, function($idade) {
    return $idade >= 18;
});
// $maiores = [22, 30, 25]

// Redução
$valores = [100, 200, 50, 75];
$total = array_reduce($valores, function($acumulador, $valor) {
    return $acumulador + $valor;
}, 0);
echo "Total: R$ $total";  // Total: R$ 425

// Combinação
$chaves = ["nome", "idade", "cidade"];
$valores = ["Maria", 25, "São Paulo"];
$pessoa = array_combine($chaves, $valores);
// ["nome" => "Maria", "idade" => 25, "cidade" => "São Paulo"]

// Desestruturação (PHP 7.1+)
[$primeiro, $segundo, $terceiro] = ["PHP", "JavaScript", "Python"];
echo $primeiro;  // PHP
```

---

## 9. Funções

### 9.1 Criando funções

```php
<?php
// Função simples
function saudacao() {
    echo "Olá! Seja bem-vindo ao sistema.";
}
saudacao();  // Chamando a função

// Função com parâmetros
function calcularIMC($peso, $altura) {
    return $peso / ($altura ** 2);
}

$imc = calcularIMC(70, 1.75);
echo "Seu IMC é: " . number_format($imc, 2);  // Seu IMC é: 22.86
```

### 9.2 Parâmetros com valor padrão

```php
<?php
function criarUsuario($nome, $perfil = "aluno", $ativo = true) {
    $status = $ativo ? "Ativo" : "Inativo";
    return "Usuário: $nome | Perfil: $perfil | Status: $status";
}

echo criarUsuario("João");                     // Perfil: aluno | Status: Ativo
echo criarUsuario("Maria", "professor");       // Perfil: professor | Status: Ativo
echo criarUsuario("Admin", "admin", false);    // Perfil: admin | Status: Inativo
```

### 9.3 Tipagem de parâmetros e retorno (PHP 7+)

```php
<?php
// Declarando tipos nos parâmetros e no retorno
function calcularDesconto(float $preco, int $percentual): float {
    return $preco - ($preco * $percentual / 100);
}

echo calcularDesconto(200.00, 15);  // 170.0

// Union types (PHP 8+) — aceita mais de um tipo
function formatar(int|float $valor): string {
    return "R$ " . number_format($valor, 2, ',', '.');
}

echo formatar(1500);      // R$ 1.500,00
echo formatar(49.90);     // R$ 49,90

// Tipo de retorno nullable
function buscarAluno(int $id): ?array {
    $alunos = [
        1 => ["nome" => "Carlos", "curso" => "ADS"],
        2 => ["nome" => "Ana", "curso" => "ADS"],
    ];
    return $alunos[$id] ?? null;
}

$aluno = buscarAluno(3);  // Retorna null (não encontrou)
```

### 9.4 Argumentos nomeados (PHP 8+)

```php
<?php
function gerarRelatorio(
    string $titulo,
    string $formato = "PDF",
    bool $incluirGraficos = true,
    string $orientacao = "retrato"
): string {
    return "Relatório: $titulo | Formato: $formato | Gráficos: " 
           . ($incluirGraficos ? "Sim" : "Não") 
           . " | Orientação: $orientacao";
}

// Sem argumentos nomeados (precisa respeitar a ordem)
echo gerarRelatorio("Vendas", "PDF", true, "paisagem");

// Com argumentos nomeados (pode pular parâmetros e alterar a ordem)
echo gerarRelatorio(
    titulo: "Vendas",
    orientacao: "paisagem"  // Pula $formato e $incluirGraficos (usam o padrão)
);
```

### 9.5 Funções anônimas (Closures) e Arrow Functions

```php
<?php
// Função anônima atribuída a uma variável
$somar = function($a, $b) {
    return $a + $b;
};
echo $somar(5, 3);  // 8

// Função anônima com `use` para acessar variáveis externas
$taxa = 0.10;
$aplicarTaxa = function($valor) use ($taxa) {
    return $valor + ($valor * $taxa);
};
echo $aplicarTaxa(100);  // 110

// Arrow function (PHP 7.4+) — sintaxe curta
$dobro = fn($n) => $n * 2;
echo $dobro(7);  // 14

// Arrow functions capturam variáveis automaticamente
$imposto = 0.18;
$calcularPrecoFinal = fn($preco) => $preco * (1 + $imposto);
echo $calcularPrecoFinal(100);  // 118

// Uso prático: ordenar array de produtos por preço
$produtos = [
    ["nome" => "Mouse", "preco" => 49.90],
    ["nome" => "Teclado", "preco" => 129.90],
    ["nome" => "Monitor", "preco" => 899.90],
    ["nome" => "Webcam", "preco" => 199.90],
];

usort($produtos, fn($a, $b) => $a["preco"] <=> $b["preco"]);

foreach ($produtos as $p) {
    echo "{$p['nome']}: R$ {$p['preco']}<br>";
}
// Mouse: R$ 49.9
// Teclado: R$ 129.9
// Webcam: R$ 199.9
// Monitor: R$ 899.9
```

---

## 10. Manipulação de Strings

### 10.1 Funções essenciais

```php
<?php
$texto = "  Programação para Internet - ADS  ";

// Tamanho
echo strlen($texto);          // 35

// Remoção de espaços
echo trim($texto);            // "Programação para Internet - ADS"
echo ltrim($texto);           // Remove espaços à esquerda
echo rtrim($texto);           // Remove espaços à direita

// Maiúsculas e minúsculas
echo strtoupper("php");       // PHP
echo strtolower("PHP");       // php
echo ucfirst("programação");  // Programação
echo ucwords("olá mundo");    // Olá Mundo
echo mb_strtoupper("café");   // CAFÉ (suporte a UTF-8)

// Busca
echo strpos("Hello PHP", "PHP");     // 6 (posição onde "PHP" começa)
echo str_contains("Hello PHP", "PHP"); // true (PHP 8+)
echo str_starts_with("Hello", "He");   // true (PHP 8+)
echo str_ends_with("foto.jpg", ".jpg"); // true (PHP 8+)

// Substituição
echo str_replace("mundo", "PHP", "Olá, mundo!");   // Olá, PHP!
echo str_ireplace("php", "PHP", "Eu uso php");     // Eu uso PHP (case-insensitive)

// Extração
echo substr("Abacaxi", 0, 3);    // Aba
echo substr("Abacaxi", -3);      // axi

// Divisão e junção
$csv = "João;25;ADS;2024";
$dados = explode(";", $csv);      // ["João", "25", "ADS", "2024"]
echo implode(" | ", $dados);      // João | 25 | ADS | 2024

// Repetição e preenchimento
echo str_repeat("=", 30);                // ==============================
echo str_pad("42", 5, "0", STR_PAD_LEFT); // 00042
```

### 10.2 Exemplo prático — Validação e formatação de CPF

```php
<?php
function formatarCPF(string $cpf): string {
    // Remove tudo que não for número
    $cpf = preg_replace('/\D/', '', $cpf);
    
    // Verifica se tem 11 dígitos
    if (strlen($cpf) !== 11) {
        return "CPF inválido: deve conter 11 dígitos.";
    }
    
    // Formata: 000.000.000-00
    return substr($cpf, 0, 3) . '.' .
           substr($cpf, 3, 3) . '.' .
           substr($cpf, 6, 3) . '-' .
           substr($cpf, 9, 2);
}

echo formatarCPF("12345678901");    // 123.456.789-01
echo formatarCPF("123.456.789-01"); // 123.456.789-01
echo formatarCPF("123");            // CPF inválido: deve conter 11 dígitos.
```

### 10.3 Expressões regulares (Regex)

```php
<?php
$email = "aluno@faculdade.edu.br";

// Verificar se é um e-mail válido
if (preg_match('/^[\w.-]+@[\w.-]+\.\w{2,}$/', $email)) {
    echo "E-mail válido! ✅";
} else {
    echo "E-mail inválido! ❌";
}

// Extrair todos os números de um texto
$texto = "Pedido 1234 tem 5 itens no valor de R$ 299,90";
preg_match_all('/\d+/', $texto, $matches);
print_r($matches[0]);  // ["1234", "5", "299", "90"]

// Substituir com regex
$telefone = "(11) 98765-4321";
$apenasNumeros = preg_replace('/\D/', '', $telefone);
echo $apenasNumeros;  // 11987654321

// Validar senha forte
function validarSenha(string $senha): array {
    $erros = [];
    
    if (strlen($senha) < 8) {
        $erros[] = "Mínimo de 8 caracteres";
    }
    if (!preg_match('/[A-Z]/', $senha)) {
        $erros[] = "Deve conter pelo menos uma letra maiúscula";
    }
    if (!preg_match('/[a-z]/', $senha)) {
        $erros[] = "Deve conter pelo menos uma letra minúscula";
    }
    if (!preg_match('/\d/', $senha)) {
        $erros[] = "Deve conter pelo menos um número";
    }
    if (!preg_match('/[@#$%!&*]/', $senha)) {
        $erros[] = "Deve conter pelo menos um caractere especial (@#$%!&*)";
    }
    
    return $erros;
}

$erros = validarSenha("abc123");
if (empty($erros)) {
    echo "Senha válida! ✅";
} else {
    echo "Senha fraca ❌:<br>";
    foreach ($erros as $erro) {
        echo "• $erro<br>";
    }
}
```

---

## 11. Formulários e Superglobais

### 11.1 Superglobais do PHP

Superglobais são variáveis especiais que estão **sempre disponíveis**, em qualquer escopo:

| Superglobal   | Descrição                                          |
|---------------|-----------------------------------------------------|
| `$_GET`       | Dados enviados via URL (método GET)                 |
| `$_POST`      | Dados enviados via formulário (método POST)         |
| `$_REQUEST`   | Combinação de `$_GET`, `$_POST` e `$_COOKIE`       |
| `$_SERVER`    | Informações do servidor e da requisição             |
| `$_SESSION`   | Dados da sessão do usuário                          |
| `$_COOKIE`    | Cookies enviados pelo navegador                     |
| `$_FILES`     | Informações de arquivos enviados via upload          |
| `$_ENV`       | Variáveis de ambiente                               |
| `$GLOBALS`    | Referência a todas as variáveis do escopo global    |

### 11.2 Método GET

Os dados são enviados **na URL** — visíveis para o usuário:

**formulario_busca.html:**
```html
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Busca de Produtos</title>
</head>
<body>
    <h2>🔍 Buscar Produto</h2>
    <form action="buscar.php" method="GET">
        <label for="termo">Termo de busca:</label>
        <input type="text" id="termo" name="termo" placeholder="Ex: notebook">
        
        <label for="categoria">Categoria:</label>
        <select id="categoria" name="categoria">
            <option value="">Todas</option>
            <option value="informatica">Informática</option>
            <option value="eletronicos">Eletrônicos</option>
            <option value="acessorios">Acessórios</option>
        </select>
        
        <button type="submit">Buscar</button>
    </form>
</body>
</html>
```

**buscar.php:**
```php
<?php
// A URL ficará assim: buscar.php?termo=notebook&categoria=informatica

$termo = $_GET['termo'] ?? '';
$categoria = $_GET['categoria'] ?? '';

echo "<h2>Resultados da busca</h2>";
echo "<p>Termo: <strong>" . htmlspecialchars($termo) . "</strong></p>";

if (!empty($categoria)) {
    echo "<p>Categoria: <strong>" . htmlspecialchars($categoria) . "</strong></p>";
}

// Simulação de resultados
$produtos = [
    ["nome" => "Notebook Dell Inspiron", "preco" => 3499.90, "categoria" => "informatica"],
    ["nome" => "Notebook Lenovo IdeaPad", "preco" => 2899.90, "categoria" => "informatica"],
    ["nome" => "Mouse Logitech", "preco" => 89.90, "categoria" => "acessorios"],
];

$resultados = array_filter($produtos, function($p) use ($termo, $categoria) {
    $matchTermo = empty($termo) || stripos($p["nome"], $termo) !== false;
    $matchCategoria = empty($categoria) || $p["categoria"] === $categoria;
    return $matchTermo && $matchCategoria;
});

if (count($resultados) > 0) {
    echo "<ul>";
    foreach ($resultados as $p) {
        echo "<li>{$p['nome']} — R$ " . number_format($p['preco'], 2, ',', '.') . "</li>";
    }
    echo "</ul>";
} else {
    echo "<p>Nenhum produto encontrado.</p>";
}
```

> 💡 **Quando usar GET:** buscas, filtros, paginação — situações onde a URL pode ser compartilhada.

### 11.3 Método POST

Os dados são enviados **no corpo da requisição** — não ficam visíveis na URL:

**formulario_cadastro.php:**
```php
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Aluno</title>
    <style>
        form { max-width: 500px; margin: 20px auto; }
        label { display: block; margin-top: 10px; font-weight: bold; }
        input, select { width: 100%; padding: 8px; margin-top: 4px; }
        button { margin-top: 15px; padding: 10px 20px; background: #007bff; color: #fff; border: none; cursor: pointer; }
        .mensagem { padding: 10px; margin: 10px 0; border-radius: 5px; }
        .sucesso { background: #d4edda; color: #155724; }
        .erro { background: #f8d7da; color: #721c24; }
    </style>
</head>
<body>
    <h2>📝 Cadastro de Aluno</h2>

    <?php
    // Processamento do formulário (mesma página)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Recebendo os dados
        $nome = trim($_POST['nome'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $idade = (int) ($_POST['idade'] ?? 0);
        $curso = $_POST['curso'] ?? '';

        // Validações
        $erros = [];

        if (empty($nome) || strlen($nome) < 3) {
            $erros[] = "Nome deve ter pelo menos 3 caracteres.";
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $erros[] = "E-mail inválido.";
        }
        if ($idade < 16 || $idade > 100) {
            $erros[] = "Idade deve estar entre 16 e 100 anos.";
        }
        if (empty($curso)) {
            $erros[] = "Selecione um curso.";
        }

        // Resultado
        if (empty($erros)) {
            echo '<div class="mensagem sucesso">';
            echo "✅ Aluno cadastrado com sucesso!<br>";
            echo "Nome: " . htmlspecialchars($nome) . "<br>";
            echo "E-mail: " . htmlspecialchars($email) . "<br>";
            echo "Idade: $idade<br>";
            echo "Curso: " . htmlspecialchars($curso);
            echo '</div>';
        } else {
            echo '<div class="mensagem erro">';
            echo "❌ Erros encontrados:<br>";
            foreach ($erros as $erro) {
                echo "• $erro<br>";
            }
            echo '</div>';
        }
    }
    ?>

    <form action="" method="POST">
        <label for="nome">Nome completo:</label>
        <input type="text" id="nome" name="nome" 
               value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>" required>

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" 
               value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>

        <label for="idade">Idade:</label>
        <input type="number" id="idade" name="idade" min="16" max="100" 
               value="<?= htmlspecialchars($_POST['idade'] ?? '') ?>" required>

        <label for="curso">Curso:</label>
        <select id="curso" name="curso">
            <option value="">Selecione...</option>
            <option value="ADS" <?= (($_POST['curso'] ?? '') === 'ADS') ? 'selected' : '' ?>>
                Análise e Desenvolvimento de Sistemas
            </option>
            <option value="SI" <?= (($_POST['curso'] ?? '') === 'SI') ? 'selected' : '' ?>>
                Sistemas de Informação
            </option>
            <option value="CC" <?= (($_POST['curso'] ?? '') === 'CC') ? 'selected' : '' ?>>
                Ciência da Computação
            </option>
        </select>

        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>
```

> 💡 **Quando usar POST:** cadastros, logins, envio de dados sensíveis — qualquer operação que modifique dados.

### 11.4 Upload de arquivos

```php
<!-- upload.html -->
<form action="processar_upload.php" method="POST" enctype="multipart/form-data">
    <label>Selecione uma imagem (JPG, PNG — máx. 2MB):</label>
    <input type="file" name="foto" accept="image/jpeg, image/png" required>
    <button type="submit">Enviar</button>
</form>
```

```php
<?php
// processar_upload.php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['foto'])) {
    $arquivo = $_FILES['foto'];

    // Informações do arquivo
    $nomeOriginal = $arquivo['name'];       // foto_perfil.jpg
    $tipoMime = $arquivo['type'];           // image/jpeg
    $tamanho = $arquivo['size'];            // Tamanho em bytes
    $tmpName = $arquivo['tmp_name'];        // Caminho temporário
    $erro = $arquivo['error'];              // Código de erro

    // Validações
    $erros = [];
    $tiposPermitidos = ['image/jpeg', 'image/png'];
    $tamanhoMaximo = 2 * 1024 * 1024; // 2MB em bytes

    if ($erro !== UPLOAD_ERR_OK) {
        $erros[] = "Erro no upload (código: $erro).";
    }
    if (!in_array($tipoMime, $tiposPermitidos)) {
        $erros[] = "Tipo de arquivo não permitido. Envie JPG ou PNG.";
    }
    if ($tamanho > $tamanhoMaximo) {
        $erros[] = "Arquivo muito grande. Máximo: 2MB.";
    }

    if (empty($erros)) {
        // Gera nome único para evitar conflitos
        $extensao = pathinfo($nomeOriginal, PATHINFO_EXTENSION);
        $nomeUnico = uniqid('img_') . '.' . $extensao;
        $destino = 'uploads/' . $nomeUnico;

        // Cria a pasta se não existir
        if (!is_dir('uploads')) {
            mkdir('uploads', 0755, true);
        }

        // Move o arquivo da pasta temporária para o destino
        if (move_uploaded_file($tmpName, $destino)) {
            echo "✅ Arquivo enviado com sucesso!<br>";
            echo "<img src='$destino' width='300'>";
        } else {
            echo "❌ Erro ao mover o arquivo.";
        }
    } else {
        echo "❌ Problemas encontrados:<br>";
        foreach ($erros as $e) {
            echo "• $e<br>";
        }
    }
}
```

### 11.5 Variáveis `$_SERVER` úteis

```php
<?php
echo $_SERVER['REQUEST_METHOD'];  // GET ou POST
echo $_SERVER['PHP_SELF'];        // /pagina.php
echo $_SERVER['HTTP_HOST'];       // localhost
echo $_SERVER['HTTP_USER_AGENT']; // Navegador do usuário
echo $_SERVER['REMOTE_ADDR'];     // IP do cliente
echo $_SERVER['DOCUMENT_ROOT'];   // /var/www/html
echo $_SERVER['QUERY_STRING'];    // termo=php&page=1
echo $_SERVER['REQUEST_URI'];     // /busca.php?termo=php
```

---

## 12. Manipulação de Arquivos

### 12.1 Lendo arquivos

```php
<?php
// Lê o arquivo inteiro para uma string
$conteudo = file_get_contents('dados.txt');
echo $conteudo;

// Lê o arquivo para um array (cada linha é um elemento)
$linhas = file('dados.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
foreach ($linhas as $numero => $linha) {
    echo "Linha " . ($numero + 1) . ": $linha<br>";
}

// Leitura manual com fopen (mais controle)
$arquivo = fopen('dados.txt', 'r'); // 'r' = read
if ($arquivo) {
    while (!feof($arquivo)) { // feof = fim do arquivo
        $linha = fgets($arquivo); // Lê uma linha
        echo $linha . "<br>";
    }
    fclose($arquivo); // Sempre feche o arquivo!
}
```

### 12.2 Escrevendo em arquivos

```php
<?php
// Escreve (sobrescreve o conteúdo existente)
file_put_contents('log.txt', "Acesso em: " . date('d/m/Y H:i:s'));

// Adiciona ao final (append)
file_put_contents('log.txt', "\nNovo registro: " . date('d/m/Y H:i:s'), FILE_APPEND);

// Escrita manual com fopen
$arquivo = fopen('relatorio.txt', 'w'); // 'w' = write (sobrescreve)
fwrite($arquivo, "Relatório de Vendas\n");
fwrite($arquivo, "==================\n");
fwrite($arquivo, "Total: R$ 15.430,00\n");
fclose($arquivo);
```

### 12.3 Trabalhando com JSON

JSON é o formato mais usado para trocar dados entre o front-end (JavaScript) e o back-end (PHP):

```php
<?php
// Array PHP → JSON
$alunos = [
    ["id" => 1, "nome" => "Ana", "media" => 8.5],
    ["id" => 2, "nome" => "Bruno", "media" => 7.2],
    ["id" => 3, "nome" => "Carla", "media" => 9.0],
];

// Codificar para JSON
$json = json_encode($alunos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
file_put_contents('alunos.json', $json);

echo $json;
/*
[
    {"id": 1, "nome": "Ana", "media": 8.5},
    {"id": 2, "nome": "Bruno", "media": 7.2},
    {"id": 3, "nome": "Carla", "media": 9.0}
]
*/

// JSON → Array PHP
$jsonString = file_get_contents('alunos.json');
$dados = json_decode($jsonString, true); // true = retorna array associativo

foreach ($dados as $aluno) {
    echo "{$aluno['nome']} - Média: {$aluno['media']}<br>";
}
```

### 12.4 Trabalhando com CSV

```php
<?php
// Escrevendo CSV
$produtos = [
    ["ID", "Produto", "Preço", "Estoque"],
    [1, "Notebook", 3499.90, 10],
    [2, "Mouse", 49.90, 150],
    [3, "Teclado", 129.90, 80],
];

$arquivo = fopen('produtos.csv', 'w');
// Adiciona BOM para Excel reconhecer UTF-8
fwrite($arquivo, "\xEF\xBB\xBF");

foreach ($produtos as $linha) {
    fputcsv($arquivo, $linha, ';'); // Separador: ponto e vírgula
}
fclose($arquivo);

// Lendo CSV
$arquivo = fopen('produtos.csv', 'r');
echo "<table border='1'>";
while (($linha = fgetcsv($arquivo, 0, ';')) !== false) {
    echo "<tr>";
    foreach ($linha as $campo) {
        echo "<td>$campo</td>";
    }
    echo "</tr>";
}
echo "</table>";
fclose($arquivo);
```

---

## 13. Sessões e Cookies

### 13.1 Sessões

Sessões permitem armazenar dados do usuário **no servidor** enquanto ele navega pelo site:

```php
<?php
// login.php — Iniciando sessão após login
session_start(); // DEVE ser chamado ANTES de qualquer saída HTML

// Simulando validação de login
$usuario = $_POST['usuario'] ?? '';
$senha = $_POST['senha'] ?? '';

if ($usuario === 'admin' && $senha === '1234') {
    // Armazena dados na sessão
    $_SESSION['usuario'] = $usuario;
    $_SESSION['nome'] = 'Administrador';
    $_SESSION['logado'] = true;
    $_SESSION['login_hora'] = date('H:i:s');
    
    header('Location: painel.php'); // Redireciona
    exit;
} else {
    echo "Usuário ou senha inválidos!";
}
```

```php
<?php
// painel.php — Verificando se o usuário está logado
session_start();

// Proteção da página
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header('Location: login.php');
    exit;
}

$nome = $_SESSION['nome'];
$hora = $_SESSION['login_hora'];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel</title>
</head>
<body>
    <h1>Bem-vindo, <?= htmlspecialchars($nome) ?>!</h1>
    <p>Você fez login às <?= $hora ?>.</p>
    <a href="logout.php">Sair</a>
</body>
</html>
```

```php
<?php
// logout.php — Destruindo a sessão
session_start();
$_SESSION = [];             // Limpa todas as variáveis de sessão

// Destroi o cookie de sessão
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params["path"]);
}

session_destroy();          // Destroi a sessão
header('Location: login.php');
exit;
```

### 13.2 Cookies

Cookies armazenam dados **no navegador do usuário**:

```php
<?php
// Criando um cookie (expira em 30 dias)
setcookie("tema", "escuro", time() + (30 * 24 * 60 * 60), "/");
setcookie("idioma", "pt-BR", time() + (365 * 24 * 60 * 60), "/");

// Lendo cookies
$tema = $_COOKIE['tema'] ?? 'claro';
$idioma = $_COOKIE['idioma'] ?? 'pt-BR';

echo "Tema atual: $tema<br>";
echo "Idioma: $idioma<br>";

// Removendo um cookie (define com data passada)
setcookie("tema", "", time() - 3600, "/");
```

> ⚠️ **Importante:** `setcookie()` deve ser chamado **antes de qualquer saída HTML** (assim como `session_start()`).

### 13.3 Sessões vs. Cookies — Quando usar cada um?

| Característica        | Sessão                          | Cookie                          |
|-----------------------|---------------------------------|----------------------------------|
| **Armazenamento**     | Servidor                        | Navegador do cliente             |
| **Segurança**         | Mais seguro                     | Menos seguro (acessível pelo JS) |
| **Capacidade**        | Sem limite prático              | ~4KB por cookie                  |
| **Duração**           | Até fechar o navegador*         | Definida pelo desenvolvedor      |
| **Uso típico**        | Login, carrinho de compras      | Preferências, "lembrar de mim"   |

---

## 14. Programação Orientada a Objetos (POO)

### 14.1 Conceitos fundamentais

A POO organiza o código em torno de **objetos** que representam entidades do mundo real. Os quatro pilares são:

1. **Encapsulamento** — Proteger dados internos do objeto.
2. **Herança** — Uma classe herda propriedades e métodos de outra.
3. **Polimorfismo** — Objetos diferentes respondem à mesma mensagem de formas diferentes.
4. **Abstração** — Expor apenas o essencial, ocultando a complexidade.

### 14.2 Classes e Objetos

```php
<?php
class Produto
{
    // Propriedades (atributos)
    public string $nome;
    public float $preco;
    private int $estoque;

    // Construtor — executado ao criar o objeto
    public function __construct(string $nome, float $preco, int $estoque)
    {
        $this->nome = $nome;
        $this->preco = $preco;
        $this->estoque = $estoque;
    }

    // Métodos
    public function getPrecoFormatado(): string
    {
        return "R$ " . number_format($this->preco, 2, ',', '.');
    }

    public function temEstoque(): bool
    {
        return $this->estoque > 0;
    }

    public function vender(int $quantidade = 1): string
    {
        if ($quantidade > $this->estoque) {
            return "Estoque insuficiente! Disponível: {$this->estoque}";
        }
        $this->estoque -= $quantidade;
        return "Venda realizada! Estoque restante: {$this->estoque}";
    }

    public function getEstoque(): int
    {
        return $this->estoque;
    }
}

// Criando objetos (instâncias)
$notebook = new Produto("Notebook Dell", 3499.90, 10);
$mouse = new Produto("Mouse Logitech", 89.90, 50);

echo $notebook->nome;                  // Notebook Dell
echo $notebook->getPrecoFormatado();   // R$ 3.499,90
echo $notebook->vender(2);             // Venda realizada! Estoque restante: 8

// Propriedade privada — acesso somente via método
// echo $notebook->estoque;            // ❌ ERRO: propriedade privada
echo $notebook->getEstoque();          // ✅ 8
```

### 14.3 Modificadores de acesso

```php
<?php
class ContaBancaria
{
    public string $titular;        // Acessível em qualquer lugar
    protected string $banco;       // Acessível na classe e subclasses
    private float $saldo;          // Acessível SOMENTE na própria classe

    public function __construct(string $titular, string $banco, float $saldoInicial = 0)
    {
        $this->titular = $titular;
        $this->banco = $banco;
        $this->saldo = $saldoInicial;
    }

    public function depositar(float $valor): void
    {
        if ($valor <= 0) {
            throw new InvalidArgumentException("Valor deve ser positivo.");
        }
        $this->saldo += $valor;
    }

    public function sacar(float $valor): bool
    {
        if ($valor > $this->saldo) {
            return false;
        }
        $this->saldo -= $valor;
        return true;
    }

    public function getSaldo(): float
    {
        return $this->saldo;
    }

    public function __toString(): string
    {
        return "Conta de {$this->titular} | Banco: {$this->banco} | Saldo: R$ " 
               . number_format($this->saldo, 2, ',', '.');
    }
}

$conta = new ContaBancaria("Maria Silva", "Banco PHP", 1000);
$conta->depositar(500);
$conta->sacar(200);
echo $conta;  // Conta de Maria Silva | Banco: Banco PHP | Saldo: R$ 1.300,00
```

### 14.4 Promoção de propriedades no construtor (PHP 8+)

```php
<?php
// Antes do PHP 8 (verboso)
class ProdutoAntigo
{
    private string $nome;
    private float $preco;
    
    public function __construct(string $nome, float $preco)
    {
        $this->nome = $nome;
        $this->preco = $preco;
    }
}

// PHP 8+ (Constructor Property Promotion — muito mais limpo!)
class ProdutoModerno
{
    public function __construct(
        private string $nome,
        private float $preco,
        private int $estoque = 0
    ) {}

    public function getNome(): string { return $this->nome; }
    public function getPreco(): float { return $this->preco; }
}

$p = new ProdutoModerno("Monitor", 899.90, 25);
echo $p->getNome();  // Monitor
```

### 14.5 Herança

```php
<?php
class Usuario
{
    public function __construct(
        protected string $nome,
        protected string $email,
        protected string $tipo = 'comum'
    ) {}

    public function exibirInfo(): string
    {
        return "Nome: {$this->nome} | E-mail: {$this->email} | Tipo: {$this->tipo}";
    }

    public function getPermissoes(): array
    {
        return ['visualizar'];
    }
}

class Administrador extends Usuario
{
    public function __construct(
        string $nome,
        string $email,
        private string $nivel = 'pleno'
    ) {
        parent::__construct($nome, $email, 'admin');
    }

    // Sobrescrita de método (polimorfismo)
    public function getPermissoes(): array
    {
        $permissoes = parent::getPermissoes();
        return array_merge($permissoes, ['criar', 'editar', 'excluir']);
    }

    public function getNivel(): string
    {
        return $this->nivel;
    }
}

class Professor extends Usuario
{
    public function __construct(
        string $nome,
        string $email,
        private string $disciplina
    ) {
        parent::__construct($nome, $email, 'professor');
    }

    public function getPermissoes(): array
    {
        $permissoes = parent::getPermissoes();
        return array_merge($permissoes, ['criar', 'editar', 'avaliar']);
    }

    public function getDisciplina(): string
    {
        return $this->disciplina;
    }
}

// Uso
$admin = new Administrador("João", "joao@email.com", "senior");
$prof = new Professor("Ana", "ana@email.com", "Programação Web");

echo $admin->exibirInfo() . "<br>";
// Nome: João | E-mail: joao@email.com | Tipo: admin

echo "Permissões Admin: " . implode(', ', $admin->getPermissoes()) . "<br>";
// Permissões Admin: visualizar, criar, editar, excluir

echo $prof->exibirInfo() . "<br>";
// Nome: Ana | E-mail: ana@email.com | Tipo: professor

echo "Disciplina: " . $prof->getDisciplina() . "<br>";
// Disciplina: Programação Web
```

### 14.6 Classes abstratas e interfaces

```php
<?php
// Classe abstrata — não pode ser instanciada diretamente
abstract class FormaPagamento
{
    public function __construct(
        protected float $valor
    ) {}

    // Método abstrato — DEVE ser implementado pelas classes filhas
    abstract public function processar(): bool;
    abstract public function getDescricao(): string;

    // Método concreto — já possui implementação
    public function getValorFormatado(): string
    {
        return "R$ " . number_format($this->valor, 2, ',', '.');
    }
}

// Interface — define um "contrato" que a classe deve seguir
interface Registravel
{
    public function registrarLog(): void;
}

interface Estornavel
{
    public function estornar(): bool;
}

// Implementando
class PagamentoPix extends FormaPagamento implements Registravel, Estornavel
{
    public function __construct(
        float $valor,
        private string $chavePix
    ) {
        parent::__construct($valor);
    }

    public function processar(): bool
    {
        echo "Processando PIX de {$this->getValorFormatado()} para {$this->chavePix}...<br>";
        return true;
    }

    public function getDescricao(): string
    {
        return "PIX - Chave: {$this->chavePix}";
    }

    public function registrarLog(): void
    {
        echo "📋 Log: PIX de {$this->getValorFormatado()} registrado.<br>";
    }

    public function estornar(): bool
    {
        echo "↩️ Estorno PIX de {$this->getValorFormatado()} realizado.<br>";
        return true;
    }
}

class PagamentoCartao extends FormaPagamento implements Registravel
{
    public function __construct(
        float $valor,
        private string $bandeira,
        private int $parcelas = 1
    ) {
        parent::__construct($valor);
    }

    public function processar(): bool
    {
        $valorParcela = $this->valor / $this->parcelas;
        echo "Processando cartão {$this->bandeira}: {$this->parcelas}x de R$ "
             . number_format($valorParcela, 2, ',', '.') . "<br>";
        return true;
    }

    public function getDescricao(): string
    {
        return "Cartão {$this->bandeira} em {$this->parcelas}x";
    }

    public function registrarLog(): void
    {
        echo "📋 Log: Cartão {$this->bandeira} de {$this->getValorFormatado()} registrado.<br>";
    }
}

// Uso
$pix = new PagamentoPix(150.00, "email@email.com");
$cartao = new PagamentoCartao(600.00, "Visa", 3);

$pix->processar();
$pix->registrarLog();

$cartao->processar();
$cartao->registrarLog();
```

### 14.7 Traits

Traits resolvem o problema da herança múltipla em PHP:

```php
<?php
trait Timestamps
{
    private ?string $criadoEm = null;
    private ?string $atualizadoEm = null;

    public function setCriadoEm(): void
    {
        $this->criadoEm = date('Y-m-d H:i:s');
    }

    public function setAtualizadoEm(): void
    {
        $this->atualizadoEm = date('Y-m-d H:i:s');
    }

    public function getCriadoEm(): ?string { return $this->criadoEm; }
    public function getAtualizadoEm(): ?string { return $this->atualizadoEm; }
}

trait SoftDelete
{
    private bool $excluido = false;
    private ?string $excluidoEm = null;

    public function excluir(): void
    {
        $this->excluido = true;
        $this->excluidoEm = date('Y-m-d H:i:s');
    }

    public function restaurar(): void
    {
        $this->excluido = false;
        $this->excluidoEm = null;
    }

    public function isExcluido(): bool { return $this->excluido; }
}

class Artigo
{
    use Timestamps, SoftDelete;

    public function __construct(
        private string $titulo,
        private string $conteudo
    ) {
        $this->setCriadoEm();
    }

    public function getTitulo(): string { return $this->titulo; }
}

$artigo = new Artigo("Introdução ao PHP", "PHP é uma linguagem...");
echo "Criado em: " . $artigo->getCriadoEm() . "<br>";

$artigo->excluir();
echo "Excluído? " . ($artigo->isExcluido() ? "Sim" : "Não") . "<br>";

$artigo->restaurar();
echo "Excluído? " . ($artigo->isExcluido() ? "Sim" : "Não") . "<br>";
```

### 14.8 Propriedades e métodos estáticos

```php
<?php
class Configuracao
{
    private static array $dados = [];
    private static int $instancias = 0;

    public function __construct()
    {
        self::$instancias++;
    }

    public static function set(string $chave, mixed $valor): void
    {
        self::$dados[$chave] = $valor;
    }

    public static function get(string $chave, mixed $padrao = null): mixed
    {
        return self::$dados[$chave] ?? $padrao;
    }

    public static function getInstancias(): int
    {
        return self::$instancias;
    }
}

// Uso — sem precisar criar objeto
Configuracao::set('app_nome', 'Loja Virtual ADS');
Configuracao::set('versao', '2.0');
Configuracao::set('debug', true);

echo Configuracao::get('app_nome');          // Loja Virtual ADS
echo Configuracao::get('tema', 'padrão');    // padrão (usa valor padrão)
```

### 14.9 Enums (PHP 8.1+)

```php
<?php
// Enum básico
enum StatusPedido
{
    case Pendente;
    case Processando;
    case Enviado;
    case Entregue;
    case Cancelado;
}

// Enum com valor (backed enum)
enum Cor: string
{
    case Vermelho = '#FF0000';
    case Verde = '#00FF00';
    case Azul = '#0000FF';
}

// Enum com métodos
enum NivelAcesso: int
{
    case Visitante = 0;
    case Aluno = 1;
    case Professor = 2;
    case Admin = 3;

    public function podeEditar(): bool
    {
        return $this->value >= 2;
    }

    public function label(): string
    {
        return match ($this) {
            self::Visitante => 'Visitante',
            self::Aluno => 'Aluno',
            self::Professor => 'Professor',
            self::Admin => 'Administrador',
        };
    }
}

// Uso
$status = StatusPedido::Enviado;
$cor = Cor::Vermelho;
$nivel = NivelAcesso::Professor;

echo $cor->value;             // #FF0000
echo $nivel->label();         // Professor
echo $nivel->podeEditar();    // true

// Criando a partir do valor
$nivelDoUsuario = NivelAcesso::from(1);  // NivelAcesso::Aluno
echo $nivelDoUsuario->label();            // Aluno
```

---

## 15. Tratamento de Erros e Exceções

### 15.1 Try / Catch / Finally

```php
<?php
function dividir(float $a, float $b): float
{
    if ($b == 0) {
        throw new DivisionByZeroError("Divisão por zero não é permitida!");
    }
    return $a / $b;
}

try {
    $resultado = dividir(10, 0);
    echo "Resultado: $resultado";
} catch (DivisionByZeroError $e) {
    echo "⚠️ Erro matemático: " . $e->getMessage();
} catch (Exception $e) {
    echo "❌ Erro geral: " . $e->getMessage();
} finally {
    echo "<br>Bloco finally: sempre executa (útil para limpeza).";
}
```

### 15.2 Criando exceções personalizadas

```php
<?php
// Exceções personalizadas para um sistema de e-commerce
class EstoqueInsuficienteException extends RuntimeException
{
    public function __construct(
        private string $produto,
        private int $solicitado,
        private int $disponivel
    ) {
        $msg = "Estoque insuficiente para '$produto'. "
             . "Solicitado: $solicitado | Disponível: $disponivel";
        parent::__construct($msg);
    }

    public function getProduto(): string { return $this->produto; }
    public function getSolicitado(): int { return $this->solicitado; }
    public function getDisponivel(): int { return $this->disponivel; }
}

class PagamentoRecusadoException extends RuntimeException {}

// Uso
class Carrinho
{
    private array $itens = [];

    public function adicionarItem(string $produto, int $qtd, int $estoque): void
    {
        if ($qtd > $estoque) {
            throw new EstoqueInsuficienteException($produto, $qtd, $estoque);
        }
        $this->itens[] = ['produto' => $produto, 'quantidade' => $qtd];
    }

    public function finalizarCompra(float $total, float $saldo): void
    {
        if ($total > $saldo) {
            throw new PagamentoRecusadoException(
                "Saldo insuficiente. Total: R$ $total | Saldo: R$ $saldo"
            );
        }
        echo "✅ Compra finalizada com sucesso!<br>";
    }
}

// Testando
try {
    $carrinho = new Carrinho();
    $carrinho->adicionarItem("Notebook", 5, 3);
} catch (EstoqueInsuficienteException $e) {
    echo "🛒 " . $e->getMessage() . "<br>";
    echo "Sugestão: adicione no máximo {$e->getDisponivel()} unidades.";
} catch (PagamentoRecusadoException $e) {
    echo "💳 " . $e->getMessage();
}
```

---

## 16. Banco de Dados com PDO

### 16.1 O que é PDO?

**PDO** (*PHP Data Objects*) é a interface recomendada para acessar bancos de dados em PHP. Suas vantagens:

- ✅ Suporta **múltiplos bancos** (MySQL, PostgreSQL, SQLite, etc.) com a mesma API.
- ✅ **Prepared statements** — proteção contra SQL Injection.
- ✅ Tratamento de erros com exceções.

### 16.2 Conexão com o banco de dados

```php
<?php
// conexao.php — Arquivo de conexão reutilizável

$host = 'localhost';
$dbname = 'loja_ads';
$usuario = 'root';
$senha = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

$opcoes = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,    // Lança exceções em caso de erro
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,          // Retorna arrays associativos
    PDO::ATTR_EMULATE_PREPARES   => false,                     // Usa prepared statements nativos
];

try {
    $pdo = new PDO($dsn, $usuario, $senha, $opcoes);
    // echo "✅ Conexão estabelecida!"; // Descomente para testar
} catch (PDOException $e) {
    die("❌ Erro na conexão: " . $e->getMessage());
}
```

### 16.3 Criando tabelas

```php
<?php
require_once 'conexao.php';

$sql = "CREATE TABLE IF NOT EXISTS produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(200) NOT NULL,
    descricao TEXT,
    preco DECIMAL(10, 2) NOT NULL,
    estoque INT DEFAULT 0,
    categoria VARCHAR(100),
    ativo BOOLEAN DEFAULT TRUE,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

$pdo->exec($sql);
echo "✅ Tabela criada com sucesso!";
```

### 16.4 CRUD Completo (Create, Read, Update, Delete)

```php
<?php
require_once 'conexao.php';

// ============================================
// CREATE — Inserir dados
// ============================================

function inserirProduto(PDO $pdo, array $dados): int
{
    $sql = "INSERT INTO produtos (nome, descricao, preco, estoque, categoria) 
            VALUES (:nome, :descricao, :preco, :estoque, :categoria)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nome'      => $dados['nome'],
        ':descricao' => $dados['descricao'],
        ':preco'     => $dados['preco'],
        ':estoque'   => $dados['estoque'],
        ':categoria' => $dados['categoria'],
    ]);

    return (int) $pdo->lastInsertId();
}

// Uso
$id = inserirProduto($pdo, [
    'nome'      => 'Notebook Dell Inspiron',
    'descricao' => 'Notebook com 16GB RAM e SSD 512GB',
    'preco'     => 3499.90,
    'estoque'   => 15,
    'categoria' => 'Informática',
]);
echo "Produto inserido com ID: $id<br>";


// ============================================
// READ — Consultar dados
// ============================================

// Buscar todos os produtos
function listarProdutos(PDO $pdo, ?string $categoria = null): array
{
    if ($categoria) {
        $sql = "SELECT * FROM produtos WHERE categoria = :categoria AND ativo = 1 ORDER BY nome";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':categoria' => $categoria]);
    } else {
        $sql = "SELECT * FROM produtos WHERE ativo = 1 ORDER BY nome";
        $stmt = $pdo->query($sql);
    }

    return $stmt->fetchAll();
}

// Buscar um produto por ID
function buscarProduto(PDO $pdo, int $id): ?array
{
    $sql = "SELECT * FROM produtos WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);

    $produto = $stmt->fetch();
    return $produto ?: null;
}

// Uso
$produtos = listarProdutos($pdo, 'Informática');
foreach ($produtos as $prod) {
    echo "{$prod['nome']} — R$ {$prod['preco']}<br>";
}


// ============================================
// UPDATE — Atualizar dados
// ============================================

function atualizarProduto(PDO $pdo, int $id, array $dados): bool
{
    $sql = "UPDATE produtos SET nome = :nome, preco = :preco, estoque = :estoque 
            WHERE id = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':id'      => $id,
        ':nome'    => $dados['nome'],
        ':preco'   => $dados['preco'],
        ':estoque' => $dados['estoque'],
    ]);

    return $stmt->rowCount() > 0;
}

// Uso
$atualizado = atualizarProduto($pdo, 1, [
    'nome'    => 'Notebook Dell Inspiron 15',
    'preco'   => 3299.90,
    'estoque' => 12,
]);
echo $atualizado ? "✅ Atualizado!" : "⚠️ Nenhuma alteração.";


// ============================================
// DELETE — Excluir dados (soft delete)
// ============================================

function excluirProduto(PDO $pdo, int $id): bool
{
    // Soft delete — apenas desativa o produto
    $sql = "UPDATE produtos SET ativo = 0 WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);

    return $stmt->rowCount() > 0;
}

// Para exclusão real (use com cautela):
function excluirProdutoPermanente(PDO $pdo, int $id): bool
{
    $sql = "DELETE FROM produtos WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);

    return $stmt->rowCount() > 0;
}
```

### 16.5 Paginação

```php
<?php
require_once 'conexao.php';

function listarProdutosPaginado(PDO $pdo, int $pagina = 1, int $porPagina = 10): array
{
    // Total de registros
    $sqlCount = "SELECT COUNT(*) FROM produtos WHERE ativo = 1";
    $totalRegistros = (int) $pdo->query($sqlCount)->fetchColumn();
    $totalPaginas = (int) ceil($totalRegistros / $porPagina);

    // Consulta paginada
    $offset = ($pagina - 1) * $porPagina;
    $sql = "SELECT * FROM produtos WHERE ativo = 1 ORDER BY id DESC LIMIT :limit OFFSET :offset";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':limit', $porPagina, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();

    return [
        'dados'           => $stmt->fetchAll(),
        'pagina_atual'    => $pagina,
        'total_paginas'   => $totalPaginas,
        'total_registros' => $totalRegistros,
    ];
}

// Uso
$pagina = (int) ($_GET['pagina'] ?? 1);
$resultado = listarProdutosPaginado($pdo, $pagina, 10);

// Exibir produtos
foreach ($resultado['dados'] as $produto) {
    echo "{$produto['nome']} - R$ {$produto['preco']}<br>";
}

// Navegação de páginas
echo "<br>Página {$resultado['pagina_atual']} de {$resultado['total_paginas']}<br>";
for ($i = 1; $i <= $resultado['total_paginas']; $i++) {
    if ($i == $resultado['pagina_atual']) {
        echo "<strong>[$i]</strong> ";
    } else {
        echo "<a href='?pagina=$i'>$i</a> ";
    }
}
```

### 16.6 Transações

```php
<?php
require_once 'conexao.php';

// Transações garantem que TODAS as operações sejam executadas ou NENHUMA seja
function realizarVenda(PDO $pdo, int $produtoId, int $clienteId, int $quantidade): bool
{
    try {
        $pdo->beginTransaction();

        // 1. Verificar estoque
        $sql = "SELECT estoque, preco FROM produtos WHERE id = :id FOR UPDATE";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $produtoId]);
        $produto = $stmt->fetch();

        if (!$produto || $produto['estoque'] < $quantidade) {
            throw new RuntimeException("Estoque insuficiente!");
        }

        // 2. Atualizar estoque
        $sql = "UPDATE produtos SET estoque = estoque - :qtd WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':qtd' => $quantidade, ':id' => $produtoId]);

        // 3. Registrar venda
        $total = $produto['preco'] * $quantidade;
        $sql = "INSERT INTO vendas (produto_id, cliente_id, quantidade, total) 
                VALUES (:produto, :cliente, :qtd, :total)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':produto' => $produtoId,
            ':cliente' => $clienteId,
            ':qtd'     => $quantidade,
            ':total'   => $total,
        ]);

        $pdo->commit(); // Confirma TODAS as operações
        return true;

    } catch (Exception $e) {
        $pdo->rollBack(); // Desfaz TODAS as operações
        echo "Erro na venda: " . $e->getMessage();
        return false;
    }
}
```

---

## 17. Segurança em PHP

### 17.1 SQL Injection — Prevenção

```php
<?php
// ❌ ERRADO — Vulnerável a SQL Injection
$nome = $_GET['nome'];
$sql = "SELECT * FROM usuarios WHERE nome = '$nome'";
// Se o usuário digitar: ' OR '1'='1' --
// A query vira: SELECT * FROM usuarios WHERE nome = '' OR '1'='1' --'
// Retorna TODOS os usuários!

// ✅ CORRETO — Usando Prepared Statements
$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE nome = :nome");
$stmt->execute([':nome' => $_GET['nome']]);
$usuarios = $stmt->fetchAll();
```

### 17.2 XSS (Cross-Site Scripting) — Prevenção

```php
<?php
// ❌ ERRADO — Vulnerável a XSS
$nome = $_POST['nome'];
echo "Olá, $nome";
// Se o usuário enviar: <script>alert('Hackeado!')</script>
// O JavaScript será executado no navegador!

// ✅ CORRETO — Escapando a saída
$nome = $_POST['nome'];
echo "Olá, " . htmlspecialchars($nome, ENT_QUOTES, 'UTF-8');
// O HTML será exibido como texto, não como código

// Função auxiliar para facilitar
function e(string $texto): string
{
    return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
}

echo "Olá, " . e($nome);
```

### 17.3 CSRF (Cross-Site Request Forgery) — Prevenção

```php
<?php
// Gerando token CSRF
session_start();

function gerarTokenCSRF(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function validarTokenCSRF(string $token): bool
{
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}
?>

<!-- No formulário HTML -->
<form method="POST" action="processar.php">
    <input type="hidden" name="csrf_token" value="<?= gerarTokenCSRF() ?>">
    <input type="text" name="nome">
    <button type="submit">Enviar</button>
</form>

<?php
// No processamento
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!validarTokenCSRF($_POST['csrf_token'] ?? '')) {
        die("❌ Token CSRF inválido! Possível ataque.");
    }
    // Processar formulário normalmente...
}
```

### 17.4 Hash de senhas

```php
<?php
// ============================================
// CADASTRO — Armazenando senha com hash
// ============================================
$senhaDigitada = $_POST['senha'];

// Gera hash seguro (bcrypt por padrão)
$senhaHash = password_hash($senhaDigitada, PASSWORD_DEFAULT);
// Resultado: $2y$10$xQ4k3Zv8VmK... (hash único a cada execução)

// Armazena o HASH no banco, NUNCA a senha em texto puro!
$sql = "INSERT INTO usuarios (email, senha) VALUES (:email, :senha)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':email' => $_POST['email'],
    ':senha' => $senhaHash,
]);


// ============================================
// LOGIN — Verificando a senha
// ============================================
$email = $_POST['email'];
$senhaDigitada = $_POST['senha'];

$sql = "SELECT * FROM usuarios WHERE email = :email";
$stmt = $pdo->prepare($sql);
$stmt->execute([':email' => $email]);
$usuario = $stmt->fetch();

if ($usuario && password_verify($senhaDigitada, $usuario['senha'])) {
    echo "✅ Login realizado com sucesso!";
    // Verificar se o hash precisa ser atualizado
    if (password_needs_rehash($usuario['senha'], PASSWORD_DEFAULT)) {
        $novoHash = password_hash($senhaDigitada, PASSWORD_DEFAULT);
        $sql = "UPDATE usuarios SET senha = :senha WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':senha' => $novoHash, ':id' => $usuario['id']]);
    }
} else {
    echo "❌ E-mail ou senha inválidos!";
}
```

### 17.5 Validação e sanitização de dados

```php
<?php
// Funções nativas de filtro do PHP

// Validação — verifica se o dado atende ao critério
$email = "aluno@faculdade.edu.br";
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "E-mail válido!";
}

$url = "https://www.google.com";
if (filter_var($url, FILTER_VALIDATE_URL)) {
    echo "URL válida!";
}

$ip = "192.168.1.1";
if (filter_var($ip, FILTER_VALIDATE_IP)) {
    echo "IP válido!";
}

$idade = "25";
$idadeFiltrada = filter_var($idade, FILTER_VALIDATE_INT, [
    'options' => ['min_range' => 1, 'max_range' => 120]
]);

// Sanitização — limpa o dado
$emailSujo = "  aluno@faculdade.edu.br  <script>";
$emailLimpo = filter_var($emailSujo, FILTER_SANITIZE_EMAIL);
echo $emailLimpo;  // aluno@faculdade.edu.brscript

$textoSujo = "<h1>Olá</h1><script>alert('xss')</script>";
$textoLimpo = filter_var($textoSujo, FILTER_SANITIZE_SPECIAL_CHARS);
echo $textoLimpo;  // &#60;h1&#62;Olá&#60;/h1&#62;...

// Classe de validação reutilizável
class Validador
{
    private array $erros = [];

    public function obrigatorio(string $campo, mixed $valor): self
    {
        if (empty(trim($valor))) {
            $this->erros[$campo] = "O campo '$campo' é obrigatório.";
        }
        return $this;
    }

    public function email(string $campo, string $valor): self
    {
        if (!filter_var($valor, FILTER_VALIDATE_EMAIL)) {
            $this->erros[$campo] = "E-mail inválido.";
        }
        return $this;
    }

    public function tamanhoMinimo(string $campo, string $valor, int $min): self
    {
        if (strlen($valor) < $min) {
            $this->erros[$campo] = "O campo '$campo' deve ter pelo menos $min caracteres.";
        }
        return $this;
    }

    public function temErros(): bool { return !empty($this->erros); }
    public function getErros(): array { return $this->erros; }
}

// Uso
$v = new Validador();
$v->obrigatorio('nome', $_POST['nome'] ?? '')
  ->email('email', $_POST['email'] ?? '')
  ->tamanhoMinimo('senha', $_POST['senha'] ?? '', 8);

if ($v->temErros()) {
    foreach ($v->getErros() as $erro) {
        echo "• $erro<br>";
    }
}
```

---

## 18. Namespaces e Autoload

### 18.1 Namespaces

Namespaces evitam conflitos de nomes entre classes em projetos grandes:

```php
<?php
// arquivo: src/Model/Usuario.php
namespace App\Model;

class Usuario
{
    public function __construct(
        private string $nome,
        private string $email
    ) {}

    public function getNome(): string { return $this->nome; }
    public function getEmail(): string { return $this->email; }
}
```

```php
<?php
// arquivo: src/Model/Produto.php
namespace App\Model;

class Produto
{
    public function __construct(
        private string $nome,
        private float $preco
    ) {}

    public function getNome(): string { return $this->nome; }
    public function getPreco(): float { return $this->preco; }
}
```

```php
<?php
// arquivo: src/Service/AuthService.php
namespace App\Service;

use App\Model\Usuario;

class AuthService
{
    public function login(string $email, string $senha): ?Usuario
    {
        // Lógica de autenticação...
        return new Usuario("João", $email);
    }
}
```

```php
<?php
// arquivo: index.php — Usando as classes com namespaces

// Importando classes com "use"
use App\Model\Usuario;
use App\Model\Produto;
use App\Service\AuthService;

$usuario = new Usuario("Maria", "maria@email.com");
$produto = new Produto("Mouse", 89.90);
$auth = new AuthService();

// Sem "use", é preciso usar o nome completo:
$usuario2 = new \App\Model\Usuario("João", "joao@email.com");
```

### 18.2 Autoload com spl_autoload_register

```php
<?php
// autoload.php — Carrega classes automaticamente
spl_autoload_register(function (string $classe) {
    // Converte namespace para caminho de arquivo
    // App\Model\Usuario  →  src/Model/Usuario.php
    $arquivo = __DIR__ . '/src/' . str_replace('\\', '/', 
                          str_replace('App\\', '', $classe)) . '.php';

    if (file_exists($arquivo)) {
        require_once $arquivo;
    }
});
```

```php
<?php
// index.php — Com autoload, não precisa de require para cada classe!
require_once 'autoload.php';

use App\Model\Usuario;
use App\Model\Produto;

$u = new Usuario("Ana", "ana@email.com"); // Classe carregada automaticamente!
```

---

## 19. Composer e Gerenciamento de Dependências

### 19.1 O que é o Composer?

O **Composer** é o gerenciador de dependências padrão do PHP (similar ao npm do JavaScript). Ele:

- 📦 Instala e atualiza bibliotecas de terceiros.
- 🔄 Gera autoload automático (PSR-4).
- 📋 Gerencia versões de pacotes.

### 19.2 Instalação

```bash
# Linux / macOS
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Verificar instalação
composer --version
```

### 19.3 Iniciando um projeto

```bash
# Cria o arquivo composer.json interativamente
composer init

# Ou crie manualmente o composer.json:
```

```json
{
    "name": "turma-ads/loja-virtual",
    "description": "Projeto da disciplina de Programação para Internet",
    "type": "project",
    "autoload": {
        "psr-4": {
            "App\\": "src/"
        }
    },
    "require": {
        "php": ">=8.1"
    }
}
```

```bash
# Gerar o autoload
composer dump-autoload
```

### 19.4 Instalando dependências

```bash
# Instalar uma biblioteca (ex: manipulação de datas)
composer require nesbot/carbon

# Instalar dependência de desenvolvimento
composer require --dev phpunit/phpunit

# Instalar todas as dependências do composer.json
composer install

# Atualizar dependências
composer update
```

### 19.5 Usando o autoload do Composer

```php
<?php
// index.php — O Composer cuida de TUDO!
require_once 'vendor/autoload.php';

// Suas classes (definidas em src/)
use App\Model\Usuario;
use App\Model\Produto;

// Bibliotecas de terceiros
use Carbon\Carbon;

// Usando Carbon para datas
$agora = Carbon::now('America/Sao_Paulo');
echo "Data atual: " . $agora->format('d/m/Y H:i:s') . "<br>";
echo "Daqui a 30 dias: " . $agora->addDays(30)->format('d/m/Y') . "<br>";
echo "Faz 2 horas: " . Carbon::now()->subHours(2)->diffForHumans() . "<br>";
// Resultado: "2 hours ago" (ou "há 2 horas" com locale pt_BR)
```

### 19.6 Estrutura recomendada de projeto

```
meu-projeto/
├── composer.json
├── composer.lock
├── vendor/              ← Dependências (NÃO versione no Git!)
├── public/              ← Ponto de entrada (index.php)
│   ├── index.php
│   ├── css/
│   ├── js/
│   └── img/
├── src/                 ← Código-fonte da aplicação
│   ├── Model/
│   │   ├── Usuario.php
│   │   └── Produto.php
│   ├── Service/
│   │   ├── AuthService.php
│   │   └── ProdutoService.php
│   ├── Controller/
│   │   └── ProdutoController.php
│   └── Database/
│       └── Conexao.php
├── templates/           ← Views/templates HTML
│   ├── header.php
│   ├── footer.php
│   └── produtos/
│       ├── listar.php
│       └── formulario.php
├── config/              ← Configurações
│   └── database.php
├── tests/               ← Testes automatizados
├── .env                 ← Variáveis de ambiente (NÃO versione!)
└── .gitignore
```

---

## 20. API REST com PHP

### 20.1 O que é uma API REST?

Uma **API REST** permite que diferentes sistemas se comuniquem via HTTP. Usa os métodos HTTP como verbos de ação:

| Método   | Ação   | Exemplo                  | Descrição                        |
|----------|--------|--------------------------|----------------------------------|
| `GET`    | Ler    | `GET /api/produtos`      | Lista todos os produtos          |
| `GET`    | Ler    | `GET /api/produtos/1`    | Retorna o produto com ID 1       |
| `POST`   | Criar  | `POST /api/produtos`     | Cria um novo produto             |
| `PUT`    | Atualizar | `PUT /api/produtos/1` | Atualiza o produto com ID 1      |
| `DELETE` | Excluir | `DELETE /api/produtos/1` | Exclui o produto com ID 1       |

### 20.2 Construindo uma API simples

```php
<?php
// api/produtos.php — API REST de Produtos

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Responder preflight CORS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

require_once '../conexao.php';

// Obtém o método HTTP e o ID (se fornecido)
$metodo = $_SERVER['REQUEST_METHOD'];
$uri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
$id = end($uri);
$id = is_numeric($id) ? (int) $id : null;

// Função auxiliar para resposta JSON
function responderJSON(mixed $dados, int $statusCode = 200): void
{
    http_response_code($statusCode);
    echo json_encode($dados, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit;
}

try {
    match ($metodo) {
        'GET'    => $id ? buscarProduto($pdo, $id) : listarProdutos($pdo),
        'POST'   => criarProduto($pdo),
        'PUT'    => atualizarProduto($pdo, $id),
        'DELETE' => excluirProduto($pdo, $id),
        default  => responderJSON(['erro' => 'Método não permitido'], 405),
    };
} catch (Exception $e) {
    responderJSON(['erro' => $e->getMessage()], 500);
}

// ============================================
// Funções da API
// ============================================

function listarProdutos(PDO $pdo): void
{
    $stmt = $pdo->query("SELECT * FROM produtos WHERE ativo = 1 ORDER BY id DESC");
    responderJSON([
        'sucesso' => true,
        'dados'   => $stmt->fetchAll(),
        'total'   => $stmt->rowCount()
    ]);
}

function buscarProduto(PDO $pdo, int $id): void
{
    $stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = :id AND ativo = 1");
    $stmt->execute([':id' => $id]);
    $produto = $stmt->fetch();

    if (!$produto) {
        responderJSON(['erro' => 'Produto não encontrado'], 404);
    }

    responderJSON(['sucesso' => true, 'dados' => $produto]);
}

function criarProduto(PDO $pdo): void
{
    $dados = json_decode(file_get_contents('php://input'), true);

    // Validação
    if (empty($dados['nome']) || !isset($dados['preco'])) {
        responderJSON(['erro' => 'Nome e preço são obrigatórios'], 400);
    }

    $sql = "INSERT INTO produtos (nome, descricao, preco, estoque, categoria) 
            VALUES (:nome, :descricao, :preco, :estoque, :categoria)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nome'      => $dados['nome'],
        ':descricao' => $dados['descricao'] ?? '',
        ':preco'     => $dados['preco'],
        ':estoque'   => $dados['estoque'] ?? 0,
        ':categoria' => $dados['categoria'] ?? 'Geral',
    ]);

    responderJSON([
        'sucesso'  => true,
        'mensagem' => 'Produto criado com sucesso!',
        'id'       => (int) $pdo->lastInsertId()
    ], 201);
}

function atualizarProduto(PDO $pdo, ?int $id): void
{
    if (!$id) {
        responderJSON(['erro' => 'ID é obrigatório'], 400);
    }

    $dados = json_decode(file_get_contents('php://input'), true);

    $sql = "UPDATE produtos SET nome = :nome, preco = :preco, estoque = :estoque 
            WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':id'      => $id,
        ':nome'    => $dados['nome'],
        ':preco'   => $dados['preco'],
        ':estoque' => $dados['estoque'] ?? 0,
    ]);

    responderJSON([
        'sucesso'  => true,
        'mensagem' => $stmt->rowCount() > 0 ? 'Produto atualizado!' : 'Nenhuma alteração.'
    ]);
}

function excluirProduto(PDO $pdo, ?int $id): void
{
    if (!$id) {
        responderJSON(['erro' => 'ID é obrigatório'], 400);
    }

    $stmt = $pdo->prepare("UPDATE produtos SET ativo = 0 WHERE id = :id");
    $stmt->execute([':id' => $id]);

    responderJSON([
        'sucesso'  => true,
        'mensagem' => $stmt->rowCount() > 0 ? 'Produto excluído!' : 'Produto não encontrado.'
    ]);
}
```

### 20.3 Consumindo a API com JavaScript (Fetch API)

Conectando o conhecimento de JavaScript com o PHP:

```html
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Consumindo API PHP</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #4CAF50; color: white; }
    </style>
</head>
<body>
    <h1>🛒 Produtos (via API)</h1>
    <div id="produtos"></div>

    <h2>Adicionar Produto</h2>
    <form id="formProduto">
        <input type="text" id="nome" placeholder="Nome do produto" required>
        <input type="number" id="preco" placeholder="Preço" step="0.01" required>
        <input type="number" id="estoque" placeholder="Estoque" required>
        <button type="submit">Adicionar</button>
    </form>

    <script>
        const API_URL = 'http://localhost/api/produtos.php';

        // Listar produtos
        async function carregarProdutos() {
            try {
                const response = await fetch(API_URL);
                const resultado = await response.json();

                if (resultado.sucesso) {
                    const tabela = `
                        <table>
                            <tr><th>ID</th><th>Nome</th><th>Preço</th><th>Estoque</th><th>Ações</th></tr>
                            ${resultado.dados.map(p => `
                                <tr>
                                    <td>${p.id}</td>
                                    <td>${p.nome}</td>
                                    <td>R$ ${parseFloat(p.preco).toFixed(2)}</td>
                                    <td>${p.estoque}</td>
                                    <td><button onclick="excluir(${p.id})">🗑️ Excluir</button></td>
                                </tr>
                            `).join('')}
                        </table>
                        <p>Total: ${resultado.total} produto(s)</p>
                    `;
                    document.getElementById('produtos').innerHTML = tabela;
                }
            } catch (error) {
                console.error('Erro:', error);
            }
        }

        // Criar produto
        document.getElementById('formProduto').addEventListener('submit', async (e) => {
            e.preventDefault();

            const produto = {
                nome: document.getElementById('nome').value,
                preco: parseFloat(document.getElementById('preco').value),
                estoque: parseInt(document.getElementById('estoque').value),
            };

            const response = await fetch(API_URL, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(produto),
            });

            const resultado = await response.json();
            alert(resultado.mensagem);
            carregarProdutos();
            e.target.reset();
        });

        // Excluir produto
        async function excluir(id) {
            if (confirm('Deseja realmente excluir?')) {
                await fetch(`${API_URL}/${id}`, { method: 'DELETE' });
                carregarProdutos();
            }
        }

        // Carregar ao iniciar
        carregarProdutos();
    </script>
</body>
</html>
```

---

## 21. Padrões de Projeto (Design Patterns)

### 21.1 Singleton — Conexão única com o banco

```php
<?php
class Database
{
    private static ?PDO $instancia = null;

    // Construtor privado: impede `new Database()`
    private function __construct() {}

    // Clone privado: impede clonar
    private function __clone() {}

    public static function getInstancia(): PDO
    {
        if (self::$instancia === null) {
            self::$instancia = new PDO(
                'mysql:host=localhost;dbname=loja_ads;charset=utf8mb4',
                'root',
                '',
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]
            );
        }
        return self::$instancia;
    }
}

// Uso — sempre a MESMA conexão
$pdo = Database::getInstancia();
$pdo2 = Database::getInstancia();
var_dump($pdo === $pdo2);  // true (mesma instância)
```

### 21.2 Repository Pattern — Separando a lógica de dados

```php
<?php
// Interface do repositório
interface ProdutoRepositoryInterface
{
    public function findAll(): array;
    public function findById(int $id): ?array;
    public function create(array $dados): int;
    public function update(int $id, array $dados): bool;
    public function delete(int $id): bool;
}

// Implementação com MySQL
class ProdutoRepository implements ProdutoRepositoryInterface
{
    public function __construct(private PDO $pdo) {}

    public function findAll(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM produtos WHERE ativo = 1 ORDER BY nome");
        return $stmt->fetchAll();
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM produtos WHERE id = :id AND ativo = 1");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch() ?: null;
    }

    public function create(array $dados): int
    {
        $sql = "INSERT INTO produtos (nome, preco, estoque, categoria) 
                VALUES (:nome, :preco, :estoque, :categoria)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($dados);
        return (int) $this->pdo->lastInsertId();
    }

    public function update(int $id, array $dados): bool
    {
        $sql = "UPDATE produtos SET nome = :nome, preco = :preco, estoque = :estoque 
                WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $dados[':id'] = $id;
        $stmt->execute($dados);
        return $stmt->rowCount() > 0;
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare("UPDATE produtos SET ativo = 0 WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->rowCount() > 0;
    }
}

// Uso
$pdo = Database::getInstancia();
$repo = new ProdutoRepository($pdo);

$produtos = $repo->findAll();
$produto = $repo->findById(1);
$novoId = $repo->create([
    ':nome' => 'Monitor LG',
    ':preco' => 899.90,
    ':estoque' => 20,
    ':categoria' => 'Informática',
]);
```

### 21.3 MVC Simplificado (Model-View-Controller)

```php
<?php
// ============================================
// Model — Representa os dados
// ============================================
// src/Model/Produto.php
namespace App\Model;

class Produto
{
    public function __construct(
        private ?int $id,
        private string $nome,
        private float $preco,
        private int $estoque = 0,
        private string $categoria = 'Geral'
    ) {}

    // Getters e Setters...
    public function getId(): ?int { return $this->id; }
    public function getNome(): string { return $this->nome; }
    public function getPreco(): float { return $this->preco; }
    public function getEstoque(): int { return $this->estoque; }
    public function getCategoria(): string { return $this->categoria; }

    public function getPrecoFormatado(): string
    {
        return "R$ " . number_format($this->preco, 2, ',', '.');
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'preco' => $this->preco,
            'estoque' => $this->estoque,
            'categoria' => $this->categoria,
        ];
    }
}
```

```php
<?php
// ============================================
// Controller — Gerencia as requisições
// ============================================
// src/Controller/ProdutoController.php
namespace App\Controller;

use App\Model\Produto;

class ProdutoController
{
    public function __construct(
        private ProdutoRepository $repository
    ) {}

    public function index(): void
    {
        $produtos = $this->repository->findAll();
        
        // Carrega a view passando os dados
        $titulo = "Lista de Produtos";
        require __DIR__ . '/../../templates/produtos/listar.php';
    }

    public function show(int $id): void
    {
        $produto = $this->repository->findById($id);
        
        if (!$produto) {
            http_response_code(404);
            require __DIR__ . '/../../templates/404.php';
            return;
        }

        require __DIR__ . '/../../templates/produtos/detalhe.php';
    }

    public function store(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            require __DIR__ . '/../../templates/produtos/formulario.php';
            return;
        }

        // Validação e criação...
        $id = $this->repository->create([
            ':nome'      => $_POST['nome'],
            ':preco'     => (float) $_POST['preco'],
            ':estoque'   => (int) $_POST['estoque'],
            ':categoria' => $_POST['categoria'],
        ]);

        header("Location: /produtos?msg=Produto+criado+com+sucesso");
        exit;
    }
}
```

```php
<!-- ============================================ -->
<!-- View — Apresenta os dados ao usuário         -->
<!-- ============================================ -->
<!-- templates/produtos/listar.php -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($titulo) ?></title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <h1><?= htmlspecialchars($titulo) ?></h1>
    
    <?php if (isset($_GET['msg'])): ?>
        <div class="alerta sucesso"><?= htmlspecialchars($_GET['msg']) ?></div>
    <?php endif; ?>

    <a href="/produtos/novo" class="btn">+ Novo Produto</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Estoque</th>
                <th>Categoria</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produtos as $produto): ?>
                <tr>
                    <td><?= $produto['id'] ?></td>
                    <td><?= htmlspecialchars($produto['nome']) ?></td>
                    <td>R$ <?= number_format($produto['preco'], 2, ',', '.') ?></td>
                    <td><?= $produto['estoque'] ?></td>
                    <td><?= htmlspecialchars($produto['categoria']) ?></td>
                    <td>
                        <a href="/produtos/<?= $produto['id'] ?>">👁️ Ver</a>
                        <a href="/produtos/<?= $produto['id'] ?>/editar">✏️ Editar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
```

---

## 22. Boas Práticas e PSRs

### 22.1 O que são PSRs?

**PSR** (*PHP Standards Recommendation*) são padrões definidos pelo [PHP-FIG](https://www.php-fig.org/) para manter a consistência entre projetos PHP. As principais são:

| PSR    | Nome                        | Descrição                                   |
|--------|-----------------------------|---------------------------------------------|
| PSR-1  | Basic Coding Standard       | Padrões básicos de codificação              |
| PSR-4  | Autoloading Standard        | Carregamento automático de classes          |
| PSR-12 | Extended Coding Style Guide | Estilo de código (substitui a PSR-2)        |

### 22.2 Resumo das convenções

```php
<?php
// ✅ BOAS PRÁTICAS

// 1. Nomes de classes: PascalCase
class ProdutoController {}
class AuthService {}

// 2. Nomes de métodos e funções: camelCase
function calcularDesconto() {}
public function getNomeCompleto() {}

// 3. Nomes de constantes: UPPER_SNAKE_CASE
const MAX_TENTATIVAS = 3;
define('TAXA_PADRAO', 0.15);

// 4. Nomes de variáveis: camelCase
$nomeCompleto = "João Silva";
$precoComDesconto = 199.90;

// 5. Um arquivo = uma classe
// Usuario.php contém APENAS a classe Usuario

// 6. Tags PHP
<?php // ✅ Use sempre a tag completa
<?    // ❌ Nunca use tags curtas (exceto <?= para echo)

// 7. Indentação: 4 espaços (não tabs)

// 8. Chaves em classes e métodos: linha separada
class Exemplo
{
    public function metodo(): void
    {
        // código
    }
}

// 9. Chaves em estruturas de controle: mesma linha
if ($condicao) {
    // código
} else {
    // código
}

// 10. Tipo de retorno: sempre declare quando possível
public function calcular(float $valor): float
{
    return $valor * 1.1;
}
```

### 22.3 Checklist de boas práticas

```
✅ Sempre use Prepared Statements para queries SQL
✅ Escape todas as saídas com htmlspecialchars()
✅ Use password_hash() / password_verify() para senhas
✅ Valide e sanitize TODA entrada do usuário
✅ Use HTTPS em produção
✅ Mantenha o PHP atualizado
✅ Use Composer para gerenciar dependências
✅ Nunca exponha credenciais no código (use .env)
✅ Trate erros com try/catch
✅ Use tipagem estrita (declare(strict_types=1))
✅ Documente funções e classes com DocBlocks
✅ Siga as PSRs para manter código consistente
```

---

## 23. Projeto Final Integrador

### Proposta: Sistema de Gerenciamento de Tarefas (To-Do List)

Um sistema web completo que integra **todos os conceitos** estudados na disciplina (HTML, CSS, JavaScript e PHP).

### Requisitos Funcionais

1. **Autenticação:** Cadastro, login e logout de usuários.
2. **CRUD de Tarefas:** Criar, listar, editar, excluir e marcar como concluída.
3. **Categorias:** Agrupar tarefas por categorias.
4. **Filtros:** Filtrar por status (pendentes, concluídas) e buscar por texto.
5. **Dashboard:** Painel com estatísticas (total de tarefas, concluídas, pendentes).

### Requisitos Técnicos

| Tecnologia   | Aplicação                                            |
|-------------- |-----------------------------------------------------|
| **HTML**      | Estrutura semântica das páginas                     |
| **CSS**       | Layout responsivo e estilização                     |
| **JavaScript** | Interatividade, validações no client-side, fetch API |
| **PHP**       | Lógica do servidor, autenticação, API REST          |
| **MySQL**     | Armazenamento de dados                              |
| **PDO**       | Conexão segura com o banco                          |
| **Sessões**   | Controle de login/logout                            |
| **POO**       | Organização em classes (Model, Controller, Repository) |

### Estrutura do banco de dados

```sql
-- Banco de dados do projeto
CREATE DATABASE IF NOT EXISTS todo_ads CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE todo_ads;

-- Tabela de usuários
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    email VARCHAR(200) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de categorias
CREATE TABLE categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    cor VARCHAR(7) DEFAULT '#6c757d',
    usuario_id INT NOT NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);

-- Tabela de tarefas
CREATE TABLE tarefas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(200) NOT NULL,
    descricao TEXT,
    concluida BOOLEAN DEFAULT FALSE,
    prioridade ENUM('baixa', 'media', 'alta') DEFAULT 'media',
    data_limite DATE,
    categoria_id INT,
    usuario_id INT NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (categoria_id) REFERENCES categorias(id) ON DELETE SET NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);
```

### Estrutura de diretórios do projeto

```
todo-app/
├── public/
│   ├── index.php           ← Ponto de entrada principal
│   ├── css/
│   │   └── style.css       ← Estilos (CSS estudado anteriormente)
│   └── js/
│       └── app.js          ← Lógica client-side (JS estudado anteriormente)
├── src/
│   ├── Model/
│   │   ├── Usuario.php
│   │   ├── Tarefa.php
│   │   └── Categoria.php
│   ├── Repository/
│   │   ├── UsuarioRepository.php
│   │   ├── TarefaRepository.php
│   │   └── CategoriaRepository.php
│   ├── Controller/
│   │   ├── AuthController.php
│   │   ├── TarefaController.php
│   │   └── DashboardController.php
│   └── Database/
│       └── Conexao.php
├── templates/
│   ├── layout.php          ← Template base (header + footer)
│   ├── auth/
│   │   ├── login.php
│   │   └── cadastro.php
│   ├── tarefas/
│   │   ├── listar.php
│   │   ├── formulario.php
│   │   └── detalhe.php
│   └── dashboard.php
├── config/
│   └── database.php
├── composer.json
└── .gitignore
```

### Critérios de Avaliação

| Critério                                   | Peso |
|--------------------------------------------|------|
| Funcionalidades completas (CRUD + Auth)    | 30%  |
| Organização do código (POO, MVC)           | 20%  |
| Segurança (SQL Injection, XSS, CSRF, Hash) | 20%  |
| Interface responsiva e usabilidade          | 15%  |
| Integração front-end e back-end             | 15%  |

---

## 📚 Referências e Recursos Adicionais

### Documentação Oficial
- [PHP.net — Manual oficial](https://www.php.net/manual/pt_BR/)
- [PHP-FIG — PSRs](https://www.php-fig.org/psr/)

### Ferramentas
- [Composer — Gerenciador de dependências](https://getcomposer.org/)
- [Packagist — Repositório de pacotes PHP](https://packagist.org/)
- [XAMPP — Ambiente de desenvolvimento](https://www.apachefriends.org/)

### Prática
- [PHP: The Right Way](https://phptherightway.com/)
- [Laracasts — Cursos em vídeo](https://laracasts.com/)
- [Exercism — Exercícios de PHP](https://exercism.org/tracks/php)

---

> **📝 Nota do Professor:** Este material cobre os conceitos fundamentais e avançados de PHP necessários para a disciplina de Programação para Internet. Pratiquem cada exemplo, modifiquem o código, testem cenários diferentes. A melhor forma de aprender programação é **programando**! 🚀

---

*Material elaborado para a disciplina de Programação para Internet — Curso de Análise e Desenvolvimento de Sistemas.*
