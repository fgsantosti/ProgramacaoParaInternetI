<?php
// Lista de produtos do supermercado
$produtos = [
    ["id" => 1, "nome" => "Arroz 5kg",         "categoria" => "Grãos",     "preco" => 24.90, "estoque" => 150],
    ["id" => 2, "nome" => "Feijão 1kg",         "categoria" => "Grãos",     "preco" => 8.50,  "estoque" => 200],
    ["id" => 3, "nome" => "Leite Integral 1L",  "categoria" => "Laticínios","preco" => 5.99,  "estoque" => 300],
    ["id" => 4, "nome" => "Óleo de Soja 900ml", "categoria" => "Óleos",     "preco" => 7.80,  "estoque" => 120],
    ["id" => 5, "nome" => "Açúcar 1kg",         "categoria" => "Mercearia", "preco" => 4.50,  "estoque" => 180],
    ["id" => 6, "nome" => "Macarrão 500g",      "categoria" => "Massas",    "preco" => 3.99,  "estoque" => 250],
    ["id" => 7, "nome" => "Frango Inteiro 1kg", "categoria" => "Carnes",    "preco" => 12.90, "estoque" => 80],
    ["id" => 8, "nome" => "Sabão em Pó 1kg",    "categoria" => "Limpeza",   "preco" => 11.99, "estoque" => 90],
];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Produtos do Supermercado</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f9; padding: 20px; }
        h2   { text-align: center; color: #333; }
        table { width: 100%; max-width: 800px; margin: 0 auto; border-collapse: collapse; background: #fff; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        th   { background-color: #007bff; color: #fff; padding: 12px; text-align: center; }
        td   { padding: 10px 14px; border-bottom: 1px solid #ddd; text-align: center; }
        tr:hover { background-color: #f1f1f1; }
        .preco { color: #28a745; font-weight: bold; }
        .baixo-estoque { color: #dc3545; font-weight: bold; }
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
            <td><?= $p['id'] ?></td>
            <td><?= $p['nome'] ?></td>
            <td><?= $p['categoria'] ?></td>
            <td class="preco">R$ <?= number_format($p['preco'], 2, ',', '.') ?></td>
            <td class="<​?= $p['estoque'] < 100 ? 'baixo-estoque' : '' ?>">
                <?= $p['estoque'] ?> <?= $p['estoque'] < 100 ? '⚠️' : '' ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>