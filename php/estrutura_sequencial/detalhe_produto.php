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