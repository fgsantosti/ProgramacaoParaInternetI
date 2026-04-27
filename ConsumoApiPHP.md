# 🔗 Consumo de Dados e APIs com PHP

### Disciplina: Programação para Internet
### Curso: Análise e Desenvolvimento de Sistemas

> **Pré-requisitos:** HTML, CSS, JavaScript básico e fundamentos de PHP (variáveis, arrays, funções, estruturas de controle).

---

## 📋 Sumário

**Etapa 1 — Dados Internos (Array PHP)**
1. [Introdução: De onde vêm os dados?](#1-introdução-de-onde-vêm-os-dados)
2. [Consumindo um Array Interno](#2-consumindo-um-array-interno)
3. [Listando Dados em uma Tabela HTML](#3-listando-dados-em-uma-tabela-html)
4. [Exibindo Detalhes de um Item (Passagem por GET)](#4-exibindo-detalhes-de-um-item-passagem-por-get)
5. [Filtrando e Buscando nos Dados](#5-filtrando-e-buscando-nos-dados)

**Etapa 2 — Dados Externos em Arquivo (JSON Local)**
6. [O que é JSON e por que usá-lo?](#6-o-que-é-json-e-por-que-usá-lo)
7. [Criando o Arquivo JSON](#7-criando-o-arquivo-json)
8. [Lendo e Decodificando o JSON](#8-lendo-e-decodificando-o-json)
9. [Listando Produtos do JSON em Tabela HTML](#9-listando-produtos-do-json-em-tabela-html)
10. [Detalhe do Produto via JSON](#10-detalhe-do-produto-via-json)
11. [Escrevendo no JSON (Simulando um Cadastro)](#11-escrevendo-no-json-simulando-um-cadastro)

**Etapa 3 — API Externa (Consumindo Dados da Internet)**
12. [O que é uma API?](#12-o-que-é-uma-api)
13. [Como funciona uma requisição HTTP](#13-como-funciona-uma-requisição-http)
14. [Consumindo API com file_get_contents](#14-consumindo-api-com-file_get_contents)
15. [Consumindo API com cURL](#15-consumindo-api-com-curl)
16. [Exemplo Prático 1 — ViaCEP (Consulta de CEP)](#16-exemplo-prático-1--viacep-consulta-de-cep)
17. [Exemplo Prático 2 — API de Moedas (Cotação do Dólar)](#17-exemplo-prático-2--api-de-moedas-cotação-do-dólar)
18. [Exemplo Prático 3 — PokeAPI (Lista de Pokémons)](#18-exemplo-prático-3--pokeapi-lista-de-pokémons)
19. [Tratamento de Erros em APIs](#19-tratamento-de-erros-em-apis)
20. [Enviando Dados para uma API (POST)](#20-enviando-dados-para-uma-api-post)

**Encerramento**
21. [Comparativo: Array vs JSON vs API](#21-comparativo-array-vs-json-vs-api)
22. [Exercícios Propostos](#22-exercícios-propostos)

---

# ETAPA 1 — Dados Internos (Array PHP)

---

## 1. Introdução: De onde vêm os dados?

Em qualquer aplicação web, os dados precisam vir de **algum lugar**. Essa origem pode evoluir conforme o projeto cresce:

```
┌─────────────────────────────────────────────────────────────────────┐
│                    EVOLUÇÃO DAS FONTES DE DADOS                     │
│                                                                     │
│   📌 Nível 1          📁 Nível 2           🌐 Nível 3              │
│   Array PHP     →    Arquivo JSON     →    API Externa              │
│   (no código)        (no servidor)         (na Internet)            │
│                                                                     │
│   Simples,           Dados separados      Dados em tempo real,      │
│   fixo no código     do código            de outros serviços        │
│                                                                     │
│   Ex: lista fixa     Ex: produtos.json    Ex: ViaCEP, cotações,     │
│   de produtos        no servidor          clima, redes sociais      │
└─────────────────────────────────────────────────────────────────────┘
```

Neste tutorial, vamos percorrer essa evolução usando um tema consistente: **produtos de supermercado**. Ao final, você será capaz de consumir dados de qualquer fonte.

---

## 2. Consumindo um Array Interno

A forma mais simples de trabalhar com dados em PHP é usando **arrays** diretamente no código. É como ter uma "mini base de dados" dentro do próprio arquivo.

### 2.1 Criando o array de produtos

```php
<?php
// Dados definidos diretamente no código PHP (array interno)
$produtos = [
    ["id" => 1, "nome" => "Arroz 5kg",         "categoria" => "Grãos",      "preco" => 24.90, "estoque" => 150],
    ["id" => 2, "nome" => "Feijão 1kg",         "categoria" => "Grãos",      "preco" => 8.50,  "estoque" => 20],
    ["id" => 3, "nome" => "Leite Integral 1L",  "categoria" => "Laticínios", "preco" => 5.99,  "estoque" => 300],
    ["id" => 4, "nome" => "Óleo de Soja 900ml", "categoria" => "Óleos",      "preco" => 7.80,  "estoque" => 120],
    ["id" => 5, "nome" => "Açúcar 1kg",         "categoria" => "Mercearia",  "preco" => 4.50,  "estoque" => 180],
    ["id" => 6, "nome" => "Macarrão 500g",      "categoria" => "Massas",     "preco" => 3.99,  "estoque" => 250],
    ["id" => 7, "nome" => "Frango Inteiro 1kg", "categoria" => "Carnes",     "preco" => 12.90, "estoque" => 80],
    ["id" => 8, "nome" => "Sabão em Pó 1kg",    "categoria" => "Limpeza",    "preco" => 11.99, "estoque" => 90],
];
```

Cada produto é um **array associativo** (chave => valor) dentro de um array maior. Isso cria uma estrutura tabular onde cada elemento representa uma "linha" de dados.

### 2.2 Acessando os dados

```php
<?php
// Acessar um produto específico pelo índice
echo $produtos[0]['nome'];   // Arroz 5kg
echo $produtos[0]['preco'];  // 24.90

// Contar quantos produtos existem
echo count($produtos);       // 8

// Percorrer todos os produtos
foreach ($produtos as $produto) {
    echo $produto['nome'] . " — R$ " . number_format($produto['preco'], 2, ',', '.') . "<br>";
}
```

**Saída:**
```
Arroz 5kg — R$ 24,90
Feijão 1kg — R$ 8,50
Leite Integral 1L — R$ 5,99
...
```

> 💡 **Quando usar arrays internos?** Em exemplos didáticos, protótipos rápidos ou quando os dados são fixos e poucos (como uma lista de estados brasileiros, por exemplo).

---

## 3. Listando Dados em uma Tabela HTML

Agora vamos integrar o PHP com o HTML para exibir os produtos em uma tabela estilizada. Repare como o PHP gera o HTML dinamicamente:

### 📄 Arquivo: `lista_produtos.php`

```php
<?php
// =============================================
// FONTE DE DADOS: Array interno (hardcoded)
// =============================================
$produtos = [
    ["id" => 1, "nome" => "Arroz 5kg",         "categoria" => "Grãos",      "preco" => 24.90, "estoque" => 150],
    ["id" => 2, "nome" => "Feijão 1kg",         "categoria" => "Grãos",      "preco" => 8.50,  "estoque" => 20],
    ["id" => 3, "nome" => "Leite Integral 1L",  "categoria" => "Laticínios", "preco" => 5.99,  "estoque" => 300],
    ["id" => 4, "nome" => "Óleo de Soja 900ml", "categoria" => "Óleos",      "preco" => 7.80,  "estoque" => 120],
    ["id" => 5, "nome" => "Açúcar 1kg",         "categoria" => "Mercearia",  "preco" => 4.50,  "estoque" => 180],
    ["id" => 6, "nome" => "Macarrão 500g",      "categoria" => "Massas",     "preco" => 3.99,  "estoque" => 250],
    ["id" => 7, "nome" => "Frango Inteiro 1kg", "categoria" => "Carnes",     "preco" => 12.90, "estoque" => 80],
    ["id" => 8, "nome" => "Sabão em Pó 1kg",    "categoria" => "Limpeza",    "preco" => 11.99, "estoque" => 90],
];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Produtos do Supermercado</title>
    <style>
        body  { font-family: Arial, sans-serif; background: #f4f4f9; padding: 20px; }
        h2    { text-align: center; color: #333; }
        table { width: 100%; max-width: 800px; margin: 0 auto; border-collapse: collapse;
                background: #fff; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        th    { background-color: #007bff; color: #fff; padding: 12px; text-align: center; }
        td    { padding: 10px 14px; border-bottom: 1px solid #ddd; text-align: center; }
        tr:hover       { background-color: #f1f1f1; }
        .preco         { color: #28a745; font-weight: bold; }
        .baixo-estoque { color: #dc3545; font-weight: bold; }
        a { color: #007bff; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>

<h2>🛒 Produtos do Supermercado</h2>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Produto</th>
            <th>Categoria</th>
            <th>Preço</th>
            <th>Estoque</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($produtos as $p): ?>
        <tr>
            <td><?= $p['id'] ?></a></td>
            <td><?= $p['nome'] ?></td>
            <td><?= $p['categoria'] ?></td>
            <td class="preco">R$ <?= number_format($p['preco'], 2, ',', '.') ?></td>
            <td class="<​?= $p['estoque'] < 100 ? 'baixo-estoque' : '' ?>">
                <?= $p['estoque'] ?> <?= $p['estoque'] < 100 ? '⚠️' : '' ?>
            </td>
            <td>
                    <!-- Link passando o ID -->
                    <a href="detalhe_produto.php?id=<?= $p['id'] ?>">Ver Detalhes</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<p style="text-align:center; color:#555; margin-top:10px;">
    Total de produtos: <strong><?= count($produtos) ?></strong>
</p>

</body>
</html>
```

### Entendendo o código passo a passo

| Trecho | O que faz |
|--------|-----------|
| `<?php foreach ($produtos as $p): ?>` | Inicia o loop — para cada produto no array, gera uma linha `<tr>` |
| `<?= $p['id'] ?>` | Atalho para `<?php echo $p['id']; ?>` — exibe o valor |
| `htmlspecialchars()` | Protege contra XSS (converte caracteres especiais em entidades HTML) |
| `number_format($p['preco'], 2, ',', '.')` | Formata o número: 2 casas decimais, vírgula decimal, ponto de milhar |
| `$p['estoque'] < 100 ? 'baixo-estoque' : ''` | Operador ternário: aplica a classe CSS se estoque for baixo |
| `detalhe_produto.php?id=<?= $p['id'] ?>` | Cria um link passando o ID do produto via **GET** na URL |

### Resultado visual

```
┌────┬─────────────────────┬────────────┬──────────┬─────────┐
│ #  │ Produto             │ Categoria  │ Preço    │ Estoque │
├────┼─────────────────────┼────────────┼──────────┼─────────┤
│ 1  │ Arroz 5kg           │ Grãos      │ R$ 24,90 │ 150     │
│ 2  │ Feijão 1kg          │ Grãos      │ R$  8,50 │ 20  ⚠️  │
│ 3  │ Leite Integral 1L   │ Laticínios │ R$  5,99 │ 300     │
│ ...│ ...                 │ ...        │ ...      │ ...     │
└────┴─────────────────────┴────────────┴──────────┴─────────┘
```

---

## 4. Exibindo Detalhes de um Item (Passagem por GET)

Quando o usuário clica no ID de um produto, a URL muda para algo como:

```
detalhe_produto.php?id=3
```

O PHP captura esse `id` pela superglobal `$_GET` e busca o produto correspondente no array.

### 📄 Arquivo: `detalhe_produto.php`

```php
<?php
// =============================================
// FONTE DE DADOS: Mesmo array (em um sistema real,
// viria de um banco de dados ou arquivo externo)
// =============================================
$produtos = [
    ["id" => 1, "nome" => "Arroz 5kg",         "categoria" => "Grãos",      "preco" => 24.90, "estoque" => 150],
    ["id" => 2, "nome" => "Feijão 1kg",         "categoria" => "Grãos",      "preco" => 8.50,  "estoque" => 20],
    ["id" => 3, "nome" => "Leite Integral 1L",  "categoria" => "Laticínios", "preco" => 5.99,  "estoque" => 300],
    ["id" => 4, "nome" => "Óleo de Soja 900ml", "categoria" => "Óleos",      "preco" => 7.80,  "estoque" => 120],
    ["id" => 5, "nome" => "Açúcar 1kg",         "categoria" => "Mercearia",  "preco" => 4.50,  "estoque" => 180],
    ["id" => 6, "nome" => "Macarrão 500g",      "categoria" => "Massas",     "preco" => 3.99,  "estoque" => 250],
    ["id" => 7, "nome" => "Frango Inteiro 1kg", "categoria" => "Carnes",     "preco" => 12.90, "estoque" => 80],
    ["id" => 8, "nome" => "Sabão em Pó 1kg",    "categoria" => "Limpeza",    "preco" => 11.99, "estoque" => 90],
];

// =============================================
// PASSO 1: Capturar o ID da URL
// =============================================
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// =============================================
// PASSO 2: Buscar o produto pelo ID
// =============================================
function buscarProdutoPorId(int $id, array $produtos): ?array
{
    foreach ($produtos as $p) {
        if ($p['id'] === $id) {
            return $p; // Encontrou! Retorna o produto
        }
    }
    return null; // Não encontrou
}

$produto = buscarProdutoPorId($id, $produtos);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Detalhe do Produto</title>
    <style>
        body  { font-family: Arial, sans-serif; background: #f4f4f9; padding: 20px; }
        .card {
            max-width: 500px; margin: 40px auto; background: #fff;
            border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            padding: 30px; text-align: center;
        }
        .card h2     { color: #333; margin-bottom: 5px; }
        .categoria   { color: #6c757d; font-size: 14px; margin-bottom: 20px; }
        .preco       { font-size: 28px; color: #28a745; font-weight: bold; margin: 15px 0; }
        .estoque     { font-size: 16px; color: #555; }
        .baixo       { color: #dc3545; }
        .voltar      { display: inline-block; margin-top: 20px; padding: 10px 20px;
                       background: #007bff; color: #fff; text-decoration: none;
                       border-radius: 5px; }
        .voltar:hover { background: #0056b3; }
        .erro        { color: #dc3545; font-size: 18px; }
    </style>
</head>
<body>

<div class="card">
    <?php if ($produto): ?>
        <!-- Produto encontrado: exibe os detalhes -->
        <p class="categoria">📂 <?= htmlspecialchars($produto['categoria']) ?></p>
        <h2><?= htmlspecialchars($produto['nome']) ?></h2>
        <p class="preco">R$ <?= number_format($produto['preco'], 2, ',', '.') ?></p>
        <p class="estoque <?= $produto['estoque'] < 100 ? 'baixo' : '' ?>">
            📦 Estoque: <?= $produto['estoque'] ?> unidades
            <?= $produto['estoque'] < 100 ? ' — Estoque baixo! ⚠️' : '' ?>
        </p>
        <p style="color:#999; font-size:12px;">ID do produto: #<?= $produto['id'] ?></p>
    <?php else: ?>
        <!-- Produto NÃO encontrado -->
        <p class="erro">❌ Produto não encontrado!</p>
        <p>O produto com ID <strong><?= $id ?></strong> não existe no sistema.</p>
    <?php endif; ?>

    <a href="lista_produtos.php" class="voltar">← Voltar à lista</a>
</div>

</body>
</html>
```

### O fluxo completo

```
  lista_produtos.php                              detalhe_produto.php
 ┌──────────────────┐                          ┌──────────────────────┐
 │ Tabela com todos  │   Clica no ID = 3       │ Captura $_GET['id']  │
 │ os produtos       │ ──────────────────────▶  │ Busca no array       │
 │                   │   URL: ?id=3             │ Exibe os detalhes    │
 └──────────────────┘                          └──────────────────────┘
```

### ⚠️ Problema: dados duplicados!

Perceba que o **mesmo array** está nos dois arquivos. Se precisarmos adicionar um produto, teremos que alterar **ambos os arquivos**. Isso é inviável em projetos reais. É exatamente esse problema que resolveremos na **Etapa 2** com arquivos JSON.

---

## 5. Filtrando e Buscando nos Dados

Antes de avançar para a Etapa 2, vamos aprender a filtrar dados — uma habilidade essencial para qualquer fonte de dados:

### 📄 Arquivo: `buscar_produtos.php`

```php
<?php
$produtos = [
    ["id" => 1, "nome" => "Arroz 5kg",         "categoria" => "Grãos",      "preco" => 24.90, "estoque" => 150],
    ["id" => 2, "nome" => "Feijão 1kg",         "categoria" => "Grãos",      "preco" => 8.50,  "estoque" => 20],
    ["id" => 3, "nome" => "Leite Integral 1L",  "categoria" => "Laticínios", "preco" => 5.99,  "estoque" => 300],
    ["id" => 4, "nome" => "Óleo de Soja 900ml", "categoria" => "Óleos",      "preco" => 7.80,  "estoque" => 120],
    ["id" => 5, "nome" => "Açúcar 1kg",         "categoria" => "Mercearia",  "preco" => 4.50,  "estoque" => 180],
    ["id" => 6, "nome" => "Macarrão 500g",      "categoria" => "Massas",     "preco" => 3.99,  "estoque" => 250],
    ["id" => 7, "nome" => "Frango Inteiro 1kg", "categoria" => "Carnes",     "preco" => 12.90, "estoque" => 80],
    ["id" => 8, "nome" => "Sabão em Pó 1kg",    "categoria" => "Limpeza",    "preco" => 11.99, "estoque" => 90],
];

// Captura os filtros do formulário (GET)
$busca = trim($_GET['busca'] ?? '');
$categoriaFiltro = $_GET['categoria'] ?? '';

// =============================================
// FILTRAGEM DOS DADOS
// =============================================
$resultados = $produtos;

// Filtro por texto (busca no nome)
if (!empty($busca)) {
    $resultados = array_filter($resultados, function ($p) use ($busca) {
        return stripos($p['nome'], $busca) !== false;
        // stripos = busca case-insensitive (ignora maiúsculas/minúsculas)
    });
}

// Filtro por categoria
if (!empty($categoriaFiltro)) {
    $resultados = array_filter($resultados, function ($p) use ($categoriaFiltro) {
        return $p['categoria'] === $categoriaFiltro;
    });
}

// Extrair categorias únicas (para preencher o <select>)
$categorias = array_unique(array_column($produtos, 'categoria'));
sort($categorias);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Buscar Produtos</title>
    <style>
        body  { font-family: Arial, sans-serif; background: #f4f4f9; padding: 20px; }
        h2    { text-align: center; color: #333; }
        .filtros {
            max-width: 800px; margin: 0 auto 20px; display: flex;
            gap: 10px; justify-content: center; flex-wrap: wrap;
        }
        .filtros input, .filtros select {
            padding: 10px; border: 1px solid #ccc; border-radius: 5px; font-size: 14px;
        }
        .filtros input  { width: 300px; }
        .filtros button {
            padding: 10px 20px; background: #007bff; color: #fff;
            border: none; border-radius: 5px; cursor: pointer;
        }
        table { width: 100%; max-width: 800px; margin: 0 auto; border-collapse: collapse;
                background: #fff; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        th    { background-color: #007bff; color: #fff; padding: 12px; }
        td    { padding: 10px 14px; border-bottom: 1px solid #ddd; text-align: center; }
        tr:hover { background-color: #f1f1f1; }
        .preco { color: #28a745; font-weight: bold; }
        .info  { text-align: center; color: #555; margin-top: 10px; }
    </style>
</head>
<body>

<h2>🔍 Buscar Produtos</h2>

<!-- Formulário de busca (método GET para permitir compartilhar a URL) -->
<form class="filtros" method="GET">
    <input type="text" name="busca" placeholder="Buscar por nome..."
           value="<?= htmlspecialchars($busca) ?>">

    <select name="categoria">
        <option value="">Todas as categorias</option>
        <?php foreach ($categorias as $cat): ?>
            <option value="<?= htmlspecialchars($cat) ?>"
                    <?= $cat === $categoriaFiltro ? 'selected' : '' ?>>
                <?= htmlspecialchars($cat) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Buscar</button>
</form>

<?php if (count($resultados) > 0): ?>
    <table>
        <thead>
            <tr><th>#</th><th>Produto</th><th>Categoria</th><th>Preço</th><th>Estoque</th></tr>
        </thead>
        <tbody>
            <?php foreach ($resultados as $p): ?>
            <tr>
                <td><?= $p['id'] ?></td>
                <td><?= htmlspecialchars($p['nome']) ?></td>
                <td><?= htmlspecialchars($p['categoria']) ?></td>
                <td class="preco">R$ <?= number_format($p['preco'], 2, ',', '.') ?></td>
                <td><?= $p['estoque'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <p class="info">Exibindo <strong><?= count($resultados) ?></strong> de <?= count($produtos) ?> produtos.</p>
<?php else: ?>
    <p class="info">❌ Nenhum produto encontrado para os filtros aplicados.</p>
<?php endif; ?>

</body>
</html>
```

### Funções-chave utilizadas

| Função | O que faz | Exemplo |
|--------|-----------|---------|
| `array_filter()` | Filtra elementos de um array com base em uma condição | Retorna apenas os produtos que passam no teste |
| `stripos()` | Busca texto dentro de outro (case-insensitive) | `stripos("Arroz 5kg", "arroz")` → `0` (encontrou) |
| `array_column()` | Extrai uma "coluna" de um array multidimensional | `array_column($produtos, 'categoria')` → `["Grãos", "Grãos", "Laticínios", ...]` |
| `array_unique()` | Remove valores duplicados | `["Grãos", "Grãos", "Laticínios"]` → `["Grãos", "Laticínios"]` |

---

# ETAPA 2 — Dados Externos em Arquivo (JSON Local)

---

## 6. O que é JSON e por que usá-lo?

### 6.1 Definição

**JSON** (*JavaScript Object Notation*) é um formato leve para troca de dados. Ele é:

- 📖 Legível por humanos.
- 🤖 Fácil de interpretar por máquinas.
- 🌐 O formato **padrão** de comunicação na web (APIs usam JSON).

### 6.2 Comparação: Array PHP vs. JSON

```
 ARRAY PHP (dentro do código)             JSON (arquivo externo)
 ┌──────────────────────────┐             ┌──────────────────────────┐
 │ $produtos = [             │             │ [                        │
 │   [                       │             │   {                      │
 │     "id" => 1,            │     ───▶    │     "id": 1,             │
 │     "nome" => "Arroz 5kg" │             │     "nome": "Arroz 5kg"  │
 │   ]                       │             │   }                      │
 │ ];                        │             │ ]                        │
 └──────────────────────────┘             └──────────────────────────┘
      Dados NO código                          Dados FORA do código
      (difícil de manter)                      (fácil de manter)
```

### 6.3 Diferenças de sintaxe

| Característica | Array PHP | JSON |
|----------------|-----------|------|
| Associação chave-valor | `"chave" => "valor"` | `"chave": "valor"` |
| Strings | Aspas simples ou duplas | **Somente** aspas duplas |
| Vírgula final | Permitida `[1, 2, 3,]` | **Proibida** `[1, 2, 3]` |
| Comentários | Sim (`//`, `/* */`) | **Não** permite comentários |
| Booleanos | `true` / `false` | `true` / `false` (minúsculos) |
| Nulo | `null` | `null` |

### 6.4 Vantagens de separar os dados em JSON

1. **Separação de responsabilidades:** Os dados ficam separados da lógica e da apresentação.
2. **Reutilização:** Vários arquivos PHP podem ler o mesmo JSON.
3. **Facilidade de manutenção:** Para adicionar um produto, basta editar o `.json`.
4. **Compatibilidade:** JSON é universal — funciona com PHP, JavaScript, Python, Java etc.
5. **Preparação para APIs:** Dados em JSON são idênticos aos retornados por APIs.

---

## 7. Criando o Arquivo JSON

### 📄 Arquivo: `produtos.json`

```json
[
    {"id": 1, "nome": "Arroz 5kg",         "categoria": "Grãos",      "preco": 24.90, "estoque": 150},
    {"id": 2, "nome": "Feijão 1kg",         "categoria": "Grãos",      "preco": 8.50,  "estoque": 200},
    {"id": 3, "nome": "Leite Integral 1L",  "categoria": "Laticínios", "preco": 5.99,  "estoque": 300},
    {"id": 4, "nome": "Óleo de Soja 900ml", "categoria": "Óleos",      "preco": 7.80,  "estoque": 50},
    {"id": 5, "nome": "Açúcar 1kg",         "categoria": "Mercearia",  "preco": 4.50,  "estoque": 180},
    {"id": 6, "nome": "Macarrão 500g",      "categoria": "Massas",     "preco": 3.99,  "estoque": 250},
    {"id": 7, "nome": "Frango Inteiro 1kg", "categoria": "Carnes",     "preco": 12.90, "estoque": 80},
    {"id": 8, "nome": "Sabão em Pó 1kg",    "categoria": "Limpeza",    "preco": 11.99, "estoque": 90}
]
```

> ⚠️ **Cuidado:** O último item do array JSON **não pode ter vírgula** no final. Essa é uma causa comum de erros.

---

## 8. Lendo e Decodificando o JSON

### 8.1 As duas funções essenciais

Para trabalhar com JSON em PHP, usamos:

| Função | Direção | O que faz |
|--------|---------|-----------|
| `json_decode()` | JSON → PHP | Converte uma string JSON em array/objeto PHP |
| `json_encode()` | PHP → JSON | Converte um array/objeto PHP em string JSON |

### 8.2 Lendo o arquivo JSON passo a passo

```php
<?php
// =============================================
// PASSO 1: Definir o caminho do arquivo
// =============================================
$arquivo = 'produtos.json';

// =============================================
// PASSO 2: Verificar se o arquivo existe
// =============================================
if (!file_exists($arquivo)) {
    die("❌ Arquivo '$arquivo' não encontrado!");
}

// =============================================
// PASSO 3: Ler o conteúdo do arquivo
// =============================================
$conteudo = file_get_contents($arquivo);
// $conteudo agora é uma STRING contendo todo o texto do arquivo JSON

echo gettype($conteudo); // string
echo $conteudo;          // [{"id": 1, "nome": "Arroz 5kg", ...}, ...]

// =============================================
// PASSO 4: Converter JSON (string) → Array PHP
// =============================================
$produtos = json_decode($conteudo, true);
//                                  ^^^^
//                                  true = retorna ARRAY associativo
//                                  false (ou omitido) = retorna OBJETO

echo gettype($produtos); // array
echo count($produtos);   // 8

// =============================================
// PASSO 5: Verificar se a conversão deu certo
// =============================================
if (json_last_error() !== JSON_ERROR_NONE) {
    die("❌ Erro ao decodificar o JSON: " . json_last_error_msg());
}

// =============================================
// PRONTO! Agora $produtos é um array PHP normal
// =============================================
foreach ($produtos as $p) {
    echo $p['nome'] . " — R$ " . number_format($p['preco'], 2, ',', '.') . "<br>";
}
```

### 8.3 json_decode — Array vs. Objeto

```php
<?php
$json = '{"nome": "Arroz", "preco": 24.90}';

// Como ARRAY (segundo parâmetro = true)
$array = json_decode($json, true);
echo $array['nome'];     // Arroz
echo $array['preco'];    // 24.90

// Como OBJETO (segundo parâmetro = false ou omitido)
$objeto = json_decode($json);
echo $objeto->nome;      // Arroz
echo $objeto->preco;     // 24.90
```

> 💡 **Recomendação:** Use `json_decode($json, true)` (como array) — é mais prático e consistente com o restante do código PHP.

### 8.4 Tratamento de erros comuns no JSON

```php
<?php
// JSON inválido — vírgula sobrando no final
$jsonErrado = '[{"id": 1, "nome": "Arroz"},]';
$dados = json_decode($jsonErrado, true);

if ($dados === null && json_last_error() !== JSON_ERROR_NONE) {
    echo "Erro: " . json_last_error_msg();
    // Erro: Syntax error
}

// Possíveis erros:
// JSON_ERROR_SYNTAX        — Erro de sintaxe (vírgula extra, aspas erradas)
// JSON_ERROR_UTF8          — Caracteres UTF-8 malformados
// JSON_ERROR_DEPTH         — Profundidade máxima excedida
// JSON_ERROR_NONE          — Nenhum erro (tudo OK!)
```

---

## 9. Listando Produtos do JSON em Tabela HTML

Agora a grande mudança: **a fonte de dados é o arquivo JSON**, não mais o array no código.

### 📄 Arquivo: `lista_produtos_json.php`

```php
<?php
// =============================================
// FONTE DE DADOS: Arquivo JSON externo
// =============================================
$arquivo = 'produtos.json';

// 1. Verifica se o arquivo existe
if (!file_exists($arquivo)) {
    die("<p style='color:red'>❌ Arquivo '$arquivo' não encontrado.</p>");
}

// 2. Lê o conteúdo do arquivo
$conteudo = file_get_contents($arquivo);

// 3. Converte o JSON em array PHP
$produtos = json_decode($conteudo, true);

// 4. Verifica se o JSON é válido
if (json_last_error() !== JSON_ERROR_NONE) {
    die("<p style='color:red'>❌ Erro ao ler o JSON: " . json_last_error_msg() . "</p>");
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Produtos — Leitura de JSON</title>
    <style>
        body  { font-family: Arial, sans-serif; background: #f4f4f9; padding: 20px; }
        h2    { text-align: center; color: #333; }
        .fonte { text-align: center; color: #888; font-size: 13px; margin-bottom: 15px; }
        table { width: 100%; max-width: 800px; margin: 0 auto; border-collapse: collapse;
                background: #fff; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        th    { background-color: #007bff; color: #fff; padding: 12px; text-align: center; }
        td    { padding: 10px 14px; border-bottom: 1px solid #ddd; text-align: center; }
        tr:hover       { background-color: #f1f1f1; }
        .preco         { color: #28a745; font-weight: bold; }
        .baixo-estoque { color: #dc3545; font-weight: bold; }
        a { color: #007bff; text-decoration: none; }
        a:hover { text-decoration: underline; }
        .total { text-align: right; max-width: 800px; margin: 10px auto;
                 font-size: 14px; color: #555; }
    </style>
</head>
<body>

<h2>📦 Produtos do Supermercado</h2>
<p class="fonte">Fonte de dados: <code>produtos.json</code></p>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Produto</th>
            <th>Categoria</th>
            <th>Preço</th>
            <th>Estoque</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($produtos as $p): ?>
        <tr>
            <td>
                <a href="detalhe_produto_json.php?id=<?= $p['id'] ?>">
                    <?= $p['id'] ?>
                </a>
            </td>
            <td><?= htmlspecialchars($p['nome']) ?></td>
            <td><?= htmlspecialchars($p['categoria']) ?></td>
            <td class="preco">R$ <?= number_format($p['preco'], 2, ',', '.') ?></td>
            <td class="<?= $p['estoque'] < 100 ? 'baixo-estoque' : '' ?>">
                <?= $p['estoque'] ?> <?= $p['estoque'] < 100 ? '⚠️' : '' ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<p class="total">Total de produtos: <strong><?= count($produtos) ?></strong></p>

</body>
</html>
```

### O que mudou em relação à Etapa 1?

```
 ANTES (Etapa 1)                         DEPOIS (Etapa 2)
 ┌──────────────────────┐                ┌──────────────────────┐
 │ $produtos = [         │                │ $conteudo =           │
 │   ["id"=>1, ...],     │    ───▶        │   file_get_contents(  │
 │   ["id"=>2, ...],     │                │     'produtos.json'   │
 │   ...                 │                │   );                  │
 │ ];                    │                │ $produtos =           │
 │                       │                │   json_decode(        │
 │                       │                │     $conteudo, true   │
 │                       │                │   );                  │
 └──────────────────────┘                └──────────────────────┘
  Dados no código                         Dados em arquivo separado
  (repetidos em cada arquivo)             (uma única fonte de verdade)
```

O restante do código HTML/PHP permanece **idêntico**! A forma de percorrer e exibir os dados não muda — apenas a **origem** dos dados é diferente.

---

## 10. Detalhe do Produto via JSON

### 📄 Arquivo: `detalhe_produto_json.php`

```php
<?php
// =============================================
// FONTE DE DADOS: Arquivo JSON externo
// =============================================
$arquivo = 'produtos.json';

if (!file_exists($arquivo)) {
    die("<p style='color:red'>❌ Arquivo '$arquivo' não encontrado.</p>");
}

$conteudo = file_get_contents($arquivo);
$produtos = json_decode($conteudo, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    die("<p style='color:red'>❌ Erro ao ler o JSON: " . json_last_error_msg() . "</p>");
}

// =============================================
// Capturar o ID e buscar o produto
// =============================================
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Função para buscar produto por ID
function buscarProdutoPorId(int $id, array $produtos): ?array
{
    foreach ($produtos as $p) {
        if ($p['id'] === $id) {
            return $p;
        }
    }
    return null;
}

$produto = buscarProdutoPorId($id, $produtos);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title><?= $produto ? htmlspecialchars($produto['nome']) : 'Produto não encontrado' ?></title>
    <style>
        body  { font-family: Arial, sans-serif; background: #f4f4f9; padding: 20px; }
        .card {
            max-width: 500px; margin: 40px auto; background: #fff;
            border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            padding: 30px; text-align: center;
        }
        .card h2     { color: #333; margin-bottom: 5px; }
        .categoria   { display: inline-block; background: #e9ecef; padding: 4px 12px;
                       border-radius: 20px; color: #495057; font-size: 13px; margin-bottom: 15px; }
        .preco       { font-size: 32px; color: #28a745; font-weight: bold; margin: 15px 0; }
        .info-row    { display: flex; justify-content: space-around; margin: 20px 0;
                       padding: 15px; background: #f8f9fa; border-radius: 8px; }
        .info-item   { text-align: center; }
        .info-label  { font-size: 12px; color: #6c757d; display: block; }
        .info-value  { font-size: 18px; font-weight: bold; color: #333; }
        .baixo       { color: #dc3545; }
        .voltar      { display: inline-block; margin-top: 20px; padding: 10px 20px;
                       background: #007bff; color: #fff; text-decoration: none;
                       border-radius: 5px; }
        .voltar:hover { background: #0056b3; }
        .erro         { color: #dc3545; font-size: 18px; }
    </style>
</head>
<body>

<div class="card">
    <?php if ($produto): ?>
        <span class="categoria">📂 <?= htmlspecialchars($produto['categoria']) ?></span>
        <h2><?= htmlspecialchars($produto['nome']) ?></h2>
        <p class="preco">R$ <?= number_format($produto['preco'], 2, ',', '.') ?></p>

        <div class="info-row">
            <div class="info-item">
                <span class="info-label">ID</span>
                <span class="info-value">#<?= $produto['id'] ?></span>
            </div>
            <div class="info-item">
                <span class="info-label">Estoque</span>
                <span class="info-value <?= $produto['estoque'] < 100 ? 'baixo' : '' ?>">
                    <?= $produto['estoque'] ?> un.
                    <?= $produto['estoque'] < 100 ? '⚠️' : '✅' ?>
                </span>
            </div>
            <div class="info-item">
                <span class="info-label">Valor Total em Estoque</span>
                <span class="info-value">
                    R$ <?= number_format($produto['preco'] * $produto['estoque'], 2, ',', '.') ?>
                </span>
            </div>
        </div>
    <?php else: ?>
        <p class="erro">❌ Produto não encontrado!</p>
        <p>O produto com ID <strong><?= $id ?></strong> não existe.</p>
    <?php endif; ?>

    <a href="lista_produtos_json.php" class="voltar">← Voltar à lista</a>
</div>

</body>
</html>
```

---

## 11. Escrevendo no JSON (Simulando um Cadastro)

Além de ler, podemos **escrever** no arquivo JSON — simulando operações de cadastro:

### 📄 Arquivo: `cadastrar_produto.php`

```php
<?php
$arquivo = 'produtos.json';
$mensagem = '';
$tipo = '';

// =============================================
// Ler os produtos atuais do JSON
// =============================================
function lerProdutos(string $arquivo): array
{
    if (!file_exists($arquivo)) {
        return [];
    }
    $conteudo = file_get_contents($arquivo);
    return json_decode($conteudo, true) ?? [];
}

// =============================================
// Salvar produtos no JSON
// =============================================
function salvarProdutos(string $arquivo, array $produtos): bool
{
    $json = json_encode($produtos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    return file_put_contents($arquivo, $json) !== false;
}

// =============================================
// Processar o formulário (quando enviado via POST)
// =============================================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome      = trim($_POST['nome'] ?? '');
    $categoria = trim($_POST['categoria'] ?? '');
    $preco     = (float) ($_POST['preco'] ?? 0);
    $estoque   = (int) ($_POST['estoque'] ?? 0);

    // Validação simples
    if (empty($nome) || empty($categoria) || $preco <= 0) {
        $mensagem = "❌ Preencha todos os campos corretamente!";
        $tipo = "erro";
    } else {
        // Ler produtos atuais
        $produtos = lerProdutos($arquivo);

        // Gerar próximo ID automaticamente
        $ultimoId = 0;
        foreach ($produtos as $p) {
            if ($p['id'] > $ultimoId) {
                $ultimoId = $p['id'];
            }
        }

        // Criar novo produto
        $novoProduto = [
            "id"        => $ultimoId + 1,
            "nome"      => $nome,
            "categoria" => $categoria,
            "preco"     => $preco,
            "estoque"   => $estoque
        ];

        // Adicionar ao array e salvar
        $produtos[] = $novoProduto;

        if (salvarProdutos($arquivo, $produtos)) {
            $mensagem = "✅ Produto '{$nome}' cadastrado com sucesso! (ID: {$novoProduto['id']})";
            $tipo = "sucesso";
        } else {
            $mensagem = "❌ Erro ao salvar o arquivo JSON.";
            $tipo = "erro";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Produto</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f9; padding: 20px; }
        h2   { text-align: center; color: #333; }
        form {
            max-width: 500px; margin: 0 auto; background: #fff;
            padding: 25px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        label  { display: block; margin-top: 12px; font-weight: bold; color: #333; }
        input, select {
            width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc;
            border-radius: 5px; font-size: 14px; box-sizing: border-box;
        }
        button {
            width: 100%; margin-top: 20px; padding: 12px; font-size: 16px;
            background: #28a745; color: #fff; border: none; border-radius: 5px; cursor: pointer;
        }
        button:hover { background: #218838; }
        .mensagem {
            max-width: 500px; margin: 15px auto; padding: 12px;
            border-radius: 5px; text-align: center; font-weight: bold;
        }
        .sucesso { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .erro    { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .link    { text-align: center; margin-top: 15px; }
        .link a  { color: #007bff; text-decoration: none; }
    </style>
</head>
<body>

<h2>➕ Cadastrar Novo Produto</h2>

<?php if (!empty($mensagem)): ?>
    <div class="mensagem <?= $tipo ?>"><?= htmlspecialchars($mensagem) ?></div>
<?php endif; ?>

<form method="POST">
    <label for="nome">Nome do Produto:</label>
    <input type="text" id="nome" name="nome" placeholder="Ex: Café 500g" required>

    <label for="categoria">Categoria:</label>
    <select id="categoria" name="categoria" required>
        <option value="">Selecione...</option>
        <option value="Grãos">Grãos</option>
        <option value="Laticínios">Laticínios</option>
        <option value="Carnes">Carnes</option>
        <option value="Massas">Massas</option>
        <option value="Óleos">Óleos</option>
        <option value="Mercearia">Mercearia</option>
        <option value="Limpeza">Limpeza</option>
        <option value="Bebidas">Bebidas</option>
    </select>

    <label for="preco">Preço (R$):</label>
    <input type="number" id="preco" name="preco" step="0.01" min="0.01" placeholder="Ex: 12.90" required>

    <label for="estoque">Estoque:</label>
    <input type="number" id="estoque" name="estoque" min="0" placeholder="Ex: 100" required>

    <button type="submit">Cadastrar Produto</button>
</form>

<p class="link">
    <a href="lista_produtos_json.php">📦 Ver lista de produtos</a>
</p>

</body>
</html>
```

### Fluxo completo da Etapa 2

```
                      produtos.json
                    ┌───────────────┐
     Ler            │ [             │          Escrever
  ┌────────────────▶│   {...},      │◀────────────────┐
  │  file_get_      │   {...},      │  file_put_       │
  │  contents()     │   {...}       │  contents()      │
  │  + json_decode()│ ]             │  + json_encode() │
  │                 └───────────────┘                  │
  │                                                    │
  ▼                                                    │
 lista_produtos_json.php              cadastrar_produto.php
 detalhe_produto_json.php
 buscar_produtos_json.php
```

---

# ETAPA 3 — API Externa (Consumindo Dados da Internet)

---

## 12. O que é uma API?

### 12.1 Definição

**API** (*Application Programming Interface*) é uma "ponte" que permite que sistemas diferentes se comuniquem. Quando falamos de **API Web** (ou API REST), estamos falando de um serviço disponível na Internet que podemos acessar via HTTP para obter ou enviar dados.

### 12.2 Analogia: API como um garçom

```
 ┌──────────┐      Pedido         ┌──────────┐      Prepara       ┌──────────┐
 │           │    (Requisição)     │           │     os dados       │           │
 │  Você     │ ──────────────────▶ │  Garçom   │ ────────────────▶  │  Cozinha  │
 │ (Cliente) │                     │  (API)    │                    │ (Servidor)│
 │           │ ◀────────────────── │           │ ◀────────────────  │           │
 │           │     Prato           │           │     Dados          │           │
 └──────────┘   (Resposta JSON)   └──────────┘    prontos          └──────────┘
```

- **Você (Cliente):** Seu código PHP que faz a requisição.
- **Garçom (API):** A URL da API que recebe seu pedido e entrega a resposta.
- **Cozinha (Servidor):** O serviço remoto que processa e prepara os dados.

### 12.3 APIs públicas — Exemplos reais

| API | URL | O que fornece |
|-----|-----|---------------|
| **ViaCEP** | `viacep.com.br` | Dados de endereço a partir do CEP |
| **AwesomeAPI** | `economia.awesomeapi.com.br` | Cotações de moedas em tempo real |
| **PokeAPI** | `pokeapi.co` | Dados de Pokémons |
| **IBGE** | `servicodados.ibge.gov.br` | Dados geográficos do Brasil |
| **OpenWeather** | `openweathermap.org` | Previsão do tempo |
| **JSONPlaceholder** | `jsonplaceholder.typicode.com` | API fake para testes |

> 💡 Todas essas APIs retornam dados em **JSON** — o formato que aprendemos na Etapa 2!

---

## 13. Como funciona uma requisição HTTP

### 13.1 O ciclo completo

```
  Seu código PHP                    Internet                    Servidor da API
 ┌──────────────┐                                             ┌──────────────────┐
 │              │   1. Requisição HTTP (GET)                   │                  │
 │ file_get_    │ ──────────────────────────────────────────▶  │  viacep.com.br   │
 │ contents()   │   URL: viacep.com.br/ws/01001000/json/      │                  │
 │   ou cURL    │                                              │  Processa...     │
 │              │   2. Resposta HTTP (JSON)                    │                  │
 │              │ ◀──────────────────────────────────────────  │  Retorna dados   │
 │ json_decode()│   {"cep":"01001-000","logradouro":"Praça.."}│                  │
 │              │                                              │                  │
 └──────────────┘                                             └──────────────────┘
       │
       ▼
  3. Exibe os dados
  no HTML da página
```

### 13.2 Métodos HTTP mais comuns

| Método | Ação | Analogia |
|--------|------|----------|
| **GET** | Buscar/ler dados | "Me dá a informação do CEP 01001-000" |
| **POST** | Enviar/criar dados | "Aqui estão os dados de um novo cadastro" |
| **PUT** | Atualizar dados | "Atualize o cadastro do cliente #42" |
| **DELETE** | Excluir dados | "Remova o produto #7" |

### 13.3 Estrutura de uma resposta HTTP

```
HTTP/1.1 200 OK                    ← Status Code (200 = sucesso)
Content-Type: application/json     ← Tipo do conteúdo (JSON)
                                   
{                                  ← Corpo da resposta (os dados)
  "cep": "01001-000",
  "logradouro": "Praça da Sé",
  "bairro": "Sé",
  "localidade": "São Paulo",
  "uf": "SP"
}
```

**Códigos de status mais comuns:**

| Código | Significado | Quando acontece |
|--------|-------------|-----------------|
| `200` | OK | Tudo funcionou |
| `201` | Created | Recurso criado com sucesso |
| `400` | Bad Request | Requisição mal formada |
| `401` | Unauthorized | Falta autenticação |
| `404` | Not Found | Recurso não encontrado |
| `500` | Internal Server Error | Erro no servidor da API |

---

## 14. Consumindo API com file_get_contents

A forma mais simples de consumir uma API em PHP é usando `file_get_contents()` — a mesma função que usamos para ler arquivos locais!

### 14.1 A conexão com a Etapa 2

Perceba a semelhança:

```php
<?php
// ETAPA 2 — Lendo arquivo JSON local
$conteudo = file_get_contents('produtos.json');
$dados = json_decode($conteudo, true);

// ETAPA 3 — Lendo JSON de uma API (URL)
$conteudo = file_get_contents('https://viacep.com.br/ws/01001000/json/');
$dados = json_decode($conteudo, true);

// A ÚNICA diferença é a origem: caminho local → URL!
```

> 🎯 **Essa é a beleza do JSON:** O mesmo código que lê um arquivo local funciona para ler dados da Internet!

### 14.2 Exemplo básico

```php
<?php
// Consultando o CEP da Praça da Sé (São Paulo)
$url = 'https://viacep.com.br/ws/01001000/json/';

// 1. Faz a requisição GET para a API
$resposta = file_get_contents($url);

// 2. Converte o JSON recebido em array PHP
$endereco = json_decode($resposta, true);

// 3. Exibe os dados
echo "CEP: "         . $endereco['cep'] . "<br>";
echo "Logradouro: "  . $endereco['logradouro'] . "<br>";
echo "Bairro: "      . $endereco['bairro'] . "<br>";
echo "Cidade: "      . $endereco['localidade'] . "<br>";
echo "Estado: "      . $endereco['uf'] . "<br>";
```

**Saída:**
```
CEP: 01001-000
Logradouro: Praça da Sé
Bairro: Sé
Cidade: São Paulo
Estado: SP
```

### 14.3 Limitações do file_get_contents

| Limitação | Descrição |
|-----------|-----------|
| Apenas GET | Não permite POST, PUT, DELETE (sem configuração extra) |
| Sem controle de erros HTTP | Se a API retornar 404, pode gerar warning |
| Sem timeout personalizado | Pode "travar" se a API demorar |
| Bloqueado em alguns servidores | `allow_url_fopen` pode estar desativado |

Para superar essas limitações, usamos o **cURL**.

---

## 15. Consumindo API com cURL

O **cURL** é a ferramenta profissional para fazer requisições HTTP em PHP. Oferece controle total sobre a requisição.

### 15.1 Estrutura básica do cURL

```php
<?php
function fazerRequisicaoGET(string $url): ?array
{
    // 1. Inicializar o cURL
    $ch = curl_init();

    // 2. Configurar as opções
    curl_setopt_array($ch, [
        CURLOPT_URL            => $url,           // URL da API
        CURLOPT_RETURNTRANSFER => true,           // Retorna como string (não imprime)
        CURLOPT_TIMEOUT        => 10,             // Timeout de 10 segundos
        CURLOPT_FOLLOWLOCATION => true,           // Segue redirecionamentos
        CURLOPT_SSL_VERIFYPEER => true,           // Verifica certificado SSL
        CURLOPT_HTTPHEADER     => [               // Cabeçalhos HTTP
            'Accept: application/json',
            'User-Agent: PHP-ADS/1.0'
        ],
    ]);

    // 3. Executar a requisição
    $resposta = curl_exec($ch);

    // 4. Verificar erros
    if (curl_errno($ch)) {
        echo "❌ Erro cURL: " . curl_error($ch);
        curl_close($ch);
        return null;
    }

    // 5. Verificar o código de status HTTP
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    // 6. Fechar a conexão
    curl_close($ch);

    if ($httpCode !== 200) {
        echo "❌ A API retornou o status: $httpCode";
        return null;
    }

    // 7. Decodificar o JSON
    return json_decode($resposta, true);
}

// Uso:
$dados = fazerRequisicaoGET('https://viacep.com.br/ws/01001000/json/');
if ($dados) {
    echo "Cidade: " . $dados['localidade'];
}
```

### 15.2 Comparativo: file_get_contents vs. cURL

| Característica | file_get_contents | cURL |
|----------------|-------------------|------|
| **Simplicidade** | ✅ Muito simples | ⚠️ Mais código |
| **Métodos HTTP** | Apenas GET* | GET, POST, PUT, DELETE... |
| **Controle de erros** | ⚠️ Básico | ✅ Completo |
| **Timeout** | ⚠️ Limitado | ✅ Configurável |
| **Headers personalizados** | ⚠️ Possível, mas complexo | ✅ Fácil |
| **Quando usar?** | Exemplos simples, protótipos | Produção, APIs complexas |

> 💡 **Recomendação:** Use `file_get_contents` para aprender e prototipar. Use `cURL` em projetos reais.

---

## 16. Exemplo Prático 1 — ViaCEP (Consulta de CEP)

A **ViaCEP** é uma API gratuita brasileira que retorna dados de endereço a partir de um CEP.

### 📄 Arquivo: `consulta_cep.php`

```php
<?php
$endereco = null;
$erro = '';
$cepBuscado = '';

if (isset($_GET['cep'])) {
    $cepBuscado = preg_replace('/\D/', '', $_GET['cep']); // Remove tudo que não for número

    // Validação: CEP deve ter 8 dígitos
    if (strlen($cepBuscado) !== 8) {
        $erro = "❌ CEP inválido! Deve conter 8 dígitos.";
    } else {
        // Monta a URL da API
        $url = "https://viacep.com.br/ws/{$cepBuscado}/json/";

        // Faz a requisição para a API
        $resposta = @file_get_contents($url);

        if ($resposta === false) {
            $erro = "❌ Erro ao conectar com a API ViaCEP. Tente novamente.";
        } else {
            $endereco = json_decode($resposta, true);

            // A API retorna {"erro": true} quando o CEP não existe
            if (isset($endereco['erro']) && $endereco['erro'] === true) {
                $erro = "❌ CEP não encontrado na base dos Correios.";
                $endereco = null;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Consulta de CEP — ViaCEP</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f9; padding: 20px; }
        h2   { text-align: center; color: #333; }
        .container {
            max-width: 600px; margin: 0 auto; background: #fff;
            padding: 25px; border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .busca {
            display: flex; gap: 10px; margin-bottom: 20px;
        }
        .busca input {
            flex: 1; padding: 12px; border: 2px solid #ddd;
            border-radius: 8px; font-size: 16px;
        }
        .busca input:focus { border-color: #007bff; outline: none; }
        .busca button {
            padding: 12px 24px; background: #007bff; color: #fff;
            border: none; border-radius: 8px; cursor: pointer; font-size: 16px;
        }
        .busca button:hover { background: #0056b3; }
        .resultado {
            background: #f8f9fa; padding: 20px; border-radius: 8px;
            border-left: 4px solid #28a745;
        }
        .resultado h3 { color: #28a745; margin-top: 0; }
        .campo { margin: 8px 0; }
        .campo strong { color: #333; display: inline-block; width: 120px; }
        .erro { background: #f8d7da; color: #721c24; padding: 12px;
                border-radius: 8px; text-align: center; }
        .api-info { text-align: center; margin-top: 15px; font-size: 12px; color: #999; }
    </style>
</head>
<body>

<div class="container">
    <h2>📮 Consulta de CEP</h2>
    <p style="text-align:center; color:#666;">
        API utilizada: <a href="https://viacep.com.br/" target="_blank">ViaCEP</a> (gratuita)
    </p>

    <form method="GET" class="busca">
        <input type="text" name="cep" placeholder="Digite o CEP (ex: 01001-000)"
               value="<?= htmlspecialchars($cepBuscado) ?>" maxlength="9" required>
        <button type="submit">🔍 Buscar</button>
    </form>

    <?php if (!empty($erro)): ?>
        <div class="erro"><?= $erro ?></div>
    <?php endif; ?>

    <?php if ($endereco): ?>
        <div class="resultado">
            <h3>📍 Endereço Encontrado</h3>
            <div class="campo"><strong>CEP:</strong> <?= $endereco['cep'] ?></div>
            <div class="campo"><strong>Logradouro:</strong> <?= htmlspecialchars($endereco['logradouro'] ?? 'N/A') ?></div>
            <div class="campo"><strong>Complemento:</strong> <?= htmlspecialchars($endereco['complemento'] ?? '—') ?></div>
            <div class="campo"><strong>Bairro:</strong> <?= htmlspecialchars($endereco['bairro'] ?? 'N/A') ?></div>
            <div class="campo"><strong>Cidade:</strong> <?= htmlspecialchars($endereco['localidade']) ?></div>
            <div class="campo"><strong>Estado:</strong> <?= htmlspecialchars($endereco['uf']) ?></div>
            <div class="campo"><strong>DDD:</strong> <?= htmlspecialchars($endereco['ddd'] ?? '—') ?></div>
            <div class="campo"><strong>IBGE:</strong> <?= htmlspecialchars($endereco['ibge'] ?? '—') ?></div>
        </div>
    <?php endif; ?>

    <p class="api-info">
        URL da API chamada:
        <?php if (!empty($cepBuscado)): ?>
            <code>https://viacep.com.br/ws/<?= $cepBuscado ?>/json/</code>
        <?php else: ?>
            <code>—</code>
        <?php endif; ?>
    </p>
</div>

</body>
</html>
```

### Como a API é chamada — passo a passo

```
 1. Usuário digita: 01001-000
 2. PHP limpa: 01001000 (remove o hífen)
 3. Monta a URL: https://viacep.com.br/ws/01001000/json/
 4. file_get_contents() faz GET na URL
 5. API retorna JSON:
    {
      "cep": "01001-000",
      "logradouro": "Praça da Sé",
      "bairro": "Sé",
      "localidade": "São Paulo",
      "uf": "SP",
      "ddd": "11"
    }
 6. json_decode() converte para array PHP
 7. PHP exibe os dados no HTML
```

---

## 17. Exemplo Prático 2 — API de Moedas (Cotação do Dólar)

A **AwesomeAPI** fornece cotações de moedas em tempo real, sem necessidade de cadastro.

### 📄 Arquivo: `cotacao_moedas.php`

```php
<?php
// =============================================
// API AwesomeAPI — Cotações de Moedas
// Documentação: https://docs.awesomeapi.com.br/
// =============================================

// Lista de moedas que queremos consultar
$moedas = ['USD-BRL', 'EUR-BRL', 'GBP-BRL', 'BTC-BRL', 'ARS-BRL'];

// Monta a URL com todas as moedas separadas por vírgula
$url = 'https://economia.awesomeapi.com.br/json/last/' . implode(',', $moedas);

// Faz a requisição
$resposta = @file_get_contents($url);
$cotacoes = [];
$erro = '';

if ($resposta === false) {
    $erro = "❌ Não foi possível conectar à API de cotações.";
} else {
    $dados = json_decode($resposta, true);

    if ($dados === null) {
        $erro = "❌ Erro ao processar os dados da API.";
    } else {
        // Organizar os dados em um formato mais limpo
        foreach ($dados as $chave => $cotacao) {
            $cotacoes[] = [
                'moeda'       => $cotacao['name'],
                'codigo'      => $cotacao['code'],
                'compra'      => (float) $cotacao['bid'],
                'venda'       => (float) $cotacao['ask'],
                'variacao'    => (float) $cotacao['pctChange'],
                'maximo'      => (float) $cotacao['high'],
                'minimo'      => (float) $cotacao['low'],
                'atualizacao' => $cotacao['create_date'],
            ];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cotação de Moedas</title>
    <style>
        body  { font-family: Arial, sans-serif; background: #1a1a2e; color: #eee; padding: 20px; }
        h2    { text-align: center; color: #e94560; }
        .sub  { text-align: center; color: #888; margin-bottom: 20px; }
        table { width: 100%; max-width: 900px; margin: 0 auto; border-collapse: collapse; }
        th    { background-color: #16213e; color: #e94560; padding: 14px; text-align: center;
                border-bottom: 2px solid #e94560; }
        td    { padding: 12px; text-align: center; border-bottom: 1px solid #333; }
        tr:hover { background-color: #16213e; }
        .positivo { color: #00e676; font-weight: bold; }
        .negativo { color: #ff5252; font-weight: bold; }
        .valor    { color: #ffd700; font-weight: bold; font-size: 16px; }
        .erro     { text-align: center; color: #ff5252; padding: 20px; }
        .info     { text-align: center; color: #666; font-size: 12px; margin-top: 15px; }
    </style>
</head>
<body>

<h2>💰 Cotação de Moedas em Tempo Real</h2>
<p class="sub">API: <a href="https://docs.awesomeapi.com.br/" target="_blank" style="color:#e94560;">AwesomeAPI</a></p>

<?php if (!empty($erro)): ?>
    <div class="erro"><?= $erro ?></div>
<?php elseif (!empty($cotacoes)): ?>
    <table>
        <thead>
            <tr>
                <th>Moeda</th>
                <th>Compra</th>
                <th>Venda</th>
                <th>Variação</th>
                <th>Mínima</th>
                <th>Máxima</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cotacoes as $c): ?>
            <tr>
                <td>
                    <strong><?= htmlspecialchars($c['codigo']) ?></strong><br>
                    <small style="color:#888;"><?= htmlspecialchars($c['moeda']) ?></small>
                </td>
                <td class="valor">R$ <?= number_format($c['compra'], 4, ',', '.') ?></td>
                <td class="valor">R$ <?= number_format($c['venda'], 4, ',', '.') ?></td>
                <td class="<?= $c['variacao'] >= 0 ? 'positivo' : 'negativo' ?>">
                    <?= $c['variacao'] >= 0 ? '▲' : '▼' ?>
                    <?= number_format(abs($c['variacao']), 2, ',', '.') ?>%
                </td>
                <td>R$ <?= number_format($c['minimo'], 4, ',', '.') ?></td>
                <td>R$ <?= number_format($c['maximo'], 4, ',', '.') ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <p class="info">
        Última atualização: <?= $cotacoes[0]['atualizacao'] ?? '—' ?><br>
        URL da API: <code><?= htmlspecialchars($url) ?></code>
    </p>
<?php endif; ?>

</body>
</html>
```

### O que este exemplo ensina de novo?

1. **Múltiplos dados de uma vez:** A API retorna cotações de várias moedas em uma única chamada.
2. **Formatação condicional:** A variação fica verde (positiva) ou vermelha (negativa).
3. **Dados dinâmicos:** Diferente do JSON local, os valores mudam a cada requisição.

---

## 18. Exemplo Prático 3 — PokeAPI (Lista de Pokémons)

A **PokeAPI** é uma API gratuita e divertida, perfeita para praticar o consumo de APIs.

### 📄 Arquivo: `pokedex.php`

```php
<?php
// =============================================
// PokeAPI — Pokédex Simples
// Documentação: https://pokeapi.co/
// =============================================

$pokemon = null;
$erro = '';
$busca = trim($_GET['pokemon'] ?? '');

if (!empty($busca)) {
    // A PokeAPI aceita nome ou ID (em minúsculas)
    $termo = strtolower($busca);
    $url = "https://pokeapi.co/api/v2/pokemon/{$termo}";

    // Usando cURL para melhor controle de erros
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL            => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 10,
    ]);
    $resposta = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode === 200) {
        $dados = json_decode($resposta, true);
        
        // Extrair os dados que nos interessam
        $pokemon = [
            'id'     => $dados['id'],
            'nome'   => ucfirst($dados['name']),
            'imagem' => $dados['sprites']['other']['official-artwork']['front_default']
                        ?? $dados['sprites']['front_default'],
            'tipos'  => array_map(fn($t) => ucfirst($t['type']['name']), $dados['types']),
            'peso'   => $dados['weight'] / 10, // Converter para kg
            'altura' => $dados['height'] / 10, // Converter para m
            'stats'  => [],
        ];

        // Extrair as estatísticas base
        foreach ($dados['stats'] as $stat) {
            $pokemon['stats'][] = [
                'nome'  => $stat['stat']['name'],
                'valor' => $stat['base_stat'],
            ];
        }
    } elseif ($httpCode === 404) {
        $erro = "❌ Pokémon '<strong>" . htmlspecialchars($busca) . "</strong>' não encontrado!";
    } else {
        $erro = "❌ Erro ao consultar a API (HTTP $httpCode).";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Pokédex PHP</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f0f0f0; padding: 20px;
               text-align: center; }
        h2   { color: #e3350d; }
        .busca-form {
            margin: 20px auto; display: flex; gap: 10px;
            justify-content: center; max-width: 500px;
        }
        .busca-form input {
            flex: 1; padding: 12px; border: 2px solid #ddd;
            border-radius: 25px; font-size: 16px; text-align: center;
        }
        .busca-form button {
            padding: 12px 24px; background: #e3350d; color: #fff;
            border: none; border-radius: 25px; cursor: pointer; font-size: 16px;
        }
        .card {
            max-width: 400px; margin: 20px auto; background: #fff;
            border-radius: 15px; box-shadow: 0 8px 24px rgba(0,0,0,0.12);
            padding: 25px; overflow: hidden;
        }
        .card img { width: 200px; height: 200px; object-fit: contain; }
        .card h3  { margin: 10px 0 5px; font-size: 24px; color: #333; }
        .card .id { color: #999; font-size: 14px; }
        .tipos span {
            display: inline-block; padding: 4px 14px; border-radius: 20px;
            color: #fff; font-size: 13px; margin: 3px;
        }
        .info-grid {
            display: flex; justify-content: space-around; margin: 15px 0;
            background: #f8f9fa; padding: 12px; border-radius: 8px;
        }
        .stat-bar { margin: 6px 0; text-align: left; }
        .stat-bar label { display: inline-block; width: 130px; font-size: 13px;
                          color: #666; text-transform: capitalize; }
        .stat-bar .barra {
            display: inline-block; height: 12px; border-radius: 6px;
            background: #e3350d; vertical-align: middle;
        }
        .stat-bar .valor { font-size: 13px; font-weight: bold; margin-left: 5px; }
        .erro { color: #e3350d; margin: 20px; }
        .sugestoes { color: #888; font-size: 13px; margin-top: 10px; }
    </style>
</head>
<body>

<h2>⚡ Pokédex PHP</h2>
<p style="color:#666;">API: <a href="https://pokeapi.co/" target="_blank">PokeAPI</a></p>

<form method="GET" class="busca-form">
    <input type="text" name="pokemon" placeholder="Nome ou número (ex: pikachu, 25)"
           value="<?= htmlspecialchars($busca) ?>" required>
    <button type="submit">Buscar</button>
</form>

<p class="sugestoes">
    💡 Sugestões: pikachu, charizard, mewtwo, eevee, bulbasaur, 150
</p>

<?php if (!empty($erro)): ?>
    <p class="erro"><?= $erro ?></p>
<?php endif; ?>

<?php if ($pokemon): ?>
    <div class="card">
        <img src="<?= htmlspecialchars($pokemon['imagem']) ?>"
             alt="<?= htmlspecialchars($pokemon['nome']) ?>">
        
        <p class="id">#<?= str_pad($pokemon['id'], 3, '0', STR_PAD_LEFT) ?></p>
        <h3><?= htmlspecialchars($pokemon['nome']) ?></h3>

        <div class="tipos">
            <?php
            // Cores por tipo de Pokémon
            $cores = [
                'fire' => '#F08030', 'water' => '#6890F0', 'grass' => '#78C850',
                'electric' => '#F8D030', 'psychic' => '#F85888', 'ice' => '#98D8D8',
                'dragon' => '#7038F8', 'dark' => '#705848', 'fairy' => '#EE99AC',
                'normal' => '#A8A878', 'fighting' => '#C03028', 'flying' => '#A890F0',
                'poison' => '#A040A0', 'ground' => '#E0C068', 'rock' => '#B8A038',
                'bug' => '#A8B820', 'ghost' => '#705898', 'steel' => '#B8B8D0',
            ];
            foreach ($pokemon['tipos'] as $tipo):
                $cor = $cores[strtolower($tipo)] ?? '#888';
            ?>
                <span style="background:<?= $cor ?>"><?= htmlspecialchars($tipo) ?></span>
            <?php endforeach; ?>
        </div>

        <div class="info-grid">
            <div>
                <small style="color:#999;">Peso</small><br>
                <strong><?= $pokemon['peso'] ?> kg</strong>
            </div>
            <div>
                <small style="color:#999;">Altura</small><br>
                <strong><?= $pokemon['altura'] ?> m</strong>
            </div>
        </div>

        <h4 style="text-align:left; color:#333;">📊 Estatísticas Base</h4>
        <?php foreach ($pokemon['stats'] as $stat): ?>
            <div class="stat-bar">
                <label><?= htmlspecialchars($stat['nome']) ?></label>
                <span class="barra" style="width: <?= min($stat['valor'], 200) ?>px;"></span>
                <span class="valor"><?= $stat['valor'] ?></span>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

</body>
</html>
```

### O que este exemplo ensina de novo?

1. **cURL em ação:** Usa cURL para melhor controle de erros (HTTP 404 vs. 200).
2. **JSON aninhado complexo:** A PokeAPI retorna dados em vários níveis de profundidade.
3. **Transformação de dados:** Extrai apenas os campos necessários de uma resposta grande.
4. **Tratamento de arrays dentro de arrays:** Tipos, stats, sprites etc.

---

## 19. Tratamento de Erros em APIs

Em produção, vários problemas podem acontecer ao consumir APIs. É fundamental tratar cada um:

### 📄 Arquivo: `api_com_tratamento.php`

```php
<?php
/**
 * Função robusta para consumir APIs com tratamento completo de erros.
 * Pode ser reutilizada em qualquer projeto!
 *
 * @param  string      $url     URL da API
 * @param  int         $timeout Tempo máximo de espera (segundos)
 * @return array       ['sucesso' => bool, 'dados' => array|null, 'erro' => string]
 */
function consumirAPI(string $url, int $timeout = 10): array
{
    // =============================================
    // VERIFICAÇÃO 1: A extensão cURL está instalada?
    // =============================================
    if (!function_exists('curl_init')) {
        return [
            'sucesso' => false,
            'dados'   => null,
            'erro'    => 'A extensão cURL não está instalada no servidor.',
        ];
    }

    // =============================================
    // VERIFICAÇÃO 2: A URL é válida?
    // =============================================
    if (!filter_var($url, FILTER_VALIDATE_URL)) {
        return [
            'sucesso' => false,
            'dados'   => null,
            'erro'    => "URL inválida: $url",
        ];
    }

    // =============================================
    // REQUISIÇÃO
    // =============================================
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL            => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => $timeout,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTPHEADER     => ['Accept: application/json'],
    ]);

    $resposta = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    curl_close($ch);

    // =============================================
    // VERIFICAÇÃO 3: Erro de conexão (rede/DNS/timeout)
    // =============================================
    if ($resposta === false) {
        return [
            'sucesso' => false,
            'dados'   => null,
            'erro'    => "Erro de conexão: $curlError",
        ];
    }

    // =============================================
    // VERIFICAÇÃO 4: Status HTTP indica erro?
    // =============================================
    if ($httpCode < 200 || $httpCode >= 300) {
        $mensagens = [
            400 => 'Requisição malformada (Bad Request)',
            401 => 'Não autorizado — verifique a chave de API',
            403 => 'Acesso proibido (Forbidden)',
            404 => 'Recurso não encontrado',
            429 => 'Muitas requisições — aguarde antes de tentar novamente',
            500 => 'Erro interno do servidor da API',
            502 => 'Bad Gateway — servidor intermediário com problemas',
            503 => 'Serviço indisponível — API fora do ar',
        ];

        $msg = $mensagens[$httpCode] ?? "Erro HTTP desconhecido";

        return [
            'sucesso' => false,
            'dados'   => null,
            'erro'    => "HTTP $httpCode — $msg",
        ];
    }

    // =============================================
    // VERIFICAÇÃO 5: O JSON é válido?
    // =============================================
    $dados = json_decode($resposta, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        return [
            'sucesso' => false,
            'dados'   => null,
            'erro'    => "Resposta não é um JSON válido: " . json_last_error_msg(),
        ];
    }

    // =============================================
    // SUCESSO!
    // =============================================
    return [
        'sucesso' => true,
        'dados'   => $dados,
        'erro'    => '',
    ];
}

// =============================================
// USO DA FUNÇÃO
// =============================================

// Exemplo 1: CEP válido
$resultado = consumirAPI('https://viacep.com.br/ws/01001000/json/');

if ($resultado['sucesso']) {
    echo "✅ Cidade: " . $resultado['dados']['localidade'] . "<br>";
} else {
    echo "❌ Erro: " . $resultado['erro'] . "<br>";
}

// Exemplo 2: URL inválida
$resultado = consumirAPI('https://api-que-nao-existe.com.br/teste');
echo "❌ Erro: " . $resultado['erro'] . "<br>";
// Saída: Erro de conexão: Could not resolve host

// Exemplo 3: Recurso que não existe (404)
$resultado = consumirAPI('https://pokeapi.co/api/v2/pokemon/xyz123');
echo "❌ Erro: " . $resultado['erro'] . "<br>";
// Saída: HTTP 404 — Recurso não encontrado
```

### Checklist de tratamento de erros

```
 ✅ Verificar se cURL está disponível
 ✅ Validar a URL antes de fazer a requisição
 ✅ Definir timeout (evitar que a página "trave")
 ✅ Verificar se a requisição retornou resposta
 ✅ Verificar o código de status HTTP
 ✅ Verificar se o JSON é válido
 ✅ Tratar erros específicos com mensagens amigáveis
 ✅ Usar o operador @ com file_get_contents OU cURL com verificação
```

---

## 20. Enviando Dados para uma API (POST)

Até agora, apenas **buscamos** dados (GET). Agora, vamos **enviar** dados para uma API usando o método POST.

### 20.1 POST com cURL

```php
<?php
/**
 * Função para enviar dados via POST para uma API
 */
function enviarParaAPI(string $url, array $dados): array
{
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL            => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 10,
        CURLOPT_POST           => true,                         // Define como POST
        CURLOPT_POSTFIELDS     => json_encode($dados),          // Corpo da requisição
        CURLOPT_HTTPHEADER     => [
            'Content-Type: application/json',                    // Informa que enviamos JSON
            'Accept: application/json',
        ],
    ]);

    $resposta = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return [
        'status' => $httpCode,
        'dados'  => json_decode($resposta, true),
    ];
}
```

### 20.2 Exemplo prático com JSONPlaceholder

A **JSONPlaceholder** é uma API fake para testes — perfeita para praticar POST sem consequências:

```php
<?php
// Simulando o cadastro de um post em um blog
$novoPost = [
    'title'  => 'Aprendendo PHP na disciplina de Programação Web',
    'body'   => 'Hoje aprendemos a consumir APIs externas usando PHP e cURL!',
    'userId' => 1,
];

$resultado = enviarParaAPI(
    'https://jsonplaceholder.typicode.com/posts',
    $novoPost
);

echo "Status HTTP: " . $resultado['status'] . "<br>";    // 201 (Created)
echo "ID criado: "   . $resultado['dados']['id'] . "<br>"; // 101

echo "<h3>Dados enviados e confirmados pela API:</h3>";
echo "<pre>" . print_r($resultado['dados'], true) . "</pre>";
```

**Saída:**
```
Status HTTP: 201
ID criado: 101

Dados enviados e confirmados pela API:
Array
(
    [title] => Aprendendo PHP na disciplina de Programação Web
    [body] => Hoje aprendemos a consumir APIs externas usando PHP e cURL!
    [userId] => 1
    [id] => 101
)
```

### 20.3 Exemplo completo — Formulário que envia para uma API

### 📄 Arquivo: `enviar_para_api.php`

```php
<?php
$resposta = null;
$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo  = trim($_POST['titulo'] ?? '');
    $corpo   = trim($_POST['corpo'] ?? '');

    if (empty($titulo) || empty($corpo)) {
        $erro = "❌ Preencha todos os campos!";
    } else {
        // Montar os dados para enviar
        $dados = [
            'title'  => $titulo,
            'body'   => $corpo,
            'userId' => 1,
        ];

        // Enviar via POST para a API
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL            => 'https://jsonplaceholder.typicode.com/posts',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 10,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => json_encode($dados),
            CURLOPT_HTTPHEADER     => [
                'Content-Type: application/json',
                'Accept: application/json',
            ],
        ]);

        $respostaJSON = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode === 201) {
            $resposta = json_decode($respostaJSON, true);
        } else {
            $erro = "❌ Erro ao enviar para a API (HTTP $httpCode).";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Enviar para API (POST)</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f9; padding: 20px; }
        h2   { text-align: center; color: #333; }
        .container {
            max-width: 600px; margin: 0 auto; background: #fff;
            padding: 25px; border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        label  { display: block; margin-top: 12px; font-weight: bold; color: #333; }
        input, textarea {
            width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc;
            border-radius: 5px; font-size: 14px; box-sizing: border-box;
        }
        textarea { height: 120px; resize: vertical; }
        button {
            width: 100%; margin-top: 20px; padding: 12px; font-size: 16px;
            background: #28a745; color: #fff; border: none;
            border-radius: 5px; cursor: pointer;
        }
        button:hover { background: #218838; }
        .sucesso {
            background: #d4edda; color: #155724; padding: 15px;
            border-radius: 5px; margin-top: 15px; border: 1px solid #c3e6cb;
        }
        .erro {
            background: #f8d7da; color: #721c24; padding: 12px;
            border-radius: 5px; margin-top: 15px; text-align: center;
        }
        pre {
            background: #f8f9fa; padding: 10px; border-radius: 5px;
            overflow-x: auto; font-size: 13px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>📤 Enviar Dados para API (POST)</h2>
    <p style="text-align:center; color:#666; font-size:14px;">
        API: <a href="https://jsonplaceholder.typicode.com/" target="_blank">JSONPlaceholder</a>
        (API de teste — os dados não são salvos de verdade)
    </p>

    <?php if (!empty($erro)): ?>
        <div class="erro"><?= $erro ?></div>
    <?php endif; ?>

    <?php if ($resposta): ?>
        <div class="sucesso">
            <strong>✅ Dados enviados com sucesso!</strong><br><br>
            <strong>ID retornado pela API:</strong> <?= $resposta['id'] ?><br>
            <strong>Título:</strong> <?= htmlspecialchars($resposta['title']) ?><br>
            <strong>Corpo:</strong> <?= htmlspecialchars($resposta['body']) ?><br><br>
            <strong>Resposta completa da API (JSON):</strong>
            <pre><?= json_encode($resposta, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) ?></pre>
        </div>
    <?php endif; ?>

    <form method="POST">
        <label for="titulo">Título do Post:</label>
        <input type="text" id="titulo" name="titulo"
               placeholder="Ex: Meu primeiro post via API" required>

        <label for="corpo">Conteúdo:</label>
        <textarea id="corpo" name="corpo"
                  placeholder="Escreva o conteúdo do post..." required></textarea>

        <button type="submit">📤 Enviar para a API</button>
    </form>
</div>

</body>
</html>
```

---

# ENCERRAMENTO

---

## 21. Comparativo: Array vs JSON vs API

| Característica | 📌 Array PHP | 📁 JSON Local | 🌐 API Externa |
|----------------|:------------:|:-------------:|:--------------:|
| **Dados ficam** | No código | Em arquivo no servidor | Na Internet |
| **Facilidade** | ⭐⭐⭐ Muito fácil | ⭐⭐ Fácil | ⭐ Requer estudo |
| **Dados dinâmicos** | ❌ Fixos | ⚠️ Editáveis manualmente | ✅ Atualizados em tempo real |
| **Compartilhamento** | ❌ Apenas no PHP | ⚠️ Qualquer linguagem pode ler | ✅ Qualquer sistema pode consumir |
| **Escalabilidade** | ❌ Não escala | ⚠️ Limitado | ✅ Alta escalabilidade |
| **Necessita Internet** | ❌ Não | ❌ Não | ✅ Sim |
| **Uso ideal** | Protótipos, exemplos | Configurações, dados pequenos | Dados reais de serviços |

### Progressão de aprendizado

```
  INICIANTE                    INTERMEDIÁRIO                    AVANÇADO
 ┌────────────┐              ┌────────────────┐              ┌──────────────────┐
 │ Array PHP  │    ───▶      │  JSON Local     │    ───▶     │  API Externa      │
 │            │              │                 │              │                   │
 │ foreach    │              │ file_get_       │              │ cURL / fetch      │
 │ para exibir│              │ contents()      │              │ HTTP Status       │
 │ dados      │              │ json_decode()   │              │ Tratamento erros  │
 │            │              │ json_encode()   │              │ GET e POST        │
 └────────────┘              └────────────────┘              └──────────────────┘
```

---

## 22. Exercícios Propostos

### 📝 Nível 1 — Array Interno (Básico)

**Exercício 1.1:** Crie um array com pelo menos 10 filmes (id, titulo, genero, ano, nota). Exiba em uma tabela HTML com estilos CSS. Destaque com cor diferente os filmes com nota acima de 8.

**Exercício 1.2:** No mesmo array de filmes, crie uma página `detalhe_filme.php` que receba o ID por `$_GET` e exiba as informações completas do filme em um card estilizado.

**Exercício 1.3:** Adicione um formulário de busca que permita filtrar os filmes por gênero e/ou por texto no título.

---

### 📝 Nível 2 — JSON Local (Intermediário)

**Exercício 2.1:** Migre o array de filmes para um arquivo `filmes.json`. Adapte as páginas de listagem e detalhe para ler do JSON.

**Exercício 2.2:** Crie uma página `cadastrar_filme.php` com formulário que adiciona novos filmes ao arquivo `filmes.json`.

**Exercício 2.3:** Crie uma página `editar_filme.php?id=X` que carregue os dados do filme no formulário e, ao salvar, atualize o arquivo JSON.

**Exercício 2.4 (Desafio):** Crie uma página `excluir_filme.php?id=X` que remova o filme do JSON e redirecione para a lista com uma mensagem de confirmação.

---

### 📝 Nível 3 — API Externa (Avançado)

**Exercício 3.1 — Consulta de CEP com preenchimento automático:**
Usando a API ViaCEP, crie um formulário de endereço onde ao digitar o CEP e clicar em "Buscar", os campos de rua, bairro, cidade e estado sejam preenchidos automaticamente.

**Exercício 3.2 — Conversor de Moedas:**
Usando a AwesomeAPI, crie um conversor que permita ao usuário:
- Digitar um valor em reais (R$)
- Selecionar a moeda de destino (Dólar, Euro, Libra)
- Ver o valor convertido com base na cotação em tempo real

**Exercício 3.3 — Pokédex Completa:**
Usando a PokeAPI, crie uma página que:
- Liste os 20 primeiros Pokémons com imagem e nome
- Permita clicar em um Pokémon para ver seus detalhes completos
- Implemente paginação para navegar entre os Pokémons

**Exercício 3.4 — Consulta de Estados e Municípios (IBGE):**
Usando a API do IBGE (`https://servicodados.ibge.gov.br/api/v1/localidades/estados`), crie um sistema com dois `<select>`:
- O primeiro lista os estados brasileiros
- Ao selecionar um estado, o segundo `<select>` é preenchido com os municípios daquele estado

**Exercício 3.5 (Desafio Final):** Combine o que aprendeu e crie um **mini sistema de e-commerce** que:
- Liste produtos de um arquivo `produtos.json`
- Consulte o CEP do cliente via API ViaCEP
- Exiba o valor total convertido em dólar usando a API de Cotações

---

## 📚 APIs Públicas para Praticar

| API | URL | Autenticação | Descrição |
|-----|-----|--------------|-----------|
| ViaCEP | `viacep.com.br` | Nenhuma | CEPs brasileiros |
| AwesomeAPI | `economia.awesomeapi.com.br` | Nenhuma | Cotações de moedas |
| PokeAPI | `pokeapi.co` | Nenhuma | Dados de Pokémons |
| IBGE | `servicodados.ibge.gov.br` | Nenhuma | Localidades do Brasil |
| JSONPlaceholder | `jsonplaceholder.typicode.com` | Nenhuma | API fake para testes |
| Dog CEO | `dog.ceo/dog-api` | Nenhuma | Fotos de cachorros |
| Open Trivia DB | `opentdb.com/api_config.php` | Nenhuma | Perguntas de trivia |
| Rick and Morty | `rickandmortyapi.com` | Nenhuma | Personagens da série |

---

> **📝 Nota do Professor:** Este tutorial foi construído de forma progressiva para que vocês entendam como os dados "caminham" em uma aplicação web. No mercado de trabalho, o consumo de APIs é uma habilidade fundamental — praticamente toda aplicação moderna se comunica com algum serviço externo. Pratiquem bastante os exercícios! 🚀

---

*Material elaborado para a disciplina de Programação para Internet — Curso de Análise e Desenvolvimento de Sistemas.*
